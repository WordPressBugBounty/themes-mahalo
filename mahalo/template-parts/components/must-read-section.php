<?php
/**
 * Must Read
 *
 * @package Mahalo
 */
if (!function_exists('mahalo_must_read')):
    function mahalo_must_read($mahalo_home_section, $repeat_times)
    {
        $section_category_6 = esc_html(isset($mahalo_home_section->section_category_6) ? $mahalo_home_section->section_category_6 : '');
        $home_section_must_read = esc_html(isset($mahalo_home_section->home_section_must_read) ? $mahalo_home_section->home_section_must_read : '');

        $must_read_section = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option("sticky_posts"), 'category_name' => esc_html($section_category_6)));
        if ($must_read_section->have_posts()):
            ?>
            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-border theme-bg-1 theme-must-read">

                <?php if ($home_section_must_read) { ?>
                    <header class="theme-block-header-alt">
                        <div class="wrapper">
                            <div class="theme-block-title-alt">
                                <h2 class="block-title-alt">
                                    <?php echo esc_html($home_section_must_read); ?>
                                </h2>
                            </div>
                        </div>
                    </header>
                <?php } ?>

                <div class="wrapper-fluid">
                    <div class="column-row">
                        <?php
                        while ($must_read_section->have_posts()) {
                            $must_read_section->the_post();
                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : '';
                            ?>
                        <div class="column column-4 column-sm-12 mb-sm-15">
                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-inlined'); ?>>
                                <div class="data-bg img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                </div>

                                <div class="article-content">
                                    <div class="entry-meta">
                                        <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                    </div>
                                    <h2 class="entry-title entry-title-small">
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
                    </div>
                </div>
            </div>
            <?php wp_reset_postdata();
        endif;
    }
endif; ?>