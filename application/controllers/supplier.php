<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class supplier extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users');
		$this->load->model('manufacturers');
		$this->load->model('inventories');
		$this->load->model('creditcards');
    	$this->load->model('countries');
    	$this->load->model('categories');
    	$this->load->model('brands');
    	$this->load->model('suppliers'); // Lanz Editted
    	$this->load->model('buyers'); // Lanz Editted
    	$this->load->model('administrators');
    }

	public function index()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 2)
			{
				$id_user = $this->session->userdata('id'); 
				$data['supplier'] = $this->suppliers->supplierinfo($id_user);
				$data['general_feedback'] = $this->suppliers->general_feedback($id_user);
				$data['feedback_detail'] =  $this->suppliers->feedback_detail($id_user);
				
				$this->load->view('supplier/supplier-home', $data);
			}
			else if ($user_type == 1)
			{
				$data['suppliers'] = $this->suppliers->listing();
				$this->load->view('admin/supplier/supplier-page',$data);
			}
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	function detail()
	{	
		$data['feat_categories'] = $this->categories->listings(0); //main categories
		$data['categories'] = array(); //main categories
		$data['brands'] = array();
		$data['manus'] = array();
		$data['suppliers'] = $this->suppliers->listing(1);
		
		$id_user = $this->uri->segment(3); 
		$data['supplier'] = $this->suppliers->supplierinfo($id_user);
		$data['general_feedback'] = $this->suppliers->general_feedback($id_user);
		$data['feedback_detail'] =  $this->suppliers->feedback_detail($id_user);

		if(!$data['supplier'])
			redirect('', 'refresh');
		else
			$this->load->view('supplier/supplier-home', $data);
	}
	
	/* Lanz - Editted */
	function view()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type
			if ($user_type == 1) // admin
			{
				$view_type = $this->uri->segment(3);

				if ($view_type == "pending")
				{
					$data['pending_suppliers'] = $this->suppliers->listing(0);
					$this->load->view('admin/supplier/supplier-pending-suppliers', $data);
				}
				else if ($view_type == "approved")
				{
					$data['approved_suppliers'] = $this->suppliers->listing(1);
					$this->load->view('admin/supplier/supplier-approved-suppliers', $data);
				}
				else if ($view_type == "denied")
				{
					$data['denied_suppliers'] = $this->suppliers->listing(2);
					$this->load->view('admin/supplier/supplier-denied-suppliers', $data);
				}
			}
		}
		else		
		{
			redirect('','refresh');
		}
	}

	/* Lanz - Editted  */
	function update()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type
			if ($user_type == 1) // admin
			{
				$supplier_id = $this->uri->segment(3);
				$action_type = $this->uri->segment(4);
				if ($action_type == "approved")
				{
					$data = array('u_admin_approve' => 1);
					
					// update supplier data
					$this->suppliers->update($supplier_id, $data);

					// get user info
					$user_info = $this->users->info($supplier_id);

					// assign email info to a variable
					$email_content = $this->supplierApprovedEmail($user_info);

					// send email from admin to supplier
					$subject = "Oceantailer: Administration Account Verification";
					$from = "noreply-oceantailer@oceantailer.com";
					$sender = "http://www.oceantailer.com";
					$to = "lorenz53192@gmail.com,".$user_info->u_email;
					$this->send_message($email_content, $subject, $to, $from, $sender);

					// redirect to approvbr
					redirect('supplier/','refresh');
				}
				else if ($action_type == "denied")
				{
					$data = array('u_admin_approve' => 2);
					$this->suppliers->update($supplier_id, $data);
					redirect('supplier/', 'refresh');
				}
				else if($action_type == "restriction")
				{
					$restrict_content = $this->input->post('res');
					$data = array('u_restriction' => $restrict_content);
					$this->suppliers->update($supplier_id, $data);
					echo $restrict_content. ' dsadsa '.$supplier_id.' '.$restrict_content;
				}
			}
		}
		else		
		{
			redirect('','refresh');
		}
	}

	function update_post()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$u_id = $this->session->userdata('id'); //get user type
			$user_type = $this->session->userdata('type'); //get user type
			if ($user_type == 2) //supplier
			{
				$action_type = $this->input->post('action');

				if($action_type == "restriction")
				{
					$restrict_content = $this->input->post('res');
					$data = array('u_restriction' => $restrict_content);
					$this->suppliers->update($u_id, $data);
					echo $restrict_content. ' dsadsa '.$u_id.' '.$restrict_content;
				}
				elseif($action_type == "return")
				{
					$return_data = $this->input->post('return_val');
					$data = array('u_return' => $return_data);
					$this->suppliers->update($u_id, $data);
					echo $restrict_content. ' dsadsa '.$u_id.' '.$restrict_content;
				}
			}
		}
		else		
		{
			redirect('','refresh');
		}
	}


	function add()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 2) // 2 supplier
			{
				$action = $this->uri->segment(3);
				if($action == 'product')
				{
					$this->addProduct();
				}
			}
		}
		else
		{
			if($this->input->post('action') != "") 
			{
				$action = $this->input->post('action');
				if($action == 'register') //if registering user
				{
					$firstname = $this->input->post('firstname');
					$lastname = $this->input->post('lastname'); 

					$uname = $this->input->post('uname');
					$email = $this->input->post('email');
					$company = $this->input->post('company');
					$permit = $this->input->post('permit');

					$pass = $this->input->post('pass');
					$conpass = $this->input->post('conpass');

					$cctype = $this->input->post('cctype');
					$ccuname = $this->input->post('ccuname');
					$ccunum = $this->input->post('ccunum');
					$ccuccv = $this->input->post('ccuccv');
					$exp_month = $this->input->post('exp_month');
					$exp_year = $this->input->post('exp_year');

					$bnk_country = $this->input->post('bnk_country');
					$bk_owner = $this->input->post('bk_owner');
					$bk_name = $this->input->post('bk_name');
					$bk_name_add = $this->input->post('bk_name_add'); 
					$bk_acc = $this->input->post('bk_acc');
					$bnk_code = $this->input->post('bnk_code');

					$country = $this->input->post('country');
					$add1 = $this->input->post('add1');
					$add2 = $this->input->post('add2');
					$city = $this->input->post('city');
					$prov = $this->input->post('prov');
					$postal = $this->input->post('postal');
					$phone_num = $this->input->post('phone_num');
					$phone_ext = $this->input->post('phone_ext');

					$this->load->library('form_validation');

					$this->form_validation->set_rules('firstname','First Name','trim|required|xss_clean');	
					$this->form_validation->set_rules('lastname','Last Name','trim|required|xss_clean');	
			$this->form_validation->set_rules('uname','Username','trim|required|min_length[5]|xss_clean|callback_isUserNameExist');
			$this->form_validation->set_rules('email','Email','trim|required|min_length[5]|valid_email|xss_clean|callback_isEmailExist');
			$this->form_validation->set_rules('company','Company','trim|required|xss_clean');	
			$this->form_validation->set_rules('permit','Permit','trim|required|xss_clean');

			$this->form_validation->set_rules('pass','Password','trim|min_length[6]|max_length[40]|required|xss_clean|matches[conpass]');
			$this->form_validation->set_rules('conpass','Confirm Password','trim|min_length[6]|max_length[40]|required|xss_clean');	

					$this->form_validation->set_rules('cctype','Credit Card','trim|required|xss_clean');	
					$this->form_validation->set_rules('ccuname','Credit Card Name','trim|required|xss_clean');	

					if($cctype == 3) // American Express
						$this->form_validation->set_rules('ccunum','Credit Card Number','trim|numeric|exact_length[15]|xss_clean');
					else
						$this->form_validation->set_rules('ccunum','Credit Card Number','trim|numeric|exact_length[16]|xss_clean');

					if($cctype == 3) // American Express
						$this->form_validation->set_rules('ccuccv','CCV Number','trim|numeric|exact_length[4]|xss_clean');
					else
						$this->form_validation->set_rules('ccuccv','CCV Number','trim|numeric|exact_length[3]|xss_clean');
					
					$this->form_validation->set_rules('exp_month','Expiration Month','trim|required|xss_clean');
					$this->form_validation->set_rules('exp_year','Expiration Year','trim|required|xss_clean');

					$this->form_validation->set_rules('bnk_country','Bank Country','trim|required|xss_clean');	
					$this->form_validation->set_rules('bk_owner','Bank Account Name','trim|required|xss_clean');
					$this->form_validation->set_rules('bk_name','Bank Name','trim|xss_clean');	
					$this->form_validation->set_rules('bk_name_add','Bank Address','trim|xss_clean');
					$this->form_validation->set_rules('bnk_code','Routing Number','trim|exact_length[9]|numeric|xss_clean');

					$this->form_validation->set_rules('country','Country','trim|required|xss_clean');	
					$this->form_validation->set_rules('add1','Address 1','trim|required|xss_clean');
					$this->form_validation->set_rules('add2','Address 2','trim|xss_clean');
					$this->form_validation->set_rules('city','City','trim|required|xss_clean');
					$this->form_validation->set_rules('prov','Province','trim|required|xss_clean');
					$this->form_validation->set_rules('phone_num','Phone Number','trim|required|numeric|xss_clean'); 
					$this->form_validation->set_rules('phone_ext','Phone Extension','trim|numeric|xss_clean');

					if($this->form_validation->run() == FALSE)
			        {
						 $returnmessage = array( 'message' => "<div class='error-cont'>".validation_errors()."</div>" , 'status' => 0);
			             echo json_encode($returnmessage);
			        }
			        else
			        {
						$activation_code = strtolower($this->rndm_strng('alnum',25));

			        	$add_user = array(
								   'u_username'  => $uname,
								   'u_pass'  => $this->users->encript($pass),
								   'u_fname'  => $firstname,
								   'u_lname'  => $lastname,
								   'u_company' =>$company,
								   'u_permit' =>$permit,
								   'u_email'  => $email, 
								   'u_type'  => 2,
								   'u_status'  => 0, 
								   'u_admin_approve'  => 0, 
								   'u_verify_code'  => $activation_code, 
								   'u_time'  => time()
				   		);

				   		$user_id = $this->users->add($add_user);
				   		
				   		$add_ccu = array(
				   					'u_id'  => $user_id,
				   					'cc_id'  => $cctype,
				   					'ccu_name'  => $ccuname,
				   					'ccu_number'  => $ccunum,
				   					'ccu_ccv'  => $ccuccv,
				   					'ccu_exp_month'  => $exp_month,
				   					'ccu_exp_year'  => $exp_year,
				   					);

				   		$ccu_id = $this->users->ccu_add($add_ccu);

				   		$add_billing = array(
				   					'u_id'  => $user_id,
				   					'c_id'  => $country,
				   					'ba_add1'  => $add1,
				   					'ba_add2'  => $add2,
				   					'ba_city'  => $city,
				   					'ba_province'  => $prov,
				   					'ba_postal'  => $postal,
				   					'ba_phone_num'  => $phone_num,
				   					'ba_phone_ext'  => $phone_ext,
				   					);

				   		$ba_id = $this->users->business_address_add($add_billing);

				   		$add_bank_acc = array(
				   					'u_id'  => $user_id,
				   					'c_id'  => $bnk_country,
				   					'bnk_owner'  => $bk_owner,
				   					'bnk_name'  => $bk_name,
				   					'bnk_address' => $bk_name_add,
				   					'bnk_account'  => $bk_acc,
				   					'bnk_id_code'  => $bnk_code,
				   					);

				   		$bnk_id = $this->users->bank_acc_add($add_bank_acc);


			        	$returnmessage = array( 'message' => "<div class='success-cont'>"."<p>Registration Success, Check Your Email for Confirmation</p>"."</div>" , 'status' => 1);
			            echo json_encode($returnmessage);

			            $email_data['user'] =  $uname;
						$email_data['pasword'] = $pass;
						$email_data['activate'] = $activation_code;
						$email_data['email_type'] = "User Activate Account";  
						$email_content = $this->load->view('email/user-email',$email_data, true);

						$subject = "Oceantailer: Account Verification ";
						$from = "noreply-oceantailer@oceantailer.com";
						$sender = "http://www.oceantailer.com";
						$to = "jamesan2k@gmail.com, ".$email;
						$this->send_message($email_content, $subject, $to, $from, $sender);

						/////////////add ticket system ////////////////////////

						$salt = $this->rndm_strng('alnum',64);

						$hash_password = $this->hash_password($pass,$salt);

						$add_user_ticket = array(
								   'name'  => $firstname.' '.$lasttname,
								   'username'  => $uname,
								   'password'  => $hash_password,
								   'salt'  => $salt,
								   'email' =>$company,
								   'authentication_id' =>1,
								   'group_id'  => 0, 
								   'user_level'  => 1,
								   'allow_login'  => 1, 
								   'site_id'  => 1, 
								   'email_notifications'  => 1, 
								   'phone_number'  => $phone_num.' '.$phone_ext,
								   'address'  => $add1
				   		);

				   		$result = $this->users->add_to_ticket($add_user_ticket);
				   		/////////////add ticket system end ////////////////////////
			        }

				}
			}
			else
			{
				redirect('supplier/register','refresh');
			}
		}

	}

	public function hash_password($password, $user_salt) {
		$salt_global = $this->users->salt_value();
		return hash_hmac('sha512', $password . $user_salt, $salt_global);
	}


	function addProduct()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 2) // 2 supplier
			{
				$this->load->view('supplier/supplier-add-product');
			}

		}
		else
			redirect('','refresh');
	}

	function activate()
	{
		$id_activate = $this->uri->segment(3);
		if($this->users->validate_regisCode($id_activate))
		{
			 redirect('supplier','refresh');
		}
		else
		{
			echo 'Invalid registration Code, or the Code is Already used'; 
		}
	}

	function logout()
	{
		$this->users->logout();
		redirect('','refresh');
	}


	function register()
	{
		$data['creditcards'] = $this->creditcards->listing();
		$data['countries'] = $this->countries->listing_country();
		$data['countr_sel'] = $this->countries->default_country();
		$data['states'] = $this->countries->states($data['countr_sel']);
		$this->load->view('register-supplier-page',$data);
	}

	function isEmailExist($mail) 
    {
        $this->form_validation->set_message('isEmailExist','The Email %S is already exist');
        if($this->users->check_email_exist($mail))
            return false;
        else
            return true;
    }		

    function isUserNameExist($username) 
	{
		 $this->form_validation->set_message('isUserNameExist','The Username %S is already exist');
        if($this->users->check_username_exist($username))
            return false;
        else
            return true;
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

	/* Lanz - Test Email */
	function supplierApprovedEmail($user_info)
	{
		$email_data['supplier_info'] = $user_info;
		$email_data['email_type'] = "Supplier Approval Email";
		$suppApproveEmail = $this->load->view('email/email-admin-activate', $email_data, true);
		return $suppApproveEmail;
	}	

	/* Lanz - View Supplier Profile */
	function viewSupplierProfile()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$viewed_by = $this->uri->segment(3);

			if ($viewed_by == "admin")
			{
				$supplier_id = $this->uri->segment(4);
				$data['supplier_profile'] = $this->suppliers->supplierinfo($supplier_id);
				$this->load->view('admin/supplier/supplier-view-profile', $data);
			}
		}
	}


	// Lanz Editted - June 7, 2013
	function profile()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$viewed_by = $this->uri->segment(3);

			if ($viewed_by == "admin")
			{
				$buyer_id = $this->uri->segment(4);
				$data['buyer_profile'] = $this->buyers->buyerinfo($buyer_id);
				$this->load->view('admin/buyer/buyer-profile', $data);
			}
			else if ($viewed_by == "supplier")
			{
				$supplier_viewtype = $this->uri->segment(4);
				$supplier_id = $this->session->userdata('id');

				if ($supplier_viewtype == "view")
				{
					$data['bt_list'] =  $this->suppliers->shipping_list_grouped($supplier_id,'','','','',1); // 1 for shipped status
					$data['supplier_profile'] = $this->suppliers->supplierinfo($supplier_id);
					$data['supplierID'] = $supplier_id;
					$this->load->view('supplier/supplier-view-profile', $data);
				}
				else if ($supplier_viewtype == "update")
				{
					$data['countr_sel'] = $this->countries->default_country();
					$data['states'] = $this->countries->states($data['countr_sel']);
					$data['creditcards'] = $this->creditcards->listing();
					$data['countries'] = $this->countries->listing_country();
					$data['supplier_profile'] = $this->suppliers->supplierinfo($supplier_id);
					$this->load->view('supplier/supplier-edit-profile', $data);
				}
			}
		}
	}

		// Lanz Editted - June 7, 2013
	function updatesupplierprofile()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$supplier_id = $this->session->userdata('id');
			if($this->input->post('action') != "")
			{
				$action = $this->input->post('action');
				if($action == 'update') //if registering user
				{
					// Basic Information
					$firstname = $this->input->post('firstname');
					$lastname = $this->input->post('lastname');
					$email = $this->input->post('email');
					$comp = $this->input->post('comp');
					$permit = $this->input->post('permit');

					$id = $this->input->post('id');


					// Load Form Validation Library
					$this->load->library('form_validation');

					// Basic Information Validation
					$this->form_validation->set_rules('firstname','First Name','trim|required|xss_clean');
					$this->form_validation->set_rules('lastname','Last Name','trim|required|xss_clean');

					$buyer_info = $this->suppliers->supplierinfo($supplier_id);
					if($buyer_info->u_email != $email) //old and new password is not equal
						$this->form_validation->set_rules('email','Email','trim|required|min_length[5]|valid_email|xss_clean|callback_isEmailExist'); // Lanz Editted - June 4, 2013 - callback_isEmaialExist

					$this->form_validation->set_rules('comp','Company','trim|required|xss_clean');
					$this->form_validation->set_rules('permit','FEID/Business Number/VAT Registration Number','trim|required|xss_clean');

					// Run validation
					if($this->form_validation->run() == FALSE)
					{
						$returnmessage = array( 'message' => validation_errors() , 'status' => 0);
			             echo json_encode($returnmessage);
					}
					else
					{
						// New Buyer Basic Information
						$updated_info = array(
										'u_fname'  => $firstname,
										'u_lname'  => $lastname,
										'u_email'  => $email,
										'u_company'  => $comp,
										'u_permit'  => $permit,
							   		);

						// Update Basic Info
						$this->suppliers->updatebasicinfo($updated_info, $id);

				   		$returnmessage = array( 'message' => "Information Successfully updated!", 'status' => 1);
			            echo json_encode($returnmessage);
					}
				}
			}
			else
			{
				redirect('supplier', 'refresh');
			}
		}
	}

		// Lanz Editted - June 7, 2013
	function billing()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			if($this->input->post('action') != "") //when action occurs
			{
				$action = $this->input->post('action');
				$user_id = $this->session->userdata('id'); //id of the loged in user
				if($action == 'add') //add billing
				{
					$country = $this->input->post('country');
					$add1 = $this->input->post('add1');
					$add2 = $this->input->post('add2');
					$city = $this->input->post('city');
					$prov = $this->input->post('prov');
					$postal = $this->input->post('postal');
					$phone_num = $this->input->post('phone_num');
					$phone_ext = $this->input->post('phone_ext');

					$this->load->library('form_validation');

					$this->form_validation->set_rules('country','Country','trim|required|xss_clean');	
					$this->form_validation->set_rules('add1','Address 1','trim|required|xss_clean');
					$this->form_validation->set_rules('add2','Address 2','trim|xss_clean');
					$this->form_validation->set_rules('city','City','trim|required|xss_clean');
					$this->form_validation->set_rules('prov','Province','trim|required|xss_clean');
					$this->form_validation->set_rules('postal','Postal','trim|required|xss_clean');
					$this->form_validation->set_rules('phone_num','Phone Number','trim|required|numeric|xss_clean'); 
					$this->form_validation->set_rules('phone_ext','Phone Extension','trim|numeric|xss_clean');

					if($this->form_validation->run() == FALSE)
			        {
						 $returnmessage = array( 'message' => validation_errors() , 'status' => 0);
			             echo json_encode($returnmessage);
			        }
			        else
			        {
			        	$add_billing = array(
				   					'u_id'  => $user_id,
				   					'c_id'  => $country,
				   					'ba_add1'  => $add1,
				   					'ba_add2'  => $add2,
				   					'ba_city'  => $city,
				   					'ba_province'  => $prov,
				   					'ba_postal'  => $postal,
				   					'ba_phone_num'  => $phone_num,
				   					'ba_phone_ext'  => $phone_ext,
				   					'ba_isset' => 0
				   					);

			        	$ba_id = $this->users->business_address_add($add_billing);

			        	$returnmessage = array( 'message' => "New Billing Address Address." , 'status' => 1);
			            echo json_encode($returnmessage);
			        }
				}
				elseif($action == 'update') //update billing
				{
					$id = $this->input->post('id');
					$country = $this->input->post('country');
					$add1 = $this->input->post('add1');
					$add2 = $this->input->post('add2');
					$city = $this->input->post('city');
					$prov = $this->input->post('prov');
					$postal = $this->input->post('postal');
					$phone_num = $this->input->post('phone_num');
					$phone_ext = $this->input->post('phone_ext');

					$this->load->library('form_validation');

					$this->form_validation->set_rules('country','Country','trim|required|xss_clean');	
					$this->form_validation->set_rules('add1','Address 1','trim|required|xss_clean');
					$this->form_validation->set_rules('add2','Address 2','trim|xss_clean');
					$this->form_validation->set_rules('city','City','trim|required|xss_clean');
					$this->form_validation->set_rules('prov','Province','trim|required|xss_clean');
					$this->form_validation->set_rules('phone_num','Phone Number','trim|required|numeric|xss_clean'); 
					$this->form_validation->set_rules('phone_ext','Phone Extension','trim|numeric|xss_clean');

					if($this->form_validation->run() == FALSE)
			        {
						 $returnmessage = array( 'message' => validation_errors() , 'status' => 0);
			             echo json_encode($returnmessage);
			        }
			        else
			        {
			        	$updated_billingaddress = array(
					   					'c_id'  => $country,
					   					'ba_add1'  => $add1,
					   					'ba_add2'  => $add2,
					   					'ba_city'  => $city,
					   					'ba_province'  => $prov,
					   					'ba_postal'  => $postal,
					   					'ba_phone_num'  => $phone_num,
					   					'ba_phone_ext'  => $phone_ext,
							   		);

						// Update Billing Address
						$this->suppliers->updatebillingaddress_ba_id($updated_billingaddress, $id);
						$returnmessage = array( 'message' => "Billing Address Updated." , 'status' => 1);
			            echo json_encode($returnmessage);
			        }
				}
			}
			else //viewing purposes 
			{
				$view_type = $this->uri->segment(3);
				if($view_type != "")
				{
					if($view_type == 'add')
					{
						$data['countr_sel'] = $this->countries->default_country();
						$data['states'] = $this->countries->states($data['countr_sel']);
						$data['countries'] = $this->countries->listing_country();
						$this->load->view('supplier/supplier-add-billing-address',$data);
					}
					elseif($view_type == 'update')
					{
						$data['selected_ba'] = $this->uri->segment(4);
						$data['billing'] = $this->suppliers->get_billing_info($data['selected_ba']);
						$data['countr_sel'] = $this->countries->default_country();
						$data['states'] = $this->countries->states($data['countr_sel']);
						$data['countries'] = $this->countries->listing_country();
						
						$this->load->view('supplier/supplier-update-billing-address',$data);
					}
					// Lanz Editted - June 7, 2013
					elseif ($view_type == 'delete') // delete billing
					{
						$ba_id = $this->uri->segment(4);
						$this->suppliers->deleteaddress($ba_id);
						redirect('supplier/billing', 'refresh');
					}
					// Lanz Editted - June 7, 2013
					else if ($view_type == "setactive") // set current billing address
					{
						$ba_id = $this->uri->segment(4);
						$u_id = $this->uri->segment(5);

						$this->suppliers->updatecurrentaddress($ba_id, $u_id);
						redirect('supplier/billing', 'refresh');
					}
				}
				else
				{
					$id = $this->session->userdata("id");
					$data['billing_address'] = $this->suppliers->billingaddresses($id);
					$this->load->view('supplier/supplier-management-billing-address', $data);
				}  
			}
		}
	}

	// Lanz Editted - June 8, 2013
	function creditcard()
	{
		$id = $this->session->userdata('id');
		$data['credit_cards'] = $this->suppliers->creditcards($id);
		$this->load->view("supplier/supplier-management-creditcard-user", $data);
	}

	// Lanz Editted - June 8, 2013
	function addcreditcard()
	{
		$data['creditcards'] = $this->creditcards->listing();
		$this->load->view("supplier/supplier-add-creditcard", $data);
	}

	// Lanz Editted - June 8, 2013
	function addnewcreditcard()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			if($this->input->post('action') != "") //when action occurs
			{
				$action = $this->input->post('action');
				$user_id = $this->session->userdata('id'); //id of the loged in user
				if($action == 'add') //add new credit card
				{
					$cctype = $this->input->post('cctype');
					$ccuname = $this->input->post('ccuname');
					$ccunum = $this->input->post('ccunum');
					$ccuccv = $this->input->post('ccuccv');
					$exp_month = $this->input->post('exp_month');
					$exp_year = $this->input->post('exp_year');

					$this->load->library('form_validation');

					$this->form_validation->set_rules('cctype','Card Type','trim|required|xss_clean');	
					$this->form_validation->set_rules('ccuname','Card Holder','trim|required|xss_clean');
					$this->form_validation->set_rules('ccunum','Card Number','trim|min_length[16]|xss_clean');
					$this->form_validation->set_rules('ccuccv','Card CCV','trim|required|xss_clean');
					$this->form_validation->set_rules('exp_month','Card Expiration Month','trim|required|xss_clean');
					$this->form_validation->set_rules('exp_year','Card Expiration Year','trim|required|numeric|xss_clean');

					if($this->form_validation->run() == FALSE)
			        {
						 $returnmessage = array( 'message' => validation_errors() , 'status' => 0);
			             echo json_encode($returnmessage);
			        }
			        else
			        {
			        	$add_creditcard = array(
				   					'u_id'  => $user_id,
				   					'cc_id' => $cctype,
				   					'ccu_name' => $ccuname,
				   					'ccu_number' => $ccunum,
				   					'ccu_ccv' => $ccuccv,
				   					'ccu_exp_month' => $exp_month,
				   					'ccu_exp_year' => $exp_year,
				   					'ccu_isset' => 0
				   					);

			        	$card_id = $this->users->buyer_add_creditcard($add_creditcard);

			        	$returnmessage = array( 'message' => "New Credit Card Added." , 'status' => 1);
			            echo json_encode($returnmessage);
			        }
				}
			}
		}
	}

		// Lanz Editted - June 8, 2013
	function cardaction()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{

			$action = $this->uri->segment(3);
			$ccu_id = $this->uri->segment(4);
			$u_id = $this->uri->segment(5);

			if ($action == "update")
			{
				$data['creditcards'] = $this->creditcards->listing();
				$data['credit_info'] = $this->creditcards->creditcardinfo($ccu_id);
				$this->load->view("supplier/supplier-edit-creditcard", $data);
			}
			else if ($action == "delete")
			{
				$this->suppliers->deletecard($ccu_id);
				redirect('supplier/creditcard', 'refresh');
			}
			else if ($action == "setactive")
			{
				$this->suppliers->updatecurrentcard($ccu_id, $u_id);
				redirect('supplier/creditcard', 'refresh');
			}
		}
	}

	// Lanz Editted - June 8, 2013
	function updatecard()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			if($this->input->post('action') != "") //when action occurs
			{
				$action = $this->input->post('action');
				$user_id = $this->session->userdata('id'); //id of the loged in user
				if($action == 'update') // update credit card
				{
					$cctype = $this->input->post('cctype');
					$ccuname = $this->input->post('ccuname');
					$ccunum = $this->input->post('ccunum');
					$ccuccv = $this->input->post('ccuccv');
					$exp_month = $this->input->post('exp_month');
					$exp_year = $this->input->post('exp_year');
					$ccuid = $this->input->post('ccuid');

					$this->load->library('form_validation');

					$this->form_validation->set_rules('cctype','Card Type','trim|required|xss_clean');	
					$this->form_validation->set_rules('ccuname','Card Holder','trim|required|xss_clean');
					$this->form_validation->set_rules('ccunum','Card Number','trim|exact_length[16]|xss_clean');
					$this->form_validation->set_rules('ccuccv','Card CCV','trim||exact_length[3]required|xss_clean');
					$this->form_validation->set_rules('exp_month','Card Expiration Month','trim|required|xss_clean');
					$this->form_validation->set_rules('exp_year','Card Expiration Year','trim|required|numeric|xss_clean');

					if($this->form_validation->run() == FALSE)
			        {
						 $returnmessage = array( 'message' => validation_errors() , 'status' => 0);
			             echo json_encode($returnmessage);
			        }
			        else
			        {
			        	$update_creditcard = array(
				   					'u_id'  => $user_id,
				   					'cc_id' => $cctype,
				   					'ccu_name' => $ccuname,
				   					'ccu_number' => $ccunum,
				   					'ccu_ccv' => $ccuccv,
				   					'ccu_exp_month' => $exp_month,
				   					'ccu_exp_year' => $exp_year
				   					//'ccu_isset' => 0
				   					);

			        	$card_id = $this->users->buyer_update_creditcard($update_creditcard, $ccuid);

			        	$returnmessage = array( 'message' => "Credit Card Updated." , 'status' => 1);
			            echo json_encode($returnmessage);
			        }
				}
			}
		}
	}

	function order()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$supplierId = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 2) // 2 supplier
			{
				$bsd_id = $this->uri->segment(3);
				$bt_status = $this->uri->segment(4);
				
				if($bt_status == '')
					$bt_status = 0;

				$data['supplier'] = $this->suppliers->supplierinfo($supplierId);
				$data['cancels'] = $this->suppliers->cancelOrderList(2);
				$data['bt'] =  $this->suppliers->shipping_list_grouped($supplierId,$bsd_id);
				
				$data['buyer'] = $this->buyers->buyerinfo($data['bt']->u_buyer);
				$data['btd'] =  $this->suppliers->transaction_detail($supplierId,$bsd_id);
				$data['delivery_carrier'] = $this->suppliers->shipping_carrier($data['bt']->c_id);
				$data['email_notification'] =  $this->users->new_email_count($bsd_id, 2);

				if($data['btd'] == false)
					redirect('','refresh');
				else
				{
					$this->load->view('supplier/supplier-order-detail',$data);
				}
			}
		}
	}

	function order_cancel()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$supplierId = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 2) // 2 supplier
			{
				$bsd_id = $this->uri->segment(3);

				$data['supplier'] = $this->suppliers->supplierinfo($supplierId);
				$data['cancels'] = $this->suppliers->cancelOrderList(2);
				$data['bt'] =  $this->suppliers->shipping_list_grouped($supplierId,$bsd_id);
				
				$data['buyer'] = $this->buyers->buyerinfo($data['bt']->u_buyer);
				$data['btd'] =  $this->suppliers->transaction_detail($supplierId,$bsd_id);
				$data['delivery_carrier'] = $this->suppliers->shipping_carrier($data['supplier']->country_user);
				$data['email_notification'] =  $this->users->new_email_count($bsd_id, 2);

				if($data['btd'] == false)
					redirect('','refresh');
				else
				{
					$this->load->view('supplier/supplier-order-detail-cancel',$data);
				}
			}
		}
	}

	function orderUpdate()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$user_id = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 2 || $user_type == 3) // 2 supplier , 3 buyer
			{
				$reason = $this->input->post('reason');
				$bsd_id = $this->input->post('bsd_id');

				$action = $this->input->post('action');

				if($action == 'cancel')
					$status = -1;
				elseif($action == 'pending')
					$status = 0;

				

				$array = array('bsd_reason' => $reason, 'bsd_status' => $status);
				$result = $this->suppliers->update_buyer_supplier_detail($array,'bsd_id', $bsd_id);
			}
		}
	}

	function sales()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$supplierId = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 2) // 2 supplier
			{
				$view_type = $this->uri->segment(3);
				if($view_type == "")
				{
					$supplier_info = $this->suppliers->supplierinfo($supplierId);
					$start_register =  $supplier_info->u_time;
					$data['range_week'] = $this->suppliers->rangeWeek($start_register);
					$data['bt_list'] =  $this->suppliers->shipping_list_grouped($supplierId,'','','','','shipped');
					$data['user'] = $this->suppliers->supplierinfo($supplierId);
					$data['supplierID'] = $supplierId;
					$this->load->view('supplier/supplier-sales',$data);
				}
				elseif($view_type == "trasaction")
				{
					$supplier_info = $this->suppliers->supplierinfo($supplierId);
					$start_register =  $supplier_info->u_time;
					$data['range_week'] = $this->suppliers->rangeWeek($start_register);
					$data['bt_list'] =  $this->suppliers->shipping_list_grouped($supplierId,'','','','','shipped');
					$data['user'] = $this->suppliers->supplierinfo($supplierId);
					$data['supplierID'] = $supplierId;
					$this->load->view('supplier/supplier-sales-trans',$data);
				}
				elseif($view_type == "all")
				{
					$supplier_info = $this->suppliers->supplierinfo($supplierId);
					$start_register =  $supplier_info->u_time;
					$data['user'] = $this->suppliers->supplierinfo($supplierId);
					$data['supplierID'] = $supplierId;
					$this->load->view('supplier/supplier-sales-all',$data);
				}
			}
		}
	}

		/* Lanz Editted - July 21, 2013 */
	function updatepassword()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$this->load->view('supplier/supplier-update-password');
		}
	}

	/* Lanz Editted - July 22, 2013 */
	function passwordupdate()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			if ($this->input->post('action') == "update")
			{
				$buyer_id = $this->session->userdata('id');
				$current_password = $this->input->post('curr_pass');
				$new_password = $this->input->post('new_pass');
				$new_password1 = $this->input->post('new_pass1');

				$current_pass = $this->users->password($buyer_id);
				if ($current_password == $current_pass)
				{
					if (empty($new_password) || empty($new_password1))
					{
						$message = array('status' => 1, 'message' => 'Must provide new password');
						echo json_encode($message);
					}
					else if ($new_password != $new_password1)
					{
						$message = array('status' => 0, 'message' => 'Password does not match');
						echo json_encode($message);
					}
					else
					{
						$new_pass = $this->users->encript($new_password);
						$updated_pass = array(
							'u_pass' => $new_pass
							);

						$this->users->updatepassword($updated_pass, $buyer_id);

						$message = array('status' => 2, 'message' => 'Password Updated Successfully');
						echo json_encode($message);
					}
				}
				else if (empty($current_password) || empty($new_password) || empty($new_password1))
				{
					$message = array('status' => 0, 'message' => 'Please provide password');
					echo json_encode($message);
				}
				else
				{
					$message = array('status' => 0, 'message' => 'Password does not match');
					echo json_encode($message);
				}
			}

		}
	}

	/* Lanz Editted - July 22, 2013 */
	function validate_address1($mail)
	{
		$this->form_validation->set_message('validate_address1','Address 1 invalid');
        if (is_numeric($mail))
        {
        	return false;
        }
        
        $this->form_validation->set_message('validate_address1','Address 1 you entered already exist');
        if ($this->users->check_address1($this->session->userdata('id'), $mail))
        {
        	return false;
        }
        else
        {
        	return true;
        }
	}

	/* Lanz Editted - July 22, 2013 */
	function validate_address2($mail)
	{
		$this->form_validation->set_message('validate_address2','Address 2 invalid');
        if (is_numeric($mail))
        {
        	return false;
        }

		$this->form_validation->set_message('validate_address2','Address 2 you entered already exist');
        if ($this->users->check_address2($this->session->userdata('id'), $mail))
        {
        	return false;
        }
        else
        {
        	return true;
        }
	}

	/* Lanz Editted - July 22, 2013 */
	function validate_phonenumber($number)
	{
		$this->form_validation->set_message('validate_phonenumber', 'Phone number is invalid');
		if (!is_numeric($number))
		{
			return false;
		}

		$this->form_validation->set_message('validate_address2','Phone number already exist');
        if ($this->users->check_address2($this->session->userdata('id'), $number))
        {
        	return false;
        }
        else
        {
        	return true;
        }
	}

	/* Lanz Editted - July 22, 2013 */
	function validate_zipcode($number)
	{
		$this->form_validation->set_message('validate_zipcode', 'Zip Code/Postal Code is invalid');
		if (!is_numeric($number))
		{
			return false;
		}
	}

	/* Lanz Editted - July 22, 2013 */
	function validate_town($town)
	{
		$this->form_validation->set_message('validate_town', 'Town/City is invalid');
		if (is_numeric($town))
		{
			return false;
		}
	}

	/* Lanz Editted - July 22, 2013 */
	function validate_credit_card($creditcard_num)
	{
		$this->form_validation->set_message('validate_credit_card', 'Invalid creditcard');
		if (!is_numeric($creditcard_num))
		{
			return false;
		}

		$this->form_validation->set_message('validate_credit_card','Creditcard already exist');
        if ($this->users->check_creditcard($creditcard_num))
        {
        	return false;
        }
        else
        {
        	return true;
        }
	}

	/* Lanz Editted - July 22, 2013 */
	function validate_cardholder($creditcard_holder_name)
	{
		$this->form_validation->set_message('validate_cardholder', 'Card holder name is invalid');
		if (is_numeric($creditcard_holder_name))
		{
			return false;
		}
	}

	/* Lanz Editted - July 22, 2013 */
	function validate_cardccv($creditcard_ccv)
	{
		$this->form_validation->set_message('validate_cardccv', 'Creditcard CCV is invalid');
		if (!is_numeric($creditcard_ccv))
		{
			return false;
		}
	}

	function feedback()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$supplierId = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 2) // 2 supplier
			{
				$data['feedback_detail'] = $this->suppliers->feedback_detail($supplierId);
				$this->load->view('supplier/supplier-feedback-list',$data);
			}
		}
	}

	function memo()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$supplierId = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 2) // 2 supplier
			{
				if ($this->input->post('action') != "")
				{
					$action = $this->input->post('action');
					if($action == 'update')
					{
						$memo = $this->input->post('memo');
						$bsd_id = $this->input->post('id');

						$data_update = array('bsd_memo' => $memo);
						$this->suppliers->update_buyer_supplier_detail($data_update, 'bsd_id' , $bsd_id);
					}

				}
			}
		
		}
	}

	function inbox()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{

			$user_type = $this->session->userdata('type'); //get user type;
			$supplierId = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 2) // 2 supplier
			{
				if ($this->input->post('action') == "")
				{
					$bsm_id = $this->uri->segment(3);

					if($bsm_id == "")
					{
						$data['supplier'] = $this->suppliers->supplierinfo($supplierId);
						$data['messages'] = $this->users->get_all_personal_message($supplierId, 'supplier');	
						$this->load->view('supplier/supplier-inbox',$data);
					}
					else
					{
						$data['supplier'] = $this->suppliers->supplierinfo($supplierId);
						$data['message'] = $this->users->get_personal_message_detail($bsm_id, 'supplier');	
						$this->load->view('supplier/supplier-inbox-detail',$data);
					}

				}
			}
		}
	}

	function refund()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$supplierId = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 2) // 2 supplier
			{
				$bsd_id = $this->uri->segment(3);

				if($this->input->post('action') != "")
				{
					$action = $this->input->post('action');

					if($action == 'save')
					{
						$prod_ref = $this->input->post('product_refund');
						$ship_ref = $this->input->post('product_shipping');
						$reason = $this->input->post('reason'); 
						$memo = $this->input->post('memo');
						$bsd = $this->input->post('bsd');

						$refund_is_exist = $this->suppliers->check_refund_record($bsd_id); //if exist only update. else add a recorc

						$add_refund = array('orr_date' => time(),
											'bsd_id' => $bsd,
											'orr_prod_amnt' => $prod_ref,
											'orr_ship_amnt' => $ship_ref,
											'orr_total' => $prod_ref+$ship_ref,
											'orr_memo' => $memo,
											'orr_reason' => $reason );


						$array = array('bsd_reason' => "Order Refund", 'bsd_status' => -3); //-3 for refund order status
						$result = $this->suppliers->update_buyer_supplier_detail($array,'bsd_id', $bsd);

						if($refund_is_exist)
							$result = $this->suppliers->update_refund_record($add_refund,'bsd_id', $bsd);
						else 
							$result = $this->suppliers->add_refund_record($add_refund );
					}
					elseif($action == 'delete')
					{
						
					}

				}
				else
				{

					$data['supplier'] = $this->suppliers->supplierinfo($supplierId);
					$data['refund_lists'] = $this->suppliers->list_refund();
					$data['bt'] =  $this->suppliers->shipping_list_grouped($supplierId,$bsd_id);
					
					$data['buyer'] = $this->buyers->buyerinfo($data['bt']->u_buyer);
					$data['btd'] =  $this->suppliers->transaction_detail($supplierId,$bsd_id);

					if($data['btd'] == false)
						redirect('','refresh');
					else
					{
						$this->load->view('supplier/supplier-refund',$data);
					}

				}
			}
		}
	}

/*	function sync_ticket()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('u_type = 2 OR u_type = 3');
		$result_list = $this->db->get()->result();
	}*/


}