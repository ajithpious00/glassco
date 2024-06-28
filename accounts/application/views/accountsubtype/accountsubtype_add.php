<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
	<div class="row g-4">
		<div class="col-sm-12 col-xl-8">
			<div class="bg-light rounded h-100 p-4 clstblpos">
				<h6 class="mb-4"><?php echo $pageName;?></h6>
				<form name="frmsubaccounttype" id="frmsubaccounttype" action="<?php echo base_url();?>Accountsubtype/accountSubTypeInsert" method="post">
				    <input type="hidden" name="accountSubTypeId" id="accountSubTypeId" value="<?php echo @$rowDet->accountSubTypeId;?>" />
					
					<?php
					/*   print_r($accountTypeList);
					   exit;*/
					?>
					<div class="row mb-3">
							 <label for="inputEmail3" class="col-sm-4 col-form-label">Account Type</label>
							 <div class="col-sm-8">
								 <select class="form-select mb-3" name="accountTypeId" id="accountTypeId" required>
								 	 <option value="">-- Select Account Type --</option>
									 <?php
									    foreach(@$accountTypeList as $key=>$val)
										{
									 ?>
										<option value="<?php echo $val->accountTypeId;?>" <?=(@$rowDet->accountTypeId == @$val->accountTypeId) ? 'selected' : ''?>>
										  <?php echo $val->accountTypeName;?></option>
									 <?php 
								        } 
									 ?>
								 </select>
							  </div>
				    </div>
					<div class="row mb-3">
						<label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="accountSubTypeName" name="accountSubTypeName" value="<?php echo @$rowDet->accountSubTypeName;?>" required>
						</div>
					</div>
					<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Form End -->