<?php get_header();
    $current_category_id = get_queried_object_id();
    $current_category    = get_category($current_category_id);
?>

<div class="d-flex flex-row">
    <?php get_sidebar(); ?>
        <div class="main-content">
        <?php get_view_part('header'); ?>
        <div class="d-flex flex-column p-12px ">
            <div class="d-flex flex-lg-row flex-column-reverse pt-24px">
                <div class="main-content px-lg-24px">
                    <?php get_component('search/post'); ?>
                </div>
                <div class="sidebar">
                    <?php get_component('favorites-tab'); ?>
                    <div class="h-24px"></div>
                </div>
            </div>
            <div class="h-24px"></div>
            <?php get_view_part('footer'); ?>
        </div>
    </div>
</div>
<?php get_footer();
