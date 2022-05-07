<?php
class Frontend extends MY_Controller {
	public function __construct()
	{

		parent::__construct();
		//Do your magic here
		$this->load->library('email');
		$this->load->model('frontend_m');
    $this->load->model('product_m');
		$this->load->library('email');
    $this->load->library('cart');
 		
    $this->data['main_menu'] =$this->frontend_m->main_menu();

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
    $this->data['child_cats'] =$this->product_m->gets_category();
    $this->data['parent_cats'] =$this->product_m->gets_parent_cats();
    $this->data['currencies'] = $this->product_m->get_currencies();
    $this->data['country'] =$this->product_m->get_country();
    $this->data['wishlist_count'] = $wishlist_count;
    //$this->data['parent_menu'] =$this->frontend_m->parent_menu();
    $currency = $this->session->userdata('currency');
    $this->data['currency']=  ($currency != "") ? $currency : "USD";
    $this->data['curr_symbol'] = $this->product_m->currency_code_symbol();
    $this->data['g_seeting'] = $this->product_m->g_setting();
      
 	}

  public function version(){
    echo CI_VERSION;
  }


	public function index(){
    
    $product_id = array();
		$this->data['title'] = "Home";
    $this->data['home_setting'] = $this->product_m->get_home_setting();
    $this->data['proudcts']  = $this->product_m->get_home_product();
    $this->data['deal_of_the_Week'] = $this->product_m->get_deal_of_the_week();
    $this->data['section_one_cat'] = $this->product_m->get_section_one_cat();
    $this->data['section_two_cat'] = $this->product_m->get_section_two_cat();
    $this->data['section_three_cat'] = $this->product_m->get_section_three_cat();

    $this->data['recomended_product_one'] = $this->product_m->get_section_one_cat("rand");
    $this->data['recomended_product_two'] = $this->product_m->get_section_two_cat("rand");
    $this->data['recomended_product_three'] = $this->product_m->get_section_three_cat("rand");

  $this->data['recomended_product'] = $this->product_m->get_recomended_product();

		$this->load->view('index', $this->data);
 
	}
	public function sendmail(){
		// $from_email = "zafaralam91@gmail.com";
  //       $to_email = "zafaralam91@gmail.com";
  //       //Load email library
  //       $this->load->library('email');
  //       $this->email->from($from_email, 'Identification');
  //       $this->email->to($to_email);
  //       $this->email->subject('Send Email Codeigniter');
  //       $this->email->message('The email send using codeigniter library');
  //       //Send mail
  //       if($this->email->send())
  //           $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
  //       else
  //           $this->session->set_flashdata("email_sent","You have encountered an error");
  //       redirect("admin/popup/newsletter",'refresh');
		$this->frontend_m->add_newsletter();
		
	}

  


