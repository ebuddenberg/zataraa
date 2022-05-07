<?php 
class Product_m extends MY_Model {
	protected $_table_name = 'products';
	protected $_order_by = 'id';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';

	function __construct(){
		parent::__construct();
		$this->load->helper("file");
		include ''.APPPATH.'libraries/Requests.php';
		Requests::register_autoloader();
	}
	public  $rules = array(
			'product_name' => array(
					'field' => 'product_name', 
					'label' => 'product_name', 
					'rules' => 'trim|required'
			), 
			'sku' => array(
				'field' => 'sku', 
				'label' => 'sku', 
				'rules' => 'trim|required'
			), 
			'price' => array(
				'field' => 'price', 
				'label' => 'price', 
				'rules' => 'trim'
			)
		);
	public function get_country(){
		return $this->db->get('countries')->result();
	}

	 public function get_states(){
   
    return $this->db->get('states')->result();
    

   }

   public function get_citys(){
   
    return $this->db->get('cities')->result();
    
   }

   public function count_t_product(){

   	$query = $this->db->get('products');
	return  $query->num_rows();
   }
   public function count_t_users(){

   	$query = $this->db->get('users');
	return  $query->num_rows();
   }

   public function  currency_code_symbol(){
   		$this->db->group_by('code');
   		$result = $this->db->get('currencies')->result();
   		$results = array();
   		foreach ($result as $data) {

   			$results[$data->code] = $data->symbol ;  
   			# code...
   		}
   		return $results; 
   }

   public function get_currencies(){
   	$this->db->group_by('code');
   return 	$this->db->get('currencies')->result();
   }
   public function count_t_orders(){

   	$query = $this->db->get('orders');
	return  $query->num_rows();
   }
   public function count_t_reviews(){

   	$query = $this->db->get('reviews');
	return  $query->num_rows();
   }

   public function get_reviews(){

    $this->db->select('reviews.*, products.product_name, products.product_sku');
	$this->db->join('products', 'products.product_id = reviews.product_id', 'left');
   return $this->db->get('reviews')->result();

   }

   public function get_reviews_by_product($product_id){

   		$this->db->where('product_id', $product_id);
   		$this->db->where('status','active');
return $this->db->get('reviews')->result();
   }
	public function products_img($ids){
		$images = array();
		$this->db->select('*');
		$this->db->from('product_images');
		if(is_array($ids) && !empty($ids)){
				$this->db->where_in('product_id', $ids);
		}

		if(!is_array($ids)){
			$this->db->where('product_id', $ids);
		}
		$result = $this->db->get()->result();
		foreach ($result as $data) {
			$images[$data->product_id][] = array('image' => $data->image_name,'is_it_cover'=>$data->is_it_cover);
		}

		return $images ;
	}
	public function g_setting(){
		$this->db->where('id', '1');
		return $this->db->get('general_seeting')->row();

	}

	public function get_categories_by_sub_child($cat = NULL){



		$cats = array();

		$this->db->select('cats_id');
		$this->db->from('product_categories');
		$this->db->where('parent_id', $cat);
		$result = $this->db->get()->result();

		foreach ($result as $data) {
			$cats[] = $data->cats_id ;
		}
			return $cats;

	}
	public function get_categories_by_parent($cat = NULL){

		$cats = array();

		$this->db->select('cats_id');
		$this->db->from('product_categories');
		$this->db->where('parent_id', $cat);
		$result = $this->db->get()->result();

		foreach ($result as $data) {
			$cats[] = $data->cats_id ;
		}
		$cats_array = array();
		if(!empty($cats)){

		$this->db->select('cats_id');
		$this->db->where_in('parent_id', $cats);
		$results = $this->db->get('product_categories')->result();
		
		foreach ($results as $data) {
			$cats_array[] = $data->cats_id ;
		}
		return $cats_array  ;
		}else{
		return $cats;
		}


	}

	public function save_order(){
    	$cart_id= array();
    	$quantity =  array();
	   foreach ($this->cart->contents() as $item){
	    array_push($cart_id, $item['id']);
	    $quantity[$item['id']] = $item["qty"] ;
	   }
	   $quantity = json_encode($quantity);
	   $products =  json_encode($cart_id);
	   $first_name = $this->input->post('first_name');
	   $last_name = $this->input->post('last_name');
	   $user_phone =$this->input->post('user_phone');
	   $email = $this->input->post('email');
	   $user_country = $this->input->post('country');
	   $user_city = $this->input->post('city');
	   $user_state = $this->input->post('state');
	   $address_one = $this->input->post('address_line_1');
	   $address_two = $this->input->post('address_line_2');
	   $add_info = $this->input->post('add_info');
	   $zip = $this->input->post('zip');
	   $shipping_method = $this->input->post('shippings_meth');
	   $shipping_price = $this->input->post('shipping_method');
	   $payment_method = $this->input->post('payment_method');
	   $user_id = $this->session->userdata('id');
	   $order_amount =  $this->frontend_m->convert($this->cart->total()) + $shipping_price;
	   
	    if($this->input->post('balance')){
        $balance = $this->input->post('balance');
        
        if($order_amount > $this->frontend_m->convert($balance)){
        $order_amount= $order_amount - $this->frontend_m->convert($balance);
        $updateData=array("balance"=>0);
        }else{
          $order_amount= $this->frontend_m->convert($balance) - $order_amount;  
          $updateData=array("balance"=> $this->frontend_m->convert($balance) - $order_amount);
        }
        
        $this->db->where('id', $user_id);
    	$this->db->update('users',$updateData);
        }
        if($this->input->post('promo_price')){
        $promoPrice = $this->input->post('promo_price');
        $order_amount = $order_amount - $this->frontend_m->convert($promoPrice) ;
        }
        
        if($this->input->post('promo_code_id')){
            $promoCode = $this->input->post('promo_code_id');
        }else{
            $promoCode = 0;
        }
	   $data = array('billing_first_name' => $first_name ,'billing_last_name'=>$last_name,'billing_email' =>$email,'billing_country'=>$user_country,'billing_zip'=> $zip,'billing_state'=>$user_state ,'billing_city' =>$user_city,'billing_phone' => $user_phone,'billing_address_one'=>$address_one,'billing_address_two'=>$address_two,'quantity'=>$quantity,'additional_information'=>$add_info,'payment_method'=>$payment_method,'product_orderd'=>$products,'order_by'=>$user_id ,'order_amount'=>$order_amount,'shipping_charge'=> $shipping_price,'shipping_method' =>$shipping_method, 'promo_code'=>$promoCode);
	    $this->db->insert('orders', $data);
	  	$result = $this->db->insert_id();
		
	   
		return $result ;

	}


