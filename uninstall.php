<?php

/* 
 * Author: Alessandro Giaquinto
 * Uninstall operations
 */

/**
 * @package Recensility Master
 */

if( !defined( 'WP_UNINSTALL_PLUGIN' ) ){
    die;
}


/*
 * Delete the master options table
 */
global $wpdb;

$wpdb->query( 'DROP TABLE `'.$wpdb->prefix.'recensility_master_options`' );

/*
 * Delete 'migliori'
 */
//$wpdb->query( 'DELETE FROM '.$wpdb->prefix.'posts WHERE `post_type` = `migliori`');
//$wpdb->query( 'DELETE FROM '.$wpdb->prefix.'postmeta WHERE `post_id` NOT IN (SELECT id FROM '.$wpdb->prefix.'posts)');
//$wpdb->query( 'DELETE FROM '.$wpdb->prefix.'term_relationships WHERE `object_id` NOT IN (SELECT id FROM '.$wpdb->prefix.'posts)');

/*
 * Also equal method:
 */
 $deleting = get_post( array( 'post_type' => 'migliori', 'numberposts' => -1 ) );
 foreach ($deleting as $delete) {
    wp_delete_post( $delete->ID, true );    // If true, the post are delete even it's a draft or private or trashed
 }