<?php
class Accountsubtype_model extends CI_Model {
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

	function accountSubTypeList()
	{  
	   $this->db->from('tbl_account_sub_type');
	   $this->db->join('tbl_account_type','tbl_account_type.accountTypeId=tbl_account_sub_type.accountTypeId');
	   $this->db->where('tbl_account_sub_type.status',1);
	   $query = $this->db->get();
	   $result=$query->result();
	   return $result;
	}
	function accountSubTypeDet($subAccountTypeId)
	{  
	   $this->db->from('tbl_account_sub_type');
	   $this->db->where('status',1);
	   $query = $this->db->get();
	   $result=$query->result();
	   $row=$result[0];
	   return $row;
	}
	
	function addAccountSubType($dataSet)
	{		
	  $this->db->insert('tbl_account_sub_type', $dataSet);
	}
	
	function updateAccountSubType($accountSubTypeId,$dataSet)
	{
		$this->db->where('accountSubTypeId', $accountSubTypeId);
		$this->db->update('tbl_account_sub_type', $dataSet);	
	}
	function deleteAccountSubType($accountSubTypeId)
	{
		$dataSet['status']=2;
		$this->db->where('accountSubTypeId', $accountSubTypeId);
		$this->db->update('tbl_account_sub_type', $dataSet);
	}
}
?>