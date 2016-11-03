<?php get_header(); ?>
	<section id="content" class="first clearfix">
		<div class="home-container">
     	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('item-list mbottom'); ?>>
       
		<div class="cthumb four-col">
            <a href="<?php the_permalink(); ?>">
			  <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'medium');} else { ?>
                <img src="<?php  echo get_template_directory_uri(); ?>/images/default-image.png" alt="<?php the_title();  ?>" />
              <?php } ?>
            </a>

        </div>
		 <div class="cdetail eight-col last">
        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        
            <div class="postmeta">
       		    <p class="vsmall pnone">by  <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) )?>" title="<?php sprintf( esc_attr__( 'View all posts by %s', 'jovial' ), get_the_author() ) ?>"><?php echo get_the_author() ?> </a>
     		       on <span class="mdate"><?php echo the_time(get_option( 'date_format' )) ?></span></p>
			</div>
        </div>
        <div class="catpost"><?php the_excerpt(); ?></div>
		<div class="clr"></div>
    </article>
<?php endwhile; ?>
    <div class="pagenavi alignright">
	    <?php if ($wp_query->max_num_pages > 1) jovial_wp_pagination(); ?>
	</div>
<?php else : get_template_part( 'no-results', 'loop' ); endif; ?>
		</div>
	</section> <!-- end #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>