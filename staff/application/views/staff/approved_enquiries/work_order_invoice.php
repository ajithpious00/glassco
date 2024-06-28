<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body narrow-margin">
						<div class="row maintitle">
							<table style="width:100%;">
								<tr>
									<td>
										<div class="col-md-6 col-sm-6 text-left">
											<img src="<?php echo base_url(); ?>assets/admin/images/logo/imgpsh_fullsize_anim.jpg" 			width="300" height="100" alt="logo" />
										</div>
									<td>
									<td style="text-align:right;">
										<div class="col-sm-12 text-right">
											<h5 class="color-font">GLASSCO TUFF</h5>
											<address class="color-font">
												Kappur-Post <br>
												Kanjirathani-679 552<br>
												State Name : Kerala ,Code : 32 <br>
												Email:info@glasscogroup.in/www.glasscogroup.in
											</address>
										</div>
									<td>
								</tr>
							</table>
							
							
						</div>
						<div class="box-body" id="perfomainvoice">
							<table class="invoice" style="width:100%;">
								<tr>
									<td>
										<div class="row">
											<div class="col-lg-6 grid-margin text-left">
												<h4 class="color-font"><strong>Customer </strong> Details</h4>
												<ul class="list-unstyled" style="list-style-type: none; padding-left: 0px;">
													<li class="color-font"><strong>Customer Name :&nbsp;&nbsp;</strong>
														<?php echo ucfirst($customerdetail->CU_Name); ?>
													</li>
													<li class="color-font"><strong>Customer Phone :&nbsp;&nbsp;</strong>
														<?php echo $customerdetail->CU_Phone; ?>
													</li>
													<li class="color-font"><strong>Customer Address
															:&nbsp;&nbsp;</strong>
														<?php echo ucfirst($customerdetail->CU_Address); ?>
													</li>
													<li class="color-font"><strong>GSTIN/UIN :&nbsp;&nbsp;</strong>
														<?php echo $customerdetail->CU_Gst_No; ?>
													</li>
													<li class="color-font"><strong>Order Date :&nbsp;&nbsp;</strong>
														<?php echo date("d-m-Y", strtotime($order_number->PD_Order_Date)); ?>
													</li>
													<!--<li class="color-font"><strong>Agent  Name :&nbsp;&nbsp;</strong>
														<?php echo $agentdetail->AG_Name; ?>
													</li>-->
													<li class="color-font"><strong>User Name :&nbsp;&nbsp;</strong>
														<?php echo $customerdetail->US_Name; ?>
													</li>
													<li class="color-font"><strong>Agent  Code :&nbsp;&nbsp;</strong>
														<?php echo $agentdetail->AG_Code; ?>
													</li>
													<li class="color-font"><strong>Cutting Type:&nbsp;&nbsp;</strong>
														<?php echo $cut_type; ?>
													</li>
													<li class="color-font"><strong>Work Order No:&nbsp;&nbsp;</strong>
														<?php echo $work_order_no; ?>
													</li>
												</ul>
											</div>
										</div>
									</td>
								</tr>
							</table>
							<div class="color-font">
								<center> <strong>Work Order Information
										<hr>
									</strong>
							</div>
							<div class="table-responsive">
								<table class="display dataTable" style="text-align:left;">
									<thead>
										<tr>
											<th>Perfoma Order No.& <br /> Date</th>
											<th>Delivery Date</th>
											<th>Pur. Order No & Date</th>
											<th>Destination</th>
											<th>E-Way Bill No</th>
										</tr>
										<tr>
											<th>
												<?php
													echo $pi_code;
												 ?><br>
												<?php
												$PD_Order_Date = date_create($order_number->PD_Order_Date);
												echo date_format($PD_Order_Date, "d-M-Y");
												?>
											</th>
											<th>
												<?php echo $customerdetail->CU_Delivered_at; ?>
											</th>
											<th><?php echo $customerdetail->CU_Created_at; ?></th>
											<th>&nbsp;</th>
											<th>&nbsp;</th>
										</tr>
										<tr>
											<th>Name & Address Of Buyer :</th>
											<td>&nbsp;</td>
											<th>Name & Address Of Consignee :</th>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<th class="invsubtitle">
												<?php echo $customerdetail->CU_Name; ?>
											</th>
											<td>&nbsp;</td>
											<th class="invsubtitle">
												<?php echo $customerdetail->CU_Delivery_Address; ?>
											</th>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<th class="invsubtitle">
												<?php echo $customerdetail->CU_Phone; ?>
											</th>
											<td>&nbsp;</td>
											<th class="invsubtitle">
												<?php echo $customerdetail->CU_Phone;
												; ?>
											</th>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<th class="invsubtitle">
												<?php echo $customerdetail->CU_Address; ?>
											</th>
											<td>&nbsp;</td>
											<th class="invsubtitle">
												<?php echo $customerdetail->CU_Address; ?>
											</th>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
									</thead>
								</table>
							</div>
							<div class="clearfix"> &nbsp;</div>
							<div class="color-font">
								<center> <strong>Work Order
										<hr>
									</strong>
							</div>
							<div class="table-responsive">
								<table class="display dataTable" id="proforma-item-list" cellspacing="0" style="text-align:left;">
									<thead>
										<tr>
											<!--<th style="border:#CCC 1px solid;">Product Type</th>
											<th style="border:#CCC 1px solid;">Product HSN Code</th>-->
											<th style="border:#CCC 1px solid;">Product Name</th>
											<!--<th style="border:#CCC 1px solid;">Height</th>
											<th style="border:#CCC 1px solid;">Width</th>
											<th style="border:#CCC 1px solid;">Height(mm)</th>
											<th style="border:#CCC 1px solid;">Width(mm)</th>-->
											<th style="border:#CCC 1px solid;">Height(mm)</th>
											<th style="border:#CCC 1px solid;">Width(mm)</th>
											<th style="border:#CCC 1px solid;">Pieces </th>
											<th style="border:#CCC 1px solid;">Sq.F</th>
											<th style="border:#CCC 1px solid;">Sqmtr</th>
											<!--<th style="border:#CCC 1px solid;">Product Rate</th>-->
											<th style="border:#CCC 1px solid;">Total Sqmtr</th>
											<!--<th style="border:#CCC 1px solid;">Total Product Rate</th>-->
											<th style="border:#CCC 1px solid;">Polish Type</th>
											<!--<th style="border:#CCC 1px solid;">Polish HSN Code</th>
											<th style="border:#CCC 1px solid;">Polish Rate</th>
											<th style="border:#CCC 1px solid;">Total Polish Rate</th>-->
											<!--<th>Rate</th>
											<th>Net Price</th>
											<th>Total Price</th>-->
										</tr>
									</thead>
									<tbody>
										<?php
										//echo '<pre>';
										//print_r($prodArr);
										//echo '</pre>';
										$total_polish_rate = 0;
										$total_product_rate = 0;
										for($i=0; $i<count($prodArr); $i++) {
											
											?>
											<tr>
												<!--<td style="border:#CCC 1px solid;">
													<?php echo ucfirst($prodArr[$i]['Edge_type']); ?><br></a>
												</td>
												<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['HSN_code']; ?><br></a>
												</td>-->
												<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['PD_Name']; ?><br></a>
												</td>
												<!--<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['PD_Cus_Height']; ?>
													<?php echo $prodArr[$i]['UN_Name']; ?>
												</td>
												<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['PD_Cus_Width']; ?>
													<?php echo $prodArr[$i]['UN_Name']; ?><br></a>-->
												</td>

												<?php
												if ($prodArr[$i]['UN_Id'] == 1) {
													$heightmm = $prodArr[$i]['PD_Height_Nl'] * 10;
													$widthmm = $prodArr[$i]['PD_Weight_Nl'] * 10;
												} elseif ($prodArr[$i]['UN_Id'] == 2) {
													$heightmm = $prodArr[$i]['PD_Height_Nl'] * 25.4;
													$widthmm = $prodArr[$i]['PD_Weight_Nl'] * 25.4;
												} elseif ($prodArr[$i]['UN_Id'] == 3) {
													$heightmm = $prodArr[$i]['PD_Height_Nl'] * 304.79999025;
													$widthmm = $prodArr[$i]['PD_Weight_Nl'] * 304.79999025;
												} else {
													$heightmm = $prodArr[$i]['PD_Height_Nl'];
													$widthmm = $prodArr[$i]['PD_Weight_Nl'];
												}
												?>
												<!--<td style="border:#CCC 1px solid;">
													<?php echo $heightmm; ?><br></a>
												</td>
												<td style="border:#CCC 1px solid;">
													<?php echo $widthmm; ?><br></a>
												</td>-->
												<td style="border:#CCC 1px solid;">
													<?php echo $heightmm + $prodArr[$i]['PD_waste']; ?><br></a>
												</td>
												<td style="border:#CCC 1px solid;">
													<?php echo $widthmm + $prodArr[$i]['PD_waste']; ?><br></a>
												</td>
												<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['PD_Quantity']; ?><br></a>
												</td>
												<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['sqf']; ?><br></a>
												</td>
												<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['sqm']; ?><br></a>
												</td>
												<!--<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['rate']; ?><br></a>
												</td>-->
												<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['product_quantity_sqm']; 
													$total_product_weight = ($prodArr[$i]['PR_Weight'] * $prodArr[$i]['product_quantity_sqm']);
													?><br></a>
												</td>
												<!--<td style="border:#CCC 1px solid;">₹
													<?php echo $prodArr[$i]['total_rate']; 
													$total_product_rate = $total_product_rate + $prodArr[$i]['total_rate'];
													?>
												</td>-->
												<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['PO_Name']; ?>
												</td>
												<!--<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['PO_Hsn_Code']; ?>
												</td>
												<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['PO_Rate']; ?>
												</td>
												<td style="border:#CCC 1px solid;">
													<?php echo $prodArr[$i]['total__polish_rate']; 
														$total_polish_rate =  $total_polish_rate + $prodArr[$i]['total__polish_rate'];
													?>
												</td>-->
											</tr>
											<?php
											//print_r($prodArr[$i]['product_adds']);exit();
											if(isset($prodArr[$i]['product_adds'])) {
											?>
											<tr>
												<td colspan="19" class="addtinal-block" style="border:#CCC 1px solid; background-color:#f9f9f9;">
													<div class="row">
														<?php 
														
														$coldiv = count($prodArr[$i]['product_adds'])/3;
														$slno=1;
														//foreach ($additional_details as $ad) {
														
														for($j=0;$j<count($prodArr[$i]['product_adds']);$j++) {
															if($slno==1) {
																echo '<div class="col-md-4">';
															}
															?>
																<div class="col-md-12 addt-item">
																	<!--<b><?php echo $ad->AU_Item ,$ad->SP_Id?>: &nbsp;&nbsp;</b>
																	<?php echo $ad->AD_Quantity ?> &nbsp;&nbsp; X &nbsp;&nbsp;
																	<?php echo $ad->AD_Unit_Price ?>&nbsp;&nbsp; = 
																	<?php echo $ad->listing_price ?></strong>-->
																	
																	<b><?php echo $prodArr[$i]['product_adds'][$j]['AU_Item'].":"; ?></b>
																	<?php echo $prodArr[$i]['product_adds'][$j]['AD_Quantity']; ?> &nbsp;&nbsp;  &nbsp;&nbsp;
																	<!--<?php echo $prodArr[$i]['product_adds'][$j]['AD_Unit_Price']; ?>&nbsp;&nbsp; = 
																	<?php echo $prodArr[$i]['product_adds'][$j]['listing_price']; ?>-->
																	
																</div>
															<?php 
															if($slno==$coldiv) {
																echo '</div>';
																$slno = 0;
															}
															$slno++;
														}
														?>
													</div>
												</td>
											</tr>
											<?php
											}
										}
										?>
									</tbody>
								</table>
							</div>
							<hr class="nomargin-top">
							<div class="row">
								<div class="col-sm-6 text-left">
									<ul class="list-unstyled" style="list-style-type: none; padding-left: 0px;">
									<li class="color-font"><b>
												Total Quantity  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>
											<?php echo $total_sqmtr; ?>.Sqmtr
										</li>
										<li class="color-font"><b>
												Total Weight Of Product: &nbsp;&nbsp;
											</b>
											<?php echo $total_product_weight; ?>&nbsp;KG
											
										</li>
										<!--<li class="color-font"><b>
												<h5>Polish Name  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b><?php echo ucfirst($polish_name); ?>
										</li>
										<li class="color-font"><b>
												<h5>HSN Code  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b><?php echo ucfirst($polish_hsn); ?>
										</li>
										<li class="color-font"><b>
												<h5>Polish Rate  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹<?php echo $polish_rate; ?>
										</li>
										<li class="color-font"><b>
												<h5>Net Polish Rate  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹<?php echo $net_polish_rate; ?>
										</li>
										<!--<li class="color-font"><b>
												<h5>Total total Price  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹<?php echo $net_polish_rate; ?>
										</li>-->
										<!--<li class="color-font"><b>
												Total Product Amount: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_product_rate; ?>
										</li>
										<li class="color-font"><b>
												Total Polish Amount: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_polish_rate; ?>
										</li>
										<li class="color-font"><b>
												Total Additional Charges: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_additional_charges; ?>
											
										</li>
										<li class="color-font"><b>
												Total Taxable Amount: &nbsp;&nbsp;
											</b>₹
											<?php $taxable = $total_product_rate + $total_polish_rate; 
												echo number_format((float)$taxable, 2, '.', '');
											?>
										</li>
										<!--<?php
										foreach ($additional_details as $ad) {
											?>
											<li class="color-font"><b>
													<?php echo $ad->AU_Item ?>: &nbsp;&nbsp;
												</b>
												<?php echo $ad->AD_Quantity ?> &nbsp;&nbsp; X &nbsp;&nbsp;
												<?php echo $ad->AD_Unit_Price ?>&nbsp;&nbsp; = 
												<?php echo $ad->listing_price ?></strong>
											</li>
											<?php
										}
										?>-->
										<!--<li class="color-font"><b>CGST@ 9% :&nbsp;&nbsp;</b>₹
											<?php //echo $cgst; 
												 $cgst = (($total_additional_charges + ($total_product_rate + $total_polish_rate)) * 9)/100;
												echo number_format((float)$cgst, 2, '.', ''); 
											?>
										</li>
										<li class="color-font"><b>SGST@ 9% :&nbsp;&nbsp;</b>₹
											<?php //echo $sgst; 
												$sgst = (($total_additional_charges + ($total_product_rate + $total_polish_rate)) * 9)/100;
												echo number_format((float)$sgst, 2, '.', ''); 
											?>
										</li>-->
										<!--<li class="color-font"><b>
												<h5>Total Quantity  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>
											<?php echo $total_sqmtr; ?>.Sqmtr
										</li>
										<<li class="color-font"><b>
												<h5>Rate(1sqrmtr)  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹
											<?php echo $price; ?>
										</li>-->
										<!--<li class="color-font"><b>
												<h5>Rate(1sqrmtr)  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹
											<?php echo $price; ?>
										</li>
										<li class="color-font"><b>
												<h5>Net Price  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹<?php echo $net_price; ?>
										</li>-->
										<!---<li class="color-font"><b>
												<h5>Polish Rate  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹<?php echo $polish_rate; ?>
										</li>-->
										<!--<li class="color-font"><b>
												<h5>Net Polish Rate  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹<?php echo $net_polish_rate; ?>
										</li>-->
										<!--<li class="color-font"><b>ROUND OFF: &nbsp;&nbsp;</b></strong>
										<li class="color-font"><b>
												Total Additional Charges: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_additional_charges; ?>
											
										</li>-->
										<!--<li class="color-font"><b>
												Total Tax Amount: &nbsp;&nbsp;
											</b>₹
											<?php //echo $total_tax; 
												$tot_tax = $cgst + $sgst;
												
												echo number_format((float)$tot_tax, 2, '.', '');
											?>
											
										</li>
										<li class="color-font"><b>
												Total Weight Of Product: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_product_weight; ?>
											
										</li>
										<li class="color-font"><h3><b>
												Grand Total: &nbsp;&nbsp;
											</b>₹
											<?php //echo $grand_total; 
												$grand_tot = $tot_tax + $total_additional_charges + $taxable;
												echo '<b>'.number_format((float)$grand_tot, 2, '.', '')."</b>";
											?>-->
											</h3>
										</li>
									</ul>
								</div>
								
							</div>
						</div>
						<div class="panel panel-default text-right button-box">
							<div class="panel-body">
								<?php
								$linkName = $customerdetail->CU_Id;
								?>
								<!--<a class="btn btn-danger"
									href="<?php echo AD_BASE_PATH . 'rejected_enquiries/reject_enquiry/' . $linkName; ?>"><i
										class="fa fa-ban"></i> Reject</a>
								<a class="btn btn-primary"
									href="<?php echo AD_BASE_PATH . 'work_order/work_approved/' . $linkName . '"'; ?>"><i
										class="fa fa-check"></i> Approve</a>
								<a class="btn btn-warning"
									href="<?php echo AD_BASE_PATH . 'work_order/work_order_sticker/' . $linkName; ?>"><i
										class="fa fa-print"></i> PRINT STICKER</a>-->
								<a class="btn btn-success" onclick="printDiv()"><i class="fa fa-print"></i> PRINT WORK
									ORDER</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>