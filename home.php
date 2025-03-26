<?php get_header(); ?>





<div class="d-flex flex-row">

<?php
    get_sidebar();

    get_component('header');
?>
</div>


<!-- دکمه برای نمایش سایدبار در موبایل -->
<button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
    منو
</button>


<?php

get_footer();
