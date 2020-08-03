<?php

/**
 * The most important class
 * Provide activation and deactivation operation
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */

require_once plugin_dir_path( dirname( __FILE__ ) ) . 'utils/recensility_master_dataset.php';

if ( !class_exists('Inizializer') ){    
    class Initializer {
        
        private $Q;
        public $basename;

        public function __construct(){
            global $wpdb;
            $this->Q = $wpdb;
            $this->basename = plugin_basename(__FILE__);
        }

        public function activation(){
            /* 
             * First check WP version installed
             */
            global $wp_version;
            if ( version_compare( $wp_version, '5.0', '<' ) ){
                wp_die( 'This plugin requires WordPress version 5.0 or higher' );
            }
            /*
             * then check if table exist and populate
             */
            RMQ_make_options_table($this->Q);
            /*
             * Flush automatically the regular route
             * It's important for operation that infer to database and change rules of wordpress admin
             */
            flush_rewrite_rules();
            
        }

        public function deactivation(){
            RMQ_drop_options_table($this->Q);
            flush_rewrite_rules();
        }

        public function enqueue(){
            wp_enqueue_style( 'main', plugins_url( '/recensility-master/css/main.css' ) ); 
            wp_enqueue_style( 'modal', plugins_url( '/recensility-master/css/modal.css' ) ); 
            wp_enqueue_script( 'main', plugins_url( '/recensility-master/js/main.js' ) ); 
            wp_enqueue_script( 'tabChooser', plugins_url( '/recensility-master/js/tabChooser.js' ) ); 
            wp_enqueue_style( 'modal', plugins_url( '/recensility-master/js/chartsjs/node_modules/chart.js/dist/Chart.min.css' ) );
        } 

        public function register(){
            add_action( 'init', array( $this, 'custom_post_type' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
            add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
                        
            add_filter( "plugin_action_links_$this->basename", array( $this, 'settings_link' ) );
        }
        
        public function add_admin_pages(){
            add_menu_page(
                        'Recensility Master',
                        'Recensility Master',
                        'manage_options',
                        'recensility_master',
                        array( $this, 'admin_page' ),
                        plugins_url('/recensility-master/img/Recensility_n.png'),
                        4
                );
            add_submenu_page(
                        'recensility_master',
                        'RecensilityMaster',
                        'Schede tecniche',
                        'manage_options',
                        'recensility_master_datasheets',
                        array( $this, 'admin_datasheets_page' )
            );
            add_submenu_page(
                        'recensility_master',
                        'RecensilityMaster',
                        'Impostazioni',
                        'manage_options',
                        'recensility_master_settings',
                        array( $this, 'admin_settings_page' )
            );
        }
        
        public function settings_link($links){
            $settings_link = '<a href="admin.php?page=recensility_master_settings_page">Settings</a>';
            array_push( $links, $settings_link);
            return $links;
        }

        /*
         * This create a new menu voice for 'Migliori page' for add a new page of 'migliori' like a post
         */
        public function custom_post_type(){
            $labels = array(
                'name' => 'Consigliati',
                'singular_name' => 'Consigliato',
                'add_new' => 'Nuovo consigliato',
                'add_new_item' => 'Aggiungi nuovo consigliato',
                'edit_item' => 'Modifica consigliato',
                'new_item' => 'Nuovo consigliato',
                'all_items' => 'Tutti i consigliati',
                'view_item' => 'Vedi il consigliato',
                'search_items' => 'Cerca un consigliato',
                'not_found' => 'Nessun consigliato trovato',
                'not_found_in_trash' => 'Nessun consigliato trovato nel cestino',
                'menu_name' => 'Consigliati'
            );
            $args = array(
                'labels' => $labels,  
                'public' => true,
                'show_in_menu' => true,
                'public_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'rewrite' => array( 'slug', 'recensilityConsiglia'),
                'capability_type' => 'post',
                'has_archive' => true,
                'hierarchical' => false,
                'menu_position'=> 4,
                'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'revsions' )
            );
            register_post_type( 'recensilityConsiglia', $args);
            flush_rewrite_rules();
            //register_post_type( 'consigliati', ['public' => 'true', 'labels' => 'Consigliati'] );
            //register_post_type( 'schede tecniche', ['public' => 'true', 'label' => 'Schede tecniche'] );
        }       
        
        public function admin_page(){
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'pages/recensility_master_admin_page.php';
        }
        
        public function admin_settings_page(){
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'pages/recensility_master_settings_page.php';
        }
        
        public function admin_datasheets_page(){
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'pages/recensility_master_datasheets_page.php';
        }
    }
}
