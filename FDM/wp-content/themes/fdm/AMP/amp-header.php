<!doctype html>
<html class="no-js" <?php language_attributes(); ?>⚡>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Cache-control" content="public">
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/icons/fav/<?php echo $favicon; ?>-favicon.ico" sizes="32x32">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>icons/favicon-black-transparent-80x80.png">
    <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>icons/favicon-black-transparent-80x80.png">
    <style amp-custom>
      <?php readfile(getcwd(). '/CSS/amp_style.css'); ?>
    </style>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script>
      script type="application/ld+json">
        {
          "@context": "http://schema.org",
          "@type": "NewsArticle",
          "headline": "Open-source framework for publishing content",
          "datePublished": "2015-10-07T12:02:41Z",
          "image": [
            "logo.jpg"
          ]
        }
      </script>

    <?php wp_head(); ?>
    <!-- AMP boilerplate code-->
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <noscript>
	     <style amp-boilerplate>
          body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}
       </style>
    </noscript>
</head>
<body <?php body_class(); ?>>
  <!-- Navbar-->
 <nav class="navbar navbar-expand-md navbar-dark fixed-top" id="navigation">
    <a class="navbar-brand" href="<?php echo home_url(); ?>/">
      <amp-img src="<?php echo get_template_directory_uri()?>/IMAGES/icon.png" id="img"
          alt="Crashed plane vintage photo" width="140" height="60"></amp-img>
    </a>

    <!-- Brand and toggle get grouped for better mobile display -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <?php

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
     ?>

  </nav>
