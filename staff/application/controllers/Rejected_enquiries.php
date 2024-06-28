<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Rejected_enquiries extends CI_Controller {
	public function __construct() { 
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('staff/Rejected_Enquiries_Model');
				
	}
	public function index(){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$data['pageTitle']  = 'Glassco | Rejected Enquiries';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/rejected_enquiries/rejected_enquiries');
			$this->load->view('staff/common/footer');
			$this->load->view('staff/rejected_enquiries/rejected_enquiries_script');
		}
	}
	public function get_reject_details(){
		$us_id=$this->session->userdata('US_Id');
		$draw = $this->input->post("draw");
		$rowstart = $this->input->post("start");
		$rowperpage = $this->input->post("length");
		$this->input->set_cookie('rejectPageLength',$rowperpage);
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
		$response = $this->Rejected_Enquiries_Model->get_reject_details($tablearr,$us_id);
		echo json_encode($response);
	}
	public function reject_enquiry($cus_id){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$this->Rejected_Enquiries_Model->update_status($cus_id);
			redirect(AD_BASE_PATH . 'rejected_enquiries');
			
		}
	}
	public function performa_invoice($cus_id){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$response = $this->Rejected_Enquiries_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Rejected_Enquiries_Model->customerview($cus_id);
			$data['order_number'] = $this->Rejected_Enquiries_Model->customerview($cus_id);
			$data['total_amount'] = $this->Rejected_Enquiries_Model->totalamount($cus_id);
			$data['additional_details'] = $this->Rejected_Enquiries_Model->additional_details($cus_id);
			$data['total_additional_charges'] = $this->Rejected_Enquiries_Model->total_additional_charge($cus_id);
			$total_charges = $this->Rejected_Enquiries_Model->totalamount($cus_id);
			$respon = $total_charges->grand_total;
			$total_additional = $this->Rejected_Enquiries_Model->total_additional_charge($cus_id);
			$total_additionals = $total_additional->total_additional_charges;
			$data['grand_totals'] = $respon + $total_additionals;
			$taxable = $this->Rejected_Enquiries_Model->taxable_amount($cus_id);
			$taxableamount = $taxable->total_price;
			$data['taxable_amounts'] = $taxableamount + $total_additionals;
			$tax =  $taxableamount + $total_additionals;
			$data['cgst'] = $tax  *(9 / 100);
			$data['sgst'] = $tax  *(9 / 100);
			$data['total_tax'] = $data['cgst'] + $data['sgst'];
			$data['grand_total'] = $data['total_tax'] +  $data['taxable_amounts'];
			$data['view_details'] = $response;
			//print_r($data['view_details']);exit();
			$data['pageTitle']  = 'Glassco | Reject Enquiries Performa Invoice';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/rejected_enquiries/performa_invoice',$data);
			$this->load->view('staff/common/footer');
			//$this->load->view('staff/rejected_enquiries/performa_invoice_script');
		}
	}
	public function remove_sales(){
		$cus_id = $this->input->post('CID');
		$remove = $this->Rejected_Enquiries_Model->remove_sales($cus_id);
		if($remove) {
			echo json_encode(array("status"=>1));
		}
		else {
			echo json_encode(array("status"=>0));
		}
	}
	public function detailview($cus_id){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$response = $this->Rejected_Enquiries_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Rejected_Enquiries_Model->customerview($cus_id);
			$data['pageTitle']  = 'Glassco | Reject Enquiries';
			$data['view_details'] = $response;
			//print_r($data['view_details']);exit();
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/rejected_enquiries/rejected_enquires_detail_view',$data);
			$this->load->view('staff/common/footer');
			//$this->load->view('staff/rejected_enquiries/sales_enquiries_script');	
		}
	}
}
