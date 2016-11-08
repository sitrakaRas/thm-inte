<?php

class ACF_Widget extends WP_Widget {

	public $available_acfs = array();
	public $metabox_ids = array();
	public $acf_group_id = false;
	public $title_field_key = false;

	function __construct() {

		$widget_options = array(
			'classname' => 'acf_widget', 
			'description' => 'Easily create custom widgets using ACF'
			);

		parent::__construct( 'ACF_Widget', 'ACF Widget', $widget_options );

	}

	function form( $instance ) {

		// Set metabox ids and search for available ACF groups
		$this->set_metabox_ids();
		$this->set_available_acfs();

		// Variables
		$group_id = ( $this->acf_group_id === false ) ? esc_attr( $instance['acf_group'] ) : $this->acf_group_id;
		$acf_groups = $this->available_acfs;
		$widget_id_base = $this->id_base; 
		$widget_id = $this->number;
		$in_widget_title = ( $this->title_field_key !== false ) ? get_field( $this->title_field_key, 'widget_' . $widget_id_base . '_' . $widget_id ) : false;

		// Set group metaboxes
		$this->set_metaboxes( $widget_id_base, $widget_id );

		require( plugin_dir_path( __FILE__ ) . '../partials/acf-widget-html.php' );

	}

	function update( $new_instance, $old_instance )  {

		// Variables
		$instance = $old_instance;
		$instance['acf_group'] = strip_tags( $new_instance['acf_group'] );
		$instance['fields'] = array();

		if ( isset( $new_instance['fields'] ) ) {

			foreach ( $new_instance['fields'] as $key => $value ) {

				$instance['fields'][ $key ] = $value;
				update_field( $key, $value, 'widget_' . $this->id_base . '_' . $this->number );

			}

		}

		return $instance;

	}

	function widget( $args, $instance ) {
		
		$title = apply_filters( 'widget_title', 'hallo', $instance, $this->id_base );

		// Variables
		$acf_key = 'widget_' . $this->id_base . '_' . $this->number;

		// Debug information
		echo '<h3>ACF Key:</h3>';
		echo $acf_key . '<br />';

		echo '<br />';

		echo '<h3>Fields:</h3>';

		echo '<pre>';
		print_r( $instance['fields'] );
		echo '</pre>';

		echo '<br />';

		echo 'Use get_field( \'fieldname\', \$acf_key ); to get the fields in the widget function.';

		echo '<br />';
		echo '<br />';

	}

	function set_metaboxes( $widget_id_base, $widget_id ) {

		// Get ACF field groups
		$acfs = apply_filters( 'acf/get_field_groups', array() );

		if ( $acfs ) {
			
			if ( empty( $this->metabox_ids ) ) {

				$this->data['no_fields'] = true;

				return false;   

			}

			foreach ( $acfs as $acf ) {

				// Get ACF options
				$acf['options'] = apply_filters( 'acf/field_group/get_options', array(), $acf['id'] );

				// Need to show this ACF field group?
				$show = in_array( $acf['id'], $this->metabox_ids ) ? 1 : 0;

				if ( ! $show ) {

					continue;

				}

				// Add meta box
				add_meta_box(
					'acf_' . $acf['id'], 
					$acf['title'], 
					array( $this, 'meta_box_input' ), 
					'acf_widget',
					'widget_' . $acf['id'],
					'high',
					array(
						'field_group' => $acf, 
						'show' => $show, 
						'post_id' => 'widget_' . $widget_id_base . '_' . $widget_id
						)
					);

			}

		}

	}

	function meta_box_input( $post, $args ) {

		// Additional variables
		$options = $args['args'];

		echo '<div class="options" data-layout="' . $options['field_group']['options']['layout'] . '" data-show="' . $options['show'] . '" style="display: none"></div>';

		$fields = apply_filters( 'acf/field_group/get_fields', array(), $options['field_group']['id'] );

		do_action( 'acf/create_fields', $fields, $options['post_id'] );

	}

	function set_available_acfs() {

		// Get ACF field groups
		$acfs = apply_filters( 'acf/get_field_groups', array() );

		if ( $acfs ) {

			foreach ( $acfs as $acf ) {

				// Get ACF options
				$acf['options'] = apply_filters( 'acf/field_group/get_options', array(), $acf['id'] );

				// Need to show this ACF field group?
				$show = in_array( $acf['id'], $this->metabox_ids ) ? 1 : 0;

				if ( ! $show) {

					continue;
			
				}

				if ( ! isset( $this->available_acfs[ $acf['id'] ] ) ) {

					$this->available_acfs[ $acf['id'] ] = array(
						'id' => $acf['id'],
						'title' => $acf['title']
						);
				
				}
			
			}
		
		}

	}

	function set_metabox_ids( $metabox_id = false ) {

		// Get ACF field groups
		$acfs = apply_filters( 'acf/get_field_groups', array() );

		if ( $acfs ) {
			
			// Variables
			$metabox_ids = array();

			foreach ( $acfs as $acf ) {
				
				// Get ACF location
				$locations = apply_filters( 'acf/field_group/get_location', array(), $acf['id'] );

				foreach ( $locations as $location ) {
					
					if ( $location[0]['param'] == 'widget' ) {
						
						$metabox_ids[] = $acf['id'];
					
					}
				
				}
			
			}

			$this->metabox_ids = $metabox_ids;
		
		}
	
	}

}
