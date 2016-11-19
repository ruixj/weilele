<?php  
/*
Plugin Name: Copyright plugin
Plugin URI: http://www.xxxx.com/plugins/
Description:微乐乐定制功能
Version: 1.0.0
Author: xcxc
Author URI: http://www.xxxx.com/
License: GPL
*/

  
register_activation_hook( __FILE__, 'xrui_plugin_install');   
register_deactivation_hook( __FILE__, 'xrui_plugin_remove' );  

function xrui_plugin_install() {  
	// global $wpdb;
	// $table_name = $wpdb->prefix .'bp_xprofile_fields';   
	// $query      = "SELECT * FROM ". $table_name . " WHERE name ='电话' and group_id = 1";
	// //$telfield   = $wpdb->get_row($query);  
	// $results    = $wpdb->get_results($query);
	// if($results)
		// return;
    
	// $data_array = array(  
		// 'group_id' =>1,
		// 'parent_id' =>0,
		// 'type'=>'mobiletel',
		// 'name'=>'电话',
		// 'description'=>'',
		// 'is_required'=>1,
		// 'is_default_option' =>0,
		// 'field_order' =>1,
		// 'option_order'=>0,
		// 'order_by'=>'',
		// 'can_delete'=>0
	// ); 
	
    // $format = array(  
		// '%d',
		// '%d',
		// '%s',
		// '%s',
		// '%s',
		// '%d',
		// '%d',
		// '%d',
		// '%d',
		// '%s',
		// '%d'
	// ); 	
	
    // $result = $wpdb->insert($table_name,$data_array,$format); 
	// if($result)
	// {
		// $id = $wpdb->insert_id;
		// $table_name = $wpdb->prefix .'bp_xprofile_meta';   
		// $data_array = array(  
			// 'object_id' =>$id,
			// 'object_type' =>'field',
			// 'meta_key'=>'default_visibility',
			// 'meta_value'=>'adminsonly'
		// );  
		// $format = array( '%d','%s','%s','%s');
		// $wpdb->insert($table_name,$data_array,$format);
		
	    
		// $data_array = array(  
			// 'object_id' =>$id,
			// 'object_type' =>'field',
			// 'meta_key'=>'allow_custom_visibility',
			// 'meta_value'=>'disabled'
		// );  
	 
		// $wpdb->insert($table_name,$data_array,$format);			
	// }
    global $wpdb;
    $table_name = $wpdb->prefix .'signups'; 	
	$addTel = "alter table ' . $table_name .' add tel varchar(100) ";
	
	$result     = $wpdb->query($sql);
	if($result == 1)
	{
		
	}
	
    $table_name = $wpdb->prefix .'users'; 	
	$addTel = "alter table ' . $table_name .' add tel varchar(100) ";
	
	$result     = $wpdb->query($sql);
	if($result == 1)
	{
		
	}	
}

function xrui_plugin_remove() 
{ 
	// global $wpdb;
    // $table_name = $wpdb->prefix .'bp_xprofile_fields';   
	// $query      = "SELECT * FROM ". $table_name . " WHERE name ='电话' and group_id = 1";
	// $telfield   = $wpdb->get_row($query);  
	 
	// $query      = "SELECT * FROM ". $table_name . " WHERE name ='电话' and group_id = 1";
	// $table_name = $wpdb->prefix .'bp_xprofile_meta'; 
	// $query      = "DELETE FROM " . $table_name . " WHERE object_id = " . $telfield->id ;
	// $wpdb->query($query);
	// //echo $mylink->link_id; // prints "10" 
}

