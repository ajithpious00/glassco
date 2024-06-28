<div class="container-fluid pt-4 px-4">
                <div class="row g-4">

					<div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4"><?php echo $pageName;?></h6>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl No</th>
											<th scope="col">Ledger </th>
                                            <th scope="col">Date</th>
											<th scope="col">Opening Balance</th>
											<th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										   $i=1;
									//	   echo "<pre>";
									//	   print_r($list);
									//	   exit;
										   foreach($list as $key=>$val)
										   {
										?>
													<tr>
														<th scope="row"><?php echo $i++;?></th>
														<td><?php echo $val->ledgerName;?></td>
														<td><?php echo $val->date;?></td>
														<td><?php echo $val->openingBalance;?></td>
														<td><a href="<?php echo base_url();?>Ledger/ledgerDetails/<?=$val->ledgerId;?>"><i class="far fa-edit fa-lg"></i></a> 
						  <a href="<?php echo base_url(); ?>Ledger/deleteLedger/<?=$val->ledgerId;?>" onclick="return confirm('Do you want to delete?');"><i class="fas fa-times fa-lg"></i></a></td>
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