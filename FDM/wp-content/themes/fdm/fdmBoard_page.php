<?php
/**
 * Template Name: FDM Board
 *
 *
 */

 if( have_rows('fdm_board', 'option') ):

    while ( have_rows('fdm_board', 'option') ) : the_row();

        // Your loop code
        ?>
        <img src="<?php echo get_sub_field('image'); ?>" alt="<?php echo get_sub_field('name');?>">
        <?php
        echo "<h1>".get_sub_field('name')."</h1>";
        echo "<p>".get_sub_field('position')."</p>";
        echo "<p>".get_sub_field('bio')."</p>";

    endwhile;

else :

    // no rows found

endif;
