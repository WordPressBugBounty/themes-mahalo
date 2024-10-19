<?php
/**
 * Pagination Settings
 *
 * @package Mahalo
 */

$mahalo_default = mahalo_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'mahalo_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'mahalo' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'mahalo_pagination_layout',
	array(
	'default'           => $mahalo_default['mahalo_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'mahalo_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'mahalo' ),
	'section'     => 'mahalo_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','mahalo'),
		'numeric' => esc_html__('Numeric Method','mahalo'),
		'load-more' => esc_html__('Ajax Load More Button','mahalo'),
		'auto-load' => esc_html__('Ajax Auto Load','mahalo'),
	),
	)
);