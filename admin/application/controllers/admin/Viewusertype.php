<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewusertype extends CI_Controller {
	 public function __construct()
	{
        parent::__construct();
         $this->load->model('Glassco_model');
    }
	public function index()
	{
		$data['h']=$this->Glassco_model->select_usertype(); 
	    $this->load->view('admin/view_usertype',$data);
	}
}
?>