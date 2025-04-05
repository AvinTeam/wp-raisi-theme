<footer class="container-fluid d-flex flex-lg-row flex-column  align-items-center p-24px secondary-shade-4 rounded-12px">
    <a href="<?=home_url()?>"><img class="h-88px p-16px" src="<?php echo image_url('logo.png') ?>" alt="<?php echo get_bloginfo('name') ?>"></a>
    <div class="w-100">
        <div class="d-flex flex-lg-row flex-column  justify-content-between align-items-center">
            <div>

                <nav class="footer-menu">
                    <?php
                            wp_nav_menu([
                                'theme_location' => 'footer-menu',
                                'container'      => false,
                                'items_wrap'     => '%3$s',
                                'walker'         => new Footer_Menu_Walker(),
                                'fallback_cb'    => false,
                            ]);
                        ?>
                </nav>
            </div>
            <div class="text-secondary-tint-1 fw-500 f-14px"> شماره تماس: <span>۹۸۲۱۸۸۷۰۵۲۸۶+</span></div>
        </div>
        <hr class="text-secondary">
        <div class="d-flex flex-lg-row flex-column-reverse  justify-content-between align-items-center">
            <div class="fw-500 f-10px text-secondary-tint-1 mt-3 mt-lg-0 ">
                تمامی حقوق مادی و معنوی این سایت متعلق به بنیاد شهید رئیسی است و استفاده از مطالب با ذکر منبع بلامانع
                است.
            </div>
            <?php get_component('social-media'); ?>
        </div>
    </div>
</footer>