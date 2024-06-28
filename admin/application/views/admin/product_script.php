<script>
$("#saveProduct").click(function(){
			var url='<?php echo base_url(); ?>/admin/Product/insert';
			$.post(url, $( "#productForm" ).serialize(),function(response){
			if(response){
				$('#finished').html('Product details Saved Successfully');
				$('#finished').show();
			}
			},'json');
});
function getsubcat(cid){
	var url='<?php echo base_url(); ?>/admin/Product/getSubCategory';
	$("#subcategoryName").empty();
	$.post(url,{cid},function(data){
		console.log(data);
		if(data){
			for(var i=0;i<data.length;i++){
				$("#subcategoryName").append('<option value="'+data[i].ID+'">'+data[i].SB_Name+'</option>');
			}
		}
	},'json');
}
</script>