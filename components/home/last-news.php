<?php

    $parent_category = get_category_by_slug('news'); // یا با نام: get_cat_ID('news')
    $parent_id       = $parent_category->term_id;
?>
<diV class="last-news">
    <div class="line-between">
        <span class="text-secondary-tint-2 fw-500 f-16px">آخرین خبرها</span>
        <span><a href="<?php echo get_category_link($parent_id) ?>" class="text-secondary-tint-2 fw-500 f-16px">مشاهده
                همه</a></span>
    </div>
    <div class="h-8px"></div>
    <!-- تب‌ها -->

    <ul class="nav nav-pills d-flex flex-row justify-content-start align-items-center w-100 gap-1" id="myLastNews"
        role="tablist">

        <li class="nav-item" role="presentation">
            <span class="me-2">دسته بندی اخبار:</span>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link nav-link f-14px fw-500 active" id="all-news-tab" data-bs-toggle="tab"
                data-bs-target="#all-news" type="button" role="tab" aria-controls="all-news" aria-selected="true">همه
                دسته ها</button>
        </li>
        <?php
            $child_categories = get_categories([
                'parent'     => $parent_id, // ID دستهٔ والد
                'hide_empty' => false,      // نمایش حتی اگر خالی باشند
             ]);

            if ($child_categories) {

                $array_slug = [  ];
                foreach ($child_categories as $child) {
                    $array_slug[  ] = $child->slug;

                    echo '
                <li class="nav-item" role="presentation">
                    <button class="nav-link nav-link f-14px fw-500 " id="' . $child->slug . '-tab" data-bs-toggle="tab"
                        data-bs-target="#' . $child->slug . '" type="button" role="tab" aria-controls="' . $child->slug . '"
                        aria-selected="true">' . $child->name . '</button>
                </li>';
                }
            }
        ?>

    </ul>
    <div class="h-24px"></div>

    <!-- محتوای تب‌ها -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="all-news" role="tabpanel" aria-labelledby="all-news-tab">
            <div class="swiper-container w-100 overflow-hidden">
                <div class="swiper-wrapper">

                    <?php
                        $args = [
                            'category_name'  => $parent_category->slug,
                            'posts_per_page' => 4, // نمایش همه پست‌ها
                         ];

                        $news_query = new WP_Query($args);

                        if ($news_query->have_posts()) {
                            while ($news_query->have_posts()) {
                                $news_query->the_post();

                                // دریافت تصویر شاخص (Featured Image)
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                                // دریافت **فقط دسته‌بندی‌های اصلی** (parent = 0) و به جز news
                                $categories      = get_the_category();
                                $main_categories = [  ];
                                foreach ($categories as $category) {
                                    if (! in_array($category->slug, [ $parent_category->slug, 'favorites', 'slider' ])) {
                                        $main_categories[  ] = [
                                            'name' => $category->name,
                                            'link' => get_category_link($category->term_id),
                                         ];
                                    }
                                }

                                // دریافت تاریخ به فرمت Y-m-d (مثل: 2025-03-26)
                                $post_date = get_the_date('Y-m-d');
                            ?>


                            <div class="swiper-slide secondary-shade-4 rounded-12px p-8px">
                                <div class="text-center">
                                    <a href="<?php the_permalink(); ?>" class="w-100 pe-2">
                                        <img class="w-100 rounded-8px"
                                            src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                                    </a>
                                </div>


                                <a href="<?php the_permalink(); ?>"
                                    class="fw-500 f-14px text-secondary-tint-2 ellipsis-text ms-2"><?php the_title(); ?></a>

                                <div>
                                    <span class="fw-500 f-12px text-secondary-tint-3"><?php echo get_the_excerpt() ?></span>
                                </div>

                                <div class="d-flex flex-row justify-content-around align-items-center">
                                    <span
                                        class="fw-500 f-10px text-secondary-tint-3"><?php echo tarikh($post_date, 'm'); ?></span>
                                    <a href="<?php echo esc_url($main_categories[ 0 ][ 'link' ]); ?>"
                                        class="fw-500 f-10px secondary-color text-secondary-tint-2 rounded-circle p-4px"><?php echo esc_html($main_categories[ 0 ][ 'name' ]); ?></a>
                                </div>
                            </div>
                            <div class="h-8px"></div> <?php
                        }
                            wp_reset_postdata();
                        } else {
                            echo '<p>هیچ پستی یافت نشد.</p>';
                        }
                    ?>
                </div>
            </div>

        </div>
        <?php

        foreach ($array_slug as $slug): ?>

        <div class="tab-pane fade" id="<?php echo $slug ?>" role="tabpanel" aria-labelledby="<?php echo $slug ?>-tab">

            <div class="swiper-container w-100 overflow-hidden">
                <div class="swiper-wrapper">

                    <?php

                        $args = [
                            'category_name'  => $slug,
                            'posts_per_page' => 4, // نمایش همه پست‌ها
                         ];

                        $news_query = new WP_Query($args);

                        if ($news_query->have_posts()) {
                            while ($news_query->have_posts()) {
                                $news_query->the_post();

                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                                $categories = get_category_by_slug($slug);

                                $post_date = get_the_date('Y-m-d');
                            ?>

                    <div class="swiper-slide secondary-shade-4 rounded-12px p-8px">
                        <div class="text-center">
                            <a href="<?php the_permalink(); ?>" class="w-100 pe-2"><img class="w-100 rounded-8px"
                                    src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                            </a>
                        </div>

                        <a href="<?php the_permalink(); ?>"
                            class="fw-500 f-14px text-secondary-tint-2 ellipsis-text ms-2"><?php the_title(); ?></a>

                        <div>
                            <span class="fw-500 f-12px text-secondary-tint-3"><?php echo get_the_excerpt() ?></span>
                        </div>

                        <div class="d-flex flex-row justify-content-around align-items-center">
                            <span
                                class="fw-500 f-10px text-secondary-tint-3"><?php echo tarikh($post_date, 'm'); ?></span>
                            <a href="<?php echo esc_url(get_category_link($categories->term_id)); ?>"
                                class="fw-500 f-10px secondary-color text-secondary-tint-2 rounded-circle p-4px"><?php echo esc_html($categories->name); ?></a>
                        </div>
                    </div>
                    <div class="h-8px"></div>

                    <?php
                        }
                            wp_reset_postdata();
                        } else {
                            echo '<p>هیچ پستی یافت نشد.</p>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</diV>