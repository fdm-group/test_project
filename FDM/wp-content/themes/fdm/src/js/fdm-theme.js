



//var googleMapsApiKey = 'AIzaSyBE1I3PHIxKpqcBldBIDa3wjjVlNv8xKbo';

var googleMapsApiKey = 'AIzaSyCGyAORAGzeofP-0lyGRl4TxYffe82oINg';

var page = 1;
jQuery(function ($) {

	$( document ).ready(function() {

		$('#testselect, #region').change(function() {
			page = 1;
			var category = $('select[name=category]').val();
			var region = $('select[name=region]').val();
			
	 		$.ajax({
		       url: afp_vars.afp_ajax_url,
		       type: "post",
		       cache: false, 
		       action: 'load_posts_by_ajax',
		       dataType : 'json',
		       data : {
					'action': 'load_posts_by_ajax', // the parameter for admin-ajax.php
					'query': afp_vars.posts, // loop parameters passed by wp_localize_script()
					'page' : page, // current page
					 'category': category,
					 'region' : region,
					'security': afp_vars.security,
					
				},
        
         	beforeSend : function ( xhr ) {
				$('.loadmore').text('Loading...'); // some type of preloader
			},
			success : function( posts ){
				//console.log(posts);
				// set the current page to 1
      			$('.fdm-posts').html(posts.content);
      			if( posts ) {
      				
					$('.loadmore').text( 'More posts' );
					$('.loadmore').show(); // if no data, HIDE the button as well
					
					if ( page >= posts.max_page ){
							$('.loadmore').hide(); // if last page, HIDE the button
					}
				} else {
						$('.loadmore').hide(); // if no data, HIDE the button as well
				}

                           
			},
			error: function() {
           		console.log("Error");
        	}

		});
		return false;
	});

				
			

		// load posts when the load more button is clicked
		$('.loadmore').click(function(){
			page++;
			var category = $('select[name=category]').val();
			var region = $('select[name=region]').val();

			$.ajax({
				url : afp_vars.afp_ajax_url, // AJAX handler
			 	dataType : 'json',
			 	type : 'POST',
				data : {
					'action': 'load_posts_by_ajax', // the parameter for admin-ajax.php
					'query': afp_vars.posts, // loop parameters passed by wp_localize_script()
					'page' : page, // current page
					 category: category,
					 region : region,
					'security': afp_vars.security,
				},
			
				beforeSend : function ( xhr ) {
					$('.loadmore').text('Loading...'); // some type of preloader
				},
				success : function( posts ){

					if( posts ) {

							$('.loadmore').text( 'More posts' );
							$('.fdm-posts').append( posts.content ); // insert new posts

							if ( page >= posts.max_page ){
								$('.loadmore').hide(); // if last page, HIDE the button
							}
					} else {
							$('.loadmore').hide(); // if no data, HIDE the button as well
					}
				},
				error: function() {
		           	console.log("Error");
		        }
			});
		return false;
	});


	$('.fdm-reports-component').each(function(){

		var $container = $(this);
		var $filters = $('.fdm-report-filters', this);
		var $reports = $('.fdm-report-link', this);

		var filterReports = function() {
			var year = $filters.find('[name=year]').val();
			var categories = [];
			$filters.find('[name=category]:checked').each(function(){
				categories.push( $(this).val() );
			});
			// start with all visible
			$reports.show();
			if (year) {
				$reports.filter('[data-year!="'+year+'"]').hide();
			}
			if (categories.length) {
				$reports.filter(function(){
					return categories.indexOf($(this).attr('data-category')) == -1;
				}).hide();
			}
		}

		$filters.on('change', filterReports);

	});

		$('table').each(function() {
    var thetable=$(this);
    $(this).find('tbody td').each(function() {
        $(this).attr('data-heading',thetable.find('thead th:nth-child('+($(this).index()+1)+')').text());
        $(this).attr('data-number',$(this).index()+1);
    });
});

				// the event needs to be run before slick is initialized
$('.slick').on('init', function (event, slick, direction) {

    // check to see if there are one or less slides
//    console.log(slick);
 

    if (!($('.slick .slick-slide').length > slick.options.slidesToShow)) {

        // remove arrows
        $('.slick-dots').hide();

    }

});


		$(".slick").slick({
		    autoplay: true,
		    dots: true,
   	        prevArrow:"<button type='button' class='slick-prev pull-left' aria-label='Previous Slide'  ><i class='fa fa-angle-left' aria-hidden='false'></i></button>",
            nextArrow:"<button type='button' class='slick-next pull-right' aria-label='Next Slide'><i class='fa fa-angle-right' aria-hidden='false'></i></button>",
		    responsive: [{
	        breakpoint: 700,
	        settings: {
	            dots: true,
	            arrows: false,
	            infinite: true,
	            slidesToShow: 1,
	            slidesToScroll: 1

        	}
    		}]
		});



		var $videoSrc;
		$('.video-btn').click(function() {
		    $videoSrc = $(this).data( "src" );
		});




		// when the modal is opened autoplay it
		$('#myModal').on('shown.bs.modal', function (e) {

		// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
		$("#video").attr('src',$videoSrc + "?rel=0&amp;showinfo=0&amp;modestbranding=1&amp;autoplay=1" );
		})


		// stop playing the youtube video when I close the modal
		$('#myModal').on('hide.bs.modal', function (e) {
		    // a poor man's stop video
		    $("#video").attr('src',$videoSrc);
		})




	/**** Interactive Google Maps ****/

	// Helper function to fetch the Google Maps API when required (can be called multiple times and only fetches once)
	// Returns a jQuery promise object which resolves when the API is available and rejects on failure
	var getGoogleMapsApi = function() {
		var dfd = $.Deferred();
		// if maps API is already loaded, resolve the promise immediately
		if (window.google && window.google.maps) {
			dfd.resolve();
			return dfd;
		}
		// otherwise, try to fetch the script
		$.ajax({url:'https://maps.googleapis.com/maps/api/js?key='+googleMapsApiKey+'&libraries=geometry', dataType:'script', timeout: 5000}).always(function(){
			if (window.google && window.google.maps) {
				dfd.resolve();
			} else {
				dfd.reject();
			}
		});
		return dfd;
	};

 function parseXml(str) {
          if (window.ActiveXObject) {
            var doc = new ActiveXObject('Microsoft.XMLDOM');
            doc.loadXML(str);
            return doc;
          } else if (window.DOMParser) {
            return (new DOMParser).parseFromString(str, 'text/xml');
          }
       }




function downloadUrl(url, postdata, callback) {

//console.log(afp_vars.afp_ajax_url);
 $.ajax({
       url: afp_vars.afp_ajax_url,
            data: postdata,
        type: "post",
        cache: false,
        dataType : "json",
        action: 'filter_posts',
        success: function(data,textStatus, XMLHttpRequest){
        	console.log(data);
            callback(data);

            },
        error: function() {

            console.log("Error");
        }
    });

}


function searchLocationsNear(center, address, map) {

       //  var markerArray = [];
		 var url = afp_vars.siteurl;
         var searchUrl = url+'/wp-admin/admin-ajax.php';
         var postdata = {lat: center.lat(), lng: center.lng(), radius:'100', action:'filter_posts'};

         downloadUrl(searchUrl, postdata, function(data) {
         // console.log("results "+data[0]+"--");
         	//showSearchedMarkers(data);
         	//map.setCenter(new google.maps.LatLng(data[0]['lat'],data[0]['lng']) );
			//	map.setZoom( 5);
          	// map.fitBounds(bounds);
          	$('#maptext').html('Our nearest location to '+address+' is '+data[0]['name']+' ('+parseInt(data[0]['distance'])+' miles)');
           		//	 map.setCenter(new google.maps.LatLng('53.798216','-1.5358677') );

			//polyline
			var searched_lat = data[0]['lat'];
			var searched_lng = data[0]['lng'];

			document.getElementById("src_lat").innerHTML =searched_lat;
			document.getElementById("src_lng").innerHTML =searched_lng;

			var lat = document.getElementById("lat").innerHTML;
			var lng = document.getElementById("lng").innerHTML;

			var src_lat = document.getElementById("src_lat").innerHTML;
			var src_lng = document.getElementById("src_lng").innerHTML;

			//polyline coordinates
			var fdmCoordinates = [

									{
										lat: parseFloat(lat),
										lng: parseFloat(lng)
									},

									{
										lat: parseFloat(src_lat),
										lng: parseFloat(src_lng)
									}


								];


								//dmCoordinates.destroy("fdmCoordinates");
								console.log(fdmCoordinates);

								var fdmbranchPath = new google.maps.Polyline({

									path: fdmCoordinates,
									geodesic: true,
									strokeColor: '#FF0000',
									strokeOpacity: 2.0,
									strokeWeight: 2


									});



								fdmbranchPath.setMap(map);

								document.getElementById("searchButton").addEventListener("click", function(){

									fdmbranchPath.setMap(null);

								});



				map.setZoom(10);
			//	map.setCenter(new google.maps.LatLng(data[0]['lat'],data[0]['lng']) );
			var Item_1 = new google.maps.LatLng(lat, lng);

    var myPlace = new google.maps.LatLng(searched_lat, searched_lng);
			var bounds = new google.maps.LatLngBounds();
    bounds.extend(myPlace);
    bounds.extend(Item_1);
    map.fitBounds(bounds);



     $('html, body').animate({
                    scrollTop: $(".map-section").offset().top
                }, 2000);

//				map.fitBounds(bounds);
				//map.setCenter(new google.maps.LatLng(latitude, longitude));

         });

       }


if($('.fdm-map-component').length > 0){



$(window).scroll(lazyLoadMaps);

 var mapwrapper = $('.fdm-map-component');

  var mapScrollDistance = mapwrapper.offset().top;
  var mapLoaded = false;



  function lazyLoadMaps() {

    var scrollDistance = $(window).scrollTop();
    var windowHeight = $(window).height();
    var minusheight = windowHeight + (windowHeight/2);
    var mapdistance = (mapScrollDistance - minusheight);


    if ((scrollDistance >= mapdistance) && !mapLoaded) {



	$('.fdm-map-component').each(function(){

		var $container = $(this);
		var $legend = $('.fdm-map-legend', this);
		var $locations = $('.fdm-map-location', this).detach();
		var $map = $('.fdm-map', this);
		var failMessage = function(msg) {
			$map.empty().append($('<p>').addClass('error').text(msg));
		};

		getGoogleMapsApi().then(function(){


 var markers = [];
				//define the basic color of your map, plus a value for saturation and brightness
	var	$main_color = '#d2eaf9',
		$saturation= -20,
		$brightness= 5;

	//we define here the style of the map
	var styles= [
		{
			//set saturation for the labels on the map
			elementType: "labels",
			stylers: [
				{saturation: $saturation}
			]
		},
	    {	//poi stands for point of interest - don't show these lables on the map
			featureType: "poi",
			elementType: "labels",
			stylers: [
				{visibility: "off"}
			]
		},
		{
			//don't show highways lables on the map
	        featureType: 'road.highway',
	        elementType: 'labels',
	        stylers: [
	            {visibility: "off"}
	        ]
	    },
		{
			//don't show local road lables on the map
			featureType: "road.local",
			elementType: "labels.icon",
			stylers: [
				{visibility: "off"}
			]
		},
		{
			//don't show arterial road lables on the map
			featureType: "road.arterial",
			elementType: "labels.icon",
			stylers: [
				{visibility: "off"}
			]
		},
		{
			//don't show road lables on the map
			featureType: "road",
			elementType: "geometry.stroke",
			stylers: [
				{visibility: "off"}
			]
		},
		//style different elements on the map
		{
			featureType: "transit",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" },
				{ lightness: $brightness },
				{ saturation: $saturation }
			]
		},
		{
			featureType: "poi",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" },
				{ lightness: $brightness },
				{ saturation: $saturation }
			]
		},
		{
			featureType: "landscape",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" },
				{ lightness: $brightness },
				{ saturation: $saturation }
			]

		},
		{
			featureType: "road",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" },
				{ lightness: $brightness },
				{ saturation: $saturation }
			]
		},
		{
			featureType: "road.highway",
			elementType: "geometry.fill",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" },
				{ lightness: $brightness },
				{ saturation: $saturation }
			]
		},
		{
			featureType: "water",
			elementType: "geometry",
			stylers: [
				{ hue: $main_color },
				{ visibility: "on" },
				{ lightness: $brightness },
				{ saturation: $saturation }
			]
		}
	];

			var options = {
				scrollwheel: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				styles:styles,
				backgroundColor: "#e7eaf0",
				streetViewControl: false,
				mapTypeControl: false,
				draggable: true
			};

			// create the google map object
			var map = new google.maps.Map($map[0], options);

			var setMapDimensions = (function(){
				var mapWidth = null;
				var mapHeight = null;
				return function() {
					var newMapWidth = Math.min($container.width(), Math.pow(3, map.zoom) * 256);
					//console.log(map.zoom);
					var newMapHeight = Math.min($(window).height()*0.7, 712, Math.pow(2, map.zoom) * 128);
					if (mapWidth !== newMapWidth || mapHeight != newMapHeight) {
						var oldCenter = map.getCenter();
						$map.css({width:newMapWidth, height:newMapHeight});
						google.maps.event.trigger(map, "resize");
						map.setCenter(oldCenter);
					}
				};
			})();

			var keepInBounds = (function(){
				var surpressEvent = false;
				return function() {
					var center = map.getCenter();
					var mapBounds = map.getBounds();
					if (!mapBounds || surpressEvent) {return;}
					var northAdjust = Math.max(0, mapBounds.getNorthEast().lat() - 75);
					var southAdjust = Math.min(0, mapBounds.getSouthWest().lat() + 60);
					var adjust = northAdjust + southAdjust;
					if (adjust) {
						surpressEvent = true;
						map.setCenter({lat:center.lat() - adjust, lng:center.lng()});
						surpressEvent = false;
					}
				};
			})();

			map.addListener('zoom_changed', setMapDimensions);
			$(window).on('resize', setMapDimensions);
			map.addListener('center_changed', keepInBounds);

			if ($('html').is('.touch')) {

				var enablePan = function() {
					$map.addClass('touch-pan');
					map.setOptions({draggable:true});
					$(window).on('touchstart.touch-pan', function(e){
						if (!$map.isOrContains(e.target)) {
							disablePan();
						}
					})
				};
				var disablePan = function() {
					$map.removeClass('touch-pan');
					map.setOptions({draggable:false});
					$(window).off('touchstart.touch-pan');
				};
				var togglePan = function() {
					if ($map.is('.touch-pan')) {disablePan();} else {enablePan();}
				};
				map.addListener('click', togglePan);

			}

/// new search
			searchButton = document.getElementById("searchButton").onclick = searchLocations;

			function searchLocations() {



					// --    loader ends here  -- //

			         var address = document.getElementById("addressInput").value;
			         var geocoder = new google.maps.Geocoder();
			         geocoder.geocode({address: address}, function(results, status) {
			           if (status == google.maps.GeocoderStatus.OK) {

			            searchLocationsNear(results[0].geometry.location, results[0].formatted_address,map);

						map.setCenter(new google.maps.LatLng(results[0].geometry.location.lat(),results[0].geometry.location.lng()) );

						//polyline: sending lat and long data to divs in map
						var lat = results[0].geometry.location.lat();
						var lng = results[0].geometry.location.lng();

						document.getElementById("lat").innerHTML =lat;
						document.getElementById("lng").innerHTML =lng;

			           } else {
			             alert(address + ' not found');
			           }
			         });
			       }

//// end new search

			// add the locations
			var $infoWindowContent = $('<div class="google-map-info-window">');
			var infoWindow = new google.maps.InfoWindow({content:$infoWindowContent[0]});

			$locations.each(function(){
				var $location = $(this);
				var data = $location.data();
				// create LatLng object for this location's precise point
				data.latlng = new google.maps.LatLng(parseFloat($location.attr('data-latitude')), parseFloat($location.attr('data-longitude')));
				// add a marker to the map
				data.marker = new google.maps.Marker({
					position: data.latlng,
					icon: {url: $location.attr('data-marker-src')},
					clickable: true
				});
				data.marker.addListener('click', function(){
					infoWindow.close();
					$infoWindowContent.children().detach();
					$infoWindowContent.append($location);
					infoWindow.open(map, data.marker);
				});
				markers.push(data.marker);
			});

			var showFilteredMarkers = function() {
				$locations.each(function(){$(this).data('marker').setMap(null);});
				$legend.find('[data-layer]:checked').each( function() {
					var layer = $(this).attr('data-layer');
					$locations.each(function(){
						if ( $(this).attr('data-layer') == layer ) {
							$(this).data('marker').setMap(map);
						}
					});
				} );
			};


			var showSearchedMarkers = function(data) {



				$locations.each(function(){$(this).data('marker').setMap(null);});

           		for (var i = 0; i < data.length; i++) {

						$locations.each(function(){
							if ( $(this).attr('data-id') == data[i]['id'] ) {
								$(this).data('marker').setMap(map);
							}
						});

           		}



			};

			showFilteredMarkers();
			$legend.on('change','[data-layer]', showFilteredMarkers);

			// start just north of center
			map.setCenter( $container.width() > 1000 ? {lat:15, lng:0} : {lat:25, lng:0});
			map.setZoom( $container.width() > 1000 ? 3 : 1);


//			 map.setCenter(new google.maps.LatLng('53.798216','-1.5358677') );
//map.setZoom( 8);

		}).fail(function(){

			failMessage('Error - Google maps failed to load');

		});
	});
mapLoaded = true;
}

}// end lazy load maps
  lazyLoadMaps();

}




