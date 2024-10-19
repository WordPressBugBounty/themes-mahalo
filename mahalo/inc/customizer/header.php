<?php
/**
* Header Options.
*
* @package Mahalo
*/

$mahalo_default = mahalo_get_default_theme_options();
$mahalo_page_lists = mahalo_page_lists();
$mahalo_post_category_list = mahalo_post_category_list();

$wp_customize->add_section(
    'preloader_options' ,
    array(
        'title' => __( 'Preloader Options', 'mahalo' ),
        'panel' => 'theme_option_panel',
        'priority'   => 10,

    )
);

$wp_customize->add_setting('show_preloader',
    array(
        'default' => $mahalo_default['show_preloader'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('show_preloader',
    array(
        'label'    => __( 'Show Preloader', 'mahalo' ),
        'section' => 'preloader_options',
        'type' => 'checkbox',
    )
);


// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Main Advertisement Settings', 'mahalo' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting('ed_header_ad',
    array(
        'default' => $mahalo_default['ed_header_ad'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ad',
    array(
        'label' => esc_html__('Enable Top Advertisement Area', 'mahalo'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting(
    'ed_header_type',
    array(
        'default'           => $mahalo_default['ed_header_type'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_select'
    )
);
$wp_customize->add_control('ed_header_type',
        array(
            'type'       => 'select',
            'section'       => 'main_header_setting',
            'label'         => esc_html__( 'Addvertisement Section Container', 'mahalo' ),
            'choices'       => array(
                'twp-img-full-width-header'  => esc_html__( 'Full Page', 'mahalo' ),
                'twp-img-boxed-header'  => esc_html__( 'Default', 'mahalo' ),
                'twp-img-content-header'  => esc_html__( 'Contained', 'mahalo' ),
            ),
            'active_callback' => 'mahalo_header_ad_ac',
        )
);


$wp_customize->add_setting( 'addvertisement_section_title',
    array(
    'default'           => $mahalo_default['addvertisement_section_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'addvertisement_section_title',
    array(
    'label'       => esc_html__( 'Addvertisement Section Title', 'mahalo' ),
    'section'     => 'main_header_setting',
    'type'        => 'text',
    'active_callback' => 'mahalo_header_ad_ac',
    )
);

$wp_customize->add_setting('header_ad_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_ad_image',
        array(
            'label'      => esc_html__( 'Top Header AD Image', 'mahalo' ),
            'section'    => 'main_header_setting',
            'active_callback' => 'mahalo_header_ad_ac',
        )
    )
);

$wp_customize->add_setting('ed_header_link',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('ed_header_link',
    array(
        'label' => esc_html__('AD Image Link', 'mahalo'),
        'section' => 'main_header_setting',
        'type' => 'text',
        'active_callback' => 'mahalo_header_ad_ac',
    )
);

// Archive Layout.
$wp_customize->add_setting(
    'mahalo_header_bg_size',
    array(
        'default'           => $mahalo_default['mahalo_header_bg_size'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'absint'
    )
);
$wp_customize->add_control('mahalo_header_bg_size',
        array(
            'type'       => 'select',
            'section'       => 'header_image',
            'label'         => esc_html__( 'Header BG Size', 'mahalo' ),
            'choices'       => array(
                '1'  => esc_html__( 'Small', 'mahalo' ),
                '2'  => esc_html__( 'Medium', 'mahalo' ),
                '3'  => esc_html__( 'Large', 'mahalo' ),
            )
        )
);

$wp_customize->add_setting('ed_header_bg_fixed',
    array(
        'default' => $mahalo_default['ed_header_bg_fixed'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_fixed',
    array(
        'label' => esc_html__('Enable Fixed BG', 'mahalo'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_bg_overlay',
    array(
        'default' => $mahalo_default['ed_header_bg_overlay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_bg_overlay',
    array(
        'label' => esc_html__('Enable BG Overlay', 'mahalo'),
        'section' => 'header_image',
        'type' => 'checkbox',
    )
);

// Trending News Section
$wp_customize->add_section( 'header_news_section',
    array(
    'title'      => esc_html__( 'Main Navigation Area', 'mahalo' ),
    'priority'   => 15,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);

$wp_customize->add_setting('ed_header_trending_news',
    array(
        'default' => $mahalo_default['ed_header_trending_news'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_trending_news',
    array(
        'label' => esc_html__('Enable Trending News', 'mahalo'),
        'section' => 'header_news_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'mahalo_header_trending_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'mahalo_sanitize_select',
    )
);
$wp_customize->add_control( 'mahalo_header_trending_cat',
    array(
    'label'       => esc_html__( 'Trending News Posts Category', 'mahalo' ),
    'section'     => 'header_news_section',
    'type'        => 'select',
    'choices'     => $mahalo_post_category_list,
    )
);


$wp_customize->add_setting('ed_header_day_light_mode',
    array(
        'default' => $mahalo_default['ed_header_day_light_mode'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_day_light_mode',
    array(
        'label' => esc_html__('Enable Day & Light Mode', 'mahalo'),
        'section' => 'header_news_section',
        'type' => 'checkbox',
    )
);
