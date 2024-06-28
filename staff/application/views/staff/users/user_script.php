<script>
    $(document).ready(function() {
        $('#finished').hide();
        $('#usertype').on('change', function() {
            var val = $(this).val();
            if (val == 5)
                $('#saleArea').show();
            else
                $('#saleArea').hide();
        });
        $("#saveUser").click(function() {
            var url = '<?php echo base_url(); ?>user/insert';
            $.post(url, $("#userForm").serialize(), function(response) {
                if (response) {
                    $('#finished').html('User details Saved Successfully');
                    $('#finished').show();
                    setTimeout(function() {
                        window.location.replace('<?php echo base_url(); ?>user');
                    }, 1500);
                }
            }, 'json');
        });
        var datatable;
        var baseurl = '<?php echo base_url(); ?>';
        datatable = $('#userTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': baseurl + 'user/listing'
            },
            'columns': [{
                    data: 'US_Name'
                },
                {
                    data: 'Email'
                },
                {
                    data: 'Mobile'
                },
                {
                    data: 'Usertype'
                },
                {
                    data: 'City'
                },
                {
                    data: 'action'
                },
            ]
        });
    });

    function delete_this(Id) {
        var baseurl = '<?php echo base_url(); ?>user/delete';
        var deleteConfirm = confirm("Are you sure you want to delete this user.?");
        if (deleteConfirm == true) {
            $.post(baseurl, {
                Id
            }, function(response) {
                if (response) {
                    $('#userTable').DataTable().ajax.reload();
                }
            }, 'json');
        }
    }
</script>