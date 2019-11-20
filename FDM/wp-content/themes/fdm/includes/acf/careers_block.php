<?php
$isslide = get_sub_field('slide');
$style = get_sub_field('block_style');
?>
<section class="white-blocks <?php echo $style;?>">
<div class="container-lrg">

  <h2><?php the_sub_field('title'); ?></h2>
      <?php
        $i=0;

 if($isslide==1){
  ?>
        <div class="slider_wrapper">
    <div class="slick" data-slick='{"slidesToShow": <?php the_sub_field('number_of_slides_per_page'); ?>, "slidesToScroll": <?php the_sub_field('number_of_slides_per_page'); ?>}'>
      <?php
      }
        while(have_rows('fdm_careers')):
          the_row();
          $i++;
    if($i==1 && $isslide!=1){
      ?><div class="white-blocks-grid ">
    <?php } ?>
    <div class="careerblock-wrapper">
      <div class="career-block <?php
      if($style=='serviceblocks')
        {
          echo 'sweep-to-right';
        } ?>">
        <?php
          if(!get_sub_field('fdm_car_use_icon')):
            if($style=='serviceblocks'){
            echo "<h3><a href='".get_sub_field('fdm_car_btn_link')."'>".get_sub_field('fdm_car_title')."</a>";
             echo "<i class='fas fa-angle-right'></i>";
            echo "</h3>";
          }else{
                echo "<h3>".get_sub_field('fdm_car_title')."</h3>";
          }
          else:
        ?>
        <img class="car-img" src="<?php echo get_sub_field('iconfdm_car_icon')?>" alt="<?php echo get_sub_field('fdm_car_title');?>" width="200" height="200">

        <?php
        endif;

        if($style!='serviceblocks'){
         echo "<p><small>".get_sub_field('fdm_car_desc')."</small></p>";
        }
        if(get_sub_field('fdm_car_btn_on_off') == "on" &&  $style!='serviceblocks'):
          echo "<a href='".get_sub_field('fdm_car_btn_link')."' class='sweep-to-right' >".get_sub_field('fdm_car_btn')."</a>";
        endif;
        ?>
      </div><!-- id career-block-->
    </div>
       <?php if($i==4 && get_sub_field('slide')!=1){
      ?></div>
    <?php $i=0; } ?>

    <?php
        endwhile;
 if(get_sub_field('slide')==1){
  ?>
       </div></div>
      <?php
      }

      ?>
 <?php if($i!=0 && get_sub_field('slide')!=1){
      ?></div>
    <?php } ?>
  <?php

 // grey block
/*  if($style == 'greyblocks'){
    ?>

    <div class="container-lrg">
      <div class="grey" style="margin-left: 30px; margin-right: 30px;">
        <div class="slick" data-slick='{"infinite": true,"slidesToShow": 3, "slidesToScroll": 3, "dots": true, "autoplay": true, "autoplaySpeed":2000}'>

        <?php
        $i=0;
        while(have_rows('fdm_careers')):

          the_row();
          $i++;
          $title = get_sub_field('fdm_car_title');
          $description = get_sub_field('fdm_car_desc');
        ?>
     <div class="greyblock">
       <?php

        echo "<h3>". $title."</h3>";
         echo "<p>".$description."</p>";
         ?>
      </div>
        <?php
        endwhile;
        ?>
        </div>
      </div>
    </div>

    <?php
  }
  */
   ?>
</section>
