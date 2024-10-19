<?php
/**
 * Header Layout 2
 *
 * @package Mahalo
 */
use mahalo\Mahalo_Walkernav;
$mahalo_default = mahalo_get_default_theme_options();
$mahalo_header_bg_size = get_theme_mod('mahalo_header_bg_size', $mahalo_default['mahalo_header_bg_size']);
$ed_header_bg_fixed = get_theme_mod('ed_header_bg_fixed', $mahalo_default['ed_header_bg_fixed']);
$site_title_add_layout = get_theme_mod('site_title_add_layout', $mahalo_default['site_title_add_layout']);
$ed_header_bg_overlay = get_theme_mod('ed_header_bg_overlay', $mahalo_default['ed_header_bg_overlay']); ?>
<header id="site-header" class="theme-header <?php if ($ed_header_bg_overlay) { echo 'header-overlay-enabled'; } ?>" role="banner">
    <?php mahalo_theme_navextras(); ?>
    <div class="header-mainbar <?php if (get_header_image()) {
        if ($ed_header_bg_fixed) {
            echo 'data-bg-fixed';
        } ?> data-bg header-bg-<?php echo esc_attr($mahalo_header_bg_size); ?> <?php } ?> " <?php if (get_header_image()) { ?> data-background="<?php echo esc_url(get_header_image()); ?>" <?php } ?>>
        <div class="wrapper-fluid header-wrapper <?php if ($site_title_add_layout == 'primary-layout') {
            echo 'header-promo-layout_1';
        } else {
            echo 'header-promo-layout_2';
        } ?>">
            <div class="header-item <?php if ($site_title_add_layout == 'primary-layout') {
                echo 'header-item-center';
            } else {
                echo 'header-item-left';
            } ?>">
                <div class="header-titles">
                    <?php
                    mahalo_site_logo();
                    mahalo_site_description();
                    ?>
                </div>
            </div>
            <?php mahalo_aside_branding_ad(); ?>
        </div>
    </div>
    <div id="theme-navigation" class="header-navbar">
        <div class="wrapper-fluid header-wrapper">
            <div class="header-item header-item-left">
                <?php if (is_active_sidebar('mahalo-offcanvas-widget')): ?>
                    <div id="widgets-nav" class="icon-sidr">
                        <button id="hamburger-one" class="navbar-control">
                            <span class="navbar-control-trigger" tabindex="-1">
                                <span class="hamburger-wrapper">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </span>
                        </button>
                    </div>
                <?php endif; ?>
                <div class="site-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'mahalo'); ?>" role="navigation">
                        <ul class="primary-menu theme-menu">
                            <?php
                            if (has_nav_menu('mahalo-primary-menu')) {
                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'mahalo-primary-menu',
                                        'walker' => new mahalo\Mahalo_Walkernav(),
                                    )
                                );
                            } else {
                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => true,
                                        'title_li' => false,
                                        'walker' => new Mahalo_Walker_Page(),
                                    )
                                );
                            } ?>
                        </ul>

                    </nav>
                </div>
            </div>
            <div class="header-item header-item-right">
                <?php main_navigation_extras(); ?>
            </div>
        </div>
        <?php mahalo_content_trending_news_render(); ?>
    </div>
</header>

<?php
if( is_home() || is_front_page() ){
    mahalo_header_ticker_posts();
} ?>
