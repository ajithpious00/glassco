<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js" integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	function fetchdata() {
		var basePath = '<?php echo base_url(); ?>';
		var id = document.getElementById('woid').value;
		var url = basePath + 'return_order/fetchdata/' + encodeURIComponent(id);
		// console.log(url);
		$.post(url, function(data) {
			if (data.class == "success") {
				document.getElementById('cuid').value = data.id;
				document.getElementById('cusname').value = data.name;
				document.getElementById('phone').value = data.phone;
				document.getElementById('adress').value = data.address;
			}
		}, 'json');
	}
	$(document).ready(function() {
		$('#save').on('click', function(e) {
			var basePath = '<?php echo base_url(); ?>';
			var url = basePath + 'return_order/save';
			$.post(url, $('#returnorder').serialize(), function(data) {
				if (data.class == "success") {
					$('.message').show();
					$('.message').css("background-color", "green");
					$('.message').css("color", "white");
					$('.message').html(data.msg);
					setTimeout(function() {
						window.location.reload();
					}, 10000);
				} else {
					$('.message').show();
					$('.message').css("background-color", "red");
					$('.message').css("color", "white");
					$('.message').html(data.msg);
				}
			}, 'json');
		});
		$('#addmore').click(function() {
			var i = 0;
			i++;
			$('#product_field').append('<tr id="row' + i + '" class="payment-added"><td><select class="form-control select2" style="width: 90px;" name="productname[]" id="productname[]"><option value="0">Select</option> <?php if (count($product) > 0) {
																																																								foreach ($product as $pt) { ?> <option <?php if ($pt->ID == $data['ID']) {
																																																										echo 'selected';
																																																									} ?> value="<?= $pt->ID; ?>">	<?= $pt->Name; ?> </option> <?php }
																																																							} ?>required /><td><input type="text" name="height[]" placeholder="Height" class="form-control name_list" required /><td><input type="text" name="width[]" placeholder="Width" class="form-control name_list" required /><td><select class="form-control select2" style="width: 90px;" name="unit[]" id="unit[]"><option value="0">Select</option> <?php if (count($product_unit) > 0) {
																																																																																									foreach ($product_unit as $pu) { ?> <option <?php if ($pu->UN_Id == $data['UN_Id']) {
																																																																																											echo 'selected';
																																																																																										} ?> value="<?= $pu->UN_Id; ?>">	<?= $pu->UN_Name; ?> </option> <?php }
																																																																																								} ?>required /><td><select class="form-control select2" style="width: 90px;" name="type[]" id="type[]"><option value="0">Select</option> <?php if (count($product_type) > 0) {
																																							foreach ($product_type as $pt) { ?> <option <?php if ($pt->ID == $data['ID']) {
																																									echo 'selected';
																																								} ?> value="<?= $pt->ID; ?>">	<?= $pt->Edge_type; ?> </option> <?php }
																																						} ?>required /><td><input type="text" name="quantity[]" placeholder="Quantity" class="form-control name_list" required /><td><input type="text" name="rate[]" placeholder="Rate" class="form-control name_list" required /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove" style ="width: 72px;">X</button></td></tr>');
		});
		$('.searchform').chosen();
	});
	$(document).on('click', '.btn_remove', function() {
		var button_id = $(this).attr("id");
		$('#row' + button_id + '').remove();
	});
</script>