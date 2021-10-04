<main data-barba="container" data-barba-namespace="profile">
	<div data-scroll-section class="profileWrapper container">
	<?php $current_user = wp_get_current_user(); ?>
	<?php $current_user_id = get_current_user_id(); ?>
	<?php $activity = get_the_author_meta('user_activity', $current_user_id ) ?>
	<?php $city = get_the_author_meta('user_city', $current_user_id ) ?>

	  <div class="profile">
			<div class="profile__top">
				<h1><?php print( esc_attr( $current_user->display_name )) ?></h1>
				<div class="profile__top__username"><?php print( esc_attr( $current_user->user_login ))?></div>
				<a class="btn btn--ghost" href='/modifica-profilo'>Modifica profilo</a>
				<a data-barba-prevent='all' class="btn btn--small" href='/logout'>Logout</a>
			</div>

			<div class="profile__lower">
				<?php if ($activity) :	?>
					<div class="profile__lower__activity">
						<span>Ambito di attività</span>
						<h3><?php print( esc_attr( $activity ))?></h3>
					</div>
				<?php endif; ?>

				<?php if ($city) :	?>
					<div class="profile__lower__city"> <i class='flaticon-pin '></i> <?php print( esc_attr( $city ))?></div>
				<?php endif; ?>

			</div>

		</div>


			
		</div>
</main>
