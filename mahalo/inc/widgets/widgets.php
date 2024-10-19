<?php
/**
 * Widget FUnctions.
 *
 * @package Mahalo
 */
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mahalo_widgets_init(){

    $mahalo_default = mahalo_get_default_theme_options();

    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'mahalo'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'mahalo'),
        'before_widget' => '<div id="%1$s" class="widget sidebar-widget theme-bg-1 theme-widget-default %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<header class="theme-widget-header"><h3 class="widget-title">',
        'after_title' => '</h3></header>',
    ));

    register_sidebar( array(
        'name' => esc_html__('Offcanvas Widget', 'mahalo'),
        'id' => 'mahalo-offcanvas-widget',
        'description' => esc_html__('Add widgets here.', 'mahalo'),
        'before_widget' => '<div id="%1$s" class="widget theme-widget-default %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<header class="theme-widget-header"><h3 class="widget-title">',
        'after_title' => '</h3></header>',
    ));

    $twp_mahalo_home_sections_1 = get_theme_mod('twp_mahalo_home_sections_1', json_encode($mahalo_default['twp_mahalo_home_sections_1']));
    $twp_mahalo_home_sections_1 = json_decode($twp_mahalo_home_sections_1);

    foreach( $twp_mahalo_home_sections_1 as $mahalo_home_section ){

        $home_section_type = isset( $mahalo_home_section->home_section_type ) ? $mahalo_home_section->home_section_type : '';

        switch( $home_section_type ){

            case 'home-widget-area':

                $ed_home_widget_area = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';

                if( $ed_home_widget_area == 'yes' ){

                    register_sidebar(array(
                        'name' => esc_html__('Front Page Widget Area', 'mahalo'),
                        'id' => 'front-page-widget-area-1',
                        'description' => esc_html__('Add widgets here.', 'mahalo'),
                        'before_widget' => '<div id="%1$s" class="widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<header class="theme-widget-header"><h3 class="widget-title">',
                        'after_title' => '</h3></header>',
                    ));

                }

                break;

            default:

                break;

        }

    }

    $mahalo_default = mahalo_get_default_theme_options();
    $footer_column_layout = absint(get_theme_mod('footer_column_layout', $mahalo_default['footer_column_layout']));

    for( $i = 0; $i < $footer_column_layout; $i++ ){

        if ($i == 0) {
            $count = esc_html__('One', 'mahalo');
        }
        if ($i == 1) {
            $count = esc_html__('Two', 'mahalo');
        }
        if ($i == 2) {
            $count = esc_html__('Three', 'mahalo');
        }
        if ($i == 3) {
            $count = esc_html__('Four', 'mahalo');
        }

        register_sidebar(array(
            'name' => esc_html__('Footer Widget ', 'mahalo') . $count,
            'id' => 'mahalo-footer-widget-' . $i,
            'description' => esc_html__('Add widgets here.', 'mahalo'),
            'before_widget' => '<div id="%1$s" class="widget theme-widget-default %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<header class="theme-widget-header"><h3 class="widget-title">',
            'after_title' => '</h3></header>',
        ));

    }

}

add_action('widgets_init', 'mahalo_widgets_init');
require get_template_directory() . '/inc/widgets/widget-base.php';
require get_template_directory() . '/inc/widgets/author.php';
require get_template_directory() . '/inc/widgets/home-page-widget.php';
require get_template_directory() . '/inc/widgets/home-page-carousel-widget.php';
require get_template_directory() . '/inc/widgets/home-page-banner-slider-widget.php';
require get_template_directory() . '/inc/widgets/social-link.php';
require get_template_directory() . '/inc/widgets/featured-category-widget.php';
require get_template_directory() . '/inc/widgets/home-page-double-cat-widget.php';
require get_template_directory() . '/inc/widgets/home-page-youtube-video.php';
require get_template_directory() . '/inc/widgets/tab-posts.php';
