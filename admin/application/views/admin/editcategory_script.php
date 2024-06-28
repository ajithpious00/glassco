<script>
$("#saveCategory").click(function(){
			var url='<?php echo base_url(); ?>/admin/Editcategory/insert';
			$.post(url, $( "#categoryForm" ).serialize(),function(response){
			if(response){
				$('#finished').html('Category details updated successfully');
				$('#finished').show();
			}
			},'json');
});
</script>