<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {
	 private $upload_path = "uploads/brand_logo";
	 public function __construct(){
        parent::__construct();
		$this->load->model('Glassco_model');
	}
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/brand');
		$this->load->view('admin/template/layout/footer');
		$this->load->view('admin/brand_script');
	}
	public function insert(){
			if ( ! empty($_FILES)) {
			
			$filename = $_FILES['brandLogo']['name'];
			$config["upload_path"]   = $this->upload_path;
			$config["allowed_types"] = "gif|jpg|png";
			$this->load->library('upload', $config);
			//$this->upload->initialize($config);
			if ( ! $this->upload->do_upload("brandLogo")) {
				echo "failed to upload file(s)";
			}
			else {
				$imgSrc = $config["upload_path"] ."/". $filename;
				
			}	
			
			
		}
		$dataset['Name']=$this->input->post('brandName');
		$dataset['Logo']=$imgSrc;
		$dataset['Status']=1;
		$this->Glassco_model->save_brand($dataset);
		echo json_encode(1);
	}
}
?>