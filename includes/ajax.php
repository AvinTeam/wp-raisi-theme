<?php

add_action('wp_ajax_nopriv_raisi_sent_sms', 'raisi_sent_sms');
function raisi_sent_sms()
{
    if (wp_verify_nonce($_POST[ 'nonce' ], 'ajax-nonce')) {


    } else {
        wp_send_json_error('لطفا یکبار صفحه را بروزرسانی کنید', 403);
    }

}
