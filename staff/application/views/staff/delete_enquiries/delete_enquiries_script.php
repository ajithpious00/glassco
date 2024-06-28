<script>
   $(document).ready(function () {
	   var i=1;
      var url = '<?php echo AD_BASE_PATH; ?>';
	  var pagelength = <?= !isset($_COOKIE['deletePageLength']) ? 10 : $_COOKIE['deletePageLength'] ?>;
      $('#deleteTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': url + 'delete_enquiries/get_delete_details'
         },
         'columns': [
			{ data: 'slno' },
			{ data: 'Order_No' },
			{ data: 'Customer' },
         { data: 'Status' },
			// { data: 'detail' },
			{ data: 'action' },
         ]
      });
});
</script>