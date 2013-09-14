<?php
	define('WP_USE_THEMES', false);
	require('../../../wp-blog-header.php');
	header('Content-type: text/javascript');
?>
jQuery(document).ready(function(){
	var $ = jQuery;

	$(window).konami({  
		cheat: function() {
			<?php echo get_option('axalian_konamicode_jquery_action') . PHP_EOL; ?>
		}
	});
});