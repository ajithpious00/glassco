<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
	$(document).ready(function () {
		$('#save').on('click', function (e) {
			var basePath = '<?php echo AD_BASE_PATH; ?>';
			var url = basePath + 'admin/product/save';
			$.post(url, $('#productadd').serialize(), function (data) {
				if (data.class == "success") {
					$('.message').show();
					$('.message').css("background-color", "green");
					$('.message').css("color", "white");
					$('.message').html(data.msg);
					$('#productadd')[0].reset();
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
	});
	var p = 0;
	$(document).ready(function () {
		$('#addmore').click(function () {
			///alert('hi');
			var i = 0;
			i++;
			p++;
			var prodDetails = $('.product-add-ons').html();
			$('#polish_field').append('<tr id="row' + p + '" class="payment-added">\
			<td>\
				<select class="form-control select2" style="width: 300px;" name="polishtype[]" id="polishtype[]">\
					<option value="0">Select</option>\
					<?php if (count($polish_type) > 0) {
						foreach ($polish_type as $po) { ?> \
							<option <?php if ($po->PO_Id == $data['PO_Id']) {
								echo 'selected';
						} ?> value="<?= $po->PO_Id; ?>">	<?= $po->PO_Name; ?> </option> <?php }
			} ?>required />\
			<td><input type="text" name="polishrate[]" placeholder="Rate" class="form-control name_list" required />\
			<td><button type="button" name="remove" id="' + i + '" data-p="'+p+'" class="btn btn-danger btn_remove" style ="width: 72px;">X</button></td></tr>');
			
			
			
		});
	});
	$(document).on('click', '.btn_remove', function () {
			//var button_id = $(this).attr("id");
			var remove_Id = $(this).attr("data-p");
			$('#row' + remove_Id).remove();
			$('#add-' + remove_Id).parent().remove();
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