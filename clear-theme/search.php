<?php get_header(); ?>
<div class="container">
  <h1>Výsledky vyhľadávania pre: <?php echo get_search_query(); ?></h1>

  <?php if(have_posts()):while(have_posts()):the_post() ;?>
    <div><!-- jeden článok -->
      <header>
        <?php if(has_post_thumbnail()): // podmienka, či existuje obrázok ?>
          <a href="<?php the_permalink(); // zobrazí url adresu, kde sa nachádza obsah (detail článku/stránky) ?>">
            <img src="<?php
              echo get_the_post_thumbnail_src(get_the_post_thumbnail($post_id,'large')); // zobrazí url náhľadového obrázoku
            ?>" alt="<?php the_title(); // zobrazí nadpis ?>" width="100%">
          </a>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>">
          <h1><?php the_title(); ?></h1>
        </a>
        <div>
          <?php
            $category = get_the_category(); // pole kategórií, v ktorom sa článok nachádza
            echo '<a href="';
            echo get_category_link($category[0]->cat_ID); // zobrazí url prvej kategórie, v ktorej sa článok nachádza
            echo '">';
            echo $category[0]->cat_name; //zobrazí názov prvej kategórie, v ktorej sa článok nachádza
            echo '</a>';
            echo ' | '; // separator;
            the_author(); // zobrazí menu autora článku s odkazom na zoznam článkov tohto autora
            echo ' | ';
            the_time('j. F Y'); // zobrazí dátum publikovania článku
          ?>
        </div>
      </header>
      <article>
        <?php the_excerpt(); // zobrazí zhrnutie alebo prvých 55 slov z obsahu (bez formátovania a obrázkov) ?>
      </article>
    </div>
  <?php endwhile; ?>
  <?php
    global $wp_query;
    $big = 999999999;
    $pages = paginate_links( array(
      'base' => str_replace( $big,'%#%',esc_url(get_pagenum_link($big))),
      'format' => '?paged=%#%',
      'current' => max( 1, get_query_var('paged')),
      'total' => $wp_query->max_num_pages,
      'before_page_number' => '<span class="sr-only">Strana </span>',
      'prev_text' => 'Novšie',
      'next_text' => 'Staršie',
      'type' => 'array'
    ));
    if( is_array( $pages ) ) {
      $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
      echo '<nav class="text-center"><ul class="pagination">';
      foreach ( $pages as $page ) {
        echo "<li>$page</li>";
      }
      echo '</ul></nav>';
    }
  ?>
  <?php else: ?>
  <h2>Je nám ľúto, nič sa nenašlo.</h2>
  <p>
    <a href="<?php
      bloginfo('url'); // zobrazí url stránky
    ?>">Prejsť na domovskú stránku</a> alebo použiť vyhľadávanie s inou frázou:
  </p>
  <?php
    get_search_form(); // zobrazí vyhľadávanie
  ?>
  <?php endif; ?>
</div>
<?php get_footer(); ?>