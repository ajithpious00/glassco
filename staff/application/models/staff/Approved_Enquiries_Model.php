<?php
class Approved_Enquiries_Model extends CI_Model{
	protected $table_name;
    public function __construct()
    {
        parent::__construct();
    }
	public function get_approved_enquiries($tablearr,$us_id){
		//echo("SELECT PD.*, SL.*, CU.*, US.* FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN user AS US ON US.US_Id = SL.US_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id WHERE PD.status = 1 AND SL.PD_Status = 3 AND SL.US_Id = '".$us_id."' OR US.Usertype =5 and SL.PD_Status = 2");exit();
		$view = "SELECT PD.*, SL.*, CU.*, US.* FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN user AS US ON US.US_Id = SL.US_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id WHERE PD.status = 1 AND SL.PD_Status = 3 AND SL.US_Id = '".$us_id."' OR US.Usertype =5 and SL.PD_Status = 3 group by SL.CU_Id" ;
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
				$status = array("1"=>"Order Taken","2"=>"Accepted","3"=>"Approved","4"=>"Rejected","5"=>"Completed");
				$detail ='<a href="approved_enquiries/detailview/'.$row->CU_Id.'"><i class="fa fa fa-eye"></i></a>';
				$action = '<a href="approved_enquiries/work_order/'.$row->CU_Id.'"><i class="mdi 		mdi-file-document"></i></a><a href="javascript:void(0);" onclick="return confirm_delete('.$row->CU_Id.');"><i class="fa fa-trash"></i></a>';
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
	public function agent_detail($cus_id) {
		//echo("SELECT AG.*, SL.* FROM tbl_sale_products AS SL LEFT JOIN tbl_agents AS AG ON SL.AG_Id = AG.AG_Id WHERE SL.CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT AG.*, SL.* FROM tbl_sale_products AS SL LEFT JOIN tbl_agents AS AG ON SL.AG_Id = AG.AG_Id WHERE SL.CU_Id = '".$cus_id."'")->row();
	}
	public function get_polish_rate($cus_id) {
		//echo();exit();
		return $this->db->query("select pa.*, pt.PO_Name from tbl_polish_addings as pa
								left join tbl_polish_types as pt on pt.PO_Id = pa.PO_Id
								where CU_Id = '".$cus_id."'")->row();
	}
	public function customerview($cus_id) {
		//echo("SELECT PD.*, SL.*, CU.*, US.US_Name FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Id,US.US_Name, US.Perfoma_Code FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'")->row();
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
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Quantity*SL.PD_Price , sum(SL.PD_Quantity*SL.PD_Price) as total_price FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'")->row();
	}
	/*public function cm_to_mm($cus_id){
		return this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Height * 10 AS total_height_mm, SL.PD_Width * 10 AS total_width_mm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN USER AS US ON SL.US_Id = US.US_Id  = '".$cus_id."'")->result();
	}*/
	public function update_accept_status($cus_id){
		return  $query = $this->db->query("update tbl_sale_products set PD_Status =  '2' WHERE CU_Id = '".$cus_id."'");
	}
	public function update_approved_status($cus_id){
		return  $query = $this->db->query("update tbl_sale_products set PD_Status =  '3' WHERE CU_Id = '".$cus_id."'");
	}
	public function remove_sales($cus_id){
		//echo("update tbl_sale_products set PD_Status =  '6' WHERE CU_Id = '".$cus_id."'");exit();
		return  $query = $this->db->query("update tbl_sale_products set PD_Status =  '6' WHERE CU_Id = '".$cus_id."'");
	}
	public function additional_details($prd_id){
		return $this->db->query("SELECT aa.*, ad.*, CASE WHEN ad.AU_Type IN (1, 3) THEN ROUND( AD_Quantity * AD_Unit_Price * 100 / 118, 2 ) WHEN ad.AU_Type = 2 THEN ROUND(AD_Unit_Price * 100 / 118, 2) ELSE NULL  END AS listing_price FROM tbl_additional_addings AS aa LEFT JOIN tbl_additional_details AS ad ON aa.AU_Id = ad.AU_Id WHERE SP_Id = '".$prd_id."' and AD_Quantity > 0")->result();
	}
	public function total_additional_charge($sp_id){
		return $this->db->query("SELECT SUM( CASE WHEN ad.AU_Type IN (1, 3) THEN ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2) WHEN ad.AU_Type = 2 THEN ROUND(AD_Unit_Price * 100 / 118, 2) ELSE NULL END ) AS total_listing_price FROM tbl_additional_addings AS aa LEFT JOIN tbl_additional_details AS ad ON aa.AU_Id = ad.AU_Id WHERE SP_Id = '".$sp_id."' AND AD_Quantity > 0")->row();
	}
	public function detailview($cus_id) {
		//echo("SELECT PD.*,SL.*,CU.*,PU.*,ED.*,US.US_Name,SL.PD_Quantity * SL.PD_Price AS total_price,SL.PD_Height * 10 As total_height_mm,SL.PD_Width * 10 AS total_width_mm, ROUND( (SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144,3) AS sqf, ROUND((( SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144 ) / 10.764,3) AS sqm,SL.PD_Quantity * ROUND(((SL.PD_Height * 10 * SL.PD_Width * 10 ) * 0.0393701 * 0.0393701 / 144 ) / 10.764,3) AS product_quantity_sqm,SUM(ROUND((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144,3)) OVER(PARTITION BY CU.CU_Id) AS sum_total_sqf, ROUND(SUM(((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144) / 10.764) OVER(), 3) AS sum_total_sqm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_product_units AS PU ON SL.PD_Unit = PU.UN_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id LEFT JOIN glass_edges AS ED ON SL.ED_Id = ED.ID WHERE SL.CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT
									PD.*,
									SL.*,
									CU.*,
									PU.*,
									ED.*,
									PO.*,
									PR.*,
									PI.*,
									US.US_Name,
									SL.PD_Quantity * SL.PD_Price AS total_price,
									CASE WHEN PU.UN_Id = 1 THEN(SL.PD_Height * 10) + SL.PD_Waste WHEN PU.UN_Id = 2 THEN(SL.PD_Height * 25.4) + SL.PD_Waste WHEN PU.UN_Id = 3 THEN(SL.PD_Height * 304.79999025) + SL.PD_Waste WHEN PU.UN_Id = 4 THEN(SL.PD_Height) + SL.PD_Waste ELSE(SL.PD_Height * 10) + SL.PD_Waste
								END AS total_height_mm,
								CASE WHEN PU.UN_Id = 1 THEN(SL.PD_Width * 10) + SL.PD_Waste WHEN PU.UN_Id = 2 THEN(SL.PD_Width * 25.4) + SL.PD_Waste WHEN PU.UN_Id = 3 THEN(SL.PD_Width * 304.79999025) + SL.PD_Waste WHEN PU.UN_Id = 4 THEN(SL.PD_Width) + SL.PD_Waste ELSE(SL.PD_Width * 10) + SL.PD_Waste
								END AS total_width_mm,
								ROUND(
									(
										CASE WHEN PU.UN_Id = 1 THEN(SL.PD_Height_Nl * 10) + SL.PD_Waste WHEN PU.UN_Id = 2 THEN(SL.PD_Height_Nl * 25.4) + SL.PD_Waste WHEN PU.UN_Id = 3 THEN(SL.PD_Height_Nl * 304.79999025) + SL.PD_Waste WHEN PU.UN_Id = 4 THEN(SL.PD_Height_Nl) + SL.PD_Waste ELSE(SL.PD_Height_Nl * 10) + SL.PD_Waste
									END * CASE WHEN PU.UN_Id = 1 THEN(SL.PD_Weight_Nl * 10) + SL.PD_Waste WHEN PU.UN_Id = 2 THEN(SL.PD_Weight_Nl * 25.4) + SL.PD_Waste WHEN PU.UN_Id = 3 THEN(SL.PD_Weight_Nl * 304.79999025) + SL.PD_Waste WHEN PU.UN_Id = 4 THEN(SL.PD_Weight_Nl) + SL.PD_Waste ELSE(SL.PD_Weight_Nl * 10) + SL.PD_Waste
								END
								) * 0.0393701 * 0.0393701 / 144,
								3
								) AS sqf,
								ROUND(
									(
										CASE WHEN PU.UN_Id = 1 THEN(SL.PD_Height_Nl * 10) + SL.PD_Waste WHEN PU.UN_Id = 2 THEN(SL.PD_Height_Nl * 25.4) + SL.PD_Waste WHEN PU.UN_Id = 3 THEN(SL.PD_Height_Nl * 304.79999025) + SL.PD_Waste WHEN PU.UN_Id = 4 THEN(SL.PD_Height_Nl) + SL.PD_Waste ELSE(SL.PD_Height_Nl * 10) + SL.PD_Waste
									END * CASE WHEN PU.UN_Id = 1 THEN(SL.PD_Weight_Nl * 10) + SL.PD_Waste WHEN PU.UN_Id = 2 THEN(SL.PD_Weight_Nl * 25.4) + SL.PD_Waste WHEN PU.UN_Id = 3 THEN(SL.PD_Weight_Nl * 304.79999025) + SL.PD_Waste WHEN PU.UN_Id = 4 THEN(SL.PD_Weight_Nl) + SL.PD_Waste ELSE(SL.PD_Weight_Nl * 10) + SL.PD_Waste
								END
								) * 0.0393701 * 0.0393701 / 144 / 10.764,
								3
								) AS sqm,
								ROUND(
									SL.PD_Quantity *(
										CASE WHEN PU.UN_Id = 1 THEN(SL.PD_Height_Nl * 10) + SL.PD_Waste WHEN PU.UN_Id = 2 THEN(SL.PD_Height_Nl * 25.4) + SL.PD_Waste WHEN PU.UN_Id = 3 THEN(SL.PD_Height_Nl * 304.79999025) + SL.PD_Waste WHEN PU.UN_Id = 4 THEN(SL.PD_Height_Nl) + SL.PD_Waste ELSE(SL.PD_Height_Nl * 10) + SL.PD_Waste
									END * CASE WHEN PU.UN_Id = 1 THEN(SL.PD_Weight_Nl * 10) + SL.PD_Waste WHEN PU.UN_Id = 2 THEN(SL.PD_Weight_Nl * 25.4) + SL.PD_Waste WHEN PU.UN_Id = 3 THEN(SL.PD_Weight_Nl * 304.79999025) + SL.PD_Waste WHEN PU.UN_Id = 4 THEN(SL.PD_Weight_Nl) + SL.PD_Waste ELSE(SL.PD_Weight_Nl * 10) + SL.PD_Waste
								END
								) * 0.0393701 * 0.0393701 / 144 / 10.764,
								3
								) AS product_quantity_sqm,
								ROUND(
									SL.PD_Quantity *(
										CASE WHEN PU.UN_Id = 1 THEN(SL.PD_Height_Nl * 10) + SL.PD_Waste WHEN PU.UN_Id = 2 THEN(SL.PD_Height_Nl * 25.4) + SL.PD_Waste WHEN PU.UN_Id = 3 THEN(SL.PD_Height_Nl * 304.79999025) + SL.PD_Waste WHEN PU.UN_Id = 4 THEN(SL.PD_Height_Nl) + SL.PD_Waste ELSE(SL.PD_Height_Nl * 10) + SL.PD_Waste
									END * CASE WHEN PU.UN_Id = 1 THEN(SL.PD_Weight_Nl * 10) + SL.PD_Waste WHEN PU.UN_Id = 2 THEN(SL.PD_Weight_Nl * 25.4) + SL.PD_Waste WHEN PU.UN_Id = 3 THEN(SL.PD_Weight_Nl * 304.79999025) + SL.PD_Waste WHEN PU.UN_Id = 4 THEN(SL.PD_Weight_Nl) + SL.PD_Waste ELSE(SL.PD_Weight_Nl * 10) + SL.PD_Waste
								END
								) * 0.0393701 * 0.0393701 / 144 / 10.764,
								3
								) * PD.PR_Weight as Product_weight
								FROM
									tbl_product AS PD
								LEFT JOIN tbl_sale_products AS SL
								ON
									PD.ID = SL.PD_Id
								LEFT JOIN tbl_product_units AS PU
								ON
									SL.PD_Unit = PU.UN_Id
								LEFT JOIN tbl_customer AS CU
								ON
									SL.CU_Id = CU.CU_Id
								LEFT JOIN user AS US
								ON
									SL.US_Id = US.US_Id
								LEFT JOIN glass_edges AS ED
								ON
									SL.ED_Id = ED.ID
								LEFT JOIN tbl_polish_types AS PO
								ON
									PO.PO_Id = SL.PO_Id
								LEFT JOIN tbl_product AS PI
								ON
									PI.ID = SL.PD_Id
								LEFT JOIN tbl_polish_rates AS PR
								ON
									PO.PO_Id = PR.PO_Id
								WHERE
									SL.CU_Id = '".$cus_id."' group by SL.SP_Id")->result();
	}
	public function total_sqs($cus_id) {
		return $this->db->query("SELECT PD.*,SL.*,CU.*,PU.*,ED.*,US.US_Name,SL.PD_Quantity * SL.PD_Price AS total_price,
								  CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Height * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Height * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Height * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Height) + SL.PD_Waste
									ELSE (SL.PD_Height * 10) + SL.PD_Waste
								  END AS total_height_mm,
								  CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Width * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Width * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Width * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Width) + SL.PD_Waste
									ELSE (SL.PD_Width * 10) + SL.PD_Waste
								  END AS total_width_mm,
								  ROUND((CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Height * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Height * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Height * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Height) + SL.PD_Waste
									ELSE (SL.PD_Height * 10) + SL.PD_Waste
								  END * CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Width * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Width * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Width * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Width) + SL.PD_Waste
									ELSE (SL.PD_Width * 10) + SL.PD_Waste
								  END) * 0.0393701 * 0.0393701 / 144, 3) AS sqft,
								  ROUND((CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Height * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Height * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Height * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Height) + SL.PD_Waste
									ELSE (SL.PD_Height * 10) + SL.PD_Waste
								  END * CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Width * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Width * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Width * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Width) + SL.PD_Waste
									ELSE (SL.PD_Width * 10) + SL.PD_Waste
								  END) * 0.0393701 * 0.0393701 / 144 / 10.764, 3) AS sqmtr,
								  ROUND(SL.PD_Quantity * (CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Height * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Height * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Height * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Height) + SL.PD_Waste
									ELSE (SL.PD_Height * 10) + SL.PD_Waste
								  END * CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Width * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Width * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Width * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Width) + SL.PD_Waste
									ELSE (SL.PD_Width * 10) + SL.PD_Waste
								  END) * 0.0393701 * 0.0393701 / 144 / 10.764, 3) AS product_quantity_sqm,
								  SUM(ROUND(SL.PD_Quantity * (CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Height_Nl * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Height_Nl * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Height_Nl * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Height_Nl) + SL.PD_Waste
									ELSE (SL.PD_Height_Nl * 10) + SL.PD_Waste
								  END * CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Weight_Nl * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Weight_Nl * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Weight_Nl * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Weight_Nl) + SL.PD_Waste
									ELSE (SL.PD_Weight_Nl * 10) + SL.PD_Waste
								  END) * 0.0393701 * 0.0393701 / 144 / 10.764, 3)) AS sum_total_sqmtr,
								  SUM(ROUND(SL.PD_Quantity * (CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Height_Nl * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Height_Nl * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Height_Nl * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Height_Nl) + SL.PD_Waste
									ELSE (SL.PD_Height_Nl * 10) + SL.PD_Waste
								  END * CASE
									WHEN PU.UN_Id = 1 THEN (SL.PD_Weight_Nl * 10) + SL.PD_Waste
									WHEN PU.UN_Id = 2 THEN (SL.PD_Weight_Nl * 25.4) + SL.PD_Waste
									WHEN PU.UN_Id = 3 THEN (SL.PD_Weight_Nl * 304.79999025) + SL.PD_Waste
									WHEN PU.UN_Id = 4 THEN (SL.PD_Weight_Nl) + SL.PD_Waste
									ELSE (SL.PD_Weight_Nl * 10) + SL.PD_Waste
								  END) * 0.0393701 * 0.0393701 / 144 / 10.764, 3) * SL.PD_Price) AS total_price
								FROM tbl_product AS PD
								LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id
								LEFT JOIN tbl_product_units AS PU ON SL.PD_Unit = PU.UN_Id
								LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id
								LEFT JOIN user AS US ON SL.US_Id = US.US_Id
								LEFT JOIN glass_edges AS ED ON SL.ED_Id = ED.ID
								WHERE SL.CU_Id = '".$cus_id."' group by CU.CU_Id;")->row();
	}
	public function total_additional_char($cus_id){
		//echo("SELECT SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS total_amount FROM tbl_additional_add WHERE CU_Id = '".$cus_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS total_amount FROM tbl_additional_add WHERE CU_Id = '".$cus_id."' AND AD_Quantity > 0")->row();
	}
	public function total_additional_dh($cus_id){
		//echo("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS list FROM tbl_additional_add WHERE AU_Id = 11 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS listt FROM tbl_additional_add WHERE AU_Id = 15 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0")->row();
	}
	public function total_additional_ch($cus_id){
		//echo("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS list FROM tbl_additional_add WHERE AU_Id = 11 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS listt FROM tbl_additional_add WHERE AU_Id = 11 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0")->row();
	}
	public function total_additional_th($cus_id){
		//echo("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS list FROM tbl_additional_add WHERE AU_Id = 11 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS listt FROM tbl_additional_add WHERE AU_Id = 13 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0")->row();
	}
	public function total_additional_hh($cus_id){
		//echo("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS list FROM tbl_additional_add WHERE AU_Id = 11 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS listt FROM tbl_additional_add WHERE AU_Id = 12 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0")->row();
	}
	/*public function taxable_amount($cus_id) {
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Quantity * SL.PD_Price, SUM(SL.PD_Quantity * SL.PD_Price) AS total_price, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS cgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS sgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS total_tax_amount, SUM(SL.PD_Quantity * SL.PD_Price) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) as grand_total FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id  = '".$cus_id."'")->row();
	}*/
	public function get_pi_code($cus_id){
		return $this->db->query("select * from tbl_sale_products where CU_Id = '".$cus_id."' group by CU_Id")->row();
	}
	public function get_cut_type($cus_id){
		return $this->db->query("select * from tbl_sale_products where CU_Id = '".$cus_id."' group by CU_Id")->row();
	}
	public function get_work_order_no($cus_id){
		return $this->db->query("select * from tbl_sale_products where CU_Id = '".$cus_id."' group by CU_Id")->row();
	}
}
?>