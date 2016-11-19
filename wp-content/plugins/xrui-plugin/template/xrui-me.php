<?php   
    global $bp;

	// Need to change the user ID, so if we're not on a member page, $counts variable is still calculated
	$user_id = /*bp_is_user() ? bp_displayed_user_id() : */bp_loggedin_user_id();

	// BuddyBar compatibility
	$user_domain = /*bp_displayed_user_domain() ? bp_displayed_user_domain() :*/ bp_loggedin_user_domain();

	/** FOLLOWERS NAV ************************************************/
	$counts         = bp_follow_total_follow_counts( array( 'user_id' => $user_id ) );
	$slug           = bp_get_friends_slug();
	$friends_link   = trailingslashit( $user_domain . $slug );	
	$following_link = $friends_link.$bp->follow->following->slug;
	$follower_link  = $friends_link.$bp->follow->followers->slug;
		
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
	
	//if ( !is_user_logged_in() || bp_displayed_user_id() != get_current_user_id() ) {
	//	$blogname = __( 'Articles', 'bp-user-blog' );
	//} else {
		$blogname = __( 'Published', 'bp-user-blog' );
	//}	
	$bookmarks_link =trailingslashit( $blog_link . 'bookmarks' ); 
	
	$photos_cnt = bbm_total_photos_count();
	$buddyboss_media_link = trailingslashit( $user_domain . buddyboss_media_default_component_slug() ); 
	
	$slug         = bp_get_profile_slug();
	$profile_link = trailingslashit( $user_domain . $slug );
	$profile_name = _x( 'Profile', 'Profile header menu', 'buddypress' );
	
	
	$me_activity_link = trailingslashit( $user_domain . $bp->activity->slug ) . 'just-me/';
	
	$slug               = bp_get_notifications_slug();
	$notifications_link = trailingslashit( $user_domain . $slug );

	// Only grab count if we're on a user page and current user has access.
	if ( bp_is_user() && bp_user_has_access() ) {
		$count    = bp_notifications_get_unread_notification_count( bp_displayed_user_id() );
		//$class    = ( 0 === $count ) ? 'no-count' : 'count';
		$nav_name = sprintf(
			/* translators: %s: Unread notification count for the current user */
			_x( '通知 %s', 'Profile screen nav', 'buddypress' ),
			sprintf(
				'%s',
				bp_core_number_format( $count )
			)
		);
	} else {
		$nav_name = _x( '通知', 'Profile screen nav', 'buddypress' );
	}	
