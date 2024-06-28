<!-- partial -->
<div class="main-panel">
	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="box-body">
							<div class="row">
								<div class="col-lg-6 grid-margin text-left">
									<h4 class  ="color-font" >Customer </strong> Details</h4>
									<ul class="list-unstyled">
										<li class  ="color-font"><strong>Customer  Name   :&nbsp;&nbsp;</strong><?php echo ucfirst($customerdetail->CU_Name); ?></li>
										<li class  ="color-font"><strong>Customer Phone   :&nbsp;&nbsp;</strong><?php echo $customerdetail->CU_Phone; ?></li>
										<li class  ="color-font"><strong>Customer Address  :&nbsp;&nbsp;</strong><?php echo ucfirst($customerdetail->CU_Address);?></li>
									</ul>
								</div>
								<div class="col-md-6 col-sm-6 text-right">
									<h4 class  ="color-font"><strong>User</strong> Details</h4>
									<ul class="list-unstyled">
										<li class  ="color-font"><strong>User Name :&nbsp;&nbsp;</strong> <?php echo ucfirst($customerdetail->
										US_Name); ?></li>
									</ul>
								</div>
							</div>
							<div class="table-responsive">
								<table class="display dataTable nomargin">
									<thead>
										<tr>
											<th>Product Name</th>
											<th>Height</th>
											<th>Width</th>
											<th>Product Type</th>
											<th>Quantity</th>
											<th>Unit Price</th>
											<!--<th>Total Price</th>-->
										</tr>
									</thead>
									<tbody>
										<?php
											foreach($view_details as $vd){
										?>
										<tr>
											
											<td><?php echo ucfirst($vd->Name); ?><br></a></td>
											<td><?php echo $vd->PD_Height; ?><br></a></td>
											<td><?php echo $vd->PD_Width; ?><br></a></td>
											<td><?php echo $vd->Edge_type; ?><br></a></td>
											<td><?php echo $vd->PD_Quantity; ?><br></a></td>
											<td>₹<?php echo $vd->PD_Price; ?></td>
											<!--<td>₹<?php echo $vd->total_price; ?></td>-->
										</tr>
										<?php 
											}
										?>
									</tbody>
								</table>
							</div>
							<div class="panel panel-default text-right">
								<div class="panel-body">
									<?php 
										$linkName =$customerdetail->CU_Id;
									?>
									<div>
										<a class="btn btn-primary" href="<?php echo AD_BASE_PATH .'sales_enquiries'; ?>"><i class="fa fa-reply"></i> Back</a>
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		