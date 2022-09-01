<?php
//Register Settings and Options
function codecleaner_settings() {
	if(get_option('codecleaner_options') == false) {	
		add_option('codecleaner_options', apply_filters('codecleaner_default_options', codecleaner_default_options()));
	}

    //Primary Options Section
    add_settings_section('codecleaner_options', 'Options', 'codecleaner_options_callback', 'codecleaner_options');

    //Disable Emojis
    add_settings_field(
    	'disable_emojis', 
    	codecleaner_title('Disable Emojis', 'disable_emojis') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-emojis-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
            'id' => 'disable_emojis',
            'tooltip' => 'Removes the WordPress Emojis JavaScript file (wp-emoji-release.min.js).'
        )
    );

    //Disable Embeds
    add_settings_field(
    	'disable_embeds', 
    	codecleaner_title('Disable Embeds', 'disable_embeds') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-embeds-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'disable_embeds',
    		'tooltip' => 'Removes the WordPress Embed JavaScript file (wp-embed.min.js).'    		
    	)
    );

    //Remove Query Strings
    add_settings_field(
    	'remove_query_strings', 
    	codecleaner_title('Remove Query Strings', 'remove_query_strings') . codecleaner_tooltip('https://cleancoded.com/cleaner/remove-query-strings-from-static-resources/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'remove_query_strings',
    		'tooltip' => 'Remove query strings from static resources (CSS and JS).'
    	)
    );

    //Query String Parameters
    /*add_settings_field(
        'query_string_parameters', 
        codecleaner_title('Additional Parameters', 'query_string_parameters') . codecleaner_tooltip(''), 
        'codecleaner_print_input', 
        'codecleaner_options', 
        'codecleaner_options', 
        array(
            'id' => 'query_string_parameters',
            'input' => 'text',
            'placeholder' => 'v,id',
            'tooltip' => ''
        )
    );*/

	//Disable XML-RPC
    add_settings_field(
    	'disable_xmlrpc', 
    	codecleaner_title('Disable XML-RPC', 'disable_xmlrpc') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-xml-rpc-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'disable_xmlrpc',
    		'tooltip' => 'Disables WordPress XML-RPC functionality.'
    	)
    );

	//Remove jQuery Migrate
    add_settings_field(
    	'remove_jquery_migrate', 
    	codecleaner_title('Remove jQuery Migrate', 'remove_jquery_migrate') . codecleaner_tooltip('https://cleancoded.com/cleaner/remove-jquery-migrate-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'remove_jquery_migrate',
    		'tooltip' => 'Removes the jQuery Migrate JavaScript file (jquery-migrate.min.js).'
    	)
    );

    //Hide WP Version
    add_settings_field(
    	'hide_wp_version', 
    	codecleaner_title('Hide WP Version', 'hide_wp_version') . codecleaner_tooltip('https://cleancoded.com/cleaner/remove-wordpress-version-number/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'hide_wp_version',
    		'tooltip' => 'Removes the WordPress version meta tag.'
    	)
    );

    //Remove wlmanifest Link
    add_settings_field(
    	'remove_wlwmanifest_link', 
    	codecleaner_title('Remove wlwmanifest Link', 'remove_wlwmanifest_link') . codecleaner_tooltip('https://cleancoded.com/cleaner/remove-wlwmanifest-link-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options',
        array(
        	'id' => 'remove_wlwmanifest_link',
        	'tooltip' => 'Removes the wlwmanifest (Windows Live Writer) link tag.'
        )
    );

    //Remove RSD Link
    add_settings_field(
    	'remove_rsd_link', 
    	codecleaner_title('Remove RSD Link', 'remove_rsd_link') . codecleaner_tooltip('https://cleancoded.com/cleaner/remove-rsd-link-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'remove_rsd_link',
    		'tooltip' => 'Removes the RSD (Real Simple Discovery) link tag.'
    	)
    );

    //Remove Shortlink
    add_settings_field(
    	'remove_shortlink', 
    	codecleaner_title('Remove Shortlink', 'remove_shortlink') . codecleaner_tooltip('https://cleancoded.com/cleaner/remove-shortlink-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'remove_shortlink',
    		'tooltip' => 'Removes the Shortlink link tag.'
    	)
    );

    //Disable RSS Feeds
    add_settings_field(
    	'disable_rss_feeds', 
    	codecleaner_title('Disable RSS Feeds', 'disable_rss_feeds') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-rss-feeds-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'disable_rss_feeds',
    		'tooltip' => 'Disables WordPress-generated RSS feeds.'
    	)
    );

    //Remove Feed Links
    add_settings_field(
    	'remove_feed_links', 
    	codecleaner_title('Remove RSS Feed Links', 'remove_feed_links') . codecleaner_tooltip('https://cleancoded.com/cleaner/remove-rss-feed-links-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'remove_feed_links',
    		'tooltip' => 'Disables WordPress-generated RSS feed link tags.'
    	)
    );

    //Disable Self Pingbacks
    add_settings_field(
    	'disable_self_pingbacks', 
    	codecleaner_title('Disable Self Pingbacks', 'disable_self_pingbacks') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-self-pingbacks-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'disable_self_pingbacks',
    		'tooltip' => 'Disables Self Pingbacks (generated when linking to a post on your own site).'
    	)
    );

    //Remove REST API Links
    add_settings_field(
    	'remove_rest_api_links', 
    	codecleaner_title('Remove REST API Links', 'remove_rest_api_links') . codecleaner_tooltip('https://cleancoded.com/cleaner/remove-wordpress-rest-api-links/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'remove_rest_api_links',
    		'tooltip' => 'Removes the REST API link tag from the front-end and the REST API header link from page requests.'
    	)
    );

    //Disable Dashicons
    add_settings_field(
        'disable_dashicons', 
        codecleaner_title('Disable Dashicons', 'disable_dashicons') . codecleaner_tooltip('https://cleancoded.com/cleaner/remove-dashicons-wordpress/'), 
        'codecleaner_print_input', 
        'codecleaner_options', 
        'codecleaner_options', 
        array(
            'id' => 'disable_dashicons',
            'tooltip' => 'Disables dashicons on the front-end when not logged in.'
        )
    );

    //Disable Google Maps
    add_settings_field(
        'disable_google_maps', 
        codecleaner_title('Disable Google Maps', 'disable_google_maps') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-google-maps-api-wordpress/'), 
        'codecleaner_print_input', 
        'codecleaner_options', 
        'codecleaner_options', 
        array(
            'id' => 'disable_google_maps',
            'tooltip' => 'Removes all instances of Google Maps loaded on your website.'
        )
    );

    //Disable Heartbeat
    add_settings_field(
    	'disable_heartbeat', 
    	'<label for=\'disable_heartbeat\'>' . __('Disable Heartbeat', 'codecleaner') . '</label>' . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-wordpress-heartbeat-api/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'disable_heartbeat',
    		'input' => 'select',
    		'options' => array(
    			'' => 'Default',
    			'disable_everywhere' => 'Disable Everywhere',
    			'allow_posts' => 'Only Allow When Editing Posts/Pages'
    		),
    		'tooltip' => 'Disables WordPress Heartbeat (used for auto saving and revision tracking).'
    	)
    );

    //Heartbeat Frequency
    add_settings_field(
    	'heartbeat_frequency', 
    	'<label for=\'heartbeat_frequency\'>' . __('Heartbeat Frequency', 'codecleaner') . '</label>' . codecleaner_tooltip('https://cleancoded.com/cleaner/change-heartbeat-frequency-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'heartbeat_frequency',
    		'input' => 'select',
    		'options' => array(
    			'' => '15 Seconds (Default)',
    			'30' => '30 Seconds',
    			'45' => '45 Seconds',
    			'60' => '60 Seconds'
    		),
    		'tooltip' => 'Controls how often the WordPress Heartbeat API is allowed to run.'
    	)
    );

    //Limit Post Revisions
    add_settings_field(
    	'limit_post_revisions', 
    	'<label for=\'limit_post_revisions\'>' . __('Limit Post Revisions', 'codecleaner') . '</label>' . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-limit-post-revisions-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'limit_post_revisions',
    		'input' => 'select',
    		'options' => array(
    			'' => 'Default',
    			'false' => 'Disable Post Revisions',
    			'1' => '1',
    			'2' => '2',
    			'3' => '3',
    			'4' => '4',
    			'5' => '5',
    			'10' => '10',
    			'15' => '15',
    			'20' => '20',
    			'25' => '25',
    			'30' => '30'
    		),
    		'tooltip' => 'Limits the maximum number of revisions that are allowed for posts and pages.'
    	)
    );

    //Autosave Interval
    add_settings_field(
    	'autosave_interval', 
    	'<label for=\'autosave_interval\'>' . __('Autosave Interval', 'codecleaner') . '</label>' . codecleaner_tooltip('https://cleancoded.com/cleaner/change-autosave-interval-wordpress/'), 
    	'codecleaner_print_input', 
    	'codecleaner_options', 
    	'codecleaner_options', 
    	array(
    		'id' => 'autosave_interval',
    		'input' => 'select',
    		'options' => array(
    			'' => '1 Minute (Default)',
    			'120' => '2 Minutes',
    			'180' => '3 Minutes',
    			'240' => '4 Minutes',
    			'300' => '5 Minutes'
    		),
    		'tooltip' => 'Controls how often WordPress will auto save posts and pages while editing.'
    	)
    );

    //Change Login URL
    add_settings_field(
        'login_url', 
        codecleaner_title('Change Login URL', 'login_url') . codecleaner_tooltip('https://cleancoded.com/cleaner/change-wordpress-login-url/'), 
        'codecleaner_print_input', 
        'codecleaner_options', 
        'codecleaner_options', 
        array(
            'id' => 'login_url',
            'input' => 'text',
            'placeholder' => 'hideme',
            'tooltip' => 'Changes your WordPress login URL (slug) to the provided string and blocks the wp-admin and wp-login endpoints from being accessed directly.'
        )
    );

    //WooCommerce Options Section
    add_settings_section('codecleaner_woocommerce', 'WooCommerce', 'codecleaner_woocommerce_callback', 'codecleaner_options');

    //Disable WooCommerce Scripts
    add_settings_field(
        'disable_woocommerce_scripts', 
        codecleaner_title('Disable Scripts', 'disable_woocommerce_scripts') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-woocommerce-scripts-and-styles/'), 
        'codecleaner_print_input', 
        'codecleaner_options', 
        'codecleaner_woocommerce', 
        array(
            'id' => 'disable_woocommerce_scripts',
            'tooltip' => 'Disables WooCommerce scripts and styles except on product, cart and checkout pages.'
        )
    );

    //Disable WooCommerce Cart Fragmentation
    add_settings_field(
        'disable_woocommerce_cart_fragmentation', 
        codecleaner_title('Disable Cart Fragmentation', 'disable_woocommerce_cart_fragmentation') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-woocommerce-cart-fragments-ajax/'), 
        'codecleaner_print_input', 
        'codecleaner_options', 
        'codecleaner_woocommerce', 
        array(
            'id' => 'disable_woocommerce_cart_fragmentation',
            'tooltip' => 'Completely disables the WooCommerce cart fragmentation script.'
        )
    );

    //Disable WooCommerce Status Meta Box
    add_settings_field(
        'disable_woocommerce_status', 
        codecleaner_title('Disable Status Meta Box', 'disable_woocommerce_status') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-woocommerce-status-meta-box/'), 
        'codecleaner_print_input', 
        'codecleaner_options', 
        'codecleaner_woocommerce', 
        array(
            'id' => 'disable_woocommerce_status',
            'tooltip' => 'Disables the WooCommerce status meta box from the WP Admin Dashboard.'
        )
    );

    //Disable WooCommerce Widgets
    add_settings_field(
        'disable_woocommerce_widgets', 
        codecleaner_title('Disable Widgets', 'disable_woocommerce_widgets') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-woocommerce-widgets/'), 
        'codecleaner_print_input', 
        'codecleaner_options', 
        'codecleaner_woocommerce', 
        array(
            'id' => 'disable_woocommerce_widgets',
            'tooltip' => 'Disables all WooCommerce widgets.'
        )
    );

    register_setting('codecleaner_options', 'codecleaner_options');

    //CDN Option
    if(get_option('codecleaner_cdn') == false) {    
        add_option('codecleaner_cdn', apply_filters('codecleaner_default_cdn', codecleaner_default_cdn()));
    }

    //CDN Section
    add_settings_section('codecleaner_cdn', 'CDN', 'codecleaner_cdn_callback', 'codecleaner_cdn');

    //CDN URL
    add_settings_field(
        'enable_cdn', 
        codecleaner_title('Enable CDN Rewrite', 'enable_cdn') . codecleaner_tooltip('https://cleancoded.com/cleaner/cdn-rewrite/'), 
        'codecleaner_print_input', 
        'codecleaner_cdn', 
        'codecleaner_cdn', 
        array(
            'id' => 'enable_cdn',
            'option' => 'codecleaner_cdn',
            'tooltip' => 'Enables rewriting of your site URLs with CDN URLs which can be configured below.'
        )
    );

    //CDN URL
    add_settings_field(
        'cdn_url', 
        codecleaner_title('CDN URL', 'cdn_url') . codecleaner_tooltip('https://cleancoded.com/cleaner/cdn-url/'), 
        'codecleaner_print_input', 
        'codecleaner_cdn', 
        'codecleaner_cdn', 
        array(
            'id' => 'cdn_url',
            'option' => 'codecleaner_cdn',
            'input' => 'text',
            'placeholder' => 'https://cdn.example.com',
            'tooltip' => 'Enter your CDN URL without the trailing backslash. Example: https://cdn.example.com'
        )
    );

    //CDN Included Directories
    add_settings_field(
        'cdn_directories', 
        codecleaner_title('Included Directories', 'cdn_directories') . codecleaner_tooltip('https://cleancoded.com/cleaner/cdn-included-directories/'), 
        'codecleaner_print_input', 
        'codecleaner_cdn', 
        'codecleaner_cdn', 
        array(
            'id' => 'cdn_directories',
            'option' => 'codecleaner_cdn',
            'input' => 'text',
            'placeholder' => 'wp-content,wp-includes',
            'tooltip' => 'Enter any directories you would like to be included in CDN rewriting, separated by commas (,). Default: wp-content,wp-includes'
        )
    );

    //CDN Exclusions
    add_settings_field(
        'cdn_exclusions', 
        codecleaner_title('CDN Exclusions', 'cdn_exclusions') . codecleaner_tooltip('https://cleancoded.com/cleaner/cdn-exclusions/'), 
        'codecleaner_print_input', 
        'codecleaner_cdn', 
        'codecleaner_cdn', 
        array(
            'id' => 'cdn_exclusions',
            'option' => 'codecleaner_cdn',
            'input' => 'text',
            'placeholder' => '.php',
            'tooltip' => 'Enter any directories or file extensions you would like excluded from CDN rewriting, separated by commas (,). Default: .php'
        )
    );

    register_setting('codecleaner_cdn', 'codecleaner_cdn');

    if(get_option('codecleaner_extras') == false) {    
        add_option('codecleaner_extras', apply_filters('codecleaner_default_extras', codecleaner_default_extras()));
    }
    add_settings_section('codecleaner_extras', 'Extras', 'codecleaner_extras_callback', 'codecleaner_extras');

    //Script Manager
    add_settings_field(
        'script_manager', 
        codecleaner_title('Script Manager', 'script_manager') . codecleaner_tooltip('https://cleancoded.com/cleaner/disable-scripts-per-post-page/'), 
        'codecleaner_print_input', 
        'codecleaner_extras', 
        'codecleaner_extras', 
        array(
        	'id' => 'script_manager',
        	'option' => 'codecleaner_extras',
        	'tooltip' => 'Enables the Code Cleaner Script Manager, which allows you to disable CSS and JS files on a page-by-page basis.'
        )
    );

    //DNS Prefetch
    add_settings_field(
        'dns_prefetch', 
        codecleaner_title('DNS Prefetch', 'dns_prefetch') . codecleaner_tooltip('https://cleancoded.com/cleaner/dns-prefetching/'), 
        'codecleaner_print_dns_prefetch', 
        'codecleaner_extras', 
        'codecleaner_extras', 
        array(
            'id' => 'dns_prefetch',
            'option' => 'codecleaner_extras',
            'tooltip' => 'Resolve domain names before a user clicks. Format: //domain.tld (one per line)'
        )
    );

    //Preconnect
    add_settings_field(
        'preconnect', 
        codecleaner_title('Preconnect', 'preconnect') . codecleaner_tooltip('https://cleancoded.com/cleaner/preconnect/'), 
        'codecleaner_print_preconnect', 
        'codecleaner_extras', 
        'codecleaner_extras', 
        array(
            'id' => 'preconnect',
            'option' => 'codecleaner_extras',
            'tooltip' => 'Preconnect allows the browser to set up connections before an HTTP request, eliminating roundtrip latency. Format: scheme://domain.tld (one per line)'
        )
    );

    //Clean Uninstall
    add_settings_field(
        'clean_uninstall', 
        codecleaner_title('Clean Uninstall', 'clean_uninstall') . codecleaner_tooltip('https://cleancoded.com/cleaner/clean-uninstall/'), 
        'codecleaner_print_input', 
        'codecleaner_extras', 
        'codecleaner_extras', 
        array(
            'id' => 'clean_uninstall',
            'option' => 'codecleaner_extras',
            'tooltip' => 'This will remove all Code Cleaner plugin options data from the database when the plugin is uninstalled.'
        )
    );

    //Accessibility Mode
    add_settings_field(
        'accessibility_mode', 
        codecleaner_title('Accessibility Mode', 'accessibility_mode', true), 
        'codecleaner_print_input',
        'codecleaner_extras', 
        'codecleaner_extras', 
        array(
        	'id' => 'accessibility_mode',
        	'input' => 'checkbox',
        	'option' => 'codecleaner_extras',
        	'tooltip' => 'Disables visual UI elements within the plugin settings such as checkbox toggles and hovering tooltips.'
        )
    );

    register_setting('codecleaner_extras', 'codecleaner_extras', 'codecleaner_sanitize_extras');
}
add_action('admin_init', 'codecleaner_settings');

