<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class checkout extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users');
		$this->load->model('manufacturers');
		$this->load->model('buyers');
		$this->load->model('countries');
		$this->load->model('inventories'); 
		$this->load->model('creditcards');
    }

	public function index()
	{

			redirect('','refresh');
	}

	function paypal()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$id = $this->session->userdata('id');
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 3) // 3 buyer
			{
				$data['credit_cards'] = $this->buyers->creditcards($id);
				$data['cart'] = $this->cart->contents();
				$data['total'] = $this->cart->total();
				$data['countries'] = $this->countries->listing_country();
				$data['countr_sel'] = $this->countries->default_country();
				$data['states'] = $this->countries->states($data['countr_sel']);
				$data['billing_address'] = $this->buyers->billingaddresses($id);
				$data['credit_card'] = $this->buyers->creditcards($id);
				$this->load->view('confirm-payment',$data);
			}
		}
		else
			redirect('','refresh');
	}




}