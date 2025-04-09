<div
    class="news secondary-shade-1 d-flex flex-row justify-content-around align-items-center w-100 border-top border-bottom border-1 border-secondary">
    <div class="d-flex flex-row align-items-center justify-content-around ps-24px">
        <span class="text-secondary-tint-2 fw-500 f-12px text-nowrap">آخرین مطالب</span>
        <div class="w-16px"></div>
        <img class="w-12px" src="<?php echo image_url('dif-red.png') ?>">
        <div class="w-16px"></div>
    </div>
    <div class="news-ticker">

        <div class="ticker-container">

            <?php
                $recent_posts = new WP_Query([
                    'posts_per_page' => 10,        // تعداد پست‌ها
                    'post_status'    => 'publish', // فقط پست‌های منتشر شده
                    'orderby'        => 'date',    // بر اساس تاریخ
                    'order'          => 'DESC',    // جدیدترین اول
                 ]);
                $news_query = new WP_Query($recent_posts);

                if ($news_query->have_posts()) {
                    $m = 0;
                    while ($news_query->have_posts()) {
                        $news_query->the_post();

                        if ($m) {
                            echo '<img class="w-12px" src="' . image_url('dif.png') . '">';
                        }

                        $m++;
                    ?>
            <a href="<?php the_permalink(); ?>"
                class="text-secondary-tint-1 fw-500 f-12px mx-4"><?php the_title(); ?></a>

            <?php
                }
                    wp_reset_postdata();

                }

            ?>
        </div>
    </div>

</div>