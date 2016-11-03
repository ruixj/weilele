<?php
/*
Plugin Name: WPJAM BASIC
Plugin URI: http://wpjam.net/item/wpjam-basic/
Description: WPJAM 常用的函数和 Hook，屏蔽所有 WordPress 所有不常用的功能。
Version: 2.4.1
Author: Denis
Author URI: http://blog.wpjam.com/
*/

define('WPJAM_BASIC_PLUGIN_URL', plugins_url('', __FILE__));
define('WPJAM_BASIC_PLUGIN_DIR', WP_PLUGIN_DIR.'/'. dirname(plugin_basename(__FILE__)));
define('WPJAM_BASIC_PLUGIN_FILE',  __FILE__);

if(!function_exists('wpjam_option_page')){
	include(WPJAM_BASIC_PLUGIN_DIR.'/include/wpjam-setting-api.php');	// 加载 WPJAM 后台选项设置基本函数库
}

if(!function_exists('wpjam_list_table')){
	include(WPJAM_BASIC_PLUGIN_DIR.'/include/wpjam-list-table.php');	// 加载 WPJAM 数据列表展示类
}

if(!function_exists('wpjam_topics_page')){
	include(WPJAM_BASIC_PLUGIN_DIR.'/include/topic.php');
}

include(WPJAM_BASIC_PLUGIN_DIR.'/wpjam-options.php');	// 设置
include(WPJAM_BASIC_PLUGIN_DIR.'/wpjam-functions.php');	// 提供的额外函数
include(WPJAM_BASIC_PLUGIN_DIR.'/wpjam-user.php');		// 用户相关
include(WPJAM_BASIC_PLUGIN_DIR.'/wpjam-ogp.php');		// OGP 
include(WPJAM_BASIC_PLUGIN_DIR.'/wpjam-shortcode.php');	// Shortcode 
include(WPJAM_BASIC_PLUGIN_DIR.'/wpjam-custom.php');	// 后台定制 
include(WPJAM_BASIC_PLUGIN_DIR.'/wpjam-cache.php');		// 缓存函数 


if(wpjam_basic_get_setting('active_seo')){
	include(WPJAM_BASIC_PLUGIN_DIR.'/wpjam-seo.php');	// SEO
}

if(wpjam_basic_get_setting('active_stats')){
	include(WPJAM_BASIC_PLUGIN_DIR.'/wpjam-stats.php');	// 统计相关 
}

if(wpjam_basic_get_setting('active_smtp')){
	include(WPJAM_BASIC_PLUGIN_DIR.'/wpjam-smtp.php');	// SMTP
}

//禁用 WP 初始化之前的主题检查
//remove_action( 'init','check_theme_switched',99);

//移除 WP_Head 无关紧要的代码
if(wpjam_basic_get_setting('remove_head_links')){
	remove_action( 'wp_head', 'wp_generator');					//删除 head 中的 WP 版本号
	remove_action( 'wp_head', 'rsd_link' );						//删除 head 中的 RSD LINK
	remove_action( 'wp_head', 'wlwmanifest_link' );				//删除 head 中的 Windows Live Writer 的适配器？ 

	remove_action( 'wp_head', 'feed_links_extra', 3 );		  	//删除 head 中的 Feed 相关的link
	//remove_action( 'wp_head', 'feed_links', 2 );	

	remove_action( 'wp_head', 'index_rel_link' );				//删除 head 中首页，上级，开始，相连的日志链接
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); 
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );	//删除 head 中的 shortlink

	remove_action( 'template_redirect','wp_shortlink_header', 11, 0 );	//删除短链接通知，不知道这个是干啥的。
}

//让用户自己决定是否书写正确的 WordPress
foreach ( array( 'the_content', 'the_title', 'wp_title' ) as $filter ){
	remove_filter( $filter, 'capital_P_dangit', 11 );
}
remove_filter( 'comment_text', 'capital_P_dangit', 31 );

//让 Shortcode 优先于 wpautop 执行。
if(wpjam_basic_get_setting('shortcode_first')){
	remove_filter( 'the_content', 'wpautop' );
	add_filter( 'the_content', 'wpautop' , 12);
	remove_filter( 'the_content', 'shortcode_unautop'  );
	add_filter( 'the_content', 'shortcode_unautop', 13  );
}

