<?php get_header(); ?>

<div id="main" role="main">
<h1>Portfolio</h1>

<?php
  $categories = get_categories(array('taxonomy' => 'format'));
  
  foreach($categories as $category):
  $cat_name = $category->name;

  global $wp_query;
  $args = array_merge( $wp_query->query, array( 'posts_per_page' => -1, 'meta_key' => '_thumbnail_id', 'format' => $cat_name ) );
  query_posts( $args );
?>

<?php if (have_posts()): ?>
  
<section class="<?php echo $cat_name; ?>">
  <h2><?php echo $cat_name; ?></h2>
  <?php while (have_posts()) : the_post(get_post_format()); ?>
  <article id="post-<?php the_ID(); ?>" <?php post_class( get_post_format() ); ?>>
    <h3><?php the_title(); ?></h3>
    <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
  </article>
  <?php endwhile; ?>
      
</section>

<?php endif; endforeach; ?>

<hr>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
