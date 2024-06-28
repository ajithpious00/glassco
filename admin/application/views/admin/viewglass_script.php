<script>
var datatable;
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
  datatable= $('#edgeTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':baseurl+'admin/Viewglass/listing'
      },
      'columns': [
         { data: 'Edge_type' },
		 { data: 'action' },
      ]
   });
});
function delete_this(Id){
	 var baseurl='<?php echo base_url(); ?>admin/Viewglass/delete';
	 var deleteConfirm = confirm("Are you sure you want to delete this glass edge.?");
	if (deleteConfirm == true) {
		 $.post(baseurl, {Id}, function(response){
			if(response) {
				datatable.clear().draw();
			}		 
		 },'json');
	}	
 }
</script>