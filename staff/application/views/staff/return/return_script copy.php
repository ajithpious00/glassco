<script>
   function complete($woid) {
      var baseurl = '<?php echo base_url(); ?>';
      var id = $woid;
      let text = "Are you sure to continue";
      if (confirm(text) == true) {
         $.ajax({
            url: baseurl + 'returning/update/' + id,
         });
         window.location = baseurl + 'returning';
      } else {
         alert("You canceled!");
      }
   }

   function printDiv() {
      //alert('hi');
      var metahead = $('head').html();
      var header = '<!DOCTYPE html><html lang="en"><head>' + metahead + '</head><body>';
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
   $(document).ready(function() {
      var i = 1;
      var baseurl = '<?php echo base_url(); ?>';
      var pagelength = <?= !isset($_COOKIE['workorderPageLength']) ? 10 : $_COOKIE['workorderPageLength'] ?>;
      $('#ReturnTable').DataTable({
         order: [
            [1, 'asc']
         ],
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': baseurl + 'returning/get_work_order'
         },
         'columns': [{
               data: 'slno'
            },
            {
               data: 'Order_No'
            },
            {
               data: 'Customer'
            },
            {
               data: 'Status'
            },
            {
               data: 'detail'
            },
            {
               data: 'action'
            },
         ]
      });
   });
</script>