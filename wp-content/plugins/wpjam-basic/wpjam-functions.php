<?php
//WP Pagenavi
function wpjam_pagenavi(){
    global $wp_query;   

    $big = 999999999; // need an unlikely integer
    
    $pagination = array(
        'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format'    => '',
        'total'     => $wp_query->max_num_pages,
        'current'   => max( 1, get_query_var('paged') ),
        'prev_text' => __('&laquo;'),
        'next_text' => __('&raquo;'),
        'end_size'  => 2,
        'mid_size'  => 2
    );

    echo '<div class="pagenavi">'.paginate_links($pagination).'</div>'; 
}

function wpjam_is_mobile() {

    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        return false;
    } elseif ( ( strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false  && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') === false) // many mobile devices (all iPh, etc.)
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mobi') !== false ) {
            return true;
    } else {
        return false;
    }
}

if(!function_exists('get_post_first_image')){
    //获取日志内容的第一张图片
    function get_post_first_image($post_content=''){
        if(!$post_content){
            $post = get_post();
            $post_content = $post->post_content;
        }
        preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', do_shortcode($post_content), $matches);
        if( $matches && isset($matches[1]) && isset($matches[1][0]) ){       
            return $matches[1][0];
        }else{
            return false;
        }
    }
}

if(!function_exists('get_post_thumbnail')){
    function get_post_thumbnail($post=null,$size='thumbnail'){
        $post = get_post($post);

        $thumbnail_id = get_post_thumbnail_id($post->ID);
        if($thumbnail_id){
            $thumb = wp_get_attachment_image_src($thumbnail_id, $size);
            $thumb = $thumb[0];
        }else{
            $thumb = get_post_first_image($post->post_content);
        }
        return $thumb;
    }
}

remove_filter( 'get_the_excerpt', 'wp_trim_excerpt'  );
add_filter('get_the_excerpt','wpjam_get_the_excerpt');
function wpjam_get_the_excerpt($post_excerpt){
    return get_post_excerpt();
}

if(!function_exists('get_post_excerpt')){   
    //获取日志摘要
    function get_post_excerpt($post=null, $excerpt_length=240){
        $post = get_post($post);

        $post_excerpt = $post->post_excerpt;
        if($post_excerpt == ''){
            $post_content = $post->post_content;

            $post_content = apply_filters('the_content',$post_content);

            $post_content = wp_strip_all_tags( $post_content );

            $excerpt_length = apply_filters('excerpt_length', $excerpt_length);     
            $excerpt_more   = apply_filters('excerpt_more', ' ' . '...');

            $post_excerpt = get_first_p($post_content); // 获取第一段

            if(mb_strwidth($post_excerpt) < $excerpt_length*1/3 || mb_strwidth($post_excerpt) > $excerpt_length){ // 如果第一段太短或者太长，就获取内容的前 $excerpt_length 字
                $post_excerpt = mb_strimwidth($post_content,0,$excerpt_length,$excerpt_more,'utf-8');
            }
        }

        $post_excerpt = wp_strip_all_tags( $post_excerpt );
        $post_excerpt = trim( preg_replace( "/[\n\r\t ]+/", ' ', $post_excerpt ), ' ' );

        return $post_excerpt;
    }

    //获取第一段
    function get_first_p($text){
        if($text){
            $text = explode("\n",strip_tags($text)); 
            $text = trim($text['0']); 
        }
        return $text;
    }
}

function wpjam_blacklist_check($str){
    $moderation_keys = trim(get_option('moderation_keys'));
    $blacklist_keys = trim(get_option('blacklist_keys'));

    $keys = $moderation_keys ."\n".$blacklist_keys;

    $words = explode("\n", $keys );

    foreach ( (array) $words as $word) {
        $word = trim($word);

        // Skip empty lines
        if ( empty($word) )
            continue;

        // Do some escaping magic so that '#' chars in the
        // spam words don't break things:
        $word = preg_quote($word, '#');

        $pattern = "#$word#i";
        if ( preg_match($pattern, $str) ) return true;
    }

    return false;
}

//获取纯文本
function get_plain_text($text){

    $text = wp_strip_all_tags($text);
    
    $text = str_replace('"', '', $text); 
    $text = str_replace('\'', '', $text);    
    // replace newlines on mac / windows?
    $text = str_replace("\r\n", ' ', $text);
    // maybe linux uses this alone
    $text = str_replace("\n", ' ', $text);
    $text = str_replace("  ", ' ', $text);
    return $text;
}

/*判断是否是机器人*/
function is_bot(){
    $useragent = trim($_SERVER['HTTP_USER_AGENT']);
    if(stristr($useragent, 'bot') !== false || stristr($useragent, 'spider') !== false){
        return true;
    }
    return false;
}

