=== Custom Options Plus ===
Contributors: leocaseiro
Donate link: http://leocaseiro.com.br/contato/
Tags: configs, custom, custom configs, custom options, custom options plus, custom settings, leocaseiro, options, settings, wp_options
Requires at least: 2.7
Tested up to: 4.7.2
Stable tag: 1.8.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==
Custom Options Plus is the easiest way to add your custom variables as a Settings Page for your Theme.

It's very useful for beginners or who doesn't want to create a settings page as a plugin.
If you are not a expertise in PHP, just follow the instructions following the FAQ tab.

You can for example, register the address and phone numbers of your company to leave in the header of your site. So, if someday relocate, you do not need to change your theme. Just change administratively.
Also, you can use to enter a social network login, as twitter, facebook, Youtube, Instagram, and more.

This Plugin was Based on Custom Settings (Custom Configs) which has been removal from WordPress Repository.

[Support on GitHub](https://github.com/leocaseiro/Wordpress-Plugin-Custom-Options-Plus/issues "GitHub Issues for Support"), please!

== Installation ==
1. Download the plugin.
2. Activate the plugin.
3. Configure the administration panel in Settings > Custom Options Plus and customize your options plus


== Frequently Asked Questions ==
= Used to single option =
`
<?php echo get_custom('name'); ?>
`

= Used to multiples options =
`
<?php
	// Default get_customs returns a list(array)
	$array = get_customs('array_name');
	foreach ( $array as $name ) :
		echo $name;
	endforeach;

	// Second parameter set to true for get_customs returns a collection(array) with `label` and `value`
	$array = get_customs('array_name', true);
	foreach ( $array as $name ) :
		echo $name['label'] . ' - '. $name['value'];
	endforeach;
?>
`


== Changelog ==

= 1.8.1 =
* minor fixes on help. Thanks @janrenn

= 1.8.0 =
* get_customs() returns a collection (optional). Thanks @kas-cor

= 1.7.1 =
* Fixed array bug that generated errors in old PHP versions

= 1.7.0 =

* Add Settings link on Plugins Page
* Add Import and Export (Thanks @lucasbhjf for his contribution)


= 1.6 =

* Set all fields as required [Fix Issue #6](https://github.com/leocaseiro/Wordpress-Plugin-Custom-Options-Plus/issues/6)

= 1.5 =

* Lot of best practices improvements on code
* ESCAPE bug fix following suggestion from @pierre-r on github Issue #4
* SQL Injection improvement using correctly $wpdp->prepare
* Plugin Version added
* Admin Layout improvements
* Automatic name generated only on Add New mode

= 1.4.1 =

* README improvements

= 1.4 =

* Update stringToSlug Plugin
* Tested up to WordPress 4.0
* Add Plugin Icon for WordPress 4.0

= 1.1 =
* Value field from varchar(255) to text
* [SQL Injection fix following suggestion from Andy Stratton](http://wordpress.org/support/topic/plugin-custom-options-plus-stripslashes-needed-on-submission-of-content?replies=1)
* New Layout using WP List Table


= 1.3 =
* Add automatic name genrated from Label using jQuery stingToSlug Plugin

= 1.2 =
* New item button and UTF8 bug fix
* Tested up to WordPress 3.8.1


= 1.0 =
* First stable release version
