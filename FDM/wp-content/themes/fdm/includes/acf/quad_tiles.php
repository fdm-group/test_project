<div id="fdm_quad_tiles">
<section class="quad-tiles">
  <div class="container-sml">

      <div class="quad-slider">
          <?php
          while(have_rows('fdm_quad_tiles')):

            the_row();

            $background = get_sub_field('fdm_block_bg');
            $heading = get_sub_field('fdm_block_heading');
            $description = get_sub_field('fdm_block_desc');
            $background_img = get_sub_field('fdm_blk_bg_img');
          ?>
          <?php
          // icon block
            if($background == 'icon'){
          ?>
          <div class="quad-cell">
            <?php
            if(get_sub_field('fdm_block_bg')=='icon'):
              echo "<img src='".get_sub_field('fdm_blk_icon')."' alt=''/>";
            endif;

              if(!get_sub_field('fdm_blk_heading_off')):

                echo "<h2 class='display-4'>".get_sub_field('fdm_block_heading')."</h2>";

              endif;

              echo "<p>".get_sub_field('fdm_block_desc')."</p>";
              echo "<div class='deco-line'></div>"
              ?>
          </div>

        <?php }
        // Image block
        if($background == 'image'){
          ?>
          <div class="service-grid">

               <div class="picture-block" <?php echo 'style="background-image:url(' . $background_img . ')"'; ?>>
                   <div class="hp-caption">
                           <div class="hp-caption-overlay">
                             <div class="hp-caption-overlay-content">
               <?php
                 echo "<div class='hs-caption-overlay-title'>".$heading."<div class='deco-line'></div></div>";
                 echo "<div class='hs-caption-overlay-content'><p>".$description."</p>";
                 echo "<a href='".get_sub_field('button_url')."' class='sweep-to-right white' >".get_sub_field('button_text')."</a></div>";
                 ?>

                     </div>
               </div>
           </div>
               </div>
                </div>

          <?php
        }

        ?>


      <?php

    endwhile;
    ?>
      </div>
  </div>
</section>



<!-- Colour Block -->

  <?php

/*
<div class="grid-container">
 while(have_rows('fdm_quad_tiles')):

    the_row();

    $background = get_sub_field('fdm_block_bg');
    $heading = get_sub_field('fdm_block_heading');
    $description = get_sub_field('fdm_block_desc');
    $background_img = get_sub_field('fdm_blk_bg_img');
    echo '<div class="grid-item">';
    if($background == "colour"){
    ?>

         <div class="text"><?php echo $description; ?></div>

    <?php
    }
    echo "</div>";
  endwhile;
  ?>
</div>


*/



?>

</div>
