<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Accountsubhead extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
		$this->load->model('Accounthead_model');
        $this->load->model('Accountsubhead_model');
    }
	public function index()
	{
	    if($this->authenticaton->is_logged_in())
		{
				$data['accountHeadList'] = $this->Accounthead_model->accountHeadList();
				$data['list'] = $this->Accountsubhead_model->accountSubHeadList();
				$data['pageName']="Account Sub Head List";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('accountsubhead/accountsubhead_list',$data);
				$this->load->view('templates/layout/footer');
	    }
		else
		{
				redirect('/accounts');
		}
	}
	public function accountSubHeadList()
	{
	    if($this->authenticaton->is_logged_in())
		{
				$data['list'] = $this->Accountsubhead_model->accountSubHeadList();
				$data['pageName']="Account Sub Head List";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('accountsubhead/accountsubhead_list',$data);
				$this->load->view('templates/layout/footer');   
		}
		else
		{
				redirect('/accounts');
		}
	}
	public function accountSubHeadAdd()
	{
	    if($this->authenticaton->is_logged_in())
		{
			   $rowDet=array();
			   $data['accountHeadList'] = $this->Accounthead_model->accountHeadList();
			//   echo "<pre>";
			//   print_r($data['accountHeadList']);
			   $accountSubHeadId = $this->uri->segment('3');
			   
			   if($accountSubHeadId != "")
			   {
				  $this->db->where('accountSubHeadId', $accountSubHeadId); 
				  $data['rowDet'] = $this->Accountsubhead_model->accountSubHeadDet($accountSubHeadId);
			   }
			   $data['pageName']="Add Account Sub Head";
			 
			   $this->load->view('templates/layout/header');
			   $this->load->view('templates/layout/menu');
			   $this->load->view('accountsubhead/accountsubhead_add',$data);
			   $this->load->view('templates/layout/footer');  
		}
		else
		{
				redirect('/accounts');
		}
	}
	
	public function accountSubHeadInsert()
	{
		if($this->authenticaton->is_logged_in())
		{
			  $accountSubHeadId = $this->input->post('accountSubHeadId');
			  $dataSet['accountHeadId'] = $this->input->post('accountHeadId');
			  $dataSet['accountSubHeadName'] = $this->input->post('accountSubHeadName');
			 
			  if($accountSubHeadId) 
			  {
					$result= $this->Accountsubhead_model->updateAccountSubHead($accountSubHeadId,$dataSet);
					$msg="Account Sub Head Updated Successfully";
			 
			   }
			   else
			   {
					
					 $this->Accountsubhead_model->addAccountSubHead($dataSet);
					 $msg="Account Sub Head Added Successfully";
			   }
			   $this->session->set_flashdata('msg', $msg);
			   redirect('/Accountsubhead/accountSubHeadList');
		}
		else
		{
				redirect('/accounts');
		}
	 } 
     
	 
	 public function deleteAccountSubHead($accountSubHeadId)
	 {
		if($this->authenticaton->is_logged_in())
		{
			   $this->Accountsubhead_model->deleteAccountSubHead($accountSubHeadId);
			   $msg="Account Sub Head Deleted Successfully";
			   $this->session->set_flashdata('msg', $msg);
			   redirect('/Accountsubhead/AccountSubHeadList');
		}
		else
		{
				redirect('/accounts');
		}
	 } 
}
?>