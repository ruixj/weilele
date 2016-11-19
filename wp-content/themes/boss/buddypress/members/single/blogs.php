<?php
/**
 * BuddyPress - Users Blogs
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="item-list-tabs" id="subnav" role="navigation">
 
</div><!-- .item-list-tabs -->

<?php
switch ( bp_current_action() ) :

	// Home/My Blogs
	case 'my-sites' :

		/**
		 * Fires before the display of member blogs content.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_before_member_blogs_content' ); ?>

		<div class="blogs myblogs">

			<?php bp_get_template_part( 'blogs/blogs-loop' ) ?>

		</div><!-- .blogs.myblogs -->

		<?php

		/**
		 * Fires after the display of member blogs content.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_after_member_blogs_content' );
		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;
