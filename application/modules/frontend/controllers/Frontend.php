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
    $this->data['curr_symbol']  = $this->product_m->currency_code_symbol();
    $this->data['g_seeting'] = $this->product_m->g_setting();
   $this->data['g_wishlist'] = $this->getWishlist();
    $this->data['g_wishlist_price'] = $this->getWishlistPrice();

 	}

  public function version(){
    echo CI_VERSION;
  }


	public function index(){
    $this->output->cache(120);
    $product_id = array();
		$this->data['title'] = "Home";
    $this->data['home_setting'] = $this->product_m->get_home_setting();
    
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
    foreach ($wishlist as $data) {
      # code...
      $html .= '<li class="clearfix"> <img class="cart_item_product" src="'.base_url().'admin-assets/images/'.$data->image_name.'" alt=""> <a href="'.site_url('product/'.$data->slugs.'').'" class="cart_item_title">'.$data->product_name.'</a></li>';
    }
$html = '';
    
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
    $posthy = explode('-', $data);
    
    $this->db->select('variation_product.*,products.product_offer,products.comission');
    $this->db->from('variation_product');
    $this->db->join('products', 'variation_product.parent_id = products.product_id', 'left');
    $this->db->where('variation_product.parent_id', $id);
    if($posthy[1]==null){
            $this->db->like('variation_product.commodityDifferenceOption', $data);
    }else{
            $this->db->where('variation_product.commodityDifferenceOption', $data);

    }
    $result = $this->db->get()->row();

    $price = $this->frontend_m->convert(round(($result->price+$result->price*$result->comission/100) - ($result->price*$result->comission/100)*$result->product_offer/100,2));
    $result->price = $price;
    if($result->product_offer >0 ){
    $result->price.= '<del > '.$this->frontend_m->convert(($result->price+$result->price*$result->comission/100)).'</del> <div class="ps-product__badge" style="position: inherit">'.
                      (int) $this->frontend_m->cal_percent($this->frontend_m->convert(round(($result->price+$result->price*$result->comission/100) - ($result->price*$result->comission/100)*$result->product_offer/100,2)) , $this->frontend_m->convert(($result->price+$result->price*$result->comission/100)) ).'%</div>' ;
    }
   
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



public function get_section_one(){
 $section_one_cat = $this->product_m->get_section_one_cat("rand");
 $currency = $this->data['currency'] ;
  $curr_symbol =  $this->data['curr_symbol']   ;
?>
  <div class="row">
                    

              <?php $i = 1;

               foreach ($section_one_cat as $data) {  
                if($i <5){
$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs); 
  ?>
              
          
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 ">
                <div class="ps-product">
                  <div class="ps-product__thumbnail"><a href="<?php echo site_url('products/'.$slugs.''); ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $data->image ; ?>" alt=""/></a>
                    <?php if($data->product_offer !=0){
                      echo '<div class="ps-product__badge">'.
                      (int) $this->frontend_m->cal_percent($this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) , $this->frontend_m->convert(($data->price+$data->price*$data->comission/100)) ).'%</div>';
                    } ?>
                    
                    <ul class="ps-product__actions">
                      <li><a href="<?php echo site_url('products/'.$slugs.''); ?>" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                      <li><a href="#" class="add_to_wishlist" data-toggle="tooltip" data-placement="top" data-id="<?php echo $data->id ; ?>" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                    </ul>
                  </div>
                  <div class="ps-product__container">
                    <div class="ps-product__content"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>
                      <div class="star-ratings-sprite"><span style="width:<?php echo $data->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span></div>
                      <p class="ps-product__price sale"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?></p>
                    </div>
                    <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>
                      <p class="ps-product__price sale"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?></p>
                    </div>
                  </div>
                </div>
              </div>
   <?php $i++ ;}} ?>
              
            
                  </div>
                  <?php
}


