<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand extends CI_Controller {
	 public function __construct(){
        parent::__construct();
		$this->load->model('Glassco_model');
		$this->load->library('upload');
		$this->load->helper(array('form', 'url')); 
		
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/brand',array('error' => ' ' ));
		$this->load->view('admin/template/layout/footer');
	}
	 public function do_upload() { 
         $config['upload_path']   = '/uploads/'; 
         $config['allowed_types'] = 'gif|jpg|png'; 
         $config['max_size']      = 100; 
         $config['max_width']     = 1024; 
         $config['max_height']    = 768; 
         $this->load->library('upload', $config);
		 $this->upload->initialize($config);
			
         if ( ! $this->upload->do_upload('brandLogo')) {
            $error = array('error' => $this->upload->display_errors()); 
            $this->load->view('admin/brand',$error);
         }
			
         else { 
            $data = array('upload_data' => $this->upload->data()); 
            $this->load->view('admin/brand',$data);
         } 
	}
	public function insert(){
		$dataset['Name']=$this->input->post('brandName');
		$dataset['Logo']=$this->input->post('brandLogo');
		$dataset['Status']=1;
		$this->Glassco_model->save_brand($dataset);
		
	}
}
?>