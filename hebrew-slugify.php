<?php
/**
 * Plugin Name:       Hebrew Slugify
 * Plugin URI:        https://github.com/ofershap/hebrew-slugify-wp
 * Description:       Automatically transliterate Hebrew post/page titles into clean, URL-safe slugs. Strips niqqud, handles mixed Hebrew + English + numbers.
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.4
 * Author:            Ofer Shapira
 * Author URI:        https://github.com/ofershap
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       hebrew-slugify
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'HEBREW_SLUGIFY_VERSION', '1.0.0' );
define( 'HEBREW_SLUGIFY_FILE', __FILE__ );

require_once __DIR__ . '/includes/transliterate.php';
require_once __DIR__ . '/includes/settings.php';

function hebrew_slugify_sanitize_title( string $title, string $raw_title = '', string $context = 'save' ): string {
	if ( 'save' !== $context || '' === $raw_title ) {
		return $title;
	}

	$options = get_option( 'hebrew_slugify_options', array(
		'enabled'        => true,
		'transliterate'  => true,
	) );

	if ( empty( $options['enabled'] ) ) {
		return $title;
	}

	$should_transliterate = ! empty( $options['transliterate'] );

	return hebrew_slugify_process( $raw_title, $should_transliterate );
}

add_filter( 'sanitize_title', 'hebrew_slugify_sanitize_title', 5, 3 );