public function recomended_product_one(){
 $recomended_product_one = $this->product_m->get_section_one_cat("rand");
  $currency = $this->data['currency'] ;
  $curr_symbol =  $this->data['curr_symbol']   ;
?>

              <figcaption>Recommended For You</figcaption>

              <?php 

               
$i = 1;
              foreach ($recomended_product_one as $data) {
                // if($i < 4){
$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs); 

               ?>
               
              <div class="ps-product--horizontal">
                <div class="ps-product__thumbnail"><a href="<?php echo site_url('products/'.$slugs.''); ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $data->image; ?>" alt=""/></a></div>
                <div class="ps-product__content"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>

                 <div class="star-ratings-sprite"><span style="width:<?php echo $data->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span></div>

                  <p class="ps-product__price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?></p>
                </div>
              </div>

<?php 
// $i++ ;} 
} ?>

            
<?php

}


public function get_section_two(){
 $section_two_cat = $this->product_m->get_section_two_cat("rand");
 $currency = $this->data['currency'] ;
 $curr_symbol =  $this->data['curr_symbol']   ;
  ?>

                  <div class="row">
                    

              <?php  foreach ($section_two_cat as $data) {  
             
$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs); 
  ?>
              
          
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 ">
                <div class="ps-product">
                  <div class="ps-product__thumbnail"><a href="<?php echo site_url('products/'.$slugs.''); ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $data->image ; ?>" alt=""/></a>
                     <?php if($data->product_offer !=0){
                      echo '<div class="ps-product__badge">-'.(int) $this->frontend_m->cal_percent($this->frontend_m->convert(($data->price+$data->price*$data->comission/100)) ,$this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ).'%</div>';
                    } ?>
                    <ul class="ps-product__actions">
                      <li><a href="<?php echo site_url('products/'.$slugs.''); ?>" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                      <li><a href="#" class="add_to_wishlist" data-toggle="tooltip" data-placement="top" data-id="<?php echo $data->id ; ?>" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                    </ul>
                  </div>
                  <div class="ps-product__container">
                    <div class="ps-product__content"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>

                      <div class="star-ratings-sprite"><span style="width:<?php echo $data->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span></div>

                      <p class="ps-product__price sale"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?></p>
                    </div>
                    <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>
                      <p class="ps-product__price sale"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?></p>
                    </div>
                  </div>
                </div>
              </div>
   <?php } ?>
              
            
                  </div>
                
  <?php
}

public function recomended_product_two(){
  
$recomended_product_two = $this->product_m->get_section_two_cat("rand");
 $currency = $this->data['currency'] ;
 $curr_symbol =  $this->data['curr_symbol']   ;
  ?>
              <figcaption>Recommended For You</figcaption>

              <?php 


$i = 1;
              foreach ($recomended_product_two as $data) {
                // if($i > 0 && $i < 5){

$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs);    
               ?>
               
              <div class="ps-product--horizontal">
                <div class="ps-product__thumbnail"><a href="<?php echo site_url('products/'.$slugs.''); ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $data->image; ?>" alt=""/></a></div>
                <div class="ps-product__content"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>

                  <div class="star-ratings-sprite"><span style="width:<?php echo $data->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span></div>

                  <p class="ps-product__price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?></p>
                </div>
              </div>

<?php
// }  $i++ ;
} 
}


public function get_section_three(){
   $section_three_cat = $this->product_m->get_section_three_cat("rand");
  $currency = $this->data['currency'] ;
  $curr_symbol =  $this->data['curr_symbol']   ;
?>


                  <div class="row">
                    

              <?php  foreach ($section_three_cat as $data) {  
$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs); 
 ?>
              
          
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 ">
                <div class="ps-product">
                  <div class="ps-product__thumbnail"><a href="<?php echo site_url('products/'.$slugs.''); ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $data->image ; ?>" alt=""/></a>
                     <?php if($data->product_offer !=0){
                      echo '<div class="ps-product__badge">-'.(int) $this->frontend_m->cal_percent($this->frontend_m->convert(($data->price+$data->price*$data->comission/100)) ,$this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ).'%</div>';
                    } ?>
                    <ul class="ps-product__actions">
                      <li><a href="<?php echo site_url('products/'.$slugs.''); ?>" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                      <li><a href="#" class="add_to_wishlist" data-toggle="tooltip" data-placement="top" data-id="<?php echo $data->id ; ?>" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                    </ul>
                  </div>
                  <div class="ps-product__container">
                    <div class="ps-product__content"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>

                      <div class="star-ratings-sprite"><span style="width:<?php echo $data->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span></div>


                      <p class="ps-product__price sale"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?></p>
                    </div>
                    <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>
                      <p class="ps-product__price sale">
                        <?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                         ?></p>
                    </div>
                  </div>
                </div>
              </div>
   <?php } ?>
              
            
                  </div>
                

