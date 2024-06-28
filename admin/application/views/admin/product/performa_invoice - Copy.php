<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row maintitle">
							<div class="col-md-6 col-sm-6 text-left"><img
										src="<?php echo base_url(); ?>assets/admin/images/logo/imgpsh_fullsize_anim.jpg"
										width="300" height="100" alt="logo" />
							</div>
							<div class="col-sm-6 text-right">
								<h5 class="color-font">GLASSCO TUFF</h5>
								<address class="color-font">
									Kappur-Post <br>
									Kanjirathani-679 552<br>
									State Name : Kerala ,Code : 32 <br>
									Email:info@glasscogroup.in/www.glasscogroup.in
								</address>
							</div>
						</div>
						<div class="box-body" id="perfomainvoice">
							<table class="invoice" style="width:100%;">
								<tr>
									<td>
										<div class="row">
											<div class="col-lg-6 grid-margin text-left">
												<h4 class="color-font"><strong>Customer </strong> Details</h4>
												<ul class="list-unstyled">
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
												</ul>
											</div>
										</div>
									</td>
									<!--<td valign="top">
										<div class="row">
											<div class="col-md-12 col-sm-12 text-right">
												<h4 class = "color-font"><strong>User</strong> Details</h4>
												<ul class="list-unstyled">
													<li class = "color-font"><strong>User Name :&nbsp;&nbsp;</strong> <?php echo ucfirst($customerdetail->
														US_Name); ?></li>
													<li class = "color-font"><strong>GSTIN/UIN :&nbsp;&nbsp;</strong>32AAVFG6290P1ZJ</li>
													
												</ul>
											</div>
										</div>
									</td>-->
								</tr>
							</table>
							<div class="color-font">
								<center> <strong>PERFORMA INVOICE
										<hr>
									</strong>
							</div>
							<div class="table-responsive">
								<table class="display dataTable">
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
													echo $customerdetail->Perfoma_Code,'-0',$customerdetail->CU_Id;
												 ?><br>
												<?php
												$PD_Order_Date = date_create($order_number->PD_Order_Date);
												echo date_format($PD_Order_Date, "d-M-Y");
												?>
											</th>
											<th>

											</th>
											<th>&nbsp;</th>
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
												<?php echo $customerdetail->CU_Name; ?>
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
								<center> <strong>Product Details
										<hr>
									</strong>
							</div>
							<div class="table-responsive">
								<table class="display dataTable">
									<thead>
										<tr>
											<th>Product Type</th>
											<th>HSN Code</th>
											<th>Product Name</th>
											<th>Height</th>
											<th>Width</th>
											<th>Height(mm)</th>
											<th>Width(mm)</th>
											<th>Height(mm)</th>
											<th>Width(mm)</th>
											<th>Pieces </th>
											<th>Sq.F</th>
											<th>Sqmtr</th>
											<th>Total Sqmtr</th>
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
										for($i=0; $i<count($prodArr); $i++) {
											
											?>
											<tr>
												<td>
													<?php echo ucfirst($prodArr[$i]['Edge_type']); ?><br></a>
												</td>
												<td>
													<?php echo $prodArr[$i]['HSN_code']; ?><br></a>
												</td>
												<td>
													<?php echo $prodArr[$i]['Name']; ?><br></a>
												</td>
												<td>
													<?php echo $prodArr[$i]['PD_Height_Nl']; ?>
													<?php echo $prodArr[$i]['UN_Name']; ?>
												</td>
												<td>
													<?php echo $prodArr[$i]['PD_Weight_Nl']; ?>
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
												<td>
													<?php echo $heightmm; ?><br></a>
												</td>
												<td>
													<?php echo $widthmm; ?><br></a>
												</td>
												<td>
													<?php echo $heightmm + $prodArr[$i]['PD_waste']; ?><br></a>
												</td>
												<td>
													<?php echo $widthmm + $prodArr[$i]['PD_waste']; ?><br></a>
												</td>
												<td>
													<?php echo $prodArr[$i]['PD_Quantity']; ?><br></a>
												</td>
												<td>
													<?php echo $prodArr[$i]['sqf']; ?><br></a>
												</td>
												<td>
													<?php echo $prodArr[$i]['sqm']; ?><br></a>
												</td>
												<td>
													<?php echo $prodArr[$i]['product_quantity_sqm']; ?><br></a>
												</td>
												<!--<td>₹
													<?php echo $prodArr[$i]['total_price']; ?>
												</td>-->
											</tr>
											<tr>
												<td colspan="14" class="addtinal-block">
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
																	<?php echo $prodArr[$i]['product_adds'][$j]['AD_Quantity']; ?> &nbsp;&nbsp; X &nbsp;&nbsp;
																	<?php echo $prodArr[$i]['product_adds'][$j]['AD_Unit_Price']; ?>&nbsp;&nbsp; = 
																	<?php echo $prodArr[$i]['product_adds'][$j]['listing_price']; ?>
																	
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
										
										
										
										/*foreach ($view_details as $vd) {
											?>
											<tr>
												<td>
													<?php echo $vd->Edge_type ?><br></a>
												</td>
												<td>
													<?php echo ucfirst($vd->Name); ?><br></a>
												</td>
												<td>
													<?php echo $vd->PD_Height_Nl; ?>
													<?php echo $vd->UN_Name ?><br></a>
												</td>
												<td>
													<?php echo $vd->PD_Weight_Nl; ?>
													<?php echo $vd->UN_Name ?><br></a>
												</td>

												<?php
												if ($vd->UN_Id == 1) {
													$heightmm = $vd->PD_Height_Nl * 10;
													$widthmm = $vd->PD_Weight_Nl * 10;
												} elseif ($vd->UN_Id == 2) {
													$heightmm = $vd->PD_Height_Nl * 25.4;
													$widthmm = $vd->PD_Weight_Nl * 25.4;
												} elseif ($vd->UN_Id == 3) {
													$heightmm = $vd->PD_Height_Nl * 304.79999025;
													$widthmm = $vd->PD_Weight_Nl * 304.79999025;
												} else {
													$heightmm = $vd->PD_Height_Nl;
													$widthmm = $vd->PD_Weight_Nl;
												}
												?>
												<td>
													<?php echo $heightmm; ?><br></a>
												</td>
												<td>
													<?php echo $widthmm; ?><br></a>
												</td>
												<td>
													<?php echo $heightmm + $vd->PD_Waste; ?><br></a>
												</td>
												<td>
													<?php echo $widthmm + $vd->PD_Waste ?><br></a>
												</td>
												<td>
													<?php echo $vd->PD_Quantity; ?><br></a>
												</td>
												<td>
													<?php echo $vd->sqf; ?><br></a>
												</td>
												<td>
													<?php echo $vd->sqm; ?><br></a>
												</td>
												<td>
													<?php echo $vd->product_quantity_sqm; ?><br></a>
												</td>
												<!--<td>₹
													<?php echo $vd->total_price; ?>
												</td>-->
											</tr>
											<tr>
												<td colspan="14" class="addtinal-block">
													<div class="row">
														<?php 
														$coldiv = count($additional_details)/3;
														$slno=1;
														foreach ($additional_details as $ad) {
															if($slno==1) {
																echo '<div class="col-md-4">';
															}
															?>
																<div class="col-md-12 addt-item">
																	<b><?php echo $ad->AU_Item ,$ad->SP_Id?>: &nbsp;&nbsp;</b>
																	<?php echo $ad->AD_Quantity ?> &nbsp;&nbsp; X &nbsp;&nbsp;
																	<?php echo $ad->AD_Unit_Price ?>&nbsp;&nbsp; = 
																	<?php echo $ad->listing_price ?></strong>
																	
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
										}*/
										?>
									</tbody>
								</table>
							</div>
							<hr class="nomargin-top">
							<div class="row">
								<div class="col-sm-6 text-left">
									<ul class="list-unstyled">
									<li class="color-font"><b>
												<h5>Total Quantity  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>
											<?php echo $total_sqmtr; ?>.Sqmtr
										</li>
										<li class="color-font"><b>
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
										<li class="color-font"><b>
												<h5>Total Taxable Amount: &nbsp;&nbsp;
											</b>₹
											<?php echo $taxable_amounts; ?>
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
										<li class="color-font"><b>CGST@ 9% :&nbsp;&nbsp;</b>₹
											<?php echo $cgst; ?>
										</li>
										<li class="color-font"><b>SGST@ 9% :&nbsp;&nbsp;</b>₹
											<?php echo $sgst; ?>
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
										<li class="color-font"><b>
												<h5>Rate(1sqrmtr)  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹
											<?php echo $price; ?>
										</li>
										<li class="color-font"><b>
												<h5>Net Price  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹<?php echo $net_price; ?>
										</li>
										<!---<li class="color-font"><b>
												<h5>Polish Rate  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹<?php echo $polish_rate; ?>
										</li>-->
										<!--<li class="color-font"><b>
												<h5>Net Polish Rate  :&nbsp;&nbsp;&nbsp;&nbsp;
											</b>₹<?php echo $net_polish_rate; ?>
										</li>-->
										<!--<li class="color-font"><b>ROUND OFF: &nbsp;&nbsp;</b></strong>-->
										<li class="color-font"><b>
												<h5>Total Additional Charges: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_additional_charges; ?>
										</li>
										<li class="color-font"><b>
												<h5>Total Tax Amount: &nbsp;&nbsp;
											</b>₹
											<?php echo $total_tax; ?>
										</li>
										<li class="color-font"><b>
												<h4>Grand Total: &nbsp;&nbsp;
											</b>₹
											<?php echo $grand_total; ?>
										</li>
									</ul>
								</div>
								
							</div>
						</div>
						<div class="panel panel-default text-right button-box ">
							<div class="panel-body">
								<?php
								$linkName = $customerdetail->CU_Id;
								?>
								<div>
									<?php
									$status = $vd->PD_Status;
									if ($status < 2) {
										?>
										<a class="btn btn-danger"
											href="<?php echo AD_BASE_PATH . 'rejected_enquiries/reject_enquiry/' . $linkName; ?>"><i
												class="fa fa-ban"></i> Reject</a>
										<a class="btn btn-primary"
											href="<?php echo AD_BASE_PATH . 'work_order/work_order/' . $linkName . '"'; ?>"><i
												class="fa fa-check"></i> Accept</a>
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