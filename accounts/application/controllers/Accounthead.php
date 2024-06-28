<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accounthead extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Accounthead_model');
    }
	public function index()
	{
		if($this->authenticaton->is_logged_in())
		{
				$data['list'] = $this->Accounthead_model->accountHeadList();
				$data['pageName']="Account Head List";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('accounthead/accounthead_list',$data);
				$this->load->view('templates/layout/footer');
	    }
		else
		{
				redirect('/accounts');
		}
	}
	public function accountHeadList()
	{
	    if($this->authenticaton->is_logged_in())
		{
				$data['list'] = $this->Accounthead_model->accountHeadList();
				$data['pageName']="Account Head List";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('accounthead/accounthead_list',$data);
				$this->load->view('templates/layout/footer');   
		 }
		 else
		 {
				redirect('/accounts');
		 }
	}
	public function accountHeadAdd()
	{
		 if($this->authenticaton->is_logged_in())
		 {
			   $accountHeadId = $this->uri->segment('3');
			   $data=array();
			   if($accountHeadId != "")
			   {
				  $this->db->where('accountHeadId', $accountHeadId); 
				  $data['rowDet'] = $this->Accounthead_model->accountHeadDet($accountHeadId);
			   }
			   $data['pageName']="Add Account Head";
			   $this->load->view('templates/layout/header');
			   $this->load->view('templates/layout/menu');
			   $this->load->view('accounthead/accounthead_add',$data);
			   $this->load->view('templates/layout/footer');  
		 }
		 else
		 {
				redirect('/accounts');
		 }
	}
	
	public function accountHeadInsert()
	{
		 if($this->authenticaton->is_logged_in())
		 {
			
				  $dataSet['accountHeadName'] = $this->input->post('accountHeadName');
				  $accountHeadId = $this->input->post('accountHeadId');
			
				
				  if($accountHeadId) 
				  {
						$result= $this->Accounthead_model->updateAccountHead($accountHeadId,$dataSet);
						$msg="Account Head Updated Successfully";
				 
				   }
				   else
				   {
						 $this->Accounthead_model->addAccountHead($dataSet);
						 $msg="Account Head Added Successfully";
				   }
				   $this->session->set_flashdata('msg', $msg);
				   redirect('/Accounthead/accountHeadList');
		  }
		  else
		  {
				redirect('/accounts');
		  }
	 } 
     
	 
	 public function deleteAccountHead($accountHeadId)
	 {
		  if($this->authenticaton->is_logged_in())
		  {
				   $this->Accounthead_model->deleteAccountHead($accountHeadId);
				   $msg="Account Head Deleted Successfully";
				   $this->session->set_flashdata('msg', $msg);
				   redirect('/Accounthead/accountHeadList');
		  }
		  else
		  {
				redirect('/accounts');
		  }
	 } 
}
?>