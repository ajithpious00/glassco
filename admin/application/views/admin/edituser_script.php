<script>
$("#saveUser").click(function(){
			var url='<?php echo base_url(); ?>/admin/Edituser/insert';
			$.post(url, $( "#userForm" ).serialize(),function(response){
			if(response){
				$('#finished').html('User details updated successfully');
				$('#finished').show();
			}
			},'json');
});
</script>