<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_products extends CI_Controller {
	public function __construct() { 
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('staff/Delivery_Products_Model');
				
	}
	public function index(){
		//echo('hi');exit();
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$data['pageTitle']  = 'Glassco | Delivery_products';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/delivery_products/delivery_products');
			$this->load->view('staff/common/footer');
			$this->load->view('staff/delivery_products/delivery_products_script');
		}
	}
	public function get_delivery_products(){
		//echo('hi');exit();
		$us_id=$this->session->userdata('US_Id');
		$draw = $this->input->post("draw");
		$rowstart = $this->input->post("start");
		$rowperpage = $this->input->post("length");
		$this->input->set_cookie('deliveryPageLength',$rowperpage);
		$columnIndex = $_POST['order'][0]['ceolumn']; // Column index;
		$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = htmlentities($_POST['search']['value'],ENT_QUOTES); // Search value
		$tablearr = array("draw"=>$draw,
						"rowstart"=>$rowstart,
						"rowperpage"=>$rowperpage,
						"columnIndex"=>$columnIndex,
						"columnSortOrder"=>$columnSortOrder,
						"columnName"=>$columnName,
						"searchValue"=>$searchValue);
		$response = $this->Delivery_Products_Model->get_delivery_products($tablearr,$us_id);
		echo json_encode($response);
	}
	/*public function mobileEnquary($cus_id)
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			$data['customerdetail'] = $this->Mobile_App_Enquiries_Model->customerview($cus_id);
			$data['view_details'] = $this->Mobile_App_Enquiries_Model->detailview($cus_id);
			$data['product'] = $this->Mobile_App_Enquiries_Model->get_Productname();
			$data['product_unit'] = $this->Mobile_App_Enquiries_Model->get_Product_unit();
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/mobile_app_enquiries/mobile_enquiries', $data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/mobile_app_enquiries/mobile_enquiries_script');
		}
	}*/
	public function detailview($cus_id){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$response = $this->Delivery_Products_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Delivery_Products_Model->customerview($cus_id);
			$data['pageTitle']  = 'Glassco | Delivery Products';
			$data['view_details'] = $response;
			//print_r($data['view_details']);exit();
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/delivery_products/delivery_products_detail_view',$data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/delivery_products/delivery_products_script');	
		}
	}
	public function performa_invoice($cus_id){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$response = $this->Delivery_Products_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Delivery_Products_Model->customerview($cus_id);
			$data['order_number'] = $this->Delivery_Products_Model->customerview($cus_id);
			$data['total_amount'] = $this->Delivery_Products_Model->totalamount($cus_id);
			$data['additional_details'] = $this->Delivery_Products_Model->additional_details($cus_id);
			$data['total_additional_charges'] = $this->Delivery_Products_Model->total_additional_charge($cus_id);
			$total_charges = $this->Delivery_Products_Model->totalamount($cus_id);
			$respon = $total_charges->grand_total;
			$total_additional = $this->Delivery_Products_Model->total_additional_charge($cus_id);
			$total_additionals = $total_additional->total_additional_charges;
			$data['grand_totals'] = $respon + $total_additionals;
			$data['view_details'] = $response;
			//print_r($data['view_details']);exit();
			$data['pageTitle']  = 'Glassco | Approved Enquiries Performa Invoice';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/delivery_products/performa_invoice',$data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/mobile_app_enquiries/performa_invoice_script');
		}
	}
	public function remove_sales(){
		$cus_id = $this->input->post('CID');
		$remove = $this->Delivery_Products_Model->remove_sales($cus_id);
		if($remove) {
			echo json_encode(array("status"=>1));
		}
		else {
			echo json_encode(array("status"=>0));
		}
	}
	/*public function save_proforma_invoice() {
		$invoiceData = $this->input->post('invoiceDoc');
		$cuid = $this->input->post('cuid');
		$wo = $this->input->post('wo');
		$saveInvoice = $this->Mobile_App_Enquiries_Model->saveInvoice($invoiceData, $cuid, $wo);
		echo json_encode(1);
	}*/
}
