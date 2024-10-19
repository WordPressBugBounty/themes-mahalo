<?php
/**
 * Article Widget Style
 *
 * @package Mahalo
 */
if (!function_exists('mahalo_post_widget')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function mahalo_post_widget()
    {
        register_widget('Mahalo_Post_Widget');
    }
endif;
add_action('widgets_init', 'mahalo_post_widget');
// Article Widget Layout 1
if (!class_exists('Mahalo_Post_Widget')) :
    /**
     * Article Widget Layout 1
     *
     * @since 1.0.0
     */
    class Mahalo_Post_Widget extends Mahalo_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'mahalo_post_widget',
                'description' => esc_html__('Displays posts from selected category in different featured layouts.', 'mahalo'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Section Title:', 'mahalo'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category' => array(
                    'label' => esc_html__('Select Category:', 'mahalo'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'mahalo'),
                ),
                'display_orientation' => array(
                    'label' => esc_html__('Display Layout:', 'mahalo'),
                    'type' => 'select',
                    'default' => 'layout-1',
                    'options' => array(
                        'layout-1' => esc_html__('Layout - 1 ', 'mahalo'),
                        'layout-2' => esc_html__('Layout - 2', 'mahalo'),
                        'layout-3' => esc_html__('Layout - 3', 'mahalo'),
                        'layout-4' => esc_html__('Layout - 4', 'mahalo'),
                        'layout-5' => esc_html__('Layout - 5', 'mahalo'),
                    ),
                ),
                'enable_meta' => array(
                    'label' => esc_html__('Enable Categories:', 'mahalo'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'enable_meta_1' => array(
                    'label' => esc_html__('Enable Date & Author:', 'mahalo'),
                    'type' => 'checkbox',
                    'default' => true,
                ),
                'button_text' => array(
                    'label' => esc_html__('Button Text:', 'mahalo'),
                    'type' => 'text',
                    'default' => 'View more',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('mahalo-widget-style-1', esc_html__('Mahalo: Featured Blocks', 'mahalo'), $opts, array(), $fields);
        }

        /**
         * Outputs the content for the current widget instance.
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         * @since 1.0.0
         *
         */
        function widget($args, $instance)
        {
            $params = $this->get_params($instance);
            echo $args['before_widget'];
            if ($params['display_orientation'] == 'layout-1') {
                $post_number = 2;
            }
            elseif ($params['display_orientation'] == 'layout-2') {
                $post_number = 5;
            }
            elseif ($params['display_orientation'] == 'layout-4') {
                $post_number = 7;
            }
            elseif ($params['display_orientation'] == 'layout-5') {
                $post_number = 8;
            }
            else {
                $post_number = 4;
            }
            $qargs = array(
                'post_type' => 'post',
                'posts_per_page' => $post_number,
                'post__not_in' => get_option("sticky_posts"),
            );
            $cat_link = "";
            if (absint($params['post_category']) > 0) {
                $qargs['cat'] = absint($params['post_category']);
                $cat_link = get_category_link($params['post_category']);
            }
            $style_1_posts_query = new WP_Query($qargs);
            if ($style_1_posts_query->have_posts()) : ?>
                <?php $display_orientation = esc_attr($params['display_orientation']);
                if ($display_orientation == 'layout-1') { ?>
                    <div class="widget-layout widget-layout-1">
                        <?php if (!empty($params['title'])) { ?>
                        <header class="theme-widget-header">
                            <div class="theme-widget-title">
                                <h2 class="widget-title">
                                    <?php echo $params['title'] ?>
                                </h2>
                            </div>
                        </header>
                        <?php } ?>
                        <div class="theme-widget-content">
                            <?php
                            $i = 1;
                            while ($style_1_posts_query->have_posts()) :
                                $style_1_posts_query->the_post(); ?>
                                <div class="theme-widget-panel widget-panel-<?php echo $i; ?>">
                                    <div class="widget-story">
                                        <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                            <?php if ($params['enable_meta'] == 'yes') { ?>
                                                <div class="article-content article-content-overlay article-content-overlay-top">
                                                    <div class="entry-meta">
                                                        <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if (has_post_thumbnail()): ?>
                                                <div class="data-bg data-bg-big img-hover-shine" data-background="<?php echo esc_url($featured_image); ?>">
                                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="article-content">
                                                <h3 class="entry-title entry-title-big">
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                                <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                                    <div class="entry-meta">
                                                        <?php mahalo_posted_by(); ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="entry-content entry-content-muted content-muted-medium">
                                                    <?php
                                                    if (has_excerpt()) {
                                                        the_excerpt();
                                                    } else {
                                                        echo '<p>';
                                                        echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                        echo '</p>';
                                                    } ?>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                                <?php $i++;
                                wp_reset_postdata(); endwhile; ?>
                        </div>
                        <?php if (!empty($params['button_text']) && !empty($cat_link)) { ?>
                            <div class="theme-footer-link theme-widget-footer">
                                <div class="theme-footer-panel widget-footer-panel">
                                    <hr>
                                    <a class="theme-viewmore-link" href="<?php echo esc_url($cat_link); ?>"><?php echo $params['button_text']; ?></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } elseif ($display_orientation == 'layout-2') { ?>
                    <div class="widget-layout widget-layout-2">
                        <?php if (!empty($params['title'])) { ?>
                            <header class="theme-widget-header">
                                <div class="theme-widget-title">
                                    <h2 class="widget-title">
                                        <?php echo $params['title'] ?>
                                    </h2>
                                </div>
                            </header>
                        <?php } ?>
                        <div class="theme-widget-content">
                        <?php
                        $i = 1;
                        while ($style_1_posts_query->have_posts()) :
                            $style_1_posts_query->the_post(); ?>
                            <?php switch ($i) {
                                case ($i == 1): ?>
                                    <div class="theme-widget-panel widget-panel-1">
                                        <div class="widget-story">
                                            <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                            <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                                <?php if (has_post_thumbnail()): ?>
                                                    <div class="data-bg data-bg-big img-hover-shine" data-background="<?php echo esc_url($featured_image); ?>">
                                                        <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="article-content mt-20">
                                                    <?php if ($params['enable_meta'] == 'yes') { ?>
                                                        <div class="entry-meta mb-10">
                                                            <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                        </div>
                                                    <?php } ?>

                                                    <h3 class="entry-title entry-title-medium">
                                                        <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                            <?php the_title(); ?>
                                                        </a>
                                                    </h3>
                                                    <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                                        <div class="entry-meta">
                                                            <?php mahalo_posted_by(); ?>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="entry-content entry-content-muted content-muted-medium">
                                                        <?php
                                                        if (has_excerpt()) {
                                                            the_excerpt();
                                                        } else {
                                                            echo '<p>';
                                                            echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                            echo '</p>';
                                                        } ?>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>

                                    <div class="theme-widget-panel theme-svg-seperator">
                                        <?php mahalo_theme_svg('seperator'); ?>
                                    </div>

                                    <div class="theme-widget-panel widget-panel-2">
                                <?php break;

                                default: ?>

                                <div class="widget-story-list">
                                    <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list'); ?>>
                                        <div class="article-content mb-xs-20">
                                            <?php if ($params['enable_meta'] == 'yes') { ?>
                                                <div class="entry-meta">
                                                    <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>
                                            <?php } ?>
                                            <h3 class="entry-title entry-title-small">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                                <div class="entry-meta">
                                                    <?php mahalo_posted_by(); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="data-bg data-bg-small img-hover-slide" data-background="<?php echo esc_url($featured_image); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                            </div>
                                        <?php endif; ?>
                                    </article>
                                </div>
                                <?php if ($style_1_posts_query->current_post + 1 == $style_1_posts_query->post_count) {
                                    echo '</div>';
                                } ?>
                                <?php 
                                break;

                            } $i++; ?>
                        <?php wp_reset_postdata();
                        endwhile; ?>
                        </div>
                        <?php if (!empty($params['button_text']) && !empty($cat_link)) { ?>
                            <div class="theme-footer-link theme-widget-footer">
                                <div class="theme-footer-panel widget-footer-panel">
                                    <hr>
                                    <a class="theme-viewmore-link" href="<?php echo esc_url($cat_link); ?>"><?php echo $params['button_text']; ?></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } elseif ($display_orientation == 'layout-3') { ?>
                    <div class="widget-layout widget-layout-3">
                    <?php if (!empty($params['title'])) { ?>
                        <header class="theme-widget-header">
                            <div class="theme-widget-title">
                                <h2 class="widget-title">
                                    <?php echo $params['title'] ?>
                                </h2>
                            </div>
                        </header>
                    <?php } ?>
                        <div class="theme-widget-content">
                            <?php
                            $i = 1;
                            while ($style_1_posts_query->have_posts()) :
                            $style_1_posts_query->the_post(); ?>
                            <?php if ($i == 1) { ?>
                                <div class="theme-widget-panel widget-panel-1">
                                    <div class="widget-story-jumbotron mb-20">
                                        <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                        $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-mega'); ?>>
                                            <?php if (has_post_thumbnail()): ?>
                                                <div class="data-bg data-bg-large img-hover-shine" data-background="<?php echo esc_url($featured_image); ?>">
                                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="article-content mt-sm-15">
                                                <?php if ($params['enable_meta'] == 'yes') { ?>
                                                    <div class="entry-meta">
                                                        <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                    </div>
                                                <?php } ?>
                                                <h3 class="entry-title entry-title-big">
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                                <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                                    <div class="entry-meta">
                                                        <?php mahalo_posted_by(); ?>
                                                    </div>
                                                <?php } ?>
                                                <div class="entry-content entry-content-muted">
                                                    <?php
                                                    if (has_excerpt()) {
                                                        the_excerpt();
                                                    } else {
                                                        echo '<p>';
                                                        echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                        echo '</p>';
                                                    } ?>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            <div class="theme-widget-panel widget-panel-2 mt-20">
                            <?php $i++;
                            } else { ?>
                                <div class="widget-story-panel">
                                    <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                        <?php if ($params['enable_meta'] == 'yes') { ?>
                                            <div class="article-content article-content-overlay article-content-overlay-top">
                                                <div class="entry-meta">
                                                    <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="img-hover-panel">
                                                <div class="data-bg data-bg-medium img-hover-scale" data-background="<?php echo esc_url($featured_image); ?>">
                                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="article-content">
                                            <h3 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                                <div class="entry-meta">
                                                    <?php mahalo_posted_by(); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </article>
                                </div>
                                <?php if ($style_1_posts_query->current_post + 1 == $style_1_posts_query->post_count) {
                                    echo '</div>';
                                } ?>
                            <?php } ?>
                            <?php wp_reset_postdata();
                            endwhile; ?>
                        </div>
                        <?php if (!empty($params['button_text']) && !empty($cat_link)) { ?>
                            <div class="theme-footer-link theme-widget-footer">
                                <div class="theme-footer-panel widget-footer-panel">
                                    <hr>
                                    <a class="theme-viewmore-link" href="<?php echo esc_url($cat_link); ?>"><?php echo $params['button_text']; ?></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                <?php } elseif ($display_orientation == 'layout-4') { ?>
                    <div class="widget-layout widget-layout-4">
                    <?php if (!empty($params['title'])) { ?>
                        <header class="theme-widget-header">
                            <div class="theme-widget-title">
                                <h2 class="widget-title">
                                    <?php echo $params['title'] ?>
                                </h2>
                            </div>
                        </header>
                    <?php } ?>
                    <div class="theme-widget-content">
                        <div class="theme-widget-panel widget-panel-1">
                            <?php
                            $i = 1;
                            while ($style_1_posts_query->have_posts()) :
                            $style_1_posts_query->the_post(); ?>
                            <?php if ($i <= 3) { ?>
                            <div class="widget-story">
                                <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>

                                    <div class="img-hover-panel mb-10">
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="data-bg data-bg-small img-hover-scale" data-background="<?php echo esc_url($featured_image); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($params['enable_meta'] == 'yes') { ?>
                                            <div class="article-content article-content-overlay">
                                                <div class="entry-meta">
                                                    <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="article-content">
                                        <h3 class="entry-title entry-title-small">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                            <div class="entry-meta">
                                                <?php mahalo_posted_by(); ?>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </article>
                            </div>
                            <?php if ($i == 3) { ?>
                        </div>
                        <div class="theme-widget-panel widget-panel-2">
                            <?php } ?>
                            <?php $i++;
                            } else { ?>
                                <div class="widget-story mb-20">
                                    <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="data-bg data-bg-medium img-hover-shine mb-20" data-background="<?php echo esc_url($featured_image); ?>">
                                                <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($params['enable_meta'] == 'yes') { ?>
                                            <div class="article-content article-content-overlay article-content-overlay-top">
                                                <div class="entry-meta">
                                                    <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                </div>
                                            </div>
                                        <?php } ?>

                                        <div class="article-content">

                                            <h3 class="entry-title entry-title-medium">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                                <div class="entry-meta">
                                                    <?php mahalo_posted_by(); ?>
                                                </div>
                                            <?php } ?>

                                            <div class="entry-content entry-content-muted content-muted-small">
                                                <?php
                                                if (has_excerpt()) {
                                                    the_excerpt();
                                                } else {
                                                    echo '<p>';
                                                    echo esc_html(wp_trim_words(get_the_content(), 20, '...'));
                                                    echo '</p>';
                                                } ?>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <?php if ($style_1_posts_query->current_post + 1 == $style_1_posts_query->post_count) {
                                    echo '</div>';
                                } ?>
                            <?php } ?>
                            <?php wp_reset_postdata();
                            endwhile; ?>
                        </div>
                        <?php if (!empty($params['button_text']) && !empty($cat_link)) { ?>
                            <div class="theme-footer-link theme-widget-footer">
                                <div class="theme-footer-panel widget-footer-panel">
                                    <hr>
                                    <a class="theme-viewmore-link"
                                       href="<?php echo esc_url($cat_link); ?>"><?php echo $params['button_text']; ?></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } elseif ($display_orientation == 'layout-5') {?>
                    <div class="widget-layout widget-layout-5">
                    <?php if (!empty($params['title'])) { ?>
                        <header class="theme-widget-header">
                            <div class="theme-widget-title">
                                <h2 class="widget-title">
                                    <?php echo $params['title'] ?>
                                </h2>
                            </div>
                        </header>
                    <?php } ?>

                    <div class="theme-widget-content">
                        <div class="theme-widget-panel widget-panel-1">
                            <?php
                            $i = 1;
                            while ($style_1_posts_query->have_posts()) :
                            $style_1_posts_query->the_post(); ?>
                            <?php if ($i <= 5) { ?>
                            <div class="widget-story mb-20">
                                <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-list'); ?>>

                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="data-bg data-bg-medium img-hover-shine" data-background="<?php echo esc_url($featured_image); ?>">
                                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                        </div>
                                    <?php endif; ?>



                                    <div class="article-content">
                                        <?php if ($params['enable_meta'] == 'yes') { ?>
                                            <div class="entry-meta entry-meta-top">
                                                <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                            </div>
                                        <?php } ?>

                                        <h3 class="entry-title entry-title-medium">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                <?php the_title(); ?>
                                            </a>
                                        </h3>
                                        <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                            <div class="entry-meta">
                                                <?php mahalo_posted_by(); ?>
                                            </div>
                                        <?php } ?>

                                    </div>
                                </article>
                            </div>
                            <?php if ($i == 5) { ?>
                        </div>
                        <div class="theme-widget-panel widget-panel-2">
                            <?php } ?>
                            <?php $i++;
                            } else { ?>
                                <div class="widget-story">
                                    <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                                       <div class="img-hover-panel">
                                            <?php if (has_post_thumbnail()): ?>
                                                <div class="data-bg data-bg-small img-hover-scale" data-background="<?php echo esc_url($featured_image); ?>">
                                                    <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($params['enable_meta'] == 'yes') { ?>
                                                <div class="article-content article-content-overlay">
                                                    <div class="entry-meta">
                                                        <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                       </div>
                                        <div class="article-content mt-15">

                                            <h3 class="entry-title entry-title-small">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <?php if ($params['enable_meta_1'] == 'yes') { ?>
                                                <div class="entry-meta">
                                                    <?php mahalo_posted_by(); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </article>
                                </div>
                                <?php if ($style_1_posts_query->current_post + 1 == $style_1_posts_query->post_count) {
                                    echo '</div>';
                                } ?>
                            <?php } ?>
                            <?php wp_reset_postdata();
                            endwhile; ?>
                        </div>
                        <?php if (!empty($params['button_text']) && !empty($cat_link)) { ?>
                            <div class="theme-footer-link theme-widget-footer">
                                <div class="theme-footer-panel widget-footer-panel">
                                    <hr>
                                    <a class="theme-viewmore-link"
                                       href="<?php echo esc_url($cat_link); ?>"><?php echo $params['button_text']; ?></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php endif;
            echo $args['after_widget'];
        }
    }
endif;