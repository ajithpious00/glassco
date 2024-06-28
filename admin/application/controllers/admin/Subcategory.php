<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory extends CI_Controller {
	 public function __construct()
	{
        parent::__construct();
        $this->load->model('Glassco_model'); 
    }
	public function index()
	{
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['ctname']=$this->Glassco_model->select_categoryname();
		$this->load->view('admin/subcategory',$data);
		$this->load->view('admin/template/layout/footer');
		$this->load->view('admin/subcategory_script');	
	}
	public function insert(){
		$dataset['Category_id']=$this->input->post('categoryName');
		$dataset['SB_Name']=$this->input->post('subCategoryName');
		$dataset['Status']=1;
		$this->Glassco_model->save_subcategory($dataset);
		echo json_encode(1);
	}
}
?>