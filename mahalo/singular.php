<?php
/**
 * The template for displaying single posts and pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mahalo
 * @since 1.0.0
 */
get_header();

$current_id = '';
if( have_posts() ):
    while (have_posts()) :
    the_post();
        $current_id  = get_the_ID();
    endwhile;
    wp_reset_postdata();
endif;
    
    $mahalo_default = mahalo_get_default_theme_options();
    $sidebar = get_theme_mod( 'global_sidebar_layout', $mahalo_default['global_sidebar_layout'] );
    $mahalo_post_sidebar = esc_attr( get_post_meta( $current_id, 'mahalo_post_sidebar_option', true ) );
    $twp_navigation_type = esc_attr( get_post_meta( $current_id, 'twp_disable_ajax_load_next_post', true ) );
    $mahalo_header_trending_page = get_theme_mod( 'mahalo_header_trending_page' );
    $mahalo_header_popular_page = get_theme_mod( 'mahalo_header_popular_page' );
    $mahalo_archive_layout = esc_attr( get_theme_mod( 'mahalo_archive_layout', $mahalo_default['mahalo_archive_layout'] ) );
    $article_wrap_class = '';
    $single_layout_class = ' single-layout-default';

    if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
        $twp_navigation_type = get_theme_mod('twp_navigation_type', $mahalo_default['twp_navigation_type']);
    }

    if( $mahalo_post_sidebar == 'global-sidebar' || empty( $mahalo_post_sidebar ) ){
        $sidebar = $sidebar;
    }else{
        $sidebar = $mahalo_post_sidebar;
    }
    $mahalo_post_layout = esc_attr( get_post_meta( $current_id, 'mahalo_post_layout', true ) );
    if( $mahalo_post_layout == '' || $mahalo_post_layout == 'global-layout' ){
        
        $mahalo_post_layout = get_theme_mod( 'mahalo_single_post_layout',$mahalo_default['mahalo_archive_layout'] );
    }
    if( $mahalo_post_layout == 'layout-2' ){
        $single_layout_class = ' single-layout-banner';
    }
    if( $mahalo_header_trending_page == $current_id || $mahalo_header_popular_page == $current_id ){
        $article_wrap_class = 'archive-layout-' . esc_attr($mahalo_archive_layout);
        $single_layout_class = '';
    }
    $mahalo_header_trending_page = get_theme_mod( 'mahalo_header_trending_page' );
    $mahalo_header_popular_page = get_theme_mod( 'mahalo_header_popular_page' );
    if( $mahalo_header_trending_page == get_the_ID() || $mahalo_header_popular_page == get_the_ID() ){

        $breadcrumb = true;

    }
    $mahalo_ed_post_rating = get_post_meta( $post->ID, 'mahalo_ed_post_rating', true ); ?>

    <div class="theme-block theme-block-single">

        <div id="primary" class="content-area">
            <main id="main" class="site-main <?php if( $mahalo_ed_post_rating ){ echo 'mahalo-no-comment'; } ?>" role="main">

                <?php
                if( !is_home() && !is_front_page() && ( isset( $breadcrumb ) || $mahalo_post_layout != 'layout-2' ) ) {
                    mahalo_breadcrumb_with_title_block();
                }

                if( have_posts() ): ?>

                    <div class="article-wraper single-layout <?php echo esc_attr($article_wrap_class.$single_layout_class); ?>">

                        <?php while (have_posts()) :
                            the_post();

                            get_template_part('template-parts/content', 'single');

                            /**
                             *  Output comments wrapper if it's a post, or if comments are open,
                             * or if there's a comment number – and check for password.
                            **/
                            if ( $mahalo_header_trending_page != $current_id && $mahalo_header_popular_page != $current_id ) {

                                if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && !post_password_required() ) { ?>

                                    <div class="comments-wrapper">
                                        <?php comments_template(); ?>
                                    </div>

                                <?php
                                }
                            }

                        endwhile; ?>

                    </div>

                <?php
                else :

                    get_template_part('template-parts/content', 'none');

                endif;

                /**
                 * Navigation
                 *
                 * @hooked mahalo_post_floating_nav - 10
                 * @hooked mahalo_related_posts - 20
                 * @hooked mahalo_single_post_navigation - 30
                */

                do_action('mahalo_navigation_action'); ?>

            </main><!-- #main -->
        </div>

        <?php
        if( class_exists('WooCommerce') && ( is_cart() || is_checkout() ) ){
            $sidebar_status = false;
        }else{
            $sidebar_status = true;
        }
        if ( $sidebar != 'no-sidebar' && $sidebar_status ) {
            get_sidebar();
        } ?>

    </div>

<?php
get_footer();
