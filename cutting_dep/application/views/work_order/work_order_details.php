<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row maintitle">
							<div class="col-md-6 col-sm-6 text-left">
								<img src="<?php echo base_url(); ?>assets/images/logo/imgpsh_fullsize_anim.jpg"
									width="300" height="100" alt="logo" />
							</div>
							<div class="col-sm-6 text-right">
								<h5 class="color-font">GLASSCO TUFF</h5>
								<address class="color-font">
									<h4 class="color-font"><strong>User</strong> Details</h4>
									<ul class="list-unstyled">
										<li class="color-font"><strong>User Name :&nbsp;&nbsp;</strong>
											<?php echo ucfirst($customerdetail->
												US_Name); ?>
										</li>

									</ul>
								</address>
							</div>
						</div>
						<div class="box-body">
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
													<li class="color-font"><strong>Order No :&nbsp;&nbsp;</strong>
														<?php echo $order_number->PD_Order_No; ?>
													</li>
													<li class="color-font"><strong>Order Date :&nbsp;&nbsp;</strong>
														<?php echo date("d-m-Y", strtotime($order_number->PD_Order_Date)); ?>
													</li>
												</ul>
											</div>
										</div>
									</td>
								</tr>
							</table>

							<div class="color-font">
								<center> <strong>WORK ORDER INFORMATION
										<hr>
									</strong>
							</div>
							<div class="table-responsive">
								<table class="display dataTable">
									<thead>
										<th>Product Type</th>
										<th>Product Name</th>
										<th>Height</th>
										<th>Width</th>
										<th>Height(mm)</th>
										<th>Width(mm)</th>
										<th>Quantity</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($view_details as $vd) {
											?>
											<tr>
												<td>
													<?php echo $vd->Edge_type ?><br></a>
												</td>
												<td>
													<?php echo ucfirst($vd->Name); ?><br></a>
												</td>
												<td>
													<?php echo $vd->PD_Height; ?>
													<?php echo $vd->UN_Name ?><br></a>
												</td>
												<td>
													<?php echo $vd->PD_Width; ?>
													<?php echo $vd->UN_Name ?><br></a>
												</td>
												<?php
												if ($vd->UN_Id == 1) {
													$heightmm = $vd->PD_Height * 10;
													$widthmm = $vd->PD_Width * 10;
												} elseif ($vd->UN_Id == 2) {
													$heightmm = $vd->PD_Height * 25.4;
													$widthmm = $vd->PD_Width * 25.4;
												} elseif ($vd->UN_Id == 3) {
													$heightmm = $vd->PD_Height * 304.79999025;
													$widthmm = $vd->PD_Width * 304.79999025;
												} else {
													$heightmm = $vd->PD_Height;
													$widthmm = $vd->PD_Width;
												}
												?>
												<td>
													<?php echo $heightmm; ?>.mm<br></a>
												</td>
												<td>
													<?php echo $widthmm; ?>.mm<br></a>
												</td>
												<td>
													<?php echo $vd->PD_Quantity; ?><br></a>
												</td>
											</tr>
											<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<hr class="nomargin-top">
							<div class="row">
								<div class="col-sm-6 color-font text-left">
									<ul class="list-unstyled">
										<li class="color-font"><strong>
												<h5>Additional Details
											</strong></li>
										<?php
										foreach ($additional_details as $ad) {
											?>
											<li class="color-font"><b>
													<?php echo $ad->AU_Item ?>: &nbsp;&nbsp;
												</b>
												<?php echo $ad->AD_Quantity ?> &nbsp;&nbsp; X &nbsp;&nbsp;
												<?php echo $ad->AD_Unit_Price ?></strong>
											</li>
											<?php
										}
										?>
									</ul>
								</div>
							</div>
						</div>
						<div class="panel panel-default text-right button-box">
							<div class="panel-body">
								<?php
								$linkName = $customerdetail->CU_Id;
								?>
								<div>
									<a class="btn btn-warning"
										href="<?php echo base_url() . 'workorder/work_order_sticker/' . $linkName; ?>"><i
											class="fa fa-print"></i> PRINT STICKER</a>
									<a class="btn btn-success" onclick="printDiv()"><i class="fa fa-print"></i> PRINT
										INVOICE</a>
									<button onClick="complete('<?php echo $order_number->PD_Order_No; ?>')"
										class="btn btn-primary" id="<?php echo $order_number->PD_Order_No; ?>"><i
											class="fa fa-check-circle"></i> COMPLETE</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>