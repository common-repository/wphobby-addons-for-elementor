jQuery(document).ready(function($){
    "use strict";

    // Admin Tabs
    $('.whae-tabs a').on('click', function(e) {
        e.preventDefault();
        $('.whae-tabs a').removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');
        var tab = $(this).attr('href');
        $('.whae-settings-tab').removeClass('active');
        $('.whae-settings-tabs')
            .find(tab)
            .addClass('active');
    });

    // Saving Data With Ajax Request
    $('.js-whae-settings-save').on('click', function(event) {
        event.preventDefault();

        var _this = $(this);

        $.ajax({
                url: localize.ajaxurl,
                type: 'post',
                data: {
                    "action": 'whae_save_settings_ajax',
                    "security": localize.nonce,
                    "fields": $('form#whae-settings').serialize()
                },
                success: function(response) {
                    display_custom_notifications();
                },
                error: function(response) {
                    console.log(response);
                }
         });


    });

    function display_custom_notifications() {
        var html = '<div class="message-box whae-message-box success">Settings Updated successfully</div>';
        $(html).appendTo(".whae-notification-wrapper").fadeIn('slow').animate({opacity: 1.0}, 2500).fadeOut('slow');
    }
});