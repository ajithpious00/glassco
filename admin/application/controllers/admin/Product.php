<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct() { 
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('Product_Model');
				
	}
	public function index(){
	
			$data['pageTitle']  = 'Glassco | Products';
			$this->load->view('admin/template/layout/header');
			$this->load->view('admin/template/layout/menu');
			$this->load->view('admin/product/products',$data);
			$this->load->view('admin/template/layout/footer');	
			$this->load->view('admin/product/products_script');
		
		}
	public function get_product(){
		$us_id=$this->session->userdata('US_Id');
		$draw = $this->input->post("draw");
		$rowstart = $this->input->post("start");
		$rowperpage = $this->input->post("length");
		$this->input->set_cookie('productPageLength',$rowperpage);
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
		$response = $this->Product_Model->get_product($tablearr,$us_id);
		echo json_encode($response);
	}
	public function add_products($agent_id=""){
		//echo('hi');exit();
			if($agent_id){
				//$data['data'] = $this->Category_Model->thisCategory($id);
				//$data['images'] = $this->Category_Model->getImages($id);
				//$data['pageTitle']  = ' Glassco | Sales Enquiries';
				$this->load->view('staff/common/header');
				$this->load->view('staff/common/menu');
				$this->load->view('staff/sales_enquiries/sales_enquiry_add');
				$this->load->view('staff/common/footer');
				$this->load->view('staff/sales_enquiries/sales_add_script');
			}
			else{
				$data['pageTitle']  = ' Glassco |Add  Polish';
				$data['polish_type'] = $this->Product_Model->get_polish_type();
				$this->load->view('admin/template/layout/header');
				$this->load->view('admin/template/layout/menu');
				$this->load->view('admin/product/products_add',$data);
				$this->load->view('admin/template/layout/footer');	
				$this->load->view('admin/product/products_add_script');
			}
	}
	public function save(){
		$errors="";
		$this->form_validation->set_rules('productcode', 'Product Name', 'trim|required');
		$this->form_validation->set_rules('hsncode', 'HSN Code', 'trim|required');
		$this->form_validation->set_rules('productname', 'Product Name', 'trim|required');
		$this->form_validation->set_rules('productprice', 'Product Name', 'trim|required');
		//$this->form_validation->set_rules('polishtype', 'Polish Type', 'trim|required');
		//$this->form_validation->set_rules('polishrate', 'Polish Rate', 'trim|required');
		$this->form_validation->set_rules('status', 'Agent Status', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			//echo('hi');exit();
			if($this->form_validation->error_string()!=""){
				$data['msg'] = $this->form_validation->error_string();
				$data['class'] = "error";
			}
		}
		else{
				//echo('hi');exit();
				$data['Code'] = $this->input->post('productcode');
				$data['PD_Hsn_Code'] = $this->input->post('hsncode');
				$data['PD_Name'] = $this->input->post('productname');
				$data['PR_Price'] = $this->input->post('productprice');
				$data['PR_Weight'] = $this->input->post('productweight');
				$data['Status'] = $this->input->post('status');
				$this->Product_Model->insertproduct($data);
				$pd_id = $this->db->insert_id();
				$po_id = $this->input->post('polishtype');
				$po_rate = $this->input->post('polishrate');
				$po_status = 1;
				for($i=0;$i<count($po_id);$i++){
						$dat= [
									'PO_Id'  =>  $po_id[$i],
									'PO_Rate'  =>  $po_rate[$i],
									'PD_Id'  => $pd_id,
									'PR_Status'  => $po_status,
								];	
						$this->Product_Model->insertpolish($dat);
				}
				//$data['CU_Created_at'] = date("Y-m-d H:i:s");
				//$checkCustomer = $this->Sales_Enquiries_Model->checkCustomer($data);
				/*if ($checkCustomer->CU_Id !='') {
					//echo('hi');exit();
					$cus_id = $checkCustomer->CU_Id ;
					$data['class'] = "error";
					$data['msg'] = "Customer already exists.";
				} 
				else{*/
					$data['class'] = "success";
					$data['msg'] = "Succesfully Added.";
				//}
			}
			echo json_encode($data);
		}
	public function remove_product(){
		$pd_id = $this->input->post('CID');
		$remove = $this->Product_Model->remove_product($pd_id);
		if($remove) {
			echo json_encode(array("status"=>1));
		}
		else {
			echo json_encode(array("status"=>0));
		}
	}
}
