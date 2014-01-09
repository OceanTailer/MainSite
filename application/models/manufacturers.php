<?php

class Manufacturers extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

 	function listing($search = "")
	{
		$this->db->select('*');

		if($search != "")
		{
			$this->db->like('m_name',$search, 'after');
		}

		$result = $this->db->get('manufacturer');
		return $result->result(); //return list of manufacturer in db;
	}

	function add($data)
	{
		$this->db->insert('manufacturer', $data);
		return $this->db->insert_id();
	}

	function add_brand($data)
	{
		$this->db->insert('brand', $data);
		return $this->db->insert_id();
	}

	function delete_brand($column,$value)
	{
		$this->db->where($column,$value);
		$this->db->delete('brand');
	}

	function brand_info($id)
	{
		$this->db->select('*');
		$this->db->where('b_id', $id);
		$result = $this->db->get('brand');
		$row = $result->row(1);

		return $row;
	}

	function delete($column,$value)
	{
		$this->db->where($column,$value);
		$this->db->delete('manufacturer');
	}

	function listings_by_product($search_value)
	{

		$this->db->select('manufacturer.m_id, manufacturer.m_name');
        $this->db->select('inventory.i_id');
        $this->db->select('inventory.c_id as cat_id');//c_id conflict with c_id in country 
        $this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');

        $this->load->model('countries');
        $default_country  = $this->countries->default_country();

        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

        $this->db->or_like('ucp_ean', $search_value);

        $this->db->or_like('manuf_num', $search_value);

        $this->db->or_like('tr_title', $search_value);

        $this->db->group_by('manufacturer.m_id');

        $result = $this->db->get('inventory');

        return $result->result();
	}

	function listings_by_priceRange($from,$to)
    {
        $this->db->select('manufacturer.m_id, manufacturer.m_name');
        $this->db->select('inventory.i_id');
        $this->db->select('inventory.c_id as cat_id');//c_id conflict with c_id in country 
        $this->db->join('inventory', 'inventory.i_id = inventory_child.i_id', 'left');
        $this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');

        $this->load->model('countries');
        $default_country  = $this->countries->default_country();

        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

        $this->db->where('ic_price BETWEEN '.$from.' AND '.$to.'');

        $this->db->group_by('manufacturer.m_id');

        $result = $this->db->get('inventory_child');

        return $result->result();
    }

}

?>