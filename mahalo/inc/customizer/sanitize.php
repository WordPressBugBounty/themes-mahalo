<?php
/**
* Custom Functions.
*
* @package Mahalo
*/


if( !function_exists( 'mahalo_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function mahalo_sanitize_sidebar_option( $mahalo_input ){

        $mahalo_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $mahalo_input,$mahalo_metabox_options ) ){

            return $mahalo_input;

        }

        return;

    }

endif;

if( !function_exists( 'mahalo_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function mahalo_sanitize_single_pagination_layout( $mahalo_input ){

        $mahalo_single_pagination = array( 'no-navigation','norma-navigation','ajax-next-post-load' );
        if( in_array( $mahalo_input,$mahalo_single_pagination ) ){

            return $mahalo_input;

        }

        return;

    }

endif;

if( !function_exists( 'mahalo_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function mahalo_sanitize_archive_layout( $mahalo_input ){

        $mahalo_archive_option = array( 'default','full','grid' );
        if( in_array( $mahalo_input,$mahalo_archive_option ) ){

            return $mahalo_input;

        }

        return;

    }

endif;

if( !function_exists( 'mahalo_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function mahalo_sanitize_single_post_layout( $mahalo_input ){

        $mahalo_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $mahalo_input,$mahalo_single_layout ) ){

            return $mahalo_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'mahalo_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function mahalo_sanitize_checkbox( $mahalo_checked ) {

		return ( ( isset( $mahalo_checked ) && true === $mahalo_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'mahalo_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function mahalo_sanitize_select( $mahalo_input, $mahalo_setting ) {

        // Ensure input is a slug.
        $mahalo_input = sanitize_text_field( $mahalo_input );

        // Get list of choices from the control associated with the setting.
        $choices = $mahalo_setting->manager->get_control( $mahalo_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $mahalo_input, $choices ) ? $mahalo_input : $mahalo_setting->default );

    }

endif;

if ( ! function_exists( 'mahalo_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function mahalo_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'section_ed' 
                        || $key == 'ed_tab' 
                        || $key == 'ed_arrows_carousel' 
                        || $key == 'ed_dots_carousel' 
                        || $key == 'ed_autoplay_carousel' 
                        || $key == 'ed_flip_column' 
                        || $key == 'ed_ribbon_bg'
                    ){

                        $input_decoded[$boxes][$key] = mahalo_sanitize_repeater_ed( $value );

                    }elseif( $key == 'home_section_type' ){

                        $input_decoded[$boxes][$key] = mahalo_sanitize_home_sections( $value );

                    }elseif( $key == 'ribbon_bg_color_schema' ){

                        $input_decoded[$boxes][$key] = mahalo_sanitize_ribbon_bg( $value );

                    }elseif( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }elseif( $key == 'tiles_post_per_page' ){

                        $input_decoded[$boxes][$key] =  absint( $value );

                    }elseif( $key == 'advertise_image' || $key == 'advertise_link' ){

                         $input_decoded[$boxes][$key] = esc_url_raw( $value );

                    }elseif($key == 'section_category' || 
                            $key == 'section_post_slide_cat' || 
                            $key == 'section_post_cat_1' || 
                            $key == 'section_category_1' || 
                            $key == 'section_category_2' || 
                            $key == 'section_category_3' || 
                            $key == 'section_category_4' || 
                            $key == 'category'
                        ){

                        $input_decoded[$boxes][$key] =  mahalo_sanitize_category( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;

/** Sanitize Enable Disable Checkbox **/
function mahalo_sanitize_repeater_ed( $input ) {

    $valid_keys = array('yes','no');
    if ( in_array( $input , $valid_keys ) ) {
        return $input;
    }
    return '';

}

function mahalo_sanitize_home_sections( $input ) {

    $home_sections = array(
        'default-banner-area' => esc_html__('Default Banner','mahalo'),
        'tiles-blocks' => esc_html__('Slider & Tiles Block','mahalo'),
        'main-banner' => esc_html__('Main Banner','mahalo'),
        'fullwidth-banner-slider' => esc_html__('Fullwidth Slider Block','mahalo'),
        'must-read' => esc_html__('Must Read','mahalo'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','mahalo'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','mahalo'),
        'slider-blocks' => esc_html__('Slider Block','mahalo'),
        'advertise-blocks' => esc_html__('Advertise Block','mahalo'),
        'home-widget-area' => esc_html__('Widgets Area Block','mahalo'),
        'you-may-like-blocks' => esc_html__('You May Like Block','mahalo'),

    );
    if ( array_key_exists( $input , $home_sections ) ) {
        return $input;
    }
    return '';

}

/** Sanitize Category **/
function mahalo_sanitize_category( $input ) {

   $mahalo_post_category_list = mahalo_post_category_list();
    if ( array_key_exists( $input , $mahalo_post_category_list ) ) {
        return $input;
    }
    return '';

}

function mahalo_sanitize_ribbon_bg( $input ) {

    $ribbon_bg = array( 
                    '1' =>  array(
                                    'title' =>  esc_html__( 'Blue', 'mahalo' ),
                                    'color' =>  '#3061ff',
                                ),
                    '2' =>  array(
                                    'title' =>  esc_html__( 'Orange', 'mahalo' ),
                                    'color' =>  '#fa9000',
                                ),
                    '3' =>  array(
                                    'title' =>  esc_html__( 'Royal Blue', 'mahalo' ),
                                    'color' =>  '#00167a',
                                ),
                    '4' =>  array(
                                    'title' =>  esc_html__( 'Pink', 'mahalo' ),
                                    'color' =>  '#ff2d55',
                                ),
                );

    if ( array_key_exists( $input , $ribbon_bg ) ) {
        return $input;
    }
    return '';

}