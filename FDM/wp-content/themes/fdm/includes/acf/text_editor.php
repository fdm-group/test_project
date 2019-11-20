
<div class="container">
  <div class="row" style="padding-top: 150px;">
<?php

  if(have_rows('fdm_text_editor')):
    while(have_rows('fdm_text_editor')):
      the_row();

        $options = get_sub_field("fdm_text_options");

        if( $options && in_array('text', $options) ):
          echo get_sub_field("fdm_text");
        endif;

        if( $options && in_array('testimonial', $options) ):
          echo "<p>". get_sub_field("fdm_testimonial")."</p>";
          echo "<hr>";
        endif;

        echo "<p><a href='".get_sub_field('fdm_button')."'>".get_sub_field('fdm_button_text')."</a></p>";
    endwhile;
  endif;
 ?>
</div>
</div>
