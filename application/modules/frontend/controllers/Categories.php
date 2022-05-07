<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->library('pagination');
		$this->load->library('email');
		$this->load->model('frontend_m');
		$this->load->model('product_m');
		$this->load->library('email');
		$this->load->library('cart');
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
        
	    $wishlist_id = $this->session->userdata('wishlist_id');
	    if(!empty($wishlist_id)){
	     $wishlist_id = array_unique($wishlist_id);
	    }
    	if($this->session->userdata('wishlist_id')){
          $wishlist_count = count($this->session->userdata('wishlist_id'));
        }else{
           $wishlist_count = 0 ;
        }
	$this->data['child_cats'] =$this->product_m->gets_category();
    $this->data['parent_cats'] =$this->product_m->gets_parent_cats();
    $this->data['wishlist_count'] = $wishlist_count;
	    $this->data['brand'] = $this->product_m->get_brands();
	    $this->data['color'] = $this->product_m->get_color();
	    $this->data['size'] = $this->product_m->get_size();
        $this->data['attributes'] = $this->product_m->get_attributes(); 
        $this->data['currencies'] = $this->product_m->get_currencies();
        $this->data['country'] =$this->product_m->get_country();
	    $currency = $this->session->userdata('currency');
	    $this->data['currency']=  ($currency != "") ? $currency : "USD";
	    $this->data['curr_symbol'] = $this->product_m->currency_code_symbol();
         $this->data['g_seeting'] = $this->product_m->g_setting();
        $this->data['g_wishlist'] = $this->getWishlist();
        $this->data['g_wishlist_price'] = $this->getWishlistPrice();
 	}


	public function index()
	{
		
		$slug =  $this->uri->segment(2);
        if($this->input->get('per_pages') && $this->input->get('per_pages') != '' ){
            $config['per_page'] = $this->input->get('per_pages') ;
        }else{
            $config['per_page'] = 20;
        }
        
         if(!$this->input->get('per_page') || $this->input->get('per_page')=="")
        {
            $offset = 0;
        }
        else
        {
            $offset = ($config['per_page'])*($this->input->get('per_page')-1);
        }
        $products = $this->product_m->adv_cats_search();
        $product = $this->product_m->adv_cats_search($config["per_page"], $offset);

        $config["base_url"] = base_url() . "categories";
        $config["total_rows"] = count($products);
        $config["total_rows"] = $config["total_rows"];
        $config["num_links"] = $config["total_rows"];
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
        $config['page_query_string'] =TRUE ;
        $config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
       

        
		$product_id = array();
		$this->data['title'] = "Product List";
		
		$this->data['products'] = $product;
		foreach ($product as $data) {
			$product_id[$data->product_id] = $data->product_id ;
		}
        $this->data['price'] =  $this->product_m->products_price($product_id);

		$this->load->view('products', $this->data);
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

}

/* End of file Categories.php */
/* Location: ./application/modules/frontend/controllers/Categories.php */