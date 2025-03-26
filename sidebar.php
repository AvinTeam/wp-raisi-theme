<div class="d-none d-lg-block text-center secondary-shade-4 vh-100 " style="width: 264px;">
    <div>
        <img class="w-100 p-16px" src="<?php echo image_url('logo.png') ?>" alt="">
    </div>

    <div class="w-100 border-1 border-secondary"></div>



    <nav class="sidebar-menu p-24px">
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'm-0 p-0', // اینجا کلاس‌ها به ul اصلی اضافه می‌شوند
            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'walker'         => new Custom_Sidebar_Walker(),
            'fallback_cb'    => false,
         ]);
    ?>
    </nav>
</div>