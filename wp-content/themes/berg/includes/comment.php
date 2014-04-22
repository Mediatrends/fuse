<?php
if ( ! function_exists('umbrella_comment')) :
    function umbrella_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case 'pingback' :
            case 'trackback' :
                ?>
                <li>
                <td class="post pingback">
                    <p><?php _e( 'Pingback:', 'um_lang' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'um_lang' ), '<span class="edit-link">', '</span>' ); ?></p>
                </td>

                <?php
                break;
            default :
                ?>

                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<div class="commentButtons">
						<?php 
						  comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'um_lang' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
								edit_comment_link( __( 'Edit', 'um_lang' ), '<span class="edit-link">', '</span>' );
						?>
					</div>
                    <div id="comment-<?php comment_ID(); ?>" class="comment commentText">
                        <?php
                        $avatar_size = 68;
                        echo get_avatar( $comment, $avatar_size );
                        ?>
                        <p>
                            <?php
                            /* translators: 1: comment author, 2: date and time */
                            printf( __('<span class="comment_name">%1$s</span> <span class="commentTime">%2$s</span>', 'um_lang' ),
                                sprintf( '%s', get_comment_author_link() ),
                                sprintf(human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago')
                            );
                            ?>
                        </p>
                        <?php if ( $comment->comment_approved == '0' ) : ?>
                            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'um_lang' ); ?></em>
                            <br />
                        <?php endif; ?>
                        <?php comment_text(); ?>
                    </div>
                <?php
                break;
        endswitch;
    }
endif; // ends check for twentyeleven_comment()
?>