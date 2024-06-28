<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accounttype extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Accounttype_model');
    }
	public function index()
	{
		if($this->authenticaton->is_logged_in())
		{
				$data['list'] = $this->Accounttype_model->accountTypeList();
				$data['pageName']="Account Types";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('accounttype/accounttype_list',$data);
				$this->load->view('templates/layout/footer');
		 }
		 else
		 {
			redirect('/accounts');
		 }
	}
	public function accountTypeList()
	{
	    if($this->authenticaton->is_logged_in())
		{
			$data['list'] = $this->Accounttype_model->accountTypeList();
			$data['pageName']="Account Types";
			$this->load->view('templates/layout/header');
			$this->load->view('templates/layout/menu');
			$this->load->view('accounttype/accounttype_list',$data);
			$this->load->view('templates/layout/footer'); 
		 }
		 else
		 {
			redirect('/accounts');
		 }  
	}
	public function accountTypeAdd()
	{
		 if($this->authenticaton->is_logged_in())
		 {  
			   $accountTypeId = $this->uri->segment('3');
			   $data=array();
			   if($accountTypeId != "")
			   {
				  $this->db->where('accountTypeId', $accountTypeId); 
				  $data['rowDet'] = $this->Accounttype_model->accountTypeDet($accountTypeId);
			   }
			   $data['pageName']="Add Account Type";
			   $this->load->view('templates/layout/header');
			   $this->load->view('templates/layout/menu');
			   $this->load->view('accounttype/accounttype_add',$data);
			   $this->load->view('templates/layout/footer');  
		 }
		 else
		 {
			redirect('/accounts');
		 }
	}
	
	public function accountTypeInsert()
	{
		 if($this->authenticaton->is_logged_in())
		 {  
			  $dataSet['accountTypeName'] = $this->input->post('accountTypeName');
			  $accountTypeId = $this->input->post('accountTypeId');
		
			
			  if($accountTypeId) 
			  {
					$result= $this->Accounttype_model->updateAccountType($accountTypeId,$dataSet);
					$msg="Account Type Updated Successfully";
			 
			   }
			   else
			   {
					 $this->Accounttype_model->addAccountType($dataSet);
					 $msg="Account Type Added Successfully";
			   }
			   $this->session->set_flashdata('msg', $msg);
			   redirect('/Accounttype/accountTypeList');
		 }
		 else
		 {
			redirect('/accounts');
		 }
	 } 
     
	 
	 public function deleteAccountType($accountTypeId)
	 {
		 if($this->authenticaton->is_logged_in())
		 {
			   $this->Accounttype_model->deleteAccountType($accountTypeId);
			   $msg="Account Type Deleted Successfully";
			   $this->session->set_flashdata('msg', $msg);
			   redirect('/Accounttype/accountTypeList');
		 }
		 else
		 {
			redirect('/accounts');
		 }
	 } 
}
?>