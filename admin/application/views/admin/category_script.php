<script>
$("#saveCategory").click(function(){
			var url='<?php echo base_url(); ?>/admin/Categories/insert';
			$.post(url, $( "#categoryForm" ).serialize(),function(response){
			if(response){
				$('#finished').html('Category details Saved successfully');
				$('#finished').show();
			}
			},'json');
});
</script>