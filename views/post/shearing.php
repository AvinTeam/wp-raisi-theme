<div class="w-100 border border-1 border-secondary p-12px secondary-shade-4 rounded-12px position-sticky top-50">
    <div class="rounded-8px w-100 secondary-shade-2 p-8px">
        <div class="f-14px fw-500 w-100 bg-secondary text-secondary-tint-1 p-8px text-center ">
            اشتراک گذاری</div>
    </div>
    <div class="h-24px"></div>

    <style>
    .link-icon {
        transition: filter 0.3s ease;
    }

    .link-icon.copied {
        filter: brightness(1) sepia(1) saturate(5) hue-rotate(0deg);
    }
    </style>

    <div class="d-flex flex-row justify-content-between align-items-center w-100">
        <!-- دکمه کپی لینک کوتاه -->
        <button class="btn p-0 m-0 copy-link" data-link="<?php echo esc_url(wp_get_shortlink()); ?>">
            <img class="w-32px h-32px link-icon" src="<?php echo image_url('link.png'); ?>" alt="کپی لینک">
        </button>

        <!-- بقیه دکمه‌های اشتراک‌گذاری -->
        <a href="https://t.me/share/url?url=<?php echo urlencode(wp_get_shortlink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
            class="btn p-0 m-0" target="_blank" rel="noopener noreferrer">
            <img class="w-32px h-32px" src="<?php echo image_url('telegram.png'); ?>" alt="اشتراک در تلگرام">
        </a>

        <a href="https://www.instagram.com/?url=<?php echo urlencode(wp_get_shortlink()); ?>" class="btn p-0 m-0"
            target="_blank" rel="noopener noreferrer">
            <img class="w-32px h-32px" src="<?php echo image_url('instagram.png'); ?>" alt="اشتراک در اینستاگرام">
        </a>

        <a href="https://www.aparat.com/share?url=<?php echo urlencode(wp_get_shortlink()); ?>" class="btn p-0 m-0"
            target="_blank" rel="noopener noreferrer">
            <img class="w-32px h-32px" src="<?php echo image_url('aparat.png'); ?>" alt="اشتراک در آپارات">
        </a>

        <a href="https://eitaa.com/share?url=<?php echo urlencode(wp_get_shortlink()); ?>" class="btn p-0 m-0"
            target="_blank" rel="noopener noreferrer">
            <img class="w-32px h-32px" src="<?php echo image_url('eitaa.png'); ?>" alt="اشتراک در ایتا">
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyButtons = document.querySelectorAll('.copy-link');

    copyButtons.forEach(button => {
        button.addEventListener('click', function() {
            const link = this.getAttribute('data-link');
            const linkIcon = this.querySelector('.link-icon');

            // ایجاد یک عنصر موقت برای کپی
            const tempInput = document.createElement('input');
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();

            try {
                // اجرای دستور کپی
                document.execCommand('copy');

                // اضافه کردن کلاس برای تغییر رنگ تصویر
                linkIcon.classList.add('copied');

                // حذف افکت پس از 1 ثانیه
                setTimeout(() => {
                    linkIcon.classList.remove('copied');
                }, 1000);

            } catch (err) {
                console.error('خطا در کپی لینک:', err);
                alert('خطا در کپی لینک');
            }

            // حذف عنصر موقت
            document.body.removeChild(tempInput);
        });
    });
});
</script>