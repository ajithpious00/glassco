
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                 <!-- <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Form elements</li>-->
                </ol>
              </nav>
            </div>
			
            <div class="row">
             
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Add Product</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                        
                    <form class="forms-sample" name="productForm" id="productForm" method="post">
					<!--<div class="form-group">
					<label for="brandName">Choose Brand</label>
                        <br><select id="brandName" name="brandName" class="form-control">
						<option value="">Select</option>
							<?php
						  foreach($brname as $row)
						  {
						     ?>
							<option value="<?php echo $row->ID;?>"><?php echo $row->Name;?></option>
							<?php
						  }
						  ?>
						</select>
                      </div>-->
                      <div class="form-group">
                        <label for="productCode">Product Code</label>
                        <input type="text" class="form-control" id="productCode" name="productCode" placeholder="Enter the Product Code">
                      </div>
					  <div class="form-group">
                        <label for="productCode">HSN Code</label>
                        <input type="text" class="form-control" id="hsncode" name="hsncode" placeholder="Enter the HSN Code">
                      </div>
					  <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter the Product Name">
                      </div>
					 <!-- <div class="form-group">
					  <label for="categoryName">Choose Category</label>
                        <br><select id="categoryName" name="categoryName" class="form-control" onchange="getsubcat(this.value)">
						<option value="">Select</option>
							<?php
						  foreach($ctname as $row)
						  {
						     ?>
							<option value="<?php echo $row->ID;?>"><?php echo $row->Name;?></option>
							<?php
						  }
						  ?>
						</select>
                      </div>-->
					 <!-- <div class="form-group">
                        <label for="subcategoryName">Choose Sub Category</label>
                        <br><select id="subcategoryName" name="subcategoryName" class="form-control">
						<option value="">Select</option>
						</select>
                      </div>
					    <div class="form-group">
                        <label for="stockAvailability">Available Stock</label>
                        <input type="text" class="form-control" id="stockAvailability" name="stockAvailability" placeholder="Enter Available Stock">
                      </div>-->
					  <div class="form-group">
                        <label for="productUnitPrice">Product Price</label>
                        <input type="text" class="form-control" id="productUnitPrice" name="productUnitPrice" placeholder="Enter Unit Price">
                      </div>
					  <div class="form-group">
									<table class="table table-bordered" id="polish_field">
										<tr>
											<td>
												<div class="form-group">
													<label for="height" class="font-color"><b>Polish  Type</b></label>
													<select class="form-control select2" style="width: 300px;"
														name="polishtype[]" id="polishtype[]">
														<option value="0">Select</option>
														<?php 
													if (count($polish_type) > 0) {

															foreach($polish_type as $po) {  print_r(($po->PO_Id == $data['PO_Id']));
																?>

																<option <?php if($po->PO_Id == $data['PO_Id']) {
																	echo 'selected';
																} ?>
																	value="<?= $po->PO_Id; ?>">
																	<?= $po->PO_Name; ?>
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
													<label for="rate" class="font-color"><b>Rate</b></label>
													<input type="text" class="form-control" id="polishrate[]"
														name="polishrate[]"
														placeholder="Polish Rate">
												</div>
											</td>
											<td>
											<button type="button" name="addmore" id="addmore" class="btn btn-success">Add More</button>
											</td>
										</tr>
									</table>
								</div>
					 <!-- <div class="form-group">
                        <label for="productMRP">MRP</label>
                        <input type="text" class="form-control" id="productMRP" name="productMRP" placeholder="Enter MRP">
                      </div>
					  <div class="form-group">
                        <label for="productWidth">Width in MM</label>
                        <input type="text" class="form-control" id="productWidth" name="productWidth" placeholder="Enter the Width in MM">
                      </div>
					  <div class="form-group">
                        <label for="productHeight">Height in MM</label>
                        <input type="text" class="form-control" id="productHeight" name="productHeight" placeholder="Enter the Height in MM">
                      </div>
					  
					   <div class="form-group">
                        <label for="productThickness">Thickness in MM</label>
                        <input type="text" class="form-control" id="productThickness" name="productThickness" placeholder="Enter the Thickness in MM">
                      </div>-->
					  <button type="button" class="btn btn-primary mr-2" name="saveProduct" id="saveProduct">Save</button>
                      <a href="<?php echo base_url(); ?>admin/viewproduct"><button type="button" class="btn btn-light" name="cancelProduct" id="cancelProduct">Cancel</button></a>
					  <div class="finish-holder">
						<div class="clearfix">&nbsp;</div>
						<div class="alert alert-success" role="alert" id="finished" ></div>
					</div>
					</form>
                  </div>
                </div>
              </div>
            </div>
		</div>