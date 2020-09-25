<?php
/*
* Plugin Name: MOS Gform True IP
* Plugin URI: https://myonlinestartup.com
* Description: Allows Gravity Forms to determine true IP in case client/server is using a proxy
* Version: 0.1.0
* Author: My Online Startup
* Author URI: https://myonlinestartup.com
*/

// Check for wordpress environment
if( !defined( 'ABSPATH' ) ) {
  die;
}

add_filter( 'gform_ip_address', function( $ip ) {
  if ( !empty($_SERVER['HTTP_CLIENT_IP']) ) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif ( !empty($_SERVER['CF-Connecting-IP']) ) {
    $ip = $_SERVER["CF-Connecting-IP"];
  } elseif ( !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
    if ( strpos( $_SERVER['HTTP_X_FORWARDED_FOR'], ',' ) !== false ) {
      $ip = explode( ',', $_SERVER['HTTP_X_FORWARDED_FOR'] )[0];
    } else {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
});