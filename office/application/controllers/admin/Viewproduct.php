<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewproduct extends CI_Controller {
	 public function __construct(){
        parent::__construct();
		$this->load->model('Glassco_model');
        
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/viewproduct');
		$this->load->view('admin/template/layout/footer');
		$this->load->view('admin/viewproduct_script');
	}
	public function listing() {
		$draw = $_POST['draw'];
		$row = $_POST['start'];
		$rowperpage = $_POST['length']; // Rows display per page
		$columnIndex = $_POST['order'][0]['column']; // Column index
		$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = $_POST['search']['value']; // Search value

		## Search 
		$searchQuery = " ";
		if($searchValue != ''){
		   $searchQuery = " and (prt.Name like '%".$searchValue."%' or prt.Code like '%".$searchValue."%')";
		}

		## Total number of records without filtering
		$sel = $this->Glassco_model->allcountproduct();
		$totalRecords = $sel->allcount;

		## Total number of record with filtering
		$sel = $this->Glassco_model->filterCountproduct($searchQuery);
		$totalRecordwithFilter = $sel->allcount;

		## Fetch records
		$listData = $this->Glassco_model->listAllDataproduct($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage);
		$data = array();

		foreach($listData as $row) {
			
			$data[] = array( 
			    "Code"=>$row->Code,
				"Name"=> ucwords($row->Name),
				"Category"=>$row->ct.Name,
				"Sub_Category"=>$row->sb.Name,
				"Available_Stock"=>$row->Available_Stock,
				"Unit_Price	"=>$row->Unit_price,
				"MRP"=>$row->MRP,
				"Width"=>$row->Width,
				"Height"=>$row->Height,
				"Brand"=>$row->brd.Name,
				"Thickness"=>$row->Thickness
			);
		}

		## Response
		$response = array(
		  "draw" => intval($draw),
		  "iTotalRecords" => $totalRecords,
		  "iTotalDisplayRecords" => $totalRecordwithFilter,
		  "aaData" => $data
		);

		echo json_encode($response);
	}
}
?>