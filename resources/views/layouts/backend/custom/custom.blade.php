<script>
    $(document).ready(function() {

        let success = `<?php echo session()->has('success') ?>`;
        let error = `<?php echo session()->has('error') ?>`;

        if (success) toastrNotification('success', "<?php echo session()->get('success'); ?>");

        if (error) toastrNotification('error', "<?php echo session()->get('error'); ?>");

        $(document).off("click", ".delete").on("click", ".delete", function(e) {
            e.preventDefault();

            let url = $(this).attr('href');
            let title = $(this).data('title');
            let message = $(this).data('message');

            confirmDeleteBox(url, title, message);
        })

    })

    toastrNotification = (type, message) => {
        toastr[type](message);
    }

    confirmDeleteBox = (url, title, message) => {
        swal({
                title: title,
                text: message,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {
                            '_method': 'delete',
                            '_token': `<?php echo csrf_token() ?>`
                        },
                        success: (response) => {
                            if (response.status === 'success') {
                                window.location.replace(response.redirectUrl);
                            }
                        },
                        error: (response) => {
                            toastrNotification('error', response.responseJSON.message);
                        }
                    });
                }
            });
    }
</script>