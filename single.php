<?php get_header(); ?>

<div class="d-flex flex-row">
    <?php get_sidebar(); ?>
    <div class="main-content">
        <?php get_view_part('header'); ?>
        <div class="d-flex flex-column p-12px">
            <div class="d-flex flex-lg-row flex-column">
                <div class="main-content">
                    <div class="d-lg-none d-block">

                        <?php get_view_part('post/shearing'); ?>
                    </div>
                    <?php
                        if (has_category('notes')) {
                            get_view_part('post/notes');
                        } else {
                            get_view_part('post/post');
                        }
                    ?>
                </div>
                <div class="sidebar position-relative">
                    <?php
                        if (has_category('notes')) {
                            get_component('notes');
                        } else {
                            get_component('favorites-tab');
                        }
                    ?>
                    <div class="h-24px"></div>

                    <?php get_view_part('post/shearing'); ?>
                </div>
            </div>
            <div class="h-24px"></div>
            <?php get_view_part('footer'); ?>
        </div>
    </div>
</div>





<?php

    get_footer();

?>