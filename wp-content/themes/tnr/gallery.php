<?php
	/**
	 *	Template Name: Gallery Page
	 */
get_header(); ?>
	<div class="content gallery-wrapper">
		<h1 class="gallery-heading"><?=$post->post_title?></h1>
		<section class="primary gallery-primary">
			<?= tnr_content($post->post_content) ?>
		</section>
		<section class="secondary gallery-sidebar">
			<?= tnr_content(get_post_meta( $post->ID, 'tnr_page_sidebar_content', true )) ?>
		</section>
		<?= do_shortcode( '[nggalbum id=1 template=tnr]' ) ?>
	</div>
<?php get_footer(); ?>