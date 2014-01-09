<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class authorized extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        //Load Neccessary Models
		$this->load->model('users');
		$this->load->model('manufacturers');
		$this->load->model('suppliers');
		$this->load->model('administrators');
		$this->load->model('banks');
		//End Load Neccessary Models
		define("AUTHORIZENET_API_LOGIN_ID", "2QusWx9Qh57j");
		define("AUTHORIZENET_TRANSACTION_KEY", "72wGtYKJ439C3x3K");
		define("AUTHORIZENET_MD5_SETTING", "");
		$this->load->library('authorizenet');
		
		
    }

    function test(){
    	$this->load->library('authorizenet');

        $this->authorizenet->setFields(
            array(
            'amount' => rand(1, 1000),
            'card_num' => '370000000000002',
            'exp_date' => '0415'
            )
        );
        $response = $this->authorizenet->authorizeAndCapture();
        echo print_r($response);
        //$this->assertTrue($response->approved);
    }


    function sample(){

		// REMEMBER YOUR AMOUNT HAS TO INCLUDE THE TAX
		$price = 10;
		$tax = number_format($price * .095,2); // Set tax
		$amount = number_format($price + $tax,2); // Set total amount


    	$this->authorizenet->setFields(
		array(
		'amount' => '10.00',
		'card_num' => '370000000000002',
		'exp_date' => '04/17',
		'first_name' => 'James',
		'last_name' => 'Angub',
		'address' => '123 Main Street',
		'city' => 'Boston',
		'state' => 'MA',
		'country' => 'USA',
		'zip' => '02142',
		'email' => 'some@email.com',
		'card_code' => '782',
		)
		);
		$response = $this->authorizenet->authorizeAndCapture();

		print_r($response);

		if ($response->approved) {
		echo "APPROVED";
		} else {
		echo "DENIED ".AUTHORIZENET_API_LOGIN_ID." ".AUTHORIZENET_TRANSACTION_KEY;
		}

    }

    function send_payment()
    {
    	if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			if ($user_type == 1) //administrator
			{
				$bank_id = $this->input->post('bnk');
				$amount = $this->input->post('total_payment');
				$supplier_id = $this->input->post('supplier_id');
				$sup_info = $this->suppliers->supplierinfo($supplier_id);

				$bnk_detail = $this->banks->get($bank_id);
				

				$bank_aba_code = $bnk_detail->bnk_id_code;
				$bank_acct_num = $bnk_detail->bnk_account;
				$bank_acct_type = "SAVINGS"; //CHECKING, BUSINESSCHECKING, SAVINGS
				$bank_name = $bnk_detail->bnk_name;
				$bank_acct_name = $bnk_detail->bnk_owner;

				
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

/*				print_r($feild_setting);
				echo "<br/><br/>";
				print_r($response);*/

				if ($response->approved) {
					

					$data_insert_payment = array('asp_amount' => $amount,
												  'u_id' => $supplier_id,
												  'bnk_id' => $bank_id,
												  'asp_date' => time(),
												  'asp_auth_respond' => json_encode($response),
												  'asp_value_send' => json_encode($feild_setting));

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
    }

    function setting(){
    	if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			if ($user_type == 1) //administrator
			{

				$data['settings'] = $this->administrators->get_settings();

				$this->load->view('admin/admin/auth-net-setting',$data);
			}
		}
    }


}