<?php
class Transaction_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	/*function accountTypeList()
	{  
	   $this->db->from('tbl_account_type');
	   $this->db->where('status',1);
	   $query = $this->db->get();
	   $result=$query->result();
	   return $result;
	}
	function accountTypeDet($accountTypeId)
	{  
	   $this->db->from('tbl_account_type');
	   $this->db->where('status',1);
	   $query = $this->db->get();
	   $result=$query->result();
	   $row=$result[0];
	   return $row;
	}*/
	
	function journalList()
	{  
	   $this->db->select("tbl_transactions.transactionId,ledgerName,transactionDate,transactionRef");
	   $this->db->from('tbl_transactions');
	   $this->db->join('tbl_transactions_dtl',"tbl_transactions.transactionId=tbl_transactions_dtl.transactionDtlId");
	   $this->db->join('tbl_ledger',"tbl_transactions.ledgerId=tbl_ledger.ledgerId");
	   $this->db->where('tbl_transactions.status',1);
	   $this->db->where('tbl_transactions_dtl.status',1);
	   $query = $this->db->get();
	// echo $this->db->last_query();
	   $result=$query->result();
	   return $result;
	}
	
	function addTransaction($dataSet)
	{		
		   $this->db->insert('tbl_transactions', $dataSet);
		   $transactionId = $this->db->insert_id();
		   return $transactionId;
	}
	function addTransactionDtl($dataSet)
	{
		   $this->db->insert('tbl_transactions_dtl',$dataSet);
	}
	
	function saveTransactions($transactionId)
	{
	    $transactionDataSet['transactionCnfStatus']=1;  
		$this->db->update('tbl_transactions',$transactionDataSet);
		
	    $transactionDtlDataSet['transactionCnfStatus']=1;  
		$this->db->update('tbl_transactions_dtl',$transactionDtlDataSet);
	}
/*	function updateTransactions($transactionId,$tblTransDataSet,$tblTransDtlDataSet)
	{
		$this->db->where('transactionId', $transactionId);
		$this->db->update('tbl_transactions', $tblTransDataSet);	
		$this->db->update('tbl_transactions_dtl', $tblTransDtlDataSet);
	}*/
	function deleteTransactions($transactionId)
	{
		$dataSet['status']=2;
		$this->db->where('transactionId', $transactionId);
		$this->db->update('tbl_transactions', $dataSet);
		
		$this->db->where('transactionId', $transactionId);
		$this->db->update('tbl_transactions_dtl', $dataSet);
	}
	
	
	
	
	
	function deleteTransactionEntryDtl($transactionDtlId)
	{
		$dataSet['status']=2;
		$this->db->where('transactionDtlId', $transactionDtlId);
		$this->db->update('tbl_transactions_dtl', $dataSet);
		echo $this->db->last_query();
	}
	
	
	function loadTransactionData($transactionId)
	{
	    $this->db->select('tbl_transactions.transactionId,tbl_transactions_dtl.transactionDtlId,tbl_account_head.accountHeadName as accountHead,tbl_transactions_dtl.particulars,tbl_transactions_dtl.amountDr,tbl_transactions_dtl.amountCr');
	    $this->db->from('tbl_transactions');
		$this->db->join('tbl_transactions_dtl','tbl_transactions.transactionId=tbl_transactions_dtl.transactionId');
		$this->db->join('tbl_account_head','tbl_account_head.accountHeadId=tbl_transactions_dtl.accountHeadId');
		$this->db->where('tbl_transactions.transactionId',$transactionId);
		$this->db->where('tbl_transactions_dtl.status',1);
		$this->db->order_by('tbl_transactions.transactionId', 'DESC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function trial_balance()
	{
	   
		$transactionFromDate=date("Y-04-01");
		$transactionToDate=date("Y-m-d");
		
		$this->db->select('tbl_transactions.transactionId,tbl_account_head.accountHeadName as accountHead,sum(tbl_transactions_dtl.amountDr) as amountDr,sum(tbl_transactions_dtl.amountCr) as amountCr');
	    $this->db->from('tbl_transactions');
		$this->db->join('tbl_transactions_dtl','tbl_transactions.transactionId=tbl_transactions_dtl.transactionId');
		$this->db->join('tbl_account_head','tbl_account_head.accountHeadId=tbl_transactions_dtl.accountHeadId');
		$this->db->where('tbl_transactions.transactionDate>=',$transactionFromDate);
		$this->db->where('tbl_transactions.transactionDate<=',$transactionToDate);
		$this->db->group_by('tbl_account_head.accountHeadId');
		$this->db->order_by('tbl_transactions.transactionId', 'DESC');
		$query = $this->db->get();
	//	echo $this->db->last_query();
		return $query->result();
	}
	
	function transactionDet($transactionId)
	{  
			if($transactionId != "")
			{
				   $this->db->from('tbl_transactions');
				   $this->db->join('tbl_transactions_dtl','tbl_transactions.transactionId=tbl_transactions_dtl.transactionId');
				   $this->db->where('tbl_transactions.transactionId', $transactionId);
				   $this->db->where('tbl_transactions.status',1);
				   $this->db->where('tbl_transactions_dtl.status',1);
				   $query = $this->db->get();
				//   echo $this->db->last_query();
				   $result=$query->result();
				   if($result)
				   {
					  $row=$result[0];
					  return $row;
				   }
			}
	}
	
	
	function balancesheet()
	{
			$transactionFromDate=date("Y-04-01");
			$year=date("Y")+1;
			$transactionToDate=date($year . "-03-31");
			
			$this->db->select('tbl_transactions.transactionId,tbl_account_head.accountHeadName as accountHead,sum(tbl_transactions_dtl.amountDr) as amountDr,sum(tbl_transactions_dtl.amountCr) as amountCr');
			$this->db->from('tbl_transactions');
			$this->db->join('tbl_transactions_dtl','tbl_transactions.transactionId=tbl_transactions_dtl.transactionId');
			$this->db->join('tbl_account_head','tbl_account_head.accountHeadId=tbl_transactions_dtl.accountHeadId');
			$this->db->where('tbl_transactions.transactionDate>=',$transactionFromDate);
			$this->db->where('tbl_transactions.transactionDate<=',$transactionToDate);
			$this->db->group_by('tbl_account_head.accountHeadId');
			$this->db->order_by('tbl_transactions.transactionId', 'DESC');
			$query = $this->db->get();
		//	echo $this->db->last_query();
			return $query->result();
	}
}
?>