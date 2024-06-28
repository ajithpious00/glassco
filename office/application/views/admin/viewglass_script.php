<script>
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
   $('#edgeTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':baseurl+'admin/Viewglass/listing'
      },
      'columns': [
         { data: 'Edge_type' }
      ]
   });
});
</script>