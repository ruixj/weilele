<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Boss
 * @since Boss 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<!-- Single blog post -->
	<?php if ( is_single() ) : ?>
		<!-- Title -->
		<header class="entry-header">

			<h1 class="entry-title"><?php the_title(); ?></h1>

		</header><!-- .entry-header -->

	<?php endif; // is_single() ?>

	<!-- Search, Blog index, archives -->
	<?php if ( is_search() || is_archive() || is_home() ) : // Only display Excerpts for Search, Blog index, and archives ?>

		<div class="post-wrap-front">
		    <!--thumbnail--->
 
			<?php
		    if ( function_exists( 'has_post_thumbnail' ) && has_post_thumbnail(   ) ) 
			{
		    ?>
				<div class="post-image-front">
					<a class="entry-post-thumbnail-front" href="<?php the_permalink(); ?>">
						<?php
							the_post_thumbnail( 'thumbnail', array( 'class' => 'avatar' ) );
						?>
					</a>
				</div>
			<?php 
			}
			?>
			<div class="post-content-front">
				<!---entry-title --> 
				<header class="post-title-front">
					 
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'boss' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				 
				</header>


			

				<div class="entry-content entry-summary  ">
 
					<footer class="entry-meta-front table">
					    <div class="entry-meta-front mobile">
							<?php buddyboss_entry_metawll(true,false); ?>
						</div>
						
						<div class="entry-meta table-cell desktop ">
							<?php buddyboss_entry_meta(); ?>
							<span class="entry-actions">
							<?php if ( comments_open() ) : ?>
								<?php comments_popup_link( '', '', '', 'reply', '' ); ?>
							<?php endif; // comments_open() ?>	
                            </span>							
						</div>

						<!--div class="mobile">
							<?php// buddyboss_entry_meta( true, false, false ); ?>
						</div-->

						<!--span class="entry-actions table-cell mobile">
							<?php 
							//if ( comments_open() ) {
							//	comments_popup_link( '', '', '', 'reply', '' ); 
							//}
							?>
						</span><!-- .entry-actions -->

					</footer><!-- .entry-meta -->

				</div><!-- .entry-content -->
			</div>
		</div><!-- .post-wrap -->

		<!-- all other templates -->
	<?php else : ?>

		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'boss' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'boss' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php edit_post_link( __( 'Edit', 'boss' ), '<span class="edit-link">', '</span>' ); ?>

	<?php endif; ?>


</article><!-- #post -->
