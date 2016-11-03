<?php

/**
 *  Require Once
 */

require_once ( 'includes/customizer.php' );


/**
 *  Content Width
 */
if ( ! isset( $content_width ) ) $content_width = 634;

add_theme_support( 'automatic-feed-links' );


/*
* Setup theme
*/

function lawyeria_lite_theme_setup() {

	load_theme_textdomain( 'lawyeria-lite', get_template_directory() . '/languages' );

	$locations = array(
		'header-menu' => __( 'This menu will appear in header.', 'lawyeria-lite' ),
	);
	register_nav_menus( $locations );
	
	/**
	 *  Post Thumbnail
	 */
	add_theme_support( 'post-thumbnails' );
	
	/*
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'cwp_custom_background_args', array(
		'default-color' => '#f5f4f9',
		'default-image' => '',
	) ) );
	
	/*
	 * Implement the Custom Header feature.
	 */
	$args = array(
			'width'         => 964,
			'height'        => 150,
			'default-image' => '',
			'uploads'       => true,
		);
	add_theme_support( 'custom-header', $args );

}

add_action( 'after_setup_theme', 'lawyeria_lite_theme_setup' );


/**
 *  WP Enqueue Style
 */
function lawyeria_lite_enqueue_style() {
    wp_enqueue_style( 'lawyeria_lite_style', get_stylesheet_uri(), array(), '1.0' );
    wp_enqueue_style( 'lawyeria_lite_fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css', array(), '1.0' );
}

add_action( 'wp_enqueue_scripts', 'lawyeria_lite_enqueue_style' );

function lawyeria_lite_slug_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lato = _x( 'on', 'Lato font: on or off', 'zerif-lite' );

   /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $roboto = _x( 'on', 'Roboto font: on or off', 'zerif-lite' );
 
    if ( 'off' !== $lato || 'off' !== $roboto ) {
        $font_families = array();
 
        
        if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:300,400,700,400italic,700italic';
        }
 
        
        if ( 'off' !== $roboto ) {
            $font_families[] = 'Roboto Slab:300,100,400,700';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

/**
 *  WP Enqueue Script
 */
function lawyeria_lite_enqueue_scripts() {
    wp_enqueue_style('lawyeria_lite_font', lawyeria_lite_slug_fonts_url(), array(), null );
    wp_enqueue_script( 'lawyeria_lite_fancybox_script', get_template_directory_uri() . '/js/jquery.fancybox.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'lawyeria_lite_masonry', get_template_directory_uri() . '/js/jquery.masonry.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'lawyeria_lite_scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0', true );
    if ( is_singular() ) wp_enqueue_script( "comment-reply" );
}

add_action( 'wp_enqueue_scripts', 'lawyeria_lite_enqueue_scripts' );

/**
 *  Add classes for next and previous navigation
 */
add_filter('next_posts_link_attributes', 'lawyeria_lite_posts_link_attributes_prev');
add_filter('previous_posts_link_attributes', 'lawyeria_lite_posts_link_attributes_next');

function lawyeria_lite_posts_link_attributes_prev() {
    return 'class="left-navigation"';
}

function lawyeria_lite_posts_link_attributes_next() {
    return 'class="right-navigation"';
}

/**
 *  Add classes for next and previous post
 */
function lawyeria_lite_posts_link_next_class($format){
     $format = str_replace('href=', 'class="next-post" href=', $format);
     return $format;
}
add_filter('next_post_link', 'lawyeria_lite_posts_link_next_class');

function lawyeria_lite_posts_link_prev_class($format) {
     $format = str_replace('href=', 'class="previous-post" href=', $format);
     return $format;
}
add_filter('previous_post_link', 'lawyeria_lite_posts_link_prev_class');

/**
 *  Right Sidebar
 */
function lawyeria_lite_right_sidebar() {

	$args = array(
		'id'            => 'right-sidebar',
		'name'          => __( 'General Sidebar', 'lawyeria-lite' ),
		'description'   => __( 'Use this sidebar to display widgets in your website, including posts and pages.', 'lawyeria-lite' ),
		'before_title'  => '<div class="title-widget">',
		'after_title'   => '</div>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	);
	register_sidebar( $args );

}

add_action( 'widgets_init', 'lawyeria_lite_right_sidebar' );

/**
 *  Footer Sidebar - One
 */
function lawyeria_lite_footer_sidebar() {

    $args = array(
        'id'            => 'footer-sidebar',
        'name'          => __( 'Footer Sidebar', 'lawyeria-lite' ),
        'description'   => __( 'In this sidebar you cand add max. three widgets.', 'lawyeria-lite' ),
        'before_title'  => '<div class="footer-box-title">',
        'after_title'   => '</div>',
        'before_widget' => '<div id="%1$s" class="footer-box %2$s">',
        'after_widget'  => '</div>',
    );
    register_sidebar( $args );

}

add_action( 'widgets_init', 'lawyeria_lite_footer_sidebar' );

/**
 *  Shape Comment
 */
if ( ! function_exists( 'lawyeria_lite_shape_comment' ) ) :

function lawyeria_lite_shape_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'lawyeria-lite' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'lawyeria-lite' ), ' ' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <?php echo get_avatar( $comment, 120 ); ?>
            <div class="comment-entry">
                <div class="comment-entry-head">
                    <?php printf( __( '<span>%s</span>', 'lawyeria-lite' ), sprintf( '%s', get_comment_author_link() ) ); ?> -
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-entry-head-date">
                        <time pubdate datetime="<?php comment_time( 'c' ); ?>">
                            <?php printf( __( '%1$s at %2$s', 'lawyeria-lite' ), get_comment_date(), get_comment_time() ); ?>
                        </time>
                    </a><!--/a .comment-entry-head-date-->
                    <?php edit_comment_link( __( 'Edit', 'lawyeria-lite' ), '- ' ); ?>
                </div><!--/div .comment-entry-head-->
                <div class="comment-entry-content">
                    <?php comment_text(); ?>
                </div><!--/div .comment-entry-content-->
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="awaiting-moderation cf"><?php _e( 'Your comment is awaiting moderation.', 'lawyeria-lite' ); ?></em><br />
                <?php endif; ?>
                <div class="coment-reply-link-div cf">
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!--/div .coment-reply-link-div-->
            </div><!--/div .comment-entry-->
        </article><!--/article-->

    <?php
            break;
    endswitch;
}
endif;

