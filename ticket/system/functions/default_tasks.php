<?php
/**
 * 	Support Tickets
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *  This file is used to schedule built in cron tasks and to hook into the plugin system.
 *
 * @package     tickets
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

//update checker
$plugins->add(
	array(
		'plugin_name'	=> PLUGIN_NAME,
		'task_name'		=> __NAMESPACE__ . '\update_check',
		'section'		=> 'cron_every_day',
		'method'		=> array($cron, 'update_check')
	)
);

//Hook into the queue for email
$plugins->add(
	array(
		'plugin_name'	=> PLUGIN_NAME,
		'task_name'		=> __NAMESPACE__ . '\email_queue_hook',
		'section'		=> 'queue_email',
		'method'		=> array($mailer, 'process_email_queue')
	)
);

//Hook into the queue for pushover
$plugins->add(
	array(
		'plugin_name'	=> PLUGIN_NAME,
		'task_name'		=> __NAMESPACE__ . '\pushover_queue_hook',
		'section'		=> 'queue_pushover',
		'method'		=> array($pushover, 'process_queue')
	)
);


//POP3 download
$plugins->add(
	array(
		'plugin_name'	=> PLUGIN_NAME,
		'task_name'		=> __NAMESPACE__ . '\pop3_download',
		'section'		=> 'cron_every_five_minutes',
		'method'		=> array($pop_system, 'download')
	)
);	


//Run email queue every 5 minutes			
$plugins->add(
	array(
		'plugin_name'	=> PLUGIN_NAME,
		'task_name'		=> __NAMESPACE__ . '\send_email',
		'section'		=> 'cron_every_five_minutes',
		'method'		=> array($mailer, 'run_queue')
	)
);

//Run pushover queue every 5 minutes			
$plugins->add(
	array(
		'plugin_name'	=> PLUGIN_NAME,
		'task_name'		=> __NAMESPACE__ . '\send_pushover',
		'section'		=> 'cron_every_five_minutes',
		'method'		=> array($pushover, 'run_queue')
	)
);


//session garbage collection 
$plugins->add(
	array(
		'plugin_name'	=> PLUGIN_NAME,
		'task_name'		=> __NAMESPACE__ . '\session_gc',
		'section'		=> 'cron_every_hour',
		'method'		=> array($session, 'gc')
	)
);

//db maintenance
$plugins->add(
	array(
		'plugin_name'	=> PLUGIN_NAME,
		'task_name'		=> __NAMESPACE__ . '\optimise_tables',
		'section'		=> 'cron_every_month',
		'method'		=> array($db_maintenance, 'optimise_tables')
	)
);

//log prune 
$plugins->add(
	array(
		'plugin_name'	=> PLUGIN_NAME,
		'task_name'		=> __NAMESPACE__ . '\logs_prune',
		'section'		=> 'cron_every_week',
		'method'		=> array($log, 'prune')
	)
);
?>