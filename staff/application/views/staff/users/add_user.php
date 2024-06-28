
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
                    <h4 class="card-title">Add User</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" name="userForm" id="userForm" action="<?php echo base_url();?>admin/user/insert" method="post">
                      <div class="form-group">
                        <label for="userName">Name</label>
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Enter Your Name">
                      </div>
                      <div class="form-group">
                        <label for="userEmail">Email address</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="Enter Your Email" >
                      </div>
					  <div class="form-group">
                        <label for="userMobile">Mobile Number</label>
                        <input type="text" maxlength="12" class="form-control" id="userMobile" name="userMobile" placeholder="Enter Your Mobile Number" >
                      </div>
                      <div class="form-group">
                        <label for="userPassword">Password</label>
                        <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Enter Your Password" >
                      </div>
					  <div class="form-group">
                        <label for="userConfirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="userConfirmPassword" name="userConfirmPassword" placeholder="Please Confirm Your Password">
                      </div>
					  <div class="form-group">
                        <label for="Usertype">User Type</label>
                       <select name="usertype" id="usertype" class="form-control">
							<option value="">Select</option>
							<?php
						  foreach($ustype->result() as $row)
						  {
						     ?>
							
							<option value="<?php echo $row->ID;?>"><?php echo $row->Type;?></option>
							
							<?php
						  }
						  ?>
					   </select>
                     </div>
                     <div class="form-group" id="saleArea" style='display:none;'>
                        <label for="executiveSaleArea">City/Area of Sale</label>
                        <input type="text" class="form-control" id="executiveSaleArea" name="executiveSaleArea" placeholder="Enter the Area of Sale">
                      </div>
                      <button type="button" class="btn btn-primary mr-2" name="saveUser" id="saveUser">Save</button>
                      <a href="<?php echo base_url(); ?>user"><button type="button" class="btn btn-light" name="cancelUser" id="cancelUser">Cancel</button></a>
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
 
   