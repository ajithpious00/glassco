<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Approved_enquiries extends CI_Controller {
	public function __construct() { 
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('staff/Approved_Enquiries_Model');
				
	}
	public function index(){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$data['pageTitle']  = 'Glassco | Approved Enquiries';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/approved_enquiries/approved_enquiries');
			$this->load->view('staff/common/footer');
			$this->load->view('staff/approved_enquiries/approved_enquiries_script');
		}
	}
	public function get_approved_enquiries(){
		$us_id=$this->session->userdata('US_Id');
		$draw = $this->input->post("draw");
		$rowstart = $this->input->post("start");
		$rowperpage = $this->input->post("length");
		$this->input->set_cookie('approvePageLength',$rowperpage);
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
		$response = $this->Approved_Enquiries_Model->get_approved_enquiries($tablearr,$us_id);
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
			$response = $this->Approved_Enquiries_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Approved_Enquiries_Model->customerview($cus_id);
			$data['pageTitle']  = 'Glassco | Sales Enquiries';
			$data['view_details'] = $response;
			//print_r($data['view_details']);exit();
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/approved_enquiries/approved_enquiries_detail_view',$data);
			$this->load->view('staff/common/footer');
			//$this->load->view('staff/approved_enquiries/approved_enquiries_detail_view_script');	
		}
	}
	public function work_order($cus_id){
			if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			// $this->Approved_Enquiries_Model->update_accept_status($cus_id);
			$response = $this->Approved_Enquiries_Model->detailview($cus_id);
			$get_cut_type = $this->Approved_Enquiries_Model->get_cut_type($cus_id);
			$cut_type = $get_cut_type->SP_Type;
			if($cut_type == 1){
				$data['cut_type'] = 'Normal';
			}
			else{
				$data['cut_type'] = 'Special';
			}
			if($response) {
				$prodArr  = array();
				$prodList = array();
				$prodAdds = array();
				$i = 0;
				//print_r($response);exit();
				$data['total_additional_charges'] = 0;
				foreach($response  as $rs) {
					$prodList['Edge_type'] = $rs->Edge_type;
					$prodList['HSN_code'] = $rs->PD_Hsn_Code;
					$prodList['UN_Name'] = $rs->UN_Name;
					$prodList['UN_Id'] = $rs->UN_Id;
					$prodList['ED_Id'] = $rs->ED_Id;
					$prodList['PD_Name'] = $rs->PD_Name;
					$prodList['PD_Height_Nl'] = $rs->PD_Height_Nl;
					$prodList['PD_Weight_Nl'] = $rs->PD_Weight_Nl;
					$prodList['PD_Cus_Height'] = $rs->PD_Cus_Height;
					$prodList['PD_Cus_Width'] = $rs->PD_Cus_Width;
					$prodList['PD_waste'] = $rs->PD_Waste;
					$prodList['PD_Quantity'] = $rs->PD_Quantity;
					$prodList['sqf'] = $rs->sqf;
					$prodList['sqm'] = $rs->sqm;
					$prodList['rate'] = $rs->PD_Price;
					$prodList['PR_Weight'] = $rs->PR_Weight;
					//$prodList['Product_weight'] = $rs->Product_weight;
					$prodList['product_quantity_sqm'] = $rs->product_quantity_sqm;
					$prodList['total_rate'] =$prodList['product_quantity_sqm'] * $prodList['rate'];
					$prodList['PO_Name'] =$rs->PO_Name;
					$prodList['PO_Hsn_Code'] =$rs->PO_Hsn_Code;
					$prodList['PO_Rate'] =$rs->PI_Rate;
					$prodList['total__polish_rate'] =$prodList['product_quantity_sqm'] * $prodList['PO_Rate'];
					$add_response = $this->Approved_Enquiries_Model->additional_details($rs->SP_Id);
					//echo count($add_response);
					if($add_response) {
						$j = 0;
						
						foreach($add_response as $ad) {
							if($ad->AU_Type == 1 || $ad->AU_Type == 3){
								
								$prodAdds[$j]['AU_Item'] = $ad->AU_Item;
								$prodAdds[$j]['AD_Quantity'] = $ad->AD_Quantity;
								$prodAdds[$j]['AD_Unit_Price'] = $ad->AD_Unit_Price;
								$prodAdds[$j]['AD_Total_Amount'] = $ad->AD_Total_Amount;
								$prodAdds[$j]['listing_price'] = $ad->listing_price;
								$prodList['product_adds'] = $prodAdds;
								
							}
							elseif($ad->AU_Type == 2) {
								$prodAdds[$j]['AU_Item'] = $ad->AU_Item;
								$prodAdds[$j]['AD_Quantity'] = $prodList['product_quantity_sqm'];
								$prodAdds[$j]['AD_Unit_Price'] = $ad->AD_Unit_Price;
								$prodAdds[$j]['AD_Total_Amount'] = $ad->AD_Total_Amount;
								$prodAdds[$j]['listing_pric'] = $ad->listing_price;
								$prodAdds[$j]['listing_price'] =  round($prodAdds[$j]['listing_pric'] * $prodList['product_quantity_sqm'],2);
								$prodList['product_adds'] = $prodAdds;
								
							}
							
							$data['total_additional_charges'] = $data['total_additional_charges'] + $prodAdds[$j]['listing_price'];
							
							$j++;
							//$data['total_additional_charges'] = $data['total_additional_charges'] + $prodAdds[$j]['listing_price'];
						}
						
					}
					
					$total_addition  = $this->Approved_Enquiries_Model->total_additional_charge($rs->SP_Id);
					$total_additional_charg = $total_addition->total_listing_price;
					//print_r($total_additional_charg);exit();
					$prodArr[$i] = $prodList;
					$i++;
					//echo $prodAdds[$j]['listing_price'];
					
				}
			}
			$work_no = $this->Approved_Enquiries_Model->get_work_order_no($cus_id);
			$data['work_order_no'] = $work_no->PD_Order_No;
			$pi_code = $this->Approved_Enquiries_Model->get_pi_code($cus_id);
			$agent_pi_code = $pi_code->AG_PI_Code;
			$agent_pi_code_no = $pi_code->AG_PI_Code_No;
			$generate_pi = $agent_pi_code . $agent_pi_code_no;
			//print_r($generate_pi);exit();
			$data['pi_code'] = $generate_pi;
			$add_deta = $this->Approved_Enquiries_Model->total_additional_char($cus_id);
			//print_r($add_deta->total_amount);exit();
			$data['add_deta'] = $add_deta->total_amount;
			//$data['total_additional_charges'] = $data['total_additional_charg'] + $add_deta->
			//$data['total_additional_charges'] = $total_additional_charg;
			//print_r($data['total_additional_charges']);exit();
			$data['total_weight_product'] = $total_additional_charg;
			$data['prodArr'] = $prodArr;
			$data['add_dh'] = $this->Approved_Enquiries_Model->total_additional_dh($cus_id);
			$data['add_ch'] = $this->Approved_Enquiries_Model->total_additional_ch($cus_id);
			$data['add_th'] = $this->Approved_Enquiries_Model->total_additional_th($cus_id);
			$data['add_hh'] = $this->Approved_Enquiries_Model->total_additional_hh($cus_id);
			
			$data['customerdetail'] = $this->Approved_Enquiries_Model->customerview($cus_id);
			$data['agentdetail'] = $this->Approved_Enquiries_Model->agent_detail($cus_id);
			$data['order_number'] = $this->Approved_Enquiries_Model->customerview($cus_id);
			$data['total_amount'] = $this->Approved_Enquiries_Model->totalamount($cus_id);
			$data['additional_details'] = $this->Approved_Enquiries_Model->additional_details($cus_id);
			//$addit = $this->Sales_Enquiries_Model->additional_details($cus_id);
			//$data['SP_Id'] =$addit->SP_Id;
			//print_r($data['SP_Id']);exit();
			//$data['total_additional_charges'] = $this->Sales_Enquiries_Model->total_additional_charge($cus_id);
			$total_additional  = $this->Approved_Enquiries_Model->total_additional_charge($cus_id);
			$total_addition  = $this->Approved_Enquiries_Model->total_additional_charge($response->SP_id);
			$data['total_additional_charge'] = $total_addition->total_listing_price;
			//print_r($data['total_additional_charge']);exit();
			//$data['total_additional_charges'] = round($data['total_additional_charge'],2);
			$total_charges = $this->Approved_Enquiries_Model->totalamount($cus_id);
			$respon = $total_charges->grand_total;
			$total_additional = $this->Approved_Enquiries_Model->total_additional_charge($cus_id);
			$total_additionals = $total_additional->total_additional_charges;
			$data['grand_totals'] = $respon + $total_additionals;
			//$taxable = $this->Sales_Enquiries_Model->taxable_amount($cus_id);
			//$taxableamount = $taxable->total_price;
			$total_sqs = $this->Approved_Enquiries_Model->total_sqs($cus_id);
			$data['price'] = $total_sqs->PD_Price;
			$data['net_price'] = $total_sqs->total_price;
			$data['net_price'] = round($data['net_price'],2);
			$data['total_sqmtr'] = $total_sqs ->sum_total_sqmtr;
			$data['polish_rate'] = $this->Approved_Enquiries_Model->get_polish_rate($cus_id);
			$polish_rate = $this->Approved_Enquiries_Model->get_polish_rate($cus_id);
			$data['net_polish_rate'] = $polish_rate->PA_Rate * ($data['total_sqmtr']);
			//print_r ($polish_rate ->PA_Rate);exit();
			$polish_rate = $this->Approved_Enquiries_Model->get_polish_rate($cus_id);
			$data['polish_rate'] = $polish_rate ->PA_Rate; 
			//$data['taxable_amounts'] = $data['net_polish_rate'] + $data['net_price'];
			$data['tax'] = $data['total_additional_charges']+ $data['taxable_amounts'];
			//print_r($data['tax']);exit();
			$data['cgst'] = $data['tax']  *(9 / 100);
			$data['cgst'] = round($data['cgst'],2);
			$data['sgst'] = $data['tax'] *(9 / 100);
			$data['sgst'] = round($data['sgst'],2);
			//print_r($data['polish_rate']);exit();
			$data['polish_name'] = $polish_rate ->PO_Name; 
			$data['polish_hsn'] = $polish_rate ->PA_Hsn; 
			$data['total_tax'] = $data['cgst'] + $data['sgst'];
			$data['grand_total'] = $data['total_tax'] +  $data['tax'];
			$data['grand_total'] = round($data['grand_total'], 2);
			$data['pageTitle']  = 'Glassco | Sales Work Order';
			$data['view_details'] = $response;
			$data['pageTitle']  = 'Glassco | Work Order';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/approved_enquiries/work_order_invoice',$data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/approved_enquiries/work_order_invoice_script');
		}
	}
	public function remove_sales(){
		$cus_id = $this->input->post('CID');
		$remove = $this->Approved_Enquiries_Model->remove_sales($cus_id);
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
