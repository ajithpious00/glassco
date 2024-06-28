<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

class Return_order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('Return_order_Model');
	}
	public function index()
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			$this->load->view('common/header');
			$this->load->view('common/menu');
			$this->load->view('return/return_order');
			$this->load->view('common/footer');
			$this->load->view('return/return_order_script');
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
		$response = $this->Return_order_Model->get_work_order($tablearr);
		echo json_encode($response);
	}
	public function detailview($cus_id)
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			$response = $this->Return_order_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Return_order_Model->customerview($cus_id);
			$data['order_number'] = $this->Return_order_Model->customerview($cus_id);
			$data['reason'] = $this->Return_order_Model->getReturnReason($cus_id);
			$data['view_details'] = $response;
			$this->load->view('common/header');
			$this->load->view('common/menu');
			$this->load->view('return/return_order_details', $data);
			$this->load->view('common/footer');
		}
	}
	public function add_return()
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			$data['additionalitem'] = $this->Return_order_Model->get_additionalitem();
			$data['product'] = $this->Return_order_Model->get_Productname();
			$data['product_unit'] = $this->Return_order_Model->get_product_unit();
			$data['product_type'] = $this->Return_order_Model->get_product_type();
			$data['workorder_name'] = $this->Return_order_Model->get_workid();
			$this->load->view('common/header');
			$this->load->view('common/menu');
			$this->load->view('return/add_return', $data);
			$this->load->view('common/footer');
			$this->load->view('return/add_script');
		}
	}
	public function fetchdata($String)
	{
		$woid = strtoupper($String);
		$result = $this->Return_order_Model->fetchdata($woid);
		foreach ($result as $rows) {
			$data['class'] = "success";
			$data['id'] = $rows->CU_Id;
			$data['name'] = $rows->CU_Name;
			$data['phone'] = $rows->CU_Phone;
			$data['address'] = $rows->CU_Address;
			echo json_encode($data);
		}
	}
	public function save()
	{
		if ($this->input->post('row') == "") {
			$cus_id = $this->input->post('cuid');
			$order_id = $this->input->post('woid');
			$us_id = $this->session->userdata('US_Id');
			$product = $this->input->post('productname');
			$height = $this->input->post('height');
			$quantity = $this->input->post('quantity');
			$width = $this->input->post('width');
			$reason = $this->input->post('reason');
			$unit = $this->input->post('unit');
			$type = $this->input->post('type');
			$rate = $this->input->post('rate');
			$date_time = date("Y-m-d H:i:s");
			$re_status = '1';
			for ($i = 0; $i < count($height); $i++) {
				$data = [
					'PD_Id'  =>  $product[$i],
					'PD_height' => $height[$i],
					'PD_Width' => $width[$i],
					'PD_Unit' => $unit[$i],
					'ED_Id' => $type[$i],
					'PD_Quantity' => $quantity[$i],
					'PD_Price' => $rate[$i],
					'CU_Id' => $cus_id,
					'US_Id'  => $us_id,
					'Reason'=> $reason,
					'PD_Order_Date' => $date_time,
					'PD_Order_No'  => $order_id,
					'RE_Status'   => $re_status
				];

				$this->Return_order_Model->insertreturn($data);
			}
			$data['class'] = "success";
			$data['msg'] = "Succesfully Added.";
		}
		echo json_encode($data);
	}
}
