<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package wpnk
 */

?><!doctype html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=0"
    />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url');?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo wpnk_get_theme_path(); ?>/dist/favicons/apple-touch-icon.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo wpnk_get_theme_path(); ?>/dist/favicons/favicon-32x32.png" />
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo wpnk_get_theme_path(); ?>/dist/favicons/favicon-16x16.png" />
	<link rel="manifest" href="<?php echo wpnk_get_theme_path(); ?>/dist/favicons/site.webmanifest" />
	<link rel="mask-icon" href="<?php echo wpnk_get_theme_path(); ?>/dist/favicons/safari-pinned-tab.svg" color="#000000" />
	<link rel="shortcut icon" href="<?php echo wpnk_get_theme_path(); ?>/dist/favicons/favicon.ico" />
	<meta name="msapplication-config" content="<?php echo wpnk_get_theme_path(); ?>/dist/favicons/browserconfig.xml" />
	<?php wp_head();?>
</head>

<body class="<?php page_bodyclass();?>" data-barba="wrapper">

	<div id="site" class="wrapper">

		<header id="header" role="banner">
			<div class="container">
				<?php
wpnk_headerLogo();
wpnk_headerBurgerMenu();
wpnk_headerNav();
?>
			</div>
		</header>


		<div data-scroll-container>

