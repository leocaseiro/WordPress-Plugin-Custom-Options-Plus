=== Custom Options Plus === 
Contributors: leocaseiro
Donate link: http://leocaseiro.com.br/contato/
Tags: configs, custom, custom configs, custom options, custom options plus, custom settings, leocaseiro, options, settings, wp_options
Requires at least: 2.7
Tested up to: 3.2.1
Stable tag: 1.0

== Description == 
With this plugin, you can enter your custom options datas. It is very easy to install and use. Even if you do not have expertise in PHP.
You can for example, register the address and phone numbers of your company to leave in the header of your site. So, if someday relocate, you do not need to change your theme. Just change administratively.
You can also enter the login of your social networks. How to login twitter, Facebook, Youtube, contact email and more.
Based on Custom Settings (Custom Configs)

== Installation == 
1. Download the plugin.
2. Activate the plugin.
3. Configure the administration panel in Settings > Custom Options Plus and customize your options plus

== Usage ==

<?php echo get_custom('name'); //Used to single option ?>

<?php 
	$array = get_customs('array_name'); //Used to multiples options
	foreach ($array as $name) :
		echo $name;
	endforeach;
?>