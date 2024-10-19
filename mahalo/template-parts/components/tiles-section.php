<?php
/**
 * Tiles Blocks
 *
 * @package Mahalo
 */
if (!function_exists('mahalo_tiles_block_section')):
    function mahalo_tiles_block_section($mahalo_home_section, $repeat_times)
    {
        $section_category = esc_html(isset($mahalo_home_section->section_category) ? $mahalo_home_section->section_category : '');
        $section_category_tile_slider = esc_html(isset($mahalo_home_section->section_category_tile_slider) ? $mahalo_home_section->section_category_tile_slider : '');
        $home_section_title = isset($mahalo_home_section->home_section_title) ? $mahalo_home_section->home_section_title : '';

        $tiles_post_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_category_tile_slider)));

        $tiles_post_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_category)));

        $slider_arrows = esc_html(isset($mahalo_home_section->ed_arrows_carousel) ? $mahalo_home_section->ed_arrows_carousel : '');
        $slider_dots = esc_html(isset($mahalo_home_section->ed_dots_carousel) ? $mahalo_home_section->ed_dots_carousel : '');
        $slider_autoplay = esc_html(isset($mahalo_home_section->ed_autoplay_carousel) ? $mahalo_home_section->ed_autoplay_carousel : '');
        
        if ($slider_arrows == 'yes' || $slider_arrows == '') {
            $arrow = 'true';
        } else {
            $arrow = 'false';
        }
        if ($slider_autoplay == 'yes' || $slider_autoplay == '') {
            $autoplay = 'true';
        } else {
            $autoplay = 'false';
        }
        if ($slider_dots == 'yes') {
            $dots = 'true';
        } else {
            $dots = 'false';
        }
        if (is_rtl()) {
            $rtl = 'true';
        } else {
            $rtl = 'false';
        }
        ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-tiles">

            <?php if ($home_section_title) { ?>


                <header class="theme-block-header">
                    <div class="theme-block-title">
                        <h2 class="block-title">
                            <?php echo esc_html($home_section_title); ?>
                        </h2>
                    </div>
                </header>

            <?php } ?>

            <div class="wrapper">
                <div class="column-row column-row-collapse">
                    <div class="column column-5 column-md-12 column-sm-12">
                        <?php if( $arrow == 'true' ){ ?>
                            <div class="slider-block-navarea">
                                <button type="button" class="slide-btn slide-btn-small slide-prev-tiles">
                                    <?php mahalo_theme_svg('chevron-left'); ?>
                                </button>
                                <button type="button" class="slide-btn slide-btn-small slide-next-tiles">
                                    <?php mahalo_theme_svg('chevron-right'); ?>
                                </button>
                            </div>
                        <?php } ?>

                        <div class="theme-tiles-slide" data-slick='{"arrows": <?php echo esc_attr($arrow); ?>,"autoplay": <?php echo esc_attr($autoplay); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                            <?php

                            if ($tiles_post_query_1->have_posts()) {
                                while ($tiles_post_query_1->have_posts()) {
                                    $tiles_post_query_1->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';
                                    ?>

                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                        <div class="data-bg data-bg-xbig data-bg-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                        </div>

                                        <div class="article-content article-content-overlay">
                                            <div class="entry-meta">
                                                <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                            </div>
                                            <h3 class="entry-title entry-title-big">
                                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                   title="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="entry-meta">
                                                <?php mahalo_posted_by(); ?>
                                                <?php mahalo_post_view_count(); ?>
                                            </div>
                                        </div>
                                    </article>

                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    if ($tiles_post_query->have_posts()) { ?>
                        <div class="column column-7 column-md-12 column-sm-12">
                            <div class="column-row column-row-collapse">
                                <?php
                                while ($tiles_post_query->have_posts()) {
                                    $tiles_post_query->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    ?>
                                    <div class="column column-6 column-xxs-12">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                            <div class="data-bg data-bg-medium data-bg-overlay img-hover-slide" data-background="<?php echo esc_url($featured_image[0]); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                            </div>

                                            <div class="article-content article-content-overlay">
                                                <div class="entry-meta">
                                                    <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>
                                                <h3 class="entry-title entry-title-medium">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                       title="<?php the_title_attribute(); ?>">
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
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
        wp_reset_postdata();
    }
endif;