<?php
class Accountsubhead_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function accountSubHeadList()
	{  
	   $this->db->from('tbl_account_subhead');
	   $this->db->join('tbl_account_head','tbl_account_head.accountHeadId=tbl_account_subhead.accountHeadId');
	   $this->db->where('tbl_account_subhead.status',1);
	   $this->db->where('tbl_account_subhead.status',1);
	   $query = $this->db->get();
	   $result=$query->result();
	   return $result;
	}
	function accountSubHeadDet($accountSubHeadId)
	{  
	   $row=array();
	   $this->db->from('tbl_account_subhead');
	   $this->db->where('accountSubHeadId ',$accountSubHeadId);
	   $this->db->where('status',1);
	   $query = $this->db->get();
	   $result=$query->result();
	   if($result)
	   {
	  	 $row=$result[0];
	   }
	   return $row;
	}
	
	function addAccountSubHead($dataSet)
	{		
	  $this->db->insert('tbl_account_subhead', $dataSet);
	}
	
	function updateAccountSubHead($accountSubHeadId,$dataSet)
	{
		$this->db->where('accountSubHeadId', $accountSubHeadId);
		$this->db->update('tbl_account_subhead', $dataSet);	
	}
	function deleteAccountSubHead($accountSubHeadId)
	{
		$dataSet['status']=2;
		$this->db->where('accountSubHeadId', $accountSubHeadId);
		$this->db->update('tbl_account_subhead', $dataSet);
	}
}
?>