	public function get_subchild_cats($id){
		$cats = array();
		$this->db->where('cats_id',$id);
		$result = $this->db->get('product_categories')->row();

		if($result->parent_id == ""){
			$cats = $this->get_categories_by_parent($id);
			return $cats ;

		}else{
			$this->db->where('parent_id',$id);
			$result = $this->db->get('product_categories')->result();

			if(count($result) > 0){

				foreach ($result as $data) {
					# code...
					$cats[] = $data->cats_id;
				}

				return $cats;

			}else{

				return $id ;
			}
		}
	}

		public function get_subchild_cats_details($id){
			
		$cats = array();
		$this->db->where('cats_id',$id);
		$result = $this->db->get('product_categories')->row();

		if($result->parent_id == ""){
			$this->db->where('parent_id',$id);
			$cats = $this->db->get('product_categories')->result();
			return $cats ;

		}else{
			$this->db->where('parent_id',$id);
			$result = $this->db->get('product_categories')->result();

			if(count($result) > 0){

				
				return $result;

			}else{
	
				$this->db->where('cats_id',$id);
				$result = $this->db->get('product_categories')->row();
				return $result ;
			}
		}
	}

	public function get_address( $ids = NULL){

		$id = $this->session->userdata('id');

		$this->db->where('user_id', $id);
		if($ids){
			$this->db->where('id', $ids);
			return $this->db->get('address')->row();
		}else{
			return $this->db->get('address')->result();
		}
		
		
	}

	public function get_order_details($id = NULL){

		$this->db->select('orders.*,orders.id order_id,countries.*, countries.sortname countryCode,countries.name country_name, states.*, states.name province,cities.* , cities.name city_name');
		$this->db->from('orders');
		$this->db->join('countries', 'orders.billing_country = countries.id', 'left');
		$this->db->join('states', 'orders.billing_state = states.id', 'left');
		$this->db->join('cities', 'orders.billing_city = cities.id', 'left');
		$this->db->where('orders.id',$id);

		return  $this->db->get()->row();

	}

	public function get_orderd_product($products){

		$var = json_decode($products) ;
		$this->db->select('variation_product.*,products.product_name,products.comission,products.product_offer');
		$this->db->from('variation_product');
		$this->db->join('products', 'variation_product.parent_id = products.product_id', 'left');
		$this->db->where_in('variation_product.sku', $var);
		return $this->db->get()->result();
	}

	public function get_variation_product($id = NULL){


		$this->db->select('variation_product.*,products.product_name,products.product_name,products.product_offer,products.comission');
		$this->db->from('variation_product');
		$this->db->join('products', 'variation_product.parent_id = products.product_id', 'left');
		if($id){
				$this->db->where_in('variation_product.sku',$id);
		}
	
		$result = $this->db->get()->result();
		$products = array();

		foreach ($result as $data) {
			# code...
			$products[$data->sku] = $data ;
		}

		return $products;

	}

	public  function products_price($ids){
 
		$prices = array();
		$this->db->select('price,parent_id');
		$this->db->from('variation_product');
		if(is_array($ids) && !empty($ids)){
				$this->db->where_in('parent_id', $ids);
		}

		if(!is_array($ids)){
			$this->db->where('parent_id', $ids);
		}
		$result = $this->db->get()->result();
		foreach ($result as $data) {
			
			$prices[$data->parent_id] = $data->price;
		}

		return $prices ;
	}

	public function get_product(){

		$cats = $this->input->get('cats');
		$search = $this->input->get('s');
		$this->db->select('*');
		$this->db->from('products');
		if($cats && $cats !=''){
			$this->db->like('product_categories', $cats, 'BOTH');
		}
		if($search && $search != '' ){
			$this->db->like('product_name', $search, 'BOTH');
		}
		return $this->db->get()->result();
	}

	public function get_variable_product($id = NULL){

		$this->db->select('*');
		$this->db->from('variation_product');
		$this->db->where('parent_id', $id);
		return $this->db->get()->result();
		
	}

	public function apply_discount_discount(){


		$min_price = $this->input->get('min_price');
		$max_price = $this->input->get('max_price');
		$discount =$this->input->get('discount');

		$this->db->select('parent_id');
		$this->db->from('variation_product');
		$this->db->where('price >=', $min_price);
		$this->db->where('price <=', $max_price);
		$result = $this->db->get()->result();
		$products = array();
		foreach ($result as $data) {

			$products[] = $data->parent_id;
			# code...
		}

		$products = array_unique($products);

		$this->db->where_in('product_id', $products);
$now = date('Y-m-d H:i:s');
		$data = array('product_offer' => $discount,'updatedAt'=>$now );

		$this->db->update('products', $data);


		$this->db->where_in('product_id', $products);	
		return $this->db->get('products')->result();






	}

		public function apply_margin_discount(){


		$min_price = $this->input->get_post('min_price');
		$max_price = $this->input->get_post('max_price');
		$discount =$this->input->get_post('discount');

		$this->db->select('*');
		$this->db->from('variation_product');
		$this->db->where('price >=', $min_price);
		$this->db->where('price <=', $max_price);
		$result = $this->db->get()->result();
		$products = array();
		foreach ($result as $data) {

			$products[] =$data->parent_id;
			# code...
		}

		$products = array_unique($products);

		$this->db->where_in('product_id', $products);
	
		$data = array('comission' => $discount);

		$this->db->update('products', $data);
		return $this->db->get('products')->result();






	}


