<?php
/**
 * Advertise
 *
 * @package Mahalo
 */

function mahalo_advertise_block( $mahalo_home_section ,$repeat_times){ 

	$advertise_image = esc_html( isset($mahalo_home_section->advertise_image) ? $mahalo_home_section->advertise_image : '');
	$advertise_link = esc_html( isset($mahalo_home_section->advertise_link) ? $mahalo_home_section->advertise_link : '');
	if( $advertise_image ){
	?>
	<div id="theme-block-<?php echo esc_attr($repeat_times); ?>" class="theme-block theme-block-ava">
	    <div class="wrapper">
            <div class="column-row">
                <div class="column column-12">
                    <a href="<?php echo esc_url($advertise_link); ?>" target="_blank" class="home-lead-link">
                        <img src="<?php echo esc_url($advertise_image); ?>" alt="<?php esc_attr_e('Advertise Image', 'mahalo'); ?>">
                    </a>
                </div>
            </div>
		</div>
	</div>

	<?php
	}
	
} ?>