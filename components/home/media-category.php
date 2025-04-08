<?php
    $subcategory_link_video = "#";
    $subcategory_link_image = "#";

    $category_slug          = 'media'; // اسلاگ دسته‌ی والد
    $subcategory_slug_video = 'video'; // اسلاگ زیردسته
    $subcategory_slug_image = 'image'; // اسلاگ زیردسته

    // دریافت آیدی دسته‌ی والد
    $parent_category = get_term_by('slug', $category_slug, 'category');

    if ($parent_category) {
        // دریافت زیردسته
        $subcategory_video = get_term_by('slug', $subcategory_slug_video, 'category');
        $subcategory_image = get_term_by('slug', $subcategory_slug_image, 'category');

        if ($subcategory_video) {
            $subcategory_link_video = get_term_link($subcategory_video);
        }

        if ($subcategory_image) {
            $subcategory_link_image = get_term_link($subcategory_image);
        }
    }

?>






<a href="<?php echo esc_url($subcategory_link_video) ?>"
    class="h-168px w-168px secondary-shade-3 rounded-12px d-flex flex-column justify-content-center align-items-center">
    <img class="w-80px" src="<?php echo image_url('video_media.png') ?>" alt="">
    <span class="fw-500 f-14px text-secondary-tint-1 mt-16px">همه ی فیلم ها</span>
</a>
<div class="w-24px"></div>
<a href="<?php echo esc_url($subcategory_link_image) ?>"
    class="h-168px w-168px secondary-shade-3 rounded-12px d-flex flex-column justify-content-center align-items-center">
    <img class="w-80px" src="<?php echo image_url('img_media.png') ?>" alt="">
    <span class="fw-500 f-14px text-secondary-tint-1 mt-16px">همه ی تصویر ها</span>
</a>