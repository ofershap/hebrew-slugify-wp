=== Hebrew Slugify ===
Contributors: ofershap
Tags: hebrew, slug, transliteration, seo, rtl, israel, permalinks, url
Requires at least: 5.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 1.0.0
License: MIT
License URI: https://opensource.org/licenses/MIT

Automatically transliterate Hebrew post and page titles into clean, URL-safe slugs.

== Description ==

Hebrew Slugify automatically converts Hebrew text in your post/page titles into clean, transliterated URL slugs.

Instead of ugly percent-encoded URLs like `/%D7%A9%D7%9C%D7%95%D7%9D/`, your posts get clean slugs like `/shlvm-avlm/`.

**Features:**

* Transliterates all 27 Hebrew letters (including final forms) to Latin characters
* Strips niqqud (vowel marks) automatically
* Handles mixed Hebrew + English + numbers
* Strips accented Latin characters (café → cafe)
* Works automatically — no manual slug editing needed
* Settings page with live preview
* Zero external dependencies
* Works with any theme and page builder (Elementor, Gutenberg, etc.)

**Looking for a JavaScript/TypeScript version?** Check out [hebrew-slugify on npm](https://www.npmjs.com/package/hebrew-slugify) — same transliteration logic for Node.js, React, and frontend projects.

== Installation ==

1. Upload the `hebrew-slugify` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. (Optional) Go to Settings → Hebrew Slugify to configure

The plugin works automatically once activated. New posts and pages will get transliterated slugs.

== Frequently Asked Questions ==

= Does this change existing slugs? =

No. The plugin only affects new posts/pages when their slug is first generated. Existing permalinks are not modified.

= Can I keep Hebrew characters in URLs instead of transliterating? =

Yes. Go to Settings → Hebrew Slugify and uncheck "Transliterate" to keep Hebrew characters in your slugs.

= Does it work with Elementor? =

Yes. The plugin hooks into WordPress core slug generation, so it works with any editor or page builder.

= Does it work with WooCommerce? =

Yes. Product slugs are generated through the same WordPress core function.

= What transliteration scheme does it use? =

A simplified phonetic mapping optimized for URL readability. See the full transliteration table in the [GitHub README](https://github.com/ofershap/hebrew-slugify-wp#transliteration-table).

== Screenshots ==

1. Settings page with live preview
2. Before and after — Hebrew title automatically gets a clean slug

== Changelog ==

= 1.0.0 =
* Initial release
* Hebrew to Latin transliteration for post/page slugs
* Niqqud (vowel marks) stripping
* Mixed Hebrew + English + numbers support
* Settings page with live preview
* Transliteration toggle option
