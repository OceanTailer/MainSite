<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users');
		$this->load->model('manufacturers');
		$this->load->model('buyers');
		$this->load->model('countries');
		$this->load->model('inventories');
    }

	public function index()
	{

			redirect('','refresh');
	}

	function buyer()
	{
		$is_Login_user = false; 
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$user_id = $this->session->userdata('id');
			if($user_type == 3) //3 is Buyer
			{
				$is_Login_user = true;

				$b_id = $this->input->post('billing'); 
				$ccu_id = $this->input->post('cc');

				$user = $this->users->info($user_id);
				$billing = $this->buyers->get_billing_info($b_id);
				//$cc = $this->buyers->get_creditcard_info($ccu_id);
				
				$shipping_used = $this->input->post('shipping_info');

				$full_name = $user->u_fname.$user->u_lname;
				$country = $billing->c_id;
				$address1 = $billing->ba_add1;
				$address2 = $billing->ba_add2;
				$city = $billing->ba_city;
				$state = $billing->ba_province;
				$code = $billing->ba_postal;
				$phone = $billing->ba_phone_num;
				$phone_ext = $billing->ba_phone_ext;

				if(!$shipping_used)
				{
					$full_name = $this->input->post('receiver_name');
					$country = $this->input->post('country');
					$address1 = $this->input->post('add1');
					$address2 = $this->input->post('add2');
					$city = $this->input->post('city');
					$state = $this->input->post('prov');
					$code = $this->input->post('postal');
					$phone = $this->input->post('phone_num');
					$phone_ext = $this->input->post('phone_ext');
				}
				$invoice = $user_id.'-'.$this->rndm_strng('numeric',10);

				$carts = $this->cart->contents(); //James, cart content	

				$total_shipping = 0;
				foreach($carts as $itemd)
				{
					$total_shipping += $itemd['options']['ship_cost'];
				}

				$data_buyer_trans = array('u_id' => $user_id,
										  'ccu_id' => $ccu_id,
										  'ba_id' => $b_id,
										  'bt_invoice' => $invoice,
										  'bt_type' => 'paypal',
										  'bt_trans_id' => '',
										  'bt_total_shipping' => $total_shipping,
										  'bt_total_payment' => $this->cart->total(),
										  'bt_total_item' => $this->cart->total_items(),
										  'bt_timestamp' => '',
										  'bt_correlation_id' => '',
										  'bt_ack' => '',
										  'bt_status' => '0',
										  'bt_time' => time(),
										  'bt_is_sameBilling_to_ship' => $shipping_used);

				$bt_id = $this->buyers->add_transaction($data_buyer_trans);
				

				foreach($carts as $itemd)
				{

					$data_tras_detail = array('bt_id' => $bt_id,
											  'ic_id' => $itemd['id'], 
											  'btd_quan' => $itemd['qty'], 
											  'btd_amount' => $itemd['price'], 
											  'btd_shipamount' => $itemd['options']['ship_cost'], 
											  'btd_subamount' => $itemd['subtotal'],
											  'btd_shipped_stat' => 0,
											  'btd_productFee' =>  $itemd['options']['fee']); //status to zero if not shipped yet

					$btd_id = $this->buyers->add_transaction_detail($data_tras_detail);
				}

				$data_shiipping_det = array('bt_id' => $bt_id,
										   'bts_name' => $full_name,
										   'c_id' => $country,
										   'bts_add1' => $address1,
										   'bts_add2' => $address2,
										   'bts_city' => $city,
										   'bts_prov' => $state,
										   'bts_postal' => $code,
										   'bts_phone_num' => $phone,
										   'bts_phone_ext' => $phone_ext);

				$bts_id = $this->buyers->add_transaction_shipdet($data_shiipping_det);

				// Buyer Payment Information
				$email_data['user'] =  $user;
				$email_data['transaction'] =  $this->buyers->get_trasaction_detail($bt_id);
				$email_data['ship'] =  $this->buyers->get_trasaction_detailShipping($bts_id);
				$email_data['email_type'] = "Send Pre Invoice";
				$email_content = $this->load->view('email/email-buyer-transaction',$email_data, true);

				//$email_content;

				// Buyer Payment Email Format
				$subject = "Oceantailer: Invoice Information";
				$from = "noreply-oceantailer@oceantailer.com";
				$sender = "http://www.oceantailer.com";
				$to = "jamesan2k@gmail.com, ".$user->u_email;

				// Send email to new Buyer
				//$this->send_message($email_content, $subject, $to, $from, $sender);

				$this->cart->destroy();//destroy all content in the cart

				$data = array('result' => 1, 'invoice' => $invoice, 'fullname' => $user->u_fname.$user->u_lname);

				$html_result = $this->load->view('buyer/buyer-payment-result',$data, TRUE);	
				$returnmessage = array( 'display' => $html_result  , 'status' => 1);
			    echo json_encode($returnmessage);

			    // Create automatically grouped payment from sepparate supplier

			    $trans_supplier_group = $this->buyers->search_shipping_list_grouped($bt_id);

			    foreach($trans_supplier_group as $group)
			    {
			    	$data_insert = array('bt_id' => $group->bt_id,
			    						 'u_supplier' => $group->invent_child_supplier,
			    						 'u_buyer' => $user->u_id,
			    						 'bsd_total_item' => $group->total_quan,
			    						 'bsd_total_paymet' => $group->total_amount,
			    						 'bsd_status' => 0,
			    						 'bsd_reason' => 'Pending');

			    	$this->buyers->buyer_supplier_detail($data_insert);
			    }

			}
		}

	}

	function rndm_strng($type,$size)
	{
		$this->load->helper('string');
		return random_string($type, $size);
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
		//echo $this->email->print_debugger();
	}	

	function test()
	{
		$trans_supplier_group = $this->buyers->search_shipping_list_grouped(31);
		echo print_r($trans_supplier_group);
	}


}