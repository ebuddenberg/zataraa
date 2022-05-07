<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_m extends CI_Model {

	protected $_table_name = 'carts';
	protected $_order_by = 'id';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';

	function __construct(){
		parent::__construct();
	}


	function validate_add_cart_item(){
     
	    $id = $this->input->post('product_id'); // Assign posted product_id to $id
	    $qty = $this->input->post('quantity'); // Assign posted quantity to $cty
	    $img = $this->input->post('image');
	    $this->db->where('id', $id); // Select where id matches the posted id
	    $query = $this->db->get('products', 1); // Select the products where a match is found and limit the query by 1
	     $num = $query->num_rows();
	    // Check if a row has matched our product id
	    if($num > 0){
	     
	    // We have a match!
	        foreach ($query->result() as $row)
	        {
	            // Create an array with product information
	            $data = array(
	                'id'      => $id,
	                'qty'     => $qty,
	                'price'   => $row->product_price,
	                'name'    => $row->product_name,
	                'img' => $img
	            );
	 
	            // Add the data to the cart using the insert function that is available because we loaded the cart library
	            $this->cart->insert($data); 
	             
	            return TRUE; // Finally return TRUE
	        }
	     
	    }else{
	        // Nothing found! Return FALSE! 
	        return $num;
	    }
	}
	function validate_update_cart(){
     
		// Get the total number of items in cart
		$total = $this->cart->total_items();
		 
		// Retrieve the posted information
		$item = $this->input->post('rowid');
		$qty = $this->input->post('qty');

		// Cycle true all items and update them
		for($i=0;$i < $total-1;$i++)
		{
		    // Create an array with the products rowid's and quantities. 
		    $data = array(
		       'rowid' => $item[$i],
		       'qty'   => $qty[$i]
		    );
 		    // Update the cart with the new information
		    $this->cart->update($data);
		}
	}
}

/* End of file Cart_m.php */
/* Location: ./application/models/Cart_m.php */