  public function product(){

       if($this->uri->segment(2)){

        
        $this->data['products_details'] = $this->frontend_m->products_details($this->uri->segment(2));
        $this->data['products_gallery'] = $this->frontend_m->products_gallery($this->uri->segment(2));
        $this->data['p_size'] = $this->frontend_m->products_size($this->uri->segment(2));
        $this->data['c_size'] = $this->frontend_m->products_csize($this->uri->segment(2));
        $this->data['title'] = "zataara";
        $this->load->view('products-detail', $this->data);
           }
  }
  public function register(){
         $this->data['title'] = "Register";
         $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback__unique_email');
        if ($this->form_validation->run() == TRUE) {
        if($this->frontend_m->user_register() == TRUE){

         $this->session->set_flashdata('success', 'Register has been successfull');
                redirect('register','refresh');
     }else{

            $this->session->set_flashdata('error', 'Password miss match Please try again');
      redirect('register','refresh');
     }
    }else{
      $this->session->set_flashdata('error', 'An email address already exist');
      redirect('register','refresh');
    } 
}
 public function _unique_email ($str)
  {

  $this->load->model('user_m'); 
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
  
public function add_to_wishlist(){
  $p_id = rtrim($this->input->post('id'));
    if($p_id){
    $wishlist_id = $this->session->userdata('wishlist_id');
    if($wishlist_id){
      array_push($wishlist_id, $p_id);
      $wishlist_id = array_unique($wishlist_id);
    }else{
      $wishlist_id = array($p_id);
    }
   $this->session->set_userdata(array('wishlist_id' => $wishlist_id));
   // var_dump($this->session->userdata('wishlist_id'));
}
}

public function wishlist_added_product(){
  $wishlist_id = $this->session->userdata('wishlist_id');
    if(count($wishlist_id) > 0){
     $wishlist_id = array_unique($wishlist_id);
    }

    $wishlist = $this->frontend_m->get_products($wishlist_id);
    $html = '';
    foreach ($wishlist as $data) {
      # code...
      $html .= '<li class="clearfix"> <img class="cart_item_product" src="'.base_url().'admin-assets/images/'.$data->image_name.'" alt=""> <a href="'.site_url('product/'.$data->slugs.'').'" class="cart_item_title">'.$data->product_name.'</a></li>';
    }

    echo $html ;

}

public function remove_wishlist($id){

 $wishlist_id = $this->session->userdata('wishlist_id');
  if (($key = array_search($id, $wishlist_id)) !== false) {
      unset($wishlist_id[$key]);
  }
 $this->session->set_userdata(array('wishlist_id' => $wishlist_id));
 redirect('wishlist','refresh');
}
public function wishlist_count(){

 $wishlist_id = $this->session->userdata('wishlist_id');

 echo count($wishlist_id);

}

public function wishlist(){
    $wishlist_id = $this->session->userdata('wishlist_id');
    if(is_array($wishlist_id) && count($wishlist_id) > 0){
     $wishlist_id = array_unique($wishlist_id);
    }

$product = $this->frontend_m->get_products($wishlist_id);

  $this->data['products'] =  $product ;
   foreach ($product as $data) {
        $product_id[$data->product_id] = $data->product_id ;
      }
      if(!isset($product_id)){
        $product_id = array();
      }
  $this->data['price'] =  $this->product_m->products_price($product_id);


        $this->data['title'] = "zataara";
        $this->load->view('wish-list', $this->data);

   }

   public function get_state(){
    $id = $this->input->post('id');
    $this->db->where('country_id', $id);
    $result = $this->db->get('states')->result();
    $html = '';
    foreach ($result as $data) {
      $html .= '<option value="'.$data->id.'">'.$data->name.'</option>';
    }


    echo $html ;

   }

  

    public function get_city(){
    $id = $this->input->post('id');
    $this->db->where('state_id', $id);
    $result = $this->db->get('cities')->result();
    $html = '';
    foreach ($result as $data) {
      $html .= '<option value="'.$data->id.'">'.$data->name.'</option>';
    }


    echo $html ;

   }
   public function checkout_step_one(){
        $this->data['title'] = "zataara";
        $this->load->view('checkout', $this->data);
   }
   public function checkout_step_two(){
        $this->data['title'] = "zataara";
        $this->load->view('checkout2', $this->data);
   }
   public function checkout_step_three(){
        $this->data['title'] = "zataara";
        $this->load->view('checkout3', $this->data);
   }
   public function checkout_step_four(){
        $this->data['title'] = "zataara";
        $this->load->view('checkout4', $this->data);
   }
   public function switchcurr() {
      $curr = $this->input->get('currency');
       $curr = ($curr != "") ? $curr : "USD";
       $this->session->set_userdata('currency', $curr);
       redirect($_SERVER['HTTP_REFERER']);
   }



   public function contact(){
    $this->db->where('id', '1');
    $this->data['contact'] = $this->db->get('contact')->row();
    $this->load->view('contact-us',$this->data);
   }

   public function submit_review(){

      $product_id = $this->input->post('product_id');
      $review = $this->input->post('review');
      $rating = $this->input->post('rating');
      
      $user_id = $this->session->userdata('id');
     
    
      $email = $this->session->userdata('email');
      $name = $this->session->userdata('fname');
      if(!$user_id){
        $name = $this->input->post('names');
        $email = $this->input->post('email');
        $data = array('name' =>$name , 'email' => $email ,'product_id' => $product_id ,'review' => $review ,'rating' => $rating);
      }else{

         $data = array('name' =>$name , 'email' => $email ,'product_id' => $product_id ,'review' => $review ,'rating' => $rating ,'user_id' => $user_id);
      }

      $this->db->insert('reviews', $data);

      $this->db->where('product_id', $product_id);
      $this->db->select('AVG(rating) as ratings , count(id) as nos');

      $result = $this->db->get('reviews')->row();

      $datas = array('avg_ratings' => $result->ratings ,'count_ratings' => $result->nos );
      $this->db->where('product_id', $product_id);
      $this->db->update('products', $datas);
   }

  public function get_commodityDifferenceOption(){

    
      $variation = array();
      foreach ($_POST as $key => $value) {
        $variation[]= $value ;
      }

     echo implode("-", $variation);

  }

  public function get_avail_variation(){

    $data = $this->input->post('data');
 parse_str($data, $get_var);
    foreach ($get_var as $key => $value) {
        $variation[]= $value ;
      }
    $id = $this->input->post('id');
    $result_data = array() ;
    $html = '<option value="">Select variation</option>';
    $first_variation = $variation[0];
     $var =  $first_variation.'-';
     $this->db->like('commodityDifferenceOption',$var);
     $this->db->where('parent_id', $id);
     $result  = $this->db->get('variation_product')->result();

     foreach ($result as $data) {
        $result_data[] = str_replace($var,"",$data->commodityDifferenceOption);
     }

     foreach ($result_data as $data) {

      $html .= '<option>'.$data.'</option>';
       # code...
     }

     echo $html ;
  }

  public function get_variation_details(){

    $data = $this->input->post('data');
    $id = $this->input->post('id');

    $this->db->select('variation_product.*,products.product_offer,products.comission');
    $this->db->from('variation_product');
    $this->db->join('products', 'variation_product.parent_id = products.product_id', 'left');
    $this->db->where('variation_product.parent_id', $id);
    $this->db->where('variation_product.commodityDifferenceOption', $data);
    $result = $this->db->get()->row();

    $price = $this->frontend_m->convert(round(($result->price+$result->price*$result->comission/100) - ($result->price*$result->comission/100)*$result->product_offer/100,2));
    $result->price = $price;
    echo  json_encode($result);
    
  }


public function get_search_val(){

    $cats = $this->input->post('cats');
    $term = $this->input->post('term');
    if($cats && $cats !=''){
     $cats = $this->product_m->get_categories_by_parent($cats);
      $this->db->where_in('categories_id', $cats);
    }
    if($term !=''){
      $this->db->like('product_name', $term, 'BOTH');
    }
   $result =  $this->db->get('products')->result();
  
   $datas = array() ;
   foreach ($result as $data) {
       # code...
    $datas[] = $data->product_name;
    
   }
   echo json_encode($datas);
}

public function about()
{

  $this->db->where('id','1');
 $this->data['cms'] = $this->db->get('cms')->row();

 $this->load->view('page', $this->data);
}

public function terms_condition(){

  $this->db->where('id','3');
 $this->data['cms'] = $this->db->get('cms')->row();

 $this->load->view('page', $this->data);
}

public function policy(){

  $this->db->where('id','2');
 $this->data['cms'] = $this->db->get('cms')->row();

 $this->load->view('page', $this->data);
}

public function faqs(){

  $this->db->where('id','4');
 $this->data['cms'] = $this->db->get('cms')->row();

 $this->load->view('page', $this->data);
}


public function returns(){

  $this->db->where('id','5');
 $this->data['cms'] = $this->db->get('cms')->row();

 $this->load->view('page', $this->data);
}

public function shipping(){

  $this->db->where('id','6');
 $this->data['cms'] = $this->db->get('cms')->row();

 $this->load->view('page', $this->data);
}

public function our_press(){

  $this->db->where('id','7');
 $this->data['cms'] = $this->db->get('cms')->row();

 $this->load->view('page', $this->data);
}
public function payment_method(){

  $this->db->where('id','8');
 $this->data['cms'] = $this->db->get('cms')->row();

 $this->load->view('page', $this->data);
}

public function tags(){

  echo preg_replace("/[^a-zA-Z]/", " ", $string);
}






}



/* End of file Frontend.php */
/* Location: ./application/modules/Frontend/controllers/Frontend.php */
 ?>