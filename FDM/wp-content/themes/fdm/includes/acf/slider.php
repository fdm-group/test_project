<section class="slide-blocks">
<?php

$Slide_types = get_sub_field('slide_type');

if($Slide_types == "pictext"){
 ?>

  <div class="slick" data-slick='{"slidesToShow": 1, "slidesToScroll": 1}'>

    <?php

    
    while(have_rows('pic_text')):

      the_row();

      $caption = get_sub_field('caption');
      $image = get_sub_field('image');

   //   $slider_option = get_sub_field('slider_option');
   // if($slider_option == true){
    ?>
 <div class="slider">
   <img src="<?php echo get_sub_field('image');?>" style="max-width: 996px; height:664px" alt="<?php echo $caption; ?>">
     <div class="caption">
      <?php echo $caption; ?>
     </div>
  </div>
    <?php
    endwhile;
    ?>
  </div>

  <?php
}else{
  ?>
<div class="picture-slide">
  <div class="slick" data-slick='{"infinite": true,"slidesToShow": 6, "slidesToScroll": 1, "dots": false, "autoplay": true, "autoplaySpeed":4000}'>

    <?php
    $i=0;
    while(have_rows('picture')):

      the_row();
      $i++;

      $image = get_sub_field('image');
   //   $slider_option = get_sub_field('slider_option');
   // if($slider_option == true){
    ?>

 <div class="slider">
   <img src="<?php echo get_sub_field('image');?>" style="max-width: 100px; height:100px" alt="">
  </div>
    <?php
    endwhile;
    ?>
  </div>
</div>
  <?php
    }
  ?>
</section>
