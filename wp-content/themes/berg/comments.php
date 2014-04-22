<?php

$commenter = wp_get_current_commenter();
$req = get_option( 'require_name_email' );
$aria_req = ( $req ? " aria-required='true'" : '' );

$name        = 'Name';
$authorEmail = "Email";


$comment_args = array(
    'id_form' => 'commentform',
    'id_submit' => 'submit',
    'title_reply' => __( 'Write a comment' ),
    'title_reply_to' => __( 'Leave a Reply to %s' ),
    'cancel_reply_link' => __( 'Cancel Reply' ),
    'label_submit' => __( 'Submit' ),
    'comment_field' => '<div class="inputFields col-md-12"><textarea placeholder="'.__('Comment','um_lang').'" id="comment" name="comment" aria-required="true"  ></textarea></p></div>',
    'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
    'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
    'comment_notes_before' => '',
    'comment_notes_after' => '<div class="resetWrapper"><input class="btn" type="reset"></div>',
    'fields' => apply_filters( 'comment_form_default_fields', array(
            'author' => '<div class="inputFields col-md-6"><input placeholder="'.esc_attr($name)  .'" id="author" name="author" type="text" class="span2" value="" ' . $aria_req . ' /></div>',
            'email' => '<div class="inputFields col-md-6"><input placeholder="'.esc_attr($authorEmail)  .'" id="email" name="email" type="text" class="span2" value=""' . $aria_req . ' /></div>'
        )
    )
);

?>
<?php comment_form( $comment_args); ?>

<div id="comments">
    <?php if ( post_password_required() ) : ?>
    <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'um_lang' ); ?></p>
</div><!-- #comments -->
<?php
/* Stop the rest of comments.php from being processed,
 * but don't kill the script entirely -- we still have
 * to fully load the template.
 */
return;
endif;
?>

<?php if ( have_comments() ) : ?>


    
    <h4 class="latestComents"><?php _e('Latest comments','um_lang'); ?></h4>


    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-above">
            <div class="nav-previous"><?php previous_comments_link('&larr; Previous'); ?></div>
            <div class="nav-next"><?php next_comments_link('Next &rarr;'); ?></div>
        </nav>
    <?php endif; // check for comment navigation ?>

    <div class="commentBody">
        <ul>
            <?php
            /* Loop through and list the comments. Tell wp_list_comments()
             * to use twentyeleven_comment() to format the comments.
             * If you want to overload this in a child theme then you can
             * define twentyeleven_comment() and that will be used instead.
             * See twentyeleven_comment() in twentyeleven/functions.php for more.
             */
            wp_list_comments( array( 'callback' => 'umbrella_comment' ) );
            ?>
        </ul>

    </div>
    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below">
            <div class="nav-previous"><?php previous_comments_link('&larr; Previous'); ?></div>
            <div class="nav-next"><?php next_comments_link('Next &rarr;'); ?></div>
        </nav>
    <?php endif; // check for comment navigation ?>

    <?php
    /* If there are no comments and comments are closed, let's leave a little note, shall we?
     * But we only want the note on posts and pages that had comments in the first place.
     */
    if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="nocomments"><?php _e( 'Comments are closed.' , 'um_lang' ); ?></p>
    <?php endif; ?>

<?php endif; // have_comments() ?>

</div><!-- #comments -->
