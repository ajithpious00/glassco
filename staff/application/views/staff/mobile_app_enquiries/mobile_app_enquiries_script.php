<script>
var dtable;
$(document).ready(function () {
	var i=1;
	var url = '<?php echo AD_BASE_PATH; ?>';
	var pagelength = <?= !isset($_COOKIE['mobilePageLength']) ? 10 : $_COOKIE['mobilePageLength'] ?>;
	dtable = $('#mobileTable').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			'ajax': {
			'url': url + 'mobile_app_enquiries/get_mobile_enquiries'
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
	  
	setInterval(function(){
		dtable.ajax.reload(); 
	},10000);
});
function confirm_delete(__dId){
		//alert(__dId);exit();
		var res = confirm('Are you sure you want to delete this item?');
		if(res) {
			if(__dId) {
				var url = '<?php echo AD_BASE_PATH; ?>' + "mobile_app_enquiries/remove_sales";
				$.post(url, {"CID" : __dId}, function(response){
					$('#mobileTable').DataTable().ajax.reload();
				},'json');
			}
		}
	}
</script>