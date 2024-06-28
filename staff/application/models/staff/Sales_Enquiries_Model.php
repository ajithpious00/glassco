<?php
class Sales_Enquiries_Model extends CI_Model
{
	protected $table_name;
	public function __construct()
	{
		parent::__construct();
	}
	public function get_sale_enquiries($tablearr, $us_id)
	{
		//echo("SELECT PD.*, SL.*, CU.*, US.* FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.PD_Status != 6 and US.Usertype = '4' and SL.CU_Id = CU.CU_Id AND SL.US_Id = '".$us_id."' and SL.PD_Status != 12");
		$view = "SELECT PD.*, SL.*, CU.*, US.* FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.PD_Status != 6 and US.Usertype = '4' and SL.CU_Id = CU.CU_Id AND SL.US_Id = '" . $us_id . "' and SL.PD_Status != 12";
		if ($tablearr['columnName'] == 'slno' || $tablearr['columnName'] == 'action') {
			$orderby = " order by SL.SP_Id desc ";
		} else {
			$tablearr['columnName'] = 'SL.SP_Id';
			$orderby = " order by SL.SP_Id desc ";
		}
		$groupby = " group by CU.CU_Id";
		$searchQuery = " ";
		if ($tablearr['searchValue'] != '') {
			$searchQuery = " and (CU.CU_Name like '%" . $tablearr['searchValue'] . "%') ";
		}
		//print_r($searchQuery);
		## Total number of records without filtering
		$totalRecords = $this->db->query($view)->num_rows();
		## Total number of record with filtering

		$totalRecordwithFilter = $this->db->query($view . $searchQuery)->num_rows();
		$viewQuery = $view . $searchQuery . $groupby . $orderby . " limit " . $tablearr['rowstart'] . "," . $tablearr['rowperpage'];
		$q = $this->db->query($viewQuery);
		$data = array();
		$slno = $tablearr['rowstart'];
		if ($q->result()) {
			foreach ($q->result() as $row) {
				$slno++;
				$status = array("1" => "Order Taken", "2" => "Accepted", "3" => "Approved", "4" => "Rejected", "5" => "Completed", "9" => "Polishing Completed", "10" => "Washing Completed", "11" => "Toughen Completed", "12" => "Delivered");
				// $detail = '<a href="sales_enquiries/detailview/' . $row->CU_Id . '"><i class="fa fa fa-eye"></i></a>';
				$action = '<a href="sales_enquiries/performa_invoice/' . $row->CU_Id . '"><i class="mdi mdi-file-document"></i></a>';
				$action .= '<a href="javascript:void(0);" onclick="return confirm_delete(' . $row->CU_Id . ');">' . ($row->GST == "" ? '<i class="fa fa-trash"></i></a>' : '');
				if ($row->PD_Status < 3) {
					$action .= '<a href="sales_enquiries/edit_sales/' . $row->CU_Id . '"><i class="fa fa-pencil"></i></a>';
				}
				$data[] = array(
					"Order_No" => $row->PD_Order_No,
					"Customer" => ucwords($row->CU_Name),
					"Status" => $status[$row->PD_Status],
					"slno" => $slno,
					"action" => $action,
					// "detail" => $detail
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
									SL.CU_Id = '" . $cus_id . "' group by SL.SP_Id")->result();
	}
	public function total_sqs($cus_id)
	{
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
								WHERE SL.CU_Id = '" . $cus_id . "' group by CU.CU_Id;")->row();
	}
	public function get_pd_status($cus_id)
	{
		return $this->db->query("select * from tbl_sale_products where CU_id = '" . $cus_id . "' ")->row();
	}
	public function taxable_amount($cus_id)
	{
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Quantity * SL.PD_Price, SUM(SL.PD_Quantity * SL.PD_Price) AS total_price, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS cgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS sgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS total_tax_amount, SUM(SL.PD_Quantity * SL.PD_Price) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) as grand_total FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id  = '" . $cus_id . "'")->row();
	}
	public function get_polish_rate($cus_id)
	{
		//echo();exit();
		return $this->db->query("select pa.*, pt.PO_Name from tbl_polish_addings as pa
								left join tbl_polish_types as pt on pt.PO_Id = pa.PO_Id
								where CU_Id = '" . $cus_id . "'")->row();
	}
	public function customerview($cus_id)
	{
		/*$this->db->select('tbl_customer.*,tbl_sale_products.SP_Type');
		$this->db->from('tbl_customer');
		$this->db->where('tbl_customer.CU_Id', $cus_id);
		$this->db->join('tbl_sale_products', 'tbl_customer.CU_Id = tbl_sale_products.CU_Id', 'left');
		$query = $this->db->get()->row();
		return $query;*/
			//echo("SELECT PD.*, SL.*, CU.*, US.US_Name, US.Perfoma_Code FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, US.Perfoma_Code FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '".$cus_id."'")->row();
		// return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, US.Perfoma_Code FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '" . $cus_id . "'")->row();
	}
	public function agent_detail($cus_id)
	{
		//echo("SELECT AG.*, SL.* FROM tbl_sale_products AS SL LEFT JOIN tbl_agents AS AG ON SL.AG_Id = AG.AG_Id WHERE SL.CU_Id = '".$cus_id."'");exit();
		return $this->db->query("SELECT AG.*, SL.* FROM tbl_sale_products AS SL LEFT JOIN tbl_agents AS AG ON SL.AG_Id = AG.AG_Id WHERE SL.CU_Id = '" . $cus_id . "'")->row();
	}
	public function agent_bank_detail($agentbankdet)
	{
		return $this->db->query("select * from tbl_agent_bank_accounts where AB_Status = 1 and AG_Id = '" . $agentbankdet . "' ")->row();
	}
	public function get_Productname()
	{
		return $data = $this->db->select('*')
						->from('tbl_product')
						->where('status', 1)
						->get()
						->result();
	}
	public function get_product_unit()
	{
		return $data = $this->db->select('*')
			->from('tbl_product_units')
			->get()
			->result();
	}
	public function get_additional()
	{
		return $data = $this->db->select('*')
			->from('tbl_additional_details')
			->where_in('AU_Type', '3')
			->get()
			->result();
	}
	public function get_additionalitem()
	{
		return $data = $this->db->select('*')
			->from('tbl_additional_details')
			->where_in('AU_Type', array('1', '2')) // Replace 'column_name' and $value with your actual conditions
			->get()
			->result();
	}
	public function get_product_type()
	{
		return $this->db->query("select * from glass_edges where status = '1' ")->result();
	}
	public function get_polish_type()
	{
		return $this->db->query("select * from tbl_polish_types where PO_Status = '1' ")->result();
	}
	public function get_agent()
	{
		return $this->db->query("select * from tbl_agents where AG_Status = '1' ")->result();
	}
	public function insertproductname($data)
	{
		return $this->db->insert('tbl_sale_products', $data);
	}
	public function fetchcust($id)
	{
		return $data = $this->db->select('*')
			->from('tbl_customer')
			->where('CU_Id', $id)
			->get()
			->result();
	}
	public function get_Customername()
	{
		return $data = $this->db->select('*')
			->from('tbl_customer')
			->group_by('CU_Phone')
			->order_by('CU_Name')
			->get()
			->result();
	}
	public function insertcustomerdetails($data)
	{
		return $this->db->insert('tbl_customer', $data);
	}
	public function invcustomerdetails($data)
	{
		return $this->db->insert('tbl_inv_customer', $data);
	}
	public function insertpolishdetails($po)
	{
		return $this->db->insert('tbl_polish_addings', $po);
	}
	public function checkCustomer($data)
	{
		$query = $this->db->query("SELECT * FROM tbl_customer WHERE CU_Phone = '" . $data['CU_Phone'] . "'")->row();
		return $query;
	}
	public function insertheight($data)
	{
		$this->db->insert('tbl_inv_sale_products', $data);
		return $this->db->insert('tbl_sale_products', $data);
	}
	public function insert_additional_details($dat)
	{
		$this->db->insert('tbl_inv_additional_addings', $dat);
		return $this->db->insert('tbl_additional_addings', $dat);
	}
	public function insert_additional_detail($da)
	{
		$this->db->insert('tbl_inv_additional_add', $da);
		return $this->db->insert('tbl_additional_add', $da);
	}
	public function deleteAdditional($cus_id)
	{
		$this->db->where('CU_Id', $cus_id);
		$this->db->delete('tbl_additional_add');
		$this->db->where('CU_Id', $cus_id);
		$this->db->delete('tbl_additional_addings');
		$this->db->where('CU_Id', $cus_id);
		$this->db->delete('tbl_sale_products');
		$this->db->where('CU_Id', $cus_id);
		$this->db->delete('tbl_inv_additional_add');
		$this->db->where('CU_Id', $cus_id);
		$this->db->delete('tbl_inv_additional_addings');
		$this->db->where('CU_Id', $cus_id);
		$this->db->delete('tbl_inv_sale_products');
	}
	public function update_additional_details($data, $id, $adid)
	{
		return $this->db->where('CU_Id', $id)
			->where('AU_Id', $adid)
			->update('tbl_additional_addings', $data);
	}
	public function getproduct($cus_id)
	{
		return $this->db->query("SELECT PD.*, CU.*, SP.* FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SP ON PD.ID = SP.PD_Id LEFT JOIN tbl_customer AS CU ON SP.CU_Id = CU.CU_Id WHERE CU.CU_Id = '" . $cus_id . "'")->result();
	}
	public function getheight($cus_id)
	{
		return $this->db->query("SELECT * from tbl_sale_products where CU_Id = '" . $cus_id . "'")->result();
	}
	public function totalamount($cus_id)
	{
		return $this->db->query("SELECT PD.*, SL.*, CU.*, US.US_Name, SL.PD_Quantity * SL.PD_Price, SUM(SL.PD_Quantity * SL.PD_Price) AS total_price, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS cgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS sgst, SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) AS total_tax_amount, SUM(SL.PD_Quantity * SL.PD_Price) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) + SUM(SL.PD_Quantity * SL.PD_Price) *(9 / 100) as grand_total FROM tbl_product AS PD LEFT JOIN tbl_sale_products AS SL ON PD.ID = SL.PD_Id LEFT JOIN tbl_customer AS CU ON SL.CU_Id = CU.CU_Id LEFT JOIN user AS US ON SL.US_Id = US.US_Id WHERE SL.CU_Id = '" . $cus_id . "'")->row();
	}
	public function remove_sales($cus_id)
	{
		return  $query = $this->db->query("update tbl_sale_products set PD_Status =  '6' WHERE CU_Id = '" . $cus_id . "'");
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
	public function saveInvoice($invoiceDoc, $cuid, $wo)
	{
		$resetInv = $this->db->query("delete from tbl_pr_invoice where CU_Id = '" . $cuid . "' and WO_Id = '" . $wo . "'");
		$saveInvoice = $this->db->query("insert into tbl_pr_invoice (IN_Invoice_Html, CU_Id, WO_Id, IN_Status) 
					values ('" . $invoiceDoc . "','" . $cuid . "','" . $wo . "','1')");
	}
	public function updatecustomerdetails($data, $id)
	{
		$this->db->where('CU_Id', $id);
		$this->db->update('tbl_inv_customer', $data);

		$this->db->where('CU_Id', $id);
		$this->db->update('tbl_customer', $data);
	}

	public function updatesp($id, $data)
	{
		return $this->db->where('SP_Id', $id)
			->update('tbl_sale_products', $data);
	}
	public function additional_details($cus_id)
	{
		$this->db->select('tbl_sale_products.*, tbl_additional_addings.*');
		$this->db->from('tbl_sale_products');
		$this->db->where('tbl_sale_products.CU_Id', $cus_id);
		$this->db->join('tbl_additional_addings', 'tbl_sale_products.SP_Id = tbl_additional_addings.SP_Id', 'left');
		$query = $this->db->get();
		$result = array();
		foreach ($query->result() as $row) {
			$sp_id = $row->SP_Id;
			if (!isset($result[$sp_id])) {
				$result[$sp_id] = (array)$row;
				$result[$sp_id]['additional_details'] = array();
			}
			$additionalDetail = array(
				'AD_Id' => $row->AD_Id,
				'AU_Id' => $row->AU_Id,
				'AU_Item' => $row->AU_Item,
				'AD_Quantity' => $row->AD_Quantity,
				'AD_Unit_Price' => $row->AD_Unit_Price,
				'AD_Total_Amount' => $row->AD_Total_Amount,
				'CU_Id' => $row->CU_Id,
				'US_Id' => $row->US_Id,
			);
			$result[$sp_id]['additional_details'][] = $additionalDetail;
		}
		$result = array_values($result);

		return $result;
	}
	public function additional_add($cus_id)
	{
		return $this->db->select('*')
			->from('tbl_additional_add')
			->where('CU_Id', $cus_id)
			->get()->result();
	}

	public function total_additional_charge($sp_id)
	{
		//echo("SELECT SUM( CASE WHEN ad.AU_Type IN (1, 3) THEN ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2) WHEN ad.AU_Type = 2 THEN ROUND(AD_Unit_Price * 100 / 118, 2) ELSE NULL END ) AS total_listing_price FROM tbl_additional_addings AS aa LEFT JOIN tbl_additional_details AS ad ON aa.AU_Id = ad.AU_Id WHERE SP_Id = '".$sp_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT SUM( CASE WHEN ad.AU_Type IN (1, 3) THEN ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2) WHEN ad.AU_Type = 2 THEN ROUND(AD_Unit_Price * 100 / 118, 2) ELSE NULL END ) AS total_listing_price FROM tbl_additional_addings AS aa LEFT JOIN tbl_additional_details AS ad ON aa.AU_Id = ad.AU_Id WHERE SP_Id = '" . $sp_id . "' AND AD_Quantity > 0")->row();
	}
	public function total_additional_char($cus_id)
	{
		//echo("SELECT SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS total_amount FROM tbl_additional_add WHERE CU_Id = '".$cus_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS total_amount FROM tbl_additional_add WHERE CU_Id = '" . $cus_id . "' AND AD_Quantity > 0")->row();
	}
	public function total_additional_dh($cus_id)
	{
		//echo("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS list FROM tbl_additional_add WHERE AU_Id = 11 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS listt FROM tbl_additional_add WHERE AU_Id = 15 and  CU_Id = '" . $cus_id . "' AND AD_Quantity > 0")->row();
	}
	public function total_additional_ch($cus_id)
	{
		//echo("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS list FROM tbl_additional_add WHERE AU_Id = 11 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS listt FROM tbl_additional_add WHERE AU_Id = 14 and  CU_Id = '" . $cus_id . "' AND AD_Quantity > 0")->row();
	}
	public function total_additional_th($cus_id)
	{
		//echo("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS list FROM tbl_additional_add WHERE AU_Id = 11 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS listt FROM tbl_additional_add WHERE AU_Id = 13 and  CU_Id = '" . $cus_id . "' AND AD_Quantity > 0")->row();
	}
	public function total_additional_hh($cus_id)
	{
		//echo("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price * 100 / 118, 2)) AS list FROM tbl_additional_add WHERE AU_Id = 11 and  CU_Id = '".$cus_id."' AND AD_Quantity > 0");exit();
		return $this->db->query("SELECT *,SUM(ROUND(AD_Quantity * AD_Unit_Price , 2)) AS listt FROM tbl_additional_add WHERE AU_Id = 12 and  CU_Id = '" . $cus_id . "' AND AD_Quantity > 0")->row();
	}
	public function getPolish($prdId)
	{
		return $this->db->query("select pr.*, pt.PO_Name, pd.PR_Price
							from tbl_polish_rates as pr
							left join tbl_polish_types as pt on pt.PO_Id = pr.PO_Id
							left join tbl_product as pd on pd.ID = pr.PD_Id
							where pr.PD_Id = '" . $prdId . "' group by PO_Id")->result();
	}
	public function getPolishRates($ptId, $pdId)
	{
		return $this->db->query("select * from tbl_polish_rates where PO_Id = '" . $ptId . "' and PD_Id = '" . $pdId . "'")->row();
	}
	public function getAddNos()
	{
		return $this->db->query("select count(AU_Id) as addCnt from tbl_additional_details where AU_Status = 1 and AU_Type IN ('1', '2')")->row();
	}
	public function check_agent($ag_id)
	{
		return $this->db->query("select * from tbl_agents where AG_Id = '" . $ag_id . "'")->row();
	}
	public function check_agent_sales($ag_id)
	{
		return $this->db->query("select * from tbl_sale_products where AG_Id = '" . $ag_id . "' order by SP_Id DESC LIMIT 0,1")->row();
	}
	public function get_pi_code($cus_id)
	{
		return $this->db->query("select * from tbl_sale_products where CU_Id = '" . $cus_id . "' group by CU_Id")->row();
	}
	public function get_cut_type($cus_id)
	{
		return $this->db->query("select * from tbl_sale_products where CU_Id = '" . $cus_id . "' group by CU_Id")->row();
	}
}
