
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
		$this->db->insert('tbl_settings',$dataset);
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
   function select_category()
	{
		$query = $this->db->get('tbl_category');  
        return $query;
		
	}
   function select_sub_category()
	{
		$query = $this->db->get('tbl_sub_category');  
        return $query;
		
	}
	function select_brand()
	{
		$query = $this->db->get('tbl_brand');  
        return $query;
		
	}
	function select_product()
	{
		$query = $this->db->get('tbl_product');  
        return $query;
		
	}
	function select_usertype()
	{
		$query = $this->db->query('select * from tbl_user_type where ID<>1'); 
		return $query;
	}
	function select_categoryname()
	{
		$query = $this->db->query('select * from tbl_category where Status=1'); 
		return $query;
	}
	function select_subcategoryname()
	{
		$query = $this->db->query('select * from tbl_sub_category where Status=1'); 
		return $query;
	}
	function select_brandname()
	{
		$query = $this->db->query('select * from tbl_brand where Status=1'); 
		return $query;
	}
	function allcount() {
		return $this->db->query("select count(*) as allcount from user as us")->row();
	}
	
	function filterCount($searchQuery) {
		return $this->db->query("select count(*) as allcount from user as us WHERE 1 " . $searchQuery)->row();
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
		return $this->db->query("select sb.*,ct.Name, ct.ID as Cttype from tbl_sub_category as sb
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
	function listAllDataproduct($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage) {
	
		return $this->db->query("select prt.*,ct.Name, ct.ID as Cttype,sb.Name,sb.ID as Sbtype,brd.Name,brd.ID as Btype 
								from tbl_product as prt
								left join tbl_category as ct on ct.ID = prt.Category_id	
								left join tbl_sub_category as sb on sb.ID = prt.Sub_category_id	
                                left join tbl_brand as brd on brd.ID = prt.Brand_id									
								WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." 
								limit ".$row.",".$rowperpage)->result();
	}
	function allcountglassedge() {
		return $this->db->query("select count(*) as allcount from glass_edges")->row();
	}
	function filterCountglassedge($searchQuery) {
		return $this->db->query("select count(*) as allcount from glass_edges WHERE 1 " . $searchQuery)->row();
	}
	function listAllDataglassedge($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage) {
	    return $this->db->query("select * from glass_edges
								WHERE 1 ".$searchQuery."order by ".$columnName." ".$columnSortOrder." 
								limit ".$row.",".$rowperpage)->result();
	}
}  
?>  