<?php
/**
* Body Classes.
*
* @package Mahalo
*/
 
 if (!function_exists('mahalo_body_classes')) :

    function mahalo_body_classes($classes) {

        $mahalo_default = mahalo_get_default_theme_options();
        global $post;

        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }

        // Adds a class of no-sidebar when there is no sidebar present.
        if ( !is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }
        
        if ( is_active_sidebar( 'sidebar-1' ) ) {

            $global_sidebar_layout = esc_html( get_theme_mod( 'global_sidebar_layout',$mahalo_default['global_sidebar_layout'] ) );

            if( is_single() || is_page() ){

                $mahalo_post_sidebar = esc_html( get_post_meta( $post->ID, 'mahalo_post_sidebar_option', true ) );

                if( $mahalo_post_sidebar == 'global-sidebar' || empty( $mahalo_post_sidebar ) ){

                    if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                        
                        $classes[] = 'no-sidebar';

                    }else{

                        $classes[] = esc_attr( $global_sidebar_layout );

                    }

                }else{

                    if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
                        
                        $classes[] = 'no-sidebar';

                    }else{

                        $classes[] = esc_attr( $mahalo_post_sidebar );

                    }
                }
                
            }elseif( is_404() ){

                $classes[] = 'no-sidebar';

            }else{
                
                $classes[] = esc_attr( $global_sidebar_layout );
            }

        }
        if (is_active_sidebar('mahalo-offcanvas-widget')){
            $classes[] = 'offcanvas-on';
        }
        if( is_page() ){

            $mahalo_header_trending_page = get_theme_mod( 'mahalo_header_trending_page' );
            $mahalo_header_popular_page = get_theme_mod( 'mahalo_header_popular_page' );

            if( $mahalo_header_trending_page == $post->ID || $mahalo_header_popular_page == $post->ID ){

                $mahalo_archive_layout = get_theme_mod( 'mahalo_archive_layout',$mahalo_default['mahalo_archive_layout'] );
                $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$mahalo_default['ed_image_content_inverse'] );
                if( $mahalo_archive_layout == 'default' && $ed_image_content_inverse ){

                    $classes[] = 'twp-archive-alternative';

                }

                $classes[] = 'twp-archive-'.esc_attr( $mahalo_archive_layout );
                
            }

        }

        if( is_singular('post') ){

            $mahalo_post_layout = esc_html( get_post_meta( $post->ID, 'mahalo_post_layout', true ) );

            if( $mahalo_post_layout == '' || $mahalo_post_layout == 'global-layout' ){
                
                $mahalo_post_layout = get_theme_mod( 'mahalo_single_post_layout',$mahalo_default['mahalo_archive_layout'] );

            }

            $classes[] = 'twp-single-'.esc_attr( $mahalo_post_layout );

            if( $mahalo_post_layout == 'layout-2' ){
                
                $mahalo_header_overlay = esc_html( get_post_meta( $post->ID, 'mahalo_header_overlay', true ) );

                if( $mahalo_header_overlay == '' || $mahalo_header_overlay == 'global-layout' ){

                    $mahalo_post_layout2 = get_theme_mod( 'mahalo_single_post_layout',$mahalo_default['mahalo_archive_layout'] );

                    if( $mahalo_post_layout2 == 'layout-2' ){

                        $ed_header_overlay = esc_html( get_post_meta( $post->ID, 'ed_header_overlay', true ) );
                        if( $ed_header_overlay == '' || $ed_header_overlay == 'global-layout' ){
                            
                            $ed_header_overlay = get_theme_mod( 'ed_header_overlay',$mahalo_default['ed_header_overlay'] );
                        }

                    }else{

                        $ed_header_overlay = false;

                    }

                }else{

                    $ed_header_overlay = true;

                }
                if( $ed_header_overlay ){

                    $classes[] = 'twp-single-header-overlay';

                }

            }

        }

        if( is_singular('page') ){

            $mahalo_page_layout = get_post_meta( $post->ID, 'mahalo_page_layout', true );

            if( $mahalo_page_layout == ''  ){
                
                $mahalo_page_layout = 'layout-1';

            }

            $classes[] = 'theme-single-'.esc_attr( $mahalo_page_layout );

            if( $mahalo_page_layout == 'layout-2' ){
                
                $mahalo_ed_header_overlay = get_post_meta( $post->ID, 'mahalo_ed_header_overlay', true );
                if( $mahalo_ed_header_overlay ){
                    $classes[] = 'theme-single-header-overlay';
                }

            }

        }

        if( is_archive() || is_home() || is_search() ){

            $mahalo_archive_layout = get_theme_mod( 'mahalo_archive_layout',$mahalo_default['mahalo_archive_layout'] );
            $ed_image_content_inverse = get_theme_mod( 'ed_image_content_inverse',$mahalo_default['ed_image_content_inverse'] );
            if( $mahalo_archive_layout == 'default' && $ed_image_content_inverse ){

                $classes[] = 'twp-archive-alternative';

            }

            $classes[] = 'twp-archive-'.esc_attr( $mahalo_archive_layout );
            
        }

        if( is_singular('post') ){

            $mahalo_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'mahalo_ed_post_reaction', true ) );
            if( $mahalo_ed_post_reaction ){
                $classes[] = 'hide-comment-rating';
            }

        }

        return $classes;
    }

endif;

add_filter('body_class', 'mahalo_body_classes');