
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
					<div class="row">
						<div class="col-md-8"><h4 class="card-title">Product Details</h4></div>
						<div class="col-md-4 text-right">
							 <a href="<?php echo base_url(); ?>admin/viewproduct">
								<button type="button" class="btn btn-secondary" name="Product" id="Product">Back to list</button>
							 </a>
						</div>
					 </div>
                    <div class="row">
					  <div class="col-md-6">
                        <label for="brandName">Brand Name</label>
                        <label id="brandName" name="brandName" class="form-control"><?php echo $brandname; ?></label>
                      </div>
                      <div class="col-md-6">
                        <label for="productCode">Product Code</label>
                        <label class="form-control" id="productCode" name="productCode"><?php echo $code; ?></label>
                      </div>
					  <div class="col-md-6">
                        <label for="productName">Product Name</label>
                        <label class="form-control" id="productName" name="productName"><?php echo $name; ?></label>
                      </div>
					  <div class="col-md-6">
					  <label for="categoryName">Category</label>
                      <label id="categoryName" name="categoryName" class="form-control"><?php echo $categoryname; ?></label>
                      </div>
					  <div class="col-md-6">
                        <label for="subcategoryName">Sub Category</label>
                        <label id="subcategoryName" name="subcategoryName" class="form-control"><?php echo $subcategoryname; ?></label>
				      </div>
					    <div class="col-md-6">
                        <label for="stockAvailability">Available Stock</label>
                        <label class="form-control" id="stockAvailability" name="stockAvailability"><?php echo $stock; ?></label>
                      </div>
					  <div class="col-md-6">
                        <label for="productUnitPrice">Unit Price</label>
                        <label class="form-control" id="productUnitPrice" name="productUnitPrice"><?php echo $price; ?></label>
                      </div>
					  <div class="col-md-6">
                        <label for="productMRP">MRP</label>
                        <label class="form-control" id="productMRP" name="productMRP"><?php echo $mrp; ?></label>
                      </div>
					  <div class="col-md-6">
                        <label for="productWidth">Width in MM</label>
                        <label class="form-control" id="productWidth" name="productWidth"><?php echo $width; ?></label>
                      </div>
					  <div class="col-md-6">
                        <label for="productHeight">Height in MM</label>
                        <label class="form-control" id="productHeight" name="productHeight"><?php echo $height; ?></label>
                      </div>
					  <div class="col-md-6">
                        <label for="productThickness">Thickness in MM</label>
                        <label class="form-control" id="productThickness" name="productThickness"><?php echo $thickness; ?></label>
                      </div>
					</div>
                     
                    
                  </div>
                </div>
              </div>
            </div>
		</div>