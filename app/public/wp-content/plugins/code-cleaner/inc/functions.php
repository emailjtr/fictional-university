<?php
$codecleaner_options = get_option('codecleaner_options');
$codecleaner_cdn = get_option('codecleaner_cdn');
$codecleaner_extras = get_option('codecleaner_extras');

/* Options Actions and Filters
/***********************************************************************/
if(!empty($codecleaner_options['disable_emojis']) && $codecleaner_options['disable_emojis'] == "1") {
	add_action('init', 'codecleaner_disable_emojis');
}
if(!empty($codecleaner_options['disable_embeds']) && $codecleaner_options['disable_embeds'] == "1") {
	add_action('init', 'codecleaner_disable_embeds', 9999);
}
if(!empty($codecleaner_options['remove_query_strings']) && $codecleaner_options['remove_query_strings'] == "1") {
	add_action('init', 'codecleaner_remove_query_strings');
}

/* Disable XML-RPC
/***********************************************************************/
if(!empty($codecleaner_options['disable_xmlrpc']) && $codecleaner_options['disable_xmlrpc'] == "1") {
	add_filter('xmlrpc_enabled', '__return_false');
	add_filter('wp_headers', 'codecleaner_remove_x_pingback');
	add_filter('pings_open', '__return_false', 9999);
}

function codecleaner_remove_x_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}

if(!empty($codecleaner_options['remove_jquery_migrate']) && $codecleaner_options['remove_jquery_migrate'] == "1") {
	add_filter('wp_default_scripts', 'codecleaner_remove_jquery_migrate');
}
if(!empty($codecleaner_options['hide_wp_version']) && $codecleaner_options['hide_wp_version'] == "1") {
	remove_action('wp_head', 'wp_generator');
	add_filter('the_generator', 'codecleaner_hide_wp_version');
}
if(!empty($codecleaner_options['remove_wlwmanifest_link']) && $codecleaner_options['remove_wlwmanifest_link'] == "1") {
	remove_action('wp_head', 'wlwmanifest_link');
}
if(!empty($codecleaner_options['remove_rsd_link']) && $codecleaner_options['remove_rsd_link'] == "1") {
	remove_action('wp_head', 'rsd_link');
}

/* Remove Shortlink
/***********************************************************************/
if(!empty($codecleaner_options['remove_shortlink']) && $codecleaner_options['remove_shortlink'] == "1") {
	remove_action('wp_head', 'wp_shortlink_wp_head');
	remove_action ('template_redirect', 'wp_shortlink_header', 11, 0);
}

if(!empty($codecleaner_options['disable_rss_feeds']) && $codecleaner_options['disable_rss_feeds'] == "1") {
	add_action('do_feed', 'codecleaner_disable_rss_feeds', 1);
	add_action('do_feed_rdf', 'codecleaner_disable_rss_feeds', 1);
	add_action('do_feed_rss', 'codecleaner_disable_rss_feeds', 1);
	add_action('do_feed_rss2', 'codecleaner_disable_rss_feeds', 1);
	add_action('do_feed_atom', 'codecleaner_disable_rss_feeds', 1);
	add_action('do_feed_rss2_comments', 'codecleaner_disable_rss_feeds', 1);
	add_action('do_feed_atom_comments', 'codecleaner_disable_rss_feeds', 1);
}
if(!empty($codecleaner_options['remove_feed_links']) && $codecleaner_options['remove_feed_links'] == "1") {
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'feed_links_extra', 3);
}
if(!empty($codecleaner_options['disable_self_pingbacks']) && $codecleaner_options['disable_self_pingbacks'] == "1") {
	add_action('pre_ping', 'codecleaner_disable_self_pingbacks');
}

/* Remove REST API Links
/***********************************************************************/
if(!empty($codecleaner_options['remove_rest_api_links']) && $codecleaner_options['remove_rest_api_links'] == "1") {
	remove_action('wp_head', 'rest_output_link_wp_head');
	remove_action('template_redirect', 'rest_output_link_header', 11, 0);
}

/* Disable Google Maps
/***********************************************************************/
if(!empty($codecleaner_options['disable_google_maps']) && $codecleaner_options['disable_google_maps'] == "1") {
	add_action('wp_loaded', 'codecleaner_disable_google_maps');
}

function codecleaner_disable_google_maps() {
	ob_start('codecleaner_disable_google_maps_regex');
}

function codecleaner_disable_google_maps_regex($html) {
	$html = preg_replace('/<script[^<>]*\/\/maps.(googleapis|google|gstatic).com\/[^<>]*><\/script>/i', '', $html);
	return $html;
}

/* Disable Dashicons
/***********************************************************************/
if(!empty($codecleaner_options['disable_dashicons']) && $codecleaner_options['disable_dashicons'] == "1") {
	add_action('wp_enqueue_scripts', 'codecleaner_disable_dashicons');
}

function codecleaner_disable_dashicons() {
	if(!is_user_logged_in()) {
		wp_dequeue_style('dashicons');
	    wp_deregister_style('dashicons');
	}
}

/* Disable WooCommerce Scripts
/***********************************************************************/
if(!empty($codecleaner_options['disable_woocommerce_scripts']) && $codecleaner_options['disable_woocommerce_scripts'] == "1") {
	add_action('wp_enqueue_scripts', 'codecleaner_disable_woocommerce_scripts', 99);
}

