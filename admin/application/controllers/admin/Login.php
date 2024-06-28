<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	 public function __construct()
	{
		parent::__construct();
		$this->load->model('Glassco_model');
		$this->load->library('session');
    }
	public function index()  
    {  
        $this->load->view('admin/login');  
    }  
    public function display()
	{
		$result=$this->Glassco_model->access();
		if(empty($result)){
		$data['msg']="error";
		$this->load->view("admin/login",$data);
		}
		else{  
		$this->session->set_userdata('userid', $result->US_ID);
		$this->session->set_userdata('usertype', $result->Usertype);
		$this->session->set_userdata('username', $result->US_Name);
		
		if ($result){  
			redirect('admin/viewuser');
		}
		
	}
	}	
	
	 public function logout()  
    {  
        $this->session->unset_userdata('userid');  
        redirect("admin/login");  
    }  
  
}
?>