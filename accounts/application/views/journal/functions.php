<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function()
  {
		  function loadTransactionData()
		  {
				transactionId=$('#transactionId').val();
			//	alert(transactionId);
				
							$.ajax({
							  url:"<?php echo base_url(); ?>Journal/loadTransactionData",
							  method:"POST",
							  data:{transactionId:transactionId},
							  dataType:"JSON",
							  success:function(data){
								var html = '<tr>';
								html += '<td id="account_head" contenteditable placeholder="Select Account Head">' +
								 '<select class="form-select mb-3" name="accountHeadId" id="accountHeadId">' +
								 '<option value="">-- Select Account Head --</option>' + 
									 <?php
										foreach(@$accountHeadList as $key=>$val)
										{
									 ?>
										'<option value="<?php echo $val->accountHeadId;?>">' + 
										  '<?php echo $val->accountHeadName;?>' + '</option>' +
									 <?php 
										} 
									 ?>
								  '</select>'  + 
								'</td>';
								html += '<td id="particulars" contenteditable placeholder="Enter Particulars"></td>';
								html += '<td id="amountDr" contenteditable></td>';
								html += '<td id="amountCr" contenteditable></td>';
								html += '<td><button type="button" name="btn_add" id="btn_add" class="btnjournaladd">';
								html += '&nbsp;<i class="fas fa-plus-square fa-lg"></i></td>';
								html += '</tr>';
								
								if(transactionId != "")
								{
										//	alert(data.length);
										for(var count = 0; count < data.length; count++)
										{
										  html += '<tr>';
										  html += '<td class="table_data" data-row_id="'+data[count].transactionId +'" data-column_name="account_head" contenteditable>'+data[count].accountHead+'</td>';
										  html += '<td class="table_data" data-row_id="'+data[count].transactionId +'" data-column_name="particulars" contenteditable>'+data[count].particulars+'</td>';
										  html += '<td class="table_data" data-row_id="'+data[count].transactionId +'" data-column_name="amountDr" contenteditable>'+data[count].amountDr+'</td>';
										  html += '<td class="table_data" data-row_id="'+data[count].transactionId +'" data-column_name="amountCr" contenteditable>'+data[count].amountCr+'</td>';
										  html += '<td><button type="button" name="delete_btn" id="'+data[count].transactionDtlId+'" class="btn btn-xs btn-danger btn_delete">'
										  html += '<img src="<?php echo base_url();?>assets/img/delete.png" width="30" height="30">';
										  html += '</button></td></tr>';
										}
								}
								$('tbody').html(html);
							  }
							});
			 // 	}
		  }
		
		  loadTransactionData();
		
		  $(document).on('click', '#btn_add', function(){
			var account_head = $('#account_head').text();
			var particulars = $('#particulars').text();
			var amountDr = $('#amountDr').text();
			var amountCr = $('#amountCr').text();
			if(account_head == '')
			{
			  alert('Select Account Head');
			  return false;
			}
			
			var transactionId=$('#transactionId').val();
			var ledgerId=$('#ledgerId').val();
			var transactionDate=$('#transactionDate').val();
			var transactionRef=$('#transactionRef').val();
			var accountHeadId=$('#accountHeadId').val();
			/*alert(accountHeadId);
			alert(particulars);
			alert(debit_amount);
			alert(credit_amount);*/
			
		/*	alert(transactionId);
			alert(ledgerId);
			alert(transactionDate);
			alert(transactionRef);
			alert(accountHeadId);*/
		
			
			$.ajax({
			  url:"<?php echo base_url(); ?>Journal/journalInsert",
			  method:"POST",
			  data:{transactionId:transactionId,ledgerId:ledgerId,transactionDate:transactionDate,transactionRef:transactionRef,accountHeadId:accountHeadId, particulars:particulars, amountDr:amountDr, amountCr:amountCr},
			  success:function(data){
				$('#transactionId').val(data);
				// alert("Successfully Added");
				loadTransactionData();
			  }
			})
			  });
			
			 /* $(document).on('blur', '.table_data', function(){
				var id = $(this).data('row_id');
				var table_column = $(this).data('column_name');
				var value = $(this).text();
				$.ajax({
				  url:"<?php // echo base_url(); ?>journal/journalUpdate",
				  method:"POST",
				  data:{id:id, table_column:table_column, value:value},
				  success:function(data)
				  {
					loadTransactionData();
				  }
				})
			  });*/
			
			  $(document).on('click', '.btn_delete', function(){
				var id = $(this).attr('id');
			//	alert(id);
				if(confirm("Are you sure you want to delete this?"))
				{
				  $.ajax({
					url:"<?php echo base_url(); ?>journal/journalEntryDelete",
					method:"POST",
					data:{transactionDtlId :id},
					success:function(data){
					  loadTransactionData();
					}
				  })
				}
			  });
			  
	});
</script>