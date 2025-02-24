<?php
/**
 * About Rencer Content.
 *
 * @package Mahalo
 */


$base_url = home_url();

$mahalo_panels_sections = array(

    'theme_general_settings' => array(

        'title' => esc_html__('General Settings', 'mahalo'),
        'sections' => array(

            array(
                'title' => esc_html__('Logo & Site Identity', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bcontrol%5D=custom_logo'),
                'icon' => 'dashicons-format-image',
            ),
            array(
                'title' => esc_html__('Header Media', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=header_image'),
                'icon' => 'dashicons-desktop',
            ),
            array(
                'title' => esc_html__('Background Image', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=background_image'),
                'icon' => 'dashicons-desktop',
            ),
            array(
                'title' => esc_html__('Menu Settings', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bpanel%5D=nav_menus'),
                'icon' => 'dashicons-menu',
            ),

        ),

    ),
    'theme_colors_panel' => array(

        'title' => esc_html__('Color Settings', 'mahalo'),
        'sections' => array(

            array(
                'title' => esc_html__('Color Options', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=colors'),
                'icon' => 'dashicons-admin-customizer',
            ),
            array(
                'title' => esc_html__('Color Scheme', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=color_schema'),
                'icon' => 'dashicons-art',
            ),

        ),

    ),
    'home_sections_repeater' => array(

        'title' => esc_html__('Homepage Content Section', 'mahalo'),
        'sections' => array(

            array(
                'title' => esc_html__('Homepage Content Section', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=home_sections_repeater'),
                'icon' => 'dashicons-admin-generic',
            ),

        ),

    ),
    'theme_option_panel' => array(

        'title' => esc_html__('Theme Options', 'mahalo'),
        'sections' => array(

            array(
                'title' => esc_html__('Header Settings', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=main_header_setting'),
                'icon' => 'dashicons-align-center',
            ),
            array(
                'title' => esc_html__('Pagination Settings', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=mahalo_pagination_section'),
                'icon' => 'dashicons-ellipsis',
            ),
            array(
                'title' => esc_html__('Article Meta Settings', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=posts_settings'),
                'icon' => 'dashicons-admin-settings',
            ),
            array(
                'title' => esc_html__('Single Post Settings', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=single_post_setting'),
                'icon' => 'dashicons-welcome-write-blog',
            ),
            array(
                'title' => esc_html__('Layout Settings', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=layout_setting'),
                'icon' => 'dashicons-layout',
            ),
            array(
                'title' => esc_html__('Footer Setting', 'mahalo'),
                'url' => esc_url($base_url . '/wp-admin/customize.php?autofocus%5Bsection%5D=footer_settings'),
                'icon' => 'dashicons-admin-generic',
            ),

        ),

    ),


);



include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
$rec_plugins = Mahalo_Getting_started::mahalo_recommended_plugins();
$theme_version = wp_get_theme()->get('Version');
$theme_info = wp_get_theme();
$theme_name = $theme_info->__get('Name');
$pro_theme_name = $theme_name . ' Pro';
$pro_theme_url = 'https://www.themeinwp.com/theme/mahalo-pro';
?>
<div class="twp-about-main">

    <div class="about-page-header">
        <div class="about-wrapper">
            <div class="about-wrapper-inner">
                <div class="about-header-left">
                    <h1 class="about-theme-title">
                        <a href="<?php echo esc_url('https://www.themeinwp.com/theme/mahalo'); ?>">
                            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/mahalo-logo.png'); ?>" class="about-theme-logo">
                            <span class="theme-version"><?php echo esc_html($theme_version); ?></span>
                        </a>
                    </h1>
                </div>
                <div class="about-header-right">
                    <div class="about-header-navigation">
                        <a target="_blank" class="about-header-links header-links-home"
                           href="<?php echo esc_url('https://www.themeinwp.com/theme/mahalo'); ?>">
                            <?php esc_html_e('Theme Details', 'mahalo'); ?>
                        </a>
                        <a target="_blank" class="about-header-links header-links-preview"
                           href="<?php echo esc_url('https://demo-preview.themeinwp.com/mahalo/'); ?>">
                            <?php esc_html_e('View Demo', 'mahalo'); ?>
                        </a>
                        <a target="_blank" class="about-header-links header-links-review"
                           href="<?php echo esc_url('https://wordpress.org/support/theme/mahalo/reviews/?filter=5'); ?>">
                            <?php esc_html_e('Rate This Theme', 'mahalo'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="about-tab-navbar">
        <div class="about-wrapper">
            <ul class="tab-navbar-list">
                <li><a class="active" href="#about-panel-1"><?php esc_html_e('Getting started', 'mahalo'); ?></a></li>
                <li><a href="#about-panel-3"><?php esc_html_e('Changelog', 'mahalo'); ?></a></li>
            </ul>
        </div>
    </div>

    <div class="about-page-content">
        <div class="about-wrapper">
            <div class="about-wrapper-inner">

                <div class="about-content-left">
                    <div class="about-tab-content">
                        <div id="about-panel-1" class="about-panel-item about-panel-general about-panel-item-active">
                            <?php
                            foreach ($mahalo_panels_sections as $panels) { ?>
                                <div class="about-content-panel">

                                    <?php if (isset($panels['title']) && $panels['title']) { ?>

                                        <h2 class="about-panel-title"><?php echo esc_html($panels['title']); ?></h2>

                                    <?php } ?>
                                    <div class="about-panel-items about-panel-2-columns">
                                        <?php

                                        if (isset($panels['sections']) && $panels['sections']) {

                                            foreach ($panels['sections'] as $section) { ?>


                                                <div class="about-items-wrap">
                                                    <?php if (isset($section['icon']) && $section['icon']) { ?>
                                                        <span class="about-items-icon dashicons <?php echo esc_attr($section['icon']); ?>"></span>
                                                    <?php } ?>

                                                    <?php if (isset($section['title']) && $section['title'] && isset($section['url']) && $section['url']) { ?>
                                                        <span class="about-items-title">
                                                        <a href="<?php echo esc_url($section['url']); ?>" target="_blank"><?php echo esc_html($section['title']); ?></a>
                                                    </span>
                                                    <?php } ?>
                                                </div>


                                            <?php }

                                        } ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="about-content-panel">

                                <h2 class="about-panel-title">
                                    <?php esc_html_e('Recommended Plugins', 'mahalo'); ?>
                                </h2>

                                <div class="about-panel-items about-panel-1-columns">

                                    <?php foreach ($rec_plugins as $key => $plugin) {

                                        $plugin_info = plugins_api(
                                            'plugin_information',
                                            array(
                                                'slug' => sanitize_key(wp_unslash($key)),
                                                'fields' => array(
                                                    'sections' => false,
                                                ),
                                            )
                                        );

                                        $plugin_status = Mahalo_Getting_started::mahalo_plugin_status($plugin['class'], $key, $plugin['PluginFile']); ?>

                                        <div id="<?php echo 'mahalo-' . esc_attr($key); ?>" class="about-items-wrap">
                                            <div class="theme-recommended-plugin <?php if ($plugin_status['status'] == 'active') {
                                                echo 'recommended-plugin-active';
                                            } ?>">

                                                <?php if (isset($plugin_info->name)) { ?>
                                                    <a href="javascript:void(0)"><?php echo esc_html($plugin_info->name); ?></a>
                                                <?php } ?>

                                                <?php if (isset($plugin_status['status']) && isset($plugin_status['string'])) { ?>

                                                    <a class="recommended-plugin-status <?php echo 'twp-plugin-' . esc_attr($plugin_status['status']); ?>"
                                                       plugin-status="<?php echo esc_attr($plugin_status['status']); ?>"
                                                       plugin-file="<?php echo esc_attr($plugin['PluginFile']); ?>"
                                                       plugin-folder="<?php echo esc_attr($key); ?>"
                                                       plugin-slug="<?php echo esc_attr($key); ?>"
                                                       plugin-class="<?php echo esc_attr($plugin['class']); ?>"
                                                       href="javascript:void(0)"><?php echo esc_html($plugin_status['string']); ?></a>

                                                <?php } ?>

                                            </div>

                                        </div>

                                    <?php } ?>

                                </div>

                            </div>
                        </div>

                        <div id="about-panel-3" class="about-panel-item about-panel-changelog">
                            <?php
                            WP_Filesystem();
                            global $wp_filesystem;
                            if (is_child_theme()) {
                                $changelog = $wp_filesystem->get_contents(get_stylesheet_directory() . '/classes/changelog.txt');
                            } else {
                                $changelog = $wp_filesystem->get_contents(get_template_directory() . '/classes/changelog.txt');
                            }
                            if (is_wp_error($changelog)) {
                                $changelog = '';
                            }

                            if (!empty($changelog)) {
                                echo '<div class="featured-section changelog">';
                                echo "<pre class='changelog'>";
                                echo $changelog;
                                echo "</pre>";
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>

                </div>

                <div class="about-content-right">

                    <div class="about-content-panel">
                        <h2 class="about-panel-title"><span
                                    class="dashicons dashicons-sos"></span> <?php esc_html_e('Looking for help?', 'mahalo'); ?>
                        </h2>
                        <div class="about-content-info">
                            <p><?php esc_html_e('We have some resources available to help you in the right direction.', 'mahalo'); ?></p>
                            <ul>
                                <li>
                                    <a href="<?php echo esc_url('https://www.themeinwp.com/support/'); ?>"
                                       target="_blank"
                                       rel="noopener"><?php esc_html_e('Create a Ticket', 'mahalo'); ?> &#187;</a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url('https://www.themeinwp.com/knowledgebase/'); ?>"
                                       target="_blank"
                                       rel="noopener"><?php esc_html_e('Knowledge Base', 'mahalo'); ?> &#187;</a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url('https://docs.themeinwp.com/docs/mahalo'); ?>"
                                       target="_blank"
                                       rel="noopener"><?php esc_html_e('Theme Documentation', 'mahalo'); ?>
                                        &#187;</a>
                                </li>
                            </ul>
                            <p><?php esc_html_e('Behind every single customer support question stands a real person ready to fix the problem in real-time and guide you through.', 'mahalo'); ?></p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="about-wrapper">
            <div class="about-wrapper-inner">
                <div class="about-content-full">
                    <div class="about-wrapper-footer">
                        <h2 class="about-panel-title"><?php printf(__('Unlock all the Features with %1$s Pro', 'mahalo'), esc_html($theme_name)); ?></h2>
                        <div class="about-footer-leftside">
                            <ul>
                                <li>
                                    <span class="dashicons dashicons-yes"></span><?php esc_html_e('Color Options', 'mahalo'); ?>
                                </li>
                                <li>
                                    <span class="dashicons dashicons-yes"></span><?php esc_html_e('800+ Font Families', 'mahalo'); ?>
                                </li>
                                <li>
                                    <span class="dashicons dashicons-yes"></span><?php esc_html_e('More Custom Widgets', 'mahalo'); ?>
                                </li>
                                <li>
                                    <span class="dashicons dashicons-yes"></span><?php esc_html_e('More Customizer controls', 'mahalo'); ?>
                                </li>
                                <li>
                                    <span class="dashicons dashicons-yes"></span><?php esc_html_e('More page/post meta options', 'mahalo'); ?>
                                </li>
                                <li>
                                    <span class="dashicons dashicons-yes"></span><?php esc_html_e('Webmaster Tools', 'mahalo'); ?>
                                </li>
                                <li>
                                    <span class="dashicons dashicons-yes"></span><?php esc_html_e('Remove Footer Attribution (copyright)', 'mahalo'); ?>
                                </li>
                                <li>
                                    <span class="dashicons dashicons-yes"></span><?php esc_html_e('VIP priority Support', 'mahalo'); ?>
                                </li>
                                <li>
                                    <span class="dashicons dashicons-plus"></span><?php esc_html_e('much more stuff...', 'mahalo'); ?>
                                </li>
                            </ul>
                        </div>
                        <div class="about-footer-rightside">
                            <div class="about-footer-upgrade">
                                <h3 class="footer-upgrade-title">
                                    <?php esc_html_e('Upgrade to Pro', 'mahalo'); ?>
                                </h3>
                                <div class="footer-upgrade-price">
                                    <sup><?php esc_html_e('$', 'mahalo'); ?></sup>
                                    <span><?php esc_html_e('59', 'mahalo'); ?></span>
                                </div>
                                <div class="footer-upgrade-link">
                                    <a target="_blank" class="button button-primary button-primary-upgrade" href="<?php echo esc_url($pro_theme_url); ?>"><?php esc_html_e('Upgrade to Pro', 'mahalo'); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>