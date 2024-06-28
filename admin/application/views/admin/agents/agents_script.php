<script>
$(document).ready(function () {
	//alert('hi');
	   //var i=1;
      var url = '<?php echo AD_BASE_PATH; ?>';
	//  alert(url);
	  var pagelength = <?= !isset($_COOKIE['agentPageLength']) ? 10 : $_COOKIE['agentPageLength'] ?>;
      $('#salesTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': url + 'admin/agents/get_agents'
         },
         'columns': [
			{ data: 'slno' },
			{ data: 'Agent_Name'},
			{ data: 'Agent_Code'},
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
				var url = '<?php echo AD_BASE_PATH; ?>' + "admin/agents/remove_agent";
				$.post(url, {"CID" : __dId}, function(response){
					$('#salesTable').DataTable().ajax.reload();
				},'json');
			}
		}
	}
</script>