function codecleaner_disable_woocommerce_scripts() {
	if(function_exists('is_woocommerce')) {
		if(!is_woocommerce() && !is_cart() && !is_checkout()) {
			global $codecleaner_options;
			
			//Dequeue WooCommerce Styles
			wp_dequeue_style('woocommerce-general');
			wp_dequeue_style('woocommerce-layout');
			wp_dequeue_style('woocommerce-smallscreen');
			wp_dequeue_style('woocommerce_frontend_styles');
			wp_dequeue_style('woocommerce_fancybox_styles');
			wp_dequeue_style('woocommerce_chosen_styles');
			wp_dequeue_style('woocommerce_prettyPhoto_css');
			//Dequeue WooCommerce Scripts
			wp_dequeue_script('wc_price_slider');
			wp_dequeue_script('wc-single-product');
			wp_dequeue_script('wc-add-to-cart');
			wp_dequeue_script('wc-checkout');
			wp_dequeue_script('wc-add-to-cart-variation');
			wp_dequeue_script('wc-single-product');
			wp_dequeue_script('wc-cart');
			wp_dequeue_script('wc-chosen');
			wp_dequeue_script('woocommerce');
			wp_dequeue_script('prettyPhoto');
			wp_dequeue_script('prettyPhoto-init');
			wp_dequeue_script('jquery-blockui');
			wp_dequeue_script('jquery-placeholder');
			wp_dequeue_script('fancybox');
			wp_dequeue_script('jqueryui');

			if(empty($codecleaner_options['disable_woocommerce_cart_fragmentation']) || $codecleaner_options['disable_woocommerce_cart_fragmentation'] == "0") {
				wp_dequeue_script('wc-cart-fragments');
			}
		}
	}
}

/* Disable WooCommerce Cart Fragmentation
/***********************************************************************/
if(!empty($codecleaner_options['disable_woocommerce_cart_fragmentation']) && $codecleaner_options['disable_woocommerce_cart_fragmentation'] == "1") {
	add_action('wp_enqueue_scripts', 'codecleaner_disable_woocommerce_cart_fragmentation', 99);
}

function codecleaner_disable_woocommerce_cart_fragmentation() {
	if(function_exists('is_woocommerce')) {
		wp_dequeue_script('wc-cart-fragments');
	}
}

/* Disable WooCommerce Status Meta Box
/***********************************************************************/
if(!empty($codecleaner_options['disable_woocommerce_status']) && $codecleaner_options['disable_woocommerce_status'] == "1") {
	add_action('wp_dashboard_setup', 'codecleaner_disable_woocommerce_status');
}

function codecleaner_disable_woocommerce_status() {
	remove_meta_box('woocommerce_dashboard_status', 'dashboard', 'normal');
}

/* Disable WooCommerce Widgets
/***********************************************************************/
if(!empty($codecleaner_options['disable_woocommerce_widgets']) && $codecleaner_options['disable_woocommerce_widgets'] == "1") {
	add_action('widgets_init', 'codecleaner_disable_woocommerce_widgets', 99);
}
function codecleaner_disable_woocommerce_widgets() {
	global $codecleaner_options;

	unregister_widget('WC_Widget_Products');
	unregister_widget('WC_Widget_Product_Categories');
	unregister_widget('WC_Widget_Product_Tag_Cloud');
	unregister_widget('WC_Widget_Cart');
	unregister_widget('WC_Widget_Layered_Nav');
	unregister_widget('WC_Widget_Layered_Nav_Filters');
	unregister_widget('WC_Widget_Price_Filter');
	unregister_widget('WC_Widget_Product_Search');
	unregister_widget('WC_Widget_Recently_Viewed');

	if(empty($codecleaner_options['disable_woocommerce_reviews']) || $codecleaner_options['disable_woocommerce_reviews'] == "0") {
		unregister_widget('WC_Widget_Recent_Reviews');
		unregister_widget('WC_Widget_Top_Rated_Products');
		unregister_widget('WC_Widget_Rating_Filter');
	}
}

if(!empty($codecleaner_options['disable_heartbeat'])) {
	add_action('init', 'codecleaner_disable_heartbeat', 1);
}
if(!empty($codecleaner_options['heartbeat_frequency'])) {
	add_filter('heartbeat_settings', 'codecleaner_heartbeat_frequency');
}
if(!empty($codecleaner_options['limit_post_revisions'])) {
	define('WP_POST_REVISIONS', $codecleaner_options['limit_post_revisions']);
}
if(!empty($codecleaner_options['autosave_interval'])) {
	define('AUTOSAVE_INTERVAL', $codecleaner_options['autosave_interval']);
}
if(!empty($codecleaner_extras['script_manager']) && $codecleaner_extras['script_manager'] == "1") {
	add_action('admin_bar_menu', 'codecleaner_script_manager_admin_bar', 1000);
	add_action('wp_footer', 'codecleaner_script_manager', 1000);
	add_action('script_loader_src', 'codecleaner_dequeue_scripts', 1000, 2);
	add_action('style_loader_src', 'codecleaner_dequeue_scripts', 1000, 2);
	add_action('template_redirect', 'codecleaner_script_manager_update', 10, 2);
}
if(!empty($codecleaner_extras['dns_prefetch'])) {
	add_action('wp_head', 'codecleaner_dns_prefetch', 1);
}

/* Disable Emojis
/***********************************************************************/
function codecleaner_disable_emojis() {
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');	
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');	
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'codecleaner_disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'codecleaner_disable_emojis_dns_prefetch', 10, 2);
}

