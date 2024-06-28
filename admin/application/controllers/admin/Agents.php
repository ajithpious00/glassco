<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends CI_Controller {
	public function __construct() { 
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('Agents_Model');
				
	}
	public function index(){
			$data['pageTitle']  = 'Glassco | Agents';
			$this->load->view('admin/template/layout/header');
			$this->load->view('admin/template/layout/menu');
			$this->load->view('admin/agents/agents',$data);
			$this->load->view('admin/template/layout/footer');	
			$this->load->view('admin/agents/agents_script');
		
	}
	public function thisagent($agent_id){
		//print_r($agent_id);exit();
			$response = $this->Agents_Model->get_thisagent($agent_id);
			$data['pageTitle']  = 'oberon | Order Detail';
			$data['agentDetails'] = $response;
			$this->load->view('admin/template/layout/header',$data);
			$this->load->view('admin/template/layout/menu');
			$this->load->view('admin/agents/view_user_agents');
			$this->load->view('admin/template/layout/footer');	
			
	}	
	public function get_agents(){
		//echo('hi');exit();
		$us_id=$this->session->userdata('US_Id');
		$draw = $this->input->post("draw");
		$rowstart = $this->input->post("start");
		$rowperpage = $this->input->post("length");
		$this->input->set_cookie('agentPageLength',$rowperpage);
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
		$response = $this->Agents_Model->get_agents($tablearr,$us_id);
		echo json_encode($response);
	}
	public function add_agents($agent_id=""){
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
				$data['pageTitle']  = ' Glassco |Add  Agents';
				$data['pageTitle']  = 'Glassco | Agents';
				$this->load->view('admin/template/layout/header');
				$this->load->view('admin/template/layout/menu');
				$this->load->view('admin/agents/agents_add',$data);
				$this->load->view('admin/template/layout/footer');	
				$this->load->view('admin/agents/agents_add_script');
			}
		
	}
	public function save(){
		$errors="";
		$this->form_validation->set_rules('agname', 'Agent Name', 'trim|required');
		$this->form_validation->set_rules('agcode', 'Agent Codde', 'trim|required');
		$this->form_validation->set_rules('agpicode', 'Agent PI Codde', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone Number', 'trim|required');
		$this->form_validation->set_rules('email', 'Agent Email', 'trim|required');
		$this->form_validation->set_rules('adress', 'Agent Address', 'trim|required');
		$this->form_validation->set_rules('district', 'Agent District', 'trim|required');
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
				$data['AG_Name'] = $this->input->post('agname');
				$data['AG_Code'] = $this->input->post('agcode');
				$data['AG_PI_Code'] = $this->input->post('agpicode');
				$data['AG_Phone'] = $this->input->post('phone');
				$data['AG_Email'] = $this->input->post('email');
				$data['AG_address'] = $this->input->post('adress');
				$data['AG_Status'] = $this->input->post('status');
				$data['AG_District'] = $this->input->post('district');
				$data['AG_Type'] = 1;
				$this->Agents_Model->insertagents($data);
				$dat['AG_Id'] = $this->db->insert_id();
				$dat['AB_Bank_Name'] = $this->input->post('bankname');
				$dat['AB_Branch'] = $this->input->post('branchname');
				$dat['AB_Ifsc_Code'] = $this->input->post('ifsc');
				$dat['AB_Ac_No'] = $this->input->post('acno');
				$dat['AB_Type'] = 1;
				$dat['AB_Status'] = 1;
				//$data['CU_Created_at'] = date("Y-m-d H:i:s");
				//$checkCustomer = $this->Sales_Enquiries_Model->checkCustomer($data);
				/*if ($checkCustomer->CU_Id !='') {
					//echo('hi');exit();
					$cus_id = $checkCustomer->CU_Id ;
					$data['class'] = "error";
					$data['msg'] = "Customer already exists.";
				} 
				else{*/
				$this->Agents_Model->insert_agent_bank_accounts($dat);
				$data['class'] = "success";
				$data['msg'] = "Succesfully Added.";
				//}
			}
			echo json_encode($data);
		}
	}
	public function remove_agent(){
		$ag_id = $this->input->post('CID');
		$remove = $this->Agents_Model->remove_agent($ag_id);
		if($remove) {
			echo json_encode(array("status"=>1));
		}
		else {
			echo json_encode(array("status"=>0));
		}
	}
}
