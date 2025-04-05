<div class="d-flex flex-lg-row flex-column">
    <div class="main-content">
        <?php
            get_component('home-slider');
        ?>
        <div class="d-lg-block d-none" >
        <?php
            get_component('home-last-news');
        ?>
        </div>
    </div>
    <div class="sidebar">
        <?php
            get_component('favorites-tab');
            echo '<div class="h-24px"></div>';
            get_component('notes');
        ?>

    </div>
    <div class="main-content">
        <div class="d-lg-none d-block" >
        <?php
            get_component('home-last-news');
        ?>
        </div>
    </div>
</div>
<div class="h-24px"></div>