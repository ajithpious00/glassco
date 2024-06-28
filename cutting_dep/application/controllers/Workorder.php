<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

class Workorder extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('work_Order_Model');

	}
	public function index()
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			$this->load->view('common/header');
			$this->load->view('common/menu');
			$this->load->view('work_order/work_order');
			$this->load->view('common/footer');
			$this->load->view('work_order/work_order_script');
		}
	}
	public function get_work_order()
	{
		$draw = $this->input->post("draw");
		$rowstart = $this->input->post("start");
		$rowperpage = $this->input->post("length");
		$this->input->set_cookie('workorderPageLength', $rowperpage);
		$columnIndex = $_POST['order'][0]['ceolumn']; // Column index;
		$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = htmlentities($_POST['search']['value'], ENT_QUOTES); // Search value
		$tablearr = array(
			"draw" => $draw,
			"rowstart" => $rowstart,
			"rowperpage" => $rowperpage,
			"columnIndex" => $columnIndex,
			"columnSortOrder" => $columnSortOrder,
			"columnName" => $columnName,
			"searchValue" => $searchValue
		);
		$response = $this->work_Order_Model->get_work_order($tablearr);
		echo json_encode($response);
	}
	public function detailview($cus_id)
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			$response = $this->work_Order_Model->detailview($cus_id);
			$data['customerdetail'] = $this->work_Order_Model->customerview($cus_id);
			$data['additional_details'] = $this->work_Order_Model->additional_details($cus_id);
			$data['order_number'] = $this->work_Order_Model->customerview($cus_id);
			$data['pageTitle'] = 'Glassco | Sales Work Order';
			$data['view_details'] = $response;
			$this->load->view('common/header');
			$this->load->view('common/menu');
			$this->load->view('work_order/work_order_details', $data);
			$this->load->view('common/footer');
			$this->load->view('work_order/work_order_script');
			
		}
	}
	public function work_order_sticker($cus_id){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$data['pageTitle']  = 'Glassco |Work order  Sticker';
			$response = $this->work_Order_Model->detailview($cus_id);
			$data['customerdetail'] = $this->work_Order_Model->customerview($cus_id);
			$data['pageTitle']  = 'Glassco | Sales Work order';
			$data['view_details'] = $response;
			$this->load->view('common/header');
			$this->load->view('common/menu');
			$this->load->view('work_order/work_order_sticker',$data);
			$this->load->view('common/footer');
			$this->load->view('work_order/work_order_sticker_script',$data);
		}
	}
	public function update($woid){
		$data = array( 
			'PD_Status' => '5'
		 ); 
		 
		 $this->db->where('PD_Order_No',$woid)
		 ->update("tbl_sale_products", $data);
	}
}