<?php


}

public function recomended_product_three(){
$recomended_product_three = $this->product_m->get_section_three_cat("rand");
  $currency = $this->data['currency'] ;
  $curr_symbol =  $this->data['curr_symbol']   ;
  ?>
              <figcaption>Recommended For You</figcaption>

              <?php 
           

$i = 1;
              foreach ($recomended_product_three as $data) {
                if($i > 0 && $i <= 5){
$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs); 
               ?>
               
              <div class="ps-product--horizontal">
                <div class="ps-product__thumbnail"><a href="<?php echo site_url('products/'.$slugs.''); ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $data->image; ?>" alt=""/></a></div>
                <div class="ps-product__content"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>

                  <div class="star-ratings-sprite"><span style="width:<?php echo $data->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span></div>


                  <p class="ps-product__price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?></p>
                </div>
              </div>

<?php }  $i++ ;} 

            
}

public function our_collection(){
$proudcts = $this->product_m->get_home_product();
    
  $currency = $this->data['currency'] ;
  $curr_symbol =  $this->data['curr_symbol']   ;
  ?>



            <div class="row">

              <?php foreach ($proudcts as $data) {  

                $p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs); 
 ?>
              
          
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6 ">
                <div class="ps-product">
                  <div class="ps-product__thumbnail"><a href="<?php echo site_url('products/'.$slugs.''); ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $data->image ; ?>" alt=""/></a>
                     <?php if($data->product_offer !=0){
                      echo '<div class="ps-product__badge">-'.(int) $this->frontend_m->cal_percent($this->frontend_m->convert(($data->price+$data->price*$data->comission/100)) ,$this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ).'%</div>';
                    } ?>
                    <ul class="ps-product__actions">
                      <li><a href="<?php echo site_url('products/'.$slugs.''); ?>" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                      <li><a href="#" class="add_to_wishlist" data-toggle="tooltip" data-placement="top" data-id="<?php echo $data->id ; ?>" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
                    </ul>
                  </div>
                  <div class="ps-product__container">
                    <div class="ps-product__content"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>

                      <div class="star-ratings-sprite"><span style="width:<?php echo $data->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span></div>


                      <p class="ps-product__price sale"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?>
                        </p>
                    </div>
                    <div class="ps-product__content hover"><a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>
                      <p class="ps-product__price sale"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?></p>
                    </div>
                  </div>
                </div>
              </div>
   <?php } ?>
              
            </div>
          
  <?php
}

