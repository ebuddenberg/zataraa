<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_setting extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		 $this->load->model('general_setting_m');
		 $this->load->library("pagination");
	}

	public function index()
	{
        $this->data['title']="Slider";
        $config = array();
        $config["base_url"] = base_url() . "admin/general_setting/";
        $config["total_rows"] = $this->general_setting_m->Slider_count();
        $config["total_rows"] = $config["total_rows"];
		$config["num_links"] = $config["total_rows"];
		$config["per_page"] = 10;
		$config['use_page_numbers'] = TRUE;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = '&laquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&raquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
         if($this->uri->segment(3) == 0)
			{
			   $offset = 0;
			}
			else
			{
			   $offset = ($config['per_page'])*($this->uri->segment(3)-1);
			}
 
		
		$this->data['slider'] = $this->general_setting_m->all_slider($config["per_page"], $offset);
		$this->load->view('slider', $this->data);
	}
    public function view_slider(){
    	$id = $this->uri->segment(4);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->general_setting_m->view_slider($id)));
    }
    public function add_slider(){
           
 	   
		$config['upload_path'] = './admin-assets/sliders/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('thumbnail')) {
            $error = array('error' => $this->upload->display_errors());
            echo "Image not uploaded kindly check and submit again"; 
             
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $image_name =  $data['image_metadata']['file_name'];
            
             $this->general_setting_m->add_slider($image_name);
  	         redirect('admin/general_setting/','refresh');
 		     
        }
	  
	 
    }
    public function update_slider()
	{  

		      $id = $this->input->post('id');
              if (isset($id)) {

              	$config['upload_path'] = './admin-assets/sliders/';
                $config['allowed_types'] = 'gif|jpg|png';
		        $this->load->library('upload', $config);
                if (!$this->upload->do_upload('thumbnail')) {
			            $this->general_setting_m->update_slider($id);
	 			        $redirect  = 'admin/general_setting/';
	 			        redirect($redirect,'refresh');
	 			        
			             
			        } else {
			        	 
			            $data = array('image_metadata' => $this->upload->data());
			            $image_name =  $data['image_metadata']['file_name'];

                        $this->general_setting_m->update_slider($id,$image_name);
	 			       $redirect  = 'admin/general_setting/';
	 			       redirect($redirect,'refresh');
 			        }
                 }else{
              	echo "Something going wrong...";
              }
 }
 public function delete(){
 	    
		$this->general_setting_m->delete_slider();
		 redirect('admin/general_setting/','refresh');
 }
 public function home_category(){
 	    
 	    $this->data['title']="Home Page categories";
	    $this->data['home_cate_list'] = $this->general_setting_m->all_cate_list();
		$this->load->view('home_category', $this->data);
 }
 public function delete_home_categ(){
 		 $this->general_setting_m->delete_home_categry();
		 redirect('admin/general_setting/home_category','refresh');
 }
 public function add_home_cate(){
 		$config['upload_path'] = './admin-assets/homecate/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('thumbnail')) {
            $error = array('error' => $this->upload->display_errors());
            echo "Image not uploaded kindly check and submit again"; 
             
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $image_name =  $data['image_metadata']['file_name'];
            
             $this->general_setting_m->add_home_cate($image_name);
  	         redirect('admin/general_setting/home_category','refresh');
         }
      }
 public function view_home_cate(){
    	$id = $this->uri->segment(4);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->general_setting_m->view_home_category($id)));
    }
 public function update_home_cate()
	{  

		      $id = $this->input->post('id');
              if (isset($id)) {

              	$config['upload_path'] = './admin-assets/homecate/';
                $config['allowed_types'] = 'gif|jpg|png';
		        $this->load->library('upload', $config);
                if (!$this->upload->do_upload('thumbnail')) {
			            $this->general_setting_m->update_home_category($id);
	 			        $redirect  = 'admin/general_setting/home_category';
	 			        redirect($redirect,'refresh');
 			        } else {
			        	 
			            $data = array('image_metadata' => $this->upload->data());
			            $image_name =  $data['image_metadata']['file_name'];
                         $this->general_setting_m->update_home_category($id,$image_name);
	 			       $redirect  = 'admin/general_setting/home_category';
	 			       redirect($redirect,'refresh');
 			        }
                 }else{
              	echo "Something going wrong...";
              }
 }
public function home_adv(){
 	    
 	    $this->data['title']="Home Page Ads";
	    $this->data['home_adv_list'] = $this->general_setting_m->all_adv_list();
		$this->load->view('home_adv', $this->data);
 }
 public function delete_home_ads(){
 		 $this->general_setting_m->delete_home_adse();
		 redirect('admin/general_setting/home_category','refresh');
 }
public function view_home_ads(){
    	$id = $this->uri->segment(4);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->general_setting_m->view_home_adse($id)));
    }
 public function add_home_ads(){
 		$config['upload_path'] = './admin-assets/homecate/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('thumbnail')) {
            $error = array('error' => $this->upload->display_errors());
            echo "Image not uploaded kindly check and submit again"; 
             
        } else {
            $data = array('image_metadata' => $this->upload->data());
            $image_name =  $data['image_metadata']['file_name'];
            
             $this->general_setting_m->add_home_adse($image_name);
  	         redirect('admin/general_setting/home_adv','refresh');
         }
      }
 public function update_home_ads()
	{  

		      $id = $this->input->post('id');
              if (isset($id)) {

              	$config['upload_path'] = './admin-assets/homecate/';
                $config['allowed_types'] = 'gif|jpg|png';
		        $this->load->library('upload', $config);
                if (!$this->upload->do_upload('thumbnail')) {
			            $this->general_setting_m->update_home_adse($id);
	 			        $redirect  = 'admin/general_setting/home_adv';
	 			        redirect($redirect,'refresh');
 			        } else {
			        	 
			            $data = array('image_metadata' => $this->upload->data());
			            $image_name =  $data['image_metadata']['file_name'];
                         $this->general_setting_m->update_home_adse($id,$image_name);
	 			       $redirect  = 'admin/general_setting/home_adv';
	 			       redirect($redirect,'refresh');
 			        }
                 }else{
              	echo "Something going wrong...";
              }
    }
 public function home_text(){
 	    
 	    $this->data['title']="Home Page Text";
	    $this->data['all_home_text'] = $this->general_setting_m->all_home_text();
		$this->load->view('home_text', $this->data);
 }
 public function delete_home_text(){
 		 $this->general_setting_m->delete_home_text();
		 redirect('admin/general_setting/home_text','refresh');
 }
 public function view_home_text(){
    	$id = $this->uri->segment(4);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->general_setting_m->view_home_text($id)));
    }
 public function add_home_text(){
             
             $this->general_setting_m->add_home_txt();
  	         redirect('admin/general_setting/home_text','refresh');
         }
 public function update_home_text()
	{   
 			            $this->general_setting_m->update_home_txt();
	 			        $redirect  = 'admin/general_setting/home_text';
	 			        redirect($redirect,'refresh');
     }
}
       
