<?php

function custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more) {
       global $post;
    return '... <br /><a href="'. get_permalink($post->ID) . '" class="read-more more-link">READ&nbsp;FULL&nbsp;ARTICLE</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function my_enqueue_scripts() {
    
    wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.custom.35063.js', true);
    wp_enqueue_script( 'modernizr' );

    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
    wp_enqueue_script( 'jquery' );

}    
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');

function my_enqueue_styles() {

    wp_register_style('style',get_template_directory_uri() . '/style.css');
    wp_enqueue_style('style');

    // accordion menu styles
    wp_register_style('sidebar-accordion',get_template_directory_uri() . '/assets/menu/css/styles.css');
    wp_enqueue_style('sidebar-accordion');
    // END accordion menu styles

    wp_register_style('main',get_template_directory_uri() . '/main.css');
    wp_enqueue_style('main');

    wp_register_style('responsive', get_template_directory_uri() . '/css/responsive.css');
    wp_enqueue_style('responsive');

}
add_action('wp_enqueue_scripts','my_enqueue_styles');


//pagination
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}
// remove 'jumping' behaviour from 'Read more' tag
function remove_more_jump_link($link) { 
    $offset = strpos($link, '#more-');
    if ($offset) {
        $end = strpos($link, '"',$offset);
    }
    if ($end) {
        $link = substr_replace($link, '', $offset, $end-$offset);
    }
    return $link;
}
add_filter('the_content_more_link', 'remove_more_jump_link');


// register widgetized areas
if(function_exists('register_sidebar')) {

    register_sidebars(1, array(
        'name' => 'widget-area%d',
        'before_widget' => '<section class="sidebar-widget">',
        'after_widget' => '</section>'
    ));
    
}

// add thumbnail support
if ( function_exists( 'add_theme_support' ) ) { 
    add_theme_support('post-thumbnails', array('post','insider_gallery'));
}

if ( function_exists( 'add_image_size' ) ) { 
    add_image_size('post-image', 610, 250, true);
    add_image_size('featured-image', 600,400); 
    add_image_size('featured-image-thumb', 70, 60, true);
}

add_action('init', 'insider_gallery_register');  

function insider_gallery_register() {
    $args = array(
        'label' => __('Insider Gallery'),
        'singular_label' => __('Insider Gallery'),
        'public' => true,
        // 'show_ui' => true,
        'hierarchical' => false,
        'rewrite' => true
       );  
    register_post_type( 'insider_gallery' , $args );
};

// cutomize previous and next post links on single pages
if ( function_exists('previous_post_link')) {
    // do to overide? core wp function code pasted below
};

/*
function previous_post_link($format='&laquo; %link', $link='%title', $in_same_cat = false, $excluded_categories = '') {
    adjacent_post_link($format, $link, $in_same_cat, $excluded_categories, true);
}*/

/* ================= */

if ( ! function_exists( 'insider_comment' ) ) :
/**
 * Template for comments.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function insider_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
    ?>
    <li class="post pingback">
        <p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <?php
                        $avatar_size = 68;
                        if ( '0' != $comment->comment_parent )
                            $avatar_size = 39;

                        echo get_avatar( $comment, $avatar_size );

                        /* translators: 1: comment author, 2: date and time */
                        printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
                            sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                            sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                                esc_url( get_comment_link( $comment->comment_ID ) ),
                                get_comment_time( 'c' ),
                                /* translators: 1: date, 2: time */
                                sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
                            )
                        );
                    ?>

                    <?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                </div><!-- .comment-author .vcard -->

                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
                    <br />
                <?php endif; ?>

            </footer>

            <div class="comment-content"><?php comment_text(); ?></div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div><!-- .reply -->
        </article><!-- #comment-## -->

    <?php
            break;
    endswitch;
}
endif; // ends check for insider_comment()

/* ================= */


?>