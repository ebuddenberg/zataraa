<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('orders_m');
		$this->load->library("pagination");
	}


	public function index()
	{	

		$this->data['title']="Orders List";
		
		$this->data['orders'] = $this->orders_m->orders();
		$this->load->view('order-list', $this->data);
	}




	public function new_order(){
		$this->data['title']="Orders List";
		$config = array();
        $config["base_url"] = base_url() . "admin/orders/new_order";
        $config["total_rows"] = $this->orders_m->orders_new_count();
        $config["total_rows"] = $config["total_rows"];
		$config["num_links"] = $config["total_rows"];
		$config["per_page"] = 20;
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
        if($this->uri->segment(4) == 0)
		{
		    $offset = 0;
		}
		else
		{
		    $offset = ($config['per_page'])*($this->uri->segment(4)-1);
		}
		$this->data['orders'] = $this->orders_m->orders_new($config["per_page"], $offset);
		$this->load->view('order-list', $this->data);
	}

	public function order_report(){
		$this->data['title'] = "Orders Report";
		$this->data['total_order'] = $this->orders_m->get_total_order();
		$this->data['current_month_order'] = $this->orders_m->get_current_month_order();
		$this->data['today_order'] = $this->orders_m->get_today_order();
		$this->data['shipped_order'] = $this->orders_m->get_shipped_order();
		$this->data['confirmed_order'] = $this->orders_m->get_confirmed_order();
        $this->data['processing_order'] = $this->orders_m->get_processing_order();
        $this->data['on_hold_order'] = $this->orders_m->get_on_hold_order();
        $this->data['completed_order'] = $this->orders_m->get_completed_order();
        $this->data['cancelled_order'] = $this->orders_m->get_cancelled_order();
        $this->data['refunded_order'] = $this->orders_m->get_refunded_order();
        $this->data['failed_order'] = $this->orders_m->get_failed_order();
        $this->data['delivered_order'] = $this->orders_m->get_delivered_order();
        $this->data['get_order_amount'] = $this->orders_m->get_order_amount();
        
		$this->load->view('orders_report', $this->data);
	}

	public function order_status_view(){
		$id = $this->uri->segment(4);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($this->orders_m->order_status_view($id)));

	}
	public function update_orders(){

		 $result = $this->orders_m->update_orders() ;
		$method = $this->router->fetch_method();
		if($result){
			redirect('admin/orders','refresh');
		}
		
	}
	public function order_information(){

		$id = $this->uri->segment(4);

		$result = $this->orders_m->order_product_information($id);

		echo $result ;
		
	}


	public function export(){
		$orders = $this->orders_m->get_orders_details_by_ids();

		$fileName = 'data-'.time().'.xls';  
    // load excel library
        $this->load->library('excel');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'OrderNumber');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'SKU');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Quantity');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'ProductTitle');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'CustomerName');   

        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Address1');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Address2'); 

        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'City');

        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Province');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'ZIP');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Country');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'ShippingPhoneNumber'); 
        // set Row
        $rowCount = 2;
        foreach ($orders as $element) {

        	$product = json_decode($element->product_orderd);
        	$quantity = (array)json_decode($element->quantity);
        	foreach ($product as $data) {
        	$product_details = $this->product_details_by_sku($data);
        	if(count($product_details) != 0){
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element->id);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $product_details[0]->sku);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $quantity[$product_details[0]->sku]);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $product_details[0]->product_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element->billing_first_name.$element->billing_last_name);
              $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element->billing_address_one);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element->billing_address_two);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $element->billing_city);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $element->billing_state);

            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $element->billing_zip);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $element->billing_country);
             $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $element->billing_phone);
            $rowCount++;
        }
}

        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        
        $objWriter->save($_SERVER['DOCUMENT_ROOT'].'/orders/'.$fileName);
    // download file
        // header("Content-Type: application/vnd.ms-excel");
        echo(site_url().'orders/'.$fileName);        

		
	}
	public function delete(){

		$id= $this->uri->segment(4);
		$this->db->where('id', $id);
		$this->db->delete('orders');
	}

	public function product_details_by_sku($id){

		$this->db->select('products.*,variation_product.*');
		$this->db->from('products');
		$this->db->join('variation_product', 'products.product_id = variation_product.parent_id', 'left');
		$this->db->where('variation_product.sku', $id);
		return $this->db->get()->result();
	}
	
	public function shipped_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
		$this->db->where('order_status','shipped');
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
		public function confirmed_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
		$this->db->where('order_status','confirmed');
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
	public function processing_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
		$this->db->where('order_status','processing');
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
	public function on_hold_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
		$this->db->where('order_status','on_hold');
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
	public function completed_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
		$this->db->where('order_status','completed');
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
	public function cancelled_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
		$this->db->where('order_status','cancelled');
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
		public function refunded_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
		$this->db->where('order_status','refunded');
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
		public function failed_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
		$this->db->where('order_status','failed');
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
	public function delivered_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
		$this->db->where('order_status','delivered');
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
	public function order_amount_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
	public function order_this_month_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
	    $this->db->like('createdAt', date('Y-m'));
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}
		public function today_orders(){
	   	$this->data['title']="Orders List";
	    $this->db->order_by('id', 'desc');
	    $this->db->like('createdAt', date('Y-m-d'));
		$this->data['orders'] = $this->db->get('orders')->result();
	    $this->load->view('order-list', $this->data);

	}

}

/* End of file Order.php */
/* Location: ./application/modules/admin/controllers/Order.php */