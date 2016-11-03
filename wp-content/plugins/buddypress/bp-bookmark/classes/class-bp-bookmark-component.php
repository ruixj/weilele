<?php
/**
 * BuddyPress XProfile Loader.
 *
 * An extended profile component for users. This allows site admins to create
 * groups of fields for users to enter information about themselves.
 *
 * @package BuddyPress
 * @subpackage XProfileLoader
 * @since 1.5.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Creates our XProfile component.
 *
 * @since 1.5.0
 */
class BP_BookMark_Component extends BP_Component {


	/**
	 * Start the xprofile component creation process.
	 *
	 * @since 1.5.0
	 */
	public function __construct() {
		parent::start(
			'bookmark',
			_x( 'Bookmarks', 'Bookmarks', 'buddypress' ),
			buddypress()->plugin_dir,
			array(
				'adminbar_myaccount_order' => 60
			)
		);

		$this->setup_hooks();
	}

	/**
	 * Set up navigation.
	 *
	 * @since 1.5.0
	 *
	 * @global BuddyPress $bp The one true BuddyPress instance
	 *
	 * @param array $main_nav Array of main nav items to set up.
	 * @param array $sub_nav  Array of sub nav items to set up.
	 */
	public function setup_nav( $main_nav = array(), $sub_nav = array() ) {



		parent::setup_nav( $main_nav, $sub_nav );
	}


	/**
	 * Set up the Admin Bar.
	 *
	 * @since 1.5.0
	 *
	 * @param array $wp_admin_nav Admin Bar items.
	 */
	public function setup_admin_bar( $wp_admin_nav = array() ) {

		// Menus for logged in user.
		if ( is_user_logged_in() ) {
			global $wp_admin_bar;
			$bookmarks_slug = bp_loggedin_user_domain().'bookmarks';				
			$wp_admin_bar->add_menu( array(
				'parent' => 'my-account-buddypress',
				'id'     => 'my-bookmarks-blog',
				'title'  => _x( '我的收藏' , 'buddypress' ),
				'href'   => trailingslashit( $bookmarks_slug ),
				'meta'      => array(
							'class'     => 'menupop',
						)
			) ); 
		}

		parent::setup_admin_bar( $wp_admin_nav );
	}

}
