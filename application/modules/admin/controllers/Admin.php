<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Admin_Controller {

	function __construct ()
	{
		parent::__construct();
		$this->load->helper('string');
		$this->load->model('product_m');
		$this->data['title'] = "Zataara";
		$this->data['categories'] =$this->product_m->get_imp_parent_cats();
	}

	public function index()
	{	
		$this->data['products'] = $this->product_m->count_t_product();
		$this->data['users'] = $this->product_m->count_t_users();
		$this->data['orders'] = $this->product_m->count_t_orders();
		$this->data['reviews'] = $this->product_m->count_t_reviews();
		$this->load->view('index', $this->data);
	}
	public function users()
	{
		echo "users";
	}

	public function login()
	{

		$this->data['title'] =  "Zataara Admin Login";
		if( $this->user_m->loggedin() == FALSE || redirect('admin'));
		$ruels = $this->user_m->ruels;
      	$this->form_validation->set_rules($ruels);
        if ($this->form_validation->run() == TRUE) {
        	if($this->user_m->login() == TRUE)
        	{	
        		redirect('admin','refresh');
        	}
        	else{
        		$this->session->set_flashdata('error', 'please enter correct credential');
        	redirect('admin/login','refresh');
        	}
        }
        
		$this->load->view('login', $this->data);
	}

	public function forget_password()
 	{

 		$this->data['title'] = "Zataara Forget Password";
	    $ruels = $this->user_m->rules8;
	    $this->form_validation->set_rules($ruels);
	    if ($this->form_validation->run() == TRUE) {
	    	if($this->user_m->email_match() == TRUE)
	    	{	
	    			$id = random_string('alnum', 16) ;

	    			$url = site_url('admin/reset_password?key='.$id.'');
	    			  $email = $this->input->post('email') ;
	    			if($this->user_m->reset_pass_key($id , $email)){

				$this->email->from('info@Zataarastore.com', 'Zataarastore');
					$this->email->to($email);
					$this->email->subject('Reset Password');
					$this->email->message('Your Password reset url: '.$url.'');
					$this->email->send();

	    			}

					
	    		$this->session->set_flashdata('success', 'Your password reset link send to  your email address');
	    		redirect('admin/forget_password','refresh');
	    	}
	    	else{
	    		$this->session->set_flashdata('error', 'No any account associated with this email');
	    	redirect('admin/forget_password','refresh');
	    	}
	    } 
		$this->load->view('forget-password', $this->data);

 	}
 	public function logout()
	{
		$this->load->user_m->logout();
		redirect('admin','refresh');
	}

 	public function reset_password()
 	{
 		$this->data['title'] = "Zataara Reset Password";
 		$key = $this->input->post('key');
 		if($key == '')
 		{
 		 
 		 $key = $this->input->get('key');
 		}


 		  $ruels = $this->user_m->rules7;
      $this->form_validation->set_rules($ruels);

        if ($this->form_validation->run() == TRUE) {
        	if($this->user_m->key_match($key))
        	{	
        			  $email_addr = $this->user_m->get_email($key) ;
        			  $email = $email_addr->email ;
        			if($this->user_m->update_pass($email)){

				$this->email->from('info@zataara.com', 'Zataara');
					$this->email->to($email);
					$this->email->subject('Reset Password');
					$this->email->message('Your Password reset sucessfully');
					$this->email->send();

        			}

					
        		$this->session->set_flashdata('success', 'Your password updated sucessfully');
        		//redirect('admin/reset_password','refresh');
        	}
        	else{
        		$this->session->set_flashdata('error', 'reset password key mismatch ');
        	//redirect('admin/reset_password','refresh');
        	}
        } 

		$this->load->view('reset-password', $this->data);


 	}


 	public function cms(){

 		$this->data['title'] = "cms";
 		$this->data['cms']  = $this->product_m->cms();
 		$this->load->view('cms-list', $this->data);
 	}

 	public function cms_update(){
		$id = $this->uri->segment(3);
		$this->db->where('id',$id);
		$this->data['cms'] = $this->db->get('cms')->row();
		$this->load->view('cms_update', $this->data);
	}

	public function contact_details(){
		$this->db->where('id', '1');
		$this->data['contact'] = $this->db->get('contact')->row();
		$this->load->view('contact-details',$this->data);
	}

	public function home_setting(){
		$this->data['home_setting'] = $this->product_m->home_setting();
		$this->data['cats'] = $this->product_m->get_category();
		$this->load->view('home_setting', $this->data);
	}

	public function update_home_settings(){
		$data_info = array();
		$config['upload_path'] = './admin-assets/images';
        $config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);


		 if ($this->upload->do_upload('home_page_slider_one')) {
            	 $data = array('image_metadata' => $this->upload->data());
            $home_page_slider_one =  $data['image_metadata']['file_name'];
           $data_info['home_page_slider_one'] = $home_page_slider_one ;

        }else{
        	$home_page_slider_one = '';
        }



         if ($this->upload->do_upload('home_page_slider_two')) {
            	 $data = array('image_metadata' => $this->upload->data());
            $home_page_slider_two =  $data['image_metadata']['file_name'];
           $data_info['home_page_slider_two'] = $home_page_slider_two ;

        }else{
        	$home_page_slider_two = '';
        }


         if ($this->upload->do_upload('home_page_slider_three')) {
            	 $data = array('image_metadata' => $this->upload->data());
            $home_page_slider_three =  $data['image_metadata']['file_name'];
           $data_info['home_page_slider_three'] = $home_page_slider_three ;

        }else{
        	$home_page_slider_three = '';
        }



        if ($this->upload->do_upload('section_one_banner_one')) {
            	 $data = array('image_metadata' => $this->upload->data());
            $section_one_banner_one =  $data['image_metadata']['file_name'];
           $data_info['section_one_banner_one'] = $section_one_banner_one ;

        }else{
        	$section_one_banner_one = '';
        }

     	if ($this->upload->do_upload('section_one_banner_two')) {
            	 $data = array('image_metadata' => $this->upload->data());
            $section_one_banner_two =  $data['image_metadata']['file_name'];
           
          $data_info['section_one_banner_two'] = $section_one_banner_two ;
        }else{
        	$section_one_banner_two = '';
        }

        if ($this->upload->do_upload('section_two_banner_one')) {
            	 $data = array('image_metadata' => $this->upload->data());
            $section_two_banner_one =  $data['image_metadata']['file_name'];
           
          $data_info['section_two_banner_one'] = $section_two_banner_one ;
        }else{
           
        	$section_two_banner_one = '';
        }

        if ($this->upload->do_upload('section_two_banner_two')) {
            	 $data = array('image_metadata' => $this->upload->data());
            $section_two_banner_two =  $data['image_metadata']['file_name'];
           
          $data_info['section_two_banner_two'] = $section_two_banner_two ;
        }else{
            
        	$section_two_banner_two = '';
        }

         if ($this->upload->do_upload('section_three_banner_one')) {
            	 $data = array('image_metadata' => $this->upload->data());
            $section_three_banner_one =  $data['image_metadata']['file_name'];
            $data_info['section_three_banner_one'] = $section_three_banner_one ;
          
        }else{
        	$section_three_banner_one = '';
        }

         if ($this->upload->do_upload('section_three_banner_two')) {
            	 $data = array('image_metadata' => $this->upload->data());
            $section_three_banner_two =  $data['image_metadata']['file_name'];
           $data_info['section_three_banner_two'] = $section_three_banner_two ;
          
        }else{
        	$section_three_banner_two = '';
        }


        $id=  $this->input->post('id');

        $data_info['sec_1_title'] =  $this->input->post('sec_1_title');
        $data_info['sec_2_title']  =  $this->input->post('sec_2_title');
        $data_info['sec_3_title'] =  $this->input->post('sec_3_title');
         $data_info['h_slider_one_link'] =  $this->input->post('h_slider_one_link');
        $data_info['h_slider_two_link']  =  $this->input->post('h_slider_two_link');
        $data_info['h_slider_three_link'] =  $this->input->post('h_slider_three_link');

       $data_info['section_1_cats'] =  $this->input->post('section_1_cats');
        $data_info['section_2_cats'] =  $this->input->post('section_2_cats');
        $data_info['section_3_cats'] =  $this->input->post('section_3_cats');
        $data_info['hide_section_one'] = $this->input->post('hide_section_one');

         $data_info['section_one_cat_link'] = $this->input->post('section_one_cat_link');

          $data_info['section_two_cat_link'] = $this->input->post('section_two_cat_link');

           $data_info['section_three_cat_link'] = $this->input->post('section_three_cat_link');

           
        $data_info['hide_section_two'] = $this->input->post('hide_section_two');
         $data_info['hide_section_three'] = $this->input->post('hide_section_three');
       $this->db->where('id', $id);
       $this->db->update('home_page_setting', $data_info);
 // var_dump($this->upload->display_errors());
    redirect('admin/home_setting','refresh');





	}


	public function general_seetings(){
		$this->db->where('id', '1');
		$this->data['g_setting'] = $this->db->get('general_seeting')->row();
		$this->load->view('general_setting',$this->data);
	}

	public function update_cms(){

	$id = $this->input->post('id');	
	
	$content = 	$this->input->post('content');	
	$title =	$this->input->post('title');	
	$data = array('content'=>$content,'title' => $title);
	$this->db->where('id', $id);
	$this->db->update('cms', $data);

	redirect('admin/cms','refresh');

	}


	public function update_general_setting(){

		$contact_no = $this->input->post('contact_no');
		$email = $this->input->post('email');
		$address = $this->input->post('address');
		$facebook_link = $this->input->post('facebook_link');
		$twitter_link = $this->input->post('twitter_link');
		$g_plus_link = $this->input->post('g_plus_link');
		$instagram_link = $this->input->post('instagram_link');
		$copyright = $this->input->post('copyright');
        $custom_script = $this->input->post('custom_script');
		$hide_cats =  implode(',', $this->input->post('product_categories[]') );
		$data = array('contact_no' => $contact_no ,'email' => $email ,'address'=> $address ,'facebook_link'=>$facebook_link ,'twitter_link' =>$twitter_link ,'g_plus_link' => $g_plus_link ,'instagram_link'=>$instagram_link ,'copyright' =>$copyright,'hide_categories' => $hide_cats ,'custom_script' => $custom_script);
		$this->db->where('id',1);
		$this->db->update('general_seeting', $data);
		redirect('admin/general_seetings','refresh');
	}

	public function update_contact_details(){

		$contact_title = $this->input->post('contact_title');
		$sec_1_title = $this->input->post('sec_1_title');
		$sec_1_cont = $this->input->post('sec_1_cont');
		$sec_2_title = $this->input->post('sec_2_title');
		$sec_2_cont = $this->input->post('sec_2_cont');
		$sec_3_title = $this->input->post('sec_3_title');
		$sec_3_cont = $this->input->post('sec_3_cont');

		$data = array('contact_title' => $contact_title ,'sec_1_title' => $sec_1_title ,'sec_1_cont'=> $sec_1_cont ,'sec_2_title'=>$sec_2_title ,'sec_2_cont' =>$sec_2_cont ,'sec_3_title' => $sec_3_title ,'sec_3_cont'=>$sec_3_cont);
		$this->db->where('id',1);
		$this->db->update('contact', $data);
		redirect('admin/contact_details','refresh');
	}

}

/* End of file admin.php */
/* Location: ./application/modules/Admin/controllers/admin.php */