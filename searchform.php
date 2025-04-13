<style>
/* استایل‌های پایه */
.search-component {
    display: inline-block;
}

/* فرم موبایل */
.mobile-search-wrapper {
    position: relative;
}

.mobile-search-form {
    position: absolute;
    top: 100%;
    right: 0;
    z-index: 1050;
    width: 280px;
    background: #2c3e50;
    padding: 10px;
    border-radius: 4px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.mobile-search-form .form-control {
    width: 100%;
}

.close-search {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.7;
}

.close-search:hover {
    opacity: 1;
}
</style>





<div class="search-component position-relative">
    <!-- فرم دسکتاپ -->
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get"
        class="search-form position-relative d-none d-lg-block">
        <i class="bi bi-search text-secondary-tint-5 position-absolute w-12px h-12px f-12px"
            style="top: 10px;right: 5px;"></i>
        <input type="text" name="s" class="form-control border-secondary text-white ps-4 rounded-8px f-14px h-36px"
            placeholder="جستجو" value="<?php echo get_search_query(); ?>" style="width: 264px;">
    </form>

    <!-- آیکون موبایل -->
    <button class="search-toggle d-lg-none bg-transparent border-0 p-0">
        <img class="search-icon h-40px w-40px" src="<?php echo image_url('search.png'); ?>" alt="جستجو">
    </button>

    <!-- فرم موبایل -->
    <div class="mobile-search-wrapper d-lg-none">
        <form action="<?php echo esc_url(home_url('/')); ?>" method="get"
            class="mobile-search-form position-relative d-none">
            <input type="text" name="s" class="form-control border-secondary text-white ps-4" placeholder="جستجو"
                value="<?php echo get_search_query(); ?>">
            <button type="button" class="close-search btn-close btn-close-white" aria-label="بستن"></button>
        </form>
    </div>
</div>