// 屏蔽 REST API
if(wpjam_basic_get_setting('disable_rest_api')){
	remove_action( 'init',          'rest_api_init' );
	remove_action( 'rest_api_init', 'rest_api_default_filters', 10 );
	remove_action( 'parse_request', 'rest_api_loaded' );

	add_filter('rest_enabled', '__return_false');
	add_filter('rest_jsonp_enabled', '__return_false');

	// 移除头部 wp-json 标签和 HTTP header 中的 link 
	remove_action('wp_head', 'rest_output_link_wp_head', 10 );
	remove_action('template_redirect', 'rest_output_link_header', 11 );
}

//禁用 Auto OEmbed
if(wpjam_basic_get_setting('disable_autoembed')){ 
	//remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
	remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
	//remove_action( 'pre_post_update', array( $GLOBALS['wp_embed'], 'delete_oembed_caches' ) );
	//remove_action( 'edit_form_advanced', array( $GLOBALS['wp_embed'], 'maybe_run_ajax_cache' ) );
}

if(wpjam_basic_get_setting('disable_post_embed')){  
	
	remove_action( 'rest_api_init', 'wp_oembed_register_route' );
	remove_filter( 'rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4 );

	add_filter( 'embed_oembed_discover', '__return_false' );

	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
	remove_filter( 'oembed_response_data',   'get_oembed_response_data_rich',  10, 4 );

	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );

	add_filter( 'tiny_mce_plugins', 'wpjam_disable_post_embed_tiny_mce_plugin' );
	function wpjam_disable_post_embed_tiny_mce_plugin($plugins){
		return array_diff( $plugins, array( 'wpembed' ) );
	}

	add_filter('query_vars', 'wpjam_wpjam_disable_post_embed_query_var');
	function wpjam_wpjam_disable_post_embed_query_var($public_query_vars) {
		return array_diff($public_query_vars, array('embed'));
	}
}

//禁用日志修订功能
if(wpjam_basic_get_setting('diable_revision')){
	define('WP_POST_REVISIONS', false);
	remove_action ( 'pre_post_update', 'wp_save_post_revision' );

	// 自动保存设置为10个小时
	define('AUTOSAVE_INTERVAL', 36000 ); 

	/* 禁用后台自动保存 */
	/*add_action('admin_print_scripts', 'plugin_deregister_autosave');
	function plugin_deregister_autosave() {
		wp_deregister_script('autosave');
	}*/
}

//移除 admin bar
if(wpjam_basic_get_setting('remove_admin_bar')){
	add_filter('show_admin_bar', '__return_false');
}

//去除后台首页面板的功能 
if(wpjam_basic_get_setting('remove_dashboard_widgets')){
	add_action('wp_dashboard_setup', 'wpjam_remove_dashboard_widgets');
	function wpjam_remove_dashboard_widgets(){
		global $wp_meta_boxes;
		unset($wp_meta_boxes['dashboard']['normal']);
		unset($wp_meta_boxes['dashboard']['side']);
	}
}

//禁用 WP_CRON
if(wpjam_basic_get_setting('disable_cron')){
	defined('DISABLE_WP_CRON');
	remove_action( 'init', 'wp_cron' );
}

//禁用 XML-RPC 接口
if(wpjam_basic_get_setting('disable_xml_rpc')){
	add_filter('xmlrpc_enabled', '__return_false');
}

if(wpjam_basic_get_setting('disable_trackbacks')){
	//彻底关闭 pingback
	add_filter('xmlrpc_methods','wpjam_xmlrpc_methods');
	function wpjam_xmlrpc_methods($methods){
		$methods['pingback.ping'] = '__return_false';
		$methods['pingback.extensions.getPingbacks'] = '__return_false';
		return $methods;
	}

	//禁用 pingbacks, enclosures, trackbacks 
	remove_action( 'do_pings', 'do_all_pings', 10, 1 );

	//去掉 _encloseme 和 do_ping 操作。
	remove_action( 'publish_post','_publish_post_hook',5, 1 );
}

// Removes the white spaces from wp_title
add_filter('wp_title', 'trim');

//remove_action( 'admin_init', 'register_admin_color_schemes', 1);
//remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

