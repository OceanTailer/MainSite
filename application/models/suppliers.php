<?php class Suppliers extends CI_Model
{
	function __construct()
	{
		// Call to model constructor
		parent::__construct();
	}

	function listing($status = "")
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('billing_address', 'user.u_id = billing_address.u_id');
		if($status  != '')
			$this->db->where('u_admin_approve', $status);
		$this->db->where('u_type', 2);

		$result = $this->db->get();
		return $result->result();
	}

	function list_supplier_child_attached($i_id)
	{
		$this->db->select('user.u_id ,ic_id, ic_quan, ic_price, ic_retail_price, sup_fee, u_company, ic_map, ic_ship_cost, ic_ship_country, ic_prom_text, c_code');
		$this->db->from('inventory_child');
		$this->db->join('user','inventory_child.u_id = user.u_id', 'left');
		$this->db->join('inventory','inventory_child.i_id = inventory.i_id', 'left');
		$this->db->join('country', 'country.c_id = inventory_child.ic_ship_country', 'left');
		$this->db->where("inventory_child.i_id", $i_id);
		$result = $this->db->get();

		return $result->result();
	}
	
	function update($supplier_id, $updateStatus)
	{
		$this->db->where('u_id', $supplier_id);
		$this->db->update('user', $updateStatus);
	}

	function child_list($sup_id,$name = '',$manu = '',$brand = '')
	{
		$this->db->select('inventory.u_id as master_uid,inventory.i_id, SKU, ic_quan, ic_price, ic_retail_price, ic_time, tr_title, ic_id');
		$this->db->from('inventory_child');
		$this->db->join('inventory','inventory.i_id = inventory_child.i_id', 'left');
		$this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');
        $this->db->join('brand', 'brand.b_id = inventory.b_id', 'left');
		$this->load->model('countries');
        $default_country  = $this->countries->default_country();

        //filtering codes were here

        if($name != '')
        	$this->db->where('tr_title',$name);

        if($manu != '')
        	$this->db->where('manufacturer.m_name',$manu);

        if($brand != '')
        	$this->db->where('brand.b_name',$brand);

        //filtering codes were here end

        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English
		$this->db->where('inventory_child.u_id',$sup_id);
		$this->db->group_by('inventory_child.i_id');

		$result = $this->db->get();
		return $result->result();
	}

	function user_product_attached_min($i_id)
	{
		$this->db->select('u_company , SKU, ic_quan, ic_price, ic_retail_price, ic_time, ic_id');
		$this->db->join('user','user.u_id = inventory_child.u_id', 'left');
		$this->db->from('inventory_child');
		$this->db->where('inventory_child.i_id',$i_id);
		$this->db->group_by('inventory_child.i_id');
		$result = $this->db->get();
		return $result->result();
	}

	function average_lead_time($u_id)
	{
		$this->db->select('ic_leadtime');
		$this->db->where('u_id', $u_id);
		$result = $this->db->get('inventory_child');
		$result = $result->result();

		$result_string = "";

		foreach($result as $res)
		{
			$result_string += preg_replace(
			  array(
			    '/[^\d,]/',    // Matches anything that's not a comma or number.
			    '/(?<=,),+/',  // Matches consecutive commas.
			    '/^,+/',       // Matches leading commas.
			    '/,+$/'        // Matches trailing commas.
			  ),
			  '',              // Remove all matched substrings.
			  $res->ic_leadtime
			);
		}

		return round($result_string / count($result));
	}

	function detail_main_inventory($i_id)
	{
        $this->db->select('*');
        $this->db->select('inventory.c_id as cat_id, inventory.i_id, inventory.u_id as master_uid, inventory_child.u_id as child_uid');
        $this->db->join('inventory_child', 'inventory.i_id = inventory_child.i_id', 'left');
        $this->db->join('user', 'user.u_id = inventory_child.u_id', 'left');
        $this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');
        $this->db->join('brand', 'brand.b_id = inventory.b_id', 'left');
        $this->db->join('category', 'category.c_id = inventory.c_id', 'left');
        $this->load->model('countries');
        $default_country  = $this->countries->default_country();
        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English
        $this->db->where('inventory.i_id', $i_id);
        $result = $this->db->get('inventory');
       // echo print_r($result->result() );
        if($result->num_rows() != 0)
        {
        	$result = $result->row(1);
        //	echo print_r($result );
/*	
        	$result->remaining_quantity = $this->get_child_remaining_quan($ic_id,$result->ic_quan);*/
            return $result;
        }
          else
             return false;
	}


	function detail_child_inventory($ic_id)
	{
        $this->db->select('*');
        $this->db->select('inventory.c_id as cat_id, inventory.i_id, inventory.u_id as master_uid, inventory_child.u_id as child_uid');
        $this->db->join('inventory', 'inventory.i_id = inventory_child.i_id', 'left');
        $this->db->join('user', 'user.u_id = inventory_child.u_id', 'left');
        $this->db->join('manufacturer', 'manufacturer.m_id = inventory.m_id', 'left');
        $this->db->join('brand', 'brand.b_id = inventory.b_id', 'left');
        $this->db->join('category', 'category.c_id = inventory.c_id', 'left');
        $this->load->model('countries');
        $default_country  = $this->countries->default_country();
        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English
        $this->db->where('inventory_child.ic_id', $ic_id);
        $result = $this->db->get('inventory_child');
        
        if($result->num_rows() != 0)
        {
        	$result = $result->row(1);

        	$result->remaining_quantity = $this->get_child_remaining_quan($ic_id,$result->ic_quan);
            return $result;
        }
          else
             return false;
	}

	function get_child_remaining_quan($ic_id,$quantity)
	{
		$this->db->select('SUM(btd_quan) as total_ordered');
		$this->db->join('buyer_supplier_detail', 'buyer_supplier_detail.bt_id = buyer_transaction_detail.bt_id');
		$this->db->where("(bsd_status = '0' OR bsd_status = '1' OR bsd_status = '2')");
		$this->db->where('buyer_transaction_detail.ic_id',$ic_id);
		$result = $this->db->get('buyer_transaction_detail');

		if($result->num_rows() != 0)
        {
        	$result = $result->row(1);
        	return $quantity - $result->total_ordered; //total quantity - total ordered
        }
        else
        	return 0;
	}


	function check_lowest_bid($i_id)
	{
		$this->db->select('ic_id');
		$this->db->where('i_id', $i_id);
		$this->db->order_by('ic_price', 'asc');
		$result = $this->db->get('inventory_child');

		if($result->num_rows() != 0)
		{
			$row = $result->row(0);
			return $row->ic_id;
		}
		else
			return false;
	}

	// Lanz Editted - June 7, 2013
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

	// Lanz Editted - June 7, 2013
	function updatebillingaddress($data, $id)
	{
		$this->db->where('u_id', $id);
		$this->db->update('billing_address', $data);
	}

	// Lanz Editted - June 7, 2013
	function billingaddresses($id)
	{
		$this->db->select("*");
		$this->db->from("billing_address");
		$this->db->join('country', 'country.c_id = billing_address.c_id', 'left');
		$this->db->where("u_id", $id);
		$result = $this->db->get();
		return $result->result();
	}

	// Lanz Editted - June 7, 2013
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

	// Lanz Editted - June 8, 2013
	function updatebillingaddress_ba_id($data, $id)
	{
		$this->db->where('ba_id', $id);
		$this->db->update('billing_address', $data);
	}

	// Lanz Editted - June 8, 2013
	function deleteaddress($ba_id)
	{
		$this->db->where("ba_id", $ba_id);
		$this->db->delete("billing_address");
	}

	// Lanz Editted - June 8, 2013
	function updatecurrentaddress($ba_id, $u_id)
	{
		$this->db->where("u_id", $u_id);
		$this->db->update("billing_address", array('ba_isset' => 0));

		$this->db->where("ba_id", $ba_id);
		$this->db->update("billing_address", array('ba_isset' => 1));
	}

	// Lanz Editted - June 8, 2013
	function creditcards($id)
	{
		$this->db->select("*");
		$this->db->from("credit_card_user");
		$this->db->where("u_id", $id);
		$result = $this->db->get();
		return $result->result();
	}

	// Lanz Editted - June 8, 2013
	function deletecard($ccu_id)
	{
		$this->db->where("ccu_id", $ccu_id);
		$this->db->delete("credit_card_user");
	}

	// Lanz Editted - June 8, 2013
	function updatecurrentcard($ccu_id, $u_id)
	{
		$this->db->where("u_id", $u_id);
		$this->db->update("credit_card_user", array('ccu_isset' => 0));

		$this->db->where("ccu_id", $ccu_id);
		$this->db->update("credit_card_user", array('ccu_isset' => 1));
	}	
	

	function shipping_list_grouped($supplierId, $bsd_id = '',$name ='',$start ='',$end ='',$stat ='')
	{
		$this->db->select('*');
		$this->db->select('buyer_transaction.u_id as buyer_u_id, buyer_transaction.bt_id, buyer_supplier_detail.bsd_id, country.c_id as country_id');
		$this->db->join('buyer_transaction', 'buyer_transaction.bt_id = buyer_supplier_detail.bt_id','left');
		$this->db->join('billing_address', 'billing_address.ba_id = buyer_transaction.ba_id','left');
		$this->db->join('buyer_transaction_ship', 'buyer_transaction_ship.bt_id = buyer_transaction.bt_id','left');
		$this->db->join('country', 'country.c_id = billing_address.c_id','left');
		$this->db->join('supplier_shipprod_info', 'supplier_shipprod_info.u_id = buyer_supplier_detail.u_supplier AND '.'supplier_shipprod_info.bsd_id = buyer_supplier_detail.bsd_id', 'left');
		$this->db->join('user', 'user.u_id = buyer_supplier_detail.u_buyer','left');// get the buyer detail
		
		$this->db->where('buyer_supplier_detail.u_supplier',$supplierId);

        if($bsd_id != '')
        {
        	$this->db->where('buyer_supplier_detail.bsd_id',$bsd_id);
     	}

     	//filtering lines
     	if($name != '')
     		$this->db->where("CONCAT(user.u_fname,' ',user.u_lname) LIKE '%".$name."%'");

     	if($start != '' && $end != '')
     	{
     		$start = strtotime($start);
     		$end = strtotime($end)+86400;
     		$this->db->where("buyer_transaction.bt_time >=  '".$start."'  AND buyer_transaction.bt_time <=  '".$end."' ");

     	}

     	if($stat != '')
     	{
     			if($stat == "shipped" )
     				$this->db->where("bsd_status = '".$stat."' OR bsd_status = 'Completed' ");
     			else
     				$this->db->where("bsd_status = '".$stat."'");


     	}
     	//end filtering lines

		$result = $this->db->get('buyer_supplier_detail');

		//echo $this->db->last_query();

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

	function transaction_detail($uid,  $bsd_id = '')
	{
		$this->db->select('*');
		$this->db->select('inventory.c_id as cat_id, inventory.i_id, inventory.u_id as master_uid, inventory_child.ic_id as supplier_id');
		$this->db->join('buyer_transaction', 'buyer_transaction.bt_id = buyer_transaction_detail.bt_id','left');
		$this->db->join('buyer_supplier_detail', 'buyer_supplier_detail.bt_id = buyer_transaction_detail.bt_id','left');
		$this->db->join('billing_address', 'billing_address.ba_id = buyer_transaction.ba_id','left');
		$this->db->join('buyer_transaction_ship', 'buyer_transaction_ship.bt_id = buyer_transaction.bt_id','left');
		$this->db->join('country', 'country.c_id = billing_address.c_id','left');
		$this->db->join('inventory_child', 'inventory_child.ic_id = buyer_transaction_detail.ic_id','left');
		$this->db->join('inventory', 'inventory.i_id = inventory_child.i_id','left');
		$this->db->join('user', 'user.u_id = buyer_transaction.u_id','left');
        $this->load->model('countries');
        $default_country  = $this->countries->default_country();
        $this->db->join('translation', 'translation.i_id = inventory.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

        $this->db->where('inventory_child.u_id',$uid);

        if($bsd_id != '')
        	$this->db->where('buyer_supplier_detail.bsd_id',$bsd_id);

		$result = $this->db->get('buyer_transaction_detail');

		return $result->result();
	}

	//James Editted-  June 23, 2013

	function shipping_list($uid, $status = 0, $bt_id = '')
	{
		$this->db->select('*');
		$this->db->select('inventory.c_id as cat_id, inventory.i_id, inventory.u_id as master_uid');
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

        $this->db->where('buyer_transaction.bt_status',$status);

        $this->db->where('inventory_child.u_id',$uid);


        if($bt_id != '')
        	$this->db->where('buyer_transaction.bt_id',$bt_id);

		$result = $this->db->get('buyer_transaction_detail');

		if($bt_id != '')
		{
			if($result->num_rows() == 1)
            	return $result->row(1);
	        else
	        	return false;
		}
		else
			return $result->result();
	}

	

	function transaction_detail_update($data,$where,$val)
	{
		$this->db->where($where,$val);
		$this->db->update('buyer_transaction',$data);
	}

	function shipping_product_add_info($data)
	{
		$this->db->select('*');
		$this->db->where('u_id', $data['u_id']);
		$this->db->where('bsd_id', $data['bsd_id']);
		$result = $this->db->get('supplier_shipprod_info');
		if($result->num_rows() == 0)
		{
			$this->db->insert('supplier_shipprod_info', $data);
			return $this->db->insert_id();
		}
		else
		{
			$this->db->where('u_id', $data['u_id']);
			$this->db->where('bsd_id', $data['bsd_id']);
			$this->db->update('supplier_shipprod_info', $data);
			$row = $result->row(1);
			return $row->ssi_id;
		}
	}

	function update_buyer_shipping_det($data, $where, $value)
	{	
		$this->db->where($where, $value);
		$this->db->update('buyer_transaction_detail', $data);
		return $this->db->insert_id();
	}

	function ship_trans_product_detail_info($btd_id)
	{
		$this->db->select('*');
		$this->db->select('buyer_transaction.u_id as buyer_u_id');
		$this->db->join('buyer_transaction', 'buyer_transaction.bt_id = buyer_transaction_detail.bt_id');
		$this->db->join('buyer_transaction_ship', 'buyer_transaction_ship.bt_id = buyer_transaction_detail.bt_id');
		$this->db->join('inventory_child', 'inventory_child.ic_id = buyer_transaction_detail.ic_id','left');
        $this->load->model('countries');
        $default_country  = $this->countries->default_country();
        $this->db->join('translation', 'translation.i_id = inventory_child.i_id AND translation.c_id = '.$default_country, 'left'); // 1 English

		$this->db->where('buyer_transaction_detail.btd_id',$btd_id);
		$result = $this->db->get('buyer_transaction_detail');

		if($result->num_rows() == 1)
            return $result->row(1);
          else
             return false;

	}


	function supplier_sales()
	{
		$this->db->select('*');
		$this->db->join('user', 'admin_supplier_payment.u_id = user.u_id','left');

		$result = $this->db->get('admin_supplier_payment');

		return $result->result();
	}
	
	function shipping_carrier($supplier_country = "")
	{
		$this->db->select('*');
		// Editted
		$this->db->select('shipping_carrier.sc_id');
		$this->db->join('shipping_carrier_country', 'shipping_carrier_country.sc_id = shipping_carrier.sc_id', 'left');

		if($supplier_country != "")
			$this->db->where('country_id',$supplier_country);

		if($supplier_country == "")
			$this->db->group_by('shipping_carrier.sc_id');
			
		$this->db->from('shipping_carrier');
		$result = $this->db->get();

		return $result->result();
	}

	function carrier_info($id)
	{
		$this->db->select('*');
		$this->db->where('sc_id',$id);
		$this->db->from('shipping_carrier');
		$result = $this->db->get();

		if($result->num_rows() == 1)
            return $result->row(1);
          else
             return false;
	}

	function carrier_assign_country($data)
	{
		$this->db->select('*');
		$this->db->where('sc_id', $data['sc_id']);
		$this->db->where('country_id', $data['country_id']);
		$this->db->from('shipping_carrier_country');
		$result = $this->db->get();

		if($result->num_rows() == 0)
		{
			$this->db->insert('shipping_carrier_country',$data);
		}
		else
			return false;
	}

	function cancelOrderList($type)
	{
		$this->db->select('*');
		$this->db->where('user_type', $type);
		$result = $this->db->get('order_cancel');


		return $result->result();
	}

	function update_buyer_supplier_detail($data,$where,$value)
	{
		$this->db->where($where, $value);
		$this->db->update('buyer_supplier_detail', $data);
	}

	/* Lanz - Retrieve Supplier Info */
	function supplierinfo($id)
	{
		$this->db->select('*');
		$this->db->select('bank_account.c_id as country_user, billing_address.c_id as country_billing');
		$this->db->from('user');
		$this->db->join('billing_address', 'user.u_id = billing_address.u_id AND ba_isset = 1', 'left');
		$this->db->join('country', 'country.c_id = billing_address.c_id', 'left');
		$this->db->join('bank_account', 'bank_account.u_id = bank_account.u_id', 'left');
		$this->db->join('credit_card_user', 'user.u_id = credit_card_user.u_id AND ccu_isset = 1', 'left');
		$this->db->join('credit_card', 'credit_card.cc_id = credit_card_user.cc_id', 'left');
		$this->db->where('user.u_id', $id);
		$result = $this->db->get();
		$row = $result->row(1);
		return $row;
	}

	function supplier_sales_detail($u_id)
	{
		$this->db->select('*');
		$this->db->where('buyer_supplier_detail.u_supplier', $u_id);
		$this->db->join('buyer_transaction','buyer_transaction.bt_id = buyer_supplier_detail.bt_id','left');
		$this->db->where('bsd_status', 1); // product that already shipped
		$result = $this->db->get('buyer_supplier_detail');

		return $result->result();
	}

	function total_fee_transaction($uid, $bsd_id)
	{
		$this->db->select('*');
		$this->db->select('inventory.c_id as cat_id, inventory.i_id, inventory.u_id as master_uid, inventory_child.ic_id as supplier_id');
		$this->db->join('buyer_transaction', 'buyer_transaction.bt_id = buyer_transaction_detail.bt_id','left');
		$this->db->join('buyer_supplier_detail', 'buyer_supplier_detail.bt_id = buyer_transaction_detail.bt_id','left');;
		$this->db->join('inventory_child', 'inventory_child.ic_id = buyer_transaction_detail.ic_id','left');
		$this->db->join('inventory', 'inventory.i_id = inventory_child.i_id','left');
		$this->db->join('user', 'user.u_id = buyer_transaction.u_id','left');

        $this->db->where('inventory_child.u_id',$uid);

        if($bsd_id != '')
        	$this->db->where('buyer_supplier_detail.bsd_id',$bsd_id);

		$result = $this->db->get('buyer_transaction_detail')->result();

		$total_fee = 0;

		foreach($result as $s)
		{
			$total_fee += $s->btd_productFee;
		}


		return $total_fee;
	}

	function general_feedback($u_id)
	{
		$this->db->select('*');
		$this->db->select('AVG(bsd_buyer_rate) as avg_rate');
		$this->db->from('buyer_supplier_detail');
		$this->db->join('user', 'user.u_id = buyer_supplier_detail.u_buyer', 'left');

		$this->db->where('bsd_is_feedback', 1);
		$this->db->where('bsd_status', 1);

		$this->db->where('u_supplier', $u_id);

		$this->db->group_by('u_supplier');


		$result = $this->db->get();

		if($result->num_rows() == 1)
			return $result->row(1);
		else return false;
	}
	function feedback_detail($u_id)
	{
		$this->db->select('*');
		$this->db->from('buyer_supplier_detail');
		$this->db->join('user', 'user.u_id = buyer_supplier_detail.u_buyer', 'left');

		$this->db->where('bsd_is_feedback', 1);
		$this->db->where('bsd_status', 1);

		$this->db->where('u_supplier', $u_id);


		$result = $this->db->get();

		return $result->result();

	}

	function list_refund()
	{
		$this->db->select('*');
		$result = $this->db->get('order_refund');

		return $result->result();
	}

	function add_refund_record($data)
	{
		$this->db->insert('order_refund_record', $data);
		return $this->db->insert_id();
	}

	function update_refund_record($data, $where, $value)
	{
		$this->db->where($where, $value);
		$this->db->update('order_refund_record',$data);

		return true;
	}

	function orr_detail($id)
	{
		$this->db->select('*');
		$this->db->from('order_refund_record');
		$this->db->where('bsd_id', $id);
		$result = $this->db->get();

		if($result->num_rows() == 1)
			return $result->row(1);
		else return false;

	}

	function check_refund_record($bsd_id)
	{
		$this->db->select('bsd_id');
		$this->db->where('bsd_id', $bsd_id);

		$result = $this->db->get('order_refund_record');

		if($result->num_rows() == 1)
			return true;
		else return false;
	}

	function rangeWeek($datestr) {
	    $start = new DateTime(date("jS F, Y",$datestr));
		$end = new DateTime();
		$interval = DateInterval::createFromDateString('6 day');
		$period = new DatePeriod($start, $interval, $end);

		$n = 1;

		$array_week_range = array();

		$start_date = "";
		$end_date = "";

		foreach ($period as $dt)
		{
			//if ($dt->format("N") == 1|| $dt->format("N") == 7)
			//{

			if($n%2 == 1)
			{
				//echo $dt->format("l Y-m-d") . "<br>\n";

				if($start_date == "")
					$start_date  = $dt;
				$n = 2;
			}
			else
			{
				//echo $dt->format("l Y-m-d") . " Second<br>\n";
				$end_date  = $dt;
				$row['start'] = $start_date;
			    $row['end'] = $end_date;
			    $array_week_range[] = $row;

			    $start_date = $end_date;

				$n = 2;
			}

			//}
		}
		rsort($array_week_range);

		$last_date_interval = $array_week_range[0];
		//echo strtotime($last_date_interval['end']->format("l Y-m-d"))." < ".strtotime($end->format("l Y-m-d"));

		//push another set of interval if not seen the current date for intervals. :)
		
		if(strtotime($last_date_interval['end']->format("l Y-m-d")) < strtotime($end->format("l Y-m-d")))
		{
			$date_last_rec = $last_date_interval['end']->format("l Y-m-d");
			$row['start'] = $last_date_interval['end'];

		    $row['end'] = new DateTime(date('l Y-m-d', strtotime($date_last_rec." + 6 day") ));
		    array_unshift($array_week_range,$row);
		}
		
		return $array_week_range;
    }

    function generate_range_option($array_date, $format= "l Y-m-d")
    {
    	$string = "";
    	foreach($array_date as $dates)
    	{
    		$string .= "<option value='".strtotime($dates['start']->format("l Y-m-d")).";".strtotime($dates['end']->format("l Y-m-d"))."'> ".$dates['start']->format($format)." - ".$dates['end']->format($format)." </option>";
    	}

    	return $string;

    }

    function get_sales_perWeek($dates,$u_id,$bsd_status)
    {
    	$this->db->select('*');
    	$this->db->where('bsd_timestamp BETWEEN '.$dates[0].' AND '.$dates[1].' '); 
    	$this->db->where('u_supplier',$u_id);
    	$this->db->where('bsd_status',$bsd_status);
    	$result = $this->db->get('buyer_supplier_detail');

    	//echo $this->db->last_query();
    	return $result->result();
    }

}
?>