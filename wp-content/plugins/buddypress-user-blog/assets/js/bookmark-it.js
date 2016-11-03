jQuery( document ).ready( function ( $ ) {
    
    $( '.bookmark-it' ).on( 'click', function (e) {
        e.preventDefault();
        
        if( $( this ).hasClass('loading') ) {
            return false;
        }
        
        $(this).addClass('loading');
        $(this).find('.fa').addClass('fa-spinner fa-spin');

        var post_id = $( this ).attr( 'data-post-id' ),
            user_id = $( this ).attr( 'data-user-id' ),
            user_action = $( this ).attr( 'data-action' );

        $.ajax( {
            url: bookmark_it_vars.ajaxurl,
            type: 'post',
            data: {
                action: 'bookmark_it',
                item_id: post_id,
                user_id: user_id,
                user_action: user_action,
                bookmark_it_nonce: bookmark_it_vars.nonce
            },
            success: function ( html ) {
                $( '.bookmark-it' ).removeClass('loading').find('.fa').removeClass('fa-spinner fa-spin');;

                if( 'add-bookmark' === user_action ) {
                    $( '.bookmark-it' ).attr('data-action', 'remove-bookmark').addClass('bookmarked').find('.fa').toggleClass('fa-bookmark-o fa-bookmark');
                } else {
                    $( '.bookmark-it' ).attr('data-action', 'add-bookmark').removeClass('bookmarked').find('.fa').toggleClass('fa-bookmark fa-bookmark-o');
                }
            }
        } );
    } );
} );