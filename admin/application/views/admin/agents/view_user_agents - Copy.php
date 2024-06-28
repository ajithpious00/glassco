<!-- partial -->
<div class="wrapper wrapper-content">
	<div class="container">
		<div class="main-panel">
			<div class="content-wrapper">
				<div class="row">
					<div class="col-lg-6 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<form id="order" name="order" class="form-horizontal" method="post" enctype="multipart/form-data" autocomplete="off">
									<div class="box-body">
										<div class="form-group">
											<h3><?php if($data == NULL){ echo "Orders Details";}else{echo "Edit Inventory";}?></h3>
											<hr>
											
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>Agent Name : <?php echo $agentDetails->AG_Name; ?> </h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>Agent Code : <?php echo $agentDetails->AG_Code; ?> <h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>Bank Name : <?php echo $agentDetails->AB_Bank_Name; ?> <h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>Branch Name : <?php echo $agentDetails->AB_Branch; ?> <h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>A/C No  :  <?php echo $agentDetails->AB_Ac_No; ?>%<h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>IFSC Code  : <?php echo $agentDetails->AB_Ifsc_Code; ?>% <h5></label>
										</div>
											
									</div>
							</div><!-- /.box-body -->
						</div>
					</div>
					<div class="col-lg-6 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
									<div class="box-body">
										<div class="form-group">
											<h3><?php if($data == NULL){ echo "Order Items";}?></h3>
											<hr>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>Agent Email : <?php echo $agentDetails->AG_Email; ?> <h5></label>
										</div>	
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>Phone Number : <?php echo $agentDetails->AG_Phone; ?> <h5></label>
										</div>	
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>Agent Address : <?php echo $agentDetails->AG_Address; ?><h5></label>
										</div>	
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>Agent District : <?php echo $agentDetails->AG_District; ?><h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="control-label"><h5>Agent PI Code : <?php echo $agentDetails->AG_PI_Code; ?><h5></label>
										</div>
										<div class="form-group">	
											<a href="<?php echo AD_BASE_PATH .'orders'; ?>">
												<button type="button" class="btn btn-secondary ">Back</button>
											</a>
										</div>
									</form>
								</div><!-- /.box-body -->
							</div>
						</div>
					</div><!-- /.content-wrapper -->
				</div>
			</div>
		</div>
	</div>
 </div>