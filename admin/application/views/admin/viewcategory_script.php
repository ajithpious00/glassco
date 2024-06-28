<script>
var datatable;
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
	datatable=$('#categoryTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':baseurl+'admin/Viewcategories/listing'
      },
      'columns': [
         { data: 'Name' },
		 { data: 'action' },
      ]
   });
});
function delete_this(Id){
	 var baseurl='<?php echo base_url(); ?>admin/Viewcategories/delete';
	 var deleteConfirm = confirm("Are you sure you want to delete this category.?");
	if (deleteConfirm == true) {
		 $.post(baseurl, {Id}, function(response){
			if(response) {
				datatable.clear().draw();
			}		 
		 },'json');
	}	
 }
</script>