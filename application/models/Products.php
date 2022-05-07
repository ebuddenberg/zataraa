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
class Products extends REST_Controller {

	function __construct($config = 'rest')

	    {

	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
     header("Access-Control-Allow-Headers: *");
	        // Construct the parent class
	        parent::__construct();
	        $this->load->model('product_m');
	        $this->load->model('user_m');
	        $this->load->helper('string');
	        // Configure limits on our controller methods
	        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
	        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
	        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
	        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
	    }

	public function products_post(){

		$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->join('variation_product', 'variation_product.parent_id  = products.product_id','left');
		$this->db->group_by('products.id');
		$result = $this->db->get()->result();

		$this->response($result, REST_Controller::HTTP_OK);


	}

	public function products_rec_post(){

		$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->join('variation_product', 'variation_product.parent_id  = products.product_id','left');
		$this->db->group_by('products.id');
		$this->db->where('products.recomended', 'yes');
		$result = $this->db->get()->result();

		$this->response($result, REST_Controller::HTTP_OK);
	}


	public function update_profile_details_post(){
		$id = $this->post('user_id');
		$first_name = $this->post('first_name');
		$last_name = $this->post('last_name');
		$gender = $this->post('gender');
		$mobile = $this->post('mobile');

		$data = array('first_name'=>$first_name ,'last_name'=>$last_name,'gender'=>$gender ,'user_phone'=>$mobile);

		$this->db->where('user_id', $id);
		$this->db->update('users', $data);
		$result = 'success';
		$this->response($result, REST_Controller::HTTP_OK);
	}

	public function list_address_post(){
		$id = $this->post('user_id');
		$this->db->where('user_id', $id);
		$result = $this->db->get('address')->result();
		$this->response($result, REST_Controller::HTTP_OK);
	}

	public function update_address_post(){
		$user_id = $this->post('user_id');
		$id= $this->post('id');
		$first_name = $this->post('first_name');
		$last_name = $this->post('last_name');
		$email = $this->post('email');
		$phone_no = $this->post('phone_no');
		$country =  $this->post('country');
		$state = $this->post('state');
		$zip = $this->post('zip');
		$address_one = $this->post('address_one');
		$address_two = $this->post('address_two');
		$is_default = $this->post('is_default');
		if($id != ''){
			$data = array('first_name' => $first_name,'last_name'=> $last_name ,'email' => $email,'phone_no' => $phone_no,'country' => $country ,'state'=> $state ,'city' => $city ,'zip'=>$zip ,'address_one' =>$address_one ,'address_two' => $address_two ,'is_default' =>$is_default);

			$this->db->where('id', $id);
			$this->db->update('address', $data);

		}else{
			$data = array('first_name' => $first_name,'last_name'=>$last_name ,'user_id' =>$user_id ,'email' =>$email ,'phone_no' =>$phone_no ,'country' => $country ,'state'=> $state ,'city' => $city ,'zip'=>$zip ,'address_one' =>$address_one ,'address_two' => $address_two ,'is_default' =>$is_default);

			$this->db->insert('address', $data);
		}

	$result = 'success',
	$this->response($result, REST_Controller::HTTP_OK);

	}

	public function default_address_post(){
		$id = $this->post('user_id');
		$this->db->where('user_id', $id);
		$this->db->where('is_default', 'yes');
		$result = $this->db->get('address')->row();
		$this->response($result, REST_Controller::HTTP_OK);
	}

	public function about_us_get(){
		$this->db->where('id', 1);
		$result = $this->db->get('cms')->row();
		$this->response($result, REST_Controller::HTTP_OK);
	}

	public function order_list_post(){
		$id = $this->post('user_id');
		$orders = $this->user_m->get_orders($id);
        $result['orders'] =  $orders ;
        $variation_product =  array();
        foreach ($orders as $data) {
        	$array = json_decode($data->product_orderd);
        	$variation_product = array_merge($variation_product,$array);
        }
       $result['variation'] = $this->product_m->get_variation_product($variation_product);
	$this->response($result, REST_Controller::HTTP_OK);
	}

