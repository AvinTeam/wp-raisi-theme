<div>
    <?php
        $current_category_id = get_queried_object_id();
        $current_category    = get_category($current_category_id);

        // بررسی اصلی بودن و داشتن زیردسته
        if ($current_category->parent == 0):
            $subcategories = get_categories([
                'parent'     => $current_category_id,
                'hide_empty' => false,
             ]);

            if (! empty($subcategories)): // فقط اگر زیردسته وجود داشت نمایش بده
            ?>

    <div class="w-100 d-flex align-items-center flex-row line-end">
        <span class="text-secondary-tint-2 fw-500 f-16px pe-24px">دسته بندی
            <?php echo $current_category->name ?></span>
    </div>



    <div class="h-32px"></div>
    <div class="row ">

        <?php foreach ($subcategories as $subcategory):
                                $image_id  = get_term_meta($subcategory->term_id, 'category-image-id', true);
                                $cat_image = $image_id ? wp_get_attachment_url($image_id) : '';
                            ?>

        <a href="<?php echo get_category_link($subcategory->term_id) ?>"
            class="h-168px w-168px bg-secondary rounded-12px d-flex justify-content-center align-items-center">
            <div class="d-flex flex-column align-items-center">
                <img class="w-80px" src="<?php echo $cat_image ?>" alt="<?php echo $subcategory->name ?>">
                <span class="f-14px text-secondary-tint-2 mt-16px"><?php echo $subcategory->name ?></span>
            </div>
        </a>
        <div class="w-24px"></div>

        <?php endforeach; ?>

    </div>

    <div class="h-40px"></div>
    <?php
                    endif;
                endif;
            ?>
</div>