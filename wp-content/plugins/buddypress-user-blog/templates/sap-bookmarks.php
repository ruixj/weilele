<?php
/**
 * The template for displaying WordPress pages, including HTML from BuddyPress templates.
 *
 * @package WordPress
 * @subpackage OneSocial Theme
 * @since OneSocial Theme 1.0.0
 */
get_header();
?>

<div id="primary" class="site-content">
	<div id="content" role="main">
		<?php
		if ( is_user_logged_in() ) {

			$bookmarked = get_user_option( 'sap_user_bookmarks', get_current_user_id() );

			if ( !empty( $bookmarked ) ) {
	    ?>
		     <div class="inner sap-post-container">
				<?php
				foreach ( $bookmarked as $id ) {
				?>

					<article class="post sap-post sap-member-post">
					    <a  href="<?php the_permalink( $id ); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'bp-user-blog' ); ?> <?php the_title_attribute(array('post' => $id )); ?>"></a>
						<div class="post-featured-image">
							
								<?php
								if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail( $id  ) ) {
									//the_post_thumbnail( 'thumbnail', array( 'class' => 'avatar' ) );
									echo get_the_post_thumbnail( $id, 'post-thumb' ) ; 
								} else {
									echo get_avatar( get_the_author_meta( 'user_email' ), '150' );
								}
								?>
							
						</div>

						<div class="post-content">

							<div class="sap-post-title">
								<a href="<?php the_permalink($id); ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'bp-user-blog' ); ?> <?php the_title_attribute(array('post' => $id )); ?>"><?php echo get_the_title( $id ); ?></a>
							</div>
							<p class="date"><?php printf( __( '%1$s', 'bp-user-blog' ), get_the_date('',$id) ); ?></p>

							<div class="sap-excerpt">
								<?php echo get_the_excerpt($id); ?>
							</div>
						</div>					
					</article>
	    <?php
				}
			}
			else
			{
				_e( '你还没有收藏文章...', 'bp-user-blog' );
			}
		} else {
			_e( 'Please login to view your bookmarks', 'bp-user-blog' );
		}
		?>

	</div>
</div>

<?php
//get_sidebar();

//get_footer();
