<?php
/**
* Posts Settings.
*
* @package Mahalo
*/

$mahalo_default = mahalo_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'posts_settings',
	array(
	'title'      => esc_html__( 'Article Meta Settings', 'mahalo' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_post_date',
    array(
        'default' => $mahalo_default['ed_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'mahalo'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_category',
    array(
        'default' => $mahalo_default['ed_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'mahalo'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_tags',
    array(
        'default' => $mahalo_default['ed_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'mahalo'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_views',
    array(
        'default' => $mahalo_default['ed_post_views'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_views',
    array(
        'label' => esc_html__('Enable Posts Views', 'mahalo'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);


// Enable Disable Post.
$wp_customize->add_setting('post_date_format',
    array(
        'default' => $mahalo_default['post_date_format'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_select',
    )
);
$wp_customize->add_control('post_date_format',
    array(
        'label' => esc_html__('Posted Date Format', 'mahalo'),
        'section' => 'posts_settings',
        'type' => 'select',
        'choices'               => array(
            'default' => esc_html__( 'Apply Default Format', 'mahalo' ),
            'time-ago' => esc_html__( 'Apply Time Age Format', 'mahalo' ),
            ),
        )
);