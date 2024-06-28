<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
	<div class="row g-4">
		<div class="col-sm-12 col-xl-8">
			<div class="bg-light rounded h-100 p-4 clstblpos">
				<h6 class="mb-4"><?php echo $pageName;?></h6>
				<form name="frmaccounttype" id="frmaccounttype" action="<?php echo base_url();?>Accounthead/accountHeadInsert" method="post">
				    <input type="hidden" name="accountHeadId" id="accountHeadId" value="<?php echo @$rowDet->accountHeadId;?>" />
					<div class="row mb-3">
						<label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" required id="accountHeadName" name="accountHeadName" value="<?php echo @$rowDet->accountHeadName;?>">
						</div>
					</div>
					<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Form End -->