public function get_home_banner_cats(){
    $child_cats =  $this->data['child_cats'] ;
    $parent_cats =  $this->data['parent_cats'];
    $g_seeting= $this->data['g_seeting'];
?>
  <ul class="menu--dropdown">

          <?php 
  $hide_cats =  explode(",",$g_seeting->hide_categories);
          foreach ($parent_cats as $data) {
$p_name =$data->categories_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs); 
if(!in_array($data->cats_id, $hide_cats)){
           ?>

          <li class="menu-item-has-children has-mega-menu"><a href="<?php echo site_url('categories/?cats='.$slugs.'&parent=true'); ?>"><?php echo $data->categories_name ; ?></a>
            <div class="mega-menu row">
              <?php 

                  $child_cats_array = array();
       
                  foreach ($child_cats as $datas) {
                    
                    if($datas->parent_id == $data->cats_id){

                      $child_cats_array[] = array('categories_name' =>$datas->categories_name ,'parent_id'=>$datas->parent_id,'cats_id'=>$datas->cats_id);
                    }

           
                  }
               
                
                foreach ($child_cats_array as $data_child) {

                    $sub_child_array = array();

                  foreach ($child_cats as $data_sub) {
                    
                    if($data_sub->parent_id == $data_child['cats_id']){

                      $sub_child_array[] = array('categories_name' =>$data_sub->categories_name ,'parent_id'=>$data_sub->parent_id,'cats_id'=>$data_sub->cats_id);
                    }

           
                  }
            $d_cats_name =$data_child['categories_name'] ;
$slugs = str_replace(" & ", '----', $d_cats_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs);  
$slugs = str_replace(" ", '_', $slugs);  
                    
               ?>
              <div class="mega-menu__column col-md-3">
                <h4><a href="<?php echo site_url('categories/?cats='.$slugs.'&sub_child=true'); ?>"><?php echo $data_child['categories_name'] ; ?></a><span class="sub-toggle"></span></h4>
                <?php if(count($sub_child_array) >0){ ?>
                <ul class="mega-menu__list">
                  <?php foreach ($sub_child_array as $data_cats_child) { 


            $d_s_cats_name =$data_cats_child['categories_name'] ;
$slugs = str_replace(" & ", '----', $d_s_cats_name); 
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs);
$slugs = str_replace(" ", '_', $slugs);
    

                   ?>
                   
               
                  <li><a href="<?php echo site_url('categories/?cats='.$slugs.''); ?>"><?php echo $data_cats_child['categories_name']; ?></a>
                  </li>
                     <?php } ?>
                </ul>
<?php } ?>
              </div>
            <?php } ?>
              
            </div>
          </li>

 <?php } } ?>
        </ul>
        <?php
}

public function get_header_menu_cats(){
$child_cats =  $this->data['child_cats'] ;
    $parent_cats =  $this->data['parent_cats'];
    $g_seeting= $this->data['g_seeting'];
  ?>
  <ul class="menu--dropdown">
              <?php foreach ($parent_cats as $data) {

$p_name =$data->categories_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs);  
$slugs = str_replace(" ", '_', $slugs);  
               ?>
              <li class="menu-item-has-children has-mega-menu"><a href="<?php echo site_url('categories/?cats='.$slugs.'&parent=true'); ?>"><?php echo $data->categories_name ; ?></a>
                <div class="mega-menu" style="min-height: 466px;">
                    <?php 
                  $child_cats_array = array();
                  foreach ($child_cats as $datas) {
                    if($datas->parent_id == $data->cats_id){
                    $child_cats_array[] = array('categories_name' =>$datas->categories_name ,'parent_id'=>$datas->parent_id,'cats_id'=>$datas->cats_id);
                    }
                  }
                foreach ($child_cats_array as $data_child) {
                    $sub_child_array = array();
                  foreach ($child_cats as $data_sub) {
                    if($data_sub->parent_id == $data_child['cats_id']){
                      $sub_child_array[] = array('categories_name' =>$data_sub->categories_name ,'parent_id'=>$data_sub->parent_id,'cats_id'=>$data_sub->cats_id);
                    }
                  }
                      $d_cats_name =$data_child['categories_name'] ;
$slugs = str_replace(" & ", '----', $d_cats_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs);      
               ?>
                  <div class="mega-menu__column">

                    <h4><a href="<?php echo site_url('categories/?cats='.$slugs.'&sub_child=true'); ?>"><?php echo $data_child['categories_name'] ; ?></a></h4>
                    <ul class="mega-menu__list">
                    <?php foreach ($sub_child_array as $data_cats_child) { 
$d_s_cats_name =$data_cats_child['categories_name'] ;
$slugs = str_replace(" & ", '----', $d_s_cats_name); 
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs);
$slugs = str_replace(" ", '_', $slugs);  
                     ?>
                      <li><a href="<?php echo site_url('categories/?cats='.$slugs.''); ?>"><?php echo $data_cats_child['categories_name']; ?></a>
                      </li>
                    <?php } ?>
                    </ul>
                  </div>
                 <?php } ?>
                </div>
              </li>
 <?php } ?>
            </ul>
  <?php
}

