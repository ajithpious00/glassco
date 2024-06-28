<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('staff/User_Model');
    }
	public function index(){
        $this->load->view('staff/common/header');
		$this->load->view('staff/common/menu');
		$this->load->view('staff/users/user');
		$this->load->view('staff/common/footer');
		$this->load->view('staff/users/user_script');
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
		$sel = $this->User_Model->allcount();
		$totalRecords = $sel->allcount;

		## Total number of record with filtering
		$sel = $this->User_Model->filterCount($searchQuery);
		$totalRecordwithFilter = $sel->allcount;

		## Fetch records
		$listData = $this->User_Model->listAllData($searchQuery,$columnName,$columnSortOrder,$row,$rowperpage);
		//print_r($listData);exit();
		$data = array();

		foreach($listData as $row) {
		 // Update Button
		 $updateButton = '<a href="'.base_url("user/edituser/$row->US_Id").'"><button class="btn btn-sm btn-info updateUser">Edit</button>';
			
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
    public function edituser($id){
        $result=$this->User_Model->selectuser($id);
		$data['id']=$id;
		$data['name']=$result->US_Name;
		$data['email']=$result->Email;
		$data['mobile']=$result->Mobile;
		$data['usertype']=$result->Usertype;
		$data['city']=$result->City;
		$data['ustype']=$this->User_Model->select_usertype();
        $this->load->view('staff/common/header');
		$this->load->view('staff/common/menu');
		$this->load->view('staff/users/edituser',$data);
		$this->load->view('staff/common/footer');
		$this->load->view('staff/users/edituser_script');
	}
    public function adduser(){
		$data['ustype']=$this->User_Model->select_usertype();
        $this->load->view('staff/common/header');
		$this->load->view('staff/common/menu');
		$this->load->view('staff/users/add_user',$data);
		$this->load->view('staff/common/footer');
		$this->load->view('staff/users/user_script');
	}
    public function edit(){
        $Id=$this->input->post('user_id');
		$data['US_Name']=$this->input->post('userName');
		$data['Email']=$this->input->post('userEmail');
		$data['Mobile']=$this->input->post('userMobile');
		$data['City']=$this->input->post('executiveSaleArea');
		$this->User_Model->update_user($Id,$data);
		echo json_encode(1);
    }
	public function insert(){
		$data['US_Name']=$this->input->post('userName');
		$data['Email']=$this->input->post('userEmail');
		$data['Mobile']=$this->input->post('userMobile');
		$data['Password']=md5($this->input->post('userPassword'));
		$data['Usertype']=$this->input->post('usertype');
		$data['City']=$this->input->post('executiveSaleArea');
		$data['Status']=1;
		$this->User_Model->add($data);
		echo json_encode(1);
	}
	public function delete(){
		$Id = $this->input->post('Id');
		$this->User_Model->delete_user($Id);
		echo json_encode("1");
	}
}
