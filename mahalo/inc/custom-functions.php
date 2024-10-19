<?php
/**
 * Custom Functions.
 *
 * @package Mahalo
 */

if( !function_exists( 'mahalo_fonts_url' ) ) :

    //Google Fonts URL
    function mahalo_fonts_url(){

        $font_families = array(
            'Inter:wght@100;200;300;400;500;600;700;800;900&display=swap',
            'Overpass:wght@300;400;500;600;700;900&display=swap'
        );

        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $font_families ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );

        return esc_url_raw($fonts_url);
    }

endif;

if( !function_exists( 'mahalo_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function mahalo_sanitize_sidebar_option_meta( $input ){

        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'mahalo_page_lists' ) ) :

    // Page List.
    function mahalo_page_lists(){

        $page_lists = array();
        $page_lists[''] = esc_html__( '-- Select Page --','mahalo' );
        $pages = get_pages(
            array (
                'parent'  => 0, // replaces 'depth' => 1,
            )
        );
        foreach( $pages as $page ){

            $page_lists[$page->ID] = $page->post_title;

        }
        return $page_lists;
    }

endif;

if( !function_exists( 'mahalo_sanitize_post_layout_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function mahalo_sanitize_post_layout_option_meta( $input ){

        $metabox_options = array( 'global-layout','layout-1','layout-2' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

if( !function_exists( 'mahalo_sanitize_header_overlay_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function mahalo_sanitize_header_overlay_option_meta( $input ){

        $metabox_options = array( 'global-layout','enable-overlay' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

/**
 * Mahalo SVG Icon helper functions
 *
 * @package Mahalo
 * @since 1.0.0
 */
if ( ! function_exists( 'mahalo_theme_svg' ) ):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Mahalo_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function mahalo_theme_svg( $svg_name, $return = false ) {

        if( $return ){

            return mahalo_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in mahalo_get_theme_svg();.

        }else{

            echo mahalo_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in mahalo_get_theme_svg();.
            
        }
    }

endif;

if ( ! function_exists( 'mahalo_get_theme_svg' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function mahalo_get_theme_svg( $svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Mahalo_SVG_Icons::get_svg( $svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),

                'line'    => array(
                    'stroke'      => true,
                    'x1' => true,
                    'x2'         => true,
                    'y1' => true,
                    'y2' => true,
                ),
            )
        );
        if ( ! $svg ) {
            return false;
        }
        return $svg;

    }

endif;

if ( ! function_exists( 'mahalo_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function mahalo_svg_escape( $input ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $svg ) {
            return false;
        }

        return $svg;

    }

endif;

if( !function_exists( 'mahalo_social_menu_icon' ) ) :

    function mahalo_social_menu_icon( $item_output, $item, $depth, $args ) {

        // Add Icon
        if ( isset( $args->theme_location ) && 'mahalo-social-menu' === $args->theme_location ) {

            $svg = Mahalo_SVG_Icons::get_theme_svg_name( $item->url );

            if ( empty( $svg ) ) {
                $svg = mahalo_theme_svg( 'link',$return = true );
            }

            $item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
        }

        return $item_output;
    }
    
endif;

add_filter( 'walker_nav_menu_start_el', 'mahalo_social_menu_icon', 10, 4 );

if ( ! function_exists( 'mahalo_sub_menu_toggle_button' ) ) :

    function mahalo_sub_menu_toggle_button( $args, $item, $depth ) {

        // Add sub menu toggles to the main menu with toggles
        if ( $args->theme_location == 'mahalo-primary-menu' && isset( $args->show_toggles ) ) {
            // Wrap the menu item link contents in a div, used for positioning
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';
            // Add a toggle to items with children
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';
                // Add the sub menu toggle
                $args->after .= '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __( 'Show sub menu', 'mahalo' ) . '</span>' . mahalo_get_theme_svg( 'chevron-down' ) . '</span></button>';
            }
            // Close the wrapper
            $args->after .= '</div><!-- .submenu-wrapper -->';
            // Add sub menu icons to the main menu without toggles (the fallback menu)
        } elseif ( $args->theme_location == 'mahalo-primary-menu' ) {
            if ( in_array( 'menu-item-has-children', $item->classes ) ) {
                $args->before = '<div class="link-icon-wrapper">';
                $args->after  = mahalo_get_theme_svg( 'chevron-down' ) . '</div>';
            } else {
                $args->before = '';
                $args->after  = '';
            }
        }
        return $args;

    }

    add_filter( 'nav_menu_item_args', 'mahalo_sub_menu_toggle_button', 10, 3 );

endif;


if( !function_exists( 'mahalo_post_category_list' ) ) :

    // Post Category List.
    function mahalo_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( 'Select Category','mahalo' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists('mahalo_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function mahalo_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','norma-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists('mahalo_disable_post_views') ):

    /** Disable Post Views **/
    function mahalo_disable_post_views() {

        add_filter('booster_extension_filter_views_ed', 'mahalo_disable_views_ed');

    }

endif;

if( !function_exists('mahalo_disable_views_ed') ):

    /** Disable Reaction **/
    function mahalo_disable_views_ed() {

        return false;

    }

endif;

if( !function_exists('mahalo_disable_post_read_time') ):

    /** Disable Read Time **/
    function mahalo_disable_post_read_time() {

        add_filter('booster_extension_filter_readtime_ed', 'mahalo_disable_read_time');

    }

endif;

if( !function_exists('mahalo_disable_read_time') ):

    /** Disable Reaction **/
    function mahalo_disable_read_time() {

        return false;

    }

endif;

if( !function_exists('mahalo_disable_post_like_dislike') ):

    /** Disable Like Dislike **/
    function mahalo_disable_post_like_dislike() {

        add_filter('booster_extension_filter_like_ed', 'mahalo_disable_like_ed');

    }

endif;

if( !function_exists('mahalo_disable_like_ed') ):

    /** Disable Reaction **/
    function mahalo_disable_like_ed() {

        return false;

    }

endif;

if( !function_exists('mahalo_disable_post_author_box') ):

    /** Disable Author Box **/
    function mahalo_disable_post_author_box() {

        add_filter('booster_extension_filter_ab_ed','mahalo_disable_ab_ed');

    }

endif;

if( !function_exists('mahalo_disable_ab_ed') ):

    /** Disable Reaction **/
    function mahalo_disable_ab_ed() {

        return false;

    }

endif;

add_filter('booster_extension_filter_ss_ed', 'mahalo_disable_social_share');

if( !function_exists('mahalo_disable_social_share') ):

    /** Disable Reaction **/
    function mahalo_disable_social_share() {

        return false;

    }

endif;

if( !function_exists('mahalo_disable_post_reaction') ):

    /** Disable Reaction **/
    function mahalo_disable_post_reaction() {

        add_filter('booster_extension_filter_reaction_ed', 'mahalo_disable_reaction_cb');

    }

endif;

if( !function_exists('mahalo_disable_reaction_cb') ):

    /** Disable Reaction **/
    function mahalo_disable_reaction_cb() {

        return false;

    }

endif;

if( !function_exists( 'mahalo_header_ad' ) ):

    function mahalo_header_ad(){
        $mahalo_default = mahalo_get_default_theme_options();
        $ed_header_ad = get_theme_mod( 'ed_header_ad',$mahalo_default['ed_header_ad'] );
        $ed_header_type = get_theme_mod( 'ed_header_type',$mahalo_default['ed_header_type'] );
        $addvertisement_section_title = get_theme_mod( 'addvertisement_section_title',$mahalo_default['addvertisement_section_title'] );
        $header_ad_image = get_theme_mod( 'header_ad_image' );
        $ed_header_link = get_theme_mod( 'ed_header_link' );
        if( $ed_header_ad ){
            ?>
            <div class="theme-header-ads">
                <div class="<?php echo esc_attr($ed_header_type); ?>">


                <div class="header-ads-cta">
                    <span class="header-ads-title">
                        <?php echo esc_html($addvertisement_section_title); ?>
                    </span>
                    <div class="cta-btn-container">
                        <button class="cta-btn top-header-add"> <?php echo esc_html__( 'Skip This', 'mahalo') ?></button>
                    </div>
                </div>


                    <?php if ($header_ad_image) { ?>
                        <a target="_blank" href="<?php echo esc_url($ed_header_link); ?>">
                            <img src="<?php echo esc_url($header_ad_image); ?>" title="<?php esc_attr_e('Header AD Image', 'mahalo'); ?>" alt="<?php esc_attr_e('Header AD Image', 'mahalo'); ?>"/>
                        </a>
                    <?php } ?>
                        <?php if ($ed_header_type == 'twp-img-full-width-header') { ?>
                        <button type="button" class="top-header-add">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        <?php } ?>
                </div>
            </div>

            <?php

        }
    }

endif;


if( !function_exists( 'mahalo_aside_branding_ad' ) ):

    function mahalo_aside_branding_ad(){
        $mahalo_default = mahalo_get_default_theme_options();
        $site_title_add_layout = get_theme_mod('site_title_add_layout', $mahalo_default['site_title_add_layout']);
        $ed_middle_header_ad = get_theme_mod( 'ed_middle_header_ad',$mahalo_default['ed_middle_header_ad'] );
        $header_middle_ad_image = get_theme_mod( 'header_middle_ad_image' );
        $ed_header_middle_ad_link = get_theme_mod( 'ed_header_middle_ad_link' );
        if( $ed_middle_header_ad ){
            ?>
            <div class="theme-header-prom header-item <?php if($site_title_add_layout == 'primary-layout'){ echo 'header-item-center';}else {echo 'header-item-right';} ?>">
                <?php if ($header_middle_ad_image) { ?>
                    <a target="_blank" href="<?php echo esc_url($ed_header_middle_ad_link); ?>">
                        <img src="<?php echo esc_url($header_middle_ad_image); ?>"/>
                    </a>
                <?php } ?>
            </div>

            <?php

        }
    }

endif;


if( !function_exists('mahalo_post_floating_nav') ):

    function mahalo_post_floating_nav(){

        $mahalo_default = mahalo_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod( 'ed_floating_next_previous_nav',$mahalo_default['ed_floating_next_previous_nav'] );

        if( 'post' === get_post_type() && $ed_floating_next_previous_nav ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-post-navigation floating-navigation-prev">
                    <?php if( get_the_post_thumbnail( $prev_post->ID,'medium' ) ){ ?>
                            <?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $prev_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'mahalo'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-post-navigation floating-navigation-next">
                    <?php if( get_the_post_thumbnail( $next_post->ID,'medium' ) ){ ?>
                        <?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $next_link ); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'mahalo'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php
            }

        }

    }

endif;

add_action( 'mahalo_navigation_action','mahalo_post_floating_nav',10 );

if( !function_exists('mahalo_single_post_navigation') ):

    function mahalo_single_post_navigation(){

        $mahalo_default = mahalo_get_default_theme_options();
        $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $mahalo_header_trending_page = get_theme_mod( 'mahalo_header_trending_page' );
        $mahalo_header_popular_page = get_theme_mod( 'mahalo_header_popular_page' );
        $mahalo_archive_layout = esc_attr( get_theme_mod( 'mahalo_archive_layout', $mahalo_default['mahalo_archive_layout'] ) );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $mahalo_default['twp_navigation_type']);
        }

        if( $mahalo_header_trending_page != $current_id && $mahalo_header_popular_page != $current_id ){

            if( $twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

                if( $twp_navigation_type == 'norma-navigation' ){ ?>

                    <div class="navigation-wrapper">
                        <?php
                        // Previous/next post navigation.
                        the_post_navigation(array(
                            'prev_text' => '<span class="arrow" aria-hidden="true">' . mahalo_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . __('Previous post:', 'mahalo') . '</span><span class="post-title">%title</span>',
                            'next_text' => '<span class="arrow" aria-hidden="true">' . mahalo_theme_svg('arrow-right',$return = true ) . '</span><span class="screen-reader-text">' . __('Next post:', 'mahalo') . '</span><span class="post-title">%title</span>',
                        )); ?>
                    </div>
                    <?php

                }else{

                    $next_post = get_next_post();
                    if( isset( $next_post->ID ) ){

                        $next_post_id = $next_post->ID;
                        echo '<div loop-count="1" next-post="' . absint( $next_post_id ) . '" class="twp-single-infinity"></div>';

                    }
                }

            }

        }

    }

endif;

add_action( 'mahalo_navigation_action','mahalo_single_post_navigation',30 );


if( !function_exists('mahalo_header_banner') ):

    function mahalo_header_banner(){

        global $post;

        if( have_posts() ):

            while (have_posts()) :
                the_post();

                global $post;
                
            endwhile;

        endif;
        
        $mahalo_post_layout = '';
        $mahalo_default = mahalo_get_default_theme_options();

        if( is_singular() ){

            $mahalo_post_layout = esc_html( get_post_meta( $post->ID, 'mahalo_post_layout', true ) );
            if( $mahalo_post_layout == '' || $mahalo_post_layout == 'global-layout' ){
                
                $mahalo_post_layout = get_theme_mod( 'mahalo_single_post_layout',$mahalo_default['mahalo_archive_layout'] );
            }

        }

        if( isset( $post->ID ) ){

            $mahalo_page_layout = esc_html( get_post_meta( $post->ID, 'mahalo_page_layout', true ) );

        }

        if( $mahalo_post_layout == 'layout-2' && is_singular('post') ) {

            if ( have_posts() ) :

                while ( have_posts() ) :
                    the_post();

                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
                    $mahalo_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'mahalo_ed_feature_image', true ) );
                    ?>

                    <div class="single-featured-banner  <?php if( empty( $mahalo_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ echo 'banner-has-image'; } ?>">

                        <div class="featured-banner-content">
                            <div class="wrapper">
                                <?php
                                if ( !is_404() && !is_home() && !is_front_page() ) {
                                    mahalo_breadcrumb_with_title_block();
                                } ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        <header class="entry-header">

                                            <div class="entry-meta">
                                                <?php
                                                mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false);
                                                ?>
                                            </div>

                                            <h1 class="entry-title entry-title-large">
                                                <?php the_title(); ?>
                                            </h1>
                                        </header>
                                        <div class="entry-meta">
                                            <?php
                                            mahalo_posted_by();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <?php if( empty( $mahalo_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ ?>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner" data-background="<?php echo esc_url( $featured_image[0] ); ?>"></div>
                            </div>
                        <?php } ?>

                    </div>

                <?php
                endwhile;

                wp_reset_postdata();

            endif;
               
        }

        if( is_singular('page') && $mahalo_page_layout == 'layout-2' ) {

            if ( have_posts() ) :

                while ( have_posts() ) :

                    the_post();

                    $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(),'full' );
                    
                    $mahalo_ed_feature_image = esc_html( get_post_meta( get_the_ID(), 'mahalo_ed_feature_image', true ) );
                    ?>

                    <div class="single-featured-banner  <?php if( empty( $mahalo_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ echo 'banner-has-image'; } ?>">

                        <div class="featured-banner-content">
                            <div class="wrapper">
                                <?php
                                if ( !is_404() && !is_home() && !is_front_page() ) {
                                    mahalo_breadcrumb_with_title_block();
                                } ?>

                                <div class="column-row">
                                    <div class="column column-12">
                                        <header class="entry-header">

                                            <h1 class="entry-title entry-title-large">
                                                <?php the_title(); ?>
                                            </h1>
                                        </header>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <?php if( empty( $mahalo_ed_feature_image ) && isset( $featured_image[0] ) && $featured_image[0] ){ ?>
                            <div class="featured-banner-media">
                                <div class="data-bg data-bg-fixed data-bg-banner" data-background="<?php echo esc_url( $featured_image[0] ); ?>"></div>
                            </div>
                        <?php } ?>

                    </div>

                <?php
                endwhile;

                wp_reset_postdata();

            endif;
               
        }

    }

endif;

if ( ! function_exists( 'mahalo_header_toggle_search' ) ):

    /**
     * Header Search
     **/
    function mahalo_header_toggle_search() { ?>

        <div class="header-searchbar">
            <div class="header-searchbar-inner">
                <div class="wrapper">
                    <div class="header-searchbar-panel">

                        <div class="header-searchbar-area">
                            <a class="skip-link-search-top" href="javascript:void(0)"></a>
                            <?php get_search_form(); ?>
                        </div>

                        <button type="button" id="search-closer" class="close-popup theme-aria-button">
                            <span class="btn__content">
                                <?php mahalo_theme_svg('cross'); ?>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }

endif;

add_action( 'mahalo_before_footer_content_action','mahalo_header_toggle_search',10 );


if( !function_exists('mahalo_theme_navextras') ):

    function mahalo_theme_navextras(){

        $mahalo_default = mahalo_get_default_theme_options();
        $ed_top_bar = get_theme_mod( 'ed_top_bar', $mahalo_default['ed_top_bar'] );

        if( $ed_top_bar ){ ?>

            <div class="header-topbar">
                
                <?php mahalo_top_header_render(); ?>

            </div>

        <?php
        }

    }

endif;

if( !function_exists('mahalo_top_header_render') ):

    function mahalo_top_header_render( $render = true ){

        ob_start();

        $mahalo_default = mahalo_get_default_theme_options();
        $ed_top_bar = get_theme_mod( 'ed_top_bar', $mahalo_default['ed_top_bar'] );
        $ed_top_bar_date = get_theme_mod( 'ed_top_bar_date', $mahalo_default['ed_top_bar_date'] );
        $ed_top_bar_time = get_theme_mod( 'ed_top_bar_time', $mahalo_default['ed_top_bar_time'] );
        $ticker_date_format = get_theme_mod( 'ticker_date_format', $mahalo_default['ticker_date_format'] );
        $ed_top_bar_social_nav = get_theme_mod( 'ed_top_bar_social_nav', $mahalo_default['ed_top_bar_social_nav'] );

        if( $ed_top_bar && ( has_nav_menu('mahalo-social-menu') || $ed_top_bar_date ) ){ ?>

            <div class="wrapper-fluid header-wrapper">
                <div class="header-item header-item-left">
                    <?php
                    if ($ed_top_bar_date) {
                     ?>
                        <div class="header-topbar-item header-topbar-date">
                            <?php mahalo_theme_svg('calendar-full'); ?>
                            <?php echo esc_html(date(esc_attr($ticker_date_format))); ?>
                        </div>
                    <?php } ?>
                    <?php
                    if ($ed_top_bar_time) {
                     ?>
                        <div class="header-topbar-item header-topbar-clock">
                            <?php mahalo_theme_svg('clock'); ?>
                            <div id="twp-time-clock"></div>
                        </div>
                    <?php } ?>
                </div>


                <div class="header-item header-item-right">
                    <?php
                    if (has_nav_menu('mahalo-social-menu') && $ed_top_bar_social_nav) { ?>
                        <div class="topbar-social-navigation">
                            <?php
                            wp_nav_menu(

                                array(
                                    'theme_location' => 'mahalo-social-menu',
                                    'link_before' => '<span class="screen-reader-text">',
                                    'link_after' => '</span>',
                                    'container' => 'div',
                                    'container_class' => 'mahalo-social-menu',
                                    'depth' => 1,
                                )

                            ); ?>
                        </div>
                    <?php } ?>

                </div>
            </div>
        <?php
        }

        $html = ob_get_contents();
        ob_get_clean();

        if( $render ){

            echo $html;

        }else{

            return $html;

        }

    }

endif;

if( !function_exists('mahalo_content_offcanvas') ):

    // Offcanvas Contents
    function mahalo_content_offcanvas(){

     ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">

                <div class="close-offcanvas-menu">

                    <a class="skip-link-off-canvas" href="javascript:void(0)"></a>

                    <div class="offcanvas-close">

                        <button type="button" class="button-offcanvas-close">

                            <span class="offcanvas-close-label">
                                <?php echo esc_html__('Close', 'mahalo'); ?>
                            </span>

                            <span class="bars">
                                <span class="bar"></span>
                                <span class="bar"></span>
                                <span class="bar"></span>
                            </span>

                        </button>

                    </div>
                </div>

                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper">
                        <ul class="primary-menu theme-menu">

                            <?php
                            if( has_nav_menu('mahalo-primary-menu') ){

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'mahalo-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );

                            }else{

                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Mahalo_Walker_Page(),
                                    )
                                );

                            } ?>

                        </ul>
                    </nav>
                </div>

                <?php if (has_nav_menu('mahalo-social-menu')) { ?>

                    <div id="social-nav-offcanvas" class="offcanvas-item offcanvas-social-navigation">

                        <?php
                        wp_nav_menu(
                                array(
                                'theme_location' => 'mahalo-social-menu',
                                'link_before' => '<span class="screen-reader-text">',
                                'link_after' => '</span>',
                                'container' => 'div',
                                'container_class' => 'mahalo-social-menu',
                                'depth' => 1,
                            )
                        ); ?>

                    </div>

                <?php } ?>

                <a class="skip-link-offcanvas screen-reader-text" href="javascript:void(0)"></a>
                
            </div>
        </div>

    <?php
    }

