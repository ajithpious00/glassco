<script>
function printthis() {
	var basePath = '<?php echo AD_BASE_PATH; ?>';
	var metahead = $('head').html();
	var header = '<!DOCTYPE html><html lang="en"><head>'+metahead+'</head><body>';
	$('.button-box').hide();
	var invoiceDoc = header + $('.content-wrapper').html() + '</body></html>';
	var url = basePath + 'Sales_enquiries/save_proforma_invoice';
	var cuid = '<?= $customerdetail->CU_Id; ?>';
	var wo = '<?= $order_number->PD_Order_No; ?>';
	//alert(wo);
	$.post(url, {invoiceDoc, cuid, wo}, function(data){
		if(data) {
			
		}
		else {
			
		}
		$('.button-box').show();
	},'json');
	
	
}
$(document).ready(function(){
	printthis();
})
function printDiv() {
	//alert('hi');
			var metahead = $('head').html();
			var header = '<!DOCTYPE html><html lang="en"><head>'+metahead+'</head><body>';
			$('.button-box').hide();
           // var divContents = document.getElementById("perfomainvoice").innerHTML;
			var invoiceDoc = header + $('.content-wrapper').html() + '</body></html>';
            var a = window.open('', '', 'height=500, width=500');
            a.document.write(metahead);
            a.document.write(header);
            a.document.write(invoiceDoc);
            //a.document.write(divContents);
           // a.document.write('</body></html>');
            a.document.close();
            a.print();
			window.location.reload();
        }
</script>