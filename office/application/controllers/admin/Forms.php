<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forms extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['h']=$this->Glassco_model->select_usertype();
        $this->load->view('admin/forms',$data);		
	    $this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/forms_script');
	}
	public function insert(){
		$dataset['Name']=$this->input->post('userName');
		$dataset['Email']=$this->input->post('userEmail');
		$dataset['Mobile']=$this->input->post('userMobile');
		$dataset['Password']=md5($this->input->post('userPassword'));
		$dataset['Usertype']=$this->input->post('usertype');
		$dataset['City']=$this->input->post('executiveSaleArea');
		$dataset['Status']=1;
		$this->Glassco_model->add($dataset);
		$this->load->view('admin/view_users');
	}
	
	
}
?>