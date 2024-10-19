<?php
/**
 * Mahalo Dynamic Styles
 *
 * @package Mahalo
 */

function mahalo_dynamic_css()
{

    $mahalo_default = mahalo_get_default_theme_options();
    $logo_width_range = get_theme_mod('logo_width_range', $mahalo_default['logo_width_range']);

    $background_color = get_theme_mod('background_color');
    $site_title_font_size = get_theme_mod('site_title_font_size', $mahalo_default['site_title_font_size']);
    
    $mahalo_bg_text_color = get_theme_mod('mahalo_bg_text_color', $mahalo_default['mahalo_bg_text_color']);


    echo "<style type='text/css' media='all'>"; ?>

    .site-logo .custom-logo-link{
    max-width:  <?php echo esc_attr($logo_width_range); ?>px;
    }

    @media (min-width: 1200px) {
        .header-titles .custom-logo-name{
        font-size: <?php echo esc_attr($site_title_font_size); ?>px;
        }
    }

    .custom-background .theme-block .theme-block-title .block-title,
    .custom-background .widget .widget-title,
    .custom-background .sidr,
    .custom-background .theme-ticker-area,
    .custom-background .header-searchbar-inner,
    .custom-background .offcanvas-wraper,
    .custom-background .booster-block .be-author-details .be-author-wrapper,
    .custom-background .theme-block .theme-block-title .block-title,
    .custom-background .widget .widget-title{
    background-color: #<?php echo esc_attr($background_color); ?>;
    }

    body, input, select, optgroup, textarea{
    color: <?php echo esc_attr($mahalo_bg_text_color); ?>;
    }
    <?php echo "</style>";
}

add_action('wp_head', 'mahalo_dynamic_css', 100);

/**
 * Sanitizing Hex color function.
 */
function mahalo_sanitize_hex_color($color)
{

    if ('' === $color)
        return '';
    if (preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color))
        return $color;

}