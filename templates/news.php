<?php
/**
 * Template Name: WPNK News
 */
get_template_part('src/views/header', 'none');
// if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//   get_template_part( 'views/listings/content_news', 'none' );
// }
get_template_part('src/views/listings/content_news', 'none');

get_template_part('src/views/footer', 'none');
