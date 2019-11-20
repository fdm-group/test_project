<section class="picture-blocks">
<div class="container-lrg">
<div class="slider_wrapper">
    <div class="slick" data-slick='{"slidesToShow":2 , "slidesToScroll": 2,  "rows": 2, "dots": true,  "speed": 200}'>
      <?php

      echo get_sub_field('fdm_block_desc');
        while(have_rows('colour_block')):
          the_row();
          $description = get_sub_field('fdm_block_desc');
          ?>
          <div class="grid-container">

          <div class="grid-item">
               <div class="text"><?php echo $description; ?></div>
          </div>

        </div>
          <?php
        endwhile;
      ?>
</div>
    </div>
  </div>
</section>
