
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
                    <h4 class="card-title">Edit Glass Edge Details</h4>
                    <form class="forms-sample" name="glassedgetypeForm" id="glassedgetypeForm" method="post" action="">
					<input type="hidden" id="edge_id" name="edge_id" value="<?php echo $id; ?>"/>
                      <div class="form-group">
                        <label for="userName">Glass Edge Type</label>
                        <input type="text" class="form-control" id="glassEdgeType" name="glassEdgeType" value="<?php echo $edgetype; ?>" />
                      </div>
                      <button type="button" class="btn btn-primary mr-2" name="saveEdgeType" id="saveEdgeType">Save</button>
                     <a href="<?php echo base_url(); ?>admin/viewglass"><button type="button" class="btn btn-light" name="cancelEdgeType" id="cancelEdgeType">Cancel</button></a>
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