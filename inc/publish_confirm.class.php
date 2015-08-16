<?php

/* Quit */
defined('ABSPATH') OR exit;


/**
 * Publish_Confirm
 *
 * @since 0.0.3
 */
class Publish_Confirm {


	/**
	 * Prepares the JS code integration
	 *
	 * @since   0.0.3
	 * @change  0.0.4
	 *
	 * @hook    array  publish_confirm_message
	 */
	public static function inject_js() {
		/* Check user role */
		if ( ! current_user_can( 'publish_posts' ) ) {
			return;
		}

		/* Filter published posts */
		if ( get_post()->post_status === 'publish' ) {
			return;
		}

		/* Optionally exlcude post types */
		$post_type =get_post()->post_type;

		$exclude_post_types = apply_filters(
			'publish_confirm_exclude_post_types',
			array()
		);

		if ( in_array( $post_type, (array) $exclude_post_types ) ) {
			return;
		}

		/* Optionally only include given post types */
		$include_post_types = apply_filters(
			'publish_confirm_include_post_types',
			array()
		);

		if ( has_filter( 'publish_confirm_include_post_types' ) && ! in_array( $post_type, (array) $include_post_types ) ) {
			return;
		}

		/* jQuery loaded? */
		if ( ! wp_script_is('jquery', 'done') ) {
			return;
		}

		/* Default message */
		$default = 'Are you sure you want to publish this now?';

		/* Custom message */
		$msg = apply_filters(
			'publish_confirm_message',
			$default
		);

		/* Message not changed? */
		if ( $msg === $default ) {
			load_plugin_textdomain(
				'publish-confirm',
				false,
				dirname( PUBLISH_CONFIRM_BASE ). '/lang/'
			);

			$msg = __( $default, 'publish-confirm' );
		}

		/* Print javascript */
		self::_print_js( $msg );
	}


	/**
	 * Prints the JS code into the footer
	 *
	 * @since   0.0.3
	 * @change  0.0.5
	 *
	 * @param   string  $msg  JS confirm message
	 */
	private static function _print_js( $msg ) { ?>
		<script type="text/javascript">
			jQuery(document).ready(
				function($){
					$( '#publish' ).on(
						'click',
						function(event) {
							if ( $(this).val() !== <?php echo json_encode( __( 'Publish' ) ) ?> ) {
								return;
							}
							if ( ! confirm(<?php echo json_encode($msg) ?>) ) {
								event.preventDefault();
							}
						}
					);
				}
			);
		</script>
	<?php }
}
