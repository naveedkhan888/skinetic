<?php
// === Post Demo Import Actions for Soo Demo Importer ===

add_action('admin_init', 'my_theme_post_import_setup');
function my_theme_post_import_setup() {
    // Check if our post-import flag is set
    if (get_option('my_theme_after_import_done') !== 'yes') {
        return;
    }

    // Check if Elementor is loaded
    if ( did_action('elementor/loaded') ) {
        // ✅ Enable Font Awesome icons in Elementor settings
        update_option('elementor_enable_fa4_support', 'yes');

        // ✅ Regenerate Elementor CSS files
        \Elementor\Plugin::instance()->files_manager->clear_cache();
    }

    // ✅ (Optional) Flush WordPress rewrite rules
    flush_rewrite_rules();

    // ✅ Clean up: remove the flag so this runs only once
    delete_option('my_theme_after_import_done');
}

// === Set the flag after Soo Demo Import ===
// NOTE: Call this only when import is successful
// You can put this at the end of import or call manually one time
// update_option('my_theme_after_import_done', 'yes');
