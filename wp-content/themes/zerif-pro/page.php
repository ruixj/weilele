<?php

/**

 * The template for displaying all pages.

 *

 * This is the template that displays all pages by default.

 * Please note that this is the WordPress construct of pages

 * and that other 'pages' on your WordPress site will use a

 * different template.

 *

 * @package zerif

 */



get_header(); ?>

<div class="clear"></div>

</header> <!-- / END HOME SECTION  -->

<?php zerif_after_header_trigger(); ?>

<div id="content" class="site-content">



	<div class="container">

		<?php zerif_before_page_content_trigger(); ?>

		<?php
		 
			if( (function_exists('is_cart') && is_cart()) || (function_exists('is_checkout') && is_checkout() ) || (function_exists('is_account_page') && is_account_page()) ) {
				
				echo '<div class="content-left-wrap col-md-12">';
				
			}
			else {
			
				echo '<div class="content-left-wrap col-md-9">';
				
			}
			
		?>	

		<?php zerif_top_page_content_trigger(); ?>

		<div id="primary" class="content-area">

			<main itemscope itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage" id="main" class="site-main" role="main">

				<?php 
				
					while ( have_posts() ) : 
					
						the_post();

						get_template_part( 'content', 'page' );
						
						/* If comments are open or we have at least one comment, load up the comment template */

						if ( comments_open() || '0' != get_comments_number() ) :

							comments_template();

						endif;

					endwhile;

				?>

			</main><!-- #main -->

		</div><!-- #primary -->
		
	<?php
	 
		if( (function_exists('is_cart') && is_cart()) || (function_exists('is_checkout') && is_checkout() ) || (function_exists('is_account_page') && is_account_page()) ) {
			zerif_bottom_page_content_trigger();
			echo '</div>';
			zerif_after_page_content_trigger();
		}
		else {
			zerif_bottom_page_content_trigger();
			echo '</div>';
			zerif_after_page_content_trigger();

			echo '<div class="sidebar-wrap col-md-3 content-left-wrap">';

				get_sidebar();

			echo '</div>';
		}
		
	?>	

	</div><!-- .container -->

<?php get_footer(); ?>
