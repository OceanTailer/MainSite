<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');

class F1 extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('accounts_model');
    }

    public function home($page = 'account')
    {
    	if($this->session->userdata('logged_in') == TRUE){

    		$str = str_replace('-', ' ', $page);
        	$data['title'] = ucfirst($str);
    		$data['slogan'] = "F-1 LEVELS";
			$navs = array('LEVEL 1', 'LEVEL 2', 'LEVEL 3', 'LEVEL 4', 'LEVEL 5', 'LEVEL 6', 'LEVEL 7', 'LEVEL 8', 'LEVEL 9', 'LEVEL 10', 'ACCOUNT');
			$data['navs'] = $navs;
			$data['info'] =  $this->accounts_model->detail($this->session->userdata('id'));
			$data['logs'] =  $this->accounts_model->logs(2,$this->session->userdata('id'));

			$data['payments'] =  $this->accounts_model->payment($data['info']->id);
			$fullname = $data['info']->firstName.' '.$data['info']->lastName;
			$data['slogan_sub'] = $fullname;
			$this->load->view('templates/header-f1', $data);
			$this->load->view('f1/account', $data);
			$this->load->view('templates/footer-f1');
		}
		else
		{
			
			$str = str_replace('-', ' ', $page);
        	$data['title'] = ucfirst($str);
    		$data['slogan'] = "F-1 LEVELS";
			$navs = array('LEVEL 1', 'LEVEL 2', 'LEVEL 3', 'LEVEL 4', 'LEVEL 5', 'LEVEL 6', 'LEVEL 7', 'LEVEL 8', 'LEVEL 9', 'LEVEL 10');
			$data['navs'] = $navs;
			$data['slogan_sub'] = 'Guest';
			$this->load->view('templates/header-f1', $data);
			$this->load->view('pages/home', $data);
			$this->load->view('templates/footer-f1');
		}

    }

    public function index($page = 'home') {
		if($this->session->userdata('logged_in') == TRUE)
		{
			$str = str_replace('-', ' ', $page);
			$data['slogan'] = "F-1 LEVELS";
       	 	$data['title'] = ucfirst($str);
			$navs = array('LEVEL 1', 'LEVEL 2', 'LEVEL 3', 'LEVEL 4', 'LEVEL 5', 'LEVEL 6', 'LEVEL 7', 'LEVEL 8', 'LEVEL 9', 'LEVEL 10', 'ACCOUNT');
			$data_user['info'] =  $this->accounts_model->detail($this->session->userdata('id'));
			$fullname = $data_user['info']->firstName.' '.$data_user['info']->lastName;
			$data['slogan_sub'] = $fullname;

			$lang = 'dk';

			if($this->session->userdata('language') == 'English')
				$lang = 'en';
			elseif($this->session->userdata('language') == 'Denmark')
				$lang = 'dk';
		
			$data['navs'] = $navs;

			$this->load->view('templates/header-f1', $data);
			$data_user['lvl'] = 0;
			if($page == 'level-1'){
				$data_user['lvl'] = 1;
				$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-1', $data_user);
	        }else if($page == 'level-2'){
	        	$data_user['lvl'] = 2;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-2', $data_user);
	        }else if($page == 'level-3'){
	        	$data_user['lvl'] = 3;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-3', $data_user);
	        }else if($page == 'level-4'){
	        	$data_user['lvl'] = 4;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-4', $data_user);
	        }else if($page == 'level-5'){
	        	$data_user['lvl'] = 5;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-5', $data_user);
	        }else if($page == 'level-6'){
	        	$data_user['lvl'] = 6;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-6', $data_user);
	        }else if($page == 'level-7'){
	        	$data_user['lvl'] = 7;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-7', $data_user);
	        }else if($page == 'level-8'){
	        	$data_user['lvl'] = 8;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-8', $data_user);
	        }else if($page == 'level-9'){
	        	$data_user['lvl'] = 9;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-9', $data_user);
	        }else if($page == 'level-10'){
	        	$data_user['lvl'] = 10;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-10', $data_user);
	        }
	      
			$this->load->view('templates/footer-f1');


        }
        else
        {
        	$str = str_replace('-', ' ', $page);
			$data['slogan'] = "F-1 LEVELS";
       	 	$data['title'] = ucfirst($str);
			$navs = array('LEVEL 1', 'LEVEL 2', 'LEVEL 3', 'LEVEL 4', 'LEVEL 5', 'LEVEL 6', 'LEVEL 7', 'LEVEL 8', 'LEVEL 9', 'LEVEL 10');
			$data_user['info']->levelF1 =  -1;
			$data['slogan_sub'] = "Guest";
		
			$data['navs'] = $navs;

			$lang = 'dk';
			
			if($this->session->userdata('language') == 'English')
				$lang = 'en';
			elseif($this->session->userdata('language') == 'Denmark')
				$lang = 'dk';

			$this->load->view('templates/header-f1', $data);
			$data_user['lvl'] = 0;
			if($page == 'level-1'){
				$data_user['lvl'] = 1;
				$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-1', $data_user);
	        }else if($page == 'level-2'){
	        	$data_user['lvl'] = 2;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-2', $data_user);
	        }else if($page == 'level-3'){
	        	$data_user['lvl'] = 3;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-3', $data_user);
	        }else if($page == 'level-4'){
	        	$data_user['lvl'] = 4;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-4', $data_user);
	        }else if($page == 'level-5'){
	        	$data_user['lvl'] = 5;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-5', $data_user);
	        }else if($page == 'level-6'){
	        	$data_user['lvl'] = 6;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-6', $data_user);
	        }else if($page == 'level-7'){
	        	$data_user['lvl'] = 7;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-7', $data_user);
	        }else if($page == 'level-8'){
	        	$data_user['lvl'] = 8;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-8', $data_user);
	        }else if($page == 'level-9'){
	        	$data_user['lvl'] = 9;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-9', $data_user);
	        }else if($page == 'level-10'){
	        	$data_user['lvl'] = 10;
	        	$data_user['contents'] = $this->accounts_model->page_content('f1', $data_user['lvl'], $lang);
				$this->load->view('f1/level-10', $data_user);
	        }
	      
			$this->load->view('templates/footer-f1');
        }
   
    }

}
