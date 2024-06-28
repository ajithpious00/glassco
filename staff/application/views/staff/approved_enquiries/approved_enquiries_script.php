<script>
$(document).ready(function () {
	   var i=1;
      var url = '<?php echo AD_BASE_PATH; ?>';
	  var pagelength = <?= !isset($_COOKIE['approvePageLength']) ? 10 : $_COOKIE['approvePageLength'] ?>;
      $('#approveTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': url + 'approved_enquiries/get_approved_enquiries'
         },
         'columns': [
			{ data: 'slno' },
			{ data: 'Order_No' },
			{ data: 'Customer' },
           // { data: 'Name' },
            { data: 'Status' },
			// { data: 'detail' },
			{ data: 'action' },
         ]
      });
});
function confirm_delete(__dId){
		//alert(__dId);exit();
		var res = confirm('Are you sure you want to delete this item?');
		if(res) {
			if(__dId) {
				var url = '<?php echo AD_BASE_PATH; ?>' + "approved_enquiries/remove_sales";
				$.post(url, {"CID" : __dId}, function(response){
					$('#approveTable').DataTable().ajax.reload();
				},'json');
			}
		}
	}
</script>