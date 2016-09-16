WordPress Custom Options Plus Plugin
=============

[![Join the chat at https://gitter.im/WordPress-Plugin-Custom-Options-Plus/Lobby](https://badges.gitter.im/WordPress-Plugin-Custom-Options-Plus/Lobby.svg)](https://gitter.im/WordPress-Plugin-Custom-Options-Plus/Lobby?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![WordPress plugin](https://img.shields.io/wordpress/plugin/v/custom-options-plus.svg)](https://wordpress.org/plugins/custom-options-plus/) [![WordPress](https://img.shields.io/wordpress/plugin/dt/custom-options-plus.svg)](https://wordpress.org/plugins/custom-options-plus/) [![WordPress](https://img.shields.io/wordpress/v/custom-options-plus.svg)](https://wordpress.org/plugins/custom-options-plus/) [![WordPress rating](https://img.shields.io/wordpress/plugin/r/custom-options-plus.svg)](https://wordpress.org/plugins/custom-options-plus/)

[WordPress Custom Options Plus](https://wordpress.org/plugins/custom-options-plus/) is the easiest way to add your custom variables as a Settings Page for your Theme.
It works similar to wp_options, but you don' need to create your own forms.

PS: It uses an extra table on your MySQL

Description
--------------
It's very useful for beginners or who doesn't want to create a settings page as a plugin.
If you are not a expertise in PHP, just follow the instructions following the FAQ tab.

You can for example, register the address and phone numbers of your company to leave on the header of your site. So, if your client needs to update they phone number, they can easily update through this plugin.

Also, you can use to enter a social network link, as Twitter, Facebook, Youtube, Instagram, Pinterest and more.

This Plugin was Based on Custom Settings (Custom Configs) which has been removal from WordPress Repository.

Support
--------------
[Open an Issue, please](https://github.com/leocaseiro/Wordpress-Plugin-Custom-Options-Plus/issues "GitHub Issues for Support")

Installation
--------------
1. Download the plugin.
2. Activate the plugin.
3. Configure the administration panel in Settings > Custom Options Plus and customize your options plus


FAQ (Frequently Asked Questions)
--------------
**Used to single option**
```php
<?php echo get_custom('name'); ?>
```

**Used to multiples options**
```php
<?php
	$array = get_customs('array_name');
	foreach ($array as $name) :
		echo $name;
	endforeach;
?>
```


Changelog
--------------

**1.7.1**

* Fixed array bug that generated errors in old PHP versions. Thanks @AdvancedStyle

**1.7.0**

* Add Settings link on Plugins Page
* Add Import and Export (Thanks @lucasbhjf for his contribution)


**1.6**

* Set all fields as required [Fix Issue #6](https://github.com/leocaseiro/Wordpress-Plugin-Custom-Options-Plus/issues/6)

**1.5**

* Lot of best practices improvements on code
* ESCAPE bug fix following suggestion from @pierre-r on github Issue #4
* SQL Injection improvement using correctly $wpdp->prepare
* Plugin Version added
* Admin Layout improvements
* Automatic name generated only on Add New mode

**1.4.1**

* README improvements

**1.4**

* Update stringToSlug Plugin
* Tested up to WordPress 4.0
* Add Plugin Icon for WordPress 4.0

**1.1**

* Value field from varchar(255) to text
* [SQL Injection fix following suggestion from Andy Stratton](http://wordpress.org/support/topic/plugin-custom-options-plus-stripslashes-needed-on-submission-of-content?replies=1)
* New Layout using WP List Table


**1.3**

* Add automatic name genrated from Label using jQuery stingToSlug Plugin

**1.2**

* New item button and UTF8 bug fix
* Tested up to WordPress 3.8.1


**1.0**

* First stable release version

License
------------
Copyright (c) 2011-2016 [Leo Caseiro](http://about.me/leocaseiro). This is free software and is licensed under the [GPL2 License](http://www.gnu.org/licenses/gpl-2.0.html)

Created and maintained by [Leo Caseiro](http://about.me/leocaseiro)
