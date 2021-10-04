<?php

///////////////////////////////////////////////////////////////////////////////
// ARTICLE PAGE TAGS
///////////////////////////////////////////////////////////////////////////////

 // ---------------------------------------------------------------
  // BREADCR
  // ---------------------------------------------------------------

  function wpnk_newsBreadcrumbs() { ?>
    <div class="newsBreadcrumbs">
      <ul>
        <li>
          <a href="/">Home</a>
          <i class="fi flaticon-arrow-right"></i>
        </li>
        <li>
          <a href="/notizie">News</a>
          <i class="fi flaticon-arrow-right"></i>
        </li>
        <li>
          <?php the_title();?></a>
        </li>
      </ul>
    </div>
  <?php }


 // ---------------------------------------------------------------
  // NAV ARTICLE
  // ---------------------------------------------------------------

  function wpnk_articleNav() { ?>
      <nav class="articlePage__content__nav">
        <?php global $post; $prevPost = get_previous_post();
          if(!empty( $prevPost )) {
            $args = array(
              'posts_per_page' => 1,
              'include' => $prevPost->ID
            );
            $prevPost = get_posts($args);
            foreach ($prevPost as $post) {
              setup_postdata($post);
        ?>
          <div class="articlePage__content__nav__tile articlePage__content__nav__tile--prev">
            <div class="newsItem__content">
              <span><i class="fi flaticon-arrow-left"></i> Articolo Precedente</span>
              <h4>
                <a href="<?php the_permalink() ?>">
                  <?php the_title(); ?>
                </a> 
              </h4>
            </div>
          </div>
        <?php
              wp_reset_postdata();
            } // end foreach
          } else {
            $first = new WP_Query('posts_per_page=1&order=DESC'); $first->the_post();
            ?>
            <div class="articlePage__content__nav__tile articlePage__content__nav__tile--prev">
              <div class="newsItem__content">
                <span><i class="fi flaticon-arrow-left"></i> Articolo Precedente</span>
                <h4>
                  <a href="<?php the_permalink() ?>">
                    <?php the_title(); ?>
                  </a> 
                </h4>
              </div>
            </div>
            <?php wp_reset_query();
          }  // end else
          global $post; 
          $nextPost = get_next_post();
          if(!empty( $nextPost )) {
            $args = array(
              'posts_per_page' => 1,
              'include' => $nextPost->ID
            );
            $nextPost = get_posts($args);
            foreach ($nextPost as $post) {
              setup_postdata($post);
          ?>
          <div class="articlePage__content__nav__tile articlePage__content__nav__tile--next">
            <div class="newsItem__content">
              <span>Articolo Successivo <i class="fi flaticon-arrow-right"></i></span>
                <h4>
                  <a href="<?php the_permalink() ?>">
                    <?php the_title(); ?>
                  </a> 
                </h4>
              </div>
            </div>
            <?php wp_reset_postdata();
            } // end foreach
          } else {
            $last = new WP_Query('posts_per_page=1&order=ASC'); $last->the_post();
            ?>
          <div class="articlePage__content__nav__tile articlePage__content__nav__tile--next">
            <div class="newsItem__content">
              <span>Articolo Successivo <i class="fi flaticon-arrow-right"></i></span>
              <h4>
                <a href="<?php the_permalink() ?>">
                  <?php the_title(); ?>
                </a> 
              </h4>
            </div>
          </div>
            <?php
            wp_reset_query();
          } // end else
        ?>
      </nav>
  <?php }

