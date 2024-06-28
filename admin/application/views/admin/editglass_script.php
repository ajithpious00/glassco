<script>
$("#saveEdgeType").click(function(){
			var url='<?php echo base_url(); ?>/admin/Editglass/insert';
			$.post(url, $( "#glassedgetypeForm" ).serialize(),function(response){
			if(response){
				$('#finished').html('Glass edge details updated successfully');
				$('#finished').show();
			}
			},'json');
});
</script>