	public function support_post(){

	$email = $this->post('email');
	$subject = $this->post('subject');
	$message = $this->post('message');
	$this->email->from('info@zataraa.com', 'Zataraa');
	$this->email->to($email);

	$this->email->subject($subject);
	$this->email->message($message);
	$this->email->send();
	$result = 'success';
	$this->response($result, REST_Controller::HTTP_OK);

	}


	public function submit_review_post(){

	  $product_id = $this->post('product_id');
      $review = $this->post('review');
      $rating = $this->post('rating');
      $name = $this->input->post('names');
      $email = $this->input->post('email');

   	$data = array('name' =>$name , 'email' => $email ,'product_id' => $product_id ,'review' => $review ,'rating' => $rating);

   		$this->db->insert('reviews', $data);

      $this->db->where('product_id', $product_id);
      $this->db->select('AVG(rating) as ratings , count(id) as nos');

      $result = $this->db->get('reviews')->row();

      $datas = array('avg_ratings' => $result->ratings ,'count_ratings' => $result->nos );
      $this->db->where('product_id', $product_id);
      $this->db->update('products', $datas);
      $result = "success";
      $this->response($result, REST_Controller::HTTP_OK);

	}

	public function related_product_post(){

		$id = $this->post('id');
		$product_cats_id = $this->post('product_cats_id');

		$result = $this->product_m->get_related_product($product_cats_id , $id); 
 		$this->response($result, REST_Controller::HTTP_OK);

	}

	public function products_details_post(){

		$id = $this->post('id');
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where('product_id', $id);
		$result['products'] = $this->db->get()->result();

		$this->db->select('*');
		$this->db->from('variation_product');
		$this->db->where('parent_id', $id);
		$result['variatons'] = $this->db->get()->result();
		$this->response($result, REST_Controller::HTTP_OK);
	}


	public function parent_categories_post(){
    $result  = $this->product_m->gets_parent_cats();
    $this->response($result, REST_Controller::HTTP_OK);
	}

	public function child_categories_post(){
		$result =$this->product_m->gets_category();
		$this->response($result, REST_Controller::HTTP_OK);
	}


	public function cats_by_id_post(){
		$id = $this->post('id');
		$result =$this->product_m->get_subchild_cats_details($id);
		$this->response($result, REST_Controller::HTTP_OK);
	}

	public function cats_post(){

		$result = $this->db->get('product_categories')->result();
		$this->response($result, REST_Controller::HTTP_OK);
	}

	public function add_to_cart_post(){
		$user_id = $this->post('userid');
		$id = $this->post('sku');
		$qty = $this->post('qty');
		$image = $this->post('image');
		$name =  $this->post('name');
		$price =  $this->post('price');

		$data = array('id'=>$id,'qty'=>$qty,'price'=>$price,'name' => $name,'image'=> $image);
		 $this->product_m->insert_db_cart($data ,$user_id);
		 $this->response("success", REST_Controller::HTTP_OK);

	}

	public function get_add_to_cart_post(){
		$user_id = $this->post('userid');
		
		 $result = $this->product_m->get_db_cart($user_id);
		$this->response($result, REST_Controller::HTTP_OK);
	}


	public function categories_products_post(){
		$id = $this->post('id');

		$cats =  $this->product_m->get_subchild_cats($id);
		$parent =  $this->post('parent');
		$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->join('variation_product', 'variation_product.parent_id  = products.product_id','left');
		$this->db->group_by('products.id');
		if(is_array($cats)){
			$this->db->where_in('products.categories_id', $cats);
		}else{
			$this->db->where('products.categories_id', $id);
		}
		$result = $this->db->get()->result();
		$this->db->group_by('products.id');
		$this->response($result, REST_Controller::HTTP_OK);

	}





}