<?php
/**
 * You May Like Blocks
 *
 * @package Mahalo
 */
if (!function_exists('mahalo_you_may_like_block_section')):
    function mahalo_you_may_like_block_section($mahalo_home_section,$repeat_times){

        $section_category = esc_html( isset($mahalo_home_section->section_category) ? $mahalo_home_section->section_category : '');
        $home_section_title = isset($mahalo_home_section->home_section_title) ? $mahalo_home_section->home_section_title : '';
        $you_may_like_post_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => '4','post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html( $section_category ) ) );
        if( $you_may_like_post_query ->have_posts() ): ?>

            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-recommended theme-block-border theme-bg-1">
                <?php if ($home_section_title || $section_category) { ?>
                    <header class="theme-block-header-alt">
                        <div class="wrapper">
                            <div class="theme-block-title-alt">
                                <h2 class="block-title-alt"><?php echo esc_html($home_section_title); ?></h2>
                            </div>
                        </div>
                    </header>
                <?php } ?>

                <div class="wrapper-fluid">
                    <div class="column-row">
                        <?php if( $you_may_like_post_query ->have_posts() ){

                            while( $you_may_like_post_query ->have_posts() ){
                                $you_may_like_post_query ->the_post();
                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : '';
                                ?>

                                <div class="column column-3 column-sm-6 column-xs-12">
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class( 'news-article news-article-panel' ); ?>>
                                        <div class="img-hover-panel">
                                            <div class="data-bg data-bg-medium img-hover-scale" data-background="<?php echo esc_url($featured_image); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                            </div>
                                            <div class="article-content article-content-overlay text-center">
                                                <div class="entry-meta">
                                                    <?php mahalo_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="article-content mt-20 text-center">
                                            <h3 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div class="entry-meta">
                                                <?php mahalo_posted_by(); ?>
                                                <?php mahalo_post_view_count(); ?>
                                            </div>
                                        </div>
                                    </article>

                                </div>

                            <?php
                            }
                        } ?>
                    </div>



                </div>

                <?php if ($section_category) {

                    $catObj = get_category_by_slug($section_category);
                    $cat_link = get_category_link($catObj->term_id); ?>

                    <div class="theme-footer-link theme-block-footer">
                        <div class="wrapper">
                            <div class="column-row">
                                <div class="column column-12 column-sm-12">
                                    <div class="theme-footer-panel block-footer-panel">
                                        <hr>
                                        <a href="<?php echo esc_url($cat_link); ?>" class="theme-viewmore-link">
                                            <?php esc_html_e('View All', 'mahalo'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

        <?php
        wp_reset_postdata();
        endif;

    }
endif;