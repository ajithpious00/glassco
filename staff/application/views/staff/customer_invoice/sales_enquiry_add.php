<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<form id="salesadd" name="salesadd" class="form-horizontal" method="post"
							enctype="multipart/form-data" autocomplete="off">
							<div class="box-body">
								<div class="form-group">
									<h3 class="card-title">
										<?php if ($data == NULL) {
											echo "Add Sales";
										} else {
											echo "Edit Products";
										} ?>
									</h3>
									<hr>
								</div>
								<div class="col-sm-12">
									<div class="message" align="center" style="display:none;"></div>
								</div>
								<div class="form-group">
									<label for="userPhonse" class="font-color"><b>Select Customer</b></label>
									<select data-live-search="true" id=cuid name="cuid" class="searchform form-control"
										onchange="fetchcust()">
										<option value="" selected>Select Customer</option>
										<?php
										foreach ($customer_name as $cu) {
											?>
											<option value="<?= $cu->CU_Id; ?>"><?= $cu->CU_Phone, ' (', $cu->CU_Name, ')'; ?>
											</option>
											<?php
										}
										?>
									</select>
								</div>
								<div class="form-group">
									<label for="userName" class="font-color"><b>Customer Full Name</b></label>
									<input type="text" class="form-control" id="cusname" name="cusname"
										placeholder="Customer Name" value="">
								</div>
								<div class="form-group">
									<label for="userPhone" class="font-color"><b>Phone Number</b></label>
									<input type="tel" class="form-control" id="phone" name="phone"
										onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
										placeholder="Enter Customer Phone">
								</div>
								<div class="form-group">
									<label for="userAdress" class="font-color"><b>Customer Address</b></label>
									<input type="text" class="form-control" id="adress" name="adress"
										placeholder="Customer Address">
								</div>
								<div class="form-group">
									<label for="userAdress" class="font-color"><b>District</b></label>
									<input type="text" class="form-control" id="district" name="district"
										placeholder="Enter District">
								</div>
								<div class="form-group">
									<label for="userGst" class="font-color"><b>GST Number</b></label>
									<input type="text" class="form-control" id="gst" name="gst"
										placeholder="GST Number(optional)">
								</div>
								<div class="form-group">
									<table class="table table-bordered" id="product_field">
										<tr>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Product Name</b></label>
													<select class="form-control select2" style="width: 90px;"
														name="productname[]" id="productname[]">
														<option value="0">Select</option>
														<?php
														if (count($product) > 0) {

															foreach ($product as $pt) {
																?>
																<option <?php if ($pt->ID == $data['ID']) {
																	echo 'selected';
																} ?>
																	value="<?= $pt->ID; ?>">
																	<?= $pt->Name; ?>
																</option>
																<?php
															}
														}
														?>
													</select>
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Height</b></label>
													<input type="text" class="form-control" id="height[]"
														name="height[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="Height">
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Width</b></label>
													<input type="text" class="form-control" id="width[]" name="width[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="Width">
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Wastage</b></label>
													<input type="text" class="form-control" id="wastage[]"
														name="wastage[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="Wastage">
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Product Unit</b></label>
													<select class="form-control select2" name="unit[]" id="unit[]">
														<option value="0">Select</option>
														<?php
														if (count($product_unit) > 0) {

															foreach ($product_unit as $pu) {
																?>
																<option <?php if ($pu->UN_Id == $data['UN_Id']) {
																	echo 'selected';
																} ?> value="<?= $pu->UN_Id; ?>">
																	<?= $pu->UN_Name; ?>
																</option>
																<?php
															}
														}
														?>
													</select>
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Product Type</b></label>
													<select class="form-control select2" style="width: 90px;"
														name="type[]" id="type[]">
														<option value="">Select</option>
														<?php
														if (count($product_type) > 0) {

															foreach ($product_type as $pt) {
																?>
																<option <?php if ($pt->ID == $data['ID']) {
																	echo 'selected';
																} ?>
																	value="<?= $pt->ID; ?>">
																	<?= $pt->Edge_type; ?>
																</option>
																<?php
															}
														}
														?>
													</select>
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Quantity</b></label>
													<input type="text" class="form-control" id="quantity[]"
														name="quantity[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="Quantity">
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Rate</b></label>
													<input type="text" class="form-control" id="rate[]" name="rate[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="Rate">
												</div>
											</td>
											<td><button type="button" name="addmore" id="addmore"
													class="btn btn-success">Add More</button></td>
										</tr>
									</table>
								</div>
								<div class="form-group">
									<table class="table table-bordered" id="product_field">
										<tr>
											<td>
												<label for="height" class="font-color"><b>Item</b></label>
											</td>
											<td>
												<label for="height" class="font-color"><b>Quantity</b></label>
											</td>
											<td>
												<label for="height" class="font-color"><b>Unit Price</b></label>
											</td>
										</tr>
										<?php
										foreach ($additionalitem as $ai) {
											?>
											<tr>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="item[]" name="item[]"
															value="<?php echo $ai->AU_Item ?>"
															onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															placeholder="Height" readonly>
														<input type="hidden" class="form-control" id="ad_id[]"
															name="ad_id[]" value="<?php echo $ai->AU_Id ?>"
															onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															placeholder="Height" readonly>
													</div>
												</td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="quan[]" name="quan[]"
															onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															placeholder="Quantity">
													</div>
												</td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="unit_price[]"
															name="unit_price[]"
															onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															placeholder="Unit Price">
													</div>
												</td>
											</tr>
											<?php
										}
										?>
									</table>
								</div>
								<button type="button" class="btn btn-primary mr-2" name="save" id="save">Save</button>
								<a href="<?php echo base_url(); ?>customer_invoice"><button type="button"
										class="btn btn-light" name="cancelUser" id="cancelUser">Cancel</button>
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>