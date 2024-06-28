
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Add Brand Details </h3>
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
                    <h4 class="card-title">Enter Brand Details</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
					
              
                    <form class="forms-sample" name="brandForm" id="brandForm" action="<?php echo base_url();?>admin/brand/insert" method="post">
                      
					  <div class="form-group">
                        <label for="brandName">Brand Name</label>
                        <input type="text" class="form-control" id="brandName" name="brandName" placeholder="Enter the Brand Name">
                      </div>
					  <div class="form-group">
                        <label for="brandLogo">Brand Logo</label>&nbsp;&nbsp;&nbsp;
                        <input type="file" id="brandLogo" name="brandLogo" size="20">
						<br>
						<br>
					  <button type="submit" class="btn btn-primary mr-2" name="savebrand" id="savebrand">Save</button>
                      <a href="<?php echo base_url(); ?>admin/brand"><button type="button" class="btn btn-light" name="cancelBrand" id="cancelBrand">Cancel</button></a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
		</div>