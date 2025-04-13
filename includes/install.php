<?php

(defined('ABSPATH')) || exit;
function setup_theme_categories()
{
    // دسته‌بندی‌های اصلی
    $main_categories = [
        'news'      => 'اخبار',
        'slider'    => 'اسلایدر',
        'favorites' => 'برگزیده‌ها',
        'media'     => 'چندرسانه‌ای',
        'notes'     => 'یادداشت‌ها',
    ];

    // زیردسته‌های media
    $media_subcategories = [
        'video' => 'فیلم',
        'image' => 'عکس',
    ];

    // ایجاد یا بررسی دسته‌بندی‌های اصلی
    foreach ($main_categories as $slug => $name) {
        $term = term_exists($slug, 'category');
        if (! $term) {
            wp_insert_term($name, 'category', [
                'slug'        => $slug,
                'description' => $name,
            ]);
        }
    }

    // ایجاد زیردسته‌ها برای media
    $media_cat = term_exists('media', 'category');
    if ($media_cat) {
        foreach ($media_subcategories as $slug => $name) {
            $term = term_exists($slug, 'category');
            if (! $term) {
                wp_insert_term($name, 'category', [
                    'slug'        => $slug,
                    'parent'      => $media_cat[ 'term_id' ],
                    'description' => $name,
                ]);
            }
        }
    }
}
add_action('after_switch_theme', 'setup_theme_categories');