<?php
class Return_order_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function get_work_order($tablearr)
	{
		$view = "SELECT RE.*, CU.* FROM tbl_return_dtl AS RE LEFT JOIN tbl_customer AS CU ON RE.CU_Id = CU.CU_Id WHERE RE.RE_Status = 1";
		if ($tablearr['columnName'] == 'slno' || $tablearr['columnName'] == 'action') {
			$orderby = " order by RE.RE_Id desc ";
		} else {
			$tablearr['columnName'] = 'RE.RE_Id';
			$orderby = " order by RE.RE_Id desc ";
		}
		$groupby = " group by RE.CU_Id";
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
				$status = array("1" => "Return");
				$detail = '<a href="return_order/detailview/' . $row->CU_Id . '"><i class="fa fa fa-eye"></i></a>';
				$data[] = array(
					"Order_No" => $row->PD_Order_No,
					"Customer" => ucwords($row->CU_Name),
					"Status" => $status[$row->RE_Status],
					"slno" => $slno,
					"detail" => $detail
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
	public function detailview($cus_id)
	{
		return $this->db->query("SELECT PD.*, RE.*, CU.*, PU.*, ED.*, US.US_Name, RE.PD_Quantity * RE.PD_Price AS total_price, RE.PD_Height * 10 AS total_height_mm, RE.PD_Width * 10 AS total_width_mm FROM tbl_product AS PD LEFT JOIN tbl_return_dtl AS RE ON PD.ID = RE.PD_Id LEFT JOIN tbl_product_units AS PU ON RE.PD_Unit = PU.UN_Id LEFT JOIN tbl_customer AS CU ON RE.CU_Id = CU.CU_Id LEFT JOIN user AS US ON RE.US_Id = US.US_Id LEFT JOIN glass_edges AS ED ON RE.ED_Id = ED.ID WHERE RE.CU_Id  = '" . $cus_id . "'")->result();
	}
	public function customerview($cus_id)
	{
		return $this->db->query("SELECT RE.*, CU.* FROM tbl_return_dtl AS RE LEFT JOIN tbl_customer AS CU ON RE.CU_Id = CU.CU_Id WHERE RE.CU_Id = '" . $cus_id . "'")->row();
	}
	public function get_workid()
	{
		return $data = $this->db->select('*')
			->from('tbl_sale_products')
			->group_by('PD_Order_No')
			->order_by('PD_Order_No')
			->get()
			->result();
	}
	public function fetchdata($woid)
	{
		$result = $this->db->select('c.*')
			->from('tbl_sale_products sp')
			->join('tbl_customer c', 'c.CU_Id = sp.CU_Id')
			->where('sp.PD_Order_No', $woid)
			->group_by('sp.PD_Order_No')
			->get()
			->result();

		return $result;
	}
	public function get_additionalitem(){
		return $data = $this->db->select('*')
							 ->from('tbl_additional_details')
							 ->get()
							 ->result();
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
	public function insertreturn($data){
		return $this->db->insert('tbl_return_dtl', $data);
	}
	public function getReturnReason($cuid) {
		$query = $this->db
			->select('Reason')
			->from('tbl_return_dtl')
			->where('CU_Id', $cuid)
			->group_by('CU_Id')
			->get();
			$row = $query->row();
			return $row->Reason;
	}
	
}
