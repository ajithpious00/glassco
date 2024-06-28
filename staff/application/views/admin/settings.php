<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <!--<h3 class="page-title"> Add Details </h3>-->
      <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                </ol>
              </nav>-->
    </div>
    <div class="row">
      <div class="col-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Enter Details</h4>
            <!--<p class="card-description"> Basic form elements </p>-->
            <form class="forms-sample" name="settingsForm" id="settingsForm"
              action="<?php echo base_url(); ?>admin/settings/insert" method="post">
              <div class="form-group">
                <label for="stnName">Name</label>
                <input type="text" class="form-control" id="stnName" name="stnName" placeholder="Enter Name">
              </div>
              <div class="form-group">
                <label for="stnAddress">Address</label>
                <input type="text" class="form-control" id="stnAddress" name="stnAddress" placeholder="Enter Address">
              </div>
              <div class="form-group">
                <label for="stnLogo">Logo</label>
                <input type="file" id="stnLogo" name="stnLogo">
              </div>
              <div class="form-group">
                <label for="stnemail">Email</label>
                <input type="text" class="form-control" id="stnemail" name="stnemail" placeholder="Enter Email">
              </div>
              <div class="form-group">
                <label for="stnsiteAddress">Site Address</label>
                <input type="text" class="form-control" id="stnsiteAddress" name="stnsiteAddress"
                  placeholder="Enter Site Address">
              </div>
              <div class="form-group">
                <label for="stnGST">GST</label>
                <input type="text" class="form-control" id="stnGST" name="stnGST" placeholder="Enter GST">
              </div>
              <div class="form-group">
                <label for="stnIGST">IGST</label>
                <input type="text" class="form-control" id="stnIGST" name="stnIGST" placeholder="Enter IGST">
              </div>
              <div class="form-group">
                <label for="stnCGST">CGST</label>
                <input type="text" class="form-control" id="stnCGST" name="stnCGST" placeholder="Enter CGST">
              </div>
              <div class="form-group">
                <label for="stnSGST">SGST</label>
                <input type="text" class="form-control" id="stnSGST" name="stnSGST" placeholder="Enter SGST">
              </div>
              <button type="submit" class="btn btn-primary mr-2" name="saveSettings" id="saveSettings">Save</button>
              <a href="<?php echo base_url(); ?>admin/settings"><button type="button" class="btn btn-light"
                  name="cancelSettings" id="cancelSettings">Cancel</button></a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>