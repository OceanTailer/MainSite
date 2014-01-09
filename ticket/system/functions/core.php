<?php
/**
 * 	Dalegroup Framework
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *  Core Functions
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;


/**
 * Class Auto Loader. Allows php class files to be included automatically when constructing a class.
 *
 * @param   string   $class_name The name of the class to be included (excluding .class.php)
 */
function class_auto_load($class_name) {
	//echo $class_name . '<br />';
	
	$class_name = \str_replace(__NAMESPACE__, '', $class_name);
	$class_name = \str_replace('\\', '', $class_name);
	if (file_exists((CLASSES . '/' . $class_name . '.class.php'))) {
		require(CLASSES . '/' . $class_name . '.class.php');
	}
}
/**
 * This function is called at the shutdown of the PHP file.
 * This is currently only used to close the session (and only really needed on buggy versions of PHP)
 *
 */
function shutdown() {
	
	//fixes a bug with certain PHP installs
	session_write_close();
}

/**
 * Returns the UTC date in MySQL datetime format.
 *
 * @param   int   	$add_seconds The number of seconds you wish to add to the returned datetime.
 * @return  string	The UTC datetime value.
 */
function datetime_utc($add_seconds = 0) {
	$base_time = time() + (int) $add_seconds;
	return gmdate('Y-m-d H:i:s', $base_time);
}

/**
 * Returns the date in MySQL datetime format based on the currently set timezone.
 *
 * @param   int   	$add_seconds The number of seconds you wish to add to the returned datetime.
 * @return  string	The datetime value.
 */
function datetime($add_seconds = 0) {
	$base_time = time() + (int) $add_seconds + 3600;
	return date('Y-m-d H:i:s', $base_time);
}

/**
 * Returns the current IP address of connection that requested the PHP file.
 *
 * @return  string	The ip address.
 */
function ip_address() {
	if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
		return $_SERVER['REMOTE_ADDR'];
	}
	else {
		return '';
	}
}

/**
 * Returns a random string.
 *
 * @param   int   	$length 		The length of the random string to return.
 * @param   string  $chars 			The characters included in the random string.
 * @return  string					The random string.
 */
function rand_str($length = 32, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890') {
    // Length of character list
    $chars_length = (strlen($chars) - 1);

    // Start our string
    $string = $chars{rand(0, $chars_length)};
   
    // Generate random string
    for ($i = 1; $i < $length; $i = strlen($string))
    {
        // Grab a random character from our list
        $r = $chars{rand(0, $chars_length)};
       
        // Make sure the same two characters don't appear next to each other
        if ($r != $string{$i - 1}) $string .=  $r;
    }
   
    // Return the string
    return $string;
}

/**
 * Decodes a string that was encrypted using the global encryption key
 *
 * @param   string  $string 		The encrypted string
 * @return  string					The clear text string
 */
function decode($string) {
	$config 	= &singleton::get(__NAMESPACE__ . '\config');
	$key 		= $config->get('encryption_key');
	$decrypted 	= rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");

	return $decrypted;
}

/**
 * Encodes a string using the global encryption key
 *
 * @param   string  $string 		The cleart text string
 * @return  string					The encrypted string
 */
function encode($string) {
	$config 	= &singleton::get(__NAMESPACE__ . '\config');
	$key 		= $config->get('encryption_key');
	$encrypted 	= base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
	
	return $encrypted;
}

/**
 * Returns the next and previous page.
 *
 * Form the array like this:
 * <code>
 * $array = array(
 *   'page'    => 1,       // the current page
 *   'limit'   => 100,     // the number of items on a page
 * );
 * 
 * </code>
 *
 * @param   array   $array 			The array explained above
 * @return  array					The returned array.
 */
function paging_start($array) {

	$return_array	= array();

	$page 	= (int) $array['page'];
	$limit	= (int) $array['limit'];
	
	$offset = $page * $limit - $limit;
	
	if ($offset < 0) {
		$offset = 0;
	}
	
	$return_array['offset'] = (int) $offset;
	
	$return_array['next_page'] = $page + 1;
	
	$return_array['previous_page'] = $page - 1;
	
	if ($return_array['previous_page'] < 1) {
		$return_array['previous_page'] = 1;
	}
	if ($return_array['next_page'] < 1) {
		$return_array['next_page'] = 1;
	}
	return $return_array;
}

function paging_finish($array) {
	if ($array['events'] < (int) $array['limit']) {
		$array['next_page'] = $array['next_page'] - 1;
	}
	return $array;
}

/**
 * Returns the user agent for use when calling external web sites and services
 *
 * @return  string					The user agent (i.e. Dalegroup STS/1.1)
 */
function user_agent() {
	$config 	= &singleton::get(__NAMESPACE__ . '\config');

	$program_version	= $config->get('program_version');

	return 'Dalegroup STS/' . $program_version;
}

/**
 * Checks to see if an email address is valid
 *
 * @param   string  $email 			The email address
 * @return  bool					TRUE if the email is value or FALSE if it is not valid
 */
function check_email_address($email) {
	
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		return true;
	}
	else {
		return false;
	}
}

/**
 * Start the timer, works out page generation time
 *
 */
