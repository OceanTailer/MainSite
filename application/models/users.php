<?php
class Users extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

        
    }

 	function encript($code)
	{
		$this->load->library('encrypt');
		$msg = $code;
		$key = 'ocieantailertoken';
		$encrypted_string = $this->encrypt->encode($msg, $key);
		return $encrypted_string;
	}
	
	function decript($code)
	{
		$this->load->library('encrypt');
		$msg = $code;
		$key = 'ocieantailertoken'; 
		$plaintext_string = $this->encrypt->decode($code);
		return $plaintext_string;
	}

	function is_valid_login($user , $pass)
	{
		$this->db->select("*");
		$this->db->where('( u_username = "'.$user.'" OR u_email = "'.$user.'") ');
		$this->db->where('u_status', 1);
		
		$result = $this->db->get('user');
		if($result->num_rows() == 1)
		{
			$row = $result->row(1);
			$dec_pass = $this->decript($row->u_pass);
			if( $dec_pass== $pass)
			 {
				$newdata = array(
					   'id'  => $row->u_id,
					   'fname' => $row->u_fname,
					   'lname' => $row->u_lname,
					   'email' => $row->u_email,
					   'type' => $row->u_type,
					   'is_login' => TRUE,
					'psw' => $dec_pass
				   );
				 $this->session->set_userdata($newdata);
				return true;
			 }
			 else
				return false;	
		}
		else
				return false;
	}

	function logout()
	{
		$array_items = array('id' => '', 'is_login' => false, 'type' => '', 'email' => '', 'name' => '');
		$this->session->unset_userdata($array_items);
	}

	function info($id)
	{
		$this->db->select('*');
		$this->db->join('billing_address', 'user.u_id = billing_address.u_id AND ba_isset = 1', 'left');
		$this->db->join('credit_card_user', 'user.u_id = credit_card_user.u_id AND ccu_isset = 1', 'left');
		$this->db->join('credit_card', 'credit_card.cc_id = credit_card_user.cc_id AND ccu_isset = 1', 'left');
		$this->db->join('country', 'country.c_id = billing_address.c_id AND ccu_isset = 1', 'left');
		$this->db->where('user.u_id', $id);
		$result = $this->db->get('user');
		$row = $result->row(1);

		return $row;
	}

	function info_via_email($email)
	{
		$this->db->select('*');
		$this->db->where('u_email', $email);
		$result = $this->db->get('user');
		$row = $result->row(1);

		return $row;
	}

	function email_info_from_product($from = "", $value = "")
	{
		$this->db->select('u_email');
		$this->db->where($from, $value);
		$this->db->join('user', 'user.u_id = inventory_child.u_id', 'left');
		$result = $this->db->get('inventory_child');
		$row = $result->row(1);

		return $row->u_email;
	}

	function update($data,$where,$value){	
		$this->db->where($where,$value);
		$this->db->update('user',$data);

	}

	function salt_value()
	{
		//return 'aX9AfzuEGRcH6EjOMBD0nfYgdWhZ58sq';//local server
		return 'Qq5cqnczRoqwzHosIL4Whr18haxgD9s2';
	}

	function add($data)
	{
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	function add_to_ticket($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	function check_email_exist($email)
	{
		$this->db->select("*");
		$this->db->where('u_email', $email);
		$result = $this->db->get('user');

		if($result->num_rows() == 0)
			return false;
		else
			return true;
	}

	function check_username_exist($user)
	{
		$this->db->select("*");
		$this->db->where('u_username', $user);
		$result = $this->db->get('user');

		if($result->num_rows() == 0)
			return false;
		else
			return true;
	}

	function ccu_add($data)
	{
		$this->db->insert('credit_card_user', $data);
		return $this->db->insert_id();
	}

	function business_address_add($data)
	{
		$this->db->insert('billing_address', $data);
		return $this->db->insert_id();
	}

	function validate_regisCode($code)
	{
		$this->db->select('*');
		$this->db->where('u_verify_code',$code);
		$result = $this->db->get('user');

		if($result->num_rows() == 1)
			{
				$user_info = $result->row(1);
				$update_status = array('u_status' => 1);
				$this->update($update_status,'u_id',$user_info->u_id);
				$this->is_valid_login($user_info->u_username, $this->decript($user_info->u_pass));	
				return true;
			}
            
          else
             return false;
	}

	function bank_acc_add($data)
	{
		$this->db->insert('bank_account', $data);
		return $this->db->insert_id();
	}

	// Lanz Editted - June 5, 2013
	function buyer_add_creditcard($data)
	{
		$this->db->insert("credit_card_user", $data);
		return $this->db->insert_id();
	}

	// Lanz Editted - June 6, 2013
	function buyer_update_creditcard($data, $ccu_id)
	{
		$this->db->where("ccu_id", $ccu_id);
		$this->db->update("credit_card_user", $data);
	}

	/* Lanz Editted - July 21, 2013 */
	function password($id)
	{
		$this->db->select('u_pass');
		$this->db->where('u_id', $id);
		$result = $this->db->get('user');
		$rand_pass = $result->row(1);

		$current_pass = $this->decript($rand_pass->u_pass);
		return $current_pass;
	}

	/* Lanz Editted - July 22, 2013 */
	function updatepassword($data, $id)
	{
		$this->db->update('user', $data, array('u_id' => $id));
	}

	/* Lanz Editted - July 22, 2013 */
	function check_address1($id, $address1)
	{
		$this->db->select('*');
		$this->db->where('u_id', $id);
		$this->db->where('ba_add1', $address1);
		$result = $this->db->get('billing_address');
		if ($result->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/* Lanz Editted - July 22, 2013 */
	function check_address2($id, $address2)
	{
		$this->db->select('*');
		$this->db->where('u_id', $id);
		$this->db->where('ba_add2', $address2);
		$result = $this->db->get('billing_address');
		if ($result->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/* Lanz Editted - July 22, 2013 */
	function check_phonenumber($id, $number)
	{
		$this->db->select('*');
		$this->db->where('u_id', $id);
		$this->db->where('ba_phone_num', $number);
		$result = $this->db->get('billing_address');
		if ($result->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	/* Buyer and Supplier Credit Cards */
	/* Lanz Editted - July 22, 2013 */
	function check_creditcard($card_num)
	{
		$this->db->select('*');
		$this->db->where('ccu_number', $card_num);
		$result = $this->db->get('credit_card_user');
		if ($result->num_rows() == 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function enable_feedback($days)
	{
		$time_allowed = strtotime("-".$days." days");

		$this->db->select('*');
		$this->db->from('buyer_supplier_detail');
		$this->db->join('supplier_shipprod_info', 'supplier_shipprod_info.bsd_id = buyer_supplier_detail.bsd_id', 'left');
		$this->db->join('buyer_transaction', 'buyer_transaction.bt_id = buyer_supplier_detail.bt_id', 'left');
		$this->db->where('bsd_status', 1); //Already Shipped;
		$this->db->where('bsd_is_feedback', 0); //Not Yet created Feedback
		//the ssi_time must be less than or equal to the time allowed set.
		$this->db->where('ssi_time <= '.$time_allowed); // minus from current date to the date set for sending email, and enable feedback features;

		$this->db->where('ssi_time != ""'); //Already Shipped;

		$approved_orders = $this->db->get()->result();

		foreach($approved_orders as $order)
		{
			$started_date = $order->ssi_time;
			$added_date = strtotime("-".$days." days");
			echo date('M d, Y H:i:s',$added_date).' '.date('M d, Y H:i:s',$started_date);

			$data_update = array('bsd_is_feedback' => 1);
			$this->suppliers->update_buyer_supplier_detail($data_update ,'bsd_id', $order->bsd_id);
			//enable feedback to the buyer

			$email_data['buyer_info'] = $this->info($order->u_buyer);
			$email_data['supplier_info'] = $this->info($order->u_supplier);
			$email_data['order_detail'] = $order;
			$email_data['email_type'] = "Notify Feedback";
			$email_content = $this->load->view('email/user-email',$email_data, true);
			//echo $pass;

			// Buyer Activate Email Format
			$subject = "Give Us a Feedback from your Last Transaction (Oceantailer)";
			$from = "noreply-oceantailer@oceantailer.com";
			$sender = "http://www.oceantailer.com";
			$to = "jamesan2k@gmail.com , ".$email_data['buyer_info']->u_email;
			$this->send_message($email_content, $subject, $to, $from, $sender);
		}

	}

	function send_message($message, $subject, $to, $from, $sender)
	{
		$this->load->library('email');

       	$config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']            = "smtp";
        $config['smtp_host']           = "localhost";
        $config['smtp_port']           = "25";
        $config['mailtype'] = 'html';
        $config['charset']  = 'utf-8';
        $config['newline']  = "\r\n";
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

		$this->email->from($from, $sender);
		$this->email->to($to); 
		
		$this->email->subject($subject);
		$this->email->message($message);	

		$this->email->send();
		echo $this->email->print_debugger();
	}

	function add_personal_message($data)
	{

		$this->db->insert('buyer_supplier_message',$data);
		return $this->db->insert_id();	

	}

	function get_personal_message($bsd_id)
	{
		$this->db->select('*');
		$this->db->from('buyer_supplier_message');
		$this->db->join('user','user.u_id = buyer_supplier_message.u_id', 'left');
		$this->db->where('bsd_id', $bsd_id);
		$this->db->order_by('bsm_time', 'desc');
		$result =  $this->db->get();


		return $result->result();
	}

	function get_personal_message_detail($bsm_id,$type)
	{
		$this->db->select('*');
		$this->db->from('buyer_supplier_message');
		$this->db->join('buyer_supplier_detail','buyer_supplier_detail.bsd_id = buyer_supplier_message.bsd_id', 'left');
		$this->db->join('buyer_transaction','buyer_transaction.bt_id = buyer_supplier_detail.bt_id', 'left');
		$this->db->where('bsm_id', $bsm_id);

		if($type == 'supplier')
		{
			$this->db->join('user','user.u_id = buyer_supplier_message.buyer_id', 'left');
		}
		elseif($type == 'buyer')
		{
			$this->db->join('user','user.u_id = buyer_supplier_message.supplier_id', 'left');
		}

		$this->db->order_by('bsm_time', 'desc');
		$result =  $this->db->get();

		if($result->num_rows() == 1)
		{
				return $result->row(1);
		}
		else
				return false;

		return $result->result();
	}

	function get_all_personal_message($user_id,$type)
	{
		$this->db->select('*');
		$this->db->from('buyer_supplier_message'); 
		$this->db->join('buyer_supplier_detail','buyer_supplier_detail.bsd_id = buyer_supplier_message.bsd_id', 'left');
		$this->db->join('buyer_transaction','buyer_transaction.bt_id = buyer_supplier_detail.bt_id', 'left');

		if($type == 'supplier')
		{
			$this->db->join('user','user.u_id = buyer_supplier_message.buyer_id', 'left');
			$this->db->where('supplier_id', $user_id);
		}
		elseif($type == 'buyer')
		{
			$this->db->join('user','user.u_id = buyer_supplier_message.supplier_id', 'left');
			$this->db->where('buyer_id', $user_id);
		}

		$this->db->order_by('bsm_time', 'desc');
		$result =  $this->db->get();


		return $result->result();
	}

	function get_message_reply($bsm)
	{
		$this->db->select('*');
		$this->db->from('buyer_supplier_reply');
		$this->db->join('user','user.u_id = buyer_supplier_reply.u_id', 'left');
		$this->db->where('bsm_id', $bsm);
		$this->db->order_by('bsr_time', 'desc');
		$result = $this->db->get();

		return $result->result();
	}

	function add_reply($data)
	{
		$this->db->insert('buyer_supplier_reply', $data);
		return $this->db->insert_id();
	}

	function new_email_count($bsd, $type)
	{
		$this->db->select('*');
		$this->db->from('buyer_supplier_message');
		$this->db->where('bsd_id',$bsd);

		if($type == 2) //supplier
		{
			$this->db->where('bsm_supplier_read', 0);
		}
		elseif($type == 3) //buyer
		{
			$this->db->where('bsm_buyer_read', 0);
		}

		$return = $this->db->get();

		return $return->result();
	}

	function update_unread_message($bsm, $type)
	{
		if($type == 2) //supplier
			$update_data = array('bsm_supplier_read' => 1);
		elseif($type == 3)
			$update_data = array('bsm_buyer_read' => 1);

		$this->db->where('bsm_id', $bsm);
		$this->db->update('buyer_supplier_message', $update_data);

	}

	function sendpayment_automatic_supplier()
	{
		$this->db->select('u_id, u_time');
		$this->db->where('u_type', 2); 
		$suppliers = $this->db->get('user');

		$suppliers = $suppliers->result();

		foreach($suppliers as $supplier)
		{
			//Get supplier range week and
			$range_week = $this->suppliers->rangeWeek($supplier->u_time);
			

			foreach($range_week as $week)
			{
				$add_days = 2;

				$date_transfer = date('M d,Y', strtotime($week['end']->format("M d,Y"))+(24*3600* $add_days)); //Plus 2 Days from the Date End of the 5 days
				$current_day = date('M d,Y', time());
				if($date_transfer == "Sep 29,2013")//if the Transfer amount scheduled is set then release the money
				{
					$date_range =  array(strtotime($week['start']->format("M d,Y")), strtotime($week['end']->format("M d,Y")));
					$sales_product = $this->suppliers->get_sales_perWeek($date_range,$supplier->u_id, 1);
					
					if(count($sales_product) != 0)
					{
						////////////////////////////PRODUCT AMOUNT////////////////////////////////
						$total_prod_charges = 0; //Add
						$total_prod_rebates = 0; //Minus
						$total_prod_fee = 0; //Minus
						$total_prod_other = 0; //Add
						$subtotal_prod_ = 0; //Add

						$payment_product_breakdown = array();

						foreach($sales_product as $sales)
						{
							$products_info =  $this->suppliers->transaction_detail($supplier->u_id,$sales->bsd_id);

							foreach($products_info as $prod_info)
							{
								
								$total_prod_charges += $prod_info->btd_subamount; //the Quantity * Price 
								$total_prod_fee += $prod_info->btd_subamount * ($prod_info->btd_productFee/100); //Product Fee
								$total_prod_other += $prod_info->btd_shipamount * $prod_info->btd_quan; //other is including the shipping fee
								$insert_prodct_breakdown = array();
							}
						}

						$subtotal_prod_ = ($total_prod_charges + $total_prod_other) - $total_prod_fee;

						echo $total_prod_charges.'</br>'; //Add
						echo $total_prod_rebates.'</br>'; //Minus
						echo $total_prod_fee.'</br>'; //Minus
						echo $total_prod_other.'</br>'; //Add
						echo $subtotal_prod_.'</br></br>'; //Add


						/////////////////////////////////////////////////////////////////////////////////////////////////////

						$total_rfnd_charges = 0; //Add
						$total_rfnd_rebates = 0; //Minus
						$total_rfnd_fee = 0; //Minus
						$total_rfnd_other = 0; //Add
						$subtotal_rfnd_ = 0; //Add

						// getting all the refund with in a certrain week by date range and the bsd_status -3 or Refund Status
						$product_refund = $this->suppliers->get_sales_perWeek($date_range,$supplier->u_id, -3); 

						//getting all the product amount including the deduction and the quantity purchased.

						foreach($product_refund as $refund)
						{
							$prod_rfnd = $this->suppliers->orr_detail($refund->bsd_id); //if exist only update. else add a recorc

							$total_rfnd_charges += $prod_rfnd->orr_prod_amnt; //the Quantity * Price 
							
							$total_rfnd_other += $prod_rfnd->orr_ship_amnt; //other is including the shipping fee

							$products_info =  $this->suppliers->transaction_detail($supplier->u_id,$refund->bsd_id);

							foreach($products_info as $prod_refund)
							{
								$total_rfnd_fee += $prod_refund->btd_subamount * ($prod_refund->btd_productFee/100); //Product Fee
							}

						}

						$subtotal_rfnd_ = ($total_rfnd_charges + $total_rfnd_other) - $total_rfnd_fee;

						echo $total_rfnd_charges.'</br>'; //Minus
						echo $total_rfnd_rebates.'</br>'; //Add
						echo $total_prod_fee.'</br>'; //Add
						echo $total_rfnd_other.'</br>'; //Minus
						echo $subtotal_rfnd_.'</br></br>'; //Minus

						$payment_total_breakdown =  array('total_prod_charges' => $total_prod_charges,
														  'total_prod_rebates' => -$total_prod_rebates,
														  'total_prod_fee' => -$total_prod_fee,
														  'total_prod_other' => $total_prod_other,
														  'subtotal_prod_' => $subtotal_prod_,
														  'total_rfnd_charges' => -$total_rfnd_charges,
														  'total_rfnd_rebates' => $total_rfnd_rebates,
														  'total_prod_fee' => $total_prod_fee,
														  'total_rfnd_other' => -$total_rfnd_other,
														  'subtotal_rfnd_' => -$subtotal_rfnd_
														  );


						echo $week['start']->format("M d,Y").' - '.$week['end']->format("M d,Y")." User: ".$supplier->u_id." end</br></br>" ;

						//Once determined the payment, needs to transfer money using Authorized.net
						$closing_balance = $subtotal_prod_ - $subtotal_rfnd_;
						$this->send_payment_authorized($supplier->u_id,$closing_balance,$payment_total_breakdown);

					}
					else
					{
						echo $week['start']->format("M d,Y").' - '.$week['end']->format("M d,Y")." User: ".$supplier->u_id." end</br></br>" ;
					}
				}
					
			}

		}

	}


	function send_payment_authorized($supplier_id,$closing_balance,$payment_total_breakdown)
	{
		$this->load->model('banks');

		$bank_info = $this->banks->get_default_bank($supplier_id);

		$bank_id = $bank_info->bnk_id; //get the default bank info
		$amount = $closing_balance;
		$sup_info = $this->suppliers->supplierinfo($supplier_id);

		$bank_aba_code = $bank_info->bnk_id_code;
		$bank_acct_num = $bank_info->bnk_account;
		$bank_acct_type = "CHECKING"; //CHECKING, BUSINESSCHECKING, SAVINGS
		$bank_name = $bank_info->bnk_name;
		$bank_acct_name = $bank_info->bnk_owner;

		
		$feild_setting = array(
			'amount' => $amount,
			'first_name' => $sup_info->u_fname,
			'last_name' => $sup_info->u_lname,
			'address' => '',
			'email' => $sup_info->u_email,
			'method' => 'echeck', // for echeck method
            'bank_aba_code' => $bank_aba_code,
            'bank_acct_num' => $bank_acct_num,
            'bank_acct_type' => "CHECKING",
            'bank_name' => $bank_name,
            'bank_acct_name' => $bank_acct_name,
            'echeck_type' => 'WEB',
			);
		$this->authorizenet->setECheck($bank_aba_code, $bank_acct_num, $bank_acct_type, $bank_name, $bank_acct_name, $echeck_type = 'WEB');

		$this->authorizenet->setFields($feild_setting);

		$response = $this->authorizenet->authorizeAndCapture();

				print_r($feild_setting);
		echo "<br/><br/>";
		print_r($response);

		if ($response->approved) {
			

			$data_insert_payment = array('asp_amount' => $amount,
										  'u_id' => $supplier_id,
										  'bnk_id' => $bank_id,
										  'asp_date' => time(),
										  'asp_auth_respond' => json_encode($response),
										  'asp_value_send' => json_encode($feild_setting),
										  'asp_summary' => json_encode($payment_total_breakdown));

			$data_result = $this->administrators->record_admin_payment($data_insert_payment);

			$transaction_list = $this->suppliers->supplier_sales_detail($supplier_id); //get all approved list and update the status, completed

			foreach($transaction_list as $trans)
			{
				$array = array('bsd_reason' => "Completed", 'bsd_status' => 2); //2 for completed transaction
				$result = $this->suppliers->update_buyer_supplier_detail($array,'bsd_id', $trans->bsd_id);
			}

			echo "APPROVED";
		} else {
			echo "DENIED: PLEASE CONTACT THE SUPPLIER FOR THE BANK ACCOUNT INFORMATION";
		}
	}
}

?>
