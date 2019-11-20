
<section class="youtube-slider">


<div class="container-lrg">

  <h2><?php the_sub_field('title'); ?></h2>

<div class="slider_wrapper">
    <div class="slick" data-slick='{"slidesToShow": 1, "slidesToScroll": 1}'>
      <?php
     
     
        while(have_rows('videos')):
          the_row();
          $i++;
      ?>
      <div class="grey-block">
          <div class="youtube-block">
       <?php
        $url = get_sub_field('YOUTUBE_URL');

        $embed_code = wp_oembed_get( $url);
        echo "<div class='video-wrapper'>".$embed_code."</div>";
        ?>
        </div>
      </div><!-- id career-block-->



      <?php
        endwhile;
   
      ?>
</div>

    </div> 
  </div>

</section>
