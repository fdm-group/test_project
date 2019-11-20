<?php

$title = get_sub_field('title');
$paragraph = get_sub_field('paragraph');
$show = get_sub_field('show_people');
$showbutton = get_sub_field('button');
$button_text = get_sub_field('button_text');
$button_url = get_sub_field('button_url');



?>
<section class="our-people our-people-amp">

<div class="container-lrg">

<?php
if($show):


	$people = get_people_data();



	$posts = get_sub_field('people');
	echo "<h2>".$title."</h2>";
	?>
<div class="fdm-our-people-component">

<div class="fdm-people-filters">
				<select name="country">
					<option value="all"><?= __( 'All Locations', 'fdm' ) ?></option>
					<?php foreach( $countries as $country ) { ?>
						<option value="<?= $country['name'] ?>"><?= $country['t_name'] ?></option>
					<?php } ?>
				</select><select name="role">
					<option value="all"><?= __( 'All Roles', 'fdm' ) ?></option>
					<?php foreach( $roles as $role => $t_role ) { ?>
						<option value="<?= $role ?>"><?= $t_role ?></option>
					<?php } ?>
				</select><select name="pathway">
					<option value="all"><?= __( 'All Pathways', 'fdm' ) ?></option>
					<?php foreach( $pathways as $pathway => $t_pathway ) { ?>
						<option value="<?= $pathway ?>"><?= $t_pathway ?></option>
					<?php } ?>
				</select>
			</div>

	<div class="fdm-people-grid">


				<?php foreach( $people as $i => $person ) { ?>

					<div class="fdm-grid-block">
						<?php
						/* note lists of roles and pathways use '|' as the delimiter, and also start and end with '|'.
						 * eg  |apples|oranges|pears|
						 * this makes it easy to test a particular value in javascript like this indexOf('|'+role+'|');
						 * using spaces as a delimiter doesn't work very well because for example the string 'Consultant' can also be found in 'HR & Consultant Support'
						 * so you get incorrect matches
						 */
						?>
						<div class="fdm-person-teaser" data-person="<?= $person['slug'] ?>" data-pathway="|<?= implode('|',$person['pathway']) ?>|"  data-country="<?= $person['country'] ?>" data-role="|<?= implode('|',$person['role']) ?>|" >
							<div name="image"><img src="" data-src="<?= $person['image']['sizes']['people-profile'] ?>" class="lazy" alt="" /></div>
							<div name="info">
								<span name="name"><?= $person['name'] ?></span>
								<span name="job-title"><?= $person['job_title'] ?></span>
								<span name="department"><?= $person['department'] ?></span>
								<span name="city"><?= __( 'Location', 'fdm' ) ?>: <?= $person['city'] ?></span>
							</div>
						</div>
					</div>

				<?php } ?>

			

			<div class="fdm-people-overlay"  >


				<?php foreach( $people as $i => $person ) { ?>

					<div class="fdm-person-profile" data-person="<?= $person['slug'] ?>" style="display:none;" >
						<button class="fdm-overlay-close" title="close"><?= __( 'Close', 'fdm' ) ?></button>
						<span name="department"><?= $person['department'] ?></span>
						<div class="inner">
							<img src="<?= $person['image']['sizes']['people-profile']; ?>" alt="<?= $person['name']; ?>" />
							<h3 name="name"><?= $person['name'] ?></h3>
							<span name="job-title"><?= $person['job_title'] ?></span>
							<span name="city"><?= __( 'Location', 'fdm' ) ?>: <?= $person['city'] ?></span>
							<div name="bio"><?= $person['bio'] ?></div>
						</div>
					</div>

				<?php } ?>

			</div>
			</div>
<?php
else:


?>
	<div class="our-people-grid ">
	  <div class="grey text-block">

	  		<?php
				echo "<h2>".$title."</h2>";
				echo "<p>".$paragraph."</p>";
			?>
			<?php
			if($showbutton):
				echo "<a href=".$button_url." class='sweep-to-right white'>".$button_text."</a>";

			endif;
			?>

		</div>

<amp-carousel  layout="fixed-height"  autoplay
    type="slides"
  height="450" width="auto" >
		<?php

$posts = get_sub_field('people');


			if( $posts ):  $j=0;?>

				<?php foreach( $posts as $p ): $j++; ?>
					
				   	<?php $img = get_field('image', $p->ID); ?>
<amp-img src="<?= $img['url'];?>" width="320" height="320">
				   		<div class="amp-carousel-description">
        <h4><?php echo get_the_title( $p->ID ); ?></h4>
									    	Job title: <?php the_field('job_title', $p->ID); ?>
    </div>
				   		</amp-img>

				   	
				<?php endforeach; ?>

				
			<?php 
		endif;
		?>
</amp-carousel>
	  	
<?php
endif;
?>
 
	</div>
		</div>

</section>