function start_timer() {
	global $sts_tstart;
	
	$sts_tstart = microtime(true);

	return true;	
}

/**
 * Returns the time it took for generation. 
 *
 * @param   int 	$accuracy 		Level of accuracy
 * @return  string					The time past since calling start_timer()
 */
function stop_timer($accuracy = 4) {
	global $sts_tstart;
	
	//fixes rando windows bug??
	$tend = microtime(true);
	$tend = microtime(true);
	
	$totaltime = number_format($tend - $sts_tstart, $accuracy);
	
	return $totaltime;
}

/**
 * Removes slashes from a value. This will remove slashes from an array too.
 *
 * @param   array  $array 			The array of values to strip
 * @return  array					The stripped array.
 */
function remove_magic_quotes($array) {

	foreach ($array as $key => $value) {
		if (is_array($value)) {
			$array[$key] = remove_magic_quotes($value);
		}
		else {
			$array[$key] = stripslashes($value);
		}
	}

	return $array;
}

/**
 * Sets register_globals off
 *
 */ 
function unregister_globals() {
	if (!ini_get('register_globals')) {
		return true;
	}

	// Might want to change this perhaps to a nicer error
	if (isset($_REQUEST['GLOBALS']) || isset($_FILES['GLOBALS'])) {
		die('GLOBALS overwrite attempt detected.');
	}

	// Variables that shouldn't be unset
	$noUnset = array('GLOBALS',  '_GET',
		'_POST',    '_COOKIE',
		'_REQUEST', '_SERVER',
		'_ENV',    '_FILES');

	$input = array_merge($_GET,    $_POST,
	$_COOKIE, $_SERVER,
	$_ENV,    $_FILES,
	
	isset($_SESSION) && is_array($_SESSION) ? $_SESSION : array());

	foreach ($input as $k => $v) {
		if (!in_array($k, $noUnset) && isset($GLOBALS[$k])) {
			unset($GLOBALS[$k]);
		}
	}

	return true;
}

/**
 * Removes the last x number of days
 *
 * @param   int  $days 			The number of days to return
 * @return  array				The array of dates
 */
function last_x_days($days = 7) {
	
	$array = array();
	for($i = $days - 1; $i >= 0; $i--) {
		$array[] = date("Y-m-d", strtotime('-'. (int) $i .' day', strtotime(datetime())));
	}
	return $array;
}

/**
 * Removes the last x number of months
 *
 * @param   int  $months 		The number of months to return
 * @return  array				The array of dates
 */
function last_x_months($months = 6) {
	
	$array = array();
	for($i = $months - 1; $i >= 0; $i--) {
		$array[] = date("Y-m", strtotime('-'. (int) $i .' month', strtotime(datetime())));
	}
	return $array;
}

/**
 * Checks a submitted date matches Y-m-d H:i
 *
 * @param   string $data 		The date to test
 * @return  bool				TRUE or FALSE
 */
function check_datetime($data) {
    if (date('Y-m-d H:i', strtotime($data)) == $data) {
        return true;
    } else {
        return false;
    }
}

/**
 * Formats a date into a human readable style
 *
 * @param   string $data 		The date to format
 * @return  string				The date in a nice format :)
 */
function nice_date($date) {
	return date("D M d, Y", strtotime($date));
}

/**
 * Formats a date and time into a human readable style
 *
 * @param   string $data 		The datetime to format
 * @return  string				The date in a nice format :)
 */
function nice_datetime($date) {
	return date("D M d, Y, h:i A", strtotime($date));
}


/**
 * Returns a UUID
 *
 */
function uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),	

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 4
        mt_rand( 0, 0x0fff ) | 0x4000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}


/**
 * Returns the timezones supported in PHP
 *
 * @return  array		The timezones in an array
 */
function get_timezones() {
	
	$tzlist = \DateTimeZone::listIdentifiers();
	
	return $tzlist;
}

/**
 * Adds an s to the end of a string if count is greater than 1
 *
 * @param   int 	$count 		The count
 * @param   string 	$text 		The text to add s to if needed
 * @return  string				The returned text
 */
function pluralize($count, $text) { 
    return $count . ( ( $count == 1 ) ? ( " $text" ) : ( " ${text}s" ) );
}

/**
 * Time ago that the datetime occurred
 *
 */
function ago($datetime) {

    $interval = date_create(datetime())->diff($datetime);		

    if ( $v = $interval->y >= 1 ) return pluralize( $interval->y, 'year' );
    if ( $v = $interval->m >= 1 ) return pluralize( $interval->m, 'month' );
    if ( $v = $interval->d >= 1 ) return pluralize( $interval->d, 'day' );
    if ( $v = $interval->h >= 1 ) return pluralize( $interval->h, 'hour' );
    if ( $v = $interval->i >= 1 ) return pluralize( $interval->i, 'minute' );
	
    return pluralize( $interval->s, 'second' );
}

function convert_encoding($string, $encoding = NULL) {

	if (isset($encoding) && !empty($encoding)) {
		$return = mb_convert_encoding($string, 'UTF-8', $encoding);
	}
	else {
		$return = mb_convert_encoding($string, 'UTF-8', 'UTF-8');
	}
	
	return $return;
}

?>