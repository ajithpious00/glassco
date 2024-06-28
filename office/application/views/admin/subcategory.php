
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Add Sub Category </h3>
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
                    <h4 class="card-title">Enter Sub Category Details</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" name="productForm" id="categoryForm" action="<?php echo base_url();?>admin/subcategory/insert" method="post">
                      <div class="form-group">
                        <label for="categoryName">Choose Category</label>
                        <br><select id="categoryName" name="categoryName">
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
                        <label for="productName">Sub Category Name</label>
                        <input type="text" class="form-control" id="subCategoryName" name="subCategoryName" placeholder="Enter the Product Name">
                      </div>
					  <button type="submit" class="btn btn-primary mr-2" name="savesubcategory" id="savesubcategory">Save</button>
                      <a href="<?php echo base_url(); ?>admin/subcategory"><button type="button" class="btn btn-light" name="cancelsubcategory" id="cancelProduct">Cancel</button></a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
		</div>