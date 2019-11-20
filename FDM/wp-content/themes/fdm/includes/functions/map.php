<?php

add_action('wp_ajax_filter_posts', function($taxonomy){ ajax_filter_get_posts($taxonomy); });
add_action('wp_ajax_nopriv_filter_posts', function($taxonomy){ ajax_filter_get_posts($taxonomy); });



function ajax_filter_get_posts($taxonomy){

	global $wpdb;
	// Get parameters from URL
	$center_lat = $_POST["lat"];
	$center_lng = $_POST["lng"];
	$radius = $_POST["radius"];


	// Search the rows in the markers table
	$query = sprintf("SELECT id, name, lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers  ORDER BY distance LIMIT 1 ",
	  $center_lat,
	  $center_lng,
	  $center_lat,
	  $radius);

	$result = $wpdb->get_results($query);

	echo json_encode($result);

	die();

}


		if ( function_exists( 'acf_add_options_page' ) ) {

			acf_add_options_page( [
				'page_title' => 'FDM Map Markers',
				'capability' => 'manage_options',
				'post_id' => 'fdm_map_markers'
			] );

		}

		// Setup ACF fields
		if ( function_exists( 'acf_add_local_field_group' ) ) {
			//require_once( dirname( __DIR__ ) . '/acf/fdm-map.php' );
		}

		// Cache the map marker data when updated, to avoid hundreds of database queries
		// Note priority of 20 means the function will run *after* the data are updated
		add_action( 'acf/save_post', function( $post_id ) {

			if ( $post_id == 'fdm_map_markers' ) {
				update_location_data_cache();
			}
		}, 20);




	 function updatemarkerstable($locations){


		// save markers in sql table for nearest search function
		global $wpdb;
		$table_name = 'markers';



		if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
		     //table not in database. Create new table
		     $charset_collate = $wpdb->get_charset_collate();



				$sql = "CREATE TABLE markers (
				  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				  name VARCHAR( 60 ) NOT NULL ,
				  address VARCHAR( 80 ) NOT NULL ,
				  lat FLOAT( 10, 6 ) NOT NULL ,
				  lng FLOAT( 10, 6 ) NOT NULL,
				  type VARCHAR( 60 ) NOT NULL
				)  ";
				$wpdb->query($sql);



		}
		else{

			$wpdb->query( "TRUNCATE TABLE markers ");
		}


			$i=0;
			foreach($locations as $loc){

				$i++;
				if($loc['type']!='placement'){
					$sql = $wpdb->prepare("INSERT INTO markers (id, name, address, lat, lng, type) VALUES ('%d','%s','%s','%s','%s','%s')",$i,$loc['city'],$loc['address'],$loc['latitude'],$loc['longitude'],$loc['type']);
					$wpdb->query($sql);
				}
			}



	}

	// Collect the information for the map locations and serialize in a single value in the database options table
	 function update_location_data_cache() {


		$locations = function_exists( 'get_field' ) ? get_field( 'map_locations', 'fdm_map_markers' ) : [];
		delete_option( 'fdm_map_locations_cache' );
		updatemarkerstable($locations);
		add_option( 'fdm_map_locations_cache', json_encode( $locations ) , '', 'no' );

		return $locations;
	}

	// Get the locations data from the database (caching if not already cached)
	 function get_location_data() {
		$json = get_option( 'fdm_map_locations_cache', false );
		if ( $json ) {
			return json_decode( $json, true );
		} else {
			return update_location_data_cache();
		}
	}

	 function base() {
		return 'fdm_map';
	}

	 function vc_params() {

		return [
			'name' => 'FDM Map',
			'description' => 'Add a map to the page',
			'category' => 'FDM',
			'params' => [
				[
				]
			]
		];

	}
