<?php
/**
 * Theme widgets.
 *
 * @package Mahalo
 */
if (!function_exists('mahalo_youtube_video_slider')):
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function mahalo_youtube_video_slider()
    {
        // Video Post widget.
        register_widget('Mahalo_Youtube_Video_Slider');
    }
endif;
add_action('widgets_init', 'mahalo_youtube_video_slider');
/*Video widget*/
if (!class_exists('Mahalo_Youtube_Video_Slider')):
    /**
     * Video widget Class.
     *
     * @since 1.0.0
     */
    class Mahalo_Youtube_Video_Slider extends Mahalo_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'mahalo_youtube_video_slider',
                'description' => __('Displays videos from youtube URL.', 'mahalo'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => __('Title:', 'mahalo'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'image_url_1' => array(
                    'label' => __('Video Image Uploader - 1:', 'mahalo'),
                    'type' => 'image',
                ),
                'url-1' => array(
                    'label' => __('Youtube URL - 1:', 'mahalo'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'image_url_2' => array(
                    'label' => __('Video Image Uploader - 2:', 'mahalo'),
                    'type' => 'image',
                ),
                'url-2' => array(
                    'label' => __('Youtube URL - 2:', 'mahalo'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'image_url_3' => array(
                    'label' => __('Video Image Uploader - 3:', 'mahalo'),
                    'type' => 'image',
                ),
                'url-3' => array(
                    'label' => __('Youtube URL - 3:', 'mahalo'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'image_url_4' => array(
                    'label' => __('Video Image Uploader - 4:', 'mahalo'),
                    'type' => 'image',
                ),
                'url-4' => array(
                    'label' => __('Youtube URL - 4:', 'mahalo'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'image_url_5' => array(
                    'label' => __('Video Image Uploader - 5:', 'mahalo'),
                    'type' => 'image',
                ),
                'url-5' => array(
                    'label' => __('Youtube URL - 5:', 'mahalo'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'image_url_6' => array(
                    'label' => __('Video Image Uploader - 6:', 'mahalo'),
                    'type' => 'image',
                ),
                'url-6' => array(
                    'label' => __('Youtube URL - 6:', 'mahalo'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
            );
            parent::__construct('mahalo-video-layout', __('Mahalo: YouTube Video Slider', 'mahalo'), $opts, array(), $fields);
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
            ?>
            <div class="widget-layout widget-layout-video">
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
                    <div class="theme-widget-panel">
                        <div class="video-slider-wrapper">
                            <div id="theme-video-slider" class="slider-pro">
                                <div class="sp-slides">
                                    <?php for ($i = 1; $i <= 6; $i++) { ?>
                                        <div class="sp-slide">
                                            <?php $mp_video_url = $params['url-' . $i] ?>
                                            <?php $mp_image_url = $params['image_url_' . $i] ?>
                                            <?php if (!empty($mp_video_url)) { ?>
                                                <a class="sp-video" href="<?php echo esc_url($mp_video_url); ?>">
                                                    <img src="<?php echo esc_url($mp_image_url); ?>">
                                                </a>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="sp-thumbnails">
                                    <?php for ($j = 1; $j <= 6; $j++) { ?>
                                        <?php $mp_image_url = $params['image_url_' . $j] ?>
                                        <?php if (!empty($mp_image_url)) { ?>
                                            <div class="sp-thumbnail">
                                                <div class="sp-thumbnail-image-container">
                                                    <img class="sp-thumbnail-image" src="<?php echo esc_url($mp_image_url); ?>"/>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;
