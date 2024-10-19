<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Mahalo
 */
get_header();
?>
    <div class="theme-block theme-block-single">
        <div id="primary" class="content-area">
            <div class="theme-block error-block error-block-heading">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'mahalo'); ?></h1>
                </header><!-- .page-header -->
            </div>
            <div class="theme-block error-block error-block-search">
                <?php get_search_form(); ?>
                        
            </div>
            <div class="theme-block error-block error-block-top">
                <h2><?php esc_html_e('Maybe it’s out there, somewhere...', 'mahalo'); ?></h2>
                <p><?php esc_html_e('You can always find insightful stories on our', 'mahalo'); ?>
                    <a href="<?php echo esc_url(home_url()); ?>"><?php esc_html_e('Homepage', 'mahalo'); ?></a>
                </p>
            </div>
        </div>
    </div>
<?php
get_footer();
