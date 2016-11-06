<div id="mobile-header" class="table <?php echo ( boss_get_option( 'boss_adminbar' ) ) ? 'with-adminbar' : ''; ?>">

	<!-- Toolbar for Mobile -->
 
	<!-- Toolbar for Mobile -->
	<div class="mobile-header-outer home-sub-nav layout-box ">
		<ul id="nav-bar-filter">
		    <?php
    		//	if( is_user_logged_in()) {  
            //        bp_get_displayed_user_nav(); 
            //        do_action( 'bp_member_options_nav' ); 
			//	}
				global $bp;

				// Need to change the user ID, so if we're not on a member page, $counts variable is still calculated
				$user_id = bp_is_user() ? bp_displayed_user_id() : bp_loggedin_user_id();

				// BuddyBar compatibility
				$user_domain = bp_displayed_user_domain() ? bp_displayed_user_domain() : bp_loggedin_user_domain();	
			    $me_link     = trailingslashit( $user_domain . 'me' );	
				$blog_link   = trailingslashit( $user_domain . __( 'blog', 'bp-user-blog' ) );
				
				$create_new_post_page = buddyboss_sap()->option('create-new-post');
				$create_post_link     = trailingslashit(get_permalink( $create_new_post_page ));
				
				//Keeping addnew post same if network activated
				if (is_multisite()) {
					if (!function_exists('is_plugin_active_for_network'))
						require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
					if (is_plugin_active_for_network(basename(constant('BP_PLUGIN_DIR')) . '/bp-loader.php') && is_plugin_active_for_network(basename(constant('BUDDYBOSS_SAP_PLUGIN_DIR')) . '/bp-user-blog.php') ) {
						$create_post_link = trailingslashit(get_blog_permalink( 1,$create_new_post_page ));
					}
				}	

				$slug       = bp_get_groups_slug();
				$group_link = trailingslashit( $user_domain . $slug );	
				
				$wall_profile_link = trailingslashit( $user_domain . $bp->activity->slug );	 
		    ?>	
		   <?php 
			if (( bp_loggedin_user_id() && !bp_displayed_user_id())  || bp_is_my_profile())
			{
			?>			
		    <li>
			    <a id='homeinfo' href="<?php echo esc_url( home_url() ); ?>">资讯</a>
			</li>
			
		    <li>
			    <a id='community' href="<?php echo $group_link; ?>">社区</a>
			</li>
			
		    <li>
			    <a id='activity' href="<?php echo $wall_profile_link; ?>">圈子</a>
			</li>
	
		    <li>
			    <a id='article' href="<?php echo $create_post_link; ?>">投稿</a>
			</li>			

			<li>
			    <a id='selfinfo' href="<?php echo $me_link; ?>">我的</a>
			</li>            
            <?php
			}
			else
			{
			?>
            <?php
			
			}?>
		</ul>

	</div>
</div><!-- #mobile-header -->