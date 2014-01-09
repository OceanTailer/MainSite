<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users');
		$this->load->model('categories');
		$this->load->model('brands');
		$this->load->model('manufacturers');
		$this->load->model('suppliers');
		$this->load->model('buyers'); 
		$this->load->model('administrators');
		define("AUTHORIZENET_API_LOGIN_ID", "2QusWx9Qh57j");
		define("AUTHORIZENET_TRANSACTION_KEY", "72wGtYKJ439C3x3K");
		define("AUTHORIZENET_MD5_SETTING", "test");
		$this->load->library('authorizenet');
    }

	public function index()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 1) //1 is admin
			{
				$id = $this->session->userdata('id');
				$data['info'] =  $this->users->info($id);
				$data['permissions'] = $this->administrators->permission_lists();
				$data['assigned_permission'] = $this->administrators->assigned_permission_list($id);
				$this->load->view('admin/home-page',$data);
			}
		}
		else
			redirect('','refresh');
	}

	function profile(){
		if ($this->session->userdata('is_login') == TRUE)
		{
			$id = $id = $this->uri->segment(3);
			$user_type = $this->session->userdata('type');
			if ($user_type == 1) // administrator
			{
				$data['user'] = $this->users->info($id);
				$data['permissions'] = $this->administrators->permission_lists();
				$data['assigned_permission'] = $this->administrators->assigned_permission_list($id);
				$this->load->view('admin/global-profile-view', $data);
			}
			
		}
	}

	function upload_category_image(){
		if ($this->session->userdata('is_login') == TRUE)
		{
			$id_user = $this->session->userdata('id'); 
			$user_type = $this->session->userdata('type'); //get user type;
			if ($user_type == 1) // administrator
			{
				$cat_id = $this->input->post('cat_id');

				$config['upload_path'] = 'categories/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '2900'; 

				$this->load->library('upload', $config);

				if ( ! $this->upload->do_upload())
				{
					$data['error'] = $this->upload->display_errors();
				}
				else
				{
					$upload_info =  $this->upload->data();
					$data['error'] = 'Your image is successfully uploaded';
					
					$data_update = array('c_default_image' => 'categories/'.$upload_info['file_name']   );
					$where = 'c_id';
					$value = $cat_id;
					$this->categories->update($data_update,$where,$value);
					
					
				}

				$level = 0;
				$data['categories'] = $this->categories->listings($level);
				$this->load->view('admin/category/category-page',$data);
			}
		}
	}

	function upload_profile()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$id_user = $this->session->userdata('id'); 
			$user_type = $this->session->userdata('type'); //get user type;
			$request = $this->input->post('request');
			if($user_type == 3) //buyer
			{	
				$error = '';
				$data['error'] = $error;
				if($request != '')
				{
					if($request == 'upload')
					{
						$config['upload_path'] = 'avatars/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '100'; 
						$config['file_name'] = $id_user.'.png';
						$config['max_width']  = '120';
						$config['max_height']  = '30';

						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload())
						{
							$data['error'] = $this->upload->display_errors();
						}
						else
						{
							$upload_info =  $this->upload->data();
							$data['error'] = 'Your Profile is Successfully Upload';
							$array_update = array('u_pic' => 'avatars/'.$upload_info['file_name']  );
							$this->users->update($array_update,'u_id', $id_user);
							
						}
					}
				}
				$data['buyer_profile'] = $this->buyers->buyerinfo($id_user);
				$this->load->view('buyer/buyer-upload-profile',$data);
			}
			elseif($user_type == 2)// Supplier
			{
				$error = '';
				$data['error'] = $error;
				if($request != '')
				{
					if($request == 'upload')
					{
						$config['upload_path'] = 'avatars/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '100'; 
						$config['file_name'] = $id_user.'.png';
						$config['max_width']  = '120';
						$config['max_height']  = '30';

						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload())
						{
							$data['error'] = $this->upload->display_errors();
						}
						else
						{
							$upload_info =  $this->upload->data();
							$data['error'] = 'Your Profile is Successfully Upload';
							$array_update = array('u_pic' => 'avatars/'.$upload_info['file_name']  );
							$this->users->update($array_update,'u_id', $id_user);
							
						}
					}
				}
				$data['buyer_profile'] = $this->buyers->buyerinfo($id_user);
				$this->load->view('supplier/supplier-upload-profile',$data);
			}
			elseif($user_type == 1)// Admin
			{
				$error = '';
				$data['error'] = $error;
				if($request != '')
				{
					if($request == 'upload')
					{
						$config['upload_path'] = 'avatars/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size']	= '100'; 
						$config['file_name'] = $id_user.'.png';
						$config['max_width']  = '120';
						$config['max_height']  = '30';

						$this->load->library('upload', $config);

						if ( ! $this->upload->do_upload())
						{
							$data['error'] = $this->upload->display_errors();
						}
						else
						{
							$upload_info =  $this->upload->data();
							$data['error'] = 'Your Profile is Successfully Upload';
							$array_update = array('u_pic' => 'avatars/'.$upload_info['file_name']  );
							$this->users->update($array_update,'u_id', $id_user);
							
						}
					}
				}
				$data['admin_profile'] = $this->users->info($id_user);
				$this->load->view('admin/admin-upload-profile',$data);
			}
		}
	}

	function login()
	{
		$username = $this->input->post('name');
		$pass = $this->input->post('pass');

		$result = $this->users->is_valid_login($username, $pass);

//		$result = array('result' => 0,'message'=> $this->users->encript($pass));
//		echo json_encode($result);

		if($result){
			$result = array('result' => 1, 'message' => 'successfully login');
			echo json_encode($result);
		}
		else{
			$result = array('result' => 0, 'message' => 'Invalid Login');
			echo json_encode($result);
		}

	}

	function logout()
	{
		$this->users->logout();
		redirect('','refresh');
	}

	function get_password()
	{
		$name = 'admin';
		$result = $this->users->encript($name);
		echo $result;
	}

	function forgotpassword()
	{
		$data['suppliers'] = $this->suppliers->listing(1);
		$data['categories'] = array(); //main categories
		$data['brands'] = array();
		$data['manus'] = array();
		$data['is_home'] = false;
		$this->load->view('forgot-password',$data);
	}

	function forgot()
	{
		$email = $this->input->post('email');
		if($this->users->check_email_exist($email))
		{
			$pass = strtolower($this->rndm_strng('alnum',5));
			$data_update = array('u_pass' => $this->users->encript($pass));

			$this->users->update($data_update,'u_email',$email);

			$user_data = $this->users->info_via_email($email);

			// Buyer Activate Email Information
			$email_data['username'] =  $user_data->u_username;
			$email_data['pass'] =  $pass;
			$email_data['email_type'] = "New Password";
			$email_content = $this->load->view('email/user-email',$email_data, true);

			//echo $pass;

			// Buyer Activate Email Format
			$subject = "Oceantailer: New Password Sent!";
			$from = "noreply-oceantailer@oceantailer.com";
			$sender = "http://www.oceantailer.com";
			$to = "".$email;

			// Send email to new Buyer
			$this->send_message($email_content, $subject, $to, $from, $sender);

			$result = array('status' => 1, 'message' => 'New Password has been sent to your Email ');
			echo json_encode($result);
		}
		else
		{
			$result = array('status' => 0, 'message' => 'Email does Not Exist');
			echo json_encode($result);
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
/*        $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
        $config['protocol']            = "smtp";*/
/*        $config['smtp_host']           = "localhost";
        $config['smtp_port']           = "25";*/

        $config['protocol'] = 'sendmail';
        $config['mailtype'] = 'html';
        /*$config['charset']  = 'utf-8';*/
        $config['charset'] = 'iso-8859-1';
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

	function generate_feedback()
	{
		$this->users->enable_feedback(15);
	}

	function send_payment_to_supplier()
	{	
		////////////////////////////////////////////////////SEND PAYMENT AUTOMATION/////////////////////////////////
		$this->users->sendpayment_automatic_supplier();
	}

	function personal_message()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$id = $this->session->userdata('id');
			$subject = $this->input->post('subject');
			$message = $this->input->post('message'); 
			$invoice = $this->input->post('invoice');
			if($user_type == 3) //3 buyer
			{
				$action = $this->input->post('action');

				if($action == 'send')
				{
					$supplier_id = $this->input->post('supplier');
					$supplier_info =  $this->users->info($supplier_id);

					$bsm_attachment = "";
					$config['upload_path'] = 'message_attachment/';
					$config['allowed_types'] = 'pdf|docx|gif|jpg|png|tiff|doc';
					$config['max_size']	= '300'; 
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					$config['file_name'] = $this->rndm_strng('alnum',5);

					$this->load->library('upload', $config);

					if (empty($_FILES['userfile']['name'])){
						$upload_session = array(
							   'has_upload'  => 1,
							   'error' => "Message Sent",
							   'is_upload' => 1
						    );
						 $this->session->set_userdata($upload_session);
						
					}else{
						if(!$this->upload->do_upload())
						{
							$data['error'] = $this->upload->display_errors();
							$upload_session = array(
								   'has_upload'  => 1,
								   'error' => $data['error'],
								   'is_upload' => 0
							);
							$this->session->set_userdata($upload_session);
						}
						else
						{
							$upload_session = array(
							   'has_upload'  => 1,
							   'error' => "Successfully Uploaded and Message Sent",
							   'is_upload' => 1
						    );
						    $this->session->set_userdata($upload_session);

							$upload_info =  $this->upload->data();
							$bsm_attachment = 'message_attachment/'.$upload_info['file_name'];
						}
					}


					$bsd_id = $this->input->post('id');
					$data_insert = array('buyer_id' => $id,
										 'supplier_id' => $supplier_id,
										 'sender_type' => 'buyer',
										 'bsd_id' => $bsd_id,
										 'bsm_subject' => $subject,
										 'bsm_message' => $message,
										 'bsm_time' => time(),
										 'bsm_supplier_read'=> 0,
										 'bsm_buyer_read' => 1,
										 'bsm_attachment' => $bsm_attachment);

					$id = $this->users->add_personal_message($data_insert );
					
					$email_data['bsd_id'] =  $bsd_id;
					$email_data['subject'] =  $subject;
					$email_data['message'] =  $message;
					$email_data['invoice'] =  $invoice;
					$email_data['email_type'] = "Personal Message";
					$email_content = $this->load->view('email/user-email',$email_data, true);


					$subject = "Oceantailer: You Got New Message";
					$from = "noreply-oceantailer@oceantailer.com";
					$sender = "http://www.oceantailer.com";
					$to = "jamesan2k@gmail.com, ".$supplier_info->u_email;

					// Send email to new Buyer
					//$this->send_message($email_content, $subject, $to, $from, $sender);

					$message_id = $this->input->post('id_message');
					if($message_id != "")
						redirect('buyer/inbox/'.$message_id,'refresh');

					redirect('buyer/order/'.$bsd_id,'refresh');
				}
				elseif($action == 'get')
				{
					$bsd_id = $this->input->post('id');
					$data_get['messages'] = $this->users->get_personal_message($bsd_id);	
					$data_get['type'] = 'bsd'; 
					$html_result = $this->load->view('buyer/buyer-personal-message-list',$data_get,true);

					echo $html_result;	
				}
				elseif($action == 'addReply')
				{
					$reply = $this->input->post('reply_content');
					$bsm = $this->input->post('id_message');
					$time = time();
					

					$bsr_attachment = "";
					$config['upload_path'] = 'message_attachment/';
					$config['allowed_types'] = 'pdf|docx|gif|jpg|png|tiff|doc';
					$config['max_size']	= '100'; 
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					$config['file_name'] = $this->rndm_strng('alnum',5);

					$this->load->library('upload', $config);

					if (empty($_FILES['userfile']['name'])){
						$upload_session = array(
							   'has_upload'  => 1,
							   'error' => "Message Sent",
							   'is_upload' => 1
						    );
						 $this->session->set_userdata($upload_session);
						
					}else{
						if(!$this->upload->do_upload())
						{
							$data['error'] = $this->upload->display_errors();
							$upload_session = array(
								   'has_upload'  => 1,
								   'error' => $data['error'],
								   'is_upload' => 0
							);
							$this->session->set_userdata($upload_session);
						}
						else
						{
							$upload_session = array(
							   'has_upload'  => 1,
							   'error' => "Successfully Uploaded and Message Sent",
							   'is_upload' => 1
						    );
						    $this->session->set_userdata($upload_session);

							$upload_info =  $this->upload->data();
							$bsr_attachment = 'message_attachment/'.$upload_info['file_name'];
						}
					}
/*
					$add = array(   'bsm_id' => $bsm, 
									'u_id' => $id,
									'bsr_content' => $reply,
									'bsr_time' => $time ,
									'bsr_attachment' => $bsr_attachment,
									);

					$this->users->add_reply($add);*/
					$supplier_id = $this->input->post('supplier');

					$message_detail = $this->users->get_personal_message_detail($bsm, 'buyer');	

					$message = 	$reply." <br/>".
								"On ".date('M d, Y H:i:s',$message_detail->bsm_time).", \" ".$message_detail->u_company." \" Wrote: <br/> <br/>".
								$message_detail->bsm_message;

					if(strpos($message_detail->bsm_subject, "RE:") !== false)
						$added_subject = "";
					else
						$added_subject = "RE: ";

					$subject = $added_subject.$message_detail->bsm_subject;

					$data_insert = array('buyer_id' => $id,
										 'supplier_id' => $supplier_id,
										 'sender_type' => 'buyer',
										 'bsd_id' => $message_detail->bsd_id,
										 'bsm_subject' => $subject,
										 'bsm_message' => $message,
										 'bsm_time' => time(),
										 'bsm_supplier_read'=> 0,
										 'bsm_buyer_read' => 1,
										 'bsm_attachment' => $bsr_attachment);

					$id = $this->users->add_personal_message($data_insert );

/*					$html_append = "<div class='clearfix'>
										<p>Me:</p>
										<p class='reply-content'>".$reply."</p>
										<div class='clear'></div>
										<div class='fr'>
											<p class='small-p-label'>".date('M d, Y H:i:s',$time)."</p>
										</div>
									</div>";*/

					//echo $html_append;

					$message_id = $this->input->post('id_message');
					if($message_id != "")
						redirect('buyer/inbox/'.$message_id,'refresh');

					redirect('buyer/order/'.$bsd_id,'refresh');


				}
			}
			if($user_type == 2) //2 supplier
			{
				$action = $this->input->post('action');

				if($action == 'send')
				{

					$buyer = $this->input->post('buyer');
					$buyer_info =  $this->users->info($buyer);
					$bsm_attachment = "";
					$config['upload_path'] = 'message_attachment/';
					$config['allowed_types'] = 'pdf|docx|gif|jpg|png|tiff|doc';
					$config['max_size']	= '100'; 
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					$config['file_name'] = $this->rndm_strng('alnum',5);

					$this->load->library('upload', $config);

					if (empty($_FILES['userfile']['name'])){
						$upload_session = array(
							   'has_upload'  => 1,
							   'error' => "Message Sent",
							   'is_upload' => 1
						    );
						 $this->session->set_userdata($upload_session);
						
					}else{
						if(!$this->upload->do_upload())
						{
							$data['error'] = $this->upload->display_errors();
							$upload_session = array(
								   'has_upload'  => 1,
								   'error' => $data['error'],
								   'is_upload' => 0
							);
							$this->session->set_userdata($upload_session);
						}
						else
						{
							$upload_session = array(
							   'has_upload'  => 1,
							   'error' => "Successfully Uploaded and Message Sent",
							   'is_upload' => 1
						    );
						    $this->session->set_userdata($upload_session);

							$upload_info =  $this->upload->data();
							$bsm_attachment = 'message_attachment/'.$upload_info['file_name'];
						}
					}
					

					$bsd_id = $this->input->post('id');
					$data_insert = array('buyer_id' => $buyer,
										 'supplier_id' => $id,
										 'sender_type' => 'supplier',
										 'bsd_id' => $bsd_id,
										 'bsm_subject' => $subject,
										 'bsm_message' => $message,
										 'bsm_time' => time(),
										 'bsm_supplier_read'=> 1,
										 'bsm_buyer_read' => 0,
										 'bsm_attachment' => $bsm_attachment);

					$id = $this->users->add_personal_message($data_insert );

					$email_data['bsd_id'] =  $bsd_id;
					$email_data['subject'] =  $subject;
					$email_data['message'] =  $message;
					$email_data['invoice'] =  $invoice;
					$email_data['email_type'] = "Personal Message";
					$email_content = $this->load->view('email/user-email',$email_data, true);


					$subject = "Oceantailer: You Got New Message";
					$from = "noreply-oceantailer@oceantailer.com";
					$sender = "http://www.oceantailer.com";
					$to = "jamesan2k@gmail.com, ".$buyer_info->u_email;

					// Send email to new Buyer
					//$this->send_message($email_content, $subject, $to, $from, $sender);

					$message_id = $this->input->post('id_message');
					if($message_id != "")
						redirect('supplier/inbox/'.$message_id,'refresh');

					redirect('supplier/order/'.$bsd_id,'refresh');
				}
				elseif($action == 'get')
				{
					$bsd_id = $this->input->post('id');
					$data_get['messages'] = $this->users->get_personal_message($bsd_id);	
					$data_get['type'] = 'bsd'; 
					$html_result = $this->load->view('supplier/supplier-personal-message-list',$data_get,true);

					echo $html_result;	
				}
				elseif($action == 'addReply') ///////////////////////////////////// Add Reply //////////////////////////////////
				{
					$reply = $this->input->post('reply_content');
					$bsm = $this->input->post('id_message');
					$message_id = $this->input->post('id_message');
					$time = time();

					$bsr_attachment = "";
					$config['upload_path'] = 'message_attachment/';
					$config['allowed_types'] = 'pdf|docx|gif|jpg|png|tiff|doc';
					$config['max_size']	= '100'; 
					$config['max_width']  = '1024';
					$config['max_height']  = '768';
					$config['file_name'] = $this->rndm_strng('alnum',5);

					$this->load->library('upload', $config);

					if (empty($_FILES['userfile']['name'])){
						$upload_session = array(
							   'has_upload'  => 1,
							   'error' => "Message Sent",
							   'is_upload' => 1
						    );
						 $this->session->set_userdata($upload_session);
						
					}else{
						if(!$this->upload->do_upload())
						{
							$data['error'] = $this->upload->display_errors();
							$upload_session = array(
								   'has_upload'  => 1,
								   'error' => $data['error'],
								   'is_upload' => 0
							);
							$this->session->set_userdata($upload_session);
						}
						else
						{
							$upload_session = array(
							   'has_upload'  => 1,
							   'error' => "Successfully Uploaded and Message Sent",
							   'is_upload' => 1
						    );
						    $this->session->set_userdata($upload_session);

							$upload_info =  $this->upload->data();
							$bsr_attachment = 'message_attachment/'.$upload_info['file_name'];
						}
					}

					$buyer = $this->input->post('buyer');
					$message_detail = $this->users->get_personal_message_detail($bsm, 'supplier');	

					$message = 	$reply." <br/>".
								"On ".date('M d, Y H:i:s',$message_detail->bsm_time).", \" ".$message_detail->u_company." \" Wrote: <br/> <br/>  ".
								$message_detail->bsm_message;

					if(strpos($message_detail->bsm_subject, "RE:") !== false)
						$added_subject = "";
					else
						$added_subject = "RE: ";

					$subject = $added_subject.$message_detail->bsm_subject;

										$data_insert = array('buyer_id' => $buyer,
										 'supplier_id' => $id,
										 'sender_type' => 'supplier',
										 'bsd_id' => $message_detail->bsd_id,
										 'bsm_subject' => $subject,
										 'bsm_message' => $message,
										 'bsm_time' => time(),
										 'bsm_supplier_read'=> 1,
										 'bsm_buyer_read' => 0,
										 'bsm_attachment' => $bsr_attachment);


					$id = $this->users->add_personal_message($data_insert );



					if($message_id != "")
						redirect('supplier/inbox/'.$message_id,'refresh');

					redirect('supplier/order/'.$bsd_id,'refresh');


				}
			}
		}
	}



}
