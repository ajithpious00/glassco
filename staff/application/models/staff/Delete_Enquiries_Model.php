<?php
class Delete_enquiries_Model extends CI_Model{
	protected $table_name;
    public function __construct()
    {
        parent::__construct();
    }
	public function get_delete_details($tablearr,$us_id){
		$view = "SELECT PD.*, SL.*, CU.*, US.* FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id WHERE SL.PD_Status = 6 AND SL.US_Id = '".$us_id."' OR US.Usertype =5 and SL.PD_Status = 6";
		if($tablearr['columnName']=='slno'||$tablearr['columnName']=='action'){
			$orderby =" order by SL.SP_Id desc ";
		}
		else{
			$tablearr['columnName'] = 'SL.SP_Id';
			$orderby =" order by SL.SP_Id desc ";
		}
		$groupby=" group by SL.CU_Id";
		$searchQuery = " ";
		if($tablearr['searchValue'] != ''){
			$searchQuery = " and (CU_Name like '%".$tablearr['searchValue']."%') ";
		}
		## Total number of records without filtering
		$totalRecords = $this->db->query($view)->num_rows();
		## Total number of record with filtering
		
		$totalRecordwithFilter = $this->db->query($view.$searchQuery)->num_rows();
		$viewQuery = $view.$searchQuery.$groupby .$orderby." limit ".$tablearr['rowstart'].",".$tablearr['rowperpage'];
        $q = $this->db->query($viewQuery);
		$data = array();
		$slno = $tablearr['rowstart'];
		if($q->result()){
				foreach ($q->result() as $row) {
				$slno++;
				$status = array("1"=>"Order Taked","2"=>"Accepted","3"=>"Approved","4"=>"Rejected","5"=>"Completed", "6"=>"Deleted" );
				// $detail ='<a href="delete_enquiries/detailview/'.$row->CU_Id.'"><i class="fa fa fa-eye"></i></a>';
				$action = '<a href="delete_enquiries/performa_invoice/'.$row->CU_Id.'"><i class="mdi mdi-file-document"></i></a>';
				$data[] = array( 
					"Order_No"=>$row->PD_Order_No,
					"Customer"=>ucwords($row->CU_Name),
					"Status"=>$status[$row->PD_Status],
					"slno"=>$slno,
					"action"=>$action,
					// "detail" =>$detail
				);
			}
		}
		## Response
		$response = array(
		  "draw" => intval($tablearr['draw']),
		  "iTotalRecords" => $totalRecords,
		  "iTotalDisplayRecords" => $totalRecordwithFilter,
		  "aaData" => $data
		);
        return $response;
    }
	public function update_status($cus_id){
		return  $query = $this->db->query("update tbl_sale_products set PD_Status =  '4' WHERE CU_Id = '".$cus_id."'");
	}
	public function detailview($cus_id) {
		return $this->db->query("SELECT PD.*, SL.*, CU.*, PU.*, ED.*, US.US_Name, SL.PD_Quantity * SL.PD_Price AS total_price, SL.PD_Height * 10 AS total_height_mm, SL.PD_Width * 10 AS total_width_mm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_product_units AS PU ON SL.PD_Unit = PU.UN_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id LEFT JOIN glass_edges AS ED ON SL.ED_Id = ED.ID WHERE SL.CU_Id  = '".$cus_id."'")->result();
	}
	public function taxable_amount($cus_id) {
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Quantity * SL.PD_Price, SUM(SL.PD_Quantity * SL.PD_Price) AS total_price, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS cgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS sgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS total_tax_amount, SUM(SL.PD_Quantity * SL.PD_Price) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) as grand_total FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id  = '".$cus_id."'")->row();
	}
	public function customerview($cus_id) {
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'")->row();
	}
	public function get_Productname(){
		return $data = $this->db->select('*')
							 ->from('tbl_product')
							 ->get()
							 ->result();
	}
	public function get_Product_unit(){
		return $data = $this->db->select('*')
							 ->from('tbl_product_units')
							 ->get()
							 ->result();
	}
	public function insertproductname($data){
		print_r ($this->db->insert('tbl_sale_products', $data));exit();
			return $this->db->insert('tbl_sale_products', $data);
	}
	public function insertheight($data){
		return $this->db->insert('tbl_sale_products', $data);
	}
	public function insertcustomerdetails($cus){
		return $this->db->insert('tbl_customer', $cus);
	}
	public function checkCustomer($data) {
		$query = $this->db->query("SELECT * FROM tbl_customer WHERE CU_Phone = '".$data['CU_Phone']."'")->row();
		return $query;
	}
	public function getproduct($cus_id){
		return $this->db->query("SELECT PD.*, CU.*, SP.* FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SP ON PD.ID = SP.PD_Id LEFT JOIN tbl_customer AS CU ON SP.CU_Id = CU.CU_Id WHERE CU.CU_Id = '".$cus_id."'")->result();
	}
	public function getheight($cus_id){
		return $this->db->query("SELECT * from tbl_sale_products where CU_Id = '".$cus_id."'")->result();
	}
	public function totalamount($cus_id){
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Quantity * SL.PD_Price, SUM(SL.PD_Quantity * SL.PD_Price) AS total_price, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS cgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS sgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS total_tax_amount, SUM(SL.PD_Quantity * SL.PD_Price) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) as grand_total FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'")->row();
	}
	/*public function cm_to_mm($cus_id){
		return this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Height * 10 AS total_height_mm, SL.PD_Width * 10 AS total_width_mm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN USER AS US ON SL.US_Id = US.US_Id  = '".$cus_id."'")->result();
	}*/
	public function additional_details($cus_id){
		//echo("SELECT * from tbl_additional_addings where CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT * from tbl_additional_addings where CU_Id = '".$cus_id."'")->result();
	}
	public function total_additional_charge($cus_id){
		return $this->db->query("SELECT *, SUM(AD_Quantity * AD_Unit_Price) AS total_additional_charges FROM tbl_additional_addings WHERE CU_Id = '".$cus_id."'")->row();
	}
}
?>