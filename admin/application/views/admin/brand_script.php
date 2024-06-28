<script>
    $(document).ready(function(){
		$("#savebrand").click(function(){
			$('#brandForm').submit();
			$('#finished').html('Brand details saved successfully');
		    $('#finished').show();
		});
		
		$("#brandForm").on('submit',(function(e) {
			var burl='<?php echo base_url(); ?>/admin/Brand/insert';
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
	