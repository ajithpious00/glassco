<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<form id="polishadd" name="polishadd" class="form-horizontal" method="post"
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
									<label for="agentName" class="font-color"><b>Polish Name</b></label>
									<input type="text" class="form-control" id="poname" name="poname"
										placeholder="Polish Name">
								</div>
								<div class="form-group">
									<label for="agentName" class="font-color"><b>HSN code</b></label>
									<input type="text" class="form-control" id="pohsn" name="pohsn"
										placeholder="Polish HSN Code">
								</div>
								<div class="form-group">
										<h5 label="inputEmail3" class="control-label"><h5>Status <span class="required">*</span></h5></label>
										<div class="col-sm-20">
											<select class="form-control select2" style="width: 100%;" name="status" id="status">
												<option  <?php if($data['PO_Status'] == 1){ echo 'selected'; } ?> value="1">Active</option>
												<option <?php if($data['PO_Status'] == 2){ echo 'selected'; } ?> value="2">Suspend</option>
											</select>
										</div>
									</div>
								<button type="button" class="btn btn-primary mr-2" name="save" id="save">Save</button>
								<a href="<?php echo base_url(); ?>polish"><button type="button"
										class="btn btn-light" name="cancelUser" id="cancelUser">Cancel</button>
								</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>