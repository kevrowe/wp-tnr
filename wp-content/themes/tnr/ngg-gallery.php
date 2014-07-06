<?php
	/**
	 *	Template Name: NGG Page
	 */
get_header();
$parent = get_post( $post->post_parent );
?>
	<div class="content gallery-wrapper">
		<h1 class="gallery-heading"><?=$post->post_title;?></h1>
		<a href="<?=get_permalink($parent->ID)?>" class="return-link">&laquo; Back to <?= $parent->post_title ?></a>
		<section>
			<?= tnr_content($post->post_content) ?>
		</section>
	</div>
<?php get_footer(); ?>