<div class="container bootstrap snippets bootdey">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row maintitle">
				<div class="col-md-6 col-sm-6 text-left">
					<img src="<?php echo base_url();?>assets/logo/logo_dashboard.jpeg">
				</div>
 				<?php
				//	  echo "<pre>";
				//	  print_r($invoiceInfo);
				?>
				<div class="col-md-6 col-sm-6 text-right">
					<h4><strong>GLASSCO TUFF</strong></h4>
					Kappur-Post, Kanjirathani - 679 552<br>
					GSTIN/UIN: 32AAVFG6290P1ZJ<br>
					State Name : Kerala,Code : 32 <br>
					Email: info@glasscogroup.in/www.glasscogroup.in
				</div>

			</div>
			
			<div class="table-responsive">
				<table class="table table-condensed nomargin invborder">
					<thead>
						<tr>
						   <th colspan="5" class="invmaintitle">
						      Perfoma Invoice
						   </td>
						</tr>
						<tr>
							<th>Perfoma Order No.& <br /> Date</th>
							<th>Delivery Date</th>
							<th>Pur. Order No & Date</th>
							<th>Destination</th>
							<th>E-Way Bill No</th>
						</tr>
						<tr>
							<th><?php echo $invoiceInfo->PD_Order_No;?><br />
							<?php 
							    $PD_Order_Date=date_create($invoiceInfo->PD_Order_Date);
								echo date_format($PD_Order_Date,"d-M-Y");
							?></th>
							<th>
							 <?php
								$PD_Delivery_Date=date_create($invoiceInfo->PD_Delivery_Date);
								echo date_format($PD_Delivery_Date,"d-M-Y");
							?>
							</th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
							<th>&nbsp;</th>
						</tr>
						<tr>
							<td>Name & Address Of Buyer :</td>
							<td>&nbsp;</td>
							<td>Name & Address Of Consignee :</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td class="invsubtitle"><?php echo $invoiceInfo->CU_Name;?></td>
							<td>&nbsp;</td>
							<td class="invsubtitle"><?php echo $invoiceInfo->CU_Name;?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td class="invsubtitle"><?php echo $invoiceInfo->CU_Address;?></td>
							<td>&nbsp;</td>
							<td class="invsubtitle"><?php echo $invoiceInfo->CU_Address;?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td class="invsubtitle"><?php echo $invoiceInfo->CU_Phone;?></td>
							<td>&nbsp;</td>
							<td class="invsubtitle"><?php echo $invoiceInfo->CU_Phone;?></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<!--<tr>
							<td>9539300664</td>
							<td>&nbsp;</td>
							<td>9539300664</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>State : &nbsp;&nbsp; Kerala</td>
							<td>State code : &nbsp;&nbsp; 32</td>
							<td>SITE : &nbsp; KARAD</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td>GSTIN/UIN No :</td>
							<td>&nbsp;</td>
							<td>State : &nbsp;&nbsp; Kerala</td>
							<td>&nbsp;</td>
							<td>State code : &nbsp;&nbsp; 32</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>GSTIN/UIN No :</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>-->
					</thead>
			    </table>
			</div>
			
			
			<div class="table-responsive">
				<table class="table table-condensed nomargin invborder">
					<thead>
						
				    </thead>
				</table>
			</div>
			
			
			<?php
			//   echo "<pre>";
			//   print_r($invoiceProductDetails);
			?>
			
			<div class="table-responsive">
				<table class="table table-condensed nomargin invborder">
					<thead>
						<tr>
							<th>Sl No</th>
							<th>HSN/SAC</th>
							<th>Commodity Name</th>
							<th>W <!--<br>(IN)--></th>
							<th>H <!--<br>(IN)--></th>
							<th>W <br>(MM)</th>
							<th>H <br>(MM)</th>
							<!--<th>W <br>(MM)</th>
							<th>H <br>(MM)</th>-->
							<!--<th>Pcs</th>-->
							<th>Sq.F</th>
							<th>Qty</th>
							<th>Rate</th>
							<th>Net <br> Value</th>
						</tr>
					</thead>
					<tbody>
					<?php
					   $pos=1;
					   foreach($invoiceProductDetails as $invoiceProductDet)
					   {
					?>
						<tr>
							<td><?php echo $pos++;?></td>
							<td>&nbsp;</td>
							<td>
								<?php echo $invoiceProductDet->Name; ?>
							</td>
							<td><?php echo $invoiceProductDet->PD_Width . " " . $invoiceProductDet->UN_Name; ?></td>
							<td><?php echo $invoiceProductDet->PD_Height . " " . $invoiceProductDet->UN_Name; ?></td>
							<td><?php echo $invoiceProductDet->PD_Width . " " . $invoiceProductDet->UN_Name; ?></td>
							<td><?php echo $invoiceProductDet->PD_Height . " " . $invoiceProductDet->UN_Name; ?></td>
							<!--<td><?php // echo $invoiceProductDet->PD_Width; ?></td>
							<td><?php // echo $invoiceProductDet->PD_Height; ?></td>-->
							<!--<td>&nbsp;</td>-->
							<td>&nbsp;</td>
							<td><?php echo $invoiceProductDet->PD_Quantity; ?></td>
							<td><?php echo $invoiceProductDet->PD_Price; ?></td>
							<td><?php echo $invoiceProductDet->PD_Quantity * $invoiceProductDet->PD_Price; ?></td>
						</tr>
				    <?php
						}
					?>
					</tbody>
				</table>
			</div>

			<!--<hr class="nomargin-top">-->
		</div>
	</div>

	<div class="panel panel-default text-right">
		<div class="panel-body prninvoice">
			<!--<a class="btn btn-warning" href="#"><i class="fa fa-pencil-square-o"></i> EDIT</a>
			<a class="btn btn-primary" href="#"><i class="fa fa-check"></i> SAVE</a>-->
			<a class="btn btn-success" href="#" target="_blank"><i class="fa fa-print"></i> PRINT INVOICE</a>
		</div>
	</div>
</div>