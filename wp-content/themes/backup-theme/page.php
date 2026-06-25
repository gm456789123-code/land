<?php
/**
 * Generic page template — fallback for all pages without a specific template
 */
get_header();
?>

<div class="max-w-4xl mx-auto px-4 lg:px-8 py-12">
  <?php while ( have_posts() ) : the_post(); ?>
    <h1 class="text-3xl font-extrabold mb-6" style="color:#13357a;"><?php the_title(); ?></h1>
    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
      <?php the_content(); ?>
    </div>
  <?php endwhile; ?>
</div>

<?php get_footer(); ?>
