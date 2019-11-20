<?php
?>

<section class="white-blocks" style="padding-top: 100px;">


<div class="container-lrg">
<?php

$title = get_sub_field('fdm_client_module');
$text = get_sub_field('fdm_client_text');
$course_title = get_sub_field('course_title');
echo "<div class='center'><div class='deco-line-center'></div></div>";
echo $text;


// check if the repeater field has rows of data
if( have_rows('fdm_client_module') ):
?>
<div class="client">
  <ul class="client-list">
    <?php
     	// loop through the rows of data
        while ( have_rows('fdm_client_module') ) : the_row();

        ?>
    	     <li><a href="<?php the_sub_field('course_link'); ?>"><?php the_sub_field('course_title'); ?></a></li>

        <?php

        endwhile;

        ?>
      <?php
else :

    // no rows found

endif;



?>
</ul>
</div>
  </div>
</section>
