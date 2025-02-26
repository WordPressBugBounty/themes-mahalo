<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mahalo
 * @since 1.0.0
 */
get_header();

    $mahalo_default = mahalo_get_default_theme_options();
    $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $mahalo_default['global_sidebar_layout'] ) );
    $mahalo_archive_layout = esc_attr( get_theme_mod( 'mahalo_archive_layout', $mahalo_default['mahalo_archive_layout'] ) ); ?>


    <header class="theme-header-default theme-archive-header">
        <div class="wrapper">
            <?php mahalo_breadcrumb_with_title_block(); ?>
        </div>
    </header>

    <div class="theme-block theme-block-archive">


                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">
                        
                        <?php
                        if( have_posts() ): ?>

                            <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr( $mahalo_archive_layout ); ?>">

                                <?php while( have_posts() ):
                                    the_post();

                                    get_template_part( 'template-parts/content', get_post_format() );

                                endwhile; ?>

                            </div>

                            <?php do_action('mahalo_archive_pagination');

                        else :

                            get_template_part('template-parts/content', 'none');

                        endif; ?>

                    </main><!-- #main -->
                </div>

                <?php if( $sidebar != 'no-sidebar' ){

                    get_sidebar();
                    
                } ?>


    </div>

<?php
get_footer();
