<?php
/**
 * Plugin Name: Admin Bar Remover
 * Plugin URI:  https://jeweltheme.com/
 * Description: Enable or disable admin bar in frontend WordPress
 * Version:     1.0.2
 * Author:      Jewel Theme
 * Author URI:  https://jeweltheme.com
 * Text Domain: admin-bar
 * Domain Path: languages/
 * License:     GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package admin-bar
 */

/*
 * don't call the file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	wp_die( esc_html__( 'You can\'t access this page', 'admin-bar' ) );
}

$jltadminbar_plugin_data = get_file_data(
	__FILE__,
	array(
		'Version'     => 'Version',
		'Plugin Name' => 'Plugin Name',
		'Author'      => 'Author',
		'Description' => 'Description',
		'Plugin URI'  => 'Plugin URI',
	),
	false
);

// Define Constants.
if ( ! defined( 'JLTADMINBAR' ) ) {
	define( 'JLTADMINBAR', $jltadminbar_plugin_data['Plugin Name'] );
}

if ( ! defined( 'JLTADMINBAR_VER' ) ) {
	define( 'JLTADMINBAR_VER', $jltadminbar_plugin_data['Version'] );
}

if ( ! defined( 'JLTADMINBAR_AUTHOR' ) ) {
	define( 'JLTADMINBAR_AUTHOR', $jltadminbar_plugin_data['Author'] );
}

if ( ! defined( 'JLTADMINBAR_DESC' ) ) {
	define( 'JLTADMINBAR_DESC', $jltadminbar_plugin_data['Author'] );
}

if ( ! defined( 'JLTADMINBAR_URI' ) ) {
	define( 'JLTADMINBAR_URI', $jltadminbar_plugin_data['Plugin URI'] );
}

if ( ! defined( 'JLTADMINBAR_DIR' ) ) {
	define( 'JLTADMINBAR_DIR', __DIR__ );
}

if ( ! defined( 'JLTADMINBAR_FILE' ) ) {
	define( 'JLTADMINBAR_FILE', __FILE__ );
}

if ( ! defined( 'JLTADMINBAR_SLUG' ) ) {
	define( 'JLTADMINBAR_SLUG', dirname( plugin_basename( __FILE__ ) ) );
}

if ( ! defined( 'JLTADMINBAR_BASE' ) ) {
	define( 'JLTADMINBAR_BASE', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'JLTADMINBAR_PATH' ) ) {
	define( 'JLTADMINBAR_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
}

if ( ! defined( 'JLTADMINBAR_URL' ) ) {
	define( 'JLTADMINBAR_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
}

if ( ! defined( 'JLTADMINBAR_INC' ) ) {
	define( 'JLTADMINBAR_INC', JLTADMINBAR_PATH . '/Inc/' );
}

if ( ! defined( 'JLTADMINBAR_LIBS' ) ) {
	define( 'JLTADMINBAR_LIBS', JLTADMINBAR_PATH . 'Libs' );
}

if ( ! defined( 'JLTADMINBAR_ASSETS' ) ) {
	define( 'JLTADMINBAR_ASSETS', JLTADMINBAR_URL . 'assets/' );
}

if ( ! defined( 'JLTADMINBAR_IMAGES' ) ) {
	define( 'JLTADMINBAR_IMAGES', JLTADMINBAR_ASSETS . 'images' );
}

if ( ! class_exists( '\\JLTADMINBAR\\JLT_Admin_Bar_Remover' ) ) {
	// Autoload Files.
	include_once JLTADMINBAR_DIR . '/vendor/autoload.php';
	// Instantiate JLT_Admin_Bar_Remover Class.
	include_once JLTADMINBAR_DIR . '/class-admin-bar.php';
}
