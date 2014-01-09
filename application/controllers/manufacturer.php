<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class manufacturer extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users');
		$this->load->model('manufacturers');
		$this->load->model('administrators');
    }

	public function index()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 1) //1 is admin, 2 supplier
			{
				
			}
		}
		else
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
				if($action == 'add') //if adding manufacturer
				{
					$manu_name = $this->input->post('manu_name');
					$data_insert = array('m_name' => $manu_name);
					$result = $this->manufacturers->add($data_insert);

					redirect('manufacturer/add','refresh');
				}
				elseif($action == 'quickadd')
				{
					$manu_name = $this->input->post('manu_name');
					$data_insert = array('m_name' => $manu_name);
					$result = $this->manufacturers->add($data_insert);

					echo $result;
				}
			}
			else{ //Load Certain Page
				if($user_type == 1) //1 is admin, 2 supplier
				{
					$data['list_manufac'] = $this->manufacturers->listing();
					$this->load->view('admin/manufacturer/add-manufacturer',$data);
				}
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
					$search_name = $this->input->post('m_val');

					$data["manufacturers"] = $this->manufacturers->listing($search_name);
					$data["type"] = 'dropdown';
					$data["usertype"] = $user_type;

					$html_ = $this->load->view('admin/manufacturer/search-manufacturer',$data);
					
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
				if($type == 'delete') 
				{
					$id = $this->input->post('id');
					$col = 'm_id';
					$this->manufacturers->delete($col,$id); //delete manufacturer
					$this->manufacturers->delete_brand($col,$id); //delete manufacturer
					$this->invetories->delete($col,$id); //delete list of product attached to brand
				}
			}

		}

	}


}