<?php

class ACF_Widget_Plugin
{
	public $metabox_ids = array();

	function __construct() {

		// Hook ACF JS and CSS to widget page
		add_action( 'sidebar_admin_setup', array( $this, 'admin_load' ) );
	
	}

	function admin_load() {

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_head', array( $this, 'admin_head' ) );
		add_action( 'admin_footer', array( $this, 'admin_footer' ) );
	
	}

	function admin_enqueue_scripts() {
		
		do_action( 'acf/input/admin_enqueue_scripts' );

	}

	function admin_head() {

		if ( isset( $_POST['acf_nonce'] ) AND wp_verify_nonce( $_POST['acf_nonce'], 'input' ) ) {

			do_action( 'acf/save_post', 'options' );

			$this->data['admin_message'] = __( 'Widget Updated', 'acf_widget' );
		
		}

		// Styles
		echo '<style type="text/css">#side-sortables.empty-container { border: 0 none; }</style>';

		// Add JS and CSS
		do_action( 'acf/input/admin_head' );

	}

	function admin_footer() {

		// Add toggle open / close postbox
		?>
		<script type="text/javascript">
			( function( $ ) {

				$('.postbox .handlediv').live( 'click', function() {
					
					var postbox = $( this ).closest( '.postbox' );

					if ( postbox.hasClass( 'closed' ) ) {

						postbox.removeClass( 'closed' );
					
					} else {
						
						postbox.addClass( 'closed' );
					
					}
				} );
			} )( jQuery );
		</script>
		<?php
	}
}
