<script>
$("#saveEdgeType").click(function(){
			var url='<?php echo base_url(); ?>/admin/Edge/save_edge';
			$.post(url, $( "#glassedgetypeForm" ).serialize(),function(response){
			if(response){
				$('#finished').html('Glass edge details saved successfully');
				$('#finished').show();
			}
			},'json');
});
</script>