<script>
$(document).ready(function () {
	//alert('hi');
	   //var i=1;
      var url = '<?php echo AD_BASE_PATH; ?>';
	//  alert(url);
	  var pagelength = <?= !isset($_COOKIE['productPageLength']) ? 10 : $_COOKIE['productPageLength'] ?>;
      $('#productTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': url + 'admin/product/get_product'
         },
         'columns': [
			{ data: 'slno' },
			{ data: 'Product_Name'},
			{ data: 'Product_Hsn_Code'},
			{ data: 'Product_Rate'},
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
				var url = '<?php echo AD_BASE_PATH; ?>' + "admin/product/remove_product";
				$.post(url, {"CID" : __dId}, function(response){
					$('#productTable').DataTable().ajax.reload();
				},'json');
			}
		}
	}
</script>