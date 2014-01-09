<?php
/**
 * 	Queue Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class queue {

	//add data to the queue
	function add($array) {
		global $db;
		
		if (!isset($array['start_date'])) {
			$array['start_date'] = '0000-00-00 00:00:00';
		}
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
	
		//we require an array
		if (!is_array($array['data'])) return false;
		
		reset($array['data']);
		
		$queue_data = \base64_encode(\serialize($array['data']));
		
		$queue_date 	= datetime();
		$site_id		= SITE_ID;

		
		$query = "INSERT INTO $tables->queue (data, type, start_date, date, site_id) VALUES (:data, :type, :start_date, :date, :site_id)";
		
				
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':data', $queue_data, database::PARAM_STR);
		$stmt->bindParam(':type', $array['type'], database::PARAM_STR);
		$stmt->bindParam(':start_date', $array['start_date'], database::PARAM_STR);
		$stmt->bindParam(':date', $queue_date, database::PARAM_STR);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_STR);
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		return true;
	}
	
	//delete an item from the queue
	function delete($array = NULL) {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		
		$site_id		= SITE_ID;

		
		$query = "DELETE FROM $tables->queue WHERE site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_STR);

		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	}
	
	//check the size of a queue
	function count($queue_type = 'all') {
		global $db;
		
		$tables =	&singleton::get(__NAMESPACE__ . '\tables');
		$error 	=	&singleton::get(__NAMESPACE__ . '\error');
		
		$site_id		= SITE_ID;
		
		$query = "SELECT count(*) as `count` FROM $tables->queue WHERE site_id = :site_id";
		
		if ($queue_type != 'all') {
			$query .= " AND type = :type";
		}
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		if ($queue_type != 'all') {
			$stmt->bindParam(':type', $queue_type);
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_STR);
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$size = $stmt->fetch(database::FETCH_ASSOC);
		
		return (int) $size['count'];
	
	}
	
	//run the queue
	function run($queue_type = 'all') {
		global $db;
		
		$tables 	=	&singleton::get(__NAMESPACE__ . '\tables');
		$error 		=	&singleton::get(__NAMESPACE__ . '\error');
		$plugins 	=	&singleton::get(__NAMESPACE__ . '\plugins');
		
		$site_id		= SITE_ID;


		$query = "SELECT * FROM $tables->queue WHERE site_id = :site_id";
		
		if ($queue_type != 'all') {
			$query .= " AND type = :type";
		}
		$query .= " ORDER BY id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_STR);
		
		if ($queue_type != 'all') {
			$stmt->bindParam(':type', $queue_type);
		}
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$queue_array = $stmt->fetchAll(database::FETCH_ASSOC);
		
		if (is_array($queue_array)) {
			foreach ($queue_array as $queue) {
				$queue['processed'] = false;
				$queue['data'] = \unserialize(\base64_decode($queue['data']));
				
				//print_r($queue);
				
				$plugins->run('queue_' . $queue['type'], $queue);
				if ($queue['processed']) {
					$this->delete(array('id' => $queue['id']));
				}
				else {
					$this->save($queue);
				}
			}
		}
	}
	
	//save any queue info (only queue_retry at this stage)
	function save($queue) {
		global $db;
		
		$tables 	=	&singleton::get(__NAMESPACE__ . '\tables');
		$error 		=	&singleton::get(__NAMESPACE__ . '\error');
		
		$site_id		= SITE_ID;
		
		$query = "UPDATE $tables->queue SET retry = :retry WHERE id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_STR);
		$stmt->bindParam(':retry', $queue['retry'], database::PARAM_INT);
		$stmt->bindParam(':id', $queue['id'], database::PARAM_INT);
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}

		return true;
	}
}

?>