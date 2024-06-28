<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-10"></div>
			<div class="col-lg-2 my-3">
				<select class="form-control" name="invoice_type" id="invoice_type" data-id="<?php echo $cus_id; ?>" onchange="updateInvoiceType(this)">
					<option value="b_to_b">B TO B</option>
					<option value="b_to_c" selected>B TO C</option>
				</select>
			</div>
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body narrow-margin">
						<div class="row maintitle">
							<table style="width:100%;">
								<tr>
									<td>
										<div class="col-md-6 col-sm-6 text-left">
											<img src="<?php echo base_url(); ?>assets/admin/images/logo/imgpsh_fullsize_anim.jpg" width="200" height="65" alt="logo" />
										</div>
									<td>
									<td style="text-align:right;">
										<div class="col-sm-12 text-right">
											<address class="color-font">
												Kappur-Post <br>
												Kanjirathani-679 552<br>
												<b>State:</b>&nbsp;Kerala ,Code : 32 <br>
												<b>Email:</b>&nbsp;info@glasscogroup.in<br />
												<b>Website:</b>&nbsp;www.glasscogroup.in
											</address>
										</div>
									<td>
								</tr>
							</table>
						</div>
						<div class="box-body" id="perfomainvoice">
							<div class="clearfix">&nbsp;</div>
							<table class="invoice" style="width:100%;">
								<tr>
									<td>
										<div class="row">
											<table class="invoice" style="width:100%;">
												<tr>
													<td>
														<div class="col-12 text-left">
															<h4 class="color-font"><strong>Customer </strong> Details</h4>
															<ul class="list-unstyled" style="list-style-type: none; padding-left: 0px;">
																<li class="color-font">
																	<b>Name :</b>&nbsp;&nbsp;<?php echo ucfirst($customerdetail->CU_Name); ?>
																</li>
																<li class="color-font">
																	<b>Phone :</b>&nbsp;&nbsp;<?php echo $customerdetail->CU_Phone; ?>
																</li>
																<li class="color-font">
																	<b>Address:</b>&nbsp;&nbsp;<?php echo ucfirst($customerdetail->CU_Address); ?>
																</li>
																<li class="color-font">
																	<b>Invoice No:</b>&nbsp;&nbsp;<?php echo 'G2C-' .ucfirst($customerdetail->CU_Id).'/23/24'; ?>
																</li>
																<!--<li class="color-font">
																	<b>GSTIN/UIN:</b>&nbsp;&nbsp;<?php echo $customerdetail->CU_Gst_No; ?>
																</li>-->
															</ul>
														</div>
													</td>
													<td style="text-align:right;">
														<div class="col-12 text-right">
															<ul class="list-unstyled" style="list-style-type: none; padding-left: 0px;">
																<li class="color-font">
																	<b>Created By :</b>&nbsp;&nbsp;<?php echo $customerdetail->US_Name; ?>
																</li>
																<li class="color-font">
																	<b>Agent Code :</b>&nbsp;&nbsp;<?php echo $agentdetail->AG_Code; ?>
																</li>
																<li class="color-font">
																	<b>Cutting Type:</b>&nbsp;&nbsp;<?php echo $cut_type; ?>
																</li>
															</ul>
														</div>
													</td>
												</tr>
											</table>

										</div>
									</td>
									<!--<td valign="top">
										<div class="row">
											<div class="col-md-12 col-sm-12 text-right">
												<h4 class = "color-font"><strong>User</strong> Details</h4>
												<ul class="list-unstyled">
													<li class = "color-font"><strong>User Name :&nbsp;&nbsp;</strong> <?php echo ucfirst($customerdetail->US_Name); ?></li>
													<li class = "color-font"><strong>GSTIN/UIN :&nbsp;&nbsp;</strong>32AAVFG6290P1ZJ</li>
													
												</ul>
											</div>
										</div>
									</td>-->
								</tr>
							</table>
							<div class="color-font">
								<center> <strong>INVOICE
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
											<th colspan="2">E-Way Bill No</th>
										</tr>
										<tr>
											<td>
												<?php echo $pi_code; ?><br>
												<?php
												$PD_Order_Date = date_create($order_number->PD_Order_Date);
												echo date_format($PD_Order_Date, "d-M-Y");
												?>
											</td>
											<td>
												<?php echo $customerdetail->CU_Delivered_at; ?>
											</td>
											<td><?php echo $customerdetail->CU_Created_at; ?></td>
											<td>
												<?php echo $customerdetail->CU_Delivery_Address; ?>
											</td>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<th>Name & Address Of Buyer : (Bill To)</th>
											<td>&nbsp;</td>
											<th>Name & Address Of Consignee : (Shipped To)</th>
											<td colspan="2">&nbsp;</td>
										</tr>
										<tr>
											<td class="invsubtitle">
												<?php
												echo $customerdetail->CU_Name . "<br/>" . $customerdetail->CU_Address . "<br/>Phone:&nbsp;" . $customerdetail->CU_Phone;
												?>
											</td>
											<td>&nbsp;</td>
											<?php
											if ($customerdetail->CU_Address == '') {

											?>
												<td class="invsubtitle">
													<?php
													echo $customerdetail->CU_Name . "<br/>" . $customerdetail->CU_Address . "<br/>Phone:&nbsp;" . $customerdetail->CU_Phone;
													?>
												</td>
												<td>&nbsp;</td>
											<?php
											}
											?>
											<?php
											if ($customerdetail->CU_Address != '') {
											?>
												<td class="invsubtitle">
													<?php echo   $customerdetail->CU_Name . "<br/>" . ',' . $customerdetail->CU_District . ',' . $customerdetail->CU_Delivery_Address . "<br/>Phone:&nbsp;" . $customerdetail->CU_Phone; ?>
												</td>
												<td colspan="2">&nbsp;</td>
											<?php
											}
											?>
										</tr>

										<!--<tr>
											<th class="invsubtitle">
												
											</th>
											<td>&nbsp;</td>
                                          	<td>&nbsp;</td>
											<th class="invsubtitle">
												<?php echo $customerdetail->CU_Address; ?>
											</th>
											<td colspan="2">&nbsp;</td>
										</tr>-->
									</thead>
								</table>
							</div>
							<div class="clearfix"> &nbsp;</div>
							<div class="color-font">
								<center> <strong>Product Details
										<hr>
									</strong>
							</div>
							<div class="table-responsive">
								<table class="display dataTable" id="proforma-item-list" cellspacing="0" style="text-align:left;">
									<?php
									//echo '<pre>';
									//print_r($prodArr);
									//echo '</pre>';
									$total_polish_rate = 0;
									$total_product_rate = 0;
									for ($i = 0; $i < count($prodArr); $i++) {

									?>
										<thead>
											<tr>
												<th style="border:#999 1px solid; font-size:14px !important;" colspan="4">
													Product Type: <?php echo ucfirst($prodArr[$i]['Edge_type']); ?>
												</th>
												<th style="border:#999 1px solid; font-size:14px !important;" colspan="4">
													HSN Code: <?php echo strtoupper($prodArr[$i]['HSN_code']); ?></th>
												<th style="border:#999 1px solid; font-size:14px !important;" colspan="8">
													Product Name: <?php echo ucfirst($prodArr[$i]['PD_Name']); ?>
												</th>
											</tr>
											<tr>

												<th style="border:#999 1px solid;">Ht</th>
												<th style="border:#999 1px solid;">Wt</th>
												<th style="border:#999 1px solid;">Ht(mm)</th>
												<th style="border:#999 1px solid;">Wt(mm)</th>
												<th style="border:#999 1px solid;">Ht(mm)</th>
												<th style="border:#999 1px solid;">Wt(mm)</th>
												<th style="border:#999 1px solid;">Pcs </th>
												<th style="border:#999 1px solid;">Sq.F</th>
												<th style="border:#999 1px solid;">Sqmtr</th>
												<th style="border:#999 1px solid;">Prod Rate</th>
												<th style="border:#999 1px solid;">Total Sqmtr</th>
												<th style="border:#999 1px solid;">Total Prod Rate</th>
												<th style="border:#999 1px solid;">Pol. Type</th>
												<th style="border:#999 1px solid;">Pol. HSN Code</th>
												<th style="border:#999 1px solid;">Pol. Rate</th>
												<th style="border:#999 1px solid;">Total Pol. Rate</th>
												<!--<th>Rate</th>
											<th>Net Price</th>
											<th>Total Price</th>-->
											</tr>
										</thead>
										<tbody>

											<tr>

												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['PD_Cus_Height']; ?>
													<?php echo $prodArr[$i]['UN_Name']; ?>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['PD_Cus_Width']; ?>
													<?php echo $prodArr[$i]['UN_Name']; ?><br></a>
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
												<td style="border:#999 1px solid;">
													<?php echo $heightmm; ?><br></a>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $widthmm; ?><br></a>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $heightmm + $prodArr[$i]['PD_waste']; ?><br></a>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $widthmm + $prodArr[$i]['PD_waste']; ?><br></a>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['PD_Quantity']; ?><br></a>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['sqf']; ?><br></a>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['sqm']; ?><br></a>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['rate']; ?><br></a>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['product_quantity_sqm'];
													$total_product_weight = ($prodArr[$i]['PR_Weight'] * $prodArr[$i]['product_quantity_sqm']);
													?><br></a>
												</td>
												<td style="border:#999 1px solid;">₹
													<?php echo $prodArr[$i]['total_rate'];
													$total_product_rate = $total_product_rate + $prodArr[$i]['total_rate'];
													?>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['PO_Name']; ?>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['PO_Hsn_Code']; ?>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['PO_Rate']; ?>
												</td>
												<td style="border:#999 1px solid;">
													<?php echo $prodArr[$i]['total__polish_rate'];
													$total_polish_rate =  $total_polish_rate + $prodArr[$i]['total__polish_rate'];
													?>
												</td>
											</tr>
											<?php
											//print_r($prodArr[$i]['product_adds']);exit();
											if (isset($prodArr[$i]['product_adds'])) {
											?>
												<tr>
													<td colspan="19" class="addtinal-block" style="border:#999 1px solid; background-color:#f9f9f9;">
														<div class="row">
															<?php

															//$coldiv = count($prodArr[$i]['product_adds'])/4;
															$coldiv = (count($prodArr[$i]['product_adds']) < 7 ? 1 : 2);
															$slno = 1;
															//foreach ($additional_details as $ad) {

															for ($j = 0; $j < count($prodArr[$i]['product_adds']); $j++) {
																if ($slno == 1) {
																	echo '<div class="col-md-2">';
																}
															?>
																<div class="col-md-12 addt-item">
																	<!--<b><?php echo $ad->AU_Item_Short, $ad->SP_Id ?>: &nbsp;&nbsp;</b>
																	<?php echo $ad->AD_Quantity ?> &nbsp;&nbsp; X &nbsp;&nbsp;
																	<?php echo $ad->AD_Unit_Price ?>&nbsp;&nbsp; = 
																	<?php echo $ad->listing_price ?></strong>-->

																	<b><?php echo $prodArr[$i]['product_adds'][$j]['AU_Item_Short'] . ":"; ?></b>
																	<?php echo $prodArr[$i]['product_adds'][$j]['AD_Quantity']; ?> &nbsp;&nbsp; X &nbsp;&nbsp;
																	<?php echo $prodArr[$i]['product_adds'][$j]['AD_Unit_Price']; ?>&nbsp;&nbsp; =
																	<?php echo $prodArr[$i]['product_adds'][$j]['listing_price']; ?>

																</div>
															<?php
																if ($slno == $coldiv) {
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
										<tr>

										</tr>
										</tbody>
								</table>
							</div>
							<hr class="nomargin-top">
							<div class="row">
								<div class="col-sm-6 text-left">
									<ul class="list-unstyled" style="list-style-type: none; padding-left: 0px;">
										<li class="color-font"><b>
												Total Quantity :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>
											<?php echo $total_sqmtr; ?>.Sqmtr
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
										<li class="color-font"><b>
												Total Product Amount: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_product_rate; ?>
										</li>
										<li class="color-font"><b>
												Total Polish Amount: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_polish_rate; ?>
										</li>
										<!--<li class="color-font"><b>
												Total Additional Work Charges: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_additional_charges + $add_deta; ?>
											
										</li>-->
										<li class="color-font"><b>
												Total Additional Work Charges: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_additional_charges; ?>
										</li>
										<!--<li class="color-font"><b>
												Total Taxable Amount: &nbsp;&nbsp;
											</b>₹
											<?php $taxable = $total_product_rate + $total_polish_rate;
											echo number_format((float)$taxable, 2, '.', '');
											?>
										</li>-->
										<li class="color-font"><b>
												Total Documentation Charges: &nbsp;&nbsp;
											</b>₹

											<?php echo $add_dh->AD_Unit_Price; ?>&nbsp;&nbsp; =
											<?php echo $add_dh->listt;
											$documentation  = $add_dh->listt; ?>
										</li>

										<!--<li class="color-font"><b>
												Total Handling Charge: &nbsp;&nbsp;
											</b>₹
											<?php echo $add_hh->AD_Quantity; ?> &nbsp;&nbsp; X &nbsp;&nbsp;
																	<?php echo $add_hh->AD_Unit_Price; ?>&nbsp;&nbsp; = 
																	<?php echo $add_hh->listt;
																	?>
										</li>-->
										<li class="color-font"><b>
												Total Transportation Charge : &nbsp;&nbsp;
											</b>₹

											<?php echo $add_th->AD_Unit_Price; ?>&nbsp;&nbsp; =
											<?php echo $add_th->listt;
											$transportation = $add_th->listt;  ?>
										</li>
										<li class="color-font"><b>
												Total Handling Charge: &nbsp;&nbsp;
											</b>
											<!--<?php echo $add_hh->AD_Quantity; ?> &nbsp;&nbsp; X &nbsp;&nbsp;
																	<?php echo $add_hh->AD_Unit_Price; ?>&nbsp;&nbsp; = 
																	<?php echo $add_hh->listt;
																	$handling = $add_hh->listt; ?>-->
											<?php echo $add_hh->AD_Unit_Price . '%'; ?>&nbsp;&nbsp; =
											<?php $handling =  $total_product_rate + $total_polish_rate + $documentation  + $transportation + $total_additional_charges;
											$hand = ($handling * $add_hh->listt) / 100;
											echo number_format((float)$hand, 2, '.', '');
											?>

										</li>
										<li class="color-font"><b>
												Total Cash Discount Paid: &nbsp;&nbsp;
											</b>₹

											<?php echo $add_ch->AD_Unit_Price; ?>&nbsp;&nbsp; =
											<?php echo $add_ch->listt;
											$cutting = $add_ch->listt; ?>
										</li>
										<li class="color-font"><b>
												Total Taxable Amount: &nbsp;&nbsp;
											</b>₹
											<?php $taxable = $total_product_rate + $total_polish_rate + $documentation  + $transportation + $total_additional_charges + $hand - $cutting;
											echo number_format((float)$taxable, 2, '.', '');
											?>
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
										<li class="color-font"><b>CGST@ 9% :&nbsp;&nbsp;</b>₹
											<?php //echo $cgst; 
											// $cgst = ((($total_additional_charges + $add_deta) + ($total_product_rate + $total_polish_rate)) * 9)/100;
											$cgst = ($taxable * 9) / 100;
											echo number_format((float)$cgst, 2, '.', '');
											?>
										</li>
										<li class="color-font"><b>SGST@ 9% :&nbsp;&nbsp;</b>₹
											<?php //echo $sgst; 
											$sgst =  ($taxable * 9) / 100;
											echo number_format((float)$sgst, 2, '.', '');
											?>
										</li>
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
										<li class="color-font"><b>
												Total Tax Amount: &nbsp;&nbsp;
											</b>₹
											<?php //echo $total_tax; 
											$tot_tax = $cgst + $sgst;

											echo number_format((float)$tot_tax, 2, '.', '');
											?>

										</li>
										<li class="color-font"><b>
												Total Weight Of Product: &nbsp;&nbsp;
											</b>
											<?php echo $total_product_weight; ?>&nbsp;KG

										</li>
										<li class="color-font">
											<h3><b>
													Grand Total: &nbsp;&nbsp;
												</b>₹
												<?php //echo $grand_total; 
												$grand_tot = $tot_tax + $taxable;
												echo '<b>' . number_format((float)$grand_tot, 2, '.', '') . "</b>";
												?>
											</h3>
										</li>
									</ul>
								</div>

							</div>
						</div>
						<div class="box-body" id="perfomainvoice">
							<table class="invoice" style="width:100%;">
								<tr>
									<thead>
										<tr>
											<th style="border:#999 1px solid; font-size:14px !important;" colspan="4">
												Bank Details:
											</th>
											<th style="border:#999 1px solid; font-size:14px !important;" colspan="4">
												Terms Condition</th>
											<th style="border:#999 1px solid; font-size:14px !important;" colspan="8">
											</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td style="border:#999 1px solid; font-size:14px !important;" colspan="4">
												<li class="color-font"><b>
														Bank Name: &nbsp;&nbsp;
														<?php echo $agentbankdetail->AB_Bank_Name; ?>
												</li>
												<li class="color-font"><b>
														Branch Name: &nbsp;&nbsp;
														<?php echo  $agentbankdetail->AB_Branch;  ?>
												</li>
												<li class="color-font"><b>
														A/c No: &nbsp;&nbsp;
														<?php echo  $agentbankdetail->AB_Ac_No;  ?>
												</li>
												<li class="color-font"><b>
														IFSC Code: &nbsp;&nbsp;
														<?php echo  $agentbankdetail->AB_Ifsc_Code;  ?>
												</li>
											</td>
											<td style="border:#999 1px solid; font-size:14px !important;" colspan="4">
												<?php echo $prodArr[$i]['PD_Cus_Width']; ?>
												<?php echo $prodArr[$i]['UN_Name']; ?><br></a>
											</td>
											<td style="border:#999 1px solid; font-size:14px !important;" colspan="4">
												<div class="col-md-4 col-sm-4 text-left">
													<img src="<?php echo base_url(); ?>assets/admin/images/logo/imgpsh_fullsize_anim.jpg" width="150" height="50" alt="logo" />
												</div>

											</td>
										</tr>
									</tbody>
								</tr>
							</table>
						</div>
						<div class="clearfix"> &nbsp;</div>
						<div class="panel panel-default text-right button-box ">
							<div class="panel-body">
								<?php
								$linkName = $customerdetail->CU_Id;
								?>
								<div>
									<?php
									$status = $vd;
									//print_r($vd);
									if ($status < 2) {
									?>
									<a class="btn btn-danger"
											href="<?php echo AD_BASE_PATH . 'rejected_enquiries/reject_enquiry/' . $linkName; ?>"><i
												class="fa fa-ban"></i> Reject</a>
										<a class="btn btn-primary"
											href="<?php echo AD_BASE_PATH . 'work_order/work_order/' . $linkName . '"'; ?>"><i
												class="fa fa-check"></i> Accept</a>
										<a class="btn btn-primary" href="<?php echo AD_BASE_PATH . 'customer_invoice/e_waybill'; ?>" target="_blank">
											<i class="fa fa-check"></i> Create E waybill
										</a>
									<?php
									}
									?>
									<a class="btn btn-success" onclick="printDiv()"><i class="fa fa-print"></i> PRINT
										INVOICE</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>