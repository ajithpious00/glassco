<!-- Form Start -->
<div class="container-fluid pt-4 px-4">
	<div class="row g-4">
		<div class="col-sm-12 col-xl-12">
			<div class="bg-light rounded h-100 p-4 clstblpos">
				<h6 class="mb-4"><?php echo $pageName;?></h6>
				<form name="frmjournal" id="frmjournal" action="<?php echo base_url();?>Journal/saveJournal" method="post">
								<!--<div class="container-fluid pt-4 px-4">-->
											<!--<div class="container box">-->
													<input type="hidden" name="transactionId" id="transactionId" value="<?php echo @$rowDet->transactionId;?>" />
													<?php
														// print_r($rowDet);
													   if(@$ledgerId == "")
													   {
													     $ledgerId=@$rowDet->ledgerId;
														 
														 
													   }
													  // echo $ledgerId;
													?>
													
													<div class="row mb-2">
														 <label for="inputEmail3" class="col-sm-1 col-form-label">Ledger</label>
														 <div class="col-sm-3">
															 <select class="form-select mb-3" name="ledgerId" id="ledgerId" required>
																 <option value="">-- Select Ledger Account --</option>
																 <?php
																	foreach(@$ledgerList as $key=>$val)
																	{
																 ?>
																	<option value="<?php echo $val->ledgerId;?>" <?=(@$ledgerId == @$val->ledgerId) ? 'selected' : ''?>>
																	  <?php echo $val->ledgerName;?></option>
																 <?php 
																	} 
																 ?>
															 </select>
														  </div>
													
														<label for="inputEmail3" class="col-sm-2 col-form-label">Date</label>
														<div class="col-sm-2">
															<input type="date" class="form-control" id="transactionDate" name="transactionDate" value="<?php echo @$rowDet->transactionDate;?>" required>
														</div>
														<label for="inputEmail3" class="col-sm-2 col-form-label">Reference</label>
														<div class="col-sm-2">
															<input type="text" required class="form-control" id="transactionRef" name="transactionRef" value="<?php echo @$rowDet->transactionRef;?>">
														</div>
													</div>
												
												<div class="table-responsive">
												  <br />
												  <table class="table table-striped table-bordered tbljournal" width="93%">
													<thead>
														  <tr>
																<th width="300">Account Head</th>
																<th width="269">Particulars</th>
																<th width="150">Debit</th>
																<th width="150">Credit</th>
																<th width="191">Action</th>
														  </tr>
													</thead>
													<tbody>
													</tbody>
												  </table>
												  <div class="row mb-3">
													 <div class="col-sm-3">
														<!--<input type="button" name="btncancel" id="btncancel" value="Cancel" class="btn btn-primary">-->
														<input type="submit" name="btnsave" id="btnsave" value="Save" class="btn btn-primary">
													 </div>
												  </div>
												</div>
											<!--</div>-->
											
								<!--</div>-->
						</form>
			</div>
		</div>
	</div>
</div>
<!-- Form End -->