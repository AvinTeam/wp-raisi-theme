<?php

(defined('ABSPATH')) || exit;

add_theme_support('post-thumbnails');
add_theme_support('menus');



function custom_theme_setup()
{
    register_nav_menus([
        'footer-menu' => 'فهرست اصلی',
     ]);
}
add_action('after_setup_theme', 'custom_theme_setup');