	public function product_details($slug){

			$this->db->select('*');
		$this->db->from('products');
		$this->db->where('slugs',$slug);
		$result = $this->db->get()->row();
		return $result ;

	}
	public function get_cats_name($id = NULL){
		$this->db->where('cats_id', $id);
		$result = $this->db->get('product_categories')->row();
		if($result){
			return $result->categories_name ;
		}else{
			return '' ;
		}
		
	}
	public function add_product ($id = NULL){	

			$cats = $this->input->post('product_categories');
			foreach($cats as $categoriesItem){
			    $cats_name[] = $this->get_cats_name($categoriesItem);
			}
// 			$cats_name = $this->get_cats_name($cats);
			$commodityDifferenceOption = $this->input->post('commodityDifferenceOption');
			if($commodityDifferenceOption == NULL){
				$commodityDifferenceOption = array();
			}else{
				$commodityDifferenceOption = explode(',', $commodityDifferenceOption);
			}

			$commodityDifferenceOption = json_encode($commodityDifferenceOption);
          $id = $this->input->post('product_id');
            $name = $this->input->post('product_name');
			$url = strtolower($name);
            $slugs = preg_replace('~[^\pL\d]+~u ', '-', $url);
            $this->db->where('slugs',$slugs);
            $query = $this->db->get('products');
		    if ($query->num_rows() > 0){
		    	if($id != ""){
		    		 $slug =$slugs;
 		           }
		         else{
		           	$slug = $slugs.mt_rand(10,20);
		           }
		    }
		    else{
		        $slug =$slugs;
		    }
		
		if($id == ""){
			$id = NULL;
		}
		foreach($cats as $categoriesItem){
		$product = $this->save(array(
			'product_name' => $this->input->post('product_name'),
			'product_sku' => $this->input->post('sku'),
			'product_price' => $this->input->post('price'),
			'product_offer' => $this->input->post('product_offer'),
			'comission' => $this->input->post('comission'),
			'product_quantity' => $this->input->post('quantity'),
			'product_long_disc' => $this->input->post('description'),
			'product_short_disc'  => $this->input->post('description_short'),
			'categories_id' => $categoriesItem,
			'commodityDifferenceOption' => $commodityDifferenceOption,
			'product_categories' => $this->get_cats_name($categoriesItem) ,
			'product_brand' =>$this->input->post('brand')
		), $id);
		}

		return $product ;
	}
	public function update_shipping(){
		$id = $this->input->post('product_id');
		if($id == ""){
			$id = NULL;
		}
		$product = $this->save(array(
			'product_weight' => $this->input->post('weight')		
		), $id);

		return $product ;
	}

	public function save_upload($id , $image)
	{

		$this->db->select('*');
		$this->db->where('product_id', $id);
		$count = $this->db->count_all_results('product_images');

		if($count == 0){
			$cover = 'yes';
		}else{
			$cover = 'no';
		}
		$data = array(
				'id' => '',
	        	'product_id' 	=> $id,
	        	'image_name' => $image,
	        	'is_it_cover' => $cover,
	        	'createdAt' => '',
	        	'updatedAt' => ''
	       	);  
	    $result= $this->db->insert('product_images',$data);

	    echo $image;
	}
	public function update_categories($data = NULL ,$id = NULL){
		if($id == NULL){
			$result= $this->db->insert('product_categories',$data);
	    	return $result;
		}else{
			$this->db->set($data);
			$this->db->where('id', $id);
			$result = $this->db->update('product_categories'); 
			return $result ;
		}
	}
	public function get_categories($limit, $start)
	{	$this->db->limit($limit, $start);
		$result = $this->db->get('product_categories')->result();
		return $result ;
	}
	public function get_products($limit = NULL, $start = NULL)
	{	$this->db->limit($limit, $start);
		$product_cats = $this->input->get('product_categories');
		$key = $this->input->get('s');
		if($product_cats){
			$this->db->where('categories_id', $product_cats);
		}
		if($key){
			$this->db->like('product_name', $key, 'BOTH');
		}
		$result = $this->db->get('products')->result();
		return $result ;
	}

	public function get_cats_products($limit, $start)
	{	$this->db->limit($limit, $start);
		$product_cats = $this->input->get('cats');
		$key = $this->input->get('s');

		$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
		if($product_cats != ''){
			$parent_cats = $this->get_categories_by_parent($product_cats);
			if(!empty($parent_cats)){
				$this->db->where_in('products.categories_id', $parent_cats);
			}
			
		}
		if($key){
			$this->db->like('products.product_name', $key, 'BOTH');
		}
		$this->db->group_by('products.product_id');
		$result = $this->db->get()->result();
		return $result ;
	}

	public function get_product_cats($limit, $start)
	{

		$parent = $this->input->get('parent');
		$product_cats = $this->uri->segment(2);

		
		if(!$product_cats){
			$product_cats = $this->input->get_post('cats');
		}
		if($product_cats != ''){
		$slugs = str_replace("----", ' & ', $product_cats);
		$slugs = str_replace("---", "'", $slugs); 
		$slugs = str_replace('--', ', ', $slugs);
		$slugs = str_replace('_'," ", $slugs);
		$this->db->where('categories_name', $slugs);
		$product_cats = $this->db->get('product_categories')->row()->cats_id;
		$sub_child = $this->input->get('sub_child');
		$cats = array();
		if($sub_child == TRUE){
		$cats = $this->get_categories_by_sub_child($product_cats);
		}
		if($parent == TRUE){
		  $cats = $this->get_categories_by_parent($product_cats);
		}

		}


		$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
		$this->db->limit($limit, $start);
		if($product_cats != ''){
		if(!empty($cats)){
			$this->db->where_in('products.categories_id', $cats);
			
		}elseif($product_cats){
			$this->db->where('products.categories_id', $product_cats);
		}
	}
		$this->db->group_by('products.product_id');

		$result = $this->db->get()->result();
		return $result ;
	}



