=== Code Cleaner ===
Contributors: cleancoded
Tags: clean, cleaner, cleanup, clean-up, optimize, optimizer, performance
Requires at least: 4.7
Tested up to: 4.9.1
License: GPLv2 or later

Code Cleaner cleans and optimizes WordPress code for improved website performance and faster page load times. 

== Description ==

This plugin cleans and optimizes WordPress code for improved website performance and faster page load times. Whether you're using a custom child theme or a marketplace theme template, this plugin will clean the code and improve performance.

It adds a variety of site-wide optimization options to the WordPress backend:

* Disable emojis
* Disable embeds
* Remove query strings
* Disable XML-RPC
* Remote jQuery Migrate 
* Hide WP Version
* Remove the wlwmanifest link
* Remove the RSD link
* Remove the shortlink tag
* Disable RSS feeds
* Disable RSS feed links
* Disable self pingbacks
* Remove REST API links
* Disable dashicons
* Disable Google Maps
* Disable Heartbeat
* Update Heartbeat frequency
* Limit/disable post revisions
* Update autosave frequency
* Change the login URL

WooCommerce optimization options:

* Diable scripts except on product, cart and checkout pages
* Disable cart fragmentation
* Disable the status meta box
* Disable widgets

The plugin also offers CDN rewrite support, a script manager to disable CSS/JS on a page-by-page basis, DNS prefetch and preconnect support, as well as backend accessibility mode. 

== Installation ==

1. Upload the Code Cleaner plugin to your WordPress site and Activate it. 
2. That's it!  

== Changelog ==

= Version 1.1.8 =
* Fixed a compatibility issue with Script Manager dequeue priority that could cause it to not function properly.
* Minor update to the uninstall function.

= Version 1.1.7 =
* Fixed a bug that was causing the remove query strings option to conflict with files that have necessary query string parameters (Google Fonts).

= Version 1.1.6 =
* Added new Clean Uninstall option in the extras tab.
* Added new Preconnect option in the extras tab.

= Version 1.1.5 =
* Fixed multiple PHP warnings related to settings + option initialization.

= Version 1.1.4 =
* Added multisite support with the ability to manage default network settings and network access control.
* Made some adjustments to plugin naming conventions throughout WordPress admin screens, menus, etc…
* Removed BETA tag on Change Login URL option.

= Version 1.1.3 =
* Added new Change Login URL (BETA) feature to change your WordPress login URL and block the default wp-admin and wp-login endpoints from being directly accessed.
* Added new Disable Dashicons feature to disable Dashicons from the front-end when not logged in.

= Version 1.1.2 =
* Added character masking to the license key input field.

= Version 1.1.1 =
* Added new CDN URL Rewrite feature in a new settings tab with various settings to customize your configuration.
* Added new Global Settings section in the Script Manager with a visual representation of the Script Manager options set across the entire site.
* Made some updates to the Script Manager layout in preparation for future additional features.

= Version 1.1.0 =
* Added new Disable Google Maps toggle.
* Added some backend logic to the Script Manager to hide scripts that have already been disabled sitewide via the main plugin settings.
* Update to the EDD license activation function variables to help prevent activation conflicts with other plugins.

= Version 1.0.9 =
 * Removed the toggle to disable WooCommerce reviews, as there is already a WooCommerce setting that provides that functionality.

= Version 1.0.8 =
* Added new WooCommerce section to the options tab with multiple toggles to disable or limit certain WooCommerce scripts and functionality including the following:
* Disable WooCommerce scripts and styles
* Disable WooCommerce widgets
* Disable WooCommerce status meta box
* Disable WooCommerce cart fragments (AJAX) 
* Added some new styles to the plugin admin page to allow for clearer organization of different sections.
* Fixed an undefined index notice in the Script Manager.
* Added some additional styles to the checkboxes in the Script Manager to fix a theme compatibility issue.

= Version 1.0.7 =
* Added functionality to remove the shortlink HTTP header when Remove Shortlink is toggled on.
* Added functionality to remove the xmlrpc.php link as well as the X-Pingback HTTP header when Disable XML-RPC is toggled on.

= Version 1.0.6 =
* Removed BETA label from Script Manager.
* Added new DNS Prefetch option in the Extras tab.

= Version 1.0.5 =
* Added new toggle to Remove REST API Links.
* Renamed ‘Remove Feed Links’ toggle for more clarification.
* UI improvements, hovering tooltips, more links to the web documentation, etc…
* Added version numbers to admin scripts to avoid caching on plugin update.
* Refactored a good portion of the settings initialization code.
* Removed “Beta” status for script manager. It has been fully tested now and is ready to use in production.

= Version 1.0.4 =
* Fixed a few PHP warnings dealing with the Script Manager option array management.
* Fixed a UI bug in the Script Manager causing certain post type check boxes to not be selectable.
* Upgrade licensing feature added. You can now upgrade licenses from within your account and you are automatically prorated the new amount.

= Version 1.0.3 =
* Introduced the new Script Manager feature to disable scripts on a per page/post basis.

= Version 1.0.2 =
* Added Extras tab with a new option for Accessibility Mode. Enabling this will turn off the custom styles we use for our settings toggles and revert to standard HTML checkboxes.
* Additional accessibility improvements.
* A few style fixes.
* WordPress 4.8 support.

=Version 1.0.1=
* Accessibility improvements to the plugin settings page.

= Version 1.0.0 =
* Plugin launched.
    
== Roadmap ==
* Lazy load images
* HTTP/2 server push
* Sync Google Analytics locally
* Delete expired transients
* WordPress menu cache
* Parse and remove all HTML comments in source code
* Disable blog (comments, categories, tags, etc.)
* Minify HTML/JS/CSS
* Disable Google Fonts
* Disable comments globally
* White label for marketing agencies
