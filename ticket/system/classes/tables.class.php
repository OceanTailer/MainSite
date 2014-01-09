<?php
/**
 * 	Tables Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class tables {

	var $table_prefix;
	
	//original tables
	var $sessions;
	var $users;
	var $config;
	var $events;
	var $tickets;
	var $ticket_notes;
	var $ticket_priorities;
	var $queue;
	var $storage;
	var $files_to_tickets;
	var $ticket_departments;
	var $pop_messages;
	var $pop_accounts;
	var $messages;
	var $message_notes;
	var $message_unread;
	var $ticket_field_group;
	var $ticket_fields;
	var $ticket_field_values;
	var $ticket_status;
	var $smtp_accounts;
	var $users_to_departments;
	
	var $tables = array();

	function __construct($table_prefix) {

		$this->table_prefix = strtolower($table_prefix);
		
		$this->sessions 				= $this->table_prefix . 'sessions';
		$this->users 					= $this->table_prefix . 'users';
		$this->config 					= $this->table_prefix . 'config';
		$this->events 					= $this->table_prefix . 'events';
		$this->tickets 					= $this->table_prefix . 'tickets';
		$this->ticket_notes 			= $this->table_prefix . 'ticket_notes';
		$this->ticket_priorities 		= $this->table_prefix . 'ticket_priorities';
		$this->queue 					= $this->table_prefix . 'queue';
		$this->storage 					= $this->table_prefix . 'storage';
		$this->files_to_tickets 		= $this->table_prefix . 'files_to_tickets';
		$this->ticket_departments 		= $this->table_prefix . 'ticket_departments';
		$this->pop_messages 			= $this->table_prefix . 'pop_messages';
		$this->pop_accounts 			= $this->table_prefix . 'pop_accounts';
		$this->messages 				= $this->table_prefix . 'messages';
		$this->message_notes 			= $this->table_prefix . 'message_notes';
		$this->message_unread 			= $this->table_prefix . 'message_unread';	
		$this->ticket_field_group 		= $this->table_prefix . 'ticket_field_group';
		$this->ticket_fields 			= $this->table_prefix . 'ticket_fields';
		$this->ticket_field_values 		= $this->table_prefix . 'ticket_field_values';
		$this->ticket_status	 		= $this->table_prefix . 'ticket_status';
		$this->smtp_accounts	 		= $this->table_prefix . 'smtp_accounts';
		$this->users_to_departments	 	= $this->table_prefix . 'users_to_departments';

		
		$this->tables = array(
			'sessions' 					=> $this->table_prefix . 'sessions',
			'users'						=> $this->table_prefix . 'users',
			'config'					=> $this->table_prefix . 'config',
			'events'					=> $this->table_prefix . 'events',
			'tickets'					=> $this->table_prefix . 'tickets',
			'ticket_notes'				=> $this->table_prefix . 'ticket_notes',
			'ticket_priorities'			=> $this->table_prefix . 'ticket_priorities',
			'queue'						=> $this->table_prefix . 'queue',
			'storage'					=> $this->table_prefix . 'storage',
			'files_to_tickets'			=> $this->table_prefix . 'files_to_tickets',
			'ticket_departments'		=> $this->table_prefix . 'ticket_departments',
			'pop_messages'				=> $this->table_prefix . 'pop_messages',
			'pop_accounts'				=> $this->table_prefix . 'pop_accounts',
			'messages'					=> $this->table_prefix . 'messages',
			'message_notes'				=> $this->table_prefix . 'message_notes',
			'message_unread'			=> $this->table_prefix . 'message_unread',
			'ticket_field_group'		=> $this->table_prefix . 'ticket_field_group',
			'ticket_fields'				=> $this->table_prefix . 'ticket_fields',
			'ticket_field_values'		=> $this->table_prefix . 'ticket_field_values',
			'ticket_status'				=> $this->table_prefix . 'ticket_status',
			'smtp_accounts'				=> $this->table_prefix . 'smtp_accounts',
			'users_to_departments'		=> $this->table_prefix . 'users_to_departments',
		);
	
	}
	
	function add_table($table_name) {

		//notice the extra $ ($this->_$_table_name) 
		$this->$table_name = $this->table_prefix . $table_name;
		$this->tables += array($table_name => $this->table_prefix . $table_name);
		
	}
	
	public function get() {
		return $this->tables;
	}

}

?>