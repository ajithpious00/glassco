<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editbrand extends CI_Controller {
	 private $upload_path = "uploads/brand_logo";
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
        $this->load->view('admin/editbrand');		
	    $this->load->view('admin/template/layout/footer');
		$this->load->view('admin/editbrand_script');
	}
	public function display($Id){
		$result=$this->Glassco_model->selectbrand($Id);
		$data['id']=$Id;
		$data['name']=$result->Name;
		$data['logo']=$result->Logo;
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
        $this->load->view('admin/editbrand',$data);		
	    $this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/editbrand_script');
	}
	public function update()
	{
		$Id=$this->input->post('brand_id');
		if ( ! empty($_FILES)) {
			
			$filename = $_FILES['brandLogo']['name'];
			if($filename){
				$result = $this->Glassco_model->selectbrand($Id);
				@unlink($result->Logo);
				$config["upload_path"]   = $this->upload_path;
				$config["allowed_types"] = "gif|jpg|png";
				$this->load->library('upload', $config);
				//$this->upload->initialize($config);
				if ( ! $this->upload->do_upload("brandLogo")) {
					echo "failed to upload file(s)";
				}
				else {
					$imgSrc = $config["upload_path"] ."/". $filename;
					$dataset['Logo'] = $imgSrc;
				}	
			}
			
		}
		$dataset['Name']=$this->input->post('brandName');
		$this->Glassco_model->update_brand($Id,$dataset);
		echo json_encode(1);
	}
	
}
?>