<?php
/**
 * Default Values.
 *
 * @package Mahalo
 */

if (!function_exists('mahalo_get_default_theme_options')) :

    /**
     * Get default theme options
     *
     * @return array Default theme options.
     * @since 1.0.0
     *
     */
    function mahalo_get_default_theme_options(){

        $mahalo_defaults = array();

        $mahalo_defaults['twp_mahalo_home_sections_1'] = array(
            array(
                'home_section_type' => 'default-banner-area',
                'section_ed' => 'yes',
                'home_section_title_5' => esc_html__('Main Highlights','mahalo'),
                'section_post_cat_1' => '',
                'ed_arrows_carousel' => 'yes',
                'ed_dots_carousel' => 'no',
                'section_category_3' => '',
                'section_category_7' => '',
            ),
            array(
                'home_section_type' => 'must-read',
                'section_ed' => 'yes',
                'home_section_must_read' => esc_html__('Must Read','mahalo'),
                'section_category_5' => '',
            ),
            array(
                'home_section_type' => 'tiles-blocks',
                'section_ed' => 'no',
                'section_category_tile_slider' => '',
                'section_category' => '',
                'ed_arrows_carousel' => 'yes',
            ),
            array(
                'home_section_type' => 'fullwidth-banner-slider',
                'section_ed' => 'no',
                'section_post_cat_1' => '',
                'section_post_number' => 3,
            ),
            array(
                'home_section_type' => 'main-banner',
                'section_ed' => 'no',
                'home_section_main_title' => esc_html__('Top Stories','mahalo'),
                'section_post_cat_1' => '',
                'section_post_number' => 4,
            ),


            array(
                'home_section_type' => 'banner-blocks-1',
                'section_ed' => 'no',
                'home_section_title_1' => esc_html__('Block Title One','mahalo'),
                'section_category_1' => '',
                'section_category_2' => '',
                'ed_flip_column' => 'no',
                'ed_tab' => 'no',
                'ed_dots_carousel' => 'no',
                'ed_autoplay_carousel' => 'yes',
            ),
            array(
                'home_section_type' => 'latest-posts-blocks',
                'section_ed' => 'yes',
            ),
            array(
                'home_section_type' => 'advertise-blocks',
                'section_ed' => 'no',
                'advertise_image' => '',
                'advertise_link' => '',
            ),
            array(
                'home_section_type' => 'home-widget-area',
                'section_ed' => 'yes',
            ),
            array(
                'home_section_type' => 'you-may-like-blocks',
                'section_ed' => 'yes',
                'home_section_title' => esc_html__('You May Also Like','mahalo'),
                'section_category' => '',
            ),
        );

        // header section
        $mahalo_defaults['logo_width_range']      = 300;
        $mahalo_defaults['site_title_font_size']  = 62;
        $mahalo_defaults['site_title_add_layout']  = 'primary-layout';

        // Options.
        $mahalo_defaults['global_sidebar_layout'] = 'right-sidebar';
        $mahalo_defaults['mahalo_archive_layout'] = 'grid';
        $mahalo_defaults['mahalo_pagination_layout'] = 'numeric';
        $mahalo_defaults['footer_column_layout'] = 3;
        $mahalo_defaults['footer_copyright_text'] = esc_html__('All rights reserved.', 'mahalo');
        $mahalo_defaults['ed_header_trending_news'] = 1;
        $mahalo_defaults['ed_header_ad'] = 0;
        $mahalo_defaults['ed_header_type'] = 'twp-img-boxed-header';
        $mahalo_defaults['addvertisement_section_title'] = esc_html__('Advertisement Section', 'mahalo');
        $mahalo_defaults['ed_middle_header_ad'] = 1;

        $mahalo_defaults['show_preloader'] = 0;

        $mahalo_defaults['ed_header_ticker_posts'] = 1;
        $mahalo_defaults['ticker_date_format'] = 'l, F jS, Y';
        $mahalo_defaults['ed_header_ticker_posts_title'] = esc_html__('Breaking News', 'mahalo');
        $mahalo_defaults['ed_image_content_inverse'] = 0;
        $mahalo_defaults['ed_related_post'] = 1;
        $mahalo_defaults['related_post_title'] = esc_html__('More Stories', 'mahalo');
        $mahalo_defaults['ed_header_day_light_mode'] = 1;
        $mahalo_defaults['twp_navigation_type'] = 'norma-navigation';
        $mahalo_defaults['mahalo_single_post_layout'] = 'layout-1';
        $mahalo_defaults['ed_post_thumbnail'] = 0;
        $mahalo_defaults['ed_post_date'] = 1;
        $mahalo_defaults['ed_post_category'] = 1;
        $mahalo_defaults['ed_header_overlay'] = 0;
        $mahalo_defaults['ed_floating_next_previous_nav'] = 1;       
        $mahalo_defaults['mahalo_header_bg_size'] = 2;
        $mahalo_defaults['ed_header_bg_fixed'] = 0;
        $mahalo_defaults['ed_header_bg_overlay'] = 0;
        $mahalo_defaults['post_date_format'] = 'default';
        $mahalo_defaults['ed_fullwidth_layout'] = 'default';
        $mahalo_defaults['ed_post_views'] = 0;
        $mahalo_defaults['ed_scroll_top_button'] = 1;
        
        $mahalo_defaults['mahalo_bg_text_color'] = '#404040';

        $mahalo_defaults['ed_top_bar']                  = 1;
        $mahalo_defaults['ed_top_bar_date']             = 1;
        $mahalo_defaults['ed_top_bar_time']             = 1;
        $mahalo_defaults['ed_tags_wide_layout']            = 1;
        $mahalo_defaults['ed_post_tags']                   = 1;
        $mahalo_defaults['ed_post_read_later']             = 1;
        $mahalo_defaults['ed_top_bar_social_nav']       = 1;

        // Pass through filter.
        $mahalo_defaults = apply_filters('mahalo_filter_default_theme_options', $mahalo_defaults);

        return $mahalo_defaults;

    }

endif;
