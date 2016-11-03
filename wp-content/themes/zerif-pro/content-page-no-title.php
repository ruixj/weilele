<?php

/**

 * The template used for displaying page content in template-fullwidth-no-title.php

 *

 * @package zerif

 */

?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content" itemprop="text">

		<?php the_content(); ?>

		<?php

			wp_link_pages( array(

				'before' => '<div class="page-links">' . __( 'Pages:', 'zerif' ),

				'after'  => '</div>',

			) );

		?>

	</div><!-- .entry-content -->

	<?php edit_post_link( __( 'Edit', 'zerif' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>

</article><!-- #post-## -->