// Directory
if ( ! defined( 'XRUI_PLUGIN_DIR' ) ) {
  define( 'XRUI_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

// Url
if ( ! defined( 'XRUI_PLUGIN_URL' ) ) {
  $plugin_url = plugin_dir_url( __FILE__ );

  // If we're using https, update the protocol. Workaround for WP13941, WP15928, WP19037.
  if ( is_ssl() )
    $plugin_url = str_replace( 'http://', 'https://', $plugin_url );

  define( 'XRUI_PLUGIN_URL', $plugin_url );
}

function xrui_plugin_css()
{
   // add custom.css
   $assets			 = XRUI_PLUGIN_URL. 'assets';
   wp_enqueue_style ( 'weilelecustom',  $assets . '/css/custom.css', array(), '1.0', 'all' ); 	
   wp_enqueue_script( 'weilelepostjs',  $assets . '/js/posts.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'xrui_plugin_css' );


function navigation_init()
{
   // Setup WP Toolbar menus.
   add_action( 'bp_setup_admin_bar',  'bookmark_setup_admin_bar', 60 );	
   add_action( 'bp_setup_nav', 'bookmark_setup_bookmark_nav', 100 );
   add_action( 'bp_setup_nav', 'member_setup_search_nav', 100 );
   add_action( 'bp_setup_nav', 'xrui_setup_me_nav', 100 );
}
add_action('plugins_loaded','navigation_init');	


function bookmark_setup_admin_bar()
{
	// Menus for logged in user.
	if ( is_user_logged_in() && bp_displayed_user_id() == get_current_user_id() )  
    {
		// global $wp_admin_bar;
		// $bookmarks_slug = bp_loggedin_user_domain().'bookmarks';				
		// $wp_admin_bar->add_menu( array(
			// 'parent' => 'my-account-buddypress',
			// 'id'     => 'my-bookmarks-blog',
			// 'title'  => _x( '我的收藏' , 'buddypress' ),
			// 'href'   => trailingslashit( $bookmarks_slug ),
			// 'meta'      => array(
						// 'class'     => 'menupop',
					// )
		// ) ); 
		global $wp_admin_bar;
		$blog_slug = bp_loggedin_user_domain().'blog/';	

		// $wp_admin_bar->add_menu( array(
			// 'parent' => 'my-account-blog',
			// 'id'     => 'my-account-blog-'.'createpost',
			// 'title'  => __( 'Add New Post', 'bp-user-blog' ),
			// 'href'   => trailingslashit( $blog_slug.'createpost' )
		// ) );
		
		// $wp_admin_bar->add_menu( array(
			// 'parent' => 'my-account-blog',
			// 'id'     => 'my-account-blog-'.'bookmarks',
			// 'title'  => __( '我的收藏', 'bp-user-blog' ),
			// 'href'   => trailingslashit( $blog_slug.'bookmarks' )
		// ) );		
		
		
	}
}

function bookmark_setup_bookmark_nav()
{
	$displayed_user_id = bp_displayed_user_id();
	$user_domain = ( ! empty( $displayed_user_id ) ) ? bp_displayed_user_domain() : bp_loggedin_user_domain();

	$blog_link = trailingslashit( $user_domain . __( 'blog', 'bp-user-blog' ) ) ;	
	if ( is_user_logged_in() && bp_displayed_user_id() == get_current_user_id() ) {	
		bp_core_new_subnav_item( 
		array(
			'name'            => __( '我的收藏', 'bp-user-blog' ),
			'slug'            => 'bookmarks',
			'parent_url'      => $blog_link,
			'parent_slug'     =>   __( 'blog', 'bp-user-blog' ),
			'screen_function' => 'sap_user_bookmark_page',
			'position' => 50,
		   )
		);
		
		// bp_core_new_subnav_item( 
			// array(
		 	 // 'name' => __( 'Add New Post', 'bp-user-blog' ),
			  // 'slug' => 'createpost',
			 // 'parent_url' => $blog_link,
			 // 'parent_slug' =>   __( 'blog', 'bp-user-blog' ),
			 // 'screen_function' => 'sap_user_postcreate_page',
			 // 'position' => 40,
		   // )
		// );		
	}
}

function sap_user_bookmark_page() {
	add_action( 'bp_template_content', 'sap_template_bookmark' );
    bp_core_load_template( apply_filters( 'sap_user_bookmark_page', 'members/single/plugins' ) );
}

function sap_template_bookmark() {
   sap_load_template( 'sap-bookmarks' );
}

function sap_user_postcreate_page() {
	add_action( 'bp_template_content', 'sap_template_postcreate' );
    bp_core_load_template( apply_filters( 'sap_user_postcreate_page', 'members/single/plugins' ) );
}

function sap_template_postcreate() {
   sap_load_template( 'sap-post-create' );
}

function member_setup_admin_bar()
{
	// Menus for logged in user.
	if ( is_user_logged_in() )
    {
		global $wp_admin_bar;
		$friends_link = bp_loggedin_user_domain().'membersearch';
		$slug         = bp_get_friends_slug();		
		$wp_admin_bar->add_menu( array(
			'parent' => 'my-account-buddypress',
			'id'     => 'membersearch',
			'title'  => _x( '添加朋友' , 'buddypress' ),
			'href'   => trailingslashit( $friends_link ) 
 
		) ); 
	}
}

function member_setup_search_nav()
{
	if ( is_user_logged_in() ) {
		global $bp;
		
		// Determine user to use.
		$user_domain = bp_loggedin_user_domain();
 
		 
		$slug         = bp_get_friends_slug();//bp_get_activity_slug();
		$friends_link = trailingslashit( $user_domain . $slug );	
		bp_core_new_subnav_item( array( 
			'name' => __( '添加朋友', 'buddypress' ), 
			'slug' => 'membersearch',
			'parent_url' => $friends_link,
			'parent_slug' => $slug,
			'position' => 30,
			'screen_function' => 'member_search_page2',
			'show_for_displayed_user' => true,
			'item_css_id' => 'membersearch'
		) );
 
		// bp_core_new_subnav_item( array( 
			// 'name' => __( '关注', 'buddypress' ), 
			// 'slug' => 'members-following',
			// 'parent_url' => $friends_link,
			// 'parent_slug' => $slug,
			// 'position' => 40,
			// 'screen_function' => 'bp_follow_screen_following',
			// 'show_for_displayed_user' => true,
			// 'item_css_id' => 'members-following'
		// ) );
	}
}

// function member_following_screen() {
	// add_action( 'bp_template_content', 'member_template_following' );
	// if ( apply_filters( 'bp_follow_allow_ajax_on_follow_pages', true ) ) {
		// // add the "Order by" dropdown filter
		// add_action( 'bp_member_plugin_options_nav',    'bp_follow_add_members_dropdown_filter' );

		// // add ability to use AJAX
		// add_action( 'bp_after_member_plugin_template', 'bp_follow_add_ajax_to_members_loop' );
	// }	
    // bp_core_load_template( apply_filters( 'member_following_screen', 'members/single/plugins' ) );
	 
// }
 

// function member_template_following() {
   // bp_get_template_part( 'members/single/follow' );
// }

function member_search_page2() {

 bp_core_load_template( apply_filters( 'friends_template_requests', 'members/single/home' ) );
}

function membersearch_template_bookmark() {
    bp_get_template_part( 'members/membersearch' ); 
}

////quanzhi
// function xrui_buddypress_quanzhi() {
	// global $bp;
	// bp_core_new_subnav_item( array( 
		// 'name' => __( 'My Own Setting', 'buddypress_login' ), 
		// 'slug' => 'email-pwd',
		// 'parent_url' => $bp->loggedin_user->domain . $bp->bp_nav['settings']['slug'] . '/',
		// 'parent_slug' => $bp->bp_nav['settings']['slug'],
		// 'position' => 100,
		// 'screen_function' => 'brain1981_budypress_recent_posts',
		// 'show_for_displayed_user' => true,
		// 'item_css_id' => 'brain1981_budypress_recent_posts'
	// ) );
// }
// add_action( 'bp_setup_nav', 'brain1981_buddypress_tab', 1000 );
 
// function xrui_budypress_recent_posts () {
	// add_action( 'bp_template_title', 'brain1981_buddypress_recent_posts_title' );
	// add_action( 'bp_template_content', 'brain1981_buddypress_recent_posts_content' );
	// bp_core_load_template(  get_template_directory_uri().'/buddypress/members/single/settings.php'  );
// }
// function xrui_buddypress_recent_posts_title() {
	// _e( 'My Own Setting', 'buddypress_login' );
// }
// function xrui_buddypress_recent_posts_content() {
	// //do something on the sub page
// } 
 
function redirect_after_login_per_role()
{
	//retrieve current user info 
	global $wp_roles, $user;
	    
	$roles = $wp_roles->roles;

	
	 //is there a user to check?
	foreach($roles as $role_slug => $role_options){
		if( isset( $user->roles ) && is_array( $user->roles ) ) {
			//check for admins
			if( in_array( $role_slug, $user->roles ) ) {
				
			}
		}
    }
	
}

function bp_xrui_redirect_to_profile( $redirect_to_calculated, $redirect_url_specified, $user ){
	if( empty( $redirect_to_calculated ) )
		$redirect_to_calculated = $redirect_url_specified;
 
	if( !is_wp_error($user) && !is_super_admin( $user->ID ) )
	{
		
		$user_domain       = bp_core_get_user_domain( $user->ID );
		$wall_profile_link = trailingslashit( $user_domain . buddypress()->activity->slug ).'following' ;
		return $wall_profile_link;//bp默认的用户中心首页
	}
		
	else
		return $redirect_to_calculated;  
     	
}
add_filter("login_redirect","bp_xrui_redirect_to_profile",100,3);

add_filter('logout_url', 'bp_xrui_logout_redirect', 10, 2);

function bp_xrui_logout_redirect($logouturl, $redir) {
  $redir = home_url(); // 这里改成你要跳转的网址
  return $logouturl . '&amp;redirect_to=' . urlencode($redir);
}

//function bp_xrui_remove_admin_bar() {
	//if( !is_super_admin() ) 
	//	add_filter( 'show_admin_bar', '__return_false' );
//}
//add_action('wp', 'bp_xrui_remove_admin_bar');


//add telephone field in buddypress register form
function bp_xrui_add_tel()
{
    $strLabel =	 '<label for="signup_tel">'.  _e( '电话号码', 'buddypress' ) . _e( '(required)', 'buddypress' ). '</label>';
 
    echo $strLabel;
	
	/**
	 * Fires and displays any member registration email errors.
	 *
	 * @since 1.1.0
	 */
	do_action( 'bp_signup_tel_errors' ); 
	$strInput = '<input type="tel" name="signup_tel" id="signup_tel" value="';
	$strInput = $strInput.bp_get_signup_tel_value().'" ';
    $strInput = $strInput.bp_form_field_attributes( 'tel' );
	$strInput = $strInput.' />';
	echo $strInput;

}
//add_action('bp_account_details_fields', 'bp_xrui_add_tel');


function bp_tel_format_check($fieldname,$mobilenumber)
{
	global $bp;
	if (!is_numeric($mobilenumber)) {
		$bp->signup->errors[$fieldname] =  __( '手机号格式不对！', 'buddypress' );
	}
	else
	{
		$isMobilePhoneNumber =  preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobilenumber) ? true : false;

		if(!$isMobilePhoneNumber)
			$bp->signup->errors[$fieldname] =  __( '手机号格式不对！', 'buddypress' );
	}
	
}
function bp_tel_exists_check($fieldname,$mobilenumber)
{  
	global $bp;
    // Check into signups.
	$signups = BP_Signup::get( array(
		'usersearch'     => $mobilenumber,
		'active'         => 1
	) );

	$signup = isset( $signups['signups'] ) && ! empty( $signups['signups'][0] ) ? $signups['signups'][0] : false;
	
    if( ! empty( $signup ))
	{
		$bp->signup->errors[$fieldname] =  __( '手机号已经被使用！', 'buddypress' );
	}	
}

function bp_tel_signup_tel_check()
{
	global $bp;
	$mobile =  $_POST['signup_tel'];
	bp_tel_format_check('signup_tel',$mobile);
	bp_tel_exists_check('signup_tel',$mobile);
}
//add_action( 'bp_signup_validate', 'bp_tel_signup_tel_check' );	

function bp_tel_check()
{	
	global $wpdb;
	$table_name = $wpdb->prefix .'bp_xprofile_fields';   
	$query      = "SELECT * FROM ". $table_name . " WHERE type='mobiletel' and group_id = 1" ;	
	$results    = $wpdb->get_results($query);
	if(!$results)
		return;
	foreach ($results as $telfield) 
	{
		$fieldname = 'field_'.$telfield->id;
		$mobile =  $_POST[$fieldname];
		bp_tel_format_check($fieldname,$mobile);
		bp_tel_exists_check($fieldname,$mobile);
	}
	
}

add_action( 'bp_signup_validate', 'bp_tel_check' );	
add_action( 'bp_profile_validate', 'bp_tel_check' );	

function bp_save_tel($user_id, $user_login, $user_password, $user_email, $usermeta )
{
	global $wpdb;
    $table_name = $wpdb->prefix .'signups'; 	
	$tel =  $_POST['signup_tel'];
	$updatesql  = "UPDATE ".$table_name ." SET tel = %s	WHERE user_login = %s";
	$sql        = $wpdb->prepare($updatesql , $tel,$user_login ); 	
	$result     = $wpdb->query($sql);
	if($result == 1)
	{
		
	}

	$sql        = $wpdb->prepare( "UPDATE $wpdb->users SET tel = %s	WHERE id = %d", $tel,$user_id ); 	
	$result     = $wpdb->query($sql);
	if($result == 1)
	{
		
	}	
}
//add_action( 'bp_core_signup_user', 'bp_save_tel',10,6 );
 

function bp_xrui_set_tel($usermeta)
{
    $usermeta['signup_tel'] = $_POST['signup_tel'] ;
	return  $usermeta;
}
//add_filter('bp_signup_usermeta', 'bp_xrui_set_tel');
	
	
function bp_xrui_assign_email()
{
    $_POST['signup_email'] = $_POST['signup_username'].'@microlele.com';
}
//add_action('bp_signup_pre_validate', 'bp_xrui_assign_email');	

function bp_xrui_update_signup_meta($userId,$posted_field_ids, $errors, $old_values, $new_values)
{
	global $bp;
	global $wpdb;
	$user_login = bp_core_get_core_userdata($userId)->user_login;	
	$signups_table = buddypress()->members->table_name_signups;
	$signup        = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$signups_table} WHERE user_login = %s AND active = 1", $user_login) );
	$meta           = maybe_unserialize( $signup->meta );
	foreach ( $new_values as $field_id=>$values ) {
		$meta['field_'.$field_id] = $values['value'];
	}
 
	$args['signup_id'] = $signup->signup_id;
	$args['meta']      = $meta;
	
	BP_Signup::update($args);
}

add_action('xprofile_updated_profile','bp_xrui_update_signup_meta',10,5);


function bp_xrui_filtering_activity( $retval ) {
    if ( !bp_is_user_activity() ) {//只在首页过滤，在用户中心不过滤
    	$retval['action'] = 'activity_update';
		//$retval['action'] = 'activity_update';//activity_update,profile_updated/new_forum_post/new_blog_post
		//$retval['sort'] = 'ASC'; //default DESC
		//$retval['display_comments'] = false;
		//$retval['per_page'] = 5;//change the number of activity
	}
	return $retval;
}	
//add_filter( 'bp_after_has_activities_parse_args', 'bp_xrui_filtering_activity' );



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

remove_action( 'wp_head','print_emoji_detection_script',7);

//add_action( 'init', 'stop_heartbeat', 1 );
function stop_heartbeat() {
   wp_deregister_script('heartbeat');
}

// add_filter( 'get_avatar_url' , 'my_custom_url' , 1 , 3 );
// function my_custom_url( $url, $id_or_email, $args) {
    
	// $tempurl = get_user_meta($id_or_email, 'open_img' );
	// if(!empty($templurl))
		// return $tempurl;
    // return $url;
// }

add_filter( 'bp_core_fetch_avatar_no_grav' , 'bp_use_useravatar' , 1 , 2 );
function bp_use_useravatar($no_grav, $params) 
{
 
	$tempurl = get_user_meta(get_current_user_id(),'open_img',true );
	if(!empty($tempurl))
		return true;
 	
    return false ;
}
add_filter( 'bp_core_default_avatar_user' , 'bp_custom_url' , 1 , 2 );
function bp_custom_url($default, $params) 
{
	if( isset($params['item_id']))
	{
		$tempurl = get_user_meta($params['item_id'],'open_img',true );
		if(!empty($tempurl))
			return $tempurl;
	}		
    return $default ;
}

/**
 * 重置非管理员用户到首页
 * https://www.wpdaxue.com/only-allow-administrators-to-access-wordpress-admin-area.html
 */
// function redirect_non_admin_users() {
	// if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		// wp_redirect( home_url() );
		// exit;
	// }
// }
// add_action( 'admin_init', 'redirect_non_admin_users' );


/*select community*/

/**
 * 文档： http://lbsyun.baidu.com/index.php?title=webapi/guide/webservice-placeapi
 * 获取坐标附近
 * @return array|boolean
 */
function sp_get_current_nearby(){
    //http://api.map.baidu.com/place/v2/search?query=%E5%B0%8F%E5%8C%BA&page_size=10&page_num=0&scope=1&location=39.95922002157291,116.46405141273048&radius=2000&output=json&ak=NwTbTCZqZ9nmu5diqC44unLGvfGP3Rmh
	
	$query='别墅$小区';
	$page_size=10;
	
	$lng='39.95922002157291';
	$lat= $_POST[ 'lat' ];
	$lng = $_POST[ 'lng' ];
 
    $url = 'http://api.map.baidu.com/place/v2/search';
    $querydata=['query'=>$query,
	            'detail'=>1,
				'page_size'=>$page_size,
				'page_num'=>0,
				'scope'=>2,
				'location'=>$lat.','.$lng,
				'radius'=>2000,
				'output'=>'json',
				'ak'=> 'BIalsTEjgPtbogULIaIj6mnD' ];
    $geturl = $url.'?'.http_build_query($querydata);
    
    //mylog($geturl,'location_api2.log');
    
    //$filemd5 = md5($geturl);
   
    $filemd5 = file_get_contents($url.'?'.http_build_query($querydata));
 
    //mylog(F($filemd5),'location_api2.log');
    //echo objectToArray(json_decode($filemd5));
	echo $filemd5;
    exit;
}



/**
 * 文档: http://lbsyun.baidu.com/index.php?title=webapi/guide/webservice-geocoding#.E9.80.86.E5.9C.B0.E7.90.86.E7.BC.96.E7.A0.81.E6.9C.8D.E5.8A.A1
 * 根据lat lng 取出地图信息
 * @param $location_str   38.76623,116.43213 lat<纬度>,lng<经度>
 */
function sp_get_location_info($lng='39.95922002157291',$lat='116.46405141273048'){
    $location_str = $lat.','.$lng;
    $url = 'http://api.map.baidu.com/geocoder/v2/';
    $querydata=['location'=>$location_str,'ak'=> 'BIalsTEjgPtbogULIaIj6mnD','output'=>'json'];
    //$geturl = $url.'?'.http_build_query($querydata);
    //$filemd5 = md5($geturl);
    //if(!F($filemd5)){
    //    F($filemd5,file_get_contents($url.'?'.http_build_query($querydata)));
    //}
    $filemd5 = file_get_contents($url.'?'.http_build_query($querydata));
    //echo objectToArray(json_decode($filemd5));
	echo $filemd5;
	
	
  exit;
}

/**
 * 文档:
 * 根据 取出小区信息
 * @param $location_str   38.76623,116.43213 lat<纬度>,lng<经度>
 */
function sp_get_community_info($guid){
	$querydata=['uid'=>$guid,'ak'=> 'BIalsTEjgPtbogULIaIj6mnD','output'=>'json','scope'=>'1'];
    $url = 'http://api.map.baidu.com/place/v2/detail';
    //$querydata=['location'=>$location_str,'ak'=> 'BIalsTEjgPtbogULIaIj6mnD','output'=>'json'];
    //$geturl = $url.'?'.http_build_query($querydata);
    //$filemd5 = md5($geturl);
    //if(!F($filemd5)){
    //    F($filemd5,file_get_contents($url.'?'.http_build_query($querydata)));
    //}
    $communityinfo = file_get_contents($url.'?'.http_build_query($querydata));
     //json_decode($filemd5));
	
	
	
    return $communityinfo;
}
function save_community( ){
	
	$current_user          = wp_get_current_user();
	$location_id           = $_POST[ 'location_id' ];
	$resp['status_code']   = 0;
	$user_domain           = bp_core_get_user_domain( $current_user->ID );
	$wall_profile_link     = trailingslashit( $user_domain . buddypress()->activity->slug ).'following' ;
	$resp['redirect_url']  = $wall_profile_link; // home_url('/');
	//save to wp_community
	global $wpdb;
    $table_name = $wpdb->prefix .'community';   
	$new_group_id = 0;

	$communityres = $wpdb->get_results( 
						$wpdb->prepare("SELECT * FROM {$wpdb->prefix}community WHERE uid=%s", $location_id) );
	if($communityres)
	{	
	    update_user_meta($current_user->ID, 'community',$communityres[0]->id );
	    //join the group
		//function bp_core_get_userid( $username = '' ) 
		$groups     = groups_get_groups( 
						   array(
							'per_page'           => 1,
							'page'               => 1,
							'user_id'            => bp_loggedin_user_id()
						   ) 
					  );
		if ($groups['total'] > 0)
		{
			$groupslist  =  $groups['groups'];
			//$groupslist[0]
			//left the previous community
			groups_leave_group($groupslist[0]->id,$current_user->ID);
		}
		$new_group_id = groups_get_id(sanitize_title( esc_attr($communityres[0]->name )));
		groups_join_group( $new_group_id, $current_user->ID );
	}
	else
	{
		$communityinfo = sp_get_community_info($location_id);
		$communityinfojson = json_decode($communityinfo,true);
		if($communityinfojson['status'] == 0)
		{
			$cinfo = $communityinfojson['result'];
			$data_array = array(  
				'uid'          =>$location_id,
				'date_created' =>bp_core_current_time(),
				'name'         =>$cinfo['name'],
				'description'  =>'',
				'address'      =>$cinfo['address']
			); 
			
			$format = array(  
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
			); 	
			
			$result = $wpdb->insert($table_name,$data_array,$format);
			if($result)
			{
				$current_user = wp_get_current_user();
				update_user_meta($current_user->ID, 'community',$wpdb->insert_id );	
                //create a group for the community
				//join the group
				

				if (  $new_group_id = groups_create_group( 
				                                         array( 'group_id'     => $new_group_id, 
				                                                'name'         => $cinfo['name'], 
															    'description'  => $cinfo['address'], 
															    'slug'         => sanitize_title( esc_attr($cinfo['name']) ) , 
															    'date_created' => bp_core_current_time(), 
															    'status'       => 'public' ,
																'creator_id'   => bp_core_get_userid("Admin")
															  ) 
													    ) 
				) 
				{
					
					$groups     = groups_get_groups( 
									   array(
										'per_page'           => 1,
										'page'               => 1,
										'user_id'            => bp_loggedin_user_id()
									   ) 
								  );
					if ($groups['total'] > 0)
					{
						$groupslist  =  $groups['groups'];
						//$groupslist[0]
						//left the previous community
						groups_leave_group($groupslist[0]->id,$current_user->ID);
					}
					
					groups_join_group( $new_group_id, $current_user->ID );
				}				
				
			}	
			else
			{
				$resp['status_code'] = 1;
				$resp['redirect_url'] = '';
			}
		}
		else
		{
			$resp['status_code'] = 1;
			$resp['redirect_url'] = '';
		}
	}
	echo wp_json_encode( $resp );
	exit;
}


add_action( 'wp_ajax_sp_get_current_nearby',  'sp_get_current_nearby'   );
add_action( 'wp_ajax_sp_get_location_info',   'sp_get_location_info'   );
add_action( 'wp_ajax_save_community',         'save_community'   );


 
function baidumap_js() {
	echo '<script type="text/javascript"> window.BMap_loadScriptTime = (new Date).getTime();</script>';
    echo '<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=BIalsTEjgPtbogULIaIj6mnD"></script>';
    echo '<script type="text/javascript" src="http://developer.baidu.com/map/jsdemo/demo/convertor.js"></script>';
}

// function get_current_page_url(){ 
	// $current_page_url = 'http';
	// if ($_SERVER["HTTPS"] == "on") 
	// { 
		// $current_page_url .= "s";
	// } 
	// $current_page_url .= "://";
	// if ($_SERVER["SERVER_PORT"] != "80") 
	// { 
		// $current_page_url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	// } 
	// else 
	// { 
		// $current_page_url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	// } 
	// return $current_page_url; 
// }
 
function communityselscripts() {
	//$basename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
	//loadCustomTemplate(TEMPLATEPATH.'/custom/'."/$basename.php");
    global $wp;
	//check if user logined in and doesn't has community property_exists
	if(is_user_logged_in()  )
	{
		//$urlarr =   array(home_url( 'communitysel', 'https' ), home_url( 'communitysel', 'https' ));
		//$currenturl =  home_url(add_query_arg(array(),$wp->request));
		//if (in_array($currenturl, $urlarr))
			
		$current_user = wp_get_current_user();
		$community = get_user_meta($current_user->ID, 'community' );
	    if(empty($community) && $wp->request != 'communitysel')
	    {	
		    $url = home_url('/communitysel');
			wp_redirect($url);
			exit;	
		}	
	    if($wp->request == 'communitysel')
		{
			$assets			 = XRUI_PLUGIN_URL. 'assets';
			
			wp_enqueue_style( 'weui1',        $assets . '/vendor/jquery-weui/dist/lib/weui.min.css', array(), '1.1', 'all' );
			wp_enqueue_style( 'jquery-weui',  $assets . '/vendor/jquery-weui/dist/css/jquery-weui.min.css', array(), '1.1', 'all' );
			wp_enqueue_style( 'jquery-weui4', $assets . '/css/app.css', array(), '1.1', 'all' );
			
			wp_enqueue_script( 'jquery-weui2', $assets . '/vendor/jquery-weui/dist/js/jquery-weui.min.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'jquery-weui1', $assets . '/vendor/jquery-weui/dist/js/swiper.min.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'jquery-weui3', $assets . '/vendor/jquery-weui/dist/lib/fastclick.js', array( 'jquery' ), '1.0', true );
			
			
			
			//wp_enqueue_script( 'jquery-weui5', $assets . '/js/convertor.js', array('jquery'), '1.0', false );
			wp_enqueue_script( 'jquery-weui6', $assets . '/js/api.js', array('jquery' ), '1.0', true );
			add_action( 'wp_head',   'baidumap_js'  );
			

			// exit;
			//loadCustomTemplate(TEMPLATEPATH.'/community.php');
		 
		}
	    if($wp->request == 'me')
		{
	        $assets			 = XRUI_PLUGIN_URL. 'assets';
			wp_enqueue_style( 'person', $assets . '/css/person.css', array(), '1.0', 'all' );
		}
	}
}
 //add_action('template_redirect', 'templateRedirect');
 //add_action( 'wp_enqueue_scripts', 'communityselscripts' );
 add_action( 'template_redirect', 'communityselscripts' ,1);
//add_action('init', 'templateRedirect');


function xrui_load_template_multiple_times( $template ) {
	$template .= '.php';
	if ( file_exists( STYLESHEETPATH . '//xrui-plugin/' . $template ) )
		include(STYLESHEETPATH . '/xrui-plugin/' . $template);
	else if ( file_exists( TEMPLATEPATH . '/xrui-plugin/' . $template ) )
		include (TEMPLATEPATH . '/xrui-plugin/' . $template);
	else {
		$template_dir = apply_filters( 'xrui_templates_dir_filter', XRUI_PLUGIN_DIR.'/template/' );
		include trailingslashit( $template_dir ) . $template;
	}
}

function xrui_bp_follower_display()
{
	global $bp;

	// Need to change the user ID, so if we're not on a member page, $counts variable is still calculated
	$user_id = bp_is_user() ? bp_displayed_user_id() : bp_loggedin_user_id();
	$counts  = bp_follow_total_follow_counts( array( 'user_id' => $user_id ) );

	// BuddyBar compatibility
	$domain = bp_displayed_user_domain() ? bp_displayed_user_domain() : bp_loggedin_user_domain();

	/** FOLLOWERS NAV ************************************************/
	$slug         = bp_get_friends_slug();
	$friends_link = trailingslashit( $domain . $slug );	
	$following_link = $friends_link.$bp->follow->following->slug;
	$follower_link = $friends_link.$bp->follow->followers->slug;
?>
	  <a class="box-col line-separate" href=<?php echo $following_link; ?> >
		 <div class="mct-a txt-s">
		 <?php echo $counts['following']; ?>
		 </div>
		 <div class="mct-a txt-s txt-bottom">
		 关注</div>
	  </a>
	  
	  <a class="box-col line-separate" href=<?php echo $follower_link; ?>  >
		 <div class="mct-a txt-s">
		 <?php echo $counts['followers']; ?></div>
		 <div class="mct-a txt-s txt-bottom">
		 粉丝</div>
	  </a>
<?php		  
}

function xrui_bp_user_screen()
{
	
    global $bp;

	// Need to change the user ID, so if we're not on a member page, $counts variable is still calculated
	$user_id = bp_is_user() ? bp_displayed_user_id() : bp_loggedin_user_id();
	$counts  = bp_follow_total_follow_counts( array( 'user_id' => $user_id ) );

	// BuddyBar compatibility
	$user_domain = bp_displayed_user_domain() ? bp_displayed_user_domain() : bp_loggedin_user_domain();

	/** FOLLOWERS NAV ************************************************/
	$slug         = bp_get_friends_slug();
	$friends_link = trailingslashit( $user_domain . $slug );	
	$following_link = $friends_link.$bp->follow->following->slug;
	$follower_link = $friends_link.$bp->follow->followers->slug;
		
	$post_count_query = new WP_Query(
		array(
			'author' => $user_id,
			'post_type' => 'post',
			'posts_per_page' => 1,
			'post_status' => 'publish'
		)
	);

	$sap_post_count = $post_count_query->found_posts;
	wp_reset_postdata();


	$blog_link = trailingslashit( $user_domain . __( 'blog', 'bp-user-blog' ) );
	
	// Add subnav items
	
	if ( !is_user_logged_in() || bp_displayed_user_id() != get_current_user_id() ) {
		$blogname = __( 'Articles', 'bp-user-blog' );
	} else {
		$blogname = __( 'Published', 'bp-user-blog' );
	}	
	$bookmarks_link =trailingslashit( $blog_link . 'bookmarks' ); 
	
	$photos_cnt = bbm_total_photos_count();
	$buddyboss_media_link = trailingslashit( $user_domain . buddyboss_media_default_component_slug() ); 
	
	$slug         = bp_get_profile_slug();
	$profile_link = trailingslashit( $user_domain . $slug );
	$profile_name = _x( 'Profile', 'Profile header menu', 'buddypress' );
?>
<div data-node="profileWrap" class="container" style="display: block;"> 
   <div class="dataCont">
      <div class="card11 card-combine" data-node="group" id="boxId_1478094959183_29">
         <div data-node="cardList" class="card-list">
            <div class="card card30 line-around" data-node="card" data-jump="/u/1407138035" data-act-type="hover" id="boxId_1478094959183_30">
               <div class="layout-box media-graphic">
                  <div class="mod-media size-s">
                     <div class="media-main">
						  <?php echo bp_core_fetch_avatar( array( 'item_id' => get_current_user_id(), 'type' => 'full', 'width' => '100', 'height' => '100' ) ); ?>
                     </div>
                  </div>
                  <div class="box-col item-list">
                     <div class="item-main txt-s mct-a txt-cut" data-node="cNameUsr">
                        <?php echo bp_core_get_user_displayname( get_current_user_id() ); ?> 
                        <a data-node="cIconLink" href="javascript:;" data-act-type="hover" class="btn btn-nvip">
                           <i class="icon icon-nvip">
                           </i>
                           <i class="icon-font icon-font-arrow-right">
                           </i>
                        </a>
                     </div>
                     <div class="item-minor txt-s mct-d" data-node="cTxtUsr">
                     简介：
                     </div>
                  </div>
                  <span data-node="arrow" class="plus plus-s">
                  <i class="icon-font icon-font-arrow-right txt-s">
                  </i>
                  </span>
               </div>
            </div>
            <div class="card card2 line-around" id="boxId_1478094959183_31">
               <div class="layout-box">
                  <a class="box-col line-separate" href="/page/tpl?containerid=1005051407138035_-_WEIBO_SECOND_PROFILE_WEIBO" data-act-type="hover">
                     <div class="mct-a txt-s">
                      13
                     </div>
                     <div class="mct-a txt-s txt-bottom">
                      动态
					  </div>
                  </a>
                  <a class="box-col line-separate" href=<?php echo $following_link; ?> >
                     <div class="mct-a txt-s">
                     <?php echo $counts['following']; ?>
					 </div>
                     <div class="mct-a txt-s txt-bottom">
                     关注</div>
                  </a>
				  
				  <a class="box-col line-separate" href=<?php echo $follower_link; ?>  >
                     <div class="mct-a txt-s">
                     <?php echo $counts['followers']; ?></div>
                     <div class="mct-a txt-s txt-bottom">
                     粉丝
					 </div>
                  </a>

               </div>
            </div>
         </div>
      </div>
      <div class="card11 card-combine" data-node="group" >
         <div data-node="cardList" class="card-list">
            <div class="card card32 line-around" >
               <a href="<?php echo $blog_link;?>" class="layout-box" >
                  <i class="iconimg iconimg-s">
                     <img width="23" height="23" src="http://u1.sinaimg.cn/upload/2014/03/19/60990.png" data-node="cMesImg">
                  </i>
                  <div class="box-col txt-cut">
                     <span class="mct-a " >
                        <?php echo $blogname;?>
                     </span>
                 </div>
                 <span class="plus plus-m">
                   <span data-node="arrow" class="plus plus-s">
                     <i class="icon-font icon-font-arrow-right txt-s">
                     </i>
                   </span>
                 </span>
               </a>
            </div>
			<?php 
			if ( is_user_logged_in() /*&& bp_displayed_user_id() == get_current_user_id()*/ ) 
			{
				$publish_post = getPostFlag();
		
				if ( !$publish_post )
				{
					$pendinglink = $blog_link. __( 'pending', 'bp-user-blog' );
			?>
					<div class="card card32 line-around" >
					   <a href="<?php echo $pendinglink;?>" class="layout-box" >
						  <i class="iconimg iconimg-s">
							 <img width="23" height="23" src="http://u1.sinaimg.cn/upload/2014/03/19/60990.png" data-node="cMesImg">
						  </i>
						  <div class="box-col txt-cut">
							 <span class="mct-a " >
								<?php echo __( 'In Review', 'bp-user-blog' );?>
							 </span>
						 </div>
						 <span class="plus plus-m">
						   <span data-node="arrow" class="plus plus-s">
							 <i class="icon-font icon-font-arrow-right txt-s">
							 </i>
						   </span>
						 </span>
					   </a>
					</div>
		    <?php 
				}
				$draftlink = $blog_link.'drafts';			
			?>
				<div class="card card32 line-around" >
				   <a href="<?php echo $draftlink;?>" class="layout-box" >
					  <i class="iconimg iconimg-s">
						 <img width="23" height="23" src="http://u1.sinaimg.cn/upload/2014/03/19/60990.png" data-node="cMesImg">
					  </i>
					  <div class="box-col txt-cut">
						 <span class="mct-a " >
							<?php echo __( 'Drafts', 'bp-user-blog' );?>
						 </span>
					 </div>
					 <span class="plus plus-m">
					   <span data-node="arrow" class="plus plus-s">
						 <i class="icon-font icon-font-arrow-right txt-s">
						 </i>
					   </span>
					 </span>
				   </a>
				</div>			
		    <?php
			} 
			?>	
            <div class="card card4 line-around" id="boxId_1478094959183_38">
               <a href="<?php echo $bookmarks_link;?>" class="layout-box" data-act-type="hover">
                  <i class="iconimg iconimg-s">
                     <img width="23" height="23" src="http://u1.sinaimg.cn/upload/2014/03/19/60986.png" alt="">
                  </i>
                  <div class="box-col txt-cut">
                     <span class="mct-a ">
                     我的收藏</span>
                     <span class="mct-b txt-xs">
                      </span>
                  </div>
                  <span data-node="arrow" class="plus plus-s">
                     <i class="icon-font icon-font-arrow-right txt-s">
                     </i>
                  </span>
               </a>
            </div>			
         </div>
      </div>
      <div class="card11 card-combine" data-node="group" id="boxId_1478094959183_34">
         <!--div data-node="cardList" class="card-list">
            <div class="card card4 line-around" id="boxId_1478094959183_35">
               <a href="http://level.account.weibo.cn/myrank" class="layout-box" data-act-type="hover">
                  <i class="iconimg iconimg-s">
                     <img width="23" height="23" src="http://h5.sinaimg.cn/upload/2014/12/26/29/card_icon_level_default.png" alt="">
                  </i>
                  <div class="box-col txt-cut">
                     <span class="mct-a ">
                     微博等级</span>
                     <span class="mct-b txt-xs">
                     Lv13</span>
                  </div>
                  <span data-node="arrow" class="plus plus-s">
                     <i class="icon-font icon-font-arrow-right txt-s">
                     </i>
                  </span>
               </a>
            </div>
         </div-->
      </div>
      <div class="card11 card-combine" data-node="group" id="boxId_1478094959183_36">
         <div data-node="cardList" class="card-list">
            <div class="card card4 line-around" id="boxId_1478094959183_37">
               <a href="<?php echo $buddyboss_media_link; ?>" class="layout-box" data-act-type="hover">
                  <i class="iconimg iconimg-s">
                     <img width="23" height="23" src="http://u1.sinaimg.cn/upload/2014/03/19/60988.png" alt="">
                  </i>
                  <div class="box-col txt-cut">
                     <span class="mct-a ">
                     我的相册
					 </span>
                     <span class="mct-b txt-xs">
                     <?php echo $photos_cnt; ?>
					 </span>
                  </div>
                  <span data-node="arrow" class="plus plus-s">
                     <i class="icon-font icon-font-arrow-right txt-s">
                     </i>
                  </span>
               </a>
            </div>

            <!--div class="card card4 line-around" id="boxId_1478094959183_39">
               <a href="/p/index?containerid=2302571407138035" class="layout-box" data-act-type="hover">
                  <i class="iconimg iconimg-s">
                  <img width="23" height="23" src="http://u1.sinaimg.cn/upload/2014/03/19/60992.png" alt="">
                  </i>
                  <div class="box-col txt-cut">
                     <span class="mct-a ">
                     赞</span>
                     <span class="mct-b txt-xs">
                     ( 0)</span>
                  </div>
                   <span data-node="arrow" class="plus plus-s">
                  <i class="icon-font icon-font-arrow-right txt-s">
                  </i>
                  </span>
               </a>
            </div-->
         </div>
      </div>
      <div class="card11 card-combine" data-node="group"  >
         <div data-node="cardList" class="card-list">
            <div class="card card4 line-around" id="boxId_1478094959183_41">
               <a href="<?php echo $profile_link;?>" class="layout-box" data-act-type="hover">
                  <i class="iconimg iconimg-s">
                     <img width="23" height="23" src="http://u1.sinaimg.cn/upload/h5/img/440/cards/icon/gear_2x.png" alt="">
                  </i>
                  <div class="box-col txt-cut">
                  <span class="mct-a ">
                  设置
				  </span>
                  </div>
                  <span data-node="arrow" class="plus plus-s">
                     <i class="icon-font icon-font-arrow-right txt-s">
                     </i>
                  </span>
               </a>
            </div>
			
            <div class="card card4 line-around" >
               <a href="<?php echo wp_logout_url(); ?>" class="layout-box" data-act-type="hover">
                  <i class="iconimg iconimg-s">
                     <img width="23" height="23" src="http://u1.sinaimg.cn/upload/h5/img/440/cards/icon/gear_2x.png" alt="">
                  </i>
                  <div class="box-col txt-cut">
                  <span class="mct-a ">
                     <?php _e( 'Logout', 'boss' ); ?>
				  </span>
                  </div>
                  <span data-node="arrow" class="plus plus-s">
                     <i class="icon-font icon-font-arrow-right txt-s">
                     </i>
                  </span>
               </a>
            </div>			
         </div>
      </div>
	  
	  
 	  
   </div>
</div>

<?php	
}


function xrui_show_display_user_nav2(){
	if(bp_displayed_user_id() 
	   && (bp_displayed_user_id() != get_current_user_id())
	)
	{
?>
		<style>
			#mainMenuBar {
				width: 100%;
				background-color: white;
				z-index: 100;
			}
			#mainMenuBar ul {
				margin: 0 auto;
				text-align: center;
				position: relative;
				padding: 20px;
				border-bottom: 1px solid black;
			}
			#mainMenuBar li {
				display: inline-block;
				color: black;
				margin-left: 30px;
				font-size: 1.2em;
				font-family: "proxima-nova";
				font-weight: 100;
			}
			.stick {
				position: fixed;
				top: 70;
			}
		</style>
		<script style='text/javascript'>
		  $( function() {
			  // Cache selectors for faster performance.
			  var $window            = $(window),
				  $mainMenuBar       = $('#mainMenuBar'),
				  $mainMenuBarAnchor = $('#mainMenuBarAnchor');
		   
			  // Run this on scroll events.
			  //scroll()
			  //当用户滚动指定的元素时，会发生scroll事件。
			  //scroll事件适用于所有可滚动的元素和window对象（浏览器窗口）
			  //scroll()方法触发scroll事件，或规定当发生scroll事件时运行的函数
			  $window.scroll(function() {
				  //scrollTop()方法返回或设置匹配元素的滚动条的垂直位置
				  var window_top = $window.scrollTop();
				//javascript用offsetTop();jquery用offset().top;
				  var div_top = $mainMenuBarAnchor.offset().top;
				  if (window_top + 70 > div_top ) {
					  // Make the div sticky.
					  $mainMenuBar.addClass('stick');
					  $mainMenuBarAnchor.height($mainMenuBar.height());
				  }
				  else {
					  // Unstick the div.
					  $mainMenuBar.removeClass('stick');
					  $mainMenuBarAnchor.height(0);
				  }
				});
		  });
		</script>				
		<div id="mainMenuBarAnchor"></div>				
		<div  id= "mainMenuBar">
			<ul id="nav-bar">
				<?php
					global $bp;
					$disuser_domain        = bp_displayed_user_domain();
					$activity_slug         = bp_get_activity_slug();
					//$blog_slug             = bp_get_blogs_slug();
					$disuser_activity_link = trailingslashit( $disuser_domain . $activity_slug ) . 'just-me/';
					$disuser_blog_link     = trailingslashit( $disuser_domain . __( 'blog', 'bp-user-blog' ) );
					$buddyboss_media_link  = trailingslashit( $disuser_domain . buddyboss_media_default_component_slug() ); 
					//bp_is_current_component();'profile' == bp_current_action() 
					$activityclass = "";
					$photoclass    = "";
					$blogclass    = "";
					
					
					if (bp_is_current_component( $activity_slug )    )
					//if(bp_is_current_component($bp->activity->slug))
					{
						$activityclass = "selected";
					}
					else if( bp_is_current_component( buddyboss_media_component_slug() ) /*&& bp_is_current_action('photos')*/ )
					{
						$photoclass    = "selected";
					}
					else if($bp->current_action == 'blog' )
					{
						$blogclass     = "selected";
					}
				?>
					<li>
						<a id='activity' href="<?php echo $disuser_activity_link ; ?>" class="<?php echo $activityclass;?>">活动</a>
					</li>	
					<li>
						<a id='blog' href="<?php echo $disuser_blog_link  ; ?>" class="<?php echo $blogclass;?>" >文章</a>
					</li>
					<li>
						<a id='photo' href="<?php echo $buddyboss_media_link  ; ?>" class="<?php echo $photoclass;?>">相册</a>
					</li>

			</ul>
		</div>
 
     
<?php
		}

}

