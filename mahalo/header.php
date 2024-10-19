<?php
/**
 * Header file for the Mahalo WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Mahalo
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if (function_exists('wp_body_open')) {
    wp_body_open();
} ?>
<?php 
$mahalo_default = mahalo_get_default_theme_options();
$show_preloader = get_theme_mod( 'show_preloader',$mahalo_default['show_preloader'] ); ?>
<?php if( $show_preloader ){ ?>
<div id="theme-preloader-initialize" class="theme-preloader">
    <div class="theme-preloader-loader"></div>
</div>
<?php } ?>
<div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to the content', 'mahalo'); ?></a>

    <?php mahalo_header_ad(); ?>

    <?php get_template_part('template-parts/header/header', 'content'); ?>

    <?php mahalo_header_banner(); ?>

    <div id="content" class="site-content">