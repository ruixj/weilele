<?php
/*
Author: LIQUID DESIGN
Author URI: https://lqd.jp/wp/
*/

// ------------------------------------
// scripts and styles
// ------------------------------------
function liquid_scripts_styles() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array() );
    wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/css/icomoon.css', array() );
    wp_enqueue_style( 'liquid-style', get_stylesheet_uri(), array() );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'liquid-script', get_template_directory_uri() . '/js/common.min.js', array( 'jquery' ) );
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'liquid_scripts_styles' );

// ------------------------------------
// wp_nav_menu
// ------------------------------------
function liquid_nav_class( $classes, $item ) {
    $classes[] = 'nav-item hidden-sm-down';
    return $classes;
}
add_filter( 'nav_menu_css_class', 'liquid_nav_class', 10, 2 );

// ------------------------------------
// widgets
// ------------------------------------
add_action( 'widgets_init', 'liquid_widgets_init' );
function liquid_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('sidebar', 'liquid' ),
        'id' => 'liquid_sidebar',
        'before_title' => '<div class="ttl">',
        'after_title' => '</div>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>'
    ));
    register_sidebar(array(
        'name' => esc_html__('main_head', 'liquid' ),
        'id' => 'liquid_main_head',
        'before_title' => '<div class="ttl">',
        'after_title' => '</div>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>'
    ));
    register_sidebar(array(
        'name' => esc_html__('main_foot', 'liquid' ),
        'id' => 'liquid_main_foot',
        'before_title' => '<div class="ttl">',
        'after_title' => '</div>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>'
    ));
    register_sidebar(array(
        'name' => esc_html__('top_header', 'liquid' ),
        'id' => 'liquid_top_header',
        'before_title' => '<div class="ttl">',
        'after_title' => '</div>',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>'
    ));
    register_sidebar(array(
        'name' => esc_html__('footer', 'liquid' ),
        'id' => 'liquid_footer',
        'before_title' => '<div class="ttl">',
        'after_title' => '</div>',
        'before_widget' => '<div id="%1$s" class="widget %2$s col-sm-4">',
        'after_widget'  => '</div>'
    ));
}

// body_class
add_filter('body_class', 'liquid_class_names');
function liquid_class_names($classes) {
    if (is_single()){
        $cat = get_the_category(); 
        $parent_cat_id = $cat[0]->parent;
        if(!$parent_cat_id){ $parent_cat_id = $cat[0]->cat_ID; }
        $classes[] = "category_".$parent_cat_id;
    }
    if (is_page()){
        $page = get_post( get_the_ID() );
        $slug = $page->post_name;
        $classes[] = "page_".$slug;
    }
	return $classes;
}

// add_theme_support
function liquid_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'automatic-feed-links' );
    if ( ! isset( $content_width ) ) $content_width = 1024;
    // languages
    load_theme_textdomain('liquid', get_template_directory() . '/languages');
    // nav_menu
    register_nav_menus(array(
        'global-menu' => esc_html__('Global Menu', 'liquid' )
    ));
    // custom-header
    add_theme_support( 'custom-header', array(
        'random-default'         => false,
        'width'                  => 1200,
        'height'                 => 600,
        'flex-height'            => true,
        'flex-width'             => false,
        'default-text-color'     => false,
        'header-text'            => false,
        'uploads'                => true,
        'admin-preview-callback' => 'liquid_admin_header_image',
    ) );
}
add_action( 'after_setup_theme', 'liquid_theme_setup' );

// custom-header-callback
function liquid_admin_header_image() {
?>
    <p class="header_preview">
        <?php bloginfo('description'); ?>
    </p>
    <?php if(get_header_image()): ?>
        <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo('name'); ?>" />
    <?php else : ?>
        <h2 class="header_preview"><?php bloginfo('name'); ?></h2>
    <?php endif; ?>
<?php
}

// Remove p tags from category description
remove_filter('term_description','wpautop');

// get_the_archive_title
function liquid_archive_title( $title ){
    if ( is_category() ) {
        $title = single_term_title( '', false );
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'liquid_archive_title', 10 );

// add post class
function liquid_post_class( $classes ) {
    if( is_archive() || is_search() ){
        $classes[] = 'card';
        $classes[] = 'col-sm-6';
    }elseif( is_single() ){
        $classes[] = 'detail';
    }else{
        $classes[] = 'card';
        $classes[] = 'col-md-4';
        $classes[] = 'col-sm-6';
    }
	return $classes;
}
add_filter( 'post_class', 'liquid_post_class' );

// navigation
function liquid_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&lt; 上一页', 'liquid' ),
		'next_text' => __( '下一页 &gt;', 'liquid' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<ul class="page-numbers">
			<li><?php echo $links; ?></li>
		</ul><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}
?>