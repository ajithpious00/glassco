<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('staff/Login_Model');
		
	}
	public function index(){
		
		//$this->load->view('staff/login/index.html');
		$this->load->view('staff/login/login');
	}
	public function signin(){
		
		if(isset($_POST)){
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			if ($this->form_validation->run() == FALSE) {
				if($this->form_validation->error_string()!=""){
					$data['msg'] = $this->form_validation->error_string();
				}
			}
			else{
				$Email_Id = $this->input->post("email");
				$Password = md5($this->input->post("password"));
				$verfiy = $this->Login_Model->Verify_User($Email_Id,$Password);
				if (isset($verfiy)){
					$newdata = array(
										'Email' => $verfiy->Email,
										'Usertype' => $verfiy->Usertype,
										'Status' => $verfiy->Status,
										'Logged_In'=> TRUE,
										'US_Id'=> $verfiy->US_Id,
										'Name'=> $verfiy->US_Name		
									);	
					$this->session->set_userdata($newdata);
					$this->session->set_userdata($newdata);
					//print_r(AD_BASE_PATH . 'home');exit();
					redirect(AD_BASE_PATH . 'sales_enquiries');
					//print_r (AD_BASE_PATH . 'home');exit();
				}
				else
				{
					$data['msg']='<div class="alert alert-danger b" role="alert">Invalid Login credentials !';
					$this->load->view('staff/login/login',$data);
				}
			}
		}
		
	}
}
?>