<!Doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-control" content="public">


    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/icons/favicon.ico" sizes="32x32">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>icons/favicon-black-transparent-80x80.png">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>icons/favicon-black-transparent-80x80.png">
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
  <!-- Navbar-->
<?php do_action('after_body'); ?>

  
 <nav class="navbar navbar-expand-md navbar-dark fixed-top" id="navigation">
    <a class="navbar-brand" href="<?php echo home_url(); ?>/"><img src="<?php echo get_template_directory_uri()?>/images/fdm-logo-2018.png" id="img" alt="FDM Logo" /></a>
    <!-- Brand and toggle get grouped for better mobile display -->




    <?php

if(!function_exists( 'is_amp_endpoint' ) || !is_amp_endpoint() ){

    ?>

<button class=" hamburger hamburger--squeeze " data-toggle="collapse" type="button" tabindex="0" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>
</button>  
<?
    /* responsive menu*/
    wp_nav_menu( array(
    'theme_location'  => 'primary',
    'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
    'container'       => 'div',
    'container_class' => 'collapse navbar-collapse',
    'container_id'      => 'navbarSupportedContent',
    'menu_class'      => 'navbar-nav mr-auto',
    //'menu_class'      => 'navbar-nav',
    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
    'walker'          => new WP_Bootstrap_Navwalker(),
    ));
    


    /* main menu */
    wp_nav_menu(array(
    'theme_location'  => 'primary',
    'container'       => 'div',
    'container_class' => 'collapse navbar-collapse justify-content-end',
    'menu_id'         => 'fdm-main-nav',
    'menu_class'      => 'navbar-nav nav-menu navbar-top',
    'depth'           => 3,
    'fallback_cb'     => 'wp_bootstrap_navwalker::fallback'

    ));

    fdm_location_selector();
}else{

    ?>

<button class=" amp-toggle hamburger hamburger--squeeze " data-toggle="collapse" type="button" on='tap:site-menu.toggle' tabindex="0" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" >
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>
</button>  
    
   <?php
}
?>
 
  </nav>
  <?php
if(function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ){
 do_action('amp_nav');
}



  ?>

