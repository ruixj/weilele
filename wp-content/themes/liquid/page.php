<?php get_header(); ?>

    <div class="detail page">
        <div class="container">
          <div class="row">
           <div class="col-md-8 mainarea">
          
           <?php if (have_posts()) : ?>
           <?php while (have_posts()) : the_post(); ?>
            <h1 class="ttl_h1"><?php the_title(); ?></h1>

            <!-- pan -->
            <?php
                $cat_name = get_the_title($post->post_parent);
                $cat_slug = get_page_link($post->post_parent);
            ?>
            <ul class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
              <li><a href="<?php echo esc_url( home_url() ); ?>" itemprop="url"><span itemprop="title"><?php esc_html_e( '主页', 'liquid' ); ?></span></a></li>
              <?php if($post->post_parent){ echo '<li><a href="'.esc_html($cat_slug).'" itemprop="url"><span itemprop="title">'.esc_html($cat_name).'</span></a></li>'; } ?>
              <li class="active"><?php the_title(); ?></li>
            </ul>


            <div class="detail_text">
               
                <div class="post_meta">
                <?php if(has_post_thumbnail()) { the_post_thumbnail(); } ?>
                </div>
                <div class="post_body"><?php the_content(); ?></div>
                
            </div>
           <?php endwhile; ?>
           <div class="detail_comments">
               <?php comments_template(); ?>
           </div>
           <?php else : ?>
               <div class="col-xs-12"><?php esc_html_e( 'No articles', 'liquid' ); ?></div>
               <?php get_search_form(); ?>
           <?php endif; ?>
           
           
            <?php
            // Paging
            $args = array(
                'before' => '<nav><ul class="page-numbers">', 
                'after' => '</ul></nav>', 
                'link_before' => '<li>', 
                'link_after' => '</li>'
            );
            wp_link_pages( $args );
            ?>

            
           </div><!-- /col -->
           <?php get_sidebar(); ?>
           
         </div>
        </div>
    </div>

   
<?php get_footer(); ?>
