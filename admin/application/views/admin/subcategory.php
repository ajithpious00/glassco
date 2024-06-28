
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
                    <h4 class="card-title">Add Sub Category</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" name="subCategoryForm" id="subCategoryForm" method="post">
                      <div class="form-group">
                        <label for="categoryName">Choose Category</label>
                        <br><select id="categoryName" name="categoryName" class="form-control">
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
                      </div>
					  <div class="form-group">
                        <label for="subCategoryName">Sub Category Name</label>
                        <input type="text" class="form-control" id="subCategoryName" name="subCategoryName" placeholder="Enter the Category">
                      </div>
					  <button type="button" class="btn btn-primary mr-2" name="savesubcategory" id="savesubcategory">Save</button>
                      <a href="<?php echo base_url(); ?>admin/viewsubcategory"><button type="button" class="btn btn-light" name="cancelsubcategory" id="cancelProduct">Cancel</button></a>
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