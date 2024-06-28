<script>
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
   $('#categoryTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
         'url':baseurl+'admin/Viewcategory/listing'
      },
      'columns': [
         { data: 'Name' }
      ]
   });
});
</script>