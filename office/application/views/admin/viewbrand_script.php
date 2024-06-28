<script>
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
   $('#brandTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':baseurl+'admin/Viewbrand/listing'
      },
      'columns': [
         { data: 'Name' },
		 { data: 'Logo' },
      ]
   });
});
</script>