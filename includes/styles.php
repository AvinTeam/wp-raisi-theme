<?php

(defined('ABSPATH')) || exit;

add_action('admin_enqueue_scripts', 'raisi_admin_script');

function raisi_admin_script()
{

    wp_register_style(
        'jalalidatepicker',
        RAISI_VENDOR . 'jalalidatepicker/jalalidatepicker.min.css',
        [  ],
        '0.9.6'
    );
    wp_register_script(
        'jalalidatepicker',
        RAISI_VENDOR . 'jalalidatepicker/jalalidatepicker.min.js',
        [  ],
        '0.9.6',
        true
    );

    wp_enqueue_style(
        'raisi_admin',
        RAISI_CSS . 'admin.css',
        [ 'jalalidatepicker' ],
        RAISI_VERSION
    );

    wp_enqueue_media();

    wp_enqueue_script(
        'raisi_admin',
        RAISI_JS . 'admin.js',
        [ 'jquery', 'jalalidatepicker' ],
        RAISI_VERSION,
        true
    );

    wp_localize_script(
        'raisi_admin',
        'raisi_js',
        [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('ajax-nonce'),
         ]
    );

}

add_action('wp_enqueue_scripts', 'raisi_style');

function raisi_style()
{
    wp_register_style(
        'bootstrap',
        RAISI_VENDOR . 'bootstrap/bootstrap.min.css',
        [  ],
        '5.3.3'
    );
    wp_register_style(
        'bootstrap.rtl',
        RAISI_VENDOR . 'bootstrap/bootstrap.rtl.min.css',
        [ 'bootstrap' ],
        '5.3.3'
    );
    wp_register_style(
        'bootstrap.icons',
        RAISI_VENDOR . 'bootstrap/bootstrap-icons.min.css',
        [ 'bootstrap' ],
        '1.11.3'
    );
    wp_register_script(
        'bootstrap',
        RAISI_VENDOR . 'bootstrap/bootstrap.min.js',
        [  ],
        '5.3.3',
        true
    );

    wp_register_style(
        'select2',
        RAISI_VENDOR . 'select2/select2.min.css',
        [ 'bootstrap' ],
        '4.1.0-rc.0'
    );
    wp_register_script(
        'select2',
        RAISI_VENDOR . 'select2/select2.min.js',
        [  ],
        '4.1.0-rc.0',
        true
    );

    wp_register_style(
        'jalalidatepicker',
        RAISI_VENDOR . 'jalalidatepicker/jalalidatepicker.min.css',
        [  ],
        '0.9.6'
    );
    wp_register_script(
        'jalalidatepicker',
        RAISI_VENDOR . 'jalalidatepicker/jalalidatepicker.min.js',
        [  ],
        '0.9.6',
        true
    );

    wp_register_style(
        'swiper',
        RAISI_VENDOR . 'swiper/swiper-bundle.min.css',
        [  ],
        '11.2.2',
    );

    wp_register_script(
        'swiper',
        RAISI_VENDOR . 'swiper/swiper-bundle.min.js',
        [  ],
        '11.2.2',

    );

    wp_enqueue_style(
        'raisi_style',
        RAISI_CSS . 'public.css',
        [ 'bootstrap.rtl', 'bootstrap.icons', 'swiper', 'jalalidatepicker' ],
        RAISI_VERSION
    );

    wp_enqueue_script(
        'raisi_js',
        RAISI_JS . 'public.js',
        [ 'jquery', 'bootstrap', 'swiper', 'jalalidatepicker' ],
        RAISI_VERSION,
        true
    );

    wp_localize_script(
        'raisi_js',
        'raisi_js',
        [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('ajax-nonce'),

         ]
    );

}
