<?php

/**
 * @package Recensility Master
 */
/*
 Plugin Name: Recensility Master
 Plugin URI: https://recensility.it/wp-admin/recensility-master/index.php
 Description: Centro di controllo per Recensility
 Version: 0.5
 Author: Alessandro Giaquinto
 Author URI: https://recensility.it/Alessandro_Giaquinto
 License: GPLv2 
 Text Domain: recensility-master
 */


/* 
 * Security checking 
 */
defined( 'ABSPATH' ) or die( 'You\'re not allowed to watch this.' );

/*
 * Security checking
 * This is an extra and it's not necessary
 */
if ( !function_exists('add_action') ){
    echo 'You\'re not allowed to watch this.';
    exit;
}

require_once plugin_dir_path( __FILE__ ) . 'include/class/Initializer.php';
require_once plugin_dir_path(  __FILE__ ) . 'include/widgets/RecensilityNewsReader.php';

/*
 * Create Objects
 */
 
if ( class_exists( 'Initializer' ) ){    
    $I = new Initializer();
    $I->register();
    register_activation_hook( __FILE__, array( $I, 'activation' ) );

    register_deactivation_hook( __FILE__, array( $I, 'deactivation' ) );
}

if ( class_exists( 'RecensilityNewsReaderWidget' ) ){
    $nr = new RecensilityNewsReaderWidget();
    $nr->register();
}





