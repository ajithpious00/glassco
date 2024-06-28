<script>
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
   $('#subcategoryTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':baseurl+'admin/Viewsubcategory/listing'
      },
      'columns': [
	     { data: 'ct.Name' },
         { data: 'sb.Name' }
      ]
   });
});
</script>