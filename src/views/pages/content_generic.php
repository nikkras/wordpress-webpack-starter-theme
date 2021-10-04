<?php while (have_posts()) : the_post(); global $post; ?>
	<main data-barba="container" data-barba-namespace="<?php echo $post->post_name; ?>">
		<div data-scroll-section class="page page--<?php echo $post->post_name; ?>">

		<?php if (is_page('login')) :	?>

			<div class="page__hero page__hero--login">
					<div class='container'>
						<h1>Accedi a Site</h1>
					</div>
				</div>

		<?php elseif (is_page('registrazione')) :	?>

			<div class="page__hero page__hero--registrazione">
					<div class='container'>
						<?php 
							$acfTitle = get_field('reg_title');
							if( !empty( $acfTitle ) ): ?>
								<h1><?php the_field('reg_title'); ?></h1>
							<?php endif; ?>

							<?php 
							$acfSubtitle = get_field('reg_subtitle');
							if( !empty( $acfSubtitle ) ): ?>
								<div class='page__hero__subtitle'><?php the_field('reg_subtitle'); ?></div>
							<?php endif; ?>

						<div class='page__hero__steps'>
							<div class="regSteps">
								<div class="regSteps__step">
									<span class="regSteps__step__number">
										<span>1</span>
									</span>
								</div>
								<div class="regSteps__step">
									<span class="regSteps__step__number">
										<span>2</span>
									</span>
								</div>
								<div class="regSteps__step">
									<span class="regSteps__step__number">
										<span>3</span>
									</span>
								</div>
							</div>

						</div>
					</div>
				</div>

		<?php else :	?>

				<div class="page__hero <?php if (!is_page(array( 'area-personale', 'modifica-profilo' ))) echo 'page__hero--bg'?>">
					<div class='container'>
						<h1><?php the_title(); ?></h1>
					</div>
				</div>

		<?php endif;?>

				<div class="page__content container" <?php if (is_page(array( 'area-personale', 'modifica-profilo' ))) echo "data-barba-prevent='all'" ?>>
					<?php if( '' !== get_post()->post_content ) : ?>
						<div class="pageEditor">
							<?php the_content(); ?>
							<?php if (is_page('registrazione')) :	?>
								<div class="stepsNav">
									<button class='btn btn--red btn--animated btn--next'>
										Procedi
									</button>
									<br /><br />
									<button class='btn btn--small btn--prev'>
										<span>
										Indietro
										</span>
									</button>
								</div>
							<?php endif; ?>
						</div>
				  <?php endif; ?>					
				</div>
				
			</div>
	</main>
<?php endwhile; ?>