//阻止非法访问
add_action('init','wpjam_block_bad_queries');
function wpjam_block_bad_queries(){
	if(is_admin()){
		return;
	}
	if(strlen($_SERVER['REQUEST_URI']) > 255 ||
		strpos($_SERVER['REQUEST_URI'], "eval(") ||
		strpos($_SERVER['REQUEST_URI'], "base64")) {
			@header("HTTP/1.1 414 Request-URI Too Long");
			@header("Status: 414 Request-URI Too Long");
			@header("Connection: Close");
			@exit;
	}
}

// 修改 WordPress Admin text
add_filter('admin_footer_text', 'wpjam_modify_admin_footer_text');
function wpjam_modify_admin_footer_text ($text) {
	if(wpjam_basic_get_setting('admin_footer_text')){
		return wpjam_basic_get_setting('admin_footer_text');
	}else{
		return $text .' | <a href="http://wpjam.com/" title="WordPress JAM" target="_blank">WordPress JAM</a> | <a href="http://wpjam.net/" title="WPJAM 应用商城" target="_blank">WPJAM 应用商城</a>';
	}
}

//修改 WordPress Dashboard
//add_action('wp_dashboard_setup', 'wpjam_modify_dashboard_widgets' );
//function wpjam_modify_dashboard_widgets() {
//	global $wp_meta_boxes;

	//wp_add_dashboard_widget('wpjam_dashboard_widget', 'WordPress JAM', 'wpjam_dashboard_widget_function');

	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
//}

//给页面添加摘要
add_action( 'admin_menu', 'wpjam_page_excerpt_meta_box' );
function wpjam_page_excerpt_meta_box() {
	add_meta_box( 'postexcerpt', __('Excerpt'), 'post_excerpt_meta_box', 'page', 'normal', 'core' );
}

//前台不加载语言包
if(wpjam_basic_get_setting('locale')){
	add_filter( 'locale', 'wpjam_locale' );
	function wpjam_locale($locale) {
		$locale = ( is_admin() ) ? $locale : 'en_US';
		return $locale;
	}
}else{
	//删除中文包中的一些无用代码
	add_action('init','remove_zh_ch_functions');
	function remove_zh_ch_functions(){
		remove_action( 'admin_init', 'zh_cn_l10n_legacy_option_cleanup' );
		wp_embed_unregister_handler('tudou');
		wp_embed_unregister_handler('youku');
		wp_embed_unregister_handler('56com');
	}
}

if(wpjam_basic_get_setting('defer') && !is_admin() ){
	add_filter( 'clean_url', 'wpjam_defer_script',11);
	function wpjam_defer_script( $url ){
		if(strpos($url, '.js') === false || (is_singular() && get_post_meta(get_the_ID(), 'custom_footer', true))) { 
			return $url;
		}

		return "$url' defer='defer";
	};
}

//屏蔽后台功能提示
if(wpjam_basic_get_setting('disable_update')){
	add_filter ('pre_site_transient_update_core', '__return_null');

	remove_action ('load-update-core.php', 'wp_update_plugins');
	add_filter ('pre_site_transient_update_plugins', '__return_null');

	remove_action ('load-update-core.php', 'wp_update_themes');
	add_filter ('pre_site_transient_update_themes', '__return_null');
}

