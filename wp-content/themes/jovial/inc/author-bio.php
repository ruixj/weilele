<?php /* The template for displaying Author Bio. */ ?>
<section>
	<div class="authorbox mb">
		<div class="authorleft">
			<div class="authorimg"><?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta( 'email' ), '136' ); } ?></div>
       		<div class="authorbio">
				<a class="author-title" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                        <?php _e('By', 'jovial'); ?> <?php echo get_the_author(); ?></a>
			
				
				
				<p class=""><?php the_author_meta( 'description' ); ?></p>
                <ul class="authorlinks">
<?php if ( get_the_author_meta( 'url' ) != '' ) { ?>
				  <a class="author-site" href="<?php the_author_meta('url'); ?>" title="Visit my Website" target="_blank"><?php the_author_meta('url'); ?></a>
				<?php } ?>                

				<?php if ( get_the_author_meta( 'twitter' ) != '' ) { ?>   
				  <a href="https://twitter.com/<?php the_author_meta( 'twitter' ); ?>">@<?php the_author_meta( 'twitter' ); ?></a>
                    <?php } ?>
					
	            </ul>
            </div>
   		</div>
	</div>
</section>

			