	public function get_brands(){
		$brand = array();
		$result = $this->db->get('brand')->result();

		foreach ($result as $data) {
			$brand[$data->brand_name] = $data->brand_name ; 
		}

		return $brand ;


	}
	public function get_p_size_list($limit, $start){
       $this->db->limit($limit, $start);
		$result = $this->db->get('product_size')->result();
		return $result ;
	}
    public function psize_count(){
		 return $this->db->count_all('product_size');
	}
	public function categories_view($id){
		$this->db->select('*');
		$this->db->from('product_categories');
		$this->db->where('id', $id);
		$result = $this->db->get()->row();
		return $result ;
	}
	public function delete_cats($id){
		$this->db->limit(1);
		$this->db->where('id', $id);
		$this->db->delete('product_categories');
	}
	public function delete_psize($id){
		$this->db->where('id', $id);
		$this->db->delete('product_size');
	}
	public function cats_count(){
		 return $this->db->count_all('product_categories');
	}
	public function product_count(){
		$product_cats = $this->input->get('id');
		if($product_cats){
			$this->db->where('categories_id', $product_cats);
		}
		 return $this->db->count_all('products');
	}
	public function shipping_method_count(){
		return $this->db->count_all('shipping_method');
	}
	public function attributes_count(){
		 return $this->db->count_all('attributes');
	}
	public function attributes($limit, $start)
	{	
		$this->db->limit($limit, $start);
		$result = $this->db->get('attributes')->result();
		return $result ;
	}
	public function attributes_view($id = NULL){
		$this->db->where('id', $id);
		$result = $this->db->get('attributes')->row();
		return $result ;
	}
	public function delete_attribute($id){
		$this->db->limit(1);
		$this->db->where('id', $id);
		$this->db->delete('attributes');
	}
	public function add_attributes()
	{
		$data = array(
			'attributes_name' => $this->input->post('attributes_name'), 
			'attribute_type' =>$this->input->post('attribute_type'),
			'attribute_value' => $this->input->post('attribute_value'),
			'createdAt' =>'',
			'updatedAt' =>''
	);
		$result = $this->db->insert('attributes', $data);
		return $result ;
	}
	public function update_attributes(){
		$id = $this->input->post('id');
		$data = array(
			'attributes_name' => $this->input->post('attributes_name'), 
			'attribute_type' =>$this->input->post('attribute_type'),
			'attribute_value' => $this->input->post('attribute_value')
		);
			$this->db->set($data);
			$this->db->where('id', $id);
			$result = $this->db->update('attributes'); 
			return $result ;
	}
	public function shipping_method($limit, $start){
		$this->db->limit($limit, $start);
		$result = $this->db->get('shipping_method')->result();
		return $result ;
	}
	public function add_shipping_method(){

		$data  = array(
			'shipping_class' => $this->input->post('shipping_class'), 
			'shipping_method' => $this->input->post('shipping_method'),
			'min_weight' => $this->input->post('min_weight'),
			'max_weight' => $this->input->post('max_weight'),
			'price_per_kg' => $this->input->post('price_per_kg'),
			'country' => $this->input->post('country')
		);

		$this->db->insert('shipping_method', $data);
	}
	public function shipping_method_view($id){
		 $this->db->where('id', $id);
		 $result = $this->db->get('shipping_method')->row();
		 return $result ;
	}

	public function shipping_method_delete($id = NULL){
		$this->db->limit(1);
		$this->db->where('id', $id);
		$this->db->delete('shipping_method');
	}
	public function variable_product($id){

		$this->db->select('*');
		$this->db->from('variation_product');
		$this->db->where('parent_id', $id);
		return $this->db->get()->result();
	}

	public function product_info(){
		$id = $this->uri->segment(4);
		$result = $this->get($id);
		return $result;
	}
	public function get_category(){

		$cats  = array();

		$result = $this->db->get('product_categories')->result();
		foreach ($result as $data) {
			$cats[$data->cats_id] = $data->categories_name;
		}
		return $cats;
	}

	public function home_setting(){
		$this->db->where('id','1');
		return $this->db->get('home_page_setting')->row();
	}
	public function get_imp_category(){

		$cats  = array();
		$this->db->where('parent_id !=', '');
		$result = $this->db->get('product_categories')->result();
		foreach ($result as $data) {
			$cats[$data->cats_id] = $data->categories_name;
		}
		return $cats;
	}

	public function gets_category(){

	
		$this->db->where('parent_id !=', '');
		$result = $this->db->get('product_categories')->result();
		
		return $result;
	}

	public function get_imp_parent_cats(){
		$cats  = array();
		$this->db->where('parent_id', '');
		$result = $this->db->get('product_categories')->result();
		foreach ($result as $data) {
			$cats[$data->cats_id] = $data->categories_name;
		}
		return $cats;

	}
	public function gets_parent_cats(){
		
		$this->db->where('parent_id', '');
		$this->db->order_by('cats_seq', 'ASC');
		$result = $this->db->get('product_categories')->result();
		
		return $result;

	}

	public function get_db_cart($user_id){

		$this->db->where('user_id',$user_id);
		return $this->db->get('carts')->result();

	}

	public function insert_db_cart($data ,$userid = NULL){

		if($userid == NULL){

			$id = $this->session->userdata('id');

		}else{

			$id = $userid ;
		}
		

		$this->db->where('user_id',$id);
		$this->db->where('product_id',$data['id']);
		$result = $this->db->get('carts')->result();

		if(count($result) > 0){
			$quantity =  $result[0]->quantity + $data['qty'] ;
			$datas = array('quantity' => $quantity);
			$this->db->where('user_id',$id);
			$this->db->where('product_id',$data[$id]);
			$this->db->update('carts', $datas);
		}else{

			$datas = array('user_id' => $id ,'product_id' => $data['id'] ,'quantity' => $data['qty'],'image' =>$data['image'] ,'price' =>$data['price'] ,'product_name'=>$data['name']);
			$this->db->insert('carts', $datas);
		}

	}

	public function delete_cart_product($id ,$userid){

		$this->db->where('product_id', $id);
		$this->db->where('user_id', $userid);
		$this->db->delete('carts');

	}

	public function update_cart_quantity($id , $userid ,$qty){

		$this->db->where('user_id', $userid);
		$this->db->where('product_id', $id);
		$data = array('quantity' => $qty);

		$this->db->update('carts', $data);

	}

	public function db_delete_cart($id = NULL){
		$this->db->where('user_id', $id);
		$this->db->delete('carts');
	}
	public function get_allcategory(){
 		$result = $this->db->get('product_categories')->result();
 		return $result;
	}

	public function get_color(){

		$color  = array();
		$this->db->where('attribute_type', 'color');
		$result = $this->db->get('attributes')->result();
		foreach ($result as $data) {
			$color[$data->attribute_value] = $data->attributes_name;
		}
		return $color;
	}

	public function get_size(){

		$size =  array();

		$this->db->where('attribute_type', 'size');
		$result = $this->db->get('attributes')->result();
		foreach ($result as $data) {
			$size[$data->attribute_value] = $data->attributes_name ;
		}
		return $size;
	}

