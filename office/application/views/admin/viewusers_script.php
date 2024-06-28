<script>
$(document).ready(function(){
	var baseurl='<?php echo base_url(); ?>';
   $('#userTable').DataTable({
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'ajax': {
          'url':baseurl+'admin/Viewuser/listing'
      },
      'columns': [
         { data: 'Name' },
         { data: 'Email' },
         { data: 'Mobile' },
         { data: 'Usertype' },
         { data: 'City' },
      ]
   });
});
</script>