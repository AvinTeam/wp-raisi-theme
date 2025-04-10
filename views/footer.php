<footer
    class="container-fluid d-flex flex-lg-row flex-column  align-items-center p-24px secondary-shade-4 rounded-12px">
    <a class="pe-16px" href="<?php echo home_url() ?>"><img class="h-88px" src="<?php echo image_url('logo.png') ?>"
            alt="<?php echo get_bloginfo('name') ?>"></a>
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
            <div
                class="text-secondary-tint-1 fw-500 f-14px d-flex flex-row align-items-center justify-content-center gap-1">
                <span>شماره تماس: </span>
                <a class="d-flex flex-row-reverse align-items-center justify-content-center gap-1"
                    href="tel:+982188705286">
                    <span class="text-secondary-tint-1 fw-500 f-14px">98+</span>
                    <span class="text-secondary-tint-1 fw-500 f-14px">21</span>
                    <span class="text-secondary-tint-1 fw-500 f-14px">8870</span>
                    <span class="text-secondary-tint-1 fw-500 f-14px">5286</span>
                </a>
            </div>
        </div>
        <hr class="text-secondary my-12px">
        <div class="d-flex flex-lg-row flex-column-reverse  justify-content-between align-items-center">
            <div class="fw-500 f-10px text-secondary-tint-1 mt-3 mt-lg-0 ">
                تمامی حقوق مادی و معنوی این سایت متعلق به بنیاد شهید رئیسی است و استفاده از مطالب با ذکر منبع بلامانع
                است.
            </div>
            <?php get_component('social-media'); ?>
        </div>
    </div>
</footer>