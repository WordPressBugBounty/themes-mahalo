<?php
if ( !class_exists('Mahalo_Dashboard_Notice') ):

    class Mahalo_Dashboard_Notice
    {
        function __construct()
        {	
            global $pagenow;

        	if( $this->mahalo_show_hide_notice() ){

	            add_action( 'admin_notices',array( $this,'mahalo_admin_notiece' ) );
                
	        }
	        add_action( 'wp_ajax_mahalo_notice_dismiss', array( $this, 'mahalo_notice_dismiss' ) );
			add_action( 'switch_theme', array( $this, 'mahalo_notice_clear_cache' ) );
        
            if( isset( $_GET['page'] ) && $_GET['page'] == 'mahalo-about' ){

                add_action('in_admin_header', array( $this,'mahalo_hide_all_admin_notice' ),1000 );

            }
        }

        public function mahalo_hide_all_admin_notice(){

            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');

        }
        
        public static function mahalo_show_hide_notice(){

            // Check If current Page 
            if ( isset( $_GET['page'] ) && $_GET['page'] == 'mahalo-about'  ) {
                return false;
            }

        	// Hide if dismiss notice
        	if( get_option('mahalo_admin_notice') ){
				return false;
			}
        	// Hide if all plugin active
        	if ( class_exists( 'Booster_Extension_Class' ) &&  class_exists( 'Demo_Import_Kit_Class' )  &&  class_exists( 'Themeinwp_Import_Companion' ) ) {
				return false;
			}
			// Hide On TGMPA pages
			if ( ! empty( $_GET['tgmpa-nonce'] ) ) {
				return false;
			}
			// Hide if user can't access
        	if ( current_user_can( 'manage_options' ) ) {
				return true;
			}
			
        }

        // Define Global Value
        public static function mahalo_admin_notiece(){

            $theme_info      = wp_get_theme();
            $theme_name            = $theme_info->__get( 'Name' );
            ?>
           <div class="updated notice is-dismissible twp-mahalo-notice">

                <h3><?php printf( __( 'Thank you for choosing %1$s ! We’re so glad that you found what you were looking for.', 'mahalo' ), esc_html( $theme_name ) ); ?></h3>
                <p><strong><?php printf( __( '%1$s is now installed and ready to use. We\'ve assembled some links to get you started.', 'mahalo' ), esc_html( $theme_name ) ); ?></strong></p>

                <small><?php esc_html_e("We've prepared a unique onboarding process through our",'mahalo'); ?> <a href="<?php echo esc_url( admin_url().'themes.php?page='.get_template().'-about') ?>"><?php esc_html_e('Getting started','mahalo'); ?></a> <?php esc_html_e("page. It helps you get started and configure your upcoming website with ease. Let's make it shine!",'mahalo'); ?></small>

                <p>
                    <a target="_blank" class="button button-primary button-primary-upgrade" href="<?php echo esc_url( 'https://www.themeinwp.com/theme/mahalo-pro/' ); ?>">
                        <span class="dashicons dashicons-thumbs-up"></span>
                        <span><?php esc_html_e('Upgrade to Pro','mahalo'); ?></span>
                    </a>

                    <a class="button button-primary twp-install-active" href="javascript:void(0)">
                        <span class="dashicons dashicons-admin-plugins"></span>
                        <span><?php esc_html_e('Install and activate recommended plugins','mahalo'); ?></span>
                    </a>
                    <span class="quick-loader-wrapper"><span class="quick-loader"></span></span>

                    <a target="_blank" class="button button-primary" href="<?php echo esc_url( 'https://demo-preview.themeinwp.com/mahalo/' ); ?>">
                        <span class="dashicons dashicons-welcome-view-site"></span>
                        <span><?php esc_html_e('View Demo','mahalo'); ?></span>
                    </a>

                    <a target="_blank" class="button button-primary" href="<?php echo esc_url('https://wordpress.org/support/theme/mahalo/reviews/?filter=5'); ?>">
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span><?php esc_html_e('Leave a review', 'mahalo'); ?></span>
                    </a>

                    <a class="btn-dismiss twp-custom-setup" href="javascript:void(0)"><?php esc_html_e('Dismiss this notice.','mahalo'); ?></a>

                </p>

            </div>

        <?php
        }

        public function mahalo_notice_dismiss(){

        	if ( isset( $_POST[ '_wpnonce' ] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ '_wpnonce' ] ) ), 'mahalo_ajax_nonce' ) ) {

	        	update_option('mahalo_admin_notice','hide');

	        }

            die();

        }

        public function mahalo_notice_clear_cache(){

        	update_option('mahalo_admin_notice','');

        }

    }
    new Mahalo_Dashboard_Notice();
endif;