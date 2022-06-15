<?php if ($this->session->has_userdata('message')) : ?>
    <!-- <div class="alert"></div> -->
    <script>
        $(function() {
            var text = '<?= $this->session->flashdata('message'); ?>';
            // $('.alert').fadeIn('animated fadeIn').delay(2000).fadeOut('animated fadeOut').html('<div class="alert alert-danger role="alert" data-type="inverse" data-from="top" data-align="right" data-icon="fa fa-comments">' + text + '</div>');


            $.growl({
                icon: 'fa fa-bell',

                message: text,

            }, {
                element: 'body',
                type: 'success',
                allow_dismiss: true,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                spacing: 10,
                z_index: 999999,
                delay: 2500,
                timer: 1000,
                url_target: '_blank',
                mouse_over: false,
                animate: {
                    enter: 'animated fadeInRight',
                    exit: 'animated fadeOutRight'
                },
                icon_type: 'class',

                template: '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-bell"> </i> Info!</h4>' + text + '</div>',

            });
        });
    </script>

<?php endif; ?>