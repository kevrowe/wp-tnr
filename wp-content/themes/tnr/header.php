<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage TNR Roofing
 * @since TNR Roofing 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html lang="en" class="ie7">
<![endif]-->
<![if !IE]>
<html lang="en">
<![endif]>
<head>
		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

		<meta name="description" content="" />
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title( '-', true, 'right' ); ?></title>
		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.png" />
		<link rel="apple-touch-icon" href="/favicon.png" />
		<script src="<?=get_stylesheet_directory_uri()?>/js/modernizr.js" type="text/javascript" charset="utf-8"></script>
		<?php wp_head(); ?>
		<!--[if IE]>
		<link href="<?= get_stylesheet_directory_uri() ?>/ie.css" media="screen, projection" rel="stylesheet" type="text/css" />
		<![endif]-->
	</head>

	<body>
		<div class="top">
			<div class="top-bar"></div>
			<div class="wrapper">
				<?php
				wp_nav_menu( array(
					'theme_location'  => 'primary',
					'menu'            => null,
					'container'       => false,
					'container_class' => null,
					'container_id'    => null,
					'menu_class'      => 'top-nav',
					'menu_id'         => null,
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '<div class="top-nav-hoverline"></div>',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
					'depth'           => 0,
					'walker'          =>  null) );
					?>
					<div class="top-nav-caption">
						<div>
							<?= get_theme_mod( 'header_telephone_caption'	, $default = false ) ?>
							<?= get_theme_mod( 'header_telephone_number'	, $default = false ) ?>
						</div>
						<div>
							<?= get_theme_mod( 'header_mobile_caption'	, $default = false ) ?>
							<?= get_theme_mod( 'header_mobile_number'	, $default = false ) ?>
						</div>
					</div>
					<?php if(!is_front_page()): ?>
					<a class="top-nav-logo" href="/">
						<img src="<?=get_stylesheet_directory_uri()?>/img/mini-logo.png" alt="TNR Roofing Logo"/>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php if ( is_front_page() ): ?>
		<div class="feature">
			<div class="wrapper">
				<div class="header-info">
					<p class="primary-heading">
						<?= get_theme_mod( 'header_heading', $default = false ) ?>
					</p>
					<p class="secondary-heading feature-secondary">
						<?= get_theme_mod( 'header_subheading', $default = false ) ?>
					</p>
				</div>
				<img src="<?= get_stylesheet_directory_uri() ?>/img/header4.png" alt="TNR Roofing &amp; Property Development" class="header-offset" align="right" />
			</div>
		<?php endif; ?>
	</div>
	<div class="main">
		<div class="wrapper">