<div class="container-fluid pt-4 px-4">
                <div class="row g-4">

					<div class="col-12">
                        <div class="bg-light rounded h-100 p-4 clstblpos">
                            <h6 class="mb-4"><?php echo $pageName;?></h6>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Liabilities</th>
											<th scope="col">Amount</th>
											<th scope="col">Assets</th>
											<th scope="col">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										   $creditBalance=0;
										   $debitBalance=0;
										   foreach($list as $key=>$val)
										   {
										?>
													<tr>
															<td>
															<?php
															   if($val->amountDr > 0)
															   {
																	 echo $val->accountHead;
															   }
															?></td>
															<td>
															<?php 
															   if($val->amountDr > 0)
															   {
															  	    $debitBalance=$debitBalance + $val->amountDr;
																	echo $val->amountDr;
															   }
															?>
															</td>
															<td>
															<?php 
															   if($val->amountCr > 0)
															   {
																	echo $val->accountHead;
															   }
															?>
															</td>
															<td>
															<?php 
															   if($val->amountCr > 0)
															   {
															   	   $creditBalance=$creditBalance + $val->amountCr;
																   echo $val->amountCr;
															   }
															?>
															</td>
													</tr>
                                        <?php
										   }
										?>
									
										<tr>
                                            <th scope="col">Total Liabilities</th>
											<th scope="col">
											<?php 
											   if($debitBalance > 0)
											   {
												  echo number_format($debitBalance,2); 
											   }
											?>
											</th>
											<th scope="col">Total Assets</th>
											<th scope="col">
											<?php 
											   if($creditBalance > 0)
											   {
											      echo number_format($creditBalance,2); 
											   } 
											?></th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
	</div>
</div>