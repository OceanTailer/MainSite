<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

// Lanz Editted - June 10, 2012
class administrators extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	function addnewuser($data)
	{
		$this->db->insert($data);
		return $this->db->insert_id();
	}

	// Lanz Editted - June 12, 2013
	function adminlist()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('u_type =', 1);
		$this->db->where('u_superAdmin =', 0); //not include super admin

		$query = $this->db->get();
		return $query->result();
	}

	// Lanz Editted - June 12, 2013
	function permissions($id)
	{
		$this->db->select('*');
		$this->db->where('u_id', $id);
		$query = $this->db->get('permission_assign');
		return $query->result();
	}

	// Lanz Editted - June 13, 2013
	function permission_lists()
	{
		$query = $this->db->get('permission');
		return $query->result();
	}

	// Lanz Editted - June 13, 2013
	function delete_assigned_permissions($id)
	{
		$this->db->delete('permission_assign', array('u_id' => $id));
	}

	// Lanz Editted - June 13, 2013
	function save_assigned_permission($data)
	{
		$this->db->insert('permission_assign', $data);
		return $this->db->insert_id();
	}

	function assigned_permission_list($id)
	{
		$this->db->select('*');
		$this->db->from('permission_assign');
		$this->db->join('permission','permission.p_id = permission_assign.p_id', 'left');
		$this->db->where('permission_assign.u_id', $id);

		$result = $this->db->get();

		return $result->result();
	}

	function check_permission($id, $perm_id)
	{

		$has_permission = false;

		$this->db->select('u_superAdmin');
		$this->db->where('u_id', $id);
		$this->db->where('u_superAdmin',1);
		$result = $this->db->get('user');
		
		if($result->num_rows() == 1)
           $has_permission = true;


		$this->db->select('*');
		$this->db->where('u_id', $id);
		$this->db->where('p_id', $perm_id);
		$result = $this->db->get('permission_assign');

		if($result->num_rows() == 1)
            $has_permission = true;

        return $has_permission;
	}

	function record_admin_payment($data)
	{
		$this->db->insert('admin_supplier_payment',$data);
		return $this->db->insert_id();
	}

	function admin_supplier_payment_history($u_id)
	{
		$this->db->select('*');
		$this->db->from('admin_supplier_payment');
		$this->db->where('u_id',$u_id);
		$result = $this->db->get();


		return $result->result();
	}

	function update_setting($data)
	{
		$this->db->update('admin_settings',$data);

	}

	function get_settings($data_get = "")
	{

		if($data_get == "")
		{
			$result = $this->db->get('admin_settings');

			if($result->num_rows() == 1)
	        	return $result->row(1);
   	 	}
   	 	else
   	 	{
   	 		$this->db->select($data_get);
   	 		$result = $this->db->get('admin_settings');
   	 		$row = $result->row(1);
			if($result->num_rows() == 1)
	        	return $row->{$data_get};
   	 	}
	}

	function update_base_url_image(){

		//FOR GATEGORY IMAGES
		$this->db->select('*');
		$categories = $this->db->get('category');
		$categories = $categories->result();

		foreach($categories as $cat)
		{
			$cat_id = $cat->c_id;
			$cat_url_img = $cat->c_default_image;
			$parse_url = parse_url($cat_url_img);

			if($cat_url_img != false)
			{
				echo '<p>'.'http://'.$parse_url['host'].'/'.'</p>';
				$change_base_url = str_replace('http://'.$parse_url['host'].'/', base_url(), $cat_url_img);
				echo '<p>'.$change_base_url.'</p>';
				$update_url = array('c_default_image' => $change_base_url);
				$this->db->where('c_id', $cat_id );
				$this->db->update('category',$update_url);
			}	
		}
		//FOR INVENTORY IMAGES
		$this->db->select('*');
		$invs = $this->db->get('inventory_image');
		$invs = $invs->result();

		foreach($invs as $inv)
		{
			$inv_id = $inv->ii_id;
			$inv_utl_img = $inv->ii_link;
			$parse_url = parse_url($inv_utl_img);

			if($inv_utl_img != false)
			{
				echo '<p>'.'http://'.$parse_url['host'].'/'.'</p>';
				$change_base_url = str_replace('http://'.$parse_url['host'].'/', base_url(), $inv_utl_img);
				echo '<p>'.$change_base_url.'</p>';
				$update_url = array('ii_link' => $change_base_url);
				$this->db->where('ii_id', $inv_id );
				$this->db->update('inventory_image',$update_url);
			}	
		}

		//FOR USER PROFILE
		$this->db->select('*');
		$users = $this->db->get('user');
		$users = $users->result();

		foreach($users as $user)
		{
			$u_id = $user->u_id;
			$u_utl_img = $user->u_pic;
			$parse_url = parse_url($u_utl_img);

			if($u_utl_img != false)
			{
				echo '<p>'.'http://'.$parse_url['host'].'/'.'</p>';
				$change_base_url = str_replace('http://'.$parse_url['host'].'/', base_url(), $u_utl_img);
				echo '<p>'.$change_base_url.'</p>';
				$update_url = array('u_pic' => $change_base_url);
				$this->db->where('u_id', $u_id );
				$this->db->update('user',$update_url);
			}	
		}
	}

}

/* End of file administrators.php */
/* Location: ./application/models/administrators.php */