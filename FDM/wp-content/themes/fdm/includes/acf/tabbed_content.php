

<section class="tabbed-content">
<?php
if(get_sub_field('title')!=''){
  ?>
<h2><?php echo get_sub_field('title'); ?></h2>
  <?php }
  ?>
  <div class="container-lrg">


     
<div class="tab-content">


    <!-- Nav tabs -->
    <div class="row">
      <div class="col-lg-3  col-xl-2">
        <ul class="nav  flex-column" role="tablist">
           <?php
    $i=0;
    while(have_rows('tabs')):

      the_row();
      $i++;
    ?>
          <li class="nav-item">
            <a class="nav-link ripple <?php if($i==1){ echo "active"; } ?>" data-toggle="tab" href="#panel<?=$i;?>" role="tab"><?php echo get_sub_field('tab_title'); ?>
            </a>
          </li>
          <?php
           endwhile;
           ?>
         
        </ul>
      </div>



      <div class="col-lg-6">
        <!-- Tab panels -->
        <div class="tab-content vertical">
          <!-- Panel 1 -->
           <?php
    $i=0;
    while(have_rows('tabs')):

      the_row();
      $i++;
    ?>
            <div class="tab-pane fade  <?php if($i==1){ echo "in show active"; } ?>" id="panel<?=$i;?>" role="tabpanel">
            <?php  
    if( have_rows('tab_section') ):

      // loop through the rows of data
      while ( have_rows('tab_section') ) : the_row();
      
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
      endwhile;

      endif; ?>
          </div>
          <?php
           endwhile;
           ?>


        
        </div>
      </div>


     <div class="col-lg-3 col-xl-2 rhs">
      <?php

      if( have_rows('RHS') ):

      // loop through the rows of data
      while ( have_rows('RHS') ) : the_row();
      
        // check current row get_row_layout
       if(get_row_layout()=='grey_area'){

          echo "<div class='"; 
            if(get_sub_field('colour')=='blue'){
              echo "blue_area";
            }else{
              echo "grey_area";
            }
          echo "'>".get_sub_field('grey_area')."</div>";
       }
       if(get_row_layout()=='button'){
          echo "<a href='".get_sub_field('url')."' class='black sweep-to-right button'>".get_sub_field('text')."<span class='right'><i class='fa fa-angle-right'></i></span></a>";
       }
    endwhile;

    endif;
  
      ?>
      </div>



    </div>

</div>

</section>