//Options Default Values
function codecleaner_default_options() {
	$defaults = array(
		'disable_emojis' => "0",
		'disable_embeds' => "0",
		'remove_query_strings' => "0",
        //'query_string_parameters' => "",
		'disable_xmlrpc' => "0",
		'remove_jquery_migrate' => "0",
		'hide_wp_version' => "0",
		'remove_wlwmanifest_link' => "0",
		'remove_rsd_link' => "0",
		'remove_shortlink' => "0",
		'disable_rss_feeds' => "0",
		'remove_feed_links' => "0",
		'disable_self_pingbacks' => "0",
		'remove_rest_api_links' => "0",
        'disable_dashicons' => "0",
        'disable_google_maps' => "0",
		'disable_heartbeat' => "",
		'heartbeat_frequency' => "",
		'limit_post_revisions' => "",
		'autosave_interval' => "",
        'login_url' => "",
        'disable_woocommerce_scripts' => "0",
        'disable_woocommerce_cart_fragmentation' => "0",
        'disable_woocommerce_status' => "0",
        'disable_woocommerce_widgets' => "0"
	);
    codecleaner_network_defaults($defaults, 'codecleaner_options');
	return apply_filters('codecleaner_default_options', $defaults);
}

//CDN Default Values
function codecleaner_default_cdn() {
    $defaults = array(
        'enable_cdn' => "0",
        'cdn_url' => "0",
        'cdn_directories' => "wp-content,wp-includes",
        'cdn_exclusions' => ".php"
    );
    codecleaner_network_defaults($defaults, 'codecleaner_cdn');
    return apply_filters( 'codecleaner_default_cdn', $defaults );
}

