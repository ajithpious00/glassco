<div class="container-fluid pt-4 px-4">
                <div class="row g-4">

					<div class="col-12">
                        <div class="bg-light rounded h-100 p-4 clstblpos">
                            <h6 class="mb-4"><?php echo $pageName;?> - <?php echo $ledgerName;?></h6>
							<form name="frmaddledger" id="frmledger" action="<?php echo base_url();?>Journal/journalAddLedger/<?php echo @$ledgerId;?>" method="post">
								<div class="row">
										<div class="col-sm-10">
										</div>
										<div class="col-sm-2">
											<input type="submit" name="btnadd" id="btnadd" value="Add" class="btn btn-primary">
										</div>
								</div>
								<input type="hidden" name="ledgerId" id="ledgerId" value="<?php echo @$ledgerId;?>" />
							</form>
							
							<br/>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
									    <tr>
										   <td colspan="4"><strong>Dr.</strong></td>
										   <td colspan="4"><strong>Cr.</strong></td>
										</tr>
                                        <tr>
                                            <th scope="col">Date</th>
											<th scope="col">Particulars</th>
											<th scope="col">Ref</th>
											<th scope="col">Amount</th>
											<th scope="col">Date</th>
											<th scope="col">Particulars</th>
											<th scope="col">Ref</th>
											<th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										   $i=1;
										    
										   
										   foreach($list as $key=>$val)
										   {
													$transDate=date_create($val->transactionDate);
										?>
													<tr>
														<?php
														  if($val->amountDr > 0)
														  {
														?>
																	<td><?php echo date_format($transDate,"d-M-Y");?></td>
																	<td><?php echo $val->particulars;?></td>
																	<td><?php echo $val->transactionRef;?></td>
																	<td><?php echo $val->amountDr;?></td>
														<?php
														  }
														  else
														  {
														  ?>
														 			<td>&nbsp;</td>
																	<td>&nbsp;</td>
																	<td>&nbsp;</td>
																	<td>&nbsp;</td>
														  <?php
														  }
														  ?>
														<?php
														  if($val->amountCr > 0)
														  {
														?>
																	<td><?php echo date_format($transDate,"d-M-Y");?></td>
																	<td><?php echo $val->particulars;?></td>
																	<td><?php echo $val->transactionRef;?></td>
																	<td><?php echo $val->amountCr;?></td>
														<?php
														  }
														  else
														  {
														  ?>
														 			<td>&nbsp;</td>
																	<td>&nbsp;</td>
																	<td>&nbsp;</td>
																	<td>&nbsp;</td>
														  <?php
														  }
														  ?>
													</tr>
                                        <?php
										   }
										?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
	</div>
</div>