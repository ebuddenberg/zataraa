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

	function __construct()

	    {

	header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
     header("Access-Control-Allow-Headers: *");
	        // Construct the parent class
	        parent::__construct();
	        $this->load->model('product_m');
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

	public function products_details_post(){

		$id = $this->post('id');
		$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->join('variation_product', 'variation_product.parent_id  = products.product_id','right outer');
		$this->db->where('products.product_id', $id);
		$result = $this->db->get()->result();
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


	public function categories_products_post(){
		$id = $this->post('id');
		$parent =  $this->post('parent');
		$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->join('variation_product', 'variation_product.parent_id  = products.product_id','left');
		$this->db->group_by('products.id');
		if($parent){
			$cats = $this->product_m->get_categories_by_parent($id);
			$this->db->where_in('products.categories_id', $cats);
		}else{
			$this->db->where('products.categories_id', $id);
		}
		

		$result = $this->db->get()->result();
		$this->response($result, REST_Controller::HTTP_OK);

	}



}