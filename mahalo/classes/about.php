<?php

/**
 * Mahalo About Page
 * @package Mahalo
 *
 */

if (!class_exists('Mahalo_About_page')):

    class Mahalo_About_page
    {

        function __construct()
        {

            add_action('admin_menu', array($this, 'mahalo_backend_menu'));

        }

        // Add Backend Menu
        function mahalo_backend_menu()
        {

            add_theme_page(esc_html__('Mahalo', 'mahalo'), esc_html__('Mahalo', 'mahalo'), 'activate_plugins', 'mahalo-about', array($this, 'mahalo_main_page'), 1);

        }

        // Settings Form
        function mahalo_main_page()
        {

            require get_template_directory() . '/classes/about-render.php';

        }

    }

    new Mahalo_About_page();

endif;