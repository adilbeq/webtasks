<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

wp_enqueue_script( 'gmap' );
wp_enqueue_script( 'owl.carousel' );
wp_enqueue_style( 'transcargo-owl.carousel.css' );

$owl_id     = uniqid( 'owl_' );
$owl_nav_id = uniqid( 'owl-nav-' );

$gmap_id = uniqid( 'stm-gmap-' );
$map_id = uniqid( 'map_' );

$map_style = array();

if ( $map_height ) {
	$map_style['height'] = 'height: ' . $map_height . ';';
}

if ( $disable_mouse_whell == 'disable' ) {
	$disable_mouse_whell = 'false';
} else {
	$disable_mouse_whell = 'true';
}

if( ! $marker ){
	$marker = get_template_directory_uri() . '/assets/images/markers/map-marker-site_style_blue.png';
}else{
	$marker = wp_get_attachment_image_url( $marker, 'full' );
}

if ( get_theme_mod( 'frontend_customizer' ) ) {
	if( ! empty( $_COOKIE['site_style'] ) ){
		$marker = get_template_directory_uri() . '/assets/images/markers/map-marker-' . $_COOKIE['site_style'] . '.png';
	}else{
		$marker = get_template_directory_uri() . '/assets/images/markers/map-marker-site_style_blue.png';
	}
}

