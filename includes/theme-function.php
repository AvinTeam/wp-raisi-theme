<?php

(defined('ABSPATH')) || exit;

function image_url($path)
{
    return RAISI_IMAGE . $path . '?ver=' . RAISI_VERSION;
}

function get_view_part($path)
{
    require RAISI_VIEWS . "/$path.php";
}

function get_component($path)
{
    require RAISI_COMPONENTS . "/$path.php";
}
function sanitize_number($text)
{

    $western = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' ];
    $persian = [ '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' ];
    $arabic  = [ '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' ];
    $text    = str_replace($persian, $western, $text);
    $text    = str_replace($arabic, $western, $text);
    return $text;

}

function is_transient()
{
    $is_transient = get_transient('is_transient');
    if ($is_transient) {
        delete_transient('is_transient');
        return $is_transient;
    }
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

function get_header_title()
{

    if (is_home() || is_front_page()) {
        $title = "صفحه اصلی";
    } elseif (is_single()) {
        $title = get_the_title();
    } elseif (is_category()) {
        $title = single_cat_title('', false) . " | دسته‌بندی";
    } elseif (is_tag()) {
        $title = single_tag_title('', false) . " | برچسب";
    } elseif (is_search()) {
        $title = "نتایج جستجو برای " . get_search_query();
    } elseif (is_404()) {
        $title = get_bloginfo('name') . "صفحه پیدا نشد | ";
    } else {
        $title = get_bloginfo('name');
    }
    return $title;

}
