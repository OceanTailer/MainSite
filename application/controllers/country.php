<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->load->model('countries');
    }

	public function index()
	{

		redirect('','refresh');
	}

	function load()
	{
		if($this->input->post('type') != "") 
		{
			$type = $this->input->post('type');
			if($type == 'dropdown') //load type
			{
				$country_sel  = $this->input->post('id');
				$states = $this->countries->states($country_sel);
				$sel = $this->input->post('sel');

				if(count($states) == 0)
					echo 0;
				else
				{
					$html = "";
					foreach($states as $state)
					{
						if($sel == $state->st_name)
							$html .= "<option selected='selected'  value='".$state->st_name."'>".$state->st_name."</option>";
						else
							$html .= "<option value='".$state->st_name."'>".$state->st_name."</option>";
					}
					echo $html;
				}
			}
		}
	}

}
