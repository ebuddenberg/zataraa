<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popup_m extends MY_Model {

	protected $_table_name = 'popup_style';
	protected $_order_by = 'id';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';

	function __construct(){
		parent::__construct();
	}
   public function list_style(){

		$result = $this->db->get('popup_style')->result();
		return $result;
   }
   public function view_popup($id){
		$result = $this->get($id);
		return $result ;
	}
   public function update_popup($id = NULL,$imgs = NULL)
	{
		if($imgs != ""){
			
 		    $data = array(
			
			'title' => $this->input->post('title'),
			'desc' => $this->input->post('desc'),
			'banner' => $imgs,
			 
 		);
 		    
      $this->db->where('id', $id);

		if ($this->db->update('popup_style', $data)) {
			return TRUE ;
		}
		else{
			return FALSE ;
		}
	}else{
		$data = array(
			'title' => $this->input->post('title'),
			'desc' => $this->input->post('desc'),
		);
		$this->db->where('id', $id);
		if ($this->db->update('popup_style', $data)) {
			return TRUE ;
		}
		else{
			return FALSE ;
		}
	}
	}
	public function update_seletor($id){
		$data = array(
			'select_popup' => "No",
		);

		if ($this->db->update('popup_style', $data)) {
			$data = array(
			'select_popup' => "Yes",
		    );
            $this->db->where('id', $id);
            if ($this->db->update('popup_style', $data)) {
			return TRUE ;
		      }
		}
		else{
			return FALSE ;
		}

	}
	public function list_newsletter(){

		$result = $this->db->get('newsleter')->result();
		return $result;
   }
   public function delete_newsletter($id)
	{
		 $id = $this->uri->segment(4);
		 $this->db->where('id', $id);
         $this ->db->delete('newsleter');
		
	}
}

/* End of file Popup_m.php */
/* Location: ./application/models/Popup_m.php */