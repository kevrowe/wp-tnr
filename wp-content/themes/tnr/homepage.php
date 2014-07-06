<?php
/**
 * Template Name: Homepage
 */

get_header(); ?>
	<div class="content">
		<section class="primary">
			<?php dynamic_sidebar( 'homepage_carousel' ); ?>
			<?= tnr_content($post->post_content) ?>
		</section>
		<section class="secondary sec-black">
			<?= do_shortcode( get_post_meta( $post->ID, 'tnr_page_sidebar_content', $single = true )) ?>
		</section>
	</div>
<?php get_footer(); ?>