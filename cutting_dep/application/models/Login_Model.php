<?php
class Login_Model extends CI_Model{
	
	public function Verify_User($email, $password){
		return $this->db->select("*")
						->from("user")
						->where("Email",$email)
						->where("Password",$password)
						->where("Usertype",'6')
						->where("Status",'1')
						->get()
						->row();
	}
	
}