// 用户未登录时，设置 304 header
if(wpjam_basic_get_setting('304_headers')){
	add_filter('wp_headers','wpjam_headers',10,2);
	function wpjam_headers($headers,$wp){
		unset($headers['X-Pingback']);
		if(!is_user_logged_in() && empty($wp->query_vars['feed'])){
			$headers['Cache-Control']	= 'max-age:600';
			$headers['Expires']		 = gmdate('D, d M Y H:i:s', time()+600) . " GMT";

			$wpjam_timestamp = get_lastpostmodified('GMT')>get_lastcommentmodified('GMT')?get_lastpostmodified('GMT'):get_lastcommentmodified('GMT');
			$wp_last_modified = mysql2date('D, d M Y H:i:s', $wpjam_timestamp, 0).' GMT';
			$wp_etag = '"' . md5($wp_last_modified) . '"';
			$headers['Last-Modified'] = $wp_last_modified;
			$headers['ETag'] = $wp_etag;

			// Support for Conditional GET
			if (isset($_SERVER['HTTP_IF_NONE_MATCH']))
				$client_etag = stripslashes(stripslashes($_SERVER['HTTP_IF_NONE_MATCH']));
			else $client_etag = false;

			$client_last_modified = empty($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? '' : trim($_SERVER['HTTP_IF_MODIFIED_SINCE']);
			// If string is empty, return 0. If not, attempt to parse into a timestamp
			$client_modified_timestamp = $client_last_modified ? strtotime($client_last_modified) : 0;

			// Make a timestamp for our most recent modification...
			$wp_modified_timestamp = strtotime($wp_last_modified);

			$exit_required = false;

			if ( ($client_last_modified && $client_etag) ?
					 (($client_modified_timestamp >= $wp_modified_timestamp) && ($client_etag == $wp_etag)) :
					 (($client_modified_timestamp >= $wp_modified_timestamp) || ($client_etag == $wp_etag)) ) {
				$status = 304;
				$exit_required = true;
			}

			if ( $exit_required ){
				if ( ! empty( $status ) ){
					status_header( $status );
				}
				foreach( (array) $headers as $name => $field_value ){
					@header("{$name}: {$field_value}");
				}

				if ( isset( $headers['Last-Modified'] ) && empty( $headers['Last-Modified'] ) && function_exists( 'header_remove' ) ){
					@header_remove( 'Last-Modified' );
				}
				
				exit();	
			} 
		} 
		return $headers;
	}
}


add_action('admin_init', 'wpjam_show_id_init',99);
function wpjam_show_id_init(){
	// 在后台页面列表显示使用的页面模板
	add_filter('manage_pages_columns', 'wpjam_manage_pages_columns_add_template');
	function wpjam_manage_pages_columns_add_template($columns){
		$columns['template'] = '模板文件';
		return $columns;
	}

	add_action('manage_pages_custom_column','wpjam_manage_pages_custom_column_show_template',10,2);
	function wpjam_manage_pages_custom_column_show_template($column_name,$id){
		if ($column_name == 'template') {
			echo get_page_template_slug();
		}
	}

	// 显示 Post ID
	add_filter('post_row_actions', 'wpjam_post_row_actionss_show_post_id', 10, 2);
	add_filter('page_row_actions', 'wpjam_post_row_actionss_show_post_id', 10, 2);
	add_filter('media_row_actions', 'wpjam_post_row_actionss_show_post_id', 10, 2);
	function wpjam_post_row_actionss_show_post_id($actions, $post){
		$actions['post_id'] = 'ID: '.$post->ID;
		return $actions;
	}

	// 显示 标签，分类，tax ID
	$custom_taxonomies = get_taxonomies(array( 'public' => true )); 
	if($custom_taxonomies){
		foreach ($custom_taxonomies as $taxonomy) {
			add_filter($taxonomy.'_row_actions','wpjam_taxonomy_row_actions_show_term_id',10,2);
		}
	}
	function wpjam_taxonomy_row_actions_show_term_id($actions, $tag){
		$actions['term_id'] = 'ID：'.$tag->term_id;
		return $actions;

	}

	// 显示用户 ID
	add_filter('ms_user_row_actions','wpjam_user_row_actions_show_user_id',10,2);
	add_filter('user_row_actions', 'wpjam_user_row_actions_show_user_id', 10, 2);
	function wpjam_user_row_actions_show_user_id($actions, $user_object){
		$actions['user_id'] = 'ID: '.$user_object->ID;
		return $actions;
	}

	// 显示留言 ID
	add_filter('comment_row_actions','wpjam_comment_row_actions_show_comment_id',10,2);
	function wpjam_comment_row_actions_show_comment_id($actions, $comment){
		$actions['comment_id'] = 'ID：'.$comment->comment_ID;
		return $actions;
	}

}

// if(wpjam_basic_get_setting('remove_unuse_rewrite')){
// 	add_action('generate_rewrite_rules', 'wpjam_generate_rewrite_rules');
// 	function wpjam_generate_rewrite_rules($wp_rewrite){

// 		$wp_rewrite->rules = wpjam_remove_rewrite_rules($wp_rewrite->rules); 
// 		$wp_rewrite->extra_rules_top = wpjam_remove_rewrite_rules($wp_rewrite->extra_rules_top); 

// 		$new_rules = array();

// 		$new_rules['feed/(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?&feed=$matches[1]';		 //重新加回全站的 feed permalink
// 		$new_rules['(feed|rdf|rss|rss2|atom)/?$'] = 'index.php?&feed=$matches[1]';

// 		$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
// 	}

// 	function wpjam_remove_rewrite_rules($rules){
// 		foreach ($rules as $key => $value) {
// 			if( 
// 				strpos($key, 'comment-page')	!== false || 
// 				strpos($key, 'comment')			!== false || 
// 				strpos($key, 'author')			!== false || 
// 				//strpos($key, 'type')			!== false || 
// 				strpos($value, 'feed=')			!== false ||
// 				strpos($value, 'attachment')	!== false || 
// 				strpos($value, 'tb=1')			!== false 
// 			){

// 				unset($rules[$key]);
// 			}
// 		}
// 		return $rules;
// 	}
// }

//当搜索结果只有一篇时直接重定向到日志
add_action('template_redirect', 'wpjam_redirect_single_post');
function wpjam_redirect_single_post() {
	if (is_search()) {
		global $wp_query;
		if ($wp_query->post_count == 1) {
			wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
		}
	}
}

// postview 加上内存缓存，每增加10次浏览才写入数据库
if(wpjam_basic_get_setting('postviews_cache')){
	add_action('init','wpjam_postviews');
}
function wpjam_postviews(){
	global $wp_object_cache;
	if(function_exists('process_postviews') && wp_using_ext_object_cache()){ //已经安装了 postview 插件，并且系统启用了 Memcached
			
		add_filter('update_post_metadata','wpjam_postviews_update_post_metadata',10,5);
		function wpjam_postviews_update_post_metadata($check, $object_id, $meta_key, $meta_value, $prev_value ){
			if($meta_key == 'views'){
				
				wp_cache_set($object_id, $meta_value,'views'); 

				if($meta_value%10 == 0){ //每增加 10 次浏览才写入数据库中去
					return $check;
				}else{
					return true;
				}
			}else{
				return $check;
			}
		}

		add_filter('get_post_metadata','wpjam_postviews_get_post_metadata',10,4);
		function wpjam_postviews_get_post_metadata($check, $object_id, $meta_key, $single ){
			if($meta_key == 'views' ){
				$views = wp_cache_get($object_id,'views'); //显示的时候直接从内存中获取

				if($views === false){
					return $check;
				}else{
					return $views;
				}
			}elseif($meta_key == ''){
				$views = wp_cache_get($object_id,'views'); 

				if($views === false){
					return $check;
				}else{
					$meta_cache = wp_cache_get($object_id, 'post_meta');

					if ( !$meta_cache ) {
						$meta_cache = update_meta_cache( 'post', array( $object_id ) );
						$meta_cache = $meta_cache[$object_id];
					}

					$meta_cache['views'][0] = $views;

					return $meta_cache;
				}

			}else{
				return $check;					
			}

		}
		
	}
}

//解决日志改变 post type 之后跳转错误的问题，
add_action( 'template_redirect', 'wpjam_old_slug_redirect',1);
function wpjam_old_slug_redirect() {
	global $wp_query;
	if ( is_404() && '' != $wp_query->query_vars['name'] ) :

		//remove_action( 'template_redirect', 'wp_old_slug_redirect');
		//remove_action( 'template_redirect', 'redirect_canonical');
	
		global $wpdb;

		$query = $wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_old_slug' AND meta_value = %s", $wp_query->query_vars['name']);

		$id = (int) $wpdb->get_var($query);

		if ( !$id ){
			$link = wpjam_redirect_guess_404_permalink();
		}else{
			$link = get_permalink($id);
		}

		if ( !$link )
			return;

		wp_redirect( $link, 301 ); 
		exit;
	endif;
}

function wpjam_redirect_guess_404_permalink() {
	global $wpdb, $wp_rewrite;

	if( get_query_var('name') == 'feed'){
		return false;
	}

	if ( get_query_var('name') ) {
		$where = $wpdb->prepare("post_name LIKE %s", $wpdb->esc_like( get_query_var('name') ) . '%');

		$post_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE $where AND post_status = 'publish'");
		if ( ! $post_id )
			return false;
		if ( get_query_var( 'feed' ) )
			return get_post_comments_feed_link( $post_id, get_query_var( 'feed' ) );
		elseif ( get_query_var( 'page' ) )
			return trailingslashit( get_permalink( $post_id ) ) . user_trailingslashit( get_query_var( 'page' ), 'single_paged' );
		else
			return get_permalink( $post_id );
	}

	return false;
}