	public function get_attributes(){

		$this->db->select('commodityDifferenceOption');
		$this->db->from('products');
		$this->db->get()->result();

	}

	public function get_style(){

		$style = array();
		$this->db->where('attribute_type', 'style');
		$result = $this->db->get('attributes')->result();
		foreach ($result as $data) {
			$style[$data->attribute_value] = $data->attributes_name;
		}
		return $style;
	}

	public function product_images(){

		$id = $this->uri->segment(4);

		$this->db->select('*');
		$this->db->from('product_images');
		$this->db->where('product_id', $id);
		$result = $this->db->get()->result();
		return $result ;
	}

	public function product_image_delete($id = NULL){

		$this->db->where('id', $id);
		$result = $this->db->get('product_images')->row();
		$image = $result->image_name ;
		$path_to_file = './admin-assets/images/'.$image.'';
			if(unlink($path_to_file)) {
			     $this->db->where('id', $id);
				 $this->db->delete('product_images');
			}
	}

	public function product_image_update($id = NULL , $product_id = NULL){
		$data = array('is_it_cover' => 'no');
		$this->db->set($data);
		$this->db->where('product_id' ,$product_id);
		$result = $this->db->update('product_images');
		if($result){
			$data = array('is_it_cover' => 'yes');
			$this->db->set($data);
			$this->db->where('id' ,$id);
			$result = $this->db->update('product_images');
		}

	}

	public function delete($id = NULL){
		
		$this->db->where('id', $id);
		$this->db->delete('products');
	}
	public function delete_specific(){

		$ids = $this->input->post('ids');
		foreach ($ids as $data) {
			$this->db->where('product_id', $data);
			$this->db->delete('products');
		}
		foreach ($ids as $data) {
			$this->db->where('parent_id', $data);
			$this->db->delete('variation_product');
		}
		


	}
	public function add_psize()
	{
		$data = array( 'size_name' => $this->input->post('size_name1'), 
			'selected_cate' => implode(',',$this->input->post('cate_id1[]')),
			'category_name' => implode(',',$this->input->post('size_cat_name1[]')), );
		$result = $this->db->insert('product_size', $data);

		return "Successfully added" ;
	}
	public function size_view()
	{
		 $id = $this->uri->segment(4);
		 $this->db->where('id', $id);
         $result = $this->db->get('product_size')->row();
	     return $result ;
	}
	public function update_roductSize(){
		 $id = $this->input->post('size_id1');
		     $data = array( 'size_name' => $this->input->post('psize_name'), 
			
			'category_name' => implode(',',$this->input->post('cate_name[]')), );
		    $this->db->where('id', $id);
		    $this->db->update('product_size',$data);
	}
	public function get_size_size_list($limit, $start)
	{	$this->db->limit($limit, $start);
		$result = $this->db->get('size_chart')->result();
		return $result ;
	}
	public function csize_count(){
		 return $this->db->count_all('size_chart');
	}
	public function delete_csize($id){
 		$this->db->where('id', $id);
		$this->db->delete('size_chart');
 	}
 	public function add_csize($img)
	{	
 		$data =  array(
			'chart_name' => $this->input->post('csize_name'),
			'images' => $img, ) ;
		$result = $this->db->insert('size_chart', $data);
		return $result;
	}
	public function csize_view()
	{
		 $id = $this->uri->segment(4);
		 $this->db->where('id', $id);
         $result = $this->db->get('size_chart')->row();
	     return $result ;
	}
	public function update_csize($id = NULL,$imgs = NULL)
	{

		    
		if($imgs != ""){
			 
  		   $data =  array(
			'chart_name' => $this->input->post('csize_name'),
			'images' => $imgs, ) ;
  		   $this->db->where('id',$id);
 		if ($this->db->update('size_chart',$data)) {

			return TRUE ;

		}
		else{
			return FALSE ;
		}
	}else{
		$data =  array( 'chart_name' => $this->input->post('csize_name')) ;
		$this->db->where('id',$id);
         
		if ($this->db->update('size_chart',$data)) {
			return TRUE ;
		}
		else{
			return FALSE ;
		}
	}
	}
	public function get_size_chart(){

		$result = $this->db->get('size_chart')->result();
		return $result ;
	}
	public function menu_count(){
		return $this->db->count_all('menus');
	}
	public function get_menu_list($limit, $start)
	{	$this->db->limit($limit, $start);
		$result = $this->db->get('menus')->result();
		return $result ;
	}
    public function delete_menus($id){
 		$this->db->where('id', $id);
		$this->db->delete('menus');
 	}
 	public function add_menu(){
 		$data = array( 'main_heading' => $this->input->post('main_menu'), 
			'parent_menu' => $this->input->post('parent') );
		$result = $this->db->insert('menus', $data);
 	}
 	public function menu_view()
	{
		 $id = $this->uri->segment(4);
		 $this->db->where('id', $id);
         $result = $this->db->get('menus')->row();
	     return $result ;
	}
	public function update_menu(){
		$id = $this->input->post('menuid');
		if($id == ""){
			$id = NULL;
		}
		$data =  array( 'main_heading' => $this->input->post('main_menu1'),
	'parent_menu' => $this->input->post('parent')) ;
		$this->db->where('id',$id);
         
		if ($this->db->update('menus',$data)) {
			return TRUE ;
		}
		else{
			return FALSE ;
		}
	}
	public function childmenu_count(){
		return $this->db->count_all('child_menus');
	}
	public function get_childmenu_list($limit, $start)
	{	$this->db->limit($limit, $start);
		$result = $this->db->get('child_menus')->result();
		return $result ;
	}
	public function delete_childmenu($id){
 		$this->db->where('id', $id);
		$this->db->delete('child_menus');
 	}
 	public function parentmenu_view(){
 		 $main = $this->uri->segment(4);
 		 $mainmenu = urldecode($main);
 		 $results = "";
		 $this->db->where('main_heading	',  $mainmenu);
         $result = $this->db->get('menus')->result();
         foreach ($result as  $value) {
         	 $results .= '<option value="'.$value->parent_menu.'">'.$value->parent_menu.'</option>';
         }
	     return $results ;
 	}
 	public function add_submenu(){
 		    $name = $this->input->post('sub_menu');
			$url = strtolower($name);
            $slugs = preg_replace('~[^\pL\d]+~u ', '-', $url);
 		$data = array( 
 			'main_menus' => $this->input->post('main_menu'), 
			'parent_menus' => $this->input->post('parent'), 
			'children_menus' => $this->input->post('sub_menu'), 
			'cate_id' => $slugs, 
		   );
		$result = $this->db->insert('child_menus', $data);
 	}

