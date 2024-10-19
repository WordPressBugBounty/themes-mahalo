<?php
/**
* Header Options.
*
* @package Mahalo
*/

$mahalo_default = mahalo_get_default_theme_options();
$mahalo_post_category_list = mahalo_post_category_list();
$wp_customize->add_section( 'breaking_news_setting',
    array(
    'title'      => esc_html__( 'Breaking News Ticker Settings', 'mahalo' ),
    'priority'   => 20,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);


$wp_customize->add_setting('ed_header_ticker_posts',
    array(
        'default' => $mahalo_default['ed_header_ticker_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_ticker_posts',
    array(
        'label' => esc_html__('Enable Ticker Posts', 'mahalo'),
        'section' => 'breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting( 'ed_header_ticker_posts_title',
    array(
    'default'           => $mahalo_default['ed_header_ticker_posts_title'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ed_header_ticker_posts_title',
    array(
    'label'       => esc_html__( 'Ticker Section Title', 'mahalo' ),
    'section'     => 'breaking_news_setting',
    'type'        => 'text',
    )
);


$wp_customize->add_setting( 'mahalo_header_ticker_cat',
    array(
    'default'           => '',
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'mahalo_sanitize_select',
    )
);
$wp_customize->add_control( 'mahalo_header_ticker_cat',
    array(
    'label'       => esc_html__( 'Ticker Posts Category', 'mahalo' ),
    'section'     => 'breaking_news_setting',
    'type'        => 'select',
    'choices'     => $mahalo_post_category_list,
    )
);


$wp_customize->add_section( 'date_breaking_news_setting',
	array(
	'title'      => esc_html__( 'Topbar (Date,  Clock,  Social icon)', 'mahalo' ),
	'priority'   => 13,
	'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting('ed_top_bar',
    array(
        'default' => $mahalo_default['ed_top_bar'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_top_bar',
    array(
        'label' => esc_html__('Enable Top Bar', 'mahalo'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('ed_top_bar_social_nav',
    array(
        'default' => $mahalo_default['ed_top_bar_social_nav'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_top_bar_social_nav',
    array(
        'label' => esc_html__('Enable Social Nav', 'mahalo'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_top_bar_date',
    array(
        'default' => $mahalo_default['ed_top_bar_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_top_bar_date',
    array(
        'label' => esc_html__('Display Date', 'mahalo'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_top_bar_time',
    array(
        'default' => $mahalo_default['ed_top_bar_time'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_top_bar_time',
    array(
        'label' => esc_html__('Display Time', 'mahalo'),
        'section' => 'date_breaking_news_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'ticker_date_format',
    array(
    'default'           => $mahalo_default['ticker_date_format'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'ticker_date_format',
    array(
    'label'       => esc_html__( 'Ticker Date Format', 'mahalo' ),
    'section'     => 'date_breaking_news_setting',
    'type'        => 'text',
    )
);


// Header Right Advertise Area Section.
$wp_customize->add_section( 'header_right_add_setting',
    array(
    'title'      => esc_html__( 'Header Middle Area Settings', 'mahalo' ),
    'priority'   => 15,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_option_panel',
    )
);


$wp_customize->add_setting( 'site_title_add_layout',
    array(
    'default'           => $mahalo_default['site_title_add_layout'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'mahalo_sanitize_select',
    )
);
$wp_customize->add_control( 'site_title_add_layout',
    array(
    'label'       => esc_html__( 'Site Title & Adv. Alignment', 'mahalo' ),
    'section'     => 'header_right_add_setting',
    'type'        => 'select',
    'choices'               => array(
        'primary-layout' => esc_html__( 'Primary Layout', 'mahalo' ),
        'secondary-layout' => esc_html__( 'Secondary Layout', 'mahalo' ),
        ),
    )
);

$wp_customize->add_setting('ed_middle_header_ad',
    array(
        'default' => $mahalo_default['ed_middle_header_ad'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_middle_header_ad',
    array(
        'label' => esc_html__('Enable Advertisement', 'mahalo'),
        'section' => 'header_right_add_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('header_middle_ad_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
);
$wp_customize->add_control( new WP_Customize_Image_Control(
    $wp_customize,
    'header_middle_ad_image',
        array(
            'label'      => esc_html__( 'Header AD Image', 'mahalo' ),
            'section'    => 'header_right_add_setting',
            'active_callback' => 'mahalo_middle_header_ad_ac',
        )
    )
);

$wp_customize->add_setting('ed_header_middle_ad_link',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
    )
);
$wp_customize->add_control('ed_header_middle_ad_link',
    array(
        'label' => esc_html__('AD Image Link', 'mahalo'),
        'section' => 'header_right_add_setting',
        'type' => 'text',
        'active_callback' => 'mahalo_middle_header_ad_ac',
    )
);
