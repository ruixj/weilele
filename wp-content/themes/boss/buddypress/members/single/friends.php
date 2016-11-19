<?php
/**
 * BuddyPress - Users Friends
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
	<ul>
		<?php //if ( bp_is_my_profile() ) bp_get_options_nav(); ?>
	</ul>
</div>

<?php
switch ( bp_current_action() ) :

	// Home/My Friends
	case 'my-friends' :

		/**
		 * Fires before the display of member friends content.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_before_member_friends_content' ); ?>
		<div id="members-dir-search" class="dir-search" role="search">
			<?php bp_directory_members_search_form(); ?>
			<input type="hidden" id="members-all" /> <!--members-personal-->
		</div><!-- #members-dir-search -->
		<div class="members friends">

			<?php bp_get_template_part( 'members/members-loop' ) ?>

		</div><!-- .members.friends -->

		<?php

		/**
		 * Fires after the display of member friends content.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_after_member_friends_content' );
		break;

	case 'requests' :
		bp_get_template_part( 'members/single/friends/requests' );
		break;
		
	case 'membersearch' :
		bp_get_template_part( 'members/membersearch' );
		break;
	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;
