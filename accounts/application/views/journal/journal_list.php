<div class="container-fluid pt-4 px-4">
                <div class="row g-4">

					<div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4"><?php echo $pageName;?></h6>
							<form name="frmjournal" id="frmjournal" action="<?php echo base_url();?>Journal/journalAdd" method="post">
								<div class="row">
										<div class="col-sm-10">
										</div>
										<div class="col-sm-2">
											<input type="submit" name="btnadd" id="btnadd" value="Add" class="btn btn-primary">
										</div>
								</div>
							</form>
							<br/>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl No</th>
											<th scope="col">Ledger A/C</th>
                                            <th scope="col">Transaction Date</th>
											<th scope="col">Transaction Ref</th>
											
											<th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										   $i=1;
										/*   print_r($list);
										     exit;*/
										   
										   foreach($list as $key=>$val)
										   {
										  //  echo "<pre>";
										  //  print_r($val);
										     /* exit;*/
											
												$transDate=date_create($val->transactionDate);
												
											 
										?>
													<tr>
														<th scope="row"><?php echo $i++;?></th>
														<td><?php echo $val->ledgerName;?></td>
														<td><?php echo date_format($transDate,"d-M-Y");?></td>
														<td><?php echo $val->transactionRef;?></td>
														
														<td>
														<a href="<?php echo base_url();?>Journal/journalAdd/<?=$val->transactionId;?>"><i class="far fa-edit fa-lg"></i></a> 
						  <a href="<?php echo base_url(); ?>Journal/deleteJournal/<?=$val->transactionId;?>" onclick="return confirm('Do you want to delete?');"><i class="fas fa-times fa-lg"></i></a></td>
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