<?php

class Countries extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function listing_country()
    {
        $this->db->select('*');
        $result = $this->db->get('country');
        return $result->result();
    }

    function country_info($c_id)
    {
        $this->db->select('*');
        $this->db->where('c_id', $c_id);
        $result = $this->db->get('country');

        if($result->num_rows() == 1)
            return $result->row(1);
        else
            return false;

    }


    function default_country()
    {
        return 236;
    }

    function states($id = '')
    {
        $this->db->select('*');
        if($id != '')
            $this->db->where('c_id', $id);

        $result = $this->db->get('state');

        return $result->result();
    }

    function carrier_info($sc_id)
    {
        $this->db->select('*');
        $this->db->where('sc_id', $sc_id);
        $this->db->from('shipping_carrier');
        $result = $this->db->get();

        if($result->num_rows() == 1)
            return $result->row(1);
        else
            return false;
    }

    function assigned_carrier_contry_list($sc_id)
    {
        $this->db->select('*');
        $this->db->where('sc_id', $sc_id);
        $this->db->join('country', 'country.c_id = shipping_carrier_country.country_id', 'left');
        $result = $this->db->get('shipping_carrier_country');


        return $result->result();
    }

}

?>