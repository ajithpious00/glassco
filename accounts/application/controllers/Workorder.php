<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Workorder extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->load->model('Transaction_model');
    }
	public function index()
	{
		if($this->authenticaton->is_logged_in())
		{
				$data['list'] = $this->Transaction_model->workOrderList();
				$data['pageName']="Work Order List";
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('workorder/workorder_list',$data);
				$this->load->view('templates/layout/footer');
	    }
		else
		{
				redirect('/accounts');
		}
	}
	
	public function invoice($orderNo)
	{
		if($this->authenticaton->is_logged_in())
		{
				$data['invoiceInfo'] = $this->Transaction_model->invoiceInfo($orderNo);
				$data['invoiceProductDetails'] = $this->Transaction_model->invoiceDetails($orderNo);
				$data['pageName']="Invoice";
				$this->load->view('templates/layout/header');
				$this->load->view('workorder/invoice',$data);
				$this->load->view('templates/layout/footer');
	    }
		else
		{
				redirect('/accounts');
		}
	}
}
?>