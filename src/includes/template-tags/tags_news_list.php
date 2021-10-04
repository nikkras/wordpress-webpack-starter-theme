<?php

///////////////////////////////////////////////////////////////////////////////
// LISTINGS NEWS TAGS
///////////////////////////////////////////////////////////////////////////////


// ---------------------------------------------------------------
// EVENTS DROPDOWN CAT
// ---------------------------------------------------------------

function wpnk_newsTags()
{?>
	<div class="newsTags">
    <h3>Tag</h3>
  <?php
    $tags = get_tags(array('get'=>'all'));
    $output = '<ul class="newsTags__ul">';
        if($tags) {
        foreach ($tags as $tag):
        $output .= '<li><a href="'. get_term_link($tag).'">'. $tag->name .'</a></li>';
        endforeach;
        } else {
        _e('No tags created.', 'text-domain');
        }
      $output .= '</ul>';
      echo $output;
    ?>
	</div>
<?php }



// ---------------------------------------------------------------
// EVENTS CONTENT LIST
// ---------------------------------------------------------------

function wpnk_newsList()
{?>
	<?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
    $args = array(
      'posts_per_page' => 10,
      'paged'          => $paged,
    );
    $the_query = new WP_Query( $args );

    global $wp_query;
    // Put default query object in a temp variable
    $tmp_query = $wp_query;
    // Now wipe it out completely
    $wp_query = null;
    // Re-populate the global with our custom query
    $wp_query = $the_query;

    if ( $the_query->have_posts() ) : 
      while ( $the_query->have_posts() ) : $the_query->the_post();?>
      <div class="newsItem">
        <div class="newsItem__content">
          <a href="<?php the_permalink() ?>">
            <div class='newsItem__content__date'><?php echo get_the_date("d-m-Y"); ?></div>
            <h4 class='newsItem__content__title'>
              <?php the_title(); ?>
            </h4>
          </a> 
        </div>
      </div>
      <?php endwhile; ?>

    <div class="pagination">
      <?php 
        previous_posts_link( '&laquo; Post precedenti' );
        next_posts_link( 'Post successivi &raquo;', $the_query->max_num_pages );
      ?>
    </div>

    <?php 
      wp_reset_postdata();
      else :
      endif;
      $wp_query = null;
      $wp_query = $tmp_query;
    ?>
<?php }



// ---------------------------------------------------------------
// EVENTS CONTENT LIST
// ---------------------------------------------------------------

function wpnk_tagsList()
{?>
	<?php
    if ( have_posts() ) : 
      while ( have_posts() ) : the_post();?>

      <div class="newsItem">
        
        <figure class="newsItem__image">
          <a href="<?php the_permalink() ?>">
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('medium_large'); ?>
              <?php else: ?>
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/placeholder.png" alt="Eco2000" />
            <?php endif;?>
            </a> 
          </figure>
          <div class="newsItem__content">
            <h4>
              <a href="<?php the_permalink() ?>">
                <?php the_title(); ?>
              </a> 
            </h4>
            <span><?php echo get_the_date("d-m-Y"); ?></span>
          </div>
      </div>
      <?php endwhile; ?>

    <div class="pagination">
      <?php 
        previous_posts_link( '&laquo; Post precedenti' );
        next_posts_link( 'Post successivi &raquo;', $the_query->max_num_pages );
      ?>
    </div>
    <?php endif; ?>
<?php }
