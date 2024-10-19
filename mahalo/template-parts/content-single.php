<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Mahalo
 * @since 1.0.0
 */

$mahalo_default = mahalo_get_default_theme_options();
$mahalo_post_layout = esc_html( get_post_meta( get_the_ID(), 'mahalo_post_layout', true ) );
$mahalo_feature_image = esc_html( get_post_meta( get_the_ID(), 'mahalo_ed_feature_image', true ) );
if (empty($mahalo_feature_image)) {
	$mahalo_ed_feature_image = esc_attr(get_theme_mod('ed_post_thumbnail'));
} else{
	$mahalo_ed_feature_image = esc_attr($mahalo_feature_image);
}

if( is_page() ){

	$mahalo_post_layout = get_post_meta(get_the_ID(), 'mahalo_page_layout', true);
	
}
if( $mahalo_post_layout == '' || $mahalo_post_layout == 'global-layout' ){
    
    $mahalo_post_layout = get_theme_mod( 'mahalo_single_post_layout',$mahalo_default['mahalo_single_post_layout'] );

}
	
mahalo_disable_post_views();
mahalo_disable_post_like_dislike();

$mahalo_ed_post_views = esc_html( get_post_meta( get_the_ID(), 'mahalo_ed_post_views', true ) );
$mahalo_ed_post_read_time = esc_html( get_post_meta( get_the_ID(), 'mahalo_ed_post_read_time', true ) );
$mahalo_ed_post_author_box = esc_html( get_post_meta( get_the_ID(), 'mahalo_ed_post_author_box', true ) );
$mahalo_ed_post_social_share = esc_html( get_post_meta( get_the_ID(), 'mahalo_ed_post_social_share', true ) );
$mahalo_ed_post_reaction = esc_html( get_post_meta( get_the_ID(), 'mahalo_ed_post_reaction', true ) );

if( $mahalo_ed_post_read_time ){ mahalo_disable_post_read_time(); }
if( $mahalo_ed_post_author_box ){ mahalo_disable_post_author_box(); }
if( $mahalo_ed_post_reaction ){ mahalo_disable_post_reaction(); }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> 

	<?php

	if( empty( $mahalo_ed_feature_image ) && $mahalo_post_layout != 'layout-2' ){ ?>

		<div class="post-thumbnail">

			<?php mahalo_post_thumbnail(); ?>
			
		</div>

	<?php
	}

	if ( is_singular() && $mahalo_post_layout != 'layout-2' ) { ?>

		<header class="entry-header">

			<?php
			if ( 'post' === get_post_type() ) { ?>

				<div class="entry-meta">

					<?php mahalo_entry_footer( $cats = true, $tags = false, $edits = false, $text = false, $icon = false ); ?>

				</div>

			<?php  } ?>

			<h1 class="entry-title entry-title-large">

	            <?php the_title(); ?>

	        </h1>

		</header>

	<?php }

	if ( $mahalo_post_layout != 'layout-2' && is_single() && 'post' === get_post_type() ) { ?>

		<div class="entry-meta">

			<?php
			mahalo_posted_by();
			if( !$mahalo_ed_post_views ){ mahalo_post_view_count(); }
			?>

		</div>

	<?php  } ?>
	
	<div class="post-content-wrap">

		<?php if( is_singular() && empty( $mahalo_ed_post_social_share ) && class_exists( 'Booster_Extension_Class' ) && 'post' === get_post_type() ){ ?>
				
			<?php $twp_booster_extention_shocial_share = do_shortcode('[booster-extension-ss layout="layout-1" status="enable"]'); ?>
			<?php if (!empty($twp_booster_extention_shocial_share)) { ?>
				<div class="post-content-share">
					<?php echo $twp_booster_extention_shocial_share; ?>
				</div>
			<?php } ?>

		<?php } ?>

		<div class="post-content">

			<div class="entry-content">

				<?php

				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'mahalo' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				if( !class_exists('Booster_Extension_Class') || is_page() ):

                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'mahalo'),
                        'after' => '</div>',
                    ));

                endif; ?>

			</div>

			<?php
			if ( is_singular() && 'post' === get_post_type() ) { ?>

				<div class="entry-footer">

                    <div class="entry-meta">
                         <?php mahalo_post_like_dislike(); ?>
                    </div>

                    <div class="entry-meta">
                        <?php mahalo_entry_footer( $cats = false, $tags = true, $edits = true ); ?>
                    </div>

				</div>

			<?php } ?>

		</div>

	</div>

</article>