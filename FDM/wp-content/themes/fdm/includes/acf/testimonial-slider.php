<section class="white-blocks">

  <h2><?php the_sub_field('title'); ?></h2>
<div class="container-lrg">

      <?php

        $i=0;

  ?>
        <div class="slider_wrapper">
    <div class="slick" data-slick='{"slidesToShow": <?php the_sub_field('number_of_slides_per_page'); ?>, "slidesToScroll": <?php the_sub_field('number_of_slides_per_page'); ?>}'>
     <?php

        while(have_rows('slider_blocks')):
          the_row();
          $i++;
?>
    <div class="careerblock-wrapper">
      <div class="testimonial-block" style="width: 80%; background-color: white; margin: auto;padding: 50px; border-bottom: 4px solid #1daded;">

        <?php
        echo "<div class='tQuote'>".get_sub_field('test_quote')."</div>";
        echo "<p><strong>".get_sub_field('test_from')."</strong></p>";

        ?>
      </div><!-- id career-block-->
    </div>


      <?php
        endwhile;


  ?>
       </div></div>



    </div>

</section>
