<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css"
	integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"
	integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
	function nlCals(rawVal, el, nl) {
		
		//var rawValArr = rawVal.split("-");
		//var parts = rawValArr[1];
		if(rawVal) {
			var nl_el = $(el).parent().parent().parent().find('.'+nl);
			/*var diviArr = divident.split("/");
			var multiplier = parseInt(18)/diviArr[1];
			var decimals = parseInt(diviArr[0]) * parseInt(multiplier);
			nl_el.val(rawValArr[0] + "." + decimals);*/
			
			var parts = rawVal.split('-');

			var wholeNumber = parseInt(parts[0]);
			if(parts[1]) {
				var fractionParts = parts[1].split('/');
				var numerator = parseInt(fractionParts[0]);
				var denominator = parseInt(fractionParts[1]);
				// Convert the fraction to an improper fraction
				var improperNumerator = wholeNumber * denominator + numerator;
				// Calculate the decimal value
				var decimalValue = improperNumerator / denominator;
				// Display the result
				//$('#result').text('Decimal value: ' + decimalValue);
				nl_el.val(decimalValue);
			}
			else {
				var nl_el = $(el).parent().parent().parent().find('.'+nl);
				nl_el.val(rawVal);
			}
		}
		else {
			var nl_el = $(el).parent().parent().parent().find('.'+nl);
			nl_el.val(rawVal);
		}
	}
	
	
	function copyThis(el) {
		var nos = $(el).attr('data-p');
		$('#addmore').trigger('click');
		/*Row One*/
		$('.copy1-'+nos).find('select').each(function(){
			if($(this).attr('name') == 'productname[]') {
				$('.copy1-'+p).find('select[name="'+$(this).attr('name')+'"]').val($(this).val());
			}
		});
		$('.copy1-'+nos).find('input').each(function(){
			if($(this).attr('name') == 'rate[]') {
				$('.copy1-'+p).find('input[name="'+$(this).attr('name')+'"]').val($(this).val());
			}
		});
		
		var prdId = $('.r' + p).find('.prodname').val();
		var basePath = '<?php echo AD_BASE_PATH; ?>';
		var url = basePath + 'sales_enquiries/getPolish';
					
		/*Row Two*/
		$.post(url, {prdId}, function(data){
			$('.copy2-'+p).find('.polishType').html('<option value="0">Select</option>');
			if(data) {
				for(var i=0; i<data.length; i++) {
					$('.copy2-'+p).find('.polishType').append('<option value="'+data[i].PO_Id+'">'+data[i].PO_Name+'</option>');
				}
				$('.copy2-'+nos).find('select').each(function(){
					if($(this).attr('name') == 'potype[]') {
						$('.copy2-'+p).find('select[name="'+$(this).attr('name')+'"]').val($(this).val());
					}
				});
				$('.copy2-'+nos).find('input').each(function(){
					if($(this).attr('name') == 'polishrate[]'){
						$('.copy2-'+p).find('input[name="'+$(this).attr('name')+'"]').val($(this).val());
					}
				});
			}
			
		},'json');
		
		/*$('.copy3-'+nos).find('input').each(function(){
			$('.copy3-'+p).find('input[data-el="'+$(this).attr('data-el')+'"]').val($(this).val());
		});*/
		
		/*Row Three*/
		
		$('.r' + p).find('.polishType').on('change', function(){
			var poId = $(this).val();
			var basePath = '<?php echo AD_BASE_PATH; ?>';
			var url = basePath + 'sales_enquiries/getPolishRates';
			//var parent = $(this).parent().parent();
			var parent = $(this).parent().attr('class');
			//$(parent).find('.porate').val(0);
			$('.'+parent).find('.porate').val(0);
			//$(parent).find('.porate').val(0);
			$('.'+parent).find('.porate').val(0);
			//var pdId = $(parent).find('.prodname').val();
			var pdId = $('.'+parent).find('.prodname').val();
			$.post(url, {poId,pdId}, function(data){
				//console.log(data);
				//$(parent).find('.porate').val(data.PO_Rate);				
				$('.'+parent).find('.porate').val(data.PO_Rate);				
			},'json');	
		});
	
	}
	
	
	var p = 0;
	$(document).ready(function () {
      	$('.mdi-menu').trigger('click');
      	
      	$(window).keypress(function(event) {
        	//addmore
          	if(event.ctrlKey && event.which == 10) {
            	$('#addmore').trigger('click');
            }
        });
		/*$('input').keypress(function(event) {
			//addmore
          	if(event.ctrlKey && event.which == 10) {
            	$('#addmore').trigger('click');
            }
        });
		$('select').keypress(function(event) {
        	//addmore
          	if(event.ctrlKey && event.which == 10) {
            	$('#addmore').trigger('click');
            }
        });*/
      	
		$('#addmore').click(function () {
			var i = 0;
			i++;
			p++;
			var prodDetails = $('.product-add-ons').html();
			$('#product_field').append('<tr class="copy1-'+p+'">\
				<td class="r' + p + '" colspan="3">\
					<select class="form-control select2 prodname" name="productname[]" id="productname[]">\
						<option value="0">Select</option>\
						<?php if (count($product) > 0) {
						foreach ($product as $pt) { ?> <option <?php if ($pt->ID == $data['ID']) {
							echo 'selected';
						} ?> value="<?= $pt->ID; ?>">	<?= $pt->PD_Name; ?> </option> <?php }
					} ?></select>\
				</td>\
				<td class="r' + p + '"><input type="text" name="rate[]" placeholder="Rate " class="form-control pdrate" required />\
				<td>\
					<select class="form-control select2" style="width: 90px;" name="type[]" id="type[]"><option value="0">Select</option> <?php if (count($product_type) > 0) {
						foreach ($product_type as $pt) { ?> <option <?php if ($pt->ID == $data['ID']) {
							echo 'selected';
						} ?> value="<?= $pt->ID; ?>">	<?= $pt->Edge_type; ?> </option> <?php }
					} ?></select>\
				</td>\
				<td colspan="5"><td>\
			</tr>\
			<tr id="row' + p + '" class="payment-added copy2-'+p+'">\
			<td class="r' + p + '"><select class="form-control select2 polishType" name="potype[]" id="potype[]" required><option value="0">Select</option></select>\
			<td class="r' + p + '"><input type="text" name="polishrate[]" placeholder="Polish Rate " class="form-control porate" required />\
			<td><input type="text" name="height[]" onkeyup="nlCals(this.value, this, \'htnl' + p + '\');" placeholder="Height" class="form-control name_list" required />\
			<td class="hidden-td" ><input type="text" id = "heightnl[]" name="heightnl[]" placeholder="Height NL" class="form-control name_list htnl' + p + '" required />\
			<td><input type="text" name="width[]" placeholder="Width" onkeyup="nlCals(this.value, this, \'wtnl' + p + '\');" class="form-control name_list" required />\
			<td class="hidden-td"><input type="text" id = "widthnl[]" name="widthnl[]" placeholder="Width NL" class="form-control name_list wtnl' + p + '" required />\
			<td><input type="text" name="wastage[]" placeholder="Wastage" class="form-control name_list" required />\
			<td>\
				<select class="form-control select2" name="unit[]" id="unit[]">\
					<option value="0">Select</option>\
					<?php if (count($product_unit) > 0) {
						foreach ($product_unit as $pu) { ?> \
							<option <?php if ($pu->UN_Id == $data['UN_Id']) {
								echo 'selected';
						} ?> value="<?= $pu->UN_Id; ?>">	<?= $pu->UN_Name; ?> </option> <?php }
			} ?>required />\
			<td><input type="text" name="quantity[]" placeholder="Quantity" class="form-control name_list" required /><td><button type="button" name="remove" id="' + i + '" data-p="'+p+'" class="btn btn-danger btn_remove" style ="width: 72px;">X</button></td>\
			<td><button type="button" name="remove" id="'+p+'" data-p="'+p+'" class="btn btn-primary btn_copy" style="width: 40px;" onclick="copyThis(this);">\
				<i class="fa fa-copy"></i>\
			</button></td>\
			</tr><tr class="copy3-'+p+'"><td colspan="11" id="add-'+p+'">'+prodDetails+'</td></tr>');
			//<td><input type="text" name="rate[]" placeholder="Rate " class="form-control name_list" required /><td>
			
			$('.r' + p).find('.prodname').on('change', function(){
				var prdId = $(this).val();
				var basePath = '<?php echo AD_BASE_PATH; ?>';
				var url = basePath + 'sales_enquiries/getPolish';
				//var parent = $(this).parent().parent();
				var parent = $(this).parent().attr('class');
				//$(parent).find('.pdrate').val(0);
				$('.'+parent).find('.pdrate').val(0);
				$.post(url, {prdId}, function(data){
					//$(parent).find('.polishType').html('<option value="0">Select</option>');
					$('.'+parent).find('.polishType').html('<option value="0">Select</option>');
					if(data) {
						for(var i=0; i<data.length; i++) {
							//$(parent).find('.pdrate').val(data[i].PR_Price);
							$('.'+parent).find('.pdrate').val(data[i].PR_Price);
							//$(parent).find('.polishType').append('<option value="'+data[i].PO_Id+'">'+data[i].PO_Name+'</option>');
							$('.'+parent).find('.polishType').append('<option value="'+data[i].PO_Id+'">'+data[i].PO_Name+'</option>');
						}
					}
					
				},'json');		
			});
			
			$('.r' + p).find('.polishType').on('change', function(){
				var poId = $(this).val();
				var basePath = '<?php echo AD_BASE_PATH; ?>';
				var url = basePath + 'sales_enquiries/getPolishRates';
				//var parent = $(this).parent().parent();
				var parent = $(this).parent().attr('class');
				//$(parent).find('.porate').val(0);
				$('.'+parent).find('.porate').val(0);
				//$(parent).find('.porate').val(0);
				$('.'+parent).find('.porate').val(0);
				//var pdId = $(parent).find('.prodname').val();
				var pdId = $('.'+parent).find('.prodname').val();
				$.post(url, {poId,pdId}, function(data){
					//console.log(data);
					//$(parent).find('.porate').val(data.PO_Rate);				
					$('.'+parent).find('.porate').val(data.PO_Rate);				
				},'json');	
			});
			
		});

		$("#salesadd").validate({
			errorClass: "error fail-alert",
			validClass: "valid success-alert",
			rules: {
				cusname: {
					required: true,
					minlength: 3,
				},
				phone: {
					required: true,
					minlength: 10,
					maxlength: 10
				},
			},
			messages: {
				cusname: {
					required: "Please enter your name",
					minlength: "Name should be at least 3 characters",
				},
				phone: {
					required: "Please enter your mobile number",
					minlength: "Mobile Number should be 10 digit Number",
					maxlength: "Mobile Number should be 10 digit Number"
				},
			}
		});
		$(document).on('click', '.btn_remove', function () {
			//var button_id = $(this).attr("id");
			var remove_Id = $(this).attr("data-p");
			$('.r' + remove_Id).parent().remove();
			$('#row' + remove_Id).remove();
			$('#add-' + remove_Id).parent().remove();
		});


		$('#save').on('click', function (e) {
			var basePath = '<?php echo AD_BASE_PATH; ?>';
			var url = basePath + 'sales_enquiries/save';
			//var s=$.post(url, $('#salesadd').serialize();
			$.post(url, $('#salesadd').serialize(), function (data) {
				if (data.class == "success") {
					$('.message').show();
					$('.message').css("background-color", "green");
					$('.message').css("color", "white");
					$('.message').html(data.msg);
					$('#salesadd')[0].reset();
					window.location.reload();
				}
				else {
					$('.message').show();
					$('.message').css("background-color", "red");
					$('.message').css("color", "white");
					$('.message').html(data.msg);
				}
			}, 'json');
		});
		$('.searchform').chosen();
		
		$('.prodname').on('change', function(){
			
			var prdId = $(this).val();
			var basePath = '<?php echo AD_BASE_PATH; ?>';
			var url = basePath + 'sales_enquiries/getPolish';
			//var parent = $(this).parent().parent().parent();
			var parent = $(this).parent().parent().attr('class');
			
			/*$(parent).find('.pdrate').val(0);
			$(parent).find('.porate').val(0);*/
			$('.'+parent).find('.pdrate').val(0);
			$('.'+parent).find('.porate').val(0);
			$.post(url, {prdId}, function(data){
				//$(parent).find('.polishType').html('<option value="0">Select</option>');
				$('.'+parent).find('.polishType').html('<option value="0">Select</option>');
				if(data) {
					for(var i=0; i<data.length; i++) {
						//$(parent).find('.pdrate').val(data[i].PR_Price);
						$('.'+parent).find('.pdrate').val(data[i].PR_Price);
						//$(parent).find('.polishType').append('<option value="'+data[i].PO_Id+'">'+data[i].PO_Name+'</option>');
						$('.'+parent).find('.polishType').append('<option value="'+data[i].PO_Id+'">'+data[i].PO_Name+'</option>');
					}
				}
				
			},'json');		
		});
		
		$('.polishType').on('change', function(){
			var poId = $(this).val();
			var basePath = '<?php echo AD_BASE_PATH; ?>';
			var url = basePath + 'sales_enquiries/getPolishRates';
			//var parent = $(this).parent().parent().parent();
			var parent = $(this).parent().parent().attr('class');
			//$(parent).find('.porate').val(0);
			$("."+parent).find('.porate').val(0);
			//var pdId = $(parent).find('.prodname').val();
			var pdId = $("."+parent).find('.prodname').val();
			$.post(url, {poId,pdId}, function(data){
				console.log(data);
				//$(parent).find('.porate').val(data.PO_Rate);				
				$("."+parent).find('.porate').val(data.PO_Rate);				
			},'json');	
		});
		
		$('#deliverydate').datepicker({
			startDate: new Date()  // Set the earliest selectable date to today
		}).datepicker('update', new Date());
		
		
	});
	function fetchcust() {
		var basePath = '<?php echo AD_BASE_PATH; ?>';
		var id = document.getElementById('cuid').value;
		var url = basePath + 'sales_enquiries/fetchcust/' + id;
		$.post(url, function (data) {
			if (data.class == "success") {
				document.getElementById('cusname').value = data.name;
				document.getElementById('phone').value = data.phone;
				document.getElementById('adress').value = data.address;
				document.getElementById('gst').value = data.gst;
			}
		}, 'json');
	}
</script>
