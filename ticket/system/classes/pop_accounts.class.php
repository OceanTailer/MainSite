<?php
/**
 * 	Pop Accounts Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class pop_accounts {
	
	function __construct() {

	}
	
	function get($array = NULL) {
		global $db;
		
		$error 		=	&singleton::get(__NAMESPACE__ . '\error');
		$tables 	=	&singleton::get(__NAMESPACE__ . '\tables');
		$site_id	= SITE_ID;

		$query = "SELECT pa.* ";

		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {			
			$query .= ", td.name AS `department_name`";
			$query .= ", sa.hostname AS `smtp_hostname`, sa.port AS `smtp_port`, sa.tls AS `smtp_tls`";
			$query .= ", sa.enabled AS `smtp_enabled`, sa.authentication AS `smtp_authentication`, sa.username as `smtp_username`";
			$query .= ", sa.password AS `smtp_password`, sa.email_address AS `smtp_email_address`";	
		}
		
		$query .= " FROM $tables->pop_accounts pa";
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {			
			$query .= " LEFT JOIN $tables->ticket_departments td ON pa.department_id = td.id";
			$query .= " LEFT JOIN $tables->smtp_accounts sa ON sa.id = pa.smtp_account_id";
		}	
			
		$query .= " WHERE 1 = 1 AND pa.site_id = :site_id";

		if (isset($array['id'])) {
			$query .= " AND pa.id = :id";
		}
		if (isset($array['enabled'])) {
			$query .= " AND pa.enabled = :enabled";
		}
		
		$query .= " ORDER BY pa.id";
			
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
		if (isset($array['enabled'])) {
			$stmt->bindParam(':enabled', $array['enabled'], database::PARAM_INT);
		}	
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$accounts = $stmt->fetchAll(database::FETCH_ASSOC);
		
		return $accounts;
		
	}

	function add($array) {
		global $db;
		
		$error 		= &singleton::get(__NAMESPACE__ . '\error');
		$tables 	= &singleton::get(__NAMESPACE__ . '\tables');
		$log		= &singleton::get(__NAMESPACE__ . '\log');
		$config		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id	= SITE_ID;
	
		$query = "INSERT INTO $tables->pop_accounts (name, site_id";
		
		if (isset($array['enabled'])) {
			$query .= ", enabled";
		}
		if (isset($array['hostname'])) {
			$query .= ", hostname";
		}
		if (isset($array['port'])) {
			$query .= ", port";
		}
		if (isset($array['tls'])) {
			$query .= ", tls";
		}
		if (isset($array['username'])) {
			$query .= ", username";
		}
		if (isset($array['password'])) {
			$query .= ", password";
		}
		if (isset($array['download_files'])) {
			$query .= ", download_files";
		}
		if (isset($array['department_id'])) {
			$query .= ", department_id";
		}
		if (isset($array['leave_messages'])) {
			$query .= ", leave_messages";
		}
		if (isset($array['priority_id'])) {
			$query .= ", priority_id";
		}		
		if (isset($array['smtp_account_id'])) {
			$query .= ", smtp_account_id";
		}	
		$query .= ") VALUES (:name, :site_id";
		
		if (isset($array['enabled'])) {
			$query .= ", :enabled";
		}
		if (isset($array['hostname'])) {
			$query .= ", :hostname";
		}
		if (isset($array['port'])) {
			$query .= ", :port";
		}
		if (isset($array['tls'])) {
			$query .= ", :tls";
		}
		if (isset($array['username'])) {
			$query .= ", :username";
		}
		if (isset($array['password'])) {
			$query .= ", :password";
		}
		if (isset($array['download_files'])) {
			$query .= ", :download_files";
		}
		if (isset($array['department_id'])) {
			$query .= ", :department_id";
		}		
		if (isset($array['leave_messages'])) {
			$query .= ", :leave_messages";
		}
		if (isset($array['priority_id'])) {
			$query .= ", :priority_id";
		}
		if (isset($array['smtp_account_id'])) {
			$query .= ", :smtp_account_id";
		}	
		$query .= ")";
	
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
	
		$stmt->bindParam(':name', $array['name'], database::PARAM_STR);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		
		if (isset($array['enabled'])) {
			$stmt->bindParam(':enabled', $array['enabled'], database::PARAM_INT);
		}
		if (isset($array['hostname'])) {
			$stmt->bindParam(':hostname', $array['hostname'], database::PARAM_STR);
		}
		if (isset($array['port'])) {
			$stmt->bindParam(':port', $array['port'], database::PARAM_INT);
		}
		if (isset($array['tls'])) {
			$stmt->bindParam(':tls', $array['tls'], database::PARAM_INT);
		}		
		if (isset($array['username'])) {
			$stmt->bindParam(':username', $array['username'], database::PARAM_STR);
		}	
		if (isset($array['password'])) {
			$password = encode($array['password']);
			$stmt->bindParam(':password', $password, database::PARAM_STR);
		}		
		if (isset($array['download_files'])) {
			$stmt->bindParam(':download_files', $array['download_files'], database::PARAM_INT);
		}
		if (isset($array['department_id'])) {
			$stmt->bindParam(':department_id', $array['department_id'], database::PARAM_INT);
		}	
		if (isset($array['leave_messages'])) {
			$stmt->bindParam(':leave_messages', $array['leave_messages'], database::PARAM_INT);
		}
		if (isset($array['priority_id'])) {
			$stmt->bindParam(':priority_id', $array['priority_id'], database::PARAM_INT);
		}	
		if (isset($array['smtp_account_id'])) {
			$stmt->bindParam(':smtp_account_id', $array['smtp_account_id'], database::PARAM_INT);
		}			
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'POP Account Added "<a href="' . safe_output($config->get('address')) . '/settings/email/#pop3_accounts">' . safe_output($array['name']) . '</a>"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'add';
		$log_array['event_source'] = 'pop_accounts';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
			
		$log->add($log_array);
	
		return $id;
	}
	
	function edit($array) {
		global $db;
		
		$error 		= &singleton::get(__NAMESPACE__ . '\error');
		$tables 	= &singleton::get(__NAMESPACE__ . '\tables');
		$log		= &singleton::get(__NAMESPACE__ . '\log');
		$config		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id	= SITE_ID;
		
		$query = "UPDATE $tables->pop_accounts SET name = :name";
		
		if (isset($array['enabled'])) {
			$query .= ", enabled = :enabled";
		}
		if (isset($array['hostname'])) {
			$query .= ", hostname = :hostname";
		}
		if (isset($array['port'])) {
			$query .= ", port = :port";
		}
		if (isset($array['tls'])) {
			$query .= ", tls = :tls";
		}
		if (isset($array['username'])) {
			$query .= ", username = :username";
		}
		if (isset($array['password'])) {
			$query .= ", password = :password";
		}
		if (isset($array['download_files'])) {
			$query .= ", download_files = :download_files";
		}
		if (isset($array['department_id'])) {
			$query .= ", department_id = :department_id";
		}
		if (isset($array['leave_messages'])) {
			$query .= ", leave_messages = :leave_messages";
		}
		if (isset($array['priority_id'])) {
			$query .= ", priority_id = :priority_id";
		}
		if (isset($array['smtp_account_id'])) {
			$query .= ", smtp_account_id = :smtp_account_id";
		}
		
		$query .= " WHERE id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':name', $array['name'], database::PARAM_STR);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		
				
		if (isset($array['enabled'])) {
			$stmt->bindParam(':enabled', $array['enabled'], database::PARAM_INT);
		}
		if (isset($array['hostname'])) {
			$stmt->bindParam(':hostname', $array['hostname'], database::PARAM_STR);
		}			
		if (isset($array['port'])) {
			$stmt->bindParam(':port', $array['port'], database::PARAM_INT);
		}		
		if (isset($array['tls'])) {
			$stmt->bindParam(':tls', $array['tls'], database::PARAM_INT);
		}	
		if (isset($array['username'])) {
			$stmt->bindParam(':username', $array['username'], database::PARAM_STR);
		}	
		if (isset($array['password'])) {
			$password = encode($array['password']);
			$stmt->bindParam(':password', $password, database::PARAM_STR);
		}	
		if (isset($array['download_files'])) {
			$stmt->bindParam(':download_files', $array['download_files'], database::PARAM_INT);
		}
		if (isset($array['department_id'])) {
			$stmt->bindParam(':department_id', $array['department_id'], database::PARAM_INT);
		}
		if (isset($array['leave_messages'])) {
			$stmt->bindParam(':leave_messages', $array['leave_messages'], database::PARAM_INT);
		}
		if (isset($array['priority_id'])) {
			$stmt->bindParam(':priority_id', $array['priority_id'], database::PARAM_INT);
		}
		if (isset($array['smtp_account_id'])) {
			$stmt->bindParam(':smtp_account_id', $array['smtp_account_id'], database::PARAM_INT);
		}		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'POP Account Updated "<a href="' . safe_output($config->get('address')) . '/settings/email/#pop3_accounts">' . safe_output($array['name']) . '</a>"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'edit';
		$log_array['event_source'] = 'pop_accounts';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
		
		return true;
	}
	
	function delete($array) {
		global $db;
		
		if (!isset($array['id'])) return false;
		
		$error 		= &singleton::get(__NAMESPACE__ . '\error');
		$tables 	= &singleton::get(__NAMESPACE__ . '\tables');
		$log		= &singleton::get(__NAMESPACE__ . '\log');

		$site_id	= SITE_ID;
		
		$query = "UPDATE $tables->tickets SET pop_account_id = 0 WHERE pop_account_id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$id 	= $array['id'];
		
		$stmt->bindParam(':id', $id, database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$query = "DELETE FROM $tables->pop_accounts WHERE id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		$id 	= $array['id'];
		
		$stmt->bindParam(':id', $id, database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
				
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'POP Account Deleted';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'delete';
		$log_array['event_source'] = 'pop_accounts';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
		
		return true;	
	}
	
}
?>