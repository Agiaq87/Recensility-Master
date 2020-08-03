<?php
if ( isset( $_POST['recensility-master-field'] ) ){
    
    print_r($_POST);
    if ( isset($_POST['recensility_news_reader_id']) ){
        $T->update(
                $_POST['recensility_news_reader_index'],
                $_POST['recensility_news_reader_id'],
                $_POST['recensility_news_reader_name'],
                $_POST['recensility_news_reader_icon'],
                $_POST['recensility_news_reader_url']
                );
        //RMQ_update_articles_lentgh($wpdb, $_POST['number_of_post']);
    }

}

if ( isset($_POST['delete']) ){
   print_r($_POST);
   if ( isset($_POST['recensility_news_reader_id']) ){
       $T->delete($_POST['recensility_news_reader_index'], $_POST['recensility_news_reader_id']);
       var_dump($T->getFastLinks(ALL));
   }
}

    wp_verify_nonce('recensility-master-news_reader', 'recensility-master-field');
?>
<div class="recensility-system-body-grid-item reserved-article">
            <span class="recensility-system-body-grid-container-title">
                <span class="tooltip">
                <span class="tooltiptext">
                    I Fast Link vengono visualizzati nell'apposito widget
                </span>
                Fast Link
                &nbsp
                </span>
                <div class="recensility-modal-into-title">
                <?php 
                RM_a_i_modal(
                    'top_ten_insert',
                    'color: white',
                    'fas fa-plus-circle',
                    '',
                    'Inserisci un nuovo Fast Link'
                    );
                RM_modal_head(
                    'top_ten_insert',
                    'Inserisci un nuovo Fast Link' 
                    );
                ?>
                    <div class="recensility-form-correct">
                <form method="post">
                    <?php wp_nonce_field('recensility-master-setting', 'recensility-master-field'); ?>                        
                        <div class="recensility-system-form-grid-container">
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings tooltip">
                                Nome Fast Link:
                                <span class="tooltiptext">
                                    Inserisci qui il nome del nuovo Fast Link
                                </span>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input
                                    type="text"
                                    id="recensility_news_reader_name"
                                    name="recensility_news_reader_name"
                                    value="Nome Fast Link"
                                >
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                                                    
                       
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings tooltip">
                                Icona:
                                <span class="tooltiptext">
                                    È sufficiente inserire solo la classe dell'icona considerata.<br>
                                    Sono accettate solo icone Font Awesome.<br>
                                    Ad esempio:<br>
                                    Se si vuole caricare l'icona <i class="fab fa-amazon"></i>, è sufficiente inserire solo la classe senza i doppi apici:<br>
                                    <center>fab fa-amazon</center>
                                </span>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input
                                    type="text"
                                    id="recensility_news_reader_icon"
                                    name="recensility_news_reader_icon"
                                    value="Classe icona Fast Link"
                                >
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings tooltip">
                                Url:
                                <span class="tooltiptext">
                                    Inserire il link completo del Fast Link.<br>
                                    Ad esempio:<br>
                                    <center>https://recensility.it/recensility-consiglia</center>
                                </span>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input
                                    type="text"
                                    id="recensility_news_reader_url"
                                    name="recensility_news_reader_url"
                                    value="URL Fast Link"
                                >
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings">Aggiungere il nuovo Fast Link?</div>
                                
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="submit" name="insert_top_ten" value="Aggiungi" class="recensility-system-body-submit">
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                        </div>
                </form> 
                    </div>
                <?php
                RM_modal_foot('');
                ?>
                </div>
            </span>
                     <div class="recensility-system-body-table-container">
                        <table id="customers">
                            <tr>
                                <th>#</th>
                                <th><strong class="tooltip">Nome<span class="tooltiptext">In questa colonna sono mostrati i nomi dei fast link creati</span></strong></th>
                                <th><strong class="tooltip">Icona<span class="tooltiptext">L'icona associata al fast link</span></strong></th>
                                <th><strong class="tooltip">Data<span class="tooltiptext">Data di creazione</span></strong></th>
                                <th><strong class="tooltip">URL<span class="tooltiptext">URL dove punta il fast link</span></strong></th>
                                <th><strong class="tooltip">Azioni<span class="tooltiptext">Puoi modificare o eliminare il fast link</span></strong></th>
                            </tr>
                                    
                            <?php
                            $index = 0;
                                    
                            while( $index < $T->getLength() ){
                                echo '
                                    <tr>
                                        <td><b><center>'. ($index + 1) .'</center></b></td>
                                        <td><strong><center>'.$T->getLinkName($index).'</center></strong></td>
                                        <td><center><i class="'.$T->getIconClass($index).'"></i></center></td>
                                        <td>'.dateTransform( substr($T->getDate($index), 5, 6) ).'</td>
                                        <td>'.titleTransform($T->getURL($index), 35).'</td> 
                                        <td>
                                            <center>
                                                <a ';
                                                RM_a_i_modal(
                                                        'modal_'.$index,
                                                        'color: #2f6d43',
                                                        'fas fa-edit',
                                                        '',
                                                        'Modifica questo Fast Link'
                                                        );
                                                RM_modal_head(
                                                        'modal_'.$index,
                                                        'Modifica il seguente Fast Link' 
                                                        );
                                                ?>
                <form method="post">
                    <?php wp_nonce_field('recensility-master-setting', 'recensility-master-field'); ?>                        
                        <div class="recensility-system-form-grid-container">
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings tooltip">
                                Nome Fast Link:
                                <span class="tooltiptext">
                                    Inserisci qui il nome del Fast Link
                                </span>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input
                                    type="text"
                                    id="recensility_news_reader_name"
                                    name="recensility_news_reader_name"
                                    value="<?php echo $T->getLinkName($index) ?>"
                                >
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                                                    
                       
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings tooltip">
                                Icona:
                                <span class="tooltiptext">
                                    È sufficiente inserire solo la classe dell'icona considerata.<br>
                                    Sono accettate solo icone Font Awesome.<br>
                                    Ad esempio:<br>
                                    Se si vuole caricare l'icona <i class="fab fa-amazon"></i>, è sufficiente inserire solo la classe senza i doppi apici:<br>
                                    <center>fab fa-amazon</center>
                                </span>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input
                                    type="text"
                                    id="recensility_news_reader_icon"
                                    name="recensility_news_reader_icon"
                                    value="<?php echo $T->getIconClass($index) ?>"
                                >
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings tooltip">
                                Url:
                                <span class="tooltiptext">
                                    Inserire il link completo del Fast Link.<br>
                                    Ad esempio:<br>
                                    <center>https://recensility.it/recensility-consiglia</center>
                                </span>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input
                                    type="text"
                                    id="recensility_news_reader_url"
                                    name="recensility_news_reader_url"
                                    value="<?php echo $T->getURL($index) ?>"
                                >
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings">Salvare le nuove impostazioni?</div>
                                <input 
                                    type="hidden" 
                                    value="<?php echo $T->getID($index); ?>"
                                    id="recensility_news_reader_id"
                                    name="recensility_news_reader_id">
                                <input 
                                    type="hidden" 
                                    value="<?php echo $index; ?>"
                                    id="recensility_news_reader_index"
                                    name="recensility_news_reader_index">
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="submit" name="submit" value="Salva" class="recensility-system-body-submit">
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                        </div>
                </form>

                                                        
                                                <?php 
                                                RM_modal_foot('');
                                            echo '
                                                <a ';
                                                RM_a_i_modal(
                                                        'modal_del'.$index,
                                                        'color: Red',
                                                        'far fa-trash-alt',
                                                        '',
                                                        'Elimina questo Fast Link'
                                                        );
                                                RM_modal_head(
                                                        'modal_del'.$index,
                                                        'Elimina il seguente Fast Link',
                                                        true
                                                        );
                                                ?>
                <form method="post">
                    <?php wp_nonce_field('recensility-master-setting', 'recensility-master-field'); ?>                        
                        <div class="recensility-system-form-grid-container">
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings">
                                Desideri eliminare il Fast Link "<strong><?php echo $T->getLinkName($index) ?></strong>"?
                                <input 
                                    type="hidden" 
                                    value="<?php echo $T->getID($index); ?>"
                                    id="recensility_news_reader_id"
                                    name="recensility_news_reader_id">
                                <input 
                                    type="hidden" 
                                    value="<?php echo $index; ?>"
                                    id="recensility_news_reader_index"
                                    name="recensility_news_reader_index">
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="submit" name="delete" value="Elimina" class="recensility-system-body-delete">
                            </div>
                             
                        </div>
                </form>

                                                        
                                                <?php 
                                                RM_modal_foot('');
                                            echo '
                                                </center>
                                            </td>
                                            </tr>';
                                            $index = $index + 1;
                            }
                            ?>
                        </table>           
                    </div>
        </div>

