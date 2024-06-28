<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
	$(document).ready(function () {
		$('#save').on('click', function (e) {
			var basePath = '<?php echo AD_BASE_PATH; ?>';
			var url = basePath + 'admin/polish/save';
			$.post(url, $('#polishadd').serialize(), function (data) {
				if (data.class == "success") {
					$('.message').show();
					$('.message').css("background-color", "green");
					$('.message').css("color", "white");
					$('.message').html(data.msg);
					$('#polishadd')[0].reset();
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css"
	integrity="sha512-0nkKORjFgcyxv3HbE4rzFUlENUMNqic/EzDIeYCgsKa/nwqr2B91Vu/tNAu4Q0cBuG4Xe/D1f/freEci/7GDRA=="
	crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"
	integrity="sha512-eSeh0V+8U3qoxFnK3KgBsM69hrMOGMBy3CNxq/T4BArsSQJfKVsKb5joMqIPrNMjRQSTl4xG8oJRpgU2o9I7HQ=="
	crossorigin="anonymous" referrerpolicy="no-referrer"></script>