<script>
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
        }
</script>