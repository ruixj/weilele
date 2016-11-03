<?php

/**

 * zerif functions and definitions

 *

 * @package zerif

 */



/**

 * Set the content width based on the theme's design and stylesheet.

 */

if ( ! isset( $content_width ) ) {

	$content_width = 640; /* pixels */

}



if ( ! function_exists( 'zerif_setup' ) ) :

/**

 * Sets up theme defaults and registers support for various WordPress features.

 *

 * Note that this function is hooked into the after_setup_theme hook, which

 * runs before the init hook. The init hook is too late for some features, such

 * as indicating support for post thumbnails.

 */

function zerif_setup() {



	/*

	 * Make theme available for translation.

	 * Translations can be filed in the /languages/ directory.

	 */

	load_theme_textdomain( 'zerif', get_template_directory() . '/languages' );



	// Add default posts and comments RSS feed links to head.

	add_theme_support( 'automatic-feed-links' );



	/*

	 * Enable support for Post Thumbnails on posts and pages.

	 *

	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails

	 */

	add_theme_support( 'post-thumbnails' );



	/* Set the image size by cropping the image */

	add_image_size( 'zerif-testimonial', 73, 73, true );
	add_image_size( 'zerif-clients', 130, 50, true );
	add_image_size( 'zerif-our-focus', 150, 150, true );
	add_image_size( 'zerif_our_team_photo', 174, 174, true );
	add_image_size( 'zerif_project_photo', 285, 214, true );
	add_image_size( 'post-thumbnail', 250, 250, true );
    add_image_size( 'post-thumbnail-large', 750, 500, true ); /* blog thumbnail */
    add_image_size( 'post-thumbnail-large-table', 600, 300, true ); /* blog thumbnail for table */
    add_image_size( 'post-thumbnail-large-mobile', 400, 200, true ); /* blog thumbnail for mobile */
	
	// This theme uses wp_nav_menu() in one location.

	register_nav_menus( array(

		'primary' => __( 'Primary Menu', 'zerif' ),

	) );



	// Enable support for Post Formats.

	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );



	// Setup the WordPress core custom background feature.

	add_theme_support( 'custom-background', apply_filters( 'wp_themeisle_custom_background_args', array(

		'default-color' => 'ffffff',

		'default-image' => '',

	) ) );



	// Enable support for HTML5 markup.

	add_theme_support( 'html5', array(

		'comment-list',

		'search-form',

		'comment-form',

		'gallery',

	) );
	
	/* woocommerce support */
	add_theme_support( 'woocommerce' );
	
	/* Enable support for title-tag */
	add_theme_support( 'title-tag' );
	
	/***********************************/
	/**************  HOOKS *************/
	/***********************************/
	
	require get_template_directory() . '/inc/hooks.php'; # Enables user customization via WordPress plugin API
	
	add_action( 'zerif_404_title', 'zerif_404_title_function' ); # Outputs the title on 404 pages
	add_action( 'zerif_404_content', 'zerif_404_content_function' ); # Outputs a helpful message on 404 pages

	add_action( 'zerif_page_header', 'zerif_page_header_function' );
	add_action( 'zerif_portfolio_header', 'zerif_portfolio_header_function' );

}

endif; 

add_action( 'after_setup_theme', 'zerif_setup' );

add_filter('image_size_names_choose', 'zerif_image_sizes'); 
	
function zerif_image_sizes($sizes) {
		
	$zerif_addsizes = array( "zerif-our-focus" => __( "Our focus","zerif"), "zerif_our_team_photo" => __("Our team","zerif"), "zerif-testimonial" => __("Testimonial", "zerif"), "zerif-clients" => __("Client logo","zerif") ); 
	$zerif_newsizes = array_merge($sizes, $zerif_addsizes); 
	return $zerif_newsizes; 
		
}

/* custom posts type */



add_action( 'init', 'zerif_create_post_type' );



function zerif_create_post_type() {

	/* portfolio */

	register_post_type( 'portofolio',

						array(

							'labels' => array(

							'name' => __( 'Portfolio','zerif' ),

							'singular_name' => __( 'Portfolio','zerif' )

						),

						'public' => true,

						'has_archive' => true,

						'taxonomies' => array('category'),

						'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),

						'show_ui' => true,
						
						'rewrite' => array( 'slug' => 'portfolio' ),

						)

	);
}

add_action('init', 'zerif_flush');

function zerif_flush () {
	if ( ! get_option( 'zerif_flush_rewrite_rules_flag' ) ) {
		flush_rewrite_rules();
		add_option( 'zerif_flush_rewrite_rules_flag', true );
	}	
}

/**

 * Register widgetized area and update sidebar with default widgets.

 */

function zerif_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'zerif' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Our focus section widgets', 'zerif' ),
		'id'            => 'sidebar-ourfocus',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	register_sidebar( array(
		'name'          => __( 'Testimonials section widgets', 'zerif' ),
		'id'            => 'sidebar-testimonials',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'About us section widgets', 'zerif' ),
		'id'            => 'sidebar-aboutus',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Our team section widgets', 'zerif' ),
		'id'            => 'sidebar-ourteam',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Packages section widgets', 'zerif' ),
		'id'            => 'sidebar-packages',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Subscribe section widgets', 'zerif' ),
		'id'            => 'sidebar-subscribe',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebars( 
		3, 
		array(
			'name' 			=> __('Footer area %d','zerif'),
			'id'            => 'zerif-sidebar-footer',
			'before_widget' => '<aside id="%1$s" class="widget footer-widget-footer %2$s">',
			'after_widget'  => '</aside>',
			'before_title'	=> '<h1 class="widget-title">',
			'after_title'	=> '</h1>'
		) 
	);

}

add_action( 'widgets_init', 'zerif_widgets_init' );



/**

 * Enqueue scripts and styles.

 */

function zerif_scripts() {
	
	/*****************/
	/**** STYLES ****/
	/****************/

	wp_enqueue_style( 'zerif_font', '//fonts.googleapis.com/css?family=Lato:300,400,700,400italic|Montserrat:700|Homemade+Apple');

	wp_enqueue_style( 'zerif_font_all', '//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600italic,600,700,700italic,800,800italic');

	/* Bootstrap style */
	
	wp_enqueue_style( 'zerif_bootstrap_style', get_template_directory_uri() . '/css/bootstrap.min.css');

	/* Font awesome */
	
	wp_enqueue_style( 'zerif_font-awesome_style', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), 'v1');
	
	/* Main stylesheet */

	wp_enqueue_style( 'zerif_style', get_stylesheet_uri(), array('zerif_font-awesome_style','zerif_bootstrap_style'),'v1' );

	if ( wp_is_mobile() ){
		
		wp_enqueue_style( 'zerif_style_mobile', get_template_directory_uri() . '/css/style-mobile.css', array('zerif_font-awesome_style','zerif_bootstrap_style', 'zerif_style'),'v1' );
	
	}

	/*****************/
	/**** SCRIPTS ****/
	/****************/

	/* Bootstrap script */
	
	wp_enqueue_script( 'zerif_bootstrap_script', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '20120206', true  );

	if( is_home() ):
	
		/* Knob script */
		wp_enqueue_script( 'zerif_knob_nav', get_template_directory_uri() . '/js/jquery.knob.min.js', array("jquery"), '20120206', true  );
		
	    /* Smootscroll script */
	    $zerif_disable_smooth_scroll = get_theme_mod('zerif_disable_smooth_scroll');
	    if( isset($zerif_disable_smooth_scroll) && ($zerif_disable_smooth_scroll != 1)):
	        wp_enqueue_script( 'zerif_smoothscroll', get_template_directory_uri() . '/js/smoothscroll.min.js', array("jquery"), '20120206', true  );
	    endif;

	endif;

	/* scrollReveal script */
	if ( !wp_is_mobile() ){
		
		wp_enqueue_script( 'zerif_scrollReveal_script', get_template_directory_uri() . '/js/scrollReveal.min.js', array("jquery"), '20120206', true  );

	}
	
	/* zerif script */
	if ( !wp_is_mobile() ){

		/* parallax effect */
	    wp_enqueue_script( 'zerif_parallax', get_template_directory_uri() . '/js/parallax.js', array("jquery"), 'v1', true );
		wp_enqueue_script( 'zerif_script', get_template_directory_uri() . '/js/zerif.js', array('zerif_parallax'), '20120206', true  );

	}else{

		wp_enqueue_script( 'zerif_script', get_template_directory_uri() . '/js/zerif.js', array(), '20120206', true  );

	}



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {

		wp_enqueue_script( 'comment-reply' );

	}

}

add_action( 'wp_enqueue_scripts', 'zerif_scripts' );

/**

 * Custom template tags for this theme.

 */


get_template_part( 'inc/template-tags' );


/**

 * Customizer additions.

 */

get_template_part( 'inc/customizer' );


get_template_part( 'inc/category-dropdown-custom-control' );


/* tgm-plugin-activation */



require_once get_template_directory() . '/class-tgm-plugin-activation.php';



add_action( 'tgmpa_register', 'zerif_register_required_plugins' );



function zerif_register_required_plugins() {

 

	$wp_version_nr = get_bloginfo('version');
	
	if( $wp_version_nr < 3.9 ):

		$plugins = array(


			array(

				'name' => 'Widget customizer',

				'slug' => 'widget-customizer', 

				'required' => false 

			),

			array(
	 
				'name'      => 'WP Product Review',
	 
				'slug'      => 'wp-product-review',
	 
				'required'  => false,
	 
			),

			array(
	 
				'name'      => 'Revive Old Post (Former Tweet Old Post)',
	 
				'slug'      => 'tweet-old-post',
	 
				'required'  => false,
	 
			)

		);
		
	else:

		$plugins = array(

			array(
	 
				'name'      => 'WP Product Review',
	 
				'slug'      => 'wp-product-review',
	 
				'required'  => false,
	 
			),

			array(
	 
				'name'      => 'Revive Old Post (Former Tweet Old Post)',
	 
				'slug'      => 'tweet-old-post',
	 
				'required'  => false,
	 
			)

		);

	
	endif;

 

	$theme_text_domain = 'zerif';



	

	$config = array(

        'default_path' => '',                      

        'menu'         => 'tgmpa-install-plugins', 

        'has_notices'  => true,                   

        'dismissable'  => true,                  

        'dismiss_msg'  => '',                   

        'is_automatic' => false,                 

        'message'      => '',     

        'strings'      => array(

            'page_title'                      => __( 'Install Required Plugins', $theme_text_domain ),

            'menu_title'                      => __( 'Install Plugins', $theme_text_domain ),

            'installing'                      => __( 'Installing Plugin: %s', $theme_text_domain ), 

            'oops'                            => __( 'Something went wrong with the plugin API.', $theme_text_domain ),

            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),

            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),

            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),

            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),

            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),

            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), 

            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), 

            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), 

            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),

            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),

            'return'                          => __( 'Return to Required Plugins Installer', $theme_text_domain ),

            'plugin_activated'                => __( 'Plugin activated successfully.', $theme_text_domain ),

            'complete'                        => __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), 

            'nag_type'                        => 'updated'

        )

    );

 

	tgmpa( $plugins, $config );

 

}