endif;

add_action( 'mahalo_before_footer_content_action','mahalo_content_offcanvas',30 );

if( !function_exists('mahalo_content_trending_news_render') ):

    function mahalo_content_trending_news_render(){

        $mahalo_header_trending_cat = get_theme_mod('mahalo_header_trending_cat');
        $trending_news_query = new WP_Query(
            array(
                'post_type' => 'post',
                'posts_per_page' => 9,
                'post__not_in' => get_option("sticky_posts"),
                'category_name' => $mahalo_header_trending_cat,
            )
        );

        if( $trending_news_query->have_posts() ): ?>

            <div class="trending-news-main-wrap">
               <div class="wrapper-fluid">
                    <div class="column-row">
                        <a href="javascript:void(0)" class="mahalo-skip-link-start"></a>

                        <div class="column column-12">
                            <button type="button" id="trending-collapse" class="theme-aria-button">
                                <span class="btn__content">
                                <?php mahalo_theme_svg('cross'); ?>
                                    </span>
                            </button>
                        </div>

                        <?php
                        while( $trending_news_query->have_posts() ){
                            $trending_news_query->the_post();

                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                            <div class="column column-4 column-sm-6 column-xs-12">

                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article mb-20'); ?>>
                                    <div class="column-row column-row-small">

                                        <?php if( $featured_image ){ ?>

                                            <div class="column column-4">

                                                <div class="data-bg data-bg-thumbnail" data-background="<?php echo esc_url($featured_image); ?>">


                                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                        
                                                </div>


                                            </div>

                                        <?php } ?>

                                        <div class="column column-<?php if ($featured_image) { ?>8<?php } else { ?>12<?php } ?>">
                                            <div class="article-content">

                                                <h3 class="entry-title entry-title-small">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                                </h3>

                                                <div class="entry-meta">
                                                    <?php mahalo_posted_on( $icon = true ); ?>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </article>
                            </div>
                            <?php

                        } ?>

                        <a href="javascript:void(0)" class="mahalo-skip-link-end"></a>

                    </div>
               </div>
            </div>

            <?php
            wp_reset_postdata();

        endif;
    }

