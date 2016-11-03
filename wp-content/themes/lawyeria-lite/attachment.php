<?php
/**
 *	The template for displaying Attachment.
 *
 *	@package lawyeria-lite
 */
get_header();
?>
	<section class="wide-nav">
		<div class="wrapper">
			<h3>
				<?php the_title(); ?>
			</h3><!--/h3-->
		</div><!--/div .wrapper-->
	</section><!--/section .wide-nav-->
</header><!--/header-->
<section id="content">
	<div class="wrapper cf">
		<div id="posts">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
				<div class="post-excerpt">
					<img src="<?php echo wp_get_attachment_url($post->ID); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
				</div><!--/div .post-excerpt-->
			</div><!--/div .post-->
			<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'lawyeria-lite'); ?></p>
            <?php endif; ?>
		</div><!--/div #posts-->
		<?php get_sidebar(); ?>
	</div><!--/div .wrapper-->
</section><!--/section #content-->
<?php get_footer(); ?>