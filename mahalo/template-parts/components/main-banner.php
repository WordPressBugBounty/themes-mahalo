<?php
/**
 * Main Banner
 *
 * @package Mahalo
 */
if (!function_exists('mahalo_main_banner')):
    function mahalo_main_banner($mahalo_home_section, $repeat_times)
    {
        $section_post_slide_cat = esc_html(isset($mahalo_home_section->section_post_slide_cat) ? $mahalo_home_section->section_post_slide_cat : '');
        $home_section_main_title = esc_html(isset($mahalo_home_section->home_section_main_title) ? $mahalo_home_section->home_section_main_title : '');
        $section_post_number = esc_html(isset($mahalo_home_section->section_post_number) ? $mahalo_home_section->section_post_number : 4);


        $banner_query_1 = new WP_Query(array('post_type' => 'post', 'posts_per_page' => $section_post_number, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_post_slide_cat)));
        if ($banner_query_1->have_posts()):
            ?>
            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-jumbo-banner">
                <?php if ($home_section_main_title) { ?>
                    <header class="theme-block-header">
                        <div class="theme-block-title">
                            <h2 class="block-title">
                                <?php echo esc_html($home_section_main_title); ?>
                            </h2>
                        </div>
                    </header>
                <?php } ?>

                <div class="wrapper">
                    <div class="column-row">
                        <?php
                        $count = 1;
                        while ($banner_query_1->have_posts()) {
                            $banner_query_1->the_post();
                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';


                            switch ($section_post_number) {
                                case 3:
                                    $block_classes = 'column-6';
                                    $image_classes = 'data-bg-big';
                                    $title_classes = 'entry-title-big';
                                    break;
                                
                                case 4:
                                    $block_classes = 'column-4';
                                    $image_classes = 'data-bg-medium';
                                    $title_classes = 'entry-title-medium';
                                    break;

                                case 5:
                                    $block_classes = 'column-3';
                                    $image_classes = 'data-bg-small';
                                    $title_classes = 'entry-title-small';
                                    break;
                                
                                default:
                                    $block_classes = '';
                                    $image_classes = '';
                                    break;
                            }
                            ?>
                            <?php if ($count == 1) { ?>
                                <div class="column column-12 mb-md-20">
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-lead news-article-panel'); ?>>

                                        <div class="data-bg data-bg-large data-bg-overlay img-hover-shine" data-background="<?php echo esc_url($featured_image); ?>">
                                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                        </div>

                                        <div class="article-content mt-15">
                                            <div class="entry-meta">
                                                <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                            </div>
                                            <h2 class="entry-title entry-title-large">
                                                <a href="<?php the_permalink(); ?>" tabindex="0"
                                                   rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>
                                            <div class="entry-footer">
                                                <div class="entry-meta">
                                                    <?php mahalo_posted_by(); ?>
                                                    <?php mahalo_post_view_count(); ?>
                                                </div>
                                            </div>

                                            <div class="entry-content hidden-xs-element entry-content-muted">
                                                <?php
                                                if (has_excerpt()) {
                                                    the_excerpt();
                                                } else {
                                                    echo '<p>';
                                                    echo esc_html(wp_trim_words(get_the_content(), 30, '...'));
                                                    echo '</p>';
                                                } ?>
                                            </div>
                                        </div>
                                    </article>
                                </div>

                                <?php $count++;
                            } else { ?>
                                <div class="column <?php echo $block_classes; ?> column-sm-12 mb-md-20">
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                        <div class="img-hover-panel">
                                            <div class="data-bg img-hover-scale <?php echo $image_classes; ?>" data-background="<?php echo esc_url($featured_image); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                            </div>
                                        </div>

                                        <div class="article-content mt-15">
                                            <div class="entry-meta">
                                                <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                            </div>
                                            <h2 class="entry-title <?php echo $title_classes; ?>">
                                                <a href="<?php the_permalink(); ?>" tabindex="0"
                                                   rel="bookmark" title="<?php the_title_attribute(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>
                                            <div class="entry-footer">
                                                <div class="entry-meta">
                                                    <?php mahalo_posted_by(); ?>
                                                    <?php mahalo_post_view_count(); ?>
                                                </div>
                                            </div>

                                        </div>
                                    </article>
                                </div>
                            <?php } ?>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <?php wp_reset_postdata();
        endif;
    }
endif; ?>
