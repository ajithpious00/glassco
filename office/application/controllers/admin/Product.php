<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['h']=$this->Glassco_model->select_categoryname();
		$data['p']=$this->Glassco_model->select_subcategoryname();
		$data['m']=$this->Glassco_model->select_brandname();
        $this->load->view('admin/product',$data);
		$this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/product_script');
	}
	public function insert(){
		$dataset['Code']=$this->input->post('productCode');
		$dataset['Name']=$this->input->post('productName');
		$dataset['Category_id']=$this->input->post('categoryName');
		$dataset['Sub_category_id']=$this->input->post('subcategoryName');
		$dataset['Available_Stock']=$this->input->post('stockAvailability');
		$dataset['Unit_price']=$this->input->post('productUnitPrice');
		$dataset['MRP']=$this->input->post('productMRP');
		$dataset['Width']=$this->input->post('productWidth');
		$dataset['Height']=$this->input->post('productHeight');
		$dataset['Brand_id']=$this->input->post('brandName');
		$dataset['Thickness	']=$this->input->post('productThickness');
		$dataset['Status']=1;
		$this->Glassco_model->save_product($dataset);
		
	}
	
}
?>