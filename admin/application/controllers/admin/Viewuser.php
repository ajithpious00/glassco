<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewuser extends CI_Controller {
	
	public function __construct() {
		
        parent::__construct();
		$this->load->model('Glassco_model');
        
    }
	public function index() {
		
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/view_users');
		$this->load->view('admin/template/layout/footer');
		$this->load->view('admin/viewusers_script');
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
		   $searchQuery = " and (us.US_Name like '%".$searchValue."%' or us.Email like '%".$searchValue."%' or ut.Type like '%".$searchValue."%')";
		}

		## Total number of records without filtering
		$sel = $this->Glassco_model->allcount();
		$totalRecords = $sel->allcount;

		## Total number of record with filtering
		$sel = $this->Glassco_model->filterCount($searchQuery);
		$totalRecordwithFilter = $sel->allcount;

		## Fetch records
		$listData = $this->Glassco_model->listAllData($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage);
		//print_r($listData);exit();
		$data = array();

		foreach($listData as $row) {
		 // Update Button
		 $updateButton = '<a href="'.base_url("admin/Edituser/display/$row->US_Id").'"><button class="btn btn-sm btn-info updateUser">Edit</button>';
			
		 // Delete Button
		 $deleteButton = '<a href="javascript:void(0)" onclick="delete_this('.$row->US_Id.')"><button class="btn btn-sm btn-danger deleteUser">Delete</button>';
		 $action = $updateButton." ".$deleteButton;
			$data[] = array( 
				"US_Name"=> ucwords($row->US_Name),
				"Email"=>strtolower($row->Email),
				"Mobile"=>$row->Mobile,
				"Usertype"=>$row->Type,
				"City"=>($row->Utype == 5 ? ucwords($row->City) : 'Not Applicable'),
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
		$this->Glassco_model->delete_user($Id);
		echo json_encode("1");
		
	}
}
?>