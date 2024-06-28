<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accountsubtype extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Accounttype_model');
		$this->load->model('Accountsubtype_model');
    }
	public function index()
	{
		if($this->authenticaton->is_logged_in())
		{
				$data['list'] = $this->Accountsubtype_model->accountSubTypeList();
				$data['pageName']="Account Sub Types";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('accountsubtype/accountsubtype_list',$data);
				$this->load->view('templates/layout/footer');
		}
		else
		{
				redirect('/accounts');
		}
	}
	public function accountSubTypeList()
	{
	    if($this->authenticaton->is_logged_in())
		{
				$data['list'] = $this->Accountsubtype_model->accountSubTypeList();
			//	print_r($data['list']);
				$data['pageName']="Account Sub Types";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('accountsubtype/accountsubtype_list',$data);
				$this->load->view('templates/layout/footer');   
		}
		else
		{
				redirect('/accounts');
		}
	}
	public function accountSubTypeAdd()
	{
		if($this->authenticaton->is_logged_in())
		{
			   $data=array();
			   $rowDet=array();
			   $data['accountTypeList'] = $this->Accounttype_model->accountTypeList();
			   /* echo "<pre>";
			  print_r($data['accountTypeList']);
			   exit;*/
			   $accountSubTypeId = $this->uri->segment('3');
			  
			   if($accountSubTypeId != "")
			   {
				  $this->db->where('AccountSubTypeId', $accountSubTypeId); 
				  $data['rowDet'] = $this->Accountsubtype_model->accountSubTypeDet($accountSubTypeId);
			   }
			   $data['pageName']="Add Account Sub Type";
			   $this->load->view('templates/layout/header');
			   $this->load->view('templates/layout/menu');
			   $this->load->view('accountsubtype/accountsubtype_add',$data);
			   $this->load->view('templates/layout/footer');  
		}
		else
		{
				redirect('/accounts');
		}
	}
	
	public function accountSubTypeInsert()
	{
		  if($this->authenticaton->is_logged_in())
		  {
				  $dataSet['accountTypeId'] =  $this->input->post('accountTypeId');
				  $dataSet['accountSubTypeName'] = $this->input->post('accountSubTypeName');
				  $accountSubTypeId = $this->input->post('accountSubTypeId');
				  if($accountSubTypeId) 
				  {
						$result= $this->Accountsubtype_model->updateAccountSubType($accountSubTypeId,$dataSet);
						$msg="Account Type Updated Successfully";
				   }
				   else
				   {
						 $this->Accountsubtype_model->addAccountSubType($dataSet);
						 $msg="Account Type Added Successfully";
				   }
				   $this->session->set_flashdata('msg', $msg);
				   redirect('/Accountsubtype/accountSubTypeList');
		  }
		  else
		  {
					redirect('/accounts');
		  }
	 } 
     
	 
	 public function deleteAccountSubType($accountSubTypeId)
	 {
		  if($this->authenticaton->is_logged_in())
		  {
				   $this->Accountsubtype_model->deleteAccountSubType($accountSubTypeId);
				   $msg="Account Sub Type Deleted Successfully";
				   $this->session->set_flashdata('msg', $msg);
				   redirect('/Accountsubtype/accountSubTypeList');
		  }
		  else
		  {
					redirect('/accounts');
		  }
	 } 
}
?>