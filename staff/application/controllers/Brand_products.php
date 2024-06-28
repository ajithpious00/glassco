<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_products extends CI_Controller {
	public function __construct() { 
        parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
        $this->load->model('staff/Sales_Enquiries_Model');
				
	}
	public function index(){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$data['pageTitle']  = 'Glassco | Sales Enquiries';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/sales_enquiries/sales_enquiries');
			$this->load->view('staff/common/footer');
			$this->load->view('staff/sales_enquiries/sales_enquiries_script');
		}
	}
	public function get_sale_enquiries(){
		$us_id=$this->session->userdata('US_Id');
		$draw = $this->input->post("draw");
		$rowstart = $this->input->post("start");
		$rowperpage = $this->input->post("length");
		$this->input->set_cookie('salesPageLength',$rowperpage);
		$columnIndex = $_POST['order'][0]['ceolumn']; // Column index;
		$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = htmlentities($_POST['search']['value'],ENT_QUOTES); // Search value
		$tablearr = array("draw"=>$draw,
						"rowstart"=>$rowstart,
						"rowperpage"=>$rowperpage,
						"columnIndex"=>$columnIndex,
						"columnSortOrder"=>$columnSortOrder,
						"columnName"=>$columnName,
						"searchValue"=>$searchValue);
		$response = $this->Sales_Enquiries_Model->get_sale_enquiries($tablearr,$us_id);
		echo json_encode($response);
	}
	public function detailview($cus_id){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$response = $this->Sales_Enquiries_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Sales_Enquiries_Model->customerview($cus_id);
			$data['pageTitle']  = 'Glassco | Sales Enquiries';
			$data['view_details'] = $response;
			//print_r($data['view_details']);exit();
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/sales_enquiries/sales_enquiry_detail_view',$data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/sales_enquiries/sales_enquiries_script');	
		}
	}
	public function add_sale($sale_id=""){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			if($sale_id){
				//$data['data'] = $this->Category_Model->thisCategory($id);
				//$data['images'] = $this->Category_Model->getImages($id);
				//$data['pageTitle']  = ' Glassco | Sales Enquiries';
				$this->load->view('staff/common/header');
				$this->load->view('staff/common/menu');
				$this->load->view('staff/sales_enquiries/sales_enquiry_add');
				$this->load->view('staff/common/footer');
				$this->load->view('staff/sales_enquiries/sales_add_script');
			}
			else{
				$data['pageTitle']  = ' Glassco | Sales Enquiries';
				$data['additionalitem'] = $this->Sales_Enquiries_Model->get_additionalitem();
				$data['customer_name'] = $this->Sales_Enquiries_Model->get_Customername();
				$data['product'] = $this->Sales_Enquiries_Model->get_Productname();
				$data['product_unit'] = $this->Sales_Enquiries_Model->get_product_unit();
				$data['product_type'] = $this->Sales_Enquiries_Model->get_product_type();
				$this->load->view('staff/common/header');
				$this->load->view('staff/common/menu');
				$this->load->view('staff/sales_enquiries/sales_enquiry_add',$data);
				$this->load->view('staff/common/footer');
				$this->load->view('staff/sales_enquiries/sales_enquiries_script');
				$this->load->view('staff/sales_enquiries/sales_add_script');
			}
		}
	}
	public function save(){
		//print_R($date);exit();
		$errors="";
		$this->form_validation->set_rules('cusname', 'Customer Name', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('adress', 'address', 'trim|required');
		//$this->form_validation->set_rules('productname', 'Prdouct Name', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			//echo('hi');exit();
			if($this->form_validation->error_string()!=""){
				$data['msg'] = $this->form_validation->error_string();
				$data['class'] = "error";
			}
		}
		else{
			if($this->input->post('row')==""){
				$data['CU_Name'] = $this->input->post('cusname');
				$data['CU_Phone'] = $this->input->post('phone');
				$data['CU_Address'] = $this->input->post('adress');
				$data['CU_Gst_No'] = $this->input->post('gst');
				$data['CU_Created_at'] = date("Y-m-d H:i:s");
				//$checkCustomer = $this->Sales_Enquiries_Model->checkCustomer($data);
				/*if ($checkCustomer->CU_Id !='') {
					//echo('hi');exit();
					$cus_id = $checkCustomer->CU_Id ;
					$data['class'] = "error";
					$data['msg'] = "Customer already exists.";
				} 
				else{*/
					$this->Sales_Enquiries_Model->insertcustomerdetails($data);
					$cus_id = $this->db->insert_id();
					$order_id = str_replace(" ","-",("WO")) . "-" .($cus_id);
					$us_id =$this->session->userdata('US_Id');
					$product= $this->input->post('productname');
					$height = $this->input->post('height');		
					$quantity = $this->input->post('quantity');
					$width = $this->input->post('width');
					$wastage = $this->input->post('wastage');
					$unit = $this->input->post('unit');
					$type = $this->input->post('type');
					$rate = $this->input->post('rate');
					$date_time = date("Y-m-d H:i:s");
					$pd_status = '1';
					$item =$this->input->post('item');
					$id = $this->input->post('ad_id');
					$quan = $this->input->post('quan');
					$unit_price = $this->input->post('unit_price');
					for($i=0;$i<count($height);$i++){
						$data= [
								'PD_Id'  =>  $product[$i],
								'PD_height' =>$height[$i],
								'PD_Width' =>$width[$i],
								'PD_Waste' =>$wastage[$i],
								'PD_Unit' =>$unit[$i],
								'ED_Id' =>$type[$i],
								'PD_Quantity' =>$quantity[$i],
								'PD_Price' =>$rate[$i],
								'CU_Id' =>$cus_id,
								'US_Id'  =>$us_id,
								'PD_Order_Date' =>$date_time,
								'PD_Order_No'  =>$order_id,
								'PD_Status'   => $pd_status
						];
					
						$this->Sales_Enquiries_Model->insertheight($data);
					}
					for($i=0 ;$i<count($item);$i++){
						$dat=[
							'AU_Id'	=> $id[$i],
							'AU_Item' => $item[$i],
							'AD_Quantity' => $quan[$i],
							'AD_Unit_Price' => $unit_price[$i],
							'CU_Id' =>$cus_id,
							'US_Id'  =>$us_id,
						];
						$this->Sales_Enquiries_Model->insert_additional_details($dat);
					}
					$data['class'] = "success";
					$data['msg'] = "Succesfully Added.";
				//}
			}
			echo json_encode($data);
		}
	}
	
	public function performa_invoice($cus_id){
		if(!$this->session->userdata('US_Id')) {
		
			header('location:'.base_url());
		}
		else{
			$response = $this->Sales_Enquiries_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Sales_Enquiries_Model->customerview($cus_id);
			$data['order_number'] = $this->Sales_Enquiries_Model->customerview($cus_id);
			$data['total_amount'] = $this->Sales_Enquiries_Model->totalamount($cus_id);
			$data['additional_details'] = $this->Sales_Enquiries_Model->additional_details($cus_id);
			$data['total_additional_charges'] = $this->Sales_Enquiries_Model->total_additional_charge($cus_id);
			$total_charges = $this->Sales_Enquiries_Model->totalamount($cus_id);
			$respon = $total_charges->grand_total;
			$total_additional = $this->Sales_Enquiries_Model->total_additional_charge($cus_id);
			$total_additionals = $total_additional->total_additional_charges;
			$data['grand_totals'] = $respon + $total_additionals;
			//print_r ($grand_totals);exit();
			$data['pageTitle']  = 'Glassco | Sales Enquiries';
			$data['view_details'] = $response;
			//print_r($data['view_details']);exit();
			$data['pageTitle']  = 'Glassco | Sales Enquiries Performa Invoice';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/sales_enquiries/performa_invoice',$data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/sales_enquiries/performa_invoice_script');
		}
	}
	public function edit($cus_id)
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			$data['additional_details'] = $this->Sales_Enquiries_Model->additional_details($cus_id);
			$data['customer_name'] = $this->Sales_Enquiries_Model->get_Customername();
			$data['customerdetail'] = $this->Sales_Enquiries_Model->customerview($cus_id);
			$data['view_details'] = $this->Sales_Enquiries_Model->detailview($cus_id);
			$data['product'] = $this->Sales_Enquiries_Model->get_Productname();
			$data['product_unit'] = $this->Sales_Enquiries_Model->get_Product_unit();
			$data['product_type'] = $this->Sales_Enquiries_Model->get_product_type();
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/sales_enquiries/sale_enquires_edit', $data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/sales_enquiries/sale_enquires_edit_script');
		}
	}
	public function edit1()
	{
		$data['CU_Name'] = $this->input->post('cusname');
		$data['CU_Phone'] = $this->input->post('phone');
		$data['CU_Address'] = $this->input->post('adress');
		$data['CU_Gst_No'] = $this->input->post('gst');
		$id = $this->input->post('id');

		$this->Sales_Enquiries_Model->updatecustomerdetails($data, $id);

		$pid = $this->input->post('pid');
		$product1 = $this->input->post('productname1');
		$height1 = $this->input->post('height1');
		$quantity1 = $this->input->post('quantity1');
		$type1 = $this->input->post('type1');
		$width1 = $this->input->post('width1');
		$unit1 = $this->input->post('unit1');
		$rate1 = $this->input->post('rate1');
		$us_id = $this->session->userdata('US_Id');
		$product = $this->input->post('productname');
		$height = $this->input->post('height');
		$quantity = $this->input->post('quantity');
		$wastage = $this->input->post('wastage');
		$wastage1= $this->input->post('wastage1');
		$type = $this->input->post('type');
		$width = $this->input->post('width');
		$unit = $this->input->post('unit');
		$rate = $this->input->post('rate');
		$date_time = date("Y-m-d H:i:s");
		$item =$this->input->post('item');
		$adid = $this->input->post('ad_id');
		$quan = $this->input->post('quan');
		$unit_price = $this->input->post('unit_price');
		$pd_status = '1';
		$order_id = str_replace(" ", "-", ("WO")) . "-" . ($id);
		// echo($height);
		// exit();
		for($i=0;$i<count($height);$i++){
			$dataid = $pid[$i];
			$data1 = [
				'PD_Id' => $product[$i],
				'PD_height' => $height[$i],
				'PD_Width' => $width[$i],
				'PD_Unit' => $unit[$i],
				'PD_Quantity' => $quantity[$i],
				'PD_Price' => $rate[$i],
				'PD_Waste' =>$wastage[$i],
				'ED_Id' => $type[$i],
				'CU_Id' => $id,
				'US_Id' => $us_id
			];
			$this->Sales_Enquiries_Model->updatesp($dataid, $data1);
		}
		if ($this->input->post('row')!=="") {
			for ($i = 0; $i < count($height1); $i++) {
				$data = [
					'PD_Id' => $product1[$i],
					'PD_height' => $height1[$i],
					'PD_Width' => $width1[$i],
					'PD_Unit' => $unit1[$i],
					'PD_Quantity' => $quantity1[$i],
					'PD_Price' => $rate1[$i],
					'CU_Id' => $id,
					'US_Id' => $us_id,
					'PD_Waste' =>$wastage1[$i],
					'PD_Order_Date' => $date_time,
					'PD_Order_No' => $order_id,
					'ED_Id' => $type1[$i],
					'PD_Status' => $pd_status
				];
				$this->Sales_Enquiries_Model->insertheight($data);
			}
		}
		for($i=0 ;$i<count($item);$i++){
			$ad_id=$adid[$i];
			$dat=[
				'AD_Quantity' => $quan[$i],
				'AD_Unit_Price' => $unit_price[$i],
			];
			$this->Sales_Enquiries_Model->update_additional_details($dat,$id,$ad_id);
		}
		$data['class'] = "success";
		echo json_encode($data);
	}
	public function updateRate()
	{
		$ids = $this->input->post('id');
		$rate = $this->input->post('rate');
		for ($i = 0; $i < count($rate); $i++) {
			$id = $ids[$i];
			$data = [
				'PD_Price' => $rate[$i]
			];
			$this->Sales_Enquiries_Model->updatesp($id, $data);
		}
		$data['class'] = "success";
		echo json_encode($data);
	}
	public function remove_sales(){
		$cus_id = $this->input->post('CID');
		$remove = $this->Sales_Enquiries_Model->remove_sales($cus_id);
		if($remove) {
			echo json_encode(array("status"=>1));
		}
		else {
			echo json_encode(array("status"=>0));
		}
	}
	public function save_proforma_invoice() {
		$invoiceData = $this->input->post('invoiceDoc');
		$cuid = $this->input->post('cuid');
		$wo = $this->input->post('wo');
		$saveInvoice = $this->Sales_Enquiries_Model->saveInvoice($invoiceData, $cuid, $wo);
		echo json_encode(1);
	}
	public function fetchcust($id){
		$result = $this->Sales_Enquiries_Model->fetchcust($id);
		foreach( $result as $rows){
			$data['class'] = "success";
			$data['name']=$rows->CU_Name;
			$data['phone']=$rows->CU_Phone;
			$data['address']=$rows->CU_Address;
			$data['gst']=$rows->CU_Gst_No;
			echo json_encode($data);
		}
	}
}
