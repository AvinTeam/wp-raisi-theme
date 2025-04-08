<div class="d-flex flex-lg-row flex-column-reverse pt-24px">
    <div class="main-content px-24px">
        <div class="d-lg-block d-none">
            <?php get_component('home/slider'); ?>
        </div>
        <?php get_component('home/last-news'); ?>
    </div>
    <div class="sidebar">
        <?php
            get_component('favorites-tab');
            echo '<div class="h-24px"></div>';
            get_component('notes');
        ?>

    </div>
    <div class="main-content d-lg-none d-block">
            <?php get_component('home/slider'); ?>
    </div>
</div>
<div class="h-40px"></div>