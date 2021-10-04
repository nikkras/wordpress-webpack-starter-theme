<?php
if (is_front_page()) {
    get_template_part('templates/landing', 'none');
}   
// elseif (is_page('area-personale')) {
//     get_template_part('templates/profile', 'none');
// }   elseif (is_page()) {
//     get_template_part('templates/page', 'none');
// }   elseif (is_home()) {
//     get_template_part('templates/news', 'none');
// }   elseif (is_singular()) {
//     get_template_part('templates/article', 'none');
// }   elseif (is_archive()) {
//     get_template_part('templates/news', 'none');
// }