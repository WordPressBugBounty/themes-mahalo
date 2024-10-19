<?php
/**
 * Full Widht Slider Banner
 *
 * @package Mahalo
 */
if (!function_exists('mahalo_fullwidth_banner_slider')):
    function mahalo_fullwidth_banner_slider($mahalo_home_section, $repeat_times)
    {
        $section_post_slide_cat = esc_html(isset($mahalo_home_section->section_post_slide_cat) ? $mahalo_home_section->section_post_slide_cat : '');
        $banner_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_slide_cat)));
        if ($banner_query_1->have_posts()):
            ?>
            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-default-slider">
                <?php if (is_rtl()) {
                    $rtl = 'true';
                } else {
                    $rtl = 'false';
                } ?>
                <div class="main-slider-container" data-slick='{"rtl": <?php echo esc_attr($rtl); ?>}'>
                    <?php
                    $slider_pagenav = '';
                    while ($banner_query_1->have_posts()) {
                        $banner_query_1->the_post();
                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';                  
                        $featured_image_medium = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                        $featured_image_medium = isset($featured_image_medium[0]) ? $featured_image_medium[0] : '';
                        ?>
                        <div class="slider-item">
                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                <div class="data-bg data-bg-full data-bg-overlay img-hover-shine" data-background="<?php echo esc_url($featured_image); ?>">
                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                </div>
                                <div class="article-content article-content-overlay">
                                    <div class="wrapper">
                                        <div class="column-row">
                                            <div class="column column-8 column-sm-12">
                                                <div class="entry-meta entry-meta-top">
                                                    <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>

                                                <h2 class="entry-title entry-title-large">
                                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                                       title="<?php the_title_attribute(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h2>

                                                <div class="entry-meta entry-meta-bottom">
                                                        <?php mahalo_posted_by(); ?>
                                                        <?php mahalo_post_view_count(); ?>
                                                </div>
                                                <div class="entry-content hidden-sm-element entry-content-muted content-muted-big">
                                                    <?php
                                                    if (has_excerpt()) {
                                                        the_excerpt();
                                                    } else {
                                                        echo '<p>';
                                                        echo esc_html(wp_trim_words(get_the_content(), 40, '...'));
                                                        echo '</p>';
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <?php
                        $slider_pagenav .= '<div class="slider-pagination-item">';
                        $slider_pagenav .= '<div class="slider-pagination-image"><div class="data-bg data-bg-thumbnail" data-background="' . esc_url($featured_image_medium) . '"></div></div>';
                        $slider_pagenav .= '<div class="slider-pagination-content"><h4 class="slider-pagination-title"><span>' . esc_html(get_the_title()) . '</span></h4></div>';
                        $slider_pagenav .= '</div>';
                        ?>
                    <?php } ?>
                </div>
                <div class="slider-pagination-container">
                    <div class="main-slider-pagination">
                        <?php echo $slider_pagenav; ?>
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata();
        endif;
    }
endif;