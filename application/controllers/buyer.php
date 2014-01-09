<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Lanz Editted */
class buyer extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('buyers');
		$this->load->model('suppliers');
		$this->load->model('users');
		$this->load->model('creditcards');
		$this->load->model('countries');
		$this->load->model('categories');
		$this->load->model('manufacturers');
		$this->load->model('inventories');
		$this->load->model('administrators');
	}

	function index()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 3)
			{	
				$data['feat_categories'] = $this->categories->listings(0); //main categories
				$data['categories'] = array(); //main categories
				$data['brands'] = array();
				$data['manus'] = array();
				$data['suppliers'] = $this->suppliers->listing(1);
				$this->load->view('buyer/buyer-home',$data);
			}
			else if ($user_type == 1)
			{

				$data['buyer_listings'] = $this->buyers->listing();
				$this->load->view('admin/buyer/buyer-page', $data);
			}
		}
		else
			redirect('','refresh');
	}

	/* Lanz Editted - July 21, 2013 */
	function updatepassword()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$this->load->view('buyer/buyer-update-password');
		}
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
					$data['pending_buyers'] = $this->buyers->listing(0);
					$this->load->view('admin/buyer/buyer-pending-suppliers', $data);
				}
				else if ($view_type == "approved")
				{
					$data['approved_buyers'] = $this->buyers->listing(1);
					$this->load->view('admin/buyer/buyer-approved-suppliers', $data);
				}
				else if ($view_type == "denied")
				{
					$data['denied_buyers'] = $this->buyers->listing(2);
					$this->load->view('admin/buyer/buyer-denied-suppliers', $data);
				}
			}
		}
		else		
		{
			redirect('','refresh');
		}
	}


	/* Lanz Editted - July 21, 2013 */
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
					$this->buyers->update($supplier_id, $data);

					// get user info
					$user_info = $this->users->info($supplier_id);

					// assign email info to a variable
					$email_content = $this->buyerApprovedEmail($user_info);

					// send email from admin to supplier
					$subject = "Oceantailer: Administration Account Verification";
					$from = "noreply-oceantailer@oceantailer.com";
					$sender = "http://www.oceantailer.com";
					$to = "lorenz53192@gmail.com,".$user_info->u_email;
					$this->send_message($email_content, $subject, $to, $from, $sender);

					// redirect to approvbr
					redirect('buyer/view/pending','refresh');
				}
				else if ($action_type == "denied")
				{
					$data = array('u_admin_approve' => 2);
					$this->buyers->update($supplier_id, $data);
					redirect('buyer/view/pending', 'refresh');
				}
			}

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

	// Lanz Editted - June 4, 2013
	function add()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			redirect('buyer', 'refresh');
		}
		else
		{
			if($this->input->post('action') != "")
			{
				$action = $this->input->post('action');
				if($action == 'register') //if registering user
				{
					// Basic Information
					$firstname = $this->input->post('firstname');
					$lastname = $this->input->post('lastname'); 
					$uname = $this->input->post('uname');
					$email = $this->input->post('email');
					$pass = $this->input->post('pass');
					$conpass = $this->input->post('conpass');

					// Credit Card Information
					$cctype = $this->input->post('cctype');
					$ccuname = $this->input->post('ccuname');
					$ccunum = $this->input->post('ccunum');
					$ccuccv = $this->input->post('ccuccv');
					$exp_month = $this->input->post('exp_month');
					$exp_year = $this->input->post('exp_year');

					// Billing Address Information
					$country = $this->input->post('country');
					$add1 = $this->input->post('add1');
					$add2 = $this->input->post('add2');
					$city = $this->input->post('city');
					$prov = $this->input->post('prov');
					$postal = $this->input->post('postal');
					$phone_num = $this->input->post('phone_num');
					$phone_ext = $this->input->post('phone_ext');

					// Load Form Validation Library
					$this->load->library('form_validation');

					// Basic Information Validation
					$this->form_validation->set_rules('firstname','First Name','trim|required|xss_clean');
					$this->form_validation->set_rules('lastname','Last Name','trim|required|xss_clean');
					$this->form_validation->set_rules('uname','Username','trim|required|min_length[5]|xss_clean|callback_isUserNameExist');
					$this->form_validation->set_rules('email','Email','trim|required|min_length[5]|valid_email|xss_clean|callback_isEmailExist');
					$this->form_validation->set_rules('pass','Password','trim|min_length[6]|max_length[40]|required|xss_clean|matches[conpass]');
					$this->form_validation->set_rules('conpass','Confirm Password','trim|min_length[6]|max_length[40]|required|xss_clean');

					// Credit Card Validation
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

					// Billing Address Validation
					$this->form_validation->set_rules('country','Country','trim|required|xss_clean');	
					$this->form_validation->set_rules('add1','Address 1','trim|required|xss_clean');
					$this->form_validation->set_rules('add2','Address 2','trim|xss_clean');
					$this->form_validation->set_rules('city','City','trim|required|xss_clean');
					$this->form_validation->set_rules('prov','Province','trim|required|xss_clean');
					$this->form_validation->set_rules('phone_num','Phone Number','trim|required|numeric|xss_clean'); 
					$this->form_validation->set_rules('phone_ext','Phone Extension','trim|numeric|xss_clean');

					// Run validation
					if($this->form_validation->run() == FALSE)
					{
						$returnmessage = array( 'message' => "<div class='error-cont'>".validation_errors()."</div>" , 'status' => 0);
			             echo json_encode($returnmessage);
					}
					else
					{
						// Generate Activaton Code
						$activation_code = strtolower($this->rndm_strng('alnum',25));

						// New Buyer Information
						$add_user = array(
										'u_username'  => $uname,
										'u_pass'  => $this->users->encript($pass),
										'u_fname'  => $firstname,
										'u_lname'  => $lastname,
										'u_email'  => $email, 
										'u_type'  => 3,
										'u_status'  => 0,
										'u_admin_approve'  => 1,
										'u_verify_code'  => $activation_code, 
										'u_time'  => time()
							   		);

						// Add new buyer and return ID
						$user_id = $this->users->add($add_user);

						// New Buyer Credit Card Information
						$add_ccu = array(
							   			'u_id'  => $user_id,
							   			'cc_id'  => $cctype,
							   			'ccu_name'  => $ccuname,
							   			'ccu_number'  => $ccunum,
							   			'ccu_ccv'  => $ccuccv,
							   			'ccu_exp_month'  => $exp_month,
							   			'ccu_exp_year'  => $exp_year,
							   			'ccu_isset' => 1 // Lanz Editted - June 4, 2013
							   		);

						// Add new buyer credit card and return ID
						$ccu_id = $this->users->ccu_add($add_ccu);

						// New Buyer Billing Address
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
				   					'ba_isset' => 1 // Lanz Editted - June 4, 2013
				   					);

				   		$ba_id = $this->users->business_address_add($add_billing);

				   		$returnmessage = array( 'message' => "<div class='success-cont'>"."<p>Registration Success, Check Your Email for Confirmation</p>"."</div>" , 'status' => 1);
			            echo json_encode($returnmessage);

						// Buyer Activate Email Information
						$email_data['firstname'] =  $firstname;
						$email_data['lastname'] = $lastname;
						$email_data['activate'] = $activation_code;
						$email_data['email_type'] = "Buyer Activate Email";
						$email_content = $this->load->view('email/email-admin-activate',$email_data, true);

						//echo $email_content;

						// Buyer Activate Email Format
						$subject = "Oceantailer: Account Verification ";
						$from = "noreply-oceantailer@oceantailer.com";
						$sender = "http://www.oceantailer.com";
						$to = "jamesan2k@gmail.com, ".$email;

						// Send email to new Buyer
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
				// Redirect to Buyer Register Page
				redirect('buyer/register', 'refresh');
			}
		}
	}

	public function hash_password($password, $user_salt) {
		$salt_global = $this->users->salt_value();
		return hash_hmac('sha512', $password . $user_salt, $salt_global);
	}


	function register()
	{
		$data['creditcards'] = $this->creditcards->listing();
		$data['countries'] = $this->countries->listing_country();
		$data['countr_sel'] = $this->countries->default_country();
		$data['states'] = $this->countries->states($data['countr_sel']);
		$this->load->view('register-buyer-page', $data);
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

	function buyerApprovedEmail($user_info)
	{
		$email_data['buyer_info'] = $user_info;
		$email_data['email_type'] = "Buyer Activate Email";
		$buyerApproveEmail = $this->load->view('email/email-admin-activate', $email_data, true);
		return $buyerApproveEmail;
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

	function activate()
	{
		$id_activate = $this->uri->segment(3);
		if($this->users->validate_regisCode($id_activate))
		{
			 redirect('buyer','refresh');
		}
		else
		{
			echo 'Invalid registration Code, or the Code is Already used';
		}
	}

	// Lanz Editted - May 31, 2013
	function profile()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$viewed_by = $this->uri->segment(3);
			if ($viewed_by == "admin")
			{
				$buyer_id = $this->uri->segment(4);
				//echo $buyer_id;
				$data['buyer_profile'] = $this->buyers->buyerinfo($buyer_id);
				$this->load->view('admin/buyer/buyer-profile', $data);
			}
			else if ($viewed_by == "buyer")
			{
				$buyer_viewtype = $this->uri->segment(4);
				$buyer_id = $this->session->userdata('id');

				if ($buyer_viewtype == "view")
				{
					$data['buyer_profile'] = $this->buyers->buyerinfo($buyer_id);
					$this->load->view('buyer/buyer-view-profile', $data);
				}
				else if ($buyer_viewtype == "update")
				{
					$data['countr_sel'] = $this->countries->default_country();
					$data['states'] = $this->countries->states($data['countr_sel']);
					$data['creditcards'] = $this->creditcards->listing();
					$data['countries'] = $this->countries->listing_country();
					$data['buyer_profile'] = $this->buyers->buyerinfo($buyer_id);
					$this->load->view('buyer/buyer-edit-profile', $data);
				}
			}
		}
	}

	// Lanz Editted - May 31, 2013
	function updatebuyerprofile()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$buyer_id = $this->session->userdata('id');
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

					$buyer_info = $this->buyers->buyerinfo($buyer_id);
					if($buyer_info->u_email != $email) //old and new password is not equal
						$this->form_validation->set_rules('email','Email','trim|required|min_length[5]|valid_email|xss_clean|callback_isEmailExist'); // Lanz Editted - June 4, 2013 - callback_isEmaialExist

					$this->form_validation->set_rules('comp','Company','trim|required|xss_clean');
					$this->form_validation->set_rules('permit','Permit','trim|required|xss_clean');


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
										'u_permit'  => $permit
							   		);

						// Update Basic Info
						$this->buyers->updatebasicinfo($updated_info, $id);


				   		$returnmessage = array( 'message' => "Information Successfully updated!", 'status' => 1);
			            echo json_encode($returnmessage);
					}
				}
			}
			else
			{
				redirect('buyer', 'refresh');
			}
		}
	}

	// Lanz Editted - May 31, 2013
	function redirectbuyer()
	{
		$this->load->view('buyer');
	}

	function billingValidate()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 3) //when action occurs
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
		        	$returnmessage = array( 'message' => 'Billing Information Valid', 'status' => 1);
					echo json_encode($returnmessage);
		        }
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

			        	$returnmessage = array( 'message' => "New Billing Address Address." , 'status' => 1,'id' =>$ba_id);
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
						$this->buyers->updatebillingaddress_ba_id($updated_billingaddress, $id);
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
						$this->load->view('buyer/buyer-add-billing-address',$data);
					}
					elseif($view_type == 'update')
					{
						$data['selected_ba'] = $this->uri->segment(4);
						$data['billing'] = $this->buyers->get_billing_info($data['selected_ba']);
						$data['countr_sel'] = $this->countries->default_country();
						$data['states'] = $this->countries->states($data['countr_sel']);
						$data['countries'] = $this->countries->listing_country();
						
						$this->load->view('buyer/buyer-update-billing-address',$data);
					}
					// Lanz Editted - June 7, 2013
					elseif ($view_type == 'delete') // delete billing
					{
						$ba_id = $this->uri->segment(4);
						$this->buyers->deleteaddress($ba_id);
						redirect('buyer/billing', 'refresh');
					}
					// Lanz Editted - June 7, 2013
					else if ($view_type == "setactive") // set current billing address
					{
						$ba_id = $this->uri->segment(4);
						$u_id = $this->uri->segment(5);

						$this->buyers->updatecurrentaddress($ba_id, $u_id);
						redirect('buyer/billing', 'refresh');
					}
				}
				else
				{
					$id = $this->session->userdata("id");
					$data['billing_address'] = $this->buyers->billingaddresses($id);
					$this->load->view('buyer/buyer-management-billing-address', $data);
				}  
			}
		}
	}

	// Lanz Editted - June 5, 2013
	function creditcard()
	{
		$id = $this->session->userdata('id');
		$data['credit_cards'] = $this->buyers->creditcards($id);
		$this->load->view("buyer/buyer-management-creditcard-user", $data);
	}

	// Lanz Editted - June 5, 2013
	function addcreditcard()
	{
		$data['creditcards'] = $this->creditcards->listing();
		$this->load->view("buyer/buyer-add-creditcard", $data);
	}

	function validateCc()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 3) //when action occurs
			{
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
		        	$returnmessage = array( 'message' => "Credit Card Valid" , 'status' => 1);
		        	 echo json_encode($returnmessage);
		        }

			}
		}
	}

	// Lanz Editted - June 5, 2013
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
					$this->form_validation->set_rules('ccunum','Card Number','trim|required|exact_length[16]|xss_clean');
					$this->form_validation->set_rules('ccuccv','Card CCV','trim|required||exact_length[3]xss_clean');
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

			        	$returnmessage = array( 'message' => "New Credit Card Added." , 'status' => 1, 'ccid' =>$card_id);
			            echo json_encode($returnmessage);
			        }
				}
			}
		}
	}

	// Lanz Editted - June 5, 2013
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
				$this->load->view("buyer/buyer-edit-creditcard", $data);	
			}
			else if ($action == "delete")
			{
				$this->buyers->deletecard($ccu_id);
				redirect('buyer/creditcard', 'refresh');
			}
			else if ($action == "setactive")
			{
				$this->buyers->updatecurrentcard($ccu_id, $u_id);
				redirect('buyer/creditcard', 'refresh');
			}
		}
	}

	// Lanz Editted - June 6, 2013
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
					$this->form_validation->set_rules('ccunum','Card Number','trim|required|exact_length[16]|xss_clean');
					$this->form_validation->set_rules('ccuccv','Card CCV','trim|required||exact_length[3]xss_clean');
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

	// Lanz Editted - June 7, 2013
	function address()
	{
		$id = $this->session->userdata("id");
		$data['billing_address'] = $this->buyers->billingaddresses($id);
		$this->load->view('buyer/buyer-management-billing-address', $data);
	}

	// Lanz Editted - June 18, 2013
