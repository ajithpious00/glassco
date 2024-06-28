<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
	<div class="row g-4">
		<div class="col-sm-12 col-xl-8">
			<div class="bg-light rounded h-100 p-4 clstblpos">
				<h6 class="mb-4"><?php echo $pageName;?></h6>
				<form name="frmledger" id="frmledger" action="<?php echo base_url();?>Ledger/ledgerInsert" method="post">
				    <input type="hidden" name="ledgerId" id="ledgerId" value="<?php echo @$rowDet->ledgerId;?>" />
					<div class="row mb-3">
						<label for="inputEmail3" class="col-sm-4 col-form-label">Name</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="ledgerName" name="ledgerName" required value="<?php echo @$rowDet->ledgerName;?>">
						</div>
					</div>
					<div class="row mb-3">
						<label for="inputEmail3" class="col-sm-4 col-form-label">Date</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" required id="date" name="date" value="<?php echo @$rowDet->date;?>">
						</div>
					</div>
					<div class="row mb-3">
						<label for="inputEmail3" class="col-sm-4 col-form-label">Opening Balance</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" required id="openingBalance" name="openingBalance" value="<?php echo @$rowDet->openingBalance;?>">
						</div>
					</div>
					<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Form End -->