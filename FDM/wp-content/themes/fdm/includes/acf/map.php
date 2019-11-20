
<?php

$locations = get_location_data();
?>

<section class="map-section">		
	  <h2><?php the_sub_field('title'); ?></h2>
		<div class="fdm-map-component">
					<!-- search form -->
					<div class="fdm-map-legend">
						<center>
							<label><input type="checkbox" checked data-layer="centre" /> <?= __( 'Centres', 'fdm' ) ?></label>
							<label><input type="checkbox" checked data-layer="academy" /> <?= __( 'Academies', 'fdm' ) ?></label>
						</center>
						<div class="fdm-map-search">
							<center><label for="addressInput">Enter your location</label><input type="text" id="addressInput"  size="15" placeholder="Location" />
							<input type="button" id="searchButton" class="searchButton" value="Search" /></center>
							<div id="maptext"></div>
						</div>
					</div>

					<!-- google map -->
					<div class="fdm-map"></div>
						<div id="searchload">
							<!-- lat and long from search near location function -->
							<div style="display: none;">
								<div id="lat"></div>
								<div id="lng"></div>
								<div id="src_lat"></div>
								<div id="src_lng"></div>
							</div>
						</div>
				
						

					<?php
		$i=0;
					foreach( $locations as $loc ) {
						$i++; ?>

						<div class="fdm-map-location " data-marker-src="<?php echo get_stylesheet_directory_uri().'/images/'.$loc['type'].'-marker.png'; ?>" data-id="<?=$i ?>" data-layer="<?= $loc['type'] ?>" data-latitude="<?= $loc['latitude'] ?>" data-longitude="<?= $loc['longitude'] ?>">
							<span name="city"><?= $loc['city'] ?></span>
							<?php if ( $loc['type'] != 'placement' ) { ?>
								<span name="description">
									<?php if ($loc['address']) { ?><?= $loc['address'] ?><?php } ?>
									<?php if ($loc['phone_number']) { ?><br /><?= $loc['phone_number'] ?><?php } ?>
									<?php /* they don't want to show email address at the moment
									<?php if ($loc['email_address']) { ?><br /><a href="mailto:<?= $loc['email_address'] ?>"><?= $loc['email_address'] ?></a><?php } */ ?>
								</span>
							<?php } ?>
						</div>

					<?php } ?>

				</div>
</section>
