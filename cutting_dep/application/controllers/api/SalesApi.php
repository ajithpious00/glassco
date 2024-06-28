<?php
require APPPATH . 'libraries/REST_Controller.php';
class SalesApi extends REST_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('Authorization_Token', 'form_validation'));
		$this->load->helper('url');
		$this->load->model('ApiModel');
	}
	public function login_post()
	{
		$phone = $this->input->post('phone');
		$password = $this->input->post("password");
		if ($phone != "" && $password != "") {
			$result = $this->ApiModel->login($phone, $password);
			if ($result == true) {
				$token_data['user_id'] = $result->US_Id;
				$token_data['name'] = $result->name;
				$token_data['email'] = $result->email;
				$token_data['mobile'] = $result->phone;
				$token_data['city'] = $result->area;
				//$tokenData = $this->authorization_token->generateToken($token_data);
				unset($result->US_Id);
				unset($result->name);
				unset($result->email);
				unset($result->phone);
				unset($result->area);
				//$result->token = $tokenData;
				//$decodedToken = $this->authorization_token->validateToken($tokenData);
				//echo "<pre>";
				$headers = $this->input->request_headers();
				print_r($headers); exit;
				$array = array('status' => 200, 'success' => true, 'data' => $result);
			} else {

				$array = array('status' => 200, 'success' => false, 'message' => 'Login Failed, Please try again');
			}
		} else {
			$array = array('status' => 200, 'success' => false, 'message' => 'Empty');
		}
		$this->response($array);
	}
	public function getProfile_get()
	{
		$headers = $this->input->request_headers();
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		if ($decodedToken['status'] == false) {
			$array = array('status' => 200, 'success' => false, 'message' => 'Invalid token');
		} else {
			$phone = $this->input->get('phone');
			$password = $this->input->get("password");
			$user_id = $decodedToken['data']->user_id;
			$result = $this->ApiModel->getProfile($user_id);
			if ($result == true) {
				$array = array('status' => 200, 'success' => true, 'message' => 'Successful', 'data' => $result);
			} else {
				$array = array('status' => 200, 'success' => false, 'message' => 'UnSuccessful');
			}
		}
		$this->response($array);
	}
	public function updateProfile_post()
	{
		$headers = $this->input->request_headers();
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		if ($decodedToken['status'] == false) {
			$array = array('status' => 200, 'success' => false, 'message' => 'Invalid token');
		} else {
			if ($this->input->post('name') != "") {
				$name = $this->input->post('name');
			} else {
				$name = $decodedToken['data']->name;
			}
			if ($this->input->post('email') != "") {
				$email = $this->input->post('email');
			} else {
				$email = $decodedToken['data']->email;
			}
			if ($this->input->post('phone') != "") {
				$phone = $this->input->post('phone');
			} else {
				$phone = $decodedToken['data']->mobile;
			}
			$user_id = $decodedToken['data']->user_id;
			$result = $this->ApiModel->updateProfile($user_id, $name, $email, $phone);
			if ($result == true) {
				$array = array('status' => 200, 'success' => true, 'message' => 'Updated');
			} else {
				$array = array('status' => 200, 'success' => false, 'message' => 'Not Updated');
			}
		}
		$this->response($array);
	}
	public function uploadProfile_post()
	{
		$headers = $this->input->request_headers();
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		if ($decodedToken['status'] == false) {
			$array = array('status' => 200, 'success' => false, 'message' => 'Invalid token');
		} else {
			$array = array();
			$new_name = $_FILES["profile"]['name'];
			$config['file_name'] = $new_name;
			$config['upload_path'] = './assets/uploads/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			$this->path = './assets/uploads/';

			if (!$this->upload->do_upload('img_file')) {
				if ($this->form_validation->error_string() != "") {
					$res['msg'] = $this->form_validation->error_string();
					$res['class'] = "error";
				}
			} else {
				$upload = $this->upload->data();
				$data = array(
					'file' => $upload['file_name']
				);
				$filename = $upload['file_name'];
				$user_id = $decodedToken['data']->user_id;
				$file = $data['file'];
				$result = $this->ApiModel->uploadProfile($user_id, $file);
				if ($result == true) {
					$array = array('status' => 200, 'success' => true, 'message' => 'Upload Successful', 'data' => $filename);
				} else {
					$array = array('status' => 200, 'success' => false, 'message' => 'Upload UnSuccessful');
				}
			}
		}
		$this->response($array);
	}
	public function addEnquiry_post()
	{
		$headers = $this->input->request_headers();
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		if ($decodedToken['status'] == false) {
			$array = array('status' => 200, 'success' => false, 'message' => 'Invalid token');
		} else {
			$name = $this->input->post('name');
			$phone = $this->input->post("phone");
			$address = $this->input->post("address");
			$products = json_decode($this->input->post("products"));
			$additionalDatas = json_decode($this->input->post("additionalData"));
			$deliveryDate = $this->input->post("deliveryDate");
			$additionalDetails = $this->input->post("additionalDetails");
			$gstNumber = $this->input->post("gstNumber");
			$user_id = $decodedToken['data']->user_id;
			// print_r($products);
			// exit();
			$result = $this->ApiModel->addEnquiry($user_id, $name, $address, $phone, $products, $deliveryDate, $additionalDetails,$additionalDatas, $gstNumber);
			if ($result == true) {
				$array = array('status' => 200, 'success' => true, 'message' => 'Added Successful');
			} else {
				$array = array('status' => 200, 'success' => false, 'message' => 'Adding UnSuccessful');
			}
		}
		$this->response($array);
	}
	public function validateToken_get()
	{
		$headers = $this->input->request_headers();
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		if ($decodedToken['status'] == false) {
			$array = array('status' => 200, 'success' => false, 'message' => 'Invalid token');
		} else {
			$array = array('status' => 200, 'success' => true, 'message' => 'Valid');
		}
		$this->response($array);
	}
}