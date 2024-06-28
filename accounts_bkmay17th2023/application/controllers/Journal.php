<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Journal extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Transaction_model');
		$this->load->model('Accounthead_model');
		$this->load->model('Ledger_model');
    }
	public function index()
	{
		 if($this->authenticaton->is_logged_in())
		 {
				$data['list'] = $this->Transaction_model->journalList();
				$data['pageName']="Journal";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('journal/journal_list',$data);
				$this->load->view('templates/layout/footer');
		}
		else
		{
			redirect('/accounts');
		}
	}
	
	public function journalList()
	{
	     if($this->authenticaton->is_logged_in())
		 {		
				$data['list'] = $this->Transaction_model->journalList();
				$data['pageName']="Journal Entry List";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('journal/journal_list',$data);
				$this->load->view('templates/layout/footer');  
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	}
	public function journalAdd()
	{
		 if($this->authenticaton->is_logged_in())
		 {
				   $data=array();
				   $transactionId = $this->uri->segment('3');
				   $data['accountHeadList'] = $this->Accounthead_model->accountHeadList();
				   
				   $data['ledgerList'] = $this->Ledger_model->ledgerList();
				   
				   if($transactionId != "")
				   {
					// $this->transaction_model->updateTransactions($transactionId,$tblTransDataSet,$tblTransDtlDataSet);
					   
					  $data['rowDet'] = $this->Transaction_model->transactionDet($transactionId);
				   }
				   else
				   {
				   //  $this->transaction_model->saveTransactions($tblTransDataSet,$tblTransDtlDataSet);
				   }
				   $data['pageName']="Add Journal Entry";
				 //  $data['js_to_load']="journal.js";
				   $this->load->view('templates/layout/header');
				   $this->load->view('templates/layout/menu');
				   $this->load->view('journal/journal_add',$data);
				   $this->load->view('templates/layout/footer',$data); 
				   $this->load->view('journal/functions',$data);
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	}
	
	public function journalAddLedger()
	{
		 if($this->authenticaton->is_logged_in())
		 {
			   $data=array();
			   $data['ledgerId'] = $this->uri->segment('3');
			   $data['accountHeadList'] = $this->Accounthead_model->accountHeadList();
			   $data['ledgerList'] = $this->Ledger_model->ledgerList();
			   $data['pageName']="Add Journal Entry";
			 //  $data['js_to_load']="journal.js";
			   $this->load->view('templates/layout/header');
			   $this->load->view('templates/layout/menu');
			   $this->load->view('journal/journal_add',$data);
			   $this->load->view('templates/layout/footer',$data); 
			   $this->load->view('journal/functions',$data);
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	}
	
	public function journalInsert()
	{
	     if($this->authenticaton->is_logged_in())
		 {
	
				  $transactionId = $this->input->post('transactionId');
				  $transactionDataSet['ledgerId'] = $this->input->post('ledgerId');
				  $transactionDataSet['transactionDate'] = $this->input->post('transactionDate');
				  $transactionDataSet['transactionRef'] = $this->input->post('transactionRef');
				  $transactionDataSet['transactionCnfStatus']=2;    //  1 active 2 inactive  Change status after save
				  $transactionDtlDataSet['accountHeadId'] = $this->input->post('accountHeadId');
				  $transactionDtlDataSet['particulars'] = $this->input->post('particulars');
				  $transactionDtlDataSet['amountDr'] = $this->input->post('amountDr');
				  $transactionDtlDataSet['amountCr'] = $this->input->post('amountCr');
				  $transactionDtlDataSet['transactionCnfStatus']=2;    //  1 active 2 inactive  Change status after save
					
				
				  if($transactionId) 
				  {
						$transactionDtlDataSet['transactionId'] = $transactionId;
						$this->Transaction_model->addTransactionDtl($transactionDtlDataSet);
						$msg="Successfully Added";
				   }
				   else
				   {
						
						 $transactionId=$this->Transaction_model->addTransaction($transactionDataSet);
						 $transactionDtlDataSet['transactionId'] = $transactionId;
						 $this->Transaction_model->addTransactionDtl($transactionDtlDataSet);
						 $msg="Successfully Added";
				   }
				  // echo $msg;
				  echo $transactionId;
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	 } 
     
	 public function saveJournal()
	 {
		 if($this->authenticaton->is_logged_in())
		 {
			 $transactionId = $this->input->post('transactionId');
			 $this->Transaction_model->saveTransactions($transactionId);
			 $msg="Successfully Saved";
			 echo $msg;
			 redirect('/Journal/journalList');
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	 }
	 
	 public function journalEntryDelete()
	 {
	     if($this->authenticaton->is_logged_in())
		 {
				$transactionDtlId  = $this->input->post('transactionDtlId');
				$this->Transaction_model->deleteTransactionEntryDtl($transactionDtlId);
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	 }
	 
	 public function deleteJournal($transactionId)
	 {
		 if($this->authenticaton->is_logged_in())
		 {
			   $this->Transaction_model->deleteTransactions($transactionId);
			   $msg="Journal Deleted Successfully";
			   $this->session->set_flashdata('msg', $msg);
			   redirect('/Journal/journalList');
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	 } 
	 
	 function loadTransactionData()
	 {
		 if($this->authenticaton->is_logged_in())
		 {	
				$transactionId = $this->input->post('transactionId');
				$data = $this->Transaction_model->loadTransactionData($transactionId);
				echo json_encode($data);
		 }
		 else
		 {
			redirect('/accounts');
		 } 
	}
}
?>