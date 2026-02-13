<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function hebrew_slugify_register_settings(): void {
	register_setting( 'hebrew_slugify', 'hebrew_slugify_options', array(
		'type'              => 'array',
		'sanitize_callback' => 'hebrew_slugify_sanitize_options',
		'default'           => array(
			'enabled'       => true,
			'transliterate' => true,
		),
	) );

	add_settings_section(
		'hebrew_slugify_main',
		__( 'Hebrew Slugify Settings', 'hebrew-slugify' ),
		'__return_null',
		'hebrew_slugify'
	);

	add_settings_field(
		'hebrew_slugify_enabled',
		__( 'Enable', 'hebrew-slugify' ),
		'hebrew_slugify_render_enabled_field',
		'hebrew_slugify',
		'hebrew_slugify_main'
	);

	add_settings_field(
		'hebrew_slugify_transliterate',
		__( 'Transliterate', 'hebrew-slugify' ),
		'hebrew_slugify_render_transliterate_field',
		'hebrew_slugify',
		'hebrew_slugify_main'
	);
}

add_action( 'admin_init', 'hebrew_slugify_register_settings' );

function hebrew_slugify_sanitize_options( $input ): array {
	return array(
		'enabled'       => ! empty( $input['enabled'] ),
		'transliterate' => ! empty( $input['transliterate'] ),
	);
}

function hebrew_slugify_render_enabled_field(): void {
	$options = get_option( 'hebrew_slugify_options', array( 'enabled' => true ) );
	$checked = ! empty( $options['enabled'] ) ? 'checked' : '';
	echo '<label><input type="checkbox" name="hebrew_slugify_options[enabled]" value="1" ' . $checked . ' /> '
		. esc_html__( 'Automatically transliterate Hebrew slugs', 'hebrew-slugify' ) . '</label>';
}

function hebrew_slugify_render_transliterate_field(): void {
	$options = get_option( 'hebrew_slugify_options', array( 'transliterate' => true ) );
	$checked = ! empty( $options['transliterate'] ) ? 'checked' : '';
	echo '<label><input type="checkbox" name="hebrew_slugify_options[transliterate]" value="1" ' . $checked . ' /> '
		. esc_html__( 'Convert Hebrew letters to Latin characters (uncheck to keep Hebrew in URLs)', 'hebrew-slugify' ) . '</label>';
}

function hebrew_slugify_add_settings_page(): void {
	add_options_page(
		__( 'Hebrew Slugify', 'hebrew-slugify' ),
		__( 'Hebrew Slugify', 'hebrew-slugify' ),
		'manage_options',
		'hebrew-slugify',
		'hebrew_slugify_render_settings_page'
	);
}

add_action( 'admin_menu', 'hebrew_slugify_add_settings_page' );

function hebrew_slugify_render_settings_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'hebrew_slugify' );
			do_settings_sections( 'hebrew_slugify' );
			submit_button();
			?>
		</form>
		<hr />
		<h2><?php esc_html_e( 'Preview', 'hebrew-slugify' ); ?></h2>
		<p><?php esc_html_e( 'Test how your Hebrew text will be slugified:', 'hebrew-slugify' ); ?></p>
		<p>
			<input type="text" id="hebrew-slugify-preview-input" placeholder="שלום עולם" style="width: 300px;" dir="rtl" />
			<span id="hebrew-slugify-preview-output" style="margin-left: 10px; font-family: monospace; color: #2271b1;"></span>
		</p>
		<script>
		(function() {
			var input = document.getElementById('hebrew-slugify-preview-input');
			var output = document.getElementById('hebrew-slugify-preview-output');
			var map = <?php echo wp_json_encode( hebrew_slugify_get_map() ); ?>;

			function slugify(text) {
				text = text.replace(/[\u0591-\u05C7]/g, '');
				var result = '';
				for (var i = 0; i < text.length; i++) {
					var char = text[i];
					result += map[char] || char;
				}
				result = result.toLowerCase();
				result = result.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
				result = result.replace(/[^a-z0-9\u00C0-\u024F]+/gi, '-').replace(/^-|-$/g, '');
				return result;
			}

			input.addEventListener('input', function() {
				var val = this.value.trim();
				output.textContent = val ? '→ ' + slugify(val) : '';
			});
		})();
		</script>
	</div>
	<?php
}

function hebrew_slugify_settings_link( array $links ): array {
	$url = admin_url( 'options-general.php?page=hebrew-slugify' );
	array_unshift( $links, '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Settings', 'hebrew-slugify' ) . '</a>' );
	return $links;
}

add_filter( 'plugin_action_links_' . plugin_basename( HEBREW_SLUGIFY_FILE ), 'hebrew_slugify_settings_link' );
