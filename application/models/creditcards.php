<?php

class creditcards extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function listing($id = "",$name = "")
	{
		$this->db->select('*');
		if($id != "")
			$this->db->where('cc_id', $id);

		if($name != "");
			$this->db->like('cc_type', $name, 'after');

		$result = $this->db->get('credit_card');

		return $result->result();
	}

	function generate_months($type='',$default = '')
	{
		$element = "";
		if($type == 'option')
		{

			for($m = 1;$m <= 12; $m++){ 
			 $month =  date("F", mktime(0, 0, 0, $m));
			 if($default == $m)
			 	 $element  .= "<option selected='selected' value='".$m."'>".$month."</option>";
			 else
				 $element  .= "<option value='".$m."'>".$month."</option>";
			}
								
		}

		return $element;
	}

	function generate_years($to = "",$from = 1980, $default)
	{
		if($to == "")
			$to = date('Y'); //current year
		for($to = $to; $to >= $from; $to--){ 
			if($default == $to)
				$element  .= "<option selected='selected' value='".$to."'>".$to."</option>";
			else
		 		$element  .= "<option value='".$to."'>".$to."</option>";
		}

		return $element;
	}

	// Lanz Editted - June 6, 2013
	function creditcardinfo($ccu_id)
	{
		$this->db->select("*");
		$this->db->from("credit_card_user");
		$this->db->join("credit_card", "credit_card.cc_id = credit_card_user.cc_id");
		$this->db->where("ccu_id", $ccu_id);

		$result = $this->db->get();
		$row = $result->row(1);
		return $row;
	}
	
}

?>