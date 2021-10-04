<?php

///////////////////////////////////////////////////////////////////////////////
// COMMON BASIC TEMPLATE TAGS
///////////////////////////////////////////////////////////////////////////////

// ---------------------------------------------------------------
// HEADER LOGO
// ---------------------------------------------------------------

function wpnk_headerLogo()
{?>
	<div class="header__brandContent">
		<h1>
			<span><?php bloginfo('name');?></span>
			<a class="mainLogo" href="<?php echo esc_url(home_url('/')); ?>" rel="home">
				<img src="<?php echo wpnk_get_theme_path(); ?>/dist/svg/logoipsum.svg" alt="site logo" />
			</a>
			<?php if ('' != get_bloginfo('description')) {?>
				<p class="site-description"><?php echo bloginfo('description'); ?></p>
			<?php }?>
		</h1>
	</div>
<?php }

// ---------------------------------------------------------------
// BURGER MENU
// ---------------------------------------------------------------

function wpnk_headerBurgerMenu()
{?>
	<div class="header__mobileContent">
		<div class="burgerMenu">
			<div class="burgerMenu__bar"></div>
			<div class="burgerMenu__bar"></div>
			<div class="burgerMenu__bar"></div>
		</div>
	</div>
<?php }

// ---------------------------------------------------------------
// NAV
// ---------------------------------------------------------------

function wpnk_headerNav()
{?>
	<div class="header__navContent">
		<nav class="mainNav" role="navigation">
			<?php
wp_nav_menu(
    array(
        'theme_location' => 'wpnk_nav',
        'container' => '',
        'container_class' => '',
        'menu_class' => 'listMenu',
        'menu_id' => 'site-main-menu',
        'walker' => new WPNK_Nav_Menu_Walker_Simple(),
    )
);
    ?>
		<?php if (is_user_logged_in()) :	?>
			<?php $current_user = wp_get_current_user(); ?>

			<a href="<?php echo get_page_link(get_page_by_path('area-personale')->ID); ?>" class="mainNav__profile">
				<span><?php print( esc_attr( $current_user->user_firstname )) ?></span>
				<i class="fi flaticon-user"></i>
			</a>
			<?php endif; ?>

		</nav>
	</div>
<?php }



// ---------------------------------------------------------------
// PAGE CONTACTS RIBBON
// ---------------------------------------------------------------

function wpnk_contactsRibbon()
{?>
	<div class="contactsRibbon">
		<div class='container'>
			<a href="<?php echo get_page_link(14); ?>">
				Contattaci
			</a>
		</div>
	</div>
<?php }

