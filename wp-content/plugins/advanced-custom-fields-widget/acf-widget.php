<?php

/**
 * Plugin Name:       Advanced Custom Fields: Widget
 * Plugin URI:        https://www.directbasing.com/resources/wordpress/advanced-custom-fields-widget/
 * Description:       A widget that is able to use content from an ACF field group
 * Version:           1.0.2
 * Author:            Direct Basing
 * Author URI:        https://www.directbasing.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       acf_widget
 * Domain Path:       /languages
 */

require_once( 'includes/class-acf-widget.php' );
require_once( 'includes/class-acf-widget-plugin.php' );
require_once( 'includes/class-acf-widget-plugin-init.php' );

$GLOBALS['acf_widget_types'] = array( 'acf_widget' );
$GLOBALS['ACF_Widget_Plugin'] = new ACF_Widget_Plugin();
$GLOBALS['ACF_Widget_Plugin_Init'] = new ACF_Widget_Plugin_Init();

function acf_widget_init()
{
	//
	// TODO
	// Use for future update so default ACF Widget can access data immediately
	// and not after saving first (AJAX)
	//

	//wp_register_script( 'acf-widget', plugins_url( 'acf-widget.js', __FILE__ ) );
	//wp_enqueue_script( 'acf-widget' );

	register_widget( 'ACF_Widget' );
}

add_action( 'widgets_init', 'acf_widget_init' );

function observe_deleted_widgets() {

	global $wp_registered_widgets;

	if ( strtolower( $_SERVER['REQUEST_METHOD'] ) == 'post') {

		// Get widget ids
		$widget_raw_id = $_POST['widget-id'];
		$widget = explode( '-', $widget_raw_id );
		$widget_id_base = $widget[0];
		$widget_id = $widget[1];

		if ( isset( $_POST['delete_widget'] ) AND in_array( $widget_id_base, $GLOBALS['acf_widget_types'] ) ) {

			if ( (int) $_POST['delete_widget'] === 1 ) {

				// Get widget by raw id
				$option_name = $wp_registered_widgets[ $widget_raw_id ]['callback'][0]->option_name;
				$key = $wp_registered_widgets[ $widget_raw_id ]['params'][0]['number'];
				$widget_data = get_option( $option_name );
				$output = (object) $widget_data[ $key ];

				// Empty ACF fields
				if ( isset( $output['fields'] ) ) {

					foreach ( $output['fields'] as $key => $value ) {

						$output['fields'][ $key ] = $value;
						update_field( $key, '', 'widget_' . $widget_id_base . '_' . $widget_id );

					}

				}

			}

		}

	}

}

add_action( 'sidebar_admin_setup', 'observe_deleted_widgets' );
