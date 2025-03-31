<div class="row row-cols-1 row-cols-2">
    <div class="col">
        <div class="image-container preview-news" style="height: 306px;">
            <img src="" class="rounded-12px preview-image">
            <div class="image-overlay"></div>
            <div class="bottom-right-text text-secondary-tint-1 fw-700 f-24px preview-title"></div>
        </div>
    </div>
    <div class="col">
        <div class="d-flex flex-column justify-content-between pe-3" style="height: 306px;">

            <?php
                $args = [
                    'category_name'  => 'news',
                    'posts_per_page' => 3, // نمایش همه پست‌ها
                 ];

                $favorites_query = new WP_Query($args);

                $count_row = 0;

                if ($favorites_query->have_posts()) {
                    while ($favorites_query->have_posts()) {
                        $favorites_query->the_post();

                        // دریافت تصویر شاخص (Featured Image)
                        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                        // دریافت **فقط دسته‌بندی‌های اصلی** (parent = 0) و به جز favorites
                        $categories      = get_the_category();
                        $main_categories = [  ];
                        foreach ($categories as $category) {
                            if ($category->slug != 'favorites' && $category->parent != 0) {
                                $main_categories[  ] = [
                                    'name' => $category->name,
                                    'link' => get_category_link($category->term_id),
                                 ];
                            }
                        }

                        $post_date = get_the_date('Y-m-d');

                        $active_class = ($count_row == 0) ? 'active' : '';
                        $count_row++;
                    ?>
            <div
                class="hero-news w-100 d-flex flex-row align-items-center secondary-shade-1 rounded-12px p-8px h-88px gap-2                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       <?php echo $active_class ?>">

                <div class="hero-news-img col-lg-2 text-center border-start border-1">
                    <a href="<?php the_permalink(); ?>" class="w-100 ms-2"><img
                            class="rounded-8px w-56px h-56px item-image" src="<?php echo esc_url($thumbnail_url); ?>"
                            alt="<?php the_title_attribute(); ?>">
                    </a>
                </div>
                <div class="col-lg-10">
                    <a href="<?php the_permalink(); ?>"
                        class="fw-500 f-14px text-secondary-tint-2 ellipsis-text ms-2 item-title"><?php the_title(); ?></a>
                    <div class="d-flex flex-row justify-content-between align-items-center px-2">
                        <span class="fw-500 f-10px text-secondary-tint-3"><?php echo tarikh($post_date, 'm'); ?></span>
                        <a href="<?php echo esc_url($main_categories[ 0 ][ 'link' ]); ?>"
                            class="fw-500 f-10px text-secondary-tint-2 bg-secondary rounded-circle p-4px"><?php echo esc_html($main_categories[ 0 ][ 'name' ]); ?></a>
                    </div>
                </div>
            </div>

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

<div class="h-24px"></div>