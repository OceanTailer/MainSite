<?php	
//sets the namespace for PHP to file the corect classes etc
namespace sts;
exit;

set_time_limit(0);

//get the directory root info
define(__NAMESPACE__ . '\ROOT', __DIR__ . '/../..');
define(__NAMESPACE__ . '\SYSTEM', ROOT . '/system');

//loader does all the important startup stuff
require(SYSTEM . '/loader.php');

$users_count = $users->count();

if ($users_count === 0) {

	/*
		Finish DB Setup
	*/
			
	$stmt = $db->prepare("INSERT INTO `ticket_priorities` (`name`, `enabled`, `site_id`) VALUES
		('Low', 1, 1),
		('Medium', 1, 1),
		('High', 1, 1)
	");

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		die($e->getMessage());
	}
	
	$stmt = $db->prepare("INSERT INTO `ticket_status` (`name`, `enabled`, `active`, `colour`, `site_id`) VALUES
		('Open', 1, 1, 'e93e3e', 1),
		('Closed', 1, 0, '71c255', 1)
	");

	try {
		$stmt->execute();
	}
	catch (Exception $e) {
		die($e->getMessage());
	}
		
	
	

	$qt_config['db_hostname']	= 'localhost';
	$qt_config['db_username']	= 'root';
	$qt_config['db_password']	= '';
	$qt_config['db_name']		= 'quicktick_pcp';
	$qt_config['db_prefix']		= '';
	$qt_config['admin_id']		= 1;
	
	$qt_tables 					= new \stdClass();
	$qt_tables->users 			= $qt_config['db_prefix'] . 'users';
	$qt_tables->departments 	= $qt_config['db_prefix'] . 'departments';
	$qt_tables->tickets 		= $qt_config['db_prefix'] . 'tickets';

	
	$qt_db = new \PDO(
			'mysql:host=' . $qt_config['db_hostname'] . ';dbname=' . $qt_config['db_name'], $qt_config['db_username'], $qt_config['db_password']
		);

	$qt_db->exec('SET NAMES UTF8');

	$qt_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	$qt_db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
	
	echo '<p>Okay! Starting Import</p>';
	
	$query = "SELECT * FROM $qt_tables->users";

	$stmt = $qt_db->prepare($query);
	$stmt->execute();
	$qt_users = $stmt->fetchAll(database::FETCH_ASSOC);

	echo '<p>Adding Users</p>';
	
	$i = 0;
	foreach ($qt_users as $item) {
	
		if (!empty($item['email'])) {
			$i++;
			$password = rand_str(8);
		
			$add_array =
				array(
					'id'				=> $item['ID'],
					'name' 				=> $item['fname'] . ' ' . $item['lname'],
					'authentication_id' => 1,
					'allow_login'		=> 1,
					'username'			=> $item['email'],
					'email'				=> $item['email'],
					'password'			=> $password
				);
			
			//admin or sub
			if ($item['type'] == 1) {
				$add_array['user_level']	= 2;
				$type = 'admin';
			}
			else {
				$add_array['user_level']	= 1;	
				$type = 'sub';
			}
			
			//email notifications
			if ($item['receive'] == 1) {
				$add_array['email_notifications']	= 1;
			}
			else {
				$add_array['email_notifications']	= 0;	
			}

			$users->add($add_array);
			echo '<p>Username: ' . $item['email'] . ', Password: ' . $password . ', Type: ' . $type . '</p>';
			unset($add_array);
		}
	}
	
	echo '<p>Finished Adding Users: ' . (int) $i . '</p>';
	
	/*
		Departments
	*/
	$query = "SELECT * FROM $qt_tables->departments";

	$stmt = $qt_db->prepare($query);
	$stmt->execute();
	$qt_departments = $stmt->fetchAll(database::FETCH_ASSOC);

	echo '<p>Adding Departments</p>';
	
	foreach ($qt_departments as $item) {
		$add_array['id']				= $item['ID'];
		$add_array['name']				= $item['name'];
		$add_array['enabled']			= 1;
		$add_array['public_view'] 		= 0;
			
		$ticket_departments->add($add_array);
		unset($add_array);
	}

	echo '<p>Finished Adding Departments: ' . count($qt_departments) . '</p>';
	
		
	/*
		Ticket Notes
	*/
	$query = "SELECT * FROM $qt_tables->tickets WHERE parent != 0 AND status != 'Internal'";

	$stmt = $qt_db->prepare($query);
	$stmt->execute();
	$qt_ticket_notes = $stmt->fetchAll(database::FETCH_ASSOC);
	
	echo '<p>Adding Ticket Notes</p>';

	foreach ($qt_ticket_notes as $item) {
		$add_array = 
			array(
				'id'				=> $item['ID'],
				'description'		=> $item['subject'] . "\n\n" . $item['body'],
				'date_added'		=> $item['created'],
				'user_id'			=> $item['by'],
				'ticket_id'			=> $item['parent']
			);

		$add_array['html'] 		= 0;

		$ticket_notes->add($add_array);
		unset($add_array);
	}
	
	echo '<p>Finished Adding Ticket Notes: ' . count($qt_ticket_notes) . '</p>';
	
	/*
		Tickets
	*/
	$query = "SELECT * FROM $qt_tables->tickets WHERE parent = 0";

	$stmt = $qt_db->prepare($query);
	$stmt->execute();
	$qt_tickets = $stmt->fetchAll(database::FETCH_ASSOC);
	
	echo '<p>Adding Tickets</p>';

	foreach ($qt_tickets as $item) {
		$add_array = 
			array(
				'id'				=> $item['ID'],
				'subject'			=> $item['subject'],
				'description'		=> $item['body'],
				'date_added'		=> $item['created'],
				'last_modified'		=> $item['modified'],
				'priority_id'		=> 1,
				'department_id'		=> $item['DEPARTMENT_ID'],
				'user_id'			=> $item['by']
			);

		$add_array['html'] 		= 0;
		
		/*
			Priority
		*/
		if ($item['priority'] == 'Low') {
			$add_array['priority_id'] = 1;
		}
		else if ($item['priority'] == 'Normal') {
			$add_array['priority_id'] = 2;
		}
		else if ($item['priority'] == 'High') {
			$add_array['priority_id'] = 3;
		}
		
		/*
			State
		*/
		if ($item['status'] == 'Resolved') {
			$add_array['state_id'] = 2;
		}	

		$tickets->add($add_array);
		unset($add_array);
	}
	
	echo '<p>Finished Adding Tickets: ' . count($qt_tickets) . '</p>';
	
	/*
		Empty Queue
	*/
	$query = "DELETE FROM $tables->queue WHERE site_id = 1";

	$stmt = $db->prepare($query);
	$stmt->execute();
	
	
	echo '<p>Migrate has been completed.</p>';

}
else {
	echo 'This does not look like a prep-db, not going to do anything else.';
	exit;
}

/*

*/

?>