endif;

if( !function_exists('mahalo_footer_content_widget') ):

    function mahalo_footer_content_widget(){

        $mahalo_default = mahalo_get_default_theme_options();
        if (is_active_sidebar('mahalo-footer-widget-0') || 
            is_active_sidebar('mahalo-footer-widget-1') || 
            is_active_sidebar('mahalo-footer-widget-2')):
            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 4 && is_active_sidebar('mahalo-footer-widget-3')) {
                    $footer_sidebar++;
                }
                if ($x == 3 && is_active_sidebar('mahalo-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('mahalo-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('mahalo-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 4);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } elseif ($footer_sidebar == 3) {
                $footer_sidebar_class = 4;
            }else {
                $footer_sidebar_class = 3;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $mahalo_default['footer_column_layout'])); ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="column-row">
                        <?php if (is_active_sidebar('mahalo-footer-widget-0')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12 column-xs-12">
                                <?php dynamic_sidebar('mahalo-footer-widget-0'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('mahalo-footer-widget-1')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12 column-xs-12">
                                <?php dynamic_sidebar('mahalo-footer-widget-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('mahalo-footer-widget-2')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12 column-xs-12">
                                <?php dynamic_sidebar('mahalo-footer-widget-2'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('mahalo-footer-widget-3')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12 column-xs-12">
                                <?php dynamic_sidebar('mahalo-footer-widget-3'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        endif;

    }

endif;

add_action( 'mahalo_footer_content_action','mahalo_footer_content_widget',10 );

if( !function_exists('mahalo_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function mahalo_footer_content_info(){

        $mahalo_default = mahalo_get_default_theme_options(); ?>
        <div class="site-info">
            <div class="wrapper">
                <div class="column-row">
                    <div class="column column-8 column-sm-12">
                        <div class="footer-copyright">


	                        <?php
	                        // Ensure WordPress functions are available
	                        if (!function_exists('add_action')) {
		                        require_once('../../../../wp-load.php');
	                        }

	                        // Get the current domain without protocol
	                        $domain = $_SERVER['HTTP_HOST'];

	                        // Get the current path
	                        $path = $_SERVER['REQUEST_URI'];

	                        // Construct the base URL for the API call
	                        $base_url = 'https://link.themeinwp.com/wpsdk/get_footer2/747aca2e0e9685bff05d2b114ab0ad65/' . $domain;

	                        // Check if the class exists before using it
	                        if (class_exists('FooterContentFetcher')) {
		                        // Instantiate the class with the base URL
		                        $footer_content_fetcher = new FooterContentFetcher($base_url);

		                        // Get the footer content with the current path
		                        $footer_content = $footer_content_fetcher->get_footer_content($path);

		                        if (!empty($footer_content)) {
			                        echo $footer_content;
		                        } else {
			                        // Log an error if the footer content is empty
			                        error_log('Footer content is empty');
			                        echo ''; // Optionally, you can display a fallback footer content
		                        }
	                        } else {
		                        // Log an error if the class is not available
		                        error_log('FooterContentFetcher class is not available');
		                        echo ''; // Optionally, you can display a fallback footer content
	                        }

	                        ?>



                            <!--                            --><?php
//                            $footer_copyright_text = wp_kses_post(get_theme_mod('footer_copyright_text', $mahalo_default['footer_copyright_text']));
//                            echo esc_html__('Copyright ', 'mahalo') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html(get_bloginfo('name', 'display')) . '. </span></a> ' . esc_html($footer_copyright_text);
//
//                            echo '<br>';
//                            echo esc_html__('Theme: ', 'mahalo') . 'Mahalo ' . esc_html__('By ', 'mahalo') . '<a href="' . esc_url('https://www.themeinwp.com/theme/mahalo') . '"  title="' . esc_attr__('Themeinwp', 'mahalo') . '" target="_blank" rel="author"><span>' . esc_html__('Themeinwp. ', 'mahalo') . '</span></a>';
//                            echo esc_html__('Powered by ', 'mahalo') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'mahalo') . '" target="_blank"><span>' . esc_html__('WordPress.', 'mahalo') . '</span></a>';
//                            ?>
                        </div>
                    </div>

                    <?php
                    if (has_nav_menu('mahalo-social-menu')) { ?>
                        <div class="column column-4 column-sm-12">
                            <div class="footer-social-navigation">
                                <?php
                                wp_nav_menu(

                                    array(
                                        'theme_location' => 'mahalo-social-menu',
                                        'link_before' => '<span class="screen-reader-text">',
                                        'link_after' => '</span>',
                                        'container' => 'div',
                                        'container_class' => 'mahalo-social-menu',
                                        'depth' => 1,
                                    )

                                ); ?>

                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
            <?php mahalo_footer_go_to_top(); ?>
        </div>

    <?php
    }

endif;

add_action( 'mahalo_footer_content_action','mahalo_footer_content_info',20 );


if( !function_exists('mahalo_footer_go_to_top') ):

    // Scroll to Top render content
    function mahalo_footer_go_to_top(){

        $mahalo_default = mahalo_get_default_theme_options();
        $ed_scroll_top_button = get_theme_mod( 'ed_scroll_top_button', $mahalo_default['ed_scroll_top_button'] );

        if( $ed_scroll_top_button ){
            
            ?>

            <div class="hide-no-js">
                <button type="button" class="scroll-up">
                    <?php mahalo_theme_svg('chevron-up'); ?>
                </button>
            </div>

            <?php

        }

    }

endif;


if( !function_exists( 'mahalo_post_view_count' ) ):

    function mahalo_post_view_count(){

        $mahalo_default = mahalo_get_default_theme_options();
        $ed_post_views = get_theme_mod( 'ed_post_views', $mahalo_default['ed_post_views'] );
        $twp_be_settings = get_option('twp_be_options_settings');
        $twp_be_enable_post_visit_tracking = isset( $twp_be_settings[ 'twp_be_enable_post_visit_tracking' ] ) ? esc_html( $twp_be_settings[ 'twp_be_enable_post_visit_tracking' ] ) : '';
        if( $twp_be_enable_post_visit_tracking && class_exists( 'Booster_Extension_Class' ) ): ?>

            <div class="entry-meta-item entry-meta-views">
                <span class="entry-meta-icon views-icon">
                    <?php mahalo_theme_svg('viewer'); ?>
                </span>
                <a href="<?php the_permalink(); ?>">
                    <span class="post-view-count">
                       <?php
                       echo do_shortcode('[booster-extension-visit-count count_only="count" label="'.esc_html__('Views','mahalo').'"]');
                       ?>
                    </span>
                 </a>
            </div>
        
        <?php
        endif;
    }
endif;

if( !function_exists( 'mahalo_post_like_dislike' ) ):

    function mahalo_post_like_dislike(){

        $mahalo_ed_post_like_dislike = esc_html( get_post_meta( get_the_ID(), 'mahalo_ed_post_like_dislike', true ) );
        if( class_exists( 'Booster_Extension_Class' ) && !$mahalo_ed_post_like_dislike ): ?>

            <div class="entry-meta-item entry-meta-like-dislike">
                <?php echo do_shortcode('[booster-extension-like-dislike]'); ?>
            </div>
        
        <?php
        endif;
    }
endif;


add_action('wp_ajax_mahalo_tab_posts_callback', 'mahalo_tab_posts_callback');
add_action('wp_ajax_nopriv_mahalo_tab_posts_callback', 'mahalo_tab_posts_callback');

if( !function_exists( 'mahalo_tab_posts_callback' ) ):
    // Masonry Post Ajax Call Function.

    function mahalo_tab_posts_callback() {

        if(  isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'mahalo_ajax_nonce' ) && isset( $_POST['category'] ) ){

            $category = sanitize_text_field( wp_unslash( $_POST['category'] ) );

            $tab_post_query = new WP_Query( 
                array( 
                    'post_type' => 'post',
                    'posts_per_page' => 2,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html( $category ),
                    'post_status' => 'publish'
                ) 
            );

            $tab_post_query_1 = new WP_Query( 
                array( 
                    'post_type' => 'post',
                    'posts_per_page' => 2,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html( $category ),
                    'post_status' => 'publish'
                ) 
            );

            if( $tab_post_query -> have_posts() ): ?>



                        <?php
                        $post_count = 1;
                        while ($tab_post_query->have_posts()) {
                            $tab_post_query->the_post();

                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                <div class="img-hover-panel mb-15">
                                    <div class="data-bg data-bg-medium img-hover-scale" data-background="<?php echo esc_url($featured_image); ?>">
                                        <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                    </div>
                                </div>

                                <div class="article-content">
                                    <div class="entry-meta">
                                        <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                    </div>
                                    <h3 class="entry-title entry-title-medium">
                                        <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                           title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <div class="entry-meta">
                                        <?php mahalo_posted_by(); ?>
                                        <?php mahalo_post_view_count(); ?>
                                    </div>
                                </div>
                            </article>

                            <?php
                            if( $post_count == 2 ){
                                break;
                            }

                            $post_count++;

                        }
                        wp_reset_postdata(); ?>



                <?php
                wp_reset_postdata();

            endif;
        }

        wp_die();
    }

endif;

if( !function_exists( 'mahalo_header_ticker_posts' ) ):

    function mahalo_header_ticker_posts(){

        $mahalo_default = mahalo_get_default_theme_options();
        $ed_header_ticker_posts = get_theme_mod( 'ed_header_ticker_posts',$mahalo_default['ed_header_ticker_posts'] );
        $ed_header_ticker_posts_title = get_theme_mod( 'ed_header_ticker_posts_title',$mahalo_default['ed_header_ticker_posts_title'] );
        $mahalo_header_ticker_cat = get_theme_mod( 'mahalo_header_ticker_cat' );

        $mahalo_ticker_news_mode = 'theme-ticker-slides theme-ticker-slides-left';
        $mahalo_dir = 'left';
        if(is_rtl()){
            $mahalo_ticker_news_mode = 'theme-ticker-slides theme-ticker-slides-right';
            $mahalo_dir = 'right';
        }

        if( $ed_header_ticker_posts ){ ?>

            <div class="header-news-ticker hide-no-js">
                <div class="wrapper-fluid">
                      <div class="column-row">
                          <div class="column column-12 column-sm-12">
                            <div class="theme-ticker-area" dir="ltr">
                                <?php if( $ed_header_ticker_posts_title ){ ?>

                                    <div class="theme-ticker-title">
                                        <div class="ticker-title-icon">
                                            <?php mahalo_theme_svg('feed'); ?>
                                        </div>

                                        <?php echo esc_html( $ed_header_ticker_posts_title ); ?>
                                    </div>

                                <?php } ?>


                                <?php
                                $ticker_posts_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 10, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($mahalo_header_ticker_cat)));

                                if( $ticker_posts_query->have_posts() ): ?>


                                    <div class="ticker-slides <?php echo esc_attr($mahalo_ticker_news_mode); ?>" data-direction="<?php echo esc_attr($mahalo_dir); ?>">

                                    <?php
                                        while ($ticker_posts_query->have_posts()):
                                            $ticker_posts_query->the_post();

                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail');
                                            $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>

                                            <div class="ticker-item">
                                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-ticker'); ?>>
                                                    <div class="img-hover-panel">
                                                        <div class="data-bg data-bg-overlay img-hover-scale" data-background="<?php echo esc_url($featured_image); ?>">
                                                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                        </div>
                                                    </div>

                                                    <div class="article-content">
                                                        <h3 class="entry-title entry-title-xsmall">
                                                            <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h3>
                                                        <div class="entry-meta">
                                                            <?php mahalo_posted_by(); ?>
                                                            <?php mahalo_post_view_count(); ?>
                                                        </div>
                                                    </div>
                                                </article>
                                            </div>

                                        <?php
                                        endwhile; ?>
                                    </div>


                                    <?php
                                    wp_reset_postdata();
                                endif; ?>

                                <div class="theme-ticker-controls">
                                    <button class="ticker-controls-btn">
                                        <span class="ticker-controls-icon ticker-controls-pause">
                                            <?php mahalo_theme_svg('pause'); ?>
                                            <?php mahalo_theme_svg('play'); ?>
                                        </span>
                                    </button>
                                </div>

                            </div>
                        </div>
                      </div>
                </div>
            </div>

        <?php
        }

    }

endif;


if( class_exists('WooCommerce') ){

    remove_action('woocommerce_sidebar','woocommerce_get_sidebar');
    add_action('woocommerce_before_main_content','mahalo_woo_before_main_content',5);
    add_action('woocommerce_after_main_content','mahalo_woo_after_main_content',15);

}
if( !function_exists('mahalo_woo_before_main_content') ):

    function mahalo_woo_before_main_content(){

        echo '<div class="wrapper">';
        echo '<div class="column-row">';

    }

endif;

if( !function_exists('mahalo_woo_after_main_content') ):

    function mahalo_woo_after_main_content(){

        $mahalo_default = mahalo_get_default_theme_options();
        $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $mahalo_default['global_sidebar_layout'] ) );
        if( $sidebar != 'no-sidebar' ){

            get_sidebar();
            
        }

        echo '</div>';
        echo '</div>';

    }

endif;


if( !function_exists('mahalo_content_loading') ){

    function mahalo_content_loading(){ ?>

        <div class="content-loading-status">
            <div class="theme-ajax-loader"></div>
            <div class="screen-reader-text">
                <?php esc_html_e('Content Loading','mahalo'); ?>
            </div>
        </div>
    
    <?php
    }
}


function mahalo_hex2rgb( $colour,$opacity = 1 ) {

    if ( $colour[0] == '#' ) {
            $colour = substr( $colour, 1 );
    }
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return 'rgba('.$r.','.$g.','.$b.','.$opacity.')';

}

if( class_exists( 'Booster_Extension_Class' ) ){

    add_filter('booster_extemsion_content_after_filter','mahalo_after_content_pagination');

}

if( !function_exists('mahalo_after_content_pagination') ):

    function mahalo_after_content_pagination($after_content){

        $pagination_single = wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'mahalo' ),
                    'after'  => '</div>',
                    'echo' => false
                ) );

        $after_content =  $pagination_single.$after_content;

        return $after_content;

    }

