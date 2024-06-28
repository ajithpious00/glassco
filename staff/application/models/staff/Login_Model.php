<?php
class Login_Model extends CI_Model{
	
	public function Verify_User($email, $password){
		/*echo("Select * from user where Email='".$email."' and Password='".$password."' and Usertype='1'=and Status = '1'");exit();
		/*
		$loginQuery = $this->db->query("Select * from admin_user where AU_Email='".$email."' and AU_Password='".$password."' and AU_Status='1'");
		return $loginQuery->result_array();
		*/
		return $this->db->select("*")
						->from("user")
						->where("Email",$email)
						->where("Password",$password)
						->where("Usertype",'4')
						->where("Status",'1')
						->get()
						->row();
		
		//print_r($this->db->last_query());    
	}
	
}
?>