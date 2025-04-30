<?php
    if (! defined('ABSPATH')) {
        exit;
    }

    add_action('add_meta_boxes', 'raisi_add_meta_boxes');

    function raisi_add_meta_boxes(): void
    {
        add_meta_box(
            'raisi_aparat_link',
            'لینک ویدیو از آپارات',
            'submenu_raisi_aparat_callable',
            'post',
            'normal',
            'high',
        );

        function submenu_raisi_aparat_callable($post)
        {

            $raisi_aparat = get_post_meta($post->ID, '_raisi_aparat', true);

            update_post_meta($post->ID, '_raisi_aparat', esc_html($raisi_aparat));

            include_once RAISI_VIEWS . 'metabox/aparat.php';

        }

    }

    add_action('save_post', 'raisi_save_bax', 1, 3);

    function raisi_save_bax($post_id, $post, $updata)
    {
        if (isset($_POST[ 'raisi_aparat' ])) {
            update_post_meta($post_id, '_raisi_aparat', esc_html($_POST[ 'raisi_aparat' ]));
        }
    }

    /**
     * افزودن متاباکس برای انتخاب عکس‌ها
     */
    function add_image_selection_metabox()
    {
        add_meta_box(
            'image_selection_metabox',        // ID متاباکس
            'انتخاب عکس‌ها',     // عنوان متاباکس
            'render_image_selection_metabox', // تابع نمایش محتوا
            'post',                           // نوع پست (می‌توانید تغییر دهید)
            'normal',                         // موقعیت
            'high'                            // اولویت
        );
    }
    add_action('add_meta_boxes', 'add_image_selection_metabox');

    /**
     * نمایش محتوای متاباکس
     */
    function render_image_selection_metabox($post)
    {
        // دریافت مقادیر ذخیره شده
        $selected_images = get_post_meta($post->ID, '_selected_images', true);
        $image_ids       = ! empty($selected_images) ? explode(',', $selected_images) : [];

        // استفاده از nonce برای امنیت
        wp_nonce_field('image_selection_nonce_action', 'image_selection_nonce');

    ?>
<div class="image-selection-metabox">
    <input type="hidden" id="selected_images" name="selected_images" value="<?php echo esc_attr($selected_images); ?>">

    <div id="image-selection-container">
        <?php
                if (! empty($image_ids)) {
                        foreach ($image_ids as $image_id) {
                            $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
                            if ($image_url) {
                                echo '<div class="selected-image" data-id="' . esc_attr($image_id) . '">';
                                echo '<img src="' . esc_url($image_url) . '" width="150">';
                                echo '<button type="button" class="remove-image">حذف</button>';
                                echo '</div>';
                            }
                        }
                    }
                ?>
    </div>

    <button type="button" id="add-images-btn" class="button button-primary">انتخاب عکس‌ها</button>

    <style>
    .selected-image {
        display: inline-block;
        margin: 5px;
        position: relative;
    }

    .remove-image {
        position: absolute;
        top: 0;
        right: 0;
        background: red;
        color: white;
        border: none;
        cursor: pointer;
    }
    </style>

    <script>
    jQuery(document).ready(function($) {
        // باز کردن مدیا آپلودر
        $('#add-images-btn').click(function() {
            var frame = wp.media({
                title: 'عکس‌ها را انتخاب کنید',
                multiple: true,
                library: {
                    type: 'image'
                },
                button: {
                    text: 'استفاده از عکس‌های انتخاب شده'
                }
            });

            frame.on('select', function() {
                var attachments = frame.state().get('selection').toJSON();
                var imageIds = [];
                var container = $('#image-selection-container');

                // container.empty();

                attachments.forEach(function(attachment) {

                    container.append(
                        '<div class="selected-image" data-id="' +
                        attachment.id + '">' +
                        '<img src="' + attachment.url +
                        '" width="150">' +
                        '<button type="button" class="remove-image">حذف</button>' +
                        '</div>'
                    );
                    imageIds.push(attachment.id);
                });

                let old_img = $('#selected_images').val();
                $('#selected_images').val(old_img + ',' + imageIds.join(','));


            });

            frame.open();
        });

        // حذف عکس
        $(document).on('click', '.remove-image', function() {
            var imageId = $(this).parent().data('id');
            var currentIds = $('#selected_images').val().split(',');
            var newIds = currentIds.filter(function(id) {
                return id != imageId;
            });

            $('#selected_images').val(newIds.join(','));
            $(this).parent().remove();
        });
    });
    </script>
</div>
<?php
        }

        /**
         * ذخیره داده‌های متاباکس
         */
        function save_image_selection_metabox($post_id)
        {
            // بررسی nonce
            if (! isset($_POST[ 'image_selection_nonce' ]) ||
                ! wp_verify_nonce($_POST[ 'image_selection_nonce' ], 'image_selection_nonce_action')) {
                return;
            }

            // بررسی ذخیره خودکار
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            // بررسی مجوزهای کاربر
            if (! current_user_can('edit_post', $post_id)) {
                return;
            }

            // ذخیره داده‌ها
            if (isset($_POST[ 'selected_images' ])) {
                update_post_meta($post_id, '_selected_images', sanitize_text_field($_POST[ 'selected_images' ]));
            } else {
                delete_post_meta($post_id, '_selected_images');
            }
        }
        add_action('save_post', 'save_image_selection_metabox');