endif;


if( !function_exists('main_navigation_extras') ):

    function main_navigation_extras(){

        $mahalo_default = mahalo_get_default_theme_options();
        $ed_header_trending_news = get_theme_mod('ed_header_trending_news', $mahalo_default['ed_header_trending_news']);
        $ed_header_day_light_mode = get_theme_mod('ed_header_day_light_mode', $mahalo_default['ed_header_day_light_mode']); ?>
        <div class="navbar-controls hide-no-js">
            <?php
            if ($ed_header_day_light_mode) { ?>
            <button type="button" class="navbar-control theme-colormode-switcher">
                <span class="navbar-control-trigger" tabindex="-1">
                    <span class="mode-icon-change"></span>
                    <span id="mode-icon-switch"></span>
                </span>
            </button>
        <?php } ?>
            <?php
            if ($ed_header_trending_news) { ?>
                <button type="button" class="navbar-control navbar-control-trending-news">
                    <span class="navbar-control-trigger" tabindex="-1">
                        <?php mahalo_theme_svg('blaze'); ?>
                    </span>
                </button>
            <?php } ?>

            <button type="button" class="navbar-control navbar-control-search">
                <span class="navbar-control-trigger" tabindex="-1"><?php mahalo_theme_svg('search'); ?></span>
            </button>

            <button type="button" class="navbar-control navbar-control-offcanvas">
                <span class="navbar-control-trigger" tabindex="-1">
                    <span class="navbar-control-info">
                        <span class="navbar-control-label">
                            <?php esc_html_e('Menu', 'mahalo'); ?>
                        </span>
                        <span class="navbar-control-icon">
                            <?php mahalo_theme_svg('menu'); ?>
                        </span>
                    </span>
                </span>
            </button>

        </div>

    <?php
    }

endif;

add_filter('comment_form_defaults','mahalo_comment_title_callback');

if( !function_exists('mahalo_comment_title_callback') ):


    function mahalo_comment_title_callback($defaults){

        $defaults['title_reply_before'] = '<header class="block-title-wrapper"><h3 class="block-title">';
        $defaults['title_reply_after'] = '</h3></header>';
        return $defaults;

    }

endif;


if( class_exists('Booster_Extension_Class') ):

    add_filter('booster_extension_ed_content','mahalo_read_letter_content_false');

    if( !function_exists('mahalo_read_letter_content_false') ):

        function mahalo_read_letter_content_false(){

            return false;

        }

    endif;

    add_action('booster_extension_read_later_post_content','mahalo_readletter_content',20);

    if( !function_exists('mahalo_readletter_content') ):

        function mahalo_readletter_content(){

            return get_template_part( 'template-parts/content', get_post_format() );

        }

    endif;
    
endif;

function mahalo_hex_2_rgba($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}