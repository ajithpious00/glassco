<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');

	}
	public function index()
	{
		if (!$this->session->userdata('US_Id')) {
			header('location:'.base_url());
		} else {
			$this->load->view('common/header');
			$this->load->view('common/menu');
			$this->load->view('home');
			$this->load->view('common/footer');
		}
	}
}
?>