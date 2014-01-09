<?php
/**
 * 	POP System
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class pop_system {
	
	function __construct() {
	
	}
	
	public function download() {
	
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$config			= &singleton::get(__NAMESPACE__ . '\config');
		$pop_accounts	= &singleton::get(__NAMESPACE__ . '\pop_accounts');
		
		$accounts = $pop_accounts->get(array('enabled' => 1));
		
		if (count($accounts) > 0) {
			
			include(LIB . '/pop3/mime_parser.php');
			include(LIB . '/pop3/rfc822_addresses.php');
			include(LIB . '/pop3/pop3.php');
			include(LIB . '/pop3/sasl.php');

			if (in_array('pop3', stream_get_wrappers())) {
				stream_wrapper_unregister('pop3');
			}
			
			stream_wrapper_register('pop3', 'pop3_stream');  /* Register the pop3 stream handler class */
			
			$pop3 = new \pop3_class();

			$log_array['event_severity'] = 'notice';
			$log_array['event_number'] = E_USER_NOTICE;
			$log_array['event_description'] = 'POP3 Start';
			$log_array['event_file'] = __FILE__;
			$log_array['event_file_line'] = __LINE__;
			$log_array['event_type'] = 'download';
			$log_array['event_source'] = 'pop_system';
			$log_array['event_version'] = '1';
			$log_array['log_backtrace'] = false;	
				
			//$log->add($log_array);
			
			$storage_path = $config->get('storage_path');
			
			//loop through each enabled email account and download email
			foreach($accounts as $account) {
				$array = array();
			
				$array['obj'] 				= $pop3;
				$array['hostname']			= $account['hostname'];
				$array['port']				= $account['port'];
				$array['tls']				= $account['tls'];
				$array['username']			= $account['username'];
				$array['password']			= decode($account['password']);
				$array['priority_id']		= $account['priority_id'];
				$array['department_id']		= $account['department_id'];
				$array['leave_messages']	= $account['leave_messages'];
				$array['id']				= $account['id'];

				
				if ($config->get('storage_enabled') && !empty($storage_path) && ($account['download_files'])) {
					$array['download_files']	= 1;
				}
				else {
					$array['download_files']	= 0;
				}
				
				if ($config->get('html_enabled')) {
					$array['html_enabled']	= 1;
				}
				else {
					$array['html_enabled']	= 0;
				}
				
				$this->download_email($array);
				
				unset($array);
			}
			
			$log_array['event_severity'] = 'notice';
			$log_array['event_number'] = E_USER_NOTICE;
			$log_array['event_description'] = 'POP3 Stop Time: ' . stop_timer();
			$log_array['event_file'] = __FILE__;
			$log_array['event_file_line'] = __LINE__;
			$log_array['event_type'] = 'download';
			$log_array['event_source'] = 'pop_system';
			$log_array['event_version'] = '1';
			$log_array['log_backtrace'] = false;	
				
			//$log->add($log_array);
		}
		
		
	}	
	
	private function download_email($account) {
	
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tickets		= &singleton::get(__NAMESPACE__ . '\tickets');
		$ticket_notes	= &singleton::get(__NAMESPACE__ . '\ticket_notes');
		$users			= &singleton::get(__NAMESPACE__ . '\users');
		$storage		= &singleton::get(__NAMESPACE__ . '\storage');
		
		$pop3				= $account['obj'];
		
		$pop3->hostname 	= $account['hostname'];		// POP 3 server host name
		$pop3->port 		= $account['port'];     	// POP 3 server host port
		$pop3->tls 			= $account['tls'];          // Establish secure connections using TLS
		$pop3->realm = '';                         /* Authentication realm or domain              */
		$pop3->workstation = '';                   /* Workstation for NTLM authentication         */
		$apop = 0;                                 /* Use APOP authentication                     */
		$pop3->authentication_mechanism = 'USER';  /* SASL authentication mechanism               */
		$pop3->debug = 0;                          /* Output debug information                    */
		$pop3->html_debug = 0;                     /* Debug information is in HTML                */
		$pop3->join_continuation_header_lines = 1; /* Concatenate headers split in multiple lines */

		if (($error = $pop3->Open()) == '') {
			if (($error = $pop3->Login($account['username'], $account['password'], $apop)) == '') {
				if (($error = $pop3->Statistics($messages, $size)) == '') {
					if ($messages > 0) {
						$log_array['event_severity'] = 'notice';
						$log_array['event_number'] = E_USER_NOTICE;
						$log_array['event_description'] = 'Found "' . (int) $messages . '" messages on POP server "' . safe_output($pop3->hostname) . '" for download';
						$log_array['event_file'] = __FILE__;
						$log_array['event_file_line'] = __LINE__;
						$log_array['event_type'] = 'download_email';
						$log_array['event_source'] = 'pop_system';
						$log_array['event_version'] = '1';
						$log_array['log_backtrace'] = false;	
							
						$log->add($log_array);
					
						$pop3->GetConnectionName($connection_name);
						for ($index = 1; $index <= $messages; $index++) {
							$saved_files		= array();
							$found_subject		= false;
						
							$message_file = 'pop3://' . $connection_name . '/' . $index;
							$mime = new \mime_parser_class();

							/*
							* Set to 0 for not decoding the message bodies
							*/
							$mime->decode_bodies = 1;

							$parameters = array(
								'File' 		=> $message_file
							);
							$success = $mime->Decode($parameters, $email_message);
																					
							$email = array();
							
							$email['body'] = '';
							$email['html']	= 0;
									
							//get the message id								
							$email['message_id']		= '';
							if (isset($email_message[0]['Headers']['message-id:']))	{
								$email['message_id']	 = $email_message[0]['Headers']['message-id:'];
							}
														
							//check if already downloaded	
							$import_message = true;
																
							if (!empty($email['message_id'])) {
								$count = $this->count_message(array('message_id' => $email['message_id']));
								if ($count > 0) {
									$import_message = false;
								}
								$this->add_message(array('message_id' => $email['message_id']));
							}
							
							if ($import_message) {
							
								if ($mime->Analyze($email_message[0], $results)) {
								
									//print_r($results);
									//exit;
								
									if ($results['Type'] == 'html') {
										$email['type'] = 'html';
										
										if ($account['html_enabled'] == 1) {
											if (isset($results['Data']) && !empty($results['Data'])) {	
												$email['html'] = 1;												
												$email['body'] = convert_encoding($results['Data'], $results['Encoding']);
											}
											else {
												$email['body'] = convert_encoding($results['Alternative'][0]['Data'], $results['Encoding']);
											}
										}
										else {
											if (isset($results['Alternative'][0]['Data']) && !empty($results['Alternative'][0]['Data'])) {	
												$email['body'] = convert_encoding($results['Alternative'][0]['Data'], $results['Encoding']);
											}
											else {
												$data = str_replace('<!DOCTYPE','<DOCTYPE',$results['Data']);

												$data = preg_replace("'<style[^>]*>.*</style>'siU",'',$data);
												$data = preg_replace('/</', ' <', $data);
												$data = preg_replace('/>/', '> ', $data);
												$data = html_entity_decode(strip_tags($data));
												$data = preg_replace('/[\n\r\t]/', ' ', $data);
												$data = preg_replace('/  /', ' ', $data);
												$data = trim($data);
												
												$email['body'] = convert_encoding($data, $results['Encoding']);
											}
										}

									}
									elseif ($results['Type'] == 'text') {
										$email['type'] = 'text';
										if (isset($results['Data']) && !empty($results['Data'])) {	
											$email['body'] = convert_encoding($results['Data'], $results['Encoding']);										
										}
									}
									
									//subject								
									if (isset($results['Subject']) && !empty($results['Subject'])) {
										if (isset($results['Encoding'])) {
											$email['subject'] = convert_encoding($results['Subject'], $results['Encoding']);
										}
										else {
											$email['subject'] = convert_encoding($results['Subject']);										
										}
									
										$found_subject				= TRUE;
									}
																		
									//save attachments
									if ($account['download_files'] == 1) {
										//there are 3 possible places where the file attachments could be
										if (isset($results['Attachments']) && is_array($results['Attachments'])) {
											foreach($results['Attachments'] as $possible_file) {
												if (isset($possible_file['Type'])) {
													if (!empty($possible_file['FileName'])) {
														$save_array['file']['name']		= $possible_file['FileName'];
														$save_array['file']['data']		= $possible_file['Data'];
														$save_array['name']				= $possible_file['FileName'];
														
														$saved_files[] = $storage->save_data($save_array);
													}
												}
											}
										}
										
										if (isset($results['Data'])) {
											if (!empty($results['FileName'])) {
												$save_array['file']['name']		= $results['FileName'];
												$save_array['file']['data']		= $results['Data'];
												$save_array['name']				= $results['FileName'];
												
												$saved_files[] = $storage->save_data($save_array);
											}
										}
										
										if (isset($results['Related']) && is_array($results['Related'])) {
											foreach($results['Related'] as $possible_file2) {
												if (isset($possible_file2['Type'])) {
													if (!empty($possible_file2['FileName'])) {
														$save_array['file']['name']		= $possible_file2['FileName'];
														$save_array['file']['data']		= $possible_file2['Data'];
														$save_array['name']				= $possible_file2['FileName'];
														
														$saved_files[] = $storage->save_data($save_array);
													}
												}
											}
										}									
										
									}
									unset($results);
								}
																	
								$email['from_address'] 		= $email_message[0]['ExtractedAddresses']['from:'][0]['address'];
								$email['from_name'] 		= $email_message[0]['ExtractedAddresses']['from:'][0]['name'];
								$email['to_address'] 		= $email_message[0]['Headers']['to:'];
								if (!$found_subject) {
									$email['subject']		 = $email_message[0]['Headers']['subject:'];
								}
								$email['date'] 				= $email_message[0]['Headers']['date:'];
								
								if (!empty($email['from_address'])) {
									$clients 					= $users->get(array('email' => $email['from_address'], 'limit' => 1));
								}
								else {
									$clients 					= NULL;
								}
									
								$new_ticket = true;
								
								//existing ticket
								if (strpos($email['body'], '[TID:') !== false) {
									$temp_id_array 	= explode('[TID:', $email['body']);
									$temp_id_array2 = explode(']', $temp_id_array[1]);
									$tid = $temp_id_array2[0];
									if (strpos($tid, '-') !== false) {
										$t_array 	= explode('-', $tid);
										$ticket_id 	= (int) $t_array[1];
										$ticket_key = $t_array[0];
										if ($ticket_id != 0) {
											//now we can check for the actual ticket
											$ticket_result = $tickets->get(array('id' => $ticket_id));
											
											if (!empty($ticket_result)) {
												$ticket = $ticket_result[0];
												if ($ticket['key'] == $ticket_key) {
													$ticket_note['date_added']	= datetime();
		
													$ticket_note['description']	= $email['body'];
													
													if (count($clients) == 1) {
														$ticket_note['user_id']	= $clients[0]['id'];
													}
													
													$ticket_note['html']			= (int) $email['html'];
													$ticket_note['ticket_id']		= $ticket['id'];
													
													$ticket_notes->add($ticket_note);
													
													$update_ticket['state_id']				= 1;
													$update_ticket['date_state_changed']	= datetime();
													$update_ticket['id']					= $ticket_id;
													$tickets->edit($update_ticket);
													
													$new_ticket = false;
													
													//attach files to ticket
													if ($account['download_files'] == 1) {
														if (!empty($saved_files)) {
															foreach ($saved_files as $file_id) {
																if ($file_id !== false) {
																	$storage->add_file_to_ticket(array('file_id' => $file_id, 'ticket_id' => $ticket['id']));
																}
															}
														}
													}
													
													unset($ticket_note);
												}
											}
										}
									}
								}
								//adds a new ticket if anything else fails
								if ($new_ticket) {
									//new ticket
									$array['subject']			= $email['subject'];
									$array['priority_id']		= $account['priority_id'];
									$array['description']		= $email['body'];
									$array['date_added']		= datetime();
									$array['department_id']		= $account['department_id'];

									$array['ticket_state_id']	= 1;
									
									if (count($clients) == 1) {
										$array['user_id']	= $clients[0]['id'];
									}
								
									$array['email']				= $email['from_address'];
									$array['name']				= $email['from_name'];
									$array['html']				= (int) $email['html'];
									$array['pop_account_id']	= (int) $account['id'];
									
									//print_r($array);
									
									$id = $tickets->add($array);
									
									//attach files to ticket
									if ($account['download_files'] == 1) {
										if (!empty($saved_files)) {
											foreach ($saved_files as $file_id) {
												if ($file_id !== false) {
													$storage->add_file_to_ticket(array('file_id' => $file_id, 'ticket_id' => $id));
												}
											}
										}
									}
									
									unset($array);
								}
								
								if (!$account['leave_messages']) {
									//delete email from pop3 server if it has been added to the database (won't delete from gmail, but will stop it being downloaded via pop3 again)
									$pop3->DeleteMessage($index);
								}
							}
						}
					}
				}
				else {
					//unable to retrieve mailbox statistics
				}
			}
			else {
				$log_array['event_severity'] = 'warning';
				$log_array['event_number'] = E_USER_WARNING;
				$log_array['event_description'] = 'Authentication to POP server "' . safe_output($pop3->hostname) . '" failed';
				$log_array['event_file'] = __FILE__;
				$log_array['event_file_line'] = __LINE__;
				$log_array['event_type'] = 'download_email';
				$log_array['event_source'] = 'pop_system';
				$log_array['event_version'] = '1';
				$log_array['log_backtrace'] = false;	
					
				$log->add($log_array);
			}
		}
		else {
			$log_array['event_severity'] = 'warning';
			$log_array['event_number'] = E_USER_WARNING;
			$log_array['event_description'] = 'Unable to connect to POP server "' . safe_output($pop3->hostname) . '", Error "' . safe_output($error) . '"';
			$log_array['event_file'] = __FILE__;
			$log_array['event_file_line'] = __LINE__;
			$log_array['event_type'] = 'download_email';
			$log_array['event_source'] = 'pop_system';
			$log_array['event_version'] = '1';
			$log_array['log_backtrace'] = false;	
				
			$log->add($log_array);
			
		}
		
		$pop3->Close();
	
	}
	
	private function add_message($array) {
		global $db;
				
		$error 		= &singleton::get(__NAMESPACE__ . '\error');
		$tables 	= &singleton::get(__NAMESPACE__ . '\tables');

		$site_id	= SITE_ID;

		$query = "INSERT INTO $tables->pop_messages (message_id, site_id";
	
		$query .= ") VALUES (:message_id, :site_id";
		
		$query .= ")";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}
		
		$stmt->bindParam(':message_id', $array['message_id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
						
		return $id;	
	}
	
	public function count_message($array = NULL) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error =	&singleton::get(__NAMESPACE__ . '\error');
		$site_id	= SITE_ID;
				
		$query = "SELECT count(*) AS `count` FROM $tables->pop_messages WHERE site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		if (isset($array['message_id'])) {
			$query .= " AND message_id = :message_id";
		}
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id);

		if (isset($array['id'])) {
			$id = $array['id'];
			$stmt->bindParam(':id', $id, database::PARAM_INT);
		}
		
		if (isset($array['message_id'])) {
			$message_id = $array['message_id'];
			$stmt->bindParam(':message_id', $message_id, database::PARAM_INT);
		}
		try {
			$stmt->execute();
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}

		$count = $stmt->fetch(database::FETCH_ASSOC);
		
		return (int) $count['count'];
	}

}

?>