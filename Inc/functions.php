<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @version       1.0.0
 * @package       JLT_Admin_Bar_Remover
 * @license       Copyright JLT_Admin_Bar_Remover
 */

if ( ! function_exists( 'jltadminbar_option' ) ) {
	/**
	 * Get setting database option
	 *
	 * @param string $section default section name jltadminbar_general .
	 * @param string $key .
	 * @param string $default .
	 *
	 * @return string
	 */
	function jltadminbar_option( $section = 'jltadminbar_general', $key = '', $default = '' ) {
		$settings = get_option( $section );

		return isset( $settings[ $key ] ) ? $settings[ $key ] : $default;
	}
}

if ( ! function_exists( 'jltadminbar_exclude_pages' ) ) {
	/**
	 * Get exclude pages setting option data
	 *
	 * @return string|array
	 *
	 * @version 1.0.0
	 */
	function jltadminbar_exclude_pages() {
		return jltadminbar_option( 'jltadminbar_triggers', 'exclude_pages', array() );
	}
}

if ( ! function_exists( 'jltadminbar_exclude_pages' ) ) {
	/**
	 * Get exclude pages except setting option data
	 *
	 * @return string|array
	 *
	 * @version 1.0.0
	 */
	function jltadminbar_exclude_pages_except() {
		return jltadminbar_option( 'jltadminbar_triggers', 'exclude_pages_except', array() );
	}
}