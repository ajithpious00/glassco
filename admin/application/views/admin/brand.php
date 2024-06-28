
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
                    <h4 class="card-title">Add Brand</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
					
              
                    <form class="forms-sample" name="brandForm" id="brandForm" method="post">
                      
					  <div class="form-group">
                        <label for="brandName">Brand Name</label>
                        <input type="text" class="form-control" id="brandName" name="brandName" placeholder="Enter the Brand Name">
                      </div>
					  <div class="form-group">
                        <label for="brandLogo">Upload Brand Logo</label><br>
                        <input type="file" id="brandLogo" name="brandLogo"><br><br><br><br>
					  <button type="button" class="btn btn-primary mr-2" name="savebrand" id="savebrand">Save</button>
                      <a href="<?php echo base_url(); ?>admin/Viewbrand"><button type="button" class="btn btn-light" name="cancelBrand" id="cancelBrand">Cancel</button></a>
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