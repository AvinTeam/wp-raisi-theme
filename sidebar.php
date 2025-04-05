<div class="d-none d-lg-block text-center secondary-shade-4 h-100 sidebar " >
    <a href="<?php echo home_url()?>">
        <img class="w-100 p-16px" src="<?php echo image_url('logo.png') ?>" alt="<?php echo get_bloginfo('name') ?>">
    </a>
    <div class="w-100 border-1 border-secondary"></div>
    <nav class="sidebar-menu p-24px">
        <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'm-0 p-0 list-unstyled', // اینجا کلاس‌ها به ul اصلی اضافه می‌شوند
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'walker'         => new Custom_Sidebar_Walker(),
                'fallback_cb'    => false,
             ]);
        ?>
    </nav>
</div>




<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar">
    <div class="offcanvas-header">
        <button type="button" class="btn-close fw-heavy" data-bs-dismiss="offcanvas"><i class="bi bi-x-lg text-white f-20px"></i></button>
    </div>
    <div class="offcanvas-body">
        <nav class="sidebar-menu p-24px">
            <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'm-0 p-0 list-unstyled', // اینجا کلاس‌ها به ul اصلی اضافه می‌شوند
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'walker'         => new Custom_Sidebar_Walker(),
                    'fallback_cb'    => false,
                 ]);
            ?>
        </nav>
    </div>
</div>