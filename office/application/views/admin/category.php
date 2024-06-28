
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Add Category </h3>
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
                    <h4 class="card-title">Enter Category Details</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" name="categoryForm" id="categoryForm" action="<?php echo base_url();?>admin/category/insert" method="post">
                      <div class="form-group">
                        <label for="userName">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName" placeholder="Enter the Category Name">
                      </div>
                     <button type="submit" class="btn btn-primary mr-2" name="saveCategory" id="saveCategory">Save</button>
                      <a href="<?php echo base_url(); ?>admin/category"><button type="button" class="btn btn-light" name="cancelCategory" id="cancelCategory">Cancel</button></a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
		</div>