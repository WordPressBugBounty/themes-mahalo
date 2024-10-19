<?php
/**
 * Double Category Post Widget Style
 *
 * @package Mahalo
 */
if (!function_exists('Mahalo_Mixed_Articles_Blocks')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function Mahalo_Mixed_Articles_Blocks()
    {
        register_widget('Mahalo_Mixed_Articles_Blocks');
    }
endif;
add_action('widgets_init', 'Mahalo_Mixed_Articles_Blocks');
// Article Widget Carousel Layout
if (!class_exists('Mahalo_Mixed_Articles_Blocks')) :
    /**
     * Article Widget Carousel Layout
     *
     * @since 1.0.0
     */
    class Mahalo_Mixed_Articles_Blocks extends Mahalo_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'Mahalo_Mixed_Articles_Blocks',
                'description' => esc_html__('Displays post form selected category in two Colum with list and grid', 'mahalo'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Section Title for List:', 'mahalo'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'post_category_list' => array(
                    'label' => esc_html__('Select Category for List:', 'mahalo'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'mahalo'),
                ),
                'post_category_grid' => array(
                    'label' => esc_html__('Select Category for Grid:', 'mahalo'),
                    'type' => 'dropdown-taxonomies',
                    'show_option_all' => esc_html__('All Categories', 'mahalo'),
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
            );
            parent::__construct('mahalo-double-cat-post-style', esc_html__('Mahalo: Mixed Articles Blocks', 'mahalo'), $opts, array(), $fields);
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
            $qargs_1 = array(
                'post_type' => 'post',
                'posts_per_page' => 5,
                'post__not_in' => get_option("sticky_posts"),
            );
            $cat_link = "";

            if (absint($params['post_category_list']) > 0) {
                $qargs_1['cat'] = absint($params['post_category_list']);
                $cat_link = get_category_link($params['post_category_list']);
            }
            $qargs_2 = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'post__not_in' => get_option("sticky_posts"),
            );
            $cat_link_1 = "";

            if (absint($params['post_category_grid']) > 0) {
                $qargs_2['cat'] = absint($params['post_category_grid']);
                $cat_link_1 = get_category_link($params['post_category_grid']);
            }
            ?>
            <div class="widget-layout widget-layout-contentrich">
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
            <?php $style_1_posts_query = new WP_Query($qargs_1);
            if ($style_1_posts_query->have_posts()) : ?>
                <div class="theme-widget-panel widget-panel-1">
                    <?php
                    while ($style_1_posts_query->have_posts()) :
                        $style_1_posts_query->the_post(); ?>

                        <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-instant'); ?>>
                            <div class="article-content-icon">
                                <?php mahalo_theme_svg('special-arrow-right'); ?>
                            </div>
                            <div class="article-content">
                                <?php if (($params['enable_meta']) == 1) { ?>
                                    <div class="entry-meta">
                                        <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                    </div>
                                <?php } ?>
                                <h3 class="entry-title entry-title-small">
                                    <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                       title="<?php the_title_attribute(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                                <?php if (($params['enable_meta_1']) == 1) { ?>
                                    <div class="entry-meta">
                                        <?php mahalo_posted_by(); ?>
                                        <?php mahalo_post_view_count(); ?>
                                    </div>
                                <?php } ?>
                            </div>

                        </article>

                        <?php
                        wp_reset_postdata();
                    endwhile; ?>
                </div>
            <?php endif; ?>
            <?php $style_2_posts_query = new WP_Query($qargs_2);
            if ($style_2_posts_query->have_posts()) : ?>
                <?php
                $count = 1; ?>
                <div class="theme-widget-panel widget-panel-2">

                <?php while ($style_2_posts_query->have_posts()) :
                    $style_2_posts_query->the_post();
                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                    $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                    <?php if ($count == 1) { ?>

                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                        <div class="data-bg data-bg-medium data-bg-overlay"
                             data-background="<?php echo esc_url($featured_image); ?>">
                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                        </div>
                        <div class="article-content mt-20">
                            <?php if (($params['enable_meta']) == 1) { ?>
                                <div class="entry-meta">
                                    <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                </div>
                            <?php } ?>
                            <h3 class="entry-title entry-title-big">
                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                   title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <?php if (($params['enable_meta_1']) == 1) { ?>
                                <div class="entry-meta">
                                    <?php mahalo_posted_by(); ?>
                                    <?php mahalo_post_view_count(); ?>
                                </div>
                            <?php } ?>
                        </div>

                    </article>

                    </div>
                    <div class="theme-widget-panel widget-panel-3">
                    <?php $count++;
                } else { ?>

                    <article id="theme-post-<?php the_ID(); ?>" <?php post_class('news-article news-article-panel'); ?>>
                        <div class="data-bg data-bg-small data-bg-overlay"
                             data-background="<?php echo esc_url($featured_image); ?>">
                            <a class="img-link" href="<?php the_permalink(); ?>" aria-label="<?php the_title_attribute(); ?>" tabindex="0"></a>
                        </div>
                        <div class="article-content mt-15">
                            <?php if (($params['enable_meta']) == 1) { ?>
                                <div class="entry-meta">
                                    <?php mahalo_entry_footer($cats = true, $tags = false, $edits = false, $text = false, $icon = false); ?>
                                </div>
                            <?php } ?>
                            <h3 class="entry-title entry-title-medium">
                                <a href="<?php the_permalink(); ?>" tabindex="0" rel="bookmark"
                                   title="<?php the_title_attribute(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <?php if (($params['enable_meta_1']) == 1) { ?>
                                <div class="entry-meta">
                                    <?php mahalo_posted_by(); ?>
                                    <?php mahalo_post_view_count(); ?>
                                </div>
                            <?php } ?>
                        </div>

                    </article>

                <?php } ?>
                    <?php
                    wp_reset_postdata();
                endwhile; ?>
                </div>

                </div>
                </div>

            <?php endif;
            echo $args['after_widget'];
        }
    }
endif;