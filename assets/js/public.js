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
        });
    });



    new Swiper(".home-slider", {
        direction: "vertical",
        slidesPerView: 1,
        spaceBetween: 30,        
        loop: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        }
    });



    new Swiper('.swiper-container', {
        slidesPerView: 4,
        spaceBetween: 20,
        breakpoints: {
            0: {
                slidesPerView: 2.7,
                spaceBetween: 15
            },
            960: {
                slidesPerView: 4,
                spaceBetween: 15
            }
        }
        
    });


    new Swiper('.swiper-media', {
        slidesPerView: 4,
        spaceBetween: 20,
        breakpoints: {
            0: {
                slidesPerView: 2.7,
                spaceBetween: 15
            },
            960: {
                slidesPerView: 3,
                spaceBetween: 15
            }
        }
    });



    let searchComponent = document.querySelectorAll('.search-component');

    if (searchComponent) {


        class SearchComponent {
            constructor(container) {
                this.container = container;
                this.toggleBtn = container.querySelector('.search-toggle');
                this.searchIcon = container.querySelector('.search-icon');
                this.mobileForm = container.querySelector('.mobile-search-form');
                this.closeBtn = container.querySelector('.close-search');

                this.initEvents();
            }

            initEvents() {
                // نمایش فرم و مخفی کردن آیکون
                this.toggleBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.searchIcon.classList.add('d-none');
                    this.mobileForm.classList.remove('d-none');
                    this.mobileForm.querySelector('input').focus();
                });

                // بستن فرم و نمایش آیکون
                const closeForm = () => {
                    this.mobileForm.classList.add('d-none');
                    this.searchIcon.classList.remove('d-none');
                };

                // بستن با دکمه بستن
                this.closeBtn.addEventListener('click', closeForm);

                // بستن با کلیک خارج از فرم
                document.addEventListener('click', (e) => {
                    if (!this.container.contains(e.target) ||
                        (e.target === this.toggleBtn && !this.mobileForm.classList.contains(
                            'd-none'))) {
                        closeForm();
                    }
                });
            }
        }

        searchComponent.forEach(container => {
            new SearchComponent(container);
        });
    }


});
document.addEventListener('DOMContentLoaded', function () {
    const previewImage = document.querySelector('.preview-image');
    const previewTitle = document.querySelector('.preview-title');
    const heroNewsItems = document.querySelectorAll('.hero-news');

    function updatePreview(activeItem) {
        const image = activeItem.querySelector('.item-image').src;
        const title = activeItem.querySelector('.item-title').textContent;

        previewImage.src = image;
        previewTitle.textContent = title;
    }

    const initialActiveItem = document.querySelector('.hero-news.active');
    if (initialActiveItem) {
        updatePreview(initialActiveItem);
    }

    heroNewsItems.forEach(item => {
        item.addEventListener('click', function () {
            if (!this.classList.contains('active')) {
                heroNewsItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
                updatePreview(this);
            }
        });
    });
});

















jQuery(document).ready(function ($) {





    $('#ticker-container').hover(function () {
        const ticker = document.getElementById('ticker-container');
        ticker.style.animationPlayState = 'paused';

    }, function () {
        const ticker = document.getElementById('ticker-container');
        ticker.style.animationPlayState = 'running';
    }
    );



    $('.onlyNumbersInput').on('input paste', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    let tickerContainer = $('#ticker-container').html();

    let newTicker = tickerContainer;

    for (let i = 0; i < 10; i++) {


        newTicker += tickerContainer;

    }

    $('#ticker-container').html(newTicker);



    const tickerContainer2 = document.getElementById('ticker-container');
    const widthInPx = tickerContainer2.offsetWidth;

    let newSpeedMs = widthInPx / 100;

    const ticker = document.getElementById('ticker-container');
    ticker.style.animationDuration = `${newSpeedMs}s`;















});

