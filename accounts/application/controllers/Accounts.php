<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Glassco_model');
    }
	public function index()  
    {  
        $this->load->view('index.html');  
    }  
	
	
	public function userexist()
	{
	    $result=$this->Glassco_model->accountUserExist();
		
		if ($result)
		{  
			$this->session->set_userdata('glassco_accounts_userid', $result->US_Id );
			$this->session->set_userdata('glassco_accounts_usertype', $result->Usertype);
			$this->session->set_userdata('glassco_accounts_username', $result->US_Name);
			redirect('dashboard');
		}
		else
		{
		    $this->session->set_flashdata('msg', "Incorrect Login");
			redirect('/accounts');
		}
	}
	
    public function dashboard()
	{
		 if($this->authenticaton->is_logged_in())
		 { 
		    $this->load->view('templates/layout/header');
			$this->load->view('templates/layout/menu');
      	 	$this->load->view('dashboard',$data);
        	$this->load->view('templates/layout/footer');
		 }
		 else
		 {
			redirect('/accounts');
		 }  
	}	
	
	 public function logout()  
    {  
        //removing session  
        $this->session->unset_userdata('glassco_accounts_userid');  
		$this->session->unset_userdata('glassco_accounts_usertype');  
		$this->session->unset_userdata('glassco_accounts_username');  
        redirect("/accounts");  
    }  
}
?>