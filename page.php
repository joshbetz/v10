<?php get_header(); ?>

<div id="main" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <h1><?php the_title(); ?></h1>
    <section class="entry">
      <?php the_content()?>
    </section>
  </article>
<?php endwhile; endif; ?>

  <hr>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
