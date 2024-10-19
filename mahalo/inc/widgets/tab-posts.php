<?php
/**
 * Tab Posts Widgets.
 *
 * @package Mahalo
 */
if (!function_exists('mahalo_tab_posts_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function mahalo_tab_posts_widgets()
    {
        // Tab Post widget.
        register_widget('Mahalo_Tab_Posts_Widget');
    }
endif;
add_action('widgets_init', 'mahalo_tab_posts_widgets');
/* Tabed widget */
if (!class_exists('Mahalo_Tab_Posts_Widget')):
    /**
     * Tabbed widget Class.
     *
     * @since 1.0.0
     */
    class Mahalo_Tab_Posts_Widget extends Mahalo_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'mahalo_widget_tabbed',
                'description' => esc_html__('Tabbed widget.', 'mahalo'),
            );
            $fields = array(
                'popular_heading' => array(
                    'label' => esc_html__('Popular', 'mahalo'),
                    'type' => 'heading',
                ),
                'popular_number' => array(
                    'label' => esc_html__('No. of Posts:', 'mahalo'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'select_image_size' => array(
                    'label' => esc_html__('Select Image Size Featured Post:', 'mahalo'),
                    'type' => 'select',
                    'default' => 'medium',
                    'options' => array(
                        'thumbnail' => esc_html__('Thumbnail', 'mahalo'),
                        'medium' => esc_html__('Medium', 'mahalo'),
                        'large' => esc_html__('Large', 'mahalo'),
                        'full' => esc_html__('Full', 'mahalo'),
                    ),
                ),
                'excerpt_length' => array(
                    'label' => esc_html__('Excerpt Length:', 'mahalo'),
                    'description' => esc_html__('Number of words', 'mahalo'),
                    'default' => 10,
                    'css' => 'max-width:60px;',
                    'min' => 0,
                    'max' => 200,
                ),
                'recent_heading' => array(
                    'label' => esc_html__('Recent', 'mahalo'),
                    'type' => 'heading',
                ),
                'recent_number' => array(
                    'label' => esc_html__('No. of Posts:', 'mahalo'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'comments_heading' => array(
                    'label' => esc_html__('Comments', 'mahalo'),
                    'type' => 'heading',
                ),
                'comments_number' => array(
                    'label' => esc_html__('No. of Comments:', 'mahalo'),
                    'type' => 'number',
                    'css' => 'max-width:60px;',
                    'default' => 5,
                    'min' => 1,
                    'max' => 10,
                ),
                'tagged_heading' => array(
                    'label' => esc_html__('Tagged', 'mahalo'),
                    'type' => 'heading',
                ),
            );
            parent::__construct('mahalo-tabbed', esc_html__('Mahalo: Sidebar Tab Widget', 'mahalo'), $opts, array(), $fields);
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
            $tab_id = 'tabbed-' . $this->number;
            echo $args['before_widget'];
            ?>
            <div class="tabbed-container">
                <div class="tab-head">
                    <ul class="twp-nav-tabs clear">
                        <li tab-data="tab-popular" class="tab tab-popular active">
                            <a href="javascript:void(0)">
                                <span class="fire-icon tab-icon">
                                    <?php mahalo_theme_svg('popular'); ?>
                                </span>
                            </a>
                        </li>
                        <li tab-data="tab-recent" class="tab tab-recent">
                            <a href="javascript:void(0)">
                                <span class="flash-icon tab-icon">
                                    <?php mahalo_theme_svg('flash'); ?>
                                </span>
                            </a>
                        </li>
                        <li tab-data="tab-comments" class="tab tab-comments">
                            <a href="javascript:void(0)">
                                <span class="comment-icon tab-icon">
                                    <?php mahalo_theme_svg('comment'); ?>
                                </span>
                            </a>
                        </li>
                        <li tab-data="tab-tagged" class="tab tab-tagged">
                            <a href="javascript:void(0)">
                                <span class="comment-icon tab-icon">
                                    <?php mahalo_theme_svg('tag'); ?>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane content-tab-popular active">
                        <?php $this->render_news('popular', $params); ?>
                    </div>
                    <div class="tab-pane content-tab-recent">
                        <?php $this->render_news('recent', $params); ?>
                    </div>
                    <div class="tab-pane content-tab-comments">
                        <?php $this->render_comments($params); ?>
                    </div>
                    <div class="tab-pane content-tab-tagged">
                        <?php $this->render_tagged($params); ?>
                    </div>
                </div>
            </div>
            <?php
            echo $args['after_widget'];
        }

        /**
         * Render news.
         *
         * @param array $type Type.
         * @param array $params Parameters.
         * @return void
         * @since 1.0.0
         *
         */
        function render_news($type, $params)
        {
            if (!in_array($type, array('popular', 'recent'))) {
                return;
            }
            switch ($type) {
                case 'popular':
                    $cat_slug = '';
                    if (isset($params['tab_cat'])) {
                        $cat_slug = $params['tab_cat'];
                    }
                    $qargs = array(
                        'posts_per_page' => $params['popular_number'],
                        'no_found_rows' => true,
                        'orderby' => 'comment_count',
                        'category_name' => $cat_slug,
                    );
                    break;
                case 'recent':
                    $cat_slug = '';
                    if (isset($params['tab_cat'])) {
                        $cat_slug = $params['tab_cat'];
                    }
                    $qargs = array(
                        'posts_per_page' => $params['recent_number'],
                        'no_found_rows' => true,
                        'category_name' => $cat_slug,
                    );
                    break;
                default:
                    break;
            }
            $tab_posts_query = new WP_Query($qargs);
            if ($tab_posts_query->have_posts()): ?>
                <ul class="theme-widget-list recent-widget-list">
                    <?php
                    while ($tab_posts_query->have_posts()):
                        $tab_posts_query->the_post(); ?>
                        <li>
                            <article class="article-list">
                                <div class="column-row column-row-small">
                                    <div class="column column-4">
                                        <div class="entry-thumbnail">
                                            <?php
                                            $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
                                            $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>
                                            <a href="<?php the_permalink(); ?>" class="data-bg data-bg-widget-thumbnail"
                                               data-background="<?php echo esc_url($featured_image); ?>"></a>
                                        </div>
                                    </div>
                                    <div class="column column-8">
                                        <div class="article-body">

                                            <h3 class="entry-title entry-title-small">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="entry-meta">
                                                <?php mahalo_posted_on($icon = true); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </li>
                    <?php endwhile; ?>
                </ul><!-- .news-list -->
                <?php wp_reset_postdata();
            endif;
        }

        /**
         * Render comments.
         *
         * @param array $params Parameters.
         * @return void
         * @since 1.0.0
         *
         */
        function render_comments($params)
        {
            $cat_slug = '';
            $post_array = array();
            if (!empty($params['tab_cat'])) {
                $cat_slug = $params['tab_cat'];
                $qargs = array(
                    'posts_per_page' => 10,
                    'no_found_rows' => true,
                    'category_name' => $cat_slug,
                );
                $tab_posts_query = new WP_Query($qargs);
                if ($tab_posts_query->have_posts()) {
                    while ($tab_posts_query->have_posts()) {
                        $tab_posts_query->the_post();
                        $post_array[] = get_the_ID();
                    }
                    wp_reset_postdata();
                }
            }
            $comment_args = array(
                'number' => $params['comments_number'],
                'status' => 'approve',
                'post_status' => 'publish',
                'post__in' => $post_array,
            );
            $comments = get_comments($comment_args);
            ?>
            <?php if (!empty($comments)): ?>
            <ul class="theme-widget-list comments-tabbed-list">
                <?php foreach ($comments as $key => $comment): ?>
                    <li>
                        <div class="column-row">
                            <div class="column column-4">
                                <div class="entry-thumbnail">
                                    <?php $comment_author_url = esc_url(get_comment_author_url($comment)); ?>
                                    <?php if (!empty($comment_author_url)):
                                        $thumb = get_avatar_url($comment, array('size' => 100)); ?>
                                        <a href="<?php echo esc_url($comment_author_url); ?>"
                                           class="data-bg data-bg-widget-thumbnail"
                                           data-background="<?php echo esc_url($thumb); ?>"></a>
                                    <?php else : ?>
                                        <?php echo wp_kses_post(get_avatar($comment, 130)); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="column column-8">
                                <div class="comments-content">
                                    <?php echo wp_kses_post(get_comment_author_link($comment)); ?>
                                </div>
                                <h3 class="entry-title entry-title-small">
                                    <a href="<?php echo esc_url(get_comment_link($comment)); ?>">
                                        <?php echo esc_html(get_the_title($comment->comment_post_ID)); ?>
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul><!-- .comments-list -->
        <?php endif; ?>
            <?php
        }

        /**
         * Render Tagged.
         *
         * @param array $params Parameters.
         * @return void
         * @since 1.0.0
         *
         */
        function render_tagged($instance)
        {
            $args = array(
                'smallest' => 10,
                'largest' => 22,
                'unit' => 'px',
                'format' => 'flat',
                'separator' => " ",
                'orderby' => 'count',
                'order' => 'DESC',
                'show_count' => 1,
                'echo' => false
            );
            $tag_string = wp_tag_cloud($args);
            echo $tag_string;
        }
    }
endif;
