# Publish Confirm #

**As the Gutenberg editor introduced in WordPress 5.0 contains a similar functionality,
    the development of this plugin is discontinued.**
The plugin only supports the classic editor 
    (works fine even when using WordPress 5.0 with the *Classic Editor* plugin).

Extra confirmation dialogue for the publish button to avoid accidental publishing.


## Description ##
Accidentally published a WordPress post too early once too often, instead of saving it as a draft? This lightweight WordPress plugin implements an extra confirmation dialogue between your click on the *Publish* button and its actual processing. Simple and effective—never publish by accident again!

Once a post has been published, the confirmation dialogue will not appear anymore for that post.


### Credits ###
* Author: [Sergej Müller](https://sergejmueller.github.io/)
* Maintainers: [pluginkollektiv](https://pluginkollektiv.org/)


## Frequently Asked Questions ##
### Does *Publish Confirm* work for posts and pages? ###
Yes, it does.

### And Custom Post Types? ###
Yup.

### Can I limit/extend the plugin’s functionality for a custom selection of post types? ###
Yes, you can, via PHP filter from a custom plugin or from your theme’s functions.php. By default, the plugin will consider all [registered post types](https://developer.wordpress.org/reference/functions/register_post_type/). As an example, you could only have a confirmation dialogue for public post types, excluding attachments, like this:

```php
	add_filter(
		'publish_confirm_post_types',
		function ( $post_types ) {

			$post_types = get_post_types( array( 'public' => true ) );

			if ( isset( $post_types[ 'attachment' ] ) ) {
				unset( $post_types[ 'attachment' ] );
			}

			return $post_types;
		}
	);
```

Or you can exclude your particular custom post type from the confirmation dialogue like so:

```php
	add_filter(
		'publish_confirm_post_types',
		function ( $post_types ) {

			if ( isset( $post_types[ 'your_custom_post_type' ] ) ) {
				unset( $post_types[ 'your_custom_post_type' ] );
			}

			return $post_types;
		}
	);
```

### Is there any way to change the default dialogue message into something else? ###
The message text in the publishing dialogue can be changed via PHP filter from a custom plugin or your theme’s functions.php:

```php
	add_filter(
		'publish_confirm_message',
		function( $msg ) {
			return "You’re about to send this out into the world.\nHave you added a kitten pic?";
		}
	);
```


## Changelog ##
[Changelog](CHANGELOG.md)
