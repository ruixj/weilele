<?php
add_action('login_head', 'wpjam_login_head');
function wpjam_login_head() {
	if(wpjam_basic_get_setting('login_head_style')){
	?>
	<style type="text/css">
		<?php echo wpjam_basic_get_setting('login_head_style'); ?>
	</style>
	<?php
	}
}

// 定制后台登录页面链接的连接
add_filter('login_headerurl', 'wpjam_login_headerurl');
function wpjam_login_headerurl(){
	return home_url();
}

// 定制后台登录页面链接的标题
add_filter('login_headertitle', 'wpjam_login_headertitle');
function wpjam_login_headertitle(){
	return get_bloginfo('name');
}

add_action('admin_head', 'wpjam_admin_head');
function wpjam_admin_head() {
	if(wpjam_basic_get_setting('admin_head_style')){
	?>
	<style type="text/css">
		<?php echo wpjam_basic_get_setting('admin_head_style'); ?>
	</style>
	<?php
	}
}

add_action('wp_head','wpjam_favicon',1);
//add_action('admin_head','wpjam_favicon');
function wpjam_favicon(){
?>
	<?php if(wpjam_basic_get_setting('favicon')){	?>
	<link rel="shortcut icon" href="<?php echo wpjam_basic_get_setting('favicon');?>"> 
	<?php } ?>
	<?php if(wpjam_basic_get_setting('apple_touch_icon')){	?>	
	<link rel="apple-touch-icon" href="<?php echo wpjam_basic_get_setting('apple_touch_icon');?>">
	<?php }?>
	<?php if(wpjam_basic_get_setting('head') && !is_admin()) { ?>
	<?php echo wpjam_basic_get_setting('head');?>
	<?php }?>
<?php
}