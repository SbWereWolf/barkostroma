jQuery(document).ready(function($) {
    $(document).on('click', '.themo-notice-warning .notice-dismiss', function( event ) {
        data = {
            action : 'themo_admin_notice_dismissed',
        };

        $.post(ajaxurl, data, function (response) {
            //console.log(response, 'DONE!');
        });
    });
});