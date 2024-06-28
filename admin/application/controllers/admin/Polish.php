<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Polish extends CI_Controller {
	public function __construct() { 
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('Polish_Model');
				
	}
	public function index(){
	
			$data['pageTitle']  = 'Glassco | Polish';
			$this->load->view('admin/template/layout/header');
			$this->load->view('admin/template/layout/menu');
			$this->load->view('admin/polish/polish',$data);
			$this->load->view('admin/template/layout/footer');	
			$this->load->view('admin/polish/polish_script');
		
		}
	public function get_polish(){
		$us_id=$this->session->userdata('US_Id');
		$draw = $this->input->post("draw");
		$rowstart = $this->input->post("start");
		$rowperpage = $this->input->post("length");
		$this->input->set_cookie('polishPageLength',$rowperpage);
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
		$response = $this->Polish_Model->get_polish($tablearr,$us_id);
		echo json_encode($response);
	}
	public function add_polish($agent_id=""){
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
				$this->load->view('admin/template/layout/header');
				$this->load->view('admin/template/layout/menu');
				$this->load->view('admin/polish/polish_add',$data);
				$this->load->view('admin/template/layout/footer');	
				$this->load->view('admin/polish/polish_add_script');
			}
	}
	public function save(){
		$errors="";
		$this->form_validation->set_rules('poname', 'Polish Name', 'trim|required');
		$this->form_validation->set_rules('pohsn', 'Polish HSN Code', 'trim|required');
		$this->form_validation->set_rules('status', 'Agent Status', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			//echo('hi');exit();
			if($this->form_validation->error_string()!=""){
				$data['msg'] = $this->form_validation->error_string();
				$data['class'] = "error";
			}
		}
		else{
			if($this->input->post('row')==""){
				$data['PO_Name'] = $this->input->post('poname');
				$data['PO_Hsn_Code'] = $this->input->post('pohsn');
				$data['PO_Status'] = $this->input->post('status');
				$data['PO_Type'] = 1;
				//$data['CU_Created_at'] = date("Y-m-d H:i:s");
				//$checkCustomer = $this->Sales_Enquiries_Model->checkCustomer($data);
				/*if ($checkCustomer->CU_Id !='') {
					//echo('hi');exit();
					$cus_id = $checkCustomer->CU_Id ;
					$data['class'] = "error";
					$data['msg'] = "Customer already exists.";
				} 
				else{*/
					$this->Polish_Model->insertpolish($data);
					$data['class'] = "success";
					$data['msg'] = "Succesfully Added.";
				//}
			}
			echo json_encode($data);
		}
	}
	public function remove_polish(){
		$pl_id = $this->input->post('CID');
		$remove = $this->Polish_Model->remove_polish($pl_id);
		if($remove) {
			echo json_encode(array("status"=>1));
		}
		else {
			echo json_encode(array("status"=>0));
		}
	}
}
