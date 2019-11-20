<?php
// Register Nav Walker class
require_once('class-wp-bootstrap-navwalker.php');
include( __DIR__ . '/includes/tracking.php' );

// Add our language files (must come first)
add_action( 'after_setup_theme', function() {
    load_theme_textdomain( 'fdm', get_stylesheet_directory() . '/lang' );
}, 1 );

function fdm_initial_build () {
  register_nav_menus( array(
    //
    'primary' => __('primary'),
    'secondary' => __('Footer Navigation'),
  ));

  add_theme_support( 'post-thumbnails' );
  add_image_size( 'blog-listing', 740, 370, true );
}
add_action( 'after_setup_theme', 'fdm_initial_build' );



//load more posts
add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');



function load_posts_by_ajax_callback() {

  // check_ajax_referer('load_more_posts', 'security');
  //  $paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;

    //$paged = 1;
   $paged = $_POST['page'];

    $cat = $_POST['category'];
    $region = $_POST['region'];

    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '3',
        'orderby' => 'publish_date',
        'cat' => $cat,
        'paged' => $paged,
        'meta_key' => 'fdm_region',
        'meta_value' => $region
    );
  //  echo $cat ."<br />".$region;
  //echo $paged;
    global $q;

    $q = new WP_Query( $args );

    if ($q->have_posts() ):


        //echo "<script>$('.loadmore').show();</script>";
      //  echo $q->max_num_pages;
      ob_start(); // start buffering because we do not need to print the posts now
        ?>

        <div class="row blog">
          <?php



          ?>
        <?php while ( $q->have_posts() ) : $q->the_post() ?>
          <?php

          $total_no_pages = $q->max_num_pages;


         ?>
          <div class='col-md-4'>
            <div class="fdm-post-teaser">
              <a class="fdm-post-teaser-inner" href="<?= get_permalink() ?>">
              <div class="teaser-text">
                <?php
                $categories = get_categories();
                 $categories = get_the_category(); $first_category = array_shift( $categories ); if ( $first_category ) { ?>
                  <strong><span name="category"><?= $first_category->name ?></span></strong>
                <?php }
                ?>
                <h3 name="post-title"><?= get_the_title() ?></h3>
                <span name="author"><i class="fas fa-user"></i> <?= get_field('author') ?></span>
                <time name="updated" datetime="<?= get_the_date( 'Y-m-d H:i:s' ) ?>"><i class="material-icons">access_time</i> <?= get_the_date() ?></time>
              </div>
              <?php $image1 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-listing');
              ?>
            <div class="teaser-image" style="background: url(<?php echo $image1[0];?>);background-position:center;background-repeat:no-repeat;background-size:cover;">
              </div>
            </a>
          </div>
            </div>

        <?php endwhile; ?>

        </div>
        <?php
    $posts_html = ob_get_contents(); // we pass the posts to variable
      ob_end_clean(); // clear the buffer

else:
    $posts_html = '<p>Nothing found for your criteria.</p>';
  endif;