?>
<div data-node="profileWrap wll-profileWrap" class="container" style="display: block;"> 
   <div class="dataCont">
 
      <div class="card11 card-combine wll-box01" data-node="group" id="boxId_1478094959183_29">
         <div data-node="cardList" class="card-list">

            <div class="card card2 " id="boxId_1478094959183_31">
               <div class="layout-box lay-box01">
                  <a class="box-col" href="<?php echo $me_activity_link;?>" data-act-type="hover">
                     <div class="mct-a  ">
                      13
                     </div>
                     <div class="mct-a">
                      动态
					  </div>
                  </a>
                  <a class="box-col" href=<?php echo $following_link; ?> >
                     <div class="mct-a ">
                     <?php echo $counts['following']; ?>
					 </div>
                     <div class="mct-a">
                     关注</div>
                  </a>
				  
				  <a class="box-col" href=<?php echo $follower_link; ?>  >
                     <div class="mct-a ">
                     <?php echo $counts['followers']; ?></div>
                     <div class="mct-a">
                     粉丝
					 </div>
                  </a>

               </div>
            </div>
         </div>
      </div>
      <div class="card11 card-combine wll-box02" data-node="group" id="boxId_1478094959183_40">
         <div data-node="cardList" class="card-list">
            <div class="card card4" id="boxId_1478094959183_41">
               <a href="<?php echo $profile_link;?>" class="layout-box" data-act-type="hover">
                  <i class="iconimg iconimg-s">
                     <img width="23" height="23" src="http://u1.sinaimg.cn/upload/h5/img/440/cards/icon/gear_2x.png" alt="">
                  </i>
                  <div class="box-col txt-cut">
                  <span class="mct-a ">
                  个人资料
				  </span>
                  </div>
                  <span data-node="arrow" class="plus plus-s">
                     <i class="icon-font icon-font-arrow-right ">
                     </i>
                  </span>
               </a>
            </div>
				
         </div>
      </div>  
	  <div class="card11 card-combine wll-box03" data-node="group" id="boxId_1478094959183_36">
         <div data-node="cardList" class="card-list">
            <div class="card card4" id="boxId_1478094959183_37">
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
                     <i class="icon-font icon-font-arrow-right ">
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
                  <i class="icon-font icon-font-arrow-right ">
                  </i>
                  </span>
               </a>
            </div-->
         </div>
      </div>
      <div class="card11 card-combine wll-box04" data-node="group" >
         <div data-node="cardList" class="card-list">
            <div class="card card32" >
               <a href="<?php echo $blog_link;?>" class="layout-box" >
                  <i class="iconimg iconimg-s">
                     <img width="23" height="23" src="http://u1.sinaimg.cn/upload/2014/03/19/60990.png" data-node="cMesImg">
                  </i>
                  <div class="box-col txt-cut">
                     <span class="mct-a " >
                        <?php echo $blogname;?>
                     </span>
                 </div>
                 <span data-node="arrow" class="plus plus-s">
					 <i class="icon-font icon-font-arrow-right ">
					 </i>
				</span>
				 <!--
				 <span class="plus plus-m">
				   <span data-node="arrow" class="plus plus-s">
					 <i class="icon-font icon-font-arrow-right ">
					 </i>
				   </span>
				 </span>
				 -->
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
					<div class="card card32" >
					   <a href="<?php echo $pendinglink;?>" class="layout-box" >
						  <i class="iconimg iconimg-s">
							 <img width="23" height="23" src="http://u1.sinaimg.cn/upload/2014/03/19/60990.png" data-node="cMesImg">
						  </i>
						  <div class="box-col txt-cut">
							 <span class="mct-a " >
								<?php echo __( 'In Review', 'bp-user-blog' );?>
							 </span>
						 </div>
						<span data-node="arrow" class="plus plus-s">
							 <i class="icon-font icon-font-arrow-right ">
							 </i>
						</span>
						 <!--
						 <span class="plus plus-m">
						   <span data-node="arrow" class="plus plus-s">
							 <i class="icon-font icon-font-arrow-right ">
							 </i>
						   </span>
						 </span>
						 -->
					   </a>
					</div>
		    <?php 
				}
				$draftlink = $blog_link.'drafts';			
			?>
				<div class="card card32" >
				   <a href="<?php echo $draftlink;?>" class="layout-box" >
					  <i class="iconimg iconimg-s">
						 <img width="23" height="23" src="http://u1.sinaimg.cn/upload/2014/03/19/60990.png" data-node="cMesImg">
					  </i>
					  <div class="box-col txt-cut">
						 <span class="mct-a " >
							<?php echo __( 'Drafts', 'bp-user-blog' );?>
						 </span>
					 </div>
					 <span data-node="arrow" class="plus plus-s">
						 <i class="icon-font icon-font-arrow-right ">
						 </i>
					</span>
					 <!--
					 <span class="plus plus-m">
					   <span data-node="arrow" class="plus plus-s">
						 <i class="icon-font icon-font-arrow-right ">
						 </i>
					   </span>
					 </span>
					 -->
				   </a>
				</div>			
		    <?php
			} 
			?>	
            <div class="card card4" id="boxId_1478094959183_38">
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
                     <i class="icon-font icon-font-arrow-right ">
                     </i>
                  </span>
               </a>
            </div>			
         </div>
      </div>
      <div class="card11 card-combine wll-box05" data-node="group" id="boxId_1478094959183_34">
         <div data-node="cardList" class="card-list">
            <div class="card card4" id="boxId_1478094959183_35">
               <a href="<?php echo $notifications_link; ?>" class="layout-box" >
                  <i class="iconimg iconimg-s">
                     <img width="23" height="23" src="http://h5.sinaimg.cn/upload/2014/12/26/29/card_icon_level_default.png" alt="">
                  </i>
                  <div class="box-col txt-cut">
                     <span class="mct-a ">
                     <?php echo $nav_name;?>
					 </span>
                     <span class="mct-b txt-xs">
                      </span>
                  </div>
                  <span data-node="arrow" class="plus plus-s">
                     <i class="icon-font icon-font-arrow-right ">
                     </i>
                  </span>
               </a>
            </div>
         </div>
      </div>

      <div class="card11 card-combine wll-box06" data-node="group" id="boxId_1478094959183_36">
         <div data-node="cardList" class="card-list">
		    <div class="card card4" >
               <a href="<?php echo wp_logout_url(); ?>" class="layout-box" data-act-type="hover">
                  <!--<i class="iconimg iconimg-s">
                     <img width="23" height="23" src="http://u1.sinaimg.cn/upload/h5/img/440/cards/icon/gear_2x.png" alt="">
                  </i>
				  -->
                  <div class="box-col txt-cut">
                  <span class="mct-a ">
                     <?php _e( 'Logout', 'boss' ); ?>
				  </span>
                  </div>
				  <!--
                  <span data-node="arrow" class="plus plus-s">
                     <i class="icon-font icon-font-arrow-right txt-s">
                     </i>
                  </span>
				  -->
               </a>
            </div>
         </div>
      </div>
   </div>
</div>

