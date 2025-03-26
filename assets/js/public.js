jalaliDatepicker.startWatch({
    minDate: "attr",
    maxDate: "attr"
});


function startLoading() {
    var overlay = document.getElementById("overlay");

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

    var overlay = document.getElementById("overlay");

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
});

jQuery(document).ready(function ($) {

    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});

