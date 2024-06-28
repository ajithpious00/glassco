<script>
$(document).ready(function () {
	$('#addmore').click(function(){ 
		var i = 0;
		i++;  
	   $('#product_field').append('<tr id="row'+i+'" class="payment-added"><td><select class="form-control select2" style="width: 90px;" name="productname[]" id="productname[]"><option value="0">Select</option> <?php if(count($product)>0) { foreach($product as $pt) { ?> <option <?php if($pt->ID == $data['ID']){ echo 'selected'; } ?> value="<?= $pt->ID; ?>">	<?= $pt->Name; ?> </option> <?php 	}}?>required /><td><input type="text" name="height[]" placeholder="Height" class="form-control name_list" required /><td><input type="text" name="width[]" placeholder="Width" class="form-control name_list" required /><td><select class="form-control select2" style="width: 90px;" name="unit[]" id="unit[]"><option value="0">Select</option> <?php if(count($product_unit)>0) { foreach($product_unit as $pu) { ?> <option <?php if($pu->UN_Id == $data['UN_Id']){ echo 'selected'; } ?> value="<?= $pu->UN_Id; ?>">	<?= $pu->UN_Name; ?> </option> <?php 	}}?>required /><td><select class="form-control select2" style="width: 90px;" name="type[]" id="type[]"><option value="0">Select</option> <?php if(count($product_type)>0) { foreach($product_type as $pt) { ?> <option <?php if($pt->ID == $data['ID']){ echo 'selected'; } ?> value="<?= $pt->ID; ?>">	<?= $pt->Edge_type; ?> </option> <?php 	}}?>required /><td><input type="text" name="quantity[]" placeholder="Quantity" class="form-control name_list" required /><td><input type="text" name="rate[]" placeholder="Rate" class="form-control name_list" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove" style ="width: 82px;">X</button></td></tr>');   
	});
	
	
	$(document).on('click', '.btn_remove', function(){  
		var button_id = $(this).attr("id");   
	   $('#row'+button_id+'').remove();  
	});
	
	
	$('#save').on('click', function(e){  
		var basePath = '<?php echo AD_BASE_PATH; ?>';
		var url = basePath + 'sales_enquiries/save';
		//var s=$.post(url, $('#salesadd').serialize();
		$.post(url, $('#salesadd').serialize(), function(data){
			if(data.class=="success"){
				$('.message').show();
				$('.message').css("background-color","green");
				$('.message').css("color","white");
				$('.message').html(data.msg);
				$('#salesadd')[0].reset();
				window.location.reload();
			}
			else{
				$('.message').show();
				$('.message').css("background-color","red");
				$('.message').css("color","white");
				$('.message').html(data.msg);
			}
		},'json');
	});
	
});
</script>
