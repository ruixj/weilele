<?php

//postviews   
function get_post_views ($post_id) {   
  
    $count_key = 'views';   
    $count = get_post_meta($post_id, $count_key, true);   
  
    if ($count == '') {   
        delete_post_meta($post_id, $count_key);   
        add_post_meta($post_id, $count_key, '0');   
        $count = '0';   
    }   
  
    echo number_format_i18n($count);   
  
}   
  
function set_post_views () {   
  
    global $post;   
  
    $post_id = $post -> ID;   
    $count_key = 'views';   
    $count = get_post_meta($post_id, $count_key, true);   
  
    if (is_single() || is_page()) {   
  
        if ($count == '') {   
            delete_post_meta($post_id, $count_key);   
            add_post_meta($post_id, $count_key, '0');   
        } else {   
            update_post_meta($post_id, $count_key, $count + 1);   
        }   
  
    }   
  
}   
add_action('get_header', 'set_post_views');  

function responsiveboat_setup() {

	add_image_size('rb_latest_news_photo', 480, 480, true);

}
add_action('after_setup_theme', 'responsiveboat_setup');

/* Theme Customizer */
function responsiveboat_customize_register( $wp_customize ) {

	$responsiveboat_parent_theme = get_template();
	if( !empty($responsiveboat_parent_theme) && ($responsiveboat_parent_theme == 'zerif-pro') ):
	
		/* Remove About us section */
		$wp_customize->remove_panel('panel_6');
		
	else:
	
		/* Remove About us section and Contact us */
		$wp_customize->remove_panel('panel_about');
		$wp_customize->remove_section('zerif_aboutus_settings_section');
		$wp_customize->remove_section('zerif_aboutus_main_section');
		$wp_customize->remove_section('zerif_aboutus_feat1_section');
		$wp_customize->remove_section('zerif_aboutus_feat2_section');
		$wp_customize->remove_section('zerif_aboutus_feat3_section');
		$wp_customize->remove_section('zerif_aboutus_feat4_section');
		$wp_customize->remove_section('zerif_aboutus_clients_section');
		$wp_customize->remove_section('zerif_contactus_section');
		
	endif;

    /**************************************/
    /********** Big title image **********/
    /*************************************/
	
	if( !empty($responsiveboat_parent_theme) && ($responsiveboat_parent_theme == 'zerif-pro') ):
	
		$wp_customize->add_setting( 'rb_bigtitle_logo', array('sanitize_callback' => 'esc_url_raw' , 'default' => get_stylesheet_directory_uri().'/images/logo-small.png'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rb_bigtitle_logo', array(
			'label'    => __( 'Header Logo', 'responsiveboat' ),
			'section'  => 'zerif_bigtitle_texts_section',
			'priority'    => 7,
		)));
	
	else:
	
		$wp_customize->add_setting( 'rb_bigtitle_logo', array('sanitize_callback' => 'esc_url_raw' , 'default' => get_stylesheet_directory_uri().'/images/logo-small.png'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rb_bigtitle_logo', array(
			'label'    => __( 'Header Logo', 'responsiveboat' ),
			'section'  => 'zerif_bigtitle_section',
			'priority'    => 7,
		)));
	
	endif;

    /**************************************/
    /********   About me section *********/
    /*************************************/

    $wp_customize->add_section( 'rb_aboutyou_section' , array(
        'title'       => __( 'About you section', 'responsiveboat' ),
        'priority'    => 34
    ));

    /* about you show/hide */
    $wp_customize->add_setting( 'rb_aboutyou_show', array('sanitize_callback' => 'responsiveboat_sanitize_text'));
    $wp_customize->add_control(
        'rb_aboutyou_show',
        array(
            'type' => 'checkbox',
            'label' => __('Hide about you section?','responsiveboat'),
            'section' => 'rb_aboutyou_section',
            'priority'    => 1,
        )
    );

    /* title */
    $wp_customize->add_setting( 'rb_aboutyou_title', array('sanitize_callback' => 'responsiveboat_sanitize_text','default' => __('About you','responsiveboat')));
    $wp_customize->add_control( 'rb_aboutyou_title', array(
        'label'    => __( 'Title', 'responsiveboat' ),
        'section'  => 'rb_aboutyou_section',
        'priority'    => 2,
    ));

    /* subtitle */
    $wp_customize->add_setting( 'rb_aboutyou_subtitle', array('sanitize_callback' => 'responsiveboat_sanitize_text','default' => __('Use this section to showcase important details about you.','responsiveboat')));
    $wp_customize->add_control( 'rb_aboutyou_subtitle', array(
        'label'    => __( 'Subtitle', 'responsiveboat' ),
        'section'  => 'rb_aboutyou_section',
        'priority'    => 3,
    ));

    /* text */
    $wp_customize->add_setting( 'rb_aboutyou_text', array('sanitize_callback' => 'responsiveboat_sanitize_text','default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec massa enim. Aliquam viverra at est ullamcorper sollicitudin. Proin a leo sit amet nunc malesuada imperdiet pharetra ut eros.<br><br> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec massa enim. Aliquam viverra at est ullamcorper sollicitudin. Proin a leo sit amet nunc malesuada imperdiet pharetra ut eros. <br><br>Mauris vel nunc at ipsum fermentum pellentesque quis ut massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas non adipiscing massa. Sed ut fringilla sapien. Cras sollicitudin, lectus sed tincidunt cursus, magna lectus vehicula augue, a lobortis dui orci et est.','responsiveboat')));
    $wp_customize->add_control( 'rb_aboutyou_text', array(
        'label'    => __( 'Text', 'responsiveboat' ),
        'section'  => 'rb_aboutyou_section',
        'priority'    => 4,
    ));

    /* image */
    $wp_customize->add_setting( 'rb_aboutyou_image', array('sanitize_callback' => 'esc_url_raw' , 'default' => get_stylesheet_directory_uri().'/images/about.jpg'));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'rb_aboutyou_image', array(
        'label'    => __( 'Image', 'responsiveboat' ),
        'section'  => 'rb_aboutyou_section',
        'priority'    => 5,
    )));

}
add_action( 'customize_register', 'responsiveboat_customize_register', 20 );


