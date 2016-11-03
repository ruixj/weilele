<?php
/**
 *  The template for displaying Comments.
 *
 *  @package lawyeria-lite
 */
if ( post_password_required() )
     return;
?>

    <div id="comments-template" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <div class="comments-template-title">
            <span>
                <?php
                    printf( _n( 'One Comment', '%1$s Comments', get_comments_number(), 'lawyeria-lite' ),
                        number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
                ?>
            </span><!--/span-->
            -
            <a href="#respond" title="Leave a Comment">
                <?php _e('Leave a Comment','lawyeria-lite'); ?>
            </a><!--/a-->
        </div><!--/div .comments-template-->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
            <h1 class="assistive-text"><?php _e( 'Comment navigation', 'lawyeria-lite' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'lawyeria-lite' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'lawyeria-lite' ) ); ?></div>
        </nav><!-- #comment-nav-before .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>

        <div class="comments-list cf">
            <?php wp_list_comments( array( 'callback' => 'lawyeria_lite_shape_comment' ) ); ?>
        </div><!--/div .comments-list .cf-->

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
        <nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
            <h1 class="assistive-text"><?php _e( 'Comment navigation', 'lawyeria-lite' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'lawyeria-lite' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'lawyeria-lite' ) ); ?></div>
        </nav><!-- #comment-nav-below .site-navigation .comment-navigation -->
        <?php endif; // check for comment navigation ?>

    <?php endif; // have_comments() ?>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="nocomments"><?php _e( 'Comments are closed.', 'lawyeria-lite' ); ?></p>
    <?php endif; ?>

        <?php
            $commenter = wp_get_current_commenter();
            $req = get_option( 'require_name_email' );
            $aria_req = ( $req ? " aria-required='true'" : '' );
            if($commenter['comment_author'] != '')
                $name = esc_attr($commenter['comment_author']);
            else
                $name = '';
            if($commenter['comment_author_email'] != '')
                $email = esc_attr($commenter['comment_author_email']);
            else
                $email = '';
            if($commenter['comment_author_url'] != '')
                $url = esc_attr($commenter['comment_author_url']);
            else
                $url = '';

            $fields =  array(
            'author' => '
                <fieldset>
                    <input class="input-full" placeholder="Full name (*)" name="author" type="text" value="' . $name . '" ' . $aria_req . ' />',
            'email'  => '
                    <input class="input-small-left" placeholder="E-mail address (*)" name="email" type="email" value="' . $email . '" ' . $aria_req . ' />',
            'url'    => '
                    <input class="input-small-right" placeholder="Website URL" name="url" type="url" value="' . $url . '" />
                </fieldset>'
            );

            $comment_textarea = '<textarea placeholder="Your Message... (*)" class="input-textarea" name="comment" aria-required="true"></textarea>';
            comment_form( array( 'fields' => $fields, 'comment_field' => $comment_textarea, 'id_submit' => 'contact_submit', 'label_submit' => esc_attr__( 'Submit', 'lawyeria-lite' ), 'title_reply' => esc_attr__( 'Leave a comment', 'lawyeria-lite' ), 'title_reply_to' => esc_attr__( 'Leave a comment to %s', 'lawyeria-lite' )) );
        ?>

</div><!-- #comments .comments-area -->