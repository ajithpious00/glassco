<?php
class History_Model extends CI_Model
{
	protected $table_name;
	public function __construct()
	{
		parent::__construct();
	}
	public function get_work_order($tablearr)
	{
		$view = "SELECT PD.*, SL.*, CU.* FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id WHERE PD.status = 1 and SL.PD_Status = 9";
		if ($tablearr['columnName'] == 'slno' || $tablearr['columnName'] == 'action') {
			$orderby = " order by SL.SP_Id desc ";
		} else {
			$tablearr['columnName'] = 'SL.SP_Id';
			$orderby = " order by SL.SP_Id desc ";
		} 
		$groupby=" group by SL.CU_Id";
		$searchQuery = " ";
		if ($tablearr['searchValue'] != '') {
			$searchQuery = " and (CU_Name like '%" . $tablearr['searchValue'] . "%') ";
		}
		## Total number of records without filtering
		$totalRecords = $this->db->query($view)->num_rows();
		## Total number of record with filtering

		$totalRecordwithFilter = $this->db->query($view . $searchQuery)->num_rows();
		$viewQuery = $view . $searchQuery .   $groupby . $orderby  . " limit " . $tablearr['rowstart'] . "," . $tablearr['rowperpage'];
		$q = $this->db->query($viewQuery);
		$data = array();
		$slno = $tablearr['rowstart'];
		if ($q->result()) {
			foreach ($q->result() as $row) {
				$slno++;
				$status = array("1" => "Order Taken", "2" => "Accepted", "3" => "Approved", "4" => "Rejected", "9" => "Completed");
				$data[] = array(
					"Order_No"=>$row->PD_Order_No,
					"Customer" => ucwords($row->CU_Name),
					"Status" => $status[$row->PD_Status],
					"slno" => $slno
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
		return $this->db->query("SELECT PD.*, SL.*, CU.*, PU.*, ED.*, US.US_Name, SL.PD_Quantity * SL.PD_Price AS total_price, SL.PD_Height * 10 AS total_height_mm, SL.PD_Width * 10 AS total_width_mm FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_product_units AS PU ON SL.PD_Unit = PU.UN_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id LEFT JOIN glass_edges AS ED ON SL.ED_Id = ED.ID WHERE SL.CU_Id  = '".$cus_id."'")->result();
	}
	public function customerview($cus_id) {
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'")->row();
	}
	public function additional_details($cus_id){
		//echo("SELECT * from tbl_additional_addings where CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT * from tbl_additional_addings where CU_Id = '".$cus_id."'")->result();
	}

}
?>