<div class="sidebar-tab w-100 border border-1 border-secondary p-12px secondary-shade-4 rounded-12px">
    <!-- تب‌ها -->
    <ul class="nav nav-pills d-flex flex-row justify-content-around align-items-center w-100 rounded-8px secondary-shade-2 p-8px"
        id="myTab" role="tablist">
        <li class="nav-item w-100" role="presentation">
            <button class="nav-link f-14x fw-500 w-100"> یادداشت ها</button>
        </li>
    </ul>
    <div class="h-24px"></div>

    <!-- محتوای تب‌ها -->
    <div class="tab-content">
        <div class="tab-pane fade show active">


            <?php
                $args = [
                    'category_name'  => 'notes',
                    'posts_per_page' => 4, // نمایش همه پست‌ها
                 ];

                $notes_query = new WP_Query($args);

                if ($notes_query->have_posts()) {
                    while ($notes_query->have_posts()) {
                        $notes_query->the_post();

                        // دریافت تصویر شاخص (Featured Image)
                        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                        $tags = get_the_tags();

                    ?>
            <div class="w-100 d-flex flex-row align-items-center secondary-shade-2 rounded-8px p-8px">

                <div class="col-lg-3 text-center  border-end border-1 border-secondary">
                    <a href="<?php the_permalink(); ?>" class="w-100 pe-2"><img class="rounded-4px"
                            src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                    </a>
                </div>
                <div class="col-lg-9">
                    <a href="<?php the_permalink(); ?>"
                        class="fw-500 f-14x text-secondary-tint-2 ellipsis-text ms-2"><?php the_title(); ?></a>

                    <?php if ($tags): ?>

                    <div> <a href="<?php echo esc_url(get_tag_link($tags[ 0 ]->term_id)); ?>"
                            class="fw-500 f-10x text-third-color p-4px"><?php echo esc_html($tags[ 0 ]->name); ?></a>
                    </div>
                    <?php endif; ?>
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