function codecleaner_disable_emojis_tinymce($plugins) {
	if(is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

function codecleaner_disable_emojis_dns_prefetch( $urls, $relation_type ) {
	if('dns-prefetch' == $relation_type) {
		$emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2.2.1/svg/');
		$urls = array_diff($urls, array($emoji_svg_url));
	}
	return $urls;
}

/* Disable Embeds
/***********************************************************************/
function codecleaner_disable_embeds() {
	global $wp;
	$wp->public_query_vars = array_diff($wp->public_query_vars, array('embed',));
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	add_filter( 'embed_oembed_discover', '__return_false' );
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );
	add_filter( 'tiny_mce_plugins', 'codecleaner_disable_embeds_tiny_mce_plugin' );
	add_filter( 'rewrite_rules_array', 'codecleaner_disable_embeds_rewrites' );
	remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}

function codecleaner_disable_embeds_tiny_mce_plugin($plugins) {
	return array_diff($plugins, array('wpembed'));
}

function codecleaner_disable_embeds_rewrites($rules) {
	foreach($rules as $rule => $rewrite) {
		if(false !== strpos($rewrite, 'embed=true')) {
			unset($rules[$rule]);
		}
	}
	return $rules;
}

/* Remove Query Strings
/***********************************************************************/
function codecleaner_remove_query_strings() {
	if(!is_admin()) {
		add_filter('script_loader_src', 'codecleaner_remove_query_strings_split', 15);
		add_filter('style_loader_src', 'codecleaner_remove_query_strings_split', 15);
	}
}

function codecleaner_remove_query_strings_split($src){
	$output = preg_split("/(&ver|\?ver)/", $src);
	return $output[0];
}

/* Remove jQuery Migrate
/***********************************************************************/
function codecleaner_remove_jquery_migrate(&$scripts) {
    if(!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array( 'jquery-core' ), '1.12.4');
    }
}

/* Hide WordPress Version
/***********************************************************************/
function codecleaner_hide_wp_version() {
	return '';
}

/* Disable RSS Feeds
/***********************************************************************/
function codecleaner_disable_rss_feeds() {
	wp_die(__('No feed available, please visit the <a href="' . esc_url(home_url('/')) . '">homepage</a>!'));
}

/* Disable Self Pingbacks
/***********************************************************************/
function codecleaner_disable_self_pingbacks(&$links) {
	$home = get_option('home');
	foreach($links as $l => $link) {
		if(strpos($link, $home) === 0) {
			unset($links[$l]);
		}
	}
}

/* Disable Heartbeat
/***********************************************************************/
function codecleaner_disable_heartbeat() {
	global $codecleaner_options;
	if(!empty($codecleaner_options['disable_heartbeat'])) {
		if($codecleaner_options['disable_heartbeat'] == 'disable_everywhere') {
			wp_deregister_script('heartbeat');
		}
		elseif($codecleaner_options['disable_heartbeat'] == 'allow_posts') {
			global $pagenow;
			if($pagenow != 'post.php' && $pagenow != 'post-new.php') {
				wp_deregister_script('heartbeat');
			}
		}
	}
}

/* Heartbeat Frequency
/***********************************************************************/
function codecleaner_heartbeat_frequency($settings) {
	global $codecleaner_options;
	if(!empty($codecleaner_options['heartbeat_frequency'])) {
		$settings['interval'] = $codecleaner_options['heartbeat_frequency'];
	}
	return $settings;
}

/* Change Login URL
/***********************************************************************/
$codecleaner_wp_login = false;

if(!empty($codecleaner_options['login_url'])) {
	add_action('plugins_loaded', 'codecleaner_plugins_loaded', 2);
	add_action('wp_loaded', 'codecleaner_wp_loaded');
	add_action('setup_theme', 'codecleaner_disable_customize_php', 1);
	add_filter('site_url', 'codecleaner_site_url', 10, 4);
	add_filter('wp_redirect', 'codecleaner_wp_redirect', 10, 2);
	add_filter('site_option_welcome_email', 'codecleaner_welcome_email');
	remove_action('template_redirect', 'wp_redirect_admin_locations', 1000);
}

function codecleaner_site_url($url, $path, $scheme, $blog_id) {
	return codecleaner_filter_wp_login($url, $scheme);
}

function codecleaner_wp_redirect($location, $status) {
	return codecleaner_filter_wp_login($location);
}

function codecleaner_filter_wp_login($url, $scheme = null) {

	//wp-login.php Being Requested
	if(strpos($url, 'wp-login.php') !== false) {

		//Set HTTPS Scheme if SSL
		if(is_ssl()) {
			$scheme = 'https';
		}

		//Check for Query String and Craft New Login URL
		$query_string = explode('?', $url);
		if(isset($query_string[1])) {
			parse_str($query_string[1], $query_string);
			$url = add_query_arg($query_string, codecleaner_login_url($scheme));
		} 
		else {
			$url = codecleaner_login_url($scheme);
		}
	}

	//Return Finished Login URL
	return $url;
}

function codecleaner_login_url($scheme = null) {

	//Return New Login URL Based on Permalink Structure
	if(get_option('permalink_structure')) {
		return codecleaner_trailingslashit(home_url('/', $scheme) . codecleaner_login_slug());
	} 
	else {
		return home_url('/', $scheme) . '?' . $this->new_login_slug();
	}
}

function codecleaner_trailingslashit($string) {

	//Check for Permalink Trailing Slash and Add to String
	if((substr(get_option('permalink_structure'), -1, 1)) === '/') {
		return trailingslashit($string);
	}
	else {
		return untrailingslashit($string);
	}
}

function codecleaner_login_slug() {

	//Declare Global Variable
	global $codecleaner_options;

	//Return Login URL Slug if Available
	if(!empty($codecleaner_options['login_url'])) {
		return $codecleaner_options['login_url'];
	} 
}

function codecleaner_plugins_loaded() {

	//Declare Global Variables
	global $pagenow;
	global $codecleaner_wp_login;

	//Parse Requested URI
	$URI = parse_url($_SERVER['REQUEST_URI']);
	$path = untrailingslashit($URI['path']);
	$slug = codecleaner_login_slug();

	//Non Admin wp-login.php URL
	if(!is_admin() && (strpos(rawurldecode($_SERVER['REQUEST_URI']), 'wp-login.php') !== false || $path === site_url('wp-login', 'relative'))) {

		//Set Flag
		$codecleaner_wp_login = true;

		//Prevent Redirect to Hidden Login
		$_SERVER['REQUEST_URI'] = codecleaner_trailingslashit('/' . str_repeat('-/', 10));
		$pagenow = 'index.php';
	} 
	//Hidden Login URL
	elseif($path === home_url($slug, 'relative') || (!get_option('permalink_structure') && isset($_GET[$slug]) && empty($_GET[$slug]))) {
		
		//Override Current Page w/ wp-login.php
		$pagenow = 'wp-login.php';
	}
}

