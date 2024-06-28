<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/settings');
		$this->load->view('admin/template/layout/footer');	
	}
	public function save_settings(){
	    $dataset['Name']=$this->input->post('stnName');
		$dataset['Address']=$this->input->post('stnAddress');
		$dataset['Logo']=$this->input->post('stnLogo');
		$dataset['Email']=$this->input->post('stnemail');
		$dataset['Site_address']=$this->input->post('stnsiteAddress');
		$dataset['GST']=$this->input->post('stnGST');
		$dataset['IGST']=$this->input->post('stnGST');
		$dataset['CGST']=$this->input->post('stnCGST');
		$dataset['SGST']=$this->input->post('stnSGST');
		$this->Glassco_model->save_settings($dataset);
		
	}
	
}
?>