/**

 * Load Jetpack compatibility file.

 */

require get_template_directory() . '/inc/jetpack.php';

function zerif_wp_page_menu() {

	echo '<ul class="nav navbar-nav navbar-right responsive-nav main-nav-list">';

		wp_list_pages(array('title_li'     => '', 'depth' => 1 ));

	echo '</ul>';

}



function zerif_add_editor_styles() {

    add_editor_style( '/css/custom-editor-style.css' );

}

add_action( 'init', 'zerif_add_editor_styles' );


add_filter( 'the_title', 'zerif_default_title' );

function zerif_default_title( $title ) {

	if($title == '') {

		$title = __("Default title","zerif");
		
	}	

	return $title;

}



/*****************************************/

/******          WIDGETS     *************/

/*****************************************/



add_action('widgets_init', 'zerif_register_widgets');

function zerif_register_widgets() {

	register_widget( 'zerif_ourfocus' );
	register_widget( 'zerif_testimonial_widget' );
	register_widget( 'zerif_clients_widget' );
	register_widget( 'zerif_team_widget' );
	register_widget( 'zerif_packages' );


}


/**************************/

/****** our focus widget */

/************************/


class zerif_ourfocus extends WP_Widget
{
    /**
     * Constructor
     **/
    public function __construct()
    {
		
		$widget_ops = array('classname' => 'ctUp-ads');

        parent::__construct( 'ctUp-ads-widget', 'Zerif - Our focus widget', $widget_ops );

        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
        add_action('admin_enqueue_styles', array($this, 'upload_styles'));
    }

    /**
     * Upload the Javascripts for the media uploader
     */
    public function upload_scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('upload_media_widget', get_template_directory_uri() . '/js/zerif-upload-media.js');
    }

    /**
     * Add the styles for the upload media box
     */
    public function upload_styles()
    {
        wp_enqueue_style('thickbox');
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget($args, $instance) {
        extract($args);
		
		$zerif_focus_target = '_self';
		if( !empty($instance['focus_open_new_window']) ):
			$zerif_focus_target = '_blank';
		endif;
		
?>
	
		<div class="col-lg-3 col-sm-3 focus-box" data-scrollreveal="enter left after 0.15s over 1s">
			<div class="service-icon">
				<?php if( !empty($instance['image_uri']) ): ?>
				<?php if( !empty($instance['link']) ): ?>
				
					<a target="<?php echo $zerif_focus_target; ?>" href="<?php echo $instance['link']; ?>" ><i class="pixeden our-focus-widget-image" style="background:url(<?php echo esc_url($instance['image_uri']); ?>) no-repeat center;"></i> <!-- FOCUS ICON--></a>
				
				<?php else: ?>
				
					<i class="pixeden our-focus-widget-image" style="background:url(<?php if( !empty($instance['image_uri']) ): echo esc_url($instance['image_uri']); endif; ?>) no-repeat center;"></i> <!-- FOCUS ICON-->
				
				<?php endif; ?>
				<?php endif; ?>
			</div>
			<h5 class="red-border-bottom"><?php if( !empty($instance['title']) ): echo apply_filters('widget_title', $instance['title'] ); endif; ?></h5> <!-- FOCUS HEADING -->
			<p>
				<?php if( !empty($instance['text']) ): echo htmlspecialchars_decode(apply_filters('widget_title', $instance['text'] )); endif; ?>
			</p>
		</div>
<?php
    }
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['text'] = stripslashes(wp_filter_post_kses( $new_instance['text'] ));
		$instance['link'] = strip_tags( $new_instance['link'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
		$instance['focus_open_new_window'] = strip_tags($new_instance['focus_open_new_window']);
        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void
     **/
    public function form( $instance )
    {
        ?>
		
		<p>

			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php if( !empty($instance['title']) ): echo $instance['title']; endif; ?>" class="widefat" />

		</p>

		<p>

			<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text','zerif'); ?></label><br />
			
			<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name('text'); ?>"
                      id="<?php echo $this->get_field_id('text'); ?>"><?php
                        if( !empty($instance['text']) ): echo htmlspecialchars_decode($instance['text']); endif;
            ?></textarea>

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" value="<?php if( !empty($instance['link']) ): echo $instance['link']; endif; ?>" class="widefat" />

		</p>
		
		<p>
			<input type="hidden" name="<?php echo $this->get_field_name('focus_open_new_window'); ?>" value="0" />
			<input type="checkbox" name="<?php echo $this->get_field_name('focus_open_new_window'); ?>" id="<?php echo $this->get_field_id('focus_open_new_window'); ?>" <?php if( !empty($instance['focus_open_new_window']) ): checked( (bool) $instance['focus_open_new_window'], true ); endif; ?> ><?php _e( 'Open link in new window?','zerif' ); ?><br>
		</p>

        <p>
            <label for="<?php echo $this->get_field_name( 'image_uri' ); ?>"><?php _e( 'Image:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'image_uri' ); ?>" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" class="widefat" type="text" size="36"  value="<?php if( !empty($instance['image_uri']) ): echo esc_url( $instance['image_uri'] ); endif; ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>
    <?php
    }
}


/****************************/

/****** testimonial widget **/

/***************************/


class zerif_testimonial_widget extends WP_Widget {

	/**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array('classname' => 'zerif_testim');

        parent::__construct( 'zerif_testim-widget', 'Zerif - Testimonial widget', $widget_ops );

        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
        add_action('admin_enqueue_styles', array($this, 'upload_styles'));
    }

    /**
     * Upload the Javascripts for the media uploader
     */
    public function upload_scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('upload_media_widget', get_template_directory_uri() . '/js/zerif-upload-media.js');
    }

    /**
     * Add the styles for the upload media box
     */
    public function upload_styles()
    {
        wp_enqueue_style('thickbox');
    }
	
    function widget($args, $instance) {

        extract($args);

?>



		<div class="feedback-box">

			<!-- MESSAGE OF THE CLIENT -->

			<div class="message">

				<?php if( !empty($instance['text']) ): echo htmlspecialchars_decode(apply_filters('widget_title', $instance['text'] )); endif; ?>

			</div>

			<!-- CLIENT INFORMATION -->

			<div class="client">

				<div class="quote red-text">
				
					<i class="fa fa-quote-left"></i>

				</div>

				<div class="client-info">

					<a class="client-name" target="_blank" <?php if( !empty($instance['link']) ): echo 'href="'.esc_url($instance['link']).'"'; endif; ?>><?php if( !empty($instance['title']) ): echo apply_filters('widget_title', $instance['title'] ); endif; ?></a>

					<div class="client-company">

						<?php 
						if( !empty($instance['details']) ):
							echo apply_filters('widget_title', $instance['details'] ); 
						endif;	
						?>

					</div>

				</div>

				<?php

					echo '<div class="client-image hidden-xs">';
						
						if( !empty($instance['image_uri']) ):
							if( !empty($instance['title']) ):			
								echo '<img src="'.esc_url($instance['image_uri']).'" alt="'.apply_filters('widget_title', $instance['title'] ).'">';
							else:
								echo '<img src="'.esc_url($instance['image_uri']).'" alt="'.__( 'Testimonial','zerif' ).'">';
							endif;
							
						endif;	

					echo '</div>';

				?>

			</div> <!-- / END CLIENT INFORMATION-->

		</div> <!-- / END SINGLE FEEDBACK BOX-->





<?php


    }



    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['text'] = stripslashes(wp_filter_post_kses($new_instance['text']));

		$instance['title'] = strip_tags( $new_instance['title'] );
	
		$instance['link'] = strip_tags( $new_instance['link'] );

		$instance['details'] = strip_tags( $new_instance['details'] );

        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );

        return $instance;

    }



    function form($instance) {

?>



	<p>

        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Author','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php if( !empty($instance['title']) ): echo $instance['title']; endif; ?>" class="widefat" />

    </p>
    
	<p>

        <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Author link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" value="<?php if( !empty($instance['link']) ): echo $instance['link']; endif; ?>" class="widefat" />

    </p>

	<p>

        <label for="<?php echo $this->get_field_id('details'); ?>"><?php _e('Author details','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('details'); ?>" id="<?php echo $this->get_field_id('details'); ?>" value="<?php if( !empty($instance['details']) ): echo $instance['details']; endif; ?>" class="widefat" />

    </p>

    <p>

        <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text','zerif'); ?></label><br />
		
		<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>" value="<?php if( !empty($instance['text']) ): echo $instance['text']; endif; ?>"><?php if( !empty($instance['text']) ): echo htmlspecialchars_decode($instance['text']); endif; ?></textarea>

    </p>

	<p>
		<label for="<?php echo $this->get_field_name( 'image_uri' ); ?>"><?php _e( 'Image:' ); ?></label>
        <input name="<?php echo $this->get_field_name( 'image_uri' ); ?>" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" class="widefat" type="text" size="36"  value="<?php if( !empty($instance['image_uri']) ): echo esc_url( $instance['image_uri'] ); endif; ?>" />
        <input class="upload_image_button" type="button" value="Upload Image" />
	</p>



<?php

    }

}


/****************************/

/****** clients widget ******/

/***************************/


class zerif_clients_widget extends WP_Widget {

	 /**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array('classname' => 'zerif_clients');

        parent::__construct( 'zerif_clients-widget', 'Zerif - Clients widget', $widget_ops );

        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
        add_action('admin_enqueue_styles', array($this, 'upload_styles'));
    }

    /**
     * Upload the Javascripts for the media uploader
     */
    public function upload_scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('upload_media_widget', get_template_directory_uri() . '/js/zerif-upload-media.js');
    }

    /**
     * Add the styles for the upload media box
     */
    public function upload_styles()
    {
        wp_enqueue_style('thickbox');
    }

    function widget($args, $instance) {

        extract($args);
		
        echo $before_widget;
		
		if( !empty($instance['image_uri']) && !empty($instance['link']) ):
			if( isset($instance['new_tab']) && ($instance['new_tab'] == 'on') ):
			?>
				<a href="<?php echo apply_filters('widget_title', $instance['link'] ); ?>" target="_blank"><img src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php if( !empty($instance['title']) ): echo $instance['title']; endif; ?>"></a>
			<?php else: ?>
				<a href="<?php echo apply_filters('widget_title', $instance['link'] ); ?>"><img src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php if( !empty($instance['title']) ): echo $instance['title']; endif; ?>"></a>
			<?php 
			endif;
			elseif( !empty($instance['image_uri'])):
			?>
			<a href=""><img src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php if( !empty($instance['title']) ): echo $instance['title']; endif; ?>"></a>
			<?php 
		endif;
		
        echo $after_widget;

    }



    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['link'] = strip_tags( $new_instance['link'] );

        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
		
		$instance['new_tab'] = strip_tags( $new_instance['new_tab'] );

        return $instance;

    }



    function form($instance) {

?>

	<p>

		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Alt Title','zerif'); ?></label><br />
 
		<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php if( !empty($instance['title']) ): echo $instance['title']; endif; ?>" class="widefat" />

	</p>


	<p>

        <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('link'); ?>" id="<?php echo $this->get_field_id('link'); ?>" value="<?php if( !empty($instance['link']) ): echo $instance['link']; endif; ?>" class="widefat" />

    </p>

	<p>
		<input type="hidden" name="<?php echo $this->get_field_name('new_tab'); ?>" value="0" />
		<input type="checkbox" <?php if( !empty($instance['new_tab']) ): checked($instance['new_tab'], 'on'); endif; ?> id="<?php echo $this->get_field_id('new_tab'); ?>" name="<?php echo $this->get_field_name('new_tab'); ?>" /> 
		<label for="<?php echo $this->get_field_id('new_tab'); ?>"><?php _e('Open in new tab','zerif'); ?></label>
	</p>

	<p>
       <label for="<?php echo $this->get_field_name( 'image_uri' ); ?>"><?php _e( 'Image:' ); ?></label>
       <input name="<?php echo $this->get_field_name( 'image_uri' ); ?>" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" class="widefat" type="text" size="36"  value="<?php if( !empty($instance['image_uri']) ): echo esc_url( $instance['image_uri'] ); endif; ?>" />
       <input class="upload_image_button" type="button" value="Upload Image" />
    </p>
	

<?php

    }

}



