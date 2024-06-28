<script>
$(document).ready(function () {
	$('#save').on('click', function(e){  
		var basePath = '<?php echo AD_BASE_PATH; ?>';
		var url = basePath + 'sales_enquiries/updateRate';
		$.post(url, $('#rate').serialize(), function(data){
			if(data.class=="success"){
				alert("Rate Update Successful");
				$('#rate')[0].reset();
				window.location.reload();
			}
			else{
				alert("Rate Update UnSuccessful");
			}
		},'json');
	});
	
});
</script>
