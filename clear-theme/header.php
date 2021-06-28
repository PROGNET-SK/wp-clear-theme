<!DOCTYPE html>
<html lang="<?php echo substr(get_bloginfo('language'),0,2); // jazyk stránky (prvé 2 písmená) ?>">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php wp_title( '|', true, 'right' ); // dynamické zobrazenie nadpisu ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- meta pre funkčnosť responzivity -->
<link rel="icon" href="<?php bloginfo('url'); // url stránky; ikonu je potom potrebné nahrať do koreňového adresára stránky ?>/favicon.ico">
<link href="<?php bloginfo('template_url'); // url adresára témy ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet"><!-- načítanie Bootstrap CSS knižnice, pokiaľ načítavam cez @import v style.css, môžem tento riadok vynechať -->
<link href="<?php bloginfo('stylesheet_url'); // url súboru style.css ?>" rel="stylesheet">
<!--[if lt IE 9]><link href="<?php bloginfo('template_url');  ?>/ie.min.css" rel="stylesheet"><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]--><!-- optimalizácia pre explorer -->
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script><!-- načítanie knižnce jQuery -->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/bootstrap/js/bootstrap.min.js"></script><!-- načítanie Bootstrap JS knižnice -->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/main.js"></script><!-- prípadné načítanie môjho JS, pokiaľ chcem nejaké použiť -->
<?php wp_head(); // miesto na načítanie riadov WordPressu a modulov ?>
<!-- následuje script pre zobrazenie lišty na zber cookies, čo je v EU povinné, v prípade použitia iného riešenia, možno vymazať: -->
<script src="//s3-eu-west-1.amazonaws.com/fucking-eu-cookies/cz.js" async></script>
<script>
var fucking_eu_config = {"l18n":{
"text": "Tento web používa na poskytovanie služieb, personalizáciu reklám a analýze návštevnosti súbory cookie. Používaním tohto webu s tým súhlasíte.",
"accept": "Súhlasím",
"more": "Viac informácií",
"link": "https://www.google.com/intl/sk/policies/technologies/cookies/"
}};
</script>
<!-- koniec scriptu pre zobrazenie lišty na zbet cookies -->
<!-- na toto miesto možno vložiť ďalšie kódy, ako napr. Google Analytics, Optimizelly a pod. --->
</head>
<body <?php body_class(); // zobrazenie class identifikujúcich aktuálnu stránku ?>>
<!-- na toto miesto možno vložiť ďalšie kódy, ako napr. Google Tag Manager, Facebook Pixel a pod. --->
<header>
  <div class="navbar" role="navigation">
    <div class="container">
      <div class="navbar-header col-sm-2">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Menu</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="<?php bloginfo('name'); // zobrazí názov stránky ?>" width="40" height="40"></a>
      </div>
      <div class="navbar-collapse collapse">
        <div class="row">
          <div class="col-sm-6">
            <?php
              wp_nav_menu( array(
                'theme_location' => 'primary', // nastavuje umiestnenie menu podľa nastavenia v súbore functions.php
                'items_wrap'     => '<ul class="nav navbar-nav">%3$s</ul>' // definuje triedy, ktoré majú byť v menu použité
              ) ); // zobrazí menu
            ?>
          </div>
          <div class="col-sm-4">
            <?php
              get_search_form(); // zobrazí vyhľadávanie
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<article>