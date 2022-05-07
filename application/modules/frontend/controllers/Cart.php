<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
        $this->load->library("cart");
		$this->load->model('cart_m');
    $this->load->model('product_m');
        $this->load->model('frontend_m');
        $this->data['main_menu'] =$this->frontend_m->main_menu();
         $wishlist_id = $this->session->userdata('wishlist_id');
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

    if(!empty($wishlist_id)){
     $wishlist_id = array_unique($wishlist_id);
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
    $this->data['child_cats'] =$this->product_m->gets_category();
    $this->data['parent_cats'] =$this->product_m->gets_parent_cats();
    $this->data['currencies'] = $this->product_m->get_currencies();
    
    $this->data['country'] =$this->product_m->get_country();
    $this->data['g_seeting'] = $this->product_m->g_setting();
    $this->data['g_wishlist'] = $this->getWishlist();
    $this->data['g_wishlist_price'] = $this->getWishlistPrice();

	}
    public function index(){
        $this->data['cart_products'] = $this->get_cart_product_details();
        $this->data['title'] = "Manufacturer, Exporter & Wholesaler";
        $this->load->view('cart', $this->data);
    }
    public function add_to_cart(){

    }
  public function add_cart(){
    $userid = $this->session->userdata('id');
    $id = rtrim($this->input->post('id'));
    $qty = rtrim($this->input->post('qty'));
    $price = rtrim($this->input->post('price'));
    $image = rtrim($this->input->post('image'));
    $name = rtrim($this->input->post('name'));
        $this->cart->product_name_rules = "\.\,\:\-_\"\' a-z0-9";
$this->cart->product_id_rules = "\.\:\-_\"\' a-z0-9";
    $data = array(
        'id' => $id,
        'qty' => $qty,
        'price' => $price,
        'image' => $image,
        'name'    => $name
    );
   $this->cart->insert($data);

   if($userid){
    $this->product_m->insert_db_cart($data) ;
   }
    echo  count($this->cart->contents());
    }

   
	 public function delete_all_cart_items($userid = NULL){
        foreach ($this->cart->contents() as $items){

              $this->cart->remove($items['rowid']);
        }
        if($userid){
          $this->product_m->db_delete_cart($userid) ;
       }
        redirect('cart');
     }


      function removeItem($rowid){


        // Remove item from cart
 
        $userid = $this->session->userdata('id');


        foreach ($this->cart->contents() as $data) {
          # code...

          $id =  $data['id'];
          if($rowid  == $data['rowid']){
            
            if ($userid) {
               $this->product_m->delete_cart_product($id ,$userid );
            }
             

          }
        }
         $remove = $this->cart->remove($rowid);
        // Redirect to the cart page
        redirect('cart/');
    }

    function updateItemQty(){
        $update = 0;
        $userid = $this->session->userdata('id');
        // Get cart item info
        $rowid = $this->input->post('rowid');
        $qty = $this->input->post('qty');
        
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            $data = array(
                'rowid' => $rowid,
                'qty'   => $qty
            );
        
            $update = $this->cart->update($data);

      if($userid){
        foreach ($this->cart->contents() as $datas) {
          # code...
          if($rowid  == $datas['rowid']){
            $qty = $datas['qty'];
            $id = $datas['id'];
            if ($userid) {
               $this->product_m->update_cart_quantity($id ,$userid , $qty);
            }
             

          }
        }
      }
        }
        
        // Return response
        echo $update?'ok':'err';
    }

    public function mini_cart(){
        $currency = $this->session->userdata('currency');
        $currency =($currency != "") ? $currency : "USD";
        $curr_symbol =$this->product_m->currency_code_symbol();
        $html = '';
              $html .= '<div class="ps-cart__items">';
               foreach ($this->cart->contents() as $item){
                $html .= '<div class="ps-product--cart-mobile">
                  <div class="ps-product__thumbnail"><a href="#"><img src="'.base_url('admin-assets/images/'.$item['image'].'').'" alt=""></a></div>
                  <div class="ps-product__content"><a class="ps-product__remove" href="'.site_url('cart/removeItem/'.$item["rowid"].'').'"><i class="icon-cross"></i></a><a href="#">'.$item["name"].'</a>
                   <small>'.$item["qty"].'x '.$currency.' '.$curr_symbol[$currency].' '.$this->frontend_m->convert($item['price']).'</small>
                  </div>
                </div>';
               
            }
             $html .= '</div>
              <div class="ps-cart__footer">
                <h3>Sub Total:<strong>'.$currency.' '.$curr_symbol[$currency].' '.$this->frontend_m->convert($this->cart->total()).'</strong></h3>
                <figure><a class="ps-btn" href="'.site_url('cart').'">View Cart</a><a class="ps-btn" href="'.site_url('checkout').'">Checkout</a></figure>
              </div>';

                echo $html;

    }
    public function cart_counts(){
        echo count($this->cart->contents());
    }

public function calculate_shipping_in_cart(){

    $weight = $this->claculate_cart_weight();
    $result = $this->frontend_m->calculate_shipping_in_cart($weight);
    $currency = $this->session->userdata('currency');
    $currency =  ($currency != "") ? $currency : "USD";
    $curr_symbol =  array('USD'=> '$', 'EUR' => '€' ,'AUD' => 'A$','INR' => '₹' ,'GBP' =>'£' ,'GHS' => '');
    if($result != ''){
      $price = $result->price_per_kg ;
      $price = $price * $weight ;
    return $price;
    }else{
      return 0;
    }

   }

public function claculate_cart_weight(){
    $products = array() ;
    $weight = array();
     foreach ($this->cart->contents() as $item){
      $products[]=$item['id'];
     }
     $products =  array_unique($products);
     if(!empty($products)){
      $this->db->select('*');
      $this->db->from('variation_product');
      $this->db->where_in('sku',$products);
      $result = $this->db->get()->result();
      foreach ($result as $data) {
        $weight[$data->sku] = array('weight' => $data->weight);
        # code...
      }
     }
     $net_weight = 0 ;
     // var_dump($weight[33]['weight']);
     foreach ($this->cart->contents() as $item){
        $id = $item['id'];
       
          if($weight[$id]['weight'] == NULL){
            $net_weight = $net_weight + 0;
          }else{
            $net_weight= $net_weight + floatval($weight[$id]['weight'])*$item['qty'] ;
          }
     }
      return $net_weight;
   }

   public function get_cart_product_details(){
        $p_id = array();
        $products = array();
        foreach ($this->cart->contents() as $item){
            $p_id[] = $item['id'];
        }
        if(!empty($p_id)){
            $this->db->select('*');
            $this->db->from('products');
            $this->db->where_in('id', $p_id);
            $result = $this->db->get()->result();
        foreach ($result as $data) {
            # code...
            $products[$data->id] = $data ;
        }
        return $products ;
        }
        
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

/* End of file Cart.php */
/* Location: ./application/modules/frontend/controllers/Cart.php */