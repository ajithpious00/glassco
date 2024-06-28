<script>
   $(document).ready(function () {
	   var i=1;
      var url = '<?php echo AD_BASE_PATH; ?>';
	  var pagelength = <?= !isset($_COOKIE['workorderPageLength']) ? 10 : $_COOKIE['workorderPageLength'] ?>;
      $('#workTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': url + 'work_order/get_work_order'
         },
         'columns': [
			{ data: 'slno' },
			{ data: 'Order_No' },
			{ data: 'Customer' },
			{ data: 'User' },
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
		var url = '<?php echo AD_BASE_PATH; ?>' + "work_order/remove_sales";
		$.post(url, {"CID" : __dId}, function(response){
			$('#workTable').DataTable().ajax.reload();
		},'json');
	}
	}
}
</script>