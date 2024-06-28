<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<form id="salesadd" name="salesadd" class="form-horizontal" method="post" enctype="multipart/form-data" autocomplete="off">
							<div class="box-body">
								<div class="form-group">
									<h3 class="card-title">
										Edit Sales
									</h3>
									<hr>
								</div>
								<div class="col-sm-12">
									<div class="message" align="center" style="display:none;"></div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="userName" class="font-color"><b>Customer Full Name</b></label>
											<input type="text" class="form-control" id="cusname" name="cusname" placeholder="Customer Name" value="<?php echo $customerdetail->CU_Name; ?>" tabindex="2">
											<input type="text" class="form-control" id="cuid" name="cuid" value="<?php echo $customerdetail->CU_Id; ?>" hidden>
										</div>
										<div class="form-group">
											<label for="userPhone" class="font-color"><b>Phone Number</b></label>
											<input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $customerdetail->CU_Phone; ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Enter Customer Phone" tabindex="3">
										</div>
										<div class="form-group">
											<label for="userGst" class="font-color"><b>GST Number</b></label>
											<input type="text" class="form-control" id="gst" value="<?php echo $customerdetail->CU_Gst_No; ?>" name="gst" placeholder="GST Number(optional)" tabindex="6">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="userAdress" class="font-color"><b>Customer Address</b></label>
											<textarea class="form-control" id="adress" name="adress" placeholder="Customer Address" tabindex="4" rows="4"><?php echo $customerdetail->CU_Address; ?></textarea>
										</div>
										<div class="form-group">
											<label for="userAdress" class="font-color"><b>Delivery Address</b></label>
											<textarea class="form-control" id="deliveryadress" name="deliveryadress" placeholder="Delivery Address" tabindex="7" rows="4"><?php echo $customerdetail->CU_Delivery_Address; ?></textarea>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="agent" class="font-color"><b>Agent</b></label>
											<select class="form-control select2 mb-2" name="agent" id="agent">
												<option value="0">Select</option>
												<?php
												if (count($agent) > 0) {

													foreach ($agent as $at) {
												?>
														<option <?php if ($at->AG_Id == $customerdetail->AG_Id) {
																	echo 'selected';
																} ?> value="<?= $at->AG_Id; ?>">
															<?= $at->AG_Name; ?>
														</option>
												<?php
													}
												}
												?>
											</select>
											<div class="form-group">
												<label for="userAdress" class="font-color"><b>District</b></label>
												<input type="text" class="form-control" id="district" value="<?php echo $customerdetail->CU_District; ?>" name="district" placeholder="Enter District" tabindex="5">
											</div>
											<div class="form-group">
												<label for="userAdress" class="font-color"><b>Delivery Date</b></label>
												<input type="text" class="form-control" id="deliverydate" value="<?php echo $customerdetail->CU_Delivered_at; ?>" name="deliverydate" placeholder="Delivery Date" tabindex="7">
											</div>
										</div>
									</div>
								</div>
								<?php $i = 0 ?>
								<?php foreach ($additional_details as $ad) : ?>
									<div class="form-group" style="overflow-x:auto;">
										<table class="table table-bordered" id="product_field">
											<tr class="copy1-<?= $i ?>">
												<td class="t1" colspan="3">
													<div class="form-group">
														<label for="productname" class="font-color"><b>Product Name</b></label>
														<select class="form-control select2 prodname" name="productname[]" id="productname[]">
															<option value="">Select</option>
															<?php if (count($product) > 0) : ?>
																<?php foreach ($product as $pt) : ?>
																	<option <?php if ($pt->ID == $ad['PD_Id']) echo 'selected'; ?> value="<?= $pt->ID; ?>">
																		<?= $pt->PD_Name; ?>
																	</option>
																<?php endforeach; ?>
															<?php endif; ?>
														</select>
													</div>
												</td>
												<td class="t1">
													<div class="form-group">
														<label for="rate" class="font-color"><b>Product Rate</b></label>
														<input type="text" class="form-control pdrate" id="rate[]" name="rate[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Rate" value="<?= $ad['PD_Price']; ?>">
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="type" class="font-color"><b>Product Type</b></label>
														<select class="form-control select2" name="type[]" id="type[]">
															<option value="">Select</option>
															<?php if (count($product_type) > 0) : ?>
																<?php foreach ($product_type as $pt) : ?>
																	<option <?php if ($pt->ID == $ad['ED_Id']) echo 'selected'; ?> value="<?= $pt->ID; ?>">
																		<?= $pt->Edge_type; ?>
																	</option>
																<?php endforeach; ?>
															<?php endif; ?>
														</select>
													</div>
												</td>
												<td colspan="5"></td>
											</tr>
											<tr class="copy2-<?= $i ?>">
												<td class="t1">
													<div class="form-group">
														<label for="potype" class="font-color"><b>Polish Type</b></label>
														<select class="form-control select2 polishType" name="potype[]" id="potype[]">
														<option value="">Select</option>
														<?=$polish_type?>
															<?php if (count($polish_type) > 0) : ?>
																<?php foreach ($polish_type as $pot) : ?>
																	<option <?php if ($pot->PO_Id == $ad['PO_Id']) echo 'selected'; ?> value="<?= $pot->PO_Id; ?>">
																		<?= $pot->PO_Name; ?>
																	</option>
																<?php endforeach; ?>
															<?php endif; ?>
														</select>
													</div>
												</td>
												<td class="t1">
													<div class="form-group">
														<label for="polishrate" class="font-color"><b>Polish Rate</b></label>
														<input type="text" class="form-control porate" id="polishrate[]" name="polishrate[]" placeholder="Polish Rate" value="<?= $ad['PI_Rate']; ?>">
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="height" class="font-color"><b>Height</b></label>
														<input type="text" class="form-control ht" id="height[]" name="height[]" value="<?= $ad['PD_Cus_Height']; ?>" placeholder="Height" onkeyup="nlCals(this.value, this, 'htnl');">
													</div>
												</td>
												<td class="hidden-td">
													<div class="form-group">
														<label for="heightnl" class="font-color"><b>HeightNL</b></label>
														<input type="text" class="form-control htnl" id="heightnl[]" name="heightnl[]" placeholder="HeightNL" value="<?= $ad['PD_Height_Nl']; ?>">
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="width" class="font-color"><b>Width</b></label>
														<input type="text" class="form-control wt" id="width[]" name="width[]" placeholder="Width" onkeyup="nlCals(this.value, this, 'wtnl');" value="<?= $ad['PD_Cus_Width']; ?>">
													</div>
												</td>
												<td class="hidden-td">
													<div class="form-group">
														<label for="widthnl" class="font-color"><b>WidthNL</b></label>
														<input type="text" class="form-control wtnl" id="widthnl[]" name="widthnl[]" placeholder="WidthNL" value="<?= $ad['PD_Weight_Nl']; ?>">
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="wastage" class="font-color"><b>Wastage</b></label>
														<input type="text" class="form-control" value="<?= $ad['PD_Waste']; ?>" id="wastage[]" name="wastage[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Wastage">
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="unit" class="font-color"><b>Product Unit</b></label>
														<select class="form-control select2" name="unit[]" id="unit[]">
															<option value="">Select</option>
															<?php if (count($product_unit) > 0) : ?>
																<?php foreach ($product_unit as $pu) : ?>
																	<option <?php if ($pu->UN_Id == $ad['PD_Unit']) echo 'selected'; ?> value="<?= $pu->UN_Id; ?>">
																		<?= $pu->UN_Name; ?>
																	</option>
																<?php endforeach; ?>
															<?php endif; ?>
														</select>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label for="quantity" class="font-color"><b>Quantity</b></label>
														<input type="text" class="form-control" id="quantity[]" name="quantity[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Quantity" value="<?= $ad['PD_Quantity']; ?>">
													</div>
												</td>
												<td style="width: 72px;">
													<button type="button" name="remove" id="'<?= $i ?>'" data-p="'<?= $i ?>'" class="btn btn-danger btn_remove" style="width: 72px;">X</button>
												</td>
												<td><button type="button" name="remove" id="<?= $i ?>" data-p="<?= $i ?>" class="btn btn-primary btn_copy" style="width: 40px;" onclick="copyThis(this);">
														<i class="fa fa-copy"></i>
													</button></td>
											</tr>
											<tr class="copy3-<?= $i ?>">
												<td colspan="11">
													<div class="">
														<div class="row">
															<?php
															$i = 1;
															foreach ($ad['additional_details'] as $ai) {
																if ($i == 1) {
															?>
																	<div class="col-md-3">
																	<?php } ?>
																	<div class="row">
																		<div class="col-md-4">
																			<input type="text" class="form-control" id="item[]" name="item[]" value="<?php echo $ai['AU_Item'] ?>" readonly>
																			<input type="hidden" class="form-control" id="ad_id[]" name="ad_id[]" value="<?php echo $ai['AU_Id'] ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" readonly>
																		</div>
																		<div class="col-md-4">
																			<input type="text" class="form-control" id="quan" name="quan[]" value="<?php echo $ai['AD_Quantity'] ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Quantity">
																		</div>
																		<div class="col-md-4">
																			<input type="text" class="form-control" id="unit_price" name="unit_price[]" placeholder="Unit Price" value="<?php echo $ai['AD_Unit_Price'] ?>">
																		</div>
																	</div>
																	<?php
																	if ($i == 1) {
																		$i = 0;
																	?>
																	</div>
															<?php
																	}
																	$i++;
																}
															?>
														</div>
													</div>
												</td>
											</tr>
										</table>
									</div>
									<?php $i++ ?>
								<input type="text" class="form-control" id="status" name="status" value="<?php echo $ad['PD_Status'] ?>" hidden>
								<?php endforeach; ?>
								<div class="product-add-ons" style="display: none;">
									<div class="row">
										<?php
										$i = 1;
										foreach ($additionalitem as $ai) {
											if ($i == 1) {
										?>
												<div class="col-md-3">
												<?php } ?>
												<div class="row">
													<div class="col-md-4">
														<input type="text" class="form-control" id="item[]" name="item[]" value="<?php echo $ai->AU_Item_Short ?>" readonly>
														<input type="hidden" class="form-control" id="ad_id[]" name="ad_id[]" value="<?php echo $ai->AU_Id ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" readonly>
													</div>
													<div class="col-md-4">
														<input type="text" class="form-control" id="quan[]" name="quan[]" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Quantity">
													</div>
													<div class="col-md-4">
														<input type="text" class="form-control" id="unit_price[]" name="unit_price[]" placeholder="Unit Price">
													</div>
												</div>
												<?php
												if ($i == 1) {
													$i = 0;
												?>
												</div>
										<?php
												}
												$i++;
											}
										?>
									</div>
								</div>
								<div class="form-group" style="overflow-x:auto;">
									<table class="table table-bordered" id="product_field">
										<tr class="prod-head">
											<td>
												<label for="height" class="font-color"><b>Item</b></label>
											</td>
											<td>
												<label for="height" class="font-color"><b>Unit Price</b></label>
											</td>
										</tr>
										<?php
										foreach ($additional_add as $ai) {
										?>
											<tr>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="item2[]" name="item2[]" value="<?php echo $ai->AU_Item ?>" readonly>
														<input type="hidden" class="form-control" id="ad_id2[]" name="ad_id2[]" value="<?php echo $ai->AU_Id ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" readonly>
													</div>
												</td>

												<input type="hidden" class="form-control" id="quan2[]" name="quan2[]" value="<?php echo $ai->AD_Quantity ?>" placeholder="Quantity">

												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="unit_price2[]" name="unit_price2[]" placeholder="Unit " value="<?php echo $ai->AD_Unit_Price ?>">
													</div>
												</td>
											</tr>
										<?php
										}
										?>
									</table>
								</div>
								<div class="form-group">
									<label for="rate" class="font-color"><b>Delivery type</b></label>
									<div class="col-sm-4">
										<select class="form-control select2" name="cutting_type" id="cutting_type">
											<option <?php if ($customerdetail->SP_Type == 1) {
														echo 'selected';
													} ?> value="1">normal</option>
											<option <?php if ($customerdetail->SP_Type == 2) {
														echo 'selected';
													} ?> value="2">Fast</option>
										</select>
									</div>
								</div>
								<button type="button" name="addmore" id="addmore" class="btn btn-success">Add More (Cntrl + Enter)</button>
								<button type="button" class="btn btn-primary mr-2" name="save" id="save">Save</button>
								<a href="<?php echo base_url(); ?>sales_enquiries"><button type="button" class="btn btn-light" name="cancelUser" id="cancelUser">Cancel</button>
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>