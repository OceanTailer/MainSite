<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class carrier extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users');
		$this->load->model('administrators');
		$this->load->model('suppliers');
		$this->load->model('countries');
		$this->load->model('carriers');
	}

	public function index()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			if ($user_type == 1)
			{
				$data['carriers'] = $this->suppliers->shipping_carrier('');
				$this->load->view('admin/admin/admin-carrier',$data);
			}
		}
	}

	function assign()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			if ($user_type == 1)
			{
				$action =  $this->input->post('action');
				if($action != '')
				{
					if($action == 'add')
					{
						$scid = $this->input->post('sc_id');
						$country = $this->input->post('country');

						$data_insert = array('sc_id' => $scid,
											 'country_id' => $country);

						$result = $this->suppliers->carrier_assign_country($data_insert);
					}
				}
				else
				{
					$id_carrier = $this->uri->segment(3);//id
					$data['carrier'] = $this->suppliers->carrier_info($id_carrier);
					$data['countries'] = $this->countries->listing_country();
					$data['assigned_countries'] = $this->countries->assigned_carrier_contry_list($id_carrier);
					$this->suppliers->shipping_carrier();
					$this->load->view('admin/admin/admin-carrier-edit',$data);
				}
			}
		}
	}

	function carrier_country()
	{
		$type = $this->input->post('type');
		if($type == 'dropdown') //load type
		{
			$carrier_sel  = $this->input->post('scid');
			$country_list =  $this->countries->assigned_carrier_contry_list($carrier_sel);
			if(count($country_list) == 0)
					echo 0;
			else
			{
				$html = "";
				foreach($country_list as $count)
				{
					$html .= "<option value='".$count->c_id."'>".$count->c_name."</option>";
				}
				echo $html;
			}
		}
	}

		// Lanz Editted - August 12, 2013
	function addcarrier()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			if ($this->input->post('action') == "add")
			{
				$c_name = $this->input->post('carrier_name');
				$c_desc = $this->input->post('carrier_desc');

				$this->load->library('form_validation');
				$this->form_validation->set_rules('carrier_name', 'Carrier Name', 'xss_clean|required');
				$this->form_validation->set_rules('carrier_desc', 'Carrier Description', 'xss_clean|required');

				if ($this->form_validation->run() == FALSE)
				{
					$message = array('message' => validation_errors(), 'status' =>  0);
					echo json_encode($message);
				}
				else
				{
					$c_data = array(
						'sc_name' => $c_name,
						'sc_desc' => $c_desc
						);

					$this->carriers->add_new_carrier($c_data);
					$message = array('message' => 'New Carrier Successfully added.', 'status' => 1);
					echo json_encode($message);
				}
			}
			else
			{
				$this->load->view('admin/admin/admin-add-carrier');
			}
		}
		else
		{
			redirect('home', 'refresh');
		}
	}

	// Lanz Editted - August 12, 2013
	function deletecarrier()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$sc_id = $this->uri->segment(3);
			$this->carriers->delete_carrier($sc_id);
			redirect('carrier', 'refresh');
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	// Lanz Editted - August 12, 2013
	function updatecarrier()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$sc_id = $this->uri->segment(3);
			$c_name = $this->input->post('carrier_name');
			$c_desc = $this->input->post('carrier_desc');

			$data = array(
				'sc_name' => $c_name,
				'sc_desc' => $c_desc
				);

			$this->carriers->update_carrier($sc_id, $data);

			$message = array('message' => 'Successfully Updated Carrier Information.', 'status' => 1);
			echo json_encode($message);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	// Lanz Editted - August 12, 2013
	function carrierinfo()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$sc_id = $this->uri->segment(3);
			$data['carrier_info'] = $this->carriers->carrier_info($sc_id);
			$this->load->view('admin/admin/admin-carrier-update', $data);
		}
		else
		{
			redirect('', 'refresh');
		}
	}

	function delete_assign()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			if ($user_type == 1) //If administrator
			{
				$scc_id = $this->uri->segment(4);
				$sc_id = $this->uri->segment(3);

				$result = $this->carriers->delete_assign_carrier($scc_id);


				redirect('carrier/assign/'.$sc_id, 'refresh');
			}
		}
	}

}
?>