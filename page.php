<?php get_header(); ?>

<div class="d-flex flex-row">

    <?php get_sidebar(); ?>


    <div class="main-content">

        <?php get_view_part('header'); ?>

        <div class="d-flex flex-column p-12px">

        <?php the_content(); ?>

            <div class="h-24px"></div>


            <?php get_view_part('footer'); ?>
        </div>
    </div>
</div>





<?php

    get_footer();

?>