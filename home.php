<?php get_header(); ?>





<div class="d-flex flex-row">

    <?php get_sidebar(); ?>


    <div class="main-content">

        <?php
            get_view_part('header');
        ?>

        <div class="d-flex flex-column p-12px">
            <div class="d-flex flex-row">
                <div class="main-content">
                    main-content
                </div>
                <div class="sidebar">
                    <?php
                        get_component('favorites-tab');
                        echo '<div class="h-24px"></div>';
                        get_component('notes');
                    ?>

                </div>
            </div>


            <?php

                get_view_part('footer');
            ?>
        </div>
    </div>
</div>


<!-- دکمه برای نمایش سایدبار در موبایل -->
<button class="btn btn-primary d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar">
    منو
</button>










<!-- اسکریپت برای مدیریت رویدادهای تب -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var tabElms = document.querySelectorAll('button[data-bs-toggle="tab"]');

    tabElms.forEach(function(tab) {
        tab.addEventListener('shown.bs.tab', function(event) {
            var activeTab = event.target.textContent;
            console.log('تب فعال: ' + activeTab);

            // در اینجا می‌توانید عملیات اضافی پس از تغییر تب انجام دهید
            // مثلاً می‌توانید اطلاعات را از سرور دریافت کنید
        });
    });
});
</script>






<?php

get_footer();