function codecleaner_wp_loaded() {

	//Declare Global Variables
	global $pagenow;
	global $codecleaner_wp_login;

	//Disable Normal WP-Admin
	if(is_admin() && !is_user_logged_in() && !defined('DOING_AJAX') && $pagenow !== 'admin-post.php') {
        wp_die(__('This has been disabled.', 'codecleaner' ), 403);
	}

	//Parse Requested URI
	$URI = parse_url($_SERVER['REQUEST_URI']);

	//Requesting Hidden Login Form - Path Mismatch
	if($pagenow === 'wp-login.php' && $URI['path'] !== codecleaner_trailingslashit($URI['path']) && get_option('permalink_structure')) {

		//Local Redirect to Hidden Login URL
		$URL = codecleaner_trailingslashit(codecleaner_login_url()) . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
		wp_safe_redirect($URL);
		die();
	}
	//Requesting wp-login.php Directly, Disabled
	elseif($codecleaner_wp_login) {
		wp_die(__('This has been disabled.', 'codecleaner' ), 403);
	} 
	//Requesting Hidden Login Form
	elseif($pagenow === 'wp-login.php') {

		//Declare Global Variables
		global $error, $interim_login, $action, $user_login;
		
		//User Already Logged In
		if(is_user_logged_in() && !isset($_REQUEST['action'])) {
			wp_safe_redirect(admin_url());
			die();
		}

		//Include Login Form
		@require_once ABSPATH . 'wp-login.php';
		die();
	}
}

function codecleaner_disable_customize_php() {

	//Declare Global Variable
	global $pagenow;

	//Disable customize.php from Redirecting to Login URL
	if(!is_user_logged_in() && $pagenow === 'customize.php') {
		wp_die(__('This has been disabled.', 'codecleaner'), 403);
	}
}

function codecleaner_welcome_email($value) {

	//Declare Global Variable
	global $codecleaner_options;

	//Check for Custom Login URL and Replace
	if(!empty($codecleaner_options['login_url'])) {
		$value = str_replace('wp-login.php', trailingslashit($codecleaner_options['login_url']), $value);
	}

	return $value;
}

/* CDN Rewrite URLs
/***********************************************************************/
if(!empty($codecleaner_cdn['enable_cdn']) && $codecleaner_cdn['enable_cdn'] == "1" && !empty($codecleaner_cdn['cdn_url'])) {
	add_action('template_redirect', 'codecleaner_cdn_rewrite');
}

function codecleaner_cdn_rewrite() {
	ob_start('codecleaner_cdn_rewriter');
}

function codecleaner_cdn_rewriter($html) {
	global $codecleaner_cdn;

	//Prep Site URL
    $escapedSiteURL = quotemeta(get_option('home'));
	$regExURL = '(https?:|)' . substr($escapedSiteURL, strpos($escapedSiteURL, '//'));

	//Prep Included Directories
	$directories = 'wp\-content|wp\-includes';
	if(!empty($codecleaner_cdn['cdn_directories'])) {
		$directoriesArray = array_map('trim', explode(',', $codecleaner_cdn['cdn_directories']));
		if(count($directoriesArray) > 0) {
			$directories = implode('|', array_map('quotemeta', array_filter($directoriesArray)));
		}
	}
  
  	//Rewrite URLs and Return
	$regEx = '#(?<=[(\"\'])(?:' . $regExURL . ')?/(?:((?:' . $directories . ')[^\"\')]+)|([^/\"\']+\.[^/\"\')]+))(?=[\"\')])#';
	$cdnHTML = preg_replace_callback($regEx, 'codecleaner_cdn_rewrite_url', $html);
	return $cdnHTML;
}

function codecleaner_cdn_rewrite_url($url) {
	global $codecleaner_cdn;

	//Make Sure CDN URL is Set
	if(!empty($codecleaner_cdn['cdn_url'])) {

		//Don't Rewrite if Excluded
		if(!empty($codecleaner_cdn['cdn_exclusions'])) {
			$exclusions = array_map('trim', explode(',', $codecleaner_cdn['cdn_exclusions']));
			foreach($exclusions as $exclusion) {
	            if(!empty($exclusion) && stristr($url[0], $exclusion) != false) {
	                return $url[0];
	            }
	        }
		} 

	    //Don't Rewrite if Previewing
	    if(is_admin_bar_showing() && isset($_GET['preview']) && $_GET['preview'] == 'true') {
	        return $url[0];
	    }

	    //Prep Site URL
	    $siteURL = get_option('home');
	    $siteURL = substr($siteURL, strpos($siteURL, '//'));

	    //Replace URL with No HTTP/S Prefix
	    if(strpos($url[0], '//') === 0) {
	        return str_replace($siteURL, $codecleaner_cdn['cdn_url'], $url[0]);
	    }

	    //Found Site URL, Replace Non Relative URL with HTTP/S Prefix
	    if(strstr($url[0], $siteURL)) {
	        return str_replace(array('http:' . $siteURL, 'https:' . $siteURL), $codecleaner_cdn['cdn_url'], $url[0]);
	    }

	    //Replace Relative URL
    	return $codecleaner_cdn['cdn_url'] . $url[0];
    }

    //Return Original URL
    return $url[0];
}

