<?php

(defined('ABSPATH')) || exit;
// افزودن فیلد تصویر به دسته‌بندی‌ها
add_action( 'category_add_form_fields', 'add_category_image_field', 10, 2 );
add_action( 'category_edit_form_fields', 'edit_category_image_field', 10, 2 );

function add_category_image_field( $taxonomy ) {
    ?>
    <div class="form-field term-group">
        <label for="category-image-id"><?php _e('تصویر دسته‌بندی', 'text-domain'); ?></label>
        <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
        <div id="category-image-wrapper"></div>
        <p>
            <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e('افزودن تصویر', 'text-domain'); ?>" />
            <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e('حذف تصویر', 'text-domain'); ?>" />
        </p>
    </div>
    <?php
}

function edit_category_image_field( $term, $taxonomy ) {
    $image_id = get_term_meta( $term->term_id, 'category-image-id', true );
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row"><label for="category-image-id"><?php _e('تصویر دسته‌بندی', 'text-domain'); ?></label></th>
        <td>
            <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
            <div id="category-image-wrapper">
                <?php if( $image_id ) { echo wp_get_attachment_image( $image_id, 'thumbnail' ); } ?>
            </div>
            <p>
                <input type="button" class="button button-secondary ct_tax_media_button" id="ct_tax_media_button" name="ct_tax_media_button" value="<?php _e('افزودن تصویر', 'text-domain'); ?>" />
                <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e('حذف تصویر', 'text-domain'); ?>" />
            </p>
        </td>
    </tr>
    <?php
}

// ذخیره‌سازی فیلد تصویر
add_action( 'created_category', 'save_category_image' );
add_action( 'edited_category', 'save_category_image' );

function save_category_image( $term_id ) {
    if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
        update_term_meta( $term_id, 'category-image-id', absint( $_POST['category-image-id'] ) );
    }
}

// افزودن اسکریپت‌های مدیریت رسانه
add_action( 'admin_enqueue_scripts', 'load_media' );
function load_media() {
    wp_enqueue_media();
}

// اسکریپت اختصاصی برای آپلود تصویر
add_action( 'admin_footer', 'add_script' );
function add_script() {
    ?>
    <script>
        jQuery(document).ready( function($) {
            // افزودن تصویر
            $('.ct_tax_media_button').click( function(e) {
                e.preventDefault();
                var button = $(this);
                var custom_uploader = wp.media({
                    title: 'انتخاب تصویر',
                    library: { type: 'image' },
                    button: { text: 'استفاده از این تصویر' },
                    multiple: false
                }).on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    $('#category-image-id').val(attachment.id);
                    $('#category-image-wrapper').html('<img src="' + attachment.url + '" alt="" style="max-width:100px;"/>');
                }).open();
            });

            // حذف تصویر
            $('.ct_tax_media_remove').click( function(e) {
                e.preventDefault();
                $('#category-image-id').val('');
                $('#category-image-wrapper').html('');
            });
        });
    </script>
    <?php
}