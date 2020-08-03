<?php
/**
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */
?>

        <div class="recensility-system-body-container">
            <div class="recensility-system-body-grid">
                <div class="recensility-system-body-grid-item reserved-article">
                    <span class="recensility-system-body-grid-container-title tooltip"><span class="tooltiptext">Puoi modificare il numero di articoli visibili in questa tabella nelle impostazioni</span>Articoli</span>
                           
                            <div class="recensility-system-body-table-container">
                                <table id="customers">
                                    <tr>
                                      <th>#</th>
                                      <th><strong class="tooltip">Titolo<span class="tooltiptext">In questa colonna sono mostrati tutti gli articoli pubblicati</span></strong></th>
                                      <th><strong class="tooltip">Data<span class="tooltiptext">Data di pubblicazione dell'articolo</span></strong></th>
                                      <th><strong class="tooltip">Autore<span class="tooltiptext">L'autore dell'articolo</span></strong></th>
                                      <th><strong class="tooltip">Distanza<span class="tooltiptext">In questa colonna vengono indicati quanti giorni sono passati dall'articolo precedente (ovvero l'articolo della riga sottostante)</span></strong></th>
                                      <th><?php echo toolTipTextIconExplain('In questo caso viene valutata la distanza, in giorni, dell\'articolo rispetto al precedente') ?></th>
                                      <th><strong class="tooltip">Link<span class="tooltiptext">Link per andare al relativo articolo (aperto in una nuova scheda)</span></strong></th>
                                    </tr>
                                    
                                    <?php
                                    $index = 0;
                                    while( $index <= $A->getCurrentLengthPosts() - 1 ){
                                        echo '
                                            <tr>
                                            <td><b><center>'. ($index + 1) .'</center></b></td>
                                            <td>'.titleTransform($A->getPostsTitle($index)).'</td>
                                            <td>'.dateTransform(substr($A->getPostsDate($index), 5, 6)).'</td>
                                            <td><strong>'.transformName( $A->searchAuthorById( $A->getPostsAuthor($index) ) ).'</strong></td>
                                            <td><center>';
                                                if ( $index == $A->getCurrentLengthPosts() - 1  ){
                                                    echo '-';
                                                } else {
                                                    echo evalDifferenceDays( $A->getDays($index), $A->getDeltaDay(), $A->getPostsTitle($index + 1) );
                                                }
                                            echo '</center></td> 
                                            <td><center>'. iconEvaluation($A->getDays($index), $A->getDeltaDay()) .'</center></td>
                                            <td>
                                            <center>
                                                <a class="tooltip" href="'.$A->getPostsGuid($index).'" target="blank">
                                                    <span class="tooltiptext">Vai all\'articolo</span>
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            </center>
                                            </td>
                                            </tr>';
                                            $index = $index + 1;
                                    }
                                    ?>
                                </table>           
                            </div>
                    </div>
            
           
                    <div class="recensility-system-body-grid-item">
                        <span class="recensility-system-body-grid-container-title tooltip"><span class="tooltiptext">
                                I risultati generali vengono mostrati in questa tabella<br>
                                Nota bene: Il calcolo eseguito dal sistema di ranking è strettamente influenzato dalla distanza tra articoli impostata dall'utente.
                                Il sistema di ranking moltiplicherà la distanza di pubblicazione tra articoli per 100 e dividerà il tutto per il valore della media considerata<br>
                                <br>Per esempio: <br>
                                se l'utente ha impostato "2" come distanza di pubblicazione e la sua media aritmetica è "2.43", 
                                il sistema di ranking moltiplica la distanza di pubblicazione per 100 <br>
                                <center>2 * 100</center><br>
                                quindi divide il tutto per la media aritmetica <br>
                                <center> 200 / 2.43 = 82,30</center><br>
                                e determina questo valore come positivo (vicino al 90%).<br>
                                Se l'utente ha impostato "4" come distanza di pubblicazione e la sua media aritmetica è "2.43", 
                                il sistema di ranking moltiplica la distanza di pubblicazione per 100 <br>
                                <center>4 * 100</center><br>
                                quindi divide il tutto per la media aritmetica <br>
                                <center> 400 / 2.43 = 164,60</center><br>
                                e determina questo valore come eccellente (superiore al 90%).<br>
                                Se l'utente imposta "1" come distanza di pubblicazione e la sua media aritmetica è "2.43", 
                                il sistema di ranking divide "100" per la media aritmetica <br>
                                <center> 100 / 2.43 = 41,15</center><br>
                                e determina questo valore come mediocre (inferiore al 50%).<br>
                            </span>Generali</span>
                        <div class="recensility-system-body-grid-container">
                            
                            <div class="recensility-system-body-grid-container-rows-item">Pubblicati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $A->getNumOfPublishedPosts() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">articoli</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/edit.php?post_status=publish&post_type=post" target="blank">
                                    <span class="tooltiptext">Vedi gli articoli pubblicati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Bozze:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $A->getNumOfDraftPosts() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in attesa</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/edit.php?post_status=draft&post_type=post" target="blank">
                                    <span class="tooltiptext">Vedi le bozze</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Data ultimo articolo:</div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo dateTransform(substr($A->getLastestPostDate(), 5, 6))?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <center>
                                    <?php echo evalDifferenceDays($A->dateDifference('now', $A->getLastestPostDate()), $A->getDeltaDay(), $A->getLastestPostTitle()); ?>
                                </center>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">giorni fa</div>
                            <div class="recensility-system-body-grid-container-rows-item">Ranking:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <center> 
                                <?php echo iconEvaluation($A->getDaysLastestPost(), $A->getDeltaDay()) ?>
                                </center>
                            </div>
                                                        
                            <div class="recensility-system-body-grid-container-rows-item">Medie sulla distanza</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">Aritmetica:</div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <center>
                                <?php 
                                
                                echo arithmeticWeight($A->getArithmeticAverage(), $A->getDeltaDay()) 
                                        ?> 
                                </center>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">giorni</div>
                            <div class="recensility-system-body-grid-container-rows-item">Ranking:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <center> 
                                <?php echo iconEvaluation($A->getArithmeticAverage(), $A->getDeltaDay()) ?>
                                </center>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">Geometrica:</div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <strong>
                                    <center> 
                                        <?php echo geometicWeight($A->getGeometricAverage(), $A->getDeltaDay()) ?> 
                                    </center>
                                </strong>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">giorni</div>
                            <div class="recensility-system-body-grid-container-rows-item">Ranking:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <center> 
                                <?php echo iconEvaluation($A->getGeometricAverage(), $A->getDeltaDay()) ?>
                                </center>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">Mediana:</div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <center> 
                                    <?php echo median( $A->getMedian(), $A->getDeltaDay() ) ?> 
                                </center>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">giorni</div>
                            <div class="recensility-system-body-grid-container-rows-item">Ranking:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <center> 
                                    <?php echo iconEvaluation( $A->getMedian(), $A->getDeltaDay() ) ?>
                                </center>
                            </div>
                                                        
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong style="color: #0ec40e">Caso migliore:</strong></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <center> 
                                    <strong class="tooltip" style="color: #0ec40e">
                                        <?php echo $A->getBestDay() ?> 
                                        <span class="tooltiptext">Qui viene indicato il miglior valore trovato tra le distanze (in giorni) calcolate</span>
                                    </strong>
                                </center>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">giorni</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong style="color: #8e0c04">Caso peggiore:</strong></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <center> 
                                    <strong class="tooltip" style="color: #8e0c04">
                                        <?php echo $A->getWorstDay() ?> 
                                        <span class="tooltiptext">Qui viene indicato il peggior valore trovato tra le distanze (in giorni) calcolate</span>
                                    </strong>
                                </center>
                            </div>
                            <div class="recensility-system-body-grid-container-rows-item">giorni</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>                       
                            
                            <div class="recensility-system-body-grid-container-rows-item">Autori:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $A->getNumOfAuthors() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <?php 

                                foreach ($A->getAuthorPosts(-1) as $Author) {
                                    echo '
                                        <div class="recensility-system-body-grid-container-rows-item"></div>
                                        <div class="recensility-system-body-grid-container-rows-item"><strong>'.transformName($Author['displayed_name']).'</strong></div>
                                        <div class="recensility-system-body-grid-container-rows-item"><strong><center>'.$Author['counted'].'<center></strong></div>
                                        <div class="recensility-system-body-grid-container-rows-item">articoli</div>
                                        <div class="recensility-system-body-grid-container-rows-item">('.strWeight($Author['weight']).')</div>
                                        <div class="recensility-system-body-grid-container-rows-item"></div>
                                        <div class="recensility-system-body-grid-container-rows-item"></div>';
                                }
                            ?>
                                                       
                            <div class="recensility-system-body-grid-container-rows-item">Utenti registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $num_of_user ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Colori registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $C->getLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Fast Link registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $F->getLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Top ten registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $T->getNumOfTopten() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Top ten preferiti registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $T->getNumOfTopTenPrefered() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Top ten qualità prezzo registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $T->getNumOfTopTenQualityPrice() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Brand registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getBrandsLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Smartphone registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getSmartphonesLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Fitband registrate:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getFitbandsLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>

                            <div class="recensility-system-body-grid-container-rows-item">SOC registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getSocsLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">CPU registrate:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getCpusLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">GPU registrate:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getGpusLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">RAM registrate:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getRamsLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Mobile GPU registrate:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getMgpusLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Connettori registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getPortsLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Slot espansioni registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getExpansionsLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Display registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getDisplaysLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Classi Wi-Fi registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getWifisLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Classi Bluetooth:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getBluetoothsLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Parti registrate:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getPartsLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Protezioni registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getProtectionsLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Sblocchi registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getUnlocksLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Tipi di Sim:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getSimsLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">OS registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getOsesLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Mobile Os registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getMosesLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                            
                            <div class="recensility-system-body-grid-container-rows-item">Mobile GUI registrati:</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center><?php echo $D->getMosesguiLength() ?></center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">
                                <a class="tooltip" href="https://recensility.it/wp-admin/users.php" target="blank">
                                    <span class="tooltiptext">Vedi tutti gli utenti registrati</span>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                                                                                    
                        </div>
                    </div>
           
                <div class="recensility-system-body-grid-item">
                        <span class="recensility-system-body-grid-container-title tooltip"><span class="tooltiptext">Tutte le categorie registrate fino ad ora</span>Categorie</span>
                        <div class="recensility-system-body-grid-container">
                            <div class="recensility-system-body-grid-container-rows-item"><strong>Categorie:</strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"><strong><center> <?php echo $A->getNumOfCategories() ?> </center></strong></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item">in totale</div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>
                            <div class="recensility-system-body-grid-container-rows-item"></div>

                            <?php
                                foreach ($A->getCategoriesAvg(-1) as $Category) {
                                    echo '
                                        <div class="recensility-system-body-grid-container-rows-item"></div>
                                        <div class="recensility-system-body-grid-container-rows-item"><strong>'.$Category['name'].'</strong></div>
                                        <div class="recensility-system-body-grid-container-rows-item">contiene</div>
                                        <div class="recensility-system-body-grid-container-rows-item"><strong><center>'.$Category['counted'].'</center></strong></div>
                                        <div class="recensility-system-body-grid-container-rows-item">articoli ('. strWeight( $Category['weight'] ).')</div>
                                        <div class="recensility-system-body-grid-container-rows-item"></div>
                                        <div class="recensility-system-body-grid-container-rows-item"></div>';
                                }        
                            ?>
                                                     
                        </div>
                </div>
                
            </div>

        </div>
        <?php 
        RM_modal_head('mdDatasheet','Inserisci una nuovo smartphone'); 
        ?>
        <h4>Prima di procedere, immetti i seguenti dati:</h4>
        <?php
        RM_modal_foot('');



