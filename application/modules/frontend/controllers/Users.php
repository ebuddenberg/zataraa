<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends User_Controller {

	function __construct ()
	{
		parent::__construct();

		$this->load->library('facebook');
		$this->load->library('google');
		$this->load->helper('string');
		$this->load->model('user_m');
		$this->load->model('product_m');
		$this->data['main_menu'] =$this->frontend_m->main_menu();
		$wishlist_id = $this->session->userdata('wishlist_id');
	    if(is_array($wishlist_id) && count($wishlist_id) > 0){
	     $wishlist_id = array_unique($wishlist_id);
	    }
	    $this->data['wishlist_item'] = $this->frontend_m->get_products($wishlist_id);

	       $wishlist_id = $this->session->userdata('wishlist_id');

    if(!empty($wishlist_id)){
     $wishlist_id = array_unique($wishlist_id);
    }

     if($this->input->get('country')){

        $array = array(
            'country' => $this->input->get('country')
        );
        
        $this->session->set_userdata( $array );

        }if($this->input->get('currencies')){
             $array = array(
            'currency' => $this->input->get('currencies')
        );
             $this->session->set_userdata($array);
        }
    if($this->session->userdata('wishlist_id')){
      $wishlist_count = count($this->session->userdata('wishlist_id'));
    }else{
       $wishlist_count = 0 ;
    }
    $this->data['wishlist_count'] = $wishlist_count;
	    $currency = $this->session->userdata('currency');
      $this->data['currency']=  ($currency != "") ? $currency : "USD";
      $this->data['curr_symbol']  =  $this->product_m->currency_code_symbol();
       $this->data['g_seeting'] = $this->product_m->g_setting();
       $this->data['child_cats'] =$this->product_m->gets_category();
    $this->data['parent_cats'] =$this->product_m->gets_parent_cats();
    $this->data['currencies'] = $this->product_m->get_currencies();
    
    $this->data['country'] =$this->product_m->get_country();
    $this->data['state'] =$this->product_m->get_states();
    $this->data['city'] =$this->product_m->get_citys();
    $this->data['g_wishlist'] = $this->getWishlist();
    $this->data['g_wishlist_price'] = $this->getWishlistPrice();
    $this->data['getUserGift'] = $this->getUserGift();

	}


	public function index(){
		$id = $this->session->userdata('id');
        $this->data['title'] = "Zataraa";
        $orders = $this->user_m->get_orders();
        $this->data['orders'] =  $orders ;
        $variation_product =  array();
        foreach ($orders as $data) {
        	$array = json_decode($data->product_orderd);
        	$variation_product = array_merge($variation_product,$array);

        }
        $this->data['address'] = $this->product_m->get_address();
       $ids =  $this->uri->segment(2);
        $this->data['address_details'] = $this->product_m->get_address($ids);
        $this->data['variation'] = $this->product_m->get_variation_product($variation_product);
        $this->data['users'] = $this->user_m->user($id);
        $this->load->view('account', $this->data);
	}

	public function add_address(){

		$id = $this->session->userdata('id');
		$address_id =  $this->input->post('address_id');
		$first_name = $this->input->post('first_name');
		$last_name = $this->input->post('last_name');
		$email = $this->input->post('email');
		$phone_no = $this->input->post('phone_no');
		$country = $this->input->post('country');
		$state =  $this->input->post('state');
		$city =  $this->input->post('city');
		$zip = $this->input->post('zip');
		$address_one =  $this->input->post('address_one');
		$address_two =  $this->input->post('address_two');
		$is_default = $this->input->post('is_default');

		$data = array('user_id' => $id ,'first_name' => $first_name ,'last_name'=> $last_name ,'email' => $email ,'phone_no' => $phone_no ,'country' => $country ,'state' => $state ,'zip'=>$zip ,'address_one'=> $address_one,'address_two'=>$address_two,'city'=> $city, 'is_default' =>$is_default);

		if($address_id == NULL){

			$this->db->insert('address', $data);

		}else{
			$this->db->where('id', $address_id);
			$this->db->update('address', $data);
		}

	redirect('users?tab=address','refresh');


	}

	
	public function register(){
		$this->data['title'] =  "zataara Register";
		$this->load->model('user_m');	
		$ruels = $this->user_m->rules1;
		$this->form_validation->set_rules($ruels);
		if ($this->form_validation->run() == TRUE) {
			$this->user_m->register_customer();
			$this->session->set_flashdata('success', 'You have registerd Successfully');
			}
		 else {
$this->session->set_flashdata('error', validation_errors());
		}
		redirect('users/login?action=register','refresh');
	}



	public function login()
	{


		
			$userData = array();
		// Check if user is logged in
		if($this->facebook->is_authenticated()){

			$refer = site_url('');
			// Get user facebook profile details
			$userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];


			if(!isset($userData['email'])){
             redirect('users/login','refresh');

            }
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            // Insert or update user data

            
            $userID = $this->user_m->checkUser($userData);
			// Check user data insert or update status
            if($userID != 0 ){
            	 $userData['id'] = $this->user_m->get_id($userProfile['email']);
            	 $userData['user_type'] = $this->user_m->get_user_type($userProfile['email']);
            	 $userData['loggedin'] = TRUE;
                $this->data['userData'] = $userData;
				
                $this->session->set_userdata($userData);
           
			if( $this->user_m->loggedin_user() == FALSE || redirect($refer));

		  redirect('users/login','refresh');

            } else {
               //$this->data['userData'] = array();
            	 	$this->session->set_flashdata('error', 'this facebook account is not associated with existing user');

            	redirect('users/login','refresh');
            }
			
			// Get logout URL
			$this->data['logoutUrl'] = $this->facebook->logout_url();
		}
		else{

            $fbuser = '';
			
			// Get login URL
            $this->data['authUrl'] =  $this->facebook->login_url();
        }

        if(isset($_GET['code'])){
        	if ($this->agent->is_referral())
			{
			    $refer = $this->agent->referrer();
			}
		else{
			$refer = site_url();
		}
			//authenticate user
			$this->google->getAuthenticate();
			//get user info from google
			$gpInfo = $this->google->getUserInfo();
            $userData['first_name'] 	= $gpInfo['given_name'];
            $userData['last_name'] 		= $gpInfo['family_name'];
            $userData['email'] 			= $gpInfo['email'];
			
            $userID = $this->user_m->checkUser($userData);

             if($userID != 0 ){
            	 $userData['id'] = $this->user_m->get_id($gpInfo['email']);
            	 $userData['user_type'] = $this->user_m->get_user_type($gpInfo['email']);
            	  $userData['loggedin'] = TRUE;
                $this->data['userData'] = $userData;

                $this->session->set_userdata($userData);
                if( $this->user_m->loggedin_user() == FALSE || redirect($refer));
                redirect('users/login','refresh');
            } else {
            	$this->session->set_flashdata('error', 'This google account is not associated with existing user');
            	redirect('users/login','refresh');
              // $this->data['userData'] = array();
            }
			
		
		} 
		
		//google login url
		$this->data['loginURL'] = $this->google->loginURL();

		if( $this->user_m->loggedin_user() == FALSE || redirect($refer));
        	$ruels = $this->user_m->ruels;
      		$this->form_validation->set_rules($ruels);
        if ($this->form_validation->run() == TRUE) {
        	 if ($this->agent->is_referral())
			{
			    $refer = $this->agent->referrer();
			}
			else{
				$refer = site_url();
			}

        	if($this->user_m->front_login() == TRUE)
        	{	
        		$this->session->set_flashdata('success', 'Login Success');
        		// $this->user_m->sync_orders();
        		$user_type= $this->session->userdata('user_type');
        		redirect($refer,'refresh');
        	}
        	else{
        		$this->session->set_flashdata('error', 'please enter correct credential');
        			redirect('users/login','refresh');	
        	}
        }
        
		$this->load->view('login', $this->data);
	}

	public function forget_password()
 	{

 		$this->data['title'] = "zataara Forget Password";
	    $ruels = $this->user_m->rules8;
	    $this->form_validation->set_rules($ruels);
	    if ($this->form_validation->run() == TRUE) {
	    	if($this->user_m->email_match() == TRUE)
	    	{	
	    			$id = random_string('alnum', 16) ;

	    			$url = site_url('users/reset_password?key='.$id.'');
	    			  $email = $this->input->post('email') ;
	    			if($this->user_m->reset_pass_key($id , $email)){

				$this->email->from('info@zataarastore.com', 'zataarastore');
					$this->email->to($email);
					$this->email->subject('Reset Password');
					$this->email->message('Your Password reset url: '.$url.'');
					$this->email->send();

	    			}

					
	    		$this->session->set_flashdata('success', 'Your password reset link send to  your email address');
	    		redirect('users/forget_password','refresh');
	    	}
	    	else{
	    		$this->session->set_flashdata('error', 'No any account associated with this email');
	    	redirect('users/forget_password','refresh');
	    	}
	    } 
		$this->load->view('forget_pass', $this->data);

 	}
 	public function hash ($string)
		{
			return hash('sha512', $string . config_item('encryption_key'));
		}
 	public function update_user_details(){

 		$id = $this->session->userdata('id');
 		$this->user_m->update_user_details($id);
 		$this->session->set_flashdata('success', 'Profile Updated');
 		redirect('users','refresh');

 	}

 	public function update_address_details(){

 		$id = $this->session->userdata('id');

 		$this->user_m->update_address_details($id);

 	}
 	public function logout()
	{
		$this->load->user_m->logout();
		redirect('users','refresh');
	}

	public function reset_pass(){

		$id = $this->session->userdata('id');
		$old_password = $this->hash($this->input->post('old_password'));
		$this->db->where('id', $id);
		$this->db->where('password', $old_password);
		$result = $this->db->get('users')->result();
		if(count($result) > 0){
			$new_pass = $this->input->post('new_password');
			$password = $this->hash($new_pass);
			$data = array('password' => $password);
			$this->db->where('id', $id);
			$this->db->update('users', $data);
			$this->session->set_flashdata('success', 'password updated');
			redirect('users','refresh');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong try again');
			redirect('users','refresh');
		}


	}

 	public function reset_password()
 	{
 		$this->data['title'] = "zataara Reset Password";
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

				$this->email->from('info@zataarastore.com', 'zataara Store');
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

		$this->load->view('reset_password', $this->data);


 	}

 	

 	 public function wishlist(){
 	 	$wishlist_id = $this->session->userdata('wishlist_id');
 	 	if(count($wishlist_id) > 0){
 	 	 $wishlist_id = array_unique($wishlist_id);
 	 	}

 	 	$this->data['products'] = $this->frontend_m->get_products($wishlist_id);
        $this->data['title'] = "Zataraa";
        $this->load->view('wish-list', $this->data);

   }

 	public function _unique_email ($str)
			{

				$this->db->where('email', $this->input->post('email'));
				$user = $this->db->get('users')->result();
				//checking wether  eamil addresss existing or not and return the value true or false 
				if (count($user)>=1) {

					$this->form_validation->set_message('_unique_email', '%s should be unique');
					return FALSE;
				}
				
				return TRUE;
			}

			public function _unique_mno ($str)
			{

				
				$this->db->where('user_phone', $this->input->post('user_phone'));
				$user = $this->db->get('users')->result();
				//checking wether  eamil addresss existing or not and return the value true or false 
				if (count($user)>=1) {

					$this->form_validation->set_message('_unique_mno', '%s should be unique');
					return FALSE;
				}
				
				return TRUE;
			}
	public function getWishlist(){
    $wishlist_id = $this->session->userdata('wishlist_id');
    if(count($wishlist_id) > 0){
     $wishlist_id = array_unique($wishlist_id);
    }
    

    $wishlist = $this->frontend_m->get_products($wishlist_id);  
    return $wishlist;
	}
    
    public function getWishlistPrice(){
    $wishlist_id = $this->session->userdata('wishlist_id');
    if(count($wishlist_id) > 0){
     $wishlist_id = array_unique($wishlist_id);
    }
        $wishlist = $this->frontend_m->get_products($wishlist_id);
   foreach ($wishlist as $data) {
        $product_id[$data->product_id] = $data->product_id ;
      }
      if(!isset($product_id)){
        $product_id = array();
      }
    $price=array();
    $price=  $this->product_m->products_price($product_id);

    return $price;
   }
   
   public function getUserGift(){
    $id=$this->session->userdata('id');
    $this->db->select('gift_id');
    $this->db->from('users');
	$this->db->where('id', $id);
	$result = $this->db->get()->row();
	
	$pidArray = explode(',', $result->gift_id);
	foreach($pidArray as $item){
    $this->db->select('product_name,product_image,slugs');
    $this->db->from('products');
    $this->db->where_in('id', $item);
    $productResult[] = $this->db->get()->result_array();
    }
    
    return $productResult;
   }
}


