<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	 public function __construct()
	{
        parent::__construct();
        
    }
	public function index()
	{
		$this->load->view('admin/template/layout/header');
		
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/home');
		$this->load->view('admin/template/layout/footer');	

		
		
	}
}
?>