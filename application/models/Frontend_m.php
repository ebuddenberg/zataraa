<?php
class Frontend_m extends MY_Model {
	protected $_table_name = 'popup_style';
	protected $_order_by = 'id';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';

	function __construct(){
		parent::__construct();
		$this->load->helper("file");
		$this->load->library('email');
		$this->CurrencyConverter = new CurrencyConverter();
	}
	public function home_popup(){
		$this->db->where('select_popup', 'Yes');
		$result = $this->db->get('popup_style')->row();
		return $result ;
	}
	public function add_newsletter(){
		$data = array(
 			'email' => $this->input->post('email1'),
			'mobile_no' => $this->input->post('phone1'),
			'coun_code' => $this->input->post('country_code1'),
			'coun_no' => $this->input->post('country1'),
  		);
  		$value = $this->db->insert('newsleter', $data);
  		if($value){
  		    echo "Message Has been sent";
  	      }else{
  	      	echo "Error";
  	      }
	}

	public function cal_percent($x , $y ){

		$result =  round(($x- $y)*100/$x ,2) ;

		return $result ;

	}
	public function main_slider(){
		$this->db->where('slider_name', "Main Slider");
       $result = $this->db->get('slider')->result();
	   return $result ;
	}
	public function small_slider1(){
		$this->db->where('slider_name', "Small Slider 1");
       $result = $this->db->get('slider')->result();
	   return $result ;
	}
	public function small_slider2(){
		$this->db->where('slider_name', "Small Slider 2");
       $result = $this->db->get('slider')->result();
	   return $result ;
	}
	public function small_slider3(){ 
		$this->db->where('slider_name', "Small Slider 3");
       $result = $this->db->get('slider')->result();
	   return $result ;
	}
	public function category_slider(){
		$this->db->where('slider_name', "Category Slider");
       $result = $this->db->get('slider')->result();
	   return $result ;
	}

	public function top_left(){
		$this->db->where('place', "Top Left");
       $result = $this->db->get('home_categories')->row();
	   return $result ;
	}
	public function top_right(){
		$this->db->where('place', "Top Right");
       $result = $this->db->get('home_categories')->row();
	   return $result ;
	}
	public function four_boxes(){
		$this->db->where('place', "Four Boxes");
       $result = $this->db->get('home_categories')->result();
	   return $result ;
	}
	public function bottom_left(){
		$this->db->where('place', "Bottom Left");
       $result = $this->db->get('home_categories')->row();
	   return $result ;
	}
	public function bottom_right(){
		$this->db->where('place', "Bottom Right");
       $result = $this->db->get('home_categories')->row();
	   return $result ;
	}

	public function top_ads(){
		$this->db->where('position', "Top");
       $result = $this->db->get('home_ads')->row();
	   return $result ;
	}
	public function middle_ads(){
		$this->db->where('position', "Middle");
       $result = $this->db->get('home_ads')->row();
	   return $result ;
	}
	public function bottom_ads(){
		$this->db->where('position', "Bottom");
       $result = $this->db->get('home_ads')->row();
	   return $result ;
	}

	public function top_scroll(){
		$this->db->where('text_place', "Top Scroll");
       $result = $this->db->get('home_text')->row();
	   return $result ;
	}
	public function slider_heading(){
		$this->db->where('text_place', "Slider Heading");
       $result = $this->db->get('home_text')->row();
	   return $result ;
	}
	public function latest_news(){
		$this->db->where('text_place', "Latest News");
       $result = $this->db->get('home_text')->result();
	   return $result ;
	}
	public function bottom_text(){
		$this->db->where('text_place', "Bottom Text");
       $result = $this->db->get('home_text')->result();
	   return $result ;
	}

