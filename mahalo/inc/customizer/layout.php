<?php
/**
* Layouts Settings.
*
* @package Mahalo
*/

$mahalo_default = mahalo_get_default_theme_options();

// Layout Section.
$wp_customize->add_section( 'layout_setting',
	array(
	'title'      => esc_html__( 'Archive Settings', 'mahalo' ),
	'priority'   => 60,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting( 'global_sidebar_layout',
	array(
	'default'           => $mahalo_default['global_sidebar_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'mahalo_sanitize_sidebar_option',
	)
);
$wp_customize->add_control( 'global_sidebar_layout',
	array(
	'label'       => esc_html__( 'Global Sidebar Layout', 'mahalo' ),
	'section'     => 'layout_setting',
	'type'        => 'select',
	'choices'     => array(
		'right-sidebar' => esc_html__( 'Right Sidebar', 'mahalo' ),
		'left-sidebar'  => esc_html__( 'Left Sidebar', 'mahalo' ),
		'no-sidebar'    => esc_html__( 'No Sidebar', 'mahalo' ),
	    ),
	)
);

// Archive Layout.
$wp_customize->add_setting(
    'mahalo_archive_layout',
    array(
        'default' 			=> $mahalo_default['mahalo_archive_layout'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_archive_layout'
    )
);
$wp_customize->add_control(
    new Mahalo_Custom_Radio_Image_Control(
        $wp_customize,
        'mahalo_archive_layout',
        array(
            'settings'      => 'mahalo_archive_layout',
            'section'       => 'layout_setting',
            'label'         => esc_html__( 'Archive Layout', 'mahalo' ),
            'choices'       => array(
            	'default'  => get_template_directory_uri() . '/assets/images/Layout-style-1.png',
                'full'  => get_template_directory_uri() . '/assets/images/Layout-style-2.png',
                'grid'  => get_template_directory_uri() . '/assets/images/Layout-style-3.png',
            )
        )
    )
);


$wp_customize->add_setting('ed_image_content_inverse',
    array(
        'default' => $mahalo_default['ed_image_content_inverse'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'mahalo_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_image_content_inverse',
    array(
        'label' => esc_html__('Inverse Image with Content', 'mahalo'),
        'section' => 'layout_setting',
        'type' => 'checkbox',
        'active_callback' => 'mahalo_header_archive_layout_ac',
    )
);

