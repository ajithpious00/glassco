<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Trialbalance extends CI_Controller {
	public function __construct()
	{
        parent::__construct();
        $this->load->model('transaction_model');
		$this->load->model('Accounthead_model');
    }
	public function index()
	{
		 if($this->authenticaton->is_logged_in())
		 { 
				$data['list'] = $this->transaction_model->trial_balance();
				$data['pageName']="Trial Balance as on " . date("d-M-Y");
				$this->load->view('templates/layout/header');
				$this->load->view('templates/layout/menu');
				$this->load->view('trialbalance/trialbalance',$data);
				$this->load->view('templates/layout/footer');
		 }
		 else
		 {
			redirect('/accounts');
		 }
	}
}
?>