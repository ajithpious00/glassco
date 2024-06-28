<script>
   $(document).ready(function () {
      var baseurl = '<?php echo base_url(); ?>';
      $('#productTable').DataTable({
         'processing': true,
         'serverSide': true,
         'serverMethod': 'post',
         'ajax': {
            'url': baseurl + 'admin/Viewproduct/listing'
         },
         'columns': [
            { data: 'Code' },
            { data: 'Name' },
            { data: 'Category_id' },
            { data: 'Sub_category_id' },
            { data: 'Available_Stock' },
            { data: 'Unit_price' },
            { data: 'MRP' },
            { data: 'Width' },
            { data: 'Height' },
            { data: 'Brand_id' },
            { data: 'Thickness' },
         ]
      });
   });
</script>