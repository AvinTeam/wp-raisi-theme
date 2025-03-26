<form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="position-relative">

<i style="top: 10px;right: 10px;"
    class="bi bi-search text-secondary-tint-5 position-absolute w-12px h-12px"></i>
<input type="text" name="s" class="form-control  border-secondary text-white ps-4" id="s"
    placeholder=" جستجو" value="<?php echo get_search_query(); ?>">
</form>