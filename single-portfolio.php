<?php get_header(); ?>

<div id="main" role="main">

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1><?php the_title(); ?></a></h1>
    <div class="meta">
      <?php if( $projecturl = get_post_meta($post->ID, 'url', true) ): ?>
        <a class="projecturl" href="<?php echo $projecturl; ?>">View Live Site</a>
      <?php endif; ?>
    </div>
    <section class="entry">
      <?php the_content("Read more &rarr;")?>
      <?php the_post_thumbnail( 'large' ); ?>
    </section>
  </article>
  
  <section id="related">
    <h2>Related Images</h2>
    <?php
      $images =& get_children( array("post_type" => "attachment", "post_mime_type" => "image", "post_parent" => $post->ID));
    
      if( count( $images ) <= 1 ) {
        echo "<p>No related images</p>";
      } else {
        echo "<span style='display:none'>";
        the_attachment_link( get_post_thumbnail_id($post->ID) );
        echo "</span>";
        foreach( $images as $attachment_id => $attachment ) {
          if( $attachment_id != get_post_thumbnail_id() )
            the_attachment_link( $attachment_id );
        }
      }
    ?>
  </section>
  

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
