<?php
class Accounthead_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function accountHeadList()
	{  
	   $this->db->from('tbl_account_head');
	   $this->db->where('status',1);
	   $query = $this->db->get();
	   $result=$query->result();
	   return $result;
	}
	function accountHeadDet($accountHeadId)
	{  
	   $this->db->from('tbl_account_head');
	   $this->db->where('status',1);
	   $query = $this->db->get();
	   $result=$query->result();
	   $row=$result[0];
	   return $row;
	}
	
	function addAccountHead($dataSet)
	{		
	  $this->db->insert('tbl_account_head', $dataSet);
	}
	
	function updateAccountHead($accountHeadId,$dataSet)
	{
		$this->db->where('accountHeadId', $accountHeadId);
		$this->db->update('tbl_account_head', $dataSet);	
	}
	function deleteAccountHead($accountHeadId)
	{
		$dataSet['status']=2;
		$this->db->where('accountHeadId', $accountHeadId);
		$this->db->update('tbl_account_head', $dataSet);
	}
}
?>