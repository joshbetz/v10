<?php

add_action( 'after_setup_theme', 'jb_setup' );
function jb_setup() {
  // This theme styles the visual editor with editor-style.css to match the theme style.
  add_editor_style();
  
  // This theme uses post formats
  add_theme_support( 'post-formats', array( 'link', 'image', 'video', 'audio' ) );

  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );

  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );
}

//jQuery Insert From Google
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

//fancyboxify links
add_filter('wp_get_attachment_link','fancybox_attachment_rel');
function fancybox_attachment_rel($html){
    $postid = get_the_ID();
    $html = str_replace('<a','<a rel="fancybox['.$postid.']"',$html);
    return $html;
}

/**
 *  remove_widows()
 *  filter the_title() to remove any chance of a typographic widow
 *  typographic widows
 *  @param string $title
 *  @return string $title;
 */
add_filter('the_title', 'remove_widows');
function remove_widows($title){
 
  $title_length = strlen($title);
    
  // convert the title into an array of words
  $anchor_array = explode(' ', $title);
 
  // Provided there's multiple words in the anchor text
  // then join all words (except the last two) together by a space.
  // Join the last two with an &nbsp; which is where the
  // magic happens
  if(sizeof($anchor_array) > 1){
    $last_word = array_pop($anchor_array);
    $title_new = join(' ', $anchor_array) . '&nbsp;' . $last_word;
    $title = substr_replace($title, $title_new, 0, $title_length);
  }
  return $title;
 
}

add_filter( 'wp_title', 'starkers_filter_wp_title', 10, 2 );
function starkers_filter_wp_title( $title, $separator ) {
  // Don't affect wp_title() calls in feeds.
  if ( is_feed() )
    return $title;

  // The $paged global variable contains the page number of a listing of posts.
  // The $page global variable contains the page number of a single post that is paged.
  // We'll display whichever one applies, if we're not looking at the first page.
  global $paged, $page;

  if ( is_search() ) {
    // If we're a search, let's start over:
    $title = sprintf( __( 'Search results for %s', 'starkers' ), '"' . get_search_query() . '"' );
    // Add a page number if we're on page 2 or more:
    if ( $paged >= 2 )
      $title .= " $separator " . sprintf( __( 'Page %s', 'starkers' ), $paged );
    // Add the site name to the end:
    $title .= " $separator " . get_bloginfo( 'name', 'display' );
    // We're done. Let's send the new title back to wp_title():
    return $title;
  }

  // Otherwise, let's start by adding the site name to the end:
  $title .= get_bloginfo( 'name', 'display' );

  // If we have a site description and we're on the home/front page, add the description:
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    $title .= " $separator " . $site_description;

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
    $title .= " $separator " . sprintf( __( 'Page %s', 'starkers' ), max( $paged, $page ) );

  // Return the new title to wp_title():
  return $title;
}

function v10_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
  ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?></p>
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
            printf( __( '%1$s on %2$s <span class="says">said:</span>' ),
              sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
              sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                esc_url( get_comment_link( $comment->comment_ID ) ),
                get_comment_time( 'c' ),
                /* translators: 1: date, 2: time */
                sprintf( __( '%1$s at %2$s' ), get_comment_date(), get_comment_time() )
              )
            );
          ?>

          <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
        </div><!-- .comment-author .vcard -->

        <?php if ( $comment->comment_approved == '0' ) : ?>
          <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
          <br />
        <?php endif; ?>

      </footer>

      <div class="comment-content"><?php comment_text(); ?></div>

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div><!-- .reply -->
    </article><!-- #comment-## -->

  <?php
      break;
  endswitch;
}

add_action('pre_get_posts', 'remove_twitter_cat' );
function remove_twitter_cat( )
{
  global $wp_query;

  // Figure out if we need to exclude twitter - exclude from
  // archives (except category archives), feeds, and home page
  if( is_home() || is_feed() ||
      ( is_archive() && !is_category() )) {
     $wp_query->query_vars['cat'] = '-14';
  }
}

add_filter( 'post_link', 'link_post_links' );
function link_post_links( $link ) {
  global $post;
  
  if ( is_feed() && has_post_format( 'link', $post->ID ) ) {
    return get_post_meta($post->ID, '_format_link_url', true);
  }
  
  return $link;
}

add_filter( 'the_permalink', 'link_permalinks' );
function link_permalinks( $link ) {
  global $post;
  
  if ( has_post_format( 'link', $post->ID ) ) {
    return get_post_meta($post->ID, '_format_link_url', true);
  }
  
  return $link;
}

add_filter( 'the_title', 'link_titles', 10, 2 );
function link_titles( $title, $id ) {
  if ( has_post_format( 'link', $id ) && !is_admin() ) {
    if ( is_feed() )
      return '&rarr; ' . $title;
    elseif ( is_home() || is_archive() || is_single( $id) )
      return '&rarr;&nbsp' . $title;
  }
  
  return $title;
}

/* utility */
function ago($ptime) {
    $etime = current_time('timestamp') - $ptime;
    
    if ($etime < 50) {
      return 'Just now';
    }
    
    if ($etime > 60*60*24*365)
      return get_the_date();
    
    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
                );
    
    foreach ($a as $secs => $str) {
      $d = $etime / $secs;
      if ($d >= 1) {
        $r = round($d);
        return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
      }
    }
}

?>