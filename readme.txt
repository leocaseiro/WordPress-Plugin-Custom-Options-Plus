=== Custom Options Plus === 
Contributors: leocaseiro
Donate link: http://leocaseiro.com.br/contato/
Tags: configs, custom, custom configs, custom options, custom options plus, custom settings, leocaseiro, options, settings, wp_options
Requires at least: 2.7
Tested up to: 4.0
Stable tag: 1.4

== Description == 
	Custom Opstions Plus is the easiest way to add your custom variables as a Settings Page for your Theme.
	
	It's very useful for beginners or who doesn't want to create a settings page as a plugin.
	If you are not a expertise in PHP, just follow the instructions following the FAQ tab.

	You can for example, register the address and phone numbers of your company to leave in the header of your site. So, if someday relocate, you do not need to change your theme. Just change administratively.
	Also, you can use to enter a social network login, as twitter, facebook, Youtube, Instagram, and more.

	This Plugin was Based on Custom Settings (Custom Configs) which has been removal from WordPress Repository.

[Support on GitHub] (https://github.com/leocaseiro/Wordpress-Plugin-Custom-Options-Plus/issues "GitHub Issues for Support"), please!

== Installation == 
1. Download the plugin.
2. Activate the plugin.
3. Configure the administration panel in Settings > Custom Options Plus and customize your options plus


== Frequently Asked Questions ==
= Used to single option =
`<?php echo get_custom('name'); ?>`

= Used to multiples options =
`
<?php
	$array = get_customs('array_name');
	foreach ($array as $name) :
		echo $name;
	endforeach;
?>
`


== Changelog ==

= 1.0 =
* First stable release version


= 1.1 =

* Value field from varchar(255) to text

* SQL Injection fix following suggestion by Andy Stratton in http://wordpress.org/support/topic/plugin-custom-options-plus-stripslashes-needed-on-submission-of-content?replies=1

* New Layout using WP List Table


= 1.2 =

* New item button and UTF8 fixed bug

* Tested up to WordPress 3.8.1


= 1.3 =

* Add automatic name genrated from Label using jQuery stingToSlug Plugin

= 1.4 =

* Update stringToSlug Plugin
* Tested up to WordPress 4.0
* Add Plugin Icon for WordPress 4.0
