<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editproduct extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['ctname']=$this->Glassco_model->select_categoryname();
		$data['sbname']=$this->Glassco_model->select_subcategorynames();
		$data['brname']=$this->Glassco_model->select_brandname();
        $this->load->view('admin/product',$data);
		$this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/editproduct_script');
	}
	public function display($Id){
		$result=$this->Glassco_model->select_product($Id);
		$data['id']=$Id;
		$data['brandname']=$result->Brand_id;
		$data['code']=$result->Code;
		$data['name']=$result->Name;
		$data['categoryname']=$result->Category_id;
		$data['subcategoryname']=$result->Sub_category_id;
		$data['stock']=$result->Available_Stock;
		$data['price']=$result->Unit_price;
		$data['mrp']=$result->MRP;
		$data['width']=$result->Width;
		$data['height']=$result->Height;
		$data['thickness']=$result->Thickness;
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['ctname']=$this->Glassco_model->select_categoryname();
		$data['sbname']=$this->Glassco_model->select_subcategorynames($data['categoryname']);
		$data['brname']=$this->Glassco_model->select_brandname();
        $this->load->view('admin/editproduct',$data);
		$this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/editproduct_script');
	}
	public function insert(){
		$Id=$this->input->post('product_id');
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
		$this->Glassco_model->update_product($Id,$dataset);
		echo json_encode(1);
	}
	public function getSubCategory() {
		$cid = $this->input->post('cid');
		$subCatArr = $this->Glassco_model->select_subcategorynames($cid);
		echo json_encode($subCatArr);
	}
	
}
?>