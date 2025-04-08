<div>
    <?php
        $paged = isset($_GET[ 'page' ]) ? absint($_GET[ 'page' ]) : 1;

        $current_category_id = get_queried_object_id();
        $current_category    = get_category($current_category_id);

        if ($current_category->category_parent == 0) {
            $main_category_slug = $current_category->slug;
        } else {
            $parent_category    = get_category($current_category->category_parent);
            $main_category_slug = $parent_category->slug;
        }

    ?>
    <div class="row row-cols-2 row-cols-lg-3">

        <?php
            $args = [
                'category_name'  => $current_category->slug,
                'posts_per_page' => 8,
                'paged'          => $paged,
             ];
            $news_query = new WP_Query($args);

            if ($news_query->have_posts()) {
                while ($news_query->have_posts()) {
                    $news_query->the_post();
                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    $post_date  = get_the_date('Y-m-d');
                    $tags = get_the_tags();
                ?>


        <div class="col py-2 ">
            <div class="secondary-shade-4 rounded-12px p-24px">

                <a href="<?php the_permalink(); ?>"
                    class="fw-500 f-14px text-secondary-tint-2 text-justify"><?php echo get_the_excerpt() ?></a>
                <div class="h-32px"></div>

                <div class="w-100 d-flex flex-row align-items-center">

                    <div class="text-center  border-end border-1 border-secondary">
                        <a href="<?php the_permalink(); ?>" class="w-100 "><img class="rounded-8px w-48px h-48px"
                                src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
                        </a>
                    </div>
                    <div class="d-flex flex-column justify-content-between align-items-start h-48px">

                        <?php if ($tags): ?>
                        <a href="<?php echo esc_url(get_tag_link($tags[ 0 ]->term_id)); ?>"
                            class="fw-500 f-10px text-third-color p-4px"><?php echo esc_html($tags[ 0 ]->name); ?></a>
                        <?php endif; ?>

                        <span
                            class="fw-500 f-10px text-secondary-tint-2 ellipsis-text ms-2"><?php echo tarikh($post_date, 'm'); ?></span>
                    </div>
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
    <div class="h-24px"></div>

    <?php
        // تنظیمات صفحه‌بندی
        $total_pages = $news_query->max_num_pages;
        $current_url = get_category_link($current_category->term_id); // لینک پایه دسته‌بندی

        if ($total_pages > 1):
    ?>
    <nav aria-label="Page navigation">
        <ul
            class="pagination justify-content-between border border-1 border-secondary p-2px d-flex flex-row-reverse rounded-8px mx-auto">
            <?php
                // دکمه قبلی
                if ($paged > 1) {
                    $prev_page = $paged - 1;
                    echo '<li class="page-item"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px" href="' . esc_url(add_query_arg('page', $prev_page, $current_url)) . '"><i class="bi bi-chevron-left text-secondary-tint-1"></i></a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px"></a></li>';
                }
            ?>

            <div class="d-flex flex-row justify-content-center align-items-center gap-16">
                <?php

                // منطق نمایش شماره صفحات
                if ($total_pages <= 4) {
                    // اگر تعداد صفحات 4 یا کمتر بود، همه رو نمایش بده
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $paged) {
                            echo '<li class="page-item active" aria-current="page"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">' . $i . '</span></li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px" href="' . esc_url(add_query_arg('page', $i, $current_url)) . '">' . $i . '</a></li>';
                        }
                    }
                } else {
                    // اگر تعداد صفحات بیشتر از 4 بود
                    if ($paged <= 2) {
                        // نمایش 3 صفحه اول + سه نقطه + صفحه آخر
                        for ($i = 1; $i <= 3; $i++) {
                            if ($i == $paged) {
                                echo '<li class="page-item active" aria-current="page"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">' . $i . '</span></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px" href="' . esc_url(add_query_arg('page', $i, $current_url)) . '">' . $i . '</a></li>';
                            }
                        }
                        echo '<li class="page-item disabled"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">…</span></li>';
                        echo '<li class="page-item"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px" href="' . esc_url(add_query_arg('page', $total_pages, $current_url)) . '">' . $total_pages . '</a></li>';
                    } elseif ($paged >= $total_pages - 1) {
                        // نمایش صفحه اول + سه نقطه + 3 صفحه آخر
                        echo '<li class="page-item"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px" href="' . esc_url(add_query_arg('page', 1, $current_url)) . '">1</a></li>';
                        echo '<li class="page-item disabled"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">…</span></li>';
                        for ($i = $total_pages - 2; $i <= $total_pages; $i++) {
                            if ($i == $paged) {
                                echo '<li class="page-item active" aria-current="page"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">' . $i . '</span></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px" href="' . esc_url(add_query_arg('page', $i, $current_url)) . '">' . $i . '</a></li>';
                            }
                        }
                    } else {
                        // نمایش صفحه اول + سه نقطه + صفحه فعلی و اطرافش + سه نقطه + صفحه آخر
                        echo '<li class="page-item"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px" href="' . esc_url(add_query_arg('page', 1, $current_url)) . '">1</a></li>';
                        echo '<li class="page-item disabled"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">…</span></li>';

                        // صفحه قبل، فعلی و بعد
                        for ($i = $paged - 1; $i <= $paged + 1; $i++) {
                            if ($i == $paged) {
                                echo '<li class="page-item active" aria-current="page"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">' . $i . '</span></li>';
                            } else {
                                echo '<li class="page-item"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px" href="' . esc_url(add_query_arg('page', $i, $current_url)) . '">' . $i . '</a></li>';
                            }
                        }

                        echo '<li class="page-item disabled"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">…</span></li>';
                        echo '<li class="page-item"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px" href="' . esc_url(add_query_arg('page', $total_pages, $current_url)) . '">' . $total_pages . '</a></li>';
                    }
                }
            ?>
            </div>
            <?php

                // دکمه بعدی
                if ($paged < $total_pages) {
                    $next_page = $paged + 1;
                    echo '<li class="page-item"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px" href="' . esc_url(add_query_arg('page', $next_page, $current_url)) . '"><i class="bi bi-chevron-right text-secondary-tint-1"></i></a></li>';
                } else {
                    echo '<li class="page-item disabled"><a class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px"><</a></li>';
                }
            ?>
        </ul>
    </nav>
    <?php
        endif;
    ?>
    <div class="h-24px"></div>

</div>