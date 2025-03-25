<?php

(defined('ABSPATH')) || exit;

function raisi_panel_js($path)
{
    return RAISI_JS . $path . '?ver=' . RAISI_VERSION;
}

function raisi_panel_css($path)
{
    return RAISI_CSS . $path . '?ver=' . RAISI_VERSION;
}

function raisi_panel_image($path)
{
    return RAISI_IMAGE . $path . '?ver=' . RAISI_VERSION;
}

function raisi_remote(string $url)
{
    $res = wp_remote_get(
        $url,
        [
            'timeout' => 1000,
         ]);

    if (is_wp_error($res)) {
        $result = (object) [
            'success' => false,
            'result'  => $res->get_error_message(),
         ];
    } else {
        $result = (object) [
            'success' => true,
            'result'  => json_decode($res[ 'body' ]),
         ];
    }

    return $result;
}

function raisi_start_working(): array
{
    $raisi_option = get_option('raisi_option');

    if (! isset($raisi_option[ 'version' ]) || version_compare(RAISI_VERSION, $raisi_option[ 'version' ], '>')) {

        update_option(
            'raisi_option',
            [
                'version'           => RAISI_VERSION,
                'tsms'              => (isset($raisi_option[ 'tsms' ])) ? $raisi_option[ 'tsms' ] : [ 'username' => '', 'password' => '', 'number' => '' ],
                'ghasedaksms'       => (isset($raisi_option[ 'ghasedaksms' ])) ? $raisi_option[ 'ghasedaksms' ] : [ 'ApiKey' => '', 'number' => '' ],
                'sms_text_otp'      => (isset($raisi_option[ 'sms_text_otp' ])) ? $raisi_option[ 'sms_text_otp' ] : 'کد تأیید شما: %otp%',
                'set_timer'         => (isset($raisi_option[ 'set_timer' ])) ? $raisi_option[ 'set_timer' ] : 1,
                'set_code_count'    => (isset($raisi_option[ 'set_code_count' ])) ? $raisi_option[ 'set_code_count' ] : 4,
                'sms_type'          => (isset($raisi_option[ 'sms_type' ])) ? $raisi_option[ 'sms_type' ] : 'tsms',
                'notificator_token' => (isset($raisi_option[ 'notificator_token' ])) ? $raisi_option[ 'notificator_token' ] : '',

                'token_password'    => (isset($raisi_option[ 'token_password' ])) ? $raisi_option[ 'token_password' ] : 'super_secret-key',
                'send_cron'         => (isset($raisi_option[ 'send_cron' ])) ? $raisi_option[ 'send_cron' ] : 'no',

             ]

        );

        update_option('raisi_crone_time', time());

    }

    return get_option('raisi_option');

}

function raisi_update_option($data)
{

    $raisi_option = get_option('raisi_option');

    $raisi_option = [
        'version'           => RAISI_VERSION,

        'tsms'              => (isset($data[ 'tsms' ])) ? $data[ 'tsms' ] : $raisi_option[ 'tsms' ],
        'ghasedaksms'       => (isset($data[ 'ghasedaksms' ])) ? $data[ 'ghasedaksms' ] : $raisi_option[ 'ghasedaksms' ],
        'set_timer'         => (isset($data[ 'set_timer' ])) ? absint($data[ 'set_timer' ]) : $raisi_option[ 'set_timer' ],
        'set_code_count'    => (isset($data[ 'set_code_count' ])) ? absint($data[ 'set_code_count' ]) : $raisi_option[ 'set_code_count' ],
        'sms_text_otp'      => (isset($data[ 'sms_text_otp' ])) ? sanitize_textarea_field($data[ 'sms_text_otp' ]) : $raisi_option[ 'sms_text_otp' ],
        'sms_type'          => (isset($data[ 'sms_type' ])) ? sanitize_text_field($data[ 'sms_type' ]) : $raisi_option[ 'sms_type' ],
        'notificator_token' => (isset($data[ 'notificator_token' ])) ? sanitize_text_field($data[ 'notificator_token' ]) : $raisi_option[ 'notificator_token' ],

        'token_password'    => (isset($data[ 'token_password' ])) ? sanitize_text_field($data[ 'token_password' ]) : $raisi_option[ 'token_password' ],
        'send_cron'         => (isset($data[ 'send_cron' ])) ? sanitize_text_field($data[ 'send_cron' ]) : $raisi_option[ 'send_cron' ],

     ];

    update_option('raisi_option', $raisi_option);

}

