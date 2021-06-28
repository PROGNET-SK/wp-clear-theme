<?php get_header(); ?>
<div class="container">
  <h1>Je nám ľúto, táto stránka neexistuje.</h1>
  <p>
    <a href="<?php
      bloginfo('url'); // zobrazí url stránky
    ?>">Prejsť na domovskú stránku</a> alebo použiť vyhľadávanie:
  </p>
  <?php
    get_search_form(); // zobrazí vyhľadávanie
  ?>
</div>
<?php get_footer(); ?>