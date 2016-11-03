<?php
function jovial_remove_default_widgets() {
	if (function_exists('unregister_widget')) {
		unregister_widget('WP_Widget_Search');
	}
}
add_action('widgets_init', 'jovial_remove_default_widgets');
?>