<script>
   $(document).ready(function () {
	   var i=1;
      var url = '<?php echo AD_BASE_PATH; ?>';
	  var pagelength = <?= !isset($_COOKIE['rejectPageLength']) ? 10 : $_COOKIE['rejectPageLength'] ?>;
      $('#rejectTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': url + 'rejected_enquiries/get_reject_details'
         },
         'columns': [
			{ data: 'slno' },
			{ data: 'Order_No' },
			{ data: 'Customer' },
            { data: 'Status' },
			{ data: 'detail' },
			{ data: 'action' },
         ]
      });
});
function confirm_delete(__dId){
		//alert(__dId);exit();
		var res = confirm('Are you sure you want to delete this item?');
		if(res) {
			if(__dId) {
				var url = '<?php echo AD_BASE_PATH; ?>' + "rejected_enquiries/remove_sales";
				$.post(url, {"CID" : __dId}, function(response){
					$('#rejectTable').DataTable().ajax.reload();
				},'json');
			}
		}
	}
</script>