/****************************/

/****** team member widget **/

/***************************/

class zerif_team_widget extends WP_Widget {
	
	/**
     * Constructor
     **/
    public function __construct()
    {
        $widget_ops = array('classname' => 'zerif_team');

        parent::__construct( 'zerif_team-widget', 'Zerif - Team member widget', $widget_ops );

        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
        add_action('admin_enqueue_styles', array($this, 'upload_styles'));
    }

    /**
     * Upload the Javascripts for the media uploader
     */
    public function upload_scripts()
    {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('upload_media_widget', get_template_directory_uri() . '/js/zerif-upload-media.js');
    }

    /**
     * Add the styles for the upload media box
     */
    public function upload_styles()
    {
        wp_enqueue_style('thickbox');
    }




	function widget($args, $instance) {

        extract($args);

?>
			<div class="col-lg-3 col-sm-3">

				<div class="team-member">

					<figure class="profile-pic">
						<?php 
						if( !empty($instance['name']) ): 
							$ourteam_widget_image_alt = apply_filters('widget_title', $instance['name'] ); 
						else:
							$ourteam_widget_image_alt = __( 'Team member','zerif' );
						endif;
						?>	
						<img src="<?php if( !empty($instance['image_uri']) ): echo esc_url($instance['image_uri']); endif; ?>" alt="<?php echo $ourteam_widget_image_alt; ?>">

					</figure>
	
					<div class="member-details">

					<?php if( !empty($instance['profile_link']) ): ?>
						<h5 class="dark-text red-border-bottom"><a href="<?php echo apply_filters('widget_title', $instance['profile_link'] ); ?>"><?php if( !empty($instance['name']) ): echo apply_filters('widget_title', $instance['name'] ); endif; ?></a></h5>
					<?php else: ?>
						<h5 class="dark-text red-border-bottom"><?php if( !empty($instance['name']) ): echo apply_filters('widget_title', $instance['name'] ); endif; ?></h5>
					<?php endif; ?>

						<div class="position"><?php if( !empty($instance['position']) ): echo htmlspecialchars_decode(apply_filters('widget_title', $instance['position'] )); endif; ?></div>

					</div>

					<div class="social-icons">

						<ul>
							<?php
								$zerif_team_target = '_self';
								if( !empty($instance['open_new_window']) ):
									$zerif_team_target = '_blank';
								endif;
							?>

							<?php if( !empty($instance['fb_link']) ): ?>
								<li><a title="<?php _e( 'Facebook', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['fb_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-facebook"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['tw_link']) ): ?>
								<li><a title="<?php _e( 'Twitter', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['tw_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-twitter"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['bh_link']) ): ?>
								<li><a title="<?php _e( 'Behance', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['bh_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-behance"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['db_link']) ): ?>
								<li><a title="<?php _e( 'Dribbble', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['db_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-dribbble"></i></a></li>
							<?php endif; ?>

							<?php if( !empty($instance['ln_link']) ): ?>
								<li><a title="<?php _e( 'LinkedIn', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['ln_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-linkedin"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['gp_link']) ): ?>
								<li><a title="<?php _e( 'Google Plus', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['gp_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-google"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['pinterest_link']) ): ?>
								<li><a title="<?php _e( 'Pinterest', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['pinterest_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-pinterest"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['tumblr_link']) ): ?>
								<li><a title="<?php _e( 'Tumblr', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['tumblr_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-tumblr"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['reddit_link']) ): ?>
								<li><a title="<?php _e( 'Reddit', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['reddit_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-reddit"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['youtube_link']) ): ?>
								<li><a title="<?php _e( 'YouTube', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['youtube_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-youtube"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['instagram_link']) ): ?>
								<li><a title="<?php _e( 'Instagram', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['instagram_link'] ); ?>" target="<?php echo $zerif_team_target; ?>"><i class="fa fa-instagram"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['email_link']) ): ?>
								<li><a title="<?php _e( 'Email', 'zerif' ); ?>" href="mailto:<?php echo apply_filters('widget_title', $instance['email_link'] ); ?>"><i class="fa fa-envelope"></i></a></li>
							<?php endif; ?>
											
							<?php if( !empty($instance['website_link']) ): ?>
								<li><a title="<?php _e( 'Website', 'zerif' ); ?>" href="<?php echo apply_filters('widget_title', $instance['website_link'] ); ?>"><i class="fa fa-globe"></i></a></li>
							<?php endif; ?>
							
							<?php if( !empty($instance['phone_link']) ): ?>
								<li><a title="<?php _e( 'Phone Number', 'zerif' ); ?>" href="tel:<?php echo apply_filters('widget_title', $instance['phone_link'] ); ?>"><i class="fa fa-phone"></i></a></li>
							<?php endif; ?>
					
						</ul>

					</div>

					<?php if( !empty($instance['description']) ): ?>
						<div class="details">
							<?php echo htmlspecialchars_decode(apply_filters('widget_title', $instance['description'] )); ?>
						</div>
					<?php endif; ?>

				</div>

			</div>
