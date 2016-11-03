<?php

function lawyeria_lite_customizer( $wp_customize ) {

	class lawyeria_lite_Theme_Support extends WP_Customize_Control
	{
		public function render_content()
		{

		}

	} 


    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	
	
	
	/* theme notes */
	$wp_customize->add_section( 'lawyeria_lite_theme_notes' , array(
		'title'      => __('ThemeIsle theme notes','lawyeria-lite'),
		'description' => __( 'Thank you for being part of this! We\'ve spent almost 6 months building ThemeIsle without really knowing if anyone will ever use a theme or not, so we\'re very grateful that you\'ve decided to work with us. Wanna <a href="http://themeisle.com/contact/" target="_blank">say hi</a>?
		<br/><br/> <a href="http://demo.themeisle.com/lawyeria-lite/" target="_blank"> View Theme Demo</a> | 
		<a href="http://themeisle.com/forums/forum/lawyeria-lite" target="_blank">Get theme support</a><br/><br/><a href="http://themeisle.com/documentation-lawyeria-lite" target="_blank">Documentation</a><br><br><a href="https://themeisle.com/themes/lawyeria-attorney-lawyer-wordpress-theme/" target="_blank" style="color:red;">Upgrade to PRO</a> ','lawyeria-lite'),
		'priority'   => 30,
	));
	$wp_customize->add_setting(
        'lawyeria_lite_theme_notes',  array('sanitize_callback' => 'lawyeria_lite_sanitize_none')
	);
	 $wp_customize->add_control( new lawyeria_lite_Theme_Support( $wp_customize, 'lawyeria_lite_theme_notes',
	    array(
	        'section' => 'lawyeria_lite_theme_notes',
	   )
	));
	
	/*         Unlimited colors */
	$wp_customize->add_section( 'lawyeria_lite_unlimited_colors' , array(
		'title'      => __('Unlimited colors','lawyeria-lite'),
		'description' => __( ' Check out the <a href="https://themeisle.com/themes/lawyeria-attorney-lawyer-wordpress-theme/" target="_blank" style="color:red;">PRO version</a> <br>for full control over the color scheme !  ','lawyeria-lite'),
		'priority'   => 50,
	));
	$wp_customize->add_setting(
        'lawyeria_lite_unlimited_colors',  array('sanitize_callback' => 'lawyeria_lite_sanitize_none')
	);
	 $wp_customize->add_control( new lawyeria_lite_Theme_Support( $wp_customize, 'lawyeria_lite_unlimited_colors',
	    array(
	        'section' => 'lawyeria_lite_unlimited_colors',
	   )
	));
	

    /*
    ** Header Customizer
    */
    $wp_customize->add_section( 'lawyeria_lite_header_section' , array(
    	'title'       => __( 'Header', 'lawyeria-lite' ),
    	'priority'    => 200,
	) );

		/* Header - Logo */
		$wp_customize->add_setting( 'lawyeria_lite_header_logo',
        array('sanitize_callback' => 'esc_url_raw', 'default' => get_template_directory_uri() .'/images/header-logo.png') );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lawyeria_lite_header_logo', array(
		    'label'    => __( 'Logo:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_header_section',
		    'settings' => 'lawyeria_lite_header_logo',
		    'priority' => '1',
		) ) );

		/* Header - Title */
		$wp_customize->add_setting( 'lawyeria_lite_header_title' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => __('Contact us now','lawyeria-lite')));
		$wp_customize->add_control( 'lawyeria_lite_header_title', array(
		    'label'    => __( 'Contact Title:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_header_section',
		    'settings' => 'lawyeria_lite_header_title',
			'priority' => '2',
		) );

		/* Header - Subtitle */
		$wp_customize->add_setting( 'lawyeria_lite_header_subtitle' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => '+1-888-846-1732'));
		$wp_customize->add_control( 'lawyeria_lite_header_subtitle', array(
		    'label'    => __( 'Contact telephone:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_header_section',
		    'settings' => 'lawyeria_lite_header_subtitle',
			'priority' => '3',
		) );

    /*
    ** Front Page Customizer
    */
    $wp_customize->add_section( 'lawyeria_lite_frontpage_section' , array(
    	'title'       => __( 'Front Page', 'lawyeria-lite' ),
    	'priority'    => 250,
	) );

		/* Front Page - SubHeader Title */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_header_title' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text','default' => __( 'Lorem ipsum dolor sit amet, consectetur adipscing elit.', 'lawyeria-lite' )));
		$wp_customize->add_control( 'lawyeria_lite_frontpage_header_title', array(
		    'label'    => __( 'Subheader Title:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_header_title',
			'priority' => '3',
		) );

		/* Front Page - SubHeader Content */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_header_content' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text','default' => __( 'Ut fermentum aliquam neque, sit amet molestie orci porttitor sit amet. Mauris venenatis et tortor ut ultrices. Nam a neque venenatis, tristique lacus id, congue augue. In id tellus lacus. In porttitor sagittis tellus nec iaculis. Nunc sem odio, placerat a diam vel, varius.', 'lawyeria-lite' )));
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'lawyeria_lite_frontpage_header_content', array(
		            'label' 	=> __( 'Subheader Content:', 'lawyeria-lite' ),
		            'section' 	=> 'lawyeria_lite_frontpage_section',
		            'settings' 	=> 'lawyeria_lite_frontpage_header_content',
		            'priority' 	=> '4'
		        )
		    )
		);

		/* Front Page - Quote */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_subheader_title' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => __( 'Lorem Ipsum is simply dummy text of the printing and type setting industry.', 'lawyeria-lite' )));
		$wp_customize->add_control( 'lawyeria_lite_frontpage_subheader_title', array(
		    'label'    => __( 'Quote:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_subheader_title',
			'priority' => '5',
		) );

		/* Front Page - Subheader Background */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_subheader_bg', array('default' => get_template_directory_uri() . "/images/full-header.jpg", 'sanitize_callback' => 'esc_url_raw') );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lawyeria_lite_frontpage_subheader_bg', array(
		    'label'    => __( 'Subheader Background:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_subheader_bg',
		    'priority' => '6',
		) ) );

		/* Front Page - Firstly Box - Icon */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_firstlybox_icon' ,
        array('default' => get_template_directory_uri().'/images/features-box-icon-one.png','sanitize_callback' => 'esc_url_raw'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lawyeria_lite_frontpage_firstlybox_icon', array(
		    'label'    => __( 'Box (first) - Icon:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_firstlybox_icon',
		    'priority' => '7',
		) ) );

		/* Front Page - Firstly Box - Title */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_firstlybox_title' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text','default' => __('Lorem','lawyeria-lite')));
		$wp_customize->add_control( 'lawyeria_lite_frontpage_firstlybox_title', array(
		    'label'    => __( 'Box (first) - Title:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_firstlybox_title',
			'priority' => '8',
		) );

		/* Front Page - Firstly Box - Content */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_firstlybox_content' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' =>  __( 'Go to Appearance - Customize, to add content.', 'lawyeria-lite' )));
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'lawyeria_lite_frontpage_firstlybox_content', array(
		            'label' 	=> __( 'Box (first) - Content:', 'lawyeria-lite' ),
		            'section' 	=> 'lawyeria_lite_frontpage_section',
		            'settings' 	=> 'lawyeria_lite_frontpage_firstlybox_content',
		            'priority' 	=> '9'
		        )
		    )
		);

		/* Front Page - Secondly Box - Icon */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_secondlybox_icon' ,
        array('default' => get_template_directory_uri().'/images/features-box-icon-two.png','sanitize_callback' => 'esc_url_raw'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lawyeria_lite_frontpage_secondlybox_icon', array(
		    'label'    => __( 'Box (two) - Icon:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_secondlybox_icon',
		    'priority' => '10',
		) ) );

		/* Front Page - Secondly Box - Title */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_secondlybox_title' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => __( 'Ipsum', 'lawyeria-lite' )));
		$wp_customize->add_control( 'lawyeria_lite_frontpage_secondlybox_title', array(
		    'label'    => __( 'Box (two) - Title:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_secondlybox_title',
			'priority' => '11',
		) );

		/* Front Page - Secondly Box - Content */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_secondlybox_content' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => __( 'Go to Appearance - Customize, to add content.', 'lawyeria-lite' )));
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'lawyeria_lite_frontpage_secondlybox_content', array(
		            'label' 	=> __( 'Box (two) - Content:', 'lawyeria-lite' ),
		            'section' 	=> 'lawyeria_lite_frontpage_section',
		            'settings' 	=> 'lawyeria_lite_frontpage_secondlybox_content',
		            'priority' 	=> '12'
		        )
		    )
		);

		/* Front Page - Thirdly Box - Icon */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_thirdlybox_icon' ,
        array('default' => get_template_directory_uri().'/images/features-box-three.png','sanitize_callback' => 'esc_url_raw'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lawyeria_lite_frontpage_thirdlybox_icon', array(
		    'label'    => __( 'Box (three) - Icon:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_thirdlybox_icon',
		    'priority' => '13',
		) ) );

		/* Front Page - Thirdly Box - Title */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_thirdlybox_title' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => __( 'Dolor', 'lawyeria-lite' )));
		$wp_customize->add_control( 'lawyeria_lite_frontpage_thirdlybox_title', array(
		    'label'    => __( 'Box (three) - Title:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_thirdlybox_title',
			'priority' => '14',
		) );

		/* Front Page - Thirdly Box - Content */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_thirdlybox_content' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => __( 'Go to Appearance - Customize, to add content.', 'lawyeria-lite' )));
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'lawyeria_lite_frontpage_thirdlybox_content', array(
		            'label' 	=> __( 'Box (three) - Content:', 'lawyeria-lite' ),
		            'section' 	=> 'lawyeria_lite_frontpage_section',
		            'settings' 	=> 'lawyeria_lite_frontpage_thirdlybox_content',
		            'priority' 	=> '15'
		        )
		    )
		);

		/* Front Page - The Content - Image */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_thecontent_image' ,
        array('default' => get_template_directory_uri().'/images/content-article-image.png','sanitize_callback' => 'esc_url_raw'));
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'lawyeria_lite_frontpage_thecontent_image', array(
		    'label'    => __( 'The Content - Image:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_thecontent_image',
		    'priority' => '16',
		) ) );

		/* Front Page - The Content - Title */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_thecontent_title' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => __( 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis.', 'lawyeria-lite' )));
		$wp_customize->add_control( 'lawyeria_lite_frontpage_thecontent_title', array(
		    'label'    => __( 'The Content - Title:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_frontpage_section',
		    'settings' => 'lawyeria_lite_frontpage_thecontent_title',
			'priority' => '17',
		) );

		/* Front Page - The Content - Content */
		$wp_customize->add_setting( 'lawyeria_lite_frontpage_thecontent_content' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => __( 'Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.', 'lawyeria-lite' )));
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'lawyeria_lite_frontpage_thecontent_content', array(
		            'label' 	=> __( 'The Content - Content:', 'lawyeria-lite' ),
		            'section' 	=> 'lawyeria_lite_frontpage_section',
		            'settings' 	=> 'lawyeria_lite_frontpage_thecontent_content',
		            'priority' 	=> '18'
		        )
		    )
		);
		
		
		
		
			/*    Frontpage widgets */
		$wp_customize->add_section( 'lawyeria_lite_frontpage_widget' , array(
			'title'      => __('Frontpage widgets','lawyeria-lite'),
			'description' => __( ' Check out the <a href="https://themeisle.com/themes/lawyeria-attorney-lawyer-wordpress-theme/" target="_blank" style="color:red;">PRO version</a> <br>for custom widgets like "Practice Area", "Our Lawyers" and "Testimonials"!  ','lawyeria-lite'),
			'priority'   => 430,
		));
		$wp_customize->add_setting(
			'lawyeria_lite_frontpage_widget',  array('sanitize_callback' => 'lawyeria_lite_sanitize_none')
		);
		 $wp_customize->add_control( new lawyeria_lite_Theme_Support( $wp_customize, 'lawyeria_lite_frontpage_widget',
			array(
				'section' => 'lawyeria_lite_frontpage_widget',
		   )
		));
		
		
		
		

    /*
    ** 404 Customizer
    */
    $wp_customize->add_section( 'lawyeria_lite_404_section' , array(
    	'title'       => __( '404 Page', 'lawyeria-lite' ),
    	'priority'    => 450,
	) );

		/* 404 - Title */
		$wp_customize->add_setting( 'lawyeria_lite_404_title' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => __( '404 Error', 'lawyeria-lite' )));
		$wp_customize->add_control( 'lawyeria_lite_404_title', array(
		    'label'    => __( '404 - Title:', 'lawyeria-lite' ),
		    'section'  => 'lawyeria_lite_404_section',
		    'settings' => 'lawyeria_lite_404_title',
			'priority' => '1',
		) );

		/* 404 - Content */
		$wp_customize->add_setting( 'lawyeria_lite_404_content' ,
        array('sanitize_callback' => 'lawyeria_lite_sanitize_text', 'default' => __( 'Oops, I screwed up and you discovered my fatal flaw. Well, we\'re not all perfect, but we try.  Can you try this again or maybe visit our <a title="themeIsle" href="'. home_url() .'">Home Page</a> to start fresh.  We\'ll do better next time.', 'lawyeria-lite' )));
		$wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'lawyeria_lite_404_content', array(
		            'label' 	=> __( '404 - Content', 'lawyeria-lite' ),
		            'section' 	=> 'lawyeria_lite_404_section',
		            'settings' 	=> 'lawyeria_lite_404_content',
		            'priority' 	=> '2'
		        )
		    )
		);
		
		function lawyeria_lite_sanitize_text( $input ) {
			return wp_kses_post( force_balance_tags( $input ) );
		}

		function lawyeria_lite_sanitize_none( $input ) {
			return $input;
		}
		function laweria_lite_sanitize_shortcode( $input ) {
			return force_balance_tags( $input );
		}

}
add_action( 'customize_register', 'lawyeria_lite_customizer' );

/**

 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.

 */

function lawyeria_lite_customize_preview_js() {

	wp_enqueue_script( 'lawyeria_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );

}

add_action( 'customize_preview_init', 'lawyeria_lite_customize_preview_js' );

if( class_exists( 'WP_Customize_Control' ) ):
	class Example_Customize_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';

	    public function render_content() { ?>

	        <label>
	        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        	<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>

	        <?php
	    }
	}
endif;


function lawyeria_lite_registers() {


	wp_register_script( 'lawyeria_lite_customizer_buttons', get_template_directory_uri() . '/js/lawyeria_lite_customizer.js', array("jquery"), '20120206', true  );

	wp_enqueue_script( 'lawyeria_lite_customizer_buttons' );
	
	wp_localize_script( 'lawyeria_lite_customizer_buttons', 'objectL10n', array(
		
		'documentation' => __( 'Documentation', 'lawyeria-lite' ),
		'pro' => __('View PRO version','lawyeria-lite'),
		'review' => __('Leave a review ( it will help us )','lawyeria-lite')
		
	) );

}

add_action( 'customize_controls_enqueue_scripts', 'lawyeria_lite_registers' );

?>
