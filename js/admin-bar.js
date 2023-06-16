jQuery(document).ready(function() {
    jQuery('#ab-form').ajaxForm({
        target: '#ab-update',
        url: ajaxurl,
        type: 'post',
        data: {
            action: 'update_form',
            security: AdminBar.admin_bar_security_nonce,
        },
        success: function() {
            var messageContainer = jQuery('#ab-update');
            while (messageContainer.queue() > 0);
            messageContainer.fadeIn(500, function() {
                jQuery(this).delay(3000).fadeOut(500);
            })
        }
    });
});