/***** Our People *****/

	$('.fdm-our-people-component').each(function(){

		var baseUrl = location.protocol+'//'+location.host+location.pathname+(location.search?location.search:"");
		var $overlay = $('.fdm-people-overlay', this).detach().appendTo(document.body);
		var $filters = $('.fdm-people-filters select', this);
		var $teasers = $('.fdm-person-teaser', this);
		var $gridblocks = $('.fdm-grid-block', this);

		$teasers.on('click', function(){

			showPerson( $(this).attr('data-person'), true );
		});

		$overlay.on('click', '.fdm-overlay-close', function() {
			$overlay.fadeOut();
			if ( window.history && history.replaceState ) {
				history.replaceState(null, null, baseUrl );
			}
		});

		var showPerson = function(slug, updateHistory) {

			var $profile = $overlay.find('.fdm-person-profile[data-person='+slug+']');

			if ( $profile.length ) {

				$overlay.find('.fdm-person-profile').hide();
				$profile.show();
				$overlay.fadeIn();
				if ( updateHistory && window.history && history.replaceState ) {
					history.replaceState(null, null, baseUrl+'#'+slug );
				}
			}
		};

		var filterPeople = function() {

			var country = $filters.filter('[name=country]').val();
			var role = $filters.filter('[name=role]').val();
			var pathway = $filters.filter('[name=pathway]').val();

			$.when($gridblocks.fadeOut(300)).done(function(){
				$teasers.each( function() {
					var $teaser = $(this);
					var $gridblock = $teaser.parent();
					var countryMatch = ( country == 'all' || $teaser.attr('data-country') == country );
					var roleMatch = ( role == 'all' || ~$teaser.attr('data-role').indexOf('|'+role+'|'));
					var pathwayMatch = ( pathway == 'all' || ~$teaser.attr('data-pathway').indexOf('|'+pathway+'|'));
					var show = countryMatch && roleMatch && pathwayMatch /* && anotherFilterMatch && anotherFilterMatch ... etc */;

					if ( show && !$gridblock.is(':visible') ) {
						$gridblock.fadeIn(500);
					}
				} );

			});
			processScrollMobile();
			//console.log('scroll');

		};

		$filters.on('change', filterPeople);

		if (window.location.hash) {
			showPerson( window.location.hash.replace(/^#/,''), false );
		}

	});



		// Lazy load juicer
		if ( $('.juicer-feed').length ) {
		  $(window).scroll(lazyLoadJuicer);

		  var feed = $('.juicer-feed');
		  var juicerFeedScrollDistance = feed.offset().top;
		  var juicerLoaded = false;

		  function lazyLoadJuicer() {
		    var scrollDistance = $(window).scrollTop();
		    var windowHeight = $(window).height();



		    if ((scrollDistance >= ((juicerFeedScrollDistance-1200) - windowHeight)) && !juicerLoaded) {
		      $.getScript('//assets.juicer.io/embed.js');

		      $('head').append('<link rel="stylesheet" type="text/css" href="//assets.juicer.io/embed.css">');
		      juicerLoaded = true;
		    }
		  };

		  lazyLoadJuicer();

		}


				  /**
		   * forEach implementation for Objects/NodeLists/Arrays, automatic type loops and context options
		   *
		   * @private
		   * @author Todd Motto
		   * @link https://github.com/toddmotto/foreach
		   * @param {Array|Object|NodeList} collection - Collection of items to iterate, could be an Array, Object or NodeList
		   * @callback requestCallback      callback   - Callback function for each iteration.
		   * @param {Array|Object|NodeList} scope=null - Object/NodeList/Array that forEach is iterating over, to use as the this value when executing callback.
		   * @returns {}
		   */
		    var forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(var c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(var e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};
		    var hamburgers = document.querySelectorAll(".hamburger");
		    if (hamburgers.length > 0) {
		      forEach(hamburgers, function(hamburger) {
		        hamburger.addEventListener("click", function() {
		          this.classList.toggle("is-active");
		        }, false);
		      });
		    }


	});

});
