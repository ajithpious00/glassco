<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<form id="agentadd" name="agentadd" class="form-horizontal" method="post"
							enctype="multipart/form-data" autocomplete="off">
							<div class="box-body">
								<div class="form-group">
									<h3 class="card-title">
										<?php if ($data == NULL) {
											echo "Add Agents";
										} else {
											echo "Edit Agents";
										} ?>
									</h3>
									<hr>
								</div>
								<div class="col-sm-12">
									<div class="message" align="center" style="display:none;"></div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="agentName" class="font-color"><b>Agent Name</b></label>
											<input type="text" class="form-control" id="agname" name="agname" placeholder="Agent Name">
										</div>
										<div class="form-group">
											<label for="agentName" class="font-color"><b>Agent code</b></label>
											<input type="text" class="form-control" id="agcode" name="agcode" placeholder="Agent Code">
										</div>
										<div class="form-group">
											<label for="agentPhone" class="font-color"><b>Bank Name</b></label>
											<input type="tel" class="form-control" id="bankname" name="bankname"
												   placeholder="Bank Name">
										</div>
										<div class="form-group">
											<label for="agentPhone" class="font-color"><b>Branch Name</b></label>
											<input type="tel" class="form-control" id="branchname" name="branchname"
												   placeholder="Branch Name">
										</div>
										<div class="form-group">
											<label for="agentPhone" class="font-color"><b>A/C No</b></label>
											<input type="tel" class="form-control" id="acno" name="acno"
												placeholder="Enter A/c No">
										</div>
										<div class="form-group">
											<label for="agentPhone" class="font-color"><b>IFSC Code</b></label>
											<input type="tel" class="form-control" id="ifsc" name="ifsc"
												  placeholder="Enter IFSC Code">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="agentAdress" class="font-color"><b>Agent Email</b></label>
											<input type="text" class="form-control" id="email" name="email" placeholder="Agent Email">
										</div>
										<div class="form-group">
											<label for="agentPhone" class="font-color"><b>Phone Number</b></label>
											<input type="tel" class="form-control" id="phone" name="phone"
												   onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
												   placeholder="Enter Customer Phone">
										</div>
										<div class="form-group">
											<label for="agentAdress" class="font-color"><b>Agent Address</b></label>
											<input type="text" class="form-control" id="adress" name="adress" placeholder="Agent Address">
										</div>
										<div class="form-group">
											<label for="userAdress" class="font-color"><b>District</b></label>
											<input type="text" class="form-control" id="district" name="district" placeholder="Enter District">
										</div>
										<div class="form-group">
											<label for="agentName" class="font-color"><b>Agent PI code</b></label>
											<input type="text" class="form-control" id="agpicode" name="agpicode" placeholder="Agent PI Code">
										</div>
										<div class="form-group">
											<label label="inputEmail3" class="control-label">
												<h5>Status <span class="required">*</span></h5>
											</label>
												<select class="form-control select2" style="width: 100%;" name="status" id="status">
													<option <?php if($data['AG_Status'] == 1) { echo 'selected'; } ?> value="1">Active</option>
													<option <?php if($data['AG_Status'] == 2) { echo 'selected'; } ?> value="2">Suspend</option>
												</select>
											
										</div>
									</div>
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