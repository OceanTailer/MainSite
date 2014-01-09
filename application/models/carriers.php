<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

class Carriers extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function add_new_carrier($data)
	{
		$this->db->insert('shipping_carrier', $data);
		return $this->db->insert_id();
	}

	function delete_carrier($sc_id)
	{
		/*$tables = array('shipping_carrier', 'shipping_carrier_country');*/
		$this->db->delete('shipping_carrier', array('sc_id' => $sc_id));
		$this->db->delete('shipping_carrier_country', array('sc_id' => $sc_id));
	}

	function update_carrier($sc_id, $data)
	{
		$this->db->update('shipping_carrier', $data, array('sc_id' => $sc_id));
	}

	function carrier_info($sc_id)
	{
		$this->db->select('*');
		$this->db->from('shipping_carrier');
		$this->db->where('sc_id', $sc_id);
		$result = $this->db->get();
		return $result->row(1);
	}

	function delete_assign_carrier($scc_id)
	{
		$this->db->delete('shipping_carrier_country', array('scc_id' => $scc_id));
	}
}

/* End of file carriers.php */
/* Location: ./application/models/carriers.php */