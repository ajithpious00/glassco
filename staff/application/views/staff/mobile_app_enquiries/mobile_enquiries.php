<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<form id="rate" name="rate" class="form-horizontal" method="post"
							enctype="multipart/form-data" autocomplete="off">
							<div class="box-body">
								<div class="form-group">
									<h3 class="card-title">
										Add Rate 
									</h3>
									<hr>
								</div>
								<div class="col-sm-12">
									<div class="message" align="center" style="display:none;"></div>
								</div>
								<div class="form-group">
									<label for="userName" class="font-color"><b>Customer Name</b></label>
									<input type="text" class="form-control"
										value="<?php echo $customerdetail->CU_Name; ?>" readonly>
								</div>
								<div class="form-group">
									<label for="userPhone" class="font-color"><b>Phone Number</b></label>
									<input type="text" class="form-control"
										value="<?php echo $customerdetail->CU_Phone; ?>" readonly>
								</div>
								<div class="form-group">
									<label for="userAdress" class="font-color"><b>Customer Adress</b></label>
									<input type="text" class="form-control"
										value="<?php echo $customerdetail->CU_Address; ?>" readonly>
								</div>
								<div class="form-group">
									<table class="table table-bordered" id="product_field">
									<?php
											foreach($view_details as $vd){
										?>
										<tr>
											<td>
												<div class="form-group">
												<label for="height" class="font-color"><b>Product Name</b></label>
													<select class="form-control select2" name="productname[]"
														id="productname[]" readonly>
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
													<label for="height" class="font-color"><b>Height</b></label>
													<input type="text" class="form-control" value="<?php echo $vd->PD_Height; ?>"readonly>
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>width</b></label>
													<input type="text" class="form-control" value="<?php echo $vd->PD_Width; ?>"readonly>
												</div>
											</td>
											<td>
												<div class="form-group">
												<label for="height" class="font-color"><b>Product Unit</b></label>
													<select class="form-control select2" name="unit[]" id="unit[]" readonly>
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
													<label for="height" class="font-color"><b>Quantity</b></label>
													<input type="text" class="form-control" value="<?php echo $vd->PD_Quantity; ?>"readonly>
												</div>
											</td>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Rate</b></label>
													<input type="text" class="form-control" id="rate[]" name="rate[]"
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														placeholder="Rate">
														<input hidden type="text" class="form-control" id="id[]" name="id[]" 
														onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
														value="<?php echo $vd->SP_Id; ?>">
												</div>
											</td>
										</tr>
										<?php 
											}
										?>
									</table>
								</div>
								<button type="button" class="btn btn-primary mr-2" name="save" id="save">Save</button>
								<a href="<?php echo base_url(); ?>mobile_app_enquiries"><button type="button"
										class="btn btn-light" name="cancelUser" id="cancelUser">Cancel</button>
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>