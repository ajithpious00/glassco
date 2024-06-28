<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editglass extends CI_Controller {
	 public function __construct(){
        parent::__construct();
        $this->load->model('Glassco_model');
    }
	public function index(){
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
        $this->load->view('admin/editglass');		
	    $this->load->view('admin/template/layout/footer');
		$this->load->view('admin/editglass_script');
	}
	public function display($Id){
		$result=$this->Glassco_model->selectglass_edge($Id);
		$data['id']=$Id;
		$data['edgetype']=$result->Edge_type;
		$this->load->view('admin/template/layout/header');
		$this->load->view('admin/template/layout/menu');
        $this->load->view('admin/editglass',$data);		
	    $this->load->view('admin/template/layout/footer');	
		$this->load->view('admin/editglass_script');
	}
	public function insert(){
		$Id=$this->input->post('edge_id');
		$dataset['Edge_type']=$this->input->post('glassEdgeType');
		$this->Glassco_model->updateglass_edge($Id,$dataset);
		echo json_encode(1);
	}
	
	
}
?>