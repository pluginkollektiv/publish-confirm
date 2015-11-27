<?php
// Quit.
defined( 'ABSPATH' ) || exit;

/**
 * Publish_Confirm
 *
 * @since 0.0.3
 */
class Publish_Confirm {

	/**
	 * Publish_Confirm constructor.
	 */
	public function __construct() {

		$this->localize();
	}

	/**
	 * Load language file.
	 *
	 * @since 2015-11-27
	 */
	public function localize() {

		load_plugin_textdomain(
			'publish-confirm',
			FALSE,
			dirname( PUBLISH_CONFIRM_BASE ) . '/lang/'
		);
	}

	/**
	 * Get message for hint popup.
	 *
	 * @return mixed|void
	 */
	private function get_message() {

		// Custom message.
		return apply_filters(
			'publish_confirm_message',
			esc_attr__( 'Are you sure you want to publish this now?', 'publish-confirm' )
		);
	}

	/**
	 * Prepares the JS code integration
	 *
	 * @since   0.0.3
	 * @change  0.0.4
	 *
	 * @hook    array  publish_confirm_message
	 */
	public static function inject_js() {

		// Check user role.
		if ( ! current_user_can( 'publish_posts' ) ) {
			return;
		}

		// Filter published posts.
		if ( get_post()->post_status === 'publish' ) {
			return;
		}

		// Optionally include/exclude post types.
		$current_pt = get_post()->post_type;

		// Filter post types.
		$include_pts = apply_filters(
			'publish_confirm_post_types',
			get_post_types()
		);

		// Bail if current PT is not in PT stack.
		if ( ! in_array( $current_pt, (array) $include_pts ) ) {
			return;
		}

		// Is jQuery loaded.
		if ( ! wp_script_is( 'jquery', 'done' ) ) {
			return;
		}

		// Print javascript.
		self::_print_js( self::get_message() );
	}

	/**
	 * Prints the JS code into the footer
	 *
	 * @since   0.0.3
	 * @change  0.0.5
	 *
	 * @param   string $msg JS confirm message.
	 */
	private static function _print_js( $msg ) {

		?>
		<script type="text/javascript">
			jQuery( document ).ready(
				function( $ ) {
					$( '#publish' ).on(
						'click',
						function( event ) {
							console.log($( this ).val());
							if ( $( this ).val() !== <?php echo wp_json_encode( esc_attr__( 'Publish' ) ) ?> ) {
								return;
							}
							if ( ! confirm(<?php echo wp_json_encode( $msg ) ?>) ) {
								event.preventDefault();
							}
						}
					);
				}
			);
		</script>
	<?php }
}
