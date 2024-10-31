=== SEO Friendly Pagination ===
Contributors: salarsadeghi
Donate link: https://salars.xyz/
Tags: wordpress,pagination,seo
Requires at least: 4.7
Tested up to: 5.5.1
Stable tag: 1.0.0
Requires PHP: 7.1.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Lightweight SEO Friendly Pagination Plugin.

== Description ==
if your theme use wp_pagenavi plugin for Pagination just deactivate it,
this plugin will override wp_pagenavi() function. 
otherwise you should contact your theme developer to change it on your theme.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/pagination-seo-friendly` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the tools menu screen to configure the plugin

== Frequently Asked Questions ==

= how to use pagination? =
use 

do_action('seo_friendly_pagination');

to display pagination.

= is this plugin automatically change wordpress default pagination? =
no, you should contact your theme developer to change it on your theme.