//给 wp_nav_menu 加上对象缓存，加快效率
function wpjam_nav_menu( $args = array() ) {
    static $menu_id_slugs = array();

    $defaults = array( 'menu' => '', 'container' => 'div', 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
    'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth' => 0, 'walker' => '', 'theme_location' => '' );

    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'wp_nav_menu_args', $args );
    $args = (object) $args;

    // Get the nav menu based on the requested menu
    $menu = wp_get_nav_menu_object( $args->menu );

    // Get the nav menu based on the theme_location
    if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
        $menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );

    // get the first menu that has items if we still can't find a menu
    if ( ! $menu && !$args->theme_location ) {
        $menus = wp_get_nav_menus();
        foreach ( $menus as $menu_maybe ) {
            if ( $menu_items = wpjam_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) ) ) {
                $menu = $menu_maybe;
                break;
            }
        }
    }

    // If the menu exists, get its items.
    if ( $menu && ! is_wp_error($menu) && !isset($menu_items) )
        $menu_items = wpjam_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );

    /*
     * If no menu was found:
     *  - Fallback (if one was specified), or bail.
     *
     * If no menu items were found:
     *  - Fallback, but only if no theme location was specified.
     *  - Otherwise, bail.
     */
    if ( ( !$menu || is_wp_error($menu) || ( isset($menu_items) && empty($menu_items) && !$args->theme_location ) )
        && $args->fallback_cb && is_callable( $args->fallback_cb ) )
            return call_user_func( $args->fallback_cb, (array) $args );

    if ( !$menu || is_wp_error( $menu ) || empty( $menu_items ) )
        return false;

    $nav_menu = $items = '';

    $show_container = false;
    if ( $args->container ) {
        $allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );
        if ( in_array( $args->container, $allowed_tags ) ) {
            $show_container = true;
            $class = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-'. $menu->slug .'-container"';
            $id = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
            $nav_menu .= '<'. $args->container . $id . $class . '>';
        }
    }

    // Set up the $menu_item variables
    _wp_menu_item_classes_by_context( $menu_items );

    $sorted_menu_items = array();
    foreach ( (array) $menu_items as $key => $menu_item )
        $sorted_menu_items[$menu_item->menu_order] = $menu_item;

    unset($menu_items);

    $sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );

    $items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
    unset($sorted_menu_items);

    // Attributes
    if ( ! empty( $args->menu_id ) ) {
        $wrap_id = $args->menu_id;
    } else {
        $wrap_id = 'menu-' . $menu->slug;
        while ( in_array( $wrap_id, $menu_id_slugs ) ) {
            if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) )
                $wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
            else
                $wrap_id = $wrap_id . '-1';
        }
    }
    $menu_id_slugs[] = $wrap_id;

    $wrap_class = $args->menu_class ? $args->menu_class : '';

    // Allow plugins to hook into the menu to add their own <li>'s
    $items = apply_filters( 'wp_nav_menu_items', $items, $args );
    $items = apply_filters( "wp_nav_menu_{$menu->slug}_items", $items, $args );

    $nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), esc_attr( $wrap_class ), $items );
    unset( $items );

    if ( $show_container )
        $nav_menu .= '</' . $args->container . '>';

    $nav_menu = apply_filters( 'wp_nav_menu', $nav_menu, $args );

    if ( $args->echo )
        echo $nav_menu;
    else
        return $nav_menu;
}
function wpjam_get_nav_menu_items( $menu, $args = array() ) {
    $menu = wp_get_nav_menu_object( $menu );

    if($menu->term_id){
        $menu_items = apply_filters('pre_wpjam_nav_menu',false,$menu,$args);
        if($menu_items === false){
            $menu_items = get_transient('wpjam_nav_menu_'.$menu->term_id);
            if($menu_items === false){
                $menu_items = wp_get_nav_menu_items( $menu->term_id, $args );
                set_transient('wpjam_nav_menu_'.$menu->term_id, $menu_items, 3600);
            }        
        }
        return $menu_items;
    }
}

//后台更新自定义菜单的时候，更新缓存
add_action( 'wp_update_nav_menu', 'wpjam_update_nav_menu' );
function wpjam_update_nav_menu( $menu_id = null, $menu_data = null ) {
    delete_transient('wpjam_nav_menu_'.$menu_id);
}

function wpjam_format_size($size) {
    $measure = "B";

    if ($size >= 1024) {
        $size = $size / 1024;
        $measure = "K";
    }

    if ($size >= 1024) {
        $size = $size / 1024;
        $measure = "M";
    }

    $return = sprintf('%0.4s',$size);

    if (substr($return, -1) == "." ) $return = substr($return, 0, -1);


    return $return . " ". $measure;
}

function wpjam_get_post_type_labels($label_name){
    return array(
        'name'                  => $label_name,
        'singular_name'         => $label_name,
        'add_new'               => '新增'.$label_name,
        'add_new_item'          => '新增'.$label_name,
        'edit_item'             => '编辑'.$label_name,
        'new_item'              => '添加'.$label_name,
        'all_items'             => '所有'.$label_name,
        'view_item'             => '查看'.$label_name,
        'search_items'          => '搜索'.$label_name,
        'not_found'             => '找不到相关'.$label_name,
        'not_found_in_trash'    => '回收站中没有'.$label_name, 
        'parent_item_colon'     => '',
        'menu_name'             => $label_name
    );
}

function wpjam_get_taxonomy_labels($label_name){
    return array(
        'name'              => $label_name,
        'singular_name'     => $label_name,
        'search_items'      => '搜索'.$label_name,
        'popular_items'     => '最受欢迎的'.$label_name,
        'all_items'         => '所有'.$label_name,
        'parent_item'       => '父级'.$label_name,
        'parent_item_colon' => '父级'.$label_name,
        'edit_item'         => '编辑'.$label_name, 
        'update_item'       => '更新'.$label_name,
        'add_new_item'      => '新增'.$label_name,
        'new_item_name'     => '添加'.$label_name,
        'menu_name'         => $label_name
    ); 
}