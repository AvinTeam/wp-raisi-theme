<div>
    <?php
        $paged = isset($_GET[ 'page' ]) ? absint($_GET[ 'page' ]) : 1;

    ?>

    <div class="row row-cols-2 row-cols-lg-4">

        <?php

            if (have_posts()) {
                while (have_posts()) {
                    the_post();

                    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

                    $categories        = get_the_category();
                    $main_categories   = [  ];
                    $parent_categories = [  ];

                    foreach ($categories as $category) {

                        if (! in_array($category->slug, [ 'favorites', 'slider' ]) && $category->category_parent != 0) {
                            $main_categories[  ] = [
                                'name' => $category->name,
                                'slug' => $category->slug,
                                'link' => get_category_link($category->term_id),
                             ];
                        } elseif (! in_array($category->slug, [ 'favorites', 'slider' ]) && $category->category_parent == 0) {
                            $parent_categories[  ] = [
                                'name' => $category->name,
                                'slug' => $category->slug,
                                'link' => get_category_link($category->term_id),
                             ];
                        }

                    }

                    if (empty($main_categories)) {
                        $main_categories = $parent_categories;
                    }

                    $post_date = get_the_date('Y-m-d');
                ?>


        <div class="col py-1">
            <div class="secondary-shade-4 rounded-12px p-8px">
                <div class="text-center h-120px position-relative">
                    <a href="<?php the_permalink(); ?>" class="w-100 pe-2">
                        <img class="h-100 rounded-8px" src="<?php echo esc_url($thumbnail_url); ?>"
                            alt="<?php the_title_attribute(); ?>">
                        <?php if ($main_categories[ 0 ][ 'slug' ] == "video"): ?>
                        <img class="position-absolute top-50 start-50 translate-middle z-1 w-40px"
                            src="<?php echo image_url('play-circle.png') ?>">

                        <?php endif; ?>

                    </a>
                </div>

                <a href="<?php the_permalink(); ?>"
                    class="fw-500 f-14px text-secondary-tint-2 text-3-lines pb-8px h-72px d-flex align-items-center"><?php the_title(); ?></a>

                <div class="d-flex flex-lg-row flex-column-reverse justify-content-between align-items-center p-8px">
                    <span class="fw-500 f-10px text-secondary-tint-3"><?php echo tarikh($post_date, 'm'); ?></span>
                    <a href="<?php echo esc_url($main_categories[ 0 ][ 'link' ]); ?>"
                        class="fw-500 f-10px secondary-color text-secondary-tint-2 rounded-circle mb-2 mb-lg-0 py-4px px-12px"><?php echo esc_html($main_categories[ 0 ][ 'name' ]); ?></a>
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
        global $wp_query;
        $total_pages = $wp_query->max_num_pages;
        $current_url = home_url(add_query_arg(null, null));

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
                                echo '<li class="page-item z-1 active" aria-current="page"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">' . $i . '</span></li>';
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
                                    echo '<li class="page-item z-1 active" aria-current="page"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">' . $i . '</span></li>';
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
                                    echo '<li class="page-item z-1 active" aria-current="page"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">' . $i . '</span></li>';
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
                                    echo '<li class="page-item z-1 active" aria-current="page"><span class="page-link w-48px h-48px d-flex justify-content-center align-items-center rounded-8px">' . $i . '</span></li>';
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