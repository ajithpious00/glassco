<?php
error_reporting(0);
class Logout extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index()
	{
		$this->session->unset_userdata('US_Id');
		$this->session->unset_userdata('US_Name');
		$this->session->unset_userdata('Email');
		$this->session->unset_userdata('DURATION');
		$this->session->unset_userdata('CTST_Id');
		$this->session->unset_userdata('Logged_In');
		$this->session->unset_userdata('YEAR');
		$this->session->unset_userdata('from');
		$this->session->unset_userdata('to');
		header('location:'.base_url());
	}
}
