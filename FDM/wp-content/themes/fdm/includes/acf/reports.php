<section class="reports">
  <?php


$reports = get_field( 'reports', 'options' );
		usort( $reports, function( $a, $b ) {
			return
				( ( $b['year'] - $a['year'] ) * 2 ) // year scores 2 'points'
				+ min( 1, max( -1, strnatcmp( $a['title'], $b['title'] ) ) ); // alphabetical order of title scores 1 'point'
		} );

		$years = array_unique( array_map( function( $report ) { return (int) $report['year']; }, $reports ) );
		sort( $years );

		$categories = array_unique( array_map( function( $report ) { return $report['category']; }, $reports ) );
		sort( $categories );


		?>

	<div class="fdm-reports-component">
		<div class="fdm-report-filters-wrapper">
			<div class="container-med ">
				<form class="fdm-report-filters">
					<select name="year">
						<option value=""><?= __( 'All years', 'fdm' ) ?></option>
						<?php foreach( $years as $year ) { ?>
							<option value="<?= $year ?>"><?= $year ?></option>
						<?php } ?>
					</select>
					<?php foreach( $categories as $category ) { ?>
						<label><input type="checkbox" name="category" value="<?= $category ?>" /><?= $category ?></label>
					<?php } ?>
				</form>
			</div>
		</div>
		<div class="container-med ">
			<div class="fdm-report-list">
				<?php foreach( $reports as $report ) { ?>
					<div class="fdm-report-link" data-year="<?= $report['year'] ?>" data-category="<?= $report['category'] ?>" >
						<span name="year"><?= $report['year'] ?></span>
						<a name="download" href="<?= $report['file']['url'] ?>">
							<?= __( 'Download report', 'fdm' ) ?>
							<i class="far fa-arrow-alt-circle-down"></i><?php /* https://material.io/icons/#ic_vertical_align_bottom */ ?>
						</a>
						<span name="title"><?= $report['title'] ?></span>
					</div>
				<?php } ?>
			</div>
		</div>


</section>