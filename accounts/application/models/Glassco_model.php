
<?php  
  
class Glassco_model extends CI_Model { 
    
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	function accountUserExist()
	{
	    
		$email = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		$query = $this->db->query("select * from user where Email = '".$email."' and 
								Password = '".$password."' and Usertype=3 and Status = 1")->row();
		
		return $query;
		
	}
	function select()
	{
		$query = $this->db->query('user');  
        return $query;
		
	}
	
  function add($dataset){
		$this->db->insert('user',$dataset);
	}
  function save($dataset){
		$this->db->insert('glass_edges',$dataset);
	}
  function save_settings($dataset){
		$this->db->insert('tbl_settings',$dataset);
	}
  
}  
?>  