public function search_trending(){
$child_cats =  $this->data['child_cats'] ;
    $parent_cats =  $this->data['parent_cats'];
              $child_cats_array = array();
              foreach ($parent_cats as $data) { 

                  foreach ($child_cats as $datas) {
                    
                    if($datas->parent_id == $data->cats_id){

                      $child_cats_array[] = array('categories_name' =>$datas->categories_name ,'parent_id'=>$datas->parent_id,'cats_id'=>$datas->cats_id,'categories_image'=>$datas->categories_image);
                    }

           
                  }
              }
              $i = 0 ;
              foreach ($child_cats_array as $data) {
               if($i == 0){
                $class = 'active';
              }else{
                $class ="";
              }  

               ?>
                
          <div class="owl-item active" style="width: 130px; margin-right: 0px;">
              <a class="<?php echo $class ; ?> " href="#<?php echo $data['cats_id'] ?>">

                <?php if($data['categories_image'] != NULL){
                   
                      ?>
 <img style="height: 38px; width: 38px; margin: 0 auto;" src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $data['categories_image'] ; ?>" alt="<?php echo $data['categories_name']; ?>">

                      <?php 

                    }else{ ?>
                    <i class="icon-star"></i>
                  <?php } ?>
                

                <span><?php echo $data['categories_name']; ?></span></a>
              </div>
               <?php  $i++ ; }
             
}

public function search_trending_tab(){
$child_cats =  $this->data['child_cats'] ;
    $parent_cats =  $this->data['parent_cats'];
 $child_cats_array = array();
          foreach ($parent_cats as $data) { 

              foreach ($child_cats as $datas) {
                
                if($datas->parent_id == $data->cats_id){

                  $child_cats_array[] = array('categories_name' =>$datas->categories_name ,'parent_id'=>$datas->parent_id,'cats_id'=>$datas->cats_id,'categories_image'=>$datas->categories_image);
                }

       
              }
          }
$i = 0 ;
foreach ($child_cats_array as $data) { 


    $sub_child_array = array();

          foreach ($child_cats as $data_sub) {
            
            if($data_sub->parent_id == $data['cats_id']){

              $sub_child_array[] = array('categories_name' =>$data_sub->categories_name ,'parent_id'=>$data_sub->parent_id,'cats_id'=>$data_sub->cats_id ,'categories_image'=>$data_sub->categories_image);
            }

   
          }




       
if($i == 0){
  $class = 'active';
}else{
  $class ="";
}

 ?>
 

              <div class="ps-tab <?php echo $class ; ?>" id="<?php echo $data['cats_id'] ;?>">
                <div class="ps-block__item">

<?php foreach ($sub_child_array as $data_child) { 
    $d_s_cats_name =$data_child['categories_name'] ;
$slugs = str_replace(" & ", '----', $d_s_cats_name); 
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs);
$slugs = str_replace(" ", '_', $slugs);
    

 ?>
                  <a class="notranslate" href="<?php echo site_url('categories/?cats='.$slugs.'') ?>">
                    <?php if($data_child['categories_image'] != NULL){
                      ?>
 <img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $data_child['categories_image'] ; ?>" alt="#television">

                      <?php 

                    }else{ ?>
                    <img src="<?php  echo base_url() ;  ?>/admin-assets/images/box-512.png" alt="#television">
                  <?php } ?>

                    <span class="translate"><?php echo $data_child['categories_name']; ?></span></a>
<?php } ?>

            
                </div>
              </div>
<?php  $i++ ; } 
}