/* Script Manager
/***********************************************************************/
function codecleaner_script_manager_admin_bar($wp_admin_bar) {
	if(!current_user_can('manage_options') || is_admin() || !codecleaner_network_access()) {
		return;
	}

	global $wp;

	$href = add_query_arg(str_replace(array('&codecleaner', 'codecleaner'), '', $_SERVER['QUERY_STRING']), '', home_url($wp->request));

	if(!isset($_GET['codecleaner'])) {
		if(!empty($_SERVER['QUERY_STRING'])) {
			$href.= '&codecleaner';
		}
		else {
			$href.= '?codecleaner';
		}
	}

	$args = array(
		'id'    => 'codecleaner_script_manager',
		'title' => 'Script Manager',
		'href'  => $href
	);
	$wp_admin_bar->add_node($args);
}

function codecleaner_script_manager() {

	if(!current_user_can('manage_options') || is_admin() || !isset($_GET['codecleaner']) || !codecleaner_network_access()) {
		return;
	}

	global $wp;
	global $wp_scripts;
	global $wp_styles;

	global $codecleaner_options;

	//Build Array of Disables
	$codecleaner_disables = array();
	if(!empty($codecleaner_options['disable_google_maps']) && $codecleaner_options['disable_google_maps'] == "1") {
		$codecleaner_disables[] = 'maps.google.com';
		$codecleaner_disables[] = 'maps.googleapis.com';
		$codecleaner_disables[] = 'maps.gstatic.com';
	}

	$currentID = get_queried_object_id();

	$codecleaner_filters = array(
		"js" => array (
			"title" => "JS",
			"scripts" => $wp_scripts
		),
		"css" => array(
			"title" => "CSS",
			"scripts" => $wp_styles
		)
	);

	$options = get_option('codecleaner_script_manager');
		
	echo "<style>
		html, body {
			overflow: hidden !important;
		}
		#codecleaner-script-manager-wrapper {
			display: none;
			position: fixed;
			z-index: 99999999;
			top: 32px;
			bottom: 0px;
			left: 0px;
			right: 0px;
			background: rgba(0,0,0,0.5);
			overflow-y: auto;
		}
		#codecleaner-script-manager {
			background: #EEF2F5;
			padding: 20px;
			font-size: 14px;
			line-height: 1.5em;
			color: #4a545a;
			min-height: 100%;
		}
		#codecleaner-script-manager a {
			color: #4A89DD;
			text-decoration: none;
			border: none;
		}
		#codecleaner-script-manager-header {
			position: relative;
		}
		#codecleaner-script-manager-header h2 {
			font-size: 24px;
			margin: 0px 0px 10px 0px;
			color: #4a545a;
			font-weight: bold;
		}
		#codecleaner-script-manager-header h2 span {
			background: #ED5464;
			color: #ffffff;
			padding: 5px;
			vertical-align: middle;
			font-size: 10px;
			margin-left: 5px;
		}
		#codecleaner-script-manager-header p {
			font-size: 14px;
			color: #4a545a;
			font-style: italic;
			margin: 0px auto 15px auto;
		}
		#codecleaner-script-manager-close {
			position: absolute;
			top: 0px;
			right: 0px;
			height: 26px;
			width: 26px;
		}
		#codecleaner-script-manager-close img {
			height: 26px;
			width: 26px;
		}
		#codecleaner-script-manager-tabs button {
			display: block;
			float: left;
			padding: 15px 45px;
			margin-right: 5px;
			font-size: 22px;
			line-height: normal;
			text-align: center;
			background: #dddddd;
			color: #aaaaaa;
		}
		#codecleaner-script-manager-tabs {
			overflow: hidden;
		}
		#codecleaner-script-manager-tabs button span {
			display: block;
			font-size: 12px;
			margin-top: 5px;
		}
		#codecleaner-script-manager-tabs button.active {
			background: #4A89DD;
			color: #ffffff;
		}
		#codecleaner-script-manager-tabs button:hover {
			color: #4A89DD;
		}
		#codecleaner-script-manager-tabs button.active:hover {
			color: #ffffff;
		}
		#codecleaner-script-manager h3 {
			padding: 10px;
			margin: 0px;
			font-size: 20px;
			background: #282E34;
			color: #ffffff;
		}
		.codecleaner-script-manager-section {
			padding: 10px;
			background: #ffffff;
			margin: 0px 0px 20px 0px;
		}
		#codecleaner-script-manager table {
			table-layout: fixed;
			width: 100%;
			margin: 0px;
			padding: 0px;
			border: none;
			text-align: left;
			font-size: 14px;
			border-collapse: collapse;
		}
		#codecleaner-script-manager table thead {
			background: none;
			color: #282E34;
			font-weight: bold;
			border: none;
		}
		#codecleaner-script-manager table thead tr {
			border: none;
			border-bottom: 2px solid #dddddd;
		}
		#codecleaner-script-manager table thead th {
			padding: 5px;
			vertical-align: middle;
		}
		#codecleaner-script-manager table tr {
			border: none;
			border-bottom: 1px solid #eeeeee;
			background: #ffffff;
		}
		#codecleaner-script-manager table tbody tr:last-child {
			border-bottom: 0px;
		}
		#codecleaner-script-manager table td {
			padding: 5px;
			border: none;
			vertical-align: middle;
			font-size: 14px;
		}
		#codecleaner-script-manager table td.codecleaner-script-manager-size {
			font-size: 12px;
		}
		#codecleaner-script-manager table td.codecleaner-script-manager-script {
			white-space: nowrap;
		}
		#codecleaner-script-manager .codecleaner-script-manager-script span {
			display: block;
			max-width: 100%;
			overflow: hidden;
			text-overflow: ellipsis;
			font-size: 16px;
			font-weight: bold;
		}
		#codecleaner-script-manager .codecleaner-script-manager-script a {
			display: inline-block;
			max-width: 100%;
			overflow: hidden;
			text-overflow: ellipsis;
			font-size: 12px;
			color: #4A89DD;
		}
		#codecleaner-script-manager table .codecleaner-script-manager-disable *:after, #codecleaner-script-manager table .codecleaner-script-manager-disable *:before {
			display: none;
		}
		#codecleaner-script-manager table select {
			height: auto;
			width: auto;
			background: #ffffff;
			background-color: #ffffff;
			padding: 7px 10px;
			margin: 0px;
			font-size: 14px;
			appearance: menulist;
			-webkit-appearance: menulist;
			-moz-appearance: menulist;
		}
		#codecleaner-script-manager table select.codecleaner-disable-select {
			border: 2px solid #27ae60;
		}
		#codecleaner-script-manager table select.codecleaner-disable-select.everywhere {
			border: 2px solid #ED5464;
		}
		#codecleaner-script-manager table select.codecleaner-disable-select.current {
			border: 2px solid #f1c40f;
		}
		#codecleaner-script-manager .codecleaner-script-manager-enable-placeholder {
			color: #bbbbbb;
			font-style: italic;
			font-size: 14px;
		}
		#codecleaner-script-manager table input[type='checkbox'] {
			position: relative;
			display: inline-block;
			margin: 0px 3px 0px 0px;
			vertical-align: middle;
			opacity: 1;
		}
		#codecleaner-script-manager table label {
			display: inline-block;
			margin: 0px 10px 0px 0px;
			width: auto;
		}
		#codecleaner-script-manager input[type='submit'] {
			background: #4a89dd;
			color: #ffffff;
			cursor: pointer;
			border: none;
			font-size: 14px;
		}
		#codecleaner-script-manager input[type='submit']:hover {
			background: #5A93E0;
		}
	</style>";

	echo "<div id='codecleaner-script-manager-wrapper' "; if(isset($_GET['codecleaner'])){ echo "style='display: block;'"; } echo ">";

		echo "<div id='codecleaner-script-manager'>";

			//Header
			echo "<div id='codecleaner-script-manager-header'>";
				echo "<h2>codecleaner Script Manager</h2>";
				echo "<div id='codecleaner-script-manager-description'>";
					echo "<p>Below you can disable/enable CSS and JS files on an individual page/post basis, including custom post types. We recommend testing this locally or on a staging site first, as this can adversely affect the appearance of your live website. If you aren't sure about a certain script, you can try clicking on it, as a lot of authors will mention their plugin or theme in the header of the source code.</p>
						<p>If for some reason you run into trouble, you can always enable everything again to reset these settings. Make sure to check out the <a href='https://cleancoded.com/cleaner/' target='_blank' title='Code Cleaner Knowledge Base'>Code Cleaner Knowledge Base</a> for more information.</p>";
				echo "</div>";
				echo "<a href='" . add_query_arg(str_replace(array('&codecleaner', 'codecleaner'), '', $_SERVER['QUERY_STRING']), '', home_url($wp->request)) . "' id='codecleaner-script-manager-close'>";
					echo "<img src='" . plugins_url( 'img/close.png', dirname(__FILE__) ) . "' title='Close Script Manager' />";
				echo "</a>";
			echo "</div>";

			//Form
			echo "<form method='POST'>";

				echo "<div id='codecleaner-script-manager-tabs'>";
					echo "<button name='tab' value='' class='"; if(empty($_POST['tab'])){echo "active";} echo "' title='Script Manager'>Script Manager<span>Manage scripts loading on the current page.</span></button>";
					echo "<button name='tab' value='settings' class='"; if(!empty($_POST['tab']) && $_POST['tab'] == "settings"){echo "active";} echo "'>Global Settings<span>View and manage all of your Script Manager settings.</button>";
				echo "</div>";

				if(empty($_POST['tab'])) {

					foreach($codecleaner_filters as $type => $data) {

						if(!empty($data["scripts"]->done)) {
							echo "<h3>" . $data["title"] . "</h3>";
							echo "<div class='codecleaner-script-manager-section'>";
								echo "<table>";
									echo "<thead>";
										echo "<tr>";
											echo "<th style='width: 75px;'>Size</th>";
											echo "<th style='width: 40%;'>Script</th>";
											echo "<th style='width: 200px;'>Disable</th>";
											echo "<th>Enable</th>";
										echo "</tr>";
									echo "</thead>";
									echo "<tbody>";
										foreach($data["scripts"]->done as $key => $script) {

											if(!empty($data["scripts"]->registered[$script]->src)) {

												//Check for Disables Already Set
												if(!empty($codecleaner_disables)) {
													foreach($codecleaner_disables as $key => $val) {
														if(strpos($data["scripts"]->registered[$script]->src, $val) !== false) {
															continue 2;
														}
													}
												}

												$handle = $data["scripts"]->registered[$script]->handle;
												echo "<tr>";	

													//Size					
													echo "<td class='codecleaner-script-manager-size'>";
														if(file_exists(ABSPATH . str_replace(get_home_url(), '', $data["scripts"]->registered[$script]->src))) {
															echo round(filesize(ABSPATH . str_replace(get_home_url(), '', $data["scripts"]->registered[$script]->src)) / 1024, 1 ) . ' KB';
														}
													echo "</td>";

													//Handle and Path
													echo "<td class='codecleaner-script-manager-script'><span>" . $data["scripts"]->registered[$script]->handle . "</span><a href='" . $data["scripts"]->registered[$script]->src . "' target='_blank'>" . str_replace(get_home_url(), '', $data["scripts"]->registered[$script]->src) . "</a></td>";

													//Disable
													echo "<td class='codecleaner-script-manager-disable'>";
														echo "<select name='disabled[" . $type . "][" . $handle . "]' class='codecleaner-disable-select'>";
															echo "<option value='' class='codecleaner-option-enabled';>Enabled</option>";
															echo "<option value='everywhere' class='codecleaner-option-everywhere' ";
																if(!empty($options['disabled'][$type][$handle]['everywhere']) && $options['disabled'][$type][$handle]['everywhere'] == 1) {
																	echo "selected";
																}
															echo ">Everywhere</option>";
															echo "<option value='current' class='codecleaner-option-current' ";
																if(isset($options['disabled'][$type][$handle]['current'])) {
																	if(in_array($currentID, $options['disabled'][$type][$handle]['current'])) {
																		echo "selected";
																	}
																}
															echo ">Current URL</option>";
														echo "</select>";
													echo "</td>";

													//Enable
													echo "<td>";
														echo "<span class='codecleaner-script-manager-enable-placeholder' "; if(!empty($options['disabled'][$type][$handle]['everywhere'])) { echo "style='display: none;'"; } echo ">Disable everwhere to view enable settings.</span>";
														echo "<span class='codecleaner-script-manager-enable'"; if(empty($options['disabled'][$type][$handle]['everywhere'])) { echo " style='display: none;'"; } echo">";
														echo "<input type='hidden' name='enabled[" . $type . "][" . $handle . "][current]' value='' />";
														echo "<label for='" . $type . "-" . $handle . "-enable-current'>";
															echo "<input type='checkbox' name='enabled[" . $type . "][" . $handle . "][current]' id='" . $type . "-" . $handle . "-enable-current' value='" . $currentID ."' ";
																if(isset($options['enabled'][$type][$handle]['current'])) {
																	if(in_array($currentID, $options['enabled'][$type][$handle]['current'])) {
																		echo "checked";
																	}
																}
															echo " />Current URL";
														echo "</label>";
														$post_types = get_post_types(array('public' => true), 'objects', 'and');
														if(!empty($post_types)) {
															if(isset($post_types['attachment'])) {
																unset($post_types['attachment']);
															}
															echo "<input type='hidden' name='enabled[" . $type . "][" . $handle . "][post_types]' value='' />";
															foreach($post_types as $key => $value) {
																echo "<label for='" . $type . "-" . $handle . "-enable-" . $key . "'>";
																	echo "<input type='checkbox' name='enabled[" . $type . "][" . $handle . "][post_types][]' id='" . $type . "-" . $handle . "-enable-" . $key . "' value='" . $key ."' ";
																		if(isset($options['enabled'][$type][$handle]['post_types'])) {
																			if(in_array($key, $options['enabled'][$type][$handle]['post_types'])) {
																				echo "checked";
																			}
																		}
																	echo " />" . $value->label;
																echo "</label>";
															}
														}
														echo "</span>";
													echo "</td>";
												echo "</tr>";
											}
										}
									echo "</tbody>";
								echo "</table>";
							echo "</div>";
						}
					}

					echo "<input type='submit' name='codecleaner_script_manager' value='Save' />";

				}
				elseif(!empty($_POST['tab']) && $_POST['tab'] == "settings") {

					echo "<div class='codecleaner-script-manager-section'>";

						/*echo "<div style='padding-bottom: 10px; border-bottom: 1px solid #eeeeee; margin-bottom: 20px; text-align: right;'>";
							echo "<button type='button'>Clear All Settings</button>";
						echo "</div>";*/

						echo "<h2 style='margin-bottom: 10px;'>Script Manager Options</h2>";
						echo "<p style='margin: 0px 0px 10px 0px;'>This is a visual representation of the Script Manager configuration across your entire site.</p>";
						if(!empty($options)) {
							foreach($options as $category => $types) {
								echo "<h3>" . $category . "</h3>";
								if(!empty($types)) {
									echo "<table>";
										echo "<thead>";
											echo "<tr>";
												echo "<th>Type</th>";
												echo "<th>Script</th>";
												echo "<th>Setting</th>";
											echo "</tr>";
										echo "</thead>";
										echo "<tbody>";
											foreach($types as $type => $scripts) {
												if(!empty($scripts)) {
													foreach($scripts as $script => $details) {
														if(!empty($details)) {
															foreach($details as $detail => $values) {
																echo "<tr><td>" . $type . "</td><td>" . $script . "</td><td>" . $detail . "</td></tr>";
															}
														}
													}
												}
											}
										echo "</tbody>";
									echo "</table>";
								}
							}
						}
					echo "<div>";
				}

			echo "</form>";
	
		echo "</div>";

	echo "</div>";

	//Dynamic Form Selection
	echo "<script>
		jQuery(document).ready(function($) {
			$('.codecleaner-disable-select').each(function() {
				$(this).addClass($(this).children(':selected').val());
				}).on('change', function(ev) {
				$(this).attr('class', 'codecleaner-disable-select').addClass($(this).children(':selected').val());
				if($(this).children(':selected').val() == 'everywhere') {
					$(this).closest('tr').find('.codecleaner-script-manager-enable-placeholder').hide();
					$(this).closest('tr').find('.codecleaner-script-manager-enable').show();
				}
				else {
					$(this).closest('tr').find('.codecleaner-script-manager-enable').hide();
					$(this).closest('tr').find('.codecleaner-script-manager-enable-placeholder').show();
				}
			});
		});
	</script>";
}

