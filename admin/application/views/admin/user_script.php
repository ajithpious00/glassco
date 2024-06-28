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
$("#saveUser").click(function(){
			var url='<?php echo base_url(); ?>/admin/User/insert';
			$.post(url, $( "#userForm" ).serialize(),function(response){
			if(response){
				$('#finished').html('User details Saved Successfully');
				$('#finished').show();
				window.location.reload();
			}
			},'json');
			
});
</script>