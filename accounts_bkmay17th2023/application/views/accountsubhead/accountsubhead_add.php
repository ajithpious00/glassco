<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
	<div class="row g-4">
		<div class="col-sm-12 col-xl-8">
			<div class="bg-light rounded h-100 p-4 clstblpos">
				<h6 class="mb-4"><?php echo $pageName;?></h6>
				<form name="frmaccountsubhead" id="frmaccountsubhead" action="<?php echo base_url();?>Accountsubhead/accountSubHeadInsert" method="post">
				    <input type="hidden" name="accountSubHeadId" id="accountSubHeadId" value="<?php echo @$rowDet->accountSubHeadId;?>" />
					 <div class="row mb-3">
							 <label for="inputEmail3" class="col-sm-4 col-form-label">Account Head</label>
							 <div class="col-sm-8">
								 <select class="form-select mb-3" name="accountHeadId" id="accountHeadId" required>
								 	 <option value="">-- Select Account Head --</option>
									 <?php
									    foreach(@$accountHeadList as $key=>$val)
										{
									 ?>
										<option value="<?php echo $val->accountHeadId;?>" <?=(@$rowDet->accountHeadId == @$val->accountHeadId) ? 'selected' : ''?>>
										  <?php echo $val->accountHeadName;?></option>
									 <?php 
								        } 
									 ?>
								 </select>
							  </div>
					  </div>
					
					
					
					
					
					<div class="row mb-3">
						<label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="accountSubHeadName" name="accountSubHeadName" value="<?php echo @$rowDet->accountSubHeadName;?>" required>
						</div>
					</div>
					<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Form End -->