function codecleaner_script_manager_update() {

	if(isset($_GET['codecleaner']) && !empty($_POST['codecleaner_script_manager'])) {
	
		global $wp_scripts;
		global $wp_styles;

		$currentID = get_queried_object_id();

		$codecleaner_filters = array(
			"js" => array (
				"title" => "JS",
				"scripts" => $wp_scripts
			),
			"css" => array(
				"title" => "CSS",
				"scripts" => $wp_styles
			)
		);

		$options = get_option('codecleaner_script_manager');

		foreach($codecleaner_filters as $type => $data) {

			foreach($_POST['disabled'][$type] as $handle => $value) {

				if(!empty($value)) {
					if($value == "everywhere") {
						$options['disabled'][$type][$handle]['everywhere'] = 1;
						if(!empty($options['disabled'][$type][$handle]['current'])) {
							unset($options['disabled'][$type][$handle]['current']);
						}
					}
					elseif($value == "current") {
						if(isset($options['disabled'][$type][$handle]['everywhere'])) {
							unset($options['disabled'][$type][$handle]['everywhere']);
						}
						if(!is_array($options['disabled'][$type][$handle]['current'])) {
							$options['disabled'][$type][$handle]['current'] = array();
						}
						if(!in_array($currentID, $options['disabled'][$type][$handle]['current'])) {
							array_push($options['disabled'][$type][$handle]['current'], $currentID);
						}
					}
				}
				else {
					unset($options['disabled'][$type][$handle]['everywhere']);
					if(isset($options['disabled'][$type][$handle]['current'])) {
						$current_key = array_search($currentID, $options['disabled'][$type][$handle]['current']);
					}
					if(!empty($current_key) || $current_key === 0) {
						unset($options['disabled'][$type][$handle]['current'][$current_key]);
						if(empty($options['disabled'][$type][$handle]['current'])) {
							unset($options['disabled'][$type][$handle]['current']);
						}
					}
				}
				if(empty($options['disabled'][$type][$handle])) {
					unset($options['disabled'][$type][$handle]);
					if(empty($options['disabled'][$type])) {
						unset($options['disabled'][$type]);
						if(empty($options['disabled'])) {
							unset($options['disabled']);
						}
					}
				}
			}

			foreach($_POST['enabled'][$type] as $handle => $value) {

				if(!empty($value['current']) || $value['current'] === "0") {
					if(!is_array($options['enabled'][$type][$handle]['current'])) {
						$options['enabled'][$type][$handle]['current'] = array();
					}
					if(!in_array($value['current'], $options['enabled'][$type][$handle]['current'])) {
						array_push($options['enabled'][$type][$handle]['current'], $value['current']);
					}
				}
				else {
					if(isset($options['enabled'][$type][$handle]['current'])) {
						$current_key = array_search($currentID, $options['enabled'][$type][$handle]['current']);
					}
					if(!empty($current_key) || $current_key === 0) {
						unset($options['enabled'][$type][$handle]['current'][$current_key]);
						if(empty($options['enabled'][$type][$handle]['current'])) {
							unset($options['enabled'][$type][$handle]['current']);
						}
					}
				}

				if(!empty($value['post_types'])) {
					$options['enabled'][$type][$handle]['post_types'] = array();
					foreach($value['post_types'] as $key => $post_type) {
						if(isset($options['enabled'][$type][$handle]['post_types'])) {
							if(!in_array($post_type, $options['enabled'][$type][$handle]['post_types'])) {
								array_push($options['enabled'][$type][$handle]['post_types'], $post_type);
							}
						}
					}
				}
				else {
					unset($options['enabled'][$type][$handle]['post_types']);
				}

				if(empty($options['enabled'][$type][$handle])) {
					unset($options['enabled'][$type][$handle]);
					if(empty($options['enabled'][$type])) {
						unset($options['enabled'][$type]);
						if(empty($options['enabled'])) {
							unset($options['enabled']);
						}
					}
				}
			}
		}
		update_option('codecleaner_script_manager', $options);
	}
}

