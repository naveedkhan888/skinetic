<?php
// Include widget files for Elementor widgets
locate_template('/inc/backend/elementor/widgets/header/logo.php', true, true);
locate_template('/inc/backend/elementor/widgets/header/menu.php', true, true);
locate_template('/inc/backend/elementor/widgets/header/vertical_menu.php', true, true);
locate_template('/inc/backend/elementor/widgets/header/search.php', true, true);
locate_template('/inc/backend/elementor/widgets/header/side-panel.php', true, true);
locate_template('/inc/backend/elementor/widgets/header/menu-mobile.php', true, true);
if ( class_exists( 'woocommerce' ) ) {
    locate_template('/inc/backend/elementor/widgets/header/cart.php', true, true);
}