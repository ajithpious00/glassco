<div class="main-panel">
          <div class="content-wrapper">
           <div class="page-header">
              <!--<h3 class="page-title"> Add Details </h3>-->
             <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="#">Forms</a></li>
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
					
                    <form class="forms-sample" name="settingsForm" id="settingsForm" method="post">
                     
					  <div class="form-group">
                        <label for="stnName">Name</label>
                        <input type="text" class="form-control" id="stnName" name="stnName" value="<?php echo $name; ?>">
                      </div>
					  <div class="form-group">
                        <label for="stnAddress">Address</label>
						<textarea class="form-control" id="stnAddress" name="stnAddress" ><?php echo $address; ?></textarea>
                      </div>
	                  <div class="form-group">
					  <label for="stnLogo">Logo</label><br>
						<img src="<?php echo base_url($logo); ?>" width="200"/><br><br>
                        <label for="stnLogo">Upload Logo</label><br>
                        <input type="file" id="stnLogo" name="stnLogo">
                      </div>
					   <div class="form-group">
                        <label for="stnemail">Email</label>
                        <input type="text" class="form-control" id="stnemail" name="stnemail" value="<?php echo $email; ?>">
                      </div>
					  <div class="form-group">
                        <label for="stnGST">GST</label>
                        <input type="text" class="form-control" id="stnGST" name="stnGST" value="<?php echo $gst; ?>">
                      </div>
					   <div class="form-group">
                        <label for="stnIGST">IGST</label>
                        <input type="text" class="form-control" id="stnIGST" name="stnIGST" value="<?php echo $igst; ?>">
                      </div>
					   <div class="form-group">
                        <label for="stnCGST">CGST</label>
                        <input type="text" class="form-control" id="stnCGST" name="stnCGST" value="<?php echo $cgst; ?>">
                      </div>
					   <div class="form-group">
                        <label for="stnSGST">SGST</label>
                        <input type="text" class="form-control" id="stnSGST" name="stnSGST" value="<?php echo $sgst; ?>">
                      </div>
					  <div class="form-group">
                        <label for="stnCuttingCharge">Cutting Charge</label>
                        <input type="text" class="form-control" id="stnCuttingCharge" name="stnCuttingCharge" value="<?php echo $ccharge; ?>">
                      </div>
					  <div class="form-group">
                        <label for="stnHoleCharge">Hole Charge</label>
                        <input type="text" class="form-control" id="stnHoleCharge" name="stnHoleCharge" value="<?php echo $hcharge; ?>">
                      </div>
					  <button type="button" class="btn btn-primary mr-2" name="saveSettings" id="saveSettings">Save</button>
                      <a href="<?php echo base_url(); ?>admin/settings/display"><button type="button" class="btn btn-light" name="cancelSettings" id="cancelSettings">Cancel</button></a>
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