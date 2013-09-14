<?php
/**
 * @package AxalianKonamicode
 */
/*
Plugin Name: KonamiCode
Plugin URI: http://github.com/?return=true
Description: Implement the konami code on your site, and execute a jQuery function when fired
Version: 1.0.0
Author: AxaliaN
Author URI: http://www.michelmaas.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

if (!class_exists('Axalian_Konamicode')) {
	class Axalian_Konamicode {

		/** 
		 * Construct the plugin object 
		 */
		public function __construct()
		{
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
            $axalian_konamicode_settings = new Axalian_Konamicode_Settings();


		}

		/**
		 * Activate the plugin
		 */
		public static function activate(){}

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate(){}
	}
}

if(class_exists('Axalian_KonamiCode')) { 
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Axalian_Konamicode', 'activate')); 
	register_deactivation_hook(__FILE__, array('Axalian_Konamicode', 'deactivate'));

	// instantiate the plugin class 
	$axalian_konamicode = new Axalian_KonamiCode(); 

	// Add a link to the settings page onto the plugin page
    if(isset($axalian_konamicode))
    {
        // Add the settings link to the plugins page
        function plugin_settings_link($links)
        { 
            $settings_link = '<a href="options-general.php?page=axalian_konamicode">Settings</a>'; 
            array_unshift($links, $settings_link); 
            return $links; 
        }

        // Add the required javascript
		function enqueue_script()
		{
            wp_register_script('jquery', 'http//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2');
            wp_register_script('jquery.konamicode', plugins_url() . '/axalian-konamicode/js/jquery.konami.min.js', array('jquery'), '1.0', true);
            wp_register_script('jquery.konamicode.cheat', plugins_url() . '/axalian-konamicode/cheat.php', array('jquery','jquery.konamicode'), '1.0', true);
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery.konamicode');
            wp_enqueue_script('jquery.konamicode.cheat');
		}
 
     	$plugin = plugin_basename(__FILE__);

        add_filter("plugin_action_links_$plugin", 'plugin_settings_link');

        add_action('wp_enqueue_scripts', 'enqueue_script');
    }
}