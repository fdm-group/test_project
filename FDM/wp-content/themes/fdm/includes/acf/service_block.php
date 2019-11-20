<section class="picture-blocks">
  <div class="container-sml">

      <h2><?php the_sub_field('title'); ?></h2>
  <div class="slick" data-slick='{"slidesToShow":  <?php the_sub_field('number_of_blocks_to_show'); ?>, "slidesToScroll": <?php the_sub_field('number_of_blocks_to_show'); ?>}'>

    <?php
    $i=0;
    while(have_rows('fdm_services')):

      the_row();
      $i++;
      $fdm_src_bg = get_sub_field('fdm_src_bg');
      $background_image = get_sub_field('fdm_src_bg_img');
      $backcolor = get_sub_field('fdm_src_bg_colour');
   //   $slider_option = get_sub_field('slider_option');
   // if($slider_option == true){
    ?>

 <div class="service-grid">

      <div class="picture-block <?php if($fdm_src_bg=='colour'){ echo $backcolor; } ?> " <?php if($fdm_src_bg=='image'){ echo 'style="background-image:url(' . $background_image['url'] . ')"'; } ?> >
          <div class="hp-caption">
                  <div class="hp-caption-overlay">
                    <div class="hp-caption-overlay-content">
      <?php

        echo "<div class='hs-caption-overlay-title'>".get_sub_field('fdm_src_title')."<div class='deco-line'></div></div>";
        echo "<div class='hs-caption-overlay-content'><p>".get_sub_field('fdm_src_desc')."</p>";
        echo "<a href='".get_sub_field('fdm_src_btn_link')."' class='sweep-to-right white' >".get_sub_field('fdm_src_btn')."</a></div>";
        ?>
            </div>
      </div>
  </div>

      </div>
       </div>
    <?php
    endwhile;
    ?>
  </div>

</div>

</section>
