<?php

/** 
 * Like source of "thrut" :P
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */



/*
 * First access into database for creating table
 */
function RMQ_make_options_table(){
    global $wpdb;
    
    // Recensility Master Table
    $wpdb->query(
        'CREATE TABLE `'.$wpdb->prefix.'recensility_master_options` (
        `id` INT NOT NULL AUTO_INCREMENT, 
        `refer` VARCHAR(255) NOT NULL, 
        `name` VARCHAR(255) NOT NULL, 
        `value` VARCHAR(255) NOT NULL,
        `created` DATETIME NOT NULL DEFAULT \''.date('Y-m-d').' 00:00:01\', PRIMARY KEY (`id`))   '
            . 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;'
        );
            
    $wpdb->query('INSERT INTO `'.$wpdb->prefix.'recensility_master_options` ('
                 . '`refer`, `name`, `value`) VALUES ('
                 . '\'article\', \'lentgh\', 10 )'   
                    );
    $wpdb->query('INSERT INTO `'.$wpdb->prefix.'recensility_master_options` ('
                 . '`refer`, `name`, `value`) VALUES ('
                 . '\'article\', \'delta_day\', 3 )'   
                    );
    $wpdb->query('INSERT INTO `'.$wpdb->prefix.'recensility_master_options` ('
                 . '`refer`, `name`, `value`) VALUES ('
                 . '\'charts\', \'vendor\', 1 )'   
                    );
    
    $temp = get_home_path().'/wp-content/themes/recensility/style.css';
    $wpdb->query('INSERT INTO `'.$wpdb->prefix.'recensility_master_options` ('
                 . '`refer`, `name`, `value`) VALUES ('
                 . '\'colorfest\', \'path\', \''.$temp.'\' )'   
                    );
    
    // Recensility Fast Link
    $wpdb->query(
            'CREATE TABLE `'.$wpdb->prefix.'recensility_fast_link` (
            `id` int(11) NOT NULL,
            `icon_class` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `link_name` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `link_url` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `archive` datetime NOT NULL DEFAULT \''.date('Y-m-d').' 00:00:01\', PRIMARY KEY(`id`) 
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;'
            );

    $wpdb->query(
            'INSERT INTO `'.$wpdb->prefix.'recensility_fast_link` (`id`, `icon_class`, `link_name`, `link_url`, `archive`, `occur`) VALUES
            (1, \'fas fa-bullhorn\', \'Chi siamo\', \'https://recensility.it/consigli/novita-di-recensility/ \', \''.date('Y-m-d').' 00:00:01\', 0),
            (2, \'fab fa-amazon\', \'Amazon\', \'https://recensility.it/abbonamenti-amazon/ \', \''.date('Y-m-d').' 00:00:01\', 0),
            (3, \'far fa-address-card\', \'Chi siamo\', \'https://recensility.it/chi-siamo/ \', \''.date('Y-m-d').' 00:00:01\', 0);'
            );
    
    // Recensility Color Fest
    var_dump($wpdb->query(
            'CREATE TABLE `'.$wpdb->prefix.'recensility_color_fest` (
            `id` int(11) NOT NULL,
            `name` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `exadecimal` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `is_active` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
            `archive` datetime NOT NULL DEFAULT \''.date('Y-m-d').' 00:00:01\', PRIMARY KEY(`id`) 
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;'
            ));
    
    $wpdb->query(
            'INSERT INTO `'.$wpdb->prefix.'recensility_color_fest` (`id`, `name`, `exadecimal`, `is_active`, `archive`) VALUES
            (1, \'Recensility\', \'#2f6d43\', \'true\', \''.date('Y-m-d').'\'),
            (2, \'Hollywood Green\', \'#1f3a3c\', \'false\', \''.date('Y-m-d').'\'),
            (3, \'Christmas\', \'#cb2821\', \'false\', \''.date('Y-m-d').'\'),
            (4, \'Valentine\', \'#d12932\', \'false\', \''.date('Y-m-d').'\'),
            (5, \'St. Patrick Blue\', \'#23297A\', \'false\', \''.date('Y-m-d').'\'),
            (6, \'St. Patrick Green\', \'#224D17\', \'false\', \''.date('Y-m-d').'\'),
            (7, \'St. Patrick Emerald\', \'#099441\', \'false\', \''.date('Y-m-d').'\'),
            (8, \'St. Patrick Light Green\', \'#60A830\', \'false\', \''.date('Y-m-d').'\'),
            (9, \'St. Patrick Gold\', \'#D9DF1D\', \'false\', \''.date('Y-m-d').'\'),
            (10, \'Benjamin Moore St. Patrick\', \'#01A07F\', \'false\', \''.date('Y-m-d').'\'),
            (11, \'Black Friday Carbon\', \'#050402\', \'false\', \''.date('Y-m-d').'\'),
            (12, \'Black Friday Intense\', \'#0a0a0a\', \'false\', \''.date('Y-m-d').'\'),
            (13, \'Before Christmas\', \'#310062\', \'false\', \''.date('Y-m-d').'\'),
            (14, \'Recensility Next\', \'#022900\', \'false\', \''.date('Y-m-d').'\'),
            (15, \'Jupiter Orange\', \'#A93A07\', \'false\', \''.date('Y-m-d').'\');'
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