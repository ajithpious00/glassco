<?php
require APPPATH . 'libraries/REST_Controller.php';
class EnquiryApi extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('Authorization_Token', 'form_validation'));
		$this->load->model('EnquiryApiModule');
	}
	public function getOrderData_get()
	{
		$headers = $this->input->request_headers();
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		if ($decodedToken['status'] == false) {
			$array = array('status' => 200, 'success' => false, 'message' => 'Invalid token');
		} else {
			$edge = $this->EnquiryApiModule->getedge();
			$product = $this->EnquiryApiModule->getproduct();
			$productUnit = $this->EnquiryApiModule->getproductUnit();
			$additionalData= $this->EnquiryApiModule->getadditionalData();
			if ($edge == true) {
				$result = array('edges' => $edge, 'products' => $product, 'units' => $productUnit,'additionalData' => $additionalData);
				$array = array('status' => 200, 'success' => true, 'message' => 'Successful', 'data' => $result);
			} else {
				$array = array('status' => 200, 'success' => false, 'message' => 'UnSuccessful');
			}
		}
		$this->response($array);
	}
	public function getOrders_post()
	{
		$headers = $this->input->request_headers();
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		if ($decodedToken['status'] == false) {
			$array = array('status' => 200, 'success' => false, 'message' => 'Invalid token');
		} else {
			$user_id = $decodedToken['data']->user_id;
			$status = $this->input->post('status');
			$page = $this->input->post('page');
			$limit = $this->input->post('limit');
			$result = $this->EnquiryApiModule->getcustomer($user_id, $status, $page, $limit);
			$data = [];
			foreach ($result as $key => $values) {
				$data[] = array(
					'CU_Id' => $values->CU_Id,
					'status' => $values->PD_Status,
					'order_id' => $values->PD_Order_No,
					'customer_name' => $values->CU_Name,
					'customer_phone' => $values->CU_Phone,
					'address' => $values->CU_Address,
					'invoice' => $values->IN_Invoice_Html,
					'products' => $this->EnquiryApiModule->getOrders($values->CU_Id, $user_id),
					'additionalData' => $this->EnquiryApiModule->additionalData($values->CU_Id),
					'deliveryDate' => $values->PD_Delivery_Date,
					'additionalDetails' => $values->AdditionalDetails,
					'gstNumber' => $values->CU_Gst_No
				);
			}
			$array = array('status' => 200, 'success' => true, 'message' => 'Successful', 'data' => $data);
		}
		$this->response($array);
	}
	public function updateEnquiry_post()
	{
		$headers = $this->input->request_headers();
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		if ($decodedToken['status'] == false) {
			$array = array('status' => 200, 'success' => false, 'message' => 'Invalid token');
		} else {
			$cu_id = $this->input->post('CU_Id');
			$name = $this->input->post('name');
			$phone = $this->input->post("phone");
			$address = $this->input->post("address");
			$products = json_decode($this->input->post("products"));
			$additionalDatas = json_decode($this->input->post("additionalData"));
			$deliveryDate = $this->input->post("deliveryDate");
			$additionalDetails = $this->input->post("additionalDetails");
			$gstNumber = $this->input->post("gstNumber");
			$user_id = $decodedToken['data']->user_id;
			$result = $this->EnquiryApiModule->updateEnquiry($cu_id, $user_id, $name, $address, $phone, $products, $deliveryDate, $additionalDetails, $gstNumber,$additionalDatas);
			if ($result == true) {
				$array = array('status' => 200, 'success' => true, 'message' => 'Added Successful');
			} else {
				$array = array('status' => 200, 'success' => false, 'message' => 'Adding UnSuccessful');
			}
		}
		$this->response($array);
	}
	public function updateSale_post()
	{
		$headers = $this->input->request_headers();
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		if ($decodedToken['status'] == false) {
			$array = array('status' => 200, 'success' => false, 'message' => 'Invalid token');
		} else {
			$order_id = $this->input->post('order_id');
			$status = $this->input->post('status');
			$result = $this->EnquiryApiModule->updateSale($order_id,$status);
			if ($result == true) {
				$array = array('status' => 200, 'success' => true, 'message' => 'Successful');
			} else {
				$array = array('status' => 200, 'success' => false, 'message' => 'UnSuccessful');
			}
		}
		$this->response($array);
	}
}