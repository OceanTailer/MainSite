<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class upload extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        $this->load->model('inventories');

    }

    function product_attachment()
	{

		//Decode JSON returned by /js/uploadify/upload.php
		$file = $this->input->post('filearray');
		$images = json_decode($file);

		//echo print_r($file);
		$id = $this->input->post('product_id');

			
		$time = time();

		$dir = dirname(__FILE__);
			$dir = str_replace("application\controllers", "product_image\\", $dir ); 

		$fle_path = $dir.'\\'.$images->file_name;
		$fle_directory = $dir.'\\'.$id.'\\';
		$fle_move = $dir.'\\'.$id.'\\'.$time.$images->file_name;

		if (!is_dir($fle_directory)) {
		    mkdir($fle_directory);
		}		

		if (copy($fle_path ,$fle_move )) {
		  unlink($fle_path);
		}

		$image_link = base_url().'product_image/'.$id."/".$time.$images->file_name;
		$array_data = array("i_id" => $id,
					   "ii_name" => $images->file_name,
					   "ii_link" => $image_link,
					   "ii_feat" => 0,
					   "ii_time" => $time );

		$image_id = $this->inventories->add_image($array_data);

		$data_link['link'] = $image_link;
		$data_link['id'] = $image_id;
		$image_result = $this->load->view('admin/inventory/inventory-image-list',$data_link, true);

		echo $image_result;

	}

	function do_upload()
   {
        $config['upload_path'] = './product_image/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']    = '144400';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        
        $this->load->library('upload', $config);
    
        if ( ! $this->upload->do_upload())
        {
            echo $this->upload->display_errors();
            
        }    
        else
        {
            $data = array('upload_data' => $this->upload->data());
            
            print_r($data);
        }
    } 


}