echo json_encode( array(
    'posts' => json_encode( $q->query_vars ),
    'max_page' => $q->max_num_pages,
    'found_posts' => $q->found_posts,
    'content' => $posts_html
  ) );

    die();
}
?>
<?php
// FDM Board
if(function_exists('acf_add_options_page')){

  acf_add_options_page(array(
    'page_title' => 'FDM Board',
    'capability' => 'edit_posts'
  ));

}
// Scripts & Styles
function fdm_enqueues () {
  global $wp_styles;
  global $post;
  global $q;
  // Main CSS
  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', '', null );
  wp_enqueue_style( 'slickcss', get_template_directory_uri() . '/css/slick.css', '', null );
  wp_enqueue_style( 'fontawesomecss', get_template_directory_uri() . '/css/fontawesome.css', '', null );
    wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', '', null );
    wp_enqueue_style('googlefonts','https://fonts.googleapis.com/css?family=Open+Sans%3A300%2C400%2C700%2C800&#038;subset=latin&#038;ver=4.8.7','',null);

  //javascript files

  wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', '', null, true );
  wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.min.js', '', null, true );
  wp_enqueue_script( 'bootstrapJS', get_template_directory_uri() . '/js/bootstrap.min.js', '', null, true );
  wp_enqueue_script( 'slickJS', get_template_directory_uri() . '/js/slick.min.js', '', null, true );
  wp_enqueue_script( 'fdmTheme', get_template_directory_uri() . '/js/fdm-theme.js', '', null, true );
   wp_enqueue_script( 'lazy', get_template_directory_uri() . '/js/lazy.js', '', null, true );
  wp_enqueue_script( 'fdmNavbar', get_template_directory_uri() . '/js/navigation.js', '', null, true );
  wp_enqueue_script( 'fontawesome', get_template_directory_uri() . '/js/all.js', '', null, true );
  wp_enqueue_script( 'contact', get_template_directory_uri() . '/js/contact-form.js', '', null, true );
  wp_enqueue_script( 'clients', get_template_directory_uri() . '/js/client-carousel.js', '', null, true );





  global $q;
  wp_localize_script( 'fdmTheme', 'afp_vars', array(
      'afp_ajax_url' => admin_url( 'admin-ajax.php' ),
      'siteurl' => get_option('siteurl')
    ));
}
add_action( 'wp_enqueue_scripts', 'fdm_enqueues' );


// Splash/Login Screen Setup
include 'includes/functions/splash.php';

// Async function via #asyncload
require ('includes/functions/asyncLoad.php');


// Disable a whole bunch of default WP stuff
require ('includes/functions/disableStuff.php');




// Register ACF Content blocks
require ('includes/functions/map.php');

$countries = [
      [ 'acf_post' => 'fdm_people', 'name' => 'United Kingdom', 'lang_code' => 'en', 't_name' => __( 'United Kingdom', 'fdm' ) ],
      [ 'acf_post' => 'fdm_people_can', 'name' => 'Canada', 'lang_code' => 'en-ca', 't_name' => __( 'Canada', 'fdm' ) ],
      [ 'acf_post' => 'fdm_people_us', 'name' => 'United States of America', 'lang_code' => 'en-us', 't_name' => __( 'United States of America', 'fdm' ) ],
      [ 'acf_post' => 'fdm_people_germany', 'name' => 'Germany', 'lang_code' => 'de', 't_name' => __( 'Germany', 'fdm' ) ],
      [ 'acf_post' => 'fdm_people_china', 'name' => 'China', 'lang_code' => 'cn', 't_name' => __( 'China', 'fdm' ) ],
      [ 'acf_post' => 'fdm_people_singapore', 'name' => 'Singapore', 'lang_code' => 'en-sg', 't_name' => __( 'Singapore', 'fdm' ) ],
      [ 'acf_post' => 'fdm_people_hk', 'name' => 'Hong Kong', 'lang_code' => 'en-hk', 't_name' => __( 'Hong Kong', 'fdm' ) ],
      [ 'acf_post' => 'fdm_people_au', 'name' => 'Australia', 'lang_code' => 'en-au', 't_name' => __( 'Australia', 'fdm' ) ],

    ];



    $pathways = [
      'Ex-Forces' => __( 'Ex-Forces', 'fdm' ),
      'Internal staff' => __( 'Internal staff', 'fdm' ),
      'Graduates' => __( 'Graduates', 'fdm' ),
      'Getting Back to Business' => __( 'Getting Back to Business', 'fdm' ),
    ];

    $roles = [
      'Consultant' => __( 'Consultant', 'fdm' ),
      'Sales & Business Development' => __( 'Sales & Business Development', 'fdm' ),
      'Recruitment' => __( 'Recruitment', 'fdm' ),
      'Marketing' => __( 'Marketing', 'fdm' ),
      'HR & Consultant Support' => __( 'HR & Consultant Support', 'fdm' ),
      'Academy & Training' => __( 'Academy & Training', 'fdm' ),
      'Diversity, Inclusion & Initiatives' => __( 'Diversity, Inclusion & Initiatives', 'fdm' ),
      'Finance' => __( 'Finance', 'fdm' ),
      'Operations' => __( 'Operations', 'fdm' ),
    ];