<?php

	}



    function update($new_instance, $old_instance) {

        $instance = $old_instance;

        $instance['name'] = strip_tags( $new_instance['name'] );

        $instance['title'] = strip_tags( $new_instance['title'] );

        $instance['position'] = stripslashes(wp_filter_post_kses( $new_instance['position'] ));

		$instance['description'] = stripslashes(wp_filter_post_kses( $new_instance['description'] ));

		$instance['fb_link'] = strip_tags( $new_instance['fb_link'] );

		$instance['tw_link'] = strip_tags( $new_instance['tw_link'] );

		$instance['bh_link'] = strip_tags( $new_instance['bh_link'] );

		$instance['db_link'] = strip_tags( $new_instance['db_link'] );
		
		$instance['ln_link'] = strip_tags( $new_instance['ln_link'] );
		
		$instance['gp_link'] = strip_tags( $new_instance['gp_link'] );
		
		$instance['pinterest_link'] = strip_tags( $new_instance['pinterest_link'] );
		
		$instance['tumblr_link'] = strip_tags( $new_instance['tumblr_link'] );
		
		$instance['reddit_link'] = strip_tags( $new_instance['reddit_link'] );
		
		$instance['youtube_link'] = strip_tags( $new_instance['youtube_link'] );
		
		$instance['instagram_link'] = strip_tags( $new_instance['instagram_link'] );
		
		$instance['website_link'] = strip_tags( $new_instance['website_link'] );
		
		$instance['email_link'] = strip_tags( $new_instance['email_link'] );
		
		$instance['phone_link'] = strip_tags( $new_instance['phone_link'] );

		$instance['image_uri'] = strip_tags( $new_instance['image_uri'] );

		$instance['profile_link'] = strip_tags( $new_instance['profile_link'] ); 
		
		$instance['open_new_window'] = strip_tags($new_instance['open_new_window']);

        return $instance;

    }



    function form($instance) {

?>



	<p>

        <label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Name','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('name'); ?>" id="<?php echo $this->get_field_id('name'); ?>" value="<?php if( !empty($instance['name']) ): echo $instance['name']; endif; ?>" class="widefat" />

    </p>



	<p>

        <input type="hidden" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php if( !empty($instance['name']) ): echo $instance['name']; endif; ?>" class="widefat" />

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('position'); ?>"><?php _e('Position','zerif'); ?></label><br />
		
		<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name('position'); ?>" id="<?php echo $this->get_field_id('position'); ?>" value="<?php if( !empty($instance['position']) ): echo $instance['position']; endif; ?>"><?php if( !empty($instance['position']) ): echo htmlspecialchars_decode($instance['position']); endif; ?></textarea>

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description','zerif'); ?></label><br />
		
		<textarea class="widefat" rows="8" cols="20" name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" value="<?php if( !empty($instance['description']) ): echo $instance['description']; endif; ?>"><?php if( !empty($instance['description']) ): echo htmlspecialchars_decode($instance['description']); endif; ?></textarea>

    </p>
	
	<p>

		<label for="<?php echo $this->get_field_id('profile_link'); ?>"><?php _e('Profile link','zerif'); ?></label><br />

		<input type="text" name="<?php echo $this->get_field_name('profile_link'); ?>" id="<?php echo $this->get_field_id('profile_link'); ?>" value="<?php if( !empty($instance['profile_link']) ): echo $instance['profile_link']; endif; ?>" class="widefat" />

	</p>

	

	<p>

        <label for="<?php echo $this->get_field_id('fb_link'); ?>"><?php _e('Facebook link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('fb_link'); ?>" id="<?php echo $this->get_field_id('fb_link'); ?>" value="<?php if( !empty($instance['fb_link']) ): echo $instance['fb_link']; endif; ?>" class="widefat" />

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('tw_link'); ?>"><?php _e('Twitter link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('tw_link'); ?>" id="<?php echo $this->get_field_id('tw_link'); ?>" value="<?php if( !empty($instance['tw_link']) ): echo $instance['tw_link']; endif; ?>" class="widefat" />

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('bh_link'); ?>"><?php _e('Behance link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('bh_link'); ?>" id="<?php echo $this->get_field_id('bh_link'); ?>" value="<?php if( !empty($instance['bh_link']) ): echo $instance['bh_link']; endif; ?>" class="widefat" />

    </p>

	

	<p>

        <label for="<?php echo $this->get_field_id('db_link'); ?>"><?php _e('Dribble link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('db_link'); ?>" id="<?php echo $this->get_field_id('db_link'); ?>" value="<?php if( !empty($instance['db_link']) ): echo $instance['db_link']; endif; ?>" class="widefat" />

    </p>

	<p>

        <label for="<?php echo $this->get_field_id('ln_link'); ?>"><?php _e('Linkedin link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('ln_link'); ?>" id="<?php echo $this->get_field_id('ln_link'); ?>" value="<?php if( !empty($instance['ln_link']) ): echo $instance['ln_link']; endif; ?>" class="widefat" />

    </p>
	
	<p>

        <label for="<?php echo $this->get_field_id('gp_link'); ?>"><?php _e('Google+ link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('gp_link'); ?>" id="<?php echo $this->get_field_id('gp_link'); ?>" value="<?php if( !empty($instance['gp_link']) ): echo $instance['gp_link']; endif; ?>" class="widefat" />

    </p>
	
	<p>

        <label for="<?php echo $this->get_field_id('pinterest_link'); ?>"><?php _e('Pinterest link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('pinterest_link'); ?>" id="<?php echo $this->get_field_id('pinterest_link'); ?>" value="<?php if( !empty($instance['pinterest_link']) ): echo $instance['pinterest_link']; endif; ?>" class="widefat" />

    </p>
	
	<p>

        <label for="<?php echo $this->get_field_id('tumblr_link'); ?>"><?php _e('Tumblr link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('tumblr_link'); ?>" id="<?php echo $this->get_field_id('tumblr_link'); ?>" value="<?php if( !empty($instance['tumblr_link']) ): echo $instance['tumblr_link']; endif; ?>" class="widefat" />

    </p>
	
	<p>

        <label for="<?php echo $this->get_field_id('reddit_link'); ?>"><?php _e('Reddit link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('reddit_link'); ?>" id="<?php echo $this->get_field_id('reddit_link'); ?>" value="<?php if( !empty($instance['reddit_link']) ): echo $instance['reddit_link']; endif; ?>" class="widefat" />

    </p>
	
	<p>

        <label for="<?php echo $this->get_field_id('youtube_link'); ?>"><?php _e('YouTube link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('youtube_link'); ?>" id="<?php echo $this->get_field_id('youtube_link'); ?>" value="<?php if( !empty($instance['youtube_link']) ): echo $instance['youtube_link']; endif; ?>" class="widefat" />

    </p>
	
	<p>

        <label for="<?php echo $this->get_field_id('instagram_link'); ?>"><?php _e('Instagram link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('instagram_link'); ?>" id="<?php echo $this->get_field_id('instagram_link'); ?>" value="<?php if( !empty($instance['instagram_link']) ): echo $instance['instagram_link']; endif; ?>" class="widefat" />

    </p>
	
	<p>

        <label for="<?php echo $this->get_field_id('email_link'); ?>"><?php _e('Email link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('email_link'); ?>" id="<?php echo $this->get_field_id('email_link'); ?>" value="<?php if( !empty($instance['email_link']) ): echo $instance['email_link']; endif; ?>" class="widefat" />

    </p>
	
	<p>

        <label for="<?php echo $this->get_field_id('website_link'); ?>"><?php _e('Website link','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('website_link'); ?>" id="<?php echo $this->get_field_id('website_link'); ?>" value="<?php if( !empty($instance['website_link']) ): echo $instance['website_link']; endif; ?>" class="widefat" />

    </p>
	
	<p>

        <label for="<?php echo $this->get_field_id('phone_link'); ?>"><?php _e('Phone number','zerif'); ?></label><br />

        <input type="text" name="<?php echo $this->get_field_name('phone_link'); ?>" id="<?php echo $this->get_field_id('phone_link'); ?>" value="<?php if( !empty($instance['phone_link']) ): echo $instance['phone_link']; endif; ?>" class="widefat" />

    </p>
	
    <p>
		<input type="hidden" name="<?php echo $this->get_field_name('open_new_window'); ?>" value="0" />
        <input type="checkbox" name="<?php echo $this->get_field_name('open_new_window'); ?>" id="<?php echo $this->get_field_id('open_new_window'); ?>" <?php if( !empty($instance['open_new_window']) ): checked( (bool) $instance['open_new_window'], true ); endif; ?> ><?php _e( 'Open links in new window?','zerif-lite' ); ?><br>
    </p>

    <p>
            <label for="<?php echo $this->get_field_name( 'image_uri' ); ?>"><?php _e( 'Image:' ); ?></label>
            <input name="<?php echo $this->get_field_name( 'image_uri' ); ?>" id="<?php echo $this->get_field_id( 'image_uri' ); ?>" class="widefat" type="text" size="36"  value="<?php if( !empty($instance['image_uri']) ): echo esc_url( $instance['image_uri'] ); endif; ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
    </p>



<?php

    }

}

/**************************/

/****** packages widget */

/************************/

class zerif_packages extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'color-picker',
			_x( 'Zerif - Package widget', 'widget title', 'zerif' ),
			array(
				'classname'   => 'package-widget col-lg-3 col-md-6 col-sm-6',
				'description' => ''
			)
		);

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
	}


	public function enqueue_scripts( $hook_suffix ) {
		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

	}

	public function print_scripts() {
		?>
		<script>
			( function( $ ){
				function initColorPicker( widget ) {
					widget.find( '.color-picker' ).wpColorPicker( {
						change: _.throttle( function() { // For Customizer
							$(this).trigger( 'change' );
						}, 3000 )
					});
				}

				function onFormUpdate( event, widget ) {
					initColorPicker( widget );
				}

				$( document ).on( 'widget-added widget-updated', onFormUpdate );

				$( document ).ready( function() {
					$( '#widgets-right .widget:has(.color-picker)' ).each( function () {
						initColorPicker( $( this ) );
					} );
				} );
			}( jQuery ) );
		</script>
		<?php
	}


	public function widget( $args, $instance ) {
		extract( $args );

		echo $before_widget;
		
		?>
		
		<div class="package-box-wrap col-lg-3 col-md-6 col-sm-6">
		
			<?php 
				if( !empty($instance['subtitle']) ):
					echo '<div class="best-value">';
				endif;
			?>		
		
			<div class="package" data-scrollreveal="enter left after 0s over 1s">
				<div class="package-header" style="background:<?php if( !empty($instance['color']) ): echo $instance['color']; endif; ?>">
					<?php 
						if( !empty($instance['subtitle']) ):
						
							if( !empty($instance['title']) ):
								echo '<h4>'.$instance['title'].'</h4>';
							endif;	
							echo '<div class="meta-text">'.$instance['subtitle'].'</div>';
							
						else:
						
							if( !empty($instance['title']) ):
								echo '<h5>'.$instance['title'].'</h5>';
							endif;
							
						endif;		
						
					?>
				</div>
				<div class="price dark-bg">
					<div class="price-container">
					<?php 
						if( !empty($instance['price']) ):
							echo '<h4>';
							
							if( !empty($instance['currency']) ):
								echo '<span class="dollar-sign">'.$instance['currency'].'</span>';
							endif;	
							
							echo $instance['price'];
							
							echo '</h4>';
						endif;
						
						if( !empty($instance['price_meta']) ):
							echo '<span class="price-meta">';	
								echo $instance['price_meta'];
							echo '</span>';
						endif;
					?>
					</div>
				</div>
				<ul>
					<?php 
						for ($i = 1; $i <= 10; $i++):
							$str_item = 'item'.$i;
							
							if( !empty($instance[$str_item]) ):
								echo '<li>'.$instance[$str_item].'</li>';
							endif;
						endfor;	
					?>
				</ul>
				<?php
					if( !empty($instance['button_label']) && !empty($instance['button_link']) ):
						if( !empty($instance['color']) ):
							echo '<a href="'.$instance['button_link'].'" class="btn btn-primary custom-button" style="background:'.$instance['color'].'">'.$instance['button_label'].'</a>';
						else:
							echo '<a href="'.$instance['button_link'].'" class="btn btn-primary custom-button">'.$instance['button_label'].'</a>';
						endif;
					endif;
				?>
				
			</div>
			<?php 
				if( !empty($instance['subtitle']) ):
					echo '</div>';
				endif;
			?>
		</div>
		
		<?php
		
		
		echo $after_widget;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'color' ] = strip_tags( $new_instance['color'] );
		
		$instance['title'] = strip_tags( $new_instance['title'] );

        $instance['subtitle'] = strip_tags( $new_instance['subtitle'] );
		
		$instance['price'] = strip_tags( $new_instance['price'] );
		
		$instance['currency'] = strip_tags( $new_instance['currency'] );
		
		$instance['price_meta'] = strip_tags( $new_instance['price_meta'] );
		
		$instance['button_label'] = strip_tags( $new_instance['button_label'] );
		
		$instance['button_link'] = strip_tags( $new_instance['button_link'] );
		
		$instance['button_link'] = strip_tags( $new_instance['button_link'] );
		
		$instance['item1'] = strip_tags( $new_instance['item1'] );
		
		$instance['item2'] = strip_tags( $new_instance['item2'] );
		
		$instance['item3'] = strip_tags( $new_instance['item3'] );
		
		$instance['item4'] = strip_tags( $new_instance['item4'] );
		
		$instance['item5'] = strip_tags( $new_instance['item5'] );
		
		$instance['item6'] = strip_tags( $new_instance['item6'] );
		
		$instance['item7'] = strip_tags( $new_instance['item7'] );
		
		$instance['item8'] = strip_tags( $new_instance['item8'] );
		
		$instance['item9'] = strip_tags( $new_instance['item9'] );
		
		$instance['item10'] = strip_tags( $new_instance['item10'] );
		
		$instance['background_color'] = $new_instance['background_color'];

		return $instance;
	}

	
	public function form( $instance ) {
		
		$instance = wp_parse_args(
			$instance,
			array(
				'title' => '',
				'subtitle' => '',
				'price' => '',
				'currency' => '',
				'price_meta' => '',
				'button_label' => '',
				'button_link' => '',
				'color' => ''
			)
		);

		$title = esc_attr( $instance[ 'title' ] );
		$subtitle = esc_attr( $instance[ 'subtitle' ] );
		$price = esc_attr( $instance[ 'price' ] );
		$currency = esc_attr( $instance[ 'currency' ] );
		$price_meta = esc_attr( $instance[ 'price_meta' ] );
		$button_label = esc_attr( $instance[ 'button_label' ] );
		$button_link = esc_attr( $instance[ 'button_link' ] );
		$color = esc_attr( $instance[ 'color' ] );
		
		?>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'color' ); ?>"><?php _e( 'Color:','zerif' ); ?></label><br>
			<input type="text" name="<?php echo $this->get_field_name( 'color' ); ?>" class="color-picker" id="<?php echo $this->get_field_id( 'color' ); ?>" value="<?php if(!empty($color)): echo $color; endif; ?>" />
		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php if(!empty($instance['title'])): echo $instance['title']; endif; ?>" class="widefat" />

		</p>

		<p>

			<label for="<?php echo $this->get_field_id('subtitle'); ?>"><?php _e('Subtitle','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('subtitle'); ?>" id="<?php echo $this->get_field_id('subtitle'); ?>" value="<?php if(!empty($instance['subtitle'])): echo $instance['subtitle']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('price'); ?>"><?php _e('Price','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('price'); ?>" id="<?php echo $this->get_field_id('price'); ?>" value="<?php if(!empty($instance['price'])): echo $instance['price']; endif; ?>" class="widefat" />

		</p>

	   <p>

			<label for="<?php echo $this->get_field_id('currency'); ?>"><?php _e('Currency','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('currency'); ?>" id="<?php echo $this->get_field_id('currency'); ?>" value="<?php if(!empty($instance['currency'])): echo $instance['currency']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('price_meta'); ?>"><?php _e('Price meta (e.g. /MONTH)','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('price_meta'); ?>" id="<?php echo $this->get_field_id('price_meta'); ?>" value="<?php if(!empty($instance['price_meta'])): echo $instance['price_meta']; endif; ?>" class="widefat" />

		</p>

		<p>

			<label for="<?php echo $this->get_field_id('button_label'); ?>"><?php _e('Button label','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('button_label'); ?>" id="<?php echo $this->get_field_id('button_label'); ?>" value="<?php if(!empty($instance['button_label'])): echo $instance['button_label']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('button_link'); ?>"><?php _e('Button link','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('button_link'); ?>" id="<?php echo $this->get_field_id('button_link'); ?>" value="<?php if(!empty($instance['button_link'])): echo $instance['button_link']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item1'); ?>"><?php _e('Item 1','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item1'); ?>" id="<?php echo $this->get_field_id('item1'); ?>" value="<?php if(!empty($instance['item1'])): echo $instance['item1']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item2'); ?>"><?php _e('Item 2','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item2'); ?>" id="<?php echo $this->get_field_id('item2'); ?>" value="<?php if(!empty($instance['item2'])): echo $instance['item2']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item3'); ?>"><?php _e('Item 3','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item3'); ?>" id="<?php echo $this->get_field_id('item3'); ?>" value="<?php if(!empty($instance['item3'])): echo $instance['item3']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item4'); ?>"><?php _e('Item 4','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item4'); ?>" id="<?php echo $this->get_field_id('item4'); ?>" value="<?php if(!empty($instance['item4'])): echo $instance['item4']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item5'); ?>"><?php _e('Item 5','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item5'); ?>" id="<?php echo $this->get_field_id('item5'); ?>" value="<?php if(!empty($instance['item5'])): echo $instance['item5']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item6'); ?>"><?php _e('Item 6','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item6'); ?>" id="<?php echo $this->get_field_id('item6'); ?>" value="<?php if(!empty($instance['item6'])): echo $instance['item6']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item7'); ?>"><?php _e('Item 7','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item7'); ?>" id="<?php echo $this->get_field_id('item7'); ?>" value="<?php if(!empty($instance['item7'])): echo $instance['item7']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item8'); ?>"><?php _e('Item 8','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item8'); ?>" id="<?php echo $this->get_field_id('item8'); ?>" value="<?php if(!empty($instance['item8'])): echo $instance['item8']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item9'); ?>"><?php _e('Item 9','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item9'); ?>" id="<?php echo $this->get_field_id('item9'); ?>" value="<?php if(!empty($instance['item9'])): echo $instance['item9']; endif; ?>" class="widefat" />

		</p>
		
		<p>

			<label for="<?php echo $this->get_field_id('item10'); ?>"><?php _e('Item 10','zerif'); ?></label><br />

			<input type="text" name="<?php echo $this->get_field_name('item10'); ?>" id="<?php echo $this->get_field_id('item10'); ?>" value="<?php if(!empty($instance['item10'])): echo $instance['item10']; endif; ?>" class="widefat" />

		</p>
		
		<?php
	}

}

function zerif_customizer_custom_css() {
	wp_enqueue_style( 'zerif_customizer_custom_css', get_template_directory_uri() . '/css/zerif_customizer_custom_css.css' );
}
add_action( 'customize_controls_print_styles', 'zerif_customizer_custom_css' );

function zerif_admin_custom_css() {
	wp_enqueue_style( 'zerif_admin_custom_css', get_template_directory_uri() . '/css/zerif_admin_custom_css.css' );
}
add_action( 'admin_enqueue_scripts', 'zerif_admin_custom_css' );

add_action('wp_footer','zerif_php_style', 1);

function zerif_php_style() {

	echo ' <style type="text/css">';
	
	/*******************************/
	/********** General ************/
	/*******************************/
	
	$zerif_background_color = get_theme_mod('zerif_background_color');
	if( !empty($zerif_background_color) ) {
		echo '	.site-content { background: '. $zerif_background_color .' }';
	}
	$zerif_navbar_color = get_theme_mod('zerif_navbar_color');
	if( !empty($zerif_navbar_color) ) {
		echo ' .navbar, .navbar-inverse .navbar-nav ul.sub-menu { background: '.$zerif_navbar_color.'; }';
	}
	$zerif_titles_color = get_theme_mod('zerif_titles_color');
	if( !empty($zerif_titles_color) ) {
		echo '	.entry-title, .entry-title a, .widget-title, .widget-title a, .page-header .page-title, .comments-title, h1.page-title { color: '. $zerif_titles_color .' !important}';
	}
	$zerif_titles_bottomborder_color = get_theme_mod('zerif_titles_bottomborder_color');
	if( !empty($zerif_titles_bottomborder_color) ) {
		echo '	.widget .widget-title:before, .entry-title:before, .page-header .page-title:before, .entry-title:after, ul.nav > li.current_page_item > a:before, .nav > li.current-menu-item > a:before, h1.page-title:before { background: '. $zerif_titles_bottomborder_color .' !important; }';
	}	
	$zerif_texts_color = get_theme_mod('zerif_texts_color');
	if( !empty($zerif_texts_color) ) {
		echo '	body, button, input, select, textarea, .widget p, .widget .textwidget { color: '. $zerif_texts_color .' }';
	}
	$zerif_links_color = get_theme_mod('zerif_links_color');
	if( !empty($zerif_links_color) ) {
		echo '	.widget li a, .widget a, article .entry-meta a, .entry-footer a, .navbar-inverse .navbar-nav>li>a, .navbar-inverse .navbar-nav ul.sub-menu li a, .home .nav > li.current_page_item a { color: '. $zerif_links_color .' !important; }';
	}
	if( !empty($zerif_links_color_hover) ) {
		echo '	.widget li a:hover, .widget a:hover, article .entry-meta a:hover, .entry-footer a:hover, .navbar-inverse .navbar-nav>li>a:hover, .navbar-inverse .navbar-nav ul.sub-menu li:hover a  { color: '. $zerif_links_color_hover .' !important; }';
	}
	
	/**************************************/
    /*********	Big title section *********/
	/**************************************/
	
	$zerif_bigtitle_background = get_theme_mod('zerif_bigtitle_background');
	if( !empty($zerif_bigtitle_background) ){
		echo '	.header-content-wrap { background: '. get_theme_mod('zerif_bigtitle_background') .'}';
	}
	$zerif_bigtitle_header_color = get_theme_mod('zerif_bigtitle_header_color');
	if( !empty($zerif_bigtitle_header_color) ) {
		echo '	.big-title-container .intro-text { color: '. $zerif_bigtitle_header_color .'}';	
	}
	$zerif_bigtitle_1button_background_color = get_theme_mod('zerif_bigtitle_1button_background_color');
	if( !empty($zerif_bigtitle_1button_background_color) ) {
		echo '	.big-title-container .red-btn { background: '. $zerif_bigtitle_1button_background_color .'}';
	}
	$zerif_bigtitle_1button_background_color_hover = get_theme_mod('zerif_bigtitle_1button_background_color_hover');
	if( !empty($zerif_bigtitle_1button_background_color_hover) ) {
		echo '	.big-title-container .red-btn:hover { background: '. $zerif_bigtitle_1button_background_color_hover .'}';
	}
	$zerif_bigtitle_1button_color = get_theme_mod('zerif_bigtitle_1button_color');
	if( !empty($zerif_bigtitle_1button_color) ) {
		echo '	.big-title-container .buttons .red-btn { color: '. $zerif_bigtitle_1button_color .' !important }';
	}
	$zerif_bigtitle_2button_background_color = get_theme_mod('zerif_bigtitle_2button_background_color');
	if( !empty($zerif_bigtitle_2button_background_color) ) {
		echo '	.big-title-container .green-btn { background: '. $zerif_bigtitle_2button_background_color .'}';
	}
	$zerif_bigtitle_2button_background_color_hover = get_theme_mod('zerif_bigtitle_2button_background_color_hover');
	if( !empty($zerif_bigtitle_2button_background_color_hover) ) {
		echo '	.big-title-container .green-btn:hover { background: '. $zerif_bigtitle_2button_background_color_hover .'}';
	}
	$zerif_bigtitle_2button_color = get_theme_mod('zerif_bigtitle_2button_color');
	if( !empty($zerif_bigtitle_2button_color) ) {
		echo '	.big-title-container .buttons .green-btn { color: '. get_theme_mod('zerif_bigtitle_2button_color') .' !important }';
	}
	$zerif_bigtitle_1button_color_hover = get_theme_mod( 'zerif_bigtitle_1button_color_hover','#fff' );
	if( !empty($zerif_bigtitle_1button_color_hover) ) {
		echo '	.big-title-container .red-btn:hover { color: '. $zerif_bigtitle_1button_color_hover .' !important }';
	}
	$zerif_bigtitle_2button_color_hover = get_theme_mod( 'zerif_bigtitle_2button_color_hover','#fff' );
	if( !empty($zerif_bigtitle_2button_color_hover) ) {
		echo '	.big-title-container .green-btn:hover { color: '. $zerif_bigtitle_2button_color_hover .' !important }';
	}
	
	/**************************************/
	/******* END - Big title section ******/
	/**************************************/
	
	/**************************************/
	/********** Our Focus section *********/
	/**************************************/
	$zerif_ourfocus_background = get_theme_mod('zerif_ourfocus_background');
	if( !empty($zerif_ourfocus_background) ) {
		echo '	.focus { background: '. $zerif_ourfocus_background .' }';
	}
	$zerif_ourfocus_header = get_theme_mod('zerif_ourfocus_header');
	if( !empty($zerif_ourfocus_header) ) {
		echo '	.focus .section-header h2{ color: '. $zerif_ourfocus_header .' }';
		echo '	.focus .section-header h6{ color: '. $zerif_ourfocus_header .' }';
	}	
	$zerif_ourfocus_box_title_color = get_theme_mod('zerif_ourfocus_box_title_color');
	if( !empty($zerif_ourfocus_box_title_color) ) {
		echo '	.focus .focus-box h5{ color: '. $zerif_ourfocus_box_title_color .' }';
	}
	$zerif_ourfocus_box_text_color = get_theme_mod('zerif_ourfocus_box_text_color');
	if( !empty($zerif_ourfocus_box_text_color) ) {
		echo '	.focus .focus-box p{ color: '. $zerif_ourfocus_box_text_color .' }';
	}
	$zerif_ourfocus_1box = get_theme_mod('zerif_ourfocus_1box');
	if( !empty($zerif_ourfocus_1box) ) {
		echo '	.focus .focus-box:nth-child(4n+1) .service-icon:hover { border: 10px solid '. $zerif_ourfocus_1box .' }';
		echo '	.focus .focus-box:nth-child(4n+1) .red-border-bottom:before { background: '. $zerif_ourfocus_1box .' }';
	}	
	$zerif_ourfocus_2box = get_theme_mod('zerif_ourfocus_2box');
	if( !empty($zerif_ourfocus_2box) ) {
		echo '	.focus .focus-box:nth-child(4n+2) .service-icon:hover { border: 10px solid '. $zerif_ourfocus_2box .' }';
		echo '	.focus .focus-box:nth-child(4n+2) .red-border-bottom:before { background: '. $zerif_ourfocus_2box .' }';
	}
	$zerif_ourfocus_3box = get_theme_mod('zerif_ourfocus_3box');
	if( !empty($zerif_ourfocus_3box) ) {
		echo '	.focus .focus-box:nth-child(4n+3) .service-icon:hover { border: 10px solid '. $zerif_ourfocus_3box .' }';
		echo '	.focus .focus-box:nth-child(4n+3) .red-border-bottom:before { background: '. $zerif_ourfocus_3box .' }';
	}
	$zerif_ourfocus_4box = get_theme_mod('zerif_ourfocus_4box');
	if( !empty($zerif_ourfocus_4box) ) {
		echo '	.focus .focus-box:nth-child(4n+4) .service-icon:hover { border: 10px solid '. $zerif_ourfocus_4box .' }';
		echo '	.focus .focus-box:nth-child(4n+4) .red-border-bottom:before { background: '. $zerif_ourfocus_4box .' }';
	}
	
	/********************************************/
	/********** END - Our Focus section *********/
	/********************************************/
	
	/**************************************/
	/********** Portfolio section *********/
	/**************************************/
	
	$zerif_portofolio_background = get_theme_mod('zerif_portofolio_background');
	if( !empty($zerif_portofolio_background) ) {
		echo '	.works { background: '. $zerif_portofolio_background .' }';
	}
	$zerif_portofolio_header = get_theme_mod('zerif_portofolio_header');
	if( !empty($zerif_portofolio_header) ) {
		echo '	.works .section-header h2 { color: '. $zerif_portofolio_header .' }';
		echo '	.works .section-header h6 { color: '. $zerif_portofolio_header .' }';
	}
	$zerif_portofolio_text = get_theme_mod('zerif_portofolio_text');
	if( !empty($zerif_portofolio_text) ) {
		echo '	.works .white-text { color: '. $zerif_portofolio_text .' }';
	}
	$zerif_portofolio_box_underline_color = get_theme_mod('zerif_portofolio_box_underline_color','#e96656');
	if( !empty($zerif_portofolio_box_underline_color) ) {
		echo '.works .red-border-bottom:before { background: '. $zerif_portofolio_box_underline_color .' !important; }';
	}
	
	/********************************************/
	/********** END - Portfolio section *********/
	/********************************************/
	
	/**************************************/
	/********** About us section **********/
	/**************************************/
	
	$zerif_aboutus_background = get_theme_mod('zerif_aboutus_background');
	if( !empty($zerif_aboutus_background) ) {
		echo '	.about-us, .about-us .our-clients .section-footer-title { background: '. $zerif_aboutus_background .' }';
	}
	$zerif_aboutus_title_color = get_theme_mod('zerif_aboutus_title_color');
	if( !empty($zerif_aboutus_title_color) ) {
		echo '	.about-us { color: '. $zerif_aboutus_title_color .' }';
		echo '	.about-us p{ color: '. $zerif_aboutus_title_color .' }';
		echo '	.about-us .section-header h2, .about-us .section-header h6 { color: '. $zerif_aboutus_title_color .' }';
	}
	
	$zerif_aboutus_number_color = get_theme_mod('zerif_aboutus_number_color','#fff');
	if( !empty($zerif_aboutus_number_color) ) {
		echo '.about-us	.skills input { color: '. $zerif_aboutus_number_color .' !important; }';
	}
	
	$zerif_aboutus_clients_color = get_theme_mod( 'zerif_aboutus_clients_color', '#fff' );
	if( !empty($zerif_aboutus_clients_color) ) {
		echo '.about-us .our-clients .section-footer-title { color: '. $zerif_aboutus_clients_color .' !important; }';
	}
	
	/**************************************/
	/******* END - About us section *******/
	/**************************************/
	
	/**************************************/
	/********** Our team section **********/
	/**************************************/
	
	$zerif_ourteam_background = get_theme_mod('zerif_ourteam_background');
	if( !empty($zerif_ourteam_background) ) {
		echo '	.our-team { background: '. $zerif_ourteam_background .' }';
	}
	$zerif_ourteam_header = get_theme_mod('zerif_ourteam_header');
	if( !empty($zerif_ourteam_header) ) {
		echo '	.our-team .section-header h2, .our-team .member-details h5, .our-team .member-details h5 a, .our-team .section-header h6, .our-team .member-details .position { color: '. $zerif_ourteam_header .' }';	
	}
	$zerif_ourteam_text = get_theme_mod('zerif_ourteam_text');
	if( !empty($zerif_ourteam_text) ) {
		echo '	.our-team .team-member:hover .details { color: '. $zerif_ourteam_text .' }';
	}
	$zerif_ourteam_socials_hover = get_theme_mod('zerif_ourteam_socials_hover');
	if( !empty($zerif_ourteam_socials_hover) ) {
		echo '	.our-team .team-member .social-icons ul li a:hover { color: '. $zerif_ourteam_socials_hover .' }';
	}
	$zerif_ourteam_socials = get_theme_mod('zerif_ourteam_socials');
	if( !empty($zerif_ourteam_socials) ) {
		echo '	.our-team .team-member .social-icons ul li a { color: '. $zerif_ourteam_socials .' }';
	}
	$zerif_ourteam_hover_background = get_theme_mod( 'zerif_ourteam_hover_background','#333' );
	if( !empty($zerif_ourteam_hover_background) ) {
		echo '.team-member:hover .details { background: '. $zerif_ourteam_hover_background .' !important; }';
	}
	$zerif_ourteam_1box = get_theme_mod( 'zerif_ourteam_1box', '#e96656' );
	if( !empty($zerif_ourteam_1box) ) {
		echo '	.our-team .row > div:nth-child(4n+1) .red-border-bottom:before { background: '. $zerif_ourteam_1box .' }';
	}
	$zerif_ourteam_2box = get_theme_mod( 'zerif_ourteam_2box','#34d293' );
	if( !empty($zerif_ourteam_2box) ) {
		echo '	.our-team .row > div:nth-child(4n+2) .red-border-bottom:before { background: '. $zerif_ourteam_2box .' }';
	}
	$zerif_ourteam_3box = get_theme_mod( 'zerif_ourteam_3box','#3ab0e2' );
	if( !empty($zerif_ourteam_3box) ) {
		echo '	.our-team .row > div:nth-child(4n+3) .red-border-bottom:before { background: '. $zerif_ourteam_3box .' }';
	}
	$zerif_ourteam_4box = get_theme_mod( 'zerif_ourteam_4box','#f7d861' );
	if( !empty($zerif_ourteam_4box) ) {
		echo '	.our-team .row > div:nth-child(4n+4) .red-border-bottom:before { background: '. $zerif_ourteam_4box .' }';
	}
	
	/**************************************/
	/******* END - Our team section *******/
	/**************************************/
	
	/**************************************/
	/******* Testimonials section *********/
	/**************************************/
	
	$zerif_testimonials_background = get_theme_mod('zerif_testimonials_background');
	if( !empty($zerif_testimonials_background) ) {
		echo '	.testimonial { background: '. $zerif_testimonials_background .' }';
	}	
	$zerif_testimonials_header = get_theme_mod('zerif_testimonials_header');
	if( !empty($zerif_testimonials_header) ) {
		echo '	.testimonial .section-header h2, .testimonial .section-header h6 { color: '. $zerif_testimonials_header .' }';
	}
	$zerif_testimonials_text = get_theme_mod('zerif_testimonials_text');
	if( !empty($zerif_testimonials_text) ) {
		echo '	.testimonial .feedback-box .message { color: '. $zerif_testimonials_text .' }';
	}
	$zerif_testimonials_author = get_theme_mod('zerif_testimonials_author');
	if( !empty($zerif_testimonials_author) ) {
		echo '	.testimonial .feedback-box .client-info .client-name { color: '. $zerif_testimonials_author .' }';	
	}
	$zerif_testimonials_quote = get_theme_mod('zerif_testimonials_quote');
	if( !empty($zerif_testimonials_quote) ) {
		echo '	.testimonial .feedback-box .quote { color: '. $zerif_testimonials_quote .' }';
	}
	$zerif_testimonials_box_color = get_theme_mod( 'zerif_testimonials_box_color','#FFFFFF' );
	if( !empty($zerif_testimonials_box_color) ) {
		echo '	.testimonial .feedback-box { background: '. $zerif_testimonials_box_color .' !important; }';
	}
	
	/**************************************/
	/****** END - Testimonials section ****/
	/**************************************/
	
	/**************************************/
	/********** Ribbon sections ***********/
	/**************************************/
	
	/* Bottom ribbon */
	$zerif_ribbon_background = get_theme_mod('zerif_ribbon_background');
	if(  !empty($zerif_ribbon_background)) {
		echo '	.separator-one { background: '. $zerif_ribbon_background .' }';	
	}
	$zerif_ribbon_text_color = get_theme_mod('zerif_ribbon_text_color');
	if( !empty($zerif_ribbon_text_color) ) {
		echo '	.separator-one h3 { color: '. $zerif_ribbon_text_color .' !important; }';
	}
	$zerif_ribbon_button_background = get_theme_mod('zerif_ribbon_button_background');
	if( !empty($zerif_ribbon_button_background) ) {
		echo '	.separator-one .green-btn { background: '. $zerif_ribbon_button_background .' }';	
	}
	$zerif_ribbon_button_background_hover = get_theme_mod('zerif_ribbon_button_background_hover');
	if( !empty($zerif_ribbon_button_background_hover) ) {
		echo '	.separator-one .green-btn:hover { background: '. $zerif_ribbon_button_background_hover .' }';
	}
	$zerif_ribbon_button_button_color = get_theme_mod('zerif_ribbon_button_button_color','#fff');
	if ( !empty($zerif_ribbon_button_button_color) ) {
		echo '	.separator-one .green-btn { color: '. $zerif_ribbon_button_button_color .' !important; }';
	}
	$zerif_ribbon_button_button_color_hover = get_theme_mod( 'zerif_ribbon_button_button_color_hover','#fff' );
	if( !empty($zerif_ribbon_button_button_color_hover) ) {
		echo '	.separator-one .green-btn:hover { color: '. $zerif_ribbon_button_button_color_hover .' !important; }';
	}
	
	/* Right ribbon */
	$zerif_ribbonright_background = get_theme_mod('zerif_ribbonright_background');
	if( !empty($zerif_ribbonright_background) ) {
		echo '	.purchase-now { background: '. $zerif_ribbonright_background .' }';	
	}
	$zerif_ribbonright_text_color = get_theme_mod('zerif_ribbonright_text_color');
	if( !empty($zerif_ribbonright_text_color) ) {
		echo '	.purchase-now h3 { color: '. $zerif_ribbonright_text_color .' }';	
	}
	$zerif_ribbonright_button_background = get_theme_mod('zerif_ribbonright_button_background');
	if( !empty($zerif_ribbonright_button_background) ) {
		echo '	.purchase-now .red-btn { background: '. $zerif_ribbonright_button_background .' !important }';
	}
	$zerif_ribbonright_button_background_hover = get_theme_mod('zerif_ribbonright_button_background_hover');
	if( !empty($zerif_ribbonright_button_background_hover) ) {
		echo '	.purchase-now .red-btn:hover { background: '. get_theme_mod('zerif_ribbonright_button_background_hover') .' !important }';
	}
	$zerif_ribbonright_button_button_color = get_theme_mod( 'zerif_ribbonright_button_button_color','#fff' );
	if( !empty($zerif_ribbonright_button_button_color) ) {
		echo '	.purchase-now .red-btn { color: '. $zerif_ribbonright_button_button_color .' !important; }';
	}
	$zerif_ribbonright_button_button_color_hover = get_theme_mod( 'zerif_ribbonright_button_button_color_hover','#fff' );
	if( !empty($zerif_ribbonright_button_button_color_hover) ) {
		echo '	.purchase-now .red-btn:hover { color: '. $zerif_ribbonright_button_button_color_hover .' !important; }';
	}
	
	
	/**************************************/
	/******* END - Ribbon sections ********/
	/**************************************/
	
	/**************************************/
	/******** Contact us section **********/
	/**************************************/
	
	$zerif_contacus_background = get_theme_mod('zerif_contacus_background');
	if( !empty($zerif_contacus_background) ) {
		echo '	.contact-us { background: '. $zerif_contacus_background .' }';
	}
	$zerif_contacus_header = get_theme_mod('zerif_contacus_header');
	if( !empty($zerif_contacus_header) ) {
		echo '	.contact-us .section-header h2, .contact-us .section-header h6 { color: '. $zerif_contacus_header .' }';	
	}
	$zerif_contacus_button_background = get_theme_mod('zerif_contacus_button_background');
	if( !empty($zerif_contacus_button_background) ) {
		echo '	.contact-us button { background: '. $zerif_contacus_button_background .' }';
	}
	$zerif_contacus_button_background_hover = get_theme_mod('zerif_contacus_button_background_hover');
	if( !empty($zerif_contacus_button_background_hover) ) {
		echo '	.contact-us button:hover { background: '. $zerif_contacus_button_background_hover .' !important; box-shadow: none; }';
	}
	$zerif_contacus_button_color = get_theme_mod('zerif_contacus_button_color');
	if( !empty($zerif_contacus_button_color) ) {
		echo '	.contact-us button, .pirate_forms .pirate-forms-submit-button { color: '. $zerif_contacus_button_color .' !important; }';	
	}
	$zerif_contacus_button_color_hover = get_theme_mod( 'zerif_contacus_button_color_hover','#fff' );
	if( !empty($zerif_contacus_button_color_hover) ) {
		echo '	.contact-us button:hover, .pirate_forms .pirate-forms-submit-button:hover { color: '. $zerif_contacus_button_color_hover .' !important; }';
	}
	
	/**************************************/
	/**** END - Contact us section ********/
	/**************************************/
	
	/**************************************/
	/********** Packages section **********/
	/**************************************/
	
	$zerif_packages_header = get_theme_mod('zerif_packages_header');
	if( !empty($zerif_packages_header) ) {
		echo '	.packages .section-header h2, .packages .section-header h6 { color: '. $zerif_packages_header .'}';	
	}
	$zerif_package_title_color = get_theme_mod('zerif_package_title_color');
	if( !empty($zerif_package_title_color) ) {
		echo '	.packages .package-header h5,.best-value .package-header h4,.best-value .package-header .meta-text { color: '. $zerif_package_title_color .'}';
	}
	$zerif_package_text_color = get_theme_mod('zerif_package_text_color');
	if( !empty($zerif_package_text_color) ) {
		echo '	.packages .package ul li, .packages .price .price-meta { color: '. $zerif_package_text_color .'}';	
	}
	$zerif_package_button_text_color = get_theme_mod('zerif_package_button_text_color');
	if( !empty($zerif_package_button_text_color) ) {
		echo '	.packages .package .custom-button { color: '. $zerif_package_button_text_color .' !important; }';	
	}
	$zerif_package_price_background_color = get_theme_mod('zerif_package_price_background_color');
	if( !empty($zerif_package_price_background_color) ) {
		echo '	.packages .dark-bg { background: '. $zerif_package_price_background_color .'; }';	
	}
	$zerif_package_price_color = get_theme_mod('zerif_package_price_color');
	if( !empty($zerif_package_price_color) ) {
		echo '	.packages .price h4 { color: '. $zerif_package_price_color .'; }';
	}
	$zerif_packages_background = get_theme_mod('zerif_packages_background','rgba(0, 0, 0, 0.5)');
	if( !empty($zerif_packages_background) ) {
		echo '	.packages { background: '. $zerif_packages_background .' }';
	}
	
	/**************************************/
	/******** END - Packages section ******/
	/**************************************/
	
	/**************************************/
	/******* Latest news section **********/
	/**************************************/
	
	$zerif_latestnews_background = get_theme_mod('zerif_latestnews_background','#fff');
	if( !empty($zerif_latestnews_background) ) {
		echo '	#latestnews { background: '. $zerif_latestnews_background .' }';
	}
	
	$zerif_latestnews_header_title_color = get_theme_mod('zerif_latestnews_header_title_color','#404040');
	if( !empty($zerif_latestnews_header_title_color) ) {
		echo '	#latestnews .section-header h2 { color: '. $zerif_latestnews_header_title_color .' }';
	}
	
	$zerif_latestnews_header_subtitle_color = get_theme_mod('zerif_latestnews_header_subtitle_color','#808080');
	if( !empty($zerif_latestnews_header_subtitle_color) ) {
		echo '	#latestnews .section-header h6 { color: '. $zerif_latestnews_header_subtitle_color .' }';
	}
	
	$zerif_latestnews_post_title_color = get_theme_mod('zerif_latestnews_post_title_color');
	if ( !empty($zerif_latestnews_post_title_color) ) {
		echo '	#latestnews #carousel-homepage-latestnews .carousel-inner .item .latestnews-title a { color: '. $zerif_latestnews_post_title_color .'}';
	}
	
	$zerif_latestnews_post_underline_color1 = get_theme_mod('zerif_latestnews_post_underline_color1');
	if ( !empty($zerif_latestnews_post_underline_color1) ) {
		echo '	#latestnews #carousel-homepage-latestnews .item .latestnews-box:nth-child(4n+1) .latestnews-title a:before { background: '. $zerif_latestnews_post_underline_color1 .'}';
	}
	
	$zerif_latestnews_post_underline_color2 = get_theme_mod('zerif_latestnews_post_underline_color2');
	if ( !empty($zerif_latestnews_post_underline_color2) ) {
		echo '	#latestnews #carousel-homepage-latestnews .item .latestnews-box:nth-child(4n+2) .latestnews-title a:before { background: '. $zerif_latestnews_post_underline_color2 .'}';
	}
	
	$zerif_latestnews_post_underline_color3 = get_theme_mod('zerif_latestnews_post_underline_color3');
	if ( !empty($zerif_latestnews_post_underline_color3) ) {
		echo '	#latestnews #carousel-homepage-latestnews .item .latestnews-box:nth-child(4n+3) .latestnews-title a:before { background: '. $zerif_latestnews_post_underline_color3 .'}';
	}
	
	$zerif_latestnews_post_underline_color4 = get_theme_mod('zerif_latestnews_post_underline_color4');
	if ( !empty($zerif_latestnews_post_underline_color4) ) {
		echo '	#latestnews #carousel-homepage-latestnews .item .latestnews-box:nth-child(4n+4) .latestnews-title a:before { background: '. $zerif_latestnews_post_underline_color4 .'}';
	}
	
	$zerif_latestnews_post_text_color = get_theme_mod('zerif_latestnews_post_text_color');
	if ( !empty($zerif_latestnews_post_text_color) ) {
		echo '	#latestnews .latesnews-content p, .latesnews-content { color: '. $zerif_latestnews_post_text_color .'}';
	}
	
	/**************************************/
	/******* END - Latest news section ****/
	/**************************************/
	
	/**************************************/
	/********* Subscribe section **********/
	/**************************************/
	
	$zerif_subscribe_background = get_theme_mod( 'zerif_subscribe_background','rgba(0, 0, 0, 0.5)' );
	if( !empty($zerif_subscribe_background) ) {
		echo ' section#subscribe { background: '.$zerif_subscribe_background.' !important; }';
	}
	$zerif_subscribe_header_color = get_theme_mod('zerif_subscribe_header_color');
	if( !empty($zerif_subscribe_header_color) ) {
		echo ' section#subscribe h3, .newsletter .sub-heading, .newsletter label { color: '.$zerif_subscribe_header_color.' !important; }';	
	}
	$zerif_subscribe_button_color = get_theme_mod('zerif_subscribe_button_color');
	if( !empty($zerif_subscribe_button_color) ) {
		echo ' section#subscribe input[type="submit"] { color: '.$zerif_subscribe_button_color.' !important; }';	
	}
	$zerif_subscribe_button_background_color = get_theme_mod('zerif_subscribe_button_background_color');
	if( !empty($zerif_subscribe_button_background_color) ) {
		echo ' section#subscribe input[type="submit"] { background: '.$zerif_subscribe_button_background_color.' !important; }';	
	}
	$zerif_subscribe_button_background_color_hover = get_theme_mod('zerif_subscribe_button_background_color_hover');
	if( !empty($zerif_subscribe_button_background_color_hover) ) {
		echo ' section#subscribe input[type="submit"]:hover { background: '.$zerif_subscribe_button_background_color_hover.' !important; }';
	}
	
	/**************************************/
	/********* END - Subscribe section ****/
	/**************************************/
	
	/*******************************/
	/*********** Footer  ***********/
	/*******************************/
	
	$zerif_footer_background = get_theme_mod('zerif_footer_background');
	if( !empty($zerif_footer_background) ) {
		echo '	#footer { background: '. $zerif_footer_background .' }';	
	}
	$zerif_footer_socials_background = get_theme_mod('zerif_footer_socials_background');
	if( !empty($zerif_footer_socials_background) ) {
		echo '	.copyright { background: '. $zerif_footer_socials_background .' }';
	}
	$zerif_footer_text_color = get_theme_mod('zerif_footer_text_color');
	if( !empty($zerif_footer_text_color) ) {
		echo '	#footer .company-details, #footer .company-details a, #footer .footer-widget p, #footer .footer-widget a { color: '. $zerif_footer_text_color .' !important; }';
	}
	$zerif_footer_socials = get_theme_mod('zerif_footer_socials');
	if( !empty($zerif_footer_socials) ) {
		echo '	#footer .social li a { color: '. $zerif_footer_socials .' }';
	}
	$zerif_footer_socials_hover = get_theme_mod('zerif_footer_socials_hover');
	if( !empty($zerif_footer_socials_hover) ) {
		echo '	#footer .social li a:hover { color: '. $zerif_footer_socials_hover .' }';
	}	
	$zerif_footer_text_color_hover = get_theme_mod( 'zerif_footer_text_color_hover','#e96656' );
	if( !empty($zerif_footer_text_color_hover) ) {
		echo '	#footer .company-details:hover, #footer .company-details a:hover, #footer .footer-widget a:hover { color: '. $zerif_footer_text_color_hover .' !important; }';
	}
	$zerif_footer_widgets_title = get_theme_mod('zerif_footer_widgets_title','#fff');
	if( !empty($zerif_footer_widgets_title) ) {
		echo '	#footer .footer-widget h1 { color: '. $zerif_footer_widgets_title .' !important; }';
	}
	$zerif_footer_widgets_title_border_bottom = get_theme_mod('zerif_footer_widgets_title_border_bottom','#e96656');
	if( !empty($zerif_footer_widgets_title_border_bottom) ) {
		echo '	#footer .footer-widget h1:before { background: '. $zerif_footer_widgets_title_border_bottom .' !important; }';
	}
	
	/**************************************/
	/*********** END - Footer  ************/
	/**************************************/
	
	/********************************/
	/*********** Buttons  ***********/
	/*******************************/
	
	$zerif_buttons_background_color = get_theme_mod('zerif_buttons_background_color');
	
	if( !empty($zerif_buttons_background_color) ) {
		echo '	.comment-form #submit, .comment-reply-link,.woocommerce .add_to_cart_button, .woocommerce .checkout-button, .woocommerce .single_add_to_cart_button, .woocommerce #place_order, .edd-submit.button, .page button, .post button, .woocommerce-page .woocommerce input[type="submit"], .woocommerce-page #content input.button, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page input.button.alt, .woocommerce-page .products a.button { background: '. $zerif_buttons_background_color .' !important; }';
	}
	
	$zerif_buttons_background_color_hover = get_theme_mod('zerif_buttons_background_color_hover');
	
	if( !empty($zerif_buttons_background_color_hover) ) {
		echo '	.comment-form #submit:hover, .comment-reply-link:hover, .woocommerce .add_to_cart_button:hover, .woocommerce .checkout-button:hover, .woocommerce  .single_add_to_cart_button:hover, .woocommerce #place_order:hover, .edd-submit.button:hover, .page button:hover, .post button:hover, .woocommerce-page .woocommerce input[type="submit"]:hover, .woocommerce-page #content input.button:hover, .woocommerce input.button.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page .products a.button:hover { background: '. $zerif_buttons_background_color_hover .' !important; box-shadow: none; }';
	}	
	
	$zerif_buttons_text_color = get_theme_mod('zerif_buttons_text_color');
	
	if( !empty($zerif_buttons_text_color) ) {
		echo '	.comment-form #submit, .comment-reply-link, .woocommerce .add_to_cart_button, .woocommerce .checkout-button, .woocommerce .single_add_to_cart_button, .woocommerce #place_order, .edd-submit.button span, .page button, .post button, .woocommerce-page .woocommerce input[type="submit"], .woocommerce-page #content input.button, .woocommerce input.button.alt, .woocommerce-page #content input.button.alt, .woocommerce-page input.button.alt { color: '. $zerif_buttons_text_color .' !important }';
	}	

	
	/********************************/
	/******* END - Buttons  *********/
	/*******************************/

	echo '</style>';

}

function zerif_excerpt_more( $more ) {
	return '<a href="'.get_permalink().'">[...]</a>';
}
add_filter('excerpt_more', 'zerif_excerpt_more');

/* Enqueue Google reCAPTCHA scripts */
add_action( 'wp_enqueue_scripts', 'recaptcha_scripts' );
function recaptcha_scripts() {
	
	if ( is_home() ):

		$zerif_contactus_sitekey = get_theme_mod('zerif_contactus_sitekey');
		$zerif_contactus_secretkey = get_theme_mod('zerif_contactus_secretkey');
		$zerif_contactus_recaptcha_show = get_theme_mod('zerif_contactus_recaptcha_show');

		if( isset($zerif_contactus_recaptcha_show) && $zerif_contactus_recaptcha_show != 1 && !empty($zerif_contactus_sitekey) && !empty($zerif_contactus_secretkey) ) :

		    wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );

		endif;

	endif;

}
add_action("after_switch_theme", "zerif_get_lite_options");

function zerif_get_lite_options () {
	
	/* import zerif lite options */
	$zerif_mods = get_option('theme_mods_zerif-lite');
	
	if( !empty($zerif_mods) ):
		
		foreach($zerif_mods as $zerif_mod_k => $zerif_mod_v):
			
			set_theme_mod( $zerif_mod_k, $zerif_mod_v );
			
		endforeach;
		
	endif;
	
}

/* remove custom-background from body_class() */
add_filter( 'body_class', 'remove_class_function' );
function remove_class_function( $classes ) {

	$zerif_background_settings = get_theme_mod('zerif_background_settings');
	$zerif_bgslider1 = get_theme_mod('zerif_bgslider_1');
	$zerif_bgslider2 = get_theme_mod('zerif_bgslider_2');
	$zerif_bgslider3 = get_theme_mod('zerif_bgslider_3');

	if ( !is_home() || ((!empty($zerif_background_settings)) && ($zerif_background_settings != 'zerif-background-image')) || (empty($zerif_background_settings) && (!empty($zerif_bgslider_1) || !empty($zerif_bgslider_2) || !empty($zerif_bgslider_3))) )
    {   
        // index of custom-background
        $key = array_search('custom-background', $classes);
        // remove class
        unset($classes[$key]);
    }
    return $classes;
}

/* to make archive pages work with the CPT */
add_filter('pre_get_posts', 'zerif_query_post_type');
function zerif_query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
	if($post_type)
	    $post_type = $post_type;
	else
	    $post_type = array('nav_menu_item','post','portofolio');
    $query->set('post_type',$post_type);
	return $query;
    }
}


 require 'inc/cwp-update.php'; 

