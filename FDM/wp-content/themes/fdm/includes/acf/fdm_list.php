<section class="grey-slider" id="fdm-list">
<div class="fdm-list-container">
  <h2><?php the_sub_field('fdm_list_heading'); ?></h2>
  <div class="content">
  <?php
    echo "<p>".get_sub_field('fdm_list_content')."</p>";
  ?>
  </div>
  <ul>
  <?php
    while(have_rows('fdm_list')):

      the_row();
        ?>
        <li><img src="<?php echo get_sub_field('fdm_list_img'); ?>" alt="<?php echo get_sub_field('fdm_list_text'); ?>" width="80" height="70"> <?php echo get_sub_field('fdm_list_text'); ?></li>
        <?php
    endwhile;

    ?>
  </ul>
</div>
</section>
