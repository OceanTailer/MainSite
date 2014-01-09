<?php
/**
 * 	Mailer Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */
namespace sts;

class mailer {
	private $phpmailer;
	
	function __construct() {		
		//$this->phpmailer 	= &singleton::get(__NAMESPACE__ . '\phpmailer', true);
		
		$this->phpmailer 	= new \PHPMailer(true);

	}

	//this kicks off the email processing
	public function run_queue() {

		$queue =	&singleton::get(__NAMESPACE__ . '\queue');
		
		$queue->run('email');

	}
	
	//this function processes the email stored in the queue
	function process_email_queue(&$queue) {

		$log =	&singleton::get(__NAMESPACE__ . '\log');
		
		//get the queue data
		$qarray = $queue['data'];
		
		if (isset($qarray['from_name'])) {
			$array['from_name']		= $qarray['from_name'];
		}
		if (isset($qarray['from'])) {
			$array['from']			= $qarray['from'];
		}
		if (isset($qarray['html'])) {
			$array['html']			= $qarray['html'];
		}
		if (isset($qarray['file'])) {
			$array['file']			= $qarray['file'];
		}
		if (isset($qarray['string_file'])) {
			$array['string_file']	= $qarray['string_file'];
		}
		if (isset($qarray['pop_account_id'])) {
			$array['pop_account_id']	= $qarray['pop_account_id'];
		}
		
		$array['subject']		= $qarray['subject'];
		$array['body']			= $qarray['body'];
		$array['to']['to']		= $qarray['to']['to'];
		$array['to']['to_name']	= $qarray['to']['to_name'];
		
		//print_r($array);
		
		//let's try and send the email now
		if($this->send_email($array)) {
			//this means the email will be deleted from the queue (success)
			$queue['processed'] = true;
		}
		else {
			if ($queue['retry'] >= 5) {
				//this means the email will be deleted from the queue (full fail)
				$queue['processed'] = true;
				
				$larray['event_severity'] = 'error';
				$larray['event_number'] = E_USER_ERROR;
				$larray['event_description'] = 'Unable to send email, removing from queue after 5 retries';
				$larray['event_file'] = __FILE__;
				$larray['event_file_line'] = __LINE__;
				$larray['event_type'] = 'email_not_sent';
				$larray['event_source'] = 'mailer';
				$larray['event_version'] = '1';
				$larray['log_backtrace'] = true;	
				
				$log->add($larray);
				
			} else {
				$queue['retry']++;
			}
		}
	}
	
	//add an email to the email queue
	public function queue_email($email_array) {
		$queue =	&singleton::get(__NAMESPACE__ . '\queue');
		
		$queue->add(array('data' => $email_array, 'type' => 'email'));

		return true;
	}
	
