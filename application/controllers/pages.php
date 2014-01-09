<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('accounts_model');
    }

    public function index($page = '') {

    	$this->accounts_model->check_language();

        
		
		$navs = $this->accounts_model->get_all_home_pages();

		if($this->session->userdata('logged_in') == TRUE){
			//navs = array('Home', 'F16 SIM', 'F1 SIM', 'R22 SIM', 'B737 SIM', 'CESSNA', 'PRICES', 'MEMBER', 'FRENCIASE');
		}
		else{
			//$navs = array('Home', 'F16 SIM', 'F1 SIM', 'R22 SIM', 'B737 SIM', 'CESSNA', 'PRICES', 'MEMBER', 'FRENCIASE');
		}	

		$data['navs'] = $navs;

		if($page == '' || $page == 'home') //get the default
			$page_content = $this->accounts_model->get_page_content('');
		else
			$page_content = $this->accounts_model->get_page_content($page);	
        
		//echo print_r($page_content);
		$data_setting = $this->accounts_model->setting_detail();

        $data['title'] = $page_content->home_page_title;
		$data['slogan'] = $data_setting->headerText;
		$data['footer_text'] = $data_setting->footerText;
		$data['page_content'] = $page_content;

    	$this->load->view('templates/header', $data);
		$this->load->view('templates/dynamic_body', $data);

        $this->load->view('templates/footer',$data);
    }

    public function switched()
    {
    	$this->accounts_model->switch_language();
    	redirect('');
    }

    function decript()
	{
		$this->load->library('encrypt');
		$code = "+68YEWTO29CSTI0IAHHYx9VUlGQOxqX3Ww7dTQr07hxfCYqIkk/hwh/boiz7v8OezVO4W0jKgfkoebDjGxOHIQ==";
		$key = '2@!#!(Sdfasf#0!_#!@#21#!@#@1321'; 
		$plaintext_string = $this->encrypt->decode($code);
		echo 'dfdsf '.$plaintext_string.' fdsf';
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */