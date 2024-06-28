<script>
$(document).ready(function () {
	//alert('hi');
	   //var i=1;
      var url = '<?php echo AD_BASE_PATH; ?>';
	//  alert(url);
	  var pagelength = <?= !isset($_COOKIE['polishPageLength']) ? 10 : $_COOKIE['polishPageLength'] ?>;
      $('#polishTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': url + 'admin/polish/get_polish'
         },
         'columns': [
			{ data: 'slno' },
			{ data: 'Polish_Name'},
			{ data: 'HSN_Code'},
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
				var url = '<?php echo AD_BASE_PATH; ?>' + "admin/polish/remove_polish";
				$.post(url, {"CID" : __dId}, function(response){
					$('#polishTable').DataTable().ajax.reload();
				},'json');
			}
		}
	}
</script>