function xrui_setup_me_nav()
{
	$displayed_user_id = bp_displayed_user_id();
	$user_domain = ( ! empty( $displayed_user_id ) ) ? bp_displayed_user_domain() : bp_loggedin_user_domain();

	$me_link = trailingslashit( $user_domain . __( 'me', 'weilele' ) );	
	if ( is_user_logged_in() && bp_displayed_user_id() == get_current_user_id() ) {	
		bp_core_new_nav_item( array(
			'name'					 => __( '我的', 'weilele' )  ,
			'slug'					 => "me",
			'position'				 => 80,
			'screen_function'		 => 'xrui_me_page',
			'default_subnav_slug'	 => 'me'
		) );
	}
}

function xrui_me_page() {
	$assets			 = XRUI_PLUGIN_URL. 'assets';
	wp_enqueue_style( 'person', $assets . '/css/person.css', array(), '1.0', 'all' );
	add_action( 'bp_template_content', 'xrui_template_me' );
    bp_core_load_template( apply_filters( 'xrui_me_page', 'members/single/plugins' ) );
}

function xrui_template_me() {
   xrui_load_template( 'xrui-me' );
}

function xrui_load_template( $template ) {
	$template .= '.php';
	if ( file_exists( STYLESHEETPATH . '//xrui-plugin/' . $template ) )
		include_once(STYLESHEETPATH . '/xrui-plugin/' . $template);
	else if ( file_exists( TEMPLATEPATH . '/xrui-plugin/' . $template ) )
		include_once (TEMPLATEPATH . '/xrui-plugin/' . $template);
	else {
		$template_dir = apply_filters( 'xrui_templates_dir_filter', XRUI_PLUGIN_DIR.'/template/' );
		include_once trailingslashit( $template_dir ) . $template;
	}
}


