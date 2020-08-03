<?php
/** 
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */

define('EXTERNAL_VENDOR', 0);
define('BUILT_IN_VENDOR', 1);

final class ChartsManager {
    private $Q;
    private $vendor = 0;    
    
    
    public function __construct(){
        global $wpdb;
        $this->Q = $wpdb;
        $this->init();
    }
    
    public function init(){
        $this->vendor = RMQ_get_engine_charts($this->Q);
    }
    
    /*public function setVendor(){
        
    }*/
    
    /*
     * Required settings for charts library
     */
    public function initiateChartsLibrary(){
        if ( $this->vendor ){
            wp_enqueue_script( 'canvasjs', plugins_url( '/recensility-master/js/chartsjs/node_modules/chart.js/dist/Chart.min.js' ) ); 
            wp_enqueue_script( 'canvasjs', plugins_url( '/recensility-master/js/chartsjs/node_modules/chart.js/dist/Chart.bundle.min.js' ) ); 
        } else {
            wp_enqueue_script( 'loader', 'https://www.gstatic.com/charts/loader.js', false );
        }
        // If vendor == 0 (equally claim Google API), 
    }
    
    /*
     * Reserved for categories
     */
    public function drawCategoriesChart($categories, $lentgh){
        $j = 0;
        if ( $this->vendor ){
        ?>
            <!-- Chartsjs -->
            
        <?php
        } else {
        ?>
            <!-- Google -->
          <script type="text/javascript">

            // Load the Visualization API and the corechart package.
            google.charts.load('current', {packages:['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Categorie');
                data.addColumn('number', 'Peso in percentuale');
                data.addRows([
                    <?php 
                    foreach ($categories as $cat) {
                        echo '[\''.json_decode($cat['name']).'\', '.$cat['counted'].']';
                        if ( $j < $lentgh-1 ){
                            echo ', ';
                            $j = $j+1;
                        } 
                    }?>
                            ]);
              
              var options = {
                  title: 'Distribuzione degli articoli relativa alle categorie',
                  is3D: false,
                  pieHole: 0.5,
              };
              
              var chart = new google.visualization.PieChart(document.getElementById('categoriesChart'));
              chart.draw(data, options);
            }

          </script>
          <div id="categoriesChart" style="width: 1200px; height: 1000px;"></div>
        <?php
        }
    }
}