if ( function_exists( 'acf_add_options_page' ) ) {

      $parent = acf_add_options_page( [
        'page_title' => 'FDM People',
        'capability' => 'manage_options',
        'menu_slug' => 'acf-options-people',
      ] );

      foreach($countries as $country){
        acf_add_options_sub_page( [
          'page_title' => 'People - ' . $country['name'],
          'capability' => 'manage_options',
          'post_id' => $country['acf_post'],
          'menu_slug' => 'acf-options-fdm-people-' . $country['lang_code'],
          'parent_slug' => 'acf-options-people',
        ]);
      }

    }



add_action( 'acf/save_post', function( $post_id ) {
      if ( strpos( $post_id, 'fdm_people' ) === 0 ) {
        $update_people_data_cache();
      }
    }, 20);
// Collect the information for the people and serialize in a single value in the database options table
  function update_people_data_cache() {
    error_log("Updating FDM people data cache");

    $people = [];
    if ( function_exists( 'get_field' ) ) {
      foreach( $countries as $country ) {

        $country_people = get_field( 'fdm_people', $country['acf_post'] ) ?: [];
        foreach( $country_people as $person ){
          $person['country'] = $country['name'];
          $person['lang_code'] = $country['lang_code'];
          $person['slug'] = sanitize_title_with_dashes( $person['name'] ) . ( $country['lang_code']=='cn' ? '-cn' : '' ); // some people are duplicated in Chinese, so add suffix to make slugs unique
          $people[] = $person;
        }
      }
    }

    delete_option( 'fdm_people_cache' );
    add_option( 'fdm_people_cache', json_encode( $people ) , '', 'no' );
    return $people;
  }

  // Get the people data from the database (caching if not already cached)
   function get_people_data() {
    $json = get_option( 'fdm_people_cache', false );
    if ( $json ) {
      return json_decode( $json, true );
    } else {
      return update_people_data_cache();
    }
  }

  //navigation Board
  // We need to resolve a conflict here between Ubermenu and Polylang
// Both of them try to 'take over' the menus, so we create a new shortcode which will merge the functionality of both
add_shortcode( 'fdm-main-nav', function() {

	ob_start();

	// Attempt to get a translated menu
	// NOTE: the 'us' in 'us_main_menu' doesn't refer to the United States or anything to do with languages
	// Actually it seems like the Zephyr theme uses 'us' as a prefix for all of their variables, methods etc
	// 'us_main_menu' is the name registered in Zephyr for the primary nav menu
	$menu_id = hodes_get_translated_menu_id( 'us_main_menu' );

	if ( $menu_id ) {
		// If we successfully got a translated menu id, we'll feed it to Ubermenu for the rendering
		//ubermenu( 'main', [ 'menu_id' => 'fdm-main-nav', 'menu' => $menu_id ] );

 			wp_nav_menu(array(
 				'menu' 				=> $menu_id,
                'theme_location'    => 'header-top-logged',
                'container'       => 'div',
                'container_id'    => '',
                'container_class' => 'collapse navbar-collapse justify-content-end',
                'menu_id'         => 'fdm-main-nav',
                'menu_class'      => 'navbar-nav nav-menu navbar-top ',
                'depth'           => 3,
                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback'
                ));

	} else {
		// Otherwise use default
		//ubermenu( 'main', [ 'menu_id' => 'fdm-main-nav', 'theme_location' => 'us_main_menu' ] );
	}

	return ob_get_clean();

} );



add_shortcode( 'fdm-footer-nav', function() {

	ob_start();
	wp_nav_menu( ['theme_location'=>'footer'] );
	return ob_get_clean();

} );


// Function to output a standard button with the blue transition
function fdm_output_button( $link, $label, $invert = false, $icon="", $class="sweep-to-right") { ?>

  <a href="<?php echo htmlspecialchars( $link ) ?>" class="<?= $class; ?>  <?= $invert ? 'white' : 'black' ?> " >
   <?= $label ?>
   <?php if($icon!=''){
    echo "<i class='".$icon."' ></i>";
   }
   ?>
  </a>
  <?php
}

add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
function my_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="video-wrapper">' . $html . '</div>';
}

function quoteblock(){

  echo "<div class='testimonialBox' >\"".get_sub_field('quote')."\"
  <div class='quotefrom'>".get_sub_field('from')."</div></div>";
}

