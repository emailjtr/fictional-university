<?php
function codecleaner_network_admin_menu() {

	//Add Network Settings Menu Item
    add_submenu_page('settings.php', 'Code Cleaner Network Settings', 'codecleaner', 'manage_network_options', 'codecleaner', 'codecleaner_network_page_callback');

    //Create Site Option if Not Found
    if(get_site_option('codecleaner_network') == false) {    
        add_site_option('codecleaner_network', true);
    }
 
 	//Add Settings Section
    add_settings_section('codecleaner_network', 'Network Setup', 'codecleaner_network_callback', 'codecleaner_network');
   
   	//Add Options Fields
	add_settings_field(
		'access', 
		'<label for=\'access\'>' . __('Network Access', 'codecleaner') . '</label>' . codecleaner_tooltip('https://cleancoded.com/cleaner/wordpress-multisite/'),
		'codecleaner_network_access_callback', 
		'codecleaner_network', 
		'codecleaner_network'
	);

	add_settings_field(
		'default', 
		'<label for=\'default\'>' . __('Network Default', 'codecleaner') . '</label>' . codecleaner_tooltip('https://cleancoded.com/cleaner/wordpress-multisite/'),
		'codecleaner_network_default_callback', 
		'codecleaner_network', 
		'codecleaner_network'
	);

	//Clean Uninstall
    add_settings_field(
        'clean_uninstall', 
        codecleaner_title('Clean Uninstall', 'clean_uninstall') . codecleaner_tooltip(''), 
        'codecleaner_print_input', 
        'codecleaner_network', 
        'codecleaner_network', 
        array(
            'id' => 'clean_uninstall',
            'option' => 'codecleaner_network',
            'tooltip' => 'When enabled, this will cause all Code Cleaner options data to be removed from your database when the plugin is uninstalled.'
        )
    );

	//Register Setting
	register_setting('codecleaner_network', 'codecleaner_network');
}
add_filter('network_admin_menu', 'codecleaner_network_admin_menu');

//Code Cleaner Network Section Callback
function codecleaner_network_callback() {
	echo '<p class="codecleaner-subheading">' . __( 'Manage network access control and setup a network default site.', 'codecleaner' ) . '</p>';
}
 
//Code Cleaner Network Access
function codecleaner_network_access_callback() {
	$codecleaner_network = get_site_option('codecleaner_network');
	echo "<div style='display: table; width: 100%;'>";
		echo "<div class='codecleaner-input-wrapper'>";
			echo "<select name='codecleaner_network[access]' id='access'>";
				echo "<option value=''>Site Admins (Default)</option>";
				echo "<option value='super' " . ((!empty($codecleaner_network['access']) && $codecleaner_network['access'] == 'super') ? "selected" : "") . ">Super Admins Only</option>";
			echo "<select>";
		echo "</div>";
		echo "<div class='codecleaner-tooltip-text-wrapper'>";
			echo "<div class='codecleaner-tooltip-text-container' style='display: none;'>";
				echo "<div style='display: table; height: 100%; width: 100%;'>";
					echo "<div style='display: table-cell; vertical-align: middle;'>";
						echo "<span class='codecleaner-tooltip-text'>Choose who has access to manage codecleaner plugin settings.</span>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
}

//Code Cleaner Network Default
function codecleaner_network_default_callback() {
	$codecleaner_network = get_site_option('codecleaner_network');
	echo "<div style='display: table; width: 100%;'>";
		echo "<div class='codecleaner-input-wrapper'>";
			echo "<select name='codecleaner_network[default]' id='default'>";
				$sites = array_map('get_object_vars', get_sites(array('deleted' => 0)));
				if(is_array($sites) && $sites !== array()) {
					echo "<option value=''>None</option>";
					foreach($sites as $site) {
						echo "<option value='" . $site['blog_id'] . "' " . ((!empty($codecleaner_network['default']) && $codecleaner_network['default'] == $site['blog_id']) ? "selected" : "") . ">" . $site['blog_id'] . ": " . $site['domain'] . $site['path'] . "</option>";
					}
				}
			echo "<select>";
		echo "</div>";
		echo "<div class='codecleaner-tooltip-text-wrapper'>";
			echo "<div class='codecleaner-tooltip-text-container' style='display: none;'>";
				echo "<div style='display: table; height: 100%; width: 100%;'>";
					echo "<div style='display: table-cell; vertical-align: middle;'>";
						echo "<span class='codecleaner-tooltip-text'>Choose a subsite that you want to pull default settings from.</span>";
					echo "</div>";
				echo "</div>";
			echo "</div>";
		echo "</div>";
	echo "</div>";
}
 
