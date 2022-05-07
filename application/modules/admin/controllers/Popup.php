<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popup extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('popup_m');
		 
	}

	public function index()
	{
		$this->data['title']="Popup style List";
        $this->data["popuplist"] = $this->popup_m->list_style();
		$this->load->view('popuplist', $this->data);
		
	}
	public function view_popup(){
		$id = $this->uri->segment(4);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->popup_m->view_popup($id)));
 	}
	public function update_popup()
	{  $id = $this->input->post('id');
              if (isset($id)) {

              	$config['upload_path'] = './admin-assets/';
                $config['allowed_types'] = 'gif|jpg|png';
		        $this->load->library('upload', $config);
                if (!$this->upload->do_upload('thumbnail')) {
			            $this->popup_m->update_popup($id);
	 			        $redirect  = 'admin/popup';
	 			        redirect($redirect,'refresh');
			             
			        } 
			        else {
			            $data = array('image_metadata' => $this->upload->data());
			            $image_name =  $data['image_metadata']['file_name'];
                        $this->popup_m->update_popup($id,$image_name);
	 			        $redirect  = 'admin/popup';
	 			        redirect($redirect,'refresh');
 			        }
                 }else{
              	echo "Something going wrong...";
              }
 	}
 	public function update_seletor(){
 		$id = $this->uri->segment(4);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->popup_m->update_seletor($id)));
		$redirect  = 'admin/popup';
 	}

 	public function newsletter(){
 		$this->data['title']="Newsletter";
        $this->data["newsletterlist"] = $this->popup_m->list_newsletter();
		$this->load->view('newsleter-list', $this->data);
 	}
 	public function delete_newsletter(){
		$this->popup_m->delete_newsletter() ;
 		redirect("admin/popup/newsletter",'refresh');
 	}
    
}

/* End of file Popup.php */
/* Location: ./application/modules/admin/controllers/Popup.php */