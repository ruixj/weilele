<?php get_header(); ?>
	<section id="content" class="first clearfix" role="main">
		<div class="page-container">
            <?php if (have_posts()) : ?>
	            <?php while ( have_posts() ) : the_post(); ?>
	                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article">
                        <div class="singlebox">
		     					<header class="article-header">
								    <h1 class="post-title"><?php the_title(); ?></h1>
			  				    </header> <!-- end header -->
							    <section class="entry-content clearfix">
							        <?php the_content(); ?>
								    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'jovial' ), 'after' => '</div>' ) ); ?>
							    </section> <!-- end section -->
							    <footer class="article-footer">
								    <?php edit_post_link( __( 'Edit', 'jovial' ), '<span class="edit-link">', '</span>' ); ?>
							    </footer> <!-- end footer -->
							<?php if ( comments_open() || '0' != get_comments_number() ) comments_template( '', true ); ?>
                        </div>
					</article> <!-- end article -->
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</section> <!-- end #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>