<?php
class Delivery_Products_Model extends CI_Model{
	protected $table_name;
    public function __construct()
    {
        parent::__construct();
    }
	public function get_delivery_products($tablearr,$us_id){
	//	echo("SELECT PD.*, SL.*, CU.*, US.* FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.PD_Status != 6 AND SL.PD_Status = 3 AND SL.CU_Id = CU.CU_Id AND SL.US_Id = '".$us_id."' AND SL.PD_Status = '12'");exit();
		$view = "SELECT PD.*, SL.*, CU.*, US.* FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.PD_Status != 6 and US.Usertype = '4' and SL.CU_Id = CU.CU_Id AND SL.US_Id = '".$us_id."' and SL.PD_Status = 12" ;
		if($tablearr['columnName']=='slno'||$tablearr['columnName']=='action'){
			$orderby =" order by SL.SP_Id desc ";
		}
		else{
			$tablearr['columnName'] = 'SL.SP_Id';
			$orderby =" order by SL.SP_Id desc ";
		}
		$groupby=" group by CU.CU_Id";
		$searchQuery = " ";
		if($tablearr['searchValue'] != ''){
			$searchQuery = " and (CU.CU_Name like '%".$tablearr['searchValue']."%' || PD.Name like '%".$tablearr['searchValue']."%' || SL.PD_Status like '%".$tablearr['searchValue']."%') ";
		}
		//print_r($searchQuery);
		## Total number of records without filtering
		$totalRecords = $this->db->query($view)->num_rows();
		## Total number of record with filtering
		
		$totalRecordwithFilter = $this->db->query($view.$searchQuery)->num_rows();
		$viewQuery = $view.$searchQuery.$orderby." limit ".$tablearr['rowstart'].",".$tablearr['rowperpage'];
        $q = $this->db->query($viewQuery);
		$data = array();
		$slno = $tablearr['rowstart'];
		if($q->result()){
				foreach ($q->result() as $row) {
				$slno++;
				$status = array("1"=>"Order Taken","2"=>"Accepted","3"=>"Approved","4"=>"Rejected","5"=>"Completed","12"=>"Delieverd" );
				$detail ='<a href="delivery_products/detailview/'.$row->CU_Id.'"><i class="fa fa fa-eye"></i></a>';
				$action = '<a href="approved_enquiries/performa_invoice/'.$row->CU_Id.'"><i class="mdi 		mdi-file-document"></i></a><a href="javascript:void(0);" onclick="return confirm_delete('.$row->CU_Id.');"><i class="fa fa-trash"></i></a>';
				$data[] = array( 
					"Order_No"=>$row->PD_Order_No,
					"Name"=>ucwords($row->Name),
					"Customer"=>ucwords($row->CU_Name),
					"Status"=>$status[$row->PD_Status],
					"slno"=>$slno,
					"action"=>$action,
					"detail" =>$detail
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
	public function detailview($cus_id) {
		//print_r("SELECT PD.*, SL.*, CU.*, PU.*, ED.*, US.US_Name, SL.PD_Quantity * SL.PD_Price AS total_price, SL.PD_Height * 10 AS total_height_mm, SL.PD_Width * 10 AS total_width_mm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_product_units AS PU ON SL.PD_Unit = PU.UN_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id LEFT JOIN glass_edges AS ED ON SL.ED_Id = ED.ID WHERE SL.CU_Id  = '".$cus_id."'");exit();
		return $this->db->query("SELECT PD.*, SL.*, CU.*, PU.*, ED.*, US.US_Name, SL.PD_Quantity * SL.PD_Price AS total_price, SL.PD_Height * 10 AS total_height_mm, SL.PD_Width * 10 AS total_width_mm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_product_units AS PU ON SL.PD_Unit = PU.UN_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id LEFT JOIN glass_edges AS ED ON SL.ED_Id = ED.ID WHERE SL.CU_Id  = '".$cus_id."'")->result();
	}
	public function customerview($cus_id) {
		//echo("SELECT PD.*, SL.*, CU.*, US.US_Name FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'")->row();
	}
	public function get_Productname(){
		return $data = $this->db->select('*')
							 ->from('tbl_product')
							 ->get()
							 ->result();
	}
	public function get_product_unit(){
		return $data = $this->db->select('*')
							 ->from('tbl_product_units')
							 ->get()
							 ->result();
	}
	public function get_product_type(){
		return $this->db->query("select * from glass_edges where status = '1' ")->result();
	}
	public function insertproductname($data){
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
	public function remove_sales($cus_id){
		return  $query = $this->db->query("update tbl_sale_products set PD_Status =  '6' WHERE CU_Id = '".$cus_id."'");
	}
	/*public function cm_to_mm($cus_id){
		return this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Height * 10 AS total_height_mm, SL.PD_Width * 10 AS total_width_mm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN USER AS US ON SL.US_Id = US.US_Id  = '".$cus_id."'")->result();
	}
	public function inch_to_mm($cus_id){
		return this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Height * 25.4 AS total_height_mm, SL.PD_Width * 25.4 AS total_width_mm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN USER AS US ON SL.US_Id = US.US_Id  = '".$cus_id."'")->result();
	}
	public function feet_to_mm($cus_id){
		return this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Height * 304.79999025 AS total_height_mm, SL.PD_Width * 304.79999025 AS total_width_mm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN USER AS US ON SL.US_Id = US.US_Id  = '".$cus_id."'")->result();
	}*/
	
	public function saveInvoice($invoiceDoc, $cuid, $wo) {
		$resetInv = $this->db->query("delete from tbl_pr_invoice where CU_Id = '".$cuid."' and WO_Id = '".$wo."'");
		$saveInvoice = $this->db->query("insert into tbl_pr_invoice (IN_Invoice_Html, CU_Id, WO_Id, IN_Status) 
					values ('".$invoiceDoc."','".$cuid."','".$wo."','1')");
		
	}
	public function updatecustomerdetails($data,$id)
	{
		return $this->db->where('CU_Id',$id)
		->update('tbl_customer', $data);
	}
	public function updatesp($id, $data)
	{
		return $this->db->where('SP_Id', $id)
			->update('tbl_sale_products', $data);
	}
	public function additional_details($cus_id){
		//echo("SELECT * from tbl_additional_addings where CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT * from tbl_additional_addings where CU_Id = '".$cus_id."'")->result();
	}
	public function total_additional_charge($cus_id){
		return $this->db->query("SELECT *, SUM(AD_Quantity * AD_Unit_Price) AS total_additional_charges FROM tbl_additional_addings WHERE CU_Id = '".$cus_id."'")->row();
	}
}
?>