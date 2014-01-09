<?php
/**
 * 	Ticket Status Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

 
namespace sts;

class ticket_status {

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

		$query = "INSERT INTO $tables->ticket_status (name, enabled, site_id";
		
		if (isset($array['colour'])) {
			$query .= ", colour";
		}
		if (isset($array['active'])) {
			$query .= ", active";
		}
		
		$query .= ") VALUES (:name, :enabled, :site_id";

		if (isset($array['colour'])) {
			$query .= ", :colour";
		}
		if (isset($array['active'])) {
			$query .= ", :active";
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
	
		if (isset($array['colour'])) {
			$colour = $array['colour'];
			$stmt->bindParam(':colour', $colour, database::PARAM_STR);		
		}
		if (isset($array['active'])) {
			$active = $array['active'];
			$stmt->bindParam(':active', $active, database::PARAM_INT);		
		}
		
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
				
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Ticket Status Added "' . safe_output($array['name']) . '"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'add';
		$log_array['event_source'] = 'ticket_status';
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
				
		$query = "SELECT count(*) AS `count` FROM $tables->ticket_status WHERE site_id = :site_id";
		
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
		
		$stmt->bindParam(':site_id', $site_id);

		if (isset($array['id'])) {
			$id = $array['id'];
			$stmt->bindParam(':id', $id, database::PARAM_INT);
		}
		
		if (isset($array['enabled'])) {
			$enabled = $array['enabled'];
			$stmt->bindParam(':enabled', $enabled, database::PARAM_INT);
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

		
		$query = "UPDATE $tables->ticket_status SET name = :name";

		if (isset($array['enabled'])) {
			$query .= ", enabled = :enabled";
		}
		if (isset($array['colour'])) {
			$query .= ", colour = :colour";
		}
		if (isset($array['active'])) {
			$query .= ", active = :active";
		}		
		$query .= " WHERE id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':name', $array['name'], database::PARAM_STR);
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		if (isset($array['enabled'])) {
			$stmt->bindParam(':enabled', $array['enabled'], database::PARAM_INT);
		}	
		if (isset($array['colour'])) {
			$stmt->bindParam(':colour', $array['colour'], database::PARAM_STR);
		}
		if (isset($array['active'])) {
			$stmt->bindParam(':active', $array['active'], database::PARAM_STR);
		}	
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Ticket Status Edited "' . safe_output($array['name']) . '"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'edit';
		$log_array['event_source'] = 'ticket_status';
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

		$query = "SELECT ts.*";
		
		$query .= " FROM $tables->ticket_status ts";
	
		$query .= " WHERE 1 = 1 AND ts.site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND ts.id = :id";
		}
		
		$query .= " GROUP BY ts.id ORDER BY ts.id";
		
		//echo $query;
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		
		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
	
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$status = $stmt->fetchAll(database::FETCH_ASSOC);
		
		return $status;
	}
	
	function delete($array = NULL) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		$log 	=	&singleton::get(__NAMESPACE__ . '\log');

		$site_id	= SITE_ID;

		
		//delete ticket status
		$query 	= "DELETE FROM $tables->ticket_status WHERE site_id = :site_id";
		
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
		$log_array['event_description'] = 'Ticket Status Deleted ID ' . safe_output($array['id']);
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'delete';
		$log_array['event_source'] = 'ticket_status';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
		
	}
}


?>