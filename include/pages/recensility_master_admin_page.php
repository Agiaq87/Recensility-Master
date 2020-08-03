<?php
/**
 * Admin Page
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */
/* 
 * Main Page
 */
require plugin_dir_path( dirname( __FILE__ ) ) . 'utils/recensility_master_utils.php';
require plugin_dir_path( dirname( __FILE__ ) ) . 'utils/recensility_master_modal.php';
require plugin_dir_path( dirname( __FILE__ ) ) . 'utils/recensility_master_headers.php';
require plugin_dir_path( dirname( __FILE__ ) ) . 'class/Articles.php';
require plugin_dir_path( dirname( __FILE__ ) ) . 'class/Datasheets.php';
require plugin_dir_path( dirname( __FILE__ ) ) . 'class/TopTens.php';
require plugin_dir_path( dirname( __FILE__ ) ) . 'class/ColorsFest.php';
require plugin_dir_path( dirname( __FILE__ ) ) . 'class/FastLinks.php';
require plugin_dir_path( dirname( __FILE__ ) ) . 'class/ChartsManager.php';

    global $wpdb;
    $A = new Articles();
    $D = new Datasheets();
    $T = new TopTens();
    $C = new ColorsFest();
    $F = new FastLinks();
    $CHARTS = new ChartsManager();
           
    $users = $wpdb->get_results('SELECT * FROM `'.$wpdb->prefix.'users`');
    $num_of_user = count($users) - $A->getNumOfAuthors();
    
?>
<div class="wrap">
    <?php recensilitySystemHeader('Report del '. today() .' ', $CHARTS) ?>
    <section>
        <div class="RM-tab-content">
            <div id="tabGeneric" class="RM-tab-panel active">
            <?php    
            require plugin_dir_path( __FILE__) . 'templates/recensility_master_generic.php';
            ?>
            </div>

            <div id="tabArticle" class="RM-tab-panel">
            <?php    
            require plugin_dir_path( __FILE__) . 'templates/recensility_master_articles.php';
            ?>
            </div>
            
            <div id="tabDatasheet" class="RM-tab-panel">
            <?php    
            //require plugin_dir_path( __FILE__) . 'templates/recensility_master_generic.php';
            ?>
            </div>
            
            <div id="tabWidget" class="RM-tab-panel">
                <div class="recensility-system-body-container">
                    <div class="recensility-system-body-grid">
            <?php    
            require plugin_dir_path( __FILE__) . 'templates/recensility_master_widget.php';
            ?>
                    </div>
                </div>
            </div>
            
            <div id="tabPlugin" class="RM-tab-panel">
                <div class="recensility-system-body-container">
                    <div class="recensility-system-body-grid">
            <?php    
            require plugin_dir_path( __FILE__) . 'templates/recensility_master_plugin.php';
            ?>
                    </div>
                </div>
            </div>
            
        </div>
    </section>  
</div>