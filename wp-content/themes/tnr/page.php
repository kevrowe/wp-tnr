<?php
get_header(); ?>
	<div class="content">
		<section class="primary">
			<div class="feature-block">
			<?= tnr_content($post->post_content) ?>
			</div>
		</section>
		<section class="secondary sec-black sec-padded">
			<?= tnr_content(get_post_meta( $post->ID, 'tnr_page_sidebar_content', true )) ?>
		</section>
	</div>
<?php get_footer(); ?>