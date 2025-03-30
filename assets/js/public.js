jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});


function startLoading() {
    let overlay = document.getElementById("overlay");

    if (overlay) {
        overlay.style.display = "flex"; // نمایش به صورت flex
        overlay.style.opacity = "0"; // آماده‌سازی برای افکت fadeIn
        overlay.style.transition = "opacity 0.5s ease-in-out"; // اضافه کردن انیمیشن

        // تأخیر برای اعمال transition
        setTimeout(() => {
            overlay.style.opacity = "1";
        }, 10);
    }

    document.body.classList.add("no-scroll"); // اضافه کردن کلاس به body
}

function endLoading() {

    let overlay = document.getElementById("overlay");

    if (overlay) {
        overlay.style.transition = "opacity 0.5s ease-in-out"; // اضافه کردن انیمیشن
        overlay.style.opacity = "0"; // شروع افکت fadeOut

        setTimeout(() => {
            overlay.style.display = "none"; // بعد از محو شدن، مخفی کردن کامل
        }, 500); // مقدار 500 باید با زمان transition هماهنگ باشه
    }

    document.body.classList.remove("no-scroll"); // حذف کلاس از body

}

document.addEventListener('DOMContentLoaded', function () {
    // مدیریت منوهای فعال در زمان لود صفحه
    document.querySelectorAll('.arrow-toggle[data-menu-type="active"]').forEach(button => {
        const menuItem = button.closest('.menu-item');
        const submenu = menuItem.querySelector('.submenu');
        const arrow = button.querySelector('.arrow-icon');

        if (submenu) {
            submenu.style.display = 'block';
            arrow.classList.remove('bi-chevron-left');
            arrow.classList.add('bi-chevron-down');
            button.setAttribute('aria-expanded', 'true');
        }
    });

    // مدیریت کلیک روی فلش
    document.querySelectorAll('.arrow-toggle').forEach(button => {
        button.addEventListener('click', function (e) {
            e.stopPropagation();
            const menuItem = this.closest('.menu-item');
            const submenu = menuItem.querySelector('.submenu');
            const arrow = this.querySelector('.arrow-icon');
            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            if (isExpanded) {
                submenu.style.display = 'none';
                arrow.classList.remove('bi-chevron-down');
                arrow.classList.add('bi-chevron-left');
                this.setAttribute('aria-expanded', 'false');
            } else {
                submenu.style.display = 'block';
                arrow.classList.remove('bi-chevron-left');
                arrow.classList.add('bi-chevron-down');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    let tabElms = document.querySelectorAll('button[data-bs-toggle="tab"]');

    tabElms.forEach(function (tab) {
        tab.addEventListener('shown.bs.tab', function (event) {
            let activeTab = event.target.textContent;
            console.log('تب فعال: ' + activeTab);

            // در اینجا می‌توانید عملیات اضافی پس از تغییر تب انجام دهید
            // مثلاً می‌توانید اطلاعات را از سرور دریافت کنید
        });
    });



    new Swiper(".home-slider", {
        direction: "vertical",
        slidesPerView: 1,
        spaceBetween: 30,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });

    new Swiper('.swiper-container', {
        slidesPerView: 4, // پیشفرض برای دسکتاپ
        spaceBetween: 20,
        breakpoints: {
            // وقتی عرض صفحه کمتر از 960px است
            960: {
                slidesPerView: 2.7, // نمایش 2.5 اسلاید
                spaceBetween: 15
            },
            1700: {
                slidesPerView: 4, // نمایش 2.5 اسلاید
                spaceBetween: 15
            }
        }
    });


    new Swiper('.swiper-media', {
        slidesPerView: 4, // پیشفرض برای دسکتاپ
        spaceBetween: 20,
        breakpoints: {
            // وقتی عرض صفحه کمتر از 960px است
            960: {
                slidesPerView: 2.7, // نمایش 2.5 اسلاید
                spaceBetween: 15
            },
            1700: {
                slidesPerView: 3, // نمایش 2.5 اسلاید
                spaceBetween: 15
            }
        }
    });






});

jQuery(document).ready(function ($) {

    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});

