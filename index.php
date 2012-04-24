<?php get_header(); ?>

<div id="main" role="main">

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(get_post_format()); ?>>
    <?php if ( get_post_format() == "link" ):
      $link = get_post_meta($post->ID, '_format_link_url', true); ?>
      <h1><a href="<?php echo $link; ?>"><?php the_title(); ?></a></h1>
    <?php else: ?>
      <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
    <?php endif; ?>
    <div class="meta">
      <div class="date"><?php echo ago(get_the_time('U')); ?></div>
      <div class="category"><?php the_category(', '); ?></div>
      <div class="shortlink"><?php echo the_shortlink(substr(wp_get_shortlink(), 7)); ?></div>
      <div class="comment-count"><?php comments_number( "", "One Comment" ); ?></div>
    </div>
    <section class="entry">
      <?php the_content("Read more &rarr;")?>
    </section>
  </article>
  <hr>
  <?php endwhile; ?>

<div class="pagenav"><span class="leftnav"><?php next_posts_link('&lsaquo; Older Entries') ?></span><span class="rightnav"><?php previous_posts_link('Newer Entries &rsaquo;') ?></span></div>
<hr>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>