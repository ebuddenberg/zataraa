<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General_setting_m extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		 
	}
  	public function all_slider($limit, $start){
  		$this->db->limit($limit, $start);
  		$result = $this->db->get('slider')->result();
		return $result;
 	}
 	public function Slider_count(){
		 
		 return $this->db->count_all('slider');
	}
    public function view_slider($id){
       $this->db->where('id', $id);
       $result = $this->db->get('slider')->row();
	   return $result ;
    }
     
    public function add_slider($img)
	{	
		 
            
		$data = array(
			'id' => '',
			'image_title' => $this->input->post('url10'),
			'slider_name' => $this->input->post('slider_type'),
 			'slide_image' => $img,			 
		);
		$this->db->insert('slider', $data);
	}
	public function delete_slider(){
        $id = $this->uri->segment(4);	
        $this->db->where('id', $id); 
	   $this->db->delete('slider') ;
	}
	public function update_slider($id = NULL,$imgs = NULL){

		if($imgs != ""){
			
 		    $data = array(
 			
			'image_title' => $this->input->post('url'),
			'slider_name' => $this->input->post('slider_type'),
 			'slide_image' => $imgs,	
		);
		 
	}else{
    $data = array(
 			
			'image_title' => $this->input->post('url'),
			'slider_name' => $this->input->post('slider_type'),
 			 
		);
	}
	$this->db->where('id', $id);
    if($this->db->update('slider', $data)){
    	return TRUE ;
    }else{
    	return FALSE ;
    }
}
    public function all_cate_list(){
  		
  		$result = $this->db->get('home_categories')->result();
		return $result;
 	}
 	public function delete_home_categry(){
        $id = $this->uri->segment(4);	
        $this->db->where('id', $id); 
	   $this->db->delete('home_categories') ;
	}
	public function add_home_cate($img)
	{	
 		$data = array(
			'id' => '',
			'cat_link' => $this->input->post('link'),
			'place' => $this->input->post('position'),
			'title' => $this->input->post('title'),
 			'images' => $img,			 
		);
		$this->db->insert('home_categories', $data);
	}
	public function view_home_category($id){
       $this->db->where('id', $id);
       $result = $this->db->get('home_categories')->row();
	   return $result ;
    }
    public function update_home_category($id = NULL,$imgs = NULL){

		if($imgs != ""){
			
 		    $data = array(
 			'cat_link' => $this->input->post('url'),
			'place' => $this->input->post('position'),
			'title' => $this->input->post('title'),
 			'images' => $imgs,	
		);
		 
	}else{
    $data = array(
 			
			'cat_link' => $this->input->post('url'),
			'place' => $this->input->post('position'),
			'title' => $this->input->post('title'),
 			 
		);
	}
	$this->db->where('id', $id);
    if($this->db->update('home_categories', $data)){
    	return TRUE ;
    }else{
    	return FALSE ;
    }
}
public function all_adv_list(){
  		
  		$result = $this->db->get('home_ads')->result();
		return $result;
 	}
public function delete_home_adse(){
        $id = $this->uri->segment(4);	
        $this->db->where('id', $id); 
	   $this->db->delete('home_ads') ;
	}
public function view_home_adse($id){
       $this->db->where('id', $id);
       $result = $this->db->get('home_ads')->row();
	   return $result ;
    }
public function add_home_adse($img)
	{	
 		$data = array(
			'id' => '',
			'ads_link' => $this->input->post('link'),
			'position' => $this->input->post('position'),
  			'images' => $img,			 
		);
		$this->db->insert('home_ads', $data);
	}
public function update_home_adse($id = NULL,$imgs = NULL){

		if($imgs != ""){
			
 		    $data = array(
 			'ads_link' => $this->input->post('url'),
			'position' => $this->input->post('position'),
 			'images' => $imgs,	
		);
		 
	}
	else{
    $data = array(
 			
			'ads_link' => $this->input->post('url'),
			'position' => $this->input->post('position'),
		);
	}
	$this->db->where('id', $id);
    if($this->db->update('home_ads', $data)){
    	return TRUE ;
    }else{
    	return FALSE ;
    }
}
public function all_home_text(){
  		
  		$result = $this->db->get('home_text')->result();
		return $result;
 	}
 	public function delete_home_text(){
        $id = $this->uri->segment(4);	
        $this->db->where('id', $id); 
	   $this->db->delete('home_text') ;
	}
	public function view_home_text($id){
       $this->db->where('id', $id);
       $result = $this->db->get('home_text')->row();
	   return $result ;
    }
    public function add_home_txt()
	{	
 		$data = array(
			'id' => '',
			'content' => $this->input->post('editor1'),
			'text_place' => $this->input->post('position'),
					 
		);
		$this->db->insert('home_text', $data);
	}
	public function update_home_txt(){
       $id = $this->input->post('id12');
		$data = array(
			 
			'content' => $this->input->post('editor1'),
			'text_place' => $this->input->post('position'),
					 
		);
	$this->db->where('id', $id);
    if($this->db->update('home_text', $data)){
    	return TRUE ;
    }else{
    	return FALSE ;
    }
}
}

/* End of file General_setting_m.php */
/* Location: ./application/models/General_setting_m.php */