<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<form id="salesedit" name="salesedit" class="form-horizontal" method="post"
							enctype="multipart/form-data" autocomplete="off">
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
								<div class="form-group">
									<label for="userName" class="font-color"><b>Customer Name</b></label>
									<input type="text" class="form-control" id="cusname" name="cusname"
										placeholder="Customer Name" value="<?php echo $customerdetail->CU_Name; ?>">
										<input hidden type="text" class="form-control" id="id" name="id"
										 value="<?php echo $customerdetail->CU_Id; ?>">
								</div>
								<div class="form-group">
									<label for="userPhone" class="font-color"><b>Phone Number</b></label>
									<input type="text" class="form-control" id="phone" name="phone"
										onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
										placeholder="Enter Customer Phone"
										value="<?php echo $customerdetail->CU_Phone; ?>">
								</div>
								<div class="form-group">
									<label for="userAdress" class="font-color"><b>Customer Adress</b></label>
									<input type="text" class="form-control" id="adress" name="adress"
										placeholder="Customer Adress"
										value="<?php echo $customerdetail->CU_Address; ?>">
								</div>
								<div class="form-group">
									<table class="table table-bordered" id="product_field">
										<tr>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Product Name</b></label>
													<select class="form-control select2" name="productname1[]"
														id="productname1[]">
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
													<input type="text" class="form-control" id="height1[]"
														name="height1[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="Height">
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>width</b></label>
													<input type="text" class="form-control" id="width1[]" name="width1[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="width">
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Product Unit</b></label>
													<select class="form-control select2" name="unit1[]" id="unit1[]">
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
													<label for="height" class="font-color"><b>Quantity</b></label>
													<input type="text" class="form-control" id="quantity1[]"
														name="quantity1[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="Quantity">
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Rate</b></label>
													<input type="text" class="form-control" id="rate1[]" name="rate1[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="Rate">
												</div>
											</td>
											<td><button type="button" name="addmore" id="addmore"
													class="btn btn-success">Add More</button></td>
										</tr>
										<?php
										foreach ($view_details as $vd) {
											?>
											<tr id="rows<?php echo $id ?>">
												<td>
													<div class="form-group">
														<select class="form-control select2" name="productname[]"
															id="productname[]">
															<?php
															if (count($product) > 0) {

																foreach ($product as $pt) {
																	?>
																	<option <?php if ($pt->ID == $vd->PD_Id) {
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
														<input type="text" class="form-control" id="height[]"
															name="height[]"
															onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															placeholder="Height" value="<?php echo $vd->PD_Height; ?>">
													</div>
												</td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="width[]" name="width[]"
															onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															placeholder="width" value="<?php echo $vd->PD_Width; ?>">
													</div>
												</td>
												<td>
													<div class="form-group">
														<select class="form-control select2" name="unit[]" id="unit[]">
															<?php
															if (count($product_unit) > 0) {

																foreach ($product_unit as $pu) {
																	?>
																	<option <?php if ($pu->UN_Id == $vd->PD_Unit) {
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
														<input type="text" class="form-control" id="quantity[]"
															name="quantity[]"
															onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															placeholder="Quantity" value="<?php echo $vd->PD_Quantity; ?>">
													</div>
												</td>
												<td>
													<div class="form-group">
														<input type="text" class="form-control" id="rate[]" name="rate[]"
															onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															placeholder="Rate" value="<?php echo $vd->PD_Price; ?>">
															<input type="text" class="form-control" id="pid[]" name="pid[]"hidden
															onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
															placeholder="Rate" value="<?php echo $vd->SP_Id; ?>">
													</div>
												</td>
												</td>
												<td>
												<div class="form-group">
													<button onclick="removerow(<?php echo $vd->SP_Id; ?>)" name="remove"<?php echo $vd->SP_Id;?>"'<?php echo $id ?>'"
														class="btn btn-danger btnremove" style="width: 82px;">X</button>
														</div>
												</td>
											</tr>
											<?php
										}
										?>
									</table>
								</div>
								<button type="button" class="btn btn-primary mr-2" name="save" id="save">Save</button>
								<a href="<?php echo base_url(); ?>sales_enquiries"><button type="button"
										class="btn btn-light" name="cancelUser" id="cancelUser">Cancel</button>
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>