<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_m extends MY_Model {

	protected $_table_name = 'orders';
	protected $_order_by = 'id';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';

	function __construct(){
		parent::__construct();
	}

	public function orders($limit = NULL, $start = NULL){

		// $this->db->limit($limit, $start);
		$this->db->order_by('id', 'desc');
		$this->db->where('order_status','delivered');
		$result = $this->db->get('orders')->result();
		return $result;
	}
	public function orders_new($limit, $start){

		//$this->db->limit($limit, $start);
		//$data = array('order_status !='  => 'completed');
		$this->db->order_by('id', 'desc');
		$this->db->where('order_status !=', 'delivered');
		$result = $this->db->get('orders')->result();
		return $result;
	}
	public function orders_count(){
		 return $this->db->count_all('orders');
	}
	public function orders_new_count(){
		$this->db->where('order_status !=' ,'delivered');
		 return $this->db->count_all('orders');
	}

	public function order_status_view($id){
		$result = $this->get($id);
		return $result ;
	}
	public function update_orders(){
		$id = $this->input->post('id');
		$data = array('order_status' => $this->input->post('order_status'),
			'payment_status' => $this->input->post('payment_status'),
			'shipping_status' => $this->input->post('shipping_status') ,'tracking_link' =>  $this->input->post('tracking_link'));
		$result = $this->save($data,$id);
		return $result ;
	}

	public function get_total_order(){
		return $this->db->get('orders')->num_rows();
	}
	public function get_current_month_order(){
		$this->db->like('createdAt', date('Y-m'));
		return $this->db->get('orders')->num_rows();

	}

	public function get_today_order(){
		$this->db->like('createdAt', date('Y-m-d'));
		return $this->db->get('orders')->num_rows();
	}
	public function order_product_information($id){

		$result = $this->get($id);
		$products = $result->product_orderd ;
		$products = explode(",",$products);
		$variation = json_decode($result->orders_variation ,true);
		$this->db->select('products.* ,products.id as ids,product_images.*');
		$this->db->from('products');
		$this->db->join('product_images', 'products.id = product_images.product_id', 'left');
		$this->db->where('product_images.is_it_cover', 'yes');
		$this->db->where_in('products.id', $products);
		$results = $this->db->get()->result();
		$html = '<div class="row"> 
                     <div class="col-md-12"> 
                        
                     <div class="table-responsive">
                       <table class="table table-striped table-bordered">
                     <tbody>
                     <tr>
                     <th width="102">Product Image</th>
                     <th width="230">Product Details</th>
                     <th width="100">Size</th>
                     </tr>';
                     
		foreach ($results as $data) {
			$size = '';
			$product_variation = $variation[$data->ids];
			$product_size = $product_variation['size'];
				foreach ($product_size as $key => $value) {
					$size .= 'Size : '.$key.' : '.$value.'|';
				}
			$html.='<tr>
                     <td><img src="'.base_url().'/admin-assets/images/'.$data->image_name.'" width="100"></td>
                     <td id="txt_lname" >
                       <table class="table table-striped table-bordered">
                         <tr>
                           <td>Product Name ('.$data->product_name. '#'.$data->id.')</td>
                         </tr>
                         <tr>
                           <td>Color :<span style="background-color: '.$product_variation['color'].'" class="color_attrib"></span></td>
                         </tr>
                         <tr>
                           <td>
                             Style: '.$product_variation['style'].'
                           </td>
                         </tr>
                         <tr>
                           <td>
                             Fabric: '.$product_variation['fabric'].'
                           </td>
                         </tr>
                          
                       </table>
                     </td>
                     <td>
                      '.$size.'
                     </td>
                     </tr>';
		}

		$html .='</tbody>
                   </table>
                     </div>                                       
                   </div> 
              </div>';

      return $html ;


	}


	public function get_orders_details_by_ids(){
		$ids = $this->input->post('ids');
		$this->db->where_in('id', $ids);
		return $this->db->get('orders')->result();
	}
	
	public function get_shipped_order(){
		$this->db->where('order_status' ,'shipped');
		return $this->db->get('orders')->num_rows();
	}
	
    public function get_confirmed_order(){
		$this->db->where('order_status' ,'confirmed');
		return $this->db->get('orders')->num_rows();
	}
    public function get_processing_order(){
    		$this->db->where('order_status' ,'processing');
    		return $this->db->get('orders')->num_rows();
    	}
    public function get_on_hold_order(){
    		$this->db->where('order_status' ,'on_hold');
    		return $this->db->get('orders')->num_rows();
    	}
    public function get_completed_order(){
    		$this->db->where('order_status' ,'completed');
    		return $this->db->get('orders')->num_rows();
    	}
    public function get_cancelled_order(){
    		$this->db->where('order_status' ,'cancelled');
    		return $this->db->get('orders')->num_rows();
    	}
    public function get_refunded_order(){
    		$this->db->where('order_status' ,'refunded');
    		return $this->db->get('orders')->num_rows();
    	}
    public function get_failed_order(){
    		$this->db->where('order_status' ,'failed');
    		return $this->db->get('orders')->num_rows();
    	}
    public function get_delivered_order(){
    		$this->db->where('order_status' ,'delivered');
    		return $this->db->get('orders')->num_rows();
    	}
    public function get_order_amount(){
            $this->db->select_sum('order_amount');
            $this->db->from('orders');
    		$query=$this->db->get();

            return $query->row()->order_amount;  
    	}	
	
	

}

/* End of file Orders_m.php */
/* Location: ./application/models/Orders_m.php */