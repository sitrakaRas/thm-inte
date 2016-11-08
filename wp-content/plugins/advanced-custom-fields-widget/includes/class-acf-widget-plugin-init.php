<?php

class ACF_Widget_Plugin_Init {

	public $title = 'Widget';
	public $slug = 'widget';

	function __construct() {

		// Add widget type to ACF
		add_filter( 'acf/location/rule_types', array( $this, 'acf_location_rules_types' ) );
		add_filter( 'acf/location/rule_values/widget', array( $this, 'acf_location_rules_values_widget' ) );
	
	}

	function acf_location_rules_types( $choices ) {

		$choices[ $this->title ][ $this->slug ] = $this->title;

		return $choices;
	
	}

	function acf_location_rules_values_widget( $choices ) {

		$choices = array();

		$choices[ $this->slug ] = $this->title;

		return $choices;
	
	}

}
