<script>
   $(document).ready(function () {
      var i = 1;
      var baseurl = '<?php echo base_url(); ?>';
      var pagelength = <?= !isset($_COOKIE['workorderPageLength']) ? 10 : $_COOKIE['workorderPageLength'] ?>;
      $('#historyTable').DataTable({
         order: [[1, 'asc']],
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': baseurl + 'return_order/get_work_order'
         },
         'columns': [
            { data: 'slno' },
            { data: 'Order_No' },
            { data: 'Customer' },
            { data: 'Status' },
            { data: 'detail' },
         ]
      });
   });
</script>