<script>
$(document).ready(function(){
	
	$('#usertype').on('change', function(){
		var val = $(this).val();
		if(val==5) 
			$('#saleArea').show();
		else 
			$('#saleArea').hide();
	});
});
</script>