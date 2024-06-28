<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewbrand extends CI_Controller {
	 public function __construct()
	{
        parent::__construct();
         $this->load->model('Glassco_model');
    }
	public function index()
	{
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/viewbrand');
		$this->load->view('admin/template/layout/footer');
		$this->load->view('admin/viewbrand_script');
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
		   $searchQuery = " and (Name like '%".$searchValue."%')";
		}

		## Total number of records without filtering
		$sel = $this->Glassco_model->allcountbrand();
		$totalRecords = $sel->allcount;

		## Total number of record with filtering
		$sel = $this->Glassco_model->filterCountbrand($searchQuery);
		$totalRecordwithFilter = $sel->allcount;

		## Fetch records
		$listData = $this->Glassco_model->listAllDatabrand($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage);
		$data = array();

		foreach($listData as $row) {
			 // Update Button
			$updateButton = '<a href="'.base_url("admin/Editbrand/display/$row->ID").'"><button class="btn btn-sm btn-info updateUser">Edit</button>';
			
			// Delete Button
			$deleteButton = '<a href="javascript:void(0)" onclick="delete_this('.$row->ID.')"><button class="btn btn-sm btn-danger deleteUser">Delete</button>';
			$logo = '<img src="'.base_url($row->Logo).'" width="80"/>';
			$action = $updateButton." ".$deleteButton;
			$data[] = array( 
				"Name"=> ucwords($row->Name),
				"Logo" => $logo,
				"action" => $action
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
	public function delete(){
		$Id = $this->input->post('Id');
		$getBrand = $this->Glassco_model->selectbrand($Id);
		if($getBrand) {
			$BrandImg = $getBrand->Logo;
			@unlink($BrandImg);
		}
		$this->Glassco_model->delete_brand($Id);
		echo json_encode("1");
	}
}
?>