public function deals_of_the_weak(){

$deal_of_the_Week = $this->product_m->get_deal_of_the_week();
 $currency = $this->data['currency'] ;
  $curr_symbol =  $this->data['curr_symbol']   ;
  ?>
<div class="ps-carousel--nav owl-slider owl-carousel owl-theme owl-loaded" data-owl-auto="true" data-owl-loop="true" data-owl-speed="1000" data-owl-gap="30" data-owl-nav="false" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="3" data-owl-item-md="4" data-owl-item-lg="4" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
  <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 1s ease 0s; width: 936px;">
  <?php
 foreach ($deal_of_the_Week as $data) {  
 $image = '';
$p_name =$data->product_name ;
$slugs = str_replace(" & ", '----', $p_name);
$slugs = str_replace(', ', '--', $slugs);
$slugs = str_replace("'", '---', $slugs); 
$slugs = str_replace(" ", '_', $slugs); 
  ?>
<div class="owl-item active" style="width: 204px; margin-right: 30px;"><div class="ps-product ps-product--inner">
            <div class="ps-product__thumbnail">
          <div class="ps-product ps-product--inner">
            <div class="ps-product__thumbnail"><a href="<?php echo site_url('products/'.$slugs.''); ?>"><img src="<?php  echo base_url() ;  ?>/admin-assets/images/<?php echo $data->image; ?>" alt=""></a>
               <?php if($data->product_offer != NULL){ ?>
                    <?php 
                    if($data->product_offer != 0){
                        echo '<div class="ps-product__badge">-'. (int)$this->frontend_m->cal_percent($this->frontend_m->convert(($data->price+$data->price*$data->comission/100)) ,$this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ).'%'.'</div>' ;
                        
                    }
                     ?>
                <?php } ?>
              <?php if($data->product_stock !="in_stock"){
                echo '<div class="ps-product__badge out-stock">out of stock</div>';
              } ?>
              <ul class="ps-product__actions">
                <li><a href="<?php echo site_url('products/'.$slugs.''); ?>" data-toggle="tooltip" data-placement="top" title="Add to Cart"><i class="icon-bag2"></i></a></li>
                <li><a href="#" class="add_to_wishlist" data-id="<?php echo $data->id ; ?>" data-toggle="tooltip" data-placement="top" title="Add to Whishlist"><i class="icon-heart"></i></a></li>
              </ul>
            </div>
            <div class="ps-product__container">
              <p class="ps-product__price"><?php echo $currency ; ?> <?php echo $curr_symbol[$currency]; ?> <?php  echo $this->frontend_m->convert(round(($data->price+$data->price*$data->comission/100) - ($data->price*$data->comission/100)*$data->product_offer/100,2)) ; 
                        if($data->product_offer >0 ){
                          echo '<del> '.$this->frontend_m->convert(($data->price+$data->price*$data->comission/100)).'</del>' ;
                        } ?></p>
              <div class="ps-product__content">
                  <div class="product-title">
                      <a class="ps-product__title" href="<?php echo site_url('products/'.$slugs.''); ?>"><?php echo $data->product_name ; ?></a>
                  </div>
                <div class="star-ratings-sprite"><span style="width:<?php echo $data->avg_ratings * 20 ; ?>%" class="star-ratings-sprite-rating"></span></div>
              </div>
           
           
            </div>
          </div>
        </div>
      </div>
    </div>
<?php } ?>
</div>
</div>
<div class="owl-controls"><div class="owl-nav"><div class="owl-prev" style="display: none;"><i class="icon-chevron-left"></i></div><div class="owl-next" style="display: none;"><i class="icon-chevron-right"></i></div></div><div class="owl-dots" style="display: block;"><div class="owl-dot active"><span></span></div></div></div></div>
<?php 
        
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
   
   public function Deals(){
    
    $this->db->select('products.*,variation_product.*');
    $this->db->from('products');
 	$this->db->where('products.deal_of_the_weak', 'yes');
 	$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
 	$this->db->group_by('products.product_id');
    $this->data['deal_of_the_Week'] =$this->db->get()->result();
    $this->data['currency'] = $this->data['currency'] ;
    $this->data['curr_symbol'] =  $this->data['curr_symbol'];

    $this->load->view('deals', $this->data);
        
}

      public function New(){
        $this->db->select('products.*,variation_product.*');
 		$this->db->from('products');
 		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
 		$this->db->group_by('products.product_id');
 		$this->db->order_by('products.id', 'desc');
 		$this->db->limit(30);
        $this->data['new_product'] = $this->db->get()->result();
        $this->data['currency'] = $this->data['currency'] ;
        $this->data['curr_symbol'] =  $this->data['curr_symbol'];

        $this->load->view('new', $this->data);
        
    }

}



/* End of file Frontend.php */
/* Location: ./application/modules/Frontend/controllers/Frontend.php */
 ?>