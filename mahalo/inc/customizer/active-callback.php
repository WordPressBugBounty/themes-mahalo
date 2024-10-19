<?php
/**
 * Mahalo Customizer Active Callback Functions
 *
 * @package Mahalo
 */

function mahalo_header_archive_layout_ac( $control ){

    $mahalo_archive_layout = $control->manager->get_setting( 'mahalo_archive_layout' )->value();
    if( $mahalo_archive_layout == 'default' ){

        return true;
        
    }
    
    return false;
}

function mahalo_overlay_layout_ac( $control ){

    $mahalo_single_post_layout = $control->manager->get_setting( 'mahalo_single_post_layout' )->value();
    if( $mahalo_single_post_layout == 'layout-2' ){

        return true;
        
    }
    
    return false;
}

function mahalo_header_ad_ac( $control ){

    $ed_header_ad = $control->manager->get_setting( 'ed_header_ad' )->value();
    if( $ed_header_ad ){

        return true;
        
    }
    
    return false;
}
function mahalo_middle_header_ad_ac( $control ){

    $ed_middle_header_ad = $control->manager->get_setting( 'ed_middle_header_ad' )->value();
    if( $ed_middle_header_ad ){

        return true;
        
    }
    
    return false;
}