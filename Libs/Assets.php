<?php
namespace JLTADMINBAR\Libs;

// No, Direct access Sir !!!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Assets' ) ) {

	/**
	 * Assets Class
	 *
	 * Jewel Theme <support@jeweltheme.com>
	 * @version     1.0.2
	 */
	class Assets {

		/**
		 * Constructor method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function __construct() {
			add_action( 'admin_enqueue_scripts', array( $this, 'jltadminbar_admin_enqueue_scripts' ), 100 );
		}


		/**
		 * Get environment mode
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function get_mode() {
			return defined( 'WP_DEBUG' ) && WP_DEBUG ? 'development' : 'production';
		}


		/**
		 * Enqueue Scripts
		 *
		 * @method admin_enqueue_scripts()
		 */
		public function jltadminbar_admin_enqueue_scripts() {
			// JS Files .
			wp_enqueue_script( 'admin-bar-admin', JLTADMINBAR_ASSETS . 'js/admin-bar-admin.js', array( 'jquery-form' ), JLTADMINBAR_VER, true );
			wp_localize_script(
				'admin-bar-admin',
				'JLTADMINBARCORE',
				array(
					'admin_ajax'       => admin_url( 'admin-ajax.php' ),
					'security'         => wp_create_nonce('admin_bar_security_nonce')
				)
			);
		}
	}
}
