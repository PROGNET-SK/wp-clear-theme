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
    <div>
      <?php
        $category = get_the_category(); // pole kategórií, v ktorom sa článok nachádza
        echo '<a href="';
        echo get_category_link($category[0]->cat_ID); // zobrazí url prvej kategórie, v ktorej sa článok nachádza
        echo '">';
        echo $category[0]->cat_name; //zobrazí názov prvej kategórie, v ktorej sa článok nachádza
        echo '</a>';
        echo ' | '; // separator;
        the_author_link(); // zobrazí menu autora článku s odkazom na zoznam článkov tohto autora
        echo ' | ';
        the_time('j. F Y'); // zobrazí dátum publikovania článku
      ?>
    </div>
    <?php the_content(); // zobrazí obsah ?>

  <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>