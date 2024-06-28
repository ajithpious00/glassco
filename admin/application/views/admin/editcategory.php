
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
                    <h4 class="card-title">Edit Category Details</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" name="categoryForm" id="categoryForm" method="post">
					<input type="hidden" id="category_id" name="category_id" value="<?php echo $id; ?>">
                      <div class="form-group">
                        <label for="userName">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo $name; ?>">
                      </div>
                     <button type="button" class="btn btn-primary mr-2" name="saveCategory" id="saveCategory">Save</button>
                      <a href="<?php echo base_url(); ?>admin/viewcategories"><button type="button" class="btn btn-light" name="cancelCategory" id="cancelCategory">Cancel</button></a>
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
		