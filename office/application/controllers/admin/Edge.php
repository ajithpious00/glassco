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
	}
	public function save_edge(){
	    $dataset['Edge_type']=$this->input->post('glassEdgeType');
		$this->Glassco_model->save($dataset);
		
	}
	
}
?>