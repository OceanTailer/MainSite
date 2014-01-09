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

				if($type == 'byweek') //Load page that get by week sales 
				{
					$total_prod_charges = 0; //Add
					$total_prod_rebates = 0; //Minus
					$total_prod_fee = 0; //Minus
					$total_prod_other = 0; //Add
					$subtotal_prod_ = 0; //Add

					$seller_fee_subscribed = $this->administrators->get_settings('supplier_selFee');
					$data_page['seller_fee'] = $seller_fee_subscribed;

					$date_range = $this->input->post('date');
					$dates = explode(';',$date_range);
					$add_days = 1;
					$data_page['date_transfer'] = date('M d,Y', $dates[1]+(24*3600* $add_days)); //Plus 1 Days from the Date End of the 5 days

					// getting all the sales with in a certrain week by date range and the bsd_status 1
					$data_page['_data_sales'] = $this->suppliers->get_sales_perWeek($dates,$user_id, 1); 

					//getting all the product amount including the deduction and the quantity purchased.

					foreach($data_page['_data_sales'] as $sales)
					{
						$products_info =  $this->suppliers->transaction_detail($user_id,$sales->bsd_id);

						foreach($products_info as $prod_info)
						{
							$total_prod_charges += $prod_info->btd_subamount; //the Quantity * Price 
							$total_prod_fee += $prod_info->btd_subamount * ($prod_info->btd_productFee/100); //Product Fee
							$total_prod_other += $prod_info->btd_shipamount * $prod_info->btd_quan; //other is including the shipping fee
						}
					}

					$subtotal_prod_ = ($total_prod_charges + $total_prod_other) - $total_prod_fee;

					$data_page['sum_prod_charges'] = $total_prod_charges;
					$data_page['sum_prod_rebates'] = $total_prod_rebates;
					$data_page['sum_prod_fee'] = $total_prod_fee;
					$data_page['sum_prod_other'] = $total_prod_other;
					$data_page['subtotal_prod'] = $subtotal_prod_;

					/////////////////////////////////////////////////////////////////////////////////////////////////////

					$total_rfnd_charges = 0; //Add
					$total_rfnd_rebates = 0; //Minus
					$total_rfnd_fee = 0; //Minus
					$total_rfnd_other = 0; //Add
					$subtotal_rfnd_ = 0; //Add

					// getting all the sales with in a certrain week by date range and the bsd_status -3 or Refund Status
					$data_page['_data_refund'] = $this->suppliers->get_sales_perWeek($dates,$user_id, -3); 

					//getting all the product amount including the deduction and the quantity purchased.

					foreach($data_page['_data_refund'] as $sales)
					{
						$prod_rfnd = $this->suppliers->orr_detail($sales->bsd_id); //if exist only update. else add a recorc

						$total_rfnd_charges += $prod_rfnd->orr_prod_amnt; //the Quantity * Price 
						
						$total_rfnd_other += $prod_rfnd->orr_ship_amnt; //other is including the shipping fee

						$products_info =  $this->suppliers->transaction_detail($user_id,$sales->bsd_id);

						foreach($products_info as $prod_refund)
						{
							$total_rfnd_fee += $prod_refund->btd_subamount * ($prod_refund->btd_productFee/100); //Product Fee
						}

					}

					$subtotal_rfnd_ = ($total_rfnd_charges + $total_rfnd_other) - $total_rfnd_fee;

					$data_page['sum_rfnd_charges'] = $total_rfnd_charges;
					$data_page['sum_rfnd_rebates'] = $total_rfnd_rebates;
					$data_page['sum_rfnd_fee'] = $total_rfnd_fee;
					$data_page['sum_rfnd_other'] = $total_rfnd_other;
					$data_page['subtotal_rfnd'] = $subtotal_rfnd_;

					/////////////////////////////////////////////////////////////////////
					$data_page['closing_balance'] = $subtotal_prod_ - $subtotal_rfnd_;


				//	echo print_r($_data_sales);
					$_html = $this->load->view('supplier/sales-perWeek',$data_page,TRUE);

					echo $_html;

				}
				elseif($type == 'byweek-transaction') //Load page that get by week sales 
				{
					$this->report_transactional();
				}
				elseif($type == 'byweek-all')
				{
					//echo 'test dsf';
					$this->report_transactional_all();
				}
			}
		}
		else
			redirect('', 'refresh');
	}

	function report_transactional()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			$user_id = $this->session->userdata('id'); //id of the loged in user

			if ($user_type == 2) //supplier
			{
				$seller_fee_subscribed = $this->administrators->get_settings('supplier_selFee');
				$data_page['seller_fee'] = $seller_fee_subscribed;

				$date_range = $this->input->post('date');
				$status_transaction =  $this->input->post('stats_payment');

				$dates = explode(';',$date_range);
				$add_days = 1;
				$data_page['date_transfer'] = date('M d,Y', $dates[1]+(24*3600* $add_days)); //Plus 1 Days from the Date End of the 5 days

				// getting all the sales with in a certrain week by date range and the bsd_status 1
				$data_page['_data_sales'] = $this->suppliers->get_sales_perWeek($dates,$user_id, 1);

				$_html = $this->load->view('supplier/sales-perWeek-transactional',$data_page,TRUE);
				echo $_html;
			}

		}
	}

	function report_transactional_all()
	{
		if ($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type');
			$user_id = $this->session->userdata('id'); //id of the loged in user

			if ($user_type == 2) //supplier
			{

				$supplier_info = $this->suppliers->supplierinfo($user_id);
				$start_register =  $supplier_info->u_time;
				$data_page['range_week'] = $this->suppliers->rangeWeek($start_register);

				$seller_fee_subscribed = $this->administrators->get_settings('supplier_selFee');
				$data_page['seller_fee'] = $seller_fee_subscribed;

				//$date_range = $this->input->post('date');

				//$dates = explode(';',$date_range);
				//$add_days = 1;
				//$data_page['date_transfer'] = date('M d,Y', $dates[1]+(24*3600* $add_days)); //Plus 1 Days from the Date End of the 5 days

				// getting all the sales with in a certrain week by date range and the bsd_status 1
				//$data_page['_data_sales'] = $this->suppliers->get_sales_perWeek($dates,$user_id, 1);

				$_html = $this->load->view('supplier/sales-perWeek-all',$data_page,TRUE);
				echo $_html;
			}

		}
	}

}
?>