<?php

///////////////////////////////////////////////////////////////////////////////
// LISTINGS PAGES TAGS
///////////////////////////////////////////////////////////////////////////////

// ---------------------------------------------------------------
// PROPOSTE HEADER
// ---------------------------------------------------------------

function wpnk_projectsListingHeader()
{?>
  <div class='breadcrumbs'>
	  <ul>
			<li><a href="/">Home</a></li>
			<li>Proposte</li>
		</ul>
	</div>
	<?php
	if (isset($_GET['categoria'])) {
    $cat = $_REQUEST['categoria'];
    // $getCat = get_category_by_slug($cat);
    $getCat = get_term_by('slug', $cat, 'projects_taxonomies');

    if ($getCat instanceof WP_Term) {
			if ($getCat->name === 'proposte') {
				echo '<h1>Proposte</h1>';
			} else {
        echo '<h1>Proposte ' . $getCat->name . '</h1>';
			}
    } else {
        echo '<h1>Proposte</h1>';
    }
	} else {
			echo '<h1>Proposte</h1>';
	}
    ?>
<?php }

// ---------------------------------------------------------------
// EVENTS DROPDOWN CAT
// ---------------------------------------------------------------

function wpnk_categoryDropdown()
{?>
	<div class="projectsCategoryDropdown" id="projectsCategoryDropdown">
		<form method="get">
			<label for="projectsCatDropdown">Filtro</label>
			<div class="select">
				<select id="projectsCatDropdown" name="categoria" onchange="jQuery('#projectsCategoryDropdown form').submit()">
				<?php if (!isset($_GET['categoria']) ): ?>
					<option value="" selected>Seleziona</option>
					<option value="in-costruzione">in costruzione</option>
					<option value="in-vendita">in vendita</option>
				<?php endif;?>

				<?php
					if (isset($_GET['categoria'])) {
						$cat = $_REQUEST['categoria'];
						$getCat = get_term_by('slug', $cat, 'projects_taxonomies');
						if ($getCat instanceof WP_Term) {
							if ($getCat->name === 'proposte') {
								echo '<option value="">Seleziona</option>';
							} 
						} 
					} ?>
				<?php 
					if (isset($_GET['categoria'])) {
						$cat = $_REQUEST['categoria'];
						$getCat = get_term_by('slug', $cat, 'projects_taxonomies');
						if ($getCat instanceof WP_Term) {
							if ($getCat->name === 'in costruzione') {
								echo '<option value="in-costruzione" selected>in costruzione</option>';
							} else {
								echo '<option value="in-costruzione">in costruzione</option>';
							}
						} 
					} 
				?>
				<?php 
					if (isset($_GET['categoria'])) {
						$cat = $_REQUEST['categoria'];
						$getCat = get_term_by('slug', $cat, 'projects_taxonomies');
						if ($getCat instanceof WP_Term) {
							if ($getCat->name === 'in vendita') {
								echo '<option value="in-vendita" selected>in vendita</option>';
							} else {
								echo '<option value="in-vendita">in vendita</option>';
							}
						} 
					} 
				?>
					<?php
// $categories = get_categories(array(
//     'taxonomy' => 'projects_taxonomies',
//     'orderby' => 'name',
//     'order' => 'ASC',
// ));
//     foreach ($categories as $category) {
// 			$cat = $_REQUEST['categoria'];
// 			if( $cat  === $category->slug) {
//         $category_opt = sprintf(
// 					'<option selected value="%1$s">%2$s</option>',
// 					esc_html($category->slug),
// 					esc_html($category->name)
// 			);
// 			echo $category_opt;

// 			} else {
//         $category_opt = sprintf(
// 					'<option value="%1$s">%2$s</option>',
// 					esc_html($category->slug),
// 					esc_html($category->name)
// 			);
// 			echo $category_opt;

// 			}
//     }
    ?>
				</select>
								<!-- <div class="select__arrow">
					<i class="fi flaticon-arrow-down"></i>
				</div> -->

			</div>
			<input type="submit" style="display:none">
		</form>
		<?php if (isset($_GET['categoria'])): 
		$cat = $_REQUEST['categoria'];
			?>
			<?php if ($cat != 'proposte'): ?>
				<a class="cleanUpFilters" href="<?php home_url()?>/proposte/">Azzera e vedi tutti</a>
			<?php endif;?>
		<?php endif;?>
	</div>
<?php }


// ---------------------------------------------------------------
// EVENTS CONTENT LIST
// ---------------------------------------------------------------

