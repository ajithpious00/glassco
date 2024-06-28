<div class="container-fluid pt-4 px-4">
                <div class="row g-4">

					<div class="col-12">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4"><?php echo $pageName;?></h6>
							<form name="frmaccountsubtype" id="frmaccountsubtype" action="<?php echo base_url();?>Accountsubtype/accountSubTypeAdd" method="post">
								<!--<div class="row">
										<div class="col-sm-10">
										</div>
										<div class="col-sm-2">
											<input type="submit" name="btnadd" id="btnadd" value="Add" class="btn btn-primary">
										</div>
								</div>-->
							</form>
							<br/>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl No</th>
											<th scope="col">Order No</th>
                                            <th scope="col">Order Date</th>
											<th scope="col">Customer</th>
											<th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
										  // echo "<pre>";
										  // print_r($list);
										   $i=1;
										   foreach($list as $key=>$val)
										   {
										?>
													<tr>
														<th scope="row"><?php echo $i++;?></th>
														<td><?php echo $val->PD_Order_No;?></th>
														<td>
														<?php 
															$PD_Order_Date=date_create($val->PD_Order_Date);
															echo date_format($PD_Order_Date,"d-M-Y");
														?>
														</td>
														<td><?php echo $val->CU_Name;?></td>
														<td><a href="<?php echo base_url(); ?>workorder/invoice/<?=$val->PD_Order_No;?>"><i class="fas fa-file-invoice fa-lg"></i></a></td>
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