/**
 *  Post Gallery
 */
add_filter('post_gallery', 'lawyeria_lite_post_gallery', 10, 2);
function lawyeria_lite_post_gallery($output, $attr) {

    global $post;

    if (isset($attr['orderby'])) {
        $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
        if (!$attr['orderby'])
            unset($attr['orderby']);
    }

    extract(shortcode_atts(array(
        'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => ''
    ), $attr));

    $id = intval($id);
    if ('RAND' == $order) $orderby = 'none';

    if (!empty($include)) {
        $include = preg_replace('/[^0-9,]+/', '', $include);
        $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

        $attachments = array();
        foreach ($_attachments as $key => $val) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    }

    if (empty($attachments)) return '';
    // Here's your actual output, you may customize it to your need
    $output = "<div id='custom-gallery gallery-". $post->ID ."' class='gallery galleryid-". $post->ID ." gallery-columns-". $columns ."'>\n";

    // Now you loop through each attachment
    foreach ($attachments as $id => $attachment) {
        $img = wp_get_attachment_image_src($id, 'full');

        $output .= "<dl class='gallery-item gallery-columns-". $columns ."'>";
        $output .= "<a href=\"{$img[0]}\" rel='post-". $post->ID ."' class=\"fancybox\" title='". $attachment->post_excerpt ."'>\n";
        $output .= "<div class='gallery-item-thumb'><img src=\"{$img[0]}\" alt='". $attachment->post_excerpt ."' /></div>\n";
        $output .= "<div class='wp-caption-text'>";
        $output .= $attachment->post_excerpt;
        $output .= "</div>";
        $output .= "</a>\n";
        $output .= "</dl>";
    }

    $output .= "</div>\n";

    return $output;
}
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'lawyeria_lite_required_plugins' );
function lawyeria_lite_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      => 'Revive Old Post',
            'slug'      => 'tweet-old-post',
            'required'  => false,
        ),

        array(
            'name'      => 'WP Product Review',
            'slug'      => 'wp-product-review',
            'required'  => false,
        ),
    

    );

    // Change this to your theme text domain, used for internationalising strings
    $theme_text_domain = 'lawyeria-lite';

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => 'lawyeria-lite',           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                          // Default absolute path to pre-packaged plugins
        'menu'              => 'install-required-plugins',  // Menu slug
        'has_notices'       => true,                        // Show admin notices or not
        'is_automatic'      => false,                       // Automatically activate plugins after installation or not
        'message'           => '',                          // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => __( 'Install Required Plugins', 'lawyeria-lite' ),
            'menu_title'                                => __( 'Install Plugins', 'lawyeria-lite' ),
            'installing'                                => __( 'Installing Plugin: %s', 'lawyeria-lite' ), // %1$s = plugin name
            'oops'                                      => __( 'Something went wrong with the plugin API.', 'lawyeria-lite' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','lawyeria-lite' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','lawyeria-lite' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','lawyeria-lite' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','lawyeria-lite' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','lawyeria-lite' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','lawyeria-lite' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','lawyeria-lite' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','lawyeria-lite' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins','lawyeria-lite' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins','lawyeria-lite' ),
            'return'                                    => __( 'Return to Required Plugins Installer', 'lawyeria-lite' ),
            'plugin_activated'                          => __( 'Plugin activated successfully.', 'lawyeria-lite' ),
            'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'lawyeria-lite' ), // %1$s = dashboard link
            'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
        )
    );

    tgmpa( $plugins, $config );

}

// Custom title function
function lawyeria_lite_wp_title( $title, $sep ) {
    global $paged, $page;

    if ( is_feed() )
        return $title;

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) )
        $title = "$title $sep $site_description";

    // Add a page number if necessary.
    if ( $paged >= 2 || $page >= 2 )
        $title = "$title $sep " . sprintf( __( 'Page %s', 'lawyeria-lite' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'lawyeria_lite_wp_title', 10, 2 );

/*
* Default title
*/
add_filter( 'the_title', 'lawyeria_lite_default_title' );

function lawyeria_lite_default_title( $title ) {

	if($title == '')
		$title = "Default title";

	return $title;
}