//Code Cleaner Network Settings Page
function codecleaner_network_page_callback() {
	if(isset($_POST['codecleaner_apply_defaults'])) {
		check_admin_referer('codecleaner-network-apply');
		if(isset($_POST['codecleaner_network_apply_blog']) && is_numeric($_POST['codecleaner_network_apply_blog'])) {
			$blog = get_blog_details($_POST['codecleaner_network_apply_blog']);
			if($blog) {

				//Apply Default Settings to Selected Blog
				if(is_multisite()) {
					$codecleaner_network = get_site_option('codecleaner_network');

					if(!empty($codecleaner_network['default'])) {

						if($blog->blog_id != $codecleaner_network['default']) {

							$option_names = array(
								'codecleaner_options',
								'codecleaner_cdn',
								'codecleaner_extras'
							);

							foreach($option_names as $option_name) {

								//Clear Selected Blog Previous Option
								delete_blog_option($blog->blog_id, $option_name);

								//Grab New Option from Default Blog
								$new_option = get_blog_option($codecleaner_network['default'], $option_name);

								//Remove Options We Don't Want to Copy
								if($option_name == 'codecleaner_cdn') {
									unset($new_option['cdn_url']);
								}

								//Update Selected Blog with Default Option
								update_blog_option($blog->blog_id, $option_name, $new_option);

							}

							//Default Settings Updated Notice
							echo "<div class='notice updated is-dismissible'><p>" . __('Default settings applied!', 'codecleaner') . "</p></div>";
						}
						else {
							//Can't Apply to Network Default
							echo "<div class='notice error is-dismissible'><p>" . __('Select a site that is not already the Network Default.', 'codecleaner') . "</p></div>";
						}
					}
					else {
						//Network Default Not Set
						echo "<div class='notice error is-dismissible'><p>" . __('Network Default not set.', 'codecleaner') . "</p></div>";
					}
				}
			}
			else {
				//Blog Not Found Notice
				echo "<div class='notice error is-dismissible'><p>" . __('Error: Blog Not Found.', 'codecleaner') . "</p></div>";
			}
		}
	}

	//Options Updated
	if(isset($_GET['updated'])) {
		echo "<div class='notice updated is-dismissible'><p>" . __('Options saved.', 'codecleaner') . "</p></div>";
	}

	//If No Tab is Set, Default to Network Tab
	if(empty($_GET['tab'])) {
		$_GET['tab'] = 'network';
	} 

	echo "<div class='wrap codecleaner-admin'>";

		//Admin Page Title
  		echo "<h1>" . __('Code Cleaner Network Settings', 'codecleaner') . "</h1>";

  		//Tab Navigation
		echo "<h2 class='nav-tab-wrapper'>";
			echo "<a href='?page=codecleaner&tab=network' class='nav-tab " . ($_GET['tab'] == 'network' ? 'nav-tab-active' : '') . "'>Network</a>";
			echo "<a href='?page=codecleaner&tab=support' class='nav-tab " . ($_GET['tab'] == 'support' ? 'nav-tab-active' : '') . "'>Support</a>";
		echo "</h2>";

		//Network Tab Content
		if($_GET['tab'] == 'network') {

	  		echo "<form method='POST' action='edit.php?action=codecleaner_update_network_options' style='overflow: hidden;'>";
			    settings_fields('codecleaner_network');
			    do_settings_sections('codecleaner_network');
			    submit_button();
	  		echo "</form>";

	  		echo "<form method='POST'>";
	 
	  			echo "<h2>" . __('Apply Default Settings', 'codecleaner') . "</h2>";
	  			echo '<p class="codecleaner-subheading">' . __( 'Choose a site to apply the settings from your network default site.', 'codecleaner' ) . '</p>';

				wp_nonce_field('codecleaner-network-apply', '_wpnonce', true, true);
				echo "<p>" . __('Select a site from the dropdown and click to apply the settings from your network default (above).', 'codecleaner') . "</p>";

				echo "<select name='codecleaner_network_apply_blog'>";
					$sites = array_map('get_object_vars', get_sites(array('deleted' => 0)));
					if(is_array($sites) && $sites !== array()) {
						echo "<option value=''>Select a Site</option>";
						foreach($sites as $site) {
							echo "<option value='" . $site['blog_id'] . "'>" . $site['blog_id'] . ": " . $site['domain'] . $site['path'] . "</option>";
						}
					}
				echo "<select>";

				echo "<input type='submit' name='codecleaner_apply_defaults' value='" . __('Apply Default Settings', 'codecleaner') . "' class='button' />";
			echo "</form>";
		}

		//Support Tab Content
		elseif($_GET['tab'] == 'support') {
			echo "<h2>" . __('Support', 'codecleaner') . "</h2>";
			echo "<p>For plugin support and documentation, please visit <a href='https://cleancoded.com/cleaner' title='Code Cleaner' target='_blank'>CLEANCODED</a>.</p>";
		}

		//Tooltip Legend
		if($_GET['tab'] != 'support') {
			echo "<div id='codecleaner-legend'>";
				echo "<div id='codecleaner-tooltip-legend'>";
					echo "<span>?</span>Click on tooltip icons to view full documentation.";
				echo "</div>";
			echo "</div>";
		}

		//Tooltip Display Script
		echo "<script>
			(function ($) {
				$('.codecleaner-tooltip').hover(function(){
				    $(this).closest('tr').find('.codecleaner-tooltip-text-container').show();
				},function(){
				    $(this).closest('tr').find('.codecleaner-tooltip-text-container').hide();
				});
			}(jQuery));
		</script>";

	echo "</div>";
}
 
//Update Code Cleaner Network Options
function codecleaner_update_network_options() {

	//Verify Post Referring Page
  	check_admin_referer('codecleaner_network-options');
 
	//Get Registered Options
	global $new_whitelist_options;
	$options = $new_whitelist_options['codecleaner_network'];

	//Loop Through Registered Options
	foreach($options as $option) {
		if(isset($_POST[$option])) {

			//Update Site Uption
			update_site_option($option, $_POST[$option]);
		}
	}

	//Redirect to Network Settings Page
	wp_redirect(add_query_arg(array('page' => 'codecleaner', 'updated' => 'true'), network_admin_url('settings.php')));

	exit;
}
add_action('network_admin_edit_codecleaner_update_network_options',  'codecleaner_update_network_options');

