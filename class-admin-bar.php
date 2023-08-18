<?php
namespace JLTADMINBAR;

use JLTADMINBAR\Libs\Assets;
use JLTADMINBAR\Libs\Helper;
use JLTADMINBAR\Libs\Featured;
use JLTADMINBAR\Inc\Classes\Recommended_Plugins;
use JLTADMINBAR\Inc\Classes\Notifications\Notifications;
use JLTADMINBAR\Inc\Classes\Pro_Upgrade;
use JLTADMINBAR\Inc\Classes\Row_Links;
use JLTADMINBAR\Inc\Classes\Upgrade_Plugin;
use JLTADMINBAR\Inc\Classes\Feedback;
use JLTADMINBAR\Inc\Classes\AdminBarRemover;

/**
 * Main Class
 *
 * @admin-bar
 * Jewel Theme <support@jeweltheme.com>
 * @version     1.0.2
 */

// No, Direct access Sir !!!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * JLT_Admin_Bar_Remover Class
 */
if ( ! class_exists( '\JLTADMINBAR\JLT_Admin_Bar_Remover' ) ) {

	/**
	 * Class: JLT_Admin_Bar_Remover
	 */
	final class JLT_Admin_Bar_Remover {

		const VERSION            = JLTADMINBAR_VER;
		private static $instance = null;

		/**
		 * what we collect construct method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function __construct() {
			$this->includes();
			add_action( 'plugins_loaded', array( $this, 'jltadminbar_plugins_loaded' ), 999 );
			// Body Class.
			add_filter( 'admin_body_class', array( $this, 'jltadminbar_body_class' ) );
			// This should run earlier .
			// add_action( 'plugins_loaded', [ $this, 'jltadminbar_maybe_run_upgrades' ], -100 ); .
		}

		/**
		 * plugins_loaded method
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltadminbar_plugins_loaded() {
			$this->jltadminbar_activate();
		}

		/**
		 * Version Key
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public static function plugin_version_key() {
			return Helper::jltadminbar_slug_cleanup() . '_version';
		}

		/**
		 * Activation Hook
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public static function jltadminbar_activate() {
			$current_jltadminbar_version = get_option( self::plugin_version_key(), null );

			if ( get_option( 'jltadminbar_activation_time' ) === false ) {
				update_option( 'jltadminbar_activation_time', strtotime( 'now' ) );
			}

			if ( is_null( $current_jltadminbar_version ) ) {
				update_option( self::plugin_version_key(), self::VERSION );
			}

			$allowed = get_option( Helper::jltadminbar_slug_cleanup() . '_allow_tracking', 'no' );

			// if it wasn't allowed before, do nothing .
			if ( 'yes' !== $allowed ) {
				return;
			}
			// re-schedule and delete the last sent time so we could force send again .
			$hook_name = Helper::jltadminbar_slug_cleanup() . '_tracker_send_event';
			if ( ! wp_next_scheduled( $hook_name ) ) {
				wp_schedule_event( time(), 'weekly', $hook_name );
			}
		}


		/**
		 * Add Body Class
		 *
		 * @param [type] $classes .
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltadminbar_body_class( $classes ) {
			$classes .= ' admin-bar ';
			return $classes;
		}

		/**
		 * Run Upgrader Class
		 *
		 * @return void
		 */
		public function jltadminbar_maybe_run_upgrades() {
			if ( ! is_admin() && ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Run Upgrader .
			$upgrade = new Upgrade_Plugin();

			// Need to work on Upgrade Class .
			if ( $upgrade->if_updates_available() ) {
				$upgrade->run_updates();
			}
		}

		/**
		 * Include methods
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function includes() {
			new Assets();
			new Recommended_Plugins();
			new Row_Links();
			new Pro_Upgrade();
			new Notifications();
			new Featured();
			new Feedback();
			new AdminBarRemover();
		}


		/**
		 * Initialization
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltadminbar_init() {
			$this->jltadminbar_load_textdomain();
		}


		/**
		 * Text Domain
		 *
		 * @author Jewel Theme <support@jeweltheme.com>
		 */
		public function jltadminbar_load_textdomain() {
			$domain = 'admin-bar';
			$locale = apply_filters( 'jltadminbar_plugin_locale', get_locale(), $domain );

			load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
			load_plugin_textdomain( $domain, false, dirname( JLTADMINBAR_BASE ) . '/languages/' );
		}




		/**
		 * Returns the singleton instance of the class.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof JLT_Admin_Bar_Remover ) ) {
				self::$instance = new JLT_Admin_Bar_Remover();
				self::$instance->jltadminbar_init();
			}

			return self::$instance;
		}
	}

	// Get Instant of JLT_Admin_Bar_Remover Class .
	JLT_Admin_Bar_Remover::get_instance();
}
