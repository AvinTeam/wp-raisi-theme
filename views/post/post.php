<?php
    // دریافت دسته‌بندی‌های پست
    $categories = get_the_category();

    $media_cat = "";

    // آرایه‌های جداگانه برای والد و فرزند
    $parent_categories = [  ];
    $child_categories  = [  ];

    foreach ($categories as $category) {
        if ($category->slug == 'slider') {
            continue;
        }
        // رد کردن دسته slider

        if ($category->parent == 0) {
            $parent_categories[  ] = $category;

        } else {
            $child_categories[  ] = $category;
        }

    }

    // ساختاردهی نهایی با ترتیب صحیح
    $ordered_categories = [  ];

    // اول دسته‌های والد
    foreach ($parent_categories as $parent) {
        $ordered_categories[  ] = [
            'title'     => $parent->name,
            'link'      => urldecode(get_category_link($parent->term_id)),
            'slug'      => $parent->slug,
            'is_parent' => true,
            'parent_id' => 0,
            'term_id'   => $parent->term_id,
         ];

        // سپس زیردسته‌های مربوط به این والد
        foreach ($child_categories as $key => $child) {
            if ($child->parent == $parent->term_id) {

                if ($child->slug == 'video' || $child->slug == 'image') {
                    $media_cat = $child->slug;
                }

                $ordered_categories[  ] = [
                    'title'     => $child->name,
                    'link'      => urldecode(get_category_link($child->term_id)),
                    'slug'      => $child->slug,
                    'is_parent' => false,
                    'parent_id' => $parent->term_id,
                    'term_id'   => $child->term_id,
                 ];
                unset($child_categories[ $key ]); // حذف از لیست زیردسته‌ها
            }

        }

    }
?>
<div class="p-8px">
    <?php

    

        $show_post_header = empty($media_cat) ? 'pic' : $media_cat;

        get_component('post/' . $show_post_header);

    ?>





    <div class="h-24px"></div>
    <p class="fw-bold f-20px "><?php the_title(); ?></p>
    <div class="d-flex flex-row align-items-center">
        <span
            class="text-secondary-tint-3 rounded-circle p-4px"><?php echo tarikh(get_the_date('Y-m-d'), 'm'); ?></span>

        <?php

            // یا می‌توانید به صورت دلخواه از آرایه استفاده کنید
            foreach ($ordered_categories as $cat) {
                echo '<div class="w-16px"></div>';
                echo '<a href="' . $cat[ 'link' ] . '" class="bg-secondary text-secondary-tint-2 rounded-circle p-4px px-3">' . $cat[ 'title' ] . '</a>';
            }

        ?>
    </div>
    <div class="h-24px"></div>
    <div><?php the_content(); ?></div>
</div>