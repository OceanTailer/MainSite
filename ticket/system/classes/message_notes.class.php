<?php
/**
 * 	Message Notes Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */
namespace sts;

class message_notes {
	
	function __construct() {

	}
	
	public function add($array) {
		global $db;
		
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$notifications 	= &singleton::get(__NAMESPACE__ . '\notifications');
		$messages 		= &singleton::get(__NAMESPACE__ . '\messages');

		$site_id		= SITE_ID;
		$date_added 	= datetime();

		
		$query = "INSERT INTO $tables->message_notes (user_id, site_id, date_added";
		
		if (isset($array['message_id'])) {
			$query .= ", message_id";
		}
		if (isset($array['message'])) {
			$query .= ", message";
		}
		
		$query .= ") VALUES (:user_id, :site_id, :date_added";
		
		if (isset($array['message_id'])) {
			$query .= ", :message_id";
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
	

		if (isset($array['message_id'])) {
			$stmt->bindParam(':message_id', $array['message_id'], database::PARAM_INT);
		}	
		if (isset($array['message'])) {
			$stmt->bindParam(':message', $array['message'], database::PARAM_STR);
		}
		
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
			if (isset($array['message_id'])) {
				$messages->edit(array('id' => $array['message_id']));
			}
			$notifications->new_message_note(array('user_id' => $array['user_id']));
			return $id;
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	}
	
	public function edit($array) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		$site_id	= SITE_ID;
	
		$query = "UPDATE $tables->message_notes SET user_id = :user_id";
		
		if (isset($array['message'])) {
			$query .= ", message = :message";
		}
		
		$query .= " WHERE id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\PDOException $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':user_id', $array['user_id'], database::PARAM_INT);
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
	
		if (isset($array['message'])) {
			$stmt->bindParam(':message', $array['message'], database::PARAM_STR);
		}
		
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
	
		$query 	= "DELETE FROM $tables->message_notes WHERE id = :id AND site_id = :site_id AND user_id = :user_id";
		
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
	
		$query 	= "SELECT mn.*, $tables->users.name, $tables->users.email FROM $tables->message_notes mn, $tables->users WHERE mn.site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND mn.id = :id";
		}
		if (isset($array['user_id'])) {
			$query .= " AND mn.user_id = :user_id";
		}
		if (isset($array['message_id'])) {
			$query .= " AND mn.message_id = :message_id";
		}
		
		$query .= " AND $tables->users.id = mn.user_id";
		
		$query .= " ORDER BY mn.id";
		
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
		if (isset($array['message_id'])) {
			$stmt->bindParam(':message_id', $array['message_id'], database::PARAM_INT);
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
	
	
}

?>