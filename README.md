# Publish Confirm #
* Contributors:      pluginkollektiv
* Tags:              publish, posts, confirm, confirmation, dialogue
* Donate link:       https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8CH5FPR88QYML
* Requires at least: 3.9
* Tested up to:      4.7
* Stable tag:        1.0.0
* License:           GPLv2 or later
* License URI:       http://www.gnu.org/licenses/gpl-2.0.html


Extra confirmation dialogue for the publish button to avoid accidental publishing.


## Description ##
Accidentally published a WordPress post too early once too often, instead of saving it as a draft? This lightweight WordPress plugin implements an extra confirmation dialogue between your click on the *Publish* button and its actual processing. Simple and effective—never publish by accident again!

Once a post has been published, the confirmation dialogue will not appear anymore for that post.

### Support ###
* Community support via the [support forums on wordpress.org](https://wordpress.org/support/plugin/publish-confirm)
* We don’t handle support via e-mail, Twitter, GitHub issues etc.

### Contribute ###
* Active development of this plugin is handled [on GitHub](https://github.com/pluginkollektiv/publish-confirm).
* Pull requests for documented bugs are highly appreciated.
* If you think you’ve found a bug (e.g. you’re experiencing unexpected behavior), please post at the [support forums](https://wordpress.org/support/plugin/publish-confirm) first.
* If you want to help us translate this plugin you can do so [on WordPress Translate](https://translate.wordpress.org/projects/wp-plugins/publish-confirm).

### Credits ###
* Author: [Sergej Müller](https://sergejmueller.github.io/)
* Maintainers: [pluginkollektiv](http://pluginkollektiv.org/)


## Installation ##
* If you don’t know how to install a plugin for WordPress, [here’s how](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins).

### Requirements ###
* WordPress 4.5 or greater


## Frequently Asked Questions ##
### Does *Publish Confirm* work for posts and pages? ###
Yes, it does.

### And Custom Post Types? ###
Yup.

### Can I limit/extend the plugin’s functionality for a custom selection of post types? ###
Yes, you can, via PHP filter from a custom plugin or from your theme’s functions.php. By default, the plugin will consider all [registered post types](https://developer.wordpress.org/reference/functions/register_post_type/). As an example, you could only have a confirmation dialogue for public post types, excluding attachments, like this:

<pre>add_filter(
	'publish_confirm_post_types',
	function ( $post_types ) {

		$post_types = get_post_types( array( 'public' => true ) );

		if ( isset( $post_types[ 'attachment' ] ) ) {
			unset( $post_types[ 'attachment' ] );
		}

		return $post_types;
	}
);</pre>

Or you can exclude your particular custom post type from the confirmation dialogue like so:

<pre>add_filter(
	'publish_confirm_post_types',
	function ( $post_types ) {

		if ( isset( $post_types[ 'your_custom_post_type' ] ) ) {
			unset( $post_types[ 'your_custom_post_type' ] );
		}

		return $post_types;
	}
);</pre>

### Is there any way to change the default dialogue message into something else? ###
The message text in the publishing dialogue can be changed via PHP filter from a custom plugin or your theme’s functions.php:

<pre>add_filter(
	'publish_confirm_message',
	function( $msg ) {
		return "You’re about to send this out into the world.\nHave you added a kitten pic?";
	}
);</pre>


## Changelog ##
### 1.0.0 ###
* Usage of translations now only via https://translate.wordpress.org/projects/wp-plugins/publish-confirm.
* Code cleanup in really small points.
* On the edge: First major version, usage of [Semantic Versioning](http://semver.org/).

### 0.1.0 ###
* Code cleanup, props [@bueltge](https://profiles.wordpress.org/bueltge/)
* Filter translatable strings
* Tested WordPress 4.6 compatibility
* standardized text domain to include a dash instead of an underscore
* added filter to manage which post types the plugin functionality will apply to
* updated [plugin authors](https://gist.github.com/glueckpress/f058c0ab973d45a72720)

### 0.0.6 ###
* WordPress 4.2 support
* Russian translation

### 0.0.5 ###
* No confirmation dialogue for scheduled posts

### 0.0.4 ###
* Publish confirmation for post drafts

### 0.0.3 ###
* *Publish Confirm* goes wordpress.org