<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class inventory extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('users');
		$this->load->model('manufacturers');
		$this->load->model('inventories');
		$this->load->model('categories');
		$this->load->model('countries');
		$this->load->model('suppliers');
		$this->load->model('brands');
		$this->load->model('administrators');
    }

	public function index()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 1) //1 is admin, 2 supplier
			{
				$data['list_manufac'] = $this->manufacturers->listing(); 
				$data['categories'] = $this->categories->listings();
				$data['inventory'] = $this->inventories->listings();
				$this->load->view('admin/inventory/inventory-page',$data);
			}
			if($user_type == 2) //Intended for Supplier
			{
				$id = $this->session->userdata('id');
				$data['info'] =  $this->users->info($id);
				//$data['inventories'] = $this->suppliers->child_list($id); //used ajax not load here go to search()
				$this->load->view('supplier/supplier-home-inventory',$data);
			}
		}
		else
			redirect('','refresh');
	}

	function search()
	{
		$search_type = $this->uri->segment(3);

		if($search_type == 'supplier_search_add') //searching product in adding product process for supplier
		{
			$search_prod = $this->input->post('search_prod');

			$data['products'] = $this->inventories->search_forAddProduct($search_prod);
			
			$result_html = $this->load->view('supplier/searched-add-product',$data,TRUE);
			echo $result_html;

		}
		elseif($search_type == 'quick') //loading result in the left sidebar in dropdown search
		{	
			$prod_search = $this->input->post('val');
			$search_result = $this->inventories->search_forAddProduct($prod_search, true); //only get the title of the product

			$data['product'] = $search_result;
			$result_html =  $this->load->view('search-sidebar-product-result',$data,TRUE);
			echo $result_html;
		}
		elseif($search_type == 'product')
		{
			$search_via_link = $this->uri->segment(4);

			$action = $this->input->post('action');
			if($action != '') //loading the data or other method that will be used in the future
			{
				if($action == 'get') //getting all the result value
				{
					$cat = $this->input->post('cat');
					$manu = $this->input->post('manu');
					$from = $this->input->post('from');
					$to = $this->input->post('to');
					$supplier = $this->input->post('supplier');

					$data['inventories'] = $this->inventories->search_forProductSearch($search_via_link,false,$cat,$manu,$from,$to,$supplier); //only get the title of the product
					$result_html =  $this->load->view('sidebar-product-result',$data,TRUE);
					echo $result_html; 
				}
			}
			else
			{

				$data['categories'] = $this->categories->listings_by_product($search_via_link); //main categories
				$data['manus'] = $this->manufacturers->listings_by_product($search_via_link);
				$data['search_page'] = true;
				$data['search_name'] = $search_via_link;
				$data['search_price_from'] = '';
				$data['search_price_to'] = '';
				$data['suppliers'] = $this->suppliers->listing(1);
				$data['dym_link'] = base_url().'inventory/search/product/'.$search_via_link;
				$this->load->view('search-sidebar-result-page',$data);
				
			}
		

		}
		elseif($search_type == 'price')
		{	
			$search_via_link = '';
			$from = $this->uri->segment(4);
			$to = $this->uri->segment(5);

			$action = $this->input->post('action');
			if($action != '') //loading the data or other method that will be used in the future
			{
				if($action == 'get') //getting all the result value
				{
					$cat = $this->input->post('cat');
					$manu = $this->input->post('manu');
					$from = $this->input->post('from');
					$to = $this->input->post('to');
					$supplier = $this->input->post('supplier');
					
					$data['inventories'] = $this->inventories->search_forProductSearch($search_via_link,false,$cat,$manu,$from,$to,$supplier ); //only get the title of the product
					$result_html =  $this->load->view('sidebar-product-result',$data,TRUE);
					echo $result_html; 
				}
			}
			else
			{

				$data['categories'] = $this->categories->listings_by_product($search_via_link); //main categories
				$data['manus'] = $this->manufacturers->listings_by_product($search_via_link);
				$data['search_page'] = true;
				$data['suppliers'] = $this->suppliers->listing(1);
				$data['search_name'] = $search_via_link;
				$data['search_price'] = '$'.$from.' ~ $'.$to;
				$data['search_price_from'] = $from;
				$data['search_price_to'] = $to;
				if($from != '' && $to != '')
					$added_price_search = '/'.$from.'/'.$to;
				else
					$added_price_search = '';

				$data['dym_link'] = base_url().'inventory/search/price/'.$added_price_search;
				$this->load->view('search-sidebar-result-page',$data);
			}


		}
		
		else //this is for the admin or Supplier
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 1) //1 is admin
			{
				$name = $this->input->post('name');
				$manu = $this->input->post('manu'); 
				$brand = $this->input->post('brand');
				
				$result = $this->inventories->listings($name,$manu,$brand);

				$data['inventory'] = $result;
				$result_html =  $this->load->view('admin/inventory/search-result-table',$data,TRUE);
				echo $result_html;
			}
			elseif($user_type == 2) // 2 supplier 
			{
				$name = $this->input->post('name');
				$manu = $this->input->post('manu'); 
				$brand = $this->input->post('brand');
				
				$id = $this->session->userdata('id');
				$data['inventories'] = $this->suppliers->child_list($id,$name,$manu,$brand);
				$result_html =  $this->load->view('supplier/supplier-search-product-list',$data,TRUE);
				echo $result_html;
			}
		}
	}

	function save_category_search()
	{
		$cat = $this->input->post('selected_category');

		$catdata = array(
					   'category_search'  => $cat,
		);

	 	$this->session->set_userdata($catdata);
	}

	function save_manu_search()
	{
		$manu = $this->input->post('selected_manu');

		$manudata = array(
					   'manu_search'  => $manu,
		);
		
	 	$this->session->set_userdata($manudata);
	 	echo print_r($manu);$data['search_price'];
	}

	function add(){
		
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			$uid = $this->session->userdata('id');
			if($this->input->post('action') != "") 
			{
				$action = $this->input->post('action');
				if($action == 'add') //if adding inventory
				{

					$ucp_ean = $this->input->post('ucp_ean');
					$manu_num = $this->input->post('manu_num');
					$manu = $this->input->post('manu');
					$brand = $this->input->post('brand');
					$weight = $this->input->post('weight');
					$weight_scale = $this->input->post('weight_scale');
					$sup_fee = $this->input->post('sup_fee');
					$ship_alone = $this->input->post('ship_alone');
					$height = $this->input->post('height');
					$width = $this->input->post('width');
					$depth = $this->input->post('depth'); 
					$d_scale = $this->input->post('d_scale'); 
					$category = $this->input->post('category');
					
					$this->load->library('form_validation');

					if($user_type == 2) //IF USER TYPE IS SUPPLIER, ADD INFORMATION FOR INVENTORY CHILD
					{
						$sku = $this->input->post('sku');
						$quan = $this->input->post('quan');
						$price = $this->input->post('price');
						$ret_price = $this->input->post('ret_price');
						$lead_time = $this->input->post('lead_time');
						$map = $this->input->post('map');
						$ship_cost = $this->input->post('ship_cost');
						$ship_from = $this->input->post('ship_from');
						$prom_text = $this->input->post('prom_text');

						$this->form_validation->set_rules('sku','SKU','trim|required|xss_clean');	
						$this->form_validation->set_rules('quan','Quantity','trim|required|xss_clean');
						$this->form_validation->set_rules('price','Price','trim|required|xss_clean');
						$this->form_validation->set_rules('ret_price','Retailed Price','trim|required|xss_clean');
						$this->form_validation->set_rules('lead_time','Lead Time','trim|required|xss_clean');
						$this->form_validation->set_rules('map','MAP','trim|xss_clean');
					}

					$this->form_validation->set_rules('ucp_ean','UCP/EAN','trim|required|min_length[5]|xss_clean');	
					$this->form_validation->set_rules('manu_num','Manufacturing Number','trim|required|min_length[5]|xss_clean');	
					$this->form_validation->set_rules('manu','Manufacture','trim|required|xss_clean');
					$this->form_validation->set_rules('brand','Brand','trim|required|xss_clean');	
					$this->form_validation->set_rules('weight','Weight','trim|required|xss_clean');	
					$this->form_validation->set_rules('weight_scale','Weight Scale','trim|required|xss_clean');	

					$this->form_validation->set_rules('sup_fee','Supplier Fee','trim|required|xss_clean');	
					$this->form_validation->set_rules('ship_alone','Ship Alone','trim|required|xss_clean');	
					$this->form_validation->set_rules('height','Height','trim|required|xss_clean');	
					$this->form_validation->set_rules('width','Width','trim|required|xss_clean');	
					$this->form_validation->set_rules('depth','Depth','trim|required|xss_clean');	

					if($this->form_validation->run() == FALSE)
			        {
			        	//If has invalid input
						 $returnmessage = array( 'message' => validation_errors() , 'status' => 0);
			             echo json_encode($returnmessage);
			        }
			        else
			        {
			        	$array_insert = array(
			        						"u_id" => $uid,
			        						"ucp_ean" => $ucp_ean,
			        						"manuf_num" => $manu_num,
			        						"m_id" => $manu,
			        						"b_id" => $brand,
			        						"c_id" => $category, 
			        						"weight" => $weight,
			        						"weightScale" => $weight_scale,
			        						"qty" => 0,
			        						"sup_fee" => $sup_fee, //CHANGED TO ITEM PRICE
			        						"ship_alone" => $ship_alone,
			        						"d_height" => $height,
			        						"d_width" => $width,
			        						"d_dept" => $depth,
			        						"d_scale" => $d_scale,
			        						"i_time" => time(),
			        	 );

			        	$i_id = $this->inventories->add($array_insert);

			        	$lang_title = $this->input->post('lang_title'); 
						$short_desc = $this->input->post('short_desc'); 
						$long_decs = $this->input->post('long_decs'); 
						$lang = $this->input->post('lang');

						$data_add_language = array('i_id' => $i_id,
												   'c_id' => $lang,
												   'tr_title' => $lang_title,
												   'tr_short_desc' => $short_desc,
												   'tr_desc' => $long_decs,
												   'tr_time' => time());

						$this->inventories->add_product_translation($data_add_language);

						if($user_type == 2) //IF USER TYPE IS SUPPLIER, ADD INFORMATION FOR INVENTORY CHILD
						{
							$add_array = array('i_id' =>$i_id,
									   'u_id' =>$uid,
									   'SKU' =>$sku,
									   'ic_quan' =>$quan,
									   'ic_price' =>$price,
									   'ic_retail_price' =>$ret_price,
									   'ic_leadtime' => $lead_time,
									   'ic_map' => $map,
									   'ic_ship_cost' => $ship_cost,
									   'ic_ship_country' => $ship_from,
									   'ic_prom_text' => $prom_text,
									   'ic_time' =>time());
							$stock_id =$this->inventories->add_stock($add_array);
						}
							

						if($user_type == 2) 
							$returnmessage = array( 'message' => base_url().'inventory/detail/'.$i_id."/".$stock_id."" , 'status' => 1);
						elseif($user_type == 1)
			        		$returnmessage = array( 'message' => base_url().'inventory/detail/'.$i_id."" , 'status' => 1);
			        	echo json_encode($returnmessage);
			        }
				}
				elseif($action == 'stock')
				{
					$sku = $this->input->post('sku');
					$quan = $this->input->post('quan');
					$price = $this->input->post('price');
					$ret_price = $this->input->post('ret_price');
					$lead_time = $this->input->post('lead_time');
					$i_id = $this->input->post('inv_id');
					$map = $this->input->post('map');
					$ship_cost = $this->input->post('ship_cost');
					$ship_from = $this->input->post('ship_from');
					$prom_text = $this->input->post('prom_text');

					$this->load->library('form_validation');
	
					$this->form_validation->set_rules('sku','SKU','trim|required|min_length[4]|xss_clean');	
					$this->form_validation->set_rules('quan','Quantity','trim|required|numeric|min_length[5]|xss_clean');	
					$this->form_validation->set_rules('price','Price','trim|required|numeric|xss_clean');
					$this->form_validation->set_rules('ret_price','Retailed Price','trim|required|numeric|xss_clean');	

					if($map != "")
						$this->form_validation->set_rules('map','MAP','trim|numeric|xss_clean');	

					$this->form_validation->set_rules('ship_cost','Ship Cost','trim|numeric|required|xss_clean');
					$this->form_validation->set_rules('ship_from','Ship Country','trim|required|xss_clean');	
					$this->form_validation->set_rules('prom_text','Promo Text','trim|xss_clean');	
					$this->form_validation->set_rules('inv_id','Inventory ID','trim|required|xss_clean');	

					if($this->form_validation->run() == FALSE)
			        {
						 $returnmessage = array( 'message' => validation_errors() , 'status' => 0);
			             echo json_encode($returnmessage);
			        }
			        else
			        {
			        	$add_array = array('i_id' =>$i_id,
									   'u_id' =>$uid,
									   'SKU' =>$sku,
									   'ic_quan' =>$quan,
									   'ic_price' =>$price,
									   'ic_retail_price' =>$ret_price,
									   'ic_leadtime' => $lead_time,
									   	'ic_map' => $map,
									   'ic_ship_cost' => $ship_cost,
									   'ic_ship_country' => $ship_from,
									   'ic_prom_text' => $prom_text,
									   'ic_time' =>time());

						$ic_id = $this->inventories->add_stock($add_array);

						$url_ext =  $i_id.'/'.$ic_id;
						$returnmessage = array( 'message' => "Stock is Added Succesfully", 'status' => 1,'url_ext' => $url_ext );
			            echo json_encode($returnmessage);
			        }

					
				}
			}
			else
			{
				if($user_type == 1) //1 is admin, 2 supplier
				{
					$level = 0;
					$data['list_manufac'] = $this->manufacturers->listing(); 
					$data['scale_dimension'] = $this->categories->scale_dimension_listing();
					$data['list_scale'] = $this->inventories->listing_scale();
					$data['categories'] = $this->categories->listings($level);
					$data['countries'] = $this->countries->listing_country();
					$data['default_country'] = $this->countries->default_country();
					$this->load->view('admin/inventory/add-inventory',$data);
				}
				elseif($user_type == 2) //For Supplier
				{
					$view_form = $this->uri->segment(3);
					if($view_form == "stock") //Add Child inventory to Main Inventory
					{
						$i_id = $this->uri->segment(4);
							$this->addStockInventory($i_id); //redirect to another function for stock inventory page

					}
					else
						$this->addSupplierInventory(); //Add Product for Supplier
				}			
			}
		}
		else
			redirect('','refresh');
	}

	function addSupplierInventory() //This function Serve for adding product for supplier Invetnory Master
	{	
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 2) //2 supplier
			{
				$level = 0;
				$data['list_manufac'] = $this->manufacturers->listing(); 
				$data['scale_dimension'] = $this->categories->scale_dimension_listing();
				$data['list_scale'] = $this->inventories->listing_scale();
				$data['categories'] = $this->categories->listings($level);
				$data['countries'] = $this->countries->listing_country();
				$data['default_country'] = $this->countries->default_country();						
				$this->load->view('supplier/supplier-add-masterProduct',$data);
			}
			else
				redirect('','refresh');
		}
		else
			redirect('','refresh');
	}

	function addStockInventory($i_id)
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($user_type == 2) //2 supplier
			{		
				$data['inventory'] = $this->inventories->detail($i_id);
				$data['countries'] = $this->countries->listing_country();
				$data['image_list'] = $this->inventories->list_image($i_id);
				$this->load->view('supplier/supplier-add-stock',$data);
			}
			else
				redirect('','refresh');
		}
		else
			redirect('','refresh');

	}


	function update()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($this->input->post('action') != "") 
			{
				$action = $this->input->post('action');
				if($action == 'update_product')
				{
					$i_id = $this->input->post('id');

					$ucp_ean = $this->input->post('ucp_ean');
					$manu_num = $this->input->post('manu_num');
					$manu = $this->input->post('manu');
					$brand = $this->input->post('brand');
					$weight = $this->input->post('weight');
					$weight_scale = $this->input->post('weight_scale');
					$sup_fee = $this->input->post('sup_fee');
					$ship_alone = $this->input->post('ship_alone');
					$height = $this->input->post('height');
					$width = $this->input->post('width');
					$depth = $this->input->post('depth');
					$d_scale = $this->input->post('d_scale'); 
					$category = $this->input->post('category');
					

					$this->load->library('form_validation');
	
					$this->form_validation->set_rules('ucp_ean','UCP/EAN','trim|required|min_length[5]|xss_clean');	
					$this->form_validation->set_rules('manu_num','Manufacturing Number','trim|required|min_length[5]|xss_clean');	
					$this->form_validation->set_rules('manu','Manufacture','trim|required|xss_clean');
					$this->form_validation->set_rules('brand','Brand','trim|required|xss_clean');	
					$this->form_validation->set_rules('weight','Weight','trim|required|xss_clean');	
					$this->form_validation->set_rules('weight_scale','Weight Scale','trim|required|xss_clean');	

					$this->form_validation->set_rules('sup_fee','Supplier Fee','trim|required|xss_clean');	
					$this->form_validation->set_rules('ship_alone','Ship Alone','trim|required|xss_clean');	
					$this->form_validation->set_rules('height','Height','trim|required|xss_clean');	
					$this->form_validation->set_rules('width','Width','trim|required|xss_clean');	
					$this->form_validation->set_rules('depth','Depth','trim|required|xss_clean');

					if($this->form_validation->run() == FALSE)
			        {
			        	//If has invalid input
						 $returnmessage = array( 'message' => validation_errors() , 'status' => 0);
			             echo json_encode($returnmessage);
			        }
			        else
			        {
			        	$array_update = array("ucp_ean" => $ucp_ean,
			        						"manuf_num" => $manu_num,
			        						"m_id" => $manu,
			        						"b_id" => $brand,
			        						"c_id" => $category, 
			        						"weight" => $weight,
			        						"weightScale" => $weight_scale,
			        						"qty" => 0,
			        						"sup_fee" => $sup_fee, //CHANGED TO ITEM PRICE
			        						"ship_alone" => $ship_alone, 
			        						"d_height" => $height,
			        						"d_width" => $width,
			        						"d_dept" => $depth,
			        						"d_scale" => $d_scale,
			        						"i_time" => time(),
			        	 );

			        	$where = "i_id";

			        	$result = $this->inventories->update($array_update,$i_id,$where);
			        	$returnmessage = array( 'message' => "Successfull Update" , 'status' => 1);
			        	echo json_encode($returnmessage);
			        }
				}
				elseif($action == 'set_feature_image') //if setting featured image
				{
					$id_sel = $this->input->post('imgid');
					$product_id = $this->input->post('id');
					$data_remove_set = array('ii_feat' => 0);
					$data_new_set = array('ii_feat' => 1);

					$this->inventories->update_featured_image($data_remove_set,$data_new_set,$id_sel,$product_id);
				}
				elseif($action == 'update_stock')
				{
					$sku = $this->input->post('sku');
					$quan = $this->input->post('quan');
					$price = $this->input->post('price');
					$ret_price = $this->input->post('ret_price');
					$lead_time = $this->input->post('lead_time');
					$ic_id = $this->input->post('ic_id');

					$ic_ship_cost = $this->input->post('ship_cost');
					$ic_ship_country = $this->input->post('ship_from');
					$ic_map = $this->input->post('map');
					$ic_prom_text = $this->input->post('prom_text');

					$this->load->library('form_validation');
	
					$this->form_validation->set_rules('sku','SKU','trim|required|min_length[4]|xss_clean');	
					$this->form_validation->set_rules('quan','Quantity','trim|required|numeric|min_length[5]|xss_clean');	
					$this->form_validation->set_rules('price','Price','trim|required|decimal|xss_clean');
					$this->form_validation->set_rules('ret_price','Retailed Price','trim|required|decimal|xss_clean');	

					if($ic_map != "")
						$this->form_validation->set_rules('map','MAP','trim|decimal|xss_clean');	

					$this->form_validation->set_rules('ship_cost','Ship Cost','trim|decimal|required|xss_clean');
					$this->form_validation->set_rules('ship_from','Ship Country','trim|required|xss_clean');	
					$this->form_validation->set_rules('prom_text','Promo Text','trim|xss_clean');	
					$this->form_validation->set_rules('ic_id','Inventory Child ID','trim|required|xss_clean');	

					if($this->form_validation->run() == FALSE)
			        {
						 $returnmessage = array( 'message' => validation_errors() , 'status' => 0);
			             echo json_encode($returnmessage);
			        }
			        else
			        {
						$update_array = array('SKU' =>$sku,
										   'ic_quan' =>$quan,
										   'ic_price' =>$price,
										   'ic_retail_price' =>$ret_price,
										   'ic_leadtime' => $lead_time,
										   'ic_ship_cost' => $ic_ship_cost,
										   'ic_ship_country' => $ic_ship_country,
										   'ic_map' => $ic_map,
										   'ic_prom_text' => $ic_prom_text,
										   'ic_time' =>time());
						$where = 'ic_id';
						
						$this->inventories->update_stock($update_array,$where,$ic_id);

						$returnmessage = array( 'message' => "Success Update Child Inventory", 'status' => 1);
			            echo json_encode($returnmessage);
					}
				}
			}
			else //Different Viewing Form
			{
				$id_product = $this->uri->segment(3);

				if($user_type == 1) //1 is admin 
				{
					$data['product'] = $this->inventories->detail($id_product);

					$data['list_manufac'] = $this->manufacturers->listing(); 
					$data['list_scale'] = $this->inventories->listing_scale();
					$data['categories'] = $this->categories->listings("0");
					$data['countries'] = $this->countries->listing_country();
					$data['scale_dimension'] = $this->categories->scale_dimension_listing();

					$data['default_country'] = $this->countries->default_country();//select default country attribute

					$data['translation_list'] = $this->inventories->list_product_translation($id_product);
					$data['image_list'] = $this->inventories->list_image($id_product);
					if($data['product'] == false)
						redirect('','refresh');
					else
					$this->load->view('admin/inventory/update-inventory',$data);

				}
				elseif($user_type == 2) // 2 is Supplier
				{
					

					$data['product'] = $this->suppliers->detail_child_inventory($id_product); //id of the child 
					if($data['product']->master_uid == $this->session->userdata('id')) //if the owner or maker of the maser inventory
					{
						$data['list_manufac'] = $this->manufacturers->listing(); 
						$data['list_scale'] = $this->inventories->listing_scale();
						$data['categories'] = $this->categories->listings("0");
						$data['countries'] = $this->countries->listing_country();
						$data['scale_dimension'] = $this->categories->scale_dimension_listing();

						$data['default_country'] = $this->countries->default_country();//select default country attribute

						$data['translation_list'] = $this->inventories->list_product_translation($data['product']->i_id);
						$data['image_list'] = $this->inventories->list_image($data['product']->i_id);
						if($data['product'] == false)
							redirect('','refresh');
						else
						$this->load->view('supplier/supplier-update-inventory',$data);
					}
					elseif($data['product']->child_uid == $this->session->userdata('id')) //has previledge to edit the child details
					{
						$data['inventory'] = $data['product'];
						$data['countries'] = $this->countries->listing_country();
						$data['image_list'] = $this->inventories->list_image($data['product']->i_id);
						
						$this->load->view('supplier/supplier-update-stock',$data);
					}
					else
						redirect('','refresh');
				}
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
			if($user_type == 2 || $user_type == 3 || $user_type == 1) //2 is supplier or Buyer
			{
				$id_product = $this->uri->segment(3);//id id master inventory
				$id_child_product = $this->uri->segment(4);//id for child inventory

				if($id_product != "")
				{
					if($id_child_product == "") //checking all suppliers that has the lowest price
						$id_child_product  = $this->suppliers->check_lowest_bid($id_product);

					if($id_child_product == "")//if no childproduct must load normal product page
					{
						$data['categories'] = array(); //main categories
						$data['brands'] = array();
						$data['manus'] = array();

						$data['has_child'] = false; 

						$data['product'] = $this->suppliers->detail_main_inventory($id_product); //id of the child 
						$data['translations'] = $this->inventories->list_translation_product($data['product']->i_id,'c_name, c_code, translation.c_id'); 
						$data['image_list'] = $this->inventories->list_image($data['product']->i_id);
						$this->load->view('view-product',$data);
					}
					else
					{
						$data['has_child'] = true; 

						$data['product'] = $this->suppliers->detail_child_inventory($id_child_product); //id of the child 
						$data['suppliers'] = $this->suppliers->list_supplier_child_attached($id_product);
						$data['translations'] = $this->inventories->list_translation_product($data['product']->i_id,'c_name, c_code, translation.c_id'); 
						$data['image_list'] = $this->inventories->list_image($data['product']->i_id);
						
						$data['categories'] = array(); //main categories
						$data['brands'] = array();
						$data['manus'] = array();
						
						if($data['product'] == false)
							redirect('','refresh');
						else
							$this->load->view('view-product',$data);
					}
				}	
				else
					redirect('','refresh');
			}

		}
		else //If no user login
		{
			$id_product = $this->uri->segment(3);//id id master inventory
			$id_child_product = $this->uri->segment(4);//id for child inventory

			if($id_product != "")
			{
				if($id_child_product == "") //checking all suppliers that has the lowest price
					$id_child_product  = $this->suppliers->check_lowest_bid($id_product);

				$data['product'] = $this->suppliers->detail_child_inventory($id_child_product); //id of the child 
				$data['suppliers'] = $this->suppliers->list_supplier_child_attached($id_product);

				if($id_child_product == "")//if no childproduct must load normal product page
				{
					$data['categories'] = array(); //main categories
					$data['brands'] = array();
					$data['manus'] = array();

					$data['has_child'] = false; 

					$data['product'] = $this->suppliers->detail_main_inventory($id_product); //id of the child 
					$data['translations'] = $this->inventories->list_translation_product($data['product']->i_id,'c_name, c_code, translation.c_id'); 
					$data['image_list'] = $this->inventories->list_image($data['product']->i_id);
					$this->load->view('view-product',$data);
				}
				else
				{
					$data['has_child'] = true; 
					$data['translations'] = $this->inventories->list_translation_product($data['product']->i_id,'c_name, c_code, translation.c_id'); 
					$data['image_list'] = $this->inventories->list_image($data['product']->i_id);
					
					$data['categories'] = array(); //main categories
					$data['brands'] = array();
					$data['manus'] = array();
					$this->load->view('view-product',$data);
				}
			}

			else
				redirect('','refresh');

		}

	}

	function translation()
	{
		if($this->session->userdata('is_login') == TRUE)
		{
			$user_type = $this->session->userdata('type'); //get user type;
			if($this->input->post('action') != "") 
			{
				$action = $this->input->post('action');
				if($action == 'add') //if adding inventory
				{
					$data_insert = array('i_id'=> $this->input->post('id'),
										 'c_id'=> $this->input->post('lang'),
										 'tr_title'=> trim($this->input->post('title')),
										 'tr_short_desc'=> trim($this->input->post('short_desc')),
										 'tr_desc'=> trim($this->input->post('desc')),
										 'tr_time'=> time(),		);

					$id = $this->inventories->add_product_translation($data_insert);
				}
				elseif($action == 'detail') //if get detail
				{
					$tr_id = $this->input->post('id');
					$result = $this->inventories->translation_detail($tr_id);

					echo json_encode($result);
				}
				elseif($action == 'update') //if update
				{
					$tr_id = $this->input->post('id');

					$array_update = array('tr_title'=> $this->input->post('title'),
										  'tr_short_desc'=> $this->input->post('short_desc'),
										  'tr_desc'=> $this->input->post('desc'));

					$result = $this->inventories->update_translation($array_update,$tr_id);

					echo json_encode($result);
				}
				elseif($action == 'delete') //if delete
				{
					$tr_id = $this->input->post('id');
					$result = $this->inventories->translation_delete($tr_id);

					echo json_encode($result);
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
			if($this->input->post('action') != "") 
			{
				$action = $this->input->post('action');
				if($action == 'image') //if adding inventory
				{
					$ii_id = $this->input->post('imgid');
					$id = $this->inventories->delete_image($ii_id);
				}
			}
		}
		else
			redirect('','refresh');
	}


}
