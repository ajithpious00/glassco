<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {
	 private $upload_path = "uploads/settings_logo";
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/settings');
		$this->load->view('admin/template/layout/footer');
		$this->load->view('admin/settings_script');
	}
	public function display(){
		$result=$this->Glassco_model->select_settings();
		$data['name']=$result->Name;
		$data['address']=$result->Address;
		$data['logo']=$result->Logo;
		$data['email']=$result->Email;
		$data['gst']=$result->GST;
		$data['igst']=$result->IGST;
		$data['cgst']=$result->CGST;
		$data['sgst']=$result->SGST;
		$data['ccharge']=$result->Cutting_charge;
		$data['hcharge']=$result->Hole_charge;
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/settings',$data);
		$this->load->view('admin/template/layout/footer');
		$this->load->view('admin/settings_script');
	}
	public function update(){
			if ( ! empty($_FILES)) {
			
			$filename = $_FILES['stnLogo']['name'];
			if($filename){
				$result = $this->Glassco_model->select_settings();
				@unlink($result->Logo);
			$config["upload_path"]   = $this->upload_path;
			$config["allowed_types"] = "gif|jpg|png";
			$this->load->library('upload', $config);
			//$this->upload->initialize($config);
			if ( ! $this->upload->do_upload("stnLogo")) {
				echo "failed to upload file(s)";
			}
			else {
				$imgSrc = $config["upload_path"] ."/". $filename;
				$dataset['Logo'] = $imgSrc;
			}	
			
			
		}
		$dataset['Name']=$this->input->post('stnName');
		$dataset['Address']=$this->input->post('stnAddress');
		$dataset['Email']=$this->input->post('stnemail');
		$dataset['GST']=$this->input->post('stnGST');
		$dataset['IGST']=$this->input->post('stnGST');
		$dataset['CGST']=$this->input->post('stnCGST');
		$dataset['SGST']=$this->input->post('stnSGST');
		$dataset['Cutting_charge']=$this->input->post('stnCuttingCharge');
		$dataset['Hole_charge']=$this->input->post('stnHoleCharge');
		$this->Glassco_model->save_settings($dataset);
		echo json_encode(1);
	}
	
}
}
?>