<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/category');
		$this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/category_script');	
	}
	public function insert(){
		$dataset['Name']=$this->input->post('categoryName');
		$dataset['Status']=1;
		$this->Glassco_model->save_category($dataset);
		echo json_encode(1);
	}
	
	
}
?>