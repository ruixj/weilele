<?php do_action( 'bp_before_directory_members_page' ); ?>

<div id="buddypress">

	<?php do_action( 'bp_before_directory_members' ); ?>
 

	<div id="members-dir-search" class="dir-search" role="search">
		<?php bp_directory_members_search_form(); ?>
		<input type="hidden" id="members-all" />
	</div><!-- #members-dir-search -->
 

	<?php do_action( 'bp_before_directory_members_tabs' ); ?>

	<form action="" method="post" id="members-directory-form" class="dir-form">

        <!-- needed for member list scroll -->
        <div id="subnav"></div>

		<div id="members-dir-list" class="members dir-list">
			<?php bp_get_template_part( 'members/members-loop' ); ?>
		</div><!-- #members-dir-list -->

		<?php do_action( 'bp_directory_members_content' ); ?>

		<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>

		<?php do_action( 'bp_after_directory_members_content' ); ?>

	</form><!-- #members-directory-form -->

	<?php do_action( 'bp_after_directory_members' ); ?>

</div><!-- #buddypress -->

<?php do_action( 'bp_after_directory_members_page' ); ?>
