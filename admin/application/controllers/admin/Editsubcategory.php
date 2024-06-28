<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editsubcategory extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['ctname']=$this->Glassco_model->select_categoryname();
        $this->load->view('admin/editsubcategory',$data);		
	    $this->load->view('admin/template/layout/footer');
		$this->load->view('admin/editsubcategory_script');
	}
	public function display($Id){
		$result=$this->Glassco_model->select_subcategory($Id);
		$data['id']=$Id;
		$data['categoryname']=$result->Category_id;
		$data['name']=$result->SB_Name;
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['ctname']=$this->Glassco_model->select_categoryname();
        $this->load->view('admin/editsubcategory',$data);		
	    $this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/editsubcategory_script');
	}
	public function insert(){
		$Id=$this->input->post('subcategory_id');
		$dataset['Category_id']=$this->input->post('CategoryName');
		$dataset['SB_Name']=$this->input->post('subCategoryName');
		$this->Glassco_model->update_subcategory($Id,$dataset);
		echo json_encode(1);
	}
	
	
}
?>