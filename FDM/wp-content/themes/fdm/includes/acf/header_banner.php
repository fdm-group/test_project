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

<section <?= $background_video ? "" : 'style="background-image:url(' . $background_image['url'] . ')"' ?> class="fdm-header-banner" data-num-ctas="<?= $call_to_actions ? count( $call_to_actions ) : 0 ?>">
<?php
	 if( $background_video ) { ?>
		<div class="background-video">
		<!--	<video data-mute="muted" muted loop="loop" preload="auto" autoplay="autoplay" id="el-video" src="<?= $background_video['url']; ?>">

		</video>-->
			<video data-mute="muted" muted loop="loop" preload="auto" autoplay="autoplay"
			id="el-video" src="<?= $background_video['url']; ?>" width="1950" height="1200">
				<div fallback>
	    		<p>Video could not be loaded. Please check that your browser supports HTML5 video.</p>
	  		</div>
			</video>
		</div>
	<?php } ?>

	<div class="overlay">
	<?php if( $youtube_link ) { ?>
			<button type="button" class="video-btn  youtube-link " aria-label='Play Video'  data-toggle="modal" data-src="<?= $youtube_link; ?>" data-target="#myModal">
 <svg viewBox="0 0 100 100">
					<path d="M85.4,14.6c-19.5-19.5-51.2-19.5-70.7,0c-19.5,19.5-19.5,51.2,0,70.7s51.2,19.5,70.7,0C104.9,65.8,104.9,34.2,85.4,14.6z
	 				M45.4,71.6c-1.2,1.2-3.5,1-4.7-0.2c-1.2-1.2-1.5-3.5-0.2-4.7l18.8-18.8L40.8,29.4c-1.2-1.2-1.4-3.1-0.1-4.4
					c1.2-1.2,3.1-1.1,4.4,0.1l20.9,20.9c0.6,0.6,1.1,1.5,1.1,2.3c0,0.8-0.1,1.7-0.7,2.3L45.4,71.6z"/>
				</svg>
</button>

		<?php } ?>
		<?php if ( $heading ) { ?>
			<h1 class="banner-heading"><?= $heading; ?></h1>
		<?php } ?>

	</div>

	<?php if( have_rows('fdm_hdr_call_to_actions') ):
		?>

			<?php
		$n = count( $call_to_actions );

		if($n == 4){
			?>
				<div class="four-buttons">
					<?php
					while ( have_rows('fdm_hdr_call_to_actions') ) : the_row();
								fdm_output_button(get_sub_field('link'),get_sub_field('label'),false,'fa fa-angle-right');
					endwhile;
						?>
				</div>
			<?php
		}

		if($n <= 3){
		?>

		<div class="call-to-actions">
			<?php
			while ( have_rows('fdm_hdr_call_to_actions') ) : the_row();
		        fdm_output_button(get_sub_field('link'),get_sub_field('label'),false,'fa fa-angle-right');
			endwhile;
    		?>
		</div>
	<?php }endif; ?>


	<?php if ( $show_we_work_with_carousel ) {
			echo "<div class='carousel-heading'>".get_sub_field('fdm_hdr_carousel_heading')."</div>";
} ?>

</section>
<?php



?>
<?php if ( $show_we_work_with_carousel ) { ?>

<div class="client-carousel-container">
	<div class="client_wrapper">
	    <div class="c-slick" data-slick='{"dots": false}'>
	      <?php
	        while(have_rows('fdm_hdr_clients_list')):
	          the_row();
	      ?>
	      <div class="client_names" >
					<?php
					// display a sub field value
					 $clients_list= array(the_sub_field('client'));

					 $clients = array_map( function( $c ) {

						 return '<span class="client-name carousel-part">' . $c['client'] . '</span>';
						 //<div style="text-align: right">|</div>

					 }, $clients_list);

					 ?>
	      </div><!-- id career-block-->



	      <?php
			//	echo implode( '<span class="divider"></span>', $clients );
	        endwhile;

	      ?>

	</div>

	    </div>

<?php } ?>

</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-body">

       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <!-- 16:9 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always">></iframe>
</div>


      </div>

    </div>
  </div>
</div>
