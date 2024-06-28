<?php
class User_Model extends CI_Model { 
    
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
    function allcount(){
		return $this->db->query("select count(*) as allcount from user as us")->row();
	}
	function delete_user($Id){
		return $this->db->query("delete from user where US_ID=".$Id);
	}
	
	function filterCount($searchQuery){
		return $this->db->query("select count(*) as allcount 
								from user as us 
								left join tbl_user_type as ut on ut.ID = us.Usertype
								WHERE 1 and ut.ID <> 1 " . $searchQuery)->row();
	}
	
	function listAllData($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage) {
		
		return $this->db->query("select us.*,ut.Type, ut.ID as Utype from user as us
								left join tbl_user_type as ut on ut.ID = us.Usertype
								WHERE 1 ".$searchQuery." and ut.ID <> 1 order by ".$columnName." ".$columnSortOrder." 
								limit ".$row.",".$rowperpage)->result();
	}
	function selectuser($Id){
		return $this->db->query("SELECT * FROM user where US_ID=".$Id)->row();
	}
    function select_usertype(){
		$query = $this->db->query('select * from tbl_user_type where ID<>1'); 
		return $query;
	}
    function add($dataset){
		$this->db->insert('user',$dataset);
	}
    function update_user($Id,$dataset){
		$this->db->where('US_ID',$Id);
		$this->db->update('user',$dataset);
	 }
}
?>