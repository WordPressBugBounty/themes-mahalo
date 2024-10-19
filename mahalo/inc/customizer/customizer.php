<?php
/**
 * Mahalo Theme Customizer
 *
 * @package Mahalo
 */

/** Sanitize Functions. **/
	require get_template_directory() . '/inc/customizer/default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if (!function_exists('mahalo_customize_register')) :

function mahalo_customize_register( $wp_customize ) {

	require get_template_directory() . '/inc/customizer/active-callback.php';
	require get_template_directory() . '/inc/customizer/custom-classes.php';
	require get_template_directory() . '/inc/customizer/sanitize.php';
	require get_template_directory() . '/inc/customizer/layout.php';
	require get_template_directory() . '/inc/customizer/date-ticker-header.php';
	require get_template_directory() . '/inc/customizer/header.php';
	require get_template_directory() . '/inc/customizer/repeater.php';
	require get_template_directory() . '/inc/customizer/pagination.php';
	require get_template_directory() . '/inc/customizer/post.php';
	require get_template_directory() . '/inc/customizer/single.php';
	require get_template_directory() . '/inc/customizer/footer.php';

	$wp_customize->get_section( 'colors' )->panel = 'theme_colors_panel';
	$wp_customize->get_section( 'colors' )->title = esc_html__('Color Options','mahalo');
	$wp_customize->get_section( 'title_tagline' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'header_image' )->panel = 'theme_general_settings';
	$wp_customize->get_section( 'background_image' )->panel = 'theme_general_settings';
    


	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
            'selector'        => '.site-logo .custom-logo-name',
			'render_callback' => 'mahalo_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'mahalo_customize_partial_blogdescription',
		) );
	}
	
	$mahalo_default = mahalo_get_default_theme_options();
	$wp_customize->add_setting('logo_width_range',
	    array(
	        'default'           => $mahalo_default['logo_width_range'],
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'mahalo_sanitize_number_range',
	    )
	);
	$wp_customize->add_control('logo_width_range',
	    array(
	        'label'       => esc_html__('Logo Width', 'mahalo'),
	        'description'       => esc_html__( 'Specify the range of logo size from a minimum of 200 pixels to a maximum of 700 pixels, with increments of 20 pixels per step.', 'mahalo' ),
	        'section'     => 'title_tagline',
	        'type'        => 'range',
	        'input_attrs' => array(
				           'min'   => 200,
				           'max'   => 700,
				           'step'   => 20,
			        	),
	    )
	);
	$wp_customize->add_setting('site_title_font_size',
	    array(
	        'default'           => $mahalo_default['site_title_font_size'],
	        'capability'        => 'edit_theme_options',
	        'sanitize_callback' => 'mahalo_sanitize_number_range',
	    )
	);
	$wp_customize->add_control('site_title_font_size',
	    array(
	        'label'       => esc_html__('Site Title Font size', 'mahalo'),
	        'description'       => esc_html__( 'Define Site title font size min-32 to max-150 (step-2)', 'mahalo' ),
	        'section'     => 'title_tagline',
	        'type'        => 'range',
	        'input_attrs' => array(
				           'min'   => 32,
				           'max'   => 150,
				           'step'   => 2,
			        	),
	    )
	);

	// Theme Options Panel.
	$wp_customize->add_panel( 'theme_option_panel',
		array(
			'title'      => esc_html__( 'Theme Options', 'mahalo' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_general_settings',
		array(
			'title'      => esc_html__( 'General Settings', 'mahalo' ),
			'priority'   => 10,
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_panel( 'theme_colors_panel',
		array(
			'title'      => esc_html__( 'Color Settings', 'mahalo' ),
			'priority'   => 15,
			'capability' => 'edit_theme_options',
		)
	);

	// Template Options
	$wp_customize->add_panel( 'theme_template_pannel',
		array(
			'title'      => esc_html__( 'Template Settings', 'mahalo' ),
			'priority'   => 150,
			'capability' => 'edit_theme_options',
		)
	);


	$wp_customize->add_setting( 'mahalo_bg_text_color',
	    array(
	    'default'           => $mahalo_default['mahalo_bg_text_color'],
	    'capability'        => 'edit_theme_options',
	    'sanitize_callback' => 'sanitize_hex_color',
	    )
	);
	$wp_customize->add_control( 
	    new WP_Customize_Color_Control( 
	    $wp_customize, 
	    'mahalo_bg_text_color',
	    array(
	        'label'      => esc_html__( 'Primary Text Color', 'mahalo' ),
	        'section'    => 'colors',
	        'settings'   => 'mahalo_bg_text_color',
	    ) ) 
	);
	
	// Register custom section types.
	$wp_customize->register_section_type( 'Mahalo_Customize_Section_Upsell' );

	// Register sections.
	$wp_customize->add_section(
		new Mahalo_Customize_Section_Upsell(
			$wp_customize,
			'theme_upsell',
			array(
				'title'    => esc_html__( 'Mahalo Pro', 'mahalo' ),
				'pro_text' => esc_html__( 'Upgrade To Pro', 'mahalo' ),
				'pro_url'  => esc_url('https://www.themeinwp.com/theme/mahalo-pro/'),
				'priority'  => 1,
			)
		)
	);

}

endif;
add_action( 'customize_register', 'mahalo_customize_register' );

/**
 * Customizer Enqueue scripts and styles.
 */

if (!function_exists('mahalo_customizer_scripts')) :

    function mahalo_customizer_scripts(){   
    	
    	wp_enqueue_script('jquery-ui-button');
    	wp_enqueue_style('mahalo-customizer', get_template_directory_uri() . '/assets/lib/custom/css/customizer.css');
        wp_enqueue_script('mahalo-customizer', get_template_directory_uri() . '/assets/lib/custom/js/customizer.js', array('jquery','customize-controls'), '', 1);

        $ajax_nonce = wp_create_nonce('mahalo_customizer_ajax_nonce');
        wp_localize_script( 
		    'mahalo-customizer', 
		    'mahalo_customizer',
		    array(
		        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
		        'ajax_nonce' => $ajax_nonce,
		     )
		);
    }

endif;

add_action('customize_controls_enqueue_scripts', 'mahalo_customizer_scripts');
add_action('customize_controls_init', 'mahalo_customizer_scripts');

/**
 * Customizer Enqueue scripts and styles.
 */
function mahalo_customizer_repearer(){   
	
	wp_enqueue_style('mahalo-repeater', get_template_directory_uri() . '/assets/lib/custom/css/repeater.css');
    wp_enqueue_script('mahalo-repeater', get_template_directory_uri() . '/assets/lib/custom/js/repeater.js', array('jquery','customize-controls'), '', 1);

    $mahalo_post_category_list = mahalo_post_category_list();

    $cat_option = '';

    if( $mahalo_post_category_list ){
	    foreach( $mahalo_post_category_list as $key => $cats ){
	    	$cat_option .= "<option value='". esc_attr( $key )."'>". esc_html( $cats )."</option>";
	    }
	}

    wp_localize_script( 
        'mahalo-repeater', 
        'mahalo_repeater',
        array(
            'optionns'   => "
            				<option selected='selected' value='tiles-blocks'>". esc_html__('Slider & Tiles Block','mahalo')."</option>
            				<option value='main-banner'>". esc_html__('Main Banner Slider','mahalo')."</option>
            				<option value='fullwidth-banner-slider'>". esc_html__('Fullwidth Slider Block','mahalo')."</option>
            				<option value='banner-blocks-1'>". esc_html__('Slider & Tab Block','mahalo')."</option>
            				<option value='latest-posts-blocks'>". esc_html__('Latest Posts Block','mahalo')."</option>
        					<option value='advertise-blocks'>". esc_html__('Advertise Block','mahalo')."</option>
            				<option value='home-widget-area'>". esc_html__('Widgets Area Block','mahalo')."</option
        					<option value='you-may-like-blocks'>". esc_html__('You May Like Block','mahalo')."</option>",
           	'categories'   => $cat_option,
            'new_section'   =>  esc_html__('New Section','mahalo'),
            'upload_image'   =>  esc_html__('Choose Image','mahalo'),
            'use_image'   =>  esc_html__('Select','mahalo'),
         )
    );

    wp_localize_script( 
        'mahalo-customizer', 
        'mahalo_customizer',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
         )
    );
}

add_action('customize_controls_enqueue_scripts', 'mahalo_customizer_repearer');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('mahalo_customize_partial_blogname')) :

	function mahalo_customize_partial_blogname() {
		bloginfo( 'name' );
	}
endif;

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */

if (!function_exists('mahalo_customize_partial_blogdescription')) :

	function mahalo_customize_partial_blogdescription() {
		bloginfo( 'description' );
	}

endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mahalo_customize_preview_js() {
	wp_enqueue_script( 'mahalo-customizer-preview', get_template_directory_uri() . '/assets/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'mahalo_customize_preview_js' );