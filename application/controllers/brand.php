<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class brand extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users');
		$this->load->model('manufacturers');
		$this->load->model('brands');
		$this->load->model('inventories');
    }

	public function index()
	{

			redirect('','refresh');
	}

	function add()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;

			//Do some Action depend on the Action Sets
			if($this->input->post('action') != "") 
			{
				$action = $this->input->post('action');

				if($action == 'add') //Add brand thgat assigned under a manufacturer
				{
					$name = $this->input->post('name');
					$manu_id = $this->input->post('manu_id');

					$data = array('m_id'=> $manu_id,
								  'b_name' => $name );

					$id = $this->brands->add($data);
					$data_brand = $this->brands->info($id);

					echo json_encode($data_brand);
				}
				elseif($action == 'quickadd') 
				{
					$name = $this->input->post('name');
					$manu_id = $this->input->post('manu_id');

					$data = array('m_id'=> $manu_id,
								  'b_name' => $name );

					$id = $this->brands->add($data);
					$data_brand = $this->brands->info($id);

					echo json_encode($data_brand);
				} 

			}
			else{ //Load Certain Page
				redirect('','refresh');
			}
		}
		else
			redirect('','refresh');
	}

	function detail()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;

			//Do some Action depend on the Action Sets
			if($this->input->post('view_type') != "") 
			{
				$view_type = $this->input->post('view_type');

				if($view_type == 'table') //Add brand thgat assigned under a manufacturer
				{
					$manu_id = $this->input->post('id');

					$brand_listing = $this->brands->listing($manu_id);

					$brand['brands'] = $brand_listing;
					$result = $this->load->view('admin/brand/brand-table',$brand);
					echo $result;
				}
			}
			else{ //Load Certain Page
				redirect('','refresh');
			}
		}
		else
			redirect('','refresh');
	}

	function search()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;

			if($this->input->post('type') != "") 
			{
				$type = $this->input->post('type');
				if($type == 'dropdown') //dropdown search
				{
					$m_val = $this->input->post('m_val');
					$brand_search = $this->input->post('b_val');

					$data["brands"] = $this->brands->listing($m_val,$brand_search);
					$data["type"] = 'dropdown';
					$data["usertype"] = $user_type;
					$html_ = $this->load->view('admin/brand/brand-dropdown',$data);
					
					echo $html_;

				}
			}

		}
		else
			redirect('','refresh');
	}

	function delete()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;

			if($this->input->post('type') != "") 
			{
				$type = $this->input->post('type');
				if($type == 'delete') //dropdown search
				{
					$id = $this->input->post('id');
					$col = 'b_id';
					$this->manufacturers->delete_brand($col,$id); //delete brands
					$result = $this->inventories->delete($col,$id); //delete list of product attached to brand
				}
			}
		}
	}



}