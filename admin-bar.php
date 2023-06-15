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
* License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

// No, Direct access Sir !!!
if (!defined('ABSPATH')) exit;

if (!class_exists('JltAdminBarRemover')) {
    require_once dirname(__FILE__) . '/class-admin-bar.php';
}
