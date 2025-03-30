<div class="d-flex flex-row">
    <div class="main-content">
        <?php
            get_component('home-slider');
            get_component('home-last-news');
        ?>
    </div>
    <div class="sidebar">
        <?php
            get_component('favorites-tab');
            echo '<div class="h-24px"></div>';
            get_component('notes');
        ?>

    </div>
</div>
<div class="h-24px"></div>