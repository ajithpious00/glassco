<script>
    $(document).ready(function() {
        $('#finished').hide();
        $("#saveUser").click(function() {
            var url = '<?php echo base_url(); ?>/user/edit';
            $.post(url, $("#userForm").serialize(), function(response) {
                if (response) {
                    $('#finished').html('User details updated successfully');
                    $('#finished').show();
                    setTimeout(function() {
                    window.location.replace('<?php echo base_url(); ?>user');
				}, 1500);
                }
            }, 'json');
        });
    });
</script>