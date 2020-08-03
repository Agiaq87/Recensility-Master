<?php
/**
 *
 * @author Alesandro "Mr.Pixel" Giaquinto 
 * @package Recensility Master
 */
require plugin_dir_path( dirname( __FILE__ ) ) . 'lib/simple_html_dom/simple_html_dom.php';

$H = file_get_html('https://www.gsmarena.com/apple_iphone_11_pro-9847.php');

//print_r($H);
echo '<br>foreach<br><br>';
foreach ($H->find('td') as $e){
    echo $e;
}

$H2 = file_get_html('https://andreagaleazzi.com/schede-tecniche/apple-iphone-11-pro/');

//print_r($H);
echo '<br>foreach<br><br>';
$arr = array();
foreach ($H2->find('li.dt-left') as $e){
    //echo $e;
    array_push($arr, "$e");
}
$val = array();
foreach ($H2->find('li.dt-right') as $e){
    //echo $e;
    array_push($val, "$e");
}

$i = count($arr);
$j = count($val);

//print_r($arr);

$def = array();

$t = 0;
while($t <= ($i-1)){
    array_push($def, [ $arr[$t] => $val[$t] ] );
    $t = $t+1;
}
echo '<h1>Final</h1><br>';
foreach ($def as $value) {
    print_r($value);
    echo '<br>';
}

//print_r($def);
/*
$def = array();
if($i == $j){
    array_push();
} */