<div class="sidebar-tab w-100 border border-1 border-secondary p-12px secondary-shade-4 rounded-12px">
    <!-- تب‌ها -->
    <ul class="nav nav-pills d-flex flex-row justify-content-around align-items-center w-100 rounded-8px secondary-shade-2 p-8px"
        id="myTab" role="tablist">
        <li class="nav-item col-lg-5" role="presentation">
            <button class="nav-link nav-link f-14px fw-500 w-100 active" id="favorites-tab" data-bs-toggle="tab"
                data-bs-target="#favorites" type="button" role="tab" aria-controls="favorites"
                aria-selected="true">برگزیده ها</button>
        </li>
        <li class="nav-item col-lg-5" role="presentation">
            <button class="nav-link f-14px fw-500 w-100" id="last-news-tab" data-bs-toggle="tab"
                data-bs-target="#last-news" type="button" role="tab" aria-controls="last-news"
                aria-selected="false">تازه ها</button>
        </li>
    </ul>
    <div class="h-24px"></div>

    <!-- محتوای تب‌ها -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="favorites" role="tabpanel" aria-labelledby="favorites-tab">

            <?php
                $args = [
                    'category_name'  => 'favorites',
                    'posts_per_page' => 4, // نمایش همه پست‌ها
                 ];

                $favorites_query = new WP_Query($args);

                if ($favorites_query->have_posts()) {
                    while ($favorites_query->have_posts()) {
                        $favorites_query->the_post();

                        // دریافت تصویر شاخص (Featured Image)
                        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                        // دریافت **فقط دسته‌بندی‌های اصلی** (parent = 0) و به جز favorites
                        $categories      = get_the_category();
                        $main_categories = [  ];
                        foreach ($categories as $category) {
                            if ($category->slug != 'favorites' && $category->parent == 0) {
                                $main_categories[  ] = [
                                    'name' => $category->name,
                                    'link' => get_category_link($category->term_id),
                                 ];
                            }
                        }

                        // دریافت تاریخ به فرمت Y-m-d (مثل: 2025-03-26)
                        $post_date = get_the_date('Y-m-d');
                    ?>
            <div class="w-100 d-flex flex-row align-items-center secondary-shade-2 rounded-8px p-8px">

                <div class="col-lg-3 text-center  border-end border-1 border-secondary">
                    <a href="<?php the_permalink(); ?>" class="w-100 pe-2"><img class="rounded-4px"
                            src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                    </a>
                </div>
                <div class="col-lg-9">
                    <a href="<?php the_permalink(); ?>"
                        class="fw-500 f-14px text-secondary-tint-2 ellipsis-text ms-2"><?php the_title(); ?></a>
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <span class="fw-500 f-10px text-secondary-tint-3"><?php echo tarikh($post_date, 'm'); ?></span>
                        <a href="<?php echo esc_url($main_categories[ 0 ][ 'link' ]); ?>"
                            class="fw-500 f-10px text-third-color third-shade-4 rounded-circle p-4px"><?php echo esc_html($main_categories[ 0 ][ 'name' ]); ?></a>
                    </div>
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


        <div class="tab-pane fade" id="last-news" role="tabpanel" aria-labelledby="last-news-tab">

            <?php
                $args = [
                    'posts_per_page' => 4, // نمایش همه پست‌ها
                 ];

                $favorites_query = new WP_Query($args);

                if ($favorites_query->have_posts()) {
                    while ($favorites_query->have_posts()) {
                        $favorites_query->the_post();

                        // دریافت تصویر شاخص (Featured Image)
                        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                        // دریافت **فقط دسته‌بندی‌های اصلی** (parent = 0) و به جز favorites
                        $categories      = get_the_category();
                        $main_categories = [  ];
                        foreach ($categories as $category) {
                            if ($category->slug != 'favorites' && $category->parent == 0) {
                                $main_categories[  ] = [
                                    'name' => $category->name,
                                    'link' => get_category_link($category->term_id),
                                 ];
                            }
                        }

                        // دریافت تاریخ به فرمت Y-m-d (مثل: 2025-03-26)
                        $post_date = get_the_date('Y-m-d');
                    ?>

            <div class="w-100 d-flex flex-row align-items-center secondary-shade-2 rounded-8px p-8px">

                <div class="col-lg-3 text-center  border-end border-1 border-secondary">
                    <a href="<?php the_permalink(); ?>" class="w-100 pe-2"><img class="rounded-4px"
                            src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                    </a>
                </div>
                <div class="col-lg-9">
                    <a href="<?php the_permalink(); ?>"
                        class="fw-500 f-14px text-secondary-tint-2 ellipsis-text ms-2"><?php the_title(); ?></a>
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <span class="fw-500 f-10px text-secondary-tint-3"><?php echo tarikh($post_date, 'm'); ?></span>
                        <a href="<?php echo esc_url($main_categories[ 0 ][ 'link' ]); ?>"
                            class="fw-500 f-10px text-third-color third-shade-4 rounded-circle p-4px"><?php echo esc_html($main_categories[ 0 ][ 'name' ]); ?></a>
                    </div>
                </div>
            </div>
            <div class="h-8px"></div>

            <?php
                }
                    wp_reset_postdata();
                } else {
                    echo '<p>پستی یافت نشد</p>';
                }
            ?>
        </div>

    </div>
</div>