/*	function transactionslist()
	{
		$id = $this->session->userdata('id');
		$data['transactions'] = $this->buyers->transactions($id);
		$this->load->view('buyer/buyer-transactions', $data);
	}	
*/
	// James Editted - June 28, 2013
	function transaction()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			if($user_type == 2) //supplier
			{
				$id = $this->session->userdata('id');
				$data['transactions'] = $this->buyers->transactions($id);
				$this->load->view('buyer/buyer-transactions', $data);
			}
		}
	}	

	
	function order()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$user_id = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 3) // 3 buyer
			{
				$bsd_id = $this->uri->segment(3);
				//$bt_supplier = $this->uri->segment(4);
				

				$data['bt'] =  $this->buyers->shipping_list_grouped($user_id,$bsd_id);
				$data['supplier_info'] = $this->suppliers->supplierinfo($data['bt']->u_supplier);
				$data['btd'] =  $this->buyers->transaction_detail($user_id,$data['bt']->bt_id,$data['bt']->u_supplier);
				$data['cancels'] = $this->buyers->cancelOrderList(3);

				$data['email_notification'] =  $this->users->new_email_count($bsd_id, 3);
				//echo print_r($data['btd']);
				if($data['btd'] == false)
					//redirect('','refresh'); 
				{
					echo $data['bt']->bt_id.' '.$data['bt']->u_supplier;
				}
				else
				{
					$this->load->view('buyer/buyer-order-detail',$data);
				}
			}
		}

	}

	function updateOrder()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$user_id = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 3) // 3 buyer
			{
				$action = $this->input->post('action');

				if($action = 'updateStatus')
				{
					$ssiid = $this->input->post('ssiid');
					$status = $this->input->post('status');
					$update_status = array('ssi_status' => $status);

					$result = $this->buyers->update_ssi($update_status,'ssi_id',$ssiid);

				}
				else
					echo false;
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
				$action = $this->input->post('action');
				
				if($action == 'cancel')
					$status = -1;
				elseif($action == 'pending')
					$status = 0; 
				elseif($action == 'return')
					$status = -4;

				$reason = $this->input->post('reason');
				$bsd_id = $this->input->post('bsd_id');

				$array = array('bsd_reason' => $reason, 'bsd_status' => $status);
				$result = $this->suppliers->update_buyer_supplier_detail($array,'bsd_id', $bsd_id);
			}
		}
	}

	function orderCancel()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$user_id = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 3) //3 buyer
			{
				$reason = $this->input->post('reason');
				$bsd_id = $this->input->post('bsd_id');

				$array = array('bsd_reason' => $reason, 'bsd_status' => '-1');

				$result = $this->buyers->update_buyer_supplier_detail($array,'bsd_id', $bsd_id);
			}
		}
	}

	function confirmShippingFee()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$user_id = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 3) //3 buyer
			{
				$ssiid = $this->input->post('ssi');

				$data_update = array('ssi_status' => true);
				$this->buyers->update_ssi($data_update,'ssi_id',$ssiid);
				
			}
		}
				
	}

	function add_feedback()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 3)//3 buyer
			{
				$feedback = $this->input->post('feedback');
				$rate = $this->input->post('rate');
				$bsd = $this->input->post('bsd');

				$data = array('bsd_buyer_rate' => $rate,
								   'bsd_buyer_feedback' => $feedback,
								   'bsd_feedback_date' => time());

				$this->buyers->update_buyer_supplier_detail($data,'bsd_id', $bsd);
				echo 'success';

			}
		}
	}

	function inbox()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{

			$user_type = $this->session->userdata('type'); //get user type;
			$buyer_id = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 3) // 3 buyer
			{
				if ($this->input->post('action') == "")
				{
					$bsm_id = $this->uri->segment(3);

					if($bsm_id == "")
					{
						$data['buyer'] = $this->buyers->buyerinfo($buyer_id);
						$data['messages'] = $this->users->get_all_personal_message($buyer_id, 'buyer');	
						$this->load->view('buyer/buyer-inbox',$data);
					}
					else
					{
						$data['buyer'] =  $this->buyers->buyerinfo($buyer_id);
						$data['message'] = $this->users->get_personal_message_detail($bsm_id, 'buyer');	
						$this->load->view('buyer/buyer-inbox-detail',$data);
					}

				}
			}
		}
	}

	function order_cancel()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$user_id = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 3) // 2 buyer
			{
				$bsd_id = $this->uri->segment(3);

				$data['bt'] =  $this->buyers->shipping_list_grouped($user_id,$bsd_id);
				$data['supplier_info'] = $this->suppliers->supplierinfo($data['bt']->u_supplier);
				$data['btd'] =  $this->buyers->transaction_detail($user_id,$data['bt']->bt_id,$data['bt']->u_supplier);
				$data['cancels'] = $this->buyers->cancelOrderList(3);



				if($data['btd'] == false)
					redirect('','refresh');
				else
				{
					$this->load->view('buyer/buyer-order-detail-cancel',$data);
				}
			}
		}
	}

	function order_return()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$user_id = $this->session->userdata('id'); //id of the loged in user
			if($user_type == 3) // 2 buyer
			{
				$bsd_id = $this->uri->segment(3);

				$data['bt'] =  $this->buyers->shipping_list_grouped($user_id,$bsd_id);
				$data['supplier_info'] = $this->suppliers->supplierinfo($data['bt']->u_supplier);
				$data['btd'] =  $this->buyers->transaction_detail($user_id,$data['bt']->bt_id,$data['bt']->u_supplier);
				$data['returns'] = $this->buyers->orderReturnList();



				if($data['btd'] == false)
					redirect('','refresh');
				else
				{
					$this->load->view('buyer/buyer-order-return',$data);
				}
			}
		}
	}
	
}
?>