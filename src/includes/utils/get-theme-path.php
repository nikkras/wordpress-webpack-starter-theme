<?php

function wpnk_get_theme_path() {
  $DevPath = 'http://site.local:3015/wp-content/themes/wpnk';
  if ( WP_DEBUG ) {
    return $DevPath;
  } else {
    return get_stylesheet_directory_uri();
  }
}
