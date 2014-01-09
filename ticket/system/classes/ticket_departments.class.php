<?php
/**
 * 	Ticket Departments Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class ticket_departments {

	function __construct() {

	}
	
	public function add($array) {
		global $db;
				
		$error 		= &singleton::get(__NAMESPACE__ . '\error');
		$log		= &singleton::get(__NAMESPACE__ . '\log');
		$tables 	= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 		= &singleton::get(__NAMESPACE__ . '\auth');
		$config 	= &singleton::get(__NAMESPACE__ . '\config');

		$site_id	= SITE_ID;

		$query = "INSERT INTO $tables->ticket_departments (name, enabled, site_id";
		
		//used for import
		if (isset($array['id'])) {
			$query .= ", id";
		}
		
		if (isset($array['public_view'])) {
			$query .= ", public_view";
		}

		$query .= ") VALUES (:name, :enabled, :site_id";
		
		//used for import
		if (isset($array['id'])) {
			$query .= ", :id";
		}
		
		if (isset($array['public_view'])) {
			$query .= ", :public_view";
		}
		
		$query .= ")";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		
		$name = $array['name'];
		$stmt->bindParam(':name', $name, database::PARAM_STR);
		
		$enabled = $array['enabled'];
		$stmt->bindParam(':enabled', $enabled, database::PARAM_INT);		
			
		//used for import
		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);		
		}
		
		if (isset($array['public_view'])) {
			$public_view = $array['public_view'];
			$stmt->bindParam(':public_view', $public_view, database::PARAM_INT);		
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
		$log_array['event_description'] = 'Ticket Department Added "' . safe_output($array['name']) . '"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'add';
		$log_array['event_source'] = 'ticket_departments';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
				
		return $id;
		
	}
	
	public function count($array = NULL) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error =	&singleton::get(__NAMESPACE__ . '\error');
		$site_id	= SITE_ID;
				
		$query = "SELECT count(*) AS `count` FROM $tables->ticket_departments WHERE site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		if (isset($array['enabled'])) {
			$query .= " AND enabled = :enabled";
		}
		if (isset($array['public_view'])) {
			$query .= " AND public_view = :public_view";
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
		
		if (isset($array['enabled'])) {
			$enabled = $array['enabled'];
			$stmt->bindParam(':enabled', $enabled, database::PARAM_INT);
		}

		if (isset($array['public_view'])) {
			$public_view = $array['public_view'];
			$stmt->bindParam(':public_view', $public_view, database::PARAM_INT);
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
	
	public function edit($array) {
		global $db;
		
		$tables 	= &singleton::get(__NAMESPACE__ . '\tables');
		$auth		= &singleton::get(__NAMESPACE__ . '\auth');
		$log		= &singleton::get(__NAMESPACE__ . '\log');
		$config		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id	= SITE_ID;
		$salt 		= $auth->generate_user_salt();

		
		$query = "UPDATE $tables->ticket_departments SET name = :name";

		if (isset($array['enabled'])) {
			$query .= ", enabled = :enabled";
		}
		if (isset($array['public_view'])) {
			$query .= ", public_view = :public_view";
		}
		
		$query .= " WHERE id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':name', $array['name'], database::PARAM_STR);
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		if (isset($array['enabled'])) {
			$stmt->bindParam(':enabled', $array['enabled'], database::PARAM_INT);
		}	
		if (isset($array['public_view'])) {
			$stmt->bindParam(':public_view', $array['public_view'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Ticket Department Edited "' . safe_output($array['name']) . '"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'edit';
		$log_array['event_source'] = 'ticket_departments';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
				
		
		return true;
	
	}
	public function get($array = NULL) {
		global $db;
		
		$error 		=	&singleton::get(__NAMESPACE__ . '\error');
		$tables 	=	&singleton::get(__NAMESPACE__ . '\tables');
		$site_id	= SITE_ID;

		$query = "SELECT td.*";
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {
			$query .= ", count(utd.id) AS `members_count`";
		}
		if (isset($array['user_id'])) {
			$query .= ", count(utd2.id) AS `is_user_member`";
		}
		if (isset($array['user_id_is_member'])) {
			$query .= ", count(utd3.id) AS `user_id_is_member`";
		}
		
		$query .= " FROM $tables->ticket_departments td";
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {
			$query .= " LEFT JOIN $tables->users_to_departments utd ON utd.department_id = td.id";
		}			
		if (isset($array['user_id'])) {
			$query .= " LEFT JOIN $tables->users_to_departments utd2 ON utd2.department_id = td.id AND utd2.user_id = :user_id";
		}		
		if (isset($array['user_id_is_member'])) {
			$query .= " LEFT JOIN $tables->users_to_departments utd3 ON utd3.department_id = td.id AND utd3.user_id = :user_id_is_member";
		}
		
		$query .= " WHERE 1 = 1 AND td.site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND td.id = :id";
		}
		if (isset($array['enabled'])) {
			$query .= " AND td.enabled = :enabled";
		}
		if (isset($array['public_view'])) {
			$query .= " AND td.public_view = :public_view";
		}
		if (isset($array['user_id_is_member'])) {
			$query .= " AND utd3.user_id = :user_id_is_member";
		}
		
		$query .= " GROUP BY td.id ORDER BY td.id";
		
		//echo $query;
		
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
		if (isset($array['public_view'])) {
			$stmt->bindParam(':public_view', $array['public_view'], database::PARAM_INT);
		}
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {

		}
		if (isset($array['user_id'])) {
			$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);
		}	
		if (isset($array['user_id_is_member'])) {
			$stmt->bindParam(':user_id_is_member', $array['user_id_is_member'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$passwords = $stmt->fetchAll(database::FETCH_ASSOC);
		
		return $passwords;
	}
	
	function delete($array = NULL) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		$log 	=	&singleton::get(__NAMESPACE__ . '\log');

		$site_id	= SITE_ID;
		
		//delete user permissions
		if (isset($array['id'])) {
			$query 	= "DELETE FROM $tables->users_to_departments WHERE site_id = :site_id AND department_id = :department_id";

			try {
				$stmt = $db->prepare($query);
			}
			catch (\PDOException $e) {
				$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
			}
			
			$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
			$stmt->bindParam(':department_id', $array['id'], database::PARAM_INT);
			
			try {
				$stmt->execute();
			}
			catch (\PDOException $e) {
				$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
			}
		}

		//delete ticket departments
		$query 	= "DELETE FROM $tables->ticket_departments WHERE site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		if (isset($array['enabled'])) {
			$query .= " AND enabled = :enabled";
		}
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\PDOException $e) {
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
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Ticket Department Deleted ID ' . safe_output($array['id']);
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'delete';
		$log_array['event_source'] = 'ticket_departments';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
		
	}
}


?>