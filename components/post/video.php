<?php

    $image        = (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'full') : '';
    $raisi_aparat = get_post_meta(get_the_ID(), '_raisi_aparat', true);

    if ($raisi_aparat) {
        $raisi_aparat = raisi_remote('https://www.aparat.com/etc/api/video/videohash/' . esc_html(linktocode($raisi_aparat)));

        if ($raisi_aparat[ 'code' ] == 0) {
            $raisi_aparat = $raisi_aparat[ 'result' ];
            if (isset($raisi_aparat->video)) {
                $file_link = $raisi_aparat->video->file_link;
            } else {
                $raisi_aparat = '';
            }
        } else {
            $raisi_aparat = '';
        }
    }

if ($raisi_aparat): ?>

<video class="w-100 rounded-12px" controls src="<?php echo $file_link ?>"></video>

<!-- <a href="<?php echo $file_link ?>" target="_blank" class="btn btn-primary btn-gradient mt-3 w-100 ">دانلود</a> -->


<?php else: ?>
<img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>"
    alt="<?php the_title_attribute(); ?>" class="w-100 rounded-12px">

<?php endif; ?>