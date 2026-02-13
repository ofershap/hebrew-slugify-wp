<?php

class TransliterateTest extends \PHPUnit\Framework\TestCase {

	public function test_basic_hebrew(): void {
		$this->assertSame( 'shlvm-avlm', hebrew_slugify_process( 'שלום עולם' ) );
	}

	public function test_hebrew_with_numbers(): void {
		$this->assertSame( 'pvst-42-bblvg', hebrew_slugify_process( 'פוסט 42 בבלוג' ) );
	}

	public function test_mixed_hebrew_english(): void {
		$this->assertSame( 'shlvm-hello-world', hebrew_slugify_process( 'שלום Hello World' ) );
	}

	public function test_niqqud_stripping(): void {
		$this->assertSame( 'shlvm', hebrew_slugify_process( 'שָׁלוֹם' ) );
	}

	public function test_final_forms(): void {
		$this->assertSame( 'chlvm', hebrew_slugify_process( 'חלום' ) );
	}

	public function test_all_final_letters(): void {
		$this->assertSame( 'k-m-n-p-ts', hebrew_slugify_process( 'ך ם ן ף ץ' ) );
	}

	public function test_english_only(): void {
		$this->assertSame( 'hello-world', hebrew_slugify_process( 'Hello World' ) );
	}

	public function test_empty_string(): void {
		$this->assertSame( '', hebrew_slugify_process( '' ) );
	}

	public function test_whitespace_only(): void {
		$this->assertSame( '', hebrew_slugify_process( '   ' ) );
	}

	public function test_special_characters_stripped(): void {
		$this->assertSame( 'shlvm-avlm', hebrew_slugify_process( 'שלום! עולם?' ) );
	}

	public function test_consecutive_separators_collapsed(): void {
		$this->assertSame( 'a-b', hebrew_slugify_process( 'a   ---   b' ) );
	}

	public function test_no_transliteration(): void {
		$this->assertSame( 'שלום-עולם', hebrew_slugify_process( 'שלום עולם', false ) );
	}

	public function test_accented_latin_stripped(): void {
		$this->assertSame( 'cafe', hebrew_slugify_process( 'café' ) );
	}

	public function test_leading_trailing_separators_removed(): void {
		$this->assertSame( 'shlvm', hebrew_slugify_process( ' -שלום- ' ) );
	}

	public function test_numbers_preserved(): void {
		$this->assertSame( '123-456', hebrew_slugify_process( '123 456' ) );
	}

	public function test_shin_and_tav(): void {
		$this->assertSame( 'shbt', hebrew_slugify_process( 'שבת' ) );
	}

	public function test_tsadi(): void {
		$this->assertSame( 'tsdyk', hebrew_slugify_process( 'צדיק' ) );
	}

	public function test_chet(): void {
		$this->assertSame( 'chyym', hebrew_slugify_process( 'חיים' ) );
	}

	public function test_strip_niqqud_function(): void {
		$this->assertSame( 'שלום', hebrew_slugify_strip_niqqud( 'שָׁלוֹם' ) );
	}

	public function test_transliterate_function(): void {
		$this->assertSame( 'shlvm', hebrew_slugify_transliterate( 'שלום' ) );
	}

	public function test_map_has_all_letters(): void {
		$map = hebrew_slugify_get_map();
		$this->assertCount( 27, $map );
		$this->assertArrayHasKey( 'א', $map );
		$this->assertArrayHasKey( 'ת', $map );
		$this->assertArrayHasKey( 'ך', $map );
		$this->assertArrayHasKey( 'ם', $map );
		$this->assertArrayHasKey( 'ן', $map );
		$this->assertArrayHasKey( 'ף', $map );
		$this->assertArrayHasKey( 'ץ', $map );
	}
}
