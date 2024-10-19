<?php
/**
* Sidebar Metabox.
*
* @package Mahalo
*/
 
add_action( 'add_meta_boxes', 'mahalo_metabox' );

if( ! function_exists( 'mahalo_metabox' ) ):


    function  mahalo_metabox() {
        
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'mahalo' ),
            'mahalo_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'theme-custom-metabox',
            esc_html__( 'Layout Settings', 'mahalo' ),
            'mahalo_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$mahalo_page_layout_options = array(
    'layout-1' => esc_html__( 'Simple Layout', 'mahalo' ),
    'layout-2' => esc_html__( 'Banner Layout', 'mahalo' ),
);

$mahalo_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'mahalo' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'mahalo' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'mahalo' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'mahalo' ),
                ),
);

$mahalo_post_layout_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'mahalo' ),
    'layout-1' => esc_html__( 'Simple Layout', 'mahalo' ),
    'layout-2' => esc_html__( 'Banner Layout', 'mahalo' ),
);

$mahalo_header_overlay_options = array(
    'global-layout' => esc_html__( 'Global Layout', 'mahalo' ),
    'enable-overlay' => esc_html__( 'Enable Header Overlay', 'mahalo' ),
);


/**
 * Callback function for post option.
*/
if( ! function_exists( 'mahalo_post_metafield_callback' ) ):
    
    function mahalo_post_metafield_callback() {
        global $post, $mahalo_post_sidebar_fields, $mahalo_post_layout_options,  $mahalo_page_layout_options, $mahalo_header_overlay_options;
        $post_type = get_post_type($post->ID);
        wp_nonce_field( basename( __FILE__ ), 'mahalo_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'mahalo'); ?>

                        </a>
                    </li>

                    <li>
                        <a id="metabox-navbar-appearance" href="javascript:void(0)">

                            <?php esc_html_e('Appearance Settings', 'mahalo'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'mahalo'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','mahalo'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $mahalo_post_sidebar = esc_html( get_post_meta( $post->ID, 'mahalo_post_sidebar_option', true ) ); 
                            if( $mahalo_post_sidebar == '' ){ $mahalo_post_sidebar = 'global-sidebar'; }

                            foreach ( $mahalo_post_sidebar_fields as $mahalo_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="mahalo_post_sidebar_option" value="<?php echo esc_attr( $mahalo_post_sidebar_field['value'] ); ?>" <?php if( $mahalo_post_sidebar_field['value'] == $mahalo_post_sidebar ){ echo "checked='checked'";} if( empty( $mahalo_post_sidebar ) && $mahalo_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $mahalo_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                </div>


                <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                    <?php if( $post_type == 'page' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','mahalo'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $mahalo_page_layout = esc_html( get_post_meta( $post->ID, 'mahalo_page_layout', true ) ); 
                                if( $mahalo_page_layout == '' ){ $mahalo_page_layout = 'layout-1'; }

                                foreach ( $mahalo_page_layout_options as $key => $mahalo_page_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="mahalo_page_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $mahalo_page_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $mahalo_page_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','mahalo'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                <?php
                                $mahalo_ed_header_overlay = esc_attr( get_post_meta( $post->ID, 'mahalo_ed_header_overlay', true ) ); ?>

                                <input type="checkbox" id="mahalo-header-overlay" name="mahalo_ed_header_overlay" value="1" <?php if( $mahalo_ed_header_overlay ){ echo "checked='checked'";} ?>/>

                                <label for="mahalo-header-overlay"><?php esc_html_e( 'Enable Header Overlay','mahalo' ); ?></label>

                            </div>

                        </div>

                    <?php endif; ?>

                    <?php if( $post_type == 'post' ): ?>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Appearance Layout','mahalo'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $mahalo_post_layout = esc_html( get_post_meta( $post->ID, 'mahalo_post_layout', true ) ); 
                                if( $mahalo_post_layout == '' ){ $mahalo_post_layout = 'global-layout'; }

                                foreach ( $mahalo_post_layout_options as $key => $mahalo_post_layout_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="mahalo_post_layout" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $mahalo_post_layout ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $mahalo_post_layout_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Header Overlay','mahalo'); ?></h3>

                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <?php
                                $mahalo_header_overlay = esc_html( get_post_meta( $post->ID, 'mahalo_header_overlay', true ) ); 
                                if( $mahalo_header_overlay == '' ){ $mahalo_header_overlay = 'global-layout'; }

                                foreach ( $mahalo_header_overlay_options as $key => $mahalo_header_overlay_option) { ?>

                                    <label class="description">
                                        <input type="radio" name="mahalo_header_overlay" value="<?php echo esc_attr( $key ); ?>" <?php if( $key == $mahalo_header_overlay ){ echo "checked='checked'";} ?>/>&nbsp;<?php echo esc_html( $mahalo_header_overlay_option ); ?>
                                    </label>

                                <?php } ?>

                            </div>

                        </div>

                    <?php endif; ?>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Feature Image Setting','mahalo'); ?></h3>

                        <div class="metabox-opt-wrap theme-checkbox-wrap">

                            <?php
                            $mahalo_ed_feature_image = esc_html( get_post_meta( $post->ID, 'mahalo_ed_feature_image', true ) ); 
                            if (!isset( $_POST['mahalo_ed_feature_image'] )) {
                                $mahalo_ed_feature_image = get_theme_mod('ed_post_thumbnail');
                            }
                            ?>

                            <input type="checkbox" id="mahalo-ed-feature-image" name="mahalo_ed_feature_image" value="<?php echo $mahalo_default_feature_image; ?>" <?php if( $mahalo_ed_feature_image ){ echo "checked='checked'";} ?>/>

                            <label for="mahalo-ed-feature-image"><?php esc_html_e( 'Disable Feature Image','mahalo' ); ?></label>


                        </div>

                    </div>

                     <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','mahalo'); ?></h3>

                        <?php $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Navigation Type','mahalo' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','mahalo'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','mahalo'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php esc_html_e('Next Previous Navigation','mahalo'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','mahalo'); ?></option>

                            </select>

                        </div>
                    </div>

                </div>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $mahalo_ed_post_views = esc_html( get_post_meta( $post->ID, 'mahalo_ed_post_views', true ) );
                    $mahalo_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'mahalo_ed_post_read_time', true ) );
                    $mahalo_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'mahalo_ed_post_like_dislike', true ) );
                    $mahalo_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'mahalo_ed_post_author_box', true ) );
                    $mahalo_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'mahalo_ed_post_social_share', true ) );
                    $mahalo_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'mahalo_ed_post_reaction', true ) );
                    $mahalo_ed_post_rating = esc_html( get_post_meta( $post->ID, 'mahalo_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','mahalo'); ?></h3>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="mahalo-ed-post-views" name="mahalo_ed_post_views" value="1" <?php if( $mahalo_ed_post_views ){ echo "checked='checked'";} ?>/>
                                    <label for="mahalo-ed-post-views"><?php esc_html_e( 'Disable Post Views','mahalo' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="mahalo-ed-post-read-time" name="mahalo_ed_post_read_time" value="1" <?php if( $mahalo_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                    <label for="mahalo-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','mahalo' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="mahalo-ed-post-like-dislike" name="mahalo_ed_post_like_dislike" value="1" <?php if( $mahalo_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                    <label for="mahalo-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','mahalo' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="mahalo-ed-post-author-box" name="mahalo_ed_post_author_box" value="1" <?php if( $mahalo_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                    <label for="mahalo-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','mahalo' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="mahalo-ed-post-social-share" name="mahalo_ed_post_social_share" value="1" <?php if( $mahalo_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                    <label for="mahalo-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','mahalo' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="mahalo-ed-post-reaction" name="mahalo_ed_post_reaction" value="1" <?php if( $mahalo_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                    <label for="mahalo-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','mahalo' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap theme-checkbox-wrap">

                                    <input type="checkbox" id="mahalo-ed-post-rating" name="mahalo_ed_post_rating" value="1" <?php if( $mahalo_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                    <label for="mahalo-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','mahalo' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'mahalo_save_post_meta' );

if( ! function_exists( 'mahalo_save_post_meta' ) ):

    function mahalo_save_post_meta( $post_id ) {

        global $post, $mahalo_post_sidebar_fields, $mahalo_post_layout_options, $mahalo_header_overlay_options,  $mahalo_page_layout_options;

        if ( !isset( $_POST[ 'mahalo_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['mahalo_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }


        foreach ( $mahalo_post_sidebar_fields as $mahalo_post_sidebar_field ) {  
            

                $old = esc_html( get_post_meta( $post_id, 'mahalo_post_sidebar_option', true ) ); 
                $new = isset( $_POST['mahalo_post_sidebar_option'] ) ? mahalo_sanitize_sidebar_option_meta( wp_unslash( $_POST['mahalo_post_sidebar_option'] ) ) : '';

                if ( $new && $new != $old ){

                    update_post_meta ( $post_id, 'mahalo_post_sidebar_option', $new );

                }elseif( '' == $new && $old ) {

                    delete_post_meta( $post_id,'mahalo_post_sidebar_option', $old );

                }

            
        }

        $twp_disable_ajax_load_next_post_old = esc_html( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 
        $twp_disable_ajax_load_next_post_new = isset( $_POST['twp_disable_ajax_load_next_post'] ) ? mahalo_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) ) : '';

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }


        foreach ( $mahalo_post_layout_options as $mahalo_post_layout_option ) {  
            
            $mahalo_post_layout_old = esc_html( get_post_meta( $post_id, 'mahalo_post_layout', true ) ); 
            $mahalo_post_layout_new = isset( $_POST['mahalo_post_layout'] ) ? mahalo_sanitize_post_layout_option_meta( wp_unslash( $_POST['mahalo_post_layout'] ) ) : '';

            if ( $mahalo_post_layout_new && $mahalo_post_layout_new != $mahalo_post_layout_old ){

                update_post_meta ( $post_id, 'mahalo_post_layout', $mahalo_post_layout_new );

            }elseif( '' == $mahalo_post_layout_new && $mahalo_post_layout_old ) {

                delete_post_meta( $post_id,'mahalo_post_layout', $mahalo_post_layout_old );

            }
            
        }



        foreach ( $mahalo_header_overlay_options as $mahalo_header_overlay_option ) {  
            
            $mahalo_header_overlay_old = esc_html( get_post_meta( $post_id, 'mahalo_header_overlay', true ) ); 
            $mahalo_header_overlay_new = isset( $_POST['mahalo_header_overlay'] ) ? mahalo_sanitize_header_overlay_option_meta( wp_unslash( $_POST['mahalo_header_overlay'] ) ) : '';

            if ( $mahalo_header_overlay_new && $mahalo_header_overlay_new != $mahalo_header_overlay_old ){

                update_post_meta ( $post_id, 'mahalo_header_overlay', $mahalo_header_overlay_new );

            }elseif( '' == $mahalo_header_overlay_new && $mahalo_header_overlay_old ) {

                delete_post_meta( $post_id,'mahalo_header_overlay', $mahalo_header_overlay_old );

            }
            
        }



        $mahalo_ed_feature_image_old = esc_html( get_post_meta( $post_id, 'mahalo_ed_feature_image', true ) ); 
        $mahalo_ed_feature_image_new = isset( $_POST['mahalo_ed_feature_image'] ) ? absint( wp_unslash( $_POST['mahalo_ed_feature_image'] ) ) : '';

        if ( $mahalo_ed_feature_image_new && $mahalo_ed_feature_image_new != $mahalo_ed_feature_image_old ){

            update_post_meta ( $post_id, 'mahalo_ed_feature_image', $mahalo_ed_feature_image_new );

        }elseif( '' == $mahalo_ed_feature_image_new && $mahalo_ed_feature_image_old ) {

            delete_post_meta( $post_id,'mahalo_ed_feature_image', $mahalo_ed_feature_image_old );

        }



        $mahalo_ed_post_views_old = esc_html( get_post_meta( $post_id, 'mahalo_ed_post_views', true ) ); 
        $mahalo_ed_post_views_new = isset( $_POST['mahalo_ed_post_views'] ) ? absint( wp_unslash( $_POST['mahalo_ed_post_views'] ) ) : '';

        if ( $mahalo_ed_post_views_new && $mahalo_ed_post_views_new != $mahalo_ed_post_views_old ){

            update_post_meta ( $post_id, 'mahalo_ed_post_views', $mahalo_ed_post_views_new );

        }elseif( '' == $mahalo_ed_post_views_new && $mahalo_ed_post_views_old ) {

            delete_post_meta( $post_id,'mahalo_ed_post_views', $mahalo_ed_post_views_old );

        }



        $mahalo_ed_post_read_time_old = esc_html( get_post_meta( $post_id, 'mahalo_ed_post_read_time', true ) ); 
        $mahalo_ed_post_read_time_new = isset( $_POST['mahalo_ed_post_read_time'] ) ? absint( wp_unslash( $_POST['mahalo_ed_post_read_time'] ) ) : '';

        if ( $mahalo_ed_post_read_time_new && $mahalo_ed_post_read_time_new != $mahalo_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'mahalo_ed_post_read_time', $mahalo_ed_post_read_time_new );

        }elseif( '' == $mahalo_ed_post_read_time_new && $mahalo_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'mahalo_ed_post_read_time', $mahalo_ed_post_read_time_old );

        }



        $mahalo_ed_post_like_dislike_old = esc_html( get_post_meta( $post_id, 'mahalo_ed_post_like_dislike', true ) ); 
        $mahalo_ed_post_like_dislike_new = isset( $_POST['mahalo_ed_post_like_dislike'] ) ? absint( wp_unslash( $_POST['mahalo_ed_post_like_dislike'] ) ) : '';

        if ( $mahalo_ed_post_like_dislike_new && $mahalo_ed_post_like_dislike_new != $mahalo_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'mahalo_ed_post_like_dislike', $mahalo_ed_post_like_dislike_new );

        }elseif( '' == $mahalo_ed_post_like_dislike_new && $mahalo_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'mahalo_ed_post_like_dislike', $mahalo_ed_post_like_dislike_old );

        }



        $mahalo_ed_post_author_box_old = esc_html( get_post_meta( $post_id, 'mahalo_ed_post_author_box', true ) ); 
        $mahalo_ed_post_author_box_new = isset( $_POST['mahalo_ed_post_author_box'] ) ? absint( wp_unslash( $_POST['mahalo_ed_post_author_box'] ) ) : '';

        if ( $mahalo_ed_post_author_box_new && $mahalo_ed_post_author_box_new != $mahalo_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'mahalo_ed_post_author_box', $mahalo_ed_post_author_box_new );

        }elseif( '' == $mahalo_ed_post_author_box_new && $mahalo_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'mahalo_ed_post_author_box', $mahalo_ed_post_author_box_old );

        }



        $mahalo_ed_post_social_share_old = esc_html( get_post_meta( $post_id, 'mahalo_ed_post_social_share', true ) ); 
        $mahalo_ed_post_social_share_new = isset( $_POST['mahalo_ed_post_social_share'] ) ? absint( wp_unslash( $_POST['mahalo_ed_post_social_share'] ) ) : '';

        if ( $mahalo_ed_post_social_share_new && $mahalo_ed_post_social_share_new != $mahalo_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'mahalo_ed_post_social_share', $mahalo_ed_post_social_share_new );

        }elseif( '' == $mahalo_ed_post_social_share_new && $mahalo_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'mahalo_ed_post_social_share', $mahalo_ed_post_social_share_old );

        }



        $mahalo_ed_post_reaction_old = esc_html( get_post_meta( $post_id, 'mahalo_ed_post_reaction', true ) ); 
        $mahalo_ed_post_reaction_new = isset( $_POST['mahalo_ed_post_reaction'] ) ? absint( wp_unslash( $_POST['mahalo_ed_post_reaction'] ) ) : '';

        if ( $mahalo_ed_post_reaction_new && $mahalo_ed_post_reaction_new != $mahalo_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'mahalo_ed_post_reaction', $mahalo_ed_post_reaction_new );

        }elseif( '' == $mahalo_ed_post_reaction_new && $mahalo_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'mahalo_ed_post_reaction', $mahalo_ed_post_reaction_old );

        }



        $mahalo_ed_post_rating_old = esc_html( get_post_meta( $post_id, 'mahalo_ed_post_rating', true ) ); 
        $mahalo_ed_post_rating_new = isset( $_POST['mahalo_ed_post_rating'] ) ? absint( wp_unslash( $_POST['mahalo_ed_post_rating'] ) ) : '';

        if ( $mahalo_ed_post_rating_new && $mahalo_ed_post_rating_new != $mahalo_ed_post_rating_old ){

            update_post_meta ( $post_id, 'mahalo_ed_post_rating', $mahalo_ed_post_rating_new );

        }elseif( '' == $mahalo_ed_post_rating_new && $mahalo_ed_post_rating_old ) {

            delete_post_meta( $post_id,'mahalo_ed_post_rating', $mahalo_ed_post_rating_old );

        }

        foreach ( $mahalo_page_layout_options as $mahalo_post_layout_option ) {  
        
            $mahalo_page_layout_old = sanitize_text_field( get_post_meta( $post_id, 'mahalo_page_layout', true ) ); 
            $mahalo_page_layout_new = isset( $_POST['mahalo_page_layout'] ) ? mahalo_sanitize_post_layout_option_meta( wp_unslash( $_POST['mahalo_page_layout'] ) ) : '';

            if ( $mahalo_page_layout_new && $mahalo_page_layout_new != $mahalo_page_layout_old ){

                update_post_meta ( $post_id, 'mahalo_page_layout', $mahalo_page_layout_new );

            }elseif( '' == $mahalo_page_layout_new && $mahalo_page_layout_old ) {

                delete_post_meta( $post_id,'mahalo_page_layout', $mahalo_page_layout_old );

            }
            
        }

        $mahalo_ed_header_overlay_old = absint( get_post_meta( $post_id, 'mahalo_ed_header_overlay', true ) ); 
        $mahalo_ed_header_overlay_new = isset( $_POST['mahalo_ed_header_overlay'] ) ? absint( wp_unslash( $_POST['mahalo_ed_header_overlay'] ) ) : '';

        if ( $mahalo_ed_header_overlay_new && $mahalo_ed_header_overlay_new != $mahalo_ed_header_overlay_old ){

            update_post_meta ( $post_id, 'mahalo_ed_header_overlay', $mahalo_ed_header_overlay_new );

        }elseif( '' == $mahalo_ed_header_overlay_new && $mahalo_ed_header_overlay_old ) {

            delete_post_meta( $post_id,'mahalo_ed_header_overlay', $mahalo_ed_header_overlay_old );

        }

    }

endif;   