<?php

if(!function_exists('wpjam_query_cache')){
	function wpjam_query_cache($args=array(),$cache_time='600'){
		$cache_key		= 'wpjam_query'.md5(serialize($args));

		$wpjam_query = get_transient($cache_key);

		if($wpjam_query === false){
			$wpjam_query = new WP_Query($args);
			set_transient($cache_key, $wpjam_query, $cache_time);
		}

		return $wpjam_query;
	}
}

/*
Usage:
	$wpjam_html_cache = new WPJAM_HTML_Cache( 'unique-key', 3600 ); // Second param is TTL
	if ( !$wpjam_html_cache->output() ) { // NOTE, testing for a return of false
		functions_that_do_stuff_live();
		these_should_echo();
		// IMPORTANT
		$wpjam_html_cache->store();
		// YOU CANNOT FORGET THIS. If you do, the site will break.
	}
*/

class WPJAM_HTML_Cache {
	var $key;
	var $ttl;

	public function __construct( $key, $ttl ) {
		$this->key = 'wpjam_html_cache_'.$key;
		$this->ttl = $ttl;
	}

	public function output() {
		$output = get_transient( $this->key );
		if ( !empty( $output ) ) {
			echo $output;
			return true;
		} else {
			ob_start();
			return false;
		}
	}

	public function store() {
		$output = ob_get_flush();
		set_transient( $this->key, $output, $this->ttl );
	}
}