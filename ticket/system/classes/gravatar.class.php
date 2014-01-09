<?php
/**
 * 	Gravatar Class
 *	Copyright Dalegroup Pty Ltd 2012
 *	support@dalegroup.net
 *
 *
 * @package     dgx
 * @author      Michael Dale <mdale@dalegroup.net>
 */
 
namespace sts;

class gravatar {

	private $email;
	private $baseUrl;
	
	function __construct() {
		$this->baseUrl = 'https://secure.gravatar.com/avatar/';
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return $this->email;
	}
	public function clearEmail() {
		$this->email = '';
	}
	
	public function getUrl() {	
		$url = $this->baseUrl;
		$url .= md5($this->getEmail());
		$url .= '?';
		$url .= 's=' . 55;
		$url .= '&amp;';
		$url .= 'd=' . 'mm';
		$url .= '&amp;';
		$url .= 'r=' . 'g';			

		
		return $url;
	}
	
}

?>