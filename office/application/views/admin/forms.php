
 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Add Users </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                 <!-- <li class="breadcrumb-item"><a href="#">Forms</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Form elements</li>-->
                </ol>
              </nav>
            </div>
			
            <div class="row">
             <!-- <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Default form</h4>
                    <p class="card-description"> Basic form layout </p>
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="exampleInputUsername1">Username</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password">
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input"> Remember me </label>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>-->
              <!--<div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Horizontal Form</h4>
                    <p class="card-description"> Horizontal form layout </p>
                    <form class="forms-sample">
                      <div class="form-group row">
                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputUsername2" placeholder="Username">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="exampleInputMobile" placeholder="Mobile number">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Re Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="exampleInputConfirmPassword2" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                          <input type="checkbox" class="form-check-input"> Remember me </label>
                      </div>
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      <button class="btn btn-light">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>-->
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Enter Details</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" name="userForm" id="userForm" action="<?php echo base_url();?>admin/Forms/insert" method="post">
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
                        <input type="text" class="form-control" id="userMobile" name="userMobile" placeholder="Enter Your Mobile Number" >
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
						  foreach($h->result() as $row)
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
                     <!-- <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" id="exampleSelectGender">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="img[]" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>-->
					  <button type="submit" class="btn btn-primary mr-2" name="saveUser" id="saveUser">Save</button>
                      <a href="<?php echo base_url(); ?>admin/forms"><button type="button" class="btn btn-light" name="cancelUser" id="cancelUser">Cancel</button></a>
                     </form>
                  </div>
                </div>
              </div>
            </div>
		</div>
