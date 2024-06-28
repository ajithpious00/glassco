<script>
var datatable;
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
   datatable=$('#productTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':baseurl+'admin/Viewproduct/listing'
      },
      'columns': [
		  { data: 'Brand' },
	     { data: 'Code' },
         { data: 'Name' },
         { data: 'Category' },
         { data: 'Sub_Category' },
         { data: 'Available_Stock' },
		 { data: 'action' },
      ]
   });
});
function delete_this(Id){
	 var baseurl='<?php echo base_url(); ?>admin/Viewproduct/delete';
	 var deleteConfirm = confirm("Are you sure you want to delete this product.?");
	if (deleteConfirm == true) {
		 $.post(baseurl, {Id}, function(response){
			if(response) {
				datatable.clear().draw();
			}		 
		 },'json');
	}	
 }
</script>