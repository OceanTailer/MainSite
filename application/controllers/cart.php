<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cart extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('suppliers');
		$this->load->model('inventories');
		$this->load->model('buyers');
		$this->load->model('countries');
		$this->load->model('brands');
		$this->load->model('categories');
		$this->load->model('manufacturers');
    }

	public function index()
	{
			$data['cart'] = $this->cart->contents();
			$data['total'] = $this->cart->total();
			$data['login'] = false; 

			$data['categories'] = array(); //main categories
			$data['brands'] = array();
			$data['manus'] = array();

			if($this->session->userdata('is_login') == TRUE)
			{
				$user_type = $this->session->userdata('type'); //get user type;
				$id = $this->session->userdata('id');
				if($user_type == 3) //buyer
				{
					$data['login'] = true; 
				}

			}

			$data['brands'] = $this->brands->listing();
			$this->load->view('view-cart',$data);
	}

	function add()
	{
		$ic_id  = $this->input->post('icid');
		$quan  = $this->input->post('quan');
		$ic = $this->suppliers->detail_child_inventory($ic_id);
		$data = array(
               'id'      => $ic->ic_id,
               'qty'     => $quan,
               'price'   => (floatval($ic->ic_price)), 
               'name'    => $ic->tr_title,
               'options' => array('ship_cost' => $ic->ic_ship_cost, 'fee' => $ic->c_feePercent, 'i_id' => $ic->i_id)
            );

		$this->cart->insert($data);

		echo json_encode(array('total_item' => $this->cart->total_items())); 
	}

	function update()
	{
		$action = $this->uri->segment(3);//action
		

		if($action == 'qty')
		{
			$qty = $this->input->post('qty');
			$rid = $this->input->post('rid');

			$data = array(
               'rowid' => $rid,
               'qty'   => $qty
            );

			$this->cart->update($data); 
		}
	}

	function empty_cart()
	{
		$this->cart->destroy();
		redirect('cart', 'refresh');
	}



}