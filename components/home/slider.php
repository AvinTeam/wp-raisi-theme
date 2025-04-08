<div class="swiper-my-body m-0 p-0 rounded-12px overflow-hidden">
            <div class="swiper home-slider">
                <div class="swiper-wrapper">
                    <!-- slider -->
                    <?php
                        $args            = [
                            'category_name'  => "slider",
                            'posts_per_page' => 4, // نمایش همه پست‌ها
                         ];

                        $news_query = new WP_Query($args);

                        if ($news_query->have_posts()) {
                            while ($news_query->have_posts()) {
                                $news_query->the_post();

                                // دریافت تصویر شاخص (Featured Image)
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                                // دریافت تاریخ به فرمت Y-m-d (مثل: 2025-03-26)
                                $post_date = get_the_date('Y-m-d');
                            ?>
                    <div class="swiper-slide">
                        <div class="image-container">
                            <img src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                            <div class="image-overlay"></div>
                            <div class="top-left-text text-secondary fw-500 f-14px">
                                <?php echo tarikh($post_date, 'm'); ?></div>
                            <div class="bottom-right-text text-secondary-tint-1 fw-700 f-24px"><?php the_title(); ?>
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
                <div class="swiper-pagination"></div>
            </div>



        </div>
        <div class="h-40px"></div>
