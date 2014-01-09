<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Lanz Editted - June 10, 2012
class administrator extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users');
		$this->load->model('administrators');
	}

	public function index()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			if ($user_type == 1)
			{
				$data['administrators'] = $this->administrators->adminlist();
				$this->load->view('admin/admin/admin-page',$data);
			}
		}
	}

	function add()
	{
		$this->load->view('admin/admin/admin-add-administrator');
	}

	function fix_image_setting()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$this->load->view('admin/admin/admin-fix-image');
		}
	}

	function fix_image()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$this->administrators->update_base_url_image();
		}
	}

	function addnewuser()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			if ($this->input->post('action') != "")
			{
				$action = $this->input->post('action');
				if ($action == "add")
				{
					$firstname = $this->input->post('firstname');
					$lastname = $this->input->post('lastname');
					$email = $this->input->post('email');
					$username = $this->input->post('username');
					$password = $this->input->post('password');
					$confirmpass = $this->input->post('con_pass');

					$this->load->library('form_validation');

					$this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|valid_email|xss_clean|callback_isEmailExist');
					$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|xss_clean|callback_isUserNameExist');
					$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[40]|required|xss_clean|matches[con_pass]');
					$this->form_validation->set_rules('con_pass','Confirm Password','trim|min_length[6]|max_length[40]|required|xss_clean');	

					if ($this->form_validation->run() == FALSE)
					{
						$returnmessage = array( 'message' => validation_errors() , 'status' => 0);
				        echo json_encode($returnmessage);
					}
					else
					{
						// Set activation code to blank
						$activation_code = "";

						// New admin user data
						$add_user = array(
										'u_username'  => $username,
										'u_pass'  => $this->users->encript($password),
										'u_fname'  => $firstname,
										'u_lname'  => $lastname,
										'u_email'  => $email,
										'u_type'  => 1,
										'u_status'  => 1,
										'u_admin_approve'  => 1,
										'u_verify_code'  => $activation_code,
										'u_time'  => time()
							   		);

						// Add new admin user and return ID
						$user_id = $this->users->add($add_user);

						// Prompt success
						$returnmessage = array( 'message' => "New Administrator Account Added." , 'status' => 1);
			            echo json_encode($returnmessage);

			            // Lanz Editted - June 17, 2013
			            // Administrator Activate Email Information
						$email_data['username'] = $username;
						$email_data['password'] = $password;
						$email_data['email_type'] = "Administrator Account Activate Email";
						$email_content = $this->load->view('email/email-admin-activate',$email_data, true);

						// Buyer Activate Email Format
						$subject = "Oceantailer: Administrator Account Verification ";
						$from = "noreply-oceantailer@oceantailer.com";
						$sender = "http://www.oceantailer.com";
						$to = "jamesan2k@gmail.com ,".$email;

						// Send email to new Buyer
						$this->send_message($email_content, $subject, $to, $from, $sender);
					}
				}
			}
		}
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


	// Lanz Editted - June 12, 2013
	function managepermission()
	{
		$data['id'] = $this->uri->segment(3);
		$data['permissions'] = $this->administrators->permission_lists();
		$data['assigned_permission'] = $this->administrators->assigned_permission_list($data['id']);
		$this->load->view('admin/admin/admin-add-permission', $data);
	}

	// Lanz Editted - June 13, 2013
	function assignpermission()
	{
		$id = $this->uri->segment(3);
		$perm_id = $this->input->post('val');

		$this->administrators->delete_assigned_permissions($id);
		foreach ($perm_id as $perm)
		{
			$data = array('u_id' => $id, 'p_id' => $perm);
			$this->administrators->save_assigned_permission($data);
		}

		$returnmessage = array( 'message' => "User Permission Added." , 'status' => 1);
		echo json_encode($returnmessage);
	}

	function block()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$id = $this->uri->segment(3);

			$update_array =  array('u_status' => 2);

			$this->users->update($update_array, 'u_id', $id );

			redirect('administrator','refresh');
		}
	}

	function activate()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$id = $this->uri->segment(3);

			$update_array =  array('u_status' => 1);

			$this->users->update($update_array, 'u_id', $id );

			redirect('administrator','refresh');
		}
	}

	function setting_update()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			if ($user_type == 1)
			{
				$action = $this->input->post('action');

				if($action == "authorized")
				{
					$update = array("auth_apiLogin" => $this->input->post('api_login'),
									"auth_apiKey" => $this->input->post('api_key'),
									"auth_apiSandbox" => $this->input->post('is_sandbox'));

					$result = $this->administrators->update_setting($update);
				}
				elseif($action == "supplier_settings")
				{
					$update = array("supplier_selFee" => $this->input->post('sup_fee'));

					$result = $this->administrators->update_setting($update);
				}

			}
		}
	}

	function setting_supplier()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			if ($user_type == 1) //administrator
			{

				$data['settings'] = $this->administrators->get_settings();

				$this->load->view('admin/admin/supplier-setting',$data);
			}
		}
	}
}
?>