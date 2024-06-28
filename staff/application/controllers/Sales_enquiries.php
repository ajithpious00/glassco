<?php
error_reporting(0);
defined('BASEPATH') or exit('No direct script access allowed');

class Sales_enquiries extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('staff/Sales_Enquiries_Model');
	}
	public function index()
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			//print_r($this->session->userdata('US_Id'));exit();
			$data['pageTitle']  = 'Glassco | Sales Enquiries';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/sales_enquiries/sales_enquiries');
			$this->load->view('staff/common/footer');
			$this->load->view('staff/sales_enquiries/sales_enquiries_script');
		}
	}
	public function get_sale_enquiries()
	{
		$us_id = $this->session->userdata('US_Id');
		$draw = $this->input->post("draw");
		$rowstart = $this->input->post("start");
		$rowperpage = $this->input->post("length");
		$this->input->set_cookie('salesPageLength', $rowperpage);
		$columnIndex = $_POST['order'][0]['ceolumn']; // Column index;
		$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
		$searchValue = htmlentities($_POST['search']['value'], ENT_QUOTES); // Search value
		$tablearr = array(
			"draw" => $draw,
			"rowstart" => $rowstart,
			"rowperpage" => $rowperpage,
			"columnIndex" => $columnIndex,
			"columnSortOrder" => $columnSortOrder,
			"columnName" => $columnName,
			"searchValue" => $searchValue
		);
		$response = $this->Sales_Enquiries_Model->get_sale_enquiries($tablearr, $us_id);
		echo json_encode($response);
	}
	public function detailview($cus_id)
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			$response = $this->Sales_Enquiries_Model->detailview($cus_id);
			$data['customerdetail'] = $this->Sales_Enquiries_Model->customerview($cus_id);
			$data['pageTitle']  = 'Glassco | Sales Enquiries';
			$data['view_details'] = $response;
			//print_r($data['view_details']);exit();
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/sales_enquiries/sales_enquiry_detail_view', $data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/sales_enquiries/sales_enquiries_script');
		}
	}
	public function add_sale($sale_id = "")
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			if ($sale_id) {
				//$data['data'] = $this->Category_Model->thisCategory($id);
				//$data['images'] = $this->Category_Model->getImages($id);
				//$data['pageTitle']  = ' Glassco | Sales Enquiries';
				$this->load->view('staff/common/header');
				$this->load->view('staff/common/menu');
				$this->load->view('staff/sales_enquiries/sales_enquiry_add');
				$this->load->view('staff/common/footer');
				$this->load->view('staff/sales_enquiries/sales_add_script');
			} else {
				$data['pageTitle']  = ' Glassco | Sales Enquiries';
				$data['additionalitem'] = $this->Sales_Enquiries_Model->get_additionalitem();
				$data['additional'] = $this->Sales_Enquiries_Model->get_additional();
				$data['customer_name'] = $this->Sales_Enquiries_Model->get_Customername();
				$data['product'] = $this->Sales_Enquiries_Model->get_Productname();
				$data['product_unit'] = $this->Sales_Enquiries_Model->get_product_unit();
				$data['product_type'] = $this->Sales_Enquiries_Model->get_product_type();
				$data['polish_type'] = $this->Sales_Enquiries_Model->get_polish_type();
				$data['agent'] = $this->Sales_Enquiries_Model->get_agent();
				$this->load->view('staff/common/header');
				$this->load->view('staff/common/menu');
				$this->load->view('staff/sales_enquiries/sales_enquiry_add', $data);
				$this->load->view('staff/common/footer');
				$this->load->view('staff/sales_enquiries/sales_enquiries_script');
				$this->load->view('staff/sales_enquiries/sales_add_script');
			}
		}
	}
	public function save()
	{
		//print_R($date);exit();
		$errors = "";
		$this->form_validation->set_rules('cusname', 'Customer Name', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('adress', 'address', 'trim|required');
		//$this->form_validation->set_rules('productname', 'Prdouct Name', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			//echo "kerii";
			//echo('hi');exit();
			if ($this->form_validation->error_string() != "") {
				$data['msg'] = $this->form_validation->error_string();
				$data['class'] = "error";
			}
		} else {
			//echo "keriilaaaaa";
			$addtionalCount = $this->Sales_Enquiries_Model->getAddNos();
			$addCnt = $addtionalCount->addCnt;
			if ($this->input->post('row') == "") {
				$data['CU_Name'] = $this->input->post('cusname');
				$data['CU_Phone'] = $this->input->post('phone');
				$data['CU_Address'] = $this->input->post('adress');
				$data['CU_Gst_No'] = $this->input->post('gst');
				$data['CU_District'] = $this->input->post('district');
				$data['CU_Created_at'] = date("Y-m-d H:i:s");
				$data['CU_Delivered_at'] = date("Y-m-d", strtotime($this->input->post('deliverydate')));
				//print_r($data['CU_Delivered_at']);exit();
				$data['CU_Delivery_Address'] = $this->input->post('deliveryadress');
				$ag_id = $this->input->post('agent');
				$data['AG_Id'] = $ag_id;
				$check_agent = $this->Sales_Enquiries_Model->check_agent($ag_id);
				$check_age = $check_agent->AG_PI_Code;
				//print_r($check_age);exit();
				$agent_check_sales  = $this->Sales_Enquiries_Model->check_agent_sales($ag_id);
				$agent_check_sales_agent_no = $agent_check_sales->AG_PI_Code_No;
				//print_r($agent_check_sales_agent);exit();
				if ($agent_check_sales_agent_no > 0) {
					//echo('hi');exit();
					$agent_check_sales_agent_no = $agent_check_sales_agent_no + 1;
					$samp = $check_age . $agent_check_sales_agent_no;
					$data['AG_PI'] = $samp;
					$data['AG_PI_Code'] = $check_age;
					$data['AG_PI_Code_No'] = $agent_check_sales_agent_no;
				} else {
					//echo('hlo');exit();
					$data['AG_PI'] = $check_age . 1;
					$data['AG_PI_Code'] = $check_age;
					$data['AG_PI_Code_No'] = 1;
				}
				//$checkCustomer = $this->Sales_Enquiries_Model->checkCustomer($data);
				/*if ($checkCustomer->CU_Id !='') {
					//echo('hi');exit();
					$cus_id = $checkCustomer->CU_Id ;
					$data['class'] = "error";
					$data['msg'] = "Customer already exists.";
				} 
				else{*/
				$agent_pi_code = $data['AG_PI_Code'];
				$agent_pi_code_no = $data['AG_PI_Code_No'];
				$this->Sales_Enquiries_Model->insertcustomerdetails($data);
				$cus_id = $this->db->insert_id();
				$data['CU_Id '] = $cus_id;
				$this->Sales_Enquiries_Model->invcustomerdetails($data);
				$order_id = str_replace(" ", "-", ("WO")) . "-" . ($cus_id);
				$us_id = $this->session->userdata('US_Id');
				$product = $this->input->post('productname');
				$hsn = $this->input->post('hsn');
				$height = $this->input->post('height');
				$width = $this->input->post('width');
				$quantity = $this->input->post('quantity');
				$heightnl = $this->input->post('heightnl');
				$widthnl = $this->input->post('widthnl');
				$wastage = $this->input->post('wastage');
				$unit = $this->input->post('unit');
				$type = $this->input->post('type');
				$rate = $this->input->post('rate');
				$po_rate = $this->input->post('polishrate');
				//print_r($rate);exit();
				$po_id = $this->input->post('potype');
				//print_r($this->input->post('potype'));exit();
				//$ag_id = $this->input->post('agent');
				$cutting_type = $this->input->post('cutting_type');
				$date_time = date("Y-m-d H:i:s");
				$item = $this->input->post('item');
				$id = $this->input->post('ad_id');
				$quan = $this->input->post('quan');
				$unit_price = $this->input->post('unit_price');
				$id2 = $this->input->post('ad_id2');
				$item2 = $this->input->post('item2');
				$add_id2 = $this->input->post('ad_id2');
				$pd_status = '1';
				$quan2 = $this->input->post('quan2');
				$unit_price2 = $this->input->post('unit_price2');
				/*$po['PA_Rate'] = $this->input->post('polishrate');
					$po['PO_Id'] = $this->input->post('potype');
					$po['PA_Hsn'] = $this->input->post('hsnc');
					$po['US_Id'] = $us_id;
					$po['PA_Status'] = 1;
					$po['PA_Type'] = 1;
					$po['CU_Id'] = $cus_id;
					$this->Sales_Enquiries_Model->insertpolishdetails($po);*/
				//print_r(count($height));exit();
				$sp_id = null;
				$j = 0;
				$p = 0;
				$q = 0;
				for ($i = 0; $i < count($product); $i++) {
					$data = [
						'PD_Id'  =>  $product[$i],
						'SL_Hsn'  =>  $hsn[$i],
						'PD_height' => $height[$i],
						'PD_Width' => $width[$i],
						'PD_Cus_Height' => $height[$i],
						'PD_Cus_Width' => $width[$i],
						'PD_Height_Nl' => $heightnl[$i],
						'PD_Weight_Nl' => $widthnl[$i],
						'PD_Waste' => $wastage[$i],
						'PD_Unit' => $unit[$i],
						'ED_Id' => $type[$i],
						'PD_Quantity' => $quantity[$i],
						'PD_Price' => $rate[$i],
						'PI_Rate' => $po_rate[$i],
						'PO_Id' => $po_id[$i],
						'AG_Id' => $ag_id,
						'AG_PI_Code' => $agent_pi_code,
						'AG_PI_Code_No' => $agent_pi_code_no,
						'CU_Id' => $cus_id,
						'US_Id'  => $us_id,
						'SP_Type'  => $cutting_type,
						'PD_Order_Date' => $date_time,
						'PD_Order_No'  => $order_id,
						'PD_Status'=>$pd_status
					];
					$this->Sales_Enquiries_Model->insertheight($data);
					$sp_id = $this->db->insert_id();
					/*for($i=0;$i<count($product);$i++){
						$dat=[
								'AU_Id'	=> $id[$i],
								'AU_Item' => $item[$i],
								'AD_Quantity' => $quan[$i],
								'AD_Unit_Price' => $unit_price[$i],
								'CU_Id' =>$cus_id,
								'US_Id'  =>$us_id,
								'SP_Id'  =>$sp_id,
							];
							$this->Sales_Enquiries_Model->insert_additional_details($dat);*/
					$checkArr = array();
					$slcount = 1;
					$divident = (count($item) / count($product)) + 1;

					/*for($p=0;$p<count($item);$p++) {
							echo $item[$p]."/Qnty:".$quan[$p]."/Price:".$unit_price[$p];
						}
						exit();*/
					//for($j=$j ;$j<count($quan);$j++){

					for ($p; $p < count($item); $p++) {
						//echo $item[$p] . " -- " . $unit_price[$p]." --- " . $p . "</br/>";
						$dat = [
							'AU_Id'	=> $id[$p],
							'AU_Item' => $item[$p],
							'AD_Quantity' => $quan[$p],
							'AD_Unit_Price' => $unit_price[$p],
							'CU_Id' => $cus_id,
							'US_Id'  => $us_id,
							'SP_Id'  => $sp_id,
						];
						/*$combId = $sp_id . "/" . $id[$j];
							if(in_array($combId, $checkArr)) {
								//Skip
							}
							else {
								array_push($checkArr, $combId);
								//print_r($dat);
								
								//$cus_id = $this->db->insert_id();
							}*/
						$this->Sales_Enquiries_Model->insert_additional_details($dat);
						$slcount++;
						if ($slcount > $addCnt) {
							$p = $p + 1;
							break;
						}
					}
				}
				for ($q; $q < count($item2); $q++) {
					//echo $item[$p] . " -- " . $unit_price[$p]." --- " . $p . "</br/>";
					$da = [
						'AU_Id'	=> $id2[$q],
						'AU_Item' => $item2[$q],
						'AD_Quantity' => $quan2[$q],
						'AD_Unit_Price' => $unit_price2[$q],
						'AF_Status' => 1,
						'CU_Id' => $cus_id,
						'US_Id'  => $us_id,
					];
					$this->Sales_Enquiries_Model->insert_additional_detail($da);
					//exit();
					$data['class'] = "success";
					$data['msg'] = "Succesfully Added.";
				}
			}
			echo json_encode($data);
		}
	}
	public function addMethod($spid)
	{
		echo "Number: " . $spid . ", Processed Number: " . $spid . "\n";
	}
	public function performa_invoice($cus_id)
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			$response = $this->Sales_Enquiries_Model->detailview($cus_id);
			$get_cut_type = $this->Sales_Enquiries_Model->get_cut_type($cus_id);
			$cut_type = $get_cut_type->SP_Type;
			//print_r($cut_type);exit();
			if ($cut_type == 1) {
				$data['cut_type'] = 'Normal';
			} else {
				$data['cut_type'] = 'Special';
			}
			if ($response) {
				$prodArr  = array();
				$prodList = array();
				$prodAdds = array();
				$i = 0;
				//print_r($response);exit();
				$data['total_additional_charges'] = 0;
				foreach ($response  as $rs) {
					$prodList['Edge_type'] = $rs->Edge_type;
					$prodList['HSN_code'] = $rs->PD_Hsn_Code;
					$prodList['UN_Name'] = $rs->UN_Name;
					$prodList['UN_Id'] = $rs->UN_Id;
					$prodList['ED_Id'] = $rs->ED_Id;
					$prodList['PD_Name'] = $rs->PD_Name;
					$prodList['PD_Height_Nl'] = $rs->PD_Height_Nl;
					$prodList['PD_Weight_Nl'] = $rs->PD_Weight_Nl;
					$prodList['PD_Cus_Height'] = $rs->PD_Cus_Height;
					$prodList['PD_Cus_Width'] = $rs->PD_Cus_Width;
					$prodList['PD_waste'] = $rs->PD_Waste;
					$prodList['PD_Quantity'] = $rs->PD_Quantity;
					$prodList['PD_Status'] = $rs->PD_Status;
					$prodList['sqf'] = $rs->sqf;
					$prodList['sqm'] = $rs->sqm;
					$prodList['rate'] = $rs->PD_Price;
					$prodList['PR_Weight'] = $rs->PR_Weight;
					//$prodList['Product_weight'] = $rs->Product_weight;
					$prodList['product_quantity_sqm'] = $rs->product_quantity_sqm;
					$prodList['total_rate'] = $prodList['product_quantity_sqm'] * $prodList['rate'];
					$prodList['PO_Name'] = $rs->PO_Name;
					$prodList['PO_Hsn_Code'] = $rs->PO_Hsn_Code;
					$prodList['PO_Rate'] = $rs->PI_Rate;
					$prodList['total__polish_rate'] = $prodList['product_quantity_sqm'] * $prodList['PO_Rate'];
					$add_response = $this->Sales_Enquiries_Model->additional_details($rs->SP_Id);
					//echo count($add_response);
					if ($add_response) {
						$j = 0;
						$prodAdds = array();
						foreach ($add_response as $ad) {
							if ($ad->AU_Type == 1 || $ad->AU_Type == 3) {

								$prodAdds[$j]['AU_Item'] = $ad->AU_Item;
								$prodAdds[$j]['AU_Item_Short'] = $ad->AU_Item_Short;
								$prodAdds[$j]['AD_Quantity'] = $ad->AD_Quantity;
								$prodAdds[$j]['AD_Unit_Price'] = $ad->AD_Unit_Price;
								$prodAdds[$j]['AD_Total_Amount'] = $ad->AD_Total_Amount;
								$prodAdds[$j]['listing_price'] = $ad->listing_price;
								$prodList['product_adds'] = $prodAdds;
							} elseif ($ad->AU_Type == 2) {
								$prodAdds[$j]['AU_Item'] = $ad->AU_Item;
								$prodAdds[$j]['AU_Item_Short'] = $ad->AU_Item_Short;
								$prodAdds[$j]['AD_Quantity'] = $prodList['product_quantity_sqm'];
								$prodAdds[$j]['AD_Unit_Price'] = $ad->AD_Unit_Price;
								$prodAdds[$j]['AD_Total_Amount'] = $ad->AD_Total_Amount;
								$prodAdds[$j]['listing_pric'] = $ad->listing_price;
								$prodAdds[$j]['listing_price'] =  round($prodAdds[$j]['listing_pric'] * $prodList['product_quantity_sqm'], 2);
								$prodList['product_adds'] = $prodAdds;
							}

							$data['total_additional_charges'] = $data['total_additional_charges'] + $prodAdds[$j]['listing_price'];

							$j++;
							//$data['total_additional_charges'] = $data['total_additional_charges'] + $prodAdds[$j]['listing_price'];
						}
					}

					$total_addition  = $this->Sales_Enquiries_Model->total_additional_charge($rs->SP_Id);
					$total_additional_charg = $total_addition->total_listing_price;
					//print_r($total_additional_charg);exit();
					$prodArr[$i] = $prodList;
					$i++;
					//echo $prodAdds[$j]['listing_price'];

				}
			}
			$pi_code = $this->Sales_Enquiries_Model->get_pi_code($cus_id);
			$agent_pi_code = $pi_code->AG_PI_Code;
			$agent_pi_code_no = $pi_code->AG_PI_Code_No;
			$generate_pi = $agent_pi_code . $agent_pi_code_no;
			//print_r($generate_pi);exit();
			$data['pi_code'] = $generate_pi;
			$add_deta = $this->Sales_Enquiries_Model->total_additional_char($cus_id);
			//print_r($add_deta->total_amount);exit();
			$data['add_deta'] = $add_deta->total_amount;
			//$data['total_additional_charges'] = $data['total_additional_charg'] + $add_deta->
			//$data['total_additional_charges'] = $total_additional_charg;
			//print_r($data['total_additional_charges']);exit();
			$data['total_weight_product'] = $total_additional_charg;
			$data['prodArr'] = $prodArr;
			$data['add_dh'] = $this->Sales_Enquiries_Model->total_additional_dh($cus_id);
			$data['add_ch'] = $this->Sales_Enquiries_Model->total_additional_ch($cus_id);
			$data['add_th'] = $this->Sales_Enquiries_Model->total_additional_th($cus_id);
			$data['add_hh'] = $this->Sales_Enquiries_Model->total_additional_hh($cus_id);

			$data['customerdetail'] = $this->Sales_Enquiries_Model->customerview($cus_id);
			$data['agentdetail'] = $this->Sales_Enquiries_Model->agent_detail($cus_id);
			$agentbankdet = $data['agentdetail']->AG_Id;
			//print_r($data['agentdeta']);exit();
			$data['agentbankdetail'] = $this->Sales_Enquiries_Model->agent_bank_detail($agentbankdet);
			$data['order_number'] = $this->Sales_Enquiries_Model->customerview($cus_id);
			$data['total_amount'] = $this->Sales_Enquiries_Model->totalamount($cus_id);
			$data['additional_details'] = $this->Sales_Enquiries_Model->additional_details($cus_id);
			//$addit = $this->Sales_Enquiries_Model->additional_details($cus_id);
			//$data['SP_Id'] =$addit->SP_Id;
			//print_r($data['SP_Id']);exit();
			//$data['total_additional_charges'] = $this->Sales_Enquiries_Model->total_additional_charge($cus_id);
			$total_additional  = $this->Sales_Enquiries_Model->total_additional_charge($cus_id);
			$total_addition  = $this->Sales_Enquiries_Model->total_additional_charge($response->SP_id);
			$data['total_additional_charge'] = $total_addition->total_listing_price;
			//print_r($data['total_additional_charge']);exit();
			//$data['total_additional_charges'] = round($data['total_additional_charge'],2);
			$total_charges = $this->Sales_Enquiries_Model->totalamount($cus_id);
			$respon = $total_charges->grand_total;
			$total_additional = $this->Sales_Enquiries_Model->total_additional_charge($cus_id);
			$total_additionals = $total_additional->total_additional_charges;
			$data['grand_totals'] = $respon + $total_additionals;
			//$taxable = $this->Sales_Enquiries_Model->taxable_amount($cus_id);
			//$taxableamount = $taxable->total_price;
			$total_sqs = $this->Sales_Enquiries_Model->total_sqs($cus_id);
			$data['price'] = $total_sqs->PD_Price;
			$data['net_price'] = $total_sqs->total_price;
			$data['net_price'] = round($data['net_price'], 2);
			$data['total_sqmtr'] = $total_sqs->sum_total_sqmtr;
			$data['polish_rate'] = $this->Sales_Enquiries_Model->get_polish_rate($cus_id);
			$polish_rate = $this->Sales_Enquiries_Model->get_polish_rate($cus_id);
			$data['net_polish_rate'] = $polish_rate->PA_Rate * ($data['total_sqmtr']);
			//print_r ($polish_rate ->PA_Rate);exit();
			$polish_rate = $this->Sales_Enquiries_Model->get_polish_rate($cus_id);
			$data['polish_rate'] = $polish_rate->PA_Rate;
			//$data['taxable_amounts'] = $data['net_polish_rate'] + $data['net_price'];
			$data['tax'] = $data['total_additional_charges'] + $data['taxable_amounts'];
			//print_r($data['tax']);exit();
			$data['cgst'] = $data['tax']  * (9 / 100);
			$data['cgst'] = round($data['cgst'], 2);
			$data['sgst'] = $data['tax'] * (9 / 100);
			$data['sgst'] = round($data['sgst'], 2);
			//print_r($data['polish_rate']);exit();
			$data['polish_name'] = $polish_rate->PO_Name;
			$data['polish_hsn'] = $polish_rate->PA_Hsn;
			$data['total_tax'] = $data['cgst'] + $data['sgst'];
			$data['grand_total'] = $data['total_tax'] +  $data['tax'];
			$data['grand_total'] = round($data['grand_total'], 2);
			$vd = $this->Sales_Enquiries_Model->get_pd_status($cus_id);
			$data['vd'] = $vd->PD_Status;
			//print_r($data['vd']);exit();
			$data['pageTitle']  = 'Glassco | Sales Enquiries';
			$data['view_details'] = $response;
			$data['pageTitle']  = 'Glassco | Sales Enquiries Performa Invoice';
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/sales_enquiries/performa_invoice', $data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/sales_enquiries/performa_invoice_script');
		}
	}
	public function edit_sales($cus_id)
	{
		if (!$this->session->userdata('US_Id')) {

			header('location:' . base_url());
		} else {
			$data['additional_details'] = $this->Sales_Enquiries_Model->additional_details($cus_id);
			$data['customerdetail'] = $this->Sales_Enquiries_Model->customerview($cus_id);
			$data['additional_add'] = $this->Sales_Enquiries_Model->additional_add($cus_id);
			$data['additional'] = $this->Sales_Enquiries_Model->get_additional();
			$data['additionalitem'] = $this->Sales_Enquiries_Model->get_additionalitem();
			$data['product'] = $this->Sales_Enquiries_Model->get_Productname();
			$data['product_unit'] = $this->Sales_Enquiries_Model->get_product_unit();
			$data['product_type'] = $this->Sales_Enquiries_Model->get_product_type();
			$data['polish_type'] = $this->Sales_Enquiries_Model->get_polish_type();
			$data['agent'] = $this->Sales_Enquiries_Model->get_agent();
			$this->load->view('staff/common/header');
			$this->load->view('staff/common/menu');
			$this->load->view('staff/sales_enquiries/sale_enquires_edit', $data);
			$this->load->view('staff/common/footer');
			$this->load->view('staff/sales_enquiries/sales_enquiries_script');
			$this->load->view('staff/sales_enquiries/sale_enquires_edit_script');
		}
	}
	public function edit()
	{
		$errors = "";
		$this->form_validation->set_rules('cusname', 'Customer Name', 'trim|required');
		$this->form_validation->set_rules('cuid', 'cuid', 'trim|required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
		$this->form_validation->set_rules('adress', 'address', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			if ($this->form_validation->error_string() != "") {
				$data['msg'] = $this->form_validation->error_string();
				$data['class'] = "error";
			}
		} else {
			$addtionalCount = $this->Sales_Enquiries_Model->getAddNos();
			$addCnt = $addtionalCount->addCnt;
			if ($this->input->post('row') == "") {
				$cus_id = $this->input->post('cuid');
				$status = $this->input->post('status');
				$data['CU_Name'] = $this->input->post('cusname');
				$data['CU_Phone'] = $this->input->post('phone');
				$data['CU_Address'] = $this->input->post('adress');
				$data['CU_Gst_No'] = $this->input->post('gst');
				$data['CU_District'] = $this->input->post('district');
				$data['CU_Created_at'] = date("Y-m-d H:i:s");
				$data['CU_Delivered_at'] = date("Y-m-d", strtotime($this->input->post('deliverydate')));
				$data['CU_Delivery_Address'] = $this->input->post('deliveryadress');
				$ag_id = $this->input->post('agent');
				$data['AG_Id'] = $ag_id;
				$check_agent = $this->Sales_Enquiries_Model->check_agent($ag_id);
				$check_age = $check_agent->AG_PI_Code;
				$agent_check_sales  = $this->Sales_Enquiries_Model->check_agent_sales($ag_id);
				$agent_check_sales_agent_no = $agent_check_sales->AG_PI_Code_No;
				if ($agent_check_sales_agent_no > 0) {
					$agent_check_sales_agent_no = $agent_check_sales_agent_no + 1;
					$samp = $check_age . $agent_check_sales_agent_no;
					$data['AG_PI'] = $samp;
					$data['AG_PI_Code'] = $check_age;
					$data['AG_PI_Code_No'] = $agent_check_sales_agent_no;
				} else {
					$data['AG_PI'] = $check_age . 1;
					$data['AG_PI_Code'] = $check_age;
					$data['AG_PI_Code_No'] = 1;
				}
				$agent_pi_code = $data['AG_PI_Code'];
				$agent_pi_code_no = $data['AG_PI_Code_No'];
				$this->Sales_Enquiries_Model->updatecustomerdetails($data, $cus_id);
				$data['AF_Name'] = $this->input->post('phone');
				$order_id = str_replace(" ", "-", ("WO")) . "-" . ($cus_id);
				$us_id = $this->session->userdata('US_Id');
				$hsn = $this->input->post('hsn');
				$product = $this->input->post('productname');
				if (is_array($product)) {
					$count = 0;
					foreach ($product as $value) {
						if ($value !== '') {
							$count++;
						}
					}
				}
				$height = $this->input->post('height');
				$width = $this->input->post('width');
				$quantity = $this->input->post('quantity');
				$heightnl = $this->input->post('heightnl');
				$widthnl = $this->input->post('widthnl');
				$wastage = $this->input->post('wastage');
				$unit = $this->input->post('unit');
				$type = $this->input->post('type');
				$rate = $this->input->post('rate');
				$po_rate = $this->input->post('polishrate');
				$po_id = $this->input->post('potype');
				$cutting_type = $this->input->post('cutting_type');
				$date_time = date("Y-m-d H:i:s");
				$item = $this->input->post('item');
				$id = $this->input->post('ad_id');
				$quan = $this->input->post('quan');
				$unit_price = $this->input->post('unit_price');
				$id2 = $this->input->post('ad_id2');
				$item2 = $this->input->post('item2');
				$add_id2 = $this->input->post('ad_id2');
				$quan2 = $this->input->post('quan2');
				$unit_price2 = $this->input->post('unit_price2');
				$sp_id = null;
				$j = 0;
				$p = 0;
				$q = 0;
				$this->Sales_Enquiries_Model->deleteAdditional($cus_id);
				for ($i = 0; $i < $count; $i++) {
					$data = [
						'PD_Id'  =>  $product[$i],
						'SL_Hsn'  =>  $hsn[$i],
						'PD_height' => $height[$i],
						'PD_Width' => $width[$i],
						'PD_Cus_Height' => $height[$i],
						'PD_Cus_Width' => $width[$i],
						'PD_Height_Nl' => $heightnl[$i],
						'PD_Weight_Nl' => $widthnl[$i],
						'PD_Waste' => $wastage[$i],
						'PD_Unit' => $unit[$i],
						'ED_Id' => $type[$i],
						'PD_Quantity' => $quantity[$i],
						'PD_Price' => $rate[$i],
						'PI_Rate' => $po_rate[$i],
						'PO_Id' => $po_id[$i],
						'AG_Id' => $ag_id,
						'AG_PI_Code' => $agent_pi_code,
						'AG_PI_Code_No' => $agent_pi_code_no,
						'CU_Id' => $cus_id,
						'US_Id'  => $us_id,
						'SP_Type'  => $cutting_type,
						'PD_Order_Date' => $date_time,
						'PD_Order_No'  => $order_id,
						'PD_Status'=>$status,
					];
					$this->Sales_Enquiries_Model->insertheight($data);
					$sp_id = $this->db->insert_id();
					$checkArr = array();
					$slcount = 1;
					$divident = (count($item) / count($product)) + 1;
					for ($p; $p < count($item); $p++) {
						$dat = [
							'AU_Id'	=> $id[$p],
							'AU_Item' => $item[$p],
							'AD_Quantity' => $quan[$p],
							'AD_Unit_Price' => $unit_price[$p],
							'CU_Id' => $cus_id,
							'US_Id'  => $us_id,
							'SP_Id'  => $sp_id,
						];
						$this->Sales_Enquiries_Model->insert_additional_details($dat);
						$slcount++;
						if ($slcount > $addCnt) {
							$p = $p + 1;
							break;
						}
					}
				}
				for ($q; $q < count($item2); $q++) {
					$da = [
						'AU_Id'	=> $id2[$q],
						'AU_Item' => $item2[$q],
						'AD_Quantity' => $quan2[$q],
						'AD_Unit_Price' => $unit_price2[$q],
						'AF_Status' => 1,
						'CU_Id' => $cus_id,
						'US_Id'  => $us_id,
					];
					$this->Sales_Enquiries_Model->insert_additional_detail($da);
					$data['class'] = "success";
					$data['msg'] = "Succesfully Added.";
				}
			}
			echo json_encode($data);
		}
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
	public function remove_sales()
	{
		$cus_id = $this->input->post('CID');
		$remove = $this->Sales_Enquiries_Model->remove_sales($cus_id);
		if ($remove) {
			echo json_encode(array("status" => 1));
		} else {
			echo json_encode(array("status" => 0));
		}
	}
	public function save_proforma_invoice()
	{
		$invoiceData = $this->input->post('invoiceDoc');
		$cuid = $this->input->post('cuid');
		$wo = $this->input->post('wo');
		$saveInvoice = $this->Sales_Enquiries_Model->saveInvoice($invoiceData, $cuid, $wo);
		echo json_encode(1);
	}
	public function fetchcust($id)
	{
		$result = $this->Sales_Enquiries_Model->fetchcust($id);
		foreach ($result as $rows) {
			$data['class'] = "success";
			$data['name'] = $rows->CU_Name;
			$data['phone'] = $rows->CU_Phone;
			$data['address'] = $rows->CU_Address;
			$data['gst'] = $rows->CU_Gst_No;
			echo json_encode($data);
		}
	}
	public function getPolish()
	{
		$prdId = $this->input->post('prdId');
		$result = $this->Sales_Enquiries_Model->getPolish($prdId);
		echo json_encode($result);
	}
	public function getPolishRates()
	{
		$poId = $this->input->post('poId');
		$pdId = $this->input->post('pdId');
		$result = $this->Sales_Enquiries_Model->getPolishRates($poId, $pdId);
		echo json_encode($result);
	}
}
