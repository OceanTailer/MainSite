<?php
/**
 * 	Messages Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */
namespace sts;

class messages {
	
	function __construct() {

	}
	
	public function add($array) {
		global $db;
		
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$notifications 	= &singleton::get(__NAMESPACE__ . '\notifications');
		$site_id		= SITE_ID;
		$date_added 	= datetime();

		
		$query = "INSERT INTO $tables->messages (user_id, site_id, date_added, last_modified";
		
		if (isset($array['from_user_id'])) {
			$query .= ", from_user_id";
		}
		
		if (isset($array['subject'])) {
			$query .= ", subject";
		}
		
		if (isset($array['message'])) {
			$query .= ", message";
		}

		
		$query .= ") VALUES (:user_id, :site_id, :date_added, :last_modified";
		
		if (isset($array['from_user_id'])) {
			$query .= ", :from_user_id";
		}	
		if (isset($array['subject'])) {
			$query .= ", :subject";
		}		
		if (isset($array['message'])) {
			$query .= ", :message";
		}		
		
		$query .= ")";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		$stmt->bindParam(':date_added', $date_added, database::PARAM_STR);
		$stmt->bindParam(':last_modified', $date_added, database::PARAM_STR);
	
		if (isset($array['from_user_id'])) {
			$stmt->bindParam(':from_user_id', $array['from_user_id'], database::PARAM_INT);
		}
		if (isset($array['subject'])) {
			$stmt->bindParam(':subject', $array['subject'], database::PARAM_STR);
		}	
		if (isset($array['message'])) {
			$stmt->bindParam(':message', $array['message'], database::PARAM_STR);
		}
		

		try {
			$stmt->execute();
			$id = $db->lastInsertId();
			$this->add_unread(array('message_id' => $id, 'user_id' => $array['user_id']));
			$notifications->new_message(array('user_id' => $array['user_id']));
			return $id;
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	}
	
	public function edit($array) {
		global $db;
		
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$site_id		= SITE_ID;
	
		$last_modified 	= datetime();
	
		$query = "UPDATE $tables->messages SET site_id = :site_id";
		
		if (isset($array['from_user_id'])) {
			$query .= ", from_user_id = :from_user_id";
		}
		if (isset($array['subject'])) {
			$query .= ", subject = :subject";
		}
		if (isset($array['message'])) {
			$query .= ", message = :message";
		}
		
		$query .= ", last_modified = :last_modified";
		
		$query .= " WHERE id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
	
		if (isset($array['from_user_id'])) {
			$stmt->bindParam(':from_user_id', $array['from_user_id'], database::PARAM_INT);
		}
		if (isset($array['subject'])) {
			$stmt->bindParam(':subject', $array['subject'], database::PARAM_STR);
		}
		if (isset($array['message'])) {
			$stmt->bindParam(':message', $array['message'], database::PARAM_STR);
		}
		
		$stmt->bindParam(':last_modified', $last_modified, database::PARAM_STR);
		
		try {
			$stmt->execute();
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	}
	
	function delete($array) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		$site_id	= SITE_ID;
		
		$this->read(array('message_id' => $array['id']));
	
		$query 	= "DELETE FROM $tables->messages WHERE id = :id AND site_id = :site_id AND user_id = :user_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		try {
			$stmt->execute();
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
	}
	
	function count($array = NULL) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		$site_id	= SITE_ID;
	
		$query  = "SELECT count(*) AS `count` FROM `$tables->messages` WHERE site_id = :site_id";
		
		if (isset($array['user_id'])) {
			$query .= " AND user_id = :user_id";
		}
		if (isset($array['from_user_id'])) {
			$query .= " AND from_user_id = :from_user_id";
		}
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		
		if (isset($array['user_id'])) {
			$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);
		}
		if (isset($array['from_user_id'])) {
			$stmt->bindParam(':from_user_id', $array['from_user_id'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$items = $stmt->fetch(database::FETCH_ASSOC);
		
		return (int)$items['count'];
		

	}
	
	function get($array = NULL) {
		global $db;
		
		$tables 	= &singleton::get(__NAMESPACE__ . '\tables');
		$error 		= &singleton::get(__NAMESPACE__ . '\error');
		$site_id	= SITE_ID;
	
		$query 	= "SELECT m.*, u.name AS `from_name`, u2.name AS `to_name`, count(mu.id) AS `unread_count` FROM $tables->messages m";
		
		$query .= " LEFT JOIN $tables->message_unread mu ON m.id = mu.message_id";
		if (isset($array['to_from_user_id'])) {
			$query .= " AND (mu.user_id = :to_from_user_id OR mu.user_id = :to_from_user_id)";
		}
		$query .= " LEFT JOIN $tables->users u ON u.id = m.from_user_id";
		$query .= " LEFT JOIN $tables->users u2 ON u2.id = m.user_id";
		
		$query .= " WHERE m.site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND m.id = :id";
		}
		if (isset($array['user_id'])) {
			$query .= " AND m.user_id = :user_id";
		}
		if (isset($array['to_from_user_id'])) {
			$query .= " AND (m.user_id = :to_from_user_id OR m.from_user_id = :to_from_user_id)";
		}
				
		$query .= " GROUP BY m.id ORDER BY m.last_modified DESC";
		
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
		if (isset($array['to_from_user_id'])) {
			$stmt->bindParam(':to_from_user_id', $array['to_from_user_id'], database::PARAM_INT);
		}
				
		try {
			$stmt->execute();
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$items = $stmt->fetchAll(database::FETCH_ASSOC);

		return $items;
	}
	
	function add_unread($array) {
		global $db;
		
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$notifications 	= &singleton::get(__NAMESPACE__ . '\notifications');
		$site_id		= SITE_ID;
		
		$query = "INSERT INTO $tables->message_unread (user_id, site_id, message_id";
		
		if (isset($array['message_note_id'])) {
			$query .= ", message_note_id";
		}
		
		$query .= ") VALUES (:user_id, :site_id, :message_id";

		if (isset($array['message_note_id'])) {
			$query .= ", :message_note_id";
		}
		
		$query .= ")";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}

		$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);		
		$stmt->bindParam(':message_id', $array['message_id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);		

		if (isset($array['message_note_id'])) {
			$stmt->bindParam(':message_note_id', $array['message_note_id'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
			return $id;
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}	
	}
	
	function unread_count($array) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		$site_id	= SITE_ID;
	
		$query  = "SELECT count(*) AS `count` FROM `$tables->message_unread` WHERE site_id = :site_id";
		
		if (isset($array['user_id'])) {
			$query .= " AND user_id = :user_id";
		}
		if (isset($array['message_id'])) {
			$query .= " AND message_id = :message_id";
		}
		if (isset($array['message_note_id'])) {
			$query .= " AND message_note_id = :message_note_id";
		}		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		
		if (isset($array['user_id'])) {
			$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);
		}
		if (isset($array['message_id'])) {
			$stmt->bindParam(':message_id', $array['message_id'], database::PARAM_INT);
		}
		if (isset($array['message_note_id'])) {
			$stmt->bindParam(':message_note_id', $array['message_note_id'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$items = $stmt->fetch(database::FETCH_ASSOC);
		
		return (int)$items['count'];
			
	}
	
	public function read($array) {
		global $db;
		
		$tables 	= &singleton::get(__NAMESPACE__ . '\tables');
		$error 		= &singleton::get(__NAMESPACE__ . '\error');
		$site_id	= SITE_ID;

		$query = "DELETE FROM `$tables->message_unread` WHERE message_id = :message_id AND site_id = :site_id";
		
		if (isset($array['user_id'])) {
			$query .= " AND user_id = :user_id";
		}
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		if (isset($array['user_id'])) {
			$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);		
		}

		$stmt->bindParam(':message_id', $array['message_id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
	
		try {
			$stmt->execute();
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		return true;
		
	}
	
}

?>