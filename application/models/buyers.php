<?php
class buyers extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function listing($status = "")
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('billing_address', 'user.u_id = billing_address.u_id');
		if($status  != '')
			$this->db->where('u_admin_approve', $status);
		$this->db->where('u_type', 3);
		$this->db->group_by('user.u_id');

		$result = $this->db->get();
		return $result->result();
	}

	function buyerinfo($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('billing_address', 'user.u_id = billing_address.u_id AND ba_isset = 1', 'left');
		$this->db->join('credit_card_user', 'user.u_id = credit_card_user.u_id AND ccu_isset = 1', 'left');
		$this->db->join('credit_card', 'credit_card.cc_id = credit_card_user.cc_id AND ccu_isset = 1', 'left');
		$this->db->join('country', 'country.c_id = billing_address.c_id AND ccu_isset = 1', 'left');
		$this->db->where('user.u_id', $id);
		$result = $this->db->get();
		$row = $result->row(1);

		return $row;
	}

	// Lanz Editted - May 31, 2013
	function updatebasicinfo($data, $id)
	{
		$newdata = array(
			   'fname' => $data['u_fname'],
			   'lname' => $data['u_lname'],
			   'email' => $data['u_email'],

		  );
		$this->session->set_userdata($newdata);
		$this->db->where('u_id', $id);
		$this->db->update('user', $data);
	}

	// Lanz Editted - May 31, 2013
	function updatebillingaddress($data, $id)
	{
		$this->db->where('u_id', $id);
		$this->db->update('billing_address', $data);
	}

	function updatebillingaddress_ba_id($data, $id)
	{
		$this->db->where('ba_id', $id);
		$this->db->update('billing_address', $data);
	}

	// Lanz Editted - June 4, 2013, James Edited, June 14, 2013
	function billingaddresses($id, $default = false)
	{
		$this->db->select("*");
		$this->db->from("billing_address");
		$this->db->join('country', 'country.c_id = billing_address.c_id', 'left');
		$this->db->where("u_id", $id);
		if($default)
		{
			$this->db->where('ba_isset', 1);
			$result = $this->db->get();
			$row = $result->row(1);

			return $row;
		}
		else
		{
			$result = $this->db->get();
			return $result->result();
		}
	}

	//James Editted - June 5, 2013
	function get_billing_info($ba_id)
	{
		$this->db->select('*');
		$this->db->from("billing_address");
		$this->db->join('country', 'country.c_id = billing_address.c_id', 'left');
		$this->db->where('ba_id', $ba_id);
		$result = $this->db->get();

		if($result->num_rows() == 1)
            return $result->row(1);
          else
             return false;
	}

	function get_creditcard_info($ccu_id)
	{
		$this->db->select("*");
		$this->db->from("credit_card_user");
		$this->db->join('credit_card', 'credit_card.cc_id = credit_card_user.cc_id', 'left');
		$this->db->where("ccu_id", $ccu_id);

		$result = $this->db->get();
		$row = $result->row(1);

		return $row;

	}

	// Lanz Editted - June 5, 2013, James Edited, June 14, 2013
	function creditcards($id, $default = false)
	{
		$this->db->select("*");
		$this->db->from("credit_card_user");
		$this->db->join('credit_card', 'credit_card.cc_id = credit_card_user.cc_id', 'left');
		$this->db->where("u_id", $id);
		if($default)
		{
			$this->db->where('ccu_isset', 1);
			$result = $this->db->get();
			$row = $result->row(1);

			return $row;
		}else
		{
			$result = $this->db->get();
			return $result->result();
		}
	}

	// Lanz Editted - June 5, 2013
	function deletecard($ccu_id)
	{
		$this->db->where("ccu_id", $ccu_id);
		$this->db->delete("credit_card_user");
	}

	// Lanz Editted - June 6, 2013
	function updatecurrentcard($ccu_id, $u_id)
	{
		$this->db->where("u_id", $u_id);
		$this->db->update("credit_card_user", array('ccu_isset' => 0));

		$this->db->where("ccu_id", $ccu_id);
		$this->db->update("credit_card_user", array('ccu_isset' => 1));
	}

	function update($supplier_id, $updateStatus)
	{
		$this->db->where('u_id', $supplier_id);
		$this->db->update('user', $updateStatus);
	}

	// Lanz Editted - June 7, 2013
	function deleteaddress($ba_id)
	{
		$this->db->where("ba_id", $ba_id);
		$this->db->delete("billing_address");
	}

	// Lanz Editted - June 7, 2013
	function updatecurrentaddress($ba_id, $u_id)
	{
		$this->db->where("u_id", $u_id);
		$this->db->update("billing_address", array('ba_isset' => 0));

		$this->db->where("ba_id", $ba_id);
		$this->db->update("billing_address", array('ba_isset' => 1));
	}

	//James Editted - June 18, 2013
	function add_transaction($data)
	{
		$this->db->insert('buyer_transaction',$data);
		return $this->db->insert_id();
	}

	function update_transaction($data,$where,$value)
	{
		$this->db->where($where,$value);
		$this->db->update('buyer_transaction',$data);
	}

	//James Editted - June 18, 2013
	function add_transaction_detail($data)
	{
		$this->db->insert('buyer_transaction_detail',$data);
		return $this->db->insert_id();
	}

	function add_transaction_shipdet($data)
	{
		$this->db->insert('buyer_transaction_ship',$data);
		return $this->db->insert_id();
	}

	function get_trasaction_detail($bt_id)
	{
		$this->db->select('*');
		$this->db->where('bt_id',$bt_id);
		$result =  $this->db->get('buyer_transaction');

		if($result->num_rows() == 1)
            return $result->row(1);
          else
             return false;
	}

	function get_trasaction_detailShipping($bts_id)
	{
		$this->db->select('*');
		$this->db->where('bts_id',$bts_id);
		$result =  $this->db->get('buyer_transaction_ship');

		if($result->num_rows() == 1)
            return $result->row(1);
          else
             return false;
	}

	function transaction_list()
	{
		$this->db->select('*');
		$this->db->join('user', 'user.u_id = buyer_transaction.u_id','left');
		$result = $this->db->get('buyer_transaction');

		return $result->result();
	}

	// Lanz Editted - June 18, 2013
	function transactions($id)
	{
		$this->db->select('*');
		$this->db->from('buyer_transaction');
		$this->db->where('u_id', $id);
		$result = $this->db->get();
		return $result->result();
	}

	function search_shipping_list_grouped($bt_id)
	{
		$this->db->select('*');
		$this->db->select('buyer_transaction.u_id as buyer_u_id ,inventory_child.u_id as invent_child_supplier');
		$this->db->select('inventory.c_id as cat_id, inventory.i_id, inventory.u_id as master_uid, sum(btd_quan) as total_quan, sum(btd_subamount) as total_amount');
		$this->db->join('buyer_transaction', 'buyer_transaction.bt_id = buyer_transaction_detail.bt_id','left');
		$this->db->join('billing_address', 'billing_address.ba_id = buyer_transaction.ba_id','left');
		$this->db->join('buyer_transaction_ship', 'buyer_transaction_ship.bt_id = buyer_transaction.bt_id','left');
		$this->db->join('country', 'country.c_id = billing_address.c_id','left');
		$this->db->join('inventory_child', 'inventory_child.ic_id = buyer_transaction_detail.ic_id','left');
		$this->db->join('inventory', 'inventory.i_id = inventory_child.i_id','left');
		$this->db->join('user', 'user.u_id = buyer_transaction.u_id','left');

        $this->load->model('countries');
        $default_country  = $this->countries->default_country();
        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English


        $this->db->where('buyer_transaction.bt_id',$bt_id);


     	$this->db->group_by('buyer_transaction.bt_id, inventory_child.u_id');
		$result = $this->db->get('buyer_transaction_detail');

		return $result->result();
	}

	function shipping_list_grouped($buyerId = '',$bsd_id = '',$name ='',$start ='',$end ='',$stat ='')
	{
		$this->db->select('*');
		$this->db->select('buyer_transaction.u_id as buyer_u_id, buyer_transaction.bt_id, billing_address.c_id as country_billing, buyer_supplier_detail.bsd_id');
		$this->db->join('buyer_transaction', 'buyer_transaction.bt_id = buyer_supplier_detail.bt_id','left');
		$this->db->join('billing_address', 'billing_address.ba_id = buyer_transaction.ba_id','left');
		$this->db->join('buyer_transaction_ship', 'buyer_transaction_ship.bt_id = buyer_transaction.bt_id','left');
		$this->db->join('country', 'country.c_id = billing_address.c_id','left');
		$this->db->join('supplier_shipprod_info', 'supplier_shipprod_info.u_id = buyer_supplier_detail.u_supplier AND '.'supplier_shipprod_info.bsd_id = buyer_supplier_detail.bsd_id', 'left');

		if($bsd_id == '')
		{
			$this->db->join('user', 'user.u_id = buyer_supplier_detail.u_supplier','left');// get the supplier detail
		}

        if($buyerId != '')
        	$this->db->where('buyer_transaction.u_id',$buyerId);

        if($bsd_id != '')
        	$this->db->where('buyer_supplier_detail.bsd_id',$bsd_id);



     	//filtering lines
     	if($name != '')
     		$this->db->where("CONCAT(user.u_fname,' ',user.u_lname) LIKE '%".$name."%' OR u_company LIKE '%".$name."%'");

     	if($start != '' && $end != '')
     	{
     		$start = strtotime($start);
     		$end = strtotime($end)+86400;
     		$this->db->where("buyer_transaction.bt_time >=  '".$start."'  AND buyer_transaction.bt_time <=  '".$end."' ");

     	}

     	if($stat != '')
     	{
     		$this->db->where('buyer_supplier_detail.bsd_status',$stat);
     	}
     	//end filtering lines

		$result = $this->db->get('buyer_supplier_detail');

		if($bsd_id != '')
		{
			if($result->num_rows() == 1)
            	return $result->row(1);
	        else
	        	return false;
		}
		else
			return $result->result();
	}

	function transaction_detail($uid,$bt_id = '',$bt_supplier = '')
	{
		$this->db->select('*');
		$this->db->select('inventory.c_id as cat_id, inventory.i_id, inventory.u_id as master_uid, inventory_child.ic_id as supplier_id');
		$this->db->join('buyer_transaction', 'buyer_transaction.bt_id = buyer_transaction_detail.bt_id','left');
		$this->db->join('billing_address', 'billing_address.ba_id = buyer_transaction.ba_id','left');
		$this->db->join('buyer_transaction_ship', 'buyer_transaction_ship.bt_id = buyer_transaction.bt_id','left');
		$this->db->join('country', 'country.c_id = billing_address.c_id','left');
		$this->db->join('inventory_child', 'inventory_child.ic_id = buyer_transaction_detail.ic_id','left');
		$this->db->join('inventory', 'inventory.i_id = inventory_child.i_id','left');

		$this->db->join('user', 'user.u_id = inventory_child.u_id','left');// get the supplier detail
        $this->load->model('countries');
        $default_country  = $this->countries->default_country();

        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English


        $this->db->where('buyer_transaction.u_id',$uid);


        if($bt_id != '')
        	$this->db->where('buyer_transaction.bt_id',$bt_id);

        if($bt_supplier != '')
     		$this->db->where('inventory_child.u_id',$bt_supplier);

		$result = $this->db->get('buyer_transaction_detail');

		return $result->result();
	}

	function update_ssi($data,$where,$value)
	{
		$this->db->where($where,$value);
		$this->db->update('supplier_shipprod_info', $data);
	}

	function cancelOrderList($type)
	{
		$this->db->select('*');
		$this->db->where('user_type', $type);
		$result = $this->db->get('order_cancel');


		return $result->result();
	}

	function buyer_supplier_detail($data)
	{
		$this->db->insert('buyer_supplier_detail', $data);
	}

	function update_buyer_supplier_detail($data,$where,$value)
	{
		$this->db->where($where, $value);
		$this->db->update('buyer_supplier_detail', $data);
	}

	function orderReturnList()
	{
		$this->db->select('*');
		$result = $this->db->get('order_return');


		return $result->result();

	}
	
}
?>