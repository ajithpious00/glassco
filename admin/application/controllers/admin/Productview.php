<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productview extends CI_Controller {
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
        $this->load->view('admin/product_View');
		$this->load->view('admin/template/layout/footer');	
	}
	public function display($Id){
		$result=$this->Glassco_model->select_product($Id);
		$data['id']=$Id;
		$data['brandname']=$result->Brand_id;
		$data['code']=$result->Code;
		$data['name']=$result->Name;
		$data['categoryname']=$result->category_name;
		$data['subcategoryname']=$result->SB_Name;
		$data['stock']=$result->Available_Stock;
		$data['price']=$result->Unit_price;
		$data['mrp']=$result->MRP;
		$data['width']=$result->Width;
		$data['height']=$result->Height;
		$data['thickness']=$result->Thickness;
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$data['ctname']=$this->Glassco_model->select_categoryname();
		$data['sbname']=$this->Glassco_model->select_subcategorynames();
		$data['brname']=$this->Glassco_model->select_brandname();
        $this->load->view('admin/product_View',$data);
		$this->load->view('admin/template/layout/footer');	
		}
	
}
?>