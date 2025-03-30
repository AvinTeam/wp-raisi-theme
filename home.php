<?php get_header(); ?>





<div class="d-flex flex-row">

    <?php get_sidebar(); ?>


    <div class="main-content">

        <?php get_view_part('header'); ?>

        <div class="d-flex flex-column p-12px">

            <?php
                get_view_part('home/news');
                get_view_part('home/media');
                get_view_part('home/gam');
            ?>
    









            <?php get_view_part('footer'); ?>
        </div>
    </div>
</div>


<!-- دکمه برای نمایش سایدبار در موبایل -->
<button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
    منو
</button>
















<?php

    get_footer();

?>