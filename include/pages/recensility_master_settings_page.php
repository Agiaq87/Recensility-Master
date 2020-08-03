<?php

/**
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'utils/recensility_master_dataset.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'utils/recensility_master_headers.php';
require_once plugin_dir_path( dirname( __FILE__ ) ) . 'utils/recensility_master_utils.php';
global $wpdb;

if ( isset( $_POST['submit'] ) ){
    
    print_r($_POST);
    if ( isset($_POST['number_of_post']) ){
        RMQ_update_articles_lentgh($wpdb, $_POST['number_of_post']);
    }
    
    if ( isset($_POST['delta_days']) ){
        RMQ_update_articles_delta_day($wpdb, $_POST['delta_days']);
    }
    
    if ( isset($_POST['diagram_engine']) ){
        RMQ_update_diagram_engine($wpdb, $_POST['diagram_engine']);
    }
    var_dump($_POST);
}

    wp_verify_nonce('recensility-master-setting', 'recensility-master-field');
    $num_of_posts = RMQ_get_articles_lentgh($wpdb);
    $delta_days = RMQ_get_articles_delta_day($wpdb);
    
        ?>
<div class="wrap">
    <?php recensilitySystemHeader('Impostazioni', null) ?>
    <section>
        <div class="recensility-system-body-container">
            <h2>Impostazioni</h2>
            <?php 
            
            ?>
            <div class="recensility-system-body-grid">
                <form method="post">
                    <?php wp_nonce_field('recensility-master-setting', 'recensility-master-field'); ?>
                    <div class="recensility-system-body-grid-item">
                        <span class="recensility-system-body-grid-container-title">Articoli</span>
                        
                        <div class="recensility-system-body-grid-container">
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings">Numero di articoli da visualizzare:</div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="number" name="number_of_post" class="recensility-system-body-input" min="10" value="<?php echo $num_of_posts ?>"/>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>

                        
                       
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings">Distanza in giorni tra gli articoli:</div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="number" name="delta_days" class="recensility-system-body-input" min="1" max="30" value="<?php echo $delta_days ?>"/>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings">Salvare le nuove impostazioni?</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="submit" name="submit" value="Salva" class="recensility-system-body-submit">
                            </div>
                       
                        
                        </div>
                    </div>
                </form>
                
                <form method="post">
                    <?php wp_nonce_field('recensility-master-setting', 'recensility-master-field'); ?>
                    <div class="recensility-system-body-grid-item">
                        <span class="recensility-system-body-grid-container-title">Diagrammi</span>
                        
                        <div class="recensility-system-body-grid-container">
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings tooltip">
                                Motore dei diagrammi
                                <span class="tooltiptext"><?php echo toolTipEngineExplain(); ?></span>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <select id="cars" name="diagram_engine" class="recensility-system-body-select tooltip">
                                    <option value="0">Google (esterno)</option>
                                    <option value="1">Chartsjs (interno)</option>
                                  </select>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>

                        
                       
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings">Distanza in giorni tra gli articoli:</div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="number" name="delta_days" class="recensility-system-body-input" min="1" max="30" value="<?php echo $delta_days ?>"/>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings">Salvare le nuove impostazioni?</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="submit" name="submit" value="Salva" class="recensility-system-body-submit">
                            </div>
                       
                        
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>


