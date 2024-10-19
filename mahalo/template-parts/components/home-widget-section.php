<?php
/**
 * Homepage Main Widget Area
 *
 * @package Mahalo
 */

if (!function_exists('mahalo_case_home_widget_area_block')):

    function mahalo_case_home_widget_area_block($mahalo_home_section, $repeat_times)
    {
        ?>
        <?php if (is_active_sidebar('front-page-widget-area-1') ) { ?>
            <div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-widgetarea-full theme-widgetarea-primary">
                <?php if (is_active_sidebar('front-page-widget-area-1')) { ?>
                    <?php dynamic_sidebar('front-page-widget-area-1'); ?>
                <?php } ?>
            </div>
    <?php } ?>

        <?php
    }

endif;