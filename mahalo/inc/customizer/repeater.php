<?php
/**
* Sections Repeater Options.
*
* @package Mahalo
*/

$mahalo_post_category_list = mahalo_post_category_list();
$mahalo_defaults = mahalo_get_default_theme_options();
$home_sections = array(
        'default-banner-area' => esc_html__('Default Banner','mahalo'),
        'tiles-blocks' => esc_html__('Slider & Tiles Block','mahalo'),
        'main-banner' => esc_html__('Banner Block','mahalo'),
        'fullwidth-banner-slider' => esc_html__('Fullwidth Slider Block','mahalo'),
        'must-read' => esc_html__('Must Read','mahalo'),
        'banner-blocks-1' => esc_html__('Slider & Tab Block','mahalo'),
        'latest-posts-blocks' => esc_html__('Latest Posts Block','mahalo'),
        'advertise-blocks' => esc_html__('Advertise Block','mahalo'),
        'home-widget-area' => esc_html__('Widgets Area Block','mahalo'),
        'you-may-like-blocks' => esc_html__('You May Like Block','mahalo'),
    );

// Slider Section.
$wp_customize->add_section( 'home_sections_repeater',
	array(
	'title'      => esc_html__( 'Homepage Sections', 'mahalo' ),
	'priority'   => 150,
	'capability' => 'edit_theme_options',
	)
);


// Recommended Posts Enable Disable.
$wp_customize->add_setting( 'twp_mahalo_home_sections_1', array(
    'sanitize_callback' => 'mahalo_sanitize_repeater',
    'default' => json_encode( $mahalo_defaults['twp_mahalo_home_sections_1'] ),
    // 'transport'           => 'postMessage',
));

$wp_customize->add_control(  new Mahalo_Repeater_Controler( $wp_customize, 'twp_mahalo_home_sections_1', 
    array(
        'section' => 'home_sections_repeater',
        'settings' => 'twp_mahalo_home_sections_1',
        'mahalo_box_label' => esc_html__('New Section','mahalo'),
        'mahalo_box_add_control' => esc_html__('Add New Section','mahalo'),
        'mahalo_box_add_button' => false,
    ),
        array(
            'section_ed' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Section', 'mahalo' ),
                'class'       => 'home-section-ed'
            ),
            'home_section_type' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Section Type', 'mahalo' ),
                'options'     => $home_sections,
                'class'       => 'home-section-type'
            ),
            'home_section_column_1' => array(
                 'type'        => 'seperator',
                 'seperator_text'       => esc_html__( 'Column 1', 'mahalo' ),
                 'class'       => 'home-repeater-fields-hs default-banner-area-fields'
             ),
             'home_section_title_5' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Block Title', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs default-banner-area-fields'
            ),
             'section_slide_category' => array(
                 'type'        => 'select',
                 'label'       => esc_html__( 'Slider Post Category', 'mahalo' ),
                 'options'     => $mahalo_post_category_list,
                 'class'       => 'home-repeater-fields-hs default-banner-area-fields'
             ),
             'home_section_column_2' => array(
                  'type'        => 'seperator',
                  'seperator_text'       => esc_html__( 'Column 2', 'mahalo' ),
                  'class'       => 'home-repeater-fields-hs default-banner-area-fields'
              ),
            'home_section_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Area Title', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'home_section_title' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields you-may-like-blocks-fields'
            ),

            'section_category_7' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Fixed Post Category', 'mahalo' ),
                'options'     => $mahalo_post_category_list,
                'class'       => 'home-repeater-fields-hs default-banner-area-fields'
            ),
            'section_category_tile_slider' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Slider Category', 'mahalo' ),
                'options'     => $mahalo_post_category_list,
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields'
            ),
            'section_category' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category', 'mahalo' ),
                'options'     => $mahalo_post_category_list,
                'class'       => 'home-repeater-fields-hs tiles-blocks-fields you-may-like-blocks-fields'
            ),

            'section_category_6' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category', 'mahalo' ),
                'options'     => $mahalo_post_category_list,
                'class'       => 'home-repeater-fields-hs must-read-fields'
            ),

             'home_section_main_title' => array(
                 'type'        => 'text',
                 'label'       => esc_html__( 'Section Area Title', 'mahalo' ),
                 'class'       => 'home-repeater-fields-hs main-banner-fields'
             ),

             'home_section_must_read' => array(
                 'type'        => 'text',
                 'label'       => esc_html__( 'Section Area Title', 'mahalo' ),
                 'class'       => 'home-repeater-fields-hs must-read-fields'
             ),

            'section_post_slide_cat' => array(
              'type'        => 'select',
              'label'       => esc_html__( 'Select Category', 'mahalo' ),
              'options'     => $mahalo_post_category_list,
              'class'       => 'home-repeater-fields-hs banner-blocks-1-fields fullwidth-banner-slider-fields main-banner-fields'
            ),
            'section_post_number' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Posts Per Page', 'mahalo' ),
                'options'     => array( 
                    '1' => 1,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ),
              'class'       => 'home-repeater-fields-hs main-banner-fields'
            ),
            'advertise_image' => array(
                'type'        => 'upload',
                'label'       => esc_html__( 'Advertise Image', 'mahalo' ),
                'description' => esc_html__( 'Recommended Image Size is 970x250 PX.', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'advertise_link' => array(
                'type'        => 'link',
                'label'       => esc_html__( 'Advertise Image Link', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs advertise-blocks-fields'
            ),
            'ed_arrows_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Arrows', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields tiles-blocks-fields default-banner-area-fields'
            ),
            'ed_dots_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Dot', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields tiles-blocks-fields default-banner-area-fields'
            ),
            'ed_autoplay_carousel' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Autoplay', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields tiles-blocks-fields'
            ),
            'ed_tab' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Enable Tab', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs ed-tabs-ac banner-blocks-1-fields'
            ),
            'cat_title_1' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title One', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_1' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category One', 'mahalo' ),
                'options'     => $mahalo_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
            'cat_title_2' => array(
                'type'        => 'text',
                'label'       => esc_html__( 'Section Title Two', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs '
            ),
            'section_category_2' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Two', 'mahalo' ),
                'options'     => $mahalo_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'section_category_3' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Three', 'mahalo' ),
                'options'     => $mahalo_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'section_category_4' => array(
                'type'        => 'select',
                'label'       => esc_html__( 'Post Category Four', 'mahalo' ),
                'options'     => $mahalo_post_category_list,
                'class'       => 'home-repeater-fields-hs banner-block-1-tab-ac banner-blocks-1-fields'
            ),
            'ed_flip_column' => array(
                'type'        => 'checkbox',
                'label'       => esc_html__( 'Flip Column Right to Left', 'mahalo' ),
                'class'       => 'home-repeater-fields-hs banner-blocks-1-fields'
            ),
    )
));

// Info.
$wp_customize->add_setting(
    'mahalo_notiece_info',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Mahalo_Info_Notiece_Control( 
        $wp_customize,
        'mahalo_notiece_info',
        array(
            'settings' => 'mahalo_notiece_info',
            'section'       => 'home_sections_repeater',
            'label'         => esc_html__( 'Info', 'mahalo' ),
        )
    )
);

$wp_customize->add_setting(
    'mahalo_premium_notiece',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Mahalo_Premium_Notiece_Control( 
        $wp_customize,
        'mahalo_premium_notiece',
        array(
            'label'      => esc_html__( 'Home Page Blocks', 'mahalo' ),
            'settings' => 'mahalo_premium_notiece',
            'section'       => 'home_sections_repeater',
        )
    )
);