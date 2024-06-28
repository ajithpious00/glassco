<?php
error_reporting(0);
class Logout extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}
	
	public function index(){
		$this->session->unset_userdata('US_Id');
		$this->session->unset_userdata('US_Name');
		header('location:'.base_url());
	}
	
}