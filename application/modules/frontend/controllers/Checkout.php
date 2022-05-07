<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends Checkout_Controller {


	function __construct ()
	{
		parent::__construct();
    $this->load->model('product_m');
    $this->load->model('frontend_m');
		$this->data['title'] = "Zataara";
    $this->load->library('cart');
    $this->data['country'] =$this->product_m->get_country();
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
		 	$id = $this->session->userdata('id');
      $user_type = $this->session->userdata('user_type');
      if($this->session->userdata('customer_data')){
        $users = $this->session->userdata('customer_data');
        $users = json_decode(json_encode($users), FALSE);
      }else{
        if(!isset($id) || $user_type == 'admin'){
      $users = array('country'=> '','city' => '','state' => '','email' => '','zip' => '','address_one'=>'','address_two' => '','first_name' =>'','last_name'=>'','email' => '','phone_no' => '');
      $users = json_decode(json_encode($users), FALSE);
    }else{
      $users = $this->frontend_m->get_address_info();
    }
      }
   	$this->data['users'] = $users ;
    $this->data['currencies'] = $this->product_m->get_currencies();
    $this->data['cart_products'] = $this->get_cart_product_details();
    $this->data['child_cats'] =$this->product_m->gets_category();
    $this->data['parent_cats'] =$this->product_m->gets_parent_cats();
     $this->data['g_seeting'] = $this->product_m->g_setting();
     $this->data['country'] =$this->product_m->get_country();
    $this->data['state'] =$this->product_m->get_states();
    $this->data['city'] =$this->product_m->get_citys();
    $this->data['g_wishlist'] = $this->getWishlist();
    $this->data['g_wishlist_price'] = $this->getWishlistPrice();
    $this->data['get_shipping_method_page_content'] = $this->getShippingMethodPageContent();
    $this->data['exis_users'] = $this->user_m->user($id);
    $this->data['getUserGift'] = $this->getUserGift();

	}

	public function index()
	{
  
  $this->data['shipping_method'] = $this->calculate_shipping();

    $this->load->view('checkout', $this->data);
	}


  public function get_price_by_shipping($shipping_method){
    

  }

  public function get_total_checkout_price(){

  $calculate_shipping = $this->input->post('shipping_method');
  $total =  $this->cart->total();

 


  $total_cost_inc_shipping =  $this->frontend_m->convert($total) + $calculate_shipping;

echo  round($total_cost_inc_shipping ,2) ;

  }

  public function set_country(){

    $id = $this->input->post('id');

    $this->db->where('id', $id);
     $country = $this->db->get('countries')->row()->name;
     $this->session->set_userdata('country', $country);
  }

  public function update_shipping_method(){

      $id = $this->input->post('id');

    $this->db->where('id', $id);
     $country = $this->db->get('countries')->row()->name;
     $this->session->set_userdata('country', $country);

     $shipping_method = $this->calculate_shipping();
$pc = 0;
$i = 0;
                                                 foreach ($shipping_method as $key => $value) { 
                                                    if($i == 0 ){
                                                         $pc = $this->frontend_m->convert($value['price']);
                                                    }
                                      
                                                 ?>
 <option value="<?php echo $key; ?>" <?php if($i==0){ echo 'selected';} ?> data-id="<?php echo $this->frontend_m->convert($value['price']); ?>"><?php
 if($key == 'ExpressShipping'){
    echo 'Express Shipping';
}
if($key == 'RegisteredShipping'){

    echo 'Registered Shipping';

}if($key == 'DHL'){

    echo 'DHL';

}   ?> <?php echo $this->frontend_m->convert($value['price']) ; ?></option>
                                                    <?php
                                               $i++; 
                                                } 



  }


  public function calculate_shipping(){

    $weight = $this->claculate_cart_weight();

    $id = $this->session->userdata('id');

    if($id){

     $this->db->select('address.*,countries.name');
     $this->db->from('address');
     $this->db->join('countries', 'address.country = countries.id', 'left');
     $this->db->where('address.user_id', $id);
     $this->db->where('address.is_default', 'yes');
     $result = $this->db->get()->row();
     if($result){
       $country = $result->name ;
     }else{
      $country = $this->session->userdata('country');
     }

    }else{
       $country = $this->session->userdata('country');
    }
   
    if($country){
    $shipping_method = $this->get_shipping_method($weight , $country);
    }else{
      $shipping_method = array();
    }
    return $shipping_method;

   }


   public function get_shipping_method($weight = NULL ,$country = NULL){
      $methods =  array();
      $this->db->where('country', $country);
      $result = $this->db->get('shipping_method')->row();
      

    $this->db->where('shipping_method', 'RegisteredShipping');
      $result1 = $this->db->get('shipping_price')->row();
      

      if($result){
        if($result->ExpressShipping == "yes"){
        $methods[] = 'ExpressShipping' ;
      }
      if($result->RegisteredShipping == "yes" && $weight/1000 <= $result1->max_weight_allowed  ){
        $methods[] = 'RegisteredShipping' ;
      }
      if($result->DHL == "yes"){
        $methods[] = 'DHL' ;
      }

     $this->db->where_in('shipping_method', $methods);
     $result = $this->db->get('shipping_price')->result();

      }
      else{
        $result = array();
      }
      

     $shipping_method = array(); 
     foreach ($result as $data) {
       # code...
      $base_weight  =  $data->base_weight ;
      $add_weight = $data->add_weight ;
      $max_weight_allowed =  $data->max_weight_allowed ;
      $base_cost = $data->base_cost ;
      $add_cost = $data->add_cost ;

      $base_price = $data->base_cost ;
      $effect_weight = $weight - $base_weight ;

      if($effect_weight > 0 ){
        $price_factor = $effect_weight/$base_weight ;
        if(!is_int($price_factor)){
         $price_factor =  (int)$price_factor + 1 ;
        }
      }else{
        $price_factor = 0;
      }

     $total_price  = $data->base_cost + $price_factor*$add_cost ;

      $total =  $this->cart->total();

 

  if($total >= 50 ){
  $shipping = $total_price - $total/10  ;
  if($shipping  < 0){
    $shipping = 0 ;
  }     
  }else{
     $shipping = $total_price;
  }
      $shipping_method[$data->shipping_method] = array('price' =>$shipping);
     }

    return $shipping_method ;

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


  public function get_country_code($country){

     $this->db->where('id', $country);
     $result = $this->db->get('countries')->row();
     return $result->phonecode ;

  }

  public function process(){

    $payment_methods = $this->input->post('payment_method');
    $shipping_method = $this->input->post('shippings_meth');
    $shipping_price = $this->input->post('shipping_method');
    $email = $this->input->post('email');
    $name = $this->input->post('first_name').' '.$this->input->post('last_name') ;
    $country = $this->input->post('country');
    $Mobile = $this->input->post('user_phone');
    $country_code = $this->get_country_code($country);
    $Mobile = $country_code.$Mobile ;
    $total =  $this->frontend_m->convert($this->cart->total()) + $shipping_price;
    if($this->input->post('balance')){
    $balance = $this->input->post('balance');
    if($total > $this->frontend_m->convert($balance)){
    $total = $total - $this->frontend_m->convert($balance) ;
    $updateData=array("balance"=>0);
    }else{
        $total = $this->frontend_m->convert($balance) - $total;
        $updateData=array("balance"=> $this->frontend_m->convert($balance) - $total);
    }
    }
    if($this->input->post('promo_price')){
    $promoPrice = $this->input->post('promo_price');
    $total = $total - $this->frontend_m->convert($promoPrice) ;
    }
    //  if($this->input->post('gift_card')){
    //   $Gift_order_id= $this->product_m->save_gift_order($this->input->post('gift_card'));
    //   echo "<pre>";print_r($Gift_order_id);die();
    // }
    if($payment_methods == "tap_pay"){
        $order_id = $this->product_m->save_order();
        $APIKey = "1tap7"; //Your API Key Provided by Tap  
        $MerchantID = 1014; //Your ID provided by Tap 
        $UserName = "test"; //Your Username under TAP. 
        $ref = $order_id; 
        $CurrencyCode = $this->data['currency'] ; 
        $Total = $total; 
        $str = 'X_MerchantID'.$MerchantID.'X_UserName'.$UserName.'X_ReferenceID'.$ref.'X_Mobile'.$Mobile.'X_CurrencyCode'.$CurrencyCode.'X_Total'.$Total.''; 

        $hashstr = hash_hmac('sha256', $str, $APIKey); 
        $html = '';
        if($hashstr != ''){
          $html .='{
            "CustomerDC": {
              "Email": "'.$email.'",
              "Mobile": "'.$Mobile.'",
              "Name": "'.$name.'"
            },
            "lstProductDC": [';
             foreach ($this->cart->contents() as $item){ 
              $html .='{
                "CurrencyCode": "'.$this->data['currency'].'",
                "ImgUrl": "'.base_url().'/admin-assets/images/'.$item["image"].'",
                "Quantity": "'.$item["qty"].'",
                "TotalPrice": "'.$this->frontend_m->convert($item["qty"]*$item['price']).'",
                "UnitDesc": "'.$item["name"].'",
                "UnitID": "'.$item["name"].'",
                "UnitName": "'.$item["name"].'",
                "UnitPrice": "'.$this->frontend_m->convert($item['price']).'"
                
              }';
            }
            $html .= ',{
                "CurrencyCode": "'.$this->data['currency'].'",
                "Quantity": 1,
                "TotalPrice": "'.$shipping_price.'",
                "UnitDesc": "Shipping Method",
                "UnitID": "'.$shipping_method.'",
                "UnitName": "Shipping Method",
                "UnitPrice": "'.$shipping_price.'"
              }],
            "lstGateWayDC": [
              {
                "Name": "ALL"
              }
            ],
            "MerMastDC": {
              "AutoReturn": "Y",
              "ErrorURL": "'.site_url('checkout/error').'",
              "HashString": "'.$hashstr.'",
              "LangCode": "EN",
              "MerchantID": "1014",
              "Password": "test",
              "PostURL": "'.site_url('checkout/success').'",
              "ReferenceID": "'.$order_id.'",
              "ReturnURL": "'.site_url('checkout/success').'",
              "UserName": "test"
            }
          }' ;
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://tapapi.gotapnow.com/TapWebConnect/Tap/WebPay/PaymentRequest",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>  ''.$html.'',
          CURLOPT_HTTPHEADER => array(
            "content-type: application/json"
          ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
        $response = json_decode($response);
         $payment_url = $response->PaymentURL ;
         
            redirect($payment_url,'refresh');
        }

        }
    $uid = $this->session->userdata('id');
    
    $this->db->where('id', $uid);
	$this->db->update('users',$updateData);
	
	$this->db->where('id', $order_id);
	$orderResult = $this->db->get('orders')->result();
	foreach ($orderResult as $orderData){
	$oId = 'Z37'. str_pad($orderData->id, 8, '0', STR_PAD_LEFT);
	$message = 'Hey '.$orderData->billing_first_name.'! Your order '. $oId. ' is confirmed. Your total order amount is '.$orderData->order_amount.' and shipping charges is '.$orderData->shipping_charge.'';
	$userEmail = $orderData->email;
	}
	$this->email->from('info@zataarastore.com', 'zataarastore');
    $this->email->to($userEmail);
	$this->email->subject('Order Confirmed');
	$this->email->message($message);
	$this->email->send();
	 foreach ($this->cart->contents() as $items){

              $this->cart->remove($items['rowid']);
        }
        if($uid){
          $this->product_m->db_delete_cart($uid) ;
       }
      $this->view_orders($order_id);
      
    }else if($payment_methods == "paypal" ){
	  $payment_url = 'https://www.paypal.com/';
 
	  
redirect($payment_url,'refresh');	
	
	
	}else{
    if($payment_methods && count($this->cart->contents()) > 0){
     $order_ids = $this->data['order_id'] = $this->product_m->save_order();
       $object = array('payment_status' => 'approved', 'order_status' => 'confirmed');
      $this->db->where('id', $order_ids);
      $this->db->update('orders', $object);
      $this->load->view('process', $this->data);
      $this->view_orders($this->data['order_id']);
      foreach ($this->cart->contents() as $items){

                  $this->cart->remove($items['rowid']);
            }
      $this->load->view('process', $this->data);
    }else{
      redirect('cart','refresh');
    }
  }


  }

