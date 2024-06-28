<script>
$("#savesubcategory").click(function(){
			var url='<?php echo base_url(); ?>/admin/Subcategory/insert';
			$.post(url, $( "#subCategoryForm" ).serialize(),function(response){
			if(response){
				$('#finished').html('Subcategory details Saved Successfully');
				$('#finished').show();
				window.location.reload();
			}
			},'json');
});
</script>