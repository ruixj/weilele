<?php

add_action( 'wp_enqueue_scripts', 'juridica_enqueue_styles' );

function juridica_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

function juridica_custom_script_fix() {
   
	wp_enqueue_script('juridica-nicescroll',get_stylesheet_directory_uri().'/js/jquery.nicescroll.js',array('jquery'),'12121',true);
    wp_enqueue_script('juridica-scripts',get_stylesheet_directory_uri().'/js/juridica-scripts.js',array('jquery','juridica-nicescroll'),'12121',true);	
}

add_action( 'wp_enqueue_scripts', 'juridica_custom_script_fix', 100 );

function juridica_inline_styles() {
	?>
	<style type="text/css">

		<?php if(is_front_page()): ?>
		.wrap-elements {
		  position: absolute !important;
		}
		<?php else: ?>
		.wrap-elements {
		 position: relative !important;
		}
		<?php endif; ?>
	</style>
		
	<?php
}

add_action("wp_print_scripts","juridica_inline_styles");

/**
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function juridica_theme_setup() {
    load_child_theme_textdomain( 'juridica', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'juridica_theme_setup' );