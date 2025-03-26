<div class="main-content">
    <div class="d-flex flex-row align-items-center justify-content-between p-24px h-88px">
        <div class="col-8 text-secondary-tint-1 f-20x fw-bold ">صفحه نخست</div>
        <div class="col-4 d-flex flex-row align-items-center gap-4 justify-content-end">
            <div>
                <a href="#" class="border border-1 border-secondary rounded-8px secondary-shade-2 p-8px"><img
                        class="w-20px h-20px" src="<?php echo image_url('telegram.png') ?>" alt="telegram"></a>
                <a href="#" class="border border-1 border-secondary rounded-8px secondary-shade-2 p-8px"><img
                        class="w-20px h-20px" src="<?php echo image_url('instagram.png') ?>" alt="instagram"></a>
                <a href="#" class="border border-1 border-secondary rounded-8px secondary-shade-2 p-8px"><img
                        class="w-20px h-20px" src="<?php echo image_url('aparat.png') ?>" alt="aparat"></a>
                <a href="#" class="border border-1 border-secondary rounded-8px secondary-shade-2 p-8px"><img
                        class="w-20px h-20px" src="<?php echo image_url('eitaa.png') ?>" alt="eitaa"></a>
            </div>
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="position-relative">

                <i style="top: 10px;right: 10px;"
                    class="bi bi-search text-secondary-tint-5 position-absolute w-12px h-12px"></i>
                <input type="text" name="s" class="form-control  border-secondary text-white ps-4" id="s"
                    placeholder=" جستجو" value="<?php echo get_search_query(); ?>">
            </form>
        </div>
    </div>
    <div class="news secondary-shade-1 d-flex flex-row justify-content-around align-items-center">
        <div class=" col-lg-1 d-flex flex-row align-items-center justify-content-around">
            <span class="text-secondary-tint-1">آخرین مطالب</span>
            <img class="w-12px" src="<?php echo image_url('dif-red.png') ?>">
        </div>
        <div class="col-lg-11 news-ticker">

            <div class="ticker-container">
                <span class="text-secondary-tint-1 mx-4">خبر اول: راه‌اندازی جدیدترین محصول شرکت</span>
                <img class="w-12px" src="<?php echo image_url('dif.png') ?>">
                <span class="text-secondary-tint-1 mx-4">خبر دوم: برگزاری کنفرانس فناوری اطلاعات</span>
                <img class="w-12px" src="<?php echo image_url('dif.png') ?>">
                <span class="text-secondary-tint-1 mx-4">خبر سوم: تغییرات جدید در قوانین مالیاتی</span>
                <img class="w-12px" src="<?php echo image_url('dif.png') ?>">
                <span class="text-secondary-tint-1 mx-4">خبر چهارم: پیشنهادات ویژه برای مشتریان وفادار</span>
            </div>
        </div>

    </div>

</div>