function xrui_displayfooter_nav()
{
?>  
    <div class="bottom-bar">
	   <div class="func-wrap wll-footer">
		    <ul class="m-bar">
<?php
	if( is_user_logged_in()) {  
		global $bp;
	 
	 
		if (( bp_loggedin_user_id() && !bp_displayed_user_id())  || bp_is_my_profile())
		{
			// Need to change the user ID, so if we're not on a member page, $counts variable is still calculated
			$user_id = /*bp_is_user() ? bp_displayed_user_id() :*/ bp_loggedin_user_id();

			// BuddyBar compatibility
			$user_domain  = /*bp_displayed_user_domain() ? bp_displayed_user_domain() :*/ bp_loggedin_user_domain();	
			$me_link      = trailingslashit( $user_domain . 'me' );	
			$blog_link    = trailingslashit( $user_domain . __( 'blog', 'bp-user-blog' ) );
			$friends_link = trailingslashit( $user_domain . bp_get_friends_slug() );
			$find_link    = trailingslashit( $friends_link . 'membersearch');
			
			$create_new_post_page = buddyboss_sap()->option('create-new-post');
			$create_post_link     = trailingslashit(get_permalink( $create_new_post_page ));
			
			//Keeping addnew post same if network activated
			if (is_multisite()) {
				if (!function_exists('is_plugin_active_for_network'))
					require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
				if (is_plugin_active_for_network(basename(constant('BP_PLUGIN_DIR')) . '/bp-loader.php') 
					&& is_plugin_active_for_network(basename(constant('BUDDYBOSS_SAP_PLUGIN_DIR')) . '/bp-user-blog.php') ) {
					$create_post_link = trailingslashit(get_blog_permalink( 1,$create_new_post_page ));
				}
			}	

			$slug       = bp_get_groups_slug();
			
			$group_link = trailingslashit( $user_domain . $slug );	
			$groups     = groups_get_groups( 
							   array(
								'per_page'           => 1,
								'page'               => 1,
								'user_id'            => bp_loggedin_user_id()
							   ) 
						  );
			if ($groups['total'] > 0)
			{
				$groupslist  =  $groups['groups'];
				$group_link  =  bp_get_group_permalink($groupslist[0]);
			}
			$wall_profile_link = trailingslashit( $user_domain . $bp->activity->slug ).'following';	
			
			$homeclass        = "";
			$communityclass   = "";
			$activityclass    = "";
			$blogclass        = "";
			$selfclass        = "";
			$component = bp_current_component();
			
		    if(is_page($create_new_post_page))
			{
				$blogclass        = "selected" ;
			}
			else if(is_home()
   				    || is_page('channels') 
				    || is_single()
					|| is_category())
			{
				$homeclass        =  "selected" ;
			}
			else if( bp_is_groups_component())
			{
				$communityclass   =  "selected";
			} 
			else if( (bp_is_activity_component() && bp_is_current_action('following')) || 
		             (bp_is_friends_component() && bp_is_current_action('membersearch')) 
		           )
			{
				$activityclass    = "selected";
			}

			else
			{
				$selfclass        = "selected";
			}
			
		?>			
			<li>
				<a id='homeinfo' href="<?php echo esc_url( home_url() ); ?>" class="<?php echo $homeclass;?>">资讯</a>
			</li>
			
			<li>
				<a id='community' href="<?php echo $group_link; ?>" class="<?php echo $communityclass;?>" >社区</a>
			</li>
			
			<li>
				<a id='activity' href="<?php echo $wall_profile_link; ?>" class="<?php echo $activityclass;?>" >圈子</a>
			</li>
			

			<li>
				<a id='article' href="<?php echo $create_post_link; ?>" class="<?php echo $blogclass;?>">投稿</a>
			</li>
			
			<li>
				<a id='selfinfo' href="<?php echo $me_link; ?>" class="<?php echo $selfclass;?>">我的</a>
			</li>            
<?php
		}
		else if(bp_displayed_user_id() 
				&& (bp_displayed_user_id() != get_current_user_id())
			)
		{
				
			$me_link      = trailingslashit( bp_loggedin_user_domain() . 'me' );	
			$disuser_link = bp_displayed_user_domain();
?>
			<li>
				 <?php echo bp_core_get_user_displayname( bp_displayed_user_id() );?>主页 
			</li>
			<li>
				<a id='selfinfo' href="<?php echo $me_link  ; ?>">我的主页</a>
			</li>			
    <?php
		}
	}
	else
	{
		
		 
?>
			<li>
				<a id='homeinfo' href="<?php echo esc_url( home_url() ); ?>">资讯</a>
			</li>
			
				<?php if (is_weixin()):?>
			<li>
					<a href="<?php echo  'javascript:void(0)'; ?>" onclick="login_button_click('wechat','<?php echo home_url();?>')" class="login-link screen-reader-shortcut"><?php _e( 'Login', 'boss' ); ?></a>
			</li>
				<?php else: ?>
				
				  <?php if ( buddyboss_is_bp_active() && bp_get_signup_allowed() ) : ?>
			<li>
					<a href="<?php echo bp_get_signup_page(); ?>" class="register-link screen-reader-shortcut"><?php _e( 'Register', 'boss' ); ?>
					</a>
			</li>
				  <?php endif; ?>	
			<li>						  
					<a href="<?php echo wp_login_url();  ?>"   class="login-link screen-reader-shortcut"><?php _e( 'Login', 'boss' ); ?></a>
			</li>
				<?php endif?>
								
<?php 
	}
?>		   
            </ul>	
	    </div>
    </div>	
<?php
}

