<?php get_header(); ?>

<!-- Template in use: page.php -->

<div id="main" role="main">


<?php


// check if the flexible content field has rows of data
if( have_rows('sections') ):

  // loop through the rows of data
  while ( have_rows('sections') ) : the_row();

    // check current row get_row_layout
    $file = dirname(__FILE__) ."/includes/acf/".get_row_layout().".php";
    if(file_exists($file)){
        include $file;
    }
endwhile;

endif;

?>
<p>Amp Page </p>

</div>

<?php get_footer(); ?>
