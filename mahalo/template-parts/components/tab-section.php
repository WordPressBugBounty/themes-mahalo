<?php
/**
 * Banner Blocks One
 *
 * @package Mahalo
 */
if (!function_exists('mahalo_banner_block_1_section')):
    function mahalo_banner_block_1_section($mahalo_home_section,$repeat_times)
    {
        $section_post_slide_cat = esc_html(isset($mahalo_home_section->section_post_slide_cat) ? $mahalo_home_section->section_post_slide_cat : '');
        
        $section_category_1 = esc_html(isset($mahalo_home_section->section_category_1) ? $mahalo_home_section->section_category_1 : '');
        $section_category_2 = esc_html(isset($mahalo_home_section->section_category_2) ? $mahalo_home_section->section_category_2 : '');
        $section_category_3 = esc_html(isset($mahalo_home_section->section_category_3) ? $mahalo_home_section->section_category_3 : '');
        $section_category_4 = esc_html(isset($mahalo_home_section->section_category_4) ? $mahalo_home_section->section_category_4 : '');

        $ed_tab = esc_html(isset($mahalo_home_section->ed_tab) ? $mahalo_home_section->ed_tab : '');
        $ed_flip_column = esc_html(isset($mahalo_home_section->ed_flip_column) ? $mahalo_home_section->ed_flip_column : '');
        $home_section_title_1 = esc_html(isset($mahalo_home_section->home_section_title_1) ? $mahalo_home_section->home_section_title_1 : '');
        $banner_post_slide_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 5, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_slide_cat)));
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
        if ($ed_tab == 'yes' && ($section_category_1 || $section_category_2 || $section_category_3 || $section_category_4)) {
            $cat_array = array();
            if ($section_category_1) {
                $cat_array[] = $section_category_1;
            }
            if ($section_category_2) {
                $cat_array[] = $section_category_2;
            }
            if ($section_category_3) {
                $cat_array[] = $section_category_3;
            }
            if ($section_category_4) {
                $cat_array[] = $section_category_4;
            }
            $banner_query_all = new WP_Query(
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 2,
                    'post__not_in' => get_option("sticky_posts"),
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field' => 'slug',
                            'terms' => $cat_array,
                        ),
                    ),
                )
            );
        } else {
            $banner_query_all = new WP_Query(
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 2,
                    'post__not_in' => get_option("sticky_posts"),
                    'category_name' => esc_html($section_category_1)
                )
            );
        }
        ?>
        <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-navtabs <?php
        if (empty($home_section_title_1)) {
            echo ' no-title-slide';
        } ?>">

            <?php if ($home_section_title_1) { ?>
                <header class="theme-block-header">
                    <div class="theme-block-title">
                        <h2 class="block-title">
                            <?php echo esc_html($home_section_title_1); ?>
                        </h2>
                    </div>
                </header>
            <?php } ?>

            <div class="wrapper">
                <div class="column-row">
                    <?php if ($banner_post_slide_query->have_posts()): ?>
                        <div class="column column-7 column-md-12 column-sm-12 column-xs-12 mb-md-20 <?php if ($ed_flip_column != 'yes') { ?>column-order-1<?php } else { ?>column-order-3<?php } ?>">
                            <?php if ($home_section_title_1) { ?>

                                    <?php if( $arrow == 'true' ){ ?>

                                    <div class="slider-block-navarea">
                                        <button type="button" class="slide-btn slide-btn-small slide-prev-lead">
                                            <?php mahalo_theme_svg('chevron-left'); ?>
                                        </button>
                                        <button type="button" class="slide-btn slide-btn-small slide-next-lead">
                                            <?php mahalo_theme_svg('chevron-right'); ?>
                                        </button>
                                    </div>

                                    <?php } ?>

                            <?php } ?>
                            <div class="theme-slider-block" data-slick='{"arrows": <?php echo esc_attr($arrow); ?>,"autoplay": <?php echo esc_attr($autoplay); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>
                                <?php
                                while ($banner_post_slide_query->have_posts()) {
                                    $banner_post_slide_query->the_post();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $featured_image = isset( $featured_image[0] ) ? $featured_image[0] : ''; ?>
                                    <div class="theme-slider-item">
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                            <div class="data-bg data-bg-large img-hover-shine" data-background="<?php echo esc_url($featured_image); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                            </div>

                                            <div class="article-content mt-20">
                                                <div class="entry-meta">
                                                    <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>

                                                <h2 class="entry-title entry-title-big">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h2>

                                                <div class="entry-meta">
                                                    <?php mahalo_posted_by(); ?>
                                                    <?php mahalo_post_view_count(); ?>
                                                </div>

                                                <div class="entry-content hidden-xs-element entry-content-muted">
                                                    <?php
                                                    if (has_excerpt()) {
                                                        the_excerpt();
                                                    } else {
                                                        echo '<p>';
                                                        echo esc_html( wp_trim_words( get_the_content(),30,'...' ) );
                                                        echo '</p>';
                                                    } ?>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        wp_reset_postdata();
                    endif; ?>

                    <div class="column column-1 column-md-12 column-sm-12 column-order-2">
                        <div class="theme-svg-seperator">
                            <?php mahalo_theme_svg('seperator'); ?>
                        </div>
                    </div>

                    <div class="column column-4 column-md-12 column-sm-12 column-xs-12 <?php if ($ed_flip_column != 'yes') { ?>column-order-3<?php } else { ?>column-order-1<?php } ?>">
                        <?php if (($ed_tab == 'yes' && ($section_category_1 || $section_category_2 || $section_category_3 || $section_category_4))) { ?>
                            <header class="block-title-wrapper">
                                <?php
                                if ($ed_tab == 'yes' && ($section_category_1 || $section_category_2 || $section_category_3 || $section_category_4)) { ?>

                                    <div class="theme-tab-controls">
                                        <div class="tab-posts hide-no-js">
                                            <a cat-data="all" class="active-tab"
                                               href="javascript:void(0)"><?php esc_html_e('All', 'mahalo'); ?></a>
                                            <?php
                                            if ($section_category_1 && $ed_tab == 'yes') {
                                                $catObj = get_category_by_slug($section_category_1);
                                                if (isset($catObj->name) && $catObj->name) { ?>
                                                    <a cat-data="<?php echo esc_attr($section_category_1); ?>" href="javascript:void(0)">
                                                        <?php echo esc_html($catObj->name); ?>
                                                    </a>
                                                <?php }
                                            }
                                            if ($section_category_2 && $ed_tab == 'yes') {
                                                $catObj = get_category_by_slug($section_category_2);
                                                if (isset($catObj->name) && $catObj->name) { ?>
                                                    <a cat-data="<?php echo esc_attr($section_category_2); ?>" href="javascript:void(0)">
                                                        <?php echo esc_html($catObj->name); ?>
                                                    </a>
                                                <?php }
                                            }
                                            if ($section_category_3 && $ed_tab == 'yes') {
                                                $catObj = get_category_by_slug($section_category_3);
                                                if (isset($catObj->name) && $catObj->name) { ?>
                                                    <a cat-data="<?php echo esc_attr($section_category_3); ?>" href="javascript:void(0)">
                                                        <?php echo esc_html($catObj->name); ?>
                                                    </a>
                                                <?php }
                                            }
                                            if ($section_category_4 && $ed_tab == 'yes') {
                                                $catObj = get_category_by_slug($section_category_4);
                                                if (isset($catObj->name) && $catObj->name) { ?>
                                                    <a cat-data="<?php echo esc_attr($section_category_4); ?>" href="javascript:void(0)">
                                                        <?php echo esc_html($catObj->name); ?>
                                                    </a>
                                                <?php }
                                            } ?>
                                        </div>
                                    </div>



                                <?php } ?>
                            </header>
                        <?php }
                        if ($banner_query_all->have_posts()): ?>
                            <div class="tab-contents tab-content-all content-loaded content-active">
                                <?php
                                $post_count = 1;
                                while ($banner_query_all->have_posts()) {
                                    $banner_query_all->the_post();
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
                                } ?>
                            </div>
                            <?php
                            wp_reset_postdata();
                        endif; ?>
                        <?php if ($ed_tab == 'yes' && $section_category_1) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_1); ?>" class="tab-contents tab-content-<?php echo esc_attr($section_category_1); ?>">
                                <?php mahalo_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($ed_tab == 'yes' && $section_category_2) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_2); ?>" class="tab-contents tab-content-<?php echo esc_attr($section_category_2); ?>">
                                <?php mahalo_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($ed_tab == 'yes' && $section_category_3) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_3); ?>" class="tab-contents tab-content-<?php echo esc_attr($section_category_3); ?>">
                                <?php mahalo_content_loading(); ?>
                            </div>
                        <?php } ?>
                        <?php if ($ed_tab == 'yes' && $section_category_4) { ?>
                            <div data-cat="<?php echo esc_attr($section_category_4); ?>" class="tab-contents tab-content-<?php echo esc_attr($section_category_4); ?>">
                                <?php mahalo_content_loading(); ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="theme-footer-link theme-block-footer">
                <div class="wrapper">
                    <div class="column-row">
                        <div class="column column-12 column-sm-12">
                            <div class="theme-footer-panel block-footer-panel">
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php
    }
endif;
