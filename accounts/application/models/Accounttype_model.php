<?php
class Accounttype_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function accountTypeList()
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
	}
	
	function addAccountType($dataSet)
	{		
	  $this->db->insert('tbl_account_type', $dataSet);
	}
	
	function updateAccountType($accountTypeId,$dataSet)
	{
		$this->db->where('accountTypeId', $accountTypeId);
		$this->db->update('tbl_account_type', $dataSet);	
	}
	function deleteAccountType($accountTypeId)
	{
		$dataSet['status']=2;
		$this->db->where('accountTypeId', $accountTypeId);
		$this->db->update('tbl_account_type', $dataSet);
	}
}
?>