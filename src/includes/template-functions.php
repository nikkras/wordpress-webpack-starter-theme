<?php

///////////////////////////////////////////////////////////////////////////////
// TEMPLATE FUNCTIONS
///////////////////////////////////////////////////////////////////////////////

// ---------------------------------------------------------------
// INCLUDE FIELS
// ---------------------------------------------------------------

function include_recursive($dir)
{
    $dh = opendir($dir);
    $dir_list = array($dir);
    while (false !== ($filename = readdir($dh))) {
        if ($filename != "." && $filename != ".." && is_dir($dir . $filename)) {
            array_push($dir_list, $dir . $filename . "/");
        }

    }
    foreach ($dir_list as $dir) {
        foreach (glob($dir . "*.php") as $filename) {
            require_once $filename;
        }

    }
}

// ---------------------------------------------------------------
// ADD PAGE NAME TO BODY CLASS
// ---------------------------------------------------------------

function page_bodyclass()
{
    global $wp_query;
    $page = '';
    if (is_front_page()) {
        $page = 'landing';
    } elseif (is_home()) {
        $page = 'news';
    } elseif (is_404()) {
        $page = 'noContent_404';
    } elseif (is_date() || is_category()) {
        $page = 'news';
    } elseif (is_page('modifica-profilo')) {
        $page = 'modifica-profilo';
    } elseif (is_page('area-personale')) {
        $page = 'area-personale';
    } elseif (is_page()) {
        $page = $wp_query->query_vars["pagename"];
    }   elseif (is_singular()) {
        $page = 'article';
    }

    // production pages ids
    // } elseif (is_page(611)) {
    //     $page = 'proposte';
    // } elseif (is_page(598)) {
    //     $page = 'about';
    // }
    if ($page) {
        echo $page;
    }

}

// ---------------------------------------------------------------
// HIDE EDITOR FOR CERTAIN PAGES
// ---------------------------------------------------------------

function hide_editor()
{
    global $pagenow;
    if (!('post.php' == $pagenow)) {
        return;
    }

    global $post;
    $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];
    if (!isset($post_id)) {
        return;
    }
    if($post_id == 9 || $post_id == 29 || $post_id == 27 || $post_id == 38 || $post_id == 40 || $post_id == 42 || $post_id == 33 || $post_id == 35){
        remove_post_type_support('page', 'editor');
    } 

    // production pages ids
    if($post_id == 2021 || $post_id == 2011 || $post_id == 2010 || $post_id == 2013 || $post_id == 2012 || $post_id == 2009 || $post_id == 2014 || $post_id == 2015){
        remove_post_type_support('page', 'editor');
    } 

    // $template_file = get_post_meta($post_id, '_wp_page_template', true);
    // if($template_file == '#.php'){
    //   remove_post_type_support('page', 'editor');
    // }
    // else if($template_file == '#.php'){
    //   remove_post_type_support('page', 'editor');
    // }
}



// ---------------------------------------------------------------
// ULTIMATE MEBERS
// ---------------------------------------------------------------

function wpnk_custom_define() {
    $custom_meta_fields = array();
    $custom_meta_fields['user_activity'] = 'Ambito Attività';
    $custom_meta_fields['user_address'] = 'Indirizzo';
    $custom_meta_fields['user_city'] = 'Città';
    return $custom_meta_fields;
  }

  function wpnk_columns($defaults) {
    $meta_number = 0;
    $custom_meta_fields = wpnk_custom_define();
    foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
      $meta_number++;
      $defaults[('mysite-usercolumn-' . $meta_number . '')] = __($meta_disp_name, 'user-column');
    }
    return $defaults;
  }
  
  function wpnk_custom_columns($value, $column_name, $id) {
    $meta_number = 0;
    $custom_meta_fields = wpnk_custom_define();
    foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
      $meta_number++;
      if( $column_name == ('mysite-usercolumn-' . $meta_number . '') ) {
        return get_the_author_meta($meta_field_name, $id );
      }
    }
  }
  
  function wpnk_show_extra_profile_fields($user) {
    print('<h3>Extra profile information</h3>');
  
    print('<table class="form-table">');
  
    $meta_number = 0;
    $custom_meta_fields = wpnk_custom_define();
    foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
      $meta_number++;
      print('<tr>');
      print('<th><label for="' . $meta_field_name . '">' . $meta_disp_name . '</label></th>');
      print('<td>');
      print('<input type="text" name="' . $meta_field_name . '" id="' . $meta_field_name . '" value="' . esc_attr( get_the_author_meta($meta_field_name, $user->ID ) ) . '" class="regular-text" /><br />');
      print('<span class="description"></span>');
      print('</td>');
      print('</tr>');
    }
    print('</table>');
  }
  
  function wpnk_save_extra_profile_fields($user_id) {

    if (!current_user_can('edit_user', $user_id))
      return false;
  
    $meta_number = 0;
    $custom_meta_fields = wpnk_custom_define();
    foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
      $meta_number++;
      update_usermeta( $user_id, $meta_field_name, $_POST[$meta_field_name] );
    }
  }
  
function showUMExtraFields() {
    $id = um_user('ID');
    $output = '';
    $custom_meta_fields = wpnk_custom_define();
  
    $fields = array(); 

    foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
        $fields[ $meta_field_name ] = UM()->builtin()->get_specific_field( $meta_field_name );
    }
  
    $fields = apply_filters('um_account_secure_fields', $fields, $id);

    foreach( $fields as $key => $data )
      $output .= UM()->fields()->edit_field( $key, $data );
  
    echo $output;
}

function getUMFormData(){
    $id = um_user('ID');
    $custom_meta_fields = wpnk_custom_define();
  
    foreach ($custom_meta_fields as $meta_field_name => $meta_disp_name) {
        if($meta_field_name === 'user_activity') {
            $option_value = UM()->builtin()->get_specific_field( 'user_activity' )['options'][$_POST[$meta_field_name]];
            update_user_meta( $id, $meta_field_name, $option_value );
        } else {
        update_user_meta( $id, $meta_field_name, $_POST[$meta_field_name] );
        }
    }
}
  
function remove_privacy( $tabs ) {
    unset( $tabs[300] );
    return $tabs;
}