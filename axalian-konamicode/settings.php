<?php

if(!class_exists('Axalian_Konamicode_Settings'))
{
	class Axalian_Konamicode_Settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		}
		
        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
        	register_setting('axalian_konamicode-group', 'axalian_konamicode_jquery_action');

        	add_settings_section(
        	    'axalian_konamicode-section', 
        	    'KonamiCode Settings', 
        	    array(&$this, 'settings_section_axalian_konamicode'), 
        	    'axalian_konamicode'
        	);
        	
            add_settings_field(
                'axalian_konamicode-jquery_action', 
                'jQuery Action', 
                array(&$this, 'settings_field_input_textarea'), 
                'axalian_konamicode', 
                'axalian_konamicode-section',
                array(
                    'field' => 'axalian_konamicode_jquery_action'
                )
            );   
        }
        
        public function settings_section_axalian_konamicode()
        {
            // Think of this as help text for the section.
            echo 'Enter the jQuery code to execute when the Konami Code has been entered.';
        }
        
        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_textarea($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];

            // Get the value of this setting
            $value = get_option($field);

            // echo a proper textarea
            echo sprintf('<textarea name="%s" id="%s" rows="10" cols="100"/>%s</textarea>', $field, $field, $value);
        }
        
        /**
         * add a menu
         */		
        public function add_menu()
        {
        	add_options_page(
        	    'KonamiCode Settings', 
        	    'KonamiCode', 
        	    'manage_options', 
        	    'axalian_konamicode', 
        	    array(&$this, 'plugin_settings_page')
        	);
        }
    
        /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
			if (function_exists('current_user_can') && !current_user_can('manage_options'))
			{
				wp_die(__('Cheatin&#8217; uh?'));
			}
	
        	// Render the settings template
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        }
    }
}