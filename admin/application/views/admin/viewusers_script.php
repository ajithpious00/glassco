<script>
var datatable;
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
	datatable= $('#userTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':baseurl+'admin/Viewuser/listing'
      },
      'columns': [
         { data: 'US_Name' },
         { data: 'Email' },
         { data: 'Mobile' },
         { data: 'Usertype' },
         { data: 'City' },
		 { data: 'action' },
      ]
   });
});
   function delete_this(Id){
	 var baseurl='<?php echo base_url(); ?>admin/Viewuser/delete';
	 var deleteConfirm = confirm("Are you sure you want to delete this user.?");
	if (deleteConfirm == true) {
		 $.post(baseurl, {Id}, function(response){
			if(response) {
				datatable.clear().draw();
			}		 
		 },'json');
	}	
 }
</script>