=== BF WPO Dequeuer ===
Contributors: dariobf
Donate Link: https://www.dariobf.com/donate
Tags: wpo, optimization, testing
Requires at least: 5.0
Tested up to: 5.5
Stable tag: 5.4
Requires PHP: 7.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Dequeue scripts and styles from your site's queue.

== Description ==

This plugin allows you to easily dequeue styles and scripts from your site’s queue.

It also allows you to check which ones are called from the Archive, Single, Page and Frontpage templates of your site.

Once you used it, you can copy&paste generated code to your plugin or theme files.

This plugin can break your site frontend, so be careful when using it. If you don’t know what you are doing, please don’t use this plugin.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the Settings->Plugin Name screen to configure the plugin

== Frequently Asked Questions ==

= How does this plugin save the information on the database =

Serialized as an unique array.

= What happens if I uninstall the plugin =

It uses the WordPress' deactivate method and removes the information stored on the database, keeping it clean.

== Screenshots ==

1. This is how the backend of the plugin looks like. You'll can configure all the aspects through one single configuration page.

== Changelog ==

= 1.1.2 =
* Reviewed for compatibility

= 1.1.1 =
* Fixed some hardcoded strings for translation

= 1.1.0 =
* Added code generator

= 1.0.1 =
* Fixed a little bug with Scripts Runner

= 1.0.0 =
* First stable version of the plugin

= 0.1.0 =
* Just born with basic functionality

== Upgrade Notice ==

= 0.1.0 =
* This is the first version of the plugin