<?php

class Banks extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function get($bnk_id)
	{
		$this->db->select('*');
		$this->db->where('bnk_id', $bnk_id);
		$result = $this->db->get('bank_account')->result();
		return $result[0]; 
	}

	function get_default_bank($u_id)
	{
		$this->db->select('*');
		$this->db->where('u_id', $u_id);
		$result = $this->db->get('bank_account')->result();
		return $result[0]; 
	}



}

?>