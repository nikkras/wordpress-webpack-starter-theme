<?php

function cc_console_log_msgs() {
  global $log_msgs;


  // $log_msgs[]=json_encode($to_formatted);

  foreach($log_msgs as $msg) {
    echo "<script>console.log($msg);</script>";
  }
}
add_action('wp_footer','cc_console_log_msgs');
