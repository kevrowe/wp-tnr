<?php
/**
 * Template Name: No Sidebar
 */

get_header(); ?>
	<div class="content">
		<section class="primary full-width">
			<div class="feature-block">
			<?= tnr_content($post->post_content) ?>
			</div>
		</section>
	</div>
<?php get_footer(); ?>