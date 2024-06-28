<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile_app_enquiries extends CI_Controller {
	public function __construct() { 
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('staff/Mobile_App_Enquiries_Model');
				
	}
	public function index(){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$data['pageTitle']  = 'Glassco | Mobile App Enquiries';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/mobile_app_enquiries/mobile_app_enquiries');
			$this->load->view('staff/common/footer');
			$this->load->view('staff/mobile_app_enquiries/mobile_app_enquiries_script');
		}
	}
	public function get_mobile_enquiries(){
		$draw = $this->input->post("draw");
		$rowstart = $this->input->post("start");
		$rowperpage = $this->input->post("length");
		$this->input->set_cookie('mobilePageLength',$rowperpage);
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
		$response = $this->Mobile_App_Enquiries_Model->get_mobile_enquiries($tablearr);
		echo json_encode($response);
	}
	public function mobileEnquary($cus_id)
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
	}
	public function detailview($cus_id){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$response = $this->Mobile_App_Enquiries_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Mobile_App_Enquiries_Model->customerview($cus_id);
			$data['pageTitle']  = 'Glassco | Sales Enquiries';
			$data['view_details'] = $response;
			//print_r($data['view_details']);exit();
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/mobile_app_enquiries/mobile_app_enquiry_detail_view',$data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/mobile_app_enquiries/mobile_app_enquiries_script');	
		}
	}
	public function performa_invoice($cus_id){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$response = $this->Mobile_App_Enquiries_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Mobile_App_Enquiries_Model->customerview($cus_id);
			$data['order_number'] = $this->Mobile_App_Enquiries_Model->customerview($cus_id);
			$data['total_amount'] = $this->Mobile_App_Enquiries_Model->totalamount($cus_id);
			$data['additional_details'] = $this->Mobile_App_Enquiries_Model->additional_details($cus_id);
			$data['total_additional_charges'] = $this->Mobile_App_Enquiries_Model->total_additional_charge($cus_id);
			$total_charges = $this->Mobile_App_Enquiries_Model->totalamount($cus_id);
			$respon = $total_charges->grand_total;
			$total_additional = $this->Mobile_App_Enquiries_Model->total_additional_charge($cus_id);
			$total_additionals = $total_additional->total_additional_charges;
			$data['grand_totals'] = $respon + $total_additionals;
			$taxable = $this->Mobile_App_Enquiries_Model->taxable_amount($cus_id);
			$taxableamount = $taxable->total_price;
			$data['taxable_amounts'] = $taxableamount + $total_additionals;
			$tax =  $taxableamount + $total_additionals;
			$data['cgst'] = $tax  *(9 / 100);
			$data['sgst'] = $tax  *(9 / 100);
			$data['total_tax'] = $data['cgst'] + $data['sgst'];
			$data['grand_total'] = $data['total_tax'] +  $data['taxable_amounts'];
			$data['pageTitle']  = 'Glassco | Sales Enquiries';
			$data['view_details'] = $response;
			//print_r($data['view_details']);exit();
			$data['pageTitle']  = 'Glassco | Sales Enquiries Performa Invoice';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/mobile_app_enquiries/performa_invoice',$data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/mobile_app_enquiries/performa_invoice_script');
		}
	}
	public function remove_sales(){
		$cus_id = $this->input->post('CID');
		$remove = $this->Mobile_App_Enquiries_Model->remove_sales($cus_id);
		if($remove) {
			echo json_encode(array("status"=>1));
		}
		else {
			echo json_encode(array("status"=>0));
		}
	}
	public function save_proforma_invoice() {
		$invoiceData = $this->input->post('invoiceDoc');
		$cuid = $this->input->post('cuid');
		$wo = $this->input->post('wo');
		$saveInvoice = $this->Mobile_App_Enquiries_Model->saveInvoice($invoiceData, $cuid, $wo);
		echo json_encode(1);
	}
}