?>
<?php if ( ! empty( $content ) ): ?>
	<div id="<?php echo esc_attr( $map_id ); ?>" class="stm_gmap_wrapper<?php echo esc_attr( $css_class ); ?>"<?php echo( ( $map_style ) ? ' style="' . esc_attr( implode( ' ', $map_style ) ) . '"' : '' ); ?>>
		<?php $google_api_key = get_theme_mod( 'google_api_key', false );
		if( current_user_can('administrator') && empty( $google_api_key ) ){ ?>
			<div class="alert alert-danger alert-dismissible fade in text-center">
				<button class="close" type="button" data-dismiss="alert">×</button>
				You need to enter your <strong>Google Maps API key</strong> under Appearance > Customize > Site Settings > Google API Settings.
			</div>
		<?php } ?>
		<div<?php echo( ( $map_style ) ? ' style="' . esc_attr( implode( ' ', $map_style ) ) . '"' : '' ); ?> id="<?php echo esc_attr( $gmap_id ); ?>" class="stm_gmap"></div>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				google.maps.event.addDomListener(window, 'load', init);
				var <?php echo esc_js( $map_id ); ?>, markers = [], gmarkers = [], <?php echo esc_js( $owl_id ); ?> = $("#<?php echo esc_js( $owl_id ); ?>"), default_marker_icon = '<?php echo esc_url( $marker ); ?>';
				$("#skin_color span").on('click', function () {
					for (var i = 0; i < gmarkers.length; i++) {
						if( $(this).attr('id') == 'site_style_default' ){
							gmarkers[i].setIcon('<?php echo get_template_directory_uri(); ?>/assets/images/markers/map-marker-site_style_blue.png');
						}else{
							gmarkers[i].setIcon('<?php echo get_template_directory_uri(); ?>/assets/images/markers/map-marker-'+$(this).attr('id')+'.png');
						}
					}
				});
				function init() {
					var mapOptions = {
						zoom: <?php echo esc_js( $map_zoom ); ?>,
						zoomControlOptions: {
							position: google.maps.ControlPosition.LEFT_TOP
						},
						streetViewControl: false,
						scrollwheel: <?php echo esc_js( $disable_mouse_whell ); ?>,
						styles: [{"stylers":[{"saturation":-100},{"gamma":1}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.business","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.text","stylers":[{"visibility":"off"}]},{"featureType":"poi.place_of_worship","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"on"},{"saturation":50},{"gamma":0},{"hue":"#50a5d1"}]},{"featureType":"administrative.neighborhood","elementType":"labels.text.fill","stylers":[{"color":"#333333"}]},{"featureType":"road.local","elementType":"labels.text","stylers":[{"weight":0.5},{"color":"#333333"}]},{"featureType":"transit.station","elementType":"labels.icon","stylers":[{"gamma":1},{"saturation":50}]}]
					};
					var mapElement = document.getElementById('<?php echo esc_js( $gmap_id ); ?>');
					<?php echo esc_js( $map_id ); ?> = new google.maps.Map(mapElement, mapOptions);

					<?php echo esc_js( $owl_id ); ?>.on('initialized.owl.carousel', function () {
						transcargo_setMarkers();
					});

					<?php echo esc_js( $owl_id ); ?>.owlCarousel({
						dotsContainer: '#<?php echo esc_js( $owl_nav_id ); ?>',
						items: 3,
						margin: 70,
						responsive: {
							0: {
								items: 1
							},
							768: {
								items: 2
							},
							980: {
								items: 3
							},
							1199:{
								items: 3
							}
						},
						onTranslated: function () {
							transcargo_setMarkers();
						}
					});
				}
				function transcargo_setMarkers(){
					var latlngbounds = new google.maps.LatLngBounds();
					markers = [];
					<?php echo esc_js( $owl_id ); ?>.find('.owl-item.active').each(function (i) {
						markers.push([parseFloat($(this).find('.item').data('lat')), parseFloat($(this).find('.item').data('lng')), $(this).find('.item').data('title')]);
					});
					for (i = 0; i < gmarkers.length; i++) {
						gmarkers[i].setMap(null);
					}
					for (var i = 0; i < markers.length; i++) {
						var marker_array = markers[i];
						marker = new google.maps.Marker({
							position: {lat: marker_array[0], lng: marker_array[1]},
							icon: default_marker_icon,
							map: <?php echo esc_js( $map_id ); ?>,
							title: marker_array[2]
						});
						latlngbounds.extend(new google.maps.LatLng(marker_array[0], marker_array[1]));
						gmarkers.push( marker );
						addInfoWindow( marker, marker_array[2] );
					}
					<?php echo esc_js( $map_id ); ?>.fitBounds(latlngbounds);
					
					if( markers.length === 1 ) {
						var listener = google.maps.event.addListener(<?php echo esc_js( $map_id ); ?>, "idle", function() { 
						  <?php echo esc_js( $map_id ); ?>.setZoom(<?php echo esc_js( $map_zoom ); ?>); 
						  google.maps.event.removeListener(listener); 
						});
					}

					google.maps.event.addListenerOnce(<?php echo esc_js( $map_id ); ?>, 'bounds_changed', function () {
						offsetCenter(latlngbounds.getCenter(), 0, $("#<?php echo esc_attr( $map_id ); ?> .gmap_addresses").innerHeight());
						if( /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ){
							<?php echo esc_js( $map_id ); ?>.setZoom(<?php echo esc_js( $map_id ); ?>.getZoom() - 4 );
						}else{
							<?php echo esc_js( $map_id ); ?>.setZoom(<?php echo esc_js( $map_id ); ?>.getZoom() - 1 );
						}
					});
				}
				function addInfoWindow(marker, title) {

					var infowindow = new google.maps.InfoWindow({
						content: '<h6>' + title + '</h6>',
						pixelOffset: new google.maps.Size(0,40)
					});

					google.maps.event.addListener(marker, 'mouseover', function () {
						infowindow.open(<?php echo esc_js( $map_id ); ?>, marker);
					});

					google.maps.event.addListener(marker, 'mouseout', function () {
						//infowindow.close(<?php echo esc_js( $map_id ); ?>, marker);
					});

				}
				function offsetCenter(latlng,offsetx,offsety) {
					map = <?php echo esc_js( $map_id ); ?>;
					var scale = Math.pow(2, map.getZoom());
					var nw = new google.maps.LatLng(
						map.getBounds().getNorthEast().lat(),
						map.getBounds().getSouthWest().lng()
					);

					var worldCoordinateCenter = map.getProjection().fromLatLngToPoint(latlng);
					var pixelOffset = new google.maps.Point((offsetx/scale) || 0,(offsety/scale) ||0)

					var worldCoordinateNewCenter = new google.maps.Point(
						worldCoordinateCenter.x - pixelOffset.x,
						worldCoordinateCenter.y + pixelOffset.y
					);

					var newCenter = map.getProjection().fromPointToLatLng(worldCoordinateNewCenter);

					map.setCenter(newCenter);

				}
			});
		</script>
		<div class="gmap_addresses">
			<div class="container">
				<div class="row">
					<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
						<div class="addresses_wr">
							<div class="addresses" id="<?php echo esc_attr( $owl_id ); ?>">
								<?php echo wpb_js_remove_wpautop( $content ); ?>
							</div>
						</div>
					</div>
					<div class="owl-dots-wr">
						<div class="owl-dots" id="<?php echo esc_attr( $owl_nav_id ); ?>"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>