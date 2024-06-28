<script>
$("#savesubcategory").click(function(){
			var url='<?php echo base_url(); ?>/admin/Editsubcategory/insert';
			$.post(url, $( "#subCategoryForm" ).serialize(),function(response){
			if(response){
				$('#finished').html('Sub category details updated successfully');
				$('#finished').show();
			}
			},'json');
});
</script>