<?php
/**
 * Template Name: WPNK Landing
 */
get_template_part('src/views/header', 'none');
// if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//   get_template_part( 'views/home/content_home', 'none' );
// }
get_template_part('src/views/landing/content_landing', 'none');

get_template_part('src/views/footer', 'none');
