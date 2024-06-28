<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() { 
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('staff/Home_Model');
				
	}
	public function index(){
		if(!$this->session->userdata('US_Id')) {
			header('location:'.base_url());
		}
		else{
			//echo('hlo');exit();
			$data['pageTitle']  = 'Glassco | Home';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/home/home',$data);
			$this->load->view('staff/common/footer');
		}
	}
}