//Extras Default Values
function codecleaner_default_extras() {
    $defaults = array(
        'script_manager' => "0",
        'accessibility_mode' => "0"
    );
    codecleaner_network_defaults($defaults, 'codecleaner_extras');
    return apply_filters( 'codecleaner_default_extras', $defaults );
}

function codecleaner_network_defaults(&$defaults, $option) {
    if(is_multisite() && is_plugin_active_for_network('codecleaner/codecleaner.php')) {
        $codecleaner_network = get_site_option('codecleaner_network');
        if(!empty($codecleaner_network['default'])) {
            $networkDefaultOptions = get_blog_option($codecleaner_network['default'], $option);
            if($option == 'codecleaner_cdn') {
                unset($networkDefaultOptions['cdn_url']);
            }
            if(!empty($networkDefaultOptions)) {
                foreach($networkDefaultOptions as $key => $val) {
                    $defaults[$key] = $val;
                }
            }
        }
    }
}

//Main Options Group Callback
function codecleaner_options_callback() {
	echo '<p class="codecleaner-subheading">' . __( 'Select which performance options you would like to enable.', 'codecleaner' ) . '</p>';
}

//WooCommerce Options Group Callback
function codecleaner_woocommerce_callback() {
    echo '<p class="codecleaner-subheading">' . __( 'Disable specific elements of WooCommerce.', 'codecleaner' ) . '</p>';
}

