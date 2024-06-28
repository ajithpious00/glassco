<script>
var datatable;
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
  datatable= $('#subTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':baseurl+'admin/Viewsubcategory/listing'
      },
      'columns': [
	     { data: 'Name' },
         { data: 'SB_Name' },
		 { data: 'action' },	
      ]
   });
});
function delete_this(Id){
	 var baseurl='<?php echo base_url(); ?>admin/Viewsubcategory/delete';
	 var deleteConfirm = confirm("Are you sure you want to delete this sub category.?");
	if (deleteConfirm == true) {
		 $.post(baseurl, {Id}, function(response){
			if(response) {
				datatable.clear().draw();
			}		 
		 },'json');
	}	
 }
</script>