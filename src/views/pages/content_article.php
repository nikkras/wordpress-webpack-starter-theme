<?php while (have_posts()) : the_post(); global $post; ?>
	<main data-barba="container" data-barba-namespace="<?php echo $post->post_name; ?>">
		<article data-scroll-section class="articlePage articlePage--<?php echo $post->post_name; ?> container">
		  <div class="articlePage__hero">
				<h1 class="articlePage__hero__title"><?php the_title(); ?></h1>
				<?php if (has_post_thumbnail()): ?>
					<figure class="articlePage__hero__image">
						<?php the_post_thumbnail('large'); ?>
					</figure>
				<?php endif;?>
			</div>
			<div class="articlePage__content">
				<div class="articlePage__content__date">Pubblicato il <?php echo get_the_date("d-m-Y"); ?></div>
				<div class="articlePage__content__body" itemprop="articleBody">
					<?php the_content(); ?>
				</div>
				<?php wpnk_articleNav();?>
			</div>
		</article>
	</main>
<?php endwhile;?>
