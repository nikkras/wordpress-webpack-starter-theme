<?php

///////////////////////////////////////////////////////////////////////////////
// HOME PAGE TAGS
///////////////////////////////////////////////////////////////////////////////

// ---------------------------------------------------------------
// HOME INTRO
// ---------------------------------------------------------------

function wpnk_introHero()
{?>
<?php if( have_rows('intro_hero') ): ?>
    <?php while( have_rows('intro_hero') ): the_row(); ?>

	<section class="introHero">

	</section>
	<?php endwhile; ?>
<?php endif; ?>
<?php }



// ---------------------------------------------------------------
// LAST NEWS MODULE
// ---------------------------------------------------------------

function wpnk_lastNews() { ?>
	<div class="homeLastNews">
		<div class="container">
		<div class="homeLastNews__header">
			<h2>Ultime notizie e aggiornamenti</h2>
			<a class='btn btn--small' href="/news">
				<span>Vedi tutte <i class='flaticon-arrow-right'></i></span>
			</a>

		</div>
	<div class="homeLastNews__content">
		<?php 
			$last_post = new WP_Query(array(
				'post_status' => 'publish',
				'posts_per_page'=>3,
				'order'=>'DESC',
				));
			while ($last_post->have_posts()) :
				$last_post->the_post(); 
				$image_arr = wp_get_attachment_image_src(get_post_thumbnail_id($last_post->ID), 'medium_large');
				$i = 0;
				$image_url = $image_arr[$i];
				$i++
		?>
		<div class="homeArticle">
			<a href="<?php the_permalink() ?>">
				<span  class="homeArticle__date"><?php echo get_the_date("d-m-Y"); ?></span>
				<h4 class="homeArticle__title">
					<?php the_title(); ?>
				</h4>
			</a> 
		</div>
		<?php endwhile; wp_reset_postdata();?>
		</div>
		
		</div>
	</div>
<?php }
