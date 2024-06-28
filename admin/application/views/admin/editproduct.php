
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
                    <h4 class="card-title">Edit Product Details</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
					
                    <form class="forms-sample" name="productForm" id="productForm" method="post">
					<input type="hidden" id="product_id" name="product_id" value="<?php echo $id; ?>">
					<div class="form-group">
                        <label for="brandName">Choose Brand</label>
                        <br><select id="brandName" name="brandName" class="form-control">
						<option value="">Select</option>
							<?php
							foreach($brname as $row)
						  {
							  if($brandname == $row->ID) {
									$selected = 'selected="selected"';
							  }
							  else {
								  $selected = '';
							  }
						     ?>
							<option value="<?php echo $row->ID;?>"<?php echo $selected; ?>><?php echo $row->Name;?></option>
							<?php
						  }
						  ?>
						</select>
                      </div>
                      <div class="form-group">
                        <label for="productCode">Product Code</label>
                        <input type="text" class="form-control" id="productCode" name="productCode" value="<?php echo $code; ?>">
                      </div>
					  <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $name; ?>">
                      </div>
					  <div class="form-group">
					  <label for="categoryName">Choose Category</label>
                        <br><select id="categoryName" name="categoryName" class="form-control" onchange="getsubcat(this.value)">
						<option value="">Select</option>
							<?php
							
						  foreach($ctname as $row)
						  {
							  if($categoryname == $row->ID) {
									$selected = 'selected="selected"';
							  }
							  else {
								  $selected = '';
							  }
						     ?>
							<option value="<?php echo $row->ID;?>" <?php echo $selected; ?>><?php echo $row->Name;?></option>
							<?php
						  }
						  ?>
						</select>
                      </div>
					  <div class="form-group">
                        <label for="subcategoryName">Choose Sub Category</label>
                        <br><select id="subcategoryName" name="subcategoryName" class="form-control">
						<option value="">Select</option>
						<?php
						foreach($sbname as $srow) {
							if($subcategoryname == $srow->ID) {
									$selected = 'selected="selected"';
							  }
							  else {
								  $selected = '';
							  }
							echo '<option value="'.$srow->ID.'" '.$selected.'>'.$srow->SB_Name.'</option>';
						}
						?>
						</select>
                      </div>
					    <div class="form-group">
                        <label for="stockAvailability">Available Stock</label>
                        <input type="text" class="form-control" id="stockAvailability" name="stockAvailability" value="<?php echo $stock; ?>">
                      </div>
					  <div class="form-group">
                        <label for="productUnitPrice">Unit Price</label>
                        <input type="text" class="form-control" id="productUnitPrice" name="productUnitPrice" value="<?php echo $price; ?>">
                      </div>
					  <div class="form-group">
                        <label for="productMRP">MRP</label>
                        <input type="text" class="form-control" id="productMRP" name="productMRP" placeholder="Enter MRP" value="<?php echo $mrp; ?>">
                      </div>
					  <div class="form-group">
                        <label for="productWidth">Width in MM</label>
                        <input type="text" class="form-control" id="productWidth" name="productWidth" value="<?php echo $width; ?>">
                      </div>
					  <div class="form-group">
                        <label for="productHeight">Height in MM</label>
                        <input type="text" class="form-control" id="productHeight" name="productHeight" value="<?php echo $height; ?>">
                      </div>
					  
					   <div class="form-group">
                        <label for="productThickness">Thickness in MM</label>
                        <input type="text" class="form-control" id="productThickness" name="productThickness" value="<?php echo $thickness; ?>">
                      </div>
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