# Publish Confirm #

Extra confirmation dialogue for the publish button, avoids publishing accidentally.

## Description ##
Accidentally published a WordPress post too early once too often, instead of saving it as a draft? The WordPress plugin *Publish Confirm* implements an extra confirmation dialogue inbetween your click on and the actual processing of the *Publish* button. Simple and effective.

Once a post has been published, the confirmation dialogue will not appear anymore for that post.


### Custom message ###
The message text can be changed any time:

`<?php
add_filter(
    'publish_confirm_message',
    function($msg) {
        return "You´re ready?\nSure!?";
    }
);
?>`


### Memory usage ###
* On backend: ~ 0,02 MB
* On frontend: ~ 0,01 MB


### Languages ###
* English
* Deutsch
* Русский


### Authors ###
* [Sergej Müller](https://sergejmueller.github.io/)
* [Caspar Hübinger](http://glueckpress.com)


### Donations ###
* [Flattr](https://flattr.com/thing/536e5e2d0ce8de72eccc08731a4514e6)
* [PayPal](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LG5VC9KXMAYXJ)


## Changelog ##

### 0.0.6 / 22.04.2015 ###
* WordPress 4.2 support
* Russian translation

### 0.0.5 ###
* No confirmation dialogue for scheduled posts

### 0.0.4 ###
* Publish confirmation for post drafts

### 0.0.3 ###
* *Publish Confirm* goes wordpress.org