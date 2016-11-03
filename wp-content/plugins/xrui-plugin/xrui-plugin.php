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

add_action('plugins_loaded','bookmark_init');	
function bookmark_init()
{
    // Setup WP Toolbar menus.
   add_action( 'bp_setup_admin_bar',  'bookmark_setup_admin_bar', 60 );	
   add_action( 'bp_setup_nav', 'bookmark_setup_bookmark_nav', 100 );
   add_action( 'bp_setup_nav', 'member_setup_search_nav', 100 );
   
  
}

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

	$blog_link = trailingslashit( $user_domain . __( 'blog', 'bp-user-blog' ) );	
	if ( is_user_logged_in() && bp_displayed_user_id() == get_current_user_id() ) {	
		bp_core_new_subnav_item( 
		array(
			'name' => __( '我的收藏', 'bp-user-blog' ),
			'slug' => 'bookmarks',
			'parent_url' => $blog_link,
			'parent_slug' =>   __( 'blog', 'bp-user-blog' ),
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
 
		 
		$slug         = bp_get_friends_slug();
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
		return bp_core_get_user_domain( $user->ID );//bp默认的用户中心首页
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

add_action( 'init', 'stop_heartbeat', 1 );
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
	
	$current_user = wp_get_current_user();
	$location_id = $_POST[ 'location_id' ];
	$resp['status_code'] = 0;
	$resp['redirect_url'] =   bp_core_get_user_domain( $current_user->ID ); // home_url('/');
	//save to wp_community
	global $wpdb;
    $table_name = $wpdb->prefix .'community';   


	$communityres = $wpdb->get_results( 
						$wpdb->prepare("SELECT * FROM {$wpdb->prefix}community WHERE uid=%s", $location_id) );
	if($communityres)
	{
	    
			
	    update_user_meta($current_user->ID, 'community',$communityres['id'] );
	}
	else
	{
		$communityinfo = sp_get_community_info($location_id);
		$communityinfojson = json_decode($communityinfo,true);
		if($communityinfojson['status'] == 0)
		{
			$cinfo = $communityinfojson['result'];
			$data_array = array(  
				'uid' =>$location_id,
				'date_created' =>bp_core_current_time(),
				'name'=>$cinfo['name'],
				'description'=>'',
				'address'=>$cinfo['address']
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
add_action( 'wp_ajax_sp_get_location_info',  'sp_get_location_info'   );
add_action( 'wp_ajax_save_community',  'save_community'   );


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
	}
}
 //add_action('template_redirect', 'templateRedirect');
 //add_action( 'wp_enqueue_scripts', 'communityselscripts' );
 add_action( 'template_redirect', 'communityselscripts' );
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


// Bookmarks Shortcode
if ( !function_exists( 'xrui_community_sel' ) ) {

	function xrui_community_sel() {
		xrui_load_template_multiple_times( 'xrui-commmunity-shortcode' );
	}

	add_shortcode( 'communitysel', 'xrui_community_sel' );
}
?>