	public function home_products($data){
		$this->db->select('products.*,products.id as pids, products.createdAt as created,products.updatedAt as updated,product_images.*');
		$this->db->from('products');
		$this->db->join('product_images', 'products.id = product_images.product_id', 'left');
		$this->db->where('product_images.is_it_cover', 'yes');
        $this->db->like('product_type', $data);
 		$result = $this->db->get()->result();
		return $result ;
	}
	public function products_details($slugs = NULL){
		 
        $this->db->where('slugs', $slugs);
 		$result = $this->db->get('products')->row();
		return $result ;
 
	}
	public function products_gallery($slugs = NULL){
		 
        $this->db->where('slugs', $slugs);
 		$result = $this->db->get('products')->row();
		 
		$this->db->where('product_id', $result->id);
 		$thumb = $this->db->get('product_images')->result();
 		return $thumb;
	}
	public function products_size($slugs = NULL){
		 
        $this->db->where('slugs', $slugs);
 		$result = $this->db->get('products')->row();
		 $results =  explode(',', $result->product_categories);
        $this->db->where_in('category_name', $results);
  		$size = $this->db->get('product_size')->result();
 		return $size;
	}
	public function products_csize($slugs = NULL){
		 
        $this->db->where('slugs', $slugs);
 		$result = $this->db->get('products')->row();
		$news=  explode(',', $result->size_chart_id);
        
        $this->db->where_in('id', $news);
  		$chart = $this->db->get('size_chart')->result();
 		return $chart;
	}
	public function  user_register($id = NULL){
		$user = $this->save(array(
			'id' => '',
 			'email' => $this->input->post('email'),
			'password' => $this->hash($this->input->post('pass')),
			'user_type'=>'customer',
			'status' => 'inactive',
			'createdAt' => '' ,
			'updatedAt' => '' ,
		));
		return TRUE ;
 	}
  public function hash ($string)
		{
			return hash('sha512', $string . config_item('encryption_key'));
		}
  public function main_menu(){
  	// $this->db->select('id,main_heading,parent_menu');
  	 
  	//    $this->db->group_by('main_heading');
  	  // $this->db->order_by('id', 'ASC');
       // $result = $this->db->get('menus')->result();
  	$result = array();
 	   return $result ;
	}

	public function get_products($product_id){

		if(!empty($product_id)){
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where_in('id', $product_id);
 		$result = $this->db->get()->result();
		return $result ;
			}else{
				return array();
			}
	}
 //  public function parent_menu(){
 //       $result = $this->db->get('menus')->result();
 //        $data1 = "";
 //       foreach ($result as $resultss) {
 //       	  $data  = $resultss->main_heading;
 //       	  $this->db->where('main_heading', $data);
 //          $p_menus  = $this->db->get('menus')->result();
 //          $data1 .= $p_menus->parent_menu;
 //       }
 //  	   return  $data1 ;
	// }

	public function convert($amount){
    		  $currency = $this->session->userdata('currency');
      $currency=  ($currency != "") ? $currency : "USD";
        $result = $this->CurrencyConverter->convert('USD', $currency, $amount, 1, 1);

        return($result);
    }

    public function calculate_shipping(){
    	$weight = rtrim($this->input->post('weight'));
    	$country = rtrim($this->input->post('country'));
    	$shipping_method = rtrim($this->input->post('shipping_method'));
    	$this->db->select('*');
    	$this->db->from('shipping_method');
    	$this->db->where('shipping_method', $shipping_method);
    	$this->db->where('country', $country);
    	$this->db->where('max_weight >=',$weight);
    	$this->db->where('min_weight <',$weight);
    	$result = $this->db->get()->row();
    	return $result ;
    }

    public function calculate_weight(){

    }

    public function get_shipping_method($weight){

    	$country = '';

    }
    public function calculate_shipping_in_cart($weight){
    	$country = rtrim($this->input->post('country'));
    	$shipping_method = rtrim($this->input->post('shipping_method'));
    	if($country !=""){
    	$data = array(
    		'shipping_country' => $country,
    		'shipping_method' => $shipping_method
    	);
    	$this->session->set_userdata($data);
	    }else{
	    	$country = $this->session->userdata('shipping_country');
	    	$shipping_method = $this->session->userdata('shipping_method');
	    }
    	$this->db->select('*');
    	$this->db->from('shipping_method');
    	$this->db->where('shipping_method', $shipping_method);
    	$this->db->where('country', $country);
    	$this->db->where('max_weight >=',$weight);
    	$this->db->where('min_weight <',$weight);
    	$result = $this->db->get()->row();
    	return $result ;
    }
    public function get_user_info(){
	  $id = $this->session->userdata('id');
	  $this->db->select('*');
	  $this->db->from('users');
	  $this->db->where('id', $id);
	  $result = $this->db->get()->row();
	  return $result;
	}

	public function get_address_info(){
	  $id = $this->session->userdata('id');
	  $this->db->select('*');
	  $this->db->from('address');
	  $this->db->where('user_id', $id);
	  $this->db->where('is_default','yes');
	  $result = $this->db->get()->row();

	  if($result == NULL){
	  	$result =  array('country'=> '','city' => '','state' => '','email' => '','zip' => '','address_one'=>'','address_two' => '','first_name' =>'','last_name'=>'','email' => '','phone_no' => '');

	  	return json_decode(json_encode($result),false);
	  }else{
	  	  return $result;
	  }
	  
	 
	
	}
}
