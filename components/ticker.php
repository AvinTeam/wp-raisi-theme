<div
    class="news secondary-shade-2 d-flex flex-row justify-content-around align-items-center w-100 border-top border-bottom border-1 border-secondary">
    <div class="d-flex flex-row align-items-center justify-content-around">
        <span class="text-secondary-tint-2 fw-500 f-12px text-nowrap ps-24px">آخرین مطالب</span>
        <img class="w-12px mx-16px" src="<?php echo image_url('dif-red.png') ?>">
    </div>
    <div class="news-ticker">

        <div class="ticker-container" id="ticker-container">

            <?php
                $recent_posts = new WP_Query([
                    'post_status' => 'publish',
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                 ]);
                $news_query = new WP_Query($recent_posts);

                if ($news_query->have_posts()) {
                    $m = 0;
                    while ($news_query->have_posts()) {
                        $news_query->the_post();

                        if ($m) {
                            echo '

                            ';
                        }

                        $m++;
                    ?>
                    <img class="w-12px mx-16px" src="<?php echo image_url('dif.png')?>">
            <a href="<?php the_permalink(); ?>" class="text-secondary-tint-1 fw-500 f-12px"><?php the_title(); ?></a>

            <?php
                }
                    wp_reset_postdata();

                }

            ?>
        </div>
    </div>

</div>