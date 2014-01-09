<?php
/**
 * 	Notifications Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 * 	This class is used for sending email notifications when a new ticket or ticket note is added
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class notifications {
	
	function __construct() {

	}
	
	public function reset_new_ticket_notification() {
		$config 		= &singleton::get(__NAMESPACE__ . '\config');
		
		$config->set('notification_new_ticket_subject', '#SITE_NAME# - #TICKET_SUBJECT#');
		
		$config->set('notification_new_ticket_body', '
		#TICKET_DESCRIPTION#
		<br /><br />
		#TICKET_KEY#
		<br /><br />
		#GUEST_URL#');

	}

	public function reset_new_ticket_note_notification() {
		$config 		= &singleton::get(__NAMESPACE__ . '\config');
		
		$config->set('notification_new_ticket_note_subject', '#SITE_NAME# - #TICKET_SUBJECT#');
		$config->set('notification_new_ticket_note_body', '
		#TICKET_NOTE_DESCRIPTION#
		<br /><br />
		#TICKET_KEY#
		<br /><br />
		#GUEST_URL#');	

	}
	
	public function reset_new_user_notification() {
		$config 		= &singleton::get(__NAMESPACE__ . '\config');
		
		$config->set('notification_new_user_subject', '#SITE_NAME# - New Account');
		$config->set('notification_new_user_body', '
		Hi #USER_FULLNAME#,
		<br /><br />
		A user account has been created for you at #SITE_NAME#.
		<br /><br />
		URL: 		#SITE_ADDRESS#<br />
		Name:		#USER_FULLNAME#<br />
		Username:	#USER_NAME#<br />
		Password:	#USER_PASSWORD#');	

	}

	//send email to user or anonymous user when a new ticket is created
	public function new_ticket($array) {
		global $db;
		
		$users 			= &singleton::get(__NAMESPACE__ . '\users');
		$mailer 		= &singleton::get(__NAMESPACE__ . '\mailer');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');
		$pushover 		= &singleton::get(__NAMESPACE__ . '\pushover');
		
		//global pushover notice
		if ($config->get('pushover_enabled')) {
			
			$pushover_users = $config->get('pushover_notify_users');
			
			if (!empty($pushover_users)) {
				
				$send_pushover_users = $users->get(array('ids' => $pushover_users));
		
				if (!empty($send_pushover_users)) {
					foreach ($send_pushover_users as $item) {
						$pushover_array = array(
							'user' 		=> $item['pushover_key'], 
							'title'		=> $array['subject']
						);
						
						$pushover_array['message'] 		= strip_tags($array['description']);
						
						$pushover_array['url'] 			= $config->get('address') .'/tickets/view/'.$array['id'].'/';
						$pushover_array['url_title'] 	= 'View Ticket';
						
						$pushover->queue($pushover_array);
						unset($pushover_array);
					}
				}
			}
		}
					
		//email notices and user specific pushover notices
		if (isset($array['user_id']) && !empty($array['user_id'])) {
		
			$users_array = $users->get(array('id' => (int) $array['user_id']));
			
			if (count($users_array) == 1) {
				$user = $users_array[0];
							
				if ($user['email_notifications'] == 1 && !empty($user['email'])) {
				
					$template_subject = $config->get('notification_new_ticket_subject');

					$subject_temp 	= str_replace('#SITE_NAME#', $config->get('name'), $template_subject);
					$subject_temp 	= str_replace('#TICKET_SUBJECT#', safe_output($array['subject']), $subject_temp);

					$email_array['subject'] = $subject_temp;
										
					$template_body = $config->get('notification_new_ticket_body');
					
					$body_temp = str_replace('#SITE_NAME#', $config->get('name'), $template_body);
					$body_temp = str_replace('#SITE_ADDRESS#', $config->get('address'), $body_temp);
					$body_temp = str_replace('#TICKET_KEY#', '[TID:' . $array['key'] . '-' . $array['id'] . ']', $body_temp);
					$body_temp = str_replace('#TICKET_SUBJECT#', safe_output($array['subject']), $body_temp);
					$body_temp = str_replace('#TICKET_ID#', $array['id'], $body_temp);

					if (isset($array['html']) && $array['html'] == 1) {
						$body_temp = str_replace('#TICKET_DESCRIPTION#', html_output($array['description']), $body_temp);
					}
					else {
						$body_temp = str_replace('#TICKET_DESCRIPTION#', nl2br($array['description']), $body_temp);
					}
					
					if ($config->get('guest_portal')) {
						$body_temp = str_replace('#GUEST_URL#', '<a href="'. $config->get('address') .'/guest/ticket_view/'.$array['id'].'/?access_key='.safe_output($array['access_key']).'">View Ticket</a>', $body_temp);
					}
					else {
						$body_temp = str_replace('#GUEST_URL#', '', $body_temp);
					}
					
					$email_array['body']					= $body_temp;
					
					$email_array['html']					= true;
					$email_array['to']['to']				= $user['email'];
					$email_array['to']['to_name']			= $user['name'];
					
					if (isset($array['pop_account_id'])) {
						$email_array['pop_account_id']		= $array['pop_account_id']; 
					}
					
					$mailer->queue_email($email_array);
					
					if (!empty($user['pushover_key']) && $config->get('pushover_enabled') && $config->get('pushover_user_enabled')) {
						$pushover_array = array(
							'user' 		=> $user['pushover_key'], 
							'title'		=> $email_array['subject']
						);
						
						$pushover_array['message'] = strip_tags($array['description']);
						
						if ($config->get('guest_portal')) {
							$pushover_array['url'] 			= $config->get('address') .'/guest/ticket_view/'.$array['id'].'/?access_key='.safe_output($array['access_key']);
							$pushover_array['url_title'] 	= 'View Ticket';
						}
						
						$pushover->queue($pushover_array);
					}
					
					return true;
				}
			}
			else {
				return false;
			}
		}
		else if ($config->get('anonymous_tickets_reply') && !empty($array['email'])) {
			$template_subject = $config->get('notification_new_ticket_subject');

			$subject_temp 	= str_replace('#SITE_NAME#', $config->get('name'), $template_subject);
			$subject_temp 	= str_replace('#TICKET_SUBJECT#', safe_output($array['subject']), $subject_temp);

			$email_array['subject'] = $subject_temp;
								
			$template_body = $config->get('notification_new_ticket_body');
			
			$body_temp = str_replace('#SITE_NAME#', $config->get('name'), $template_body);
			$body_temp = str_replace('#SITE_ADDRESS#', $config->get('address'), $body_temp);
			$body_temp = str_replace('#TICKET_KEY#', '[TID:' . $array['key'] . '-' . $array['id'] . ']', $body_temp);
			$body_temp = str_replace('#TICKET_SUBJECT#', safe_output($array['subject']), $body_temp);
			$body_temp = str_replace('#TICKET_ID#', $array['id'], $body_temp);

			if (isset($array['html']) && $array['html'] == 1) {
				$body_temp = str_replace('#TICKET_DESCRIPTION#', html_output($array['description']), $body_temp);
			}
			else {
				$body_temp = str_replace('#TICKET_DESCRIPTION#', nl2br($array['description']), $body_temp);
			}
			
			if ($config->get('guest_portal')) {
				$body_temp = str_replace('#GUEST_URL#', '<a href="'. $config->get('address') .'/guest/ticket_view/'.$array['id'].'/?access_key='.safe_output($array['access_key']).'">View Ticket</a>', $body_temp);
			}
			else {
				$body_temp = str_replace('#GUEST_URL#', '', $body_temp);
			}
			
			$email_array['body']					= $body_temp;
			
			$email_array['html']					= 	true;
			$email_array['to']['to']				= 	$array['email'];
			$email_array['to']['to_name']			= 	$array['name'];			

			if (isset($array['pop_account_id'])) {
				$email_array['pop_account_id']		= $array['pop_account_id']; 
			}	
			
			$mailer->queue_email($email_array);
			
			return true;
		}
		else {
			return false;
		}
		
	}
	
	public function new_ticket_note($array) {
		global $db;
		
		$users 			= &singleton::get(__NAMESPACE__ . '\users');
		$mailer 		= &singleton::get(__NAMESPACE__ . '\mailer');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');
		$tickets 		= &singleton::get(__NAMESPACE__ . '\tickets');
		$pushover 		= &singleton::get(__NAMESPACE__ . '\pushover');

		if (!isset($array['ticket_id'])) {
			return false;
		}
		
		$tickets_array = $tickets->get(array('id' => (int) $array['ticket_id'], 'get_other_data' => true));

		if (count($tickets_array) == 1) {
			$ticket		= $tickets_array[0];
			
			//global pushover notice
			if ($config->get('pushover_enabled')) {
				
				$pushover_users = $config->get('pushover_notify_users');
				
				if (!empty($pushover_users)) {
					
					$send_pushover_users = $users->get(array('ids' => $pushover_users));
			
					if (!empty($send_pushover_users)) {
						foreach ($send_pushover_users as $item) {
							$pushover_array = array(
								'user' 		=> $item['pushover_key'], 
								'title'		=> $ticket['subject']
							);
							
							$pushover_array['message'] 		= strip_tags($array['description']);
							
							$pushover_array['url'] 			= $config->get('address') .'/tickets/view/'.$ticket['id'].'/';
							$pushover_array['url_title'] 	= 'View Ticket';
							
							$pushover->queue($pushover_array);
							unset($pushover_array);
						}
					}
				}
			}
			
			
			$template_subject = $config->get('notification_new_ticket_note_subject');

			$subject_temp 	= str_replace('#SITE_NAME#', $config->get('name'), $template_subject);
			$subject_temp 	= str_replace('#TICKET_SUBJECT#', safe_output($ticket['subject']), $subject_temp);

			$email_array['subject'] = $subject_temp;
								
			$template_body = $config->get('notification_new_ticket_note_body');
			
			$body_temp = str_replace('#SITE_NAME#', $config->get('name'), $template_body);
			$body_temp = str_replace('#SITE_ADDRESS#', $config->get('address'), $body_temp);
			$body_temp = str_replace('#TICKET_KEY#', '[TID:' . $ticket['key'] . '-' . $ticket['id'] . ']', $body_temp);
			$body_temp = str_replace('#TICKET_SUBJECT#', safe_output($ticket['subject']), $body_temp);
			$body_temp = str_replace('#TICKET_ID#', $ticket['id'], $body_temp);

			if (isset($array['html']) && $array['html'] == 1) {
				$body_temp = str_replace('#TICKET_NOTE_DESCRIPTION#', html_output($array['description']), $body_temp);
			}
			else {
				$body_temp = str_replace('#TICKET_NOTE_DESCRIPTION#', nl2br($array['description']), $body_temp);
			}
			
			if ($config->get('guest_portal') && !empty($ticket['access_key'])) {
				$body_temp = str_replace('#GUEST_URL#', '<a href="'. $config->get('address') .'/guest/ticket_view/'.$ticket['id'].'/?access_key='.safe_output($ticket['access_key']).'">View Ticket</a>', $body_temp);
			}
			else {
				$body_temp = str_replace('#GUEST_URL#', '', $body_temp);
			}
			
			$email_array['body']					= $body_temp;
			
			$email_array['html']				= 	true;

			if (isset($ticket['pop_account_id'])) {
				$email_array['pop_account_id']		= $ticket['pop_account_id']; 
			}
			
			//send email to ticket owner
			if (!empty($ticket['owner_email']) && ($ticket['owner_email_notifications'] == 1)) {
				$email_array['to']['to']			= 	$ticket['owner_email'];
				$email_array['to']['to_name']		= 	$ticket['owner_name'];		
						
				$mailer->queue_email($email_array);
				
				if (!empty($ticket['owner_pushover_key']) && $config->get('pushover_enabled') && $config->get('pushover_user_enabled')) {
					$pushover_array = array(
						'user' 		=> $ticket['owner_pushover_key'], 
						'title'		=> $email_array['subject']
					);
					
					$pushover_array['message'] = strip_tags($array['description']);
					
					if ($config->get('guest_portal')) {
						$pushover_array['url'] 			= $config->get('address') .'/guest/ticket_view/'.$ticket['id'].'/?access_key='.safe_output($ticket['access_key']);
						$pushover_array['url_title'] 	= 'View Ticket';
					}
					
					$pushover->queue($pushover_array);
				}
			}
			
			//send email to ticket owner if not a user
			else if ($config->get('anonymous_tickets_reply') && !empty($ticket['email'])) {
				$email_array['to']['to']			= 	$ticket['email'];
				$email_array['to']['to_name']		= 	$ticket['name'];		
						
				$mailer->queue_email($email_array);			
			}

			//send email to ticket assigned user
			if (!empty($ticket['assigned_email']) && ($ticket['assigned_email_notifications'] == 1)) {
				$email_array['to']['to']			= 	$ticket['assigned_email'];
				$email_array['to']['to_name']		= 	$ticket['assigned_name'];		
						
				$mailer->queue_email($email_array);
				
				if (!empty($ticket['assigned_pushover_key']) && $config->get('pushover_enabled') && $config->get('pushover_user_enabled')) {
					$pushover_array = array(
						'user' 		=> $ticket['assigned_pushover_key'], 
						'title'		=> $email_array['subject']
					);
					
					$pushover_array['message'] = strip_tags($array['description']);
					
					$pushover_array['url'] 			= $config->get('address') .'/tickets/view/'.$ticket['id'].'/';
					$pushover_array['url_title'] 	= 'View Ticket';
					
					$pushover->queue($pushover_array);
				}
			}
		}
		else {
			return false;
		}
	}
	
	public function password_reset($array) {
		global $db;
		
		$mailer 		= &singleton::get(__NAMESPACE__ . '\mailer');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');
		
				
		if (is_array($array['user'])) {
			$user = $array['user'];
						
			if (!empty($user['email'])) {
				
				$email_array['subject']				= $config->get('name') . ' - Password Reset';
				$email_array['body']				= 'A password reset request has been created for your account at ' . $config->get('name');
				$email_array['body']				.= "<br /><br />To approve this reset please click on this link:";
				$email_array['body']				.= '<br /><a href="'. $config->get('address') . '/reset/?key=' . urlencode($array['reset_key']) . '&amp;username=' . urlencode($user['username']) . '">' . $config->get('address') . '/reset/?key=' . urlencode($array['reset_key']) . '&amp;username=' . urlencode($user['username']) . '</a>';

				$email_array['to']['to']			= $user['email'];
				$email_array['to']['to_name']		= $user['name'];
				$email_array['html']				= true;
				
				$mailer->send_email($email_array);
			}
		}
		else {
			return false;
		}
	
	}
	
	public function new_user($array) {
		$mailer 		= &singleton::get(__NAMESPACE__ . '\mailer');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		if (is_array($array)) {
				
			$template_subject = $config->get('notification_new_user_subject');

			$subject_temp 	= str_replace('#SITE_NAME#', $config->get('name'), $template_subject);
			
			$subject_temp = str_replace('#USER_FULLNAME#', $array['name'], $subject_temp);
			$subject_temp = str_replace('#USER_NAME#', $array['username'], $subject_temp);
			$subject_temp = str_replace('#USER_PASSWORD#', $array['password'], $subject_temp);
			$subject_temp = str_replace('#USER_EMAIL#', $array['email'], $subject_temp);
			$subject_temp = str_replace('#SITE_ADDRESS#', $config->get('address'), $subject_temp);

			$email_array['subject'] = $subject_temp;
								
			$template_body = $config->get('notification_new_user_body');

			$body_temp = str_replace('#USER_FULLNAME#', $array['name'], $template_body);
			
			$body_temp = str_replace('#USER_NAME#', $array['username'], $body_temp);
			$body_temp = str_replace('#USER_PASSWORD#', $array['password'], $body_temp);
			$body_temp = str_replace('#USER_EMAIL#', $array['email'], $body_temp);
			$body_temp = str_replace('#SITE_NAME#', $config->get('name'), $body_temp);
			$body_temp = str_replace('#SITE_ADDRESS#', $config->get('address'), $body_temp);
				
			$email_array['body']					= $body_temp;
			
			$email_array['html']					= true;
			$email_array['to']['to']				= $array['email'];
			$email_array['to']['to_name']			= $array['name'];			

			if (isset($array['pop_account_id'])) {
				$email_array['pop_account_id']		= $array['pop_account_id']; 
			}	
			
			$mailer->queue_email($email_array);
			
			return true;

		}
		else {
			return false;
		}	
	}
	
	public function new_message($array) {
	
	}
	
	public function new_message_note($array) {
	
	}
}

?>