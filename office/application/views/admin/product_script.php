<script>
$(document).ready(function(){
	$('#productMeasurement').on('change', function(){
		var val = $(this).val();
		var measurement=$('#productWeightValue').val();
		var convert=0;
		if(val==1) {
			convert=measurement*25.4;
		}
		else if(val==2){
			convert=measurement*304.8;
		}
		else if(val==3){
			convert=measurement*10;
		}
        $('#productWeightValueMM').val(convert);	
	});
});
</script>