<?php
/**
 * 	Plugins Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */

namespace sts;

class plugins {
	var $tasks 				= NULL;
	var $plugins_folder 	= NULL;
	var $installed_plugins 	= array();
	var $loaded_plugins		= array();
	
	function __construct() {
		$config 		= &singleton::get(__NAMESPACE__ . '\config');

		$this->plugins_folder 		= USER . '/plugins/';
		$this->installed_plugins 	= $config->get('plugin_data');

	}

	/**
	 * Adds a hook into the system.
	 *
	 * Form the array like this:
	 * <code>
	 * $array = array(
	 *	'plugin_name'	=> 	__CLASS__,						//The name of the plugin. If calling from a class simply use __CLASS__
	 *	'task_name'		=> __CLASS__ . 'section_name',		//The unique name of the hook/task
	 *	'section'		=> 'section_name',					//The section where the hook will be called in the system
	 *	'method'		=> array($this, 'section_name')		//The method or function name that will be called when the section occurs.
	 * );
	 * </code>
	 *
	 * @param   array   $array 		The array explained above
	 */
	public function add($array) {
		
		$name 			= $array['plugin_name'];
		$task_name 		= $array['task_name'];

		$section 		= $array['section'];
		$method 		= $array['method'];
		
		
		$priority			= 10;
		if (isset($array['priority'])) {
			$priority 		= (int) $array['priority'];
		}
		
		$arguments			= 1;
		if (isset($array['arguments'])) {
			$arguments 		= $array['arguments'];
		}
		
		$this->tasks[$section][$priority][$task_name] = array(
			'name'			=> $name,
			'arguments'		=> $arguments,
			'method'		=> $method
			
		);
						
		return true;
		
		
	}
	
	public function remove($section, $task, $priority = 10) {
		
		unset($this->tasks[$section][$priority][$task]);
		
		return true;
	}
	
	public function run($section, &$args = '') {

		if (!isset($this->tasks[$section])) return false;

		//sorts based on priority, 1 being the highest (first run)
		ksort($this->tasks[$section], SORT_NUMERIC);
		
		//call_user_func_array requires an array
		$arguments = array(&$args);
		
		foreach($this->tasks[$section] as $priority => $functions) {
			foreach($this->tasks[$section][$priority] as $task => $task_details) {
				
				//echo $task;
				//print_r($task_details);
				//exit;
				
				if (is_array($task_details['method'])) {
					//class call
					call_user_func_array(array($task_details['method'][0], $task_details['method'][1]), $arguments);
				}
				else {	
					//function call
					
					//echo '<p>call: ' . $function . '</p>';
					if (!function_exists($task_details['method'])) {
						continue;
					}
					call_user_func_array($task_details['method'], $arguments);
				}
			}
		}
	
		return true;
	}
	
	function load() {	
		if (!empty($this->installed_plugins)) {
			foreach($this->installed_plugins as $name) {
				if (file_exists($this->plugins_folder . $name . '.plugin.php')) {
					
					$array = explode('.', basename($this->plugins_folder . $name . '.plugin.php'));					
					
					$class = __NAMESPACE__ . '\\plugins\\' . $array[0];
					
					if (!class_exists($class)) {
						include($this->plugins_folder . $name . '.plugin.php');
						if (class_exists($class)) {
							$this->loaded_plugins[$name] = new $class;
							if (method_exists($this->loaded_plugins[$name], 'load')) {
								$this->loaded_plugins[$name]->load();
							}
						}
					}
				}
			}
		}	
	}
	
