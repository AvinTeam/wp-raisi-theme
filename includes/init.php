<?php

(defined('ABSPATH')) || exit;
function disable_admin_bar_for_specific_roles($show)
{
    if (is_user_logged_in()) {
        $user             = wp_get_current_user();
        $restricted_roles = [ 'subscriber' ];

        if (array_intersect($restricted_roles, $user->roles)) {
            return false;
        }
    }

    return $show;
}

add_action('init', 'raisi_action_init');

function raisi_action_init(): void
{

    if (! isset($_COOKIE[ "setcookie_raisi_nonce" ])) {
        setcookie("setcookie_raisi_nonce", wp_generate_password(20, true, true), time() + 1800, "/");
        header("Refresh:0");
        exit;

    }

}

function remove_wp_version()
{
    return '';
}
add_filter('the_generator', 'remove_wp_version');

function hide_theme_name()
{
    wp_dequeue_style('parent-style'); // غیرفعال کردن استایل‌های قالب والد
    wp_dequeue_style('child-style');  // غیرفعال کردن استایل‌های قالب فرزند
    wp_deregister_style('parent-style');
    wp_deregister_style('child-style');
}
add_action('wp_enqueue_scripts', 'hide_theme_name', 9999);

function disable_rest_api()
{
    if (! is_user_logged_in()) {
        wp_die(__('REST API is disabled.', 'textdomain'));
    }
}
add_action('rest_api_init', 'disable_rest_api', 1);
