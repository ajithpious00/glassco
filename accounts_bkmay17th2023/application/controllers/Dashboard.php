<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	public function index()
	{
		 if($this->authenticaton->is_logged_in())
		 {	
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
			 //   $this->load->view('dashboard');
				$this->load->view('templates/layout/footer');	
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	}
}
?>