function wpnk_projectsList()
{?>
	<?php
global $paged;
    global $post;
    if (isset($_GET['categoria'])) {
        $cat = $_REQUEST['categoria'];
        query_posts(
            array(
                'post_type' => 'Progetti',
                'order' => 'desc',
								'orderby' => 'modified',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'projects_taxonomies',
                        'field' => 'slug',
                        'terms' => $cat,
                    ),
                ),
                'posts_per_page' => 8,
                'paged' => $paged,
            )
        );
    } else {
        query_posts(
            array(
                'post_type' => 'Progetti',
                'order' => 'desc',
								'orderby' => 'modified',
                'posts_per_page' => 8,
                'paged' => $paged,
            )
        );
    }

		if (have_posts()): 
			?>
			
			<div class="projectsContent__list container">

			<?php 
        while (have_posts()): the_post();
				$image_arr = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium_large');
				$image_url = $image_arr[0];
				$post_type = get_post_type(get_the_ID());   
				$taxonomies = get_object_taxonomies($post_type);   
				$taxonomy_names = wp_get_object_terms(get_the_ID(), $taxonomies,  array("fields" => "names")); 
				?>
					<div class="projectsTile">

						<figure class="projectsTile__image">
							<a href="<?php the_permalink();?>">
								<?php if (!empty($image_url)): ?>
									<img src="<?php echo $image_url ?>" alt="edilmema">
								<?php else: ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-vert-white.png" alt="edilmema" />
								<?php endif;?>
							</a>
						</figure>

						<span class='projectsTile__categories'>
							<?php 
								if(!empty($taxonomy_names)) :
									foreach($taxonomy_names as $tax_name) : ?>     
										<?php if($tax_name != 'proposte') : ?> 
											<p><?php echo $tax_name; ?> </p>
										<?php endif; ?>
									<?php endforeach;
								endif;
							?>
						</span>

						<div class="projectsTile__content">
							<h3 class="projectsTile__content__title">
								<a href="<?php the_permalink();?>">
									<?php the_title();?>
								</a>
							</h3>
							<div class="projectsTile__content__specs">
								<?php if( have_rows('caratteristiche') ): 
									$arrNumBagni = [];
									$arrMetratura = [];
									$arrStanzeLetto = [];
									while( have_rows('caratteristiche') ) : the_row();
										array_push($arrNumBagni, get_sub_field('numero_bagni'));
										array_push($arrMetratura, get_sub_field('metratura'));
										array_push($arrStanzeLetto, get_sub_field('stanze_letto'));
									endwhile;
									?>
									<span><i class="fi flaticon-bathtub"></i><?php echo array_sum($arrNumBagni); ?></span>
									<span><i class="fi flaticon-metering"></i><?php echo array_sum($arrMetratura); ?></span>
									<span><i class="fi flaticon-bed"></i><?php echo array_sum($arrStanzeLetto); ?></span>
								<?php endif; ?>
								<span><i class="fi flaticon-pin"></i><span class='textPlace'><?php the_field('luogo'); ?></span></span>
							</div>
						</div>
					</div>
				<?php endwhile;?>
			</div> 
		<?php if (get_posts_nav_link()): ?>
			<div class="pagination container">
				<?php posts_nav_link();?>
			</div>
		<?php endif;?>

	<?php
else:
        echo 'Nessun evento da mostrare';
    endif;
    wp_reset_query();
    ?>
<?php }


// ---------------------------------------------------------------
// WORSK LIST
// ---------------------------------------------------------------

function wpnk_worksList()
{?>
	<?php
global $paged;
    global $post;
		query_posts(
			array(
					'post_type' => 'Progetti',
					'projects_taxonomies'  => 'lavori-svolti',
					'order' => 'desc',
					'orderby' => 'modified',
					'posts_per_page' => 8,
					'paged' => $paged,
			)
		);
		if (have_posts()): 
			?>
			
			<div class="projectsContent__list container">

			<?php 
        while (have_posts()): the_post();
				$image_arr = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium_large');
				$image_url = $image_arr[0];
				$post_type = get_post_type(get_the_ID());   
				$taxonomies = get_object_taxonomies($post_type);   
				$taxonomy_names = wp_get_object_terms(get_the_ID(), $taxonomies,  array("fields" => "names")); 
				?>
					<div class="projectsTile">

						<figure class="projectsTile__image">
							<a href="<?php the_permalink();?>">
								<?php if (!empty($image_url)): ?>
									<img src="<?php echo $image_url ?>" alt="edilmema">
								<?php else: ?>
									<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-vert-white.png" alt="edilmema" />
								<?php endif;?>
							</a>
						</figure>

						<div class="projectsTile__content">
							<h3 class="projectsTile__content__title">
								<a href="<?php the_permalink();?>">
									<?php the_title();?>
								</a>
							</h3>
							<div class="projectsTile__content__specs">
								<?php if( have_rows('caratteristiche') ): 
									$arrNumBagni = [];
									$arrMetratura = [];
									$arrStanzeLetto = [];
									while( have_rows('caratteristiche') ) : the_row();
										array_push($arrNumBagni, get_sub_field('numero_bagni'));
										array_push($arrMetratura, get_sub_field('metratura'));
										array_push($arrStanzeLetto, get_sub_field('stanze_letto'));
									endwhile;
									?>
									<span><i class="fi flaticon-bathtub"></i><?php echo array_sum($arrNumBagni); ?></span>
									<span><i class="fi flaticon-metering"></i><?php echo array_sum($arrMetratura); ?></span>
									<span><i class="fi flaticon-bed"></i><?php echo array_sum($arrStanzeLetto); ?></span>
								<?php endif; ?>
								<span><i class="fi flaticon-pin"></i><span class='textPlace'><?php the_field('luogo'); ?></span></span>
							</div>
						</div>

					</div>
				<?php endwhile;?>
			</div> 
		<?php if (get_posts_nav_link()): ?>
			<div class="pagination container">
				<?php posts_nav_link();?>
			</div>
		<?php endif;?>

	<?php
else:
        echo 'Nessun evento da mostrare';
    endif;
    wp_reset_query();
    ?>
<?php }
