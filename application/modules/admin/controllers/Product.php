<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('product_m');
		$this->load->library("pagination");
		$this->data['title'] = "zataara admin";
		$this->data['categories'] =$this->product_m->get_category();
		$this->data['get_imp_cats'] =$this->product_m->get_imp_category();
		$this->data['get_imp_parent_cats'] =$this->product_m->get_imp_parent_cats();
		$this->data['size'] =$this->product_m->get_size();
		$this->data['color'] =$this->product_m->get_color();
		$this->data['brand'] =$this->product_m->get_brands();
		$this->data['attributes_type'] = array('color','size','fabric');
		$this->data['size_chart'] =$this->product_m->get_size_chart();
	}

	public function index()
	{	
		$config = array();
		$per_page = $this->input->get('per_pages');
		if(!$per_page){
			$per_page = 20;
		}
		$config["per_page"] = $per_page;
		if($this->uri->segment(3) == 0)
		{
		    $offset = 0;
		}
		else
		{
		    $offset = ($config['per_page'])*($this->uri->segment(3)-1);
		}
		
		$products = $this->product_m->get_products();
		$product = $this->product_m->get_products($config["per_page"], $offset);
        $config["base_url"] = base_url() . "admin/product/";
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
			// $config['page_query_string'] =TRUE ;
		$config['reuse_query_string'] = true;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->data["links"] = $this->pagination->create_links();
		

		$product_id = array();
		$this->data['title'] = "Product List";
		
		$this->data['products'] = $product;
		foreach ($product as $data) {
			$product_id[$data->id] = $data->id ;
		}
		$this->load->view('product-list', $this->data);
	}
	public function add_product(){
		
		$this->data['title'] = "Add Product";
		$rules = $this->product_m->rules;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE) {
			$product  = $this->product_m->add_product();
			echo $product ;
		}
		else{
			$this->load->view('add-product', $this->data);
		}
	}

	public function sync_cj_product(){

		$id = $this->input->post('id');

		$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->where('products.product_id', $id);
		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id');
		$result = $this->db->get()->result();

		$price = array();

		foreach ($result as $data) {
			
			$price[] = $data->price ;
		}

		$min = min($price);
		$max = min($price);

		if($min == $max){

			$price_range = $min ;	
		}else{
			$price_range = $min.'-'.$max ;	
		}


$json = '';
		$json .= '[{"uid" : "'.$result[0]->id.'",
			    "title" : "'.$result[0]->product_name.'" ,
			    "image" : "'.base_url('admin-assets/images/').$result[0]->product_image.'" ,
			    "prices" : "'.$price_range.'" ,
			    "tags" : "" ,
			    "productType" : "" ,
			    "categoryId" : "'.$result[0]->categories_id.'" ,
			    "variants" : [';
			    $i = 0 ;
			 $count =    count($result);
foreach ($result as $data) {
	$json .='{"vid" : "'.$data->variation_product_id.'" ,
			    "price" : "'.$data->price.'" ,
			    "sku" : "'.$data->sku.'" ,
			    "title" : "'.$data->commodityDifferenceOption.'" ,
			    "grams" : "'.$data->weight.'" ,
			    "oldinventoryquantity" : "100" ,
			    "image" : "'.base_url('admin-assets/images/').$data->image.'"
			    }';
			    if($i != $count-1){
			    	$json .= ',';
			    }
 $i++ ;
}
$json .=']}]';

$json = json_encode(json_decode($json));

if($result[0]->product_sync == 'no'){

	$headers = array('CJ-Access-Token' => 'eb47bdcce2f44800a21baa2300110d4c','Content-Type' => 'application/json');
	$request = Requests::post('https://developers.cjdropshipping.com/api/product/createProducts', $headers,$json);	
	if(json_decode($request->body)){
		$data =  json_decode($request->body);
		if($data[0]->result == true){
			$data = array('product_sync' => 'yes');
			$this->db->where('product_id', $id);
			$this->db->update('products', $data);
		}
	
	}


}else{

	$headers = array('CJ-Access-Token' => 'eb47bdcce2f44800a21baa2300110d4c','Content-Type' => 'application/json');
	$request = Requests::post('https://developers.cjdropshipping.com/api/product/upProductsInfo', $headers,$json);	

}

	}

	public function update_recomended(){

		$rec = $this->input->post('rec');
		$id = $this->input->post('id');

		$data = array('recomended' => $rec);
		$this->db->where('product_id', $id);
		$this->db->update('products', $data);
	}

	public function update_product(){
		$this->data['title'] = "Update Product";
		$rules = $this->product_m->rules;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE) {
		    
			$product  = $this->product_m->add_product();
			echo $product ;
		}
		else{
			$products = $this->data['products'] = $this->product_m->product_info();
			$this->data['product_image'] = $this->product_m->product_images();
			$product_id = $products->product_id;
			if($product_id == ""){
				$product_id = $products->id;
			}
			$this->data['variation_product'] = $this->product_m->get_variable_product($product_id);
		$this->load->view('update-product', $this->data);
		}
	}

	public function update_deal_of_the_week(){
		$rec = $this->input->post('rec');
		$id = $this->input->post('id');

		$data = array('deal_of_the_weak' => $rec);
		$this->db->where('product_id', $id);
		$this->db->update('products', $data);
	}

	public function update_variation(){
		$product_id = $this->input->post('product_id');
		$parent_id = $this->input->post('parent_id');
		$sku = $this->input->post('sku');
		$price =  $this->input->post('price');
		$weight =$this->input->post('weight');
		$specification = $this->input->post('Specification');
		$specification = json_encode(explode(',',$specification));
		$commodityDifferenceOption = $this->input->post('commodityDifferenceOption');
		$commodityDifferenceOption = json_encode(explode(',',$commodityDifferenceOption));
        $variation_product_id = $this->input->post('variation_product_id');
		$datas = array('specifications'=> $specification,'price'=>$price,'sku'=>$sku,'weight'=>$weight,'varietyCommodityDifferenceOption'=>$commodityDifferenceOption, 'parent_id' => $parent_id);
		$config['upload_path'] = './admin-assets/images';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image')) {
            	 $data = array('image_metadata' => $this->upload->data());
            $image_name =  $data['image_metadata']['file_name'];
           
           $datas['image'] =$image_name;
        }else{
        	$image_name = '';
        }
        if($variation_product_id != ""){

        	
        	$this->db->where('variation_product_id', $variation_product_id);
        	$this->db->update('variation_product', $datas);
          //  redirect($_SERVER['HTTP_REFERER'].'#tabship'); 

        }else{

        //	$datas['parent_id'] = $product_id ; 

        	$result = $this->db->insert('variation_product', $datas); if($result){

        		$datas2 = array('product_image' =>$image_name );
        		$this->db->where('id', $product_id);
        		$this->db->update('products', $datas2);
        	}
      //   redirect(site_url('admin/product/update_product/'.$product_id.'').'#tabship');

        }

        
         redirect(site_url('admin/product/update_product/'.$product_id.'').'#tabship');

	}

	public function update_shipping(){
		$product  = $this->product_m->update_shipping();
			echo $product ;
	}

	public function upload_images(){
		$config['upload_path']="./admin-assets/images";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        
        $this->load->library('upload',$config);
	    if($this->upload->do_upload("file")){
	        $data = $this->upload->data();
	        //Resize and Compress Image
            $config['image_library']='gd2';
            $config['source_image']='./admin-assets/images/'.$data['file_name'];
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '60%';
            $config['width']= 800;
            $config['height']= 1100;
            $config['new_image']= './admin-assets/images/'.$data['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
	        $product_id= $this->input->post('product_id');
	        $image= $data['file_name']; 
	        
	        $result= $this->product_m->save_upload($product_id,$image);
	        echo json_decode($result);
	    }
	    else{
	    	echo "something wrong";
	    	echo $this->upload->display_errors();
	    }
	}

	public function categories(){
		$config = array();
        $config["base_url"] = base_url() . "admin/product/categories/";
        $config["total_rows"] = $this->product_m->cats_count();
        $config["total_rows"] = $config["total_rows"];
		$config["num_links"] = $config["total_rows"];
		$config["per_page"] = 50;
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
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["links"] = $this->pagination->create_links();
		$this->data['title'] = "Categories List";
		if($this->uri->segment(4) == 0)
		{
		    $offset = 0;
		}
		else
		{
		    $offset = ($config['per_page'])*($this->uri->segment(4)-1);
		}
		$this->data['categories'] = $this->product_m->get_categories($config["per_page"], $offset);
		$this->load->view('categories', $this->data);

	}

	public function add_categories(){

		$config['upload_path']="./admin-assets/images";
        $config['allowed_types']='gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        
        $this->load->library('upload',$config);
	    if($this->upload->do_upload("file")){
	        $data = $this->upload->data();
	        //Resize and Compress Image
            $config['image_library']='gd2';
            $config['source_image']='./admin-assets/images/'.$data['file_name'];
            $config['create_thumb']= FALSE;
            $config['maintain_ratio']= FALSE;
            $config['quality']= '60%';
            $config['width']= 600;
            $config['height']= 400;
            $config['new_image']= './admin-assets/images/'.$data['file_name'];
            $this->load->library('image_lib', $config);
            $this->image_lib->resize();
	        $image= $data['file_name']; 
		}else{
			
		}
		if(!isset($image)){
			$image = '';
		}
		$id = $this->input->post('categories_id'); 
	


		if($image == ''){
			$data = array(
			'categories_name' => $this->input->post('categories_name'),
			'cats_id' => $this->input->post('cats_id'),
			'parent_id' => $this->input->post('parent_id'),
			'cats_seq' => $this->input->post('cats_seq'),
			'createdAt'  => '',
			'modifiedAt' =>''
		);

		}else{
			$data = array(
			'categories_name' => $this->input->post('categories_name'),
			'cats_id' => $this->input->post('cats_id'),
			'parent_id' => $this->input->post('parent_id'),
			'cats_seq' => $this->input->post('cats_seq'),
			'categories_image' => $image,
			'createdAt'  => '',
			'modifiedAt' =>''
		);
		}

		
		$categories = $this->product_m->update_categories($data , $id);

		redirect('admin/product/categories','refresh');

	}


	public function reviews(){

		$this->data['reviews'] = $this->product_m->get_reviews();

		$this->load->view('reviews',$this->data);

	}

	public function change_review_status(){

		$id = $this->input->get('id');

		$status  = $this->input->get('status');

		$data = array('status' => $status);
		$this->db->where('id', $id);
		$this->db->update('reviews', $data);
		redirect('admin/product/reviews','refresh');
	}


	public function delete_review(){

		$id = $this->uri->segment(4);

		$this->db->where('id', $id);
		$this->db->delete('reviews');
	}


	public function get_child_cats(){
		$id = $this->input->post('id');
		$this->db->where('parent_id', $id);
		$result = $this->db->get('product_categories')->result();
		$html= '';
		foreach ($result as $data) {
			# code...
			$html .= '<option value="'.$data->cats_id.'">'.$data->categories_name.'</option>';
		}

		echo $html ;
	}

	public function categories_view()
	{
		
		$id = $this->uri->segment(4);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->product_m->categories_view($id)));
	}

	public function delete_cats(){
		$id = $this->uri->segment(4);
		$this->product_m->delete_cats($id) ;
	}

	public function attributes_view()
	{
		$id = $this->uri->segment(4);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->product_m->attributes_view($id)));

	}

	public function delete_attribute(){
		$id = $this->uri->segment(4);
		$this->product_m->delete_attribute($id) ;
	}

	public function apply_discount_product(){

		$this->data['products'] = $this->product_m->apply_discount_discount();
		$this->load->view('product-list', $this->data);
	}

	public function apply_margin_product(){

		$this->data['products'] = $this->product_m->apply_margin_discount();
		$this->load->view('product-list', $this->data);
	}


	public function attributes(){
		$config = array();
        $config["base_url"] = base_url() . "admin/product/attributes/";
        $config["total_rows"] = $this->product_m->attributes_count();
        $config["total_rows"] = $config["total_rows"];
		$config["num_links"] = $config["total_rows"];
		$config["per_page"] = 10;
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
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["links"] = $this->pagination->create_links();
		$this->data['title'] = " Attributes ";
		if($this->uri->segment(4) == 0)
		{
		    $offset = 0;
		}
		else
		{
		    $offset = ($config['per_page'])*($this->uri->segment(4)-1);
		}
		$this->data['attributes'] = $this->product_m->attributes($config["per_page"], $offset);
		$this->load->view('attributes', $this->data);
	}

	public function add_attributes(){

		$this->product_m->add_attributes();
		redirect('admin/product/attributes','refresh');

	}
	public function update_attribute(){
		$this->product_m->update_attributes();
		redirect('admin/product/attributes','refresh');
	}

	public function shipping_method(){

		$this->data['title'] = 'Shipping Method';
		$config = array();
        $config["base_url"] = base_url() . "admin/product/shipping_method/";
        $config["total_rows"] = $this->product_m->shipping_method_count();
        $config["total_rows"] = $config["total_rows"];
		$config["num_links"] = $config["total_rows"];
		$config["per_page"] = 10;
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
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["links"] = $this->pagination->create_links();
		$this->data['title'] = " Attributes ";
		if($this->uri->segment(4) == 0)
		{
		    $offset = 0;
		}
		else
		{
		    $offset = ($config['per_page'])*($this->uri->segment(4)-1);
		}
		$this->data['shipping_method'] =$this->product_m->shipping_method($config["per_page"], $offset);
		$this->load->view('shipping_method', $this->data);
	}	

	public function add_shipping_method(){

		$this->product_m->add_shipping_method();
		redirect('admin/product/shipping_method','refresh');
	}


	

	public function shipping_method_view(){
		$id = $this->uri->segment(4);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->product_m->shipping_method_view($id)));
	}

	public function shipping_method_delete(){
		$id = $this->uri->segment(4);
		$this->product_m->shipping_method_delete($id) ;
	}

	public function product_image_delete(){
		$id = $this->uri->segment(4);
		$this->product_m->product_image_delete($id) ;
	}

	public function product_image_update(){
		$id = $this->uri->segment(4);
		$product_id = $this->input->post('product_id');
		$this->product_m->product_image_update($id , $product_id);
	}

	public function delete(){
		$id = $this->uri->segment(4);
		$this->product_m->delete($id);
	}


	public function delete_specific()
	{
		$this->product_m->delete_specific();
	}
	public function  delete_psize(){
		$id = $this->uri->segment(4);
		$this->product_m->delete_psize($id);
	}
	public function p_size(){
		$this->data['categorielist'] =$this->product_m->get_allcategory();
		$config = array();
        $config["base_url"] = base_url() . "admin/product/p_size/";
        $config["total_rows"] = $this->product_m->psize_count();
        $config["total_rows"] = $config["total_rows"];
		$config["num_links"] = $config["total_rows"];
		$config["per_page"] = 10;
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
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["links"] = $this->pagination->create_links();
		$this->data['title'] = "Categories List";
		if($this->uri->segment(4) == 0)
		{
		    $offset = 0;
		}
		else
		{
		    $offset = ($config['per_page'])*($this->uri->segment(4)-1);
		}
		$this->data['product_size_list'] = $this->product_m->get_p_size_list($config["per_page"], $offset);
		$this->load->view('product_size', $this->data);

	}
	public function  add_psize(){
 		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->product_m->add_psize()));
 	}
 	public function size_view(){
 		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->product_m->size_view()));
 		 
 	}
 	public function  update_roductSize(){
 		  
 		  $this->product_m->update_roductSize();
 		  
 		  redirect('admin/product/p_size','refresh');
 	}
 	public function size_cart(){
		$this->data['categorielist'] =$this->product_m->get_allcategory();
		$config = array();
        $config["base_url"] = base_url() . "admin/product/size_cart/";
        $config["total_rows"] = $this->product_m->csize_count();
        $config["total_rows"] = $config["total_rows"];
		$config["num_links"] = $config["total_rows"];
		$config["per_page"] = 10;
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
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["links"] = $this->pagination->create_links();
		$this->data['title'] = "Size Chart";
		if($this->uri->segment(4) == 0)
		{
		    $offset = 0;
		}
		else
		{
		    $offset = ($config['per_page'])*($this->uri->segment(4)-1);
		}
		$this->data['size_chart_list'] = $this->product_m->get_size_size_list($config["per_page"], $offset);
		$this->load->view('size_chart', $this->data);

	}
	public function  delete_csize(){
		$id = $this->uri->segment(4);
		$this->product_m->delete_csize($id);
	}
	public function add_csize(){

       
		$config['upload_path'] = './admin-assets/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('thumbnail')) {
            $error = array('error' => $this->upload->display_errors());
            echo "Image not uploaded kindly check and submit again"; 
            } 
       else {

            $data = array('image_metadata' => $this->upload->data());
            $image_name =  $data['image_metadata']['file_name'];
            $this->product_m->add_csize($image_name);
  	         redirect('admin/product/size_cart','refresh');
 		     redirect($redirect,'refresh');
        }
	 
	}
	public function csize_view(){

 		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->product_m->csize_view()));
 		 
 	}
 	public function update_csize()
	{
 			$id = $this->input->post('size_id1');
              if (isset($id)) {
              	$config['upload_path'] = './admin-assets/';
                $config['allowed_types'] = 'gif|jpg|png';
		        $this->load->library('upload', $config);
                if (!$this->upload->do_upload('thumbnail')) {
			            $this->product_m->update_csize($id);
	 			        redirect('admin/product/size_cart','refresh');
 			        } else {
			            $data = array('image_metadata' => $this->upload->data());
			            $image_name =  $data['image_metadata']['file_name'];
                        $this->product_m->update_csize($id,$image_name);
	 			        redirect('admin/product/size_cart','refresh');
 			        }
                 }
                 else{
               	       redirect('admin/product/size_cart','refresh');
                     }
 	}
 	public function menus(){
		$this->data['categorielist'] =$this->product_m->get_allcategory();
		$config = array();
        $config["base_url"] = base_url() . "admin/product/menus/";
        $config["total_rows"] = $this->product_m->menu_count();
        $config["total_rows"] = $config["total_rows"];
		$config["num_links"] = $config["total_rows"];
		$config["per_page"] = 10;
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
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["links"] = $this->pagination->create_links();
		$this->data['title'] = "Size Chart";
		if($this->uri->segment(4) == 0)
		{
		    $offset = 0;
		}
		else
		{
		    $offset = ($config['per_page'])*($this->uri->segment(4)-1);
		}
		$this->data['menu_list'] = $this->product_m->get_menu_list($config["per_page"], $offset);
		$this->load->view('menus', $this->data);
 	}
 	public function delete_menu(){
 		$id = $this->uri->segment(4);
		$this->product_m->delete_menus($id);
 	} 
   public function add_menu(){
         	$this->product_m->add_menu();
  	         redirect('admin/product/menus','refresh');
   }
   public function menu_view(){
   	    header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->product_m->menu_view()));
   }
   public function update_menu()
	{ 
 		 $this->product_m->update_menu();
	 	 redirect('admin/product/menus','refresh');
   	}
   public function child_menus(){
		$this->data['categorielist'] =$this->product_m->get_allcategory();
		$config = array();
        $config["base_url"] = base_url() . "admin/product/child_menus/";
        $config["total_rows"] = $this->product_m->childmenu_count();
        $config["total_rows"] = $config["total_rows"];
		$config["num_links"] = $config["total_rows"];
		$config["per_page"] = 10;
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
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $this->data["links"] = $this->pagination->create_links();
		$this->data['title'] = "Size Chart";
		if($this->uri->segment(4) == 0)
		{
		    $offset = 0;
		}
		else
		{
		    $offset = ($config['per_page'])*($this->uri->segment(4)-1);
		}
		$this->data['childmenu_list'] = $this->product_m->get_childmenu_list($config["per_page"], $offset);
		$this->load->view('child_menu', $this->data);
 	}
 	public function delete_childmenu(){
 		$id = $this->uri->segment(4);
		$this->product_m->delete_childmenu($id);
 	}


 	public function parentmenu_view(){
 		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->product_m->parentmenu_view()));
 	}
 	public function add_submenu(){
 		$this->product_m->add_submenu();
  	    redirect('admin/product/child_menus','refresh');
 	}

 	public function adv_search(){

 		
 	}


 	public function  import_categories(){

 	
 		$this->load->view('import_cats', $this->data);
 	}

 	public function  import_products(){

 	
 		$this->load->view('import_products', $this->data);
 	}

 	public function sync_cats(){
 		$page_no = (int)$this->input->post('page_no');
 		$per_page = (int)$this->input->post('cats_per_page');
	$headers = array('CJ-Access-Token' => 'eb47bdcce2f44800a21baa2300110d4c','Content-Type' => 'application/json');
	$data = json_encode(array('pageNum'=>$page_no, 'pageSize'=>$per_page));
	$request = Requests::post('https://developers.cjdropshipping.com/api/commodity/getCategory', $headers,$data);
	$cats =  json_decode($request->body)->data;
	$cats_array = array();
			foreach ($cats as $data) {
				$cats_array[] = array('cats_id' =>$data->id ,'categories_name' => $data->name,'parent_id'=>'');
				if(count($data->subsetJson) > 0){

					foreach ($data->subsetJson as $data_level_1) {
						# code...
						$cats_array[] = array('cats_id' =>$data_level_1->id ,'categories_name' => $data_level_1->name ,'parent_id'=>$data_level_1->parentPid);
						if(count($data_level_1->subsetJson) > 0){
							foreach ($data_level_1->subsetJson as $data_level_2) {
								# code...
								$cats_array[] = array('cats_id' =>$data_level_2->id ,'categories_name' => $data_level_2->name ,'parent_id'=>$data_level_2->parentPid);
							}
						}
					}

				}

			}
			$db_cats_array = array();
			$db_product_cats = $this->db->get('product_categories')->result();
			foreach ($db_product_cats as $data) {
				$db_cats_array[] = array('cats_id' => $data->cats_id ,'categories_name' => $data->categories_name ,'parent_id'=>$data->parent_id);
			}

			$data_cats = array_diff(array_column($cats_array, 'cats_id'), array_column($db_cats_array, 'cats_id'));
			$new_data = array();
		
			$new_data_array = array();
			foreach ($data_cats as $key => $value) {
				# code...
				$new_data_array[] = $cats_array[$key];
			}

			if(count($new_data_array) > 0){
				$this->db->insert_batch('product_categories', $new_data_array);
			}
 	}


 	public function  getimg($url) {         
    $headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';              
    $headers[] = 'Connection: Keep-Alive';         
    $headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';         
    $user_agent = 'php';         
    $process = curl_init($url);         
    curl_setopt($process, CURLOPT_HTTPHEADER, $headers);         
    curl_setopt($process, CURLOPT_HEADER, 0);         
    curl_setopt($process, CURLOPT_USERAGENT, $user_agent); //check here         
    curl_setopt($process, CURLOPT_TIMEOUT, 30);         
    curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);         
    curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);         
    $return = curl_exec($process);         
    curl_close($process);         
    return $return;     
	} 

	public function clone_image(){
	$imgurl = 'https://cc-west-usa.oss-us-west-1.aliyuncs.com/15095520/3076801687_2112171848.400x400.jpg'; 
	$imagename= basename($imgurl);
	if(file_exists('./admin-assets/images/'.$imagename)){
		echo $imagename;
	} 
	$image = $this->getimg($imgurl); 
	file_put_contents('./admin-assets/images/'.$imagename,$image); 
	}

	public function sync_orders(){

	$id = $this->session->userdata('id');

		$this->db->where('user_id', $id);
		$result = $this->db->get('carts')->result();

		
	}

 	public function sync_product(){
 	    
 		$page_no = (int)$this->input->post('page_no');
 		$per_page = (int)$this->input->post('per_page');
 		$cats_id = $this->input->post('product_categories');
 		$page_no = $this->product_m->history($cats_id);
 		$comission = $this->input->post('comission');
 		$headers = array('CJ-Access-Token' => 'eb47bdcce2f44800a21baa2300110d4c','Content-Type' => 'application/json');
		$data = json_encode(array('pageNum'=>$page_no,'pageSize' =>$per_page,'categoryId' => $cats_id));
		$request = Requests::post('https://developers.cjdropshipping.com/api/commodity/getCommodity', $headers,$data);
 	  	if(json_decode($request->body)->code == true){
		$product   = json_decode($request->body)->data;
 	  	$product_array = array();
 	  	$variation_product = array();
 	
 	  	foreach ($product as $data) {
 	  		# code...
 	  	$imgurl = $data->bigImg ;
 	     $imagename= basename($imgurl);
		$image = $this->getimg($imgurl); 
	file_put_contents('./admin-assets/images/'.$imagename,$image);
$img_opt = $data->imgOption;

$images_option = array();
	foreach ($img_opt as $datas) {
		# code...
		$imgurl = $datas ;
 	     $imagename= basename($imgurl);
		$image = $this->getimg($imgurl); 
	file_put_contents('./admin-assets/images/'.$imagename,$image);
		$images_option[] = $imagename ;

	}

	$image_option = json_encode($images_option);
 	  		$product_array[] = array('product_id' => $data->id ,'	product_name'=> preg_replace("/[^a-zA-Z]/", " ", $data->name),'product_categories'=> $data->category ,'categories_id' => $data->categoryId,'product_long_disc'=>$data->description,'product_sku'=> $data->sku ,'product_image'=>$imagename ,'imgOption'=>$image_option ,'commodityDifferenceOption' =>json_encode($data->commodityDifferenceOption),'comission' =>$comission );

 	  		if(count($data->commodityData) > 0 ){
 	  			foreach ($data->commodityData as $var_data) {
 	  				# code...
 	  				$imgurl = $var_data->img ;
 	   				$imagename= basename($imgurl);
					$image = $this->getimg($imgurl); 
					file_put_contents('./admin-assets/images/'.$imagename,$image); 

 	  				$variation_product[] = array('parent_id' => $var_data->parentID ,'weight'=> $var_data->weight,'sku'=> $var_data->sku ,'commodityDifferenceOption' => $var_data->commodityDifferenceOption,'image'=>$imagename,'price'=>$var_data->price,'standard'=>$var_data->STANDARD,'specifications' => json_encode($var_data->specifications) ,'varietyCommodityDifferenceOption' => json_encode($var_data->varietyCommodityDifferenceOption));
 	  		}

 	  		}

 	  	}
 	  		$db_products_array = array();
			$db_products = $this->db->get('products')->result();

			if(count($db_products) > 0 ){
			foreach ($db_products as $datak) {
				$db_products_array[] = array('product_id' => $datak->product_id ,'product_name'=> $datak->product_name,'product_categories'=> $datak->product_categories ,'categories_id' => $datak->categories_id,'product_sku'=> $datak->product_sku ,'product_image'=>$datak->product_image ,'commodityDifferenceOption' =>$datak->commodityDifferenceOption );
			}

			$data_products = array_diff(array_column($product_array, 'product_id'), array_column($db_products_array, 'product_id'));
		
			$new_data_array = array();
			foreach ($data_products as $key => $value) {
				# code...
				$new_data_array[] = $product_array[$key];
			}

			if(count($new_data_array) > 0){
				$this->db->insert_batch('products', $new_data_array);
			}
		}else{

		
			$this->db->insert_batch('products', $product_array);
		}

			$db_variation_product_array = array();
			$db_variation_product = $this->db->get('variation_product')->result();
			if(count($db_variation_product) > 0 ){
			foreach ($db_variation_product as $datas) {
				$db_variation_product_array[] = array('parent_id' => $datas->parent_id ,'weight'=> $datas->weight,'sku'=> $datas->sku ,'commodityDifferenceOption' => $datas->commodityDifferenceOption,'image'=>$datas->image,'price'=>$datas->price,'standard'=>$datas->standard,'specifications' => $datas->specifications ,'varietyCommodityDifferenceOption' => $datas->varietyCommodityDifferenceOption);
			}

			$data_variation_products = array_diff(array_column($variation_product, 'sku'), array_column($db_variation_product_array, 'sku'));


		
			$new_data_var_array = array();
			foreach ($data_variation_products as $key => $value) {
				# code...
				$new_data_var_array[] = $variation_product[$key];
			}
			if(count($new_data_var_array) > 0){
				$this->db->insert_batch('variation_product',$new_data_var_array); 
			}
		}else{
			$this->db->insert_batch('variation_product',$variation_product); 
		}

		}

 }

 public function delete_all(){
 $this->db->empty_table('products');
 $this->db->empty_table('variation_product');
 redirect('admin/product','refresh');
 }

 public function discount(){

 	$this->load->view('discount', $this->data);
 }

 public function apply_discount(){
 	$discount = $this->input->get('discount');
 	$product_categories  = $this->input->get('product_categories');
 	$data = array('product_offer' => $discount);
 	$this->db->where('categories_id', $product_categories);
 	$this->db->update('products', $data);

 	redirect('admin/product/discount','refresh');
 }
 
 public function promocode(){
     $config = array();
        $config["base_url"] = base_url() . "admin/promocode/";
        $config["total_rows"] = "";
        $config["total_rows"] = $config["total_rows"];
		$config["num_links"] = $config["total_rows"];
		$config["per_page"] = 10;
		$config['use_page_numbers'] = TRUE;
		$config['cur_tag_open'] = '&nbsp;<a class="current">';
		$config['cur_tag_close'] = '</a>';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_link'] = '&laquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&raquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$config["cur_page"] = $page;
		$this->pagination->initialize($config);
		$this->data["links"] = $this->pagination->create_links();
        if($this->uri->segment(3) == 0)
			{
			    $offset = 0;
			}
			else
			{
			    $offset = ($config['per_page'])*($this->uri->segment(3)-1);
			}

    $this->data['promocodes'] = $this->product_m->promocode($config["per_page"], $offset);    
    $this->data['title'] ="Promo Code";
 	$this->load->view('promocode', $this->data);
 }
    public function add_promo_code(){
        $this->product_m->addpromocode(); 
        redirect('admin/product/promocode','refresh');
    }
    
    public function promo_code_delete(){

		$id = $this->uri->segment(4);
		$this->db->where('id', $id);
		$this->db->delete('tbl_offers');
	}
    public function view_promo_code(){
         header('Content-Type: application/x-json; charset=utf-8');
		 echo(json_encode($this->product_m->view_promo_code()));
    }   

    public function update_promo_code(){
        
        $id = $this->input->post('guid');
	    $this->product_m->update_promo_code($id);
	    redirect('admin/product/promocode','refresh');
    }
 }

/* End of file Product.php */
/* Location: ./application/modules/admin/controllers/Product.php */