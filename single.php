<?php get_header(); ?>

<div id="main" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(get_post_format()); ?>>
    <?php if ( get_post_format() == "link" ):
      $link = get_post_meta($post->ID, '_format_link_url', true); ?>
      <h1><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h1>
    <?php else: ?>
      <h1><?php the_title(); ?></h1>
    <?php endif; ?>
    <div class="meta">
      <div class="date"><?php echo ago(get_the_time('U')); ?></div>
      <div class="category"><?php the_category(', '); ?></div>
      <div class="shortlink"><?php echo the_shortlink(substr(wp_get_shortlink(), 7)); ?></div>
      <div class="comment-count"><?php comments_number( "No Comments", "One Comment" ); ?></div>
    </div>
    <section class="entry">
      <?php the_content(); ?>
    </section>    
  </article>
<?php endwhile; endif; ?>

  <hr>

  <div class="pagenav"><span class="leftnav"><?php previous_post_link('&lsaquo; %link') ?></span><span class="rightnav"><?php next_post_link('%link &rsaquo;') ?></span></div>

  <?php
    if(!is_preview())
      comments_template(); ?>
        
  <hr>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
