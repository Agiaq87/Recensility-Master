<?php

/** 
 * Like source of "thrut" :P
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */


/*
 * Check if table not exist
 */
function RMQ_check_table_not_exist(&$wpdb, string $table) {
    return $wpdb->get_var('SHOW TABLES LIKE \'' . $wpdb->prefix . $table . '\'') === $table;
}

    // Recensility Fast Link

    
    
    // Recensility Color Fest

    // Recensility Brand
    

    // Recensility category
    $wpdb->query(
        'CREATE TABLE `'.$wpdb->prefix.'recensility_category` (
            `id` int NOT NULL,
            `category` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `archive` datetime NOT NULL DEFAULT \''.date('Y-m-d').' 00:00:01\', 
            `image` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `occur` int DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;'
    );

    $wpdb->query(
        'INSERT INTO `'.$wpdb->prefix.'recensility_category` (`id`, `category`, `archive`, `image`, `occur`) VALUES
        (1, "Auricolari", "2019-01-07 00:24:32", "", 0),
        (2, "Console", "2019-01-07 00:24:32", "", 0),
        (3, "Convertibili", "2019-01-07 00:24:32", "", 0),
        (4, "Cuffie", "2019-01-07 00:24:32", "", 0),
        (5, "Embedded", "2019-01-07 00:24:32", "", 0),
        (6, "Hi-Fi", "2019-01-07 00:24:32", "", 0),
        (7, "Monitor", "2019-01-07 00:24:32", "", 0),
        (8, "Notebook", "2019-01-07 00:24:32", "", 0),
        (9, "Pc", "2019-01-07 00:24:32", "", 0),
        (10, "Smartphone", "2019-01-07 00:24:32", "", 0),
        (11, "Smartwatch", "2019-01-07 00:24:32", "", 0),
        (12, "Tablet", "2019-01-07 00:24:32", "", 0),
        (13, "Workstation desktop", "2019-01-07 00:24:32", "", 0),
        (14, "Workstation portatili", "2019-01-07 00:24:32", "", 0);'
    );
}

/*
 * Drop initial table
 */

function RMQ_drop_options_table(){
    global $wpdb;
    $wpdb->query('DROP TABLE `'.$wpdb->prefix.'recensility_master_options`');
}


/*
 * Generic function
 */
function RMQ_get_options(&$wpdb, string $refer, string $name){
    return $wpdb->query('SELECT * FROM `'.$wpdb->prefix.'recensility_master_options` WHERE `refer` = \''.$refer.'\' AND `name` = \''.$name.'\'')[0]->value;
}

/*
 * Require a table
 */
function RMQ_table(&$wpdb, string $table){
    return $wpdb->get_results( "SELECT * FROM `$table`" );
}

/*
 * Articles length
 */
function RMQ_get_articles_lentgh(&$wpdb){
    return (int)($wpdb->get_results('SELECT * FROM `'.$wpdb->prefix.'recensility_master_options` WHERE `refer` = \'article\' AND `name` = \'lentgh\'')[0])->value;
}

/*
 * Articles delta day
 */
function RMQ_get_articles_delta_day(&$wpdb){
    return (int)($wpdb->get_results('SELECT * FROM `'.$wpdb->prefix.'recensility_master_options` WHERE `refer` = \'article\' AND `name` = \'delta_day\'')[0])->value;
}

/*
 * Obtain engine for charts
 */
function RMQ_get_engine_charts(&$wpdb){
    return (int)($wpdb->get_results('SELECT * FROM `'.$wpdb->prefix.'recensility_master_options` WHERE `refer` = \'charts\' AND `name` = \'vendor\'')[0])->value;
}


/*
 * Update functions
 */
//Articles
function RMQ_update_articles_lentgh(&$wpdb, int $lentgh){
    return $wpdb->query('UPDATE `'.$wpdb->prefix.'recensility_master_options` SET `value` = '.$lentgh.' WHERE `name` = \'lentgh\'' );
}

function RMQ_update_articles_delta_day(&$wpdb, int $delta){
    return $wpdb->query('UPDATE `'.$wpdb->prefix.'recensility_master_options` SET `value` = '.$delta.' WHERE `name` = \'delta_day\'' );
}

function RMQ_update_diagram_engine(&$wpdb, int $value){
    return $wpdb->query('UPDATE `'.$wpdb->prefix.'recensility_master_options` SET `value` = '.$value.' WHERE `name` = \'vendor\'' );
}

// Colors
function RMQ_update_colors(&$wpdb, $id, $active_id){
    return (
        $wpdb->get_results('UPDATE `'.$wpdb->prefix.'` SET `is_active`= "true" WHERE `id` = '.$id )
            &&
        $wpdb->get_results('UPDATE `'.$wpdb->prefix.'` SET `is_active`= "false" WHERE `id` = '.$active_id )
            );
}


/*
 * Specific
 */
// Authors
function RMQ_get_authors(&$wpdb){
    return $wpdb->get_results("SELECT DISTINCT $wpdb->posts.post_author, $wpdb->users.user_login, $wpdb->users.user_email, $wpdb->users.display_name FROM  $wpdb->posts, $wpdb->users WHERE $wpdb->posts.post_author = $wpdb->users.ID");
}
// Colors
function RMQ_get_colors(&$wpdb){
    return $wpdb->get_results('SELECT * FROM `'.$wpdb->prefix.'recensility_color_fest`');
}