 	public function get_product_id_by_slug($slug){
 	    $slugs = str_replace("----", ' & ', $slug);
		$slugs = str_replace("---", "'", $slugs); 
		$slugs = str_replace('--', ', ', $slugs);
	    $slugs = str_replace("___", ' + ', $slugs);
		$slugs = str_replace('_'," ", $slugs);
 		$this->db->select('*');
 		$this->db->like('product_name', $slugs);
 		return $this->db->get('products')->row();

 	}

 	public function get_product_details($id){

 		$this->db->select('products.*, products.commodityDifferenceOption commodityDifference,variation_product.*');
 		$this->db->from('products');
 		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
 		$this->db->where('products.id', $id);

 		return $this->db->get()->row();
 	}


 	public function get_product_api_checked($checked = null , $product_id = null){

 	if($checked == 'no'){
 				$headers = array('CJ-Access-Token' => 'eb47bdcce2f44800a21baa2300110d4c','Content-Type' => 'application/json');
	$data = json_encode(array('pid'=>$product_id));
	$request = Requests::post('https://developers.cjdropshipping.com/api/commodity/detail', $headers,$data);

	
	
if(json_decode($request->body)->code){
$product =  json_decode($request->body)->data;
	foreach ($product->stanProducts as $data) {

		$datas = array('v_id' =>$data->ID );
		$this->db->where('sku',$data->SKU);
		$this->db->update('variation_product', $datas);
		
	}

	$data = array('api_called' =>'yes' );
	$this->db->where('product_id',$product_id);
	$this->db->update('products', $data);

 	}
 	
 	}
}

 	public function history($cats_id){

 		$this->db->select_max('page_no');
 		$this->db->where('cats_id', $cats_id);
 		$result = $this->db->get('product_import_history')->row();
 		
 		if($result){
 			$page_no = $result->page_no +1 ;
 			$data = array('cats_id'=>$cats_id ,'page_no'=>$page_no);
 			$this->db->insert('product_import_history', $data);
 			
 		}

 		return $page_no ;
 	}

 	public function get_related_product($cats = NULL , $id){
 		if($cats == NULL)
 		{
 			$cats= array();
 		}
 		$cats = explode(',', $cats);

 		$this->db->select('products.*,variation_product.*');
 		$this->db->from('products');
 		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
 		foreach($cats as $key => $value) {
		if($key == 0) {
		        $this->db->like('products.product_categories', $value, 'BOTH');
		    } else {
		        $this->db->or_like('products.product_categories', $value, 'BOTH');
		    }
		}
		$this->db->limit(5);
		$this->db->group_by('products.id');
		$this->db->where('products.id !=', $id);
		return $this->db->get()->result();
 	}

 	public function get_home_product(){
 		$this->db->select('products.*,variation_product.*');
 		$this->db->from('products');
 		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
 		$this->db->group_by('products.product_id');
 		 $this->db->order_by('rand()');
 		 $this->db->distinct();
		$this->db->limit(8);
		return $this->db->get()->result();
 	}


 	public function get_home_setting(){
 		$this->db->where('id', '1');
 		$result =$this->db->get('home_page_setting')->row();

 		return $result ;
 	}


 	public function get_deal_of_the_week(){

 		$this->db->select('products.*,variation_product.*');
 		$this->db->from('products');
 		$this->db->where('products.deal_of_the_weak', 'yes');
 		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
 		$this->db->group_by('products.product_id');
		//$this->db->limit(4);
		return $this->db->get()->result();
 	}

 	public function get_section_one_cat($rand = NULL){
 		$this->db->where('id', '1');
 		$result = $this->db->get('home_page_setting')->row();
 		$cats =  $result->section_1_cats;
 		$cats = $this->product_m->get_subchild_cats($cats);
		$this->db->select('products.*,variation_product.*');
 		$this->db->from('products');
 		if($rand){
 			  $this->db->order_by('rand()');
 		}else{
 			$this->db->order_by('products.product_offer', 'desc');
 		}
 		
 		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
 		$this->db->where_in('products.categories_id', $cats);
 		$this->db->where('products.recomended', "yes");
 		$this->db->group_by('products.product_id');
	//	$this->db->limit(8);
		return $this->db->get()->result();
 	}

 	public function get_section_two_cat($rand = NULL){
 		$this->db->where('id', '1');
 		$result = $this->db->get('home_page_setting')->row();
 		$cats =  $result->section_2_cats;
 		$cats = $this->product_m->get_subchild_cats($cats);
		$this->db->select('products.*,variation_product.*');
 		$this->db->from('products');
 		if($rand){
 			  $this->db->order_by('rand()');
 		}else{
 			$this->db->order_by('products.product_offer', 'desc');
 		}
 		
 		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
 		$this->db->where_in('products.categories_id', $cats);
 		$this->db->where('products.recomended', "yes");
 		$this->db->group_by('products.product_id');
		//$this->db->limit(8);
		return $this->db->get()->result();
 	}

 	public function get_section_three_cat($rand = NULL){
 		$this->db->where('id', '1');
 		$result = $this->db->get('home_page_setting')->row();
 		$cats =  $result->section_3_cats;
 		$cats = $this->product_m->get_subchild_cats($cats);
		$this->db->select('products.*,variation_product.*');
 		$this->db->from('products');
		if($rand){
 			  $this->db->order_by('rand()');
 		}else{
 			$this->db->order_by('products.product_offer', 'desc');
 		}
 		
 		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
 		$this->db->where_in('products.categories_id', $cats);
 		$this->db->where('products.recomended', "yes");
 		$this->db->group_by('products.product_id');
// 		$this->db->limit(8);
		return $this->db->get()->result();
 	}

 	public function get_recomended_product(){

 		$this->db->select('products.*,variation_product.*');
 		$this->db->from('products');
 		$this->db->order_by('rand()');
 		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
 		$this->db->group_by('products.product_id');
		$this->db->limit(15);
		return $this->db->get()->result();
 	}

