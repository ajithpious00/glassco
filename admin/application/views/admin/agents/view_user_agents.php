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
										Agent Details
									</h3>
									<hr>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">Agent Name : <?php echo $agentDetails->AG_Name; ?> </h5></label>
										</div>

										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">Agent Code : <?php echo $agentDetails->AG_Code; ?> </h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">Bank Name : <?php echo $agentDetails->AB_Bank_Name; ?> <h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">Branch Name : <?php echo $agentDetails->AB_Branch; ?> <h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">A/C No  :  <?php echo $agentDetails->AB_Ac_No; ?>%<h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">IFSC Code  : <?php echo $agentDetails->AB_Ifsc_Code; ?>% <h5></label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">Agent Email : <?php echo $agentDetails->AG_Email; ?> <h5></label>
										</div>	
										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">Phone Number : <?php echo $agentDetails->AG_Phone; ?> <h5></label>
										</div>	
										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">Agent Address : <?php echo $agentDetails->AG_Address; ?><h5></label>
										</div>	
										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">Agent District : <?php echo $agentDetails->AG_District; ?><h5></label>
										</div>
										<div class="form-group">
											<label for="inputEmail3" class="font-color" style="color: black;">Agent PI Code : <?php echo $agentDetails->AG_PI_Code; ?> <h5></label>
										</div>
										<div class="form-group">	
											<a href="<?php echo AD_BASE_PATH .'admin/agents'; ?>">
												<button type="button" class="btn btn-secondary ">Back</button>
											</a>
										</div>
									</div>
								</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>