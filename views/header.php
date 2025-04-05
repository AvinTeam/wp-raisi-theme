<div class="w-100 d-none d-lg-block">
    <div class="d-flex flex-row align-items-center justify-content-between p-24px h-88px">
        <div class="col-7 text-secondary-tint-1 f-20px fw-bold "><?php echo get_header_title() ?></div>
        <div class="col-5 d-flex flex-row align-items-center gap-4 justify-content-end">

            <?php
                get_component('social-media');
                get_search_form();
            ?>
        </div>
    </div>
    <?php get_component('ticker'); ?>
</div>

<div class="w-100 d-flex flex-column justify-content-center align-items-center d-lg-none">
    <a class="w-50" href="<?php echo home_url() ?>"><img class="w-100 p-16px" src="<?php echo image_url('logo.png') ?>"
            alt="<?php echo get_bloginfo('name') ?>"></a>
    <?php get_component('ticker'); ?>


    <div class="d-flex flex-row align-items-center justify-content-between p-24px h-88px w-100">
        <div class="col-1 d-flex flex-row align-items-center justify-content-center">
            <button class="btn d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasSidebar">
                <img class="h-40px w-40px" src="<?=image_url('menu.png')?>" alt="menu">
            </button>
        </div>

        <div class="col-10 text-secondary-tint-1 f-20px fw-bold text-center "><?php echo get_header_title() ?></div>

        <div class="col-1 d-flex flex-row align-items-center gap-4 justify-content-end">

            <?php
                get_search_form();
            ?>
        </div>
    </div>





</div>