<?php

// Output content
function tnr_content($content) {
	return do_shortcode(wpautop($content));
}

/**
 * Navigation class
 */
function top_nav_class( $classes, $item )
{
	$classes[] = 'top-nav-item';
	return $classes;
}
add_filter( 'nav_menu_css_class', 'top_nav_class', 10, 2 );

/**
 * Custom Header Fields
 */
// Hook
add_action('custom_header_options', 'custom_header_fields');
// Add fields in admin view
function custom_header_fields()
{
	?>
	<h3>Header Telephone Number</h3>
	<table class="form-table">
		<tbody>
			<tr valign="top" class="hide-if-no-js">
				<th scope="row"><?php _e( 'Telephone Caption:' ); ?></th>
				<td>
					<p>
						<input type="text" name="header_telephone_caption" id="header_telephone_caption"
						value="<?php echo esc_attr( get_theme_mod( 'header_telephone_caption', 'tel: ' ) ); ?>" />
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e( 'Telephone Number:' ); ?></th>
				<td>
					<p>
						<input type="text" name="header_telephone_number" id="header_telephone_number"
						value="<?php echo esc_attr( get_theme_mod( 'header_telephone_number', '01234 456789' ) ); ?>" />
					</p>
				</td>
			</tr>
			<tr valign="top" class="hide-if-no-js">
				<th scope="row"><?php _e( 'Mobile Caption:' ); ?></th>
				<td>
					<p>
						<input type="text" name="header_mobile_caption" id="header_mobile_caption"
						value="<?php echo esc_attr( get_theme_mod( 'header_mobile_caption', 'mob: ' ) ); ?>" />
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php _e( 'Mobile Number:' ); ?></th>
				<td>
					<p>
						<input type="text" name="header_mobile_number" id="header_mobile_number"
						value="<?php echo esc_attr( get_theme_mod( 'header_mobile_number', '01234 456789' ) ); ?>" />
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<h3>Header Showcase Text</h3>
	<table class="form-table">
		<tbody>
			<tr>
				<th class="row"><?= _e('Main Heading');?></th>
				<td>
					<p><input type="text" name="header_heading" id="header_heading"
						value="<?= esc_attr(get_theme_mod( 'header_heading', $default = false )) ?>"/>
					</p>
				</td>
			</tr>
			<tr>
				<th class="row"><?= _e('Main Subheading');?></th>
				<td>
					<p>
						<textarea name="header_subheading" id="header_subheading" cols="60" rows="3"><?=
						esc_attr(get_theme_mod( 'header_subheading', $default = false ))
						?></textarea>
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
} // end custom_header_fields

// Add save functions
add_action('admin_head', 'save_custom_header_fields');
function save_custom_header_fields()
{
	if ( isset( $_POST['header_telephone_caption'] ) && isset( $_POST['header_telephone_number'] )
		&& isset($_POST['header_heading']) && isset($_POST['header_subheading']) )
	{
		// validate the request itself by verifying the _wpnonce-custom-header-options nonce
		// (note: this nonce was present in the normal Custom Header form already, so we didn't have to add our own)
		check_admin_referer( 'custom-header-options', '_wpnonce-custom-header-options' );

		// be sure the user has permission to save theme options (i.e., is an administrator)
		if ( current_user_can('manage_options') ) {
			// NOTE: Add your own validation methods here
			set_theme_mod( 'header_telephone_caption', $_POST['header_telephone_caption'] );
			set_theme_mod( 'header_telephone_number', $_POST['header_telephone_number'] );
			set_theme_mod( 'header_mobile_caption', $_POST['header_mobile_caption'] );
			set_theme_mod( 'header_mobile_number', $_POST['header_mobile_number'] );
			set_theme_mod( 'header_heading', $_POST['header_heading'] );
			set_theme_mod( 'header_subheading', $_POST['header_subheading'] );
		}
	}
	return;
}

include_once('inc/widgets.php');

// Register Sidebars
register_sidebar( array(
	'name'=>'Homepage Carousel',
	'id'=>'homepage_carousel'
	) );

// Add shortcodes
add_shortcode( 'feature_block', 'feature_block' );
function feature_block($args, $content = null) {
	printf('<div class="feature-block">%s</div>', $content);
}

add_shortcode( 'tnr_banner', 'tnr_banner' );
function tnr_banner($args, $content) {
	extract($args);
	?>
	<div class="banner">
		<h2><?=$heading?></h2>
		<p><?=$content?></p>
	</div>
	<?php
}

// Page Fields
add_action('admin_menu', 'add_sidebar_meta');

function add_sidebar_meta() {
	add_meta_box( 'tnr_page_sidebar', 'Sidebar Content', 'tnr_page_sidebar_setup', 'page', 'normal', 'core', null);
}

function tnr_page_sidebar_setup($post) {
	$value = get_post_meta( $post->ID, $key = 'tnr_page_sidebar_content', $single = true );
	wp_nonce_field( plugin_basename( __FILE__ ), 'tnr_page_sidebar_noncename' );
	wp_editor( $value, 'tnr_page_sidebar_content', '' );
}

add_action( 'save_post', 'tnr_page_sidebar_save' );

/* When the post is saved, saves our custom data */
function tnr_page_sidebar_save( $post_id ) {

  // First we need to check if the current user is authorised to do this action.
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

  // Secondly we need to check if the user intended to change this value.
	if ( ! isset( $_POST['tnr_page_sidebar_noncename'] ) || ! wp_verify_nonce( $_POST['tnr_page_sidebar_noncename'], plugin_basename( __FILE__ ) ) ){
		return;
	}

  // Thirdly we can save the value to the database

  //sanitize user input
	$mydata = $_POST['tnr_page_sidebar_content'];

  // Do something with $mydata
  // either using
	add_post_meta($post_id, 'tnr_page_sidebar_content', $mydata, true) or
	update_post_meta($post_id, 'tnr_page_sidebar_content', $mydata);
  // or a custom table (see Further Reading section below)
}

?>