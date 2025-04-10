<?php

    $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    $post_date     = get_the_date('Y-m-d');
    $tags          = get_the_tags();
?>
<div class="p-24px secondary-shade-4 rounded-8px">

    <p class="fw-bold f-20px "><?php the_title(); ?></p>
    <hr class="text-secondary mb-12px">
    <div class="f-14px fw-500 text-secondary-tint-2"><?php the_content(); ?></div>
    <div class="w-100 d-flex flex-row align-items-center">

        <div class="text-center  border-end border-1 border-secondary">
            <a href="<?php the_permalink(); ?>" class="w-100 "><img class="rounded-8px w-48px h-48px"
                    src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php the_title_attribute(); ?>">
            </a>
        </div>
        <div class="d-flex flex-column justify-content-between align-items-start h-48px">

            <?php if ($tags): ?>
            <a href="<?php echo esc_url(get_tag_link($tags[ 0 ]->term_id)); ?>"
                class="fw-500 f-10px text-third-color p-4px"><?php echo esc_html($tags[ 0 ]->name); ?></a>
            <?php endif; ?>

            <span
                class="fw-500 f-10px text-secondary-tint-3 ms-2"><?php echo tarikh($post_date, 'm'); ?></span>
        </div>
    </div>


</div>