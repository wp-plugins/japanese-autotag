=== Plugin Name ===
Contributors: Keisuke Oyama
Donate link: http://keicode.com/contact.php
Tags: tags, Japanese
Requires at least: 2.8.4
Tested up to: 2.9.2
Stable tag: 0.2.15

Japanese AutoTag is a WordPress plugin which generates tags automatically based on your post title.

== Description ==

Japanese AutoTag is a WordPress plugin which generates tags automatically based on your post title.

For example, if you writes "Ensoku de Fujisan ni nobotta" in Japanese as your post's title, Japanese 
AutoTag will analyze the Japanese text when saving and set "Ensoku" and "Fujisan" as its tags automatically.

You can configure excluding words so as to prevent specific words from being tagged. 
If you don't want to set "Fujisan" as a tag automatically, you can add "Fujisan" into the excluding word list. 

Note that you have to enter Yahoo! JAPAN application ID to enable this plugin. You can get the ID from the
following URL for free: http://e.developer.yahoo.co.jp/webservices/register_application  

== Installation ==

1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Enter your Yahoo! JAPAN application ID from the plugin configuration page.

== Frequently Asked Questions ==

= Why do I have to enter Yahoo! JAPAN application ID? =

This plugin uses Yahoo! JAPAN's morphological analysis web service to analyze Japanese text 
behind the scene. So you need to enter the ID to work it correctly.

= How can I get Yahoo! JAPAN application ID? =

You can get the ID from Yahoo! JAPAN developer center for free:
http://e.developer.yahoo.co.jp/webservices/register_application


== Screenshots ==

1. Configuration page for the plugin

== Changelog ==

= 0.2.0 =
* First release.
= 0.2.4 =
* Added default prohibited words.
* Cleaned some code.
= 0.2.5 =
* Trimmed option parameter values
= 0.2.6 =
* Supported PHP4.
= 0.2.7 =
* Added a prohibited pattern matching feature.
= 0.2.8 =
* Added an additional timing to generate tags. If you check Save Post option on the configuration page,
taggs will be generated every time you save posts even when drafting.
= 0.2.9 =
* Added Plugin Status option. This option allows you to disable the plugin temporarily.
= 0.2.10 =
* Added Scope option. This option allows you to tag based on post contents. 
= 0.2.11 =
* Added Word Class option. This allows you to tag all word classes not only nouns.
= 0.2.12 =
* Updated Compatible version to 2.9.1. No features changed.
= 0.2.13 =
* Handled versioning issue.
= 0.2.15 =
* Added Key Phrase Tagging option. This allows you to tag based on key phrases instead of words. This option is disabled by default.