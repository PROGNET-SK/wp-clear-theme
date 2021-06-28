<?php

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10); // prvá povinná hodnota pre použite Woocommerce
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10); // druhá povinná hodnota pre použite Woocommerce

remove_action('wp_head', 'wp_generator'); // odstráni informáciu o generátore z kódu

function theme_setup() { // registruje menu
    register_nav_menu('primary', 'Primary menu'); //prvá hodnota v zátvorke je slug pre menu, druhá jeho viditeľné pomenovanie v administrácií
}

add_action('after_setup_theme', 'theme_setup');

add_theme_support('post-thumbnails'); // umožnuje pridávať obrázky k článkom

function theme_widgets_init() { // registruje plochy pre Widgety
    register_sidebar(array(// prvá plocha Widgetov
        'name' => 'Názov plochy Widgetov', // povinné pole
        'id' => 'sidebar', // univerzálny identifikátor, povinné pole
        'description' => 'Popis widgetu',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">', // možnosť vloženia elementu, jeho tried a identifikátorov pre jednotlivé Widgety
        'after_widget' => '</aside>', // koniec jednotlivého Widgetu
        'before_title' => '<h3 class="widget-title">', // možnosť vloženia elementu, jeho tried a identifikátorov pre jednotlivé nadpisy Widgetov
        'after_title' => '</h3>', // koniec jednotlivých nadpisov Widgetov
    ));
    register_sidebar(array(// ďalšia plocha Widgetov
        'name' => 'Názov plochy Widgetov',
        'id' => 'sidebar2',
        'description' => 'Popis widgetu',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'theme_widgets_init');

function theme_wp_title($title, $sep) { // upravuje funkciu wp_title(), aby bola SEO friendly
    global $paged, $page;
    if (is_feed())
        return $title;
    $title .= get_bloginfo('name', 'display');
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && ( is_home() || is_front_page() ))
        $title = "$title $sep $site_description";
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf('Strana %s', max($paged, $page)); // stačí upraviť iba hodnotu "Strana", pokiaľ má byť stránke pre iný jazyk
    return $title;
}

add_filter('wp_title', 'theme_wp_title', 10, 2);

function get_the_post_thumbnail_src($img) { // vráti url adresu prezentačného obrázku
    return ( preg_match('~\bsrc="([^"]++)"~', $img, $matches) ) ? $matches[1] : '';
}

// Woocommerce:

$show_in_nav_menus = apply_filters('woocommerce_attribute_show_in_nav_menus', false, $name="");

add_filter('woocommerce_attribute_show_in_nav_menus', 'wc_reg_for_menus', 1, 2);

function wc_reg_for_menus($register, $name = '') {
    if ($name == 'pa_types')
        $register = true;
    if ($name == 'pa_special-sales')
        $register = true;
    return $register;
}


function create_function(){
    /*iba na test*/
    return true;
}


add_filter('loop_shop_per_page', create_function('$cols', 'return 8;'), 20);

add_filter('woocommerce_variable_sale_price_html', 'wc_wc20_variation_price_format', 10, 2);
add_filter('woocommerce_variable_price_html', 'wc_wc20_variation_price_format', 10, 2);

function wc_wc20_variation_price_format($price, $product) {
    $prices = array($product->get_variation_price('min', true), $product->get_variation_price('max', true));
    $price = $prices[0] !== $prices[1] ? sprintf(__('From: %1$s', 'woocommerce'), wc_price($prices[0])) : wc_price($prices[0]);
    $prices = array($product->get_variation_regular_price('min', true), $product->get_variation_regular_price('max', true));
    sort($prices);
    $saleprice = $prices[0] !== $prices[1] ? sprintf(__('From: %1$s', 'woocommerce'), wc_price($prices[0])) : wc_price($prices[0]);

    if ($price !== $saleprice) {
        $price = '<del>' . $saleprice . '</del> <ins>' . $price . '</ins>';
    }
    return $price;
}

add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start() {
    echo '<section id="main">';
}

function my_theme_wrapper_end() {
    echo '</section>';
}

add_theme_support('woocommerce');
?>