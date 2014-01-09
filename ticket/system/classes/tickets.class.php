<?php
/**
 * 	Tickets Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

 
namespace sts;

class tickets {

	function __construct() {

	}
	
	public function add($array) {
		global $db;
				
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');
		$notifications 	= &singleton::get(__NAMESPACE__ . '\notifications');


		$site_id		= SITE_ID;
		$date_added 	= datetime();
		$last_modified	= datetime();
		$key 			= rand_str(8);
		$access_key 	= rand_str(32);

		$query = "INSERT INTO $tables->tickets (user_id, site_id, date_added, last_modified, `key`, submitted_user_id, date_state_changed, access_key";

		//used for import
		if (isset($array['id'])) {
			$query .= ", id";
		}
		
		if (isset($array['subject'])) {
			$query .= ", subject";
		}		
		if (isset($array['description'])) {
			$query .= ", description";
		}
		if (isset($array['priority_id'])) {
			$query .= ", priority_id";
		}
		if (isset($array['department_id'])) {
			$query .= ", department_id";
		}
		if (isset($array['name'])) {
			$query .= ", name";
		}
		if (isset($array['email'])) {
			$query .= ", email";
		}
		if (isset($array['html'])) {
			$query .= ", html";
		}
		if (isset($array['assigned_user_id'])) {
			$query .= ", assigned_user_id";
		}
		if (isset($array['pop_account_id'])) {
			$query .= ", pop_account_id";
		}
		if (isset($array['state_id'])) {
			$query .= ", state_id";
		}
		
		$query .= ") VALUES (:user_id, :site_id, :date_added, :last_modified, :key, :submitted_user_id, :date_state_changed, :access_key";
		
		//used for import
		if (isset($array['id'])) {
			$query .= ", :id";
		}
		
		if (isset($array['subject'])) {
			$query .= ", :subject";
		}
		if (isset($array['description'])) {
			$query .= ", :description";
		}
		if (isset($array['priority_id'])) {
			$query .= ", :priority_id";
		}
		if (isset($array['department_id'])) {
			$query .= ", :department_id";
		}
		if (isset($array['name'])) {
			$query .= ", :name";
		}
		if (isset($array['email'])) {
			$query .= ", :email";
		}
		if (isset($array['html'])) {
			$query .= ", :html";
		}	
		if (isset($array['assigned_user_id'])) {
			$query .= ", :assigned_user_id";
		}
		if (isset($array['pop_account_id'])) {
			$query .= ", :pop_account_id";
		}		
		if (isset($array['state_id'])) {
			$query .= ", :state_id";
		}
		
		$query .= ")";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		
		if (isset($array['date_added'])) {
			$stmt->bindParam(':date_added', $array['date_added'], database::PARAM_STR);		
		}
		else {
			$stmt->bindParam(':date_added', $date_added, database::PARAM_STR);
		}
		
		if (isset($array['last_modified'])) {
			$stmt->bindParam(':last_modified', $array['last_modified'], database::PARAM_STR);		
		}
		else {
			$stmt->bindParam(':last_modified', $date_added, database::PARAM_STR);
		}
		
		$stmt->bindParam(':date_state_changed', $date_added, database::PARAM_STR);
		
		if (!isset($array['access_key'])) {
			$array['access_key'] = $access_key;
		}

		$stmt->bindParam(':access_key', $array['access_key'], database::PARAM_STR);
		$stmt->bindParam(':key', $key, database::PARAM_STR);
		
		$submitted_user_id = $auth->get('id');
		$stmt->bindParam(':submitted_user_id', $submitted_user_id, database::PARAM_INT);

		
		$array['key']	= $key;
		
		if (isset($array['description'])) {
			$description = $array['description'];
			$stmt->bindParam(':description', $description, database::PARAM_STR);
		}
		
		//used for import
		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
		
		if (isset($array['subject'])) {
			$subject = $array['subject'];
			$stmt->bindParam(':subject', $subject, database::PARAM_STR);
		}
		
		if (isset($array['user_id'])) {
			$user_id = (int) $array['user_id'];
		}
		else {
			$user_id = 0;
		}
		
		$array['user_id']	= $user_id;
		
		$stmt->bindParam(':user_id', $user_id, database::PARAM_INT);
	
		if (isset($array['priority_id'])) {
			$priority_id	= $array['priority_id'];
			$stmt->bindParam(':priority_id', $priority_id, database::PARAM_INT);
		}
		if (isset($array['department_id'])) {
			$department_id	= $array['department_id'];
			$stmt->bindParam(':department_id', $department_id, database::PARAM_INT);
		}
		
		if (isset($array['name'])) {
			$name = $array['name'];
			$stmt->bindParam(':name', $name, database::PARAM_STR);
		}
		if (isset($array['email'])) {
			$email = $array['email'];
			$stmt->bindParam(':email', $email, database::PARAM_STR);
		}
		if (isset($array['html'])) {
			$html = $array['html'];
			$stmt->bindParam(':html', $html, database::PARAM_INT);
		}
		if (isset($array['assigned_user_id'])) {
			$assigned_user_id	= $array['assigned_user_id'];
			$stmt->bindParam(':assigned_user_id', $assigned_user_id, database::PARAM_INT);	
		}	
		if (isset($array['pop_account_id'])) {
			$pop_account_id	= $array['pop_account_id'];
			$stmt->bindParam(':pop_account_id', $pop_account_id, database::PARAM_INT);	
		}	
		if (isset($array['state_id'])) {
			$state_id	= $array['state_id'];
			$stmt->bindParam(':state_id', $state_id, database::PARAM_INT);	
		}		
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$array['id']	= (int) $id;
				
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Ticket Added "<a href="'. $config->get('address') .'/tickets/view/'.(int)$id.'/">' . safe_output($array['subject']) . '</a>"';
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'add';
		$log_array['event_source'] = 'tickets';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
		
		$notifications->new_ticket($array);
				
		return $id;
		
	}
	
	public function count($array = NULL) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error =	&singleton::get(__NAMESPACE__ . '\error');
		$site_id	= SITE_ID;
				
		$query = "SELECT count(*) AS `count` FROM $tables->tickets WHERE site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		if (isset($array['user_id'])) {
			$query .= " AND user_id = :user_id";
		}
		if (isset($array['state_id'])) {
			$query .= " AND state_id = :state_id";
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
		if (isset($array['state_id'])) {
			$stmt->bindParam(':state_id', $array['state_id'], database::PARAM_INT);
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

		$site_id			= SITE_ID;
		$salt 				= $auth->generate_user_salt();
		$last_modified 		= datetime();	
		
		$query = "UPDATE $tables->tickets SET last_modified = :last_modified";

		if (isset($array['subject'])) {
			$query .= ", subject = :subject";
		}
		if (isset($array['description'])) {
			$query .= ", description = :description";
		}
		if (isset($array['priority_id'])) {
			$query .= ", priority_id = :priority_id";
		}
		if (isset($array['state_id'])) {
			$query .= ", state_id = :state_id";
		}
		if (isset($array['assigned_user_id'])) {
			$query .= ", assigned_user_id = :assigned_user_id";
		}
		if (isset($array['department_id'])) {
			$query .= ", department_id = :department_id";
		}
		if (isset($array['key'])) {
			$query .= ", key = :key";
		}
		if (isset($array['html'])) {
			$query .= ", html = :html";
		}
		if (isset($array['date_state_changed'])) {
			$query .= ", date_state_changed = :date_state_changed";
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
		$stmt->bindParam(':last_modified', $last_modified, database::PARAM_STR);


		if (isset($array['subject'])) {
			$stmt->bindParam(':subject', $array['subject'], database::PARAM_STR);
		}	
		if (isset($array['description'])) {
			$stmt->bindParam(':description', $array['description'], database::PARAM_STR);
		}	
		if (isset($array['priority_id'])) {
			$stmt->bindParam(':priority_id', $array['priority_id'], database::PARAM_INT);
		}
		if (isset($array['state_id'])) {
			$stmt->bindParam(':state_id', $array['state_id'], database::PARAM_INT);
		}
		if (isset($array['assigned_user_id'])) {
			$stmt->bindParam(':assigned_user_id', $array['assigned_user_id'], database::PARAM_INT);
		}
		if (isset($array['department_id'])) {
			$stmt->bindParam(':department_id', $array['department_id'], database::PARAM_INT);
		}
		if (isset($array['key'])) {
			$stmt->bindParam(':key', $array['key'], database::PARAM_INT);
		}
		if (isset($array['html'])) {
			$stmt->bindParam(':html', $array['html'], database::PARAM_INT);
		}		
		if (isset($array['date_state_changed'])) {
			$stmt->bindParam(':date_state_changed', $array['date_state_changed'], database::PARAM_STR);
		}

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$log_array['event_severity'] = 'notice';
		$log_array['event_number'] = E_USER_NOTICE;
		$log_array['event_description'] = 'Ticket Edited ID <a href="'. $config->get('address') .'/tickets/view/'.(int)$array['id'] . '/">' . safe_output($array['id']) . '</a>';
		if (isset($array['subject'])) {
			$log_array['event_description'] = 'Ticket Edited "<a href="'. $config->get('address') .'/tickets/view/'.(int)$array['id'] . '/">' . safe_output($array['subject']) . '</a>"';
		}
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'edit';
		$log_array['event_source'] = 'tickets';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
				
		
		return true;
	
	}
	public function get($array = NULL) {
		global $db;
		
		$error 			=	&singleton::get(__NAMESPACE__ . '\error');
		$tables 		=	&singleton::get(__NAMESPACE__ . '\tables');
		$site_id		= SITE_ID;
		$order_array 	= array('date_added', 'state_id', 'priority_id', 'subject', 'user_id', 'assigned_user_id', 'last_modified', 'id');


		if (isset($array['count']) && ($array['count'] == true)) {
			$query = "SELECT count(t.id) AS `count`";
		}
		else {
			$query = "SELECT t.* ";
		}
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {
			$query .= ", u.pushover_key AS `owner_pushover_key`, u.name AS `owner_name`, u.id AS `owner_id`, u.email AS `owner_email`, u.phone_number AS `owner_phone`, u.email_notifications AS `owner_email_notifications`";
			$query .= ", u2.pushover_key AS `assigned_pushover_key`, u2.name AS `assigned_name`, u2.id AS `assigned_id`, u2.email AS `assigned_email`, u2.email_notifications AS `assigned_email_notifications`";
			$query .= ", u3.name AS `submitted_name`, u3.id AS `submitted_id`, u3.email AS `submitted_email`, u3.email_notifications AS `submitted_email_notifications`";
			
			$query .= ", tp.name AS `priority_name`";
			$query .= ", td.name AS `department_name`";
			$query .= ", ts.name AS `status_name`, ts.colour  AS `status_colour`, ts.active AS `active`";
			$query .= ", pa.name AS `pop_account_name`";
		}
		
		$query .= " FROM $tables->tickets t";
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true)) {
			$query .= " LEFT JOIN $tables->users u ON u.id = t.user_id";
			$query .= " LEFT JOIN $tables->users u2 ON u2.id = t.assigned_user_id";
			$query .= " LEFT JOIN $tables->users u3 ON u3.id = t.submitted_user_id";
			
			$query .= " LEFT JOIN $tables->ticket_priorities tp ON tp.id = t.priority_id";
			$query .= " LEFT JOIN $tables->ticket_departments td ON td.id = t.department_id";
			$query .= " LEFT JOIN $tables->ticket_status ts ON ts.id = t.state_id";
			$query .= " LEFT JOIN $tables->pop_accounts pa ON pa.id = t.pop_account_id";
		}
		
		$query .= " WHERE 1 = 1 AND t.site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND t.id = :id";
		}
		if (isset($array['user_id'])) {
			$query .= " AND t.user_id = :user_id";
		}
		if (isset($array['assigned_user_id'])) {
			$query .= " AND t.assigned_user_id = :assigned_user_id";
		}	
		if (isset($array['assigned_or_user_id'])) {
			$query .= " AND (t.assigned_user_id = :assigned_or_user_id OR t.user_id = :assigned_or_user_id)";
		}	
		if (isset($array['state_id'])) {
			$query .= " AND t.state_id = :state_id";
		}
		if (isset($array['priority_id'])) {
			$query .= " AND t.priority_id = :priority_id";
		}
		if (isset($array['department_id'])) {
			$query .= " AND t.department_id = :department_id";
		}
		if (isset($array['like_search'])) {
			$query .= " AND (t.subject LIKE :like_search OR t.description LIKE :like_search)";
		}
		if (isset($array['access_key'])) {
			$query .= " AND t.access_key = :access_key";
		}
		//used for moderators
		if (isset($array['department_or_assigned_or_user_id'])) {
			$query .= " AND (";
				//departments
				$query .= " t.department_id IN (SELECT utd.department_id FROM $tables->users_to_departments utd WHERE utd.user_id = :department_or_assigned_or_user_id AND utd.site_id = :site_id)";
			$query .= " OR ";
				//assigned or user
				$query .= " (t.assigned_user_id = :department_or_assigned_or_user_id OR t.user_id = :department_or_assigned_or_user_id)";
			$query .= ")";
		}
		
		if (isset($array['get_other_data']) && ($array['get_other_data'] == true) && isset($array['active'])) {
			$query .= " HAVING active = :active ";
		}
		
		if (isset($array['order_by']) && in_array($array['order_by'], $order_array)) {
			if (isset($array['order']) && $array['order'] == 'desc') {
				$query .= ' ORDER BY t.' . $array['order_by'] . ' DESC';
			}
			else {
				$query .= ' ORDER BY t.' . $array['order_by'];
			}			
		}
		else {
			if (isset($array['order']) && $array['order'] == 'asc') {
				$query .= ' ORDER BY t.last_modified';
			}
			else {
				$query .= " ORDER BY t.last_modified DESC";
			}	
		}
		
		if (isset($array['limit'])) {
			$query .= " LIMIT :limit";
			if (isset($array['offset'])) {
				$query .= " OFFSET :offset";
			}
		}
		
		//echo $query;
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		if (isset($array['get_other_data']) && ($array['get_other_data'] == true) && isset($array['active'])) {
			$stmt->bindParam(':active', $array['active'], database::PARAM_INT);
		}		
		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
		if (isset($array['user_id'])) {
			$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);
		}
		if (isset($array['assigned_user_id'])) {
			$stmt->bindParam(':assigned_user_id', $array['assigned_user_id'], database::PARAM_INT);
		}
		if (isset($array['assigned_or_user_id'])) {
			$stmt->bindParam(':assigned_or_user_id', $array['assigned_or_user_id'], database::PARAM_INT);
		}
		if (isset($array['state_id'])) {
			$stmt->bindParam(':state_id', $array['state_id'], database::PARAM_INT);
		}
		if (isset($array['priority_id'])) {
			$stmt->bindParam(':priority_id', $array['priority_id'], database::PARAM_INT);
		}
		if (isset($array['department_id'])) {
			$stmt->bindParam(':department_id', $array['department_id'], database::PARAM_INT);
		}
		if (isset($array['access_key'])) {
			$stmt->bindParam(':access_key', $array['access_key'], database::PARAM_STR);
		}
		if (isset($array['like_search'])) {
			$value = $array['like_search'];
			$value = "%{$value}%";
			$stmt->bindParam(':like_search', $value, database::PARAM_STR);
			unset($value);
		}
		if (isset($array['department_or_assigned_or_user_id'])) {
			$stmt->bindParam(':department_or_assigned_or_user_id', $array['department_or_assigned_or_user_id'], database::PARAM_INT);
		}
		
		if (isset($array['limit'])) {
			$limit = (int) $array['limit'];
			if ($limit < 0) $limit = 0;
			$stmt->bindParam(':limit', $limit, database::PARAM_INT);
			if (isset($array['offset'])) {
				$offset = (int) $array['offset'];
				$stmt->bindParam(':offset', $offset, database::PARAM_INT);					
			}
		}	
	
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$tickets = $stmt->fetchAll(database::FETCH_ASSOC);
		
		//print_r($tickets);
		
		return $tickets;
	}
	
	function delete($array) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		$log 	=	&singleton::get(__NAMESPACE__ . '\log');

		$site_id	= SITE_ID;
		
		if (!isset($array['id'])) return false;
		
		//delete file links
		$query 	= "DELETE FROM $tables->files_to_tickets WHERE site_id = :site_id AND ticket_id = :id";
				
		try {
			$stmt = $db->prepare($query);
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		
		try {
			$stmt->execute();
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}

		//delete notes
		$query 	= "DELETE FROM $tables->ticket_notes WHERE site_id = :site_id AND ticket_id = :id";
				
		try {
			$stmt = $db->prepare($query);
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		
		try {
			$stmt->execute();
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		//delete ticket
		$query 	= "DELETE FROM $tables->tickets WHERE site_id = :site_id";
		
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
		$log_array['event_description'] = 'Ticket Deleted ID ' . safe_output($array['id']);
		$log_array['event_file'] = __FILE__;
		$log_array['event_file_line'] = __LINE__;
		$log_array['event_type'] = 'delete';
		$log_array['event_source'] = 'tickets';
		$log_array['event_version'] = '1';
		$log_array['log_backtrace'] = false;	
				
		$log->add($log_array);
		
	}
	
	public function get_files($array) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		$log 	=	&singleton::get(__NAMESPACE__ . '\log');

		$site_id	= SITE_ID;
		
		$query = "SELECT $tables->storage.* FROM $tables->files_to_tickets LEFT JOIN $tables->storage ON $tables->files_to_tickets.file_id = $tables->storage.id WHERE 1 = 1 AND $tables->storage.site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND $tables->files_to_tickets.ticket_id = :id";
		}
		
		if (isset($array['file_id'])) {
			$query .= " AND $tables->files_to_tickets.file_id = :file_id";
		}
		
		if (isset($array['ticket_ids'])) {
				
			$return = " AND $tables->files_to_tickets.ticket_id = ";
			
			foreach ($array['ticket_ids'] as $index => $value) {
				$return .= ' :tids' . (int) $index . " OR $tables->files_to_tickets.ticket_id = ";
			}
			
			if(substr($return, -42) == " OR $tables->files_to_tickets.ticket_id = ") {	
				$return = substr($return, 0, strlen($return) - 42);
			}
			
			$query .= $return;
		}
		
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
		if (isset($array['file_id'])) {
			$stmt->bindParam(':file_id', $array['file_id'], database::PARAM_INT);
		}
		if (isset($array['ticket_ids'])) {	
			foreach ($array['ticket_ids'] as $index => $value) {
				$t_id = (int) $value;
				$stmt->bindParam(':tids' . (int) $index, $t_id, database::PARAM_INT);
				unset($t_id);
			}
		}	
	
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$files = $stmt->fetchAll(database::FETCH_ASSOC);
		
		return $files;
		
	}
	
	public function day_stats($array = NULL) {
		global $db;
		
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$site_id		= SITE_ID;
		
		if ($array['date_select'] == 'date_state_changed') {
			$query = "SELECT count(id) AS `count`, DAY(date_state_changed) AS `day`, MONTH(date_state_changed) AS `month`, YEAR(date_state_changed) AS `year`";
		}
		else {
			$query = "SELECT count(id) AS `count`, DAY(date_added) AS `day`, MONTH(date_added) AS `month`, YEAR(date_added) AS `year`";
		}
		
		$query .= "FROM $tables->tickets WHERE 1 = 1 AND site_id = :site_id";
		
		if (isset($array['state_id'])) {
			$query .= " AND state_id = :state_id";
		}
		
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			if ($array['date_select'] == 'date_state_changed') {
				$query .= ' AND date_state_changed >= SUBDATE(DATE_FORMAT(NOW(), "%Y-%m-%d"), INTERVAL :days DAY)';
			}
			else {
				$query .= ' AND date_added >= SUBDATE(DATE_FORMAT(NOW(), "%Y-%m-%d"), INTERVAL :days DAY)';
			}
		}
		
		$query .= " GROUP BY `year` DESC, `month` DESC, `day` DESC";
		
		$query .= " ORDER BY `year` DESC, `month` DESC, `day` DESC";
		
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			$query .= " LIMIT " . (int) $array['days'];
		}
		
		//echo $query . '<br />';

		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			$stmt->bindParam(':days', $array['days'], database::PARAM_INT);
		}
				
		if (isset($array['state_id'])) {
			$stmt->bindParam(':state_id', $array['state_id'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$stats = $stmt->fetchAll(database::FETCH_ASSOC);
				
		return $stats;
	}
	
	public function month_stats($array = NULL) {
		global $db;
		
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$site_id		= SITE_ID;
		
		if ($array['date_select'] == 'date_state_changed') {
			$query = "SELECT count(id) AS `count`, MONTH(date_state_changed) AS `month`, YEAR(date_state_changed) AS `year`";
		}
		else {
			$query = "SELECT count(id) AS `count`, MONTH(date_added) AS `month`, YEAR(date_added) AS `year`";
		}
		
		$query .= "FROM $tables->tickets WHERE 1 = 1 AND site_id = :site_id";
		
		if (isset($array['state_id'])) {
			$query .= " AND state_id = :state_id";
		}
		
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			if ($array['date_select'] == 'date_state_changed') {
				$query .= ' AND date_state_changed >= SUBDATE(DATE_FORMAT(NOW(), "%Y-%m-01"), INTERVAL :months MONTH)';
			}
			else {
				$query .= ' AND date_added >= SUBDATE(DATE_FORMAT(NOW(), "%Y-%m-01"), INTERVAL :months MONTH)';
			}
		}
		
		$query .= " GROUP BY `year` DESC, `month` DESC";
		
		$query .= " ORDER BY `year` DESC, `month` DESC";
		
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			$query .= " LIMIT " . (int) $array['months'];
		}
		
		//echo $query . '<br />';

		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			$stmt->bindParam(':months', $array['months'], database::PARAM_INT);
		}
				
		if (isset($array['state_id'])) {
			$stmt->bindParam(':state_id', $array['state_id'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$stats = $stmt->fetchAll(database::FETCH_ASSOC);
				
		return $stats;
	}
	
		
	public function day_users($array = NULL) {
		global $db;
		
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$site_id		= SITE_ID;
		
		$query = "SELECT count(t.id) AS `count`, u.name as `full_name`";
		
		$query .= "FROM $tables->tickets t, $tables->users u WHERE 1 = 1 AND t.site_id = :site_id AND t.user_id = u.id";
		
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			$query .= ' AND t.date_added >= SUBDATE(DATE_FORMAT(NOW(), "%Y-%m-%d"), INTERVAL :days DAY)';
		}
		
		$query .= " GROUP BY t.user_id";
		
		$query .= " ORDER BY `count` DESC";
		
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			if (isset($array['limit'])) {
				$query .= " LIMIT " . (int) $array['limit'];
			}
		}
		
		//echo $query . '<br />';

		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			$stmt->bindParam(':days', $array['days'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$stats = $stmt->fetchAll(database::FETCH_ASSOC);
				
		return $stats;
	}
	
	public function month_users($array = NULL) {
		global $db;
		
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$site_id		= SITE_ID;
		
		$query = "SELECT count(t.id) AS `count`, u.name as `full_name`";
		
		$query .= "FROM $tables->tickets t, $tables->users u WHERE 1 = 1 AND t.site_id = :site_id AND t.user_id = u.id";
		
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			$query .= ' AND t.date_added >= SUBDATE(DATE_FORMAT(NOW(), "%Y-%m-01"), INTERVAL :months MONTH)';
		}
		
		$query .= " GROUP BY t.user_id";
		
		$query .= " ORDER BY `count` DESC";
		
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			if (isset($array['limit'])) {
				$query .= " LIMIT " . (int) $array['limit'];
			}
		}
		
		//echo $query . '<br />';

		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		if (isset($array['get_all']) && ($array['get_all'] == true)) {
		
		}
		else {
			$stmt->bindParam(':months', $array['months'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$stats = $stmt->fetchAll(database::FETCH_ASSOC);
				
		return $stats;
	}
	
}


?>