function htmlblock(){

 echo get_sub_field('htmlcontent');

}
function iconblock(){
  if(have_rows('item')):
    ?>
    <div class="icon_grid">
    <?php
    while(have_rows('item')):
          the_row();
          echo "<div class='icon_img'><img src='".get_sub_field('image')."'/></div>";
          echo "<div class='icon_text'>".get_sub_field('text')."</div>";
    endwhile;
    ?>
  </div>
  <?php
  endif;

}

function buttonblock(){

        echo "<a href='".get_sub_field('btn_link')."'  class='sweep-to-right black' >".get_sub_field('btn_text')."</a>";
}


function showslider(){
?>
<div class="slider_wrapper">
    <div class="slick" data-slick='{"slidesToShow": <?php the_sub_field('number_of_blocks'); ?>, "slidesToScroll": <?php the_sub_field('number_of_blocks'); ?>}'>
      <?php


        while(have_rows('blocks')):
          the_row();
          $i++;
      ?>
      <div class="grey-block">
        <?php
          if(get_sub_field('icon')):

        ?>
        <img class="car-img" src="<?php echo get_sub_field('icon')?>" alt="<?php echo get_sub_field('text');?>"/>
        <?php
        endif;
        echo "<p>".get_sub_field('text')."</p>";


        ?>
      </div><!-- id career-block-->



      <?php
        endwhile;

      ?>
</div>

    </div>
    <?php }



function showoverlayslider(){
?>
<div class="slider_wrapper">
    <div class="slick" data-slick='{"slidesToShow": <?php the_sub_field('number_of_blocks'); ?>, "slidesToScroll": <?php the_sub_field('number_of_blocks'); ?>, "dots":false }'>
          <?php


        while(have_rows('blocks')):
          the_row();
          $i++;
      ?>
          <div class="people-cell">
                  <div class="hp-caption">
                    <div class="hp-caption-overlay">
                      <div class="hp-caption-overlay-content">
                        <?php echo get_sub_field('text');?>
                      </div>
                    </div>
                    <img src="<?php echo get_sub_field('icon')?>"/>
                  </div>
           </div>

      <?php
        endwhile;

      ?>
  </div>

</div>
    <?php }


add_filter( 'mce_buttons', 'myplugin_register_buttons' );

function myplugin_register_buttons( $buttons ) {
   array_push( $buttons, 'separator', 'myplugin' );
   return $buttons;
}


function tiny_mce_add_buttons( $plugins ) {
  $plugins['mytinymceplugin'] = get_template_directory_uri() . '/js/tiny-mce.js';
  return $plugins;
}

function tiny_mce_register_buttons( $buttons ) {
  $newBtns = array(
    'myblockquotebtn'
  );
  $buttons = array_merge( $buttons, $newBtns );
  return $buttons;
}

add_action( 'init', 'tiny_mce_new_buttons' );

function tiny_mce_new_buttons() {
  add_filter( 'mce_external_plugins', 'tiny_mce_add_buttons' );
  add_filter( 'mce_buttons', 'tiny_mce_register_buttons' );
}



function output_meta_tags() {
    $meta_title = ($post_title = get_the_title()) ? $post_title : get_bloginfo();
    $meta_description = '';

    if( is_singular() ) {
      $post_id = get_the_ID();
      $meta_title = ($custom_title = get_field( 'fdm_meta_title', $post_id )) ? $custom_title : $meta_title;

      $meta_description = get_field( 'fdm_meta_desc', $post_id );
      if( empty($meta_description) ) {
        $this_post = get_post( $post_id );
        $meta_description = wp_trim_words( strip_shortcodes( $this_post->post_content ), 20 );
      }
    }

    echo "<title>$meta_title</title>";
    echo '<meta name="description" content="'.$meta_description.'">';
  }

  add_action( 'wp_head', function() {
    output_meta_tags();
  }, 5 );



