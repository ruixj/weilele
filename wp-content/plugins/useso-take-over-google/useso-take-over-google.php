<?php
/*
Plugin Name: Useso take over Google
Plugin URI: http://www.brunoxu.com/useso-take-over-google.html
Description: 替换所有的Google字体、谷歌JS公用库、Gravatar头像为geekzu资源。
Author: Bruno Xu
Author URI: http://www.brunoxu.com/
Version: 1.7
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define('USESO_TAKE_OVER_GOOGLE_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('USESO_TAKE_OVER_GOOGLE_PLUGIN_DIR', plugin_dir_path( __FILE__ ));

function useso_take_over_google_is_login_page() {
	return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

if (is_admin()) {// init -> wp_loaded -> admin_menu -> admin_init -> wp -> admin_enqueue_scripts -> admin_head
	$action = 'admin_init'; // OK
 
} elseif (useso_take_over_google_is_login_page()) {
	$action = 'wp_loaded'; // OK
 
} else { // init -> wp_loaded -> wp -> template_redirect -> get_header -> wp_enqueue_scripts -> wp_head
	$action = 'template_redirect'; // OK
 
}

add_action($action, 'useso_take_over_google_obstart');
function useso_take_over_google_obstart() {
	ob_start('useso_take_over_google_obend');
}

function useso_take_over_google_obend($content) {
	return useso_take_over_google_filter($content);
}

function useso_take_over_google_filter($content)
{
	$content = apply_filters('useso_take_over_google_content_filter_before', $content);

	/*
	google fonts imported by 'Web Font Loader'
		https://ajax.googleapis．com/ajax/libs/webfont/1.5.3/webfont.js
		http://ajax.googleapis．com/ajax/libs/webfont/1/webfont.js
	*/
	//$content = str_ireplace('//ajax.googleapis'.'.com/ajax/libs/webfont/1/webfont.js', substr($webfont_js, strpos($webfont_js,'//')), $content);
	//$content = preg_replace('|//ajax.googleapis'.'.com/ajax/libs/webfont/[\d\.]+/webfont.js|i', substr($webfont_js, strpos($webfont_js,'//')), $content);
	$regexp = "|(http(s)?:)?//ajax.googleapis".".com/ajax/libs/webfont/[\d\.]+/webfont.js|i";
	$content = preg_replace_callback(
		$regexp,
		"useso_take_over_google_str_handler2",
		$content
	);

	/*
	<link rel="stylesheet" id="open-sans-css" href="//fonts.googleapis．com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&amp;subset=latin%2Clatin-ext&amp;ver=3.9.2" type="text/css" media="all">
	<script type="text/javascript" src="http://ajax.googleapis．com/ajax/libs/jquery/1.6/jquery.min.js"></script>
	*/
	$regexp = "/<(link|script)([^<>]+)>/i";
	$content = preg_replace_callback(
		$regexp,
		"useso_take_over_google_str_handler",
		$content
	);

	/*
	@import url(http://fonts.googleapis．com/css?family=Roboto+Condensed:regular);
	@import url(http://fonts.googleapis．com/css?family=Merriweather:300,300italic,700,700italic);
	*/
	$regexp = "/@import\s+url\([^\(\)]+\);?/i";
	$content = preg_replace_callback(
		$regexp,
		"useso_take_over_google_str_handler",
		$content
	);

	/*
	gravatar imgs
		<img src="http://1.gravatar．com/avatar/11fee321889526d1df2393655f48bd0c?s=26&d=retro&r=g">
		<img src="https://secure.gravatar．com/avatar/06a2950d128ec9faf155e28d9e889baa?s=120">
	*/
	$regexp = "/<img([^<>]+)>/i";
	$content = preg_replace_callback(
		$regexp,
		"useso_take_over_google_str_handler3",
		$content
	);

	return apply_filters('useso_take_over_google_content_filter_after', $content);
}

function useso_take_over_google_str_handler($matches)
{
	$str = $matches[0];

	$is_ssl = false;
	if (stristr($str, 'https://')) {
		$is_ssl = true;
	} else {
		if (!stristr($str, 'http://') && is_ssl()) {
			$is_ssl = true;
		}
	}

	if (!$is_ssl) {
		$str = str_ireplace('//fonts.googleapis'.'.com/', '//fonts.geekzu.org/', $str);
		$str = str_ireplace('//ajax.googleapis'.'.com/', '//fdn.geekzu.org/ajax/', $str);
	} else {
		$str = str_ireplace('//fonts.googleapis'.'.com/', '//fonts.geekzu.org/', $str);
		$str = str_ireplace('//ajax.googleapis'.'.com/', '//sdn.geekzu.org/ajax/', $str);
	}

	return $str;
}

function useso_take_over_google_str_handler2($matches)
{
	$str = $matches[0];

	$is_ssl = false;
	if (stristr($str, 'https://')) {
		$is_ssl = true;
	} else {
		if (!stristr($str, 'http://') && is_ssl()) {
			$is_ssl = true;
		}
	}

	if ($is_ssl) {
		$webfont_js = USESO_TAKE_OVER_GOOGLE_PLUGIN_URL . 'webfont_https_v1.5.3.js';
	} else {
		$webfont_js = USESO_TAKE_OVER_GOOGLE_PLUGIN_URL . 'webfont_https_v1.5.3.js';
	}

	$str = preg_replace('|//ajax.googleapis'.'.com/ajax/libs/webfont/[\d\.]+/webfont.js|i', substr($webfont_js, strpos($webfont_js,'//')), $str);

	// fix for Avada-4.0.3
	if ($is_ssl && !is_ssl()) {
		$str = str_ireplace('https://', 'http://', $str);
	}
	if (!$is_ssl && is_ssl()) {
		$str = str_ireplace('http://', 'https://', $str);
	}

	return $str;
}

function useso_take_over_google_str_handler3($matches)
{
	$str = $matches[0];

	$regexp = "/(\d+|www|secure|cn|s).gravatar.com\/avatar/i";
	$str = preg_replace($regexp, 'sdn.geekzu.org/avatar', $str);

	return $str;
}
?>