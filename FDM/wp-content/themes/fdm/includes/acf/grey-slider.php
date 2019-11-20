
<section class="grey-slider">


<div class="container-lrg">

  <h2><?php the_sub_field('title'); ?></h2>

<div class="slider_wrapper">
    <div class="slick" data-slick='{"slidesToShow": <?php the_sub_field('number_of_blocks'); ?>, "slidesToScroll": <?php the_sub_field('number_of_blocks'); ?>, "row": 2}'>
      <?php


        while(have_rows('blocks')):
          the_row();
          $i++;
      ?>
      <div class="grey-block">
        <?php
          if(!get_sub_field('icon')):
            echo "<h3>".get_sub_field('fdm_car_title'). "</h3>";
          else:
        ?>
        <img class="car-img" src="<?php echo get_sub_field('icon')?>" alt="<?php echo get_sub_field('fdm_car_title');?>" width="200" height="200">
        <?php
        endif;
        echo "<p>".get_sub_field('fdm_car_desc')."</p>";

        if(get_sub_field('fdm_car_btn_on_off') == "on"):
          echo "<a href='".get_sub_field('fdm_car_btn_link')."' class='sweep-to-right' >".get_sub_field('fdm_car_btn')."</a>";
        endif;
        ?>
      </div><!-- id career-block-->



      <?php
        endwhile;

      ?>
</div>
    </div>
  </div>

</section>
