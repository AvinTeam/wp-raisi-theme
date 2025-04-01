<?php
$post_id = get_the_ID();
$gallery_images = get_post_meta($post_id, '_selected_images', true);
$image_ids = !empty($gallery_images) ? explode(',', $gallery_images) : array();

// اگر گالری خالی بود از عکس شاخص استفاده می‌کنیم
if (empty($image_ids) && has_post_thumbnail($post_id)) {
    $image_ids = array(get_post_thumbnail_id($post_id));
}

if (!empty($image_ids)): 
?>
    <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiperImage2">
        <div class="swiper-wrapper">
            <?php foreach ($image_ids as $image_id): ?>
                <?php $image_url = wp_get_attachment_image_url($image_id, 'full'); ?>
                <?php if ($image_url): ?>
                    <div class="swiper-slide rounded-12px overflow-hidden">
                        <img style="height: 480px;" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title($image_id)); ?>">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    
    <div thumbsSlider="" class="swiper mySwiperImage">
        <div class="swiper-wrapper">
            <?php foreach ($image_ids as $image_id): ?>
                <?php $thumb_url = wp_get_attachment_image_url($image_id, 'medium'); ?>
                <?php if ($thumb_url): ?>
                    <div class="swiper-slide">
                        <img class="w-100 h-100" src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr(get_the_title($image_id)); ?>">
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var thumbSwiper = new Swiper(".mySwiperImage", {
                loop: true,
                spaceBetween: 10,
                slidesPerView: 9,
                freeMode: true,
                watchSlidesProgress: true,
            });
            
            var mainSwiper = new Swiper(".mySwiperImage2", {
                loop: true,
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: thumbSwiper,
                },
            });
        });
    </script>
    
    <style>
        .swiper {
            width: 100%;
            height: auto;
            margin: 20px 0;
        }
        .swiper-slide img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
        .mySwiperImage {
            height: 100px;
            box-sizing: border-box;
        }
        .mySwiperImage .swiper-slide {
            opacity: 0.4;
        }
        .mySwiperImage .swiper-slide-thumb-active {
            opacity: 1;
        }
        .swiper-button-next, .swiper-button-prev {
            background-color: rgba(0,0,0,0.5);
            padding: 20px;
            border-radius: 50%;
        }
    </style>
<?php endif; ?>