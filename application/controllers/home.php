<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users');
		$this->load->model('manufacturers');
		$this->load->model('inventories');
		$this->load->model('categories');
		$this->load->model('brands');
		$this->load->model('suppliers');
    }

	public function index()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 1) // 1 is admin
			{
				redirect('user','refresh');
			}
			elseif($user_type == 2) // 2 is supplier
			{
				redirect('supplier','refresh');
			}
			// Lanz Editted
			elseif($user_type == 3) // 3 is buyer
			{
				redirect('buyer','refresh');
			}
		}
		else
		{
			$data['feat_categories'] = $this->categories->listings(0); //main categories
			$data['categories'] = array(); //main categories
			$data['brands'] = array();
			$data['manus'] = array();
			$data['suppliers'] = $this->suppliers->listing(1);
			$data['is_home'] = 1;
			$this->load->view('home-page',$data);
		}
	}
}
