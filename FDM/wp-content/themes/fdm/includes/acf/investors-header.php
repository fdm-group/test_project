<?php
$background_image = get_sub_field( 'background_image');

?>
<section class="fdm-investors-header" style="background-image:url(<?php echo $background_image;?>);" >


<div class="container-lrg">
<?php

if (  function_exists( 'pll_current_language' ) && function_exists( 'get_field' ) ) {
	

		
		$options_page_id = 'fdm-investors-header-' . pll_current_language();
		$sidebar_items = get_field( 'sidebar_items', $options_page_id );
		$show_share_price_widget = get_sub_field( 'share_price_widget' );
		$annual_report = get_field( 'annual_report', $options_page_id );

		$share_price_widget = get_field( 'share_price_widget', $options_page_id );
				
		
		//$sidebar_html = implode( $this->sidebar_spacer(), $sidebar_html );
		
		
		?>
		<div class="fdm-investors-header-component">
			<div class="fdm-investors-header-sidebar">
				<?php 
				$sidebar_html = array_map( function( $item ) {
			  fdm_output_button($item['link'],$item['label'],true,'fa fa-angle-right ','sweep-to-right inv-link');
			  echo "<div class='clearer'></div>";

		}, $sidebar_items );
		 ?>
			</div>
			<div class="fdm-investors-header-info">
				<?php if ( $show_share_price_widget ) { ?>

					<h3><?= $share_price_widget['heading'] ?></h3>
					<?php minishareprice(); 
fdm_output_button($share_price_widget['button_link'],$share_price_widget['button_label'],false,'fa fa-angle-right ');
					?>
					
				<?php } ?>
					<h3><?= $annual_report['heading'] ?></h3>
					<?php fdm_output_button($annual_report['report_file']['url'],$annual_report['button_label'],false,'fa fa-angle-right '); ?>
			
			</div>
		</div>

<?php
}
?>
</div>
</section>