if (  function_exists( 'pll_current_language' ) && function_exists( 'get_field' ) ) {

     // if either plugin isn't installed the functions will be missing, so we need to exit early to avoid crashing the site
    $plugin_functions = [ 'acf_add_options_page', 'acf_add_options_sub_page', 'pll_languages_list', 'pll_languages_list' ];
    foreach( $plugin_functions as $fn ) {
      if ( ! function_exists( $fn ) ) {
        $setupinvestors = false;
      }
    }


    // get array of all languages in form slug => name
      $langs = array_combine( pll_languages_list( ['fields'=>'slug'] ),  pll_languages_list( ['fields'=>'name'] ) );

      $parent = acf_add_options_page( [
        'page_title' => 'FDM Investors Header',
        'capability' => 'manage_options',
        'menu_slug' => 'acf-fdm-investors-header',
      ] );

      foreach ($langs as $slug => $name ) {
        acf_add_options_sub_page( [
          'page_title' => 'Investors Header - ' . $name,
          'capability' => 'manage_options',
          'post_id' => 'fdm-investors-header-' . $slug,
          'menu_slug' => 'acf-fdm-investors-header-' . $slug,
          'parent_slug' => 'acf-fdm-investors-header',
        ]);
      }


      $parent = acf_add_options_page( [
        'page_title' => 'FDM Reports',
        'capability' => 'manage_options',
        'menu_slug' => 'acf-options-fdm-reports',
      ] );

}

  function minishareprice() {


    ?>
    <iframe class="mini-share-price" width="100%" height="230px" src="https://irs.tools.investis.com/Clients/uk/fdmgroup/Minichart/Default.aspx?culture=en-GB"></iframe>
    <?php


  }


/**
 * Render the Primary Nav Menu
 *
 * Uses amp-sidebar to handle
 * slideout animation.
 *
 * Be sure to include the amp-sidebar component script.
 * Also, rememeber that the amp-sidebar element must be 
 * a direct child of the <body>.
 *
 * @action {your custom template action}
 */
function xwp_render_primary_nav() {

?>
  <amp-sidebar id="site-menu" layout="nodisplay">
    <?php
    wp_nav_menu(array(
    'theme_location'  => 'primary',
    'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
    'container'       => 'div',
    'container_class' => '',
    'container_id'      => '',
    'menu_class'      => 'navbar-nav mr-auto',
    ));
    ?>

  </amp-sidebar>
  
  <?php
}
add_action( 'amp_nav', 'xwp_render_primary_nav' );




function fdm_location_selector() {
if(function_exists('pll_current_language') ) {
  $langs = pll_the_languages( [ 'raw' => true ] );
  $current_lang = array_filter( $langs, function( $lang ) { return $lang['current_lang']; } );
  $current_lang = array_pop( $current_lang );

  ?>
  <div id="fdm-location-selector">
    <div class="fdm-location-selector-toggle"><a href="#"><img src="<?= $current_lang['flag'] ?>" /></a></div>
    <ul class="fdm-location-selector-list" style="display:none;">
      <?php foreach( $langs as $lang ) { ?>
        <li><a href="<?= $lang['url'] ?>" class="<?= $lang['current_lang'] ? 'current' : '' ?>"><img src="<?= $lang['flag'] ?>" /> <?= $lang['name'] ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <script>jQuery(function($){
    $('#fdm-location-selector').each(function(){
      var $toggle = $('.fdm-location-selector-toggle', this);
      var $list = $('.fdm-location-selector-list', this);
      var showList = function() {
        $list.slideDown();
        $(document.body).on('click', hideList);
      };

      var hideList = function() {
        $list.slideUp();
        $(document.body).off('click', hideList);
      };

      $toggle.on('click', function(){
        if ( $list.is(':visible') ) {
          hideList();
        } else {
          showList();
        }
        return false;
      });
    })
  });</script>
  <?php
}
} 

function get_translated_post_id( $post_id, $lang = null ) {
  // Get the translated post (as long as Polylang is installed)
  $translated_post_id = false;
  if ( function_exists('pll_get_post') && function_exists('pll_current_language') ) {
    // if $lang is not set, assume current language
    $translated_post_id = pll_get_post( $post_id, $lang ? : pll_current_language() );
  }
  // Return the translated post id
  // Fall back to theuntranslated post if the post isn't translated
  return $translated_post_id ? $translated_post_id : $post_id;
}