function tarikh($data, $type = '')
{

    $data_array = explode(" ", $data);

    $data = $data_array[ 0 ];
    $time = (sizeof($data_array) >= 2) ? $data_array[ 1 ] : 0;

    $has_mode = (strpos($data, '-')) ? '-' : '/';

    list($y, $m, $d) = explode($has_mode, $data);

    $ch_date = (strpos($data, '-')) ? gregorian_to_jalali($y, $m, $d, '/') : jalali_to_gregorian($y, $m, $d, '-');

    $has_mode = (strpos($ch_date, '-')) ? '-' : '/';

    list($y, $m, $d) = explode($has_mode, $ch_date);
    if ($m < 10) {$m = '0' . $m;}
    if ($d < 10) {$d = '0' . $d;}

    $ch_date = $y . $has_mode . $m . $has_mode . $d;

    if ($type == 'time') {
        $new_date = $time;
    } elseif ($type == 'date') {
        $new_date = $ch_date;
    } elseif ($type == 'w') {

        if (strpos($ch_date, '/')) {

            list($y, $m, $d) = explode('/', $ch_date);

            $ch_date = jalali_to_gregorian($y, $m, $d, '-');

        }

        $timestamp = strtotime($ch_date);
        $dayOfWeek = date('w', $timestamp);

        $daysOfWeekPersian = [ 'یکشنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه', 'شنبه' ];

        $new_date = $daysOfWeekPersian[ $dayOfWeek ];
    } else {
        $new_date = ($time === 0) ? $ch_date : $ch_date . ' ' . $time;
    }

    return $new_date;

}

function raisi_to_enghlish($text)
{

    $western = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ];
    $persian = [ '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ];
    $arabic  = [ '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ];
    $text    = str_replace($persian, $western, $text);
    $text    = str_replace($arabic, $western, $text);
    return $text;

}

function sanitize_phone($phone)
{

    /**
     * Convert all chars to en digits
     */

    $phone = raisi_to_enghlish($phone);

    //.9158636712   => 09158636712
    if (strpos($phone, '.') === 0) {
        $phone = '0' . substr($phone, 1);
    }

    //00989185223232 => 9185223232
    if (strpos($phone, '0098') === 0) {
        $phone = substr($phone, 4);
    }
    //0989108210911 => 9108210911
    if (strlen($phone) == 13 && strpos($phone, '098') === 0) {
        $phone = substr($phone, 3);
    }
    //+989156040160 => 9156040160
    if (strlen($phone) == 13 && strpos($phone, '+98') === 0) {
        $phone = substr($phone, 3);
    }
    //+98 9156040160 => 9156040160
    if (strlen($phone) == 14 && strpos($phone, '+98 ') === 0) {
        $phone = substr($phone, 4);
    }
    //989152532120 => 9152532120
    if (strlen($phone) == 12 && strpos($phone, '98') === 0) {
        $phone = substr($phone, 2);
    }
    //Prepend 0
    if (strpos($phone, '0') !== 0) {
        $phone = '0' . $phone;
    }
    /**
     * check for all character was digit
     */
    if (! ctype_digit($phone)) {
        return '';
    }

    if (strlen($phone) != 11) {
        return '';
    }

    return $phone;

}

function raisi_transient()
{
    $raisi_transient = get_transient('raisi_transient');

    if ($raisi_transient) {
        delete_transient('raisi_transient');
        return $raisi_transient;
    }

}

function is_mobile($mobile)
{
    $pattern = '/^(\+98|0)?9\d{9}$/';
    return preg_match($pattern, $mobile);
}

function sanitize_text_no_item($item)
{
    $new_item = [  ];

    foreach ($item as $value) {
        if (empty($value)) {continue;}
        $new_item[  ] = sanitize_text_field($value);
    }

    return $new_item;

}

function raisi_cookie(): string
{

    if (! isset($_COOKIE[ "setcookie_raisi_nonce" ])) {

        $is_key_cookie = wp_generate_password(20, true, true);

        setcookie("setcookie_raisi_nonce", $is_key_cookie, time() + 1800, "/");

    } else {

        $is_key_cookie = $_COOKIE[ "setcookie_raisi_nonce" ];

    }

    return $is_key_cookie;
}
