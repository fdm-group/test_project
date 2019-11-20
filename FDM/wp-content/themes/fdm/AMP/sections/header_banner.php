<?php

$show_video = get_sub_field('fdm_hdr_use_header_banner');

$background_image = get_sub_field('fdm_hdr_background_image');

$background_video = get_sub_field('fdm_hdr_background_video');

$call_to_actions = get_sub_field('fdm_hdr_call_to_actions');
$count = count($call_to_actions);
$youtube_link = get_sub_field('fdm_hdr_youtube_link');
$heading = get_sub_field('fdm_hdr_heading');
$show_we_work_with_carousel = get_sub_field('fdm_hdr_show_we_work_with_carousel');
?>

<section <?=  'style="background-image:url(' . $background_image['url'] . ')"'; ?> class="fdm-header-banner" data-num-ctas="<?= $call_to_actions ? count( $call_to_actions ) : 0 ?>">


	<div class="overlay">
	
		<?php if ( $heading ) { ?>
			<h1 class="banner-heading"><?= $heading; ?></h1>
		<?php } ?>

	</div>

	<?php if( have_rows('fdm_hdr_call_to_actions') ):

		$n = count( $call_to_actions );

		?>
		<div class="call-to-actions">
			<?php
			while ( have_rows('fdm_hdr_call_to_actions') ) : the_row();
		        fdm_output_button(get_sub_field('link'),get_sub_field('label'),false,'');
			endwhile;
    		?>
		</div>

	<?php endif; ?>

	<?php if ( $show_we_work_with_carousel ) { ?>

		<div class="client-carousel-heading"><?= $carousel_heading; ?></div>

	<?php } ?>

</section>

<?php if ( $show_we_work_with_carousel ) { ?>

	<div class="client-carousel-container">
		<div class="viewport">
			<div class="track">
				<?php
					$clients = array_map( function( $c ) {

						return '<span class="client-name carousel-part">' . $c['client'] . '</span>';
						echo "<script></script>";
					}, $clients_list );

					echo implode( '<span class="divider"></span>', $clients );
				?>
			</div>
		</div>
		<button type="button" aria-label="Previous" title="Previous" class="carousel-arrow prev"><i class="material-icons">chevron_left</i></button>
		<button type="button" role="button" aria-label="Next" title="Next" class="carousel-arrow next"><i class="material-icons">chevron_right</i></button>
	</div>

<?php } ?>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-body">

       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <!-- 16:9 aspect ratio -->



      </div>

    </div>
  </div>
</div>
