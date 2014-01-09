<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('accounts_model');
    }


    public function index($page = 'Login')
    {
        if($this->session->userdata('logged_in_admin') == TRUE)
            redirect('index.php/admin/home','refresh');
        else
        {
        	$navs = array('Login');
    		$data['navs'] = $navs;
    		$data['title'] = "Account";
    		$data['slogan'] = "Administrator";

        	$this->load->view('admin/header', $data);
        	$this->load->view('admin/login', $data);
        	$this->load->view('admin/footer');
        }
    }

    public function validate($page = 'login')
    {
        $navs = array('Login');
        $data['navs'] = $navs;
        $data['title'] = "Account";
        $data['slogan'] = "Administrator";

        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() == FALSE)
        {
            $data['message'] = validation_errors();
            $this->load->view('admin/header', $data);
            $this->load->view('admin/login', $data);
            $this->load->view('admin/footer');
        }
        else
        {
            $result = $this->accounts_model->admin_validate($user, $pass);
            if ($result == true)
            {
                redirect('index.php/admin/home','refresh');
            }
            else
            {
                $data['message'] = 'Invalid Login';
                $this->load->view('admin/header', $data);
                $this->load->view('admin/login', $data);
                $this->load->view('admin/footer');
            }
        }
    }

    public function home()
    {       
        if($this->session->userdata('logged_in_admin') == TRUE){
            $navs = array('Login');
            //$data['navs'] = $navs;
            $data['title'] = "Account";
            $data['slogan'] = "Welcome";
            $data['slogansub'] = "Administrator Account";
            $data['fullname'] = $this->session->userdata('fullname');

            $this->load->view('admin/header', $data);
            $this->load->view('admin/home', $data);
            $this->load->view('admin/footer');
        }
        else
         redirect('index.php/admin','refresh');
    }

    public function logout()
    {
        $this->accounts_model->logout();
        redirect('index.php/admin/home','refresh');
    }


    public function f16($page = 'home', $lang = 'dk')
    {
        if($this->session->userdata('logged_in_admin') == TRUE)
        {
            $request = $this->input->post('request');
            if($request == 'request')
            {
                $update_array = array('page_title' => $this->input->post('page_title'),
                                      'page_head1' => $this->input->post('page_head1'),
                                      'page_content1' => $this->input->post('page_content1'),
                                      'page_head2' => $this->input->post('page_head2'),
                                      'page_content2' => $this->input->post('page_content2'),
                                      'page_head3' => $this->input->post('page_head3'),
                                      'page_content3' => $this->input->post('page_content3'),
                                      'page_head4' => $this->input->post('page_head4'),
                                      'page_content4' => $this->input->post('page_content4'),
                                      'page_video1' => $this->input->post('page_video1'),
                                      'page_video2' => $this->input->post('page_video2'),
                                      'page_video3' => $this->input->post('page_video3'),
                                      'page_video4' => $this->input->post('page_video4'),
                                      );  

                $set_data = " page_title = '".$update_array['page_title']."' ,"." page_head1 = '".$update_array['page_head1']."', "." page_content1 = '".$update_array['page_content1']."', "
                            ." page_head2 = '".$update_array['page_head2']."', "." page_content2 = '".$update_array['page_content2']."', "
                            ." page_head3 = '".$update_array['page_head3']."', "." page_content3 = '".$update_array['page_content3']."', "
                            ." page_head4 = '".$update_array['page_head4']."', "." page_content4 = '".$update_array['page_content4']."' ,"
                            ." page_video1 = '".$update_array['page_video1']."' ,"." page_video2 = '".$update_array['page_video2']."' ,"
                            ." page_video3 = '".$update_array['page_video3']."' ,"." page_video4 = '".$update_array['page_video4']."' ";

                $page_id = $this->input->post('page_id');

                $this->accounts_model->page_update($set_data,'page_id',$page_id);
            }

           // echo $page.' '.$lang;

            $str = str_replace('-', ' ', $page);
            $data['slogan'] = "F-16 LEVELS";
            $data['title'] = ucfirst($str);
            $navs = array('LEVEL 1', 'LEVEL 2', 'LEVEL 3', 'LEVEL 4', 'LEVEL 5', 'LEVEL 6', 'LEVEL 7', 'LEVEL 8', 'LEVEL 9', 'LEVEL 10');
            $fullname = $this->session->userdata('fullname');
            $data['slogan_sub'] = $fullname;

            $data['lang'] = $lang;
            $data['navs'] = $navs;

            $this->load->view('admin/header-f16', $data);
            $data_user['lvl'] = 0;
            if($page == 'level-1'){
                $data_user['lvl'] = 1;
            }else if($page == 'level-2'){
                $data_user['lvl'] = 2;
            }else if($page == 'level-3'){
                $data_user['lvl'] = 3;
            }else if($page == 'level-4'){
                $data_user['lvl'] = 4;
            }else if($page == 'level-5'){
                $data_user['lvl'] = 5;
            }else if($page == 'level-6'){
                $data_user['lvl'] = 6;
            }else if($page == 'level-7'){
                $data_user['lvl'] = 7;
            }else if($page == 'level-8'){
                $data_user['lvl'] = 8;
            }else if($page == 'level-9'){
                $data_user['lvl'] = 9;
            }else if($page == 'level-10'){
                $data_user['lvl'] = 10;
            }
            $data_user['page_content'] = $this->accounts_model->page_content('f16',$data_user['lvl'], $lang);
            $data_user['page_id'] = $page;

            $this->load->view('f16/edit/level', $data_user);
            $this->load->view('admin/footer-f16');

            

        }
    }

    public function f1($page = 'home', $lang = 'dk')
    {
        
        if($this->session->userdata('logged_in_admin') == TRUE)
        {
            $request = $this->input->post('request');
            if($request == 'request')
            {
                $update_array = array('page_title' => $this->input->post('page_title'),
                                      'page_head1' => $this->input->post('page_head1'),
                                      'page_content1' => $this->input->post('page_content1'),
                                      'page_head2' => $this->input->post('page_head2'),
                                      'page_content2' => $this->input->post('page_content2'),
                                      'page_head3' => $this->input->post('page_head3'),
                                      'page_content3' => $this->input->post('page_content3'),
                                      'page_head4' => $this->input->post('page_head4'),
                                      'page_content4' => $this->input->post('page_content4'),
                                      'page_video1' => $this->input->post('page_video1'),
                                      'page_video2' => $this->input->post('page_video2'),
                                      'page_video3' => $this->input->post('page_video3'),
                                      'page_video4' => $this->input->post('page_video4'),
                                      );  

                $set_data = " page_title = '".$update_array['page_title']."' ,"." page_head1 = '".$update_array['page_head1']."', "." page_content1 = '".$update_array['page_content1']."', "
                            ." page_head2 = '".$update_array['page_head2']."', "." page_content2 = '".$update_array['page_content2']."', "
                            ." page_head3 = '".$update_array['page_head3']."', "." page_content3 = '".$update_array['page_content3']."', "
                            ." page_head4 = '".$update_array['page_head4']."', "." page_content4 = '".$update_array['page_content4']."' ,"
                            ." page_video1 = '".$update_array['page_video1']."' ,"." page_video2 = '".$update_array['page_video2']."' ,"
                            ." page_video3 = '".$update_array['page_video3']."' ,"." page_video4 = '".$update_array['page_video4']."' ";

                $page_id = $this->input->post('page_id');

                $this->accounts_model->page_update($set_data,'page_id',$page_id);
            }

            $str = str_replace('-', ' ', $page);
            $data['slogan'] = "F-16 LEVELS";
            $data['title'] = ucfirst($str);
            $navs = array('LEVEL 1', 'LEVEL 2', 'LEVEL 3', 'LEVEL 4', 'LEVEL 5', 'LEVEL 6', 'LEVEL 7', 'LEVEL 8', 'LEVEL 9', 'LEVEL 10');
            $fullname = $this->session->userdata('fullname');
            $data['slogan_sub'] = $fullname;
            
            $data['lang'] = $lang;
            $data['navs'] = $navs;

            $this->load->view('admin/header-f1', $data);
            $data_user['lvl'] = 0;
            if($page == 'level-1'){
                $data_user['lvl'] = 1;
            }else if($page == 'level-2'){
                $data_user['lvl'] = 2;
            }else if($page == 'level-3'){
                $data_user['lvl'] = 3;
            }else if($page == 'level-4'){
                $data_user['lvl'] = 4;
            }else if($page == 'level-5'){
                $data_user['lvl'] = 5;
            }else if($page == 'level-6'){
                $data_user['lvl'] = 6;
            }else if($page == 'level-7'){
                $data_user['lvl'] = 7;
            }else if($page == 'level-8'){
                $data_user['lvl'] = 8;
            }else if($page == 'level-9'){
                $data_user['lvl'] = 9;
            }else if($page == 'level-10'){
                $data_user['lvl'] = 10;
            }

            $data_user['page_content'] = $this->accounts_model->page_content('f1',$data_user['lvl'], $lang);
            $data_user['page_id'] = $page;
            $this->load->view('f1/edit/level', $data_user);
            $this->load->view('admin/footer-f1');

            

        }
    }

    function menu()
    {
        if($this->session->userdata('logged_in_admin') == TRUE){
            //$data['navs'] = $navs;
            $data['title'] = "Account";
            $data['slogan'] = "Welcome";
            $data['slogansub'] = "Administrator Account";
            $data['fullname'] = $this->session->userdata('fullname');

            $this->load->view('admin/headerPages', $data);
            $this->load->view('admin/menu', $data);
            $this->load->view('admin/footer');
        }
        else
            redirect('index.php/admin','refresh');
    }

    function Pages()
    {
        if($this->session->userdata('logged_in_admin') == TRUE){

            $action = $this->input->post('action');
            if($action == 'up')
            {
                $id = $this->input->post('idpage');
                $position = $this->input->post('position');

                $update_array = array('home_page_position' => $position);  
                $set_data = " home_page_position = '".$update_array['home_page_position']."' ";
                $this->accounts_model->page_home_update($set_data,'home_page_position',$position-1);

                 //up the data selected

               $update_array = array('home_page_position' => $position-1);  
               $set_data = " home_page_position = '".$update_array['home_page_position']."' ";
               $this->accounts_model->page_home_update($set_data,'home_page_id',$id);
            }
            //$data['navs'] = $navs;
            $data['title'] = "Account";
            $data['slogan'] = "Welcome";
            $data['slogansub'] = "Administrator Account";
            $data['fullname'] = $this->session->userdata('fullname');

            $data['homepages'] = $this->accounts_model->get_all_home_pages();

            $this->load->view('admin/headerPages', $data);
            $this->load->view('admin/managePages', $data);
            $this->load->view('admin/footer');
        }
        else
            redirect('index.php/admin','refresh');
    }

    function updatePage($id_page = "")
    {
         if($this->session->userdata('logged_in_admin') == TRUE){

            $request = $this->input->post('request');
            if($request == 'update')
            {
                $title_link = str_replace('-', ' ', $this->input->post('page_title'));

                $id_pages = $this->input->post('page_id');
                $update_array = array('home_page_link' => $title_link,
                                      'home_page_name' => $this->input->post('page_title'),
                                      'home_page_title' => $this->input->post('page_title'),
                                      'home_page_head1' => $this->input->post('page_head1'),
                                      'home_page_content1' => $this->input->post('page_content1'),
                                      'home_page_head2' => $this->input->post('page_head2'),
                                      'home_page_content2' => $this->input->post('page_content2'),
                                      'home_page_head3' => $this->input->post('page_head3'),
                                      'home_page_content3' => $this->input->post('page_content3'),
                                      'home_page_head4' => $this->input->post('page_head4'),
                                      'home_page_content4' => $this->input->post('page_content4'),
                                      'home_page_link1' => $this->input->post('page_video1'),
                                      'home_page_link2' => $this->input->post('page_video2'),
                                      'home_page_link3' => $this->input->post('page_video3'),
                                      'home_page_link4' => $this->input->post('page_video4'),
                                      );  


                $set_data = " home_page_link = '".$update_array['home_page_link']."' ,"." home_page_name = '".$update_array['home_page_name']."', "." home_page_title = '".$update_array['home_page_title']."', "
                            ." home_page_head1 = '".$update_array['home_page_head1']."', "." home_page_content1 = '".$update_array['home_page_content1']."', "
                            ." home_page_head2 = '".$update_array['home_page_head2']."', "." home_page_content2 = '".$update_array['home_page_content2']."', "
                            ." home_page_head3 = '".$update_array['home_page_head3']."', "." home_page_content3 = '".$update_array['home_page_content3']."' ,"
                            ." home_page_head4 = '".$update_array['home_page_head4']."' ,"." home_page_content4 = '".$update_array['home_page_content4']."' ,"
                            ." home_page_link1 = '".$update_array['home_page_link1']."' ,"." home_page_link2 = '".$update_array['home_page_link2']."' ,"
                            ." home_page_link3 = '".$update_array['home_page_link3']."' ,"." home_page_link4 = '".$update_array['home_page_link4']."' ";

                $this->accounts_model->page_home_update($set_data,'home_page_id',$id_pages);
            }

            if($id_page == "")
                redirect('index.php/admin','refresh');
            else
            { 
                $navs = array('Home');
                //$data['navs'] = $navs;
                $data['title'] = "Account";
                $data['slogan'] = "Welcome";
                $data['slogansub'] = "Administrator Account";
                $data['fullname'] = $this->session->userdata('fullname');
                echo $id_page;
                $data['page'] =  $this->accounts_model->get_page_content_byID($id_page);

                $this->load->view('admin/headerPages', $data);
                $this->load->view('admin/updatePage', $data);
                $this->load->view('admin/footer');
            }
        }
        else
            redirect('index.php/admin','refresh');       
    }

    function manageTemplate()
    {
        if($this->session->userdata('logged_in_admin') == TRUE){

            $request = $this->input->post('request');
            if($request == 'update')
            {
                $head = $this->input->post('textHeader');
                $footer = $this->input->post('textFooter');
                $set_data = " headerText = '".$head."' ,"." footerText = '".$footer."'";

                $this->accounts_model->update_setting($set_data);
            }
            $navs = array('Home');
            //$data['navs'] = $navs;
            $data['title'] = "Account";
            $data['slogan'] = "Welcome";
            $data['slogansub'] = "Administrator Account";
            $data['fullname'] = $this->session->userdata('fullname');

            $data['setting'] = $this->accounts_model->setting_detail();

            $this->load->view('admin/headerPages', $data);
            $this->load->view('admin/manageTemplatePage', $data);
            $this->load->view('admin/footer');
        }
    }

    function addPage()
    {
        if($this->session->userdata('logged_in_admin') == TRUE){

            $request = $this->input->post('request');
            if($request == 'add')
            {
                $title_link = str_replace('-', ' ', $this->input->post('page_title'));

                $latest_poistion = $this->accounts_model->latest_position()+1;

                $update_array = array('home_page_link' => $title_link,
                                      'home_page_name' => $this->input->post('page_title'),
                                      'home_page_title' => $this->input->post('page_title'),
                                      'home_page_head1' => $this->input->post('page_head1'),
                                      'home_page_content1' => $this->input->post('page_content1'),
                                      'home_page_head2' => $this->input->post('page_head2'),
                                      'home_page_content2' => $this->input->post('page_content2'),
                                      'home_page_head3' => $this->input->post('page_head3'),
                                      'home_page_content3' => $this->input->post('page_content3'),
                                      'home_page_head4' => $this->input->post('page_head4'),
                                      'home_page_content4' => $this->input->post('page_content4'),
                                      'home_page_link1' => $this->input->post('page_video1'),
                                      'home_page_link2' => $this->input->post('page_video2'),
                                      'home_page_link3' => $this->input->post('page_video3'),
                                      'home_page_link4' => $this->input->post('page_video4'),
                                      'home_page_editable' => 1,
                                      'home_page_position' => $latest_poistion
                                      );  

                $set_data = 
                "(home_page_link,home_page_name, home_page_title,home_page_head1,home_page_content1,home_page_head2, home_page_content2,home_page_head3,home_page_content3,home_page_head4,home_page_content4,home_page_link1,home_page_link2,home_page_link3,home_page_link4,home_page_editable,home_page_position  )"
                ."VALUES ( '".$update_array['home_page_link']."' , '".$update_array['home_page_name']."', '".$update_array['home_page_title']."',  "." '".$update_array['home_page_head1']."', '".$update_array['home_page_content1']."',
                  '".$update_array['home_page_head2']."', '".$update_array['home_page_content2']."', '".$update_array['home_page_head3']."', '".$update_array['home_page_content3']."' ,'".$update_array['home_page_head4']."', 
                  '".$update_array['home_page_content4']."', '".$update_array['home_page_link1']."', '".$update_array['home_page_link2']."', '".$update_array['home_page_link3']."', '".$update_array['home_page_link4']."', 
                  '".$update_array['home_page_editable']."', '".$update_array['home_page_position']."'  )";

/*                ."  home_page_link = '".$update_array['home_page_link']."' ,"." home_page_name = '".$update_array['home_page_name']."', "
                            ." home_page_title = '".$update_array['home_page_title']."', "." home_page_head1 = '".$update_array['home_page_head1']."', "
                            ." home_page_content1 = '".$update_array['home_page_content1']."', "." home_page_head2 = '".$update_array['home_page_head2']."', "
                            ." home_page_content2 = '".$update_array['home_page_content2']."', "." home_page_head3 = '".$update_array['home_page_head3']."' ,"
                            ." home_page_content3 = '".$update_array['home_page_content3']."' ,"." home_page_head4 = '".$update_array['home_page_head4']."' ,"
                            ." home_page_content4 = '".$update_array['home_page_content4']."' ,"." home_page_link1 = '".$update_array['home_page_link1']."' ,"
                            ." home_page_link2 = '".$update_array['home_page_link2']."', "." home_page_link3 = '".$update_array['home_page_link3']."', "
                            ." home_page_link4 = '".$update_array['home_page_link4']."', "." home_page_editable = '".$update_array['home_page_editable']."', "
                            ." home_page_position = '".$update_array['home_page_position']."'";*/

                $this->accounts_model->page_home_add($set_data);
            }
            $navs = array('Home');
            //$data['navs'] = $navs;
            $data['title'] = "Account";
            $data['slogan'] = "Welcome";
            $data['slogansub'] = "Administrator Account";
            $data['fullname'] = $this->session->userdata('fullname');

            $this->load->view('admin/headerPages', $data);
            $this->load->view('admin/addPage', $data);
            $this->load->view('admin/footer');
        }
        else
            redirect('index.php/admin','refresh');
    }

}
