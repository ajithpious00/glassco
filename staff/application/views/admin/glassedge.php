<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Manage Glass Edges </h3>
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
            <h4 class="card-title">Enter Glass Edge Details</h4>
            <!--<p class="card-description"> Basic form elements </p>-->
            <form class="forms-sample" name="glassedgetypeForm" id="glassedgetypeForm"
              action="<?php echo base_url(); ?>admin/edge/save_edge" method="post">
              <div class="form-group">
                <label for="userName">Glass Edge Type</label>
                <input type="text" class="form-control" id="glassEdgeType" name="glassEdgeType"
                  placeholder="Enter Glass Edge Type">
              </div>
              <button type="submit" class="btn btn-primary mr-2" name="saveEdgeType" id="saveEdgeType">Save</button>
              <a href="<?php echo base_url(); ?>admin/edge"><button type="button" class="btn btn-light"
                  name="cancelEdgeType" id="cancelEdgeType">Cancel</button></a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>