<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editcategory extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
        $this->load->view('admin/editcategory',$data);		
	    $this->load->view('admin/template/layout/footer');
		$this->load->view('admin/editcategory_script');
	}
	public function display($Id){
		$result=$this->Glassco_model->selectcategory($Id);
		$data['id']=$Id;
		$data['name']=$result->Name;
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
        $this->load->view('admin/editcategory',$data);		
	    $this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/editcategory_script');
	}
	public function insert(){
		$Id=$this->input->post('category_id');
		$dataset['Name']=$this->input->post('categoryName');
		$this->Glassco_model->updatecategory($Id,$dataset);
		echo json_encode(1);
	}
	
	
}
?>