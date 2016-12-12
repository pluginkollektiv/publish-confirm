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
	 * Plugin instance.
	 *
	 * @see get_instance()
	 * @type object
	 * @var $instance
	 */
	protected static $instance = NULL;

	/**
	 * Get instance.
	 *
	 * @return Publish_Confirm
	 */
	public static function get_instance() {

		if ( ! self::$instance instanceof self ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Publish_Confirm constructor.
	 */
	public function __construct() {
	}

	/**
	 * Run the plugin working instance.
	 */
	public function setup() {

		// Check user role.
		if ( ! current_user_can( 'publish_posts' ) ) {
			return;
		}

		self::localize();

		foreach ( array( 'post-new.php', 'post.php' ) as $page ) {
			add_action( 'admin_footer-' . $page, array( $this, 'inject_js' ), 11 );
		}
	}

	/**
	 * Validate for the allowed post types.
	 */
	private static function validate_post_type() {

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
	}

	/**
	 * Load language file.
	 *
	 * @since   2015-11-27
	 * @version 2016-12-12
	 */
	public function localize() {

		load_plugin_textdomain( 'publish-confirm' )
	}

	/**
	 * Get message for hint popup.
	 *
	 * @return mixed|void
	 */
	private static function get_message() {

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

		self::validate_post_type();

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
	 * @change  2015-11-30
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
							if ( $( this ).attr( 'name' ) !== 'publish' ) {
								return;
							}
							if ( ! confirm( <?php echo wp_json_encode( $msg ) ?> ) ) {
								event.preventDefault();
							}
						}
					);
				}
			);
		</script>
	<?php }
}
