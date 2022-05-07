<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {


	public function __construct() {
        parent:: __construct();
        $this->load->library("pagination");
    }
	public function index()
	{
		$config = array();
        $config["base_url"] = base_url() . "admin/users/";
        $config["total_rows"] = $this->user_m->customer_count();
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
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = '&laquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&raquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config["cur_page"] = $page;
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

        $this->data['users'] = $this->user_m->customer($config["per_page"], $offset);
		$this->data['title'] ="Customer List";
		$this->data['get_product_array']= $this->get_product_array();
		$this->load->view('users', $this->data);
	}

	public function delete(){

		$id = $this->uri->segment(4);
		$this->db->where('id', $id);
		$this->db->delete('users');
	}

	public function admin()
	{
		$config = array();
        $config["base_url"] = base_url() . "admin/users/admin/";
        $config["total_rows"] = $this->user_m->admin_count();
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
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $config["cur_page"] = $page;
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
		if($this->uri->segment(4) == 0)
		{
		    $offset = 0;
		}
		else
		{
		    $offset = ($config['per_page'])*($this->uri->segment(4)-1);
		}
		$this->data['title'] ="Admin List";
		$this->data['users'] = $this->user_m->admin_list($config["per_page"], $offset);
		$this->load->view('users', $this->data);
	}



	public function view() {
		 header('Content-Type: application/x-json; charset=utf-8');
		 echo(json_encode($this->user_m->user()));
	}

	public function add_user()
	{
		$ruels = $this->user_m->ruels3;
		$this->form_validation->set_rules($ruels);

		if ($this->form_validation->run() == TRUE) {

			$this->user_m->register();
			$user_type = $this->input->post('user_type');
			if($user_type == 'admin'){
				$redirect  = 'admin/users/admin';
			}elseif($user_type == "customer"){
				$redirect = "admin/users";
			}else{
				$redirect = 'admin/users/shop_manger';
			}
			redirect($redirect,'refresh');
			# code...
		}
		 else {
		 	
			redirect('admin/users','refresh');
			# code...
		}

	}
	public function update_user()
	{
		
			$id = $this->input->post('id');
			$result = $this->user_m->get_user_email($id);
			$this->user_m->update_user($id);
			$user_type = $this->input->post('user_type');
			
			if($this->input->post('change_balance') != null && $this->input->post('change_balance') != 0){
			$this->email->from('info@zataarastore.com', 'zataarastore');
            $this->email->to($result->email);
			$this->email->subject('Earned Balance');
		    $this->email->message('Congratulations!! you have got a balance of '.$this->input->post('balance').' in your account which you can use in your next orders.');
			$this->email->send();
			    
			}

			if($user_type == 'admin'){
				$redirect  = 'admin/users/admin';
			}elseif($user_type == "customer"){
				$redirect = "admin/users";
			}else{
				$redirect = 'admin/users/shop_manger';
			}
			redirect($redirect,'refresh');

	}
	public function _unique_email ($str)
	{
	
		//retreving user email information from the User Table
		$this->db->where('email', $this->input->post('email'));
		$user = $this->user_m->get();
		//checking wether  eamil addresss existing or not and return the value true or false 
		if (count($user)>=1) {

			$this->form_validation->set_message('_unique_email', '%s should be unique');
			return FALSE;
		}
		
		return TRUE;
	}
	
	public function get_product_array(){
		$this->db->select('id, product_sku');
		$this->db->from('products');
		$products = $this->db->get()->result();
		$prod_dd = array();
		foreach($products as $item){
		    $prod_dd[$item->id] = $item->product_sku;
		}
		return $prod_dd;
	}
	
	public function add_gift(){
       
        $giftValue = implode(",",$this->input->post('user_gift'));

    	$updateData=array("gift_id"=>$giftValue);
    	$id = $this->input->post('guid');
    	$result = $this->user_m->get_user_email($id);
    	
    	$pidArray = explode(',', $giftValue);
    	foreach($pidArray as $giftid){
    	$this->db->select('product_name,product_image');
    	$this->db->from('products');
        $this->db->where('id', $giftid);
     	$productResults[] = $this->db->get()->result_array();
    	}
    	$this->db->where('id', $id);
        $this->db->update('users',$updateData);
        
        $message='Congratulations!!We will give you';
        foreach($productResults as $key=>$productResult){
        $p_name =$productResult[0]['product_name'] ;
        
        $slugs = str_replace(" & ", '----', $p_name);
        $slugs = str_replace(', ', '--', $slugs);
        $slugs = str_replace("'", '---', $slugs); 
        $slugs = str_replace(" ", '_', $slugs); 

        $imgUrl = site_url('admin-assets/images/'.$productResult[0]['product_image'].'');
        $productUrl = site_url('products/'.$slugs.'');
        $message.= '<a href="'.$productUrl.'">'.$productResult[0]['product_name'].' </a>'.", ";
        $this->email->attach($imgUrl);
        }
        $message.= 'item and you will get this along with your next order for free.';
        $this->email->from('info@zataarastore.com', 'zataarastore');
            $this->email->to($result->email);
			$this->email->subject('Earned Gift');
		    //$this->email->message('Congratulations!!We will give you <img src="'.site_url('admin-assets/images/'.$productResult->product_image.'').'" alt="Image" title="Image" style="display:block" width="200" height="87" /> '.$productResult->product_name.' item and you will get this along with your next order for free.');
		    //$this->email->message('Congratulations!!We will give you <a href="'.$productUrl.'">'.$productResult->product_name.' </a>item and you will get this along with your next order for free.');
		    $this->email->message($message);
		    //$this->email->attach($imgUrl);
		     $this->email->set_mailtype("html");
			$this->email->send();
		if($user_type == 'admin'){
				$redirect  = 'admin/users/admin';
			}else{
				$redirect = 'admin/users';
			}
		redirect($redirect,'refresh');

	}
	
	

}

/* End of file Users.php */
/* Location: ./application/modules/admin/controllers/Users.php */