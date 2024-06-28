<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	 public function __construct(){
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('Glassco_model');
    }
	public function index(){
		//$data['ctname']=$this->Glassco_model->select_categoryname();
		//$data['sbname']=$this->Glassco_model->select_subcategorynames();
		//$data['brname']=$this->Glassco_model->select_brandname();
		$data['pageTitle']  = ' Glassco | Sales Enquiries';
		$data['polish_type'] = $this->Glassco_model->get_polish_type();
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
        $this->load->view('admin/products',$data);
		$this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/product_script');
	}
	public function insert(){
		$dataset['Brand_id']=$this->input->post('brandName');
		$dataset['Code']=$this->input->post('productCode');
		$dataset['Name']=$this->input->post('productName');
		$dataset['Category_id']=$this->input->post('categoryName');
		$dataset['Sub_category_id']=$this->input->post('subcategoryName');
		$dataset['Available_Stock']=$this->input->post('stockAvailability');
		$dataset['Unit_price']=$this->input->post('productUnitPrice');
		$dataset['MRP']=$this->input->post('productMRP');
		$dataset['Width']=$this->input->post('productWidth');
		$dataset['Height']=$this->input->post('productHeight');
		$dataset['Thickness	']=$this->input->post('productThickness');
		$dataset['Status']=1;
		$this->Glassco_model->save_product($dataset);
		echo json_encode(1);
		
	}
	public function getSubCategory() {
		$cid = $this->input->post('cid');
		$subCatArr = $this->Glassco_model->select_subcategorynames($cid);
		echo json_encode($subCatArr);
	}
}
?>