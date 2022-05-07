<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Users extends REST_Controller {

    function __construct($config = 'rest')
    {

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
     header("Access-Control-Allow-Headers:*");
        // Construct the parent class
        parent::__construct();
        $this->load->model('user_m');
        $this->load->helper('string');
        $this->load->model('product_m');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        $this->CurrencyConverter = new CurrencyConverter();
    }

    public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
            ['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
            ['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
        ];

        $id = $this->get('id');

        // If the id parameter doesn't exist return all the users

        if ($id === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users)
            {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.

        $id = (int) $id;

        // Validate the id.
        if ($id <= 0)
        {
            // Invalid id, set the response and exit.
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // Get the user from the array, using the id as key for retrieval.
        // Usually a model is to be used for this.

        $user = NULL;

        if (!empty($users))
        {
            foreach ($users as $key => $value)
            {
                if (isset($value['id']) && $value['id'] === $id)
                {
                    $user = $value;
                }
            }
        }

        if (!empty($user))
        {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response([
                'status' => FALSE,
                'message' => 'User could not be found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function users_post()
    {
        // $this->some_model->update_user( ... );
        $message = [
            'id' => 100, // Automatically generated by the model
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function users_delete()
    {
        $id = (int) $this->get('id');

        // Validate the id.
        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $this->some_model->delete_something($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function hash ($string)
    {
        return hash('sha512', $string . config_item('encryption_key'));
    }

    public function login_post(){

        $email = $this->post('email');
        $password = $this->hash($this->post('password'));

        $data = array('email' => $email ,'password'=>$password ,'user_type'=>'customer','status'=>'active');

        $result =$this->db->get_where('users', $data)->row();
        unset($result->password);


        $this->set_response($result, REST_Controller::HTTP_CREATED);

    }


    public function forget_password_post(){

        $email = $this->post('email');

        $id = random_string('alnum', 6) ;

        if($this->user_m->reset_pass_key($id , $email)){

            $this->email->from('info@zataarastore.com', 'zataarastore');
                $this->email->to($email);
                $this->email->subject('Reset Password');
                $this->email->message('Your One Time password: '.$id.'');
                $this->email->send();
        $this->response([
                 'status' => TRUE,
                'message' => 'OTP send Successfully',
            ], REST_Controller::HTTP_OK);
        }else{
            $this->set_response([
                'status' => FALSE,
                'message' => 'Email Not Found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function reset_password_post(){

        $key = $this->post('otp');

        $password = $this->post('password');
        if($this->user_m->key_match($key))
            {   

                if($password){
                      $email_addr = $this->user_m->get_email($key) ;
                      $email = $email_addr->email ;
        if($this->user_m->update_pass($email ,$password)){

                $this->email->from('info@zataarastore.com', 'zataara Store');
                    $this->email->to($email);
                    $this->email->subject('Reset Password');
                    $this->email->message('Your Password reset sucessfully');
                    $this->email->send();
$this->response([
                'status' => TRUE,
                'message' => 'Reset Password Successfull'
            ], REST_Controller::HTTP_OK);
                    }
                }
                $this->response('OTP matched', REST_Controller::HTTP_OK);
            }else{

                $this->session->set_flashdata('error', 'reset password key mismatch ');
                $this->set_response([
                'status' => FALSE,
                'message' => 'Wrong OTP'
            ], REST_Controller::HTTP_NOT_FOUND);
            }
    }


    public function register_post(){

        $email  = $this->post('email');

        $this->db->where('email', $email);
        $result = $this->db->get('users')->result();
        if(count($result) > 0){
            $this->set_response([
                'status' => FALSE,
                'message' => 'Email Already Exist'
            ], REST_Controller::HTTP_NOT_FOUND);
        }else{
              $data =  array(
                'id' => '',
                'first_name' => $this->post('first_name'),
                'last_name' => $this->post('last_name'),
                'user_phone' => $this->post('user_phone'),
                'email' => $this->post('email'),
                'password' => $this->hash($this->post('password')),
                'user_type'=>'customer',
                'status' => 'active',
                'createdAt' => '' ,
                'updatedAt' => '' ,
            );

    $result =  $this->db->insert('users', $data);
    if($result){
        $this->response('Registerd Successfully', REST_Controller::HTTP_OK);
    }else{
        $this->set_response([
                'status' => FALSE,
                'message' => 'Something Went Wrong'
            ], REST_Controller::HTTP_NOT_FOUND);
    }
        
        }
     
    }


    public function get_countries_post(){

        $result = $this->db->get('countries')->result();
        $this->response($result, REST_Controller::HTTP_OK);

    }

     public function get_states_post(){
        $id  = $this->post('country_id');
        $this->db->where('country_id', $id);
        $result = $this->db->get('states')->result();
        $this->response($result, REST_Controller::HTTP_OK);

    }

     public function get_cities_post(){
        $id  = $this->post('state_id');
        $this->db->where('state_id', $id);
        $result = $this->db->get('cities')->result();
        $this->response($result, REST_Controller::HTTP_OK);

    }


    public function get_shipping_method($weight = NULL ,$country = NULL ,$user_id =NULL){
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

      $total =  $this->get_cart_total_price($user_id);

 

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

   public function get_cart_total_price($user_id){

    $price = 0 ;

    $this->db->where('user_id', $user_id);
    $result = $this->db->get('carts')->result();
    foreach ($result as $data) {

        $price += $data->quantity*$data->price;
        # code...
    }

    return $price ;

   }


     public function get_shipping_method_post(){

    $country_id = $this->post('country_id');
    $user_id = $this->post('user_id');
    $this->db->where('id', $country_id);
     $country_name = $this->db->get('countries')->row()->name;

     $shipping_method = $this->calculate_shipping($country_id ,$user_id , $country_name);
    $this->response($shipping_method, REST_Controller::HTTP_OK);


  }

     public function calculate_shipping($country_id ,$user_id, $country_name = NULL){

    $weight = $this->claculate_cart_weight($country_id ,$user_id);

    $id = $user_id;

    if($country_name != NULL){
         $country = $country_name;
    }

    elseif($id != NULL){

     $this->db->select('address.*,countries.name');
     $this->db->from('address');
     $this->db->join('countries', 'address.country = countries.id', 'left');
     $this->db->where('address.user_id', $id);
     $this->db->where('address.is_default', 'yes');
     $result = $this->db->get()->row();
     if($result){
       $country = $result->name ;
     }else{
      $country = $country_name;
     }

    }
   
    if($country){
    $shipping_method = $this->get_shipping_method($weight , $country , $user_id);
    }else{
      $shipping_method = array();
    }
    return $shipping_method;

   }



   public function claculate_cart_weight($user_id){
    $products = array() ;
    $weight = array();
     foreach ($this->product_m->get_db_cart($user_id) as $item){
      $products[]=$item->product_id;
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
     foreach ($this->product_m->get_db_cart($user_id) as $item){
        $id = $item->product_id;
       
          if($weight[$id]['weight'] == NULL){
            $net_weight = $net_weight + 0;
          }else{
            $net_weight= $net_weight + floatval($weight[$id]['weight'])*$item['qty'] ;
          }
     }
      return $net_weight;
   }


   public function save_order_post(){
  $cart_id= array();
        $quantity =  array();
        $user_id = $this->post('user_id');
       foreach ($this->product_m->get_db_cart($user_id) as $item){
        array_push($cart_id, $item->product_id);
        $quantity[$item->product_id] = $item->quantity ;
       }
       $quantity = json_encode($quantity);
       $products =  json_encode($cart_id);
       $first_name = $this->post('first_name');
       $last_name = $this->post('last_name');
       $user_phone =$this->post('user_phone');
       $email = $this->post('email');
       $user_country = $this->post('country');
       $user_city = $this->post('city');
       $user_state = $this->post('state');
       $address_one = $this->post('address_line_1');
       $address_two = $this->post('address_line_2');
       $add_info = $this->post('add_info');
       $zip = $this->post('zip');
       $shipping_method = $this->post('shippings_method');
       $shipping_price = $this->post('shipping_charge');
       $payment_method = $this->post('payment_method');
       $order_amount =  $this->post('order_amount');
       $data = array('billing_first_name' => $first_name ,'billing_last_name'=>$last_name,'billing_email' =>$email,'billing_country'=>$user_country,'billing_zip'=> $zip,'billing_state'=>$user_state ,'billing_city' =>$user_city,'billing_phone' => $user_phone,'billing_address_one'=>$address_one,'billing_address_two'=>$address_two,'quantity'=>$quantity,'additional_information'=>$add_info,'payment_method'=>$payment_method,'product_orderd'=>$products,'order_by'=>$user_id ,'order_amount'=>$order_amount,'shipping_charge'=> $shipping_price,'shipping_method' =>$shipping_method);
        $this->db->insert('orders', $data);
        $result = $this->db->insert_id();

        if($result){
            $this->db->where('user_id', $user_id);
            $this->db->delete('carts');
        }
       
        $this->response($result, REST_Controller::HTTP_OK);
   }

   public function update_order_status(){
        $id = $this->post('order_id');
        $payment_status  = $this->post('payment_status');
        $order_status = $this->post('order_status');
        $object = array('payment_status' => $payment_status, 'order_status' => $order_status);
      $this->db->where('id', $id);
      $this->db->update('orders', $object);
      $this->response("order updated Successfully", REST_Controller::HTTP_OK);
   }

   public function get_currencies_post(){
            $result = $this->db->get('currencies')->result();
            $this->response($result , REST_Controller::HTTP_OK);
   }

   public function get_currency_rate_post(){

    $currency = $this->post('currency');
    $amount = 1 ;
    $this->CurrencyConverter->convert('USD', $currency, $amount, 1, 1);
    $this->db->where('to', $currency);
    $result = $this->db->get('currency_converter')->row();
    $this->response($result , REST_Controller::HTTP_OK);


   }



}