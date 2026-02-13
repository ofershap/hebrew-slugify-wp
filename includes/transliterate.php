<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function hebrew_slugify_get_map(): array {
	return array(
		'א' => 'a',
		'ב' => 'b',
		'ג' => 'g',
		'ד' => 'd',
		'ה' => 'h',
		'ו' => 'v',
		'ז' => 'z',
		'ח' => 'ch',
		'ט' => 't',
		'י' => 'y',
		'כ' => 'k',
		'ך' => 'k',
		'ל' => 'l',
		'מ' => 'm',
		'ם' => 'm',
		'נ' => 'n',
		'ן' => 'n',
		'ס' => 's',
		'ע' => 'a',
		'פ' => 'p',
		'ף' => 'p',
		'צ' => 'ts',
		'ץ' => 'ts',
		'ק' => 'k',
		'ר' => 'r',
		'ש' => 'sh',
		'ת' => 't',
	);
}

function hebrew_slugify_strip_niqqud( string $text ): string {
	return preg_replace( '/[\x{0591}-\x{05C7}]/u', '', $text );
}

function hebrew_slugify_transliterate( string $text ): string {
	$map = hebrew_slugify_get_map();
	$result = '';
	$chars = preg_split( '//u', $text, -1, PREG_SPLIT_NO_EMPTY );

	foreach ( $chars as $char ) {
		$result .= $map[ $char ] ?? $char;
	}

	return $result;
}

function hebrew_slugify_process( string $text, bool $should_transliterate = true ): string {
	$slug = hebrew_slugify_strip_niqqud( trim( $text ) );

	if ( $should_transliterate ) {
		$slug = hebrew_slugify_transliterate( $slug );
	}

	$slug = mb_strtolower( $slug, 'UTF-8' );

	$slug = remove_accents( $slug );

	$slug = preg_replace( '/[^a-z0-9\p{L}]+/u', '-', $slug );

	$slug = trim( $slug, '-' );

	return $slug;
}
