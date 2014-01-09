<?php

class Accounts extends CI_Controller {

function __construct() {
	parent::__construct();
	$this->load->model('accounts_model');
	$this->load->helper('url');
}

public function dashboard() {
	//for user who have session login
	if($this->session->userdata('logged_in') == TRUE){
		$navs  = $this->accounts_model->get_all_home_pages();
		$data['navs'] = $navs;


		$data_setting = $this->accounts_model->setting_detail();
		$data['footer_text'] = $data_setting->footerText;
		$data['title'] = "Account";
		$data['slogan'] = $data_setting->headerText;

		$data['user_info'] = $this->accounts_model->detail($this->session->userdata('id'));
		$fullname = $data['user_info']->firstName.' '.$data['user_info']->lastName;
		$data['slogan_sub'] = $fullname;
		$this->load->view('templates/header', $data);
		$this->load->view('account/z_backup_dashboard', $data);
		$this->load->view('templates/footer',$data);
	}else {
		header('Location: ../index.php/member/login');
	}
}


public function login() {

	$data_setting = $this->accounts_model->setting_detail();
	$data['footer_text'] = $data_setting->footerText;
	$data['title'] = "MEMBER";
	$data['slogan'] = $data_setting->headerText;
	$data['slogan_sub'] = "Denmark";
		
	$navs = $this->accounts_model->get_all_home_pages();
	$data['navs'] = $navs;
	
	$this->load->view('templates/header', $data);
	$this->load->view('account/login');
	$this->load->view('templates/footer', $data);
	
}

public function forgot()
{
	
		
	$navs = array('Home', 'F16 SIM', 'F1 SIM', 'R22 SIM', 'B737 SIM', 'CESSNA', 'PRICES', 'MEMBER', 'FRENCIASE');
	$data['navs'] = $navs;

	$data_setting = $this->accounts_model->setting_detail();

	$data['footer_text'] = $data_setting->footerText;
	$data['title'] = "MEMBER";
	$data['slogan'] = $data_setting->headerText;
	$data['slogan_sub'] = "Denmark";
	
	$this->load->view('templates/header', $data);
	$this->load->view('account/forgot');
	$this->load->view('templates/footer',$data);

}

public function validate() {

	$data_setting = $this->accounts_model->setting_detail();
	$data['footer_text'] = $data_setting->footerText;
	$data['title'] = "MEMBER";
	$data['slogan'] = $data_setting->headerText;
	$data['slogan_sub'] = "Denmark";
		
	$navs  = $this->accounts_model->get_all_home_pages();
	$data['navs'] = $navs;

	$this->load->library('form_validation');
	
	$this->form_validation->set_rules('email', 'Username', 'required');
	//$this->form_validation->set_rules('password', 'Password', 'required');
	
	if($this->form_validation->run() == FALSE) {

		$body_info['message'] = validation_errors();
		$this->load->view('templates/header', $data);
		$this->load->view('account/login',$body_info);
		$this->load->view('templates/footer',$data);
	} else {
		$result = $this->accounts_model->validate();
		if(!$result)
		{
			if($this->input->post('password') == "")
				$body_info['message'] = '<p>Email Sent!</p>';
			else
				$body_info['message'] = '<p>Invalid Login</p>';
			$this->load->view('templates/header', $data);
			$this->load->view('account/login',$body_info);
			$this->load->view('templates/footer',$data);
		}
		else
			header('Location: ../member');
	}
	
}

public function forgotpassword(){
	$email = $this->input->post('email');
	$result = $this->accounts_model->generate_password($email);
	if($result)
		$body_info['message'] = '<p>New Password Sent to Email</p>';
	else
		$body_info['message'] = '<p>Email you enter doesn\'t exist</p>';

	$data_setting = $this->accounts_model->setting_detail();
	$data['footer_text'] = $data_setting->footerText;
	$data['title'] = "MEMBER";
	$data['slogan'] = $data_setting->headerText;
	$data['slogan_sub'] = "Denmark";
		
	$navs = array('Home', 'F16 SIM', 'F1 SIM', 'R22 SIM', 'B737 SIM', 'CESSNA', 'PRICES', 'MEMBER', 'FRENCIASE');
	$data['navs'] = $navs;

	if(!$result)
	{
		$this->load->view('templates/header', $data);
		$this->load->view('account/forgot',$body_info);
		$this->load->view('templates/footer',$data);
	}
	else
	{
		$this->load->view('templates/header', $data);
		$this->load->view('account/login',$body_info);
		$this->load->view('templates/footer',$data);
	}
}

public function logout() {
	$this->accounts_model->logout();
	header('Location: ../home');
}

public function listing()
{
	//$this->accounts_model->listings();
}

public function viewown() {
	$navs = array('Home', 'F16 SIM', 'F1 SIM', 'R22 SIM', 'B737 SIM', 'CESSNA', 'PRICES', 'LOGIN', 'FRENCIASE', 'ACOUNT');
        
	$data['num-navs'] = 10;
	$data['navs'] = $navs;
	$data['title'] = "Account";
	$data['slogan'] = "F-16 LEVELS";
	$data['slogan_sub'] = "Frank Riedel";

	$this->load->view("templates/header", $data);
	$this->load->view("account/viewown");
	$this->load->view("templates/footer");
}

}