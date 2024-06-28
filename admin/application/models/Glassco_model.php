
<?php  
  
class Glassco_model extends CI_Model { 
    
	function __construct(){
        // Call the Model constructor
        parent::__construct();
    }
	function access(){
	    
		$email = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		$query = $this->db->query("select * from user where Email = '".$email."' and 
								Password = '".$password."' and Status = 1")->row();
		
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
		$this->db->update('tbl_settings',$dataset);
	}
   function save_category($dataset){
	   $this->db->insert('tbl_category',$dataset);
   }	 
   function save_product($dataset){
	   $this->db->insert('tbl_product',$dataset);
   }   
   function save_subcategory($dataset){
	   $this->db->insert('tbl_sub_category',$dataset);
   }
   function save_brand($dataset){
	   $this->db->insert('tbl_brand',$dataset);
   }
   function select_category(){
		$query = $this->db->get('tbl_category');  
        return $query;
		
	}
   function select_sub_category(){
		$query = $this->db->get('tbl_sub_category');  
        return $query;
		
	}
	function select_brand(){
		$query = $this->db->get('tbl_brand');  
        return $query;
		
	}
	
	function select_settings(){
		return $this->db->query("SELECT * FROM tbl_settings")->row(); 
	}
	function select_usertype(){
		$query = $this->db->query('select * from tbl_user_type where ID<>1'); 
		return $query;
	}
	function select_categoryname(){
		$query = $this->db->query('select * from tbl_category where Status=1')->result(); 
		return $query;
	}
	function select_subcategoryname(){
		$query = $this->db->query('select * from tbl_sub_category where Status=1')->result(); 
		return $query;
	}
	function select_subcategorynames($cid=''){
		if($cid) {
			$query = $this->db->query('select * from tbl_sub_category where Category_id = '.$cid)->result();
		}
		else {
			$query = $this->db->query('select sb.*,ct.ID,ct.Name as Ctype from tbl_sub_category as sb 	
									left join tbl_category as ct on ct.ID=sb.Category_id where 1')->result();
		}									
		return $query;
	}
	function select_brandname(){
		$query = $this->db->query('select * from tbl_brand where Status=1')->result(); 
		return $query;
	}
	function allcount(){
		return $this->db->query("select count(*) as allcount from user as us")->row();
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
	
	function allcountcategory() {
		return $this->db->query("select count(*) as allcount from tbl_category")->row();
	}
	function filterCountcategory($searchQuery) {
		return $this->db->query("select count(*) as allcount from tbl_category WHERE 1 " . $searchQuery)->row();
	}
	function listAllDatacategory($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage) {
		/*echo("select * from tbl_category 
								WHERE 1 ".$searchQuery."order by ".$columnName." ".$columnSortOrder." 
								limit ".$row.",".$rowperpage);*/
		
		return $this->db->query("select * from tbl_category 
								WHERE 1 ".$searchQuery."order by ".$columnName." ".$columnSortOrder." 
								limit ".$row.",".$rowperpage)->result();
	}
	function allcountsubcategory() {
		return $this->db->query("select count(*) as allcount from tbl_sub_category as sb")->row();
	}
	function filterCountsubcategory($searchQuery) {
		return $this->db->query("select count(*) as allcount from tbl_sub_category as sb WHERE 1 " . $searchQuery)->row();
	}
	function listAllDatasubcategory($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage) {
		return $this->db->query("select sb.*,ct.Name, ct.ID as Ctype from tbl_sub_category as sb
								left join tbl_category as ct on ct.ID = sb.Category_id	
								WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." 
								limit ".$row.",".$rowperpage)->result();
	}
	function allcountbrand() {
		return $this->db->query("select count(*) as allcount from tbl_brand")->row();
	}
	function filterCountbrand($searchQuery) {
		return $this->db->query("select count(*) as allcount from tbl_brand WHERE 1 " . $searchQuery)->row();
	}
	function listAllDatabrand($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage) {
		return $this->db->query("select * from tbl_brand
								WHERE 1 ".$searchQuery."order by ".$columnName." ".$columnSortOrder." 
								limit ".$row.",".$rowperpage)->result();
	}
	function allcountproduct() {
		return $this->db->query("select count(*) as allcount from tbl_product as prt")->row();
	}
	function filterCountproduct($searchQuery) {
		return $this->db->query("select count(*) as allcount from tbl_product as prt WHERE 1 " . $searchQuery)->row();
	}
	function listAllDataproduct($searchQuery,$columnSortOrder,$row,$rowperpage) {
		/*echo("select prt.*,ct.Name, ct.ID as Cttype,sb.SB_Name,sb.ID as Sbtype,brd.Name,brd.ID as Btype 
								from tbl_product as prt
								left join tbl_category as ct on ct.ID = prt.Category_id	
								left join tbl_sub_category as sb on sb.ID = prt.Sub_category_id	
                                left join tbl_brand as brd on brd.ID = prt.Brand_id									
								WHERE 1 ".$searchQuery." order by prt.ID ".$columnSortOrder." 
								limit ".$row.",".$rowperpage);exit();*/
		return $this->db->query("select prt.*, ct.Name as CA_Name, ct.ID as Cttype,sb.SB_Name,sb.ID as Sbtype,brd.Name,brd.ID as Btype 
								from tbl_product as prt
								left join tbl_category as ct on ct.ID = prt.Category_id	
								left join tbl_sub_category as sb on sb.ID = prt.Sub_category_id	
                                left join tbl_brand as brd on brd.ID = prt.Brand_id									
								WHERE 1 ".$searchQuery." order by prt.ID ".$columnSortOrder." 
								limit ".$row.",".$rowperpage)->result();
	}
	function allcountglassedge() {
		return $this->db->query("select count(*) as allcount from glass_edges")->row();
	}
	function filterCountglassedge($searchQuery) {
		return $this->db->query("select count(*) as allcount from glass_edges WHERE 1 " . $searchQuery)->row();
	}
	function listAllDataglassedge($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage) {
	    return $this->db->query("select * from glass_edges WHERE 1 ".$searchQuery."order by ".$columnName." ".$columnSortOrder." 
								limit ".$row.",".$rowperpage)->result();
	}
	function selectuser($Id){
		return $this->db->query("SELECT * FROM user where US_ID=".$Id)->row();
	}
	function update_user($Id,$dataset){
		$this->db->where('US_ID',$Id);
		$this->db->update('user',$dataset);
	 }
	function delete_user($Id){
		return $this->db->query("delete from user where US_ID=".$Id);
	}
	function selectglass_edge($Id){
		return $this->db->query("SELECT * FROM glass_edges where ID=".$Id)->row();
	}
	function updateglass_edge($Id,$dataset){
		$this->db->where('ID',$Id);
		$this->db->update('glass_edges',$dataset);
	 }
	function delete_glass($Id){
		return $this->db->query("delete from glass_edges where ID=".$Id);
	}
	function selectbrand($Id){
		return $this->db->query("SELECT * FROM tbl_brand where ID=".$Id)->row();
	}
	function update_brand($Id,$dataset){
		$this->db->where('ID',$Id);
		$this->db->update('tbl_brand',$dataset);
	 }
	function delete_brand($Id){
		return $this->db->query("delete from tbl_brand where ID=".$Id);
	}
	function selectcategory($Id){
		return $this->db->query("SELECT * FROM tbl_category where ID=".$Id)->row();
	}
	function updatecategory($Id,$dataset){
		$this->db->where('ID',$Id);
		$this->db->update('tbl_category',$dataset);
	 }
	function deletecategory($Id){
		return $this->db->query("delete from tbl_category where ID=".$Id);
	}
	function select_subcategory($Id){
		return $this->db->query("SELECT * FROM tbl_sub_category where ID=".$Id)->row();
	}
	function update_subcategory($Id,$dataset){
		$this->db->where('ID',$Id);
		$this->db->update('tbl_sub_category',$dataset);
	 }
	function delete_subcategory($Id){
		return $this->db->query("delete from tbl_sub_category where ID=".$Id);
	}
	function select_product($Id){
		return $this->db->query("SELECT pd.*, ct.Name as category_name, sct.SB_Name 
								FROM tbl_product as pd
								left join tbl_category as ct on ct.ID = pd.Category_id
								left join tbl_sub_category as sct on sct.ID = pd.Sub_category_id
								where pd.ID=".$Id)->row();
		
	}
	function update_product($Id,$dataset){
		$this->db->where('ID',$Id);
		$this->db->update('tbl_product',$dataset);
	 }
	 function delete_product($Id){
		return $this->db->query("delete from tbl_product where ID=".$Id);
	}
	/*-------------------------------------------------------------------------------------------------------------*/
	public function get_polish_type(){
		//echo("select * from tbl_polish_types where PO_Status = '1' ");exit();
		return $this->db->query("select * from tbl_polish_types where PO_Status = '1' ")->result();
	}
}  
?>  