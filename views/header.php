<div class="w-100">
    <div class="d-flex flex-row align-items-center justify-content-between p-24px h-88px">
        <div class="col-7 text-secondary-tint-1 f-20px fw-bold "><?php echo get_header_title() ?></div>
        <div class="col-5 d-flex flex-row align-items-center gap-4 justify-content-end">

            <?php
            get_component('social-media');
            get_search_form();
        ?>
        </div>
    </div>
    <div class="news secondary-shade-1 d-flex flex-row justify-content-around align-items-center">
        <div class=" col-lg-1 d-flex flex-row align-items-center justify-content-around">
            <span class="text-secondary-tint-2  fw-500 f-12px">آخرین مطالب</span>
            <img class="w-12px" src="<?php echo image_url('dif-red.png') ?>">
        </div>
        <div class="col-lg-11 news-ticker">

            <div class="ticker-container">
                <span class="text-secondary-tint-1 fw-500 f-12px mx-4">خبر اول: راه‌اندازی جدیدترین محصول شرکت</span>
                <img class="w-12px" src="<?php echo image_url('dif.png') ?>">
                <span class="text-secondary-tint-1 fw-500 f-12px mx-4">خبر دوم: برگزاری کنفرانس فناوری اطلاعات</span>
                <img class="w-12px" src="<?php echo image_url('dif.png') ?>">
                <span class="text-secondary-tint-1 fw-500 f-12px mx-4">خبر سوم: تغییرات جدید در قوانین مالیاتی</span>
                <img class="w-12px" src="<?php echo image_url('dif.png') ?>">
                <span class="text-secondary-tint-1 fw-500 f-12px mx-4">خبر چهارم: پیشنهادات ویژه برای مشتریان
                    وفادار</span>
            </div>
        </div>

    </div>

</div>