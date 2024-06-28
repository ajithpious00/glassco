<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['ustype']=$this->Glassco_model->select_usertype();
        $this->load->view('admin/user',$data);		
	    $this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/user_script');
	}
	public function insert(){
		$dataset['US_Name']=$this->input->post('userName');
		$dataset['Email']=$this->input->post('userEmail');
		$dataset['Mobile']=$this->input->post('userMobile');
		$dataset['Password']=md5($this->input->post('userPassword'));
		$dataset['Usertype']=$this->input->post('usertype');
		$dataset['City']=$this->input->post('executiveSaleArea');
		$dataset['Perfoma_Code']=$this->input->post('perfomainvoice');
		$dataset['Invoice_Code']=$this->input->post('invoice');
		$dataset['Status']=1;
		$this->Glassco_model->add($dataset);
		echo json_encode(1);
	}
	
	
}
?>