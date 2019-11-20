<?php
 // echo '<link rel="stylesheet" type="text/css" href=" '. get_template_directory_uri() .'/includes/functions/splash.css" >';

function load_custom_wp_admin_style() {
        wp_register_style( 'custom_wp_admin_css', get_template_directory_uri() . '/css/splash.css', false, '1.0.0' );
        wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action( 'login_enqueue_scripts', 'load_custom_wp_admin_style' );

  function my_addition_to_login_footer() {
    echo '
      <div id="splash_image_container">
        hello
      </div>
    ';
  }

  function login_logo_url() { return home_url(); } //replaces logo url
  function login_logo_url_title() { return 'Fueled by Developers'; }

  add_filter( 'login_headerurl', 'login_logo_url' );
  add_filter( 'login_headertitle', 'login_logo_url_title' );
  add_action('login_footer', 'my_addition_to_login_footer');

?>