 	public function adv_cats_search($start = NULL ,$limit = NULL){
  		$product_cats = $this->uri->segment(2);
		if(!$product_cats || $product_cats ==""){
			$product_cats = $this->input->get_post('cats');
		}
		$parent = $this->input->get_post('parent');
		$search = $this->input->get('s');
		if($search){
		$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		 $this->db->group_by('products.id');
		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
		$this->db->like('products.product_name', $search, 'BOTH');
			$result =  $this->db->get()->result();
			return $result ;
		}
		if($product_cats != ''){
		$slugs = str_replace("----", ' & ', $product_cats);
		$slugs = str_replace("---", "'", $slugs); 
		$slugs = str_replace('--', ', ', $slugs);
		$slugs = str_replace('_'," ", $slugs);
		$this->db->where('categories_name', $slugs);
		$product_cats = $this->db->get('product_categories')->row()->cats_id;

		$sub_child = $this->input->get('sub_child');
		$cats = array();
		if($sub_child == TRUE){
		$cats = $this->get_categories_by_sub_child($product_cats);
		}
		if($parent == TRUE){
		  $cats = $this->get_categories_by_parent($product_cats);
		}

		}
 			$brand = $this->input->get_post('brand');
 			$review = $this->input->get_post('review');
 			$size = $this->input->get_post('size');
 			$sort = $this->input->get_post('sort');
 			$min = $this->input->get_post('min');
 			$color = $this->input->get_post('color');
 			// $per_page = $this->input->get_post('per_page');
 			$ids = $this->input->get_post('id');
 			$f_min = $this->input->get_post('f_min');
 			$f_max = $this->input->get_post('f_max');


 			if($min){
 				$min = floatval(trim($min,"$"));
 			}
 			$max= $this->input->post('max');
 			if($max){
 				$max = floatval(trim($max,"$"));
 			}

 			if($f_min){
 				$min = $f_min ;
 			}
 			if($f_max){
 				$max = $f_max;
 			}


 			$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');

 			$this->db->limit($start ,$limit);

	 			if($min){
	 				$this->db->where('variation_product.price - (variation_product.price * (products.product_offer/100)) >=',$min);
	 			}
	 			if($max){
	 				$this->db->where('variation_product.price - (variation_product.price * (products.product_offer/100)) <=',$max);
	 			}

	 		   if($sort){
 				if($sort =="high_to_low"){
 					$this->db->order_by('variation_product.price', 'desc');
 				}
 				if($sort =="low_to_high"){
 					$this->db->order_by('variation_product.price', 'asc');
 				}
 			}
 			
 			// if($cats && !empty($cats)){
	 		// $this->db->where_in('products.categories_id', $cats);
	 		// }

	 	if($product_cats != ''){
			if($cats && !empty($cats)){
				$this->db->where_in('products.categories_id', $cats);
				
			}elseif($product_cats){
				$this->db->where('products.categories_id', $product_cats);
			}
		}
 			
			if($sort =="latest"){
				 $this->db->order_by('products.id', 'desc');
			}
			 $this->db->group_by('products.id');
 		
 			$result =  $this->db->get()->result();
			
 			
 			return  $result ;
 		
 		} 	
 	public function adv_product_search($cats){
  			$cats = array_filter($cats) ;
 			$brand = $this->input->get_post('brand');
 			$review = $this->input->get_post('review');
 			$size = $this->input->get_post('size');
 			$sort = $this->input->get_post('sort');
 			$min = $this->input->get_post('min');
 			$color = $this->input->get_post('color');
 			$per_page = $this->input->get_post('per_page');
 			$ids = $this->input->get_post('id');
 			$f_min = $this->input->get_post('f_min');
 			$f_max = $this->input->get_post('f_max');


 			if($min){
 				$min = floatval(trim($min,"$"));
 			}
 			$max= $this->input->post('max');
 			if($max){
 				$max = floatval(trim($max,"$"));
 			}

 			if($f_min){
 				$min = $f_min ;
 			}
 			if($f_max){
 				$max = $f_max;
 			}


 			$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');

 			$this->db->limit($per_page);

	 			if($min){
	 				$this->db->where('variation_product.price - (variation_product.price * (products.product_offer/100)) >=',$min);
	 			}
	 			if($max){
	 				$this->db->where('variation_product.price - (variation_product.price * (products.product_offer/100)) <=',$max);
	 			}

	 		   if($sort){
 				if($sort =="high_to_low"){
 					$this->db->order_by('variation_product.price', 'desc');
 				}
 				if($sort =="low_to_high"){
 					$this->db->order_by('variation_product.price', 'asc');
 				}
 			}
 			
 			if($cats && !empty($cats)){
	 		$this->db->where_in('products.categories_id', $cats);
	 		}
 			
			if($sort =="latest"){
				 $this->db->order_by('products.id', 'desc');
			}
			 $this->db->group_by('products.id');
 		
 			$result =  $this->db->get()->result();
			
 			
 			return  $result ;
 		
 		}

 	public function cms(){
 		return $this->db->get('cms')->result();
 	}

 	public function get_sub_parent_cats($id = NULL){
 		$this->db->select('*');
 		$this->db->where('cats_id', $id);
 		$result = $this->db->get('product_categories')->row();

 		$sub_parent_id = $result->parent_id ;

 		$this->db->select('*');
 		$this->db->where('parent_id', $sub_parent_id);
 		$result = $this->db->get('product_categories')->result();

 		return $result ;

 	}

 	public function get_parent_cats($id = NULL){
 		$this->db->select('*');
 		$this->db->where('cats_id', $id);
 		$result = $this->db->get('product_categories')->row();

 		$sub_parent_id = $result->parent_id ;

 		$this->db->select('*');
 		$this->db->where('cats_id', $sub_parent_id);
 		$result = $this->db->get('product_categories')->row();

 		$this->db->where('parent_id', $result->parent_id);
 		return $this->db->get('product_categories')->result();


 	}

 	public function get_cats_by_name($name =  NULL){

 		$this->db->where('categories_name', $name);
 		$result = $this->db->get('product_categories')->row();
 		var_dump($name);
 		die();
 		return $result->cats_id ;
 	}

