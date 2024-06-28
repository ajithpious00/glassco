<?php
class Ledger_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function ledgerList()
	{  
	   $this->db->from('tbl_ledger');
	   $this->db->where('status',1);
	   $query = $this->db->get();
	   $result=$query->result();
	   return $result;
	}
	function ledgerDet($ledgerId)
	{  
	   $this->db->from('tbl_ledger');
	   $this->db->where('ledgerId',$ledgerId);
	   $this->db->where('status',1);
	   $query = $this->db->get();
	   $result=$query->result();
	   $row=$result[0];
	   return $row;
	}
	
	function addLedger($dataSet)
	{		
	  $this->db->insert('tbl_ledger', $dataSet);
	}
	
	function updateLedger($ledgerId,$dataSet)
	{
		$this->db->where('ledgerId', $ledgerId);
		$this->db->update('tbl_ledger', $dataSet);	
	}
	function deleteLedger($ledgerId)
	{
		$dataSet['status']=2;
		$this->db->where('ledgerId', $ledgerId);
		$this->db->update('tbl_ledger', $dataSet);
	}
	function ledger($ledgerId)
	{
		$this->db->select('tbl_transactions.transactionId,tbl_account_head.accountHeadName as accountHead,tbl_transactions.transactionDate,tbl_transactions.transactionRef,
		tbl_transactions_dtl.particulars,tbl_transactions_dtl.amountDr,tbl_transactions_dtl.amountCr');
	    $this->db->from('tbl_transactions');
		$this->db->join('tbl_transactions_dtl','tbl_transactions.transactionId=tbl_transactions_dtl.transactionId');
		$this->db->join('tbl_account_head','tbl_account_head.accountHeadId=tbl_transactions_dtl.accountHeadId');
		$this->db->where('tbl_transactions.ledgerId',$ledgerId);
		$this->db->where('tbl_transactions.status',1);
		$this->db->order_by('tbl_transactions.transactionId', 'DESC');
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result();
	}
}
?>