function xrui_display_headernav()
{

    if(!is_weixin() && (is_single() || is_page() || is_author() || is_category()) )
	{
?>
		<li>
		   <a href="javascript:history.go(-1)" class="icon-back">返回</a>
		</li>
	
<?php 
	} 
?>	

	<!--li>
		<a href="#scroll-to" >到页首</a>
	</li-->
	
<?php 
	if(is_home() || is_page('channels'))
	{
		$homeclass    = is_home()?"selected":"";
		$channelclass = is_home()?"":"selected";
?>
	<li>
		<a href="<?php echo home_url('/'); ?>" class="<?php echo $homeclass; ?>" >综合</a>
	</li>
	<li>
		<a href="<?php echo home_url('/channels'); ?>" class="<?php echo $channelclass ; ?>" >频道系列</a>
	</li>	
<?php
	}
	if( is_user_logged_in()) {  
		$user_id = /*bp_is_user() ? bp_displayed_user_id() :*/ bp_loggedin_user_id();

		// BuddyBar compatibility
		$user_domain  = /*bp_displayed_user_domain() ? bp_displayed_user_domain() :*/ bp_loggedin_user_domain();	
		$me_link      = trailingslashit( $user_domain . 'me' );	
		$blog_link    = trailingslashit( $user_domain . __( 'blog', 'bp-user-blog' ) );
		$friends_link = trailingslashit( $user_domain . bp_get_friends_slug() );
		$find_link    = trailingslashit( $friends_link . 'membersearch');	
	
		if(bp_is_groups_component() ){
?>
			<?php bp_get_options_nav(); ?>

			<?php do_action( 'bp_group_options_nav' ); ?>
<?php						
		}
		if( (bp_is_activity_component() && bp_is_current_action('following')) || 
		    (bp_is_friends_component() && bp_is_current_action('membersearch')) 
		)
		{
			$findclass = "";
			if(bp_is_friends_component() && bp_is_current_action('membersearch'))
			{
				$findclass = "selected";
			}
?>	
			<?php bp_get_options_nav(bp_get_activity_slug()); ?>
			<li>
				<a id='find' href="<?php echo $find_link ; ?>" class="<?php echo $findclass;?>">发现朋友</a>
			</li>
<?php						
		}	
	}
?>
<?php	
}

// Bookmarks Shortcode
if ( !function_exists( 'xrui_community_sel' ) ) {

	function xrui_community_sel() {
		xrui_load_template_multiple_times( 'xrui-commmunity-shortcode' );
	}

	add_shortcode( 'communitysel', 'xrui_community_sel' );
}
if(!function_exists( 'xrui_include_me' ))
{
	
	function xrui_include_me($ids, $userid) {
		$ids = empty( $ids ) ? 0 : $ids; 
		if($ids == 0)
		{
			$ids = $userid;
		}
		else
		{
			$ids = $userid.','. $ids;
		}
		return $ids;
	}	
	add_filter( 'bp_get_following_ids','xrui_include_me', 10, 2 );
}

?>