function responsiveboat_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

add_action( 'wp_enqueue_scripts', 'responsiveboat_enqueue_styles' );
function responsiveboat_enqueue_styles() {

	wp_enqueue_style( 'responsiveboat-font', '//fonts.googleapis.com/css?family=Titillium+Web:400,300,300italic,200italic,200,400italic,600,600italic,700,700italic,900');

	wp_enqueue_style( 'responsiveboat-style', get_template_directory_uri() . '/style.css', array('zerif_bootstrap_style') );

}

function responsiveboat_custom_script_fix1()
{
	wp_enqueue_script('responsiveboat-script', get_stylesheet_directory_uri() . '/js/responsive_boat_script.js', array(), '201202067', true);
}
add_action( 'wp_enqueue_scripts', 'responsiveboat_custom_script_fix1' );

function responsiveboat_remove_style_child(){
	remove_action('wp_print_scripts','zerif_php_style');
}

add_action( 'wp_enqueue_scripts', 'responsiveboat_remove_style_child', 100 );

/* get first image from a post content or get a default image */
function responsiveboat_get_first_image_from_post() {

	global $post, $posts;

	$zerif_first_img = '';
	ob_start();
	ob_end_clean();

	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $zerif_matches);

	if( !empty($zerif_matches[1][0]) ):
		$zerif_first_img = '<img src="'.$zerif_matches[1][0].'">';
	endif;

	if(empty($zerif_first_img)):
		$zerif_first_img = '<img src="'.get_template_directory_uri().'/images/blank-latestposts.png'.'">';
	endif;

	return $zerif_first_img;

}
