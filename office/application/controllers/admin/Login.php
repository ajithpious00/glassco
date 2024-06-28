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
		$this->session->set_userdata('userid', $result->ID);
		$this->session->set_userdata('usertype', $result->Usertype);
		$this->session->set_userdata('username', $result->Name);
		
		if ($result){  
			redirect('admin/home');
		}
		/*else
		{
		     $data['error'] = 'Your Account is Invalid';  
			 $this->load->view('admin/login',$data);  
		}*/
		
	}	
	
	 public function logout()  
    {  
        //removing session  
        $this->session->unset_userdata('userid');  
        redirect("admin/login");  
    }  
  
}
?>