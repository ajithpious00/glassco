<script>
var datatable;
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
    datatable= $('#brandTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':baseurl+'admin/Viewbrand/listing'
      },
      'columns': [
         { data: 'Name' },
		 { data: 'Logo' },
		 { data: 'action' },
      ]
   });
});
function delete_this(Id){
	 var baseurl='<?php echo base_url(); ?>admin/Viewbrand/delete';
	 var deleteConfirm = confirm("Are you sure you want to delete this brand.?");
	if (deleteConfirm == true) {
		 $.post(baseurl, {Id}, function(response){
			if(response) {
				datatable.clear().draw();
			}		 
		 },'json');
	}	 
 }
</script>