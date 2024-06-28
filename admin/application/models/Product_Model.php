<?php
class Product_model extends CI_Model{
	protected $table_name;
    public function __construct()
    {
        parent::__construct();
    }
	public function get_product($tablearr){
		//echo("select * from tbl_agents where AG_Status = 1");
		$view = "select * from tbl_product where 1 = 1" ;
		if($tablearr['columnName']=='slno'||$tablearr['columnName']=='action'){
			$orderby =" order by ID  desc ";
		}
		else{
			$tablearr['columnName'] = 'ID ';
			$orderby =" order by ID  desc ";
		}
		$groupby=" group by ID ";
		$searchQuery = " ";
		if($tablearr['searchValue'] != ''){
			$searchQuery = " and (PD_Name like '%".$tablearr['searchValue']."%') ";
		}
		//print_r($searchQuery);
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
				$status = array("1"=>"Active","2"=>"Inactve" );
				$detail ='<a href="sales_enquiries/detailview/'.$row->ID.'"><i class="fa fa fa-eye"></i></a>';
				$action = '<a href="sales_enquiries/performa_invoice/'.$row->ID.'"><i class="mdi 		mdi-file-document"></i></a><a href="javascript:void(0);" onclick="return confirm_delete('.$row->ID.');"><i class="fa fa-trash"></i></a><a href="sales_enquiries/edit/' . $row->ID . '"><i class="fa fa-pencil"></i></a>';
				$data[] = array( 
					"Product_Name"=>$row->PD_Name,
					"Product_Hsn_Code"=>ucwords($row->PD_Hsn_Code),
					"Product_Rate"=>ucwords($row->PR_Price),
					"Status"=>$status[$row->Status],
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
		//echo("SELECT PD.*,SL.*,CU.*,PU.*,ED.*,US.US_Name,SL.PD_Quantity * SL.PD_Price AS total_price,SL.PD_Height * 10 As total_height_mm,SL.PD_Width * 10 AS total_width_mm, ROUND( (SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144,3) AS sqf, ROUND((( SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144 ) / 10.764,3) AS sqm,SL.PD_Quantity * ROUND(((SL.PD_Height * 10 * SL.PD_Width * 10 ) * 0.0393701 * 0.0393701 / 144 ) / 10.764,3) AS product_quantity_sqm,SUM(ROUND((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144,3)) OVER(PARTITION BY CU.CU_Id) AS sum_total_sqf, ROUND(SUM(((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144) / 10.764) OVER(), 3) AS sum_total_sqm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_product_units AS PU ON SL.PD_Unit = PU.UN_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id LEFT JOIN glass_edges AS ED ON SL.ED_Id = ED.ID WHERE SL.CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT PD.*,SL.*,CU.*,PU.*,ED.*,US.US_Name,SL.PD_Quantity * SL.PD_Price AS total_price,CASE
								WHEN PU.UN_Id = 1 THEN (SL.PD_Height * 10) + SL.PD_Waste
								WHEN PU.UN_Id = 2 THEN (SL.PD_Height * 25.4) + SL.PD_Waste
								WHEN PU.UN_Id = 3 THEN (SL.PD_Height * 304.79999025) + SL.PD_Waste
								WHEN PU.UN_Id = 4 THEN (SL.PD_Height) + SL.PD_Waste
								ELSE (SL.PD_Height * 10) + SL.PD_Waste END AS total_height_mm,
								CASE
								WHEN PU.UN_Id = 1 THEN (SL.PD_Width * 10) + SL.PD_Waste
								WHEN PU.UN_Id = 2 THEN (SL.PD_Width * 25.4) + SL.PD_Waste
								WHEN PU.UN_Id = 3 THEN (SL.PD_Width * 304.79999025) + SL.PD_Waste
								WHEN PU.UN_Id = 4 THEN (SL.PD_Width) + SL.PD_Waste
								ELSE (SL.PD_Width * 10) + SL.PD_Waste
							  END AS total_width_mm,
							  ROUND((CASE
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
							  END) * 0.0393701 * 0.0393701 / 144, 3) AS sqf,
							  ROUND((CASE
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
							  END) * 0.0393701 * 0.0393701 / 144 / 10.764, 3) AS sqm,
							  ROUND(SL.PD_Quantity * (CASE
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
							  END) * 0.0393701 * 0.0393701 / 144 / 10.764, 3) AS product_quantity_sqm
							FROM tbl_product AS PD
							LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id
							LEFT JOIN tbl_product_units AS PU ON SL.PD_Unit = PU.UN_Id
							LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id
							LEFT JOIN user AS US ON SL.US_Id = US.US_Id
							LEFT JOIN glass_edges AS ED ON SL.ED_Id = ED.ID WHERE SL.CU_Id = '".$cus_id."'")->result();
	}
	public function total_sqs($cus_id) {
		//echo("SELECT PD.*, SL.*, CU.*, PU.*, ED.*, US.US_Name, SL.PD_Quantity * SL.PD_Price AS total_price,SL.PD_Height * 10 AS total_height_mm, SL.PD_Width * 10 AS total_width_mm, ROUND((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144, 3) AS total_sqf, ROUND(((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144) / 10.764, 3) AS total_sqm,  SL.PD_Quantity * ROUND(((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144) / 10.764, 3) AS product_quantity_sqm, SUM(SL.PD_Quantity * ROUND(((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144) / 10.764, 3)) AS sum_product_quantity_sqm, SUM(ROUND((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144, 3)) OVER (PARTITION BY CU.CU_Id) AS sum_total_sqf, ROUND(SUM(((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144) / 10.764) OVER(), 3) AS sum_total_sqm,SUM(SL.PD_Quantity * ROUND(((SL.PD_Height * 10 * SL.PD_Width * 10) * 0.0393701 * 0.0393701 / 144) / 10.764, 3)) * SL.PD_Price AS sum_product_quantity_price FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_product_units AS PU ON SL.PD_Unit = PU.UN_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id LEFT JOIN glass_edges AS ED ON SL.ED_Id = ED.ID WHERE SL.CU_Id  = '".$cus_id."' GROUP BY CU.CU_Id");exit();
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
	public function taxable_amount($cus_id) {
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Quantity * SL.PD_Price, SUM(SL.PD_Quantity * SL.PD_Price) AS total_price, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS cgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS sgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS total_tax_amount, SUM(SL.PD_Quantity * SL.PD_Price) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) as grand_total FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id  = '".$cus_id."'")->row();
	}
	public function get_polish_rate($cus_id) {
		return $this->db->query("select pa.*, pt.PO_Name from tbl_polish_addings as pa
								left join tbl_polish_types as pt on pt.PO_Id = pa.PO_Id
								where CU_Id = '".$cus_id."'")->row();
	}
	public function customerview($cus_id) {
		//echo("SELECT PD.*, SL.*, CU.*, US.US_Name FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, US.Perfoma_Code FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'")->row();
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
	public function get_additionalitem(){
		return $data = $this->db->select('*')
							 ->from('tbl_additional_details')
							 ->get()
							 ->result();
	}
	public function get_product_type(){
		return $this->db->query("select * from glass_edges where status = '1' ")->result();
	}
	public function get_polish_type(){
		return $this->db->query("select * from tbl_polish_types where PO_Status = '1' ")->result();
	}
	public function insertproductname($data){
		return $this->db->insert('tbl_sale_products', $data);
	}
	public function fetchcust($id){
		return $data = $this->db->select('*')
							 ->from('tbl_customer')
							 ->where('CU_Id',$id)
							 ->get()
							 ->result();
	}
	public function get_Customername(){
		return $data = $this->db->select('*')
							 ->from('tbl_customer')
							 ->group_by('CU_Phone')
							 ->order_by('CU_Name')
							 ->get()
							 ->result();
	}
	public function insertpolish($dat){
		return $this->db->insert('tbl_polish_rates', $dat);
	}
	public function insertproduct($data){
		return $this->db->insert('tbl_product', $data);
	}
	public function insertpolishdetails($po){
		return $this->db->insert('tbl_polish_addings', $po);
	}
	public function checkCustomer($data) {
		$query = $this->db->query("SELECT * FROM tbl_customer WHERE CU_Phone = '".$data['CU_Phone']."'")->row();
		return $query;
	}
	public function insert_additional_details($dat){
		//print_r($this->db->insert('tbl_additional_addings', $dat));exit();
		return $this->db->insert('tbl_additional_addings', $dat);
	}
	public function update_additional_details($data,$id,$adid){
		return $this->db->where('CU_Id',$id)
		->where('AU_Id',$adid)
		->update('tbl_additional_addings',$data);
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
	}
	*/
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
	public function additional_details($prd_id){
		//echo("SELECT *,ROUND( AD_Quantity * AD_Unit_Price * 100 / 118,2) AS listing_price FROM tbl_additional_addings WHERE SP_Id = '".$prd_id."' and AD_Quantity > 0");exit();
		//echo("SELECT * from tbl_additional_addings where CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT *,ROUND( AD_Quantity * AD_Unit_Price * 100 / 118,2) AS listing_price FROM tbl_additional_addings WHERE SP_Id = '".$prd_id."' and AD_Quantity > 0")->result();
	}
	public function total_additional_charge($cus_id){
		return $this->db->query("SELECT SUM(AD_Quantity * AD_Unit_Price * 100 / 118) AS total_additional_price FROM tbl_additional_addings WHERE CU_Id = '".$cus_id."'")->row();
	}
	public function remove_product($pd_id){
		return  $query = $this->db->query("update tbl_product set Status =  '2' WHERE ID = '".$pd_id."'");
	}
}
?>