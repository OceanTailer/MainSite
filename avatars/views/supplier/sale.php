<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// Lanz Editted - June 10, 2012
class sale extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users');
		$this->load->model('administrators');
		$this->load->model('buyers');
		$this->load->model('suppliers');
	}

	public function index()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			if ($user_type == 1) //administrator
			{
				$data['sales'] = $this->buyers->transaction_list();
				$data['supplier_sales'] = $this->suppliers->supplier_sales();
				$this->load->view('admin/sales/admin-sales-home',$data);
			}
		}
	}

	function details()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			if ($user_type == 1) //administrator
			{
				$supplier_id = $this->uri->segment(3);
				if($supplier_id != '')
				{
					$data['sales_detail'] = $this->suppliers->supplier_sales_detail($supplier_id);
					$data['payment_history'] = $this->administrators->admin_supplier_payment_history($supplier_id);
					$data['info'] = $this->suppliers->supplierinfo($supplier_id);
					$this->load->view('admin/sales/admin-supplier-sales-detail',$data);
				}
				else
					redirect('', 'refresh');
			}
		}
	}

	function report()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			$user_id = $this->session->userdata('id'); //id of the loged in user

			if ($user_type == 2) //supplier
			{
				$type = $this->input->post('type');

				if($type = 'byweek') //Load page that get by week sales 
				{
					$total_prod_charges = 0; //Add
					$total_prod_rebates = 0; //Minus
					$total_prod_fee = 0; //Minus
					$total_prod_other = 0; //Add

					$date_range = $this->input->post('date');
					$dates = explode(';',$date_range);

					// getting all the sales with in a certrain week by date range and the bsd_status 1
					$data_page['_data_sales'] = $this->suppliers->get_sales_perWeek($dates,$user_id); 

					//getting all the product amount including the deduction and the quantity purchased.

					foreach($data_page['_data_sales'] as $sales)
					{
						$product_info =  $this->suppliers->transaction_detail($user_id,$sales->bsd_id);
						$total_prod_charges += $product_info->btd_subamount; //the Quantity * Price 
						$total_prod_fee += 0; $product_info->btd_subamount * ($product_info->btd_productFee/100); //Product Fee
						$total_prod_other += $product_info->btd_shipamount; //other is including the shipping fee
					}

					$data_page['sum_prod_charges'] = $total_prod_charges;
					$data_page['sum_prod_rebates'] = $total_prod_rebates;
					$data_page['sum_prod_fee'] = $total_prod_fee;
					$data_page['sum_prod_other'] = $total_prod_other;


				//	echo print_r($_data_sales);
					$_html = $this->load->view('supplier/sales-perWeek',$data_page,TRUE);

					echo $_html;

				}
			}
		}
		else
			redirect('', 'refresh');
	}

}
?>