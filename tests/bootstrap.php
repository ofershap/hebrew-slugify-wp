<?php

define( 'ABSPATH', '/tmp/' );

if ( ! function_exists( 'remove_accents' ) ) {
	function remove_accents( string $string ): string {
		if ( ! preg_match( '/[\x80-\xff]/', $string ) ) {
			return $string;
		}
		$string = strtr( $string, array(
			'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
			'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
			'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
			'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o',
			'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
			'ñ' => 'n', 'ç' => 'c',
		) );
		return $string;
	}
}

require_once __DIR__ . '/../includes/transliterate.php';