	public function send_email($array) {
	
		$config 		=	&singleton::get(__NAMESPACE__ . '\config');
		$log 			=	&singleton::get(__NAMESPACE__ . '\log');
		$pop_accounts 	=	&singleton::get(__NAMESPACE__ . '\pop_accounts');
		$smtp_accounts 	=	&singleton::get(__NAMESPACE__ . '\smtp_accounts');
		
		try {

			//clear any current info
			$this->phpmailer->ClearAllRecipients();
			$this->phpmailer->ClearAttachments();
			
			$this->phpmailer->From = 'do_not_reply@' . $config->get('domain');
			
			$found_smtp_account = false;
			
			if (isset($array['pop_account_id']) && !empty($array['pop_account_id'])) {
				$pop_array = $pop_accounts->get(array('id' => $array['pop_account_id'], 'get_other_data' => true));
				
				if (!empty($pop_array) && !empty($pop_array[0]['smtp_hostname']) && $pop_array[0]['smtp_enabled'] == 1) {
					
					$smtp['hostname'] 			= $pop_array[0]['smtp_hostname'];
					$smtp['port'] 				= $pop_array[0]['smtp_port'];
					$smtp['tls'] 				= $pop_array[0]['smtp_tls'];
					$smtp['username'] 			= $pop_array[0]['smtp_username'];
					$smtp['password'] 			= decode($pop_array[0]['smtp_password']);
					$smtp['authentication'] 	= $pop_array[0]['smtp_authentication'];
					$smtp['email_address'] 		= $pop_array[0]['smtp_email_address'];					
					
					$found_smtp_account = true;
				}
			}
			else if (isset($array['smtp_account_id']) && !empty($array['smtp_account_id'])) {
				$smtp_array = $smtp_accounts->get(array('id' => $array['smtp_account_id']));
				
				if (!empty($smtp_array) && !empty($smtp_array[0]['hostname']) && $smtp_array[0]['enabled'] == 1) {
				
					$smtp['hostname'] 			= $smtp_array[0]['hostname'];
					$smtp['port'] 				= $smtp_array[0]['port'];
					$smtp['tls'] 				= $smtp_array[0]['tls'];
					$smtp['username'] 			= $smtp_array[0]['username'];
					$smtp['password'] 			= decode($smtp_array[0]['password']);
					$smtp['authentication'] 	= $smtp_array[0]['authentication'];
					$smtp['email_address'] 		= $smtp_array[0]['email_address'];		
				
					$found_smtp_account = true;
				}			
			}
			
			if (!$found_smtp_account) {
				$smtp_array = $smtp_accounts->get(array('id' => $config->get('default_smtp_account')));
								
				if (!empty($smtp_array) && !empty($smtp_array[0]['hostname']) && $smtp_array[0]['enabled'] == 1) {
				
					$smtp['hostname'] 			= $smtp_array[0]['hostname'];
					$smtp['port'] 				= $smtp_array[0]['port'];
					$smtp['tls'] 				= $smtp_array[0]['tls'];
					$smtp['username'] 			= $smtp_array[0]['username'];
					$smtp['password'] 			= decode($smtp_array[0]['password']);
					$smtp['authentication'] 	= $smtp_array[0]['authentication'];
					$smtp['email_address'] 		= $smtp_array[0]['email_address'];		
				
					$found_smtp_account = true;
				}		
			}
			
			if ($found_smtp_account) {
							
				//what server to send the email to
				$this->phpmailer->Host 		= $smtp['hostname'];
				$this->phpmailer->Mailer 	= 'smtp';
								
				//setup authentication if required
				if ($smtp['authentication']) {
					$this->phpmailer->SMTPAuth = true;     // turn on SMTP authentication
					$this->phpmailer->Username = $smtp['username'];
					$this->phpmailer->Password = $smtp['password'];
				}
				
				if ($smtp['tls'] ) {
					$this->phpmailer->SMTPSecure = 'tls';
				}
				
				$this->phpmailer->Port = (int) $smtp['port'];
				
				//setup the basic email stuff
				if (isset($array['from'])) {
					$this->phpmailer->From = $array['from'];
				}
				else {
					if (!empty($smtp['email_address'])) {
						$this->phpmailer->From = $smtp['email_address'];
					}
				}
			}
			else {
				$this->phpmailer->Mailer 	= 'mail';
				if (isset($array['from'])) {
					$this->phpmailer->From = $array['from'];
				}				
			}
			
			//increase the default timeout to 15 seconds
			$this->phpmailer->Timeout = 15;
			
			$this->phpmailer->CharSet = 'utf-8';
			
			if (isset($array['html']) && ($array['html'] == true)) {
				$this->phpmailer->IsHTML(true);
			}
				
			if (isset($array['from_name'])) {
				$this->phpmailer->FromName = $array['from_name'];
			}
			else {
				$this->phpmailer->FromName = $config->get('name');
			}
			
			$this->phpmailer->Subject 	= $array['subject'];
			$this->phpmailer->Body 		= $array['body'];
			
			if (isset($array['to']) && is_array($array['to'])) {
				if (!empty($array['to']['to'])) {
					$this->phpmailer->AddAddress($array['to']['to'], $array['to']['to_name']);
				}
			}
			
			//add multiple files
			if (isset($array['file']) && is_array($array['file'])) {
				foreach ($array['file'] as $file) {
					if (file_exists($file['file'])) {
						$this->phpmailer->AddAttachment($file['file'], $file['file_name']);
					}
				}
			}
			
			//add multiple files via a string (I haven't really tested this yet)
			if (isset($array['string_file']) && is_array($array['string_file'])) {
				foreach ($array['string_file'] as $string) {
					$this->phpmailer->AddStringAttachment($string['string'], $string['string_name']);
				}
			}

			//let's try and send the email now
			$this->phpmailer->Send();
			
			$array['event_severity'] = 'notice';
			$array['event_number'] = E_USER_NOTICE;
			
			if (isset($array['to']) && is_array($array['to'])) {
				$array['event_description'] = 'Email sent to "' . safe_output($array['to']['to']) . '" from "' . $this->phpmailer->From . '"';				
			}
			else {
				$array['event_description'] = 'Email sent from "' . $this->phpmailer->From . '"';
			}
			
			$array['event_file'] = __FILE__;
			$array['event_file_line'] = __LINE__;
			$array['event_type'] = 'email_sent';
			$array['event_source'] = 'mailer';
			$array['event_version'] = '1';
			$array['log_backtrace'] = false;	
			
			$log->add($array);
			
			return true;
		}
		catch (\phpmailerException $e) {
			$array['event_severity'] = 'warning';
			$array['event_number'] = E_USER_WARNING;
			$array['event_description'] = $e->errorMessage();
			$array['event_file'] = __FILE__;
			$array['event_file_line'] = __LINE__;
			$array['event_type'] = 'email_not_sent';
			$array['event_source'] = 'mailer';
			$array['event_version'] = '1';
			$array['log_backtrace'] = true;	
			
			$log->add($array);
			
			return false;
		} catch (\Exception $e) {
			$array['event_severity'] = 'warning';
			$array['event_number'] = E_USER_WARNING;
			$array['event_description'] = $e->getMessage();
			$array['event_file'] = __FILE__;
			$array['event_file_line'] = __LINE__;
			$array['event_type'] = 'email_not_sent';
			$array['event_source'] = 'mailer';
			$array['event_version'] = '1';
			$array['log_backtrace'] = true;	
			
			$log->add($array);
			
			return false;
		}
	}
} 

?>