<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ledger extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->load->model('transaction_model');
		$this->load->model('Accounthead_model');
		$this->load->model('Ledger_model');
    }
	public function index()
	{
		if($this->authenticaton->is_logged_in())
		{ 
				$data['list'] = $this->Ledger_model->ledgerList();
				$data['pageName']="Ledger";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('ledger/ledger_list',$data);
				$this->load->view('templates/layout/footer');
		 }
		 else
		 {
			redirect('/accounts');
		 }
	}
	public function ledgerList()
	{
		if($this->authenticaton->is_logged_in())
		{ 
				$data['list'] = $this->Ledger_model->ledgerList();
				$data['pageName']="Ledger";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('ledger/ledger_list',$data);
				$this->load->view('templates/layout/footer');  
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	}
	public function ledgerAdd()
	{
		 if($this->authenticaton->is_logged_in())
		 { 
			   $ledgerId = $this->uri->segment('3');
			   $data=array();
			   if($ledgerId != "")
			   {
				  $this->db->where('ledgerId', $ledgerId); 
				  $data['rowDet'] = $this->Ledger_model->ledgerDet($ledgerId);
			   }
			   $data['pageName']="Add Ledger";
			   $this->load->view('templates/layout/header');
			   $this->load->view('templates/layout/menu');
			   $this->load->view('ledger/ledger_add',$data);
			   $this->load->view('templates/layout/footer');  
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	}
	public function ledgerInsert()
	{
		if($this->authenticaton->is_logged_in())
		{
			  $dataSet['ledgerName'] = $this->input->post('ledgerName');
			  $dataSet['date'] = $this->input->post('date');
			  $dataSet['openingBalance'] = $this->input->post('openingBalance');
			  $dataSet['status'] = 1;
			  $ledgerId = $this->input->post('ledgerId');
			
			  if($ledgerId) 
			  {
					$result= $this->Ledger_model->updateLedger($ledgerId,$dataSet);
					$msg="Ledger Account Updated Successfully";
			 
			   }
			   else
			   {
					 $this->Ledger_model->addLedger($dataSet);
					 $msg="Ledger Account Added Successfully";
			   }
			   $this->session->set_flashdata('msg', $msg);
			   redirect('/Ledger/ledgerList');
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	 } 
	 public function ledgerDetails()
	 {
	 	if($this->authenticaton->is_logged_in())
		{
			//	$ledgerId = $this->input->post('ledgerId');
				$ledgerId = $this->uri->segment('3');
				$data['ledgerId'] = $this->uri->segment('3');
				$ledgerDetails=$this->Ledger_model->ledgerDet($ledgerId);
				$data['ledgerName']=$ledgerDetails->ledgerName;
			//	print_r($ledgerDetails);
			//	exit;
			//	echo "<pre>";
				$data['list'] = $this->Ledger_model->ledger($ledgerId);
			//	print_r($data['list']);
				$data['pageName']="Ledger";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('ledger/ledger_details',$data);
				$this->load->view('templates/layout/footer');
		 }
		 else
		 {
			redirect('/accounts');
		 }
	}
	
	 public function deleteLedger($ledgerId)
	 {
		 if($this->authenticaton->is_logged_in())
		 {
			   $this->Ledger_model->deleteLedger($ledgerId);
			   $msg="Ledger Deleted Successfully";
			   $this->session->set_flashdata('msg', $msg);
			   redirect('/Ledger/LedgerList');
		 }
		 else
		 {
			redirect('/accounts');
		 }
	 } 
}
?>