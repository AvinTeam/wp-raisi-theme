<?php get_header(); ?>





<div class="d-flex flex-row">

    <?php get_sidebar(); ?>


    <div class="main-content">

    <?php
        get_component('header');
        get_component('footer');
    ?>
    </div>
</div>


<!-- دکمه برای نمایش سایدبار در موبایل -->
<button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
    منو
</button>


<?php

get_footer();