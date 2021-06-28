<?php get_header(); ?>
<div class="container">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h1><?php the_title(); // zobrazí nadpis ?></h1>
    <?php if(has_post_thumbnail()): // podmienka, či existuje obrázok ?>
      <a href="<?php the_permalink(); // zobrazí url adresu, kde sa nachádza obsah (detail článku/stránky) ?>">
        <img src="<?php
          echo get_the_post_thumbnail_src(get_the_post_thumbnail($post_id,'large')); // zobrazí url náhľadového obrázoku
        ?>" alt="<?php the_title(); // zobrazí nadpis ?>" width="100%">
      </a>
    <?php endif; ?>
    <?php the_content(); // zobrazí obsah ?>

  <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>