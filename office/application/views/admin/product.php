
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Add Product </h3>
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
                    <h4 class="card-title">Enter Product Details</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" name="productForm" id="productForm" action="<?php echo base_url();?>admin/product/insert" method="post">
                      <div class="form-group">
                        <label for="productCode">Product Code</label>
                        <input type="text" class="form-control" id="productCode" name="productCode" placeholder="Enter the Product Code">
                      </div>
					  <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter the Product Name">
                      </div>
					  <div class="form-group">
					  <label for="categoryName">Choose Category</label>
                        <br><select id="categoryName" name="categoryName" class="form-control">
						<option value="">Select</option>
							<?php
						  foreach($h->result() as $row)
						  {
						     ?>
							<option value="<?php echo $row->ID;?>"><?php echo $row->Name;?></option>
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
						  foreach($p->result() as $row)
						  {
						     ?>
							<option value="<?php echo $row->ID;?>"><?php echo $row->Name;?></option>
							<?php
						  }
						  ?>
						</select>
                      </div>
					    <div class="form-group">
                        <label for="stockAvailability">Available Stock</label>
                        <input type="text" class="form-control" id="stockAvailability" name="stockAvailability" placeholder="Enter Available Stock">
                      </div>
					  <div class="form-group">
                        <label for="productUnitPrice">Unit Price</label>
                        <input type="text" class="form-control" id="productUnitPrice" name="productUnitPrice" placeholder="Enter Unit Price">
                      </div>
					  <div class="form-group">
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
                        <label for="brandName">Choose Brand</label>
                        <br><select id="brandName" name="brandName" class="form-control">
						<option value="">Select</option>
							<?php
						  foreach($m->result() as $row)
						  {
						     ?>
							<option value="<?php echo $row->ID;?>"><?php echo $row->Name;?></option>
							<?php
						  }
						  ?>
						</select>
                      </div>
					   <div class="form-group">
                        <label for="productThickness">Thickness in MM</label>
                        <input type="text" class="form-control" id="productThickness" name="productThickness" placeholder="Enter the Thickness in MM">
                      </div>
					  <!--<div class="form-group">
                        <label for="productWeightValue">Weight Value</label>
                        <input type="text" id="productWeightValue" name="productWeightValue" placeholder="Weight Value">
						<select name="productMeasurement" id="productMeasurement">
						<option value="">--- Choose a measurement ---</option>
						<option value="1">Inch</option>
						<option value="2">Feet</option>
						<option value="3">cm</option>
						</select>
						
						<input type="text" id="productWeightValueMM" name="productWeightValueMM" placeholder="" readonly>
                      </div>-->
					  <button type="submit" class="btn btn-primary mr-2" name="saveProduct" id="saveProduct">Save</button>
                      <a href="<?php echo base_url(); ?>admin/product"><button type="button" class="btn btn-light" name="cancelProduct" id="cancelProduct">Cancel</button></a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
		</div>