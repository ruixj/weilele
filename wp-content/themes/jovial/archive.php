<?php get_header(); ?>
	<section id="content" class="first clearfix">
		<div class="cat-container">
							
				<?php if (is_category()) { ?>
					<div class="cat-head mbottom">
						<h1 class="archive-title">
							<span><?php _e("Posts Categorized:", "jovial"); ?></span> <?php single_cat_title(); ?>
						</h1>
                    </div>
				<?php } elseif (is_tag()) { ?>
					<div class="cat-head mbottom">
						<h1 class="archive-title">
							<?php _e("Posts Tagged:", "jovial"); ?> <?php single_tag_title(); ?>
						</h1>
                    </div>
				<?php } elseif (is_author()) {
					global $post;
					$author_id = $post->post_author; ?>
					<div class="cat-head mbottom">
						<h1 class="archive-title">
							<?php _e("Posts By:", "jovial"); ?> <?php the_author_meta('display_name', $author_id); ?>
						</h1>
					</div>
				<?php } elseif (is_day()) { ?>
					<div class="cat-head mbottom">
						<h1 class="archive-title">
							<?php _e("Daily Archives:", "jovial"); ?> <?php the_time('l, F j, Y'); ?>
						</h1>
                    </div>
				<?php } elseif (is_month()) { ?>
                    <div class="cat-head mbottom">
		                <h1 class="archive-title">
							<?php _e("Monthly Archives:", "jovial"); ?> <?php the_time('F Y'); ?>
						</h1>
                    </div>
				<?php } elseif (is_year()) { ?>
                    <div class="cat-head mbottom">
		                <h1 class="archive-title">
							<?php _e("Yearly Archives:", "jovial"); ?> <?php the_time('Y'); ?>
						</h1>
                    </div>
				<?php } ?>
				<?php get_template_part( 'loop', 'archive' ); ?>
			</div>
	</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>