<?php
/**
 * Plugin Name: Admin Bar
 * Plugin URI:  https://github.com/litonarefin/admin-bar
 * Description: Enable or disable Frontend Admin Bar in WordPress
 * Version:     1.0.1
 * Author:      Liton Arefin
 * Author URI:  https://github.com/litonarefin/admin-bar
 * Text Domain: admin-bar
 * Domain Path: /languages/
 * License: GPLv3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

// No, Direct access Sir !!!
if (!defined('ABSPATH')) exit;

if (!class_exists('JltAdminBarRemover')) {
    require_once dirname(__FILE__) . '/class-admin-bar.php';
}
