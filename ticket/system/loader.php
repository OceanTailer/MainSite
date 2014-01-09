<?php
/**
 * 	Support Tickets
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     tickets
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

if (!class_exists('\PDO')) die('This program requires the PHP MySQL PDO database class to run.');

/**
 *
 * Folder location variables
 *
 */
define(__NAMESPACE__ . '\CLASSES', 		SYSTEM 	. '/classes');
define(__NAMESPACE__ . '\USER', 		ROOT 	. '/user');
define(__NAMESPACE__ . '\THEMES', 		USER 	. '/themes');
define(__NAMESPACE__ . '\SETTINGS', 	USER 	. '/settings');
define(__NAMESPACE__ . '\FUNCTIONS', 	SYSTEM 	. '/functions');
define(__NAMESPACE__ . '\LIB', 			SYSTEM 	. '/libraries');

/**
 *
 * Other variables
 *
 */
define(__NAMESPACE__ . '\PLUGIN_NAME', 		'STSCore');


require(FUNCTIONS . '/core.php');

start_timer();

//register_globals off
unregister_globals();

if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
	$_POST = remove_magic_quotes($_POST);
	$_GET = remove_magic_quotes($_GET);
	$_COOKIE = remove_magic_quotes($_COOKIE);
	$_SERVER = remove_magic_quotes($_SERVER);
}

register_shutdown_function(__NAMESPACE__  . '\shutdown');
spl_autoload_register(__NAMESPACE__ . '\class_auto_load');

require(FUNCTIONS . '/html.php');

$error		= &singleton::get(__NAMESPACE__  . '\error');

try {
	if (!file_exists(SETTINGS . '/config.php')) {
		throw new \Exception('The config file could not be found.');
	}
	else {
		require(SETTINGS . '/config.php');
	}
}
catch (\Exception $e) {
	echo 'The config file "user/settings/config.php" could not be found. Please run the <a href="install/">installer</a>.';
	$error->create(array('type' => 'file_not_found', 'message' => $e->getMessage()));
}

define(__NAMESPACE__ . '\SITE_ID', (int) $config['site_id']);

//start database connection here
$db = new database($config['database_hostname'], $config['database_name'], $config['database_username'], $config['database_password'], $config['database_type'], $config['database_charset']);
$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);

//tables
$tables			= &singleton::get(__NAMESPACE__ . '\tables', $config['database_table_prefix']);

//active directory class
include(LIB . '/adldap/adLDAP.php');

//phpmailer class
include(LIB . '/phpmailer/class.phpmailer.php');

//auth
$auth			= &singleton::get(__NAMESPACE__ . '\auth');

try {
	if (!isset($config['salt']) || (empty($config['salt']))) {
		throw new \Exception('The salt config value could not be found.');
	}
	else {
		$auth->set_salt($config['salt']);
	}
}
catch (\Exception $e) {
	$error->create(array('type' => 'security_error', 'message' => $e->getMessage()));
}

//unset database details
unset($config);

define(__NAMESPACE__ . '\SEC_DB_LOADED', true);

//demo mode
if (!defined(__NAMESPACE__ . '\DEMO_MODE')) define(__NAMESPACE__ . '\DEMO_MODE', false);

//config
$config 			= &singleton::get(__NAMESPACE__ . '\config');

//set timezone
if ($config->get('default_timezone')) {
	date_default_timezone_set($config->get('default_timezone'));
}
else {
	date_default_timezone_set('Australia/Sydney');
}

//set theme
if ($config->get('default_theme')) {
	define(__NAMESPACE__ . '\CURRENT_THEME', $config->get('default_theme'));
}
else {
	define(__NAMESPACE__ . '\CURRENT_THEME', 'standard');
}

/**
 *
 * The following sets up all the classes that will be required to run the application.
 * The singleton allows classes to be called from within functions and methods without the use of global variables.
 *
 */

//language
$language			= &singleton::get(__NAMESPACE__ . '\language');

//sessions
$session 			= &singleton::get(__NAMESPACE__ . '\sessions', array('database' => $db, 'table_name' => $tables->sessions));

//log
$log				= &singleton::get(__NAMESPACE__ . '\log');

//site
$site				= &singleton::get(__NAMESPACE__ . '\site');

//users
$users				= &singleton::get(__NAMESPACE__ . '\users');

//tickets
$tickets			= &singleton::get(__NAMESPACE__ . '\tickets');

//ticket priorities
$ticket_priorities	= &singleton::get(__NAMESPACE__ . '\ticket_priorities');

//ticket status
$ticket_status		= &singleton::get(__NAMESPACE__ . '\ticket_status');

//ticket departments
$ticket_departments	= &singleton::get(__NAMESPACE__ . '\ticket_departments');

//tickets support
$tickets_support	= &singleton::get(__NAMESPACE__ . '\tickets_support');

//ticket notes
$ticket_notes		= &singleton::get(__NAMESPACE__ . '\ticket_notes');

//queue
$queue				= &singleton::get(__NAMESPACE__ . '\queue');

//cron system
$cron				= &singleton::get(__NAMESPACE__ . '\cron');

//mailer
$mailer				= &singleton::get(__NAMESPACE__ . '\mailer');

//plugins
$plugins			= &singleton::get(__NAMESPACE__ . '\plugins');

//gravatar
$gravatar			= &singleton::get(__NAMESPACE__ . '\gravatar');

//pop_system
$smtp_accounts		= &singleton::get(__NAMESPACE__ . '\smtp_accounts');

//pop_system
$pop_accounts		= &singleton::get(__NAMESPACE__ . '\pop_accounts');

//pop_system
$pop_system			= &singleton::get(__NAMESPACE__ . '\pop_system');

//pop_system
$storage			= &singleton::get(__NAMESPACE__ . '\storage');

//captcha
$captcha			= &singleton::get(__NAMESPACE__ . '\captcha');

//messages
$messages			= &singleton::get(__NAMESPACE__ . '\messages');

//message_notes
$message_notes		= &singleton::get(__NAMESPACE__ . '\message_notes');

//message_notes
$ticket_custom_fields		= &singleton::get(__NAMESPACE__ . '\ticket_custom_fields');

//pushover
$pushover					= &singleton::get(__NAMESPACE__ . '\pushover');

//users_to_departments
$users_to_departments		= &singleton::get(__NAMESPACE__ . '\users_to_departments');

//db_maintenance
$db_maintenance				= &singleton::get(__NAMESPACE__ . '\db_maintenance');


require(FUNCTIONS . '/default_tasks.php');


/**
 *
 * URL Handling Code. Everything is redirected with the .htaccess file to index.php?url=
 *
 */
if (isset($_GET['url'])) {
	$input_url = $_GET['url'];
}
else {
	$input_url = '';
}

$url			= &singleton::get(__NAMESPACE__ . '\url', array('url' => $input_url));

unset($input_url);

$auth->load();

//html purifier
include(LIB . '/htmlpurifier/HTMLPurifier.auto.php');

$htmlpurifier_config = \HTMLPurifier_Config::createDefault();

//default html is set to XHTML 1.1
//$htmlpurifier_config->set('Core.Encoding', 'XHTML 1.1');

//create the class we are going to use.
$purifier	= &singleton::get('HTMLPurifier', $htmlpurifier_config);

$plugins->load();

$plugins->run('loader');
?>