	function loaded($plugin_name) {
		if (!empty($plugin_name)) {
			if (array_key_exists($plugin_name, $this->loaded_plugins)) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}

	function get() {
		
		$plugin_info = array();
		$plugin_info_temp = array();

		if (is_dir($this->plugins_folder)) {
			$plugin_folders[] = '';
			$folder = opendir($this->plugins_folder);
			while (false !== ($dir_array = readdir($folder))) {
				if ($dir_array != '.' && $dir_array != '..') {
					if(is_dir($this->plugins_folder . $dir_array)) {
						if ($this->sanitize_plugin_name($dir_array) == $dir_array) {
							$plugin_folders[] = $dir_array . '/';
						}
					}
				}
			}
			closedir($folder);
		}
		
		foreach($plugin_folders as $plugin_folder) {			
			$plugin_folder_full = $this->plugins_folder . $plugin_folder;
			if (is_dir($plugin_folder_full)) {
				$folder = opendir($plugin_folder_full);
				while (false !== ($file_array = readdir($folder))) {
					if ($file_array != '.' && $file_array != '..') {
						if(filetype($plugin_folder_full . $file_array) == 'file') {
							if(preg_match("/^([a-z0-9_\/]+).plugin.php$/", $file_array, $matches) > 0){

								$plugin_info[$matches[1]] =
									array (
										'file_name' => $plugin_folder . $matches[1],
										'name' => $matches[1],
										'description' => '',
										'update_check_url' => '',
										'author' => '',
										'author_website' => '',
										'website' => '',
										'version' => ''
									);
								
							
								if (!in_array($plugin_folder . $matches[1], $this->installed_plugins)) {
									include($plugin_folder_full . $matches[1] . '.plugin.php');
								}

								$class = __NAMESPACE__ . '\\plugins\\' . $matches[1];
								
								if (class_exists($class)) {	
									$plugin_info_temp[$matches[1]] = new $class;
									if (method_exists($plugin_info_temp[$matches[1]], 'meta_data')) {
										$plugin_info[$matches[1]] = array_merge($plugin_info[$matches[1]], $plugin_info_temp[$matches[1]]->meta_data());
										$plugin_info[$matches[1]]['file_name'] = $plugin_folder . $matches[1];
									}
								}	
							}
						}
					}
				}
				closedir($folder);
			}
		}
		
		ksort($plugin_info);
		
		return $plugin_info;
	}
	
	function enable($plugin_name) {
		
		$config 		= &singleton::get(__NAMESPACE__ . '\config');
		$log			= &singleton::get(__NAMESPACE__ . '\log');

		$plugin_name = $this->sanitize_plugin_name($plugin_name);
		if (!empty($plugin_name)) {
			if (!in_array($plugin_name, $this->installed_plugins)) {
				$this->installed_plugins[] = $plugin_name;

				$log_array['event_severity'] = 'notice';
				$log_array['event_number'] = E_USER_NOTICE;
				$log_array['event_description'] = 'Plugin Enabled "' . $plugin_name . '"';
				$log_array['event_file'] = __FILE__;
				$log_array['event_file_line'] = __LINE__;
				$log_array['event_type'] = 'enable';
				$log_array['event_source'] = 'plugins';
				$log_array['event_version'] = '1';
				$log_array['log_backtrace'] = false;			
				$log->add($log_array);	
				
				$config->set('plugin_data', $this->installed_plugins);
			}
		}
		
	}
	
	function disable($plugin_name) {
	
		$config 		= &singleton::get(__NAMESPACE__ . '\config');
		$log			= &singleton::get(__NAMESPACE__ . '\log');
	
		if (in_array($plugin_name, $this->installed_plugins)) {
			$key = array_search($plugin_name, $this->installed_plugins);
			unset($this->installed_plugins[$key]);
			$this->installed_plugins = array_values($this->installed_plugins);

			$log_array['event_severity'] = 'notice';
			$log_array['event_number'] = E_USER_NOTICE;
			$log_array['event_description'] = 'Plugin Disabled "' . $plugin_name . '"';
			$log_array['event_file'] = __FILE__;
			$log_array['event_file_line'] = __LINE__;
			$log_array['event_type'] = 'disable';
			$log_array['event_source'] = 'plugins';
			$log_array['event_version'] = '1';
			$log_array['log_backtrace'] = false;			
			$log->add($log_array);	
				
			$config->set('plugin_data', $this->installed_plugins);

		}
		
	}
	
	function sanitize_plugin_name($plugin_name) {
		$plugin_name = strtolower($plugin_name);
		$plugin_name = preg_replace('([^0-9a-z_\/])', '', $plugin_name);
		return $plugin_name;
	}	
	
	function plugin_basename($file) {
		$file = str_replace('\\','/',$file); // sanitize for Win32 installs
		$file = preg_replace('|/+|','/', $file); // remove any duplicate slash
		$file = preg_replace('|^.*' . '/plugins' . '/|','',$file); // get relative path from plugins dir
		return $file;
	}
	
	function plugin_base_url($file) {
		$file = $this->plugin_basename($file);
		$file = str_replace('.plugin.php','',$file);
		return $file;
	}
	
}

?>