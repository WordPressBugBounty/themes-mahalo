<?php
/**
 * Latest Posts
 *
 * @package Mahalo
 */
if( !function_exists('mahalo_latest_blocks') ):
    
    function mahalo_latest_blocks($mahalo_home_section,$repeat_times){

        global $post;
        $mahalo_default = mahalo_get_default_theme_options();
        $sidebar = esc_attr( get_theme_mod( 'global_sidebar_layout', $mahalo_default['global_sidebar_layout'] ) );

        $mahalo_archive_layout = esc_attr( get_theme_mod( 'mahalo_archive_layout', $mahalo_default['mahalo_archive_layout'] ) ); ?>
        <div id="theme-block-<?php echo esc_attr( $repeat_times ); ?>" class="theme-block theme-block-archive">

            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">

                        <?php
                        if( !is_front_page() && !is_home()  ) {
                            mahalo_breadcrumb_with_title_block();
                        }

                        if( have_posts() ): ?>

                            <div class="article-wraper archive-layout <?php echo 'archive-layout-' . esc_attr( $mahalo_archive_layout ); ?>">
                                <?php while (have_posts()) :
                                    the_post();

                                    if( !is_page() ){

                                        get_template_part( 'template-parts/content', get_post_format() );

                                    }else{
                                        get_template_part('template-parts/content', 'single');
                                    }


                                endwhile; ?>
                            </div>

                            <?php if( !is_page() ): do_action('mahalo_archive_pagination'); endif;

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
    }
    
endif;
