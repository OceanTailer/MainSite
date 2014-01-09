<?php
/**
 * 	SMTP Accounts Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class smtp_accounts {
	
	function __construct() {

	}
	
	function get($array = NULL) {
		global $db;
		
		$error 		=	&singleton::get(__NAMESPACE__ . '\error');
		$tables 	=	&singleton::get(__NAMESPACE__ . '\tables');
		$site_id	= SITE_ID;

		$query = "SELECT sa.* ";

		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {			
			//$query .= ", td.name AS `department_name`";
		}
		
		$query .= " FROM $tables->smtp_accounts sa";
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {			
			//$query .= " LEFT JOIN $tables->ticket_departments td ON pa.department_id = td.id";
		}	
			
		$query .= " WHERE 1 = 1 AND sa.site_id = :site_id";

		if (isset($array['id'])) {
			$query .= " AND sa.id = :id";
		}
		if (isset($array['enabled'])) {
			$query .= " AND sa.enabled = :enabled";
		}
		
		$query .= " ORDER BY sa.id";
			
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
	
		$query = "INSERT INTO $tables->smtp_accounts (name, site_id";
		
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
		if (isset($array['authentication'])) {
			$query .= ", authentication";
		}
		if (isset($array['email_address'])) {
			$query .= ", email_address";
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
		if (isset($array['authentication'])) {
			$query .= ", :authentication";
		}
		if (isset($array['email_address'])) {
			$query .= ", :email_address";
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
		if (isset($array['authentication'])) {
			$stmt->bindParam(':authentication', $array['authentication'], database::PARAM_INT);
		}
		if (isset($array['email_address'])) {
			$stmt->bindParam(':email_address', $array['email_address'], database::PARAM_STR);
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
		$log_array['event_description'] = 'SMTP Account Added "<a href="' . safe_output($config->get('address')) . '/settings/email/#pop3_accounts">' . safe_output($array['name']) . '</a>"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'add';
		$log_array['event_source'] = 'stmp_accounts';
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
		
		$query = "UPDATE $tables->smtp_accounts SET name = :name";
		
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
		if (isset($array['authentication'])) {
			$query .= ", authentication = :authentication";
		}
		if (isset($array['email_address'])) {
			$query .= ", email_address = :email_address";
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
		if (isset($array['authentication'])) {
			$stmt->bindParam(':authentication', $array['authentication'], database::PARAM_INT);
		}
		if (isset($array['email_address'])) {
			$stmt->bindParam(':email_address', $array['email_address'], database::PARAM_STR);
		}
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'SMTP Account Updated "<a href="' . safe_output($config->get('address')) . '/settings/email/#pop3_accounts">' . safe_output($array['name']) . '</a>"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'edit';
		$log_array['event_source'] = 'smtp_accounts';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
		
		return true;
	}
	
	function delete($array) {
		global $db;
		
		$error 		= &singleton::get(__NAMESPACE__ . '\error');
		$tables 	= &singleton::get(__NAMESPACE__ . '\tables');
		$log		= &singleton::get(__NAMESPACE__ . '\log');

		$site_id	= SITE_ID;
		
		$query = "DELETE FROM $tables->smtp_accounts WHERE id = :id AND site_id = :site_id";
		
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
		$log_array['event_description'] = 'SMTP Account Deleted';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'delete';
		$log_array['event_source'] = 'smtp_accounts';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
		
		return true;	
	}
	
}
?>