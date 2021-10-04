<?php

/**
 * Template Name: WPNK Profile
 */
get_template_part('src/views/header', 'none');
// if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
//   get_template_part( 'views/pages/content_about', 'none' );
// }
get_template_part('src/views/pages/content_profile', 'none');

get_template_part('src/views/footer', 'none');
