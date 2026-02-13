# hebrew-slugify-wp

[![CI](https://github.com/ofershap/hebrew-slugify-wp/actions/workflows/ci.yml/badge.svg)](https://github.com/ofershap/hebrew-slugify-wp/actions/workflows/ci.yml)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)](https://www.php.net/)
[![WordPress](https://img.shields.io/badge/WordPress-5.0%2B-21759b.svg)](https://wordpress.org/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Automatically transliterate Hebrew post and page titles into clean, URL-safe slugs. Works with Gutenberg, Elementor, WooCommerce, and any theme.

```
Before: /שלום-עולם/  →  /%D7%A9%D7%9C%D7%95%D7%9D-%D7%A2%D7%95%D7%9C%D7%9D/
After:  /shlvm-avlm/
```

> WordPress plugin that converts Hebrew titles to transliterated URL slugs. Strips niqqud, handles mixed Hebrew + English + numbers. Zero dependencies. Settings page with live preview.

## Install

**Option A — Upload:**

1. Download the [latest release](https://github.com/ofershap/hebrew-slugify-wp/releases)
2. Go to Plugins → Add New → Upload Plugin
3. Upload the zip and activate

**Option B — Manual:**

1. Clone or download this repo into `/wp-content/plugins/hebrew-slugify/`
2. Activate through the Plugins menu

## How It Works

The plugin hooks into WordPress's `sanitize_title` filter (priority 5, before WP's default processing). When you create or update a post, page, or product, it:

1. Strips niqqud (vowel marks) — `שָׁלוֹם` → `שלום`
2. Transliterates Hebrew letters to Latin — `שלום` → `shlvm`
3. Lowercases and slugifies — `shlvm avlm` → `shlvm-avlm`

Existing slugs are **never** modified. Only new posts get transliterated slugs.

## Settings

Go to **Settings → Hebrew Slugify** to configure:

| Setting | Default | Description |
|---------|---------|-------------|
| Enable | ✅ On | Toggle the plugin on/off without deactivating |
| Transliterate | ✅ On | Convert Hebrew to Latin characters. Uncheck to keep Hebrew in URLs |

The settings page includes a **live preview** — type Hebrew text and see the slug in real time.

## Transliteration Table

| Letter | Transliteration | Letter | Transliteration |
|--------|----------------|--------|----------------|
| א      | a              | מ ם    | m              |
| ב      | b              | נ ן    | n              |
| ג      | g              | ס      | s              |
| ד      | d              | ע      | a              |
| ה      | h              | פ ף    | p              |
| ו      | v              | צ ץ    | ts             |
| ז      | z              | ק      | k              |
| ח      | ch             | ר      | r              |
| ט      | t              | ש      | sh             |
| י      | y              | ת      | t              |
| כ ך    | k              | ל      | l              |

## Compatibility

- **WordPress** 5.0+
- **PHP** 7.4+
- **Editors:** Gutenberg, Classic Editor, Elementor, Divi, WPBakery
- **Plugins:** WooCommerce, Yoast SEO, Rank Math, WPML
- **Themes:** Any

## Looking for a JavaScript/Node.js version?

This plugin is a PHP port of [**hebrew-slugify**](https://github.com/ofershap/hebrew-slugify) — the same transliteration logic available as an npm package for Node.js, React, and frontend projects.

```bash
npm install hebrew-slugify
```

```ts
import { hebrewSlugify } from "hebrew-slugify";
hebrewSlugify("שלום עולם"); // → "shlvm-avlm"
```

## Development

```bash
composer install
vendor/bin/phpunit --testdox
```

21 tests covering all Hebrew letters, niqqud stripping, mixed text, edge cases.

## License

[MIT](LICENSE) &copy; [Ofer Shapira](https://github.com/ofershap)
