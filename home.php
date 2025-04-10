<?php get_header(); ?>





<div class="d-flex flex-row">

    <?php get_sidebar(); ?>


    <div class="main-content">

        <?php get_view_part('header'); ?>

        <div class="d-flex flex-column pe-24px">

            <?php
                get_view_part('home/news');
                get_view_part('home/media');
                get_view_part('home/gam');
            ?>

            <?php get_view_part('footer'); ?>
        </div>
    </div>
</div>





<?php

    get_footer();

?>