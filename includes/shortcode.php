<?php


add_shortcode( 'biography','raisi_biography' );
function raisi_biography() {

    ob_start();
    include_once RAISI_VIEWS . 'biography.php';
    return ob_get_clean();
}