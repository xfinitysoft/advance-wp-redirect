<?php
/*
* Functions of Advance WP Redirect
*
*/
// Exit if directly access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
* Setting link plugin
* @param array $xsawrlite_link
* @return array $xsawrlite_link
*/
function xsawrlite_plugin_link($xsawrlite_link)
{
    $setting_link = '<a href="admin.php?page=xsawrlite_page">Setting</a>';
    array_unshift($xsawrlite_link,$setting_link);
    return $xsawrlite_link;
}

/**
*
*Get the options
* @param string option name
*/
function xsawrlite_check_option($option_name, $value){
    $xsawrlite_getopt = get_option($option_name);
    if( isset($xsawrlite_getopt[$value]) && !empty($xsawrlite_getopt) ) {
        if( $xsawrlite_getopt[$value] == 1 || $xsawrlite_getopt[$value] == $value ) {
            echo "checked";
        } else {
            echo $xsawrlite_getopt[$value];
        }
    }
}

?>