 	public function get_cats_adv_search(){
 		$parent = $this->input->get_post('parent');
		$product_cats = $this->input->get_post('cats');
		if($product_cats){
		$slugs = str_replace("----", ' & ', $product_cats);
		$slugs = str_replace("---", "'", $slugs); 
		$slugs = str_replace('--', ', ', $slugs);
		$slugs = str_replace('_'," ", $slugs);
		$this->db->where('categories_name', $slugs);
		$product_cats = $this->db->get('product_categories')->row()->cats_id;
		}else{
			$product_cats = '';
		}
		$sub_child = $this->input->get_post('sub_child');
		$cats = array();
		if($sub_child == TRUE){
		$cats = $this->get_categories_by_sub_child($product_cats);
		}
		if($parent == TRUE){
		  $cats = $this->get_categories_by_parent($product_cats);
		}

		if(empty($cats)){
			$cats[] = $product_cats;
		}

		return $cats;
 	}
 	
 		public function promocode($limit, $start)
	{   
		$this->db->limit($limit, $start);
		$promocode = $this->db->get('tbl_offers')->result();
		return $promocode ;
	}

    	public function addpromocode($id = NULL)
	{	
        $coupon_code = $this->input->post('coupon_code');
    	$description = $this->input->post('offer_desc');
    	$enable = $this->input->post('enable');
    	
    	if($this->input->post('discount-type') == "flat"){
        	$flat = $this->input->post('type');
        	$percent = 0;
        	$type = "flat";
    	}else{
        	$percent = $this->input->post('type');
        	$flat = 0;
        	$type = "percent";
    	}
    	$max_off = $this->input->post('max_off');
    	$use_date_begin = $this->input->post('use_date_begin');
    	$use_date_end = $this->input->post('use_date_end');
    	$total_range_begin = $this->input->post('total_range_begin');
    	$total_range_end = $this->input->post('total_range_end');
    	$use_limit_per_user = $this->input->post('use_limit_per_user');
	
	    $data = array('coupon_code' => $coupon_code ,'offer_desc'=>$description,'enable' =>$enable,'type'=>$type,'flat'=> $flat,'percent'=>$percent ,'max_off' =>$max_off,'use_date_begin' => $use_date_begin,'use_date_end'=>$use_date_end,'total_range_begin'=>$total_range_begin,'total_range_end'=>$total_range_end,'use_limit_per_user'=>$use_limit_per_user);
	    $this->db->insert('tbl_offers', $data);
	  	$result = $this->db->insert_id();
	}
	
	public function view_promo_code($id = NULL)	
	{	
		if($id == NULL){
			$id = $this->uri->segment(4);
		}		
		$this->db->where('id', $id);

        return $this->db->get('tbl_offers')->row();
	}
	
	 public function update_promo_code($id= NULL){
        $coupon_code = $this->input->post('coupon_code');
    	$description = $this->input->post('offer_desc');
    	$enable = $this->input->post('enable');
    	
    	if($this->input->post('discount-type') == "flat"){
        	$flat = $this->input->post('type');
        	$percent = 0;
        	$type = "flat";
    	}else{
        	$percent = $this->input->post('type');
        	$flat = 0;
        	$type = "percent";
    	}
    	$max_off = $this->input->post('max_off');
    	$use_date_begin = $this->input->post('use_date_begin');
    	$use_date_end = $this->input->post('use_date_end');
    	$total_range_begin = $this->input->post('total_range_begin');
    	$total_range_end = $this->input->post('total_range_end');
    	$use_limit_per_user = $this->input->post('use_limit_per_user');
	
	    $data = array('coupon_code' => $coupon_code ,'offer_desc'=>$description,'enable' =>$enable,'type'=>$type,'flat'=> $flat,'percent'=>$percent ,'max_off' =>$max_off,'use_date_begin' => $use_date_begin,'use_date_end'=>$use_date_end,'total_range_begin'=>$total_range_begin,'total_range_end'=>$total_range_end,'use_limit_per_user'=>$use_limit_per_user);

	    $this->db->where('id', $id);
	    $result = $this->db->update('tbl_offers', $data);
		return $result ;
    }
    
    public function save_gift_order($ids){
        
    $pidArray = explode(',', $ids);
    echo "<pre>";print_r($ids);die();
    foreach($pidArray as $item){
    $this->db->select('variation_product.sku');
    $this->db->from('products');
    $this->db->join('products', 'variation_product.parent_id = products.product_id', 'left');
    $this->db->where('id', $item);
    $productResult[] = $this->db->get()->result_array();
    }
    
    foreach($productResult as $product){
        $quantity["$product[0]['sku']"] = 1 ;
        $quantity = json_encode($quantity);
        $first_name = $this->input->post('first_name');
	   $last_name = $this->input->post('last_name');
	   $user_phone =$this->input->post('user_phone');
	   $email = $this->input->post('email');
	   $user_country = $this->input->post('country');
	   $user_city = $this->input->post('city');
	   $user_state = $this->input->post('state');
	   $address_one = $this->input->post('address_line_1');
	   $address_two = $this->input->post('address_line_2');
	   $add_info = $this->input->post('add_info');
	   $zip = $this->input->post('zip');
	   $shipping_method = $this->input->post('shippings_meth');
	   $shipping_price = $this->input->post('shipping_method');
	   $payment_method = $this->input->post('payment_method');
	   $user_id = $this->session->userdata('id');
	   $order_amount =  0;
	   $promoCode = 0;
	   $data[] = array('billing_first_name' => $first_name ,'billing_last_name'=>$last_name,'billing_email' =>$email,'billing_country'=>$user_country,'billing_zip'=> $zip,'billing_state'=>$user_state ,'billing_city' =>$user_city,'billing_phone' => $user_phone,'billing_address_one'=>$address_one,'billing_address_two'=>$address_two,'quantity'=>$quantity,'additional_information'=>$add_info,'payment_method'=>$payment_method,'product_orderd'=>$products,'order_by'=>$user_id ,'order_amount'=>$order_amount,'shipping_charge'=> $shipping_price,'shipping_method' =>$shipping_method, 'promo_code'=>$promoCode);
        }
        echo "<pre>";print_r($data);die();
	    $this->db->insert_batch('orders', $data);
	  	$result = $this->db->insert_id();
		return $result ;

	}
    
 
}