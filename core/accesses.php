<?php

(defined('ABSPATH')) || exit;

add_theme_support('post-thumbnails');
add_theme_support('menus');

function custom_theme_setup()
{
    register_nav_menus([
        'primary'     => 'فهرست اصلی',
        'footer-menu' => 'فهرست فوتر',
     ]);
}
add_action('after_setup_theme', 'custom_theme_setup');

// ابتدا مطمئن شوید کلاس والد وجود دارد
if (! class_exists('Walker_Nav_Menu_Edit')) {
    require_once ABSPATH . 'wp-admin/includes/nav-menu.php';
}

// سپس Walker سفارشی را تعریف کنید
class Custom_Walker_Nav_Menu_Edit extends Walker_Nav_Menu_Edit
{
    public function start_el(&$output, $item, $depth = 0, $args = [  ], $id = 0)
    {
        $item_output = '';
        parent::start_el($item_output, $item, $depth, $args, $id);

        // کدهای سفارشی شما...
        $image_id  = get_post_meta($item->ID, '_menu_item_image', true);
        $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

        $field = '
            <p class="field-image description description-wide">
                <span class="menu-item-image-preview" style="display:' . ($image_url ? 'block' : 'none') . ';">
                    <img src="' . esc_url($image_url) . '" style="max-width:100px; height:auto;" />
                </span>
                <br>
                <label for="edit-menu-item-image-' . $item->ID . '">تصویر منو<br>
                    <input type="hidden" id="edit-menu-item-image-' . $item->ID . '" class="widefat edit-menu-item-image" name="menu-item-image[' . $item->ID . ']" value="' . esc_attr($image_id) . '" />
                    <button class="button button-secondary upload-menu-image" data-menu-item-id="' . $item->ID . '">انتخاب تصویر</button>
                    <button class="button button-secondary remove-menu-image" data-menu-item-id="' . $item->ID . '">حذف تصویر</button>
                </label>

            </p>
        ';

        $output .= preg_replace('/(?=<\/fieldset>)/', $field, $item_output);
    }
}

// فیلتر Walker
add_filter('wp_edit_nav_menu_walker', function () {
    return 'Custom_Walker_Nav_Menu_Edit';
}, 10, 2);

add_action('wp_update_nav_menu_item', 'save_menu_item_image', 10, 3);
function save_menu_item_image($menu_id, $menu_item_db_id, $args)
{
    if (isset($_POST[ 'menu-item-image' ][ $menu_item_db_id ])) {
        $image_id = (int) $_POST[ 'menu-item-image' ][ $menu_item_db_id ];
        update_post_meta($menu_item_db_id, '_menu_item_image', $image_id);
    } else {
        delete_post_meta($menu_item_db_id, '_menu_item_image');
    }
}

class Custom_Walker_Nav_Menu_Display extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $image_id = get_post_meta($item->ID, '_menu_item_image', true);
        $image    = $image_id ? wp_get_attachment_image($image_id, 'thumbnail', false, [
            'class' => 'menu-item-image',
            'style' => 'vertical-align:middle; margin-left:5px;',
         ]) : '';

        $output .= '<li class="menu-item">';
        $output .= $args->before;
        $output .= '<a href="' . esc_url($item->url) . '">';
        $output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $output .= $image;
        $output .= '</a>';
        $output .= $args->after;
    }
}

class Custom_Sidebar_Walker extends Walker_Nav_Menu
{
    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='submenu m-0 p-0 list-unstyled' style='display:none;'>\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        $image_id  = get_post_meta($item->ID, '_menu_item_image', true);
        $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

        $classes   = empty($item->classes) ? [] : (array) $item->classes;
        $is_active =(in_array('current-menu-item', $classes) || in_array('current-menu-ancestor', $classes)) ? 'active' : '';

        // بررسی برای پست‌ها و دسته‌بندی‌ها
        if (is_single() && $item->type === 'taxonomy' && $item->object === 'category') {
            $current_post = get_queried_object();
            $post_categories = get_the_category($current_post->ID);
            $category_ids = wp_list_pluck($post_categories, 'term_id');
            
            // بررسی مستقیم تطابق دسته‌بندی
            if (in_array($item->object_id, $category_ids)) {
                $is_active = 'active';
            }
            // اگر تطابق مستقیم نداشتیم، بررسی می‌کنیم که آیا این دسته‌بندی والد یکی از دسته‌بندی‌های پست است
            else {
                foreach ($post_categories as $cat) {
                    $ancestors = get_ancestors($cat->term_id, 'category');
                    if (in_array($item->object_id, $ancestors)) {
                        $is_active = 'active';
                        break;
                    }
                }
            }
        }

        $has_children = in_array('menu-item-has-children', $classes);

        // اضافه کردن کلاس submenu-item برای آیتم‌های زیرمنو
        if ($depth > 0) {
            $classes[] = 'submenu-item mx-3 mb-8px';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= $indent . '<li' . $class_names . '>';

        $output .= '<div class="h-56px menu-item-container d-flex align-items-center flex-row justify-content-between gap-2 f-16px fw-500 rounded-8px ' . $is_active . '">';
        $output .= '<a class="flex-grow-1 d-flex flex-row align-items-center justify-content-start gap-2 p-8px" href="' . esc_url($item->url) . '">';

        if ($image_url) {
            $output .= '<img class="w-24px h-24px" src="' . esc_url($image_url) . '" alt="' . esc_attr($item->title) . '">';
        }

        $output .= '<span>' . apply_filters('the_title', $item->title, $item->ID) . '</span>';
        $output .= '</a>';

        if ($has_children) {
            $output .= '<button class="btn menu-toggle arrow-toggle rounded-circle d-flex justify-content-center align-items-center me-2 p-0  w-20px h-20px" data-menu-type="' . $is_active . '" data-menu-id="' . $item->ID . '" aria-expanded="false">';
            $output .= '<i class="arrow-icon bi bi-chevron-left d-flex align-items-center flex-row justify-content-center f-10px"></i>';
            $output .= '</button>';
        }

        $output .= '</div>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}

class Footer_Menu_Walker extends Walker_Nav_Menu
{
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        if ($depth === 0 && $args->walker->has_children === false) {
            if (! empty($output)) {
                // اضافه کردن تصویر جداکننده قبل از هر آیتم به جز اولین
                $output .= '<img class="w-12px" src="' . image_url('dat.png') . '" alt="separator">';
            }

            // ساختار هر آیتم منو
            $output .= sprintf(
                '<a href="%s" class="text-secondary-tint-1 f-14px fw-500 mx-3">%s</a>',
                esc_url($item->url),
                esc_html($item->title)
            );
        }
    }
}
