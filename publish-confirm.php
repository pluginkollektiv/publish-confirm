<?php
/**
 * Plugin Name: Publish Confirm
 * Description: Extra confirmation dialogue for the publish button to avoid accidental publishing.
 * Author:      pluginkollektiv
 * Author URI:  http://pluginkollektiv.org
 * Plugin URI:  https://wordpress.org/plugins/publish-confirm/
 * Text Domain: publish-confirm
 * Domain Path: /lang
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Version:     0.0.8
 */

/*
Copyright (C)  2014-2015 Sergej Müller, pluginkollektiv

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
*/

/* Quit */
defined( 'ABSPATH' ) || exit;

/* Backend only */
if ( ! is_admin() ) {
	return;
}

/* Fire! */
define( 'PUBLISH_CONFIRM_BASE', plugin_basename( __FILE__ ) );

require_once sprintf(
	'%s/inc/publish-confirm.php',
	dirname( __FILE__ )
);

add_action(
	'admin_footer-post-new.php',
	array(
		'Publish_Confirm',
		'inject_js',
	)
);
add_action(
	'admin_footer-post.php',
	array(
		'Publish_Confirm',
		'inject_js',
	)
);
