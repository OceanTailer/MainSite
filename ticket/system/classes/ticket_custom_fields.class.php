<?php
/**
 * 	Ticket Custom Fields Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;


class ticket_custom_fields {

	function add_field($array) {
		global $db;
		
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;
		
		$query = "INSERT INTO $tables->ticket_fields (ticket_field_group_id, site_id";
		
		if (isset($array['value'])) {
			$query .= ", value";
		}

		$query .= ") VALUES (:ticket_field_group_id, :site_id";
		
		if (isset($array['value'])) {
			$query .= ", :value";
		}
		
		$query .= ")";
	
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}

		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);		
		$stmt->bindParam(':ticket_field_group_id', $array['ticket_field_group_id'], database::PARAM_INT);

		if (isset($array['value'])) {
			$stmt->bindParam(':value', $array['value'], database::PARAM_STR);
		}
		
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	
		return $id;		
	}
	
	function edit_field($array) {
		global $db;
		
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;
		
		$query = "UPDATE $tables->ticket_fields SET value = :value";

	
		$query .= " WHERE id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		$stmt->bindParam(':value', $array['value'], database::PARAM_STR);
								
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	}
	
	function get_values($array) {
		global $db;
		
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;

		
		$query = "SELECT * FROM $tables->ticket_field_values WHERE site_id = :site_id";
		
		
		if (isset($array['ticket_field_group_id'])) {
			$query .= " AND ticket_field_group_id = :ticket_field_group_id";
		}
		if (isset($array['ticket_id'])) {
			$query .= " AND ticket_id = :ticket_id";
		}	
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}	
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}

		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		if (isset($array['ticket_field_group_id'])) {
			$stmt->bindParam(':ticket_field_group_id', $array['ticket_field_group_id'], database::PARAM_INT);
		}
		if (isset($array['ticket_id'])) {
			$stmt->bindParam(':ticket_id', $array['ticket_id'], database::PARAM_INT);
		}
		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}	
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$fields = $stmt->fetchAll(database::FETCH_ASSOC);
		
		return $fields;
		
	}
	
	function add_value($array) {
		global $db;
			
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;
				
		$query = "INSERT INTO $tables->ticket_field_values (site_id, ticket_id, ticket_field_group_id, value";
		
	
		
		$query .= ") VALUES (:site_id, :ticket_id, :ticket_field_group_id, :value";
		

		
		$query .= ")";
	
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}

		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);		
		$stmt->bindParam(':ticket_id', $array['ticket_id'], database::PARAM_INT);
		$stmt->bindParam(':ticket_field_group_id', $array['ticket_field_group_id'], database::PARAM_INT);
		$stmt->bindParam(':value', $array['value'], database::PARAM_STR);

		try {
			$stmt->execute();
			$id = $db->lastInsertId();

		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	
		return $id;	
	}
	
	function add_group($array) {
		global $db;
			
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;
	
			
		$query = "INSERT INTO $tables->ticket_field_group (type, site_id";
		
		if (isset($array['name'])) {
			$query .= ", name";
		}
		if (isset($array['client_modify'])) {
			$query .= ", client_modify";
		}
		if (isset($array['enabled'])) {
			$query .= ", enabled";
		}
		if (isset($array['default_field_id'])) {
			$query .= ", default_field_id";
		}
		
		$query .= ") VALUES (:type, :site_id";
		
		if (isset($array['name'])) {
			$query .= ", :name";
		}
		if (isset($array['client_modify'])) {
			$query .= ", :client_modify";
		}
		if (isset($array['enabled'])) {
			$query .= ", :enabled";
		}
		if (isset($array['default_field_id'])) {
			$query .= ", :default_field_id";
		}
		
		$query .= ")";
	
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}

		$stmt->bindParam(':site_id', $site_id, database::PARAM_STR);		
		$stmt->bindParam(':type', $array['type'], database::PARAM_STR);

		if (isset($array['name'])) {
			$stmt->bindParam(':name', $array['name'], database::PARAM_STR);
		}
		if (isset($array['client_modify'])) {
			$stmt->bindParam(':client_modify', $array['client_modify'], database::PARAM_INT);
		}
		if (isset($array['enabled'])) {
			$stmt->bindParam(':enabled', $array['enabled'], database::PARAM_INT);
		}
		if (isset($array['default_field_id'])) {
			$stmt->bindParam(':default_field_id', $array['default_field_id'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
			$id = $db->lastInsertId();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	
		return $id;		
		
	}
	
	function edit_group($array) {
		global $db;
			
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;		
		
		
		$query = "UPDATE $tables->ticket_field_group SET type = :type";

		if (isset($array['name'])) {
			$query .= ", name = :name";
		}
		if (isset($array['client_modify'])) {
			$query .= ", client_modify = :client_modify";
		}
		if (isset($array['enabled'])) {
			$query .= ", enabled = :enabled";
		}
		
		if (isset($array['default_field_id'])) {
			$query .= ", default_field_id = :default_field_id";
		}
		
		$query .= " WHERE id = :id AND site_id = :site_id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}
		
		$stmt->bindParam(':type', $array['type'], database::PARAM_STR);
		$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

		
		if (isset($array['name'])) {
			$stmt->bindParam(':name', $array['name'], database::PARAM_STR);
		}
		if (isset($array['client_modify'])) {
			$stmt->bindParam(':client_modify', $array['client_modify'], database::PARAM_INT);
		}
		if (isset($array['enabled'])) {
			$stmt->bindParam(':enabled', $array['enabled'], database::PARAM_INT);
		}
		if (isset($array['default_field_id'])) {
			$stmt->bindParam(':default_field_id', $array['default_field_id'], database::PARAM_INT);
		}
						
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	}
	

	
	
	function get_groups($array = NULL) {
		global $db;
		
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;
		
		$query = "SELECT * FROM $tables->ticket_field_group WHERE site_id = :site_id";
		
		if (isset($array['client_modify'])) {
			$query .= " AND client_modify = :client_modify";
		}

		if (isset($array['enabled'])) {
			$query .= " AND enabled = :enabled";
		}
		
		if (isset($array['default_field_id'])) {
			$query .= " AND default_field_id = :default_field_id";
		}
		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}	
		
		$query .= " ORDER BY id DESC";

		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}

		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);
		
		if (isset($array['client_modify'])) {
			$stmt->bindParam(':client_modify', $array['client_modify'], database::PARAM_INT);
		}
		if (isset($array['enabled'])) {
			$stmt->bindParam(':enabled', $array['enabled'], database::PARAM_INT);
		}
		if (isset($array['default_field_id'])) {
			$stmt->bindParam(':default_field_id', $array['default_field_id'], database::PARAM_INT);
		}
		if (isset($array['id'])) {
			$stmt->bindParam(':id', $array['id'], database::PARAM_INT);
		}
	
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$fields = $stmt->fetchAll(database::FETCH_ASSOC);
		
		return $fields;
	}
	
	public function get_fields($array = NULL) {
		global $db;
		
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;

		
		$query = "SELECT * FROM $tables->ticket_fields WHERE site_id = :site_id";
		
		if (isset($array['ticket_field_group_id'])) {
			$query .= " AND ticket_field_group_id = :ticket_field_group_id";
		}
		
		$query .= " ORDER BY id";
		
		try {
			$stmt = $db->prepare($query);
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_prepare_error', 'message' => $e->getMessage()));		
		}
		
		$stmt->bindParam(':site_id', $site_id, database::PARAM_INT);

			
		if (isset($array['ticket_field_group_id'])) {
			$stmt->bindParam(':ticket_field_group_id', $array['ticket_field_group_id'], database::PARAM_INT);
		}			
	
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$fields = $stmt->fetchAll(database::FETCH_ASSOC);
		
		return $fields;
	}
	
	function delete_field($array = NULL) {
		global $db;
		
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;
		
		$query = "DELETE FROM $tables->ticket_fields WHERE site_id = :site_id";

		if (isset($array['id'])) {
			$query .= " AND id = :id";
		}
		if (isset($array['ticket_field_group_id'])) {
			$query .= " AND ticket_field_group_id = :ticket_field_group_id";
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
		if (isset($array['ticket_field_group_id'])) {
			$stmt->bindParam(':ticket_field_group_id', $array['ticket_field_group_id'], database::PARAM_INT);
		}
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	}
	
	function delete_group($array = NULL) {
		global $db;
		
		if (!isset($array['id'])) return false;
		
		$error 			= &singleton::get(__NAMESPACE__ . '\error');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
		$tables 		= &singleton::get(__NAMESPACE__ . '\tables');
		$auth 			= &singleton::get(__NAMESPACE__ . '\auth');
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$site_id		= SITE_ID;
		
		$query = "DELETE FROM $tables->ticket_field_values WHERE site_id = :site_id";

		
		if (isset($array['id'])) {
			$query .= " AND ticket_field_group_id = :id";
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
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		
		$query = "DELETE FROM $tables->ticket_fields WHERE site_id = :site_id";

		
		if (isset($array['id'])) {
			$query .= " AND ticket_field_group_id = :id";
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
		
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
		
		$query = "DELETE FROM $tables->ticket_field_group WHERE site_id = :site_id";
		
		if (isset($array['id'])) {
			$query .= " AND id = :id";
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
				
		try {
			$stmt->execute();
		}
		catch (\Exception $e) {
			$error->create(array('type' => 'sql_execute_error', 'message' => $e->getMessage()));
		}
	}
	
}

?>