<?php
/**
 * 	Ticket Notes Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

 
namespace sts;

class ticket_notes {

	function __construct() {

	}
	
	public function add($array) {
		global $db;
				
		$error 		= &singleton::get(__NAMESPACE__ . '\error');
		$log		= &singleton::get(__NAMESPACE__ . '\log');
		$tables 	= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 		= &singleton::get(__NAMESPACE__ . '\auth');
		$config 	= &singleton::get(__NAMESPACE__ . '\config');
		$notifications 	= &singleton::get(__NAMESPACE__ . '\notifications');
		$tickets 	= &singleton::get(__NAMESPACE__ . '\tickets');

		$site_id	= SITE_ID;
		$date_added = datetime();

		$query = "INSERT INTO $tables->ticket_notes (user_id, site_id, date_added";

		//used for import
		if (isset($array['id'])) {
			$query .= ", id";
		}
		
		if (isset($array['ticket_id'])) {
			$query .= ", ticket_id";
		}		
		if (isset($array['description'])) {
			$query .= ", description";
		}
		if (isset($array['html'])) {
			$query .= ", html";
		}		
		if (isset($array['private'])) {
			$query .= ", private";
		}	
		
		$query .= ") VALUES (:user_id, :site_id, :date_added";
	
		//used for import
		if (isset($array['id'])) {
			$query .= ", :id";
		}
	
		if (isset($array['ticket_id'])) {
			$query .= ", :ticket_id";
		}
		if (isset($array['description'])) {
			$query .= ", :description";
		}
		if (isset($array['html'])) {
			$query .= ", :html";
		}
		if (isset($array['private'])) {
			$query .= ", :private";
		}
		
		$query .= ")";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}
		
		if (isset($array['user_id'])) {
			$user_id = (int) $array['user_id'];
		}
		else {
			$user_id = $auth->get('id');
		}
		
		$array['user_id']	= $user_id;
		
		$stmt->bindParam(':user_id', $user_id, database::PARAM_INT);
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
	
		if (isset($array['date_added'])) {
			$stmt->bindParam(':date_added', $array['date_added'], database::PARAM_STR);		
		}
		else {
			$stmt->bindParam(':date_added', $date_added, database::PARAM_STR);
		}

		//used for import
		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
		
		if (isset($array['ticket_id'])) {
			$ticket_id = $array['ticket_id'];
			$stmt->bindParam(':ticket_id', $ticket_id, database::PARAM_INT);
		}
		if (isset($array['description'])) {
			$description = $array['description'];
			$stmt->bindParam(':description', $description, database::PARAM_STR);
		}
	
		if (isset($array['priority_id'])) {
			$priority_id	= $array['priority_id'];
			$stmt->bindParam(':priority_id', $priority_id, database::PARAM_INT);
		}
		if (isset($array['html'])) {
			$html	= $array['html'];
			$stmt->bindParam(':html', $html, database::PARAM_INT);
		}		
	
		if (isset($array['private'])) {
			$private	= $array['private'];
			$stmt->bindParam(':private', $private, database::PARAM_INT);
		}
		
		
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$array['id']	= (int) $id;
				
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Ticket Note Added "<a href="'. $config->get('address') .'/tickets/view/'.(int)$ticket_id.'/">Note</a>"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'add';
		$log_array['event_source'] = 'ticket_notes';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
		
		if (isset($array['ticket_id'])) {
			$tickets->edit(array('id' => $array['ticket_id']));
		}
		
		$notifications->new_ticket_note($array);
				
		return $id;
		
	}
	
	public function count($array = NULL) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error =	&singleton::get(__NAMESPACE__ . '\error');
		$site_id	= SITE_ID;
				
		$query = "SELECT count(*) AS `count` FROM $tables->ticket_notes WHERE site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		if (isset($array['user_id'])) {
			$query .= " AND user_id = :user_id";
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
		
		if (isset($array['user_id'])) {
			$user_id = $array['user_id'];
			$stmt->bindParam(':user_id', $user_id, database::PARAM_INT);
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

		
		$query = "UPDATE $tables->ticket_notes SET site_id = :site_id";

		if (isset($array['description'])) {
			$query .= ", description = :description";
		}
		
		$query .= " WHERE id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);


		if (isset($array['description'])) {
			$stmt->bindParam(':description', $array['description'], database::PARAM_STR);
		}
		
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Ticket Note Edited "<a href="'. $config->get('address') .'/tickets/view/'.(int)$array['id'] . '/">' . safe_output($array['name']) . '</a>"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'edit';
		$log_array['event_source'] = 'ticket_notes';
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

		$query = "SELECT tn.*";
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {
			$query .= ", u.name AS `owner_name`, u.id AS `owner_id`, u.email AS `owner_email`";
		}
		
		$query .= " FROM $tables->ticket_notes tn";
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {
			$query .= " LEFT JOIN $tables->users u ON (u.id = tn.user_id)";
		}
		
		$query .= " WHERE 1 = 1 AND tn.site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND tn.id = :id";
		}
		if (isset($array['user_id'])) {
			$query .= " AND tn.user_id = :user_id";
		}
		if (isset($array['ticket_id'])) {
			$query .= " AND tn.ticket_id = :ticket_id";
		}
		if (isset($array['private'])) {
			$query .= " AND tn.private = :private";
		}		
		
		$query .= " GROUP BY tn.id ORDER BY tn.id";
		
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
		if (isset($array['user_id'])) {
			$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);
		}
		if (isset($array['ticket_id'])) {
			$stmt->bindParam(':ticket_id', $array['ticket_id'], database::PARAM_INT);
		}
		if (isset($array['private'])) {
			$stmt->bindParam(':private', $array['private'], database::PARAM_INT);
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
	
	function delete($array) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		$log 	=	&singleton::get(__NAMESPACE__ . '\log');

		$site_id	= SITE_ID;

		
		//delete password
		$query 	= "DELETE FROM $tables->ticket_notes WHERE site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		if (isset($array['user_id'])) {
			$query .= " AND user_id = :user_id";
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
		if (isset($array['user_id'])) {
			$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Ticket Note Deleted ID ' . safe_output($array['id']);
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'delete';
		$log_array['event_source'] = 'ticket_notes';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
		
	}
}


?>