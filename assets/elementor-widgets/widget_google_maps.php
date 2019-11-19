<?php

namespace BusyBytes\ElementorWidgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Google_Maps extends Widget_Base {
	
	const DEFAULT_MAP_STYLE = '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"saturation":"-30"},{"color":"#c5d7ff"}]}]';

	public function get_name() {
		return 'bb-google-maps';
	}

	public function get_title() {
		return 'BusyBytes Google Maps';
	}

	public function get_icon() {
		return 'eicon-google-maps';
	}

	public function get_categories() {
		return [ 'bb-widgets' ];
	}

	protected function _register_controls() {
		parent::_register_controls();

		$this->start_controls_section(
			'bb_section',
			[
				'label' => 'BusyBytes Extension',
			]
		);
		
		// API Key
		$this->add_control(
			'api_key',
			[
				'label' => 'API Key',
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => 'Paste your GMaps API key',
			]
		);

		// Heading: Center Location
		$this->add_control(
			'center_location_heading',
			[
				'label' => 'Center Location',
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Map Zoom
		$this->add_control(
			'zoom',
			[
				'label' => 'Zoom',
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		// Center Latitude		
		$this->add_control(
			'center_latitude',
			[
				'label' => 'Latitude',
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
			]
		);

		// Center Longitude
		$this->add_control(
			'center_longitude',
			[
				'label' => 'Longitude',
				'type' => Controls_Manager::NUMBER,
				'default' => 0,
			]
		);

		$this->add_control(
			'latlong_note',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => 'To find both the latitude and longitude of some place, please use <a href="https://www.latlong.net/">this tool</a>.',
			]
		);

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		// Open By Default
		$this->add_control(
			'open_location',
			[
				'label' => 'Open by default?',
				'description' => 'By default the first location will be opened, uncheck this option to turn this off.',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'True',
				'label_off' => 'False',
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		// repeater and its fields
		$locations = new \Elementor\Repeater();
		$locations->add_control(
			'info_window', [
				'label' => 'Info Window Content',
				'type' => \Elementor\Controls_Manager::CODE,
				'rows' => 10,
				'language' => 'html'
			]
		);

		$locations->add_control(
			'latitude', [
				'label' => 'Latitude',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		$locations->add_control(
			'longitude', [
				'label' => 'Longitude',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
			]
		);

		// Locations Repeater
		$this->add_control(
			'locations',
			[
				'label' => 'Locations',
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $locations->get_controls(),
				'default' => [
					[
						'info_window' => 'Add some description here! Html accepted!',
						'latitude' => 0,
						'longitude' => 0
					],
					[
						'info_window' => 'Add some description here! Html accepted!',
						'latitude' => 0,
						'longitude' => 0
					],
				]
			]
		);

		// Heading: Style Options
		$this->add_control(
			'style_options_heading',
			[
				'label' => 'Style Options',
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'height', [
				'label' => 'Height (px)',
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 480,
			]
		);

		// Map Type
		$this->add_control(
			'map_type',
			[
				'label' => 'Map Type ID',
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'roadmap',
				'options' => [
					'roadmap'  => 'Roadmap',
					'satellite' => 'Satellite',
					'hybrid' => 'Hybrid',
					'terrain' => 'Terrain',
				],
			]
		);

		// Map Json Style		
		$this->add_control(
			'map_json_style', [
				'label' => 'Map Style (json)',
				'description' => 'The Map\'s Style as Json. For presets, please visit: <a href="https://snazzymaps.com/">SnazzyMaps</a>.',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => self::DEFAULT_MAP_STYLE
			]
		);

		// Heading: Additional Options
		$this->add_control(
			'additional_options_heading',
			[
				'label' => 'Style Options',
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		// Draggable?
		$this->add_control(
			'draggable',
			[
				'label' => 'Draggable?',
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => 'True',
				'label_off' => 'False',
				'return_value' => 'true',
				'default' => 'false',
			]
		);

		$this->end_controls_section();
	}
	
	protected function render() {
		$settings = $this->get_settings();

		?>
			<div id="map" style="width: 100%; height: <?php echo $settings['height']; ?>px;"></div>
			<script type="text/javascript">
				function initMap() {

					var locations = [
						<?php
							foreach ( $settings['locations'] as $key=>$location ) {
								// if there is a line break in the html editor, it gets rendered in the js and throws errors,
								// so we use a str_replace to delete these line breaks and input the new text into a new variable
								$parsed_info_window = str_replace( array ("\r","\n") , "" , $location['info_window']);
								echo '[\'' . $parsed_info_window . '\', ' . $location['latitude'] . ', ' . $location['longitude'] . ', ' . $key . '],';
							}
						?>
					];

					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: <?php echo $settings['zoom']; ?>,
						center: new google.maps.LatLng(<?php echo $settings['center_latitude']; ?>, <?php echo $settings['center_longitude']; ?>),
						mapTypeId: google.maps.MapTypeId.<?php echo strtoupper($settings['map_type']); ?>,
						scrollwheel: false,
						navigationControl: false,
						mapTypeControl: false,
						scaleControl: false,
						draggable: <?php echo ( empty( $settings['draggable'] ) ) ? 'false' : 'true' ?>,
						styles: <?php echo ( empty( $settings['map_json_style'] ) ) ? self::DEFAULT_MAP_STYLE : $settings['map_json_style']; ?>
					});

					var infowindow = new google.maps.InfoWindow();
					var marker, i;

					for (i = 0; i < locations.length; i++) { 
						marker = new google.maps.Marker({
							position: new google.maps.LatLng(locations[i][1], locations[i][2]),
							map: map
						});

						google.maps.event.addListener( marker, 'click', ( function ( marker, i ) {
							return function() {
								infowindow.setContent( locations[i][0] );
								infowindow.open( map, marker );
							}
						})( marker, i ));
						
						<?php
						
						// if the open location is not empty,
						// it means it returned something (its value is "true"),
						// then: print this js code, to open the first element
						if ( ! empty ( $settings['open_location'] ) ) {
							?>
							if(i == 0) {
								infowindow.setContent( locations[i][0] );
								infowindow.open( map, marker );
							}
							<?php
						}
						?>
					}
				}
			</script>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?php echo $settings['api_key']; ?>&callback=initMap" async defer></script>
		<?php
	}
}