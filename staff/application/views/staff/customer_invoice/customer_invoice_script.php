<script>
$(document).ready(function () {
	   var i=1;
      var url = '<?php echo AD_BASE_PATH; ?>';
	  var pagelength = <?= !isset($_COOKIE['invoicePageLength']) ? 10 : $_COOKIE['invoicePageLength'] ?>;
      $('#invoiceTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': url + 'customer_invoice/get_sale_enquiries'
         },
         'columns': [
			{ data: 'slno' },
			{ data: 'Order_No' },
			{ data: 'Customer' },
			{ data: 'action' },
         ]
      });
});
function confirm_delete(__dId){
		//alert(__dId);exit();
		var res = confirm('Are you sure you want to delete this item?');
		if(res) {
			if(__dId) {
				var url = '<?php echo AD_BASE_PATH; ?>' + "customer_invoice/remove_sales";
				$.post(url, {"CID" : __dId}, function(response){
					$('#salesTable').DataTable().ajax.reload();
				},'json');
			}
		}
	}
</script>