public function view_orders($id = NULL){

$order_data = array();

$orders =  $this->product_m->get_order_details($id);

$products = $this->product_m->get_orderd_product($orders->product_orderd);
$order_data = array_merge($order_data, array('customerName' =>  $orders->billing_first_name.' '.$orders->billing_last_name));
$order_data  = array_merge($order_data, array('uid' =>  $orders->order_by));

$order_data  = array_merge($order_data, array('zip' =>  $orders->billing_zip));
$order_data  = array_merge($order_data, array('phone' =>  $orders->billing_phone));
$order_data  = array_merge($order_data, array('countryCode' =>  $orders->countryCode));
$order_data  = array_merge($order_data, array('shippingAddress1' =>  $orders->billing_address_one));
$order_data  = array_merge($order_data, array('shippingAddress2' =>  $orders->billing_address_two));
$order_data  = array_merge($order_data, array('city' =>  $orders->city_name));
$order_data  = array_merge($order_data, array('country' =>  $orders->country_name));
$order_data  = array_merge($order_data, array('email' =>  $orders->billing_email));
$order_data  = array_merge($order_data, array('orderNumber' =>  $orders->order_id));
$order_data  = array_merge($order_data, array('noteAttributes' =>  $orders->additional_information));
$order_data  = array_merge($order_data, array('province' =>  $orders->province));
$order_data  = array_merge($order_data, array('createdAt' =>  strtotime($orders->createdAt)*1000));
$quantity = json_decode($orders->quantity ,true);

$order_product = array();

foreach ($products as $data) {
$price = round(($data->price+$data->price*$data->comission/100) - ($data->price+$data->price*$data->comission/100)*$data->product_offer/100,2);
$url = base_url('admin-assets/images/'.$data->image.'');
$order_product[] = array('image' => $url,'quantity' => $quantity[$data->sku] ,'variantId' => $data->variation_product_id,'productPrice'=>$price,'shippingName' => 'ePacket');
  # code...
}
$order_data  = array_merge($order_data, array('products' =>  $order_product));
$data = array();
$data[] = $order_data;
$json =json_encode($data) ;

$headers = array('CJ-Access-Token' => 'eb47bdcce2f44800a21baa2300110d4c','Content-Type' => 'application/json');
$request = Requests::post('https://developers.cjdropshipping.com/api/order/createOrders', $headers,$json);  
  }


  public function save_customer_address(){
    $data =  array('customer_data' => $_POST);
      $this->session->set_userdata($data);
  }


  public function success(){
    $Tap_Ref = $_REQUEST['ref'];
    $Txn_Result = $_REQUEST['result'];
    $Txn_OrderID = $_REQUEST['trackid'];
    $Hash = $_REQUEST['hash'];
    $APIKey = "1tap7"; //Your API Key Provided by Tap 
    $MerchantID = 1014; //Your ID provided by Tap
    $toBeHashedString = 'x_account_id'.$MerchantID.'x_ref'.$Tap_Ref.'x_result'.$Txn_Result.'x_referenceid'.$Txn_OrderID.'';
    $myHashStr = hash_hmac('sha256', $toBeHashedString, $APIKey);

    if($myHashStr == $Hash)
    {

    foreach ($this->cart->contents() as $items){
        $this->cart->remove($items['rowid']);
      }


      $this->data['order_id'] = $_REQUEST['trackid'];
      $object = array('payment_status' => 'approved', 'order_status' => 'confirmed');
      $this->db->where('id', $_REQUEST['trackid']);
      $this->db->update('orders', $object);
      $this->load->view('process', $this->data);

    }else
    {
       echo "Something Went Wrong";
      
    }
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

    public function getShippingMethodPageContent(){
        $this->db->where('id','9');
        $cmsContent = $this->db->get('cms')->row();
        return $cmsContent;
    }
    
    public function check_promo_code(){
        $promoCode = $this->input->post('promoCode');
        $amount = $this->input->post('amount');
        $currDate = date("m/d/Y");
        $this->db->where(array('coupon_code'=>$promoCode,'enable'=> 1));
        $rowResult = $this->db->get('tbl_offers')->row();
        $id = $this->session->userdata('id');

        if($rowResult){
            if($currDate > $rowResult->use_date_begin && $rowResult->use_date_end > $currDate){
                $this->db->where(array('promo_code'=>$rowResult->id,'order_by'=> $id));
                $checkrow = $this->db->get('orders')->row();
                if($rowResult->use_limit_per_user == "one time" && $checkrow != null){
                    $data ['status'] = "false";
                    $data['message']="This promo code is not valid now."; 
                    $mesg= $data;
                }else{
                
                if ($rowResult->total_range_begin > $amount) {
                    $data ['status'] = "false";
                    $data['message']="Amount should be greater than".$rowResult->total_range_begin ;
                    $mesg= $data;
                   
                }else  if ($amount > $rowResult->total_range_end) {
                     $data ['status'] = "false";
                    $data['message']="Amount should be less than".$rowResult->total_range_begin ;
                    $mesg= $data;
                    
                }else{
                    if ($rowResult->type == 'flat') {
                                $discount = (int)$rowResult->flat;
                            } else {
                                $discount = (int)$amount * $rowResult->percent / 100;
                                if ($discount > $rowResult->max_off) 
                                    $discount = (int)$rowResult->max_off;
                            }
                 $promoamount = $discount;
                 $data['amount'] = $promoamount;
                 $data['promo_id'] = $rowResult->id;
                 $data ['status'] = "true";
                 $data['message']="Promo code applied"; 
                 $mesg= $data;
                }
            }
                
            }else{
                $data ['status'] = "false";
                $data['message']="Invalid Promo code"; 
                $mesg=$data;
            }
            
        }else{
            $data ['status'] = "false";
            $data['message']="Invalid Promo code"; 
            $mesg=$data;
           
        }
        echo json_encode($mesg);
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

/* End of file Checkout.php */
/* Location: ./application/modules/frontend/controllers/Checkout.php */