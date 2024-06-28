<script>
    $(document).ready(function(){
		$("#saveBrand").click(function(){
			$('#brandForm').submit();
			$('#finished').html('Brand details updated successfully');
		    $('#finished').show();
			setTimeout(function() {
				location.reload(true);
			}, 2000);
			
		});
		
		$("#brandForm").on('submit',(function(e) {
			var burl='<?php echo base_url(); ?>admin/Editbrand/update';
			e.preventDefault();
			$.ajax({
				url: burl,
				type: "POST",
				data:  new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				beforeSend : function()
				{
					//$("#preview").fadeOut();
					$("#err").fadeOut();
				},
				success: function(data)
				{
					if(data=='invalid')
					{
						// invalid file format.
						$("#err").html("Invalid File !").fadeIn();
					}
					else
					{
						// view uploaded file.
						$("#preview").html(data).fadeIn();
						$("#form")[0].reset(); 
					}
				},
				error: function(e) 
				{
					$("#err").html(e).fadeIn();
				}          
			});
			
		}));
		
	});
	</script>