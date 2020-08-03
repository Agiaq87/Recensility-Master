<?php

if ( isset( $_POST['recensility-master-field'] ) ){
    if ( isset($_POST['insert_color']) ){
        $C->insert($_POST['recensility_colorfest_name'], $_POST['recensility_colorfest_icon']);
    }else if ( isset( $_POST['delete_color'] ) ){
        $C->delete($_POST['recensility_colorfest_index'], $_POST['recensility_colorfest_id']);
    }else if ( isset( $_POST['change_color'] ) ){
        $C->setActive($_POST['recensility_colorfest_id'], $_POST['recensility_colorfest_index']);
    }
}
    wp_verify_nonce('recensility-master-colorfest', 'recensility-master-field');
?>
<div class="recensility-system-body-grid-item reserved-article">
            <span class="recensility-system-body-grid-container-title">
                <span class="tooltip">
                <span class="tooltiptext">
                    I colori vengono visualizzati nell'apposito widget<br>
                    Ricorda che queste modifiche funzioneranno solo sul tema Recensility
                </span>
                Color Fest for Recensility Theme
                &nbsp
                </span>
                <div class="recensility-modal-into-title">
                <?php 
                RM_a_i_modal(
                    'color_fest_insert',
                    'color: white',
                    'fas fa-plus-circle',
                    '',
                    'Inserisci un nuovo Colore'
                    );
                RM_modal_head(
                    'color_fest_insert',
                    'Inserisci un nuovo Colore' 
                    );
                ?>
                <div class="recensility-form-correct">
                <form method="post">
                    <?php wp_nonce_field('recensility-master-setting', 'recensility-master-field'); ?>                        
                        <div class="recensility-system-form-grid-container">
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings tooltip">
                                Nome Colore:
                                <span class="tooltiptext">
                                    Inserisci qui il nome del nuovo Colore
                                </span>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input
                                    type="text"
                                    id="recensility_colorfest_name"
                                    name="recensility_colorfest_name"
                                    value="Nome nuovo colore"
                                >
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                                                    
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings tooltip">
                                Esadecimale:
                                <span class="tooltiptext">
                                    Inserisci il colore preceduto da #<br>
                                    Ad esempio:<br>
                                    <center>#2f6d43</center>
                                </span>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input
                                    type="text"
                                    id="recensility_colorfest_icon"
                                    name="recensility_colorfest_icon"
                                    value="Classe icona Colore"
                                >
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>

                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings">Aggiungere il nuovo Colore?</div>   
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="submit" name="insert_color" value="Aggiungi" class="recensility-system-body-submit">
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
                                <th><strong class="tooltip">Nome<span class="tooltiptext">In questa colonna sono mostrati i nomi dei colori inseriti</span></strong></th>
                                <th><strong class="tooltip">Esadecimale<span class="tooltiptext">Valore esadecimale del colore</span></strong></th>
                                <th><strong class="tooltip">Attivo<span class="tooltiptext">Segnala se il colore è attivo nel tema</span></strong></th>
                                <th><strong class="tooltip">Data<span class="tooltiptext">Data di creazione</span></strong></th>
                                <th><strong class="tooltip">Azioni<span class="tooltiptext">Puoi modificare o eliminare il fast link</span></strong></th>
                            </tr>
                                    
                            <?php
                            $index = 0;
                                    
                            while( $index < $C->getLength() ){
                                echo '
                                    <tr>
                                        <td><b><center>'. ($index + 1) .'</center></b></td>
                                        <td><strong><center>'.$C->getColorName($index).'</center></strong></td>
                                        <td><strong class="tooltip dot-container"><span class="dot" style="background:'.$C->getColorExadecimal($index).'"><span class="tooltiptext">Colore:'.$C->getColorExadecimal($index).'</span></span></strong></td>
                                        <td><strong><center>'.$C->getColorActive($index).'</center></strong></td>
                                        <td>'.dateTransform( substr($C->getDate($index), 5, 6) ).'</td>
                                        <td>
                                            <center>
                                                <a ';
                                if ( $C->getColorActive($index) == 'false' ){
                                                RM_a_i_modal(
                                                        'modal_color'.$index,
                                                        'color: #2f6d43',
                                                        'fas fa-adjust',
                                                        '',
                                                        'Attiva questo Colore<br>Viene eseguito uno switch tra il colore attivo <br><center>'.
                                                        $C->getActiveName().':<span class="dot" style="padding:5px; background:'.$C->getActiveExadecimal().'"></span></center>'.
                                                        'e il seguente colore: <br><center>'.$C->getColorName($index).
                                                        ': <span class="dot" style="padding:5px; background:'.$C->getColorExadecimal($index).'"></span></center>'
                                                        );
                                                RM_modal_head(
                                                        'modal_color'.$index,
                                                        'Attivare il colore '.$C->getColorName($index).'?' 
                                                        );
                                                ?>
                <form method="post">
                    <?php wp_nonce_field('recensility-master-setting', 'recensility-master-field'); ?>                        
                        <div class="recensility-system-form-grid-container">
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings tooltip">
                                Desideri impostare il colore <?php echo $C->getColorName($index) ?> come predefinito?
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                                <input 
                                    type="hidden" 
                                    value="<?php echo $C->getID($index); ?>"
                                    id="recensility_colorfest_id"
                                    name="recensility_colorfest_id">
                                <input 
                                    type="hidden" 
                                    value="<?php echo $index; ?>"
                                    id="recensility_colorfest_index"
                                    name="recensility_colorfest_index">
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="submit" name="change_color" value="Cambia" class="recensility-system-body-submit">
                            </div>
                        </div>
                </form>

                                                        
                                                <?php 
                                                RM_modal_foot('');
                                }
                                            echo '
                                                <a ';
                                                RM_a_i_modal(
                                                        'modal_color_del'.$index,
                                                        'color: Red',
                                                        'far fa-trash-alt',
                                                        '',
                                                        'Elimina questo Colore'
                                                        );
                                                RM_modal_head(
                                                        'modal_color_del'.$index,
                                                        'Elimina il seguente Colore',
                                                        true
                                                        );
                                                ?>
                <form method="post">
                    <?php wp_nonce_field('recensility-master-setting', 'recensility-master-field'); ?>                        
                        <div class="recensility-system-form-grid-container">
                            <div class="recensility-system-body-grid-container-rows-item recensility-system-special-settings">
                                Desideri eliminare il Colore "<strong><?php echo $C->getColorName($index) ?></strong>"?
                                <input 
                                    type="hidden" 
                                    value="<?php echo $C->getID($index); ?>"
                                    id="recensility_colorfest_id"
                                    name="recensility_colorfest_id">
                                <input 
                                    type="hidden" 
                                    value="<?php echo $index; ?>"
                                    id="recensility_colorfest_index"
                                    name="recensility_colorfest_index">
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <input type="submit" name="delete_color" value="Elimina" class="recensility-system-body-delete">
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

