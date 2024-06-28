<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edge extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
		$this->load->view('admin/glassedge');
		$this->load->view('admin/template/layout/footer');
        $this->load->view('admin/glass_script');		
	}
	public function save_edge(){
	    $dataset['Edge_type']=$this->input->post('glassEdgeType');
		$dataset['Status']=1;
		$this->Glassco_model->save($dataset);
		echo json_encode(1);
	}
	
}
?>