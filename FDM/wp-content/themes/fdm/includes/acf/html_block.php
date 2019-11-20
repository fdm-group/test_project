

<section class="html-block
<?php if(get_sub_field('remove_padding')){ echo "remove_padding"; } ?>">

  <div class="container-<?php echo get_sub_field('width');?> <?php echo get_sub_field('background_colour');?>">

          <!-- Panel 1 -->
           <?php

    if( have_rows('content') ):
    while(have_rows('content')):

      the_row();
      $i++;
    ?>
            <?php
        // check current row get_row_layout
       if(get_row_layout()=='html'){
          htmlblock();
       }
       if(get_row_layout()=='quote'){
          quoteblock();
       }
       if(get_row_layout()=='icons'){
          iconblock();
       }

       if(get_row_layout()=='our_people'){
         Ourpeople();
       }
       if(get_row_layout()== 'button'){
         buttonblock();
       }
       if(get_row_layout()=='slider'){
            //if type
        if(get_sub_field('style')=='hover'){
            showoverlayslider();
        }else{
           showslider();
        }

       }
      ?>

          <?php
           endwhile;

           endif;
           ?>



        </div>







</section>
