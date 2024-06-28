<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edituser extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['ustype']=$this->Glassco_model->select_usertype();
        $this->load->view('admin/edituser',$data);		
	    $this->load->view('admin/template/layout/footer');
		$this->load->view('admin/edituser_script');
	}
	public function display($Id){
		$result=$this->Glassco_model->selectuser($Id);
		$data['id']=$Id;
		$data['name']=$result->US_Name;
		$data['email']=$result->Email;
		$data['mobile']=$result->Mobile;
		$data['usertype']=$result->Usertype;
		$data['city']=$result->City;
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['ustype']=$this->Glassco_model->select_usertype();
        $this->load->view('admin/edituser',$data);		
	    $this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/edituser_script');
	}
	public function insert(){
		$Id=$this->input->post('user_id');
		$dataset['US_Name']=$this->input->post('userName');
		$dataset['Email']=$this->input->post('userEmail');
		$dataset['Mobile']=$this->input->post('userMobile');
		$dataset['City']=$this->input->post('executiveSaleArea');
		$this->Glassco_model->update_user($Id,$dataset);
		echo json_encode(1);
	}
	
	
}
?>