function codecleaner_dequeue_scripts($src, $handle) {
	if(is_admin()) {
		return $src;
	}

	if(current_filter() == 'script_loader_src') {
		$type = 'js';
	}
	else {
		$type = 'css';
	}

	$options = get_option('codecleaner_script_manager');
	$currentID = get_queried_object_id();

	if((!empty($options['disabled'][$type][$handle]['everywhere']) && $options['disabled'][$type][$handle]['everywhere'] == 1) || (!empty($options['disabled'][$type][$handle]['current']) && in_array($currentID, $options['disabled'][$type][$handle]['current']))) {
		
		if(!empty($options['enabled'][$type][$handle]['current']) && in_array($currentID, $options['enabled'][$type][$handle]['current'])) {
			return $src;
		}

		if(is_front_page() || is_home()) {
			if('page' != get_option('show_on_front')) {
				return false;
			}
			else {
				if(!empty($options['enabled'][$type][$handle]['post_types']) && in_array('page', $options['enabled'][$type][$handle]['post_types'])) {
					return $src;
				}
			}
		}

		if(!empty($options['enabled'][$type][$handle]['post_types']) && in_array(get_post_type(), $options['enabled'][$type][$handle]['post_types'])) {
			return $src;
		}

		return false;
	}

	return $src;
}

/* DNS Prefetch
/***********************************************************************/
function codecleaner_dns_prefetch() {
	global $codecleaner_extras;
	if(!empty($codecleaner_extras['dns_prefetch']) && is_array($codecleaner_extras['dns_prefetch'])) {
		foreach($codecleaner_extras['dns_prefetch'] as $url) {
			echo "<link rel='dns-prefetch' href='" . $url . "'>" . "\n";
		}
	}
}

/* Preconnect
/***********************************************************************/
if(!empty($codecleaner_extras['preconnect'])) {
	add_action('wp_head', 'codecleaner_preconnect', 1);
}

function codecleaner_preconnect() {
	global $codecleaner_extras;
	if(!empty($codecleaner_extras['preconnect']) && is_array($codecleaner_extras['preconnect'])) {
		foreach($codecleaner_extras['preconnect'] as $url) {
			echo "<link rel='preconnect' href='" . $url . "' crossorigin>" . "\n";
		}
	}
}