//CDN Group Callback
function codecleaner_cdn_callback() {
    echo '<p class="codecleaner-subheading">' . __( 'CDN options that allow you to rewrite your site URLs with CDN URLs.', 'codecleaner' ) . '</p>';
}

//Extras Group Callback
function codecleaner_extras_callback() {
    echo '<p class="codecleaner-subheading">' . __( 'Extra Code Cleaner plugin functionality.', 'codecleaner' ) . '</p>';
}

//Print Form Inputs
function codecleaner_print_input($args) {
    if(!empty($args['option'])) {
        $option = $args['option'];
        if($args['option'] == 'codecleaner_network') {
            $options = get_site_option($args['option']);
        }
        else {
            $options = get_option($args['option']);
        }
    }
    else {
        $option = 'codecleaner_options';
        $options = get_option('codecleaner_options');
    }
    if(!empty($args['option']) && $args['option'] == 'codecleaner_extras') {
        $extras = $options;
    }
    else {
        $extras = get_option('codecleaner_extras');
    }

    echo "<div style='display: table; width: 100%;'>";
        echo "<div class='codecleaner-input-wrapper'>";

            //Text
            if(!empty($args['input']) && ($args['input'] == 'text' || $args['input'] == 'color')) {
                echo "<input type='text' id='" . $args['id'] . "' name='" . $option . "[" . $args['id'] . "]' value='" . (!empty($options[$args['id']]) ? $options[$args['id']] : '') . "' placeholder='" . (!empty($args['placeholder']) ? $args['placeholder'] : '') . "' />";
            }

            //Select
            elseif(!empty($args['input']) && $args['input'] == 'select') {
                echo "<select id='" . $args['id'] . "' name='" . $option . "[" . $args['id'] . "]'>";
                    foreach($args['options'] as $value => $title) {
                        echo "<option value='" . $value . "' "; 
                        if(!empty($options[$args['id']]) && $options[$args['id']] == $value) {
                            echo "selected";
                        } 
                        echo ">" . $title . "</option>";
                    }
                echo "</select>";
            }

            //Checkbox and Toggle
            else {
                if((empty($extras['accessibility_mode']) || $extras['accessibility_mode'] != "1") && (empty($args['input']) || $args['input'] != 'checkbox')) {
                    echo "<label for='" . $args['id'] . "' class='switch'>";
                }
                    echo "<input type='checkbox' id='" . $args['id'] . "' name='" . $option . "[" . $args['id'] . "]' value='1' style='display: block; margin: 0px;' ";
                    if(!empty($options[$args['id']]) && $options[$args['id']] == "1") {
                        echo "checked";
                    }
                    echo ">";
                if((empty($extras['accessibility_mode']) || $extras['accessibility_mode'] != "1") && (empty($args['input']) || $args['input'] != 'checkbox')) {
                       echo "<div class='slider'></div>";
                   echo "</label>";
                }
            }
            
        echo "</div>";

        if(!empty($args['tooltip'])) {
            if((empty($extras['accessibility_mode']) || $extras['accessibility_mode'] != "1") && $args['id'] != 'accessibility_mode') {
                echo "<div class='codecleaner-tooltip-text-wrapper'>";
                    echo "<div class='codecleaner-tooltip-text-container'>";
                        echo "<div style='display: table; height: 100%; width: 100%;'>";
                            echo "<div style='display: table-cell; vertical-align: middle;'>";
                                echo "<span class='codecleaner-tooltip-text'>" . $args['tooltip'] . "</span>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
            else {
                echo "<p style='font-size: 12px; font-style: italic;'>" . $args['tooltip'] . "</p>";
            }
        }
    echo "</div>";
}

//Print Checkbox Toggle Option
function codecleaner_print_toggle($args) {
    if(!empty($args['section'])) {
        $section = $args['section'];
        $options = get_option($args['section']);
    }
    else {
        $section = 'codecleaner_options';
        $options = get_option('codecleaner_options');
    }
    if(!empty($args['section']) && $args['section'] == 'codecleaner_extras') {
        $extras = $options;
    }
    else {
        $extras = get_option('codecleaner_extras');
    }
	//$options = get_option('codecleaner_options');
    //$extras = get_option('codecleaner_extras');
    if((empty($extras['accessibility_mode']) || $extras['accessibility_mode'] != "1") && empty($args['checkbox'])) {
        echo "<label for='" . $args['id'] . "' class='switch' style='font-size: 1px;'>";
            echo $args['label'];
    }
    	echo "<input type='checkbox' id='" . $args['id'] . "' name='" . $section . "[" . $args['id'] . "]' value='1' style='display: block; margin: 0px;' ";
    	if(!empty($options[$args['id']]) && $options[$args['id']] == "1") {
    		echo "checked";
    	}
        echo ">";
    if((empty($extras['accessibility_mode']) || $extras['accessibility_mode'] != "1") && empty($args['checkbox'])) {
	       echo "<div class='slider'></div>";
	   echo "</label>";
    }
}

//Print Select Option
function codecleaner_print_select($args) {
	$options = get_option('codecleaner_options');
	echo "<select id='" . $args['id'] . "' name='codecleaner_options[" . $args['id'] . "]'>";
		foreach($args['options'] as $value => $title) {
			echo "<option value='" . $value . "' "; 
			if($options[$args['id']] == $value) {
				echo "selected";
			} 
			echo ">" . $title . "</option>";
		}
	echo "</select>";
}

//Print DNS Prefetch
function codecleaner_print_dns_prefetch($args) {
    $extras = get_option('codecleaner_extras');
     echo "<div style='display: table; width: 100%;'>";
        echo "<div class='codecleaner-input-wrapper'>";
            echo "<textarea id='" . $args['id'] . "' name='codecleaner_extras[" . $args['id'] . "]' placeholder='//example.com'>";
                if(!empty($extras['dns_prefetch'])) {
                    foreach($extras['dns_prefetch'] as $line) {
                        echo $line . "\n";
                    }
                }
            echo "</textarea>";
        echo "</div>";
        if(!empty($args['tooltip'])) {
            if(empty($extras['accessibility_mode']) || $extras['accessibility_mode'] != "1") {
                echo "<div class='codecleaner-tooltip-text-wrapper'>";
                    echo "<div class='codecleaner-tooltip-text-container'>";
                        echo "<div style='display: table; height: 100%; width: 100%;'>";
                            echo "<div style='display: table-cell; vertical-align: top;'>";
                                echo "<span class='codecleaner-tooltip-text'>" . $args['tooltip'] . "</span>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
            else {
                echo "<p style='font-size: 12px; font-style: italic;'>" . $args['tooltip'] . "</p>";
            }
        }
    echo "</div>";
}

//Print Preconnect
function codecleaner_print_preconnect($args) {
    $extras = get_option('codecleaner_extras');
     echo "<div style='display: table; width: 100%;'>";
        echo "<div class='codecleaner-input-wrapper'>";
            echo "<textarea id='" . $args['id'] . "' name='codecleaner_extras[" . $args['id'] . "]' placeholder='https://example.com'>";
                if(!empty($extras['preconnect'])) {
                    foreach($extras['preconnect'] as $line) {
                        echo $line . "\n";
                    }
                }
            echo "</textarea>";
        echo "</div>";
        if(!empty($args['tooltip'])) {
            if(empty($extras['accessibility_mode']) || $extras['accessibility_mode'] != "1") {
                echo "<div class='codecleaner-tooltip-text-wrapper'>";
                    echo "<div class='codecleaner-tooltip-text-container'>";
                        echo "<div style='display: table; height: 100%; width: 100%;'>";
                            echo "<div style='display: table-cell; vertical-align: top;'>";
                                echo "<span class='codecleaner-tooltip-text'>" . $args['tooltip'] . "</span>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
            else {
                echo "<p style='font-size: 12px; font-style: italic;'>" . $args['tooltip'] . "</p>";
            }
        }
    echo "</div>";
}

//Sanitize Extras
function codecleaner_sanitize_extras($values) {
    if(!empty($values['dns_prefetch'])) {
        $text = trim($values['dns_prefetch']);
        $text_array = explode("\n", $text);
        $text_array = array_filter($text_array, 'trim');
        $values['dns_prefetch'] = $text_array;
    }
    if(!empty($values['preconnect'])) {
        $text = trim($values['preconnect']);
        $text_array = explode("\n", $text);
        $text_array = array_filter($text_array, 'trim');
        $values['preconnect'] = $text_array;
    }
    return $values;
}

//Print Tooltip
function codecleaner_tooltip($link) {
	$var = "<a ";
        if(!empty($link)) {
            $var.= "href='" . $link . "' title='View Documentation' ";
        }
        $var.= "class='codecleaner-tooltip' target='_blank'>?";
    $var.= "</a>";
    return $var;
}

//Print Title
function codecleaner_title($title, $id, $checkbox = false) {
    if(!empty($title)) {
        $var = $title;
        if(!empty($id)) {
            $extras = get_option('codecleaner_extras');
            if((!empty($extras['accessibility_mode']) && $extras['accessibility_mode'] == "1") || $checkbox == true) {
                $var = "<label for='" . $id . "'>" . $var . "</label>";
            }
        }
        return $var;
    }
}