<?php
/**
 *
 * Front Page
 *
 * @package Mahalo
 */

get_header();


    $mahalo_default = mahalo_get_default_theme_options();
    $mahalo_default = mahalo_get_default_theme_options();
    $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $mahalo_default['global_sidebar_layout'] ) );
    

    if( is_single() || is_page() ){

        $mahalo_post_sidebar = esc_attr( get_post_meta( $post->ID, 'mahalo_post_sidebar_option', true ) );
        if( $mahalo_post_sidebar == 'global-sidebar' || empty( $mahalo_post_sidebar ) ){

            $sidebar = $sidebar;
        }else{
            $sidebar = $mahalo_post_sidebar;
        }

    }
    $twp_mahalo_home_sections_1 = get_theme_mod( 'twp_mahalo_home_sections_1', json_encode( $mahalo_default['twp_mahalo_home_sections_1'] ) );
    $repeat_times = 1;
    $paged_active = false;

    if ( !is_paged() ) {
        $paged_active = true;
    }

    $twp_mahalo_home_sections_1 = json_decode( $twp_mahalo_home_sections_1 );

    if( $twp_mahalo_home_sections_1 ){ ?>

        <?php
        foreach ( $twp_mahalo_home_sections_1 as $mahalo_home_section ) {

            $home_section_type = isset( $mahalo_home_section->home_section_type ) ? $mahalo_home_section->home_section_type : '';

            switch ($home_section_type) {

                case 'default-banner-area':

                    $ed_horizontal_vertical_slider = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';
                    if ( $ed_horizontal_vertical_slider == 'yes' && $paged_active ) {
                        mahalo_horizontal_vertical_slider( $mahalo_home_section , $repeat_times);
                    }

                break;

                case 'fullwidth-banner-slider':

                    $ed_fullwidth_banner_blocks = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';
                    if ( $ed_fullwidth_banner_blocks == 'yes' && $paged_active ) {
                        mahalo_fullwidth_banner_slider( $mahalo_home_section , $repeat_times);
                    }

                break;

                case 'main-banner':

                    $ed_slider_blocks = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';
                    if ( $ed_slider_blocks == 'yes' && $paged_active ) {
                        mahalo_main_banner( $mahalo_home_section , $repeat_times);
                    }

                break;


                case 'must-read':

                    $ed_must_read = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';
                    if ( $ed_must_read == 'yes' && $paged_active ) {
                        mahalo_must_read( $mahalo_home_section , $repeat_times);
                    }

                break;


                case 'latest-posts-blocks':

                    $ed_latest_posts_blocks = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';
                    if ( $ed_latest_posts_blocks == 'yes' ) {
                        mahalo_latest_blocks( $mahalo_home_section  , $repeat_times);
                    }

                break;

                case 'tiles-blocks':

                    $ed_tiles_block = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';
                    if ( $ed_tiles_block == 'yes' && $paged_active ) {
                        mahalo_tiles_block_section( $mahalo_home_section , $repeat_times);
                    }

                break;

                case 'banner-blocks-1':

                    $ed_banner_blocks_1 = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';
                    if ( $ed_banner_blocks_1 == 'yes' && $paged_active ) {
                        mahalo_banner_block_1_section( $mahalo_home_section , $repeat_times);
                    }

                break;

                case 'advertise-blocks':

                    $ed_advertise_blocks = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';
                    if ( $ed_advertise_blocks == 'yes' && $paged_active ) {
                        mahalo_advertise_block( $mahalo_home_section , $repeat_times);
                    }
                    
                break;

                case 'home-widget-area':

                    $ed_home_widget_area = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';
                    if ( $ed_home_widget_area == 'yes' && $paged_active ) {
                        mahalo_case_home_widget_area_block( $mahalo_home_section , $repeat_times);
                    }
                    
                break;

                case 'you-may-like-blocks':

                    $ed_you_may_like_area = isset( $mahalo_home_section->section_ed ) ? $mahalo_home_section->section_ed : '';
                    if ( $ed_you_may_like_area == 'yes' && $paged_active ) {
                        mahalo_you_may_like_block_section( $mahalo_home_section , $repeat_times);
                    }
                    
                break;

                default:

                break;

            }

        $repeat_times++;
        } 
        ?>

    <?php
    }

get_footer();
