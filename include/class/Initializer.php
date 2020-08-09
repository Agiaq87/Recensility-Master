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
            $this->Q->query(
                'CREATE TABLE `'.$wpdb->prefix.'recensility_master_options` (
                `id` INT NOT NULL AUTO_INCREMENT, 
                `refer` VARCHAR(255) NOT NULL, 
                `name` VARCHAR(255) NOT NULL, 
                `value` VARCHAR(255) NOT NULL,
                `created` DATETIME NOT NULL DEFAULT \''.date('Y-m-d').' 00:00:01\', PRIMARY KEY (`id`))   '
                    . 'ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;'
                );
                    
            $this->Q->query('INSERT INTO `'.$wpdb->prefix.'recensility_master_options` ('
                         . '`refer`, `name`, `value`) VALUES ('
                         . '\'article\', \'lentgh\', 10 )'   
                            );
            $this->Q->query('INSERT INTO `'.$wpdb->prefix.'recensility_master_options` ('
                         . '`refer`, `name`, `value`) VALUES ('
                         . '\'article\', \'delta_day\', 3 )'   
                            );
            $this->Q->query('INSERT INTO `'.$wpdb->prefix.'recensility_master_options` ('
                         . '`refer`, `name`, `value`) VALUES ('
                         . '\'charts\', \'vendor\', 1 )'   
                            );
            
            /*
             * Next step: control if tables exists
             * If specific table don't exist, then create it
             */
            // First check fast link
            if ( RMQ_check_table_not_exist('recensility_fast_link') ) {
                $this->Q->query(
                    'CREATE TABLE `'.$wpdb->prefix.'recensility_fast_link` (
                    `id` int(11) NOT NULL,
                    `icon_class` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
                    `link_name` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
                    `link_url` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
                    `archive` datetime NOT NULL DEFAULT \''.date('Y-m-d').' 00:00:01\', PRIMARY KEY(`id`) 
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;'
                    );
        
                $this->Q->query(
                    'INSERT INTO `'.$wpdb->prefix.'recensility_fast_link` (`id`, `icon_class`, `link_name`, `link_url`, `archive`, `occur`) VALUES
                    (1, \'fas fa-bullhorn\', \'Chi siamo\', \'https://recensility.it/consigli/novita-di-recensility/ \', \''.date('Y-m-d').' 00:00:01\', 0),
                    (2, \'fab fa-amazon\', \'Amazon\', \'https://recensility.it/abbonamenti-amazon/ \', \''.date('Y-m-d').' 00:00:01\', 0),
                    (3, \'far fa-address-card\', \'Chi siamo\', \'https://recensility.it/chi-siamo/ \', \''.date('Y-m-d').' 00:00:01\', 0);'
                    );
            }

            if ( RMQ_check_table_not_exist('recensility_color_fest') ) {
                $this->Q->query(
                    'CREATE TABLE `'.$wpdb->prefix.'recensility_color_fest` (
                    `id` int(11) NOT NULL,
                    `name` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
                    `exadecimal` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
                    `is_active` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
                    `archive` datetime NOT NULL DEFAULT \''.date('Y-m-d').' 00:00:01\', 
                    PRIMARY KEY(`id`) 
                  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;'
                );

                $temp = get_home_path().'/wp-content/themes/recensility/style.css';
                $this->Q->query('INSERT INTO `'.$wpdb->prefix.'recensility_master_options` ('
                         . '`refer`, `name`, `value`) VALUES ('
                         . '\'colorfest\', \'path\', \''.$temp.'\' )'   
                            );

                $this->Q->query(
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

// REMEMBER: THIS PART IT'S FOR DATASHEET
            if ( RMQ_check_table_not_exist('recensility_brand') ) {
                $this->Q->query(
                    'CREATE TABLE `'.$wpdb->prefix.'recensility_brand` (
                        `id` int UNSIGNED NOT NULL,
                        `brand` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
                        `archive` datetime NOT NULL DEFAULT \''.date('Y-m-d').' 00:00:01\', 
                        PRIMARY KEY(`id`)
                      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;'
                );

                $this->Q->query(
                    'INSERT INTO `'.$wpdb->prefix.'recensility_brand` (`id`, `brand`) VALUES
                    (1, "360"),
                    (2, "AAEON"),
                    (3, "Acer"),
                    (4, "Adata"),
                    (5, "AdvanTech"),
                    (6, "Aermoo"),
                    (7, "Agm"),
                    (8, "Alcatel"),
                    (9, "Alienware"),
                    (10, "AllCall"),
                    (11, "Alphacool"),
                    (12, "Amd"),
                    (13, "Amigoo"),
                    (14, "Amoi"),
                    (15, "Antec"),
                    (16, "AOC"),
                    (17, "Apple"),
                    (18, "Arbor"),
                    (19, "Archos"),
                    (20, "ARM Holdings"),
                    (21, "AsRock"),
                    (22, "Astro"),
                    (23, "Asus"),
                    (24, "Athesi"),
                    (25, "Axgio"),
                    (26, "Beltronic"),
                    (27, "BenQ"),
                    (28, "Beyerdynamic"),
                    (29, "Bfg"),
                    (30, "BitFenix"),
                    (31, "Blackberry"),
                    (32, "Blackview"),
                    (33, "Blu"),
                    (34, "Bluboo"),
                    (35, "Bq"),
                    (36, "Broadcom"),
                    (37, "Bsimb"),
                    (38, "Cagabi"),
                    (39, "Cat"),
                    (40, "Caterpillar"),
                    (41, "Chcnav"),
                    (42, "Cherry"),
                    (43, "ChinaMobile"),
                    (44, "Compaq"),
                    (45, "Cong"),
                    (46, "Cooler Master"),
                    (47, "Coolpad"),
                    (48, "Corsair"),
                    (49, "Crucial"),
                    (50, "Cubot"),
                    (51, "Dakele"),
                    (52, "Dell"),
                    (53, "Doogee"),
                    (54, "Doopro"),
                    (55, "E&L"),
                    (56, "Ecom"),
                    (57, "Ecoo"),
                    (58, "Elephone"),
                    (59, "EMachines"),
                    (60, "Energy"),
                    (61, "Enermax"),
                    (62, "Essential"),
                    (63, "Estar"),
                    (64, "EStone Technology"),
                    (65, "eVGA"),
                    (66, "Faea"),
                    (67, "Fairphone"),
                    (68, "Foxconn"),
                    (69, "Fractal"),
                    (70, "Fujitsu"),
                    (71, "Gainward"),
                    (72, "Galax"),
                    (73, "GeCube"),
                    (74, "Geil"),
                    (75, "Geotel"),
                    (76, "Gigabyte"),
                    (77, "Gigaset"),
                    (78, "Gionee"),
                    (79, "Gome"),
                    (80, "Google"),
                    (81, "Goophone"),
                    (82, "Gretel"),
                    (83, "G.Skill"),
                    (84, "Hafury"),
                    (85, "Haier"),
                    (86, "Hannspree"),
                    (87, "HengStar"),
                    (88, "HGST"),
                    (89, "Hike"),
                    (90, "HiSense"),
                    (91, "HiSilicon"),
                    (92, "HomTom"),
                    (93, "Honor"),
                    (94, "HP"),
                    (95, "HTC"),
                    (96, "Huawei"),
                    (97, "HyperX"),
                    (98, "Icop"),
                    (99, "IKall"),
                    (100, "iLa"),
                    (101, "iMan"),
                    (102, "iNew"),
                    (103, "Infinix"),
                    (104, "InFocus"),
                    (105, "InnJoo"),
                    (106, "Inno3d"),
                    (107, "Innos"),
                    (108, "Intel"),
                    (109, "Intermec"),
                    (110, "Intex"),
                    (111, "Itel"),
                    (112, "Iuni"),
                    (113, "IVooMi"),
                    (114, "Jesy"),
                    (115, "Jetway"),
                    (116, "Jiake"),
                    (117, "Jiayu"),
                    (118, "Karbonn"),
                    (119, "Kazam"),
                    (120, "Keecoo"),
                    (121, "Kenxinda"),
                    (122, "KingSing"),
                    (123, "Kingston"),
                    (124, "KingZone"),
                    (125, "Kodak"),
                    (126, "Kolina"),
                    (127, "Koolnee"),
                    (128, "Landvo"),
                    (129, "Laude"),
                    (130, "Lava"),
                    (131, "Leagoo"),
                    (132, "LeEco"),
                    (133, "Lenovo"),
                    (134, "Leotec"),
                    (135, "LeRee"),
                    (136, "LG"),
                    (137, "Lian-Li"),
                    (138, "Logitech"),
                    (139, "Ly"),
                    (140, "Lyf"),
                    (141, "M-Horse"),
                    (142, "M-Net"),
                    (143, "Mann"),
                    (144, "Maze"),
                    (145, "MediaTek"),
                    (146, "Meiigoo"),
                    (147, "Meitu"),
                    (148, "Meizu"),
                    (149, "Micromax"),
                    (150, "Micronet"),
                    (151, "Microsoft"),
                    (152, "Micro-star International"),
                    (153, "Mijue"),
                    (154, "Milai"),
                    (155, "Mlais"),
                    (156, "Morefine"),
                    (157, "Motorola"),
                    (158, "Mpie"),
                    (159, "Msi"),
                    (160, "Mstar"),
                    (161, "Mushkin"),
                    (162, "Multilaser"),
                    (163, "MyWigo"),
                    (164, "Neken"),
                    (165, "Netgear"),
                    (166, "Neo"),
                    (167, "Newman"),
                    (168, "NO.1"),
                    (169, "Nokia"),
                    (170, "Nomu"),
                    (171, "Nubia"),
                    (172, "Nvidia"),
                    (173, "NXP"),
                    (174, "NZXT"),
                    (175, "Ocz"),
                    (176, "Olidata"),
                    (177, "Olivetti"),
                    (178, "Omen"),
                    (179, "OnePlus"),
                    (180, "Oppo"),
                    (181, "Otium"),
                    (182, "Oukitel"),
                    (183, "Packard Bell"),
                    (184, "Palit"),
                    (185, "Palm"),
                    (186, "Panasonic"),
                    (187, "Pantech"),
                    (188, "Pepperl+Fuchs"),
                    (189, "Phicomm"),
                    (190, "Philips"),
                    (191, "Phonemax"),
                    (192, "Plunk"),
                    (193, "Pny"),
                    (194, "Pomp"),
                    (195, "Poptel"),
                    (196, "Powercolor"),
                    (197, "PPTV"),
                    (198, "Prestigio"),
                    (199, "Qiku"),
                    (200, "Qualcomm"),
                    (201, "Quantum"),
                    (202, "Ramos"),
                    (203, "Razer"),
                    (204, "Realme"),
                    (205, "RedMi"),
                    (206, "Roccat"),
                    (207, "Roda"),
                    (208, "Ruggon"),
                    (209, "Runbo"),
                    (210, "Samsung"),
                    (211, "Sandisk"),
                    (212, "Sapphire"),
                    (213, "Seagate"),
                    (214, "Sennheiser"),
                    (215, "Sharp"),
                    (216, "SilentCircle"),
                    (217, "SilverStone"),
                    (218, "Siswoo"),
                    (219, "Sitecom"),
                    (220, "Smartisan"),
                    (221, "Snopow"),
                    (222, "Sony"),
                    (223, "SonyEricsson"),
                    (224, "South"),
                    (225, "Sparkle"),
                    (226, "Star"),
                    (227, "SteelSeries"),
                    (228, "Swipe"),
                    (229, "TCL"),
                    (230, "Teguar"),
                    (231, "Tengda"),
                    (232, "Thermaltake"),
                    (233, "THL"),
                    (234, "Tianhe"),
                    (235, "Timmy"),
                    (236, "Toshiba"),
                    (237, "TP-Link"),
                    (238, "TSMC"),
                    (239, "TurtlenBeach"),
                    (240, "Ubro"),
                    (241, "Uhans"),
                    (242, "Uhappy"),
                    (243, "Uimi"),
                    (244, "Ukozi"),
                    (245, "Ulefone"),
                    (246, "Umi"),
                    (247, "UMiDIGI"),
                    (248, "Vargo"),
                    (249, "Vernee"),
                    (250, "ViewSonic"),
                    (251, "Vivo"),
                    (252, "VKworld"),
                    (253, "V-Moda"),
                    (254, "Voto"),
                    (255, "VPhone"),
                    (256, "Welotec"),
                    (257, "Weimei"),
                    (258, "Western Digital"),
                    (259, "Wico"),
                    (260, "WinMate"),
                    (261, "Wiko"),
                    (262, "WileyFox"),
                    (263, "Wolder"),
                    (264, "Woxter"),
                    (265, "XFX"),
                    (266, "Xiaomi"),
                    (267, "Xolo"),
                    (268, "Yotaphone"),
                    (269, "YU"),
                    (270, "Zebra"),
                    (271, "Zoji"),
                    (272, "Zotac"),
                    (273, "Zopo"),
                    (274, "Zowie"),
                    (275, "Zte"),
                    (276, "Zuk");'
                );
            }

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
