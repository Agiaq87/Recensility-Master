<?php


function strWeight($calculated){
    return '<b '. styleColorGradient($calculated).'>'.substr(strval( $calculated ), 0, 4).'%</b>';
}

function styleColorGradient($value){
    //var_dump($value);
    if($value <= 0.50){
        return 'style="color: #8e0c04"';
    } elseif ($value > 0.50 && $value <= 5.00) {
        return 'style="color: #ab0d07"';
    }elseif ($value > 5.00 && $value <= 10.00) {
        return 'style="color: #db080c"';    
    }elseif ($value > 10.00 && $value <= 15.00) {
        return 'style="color: #f02d0f"';    
    }elseif ($value > 15.00 && $value <= 20.00) {
        return 'style="color: #ff3312"';    
    }elseif ($value > 20.00 && $value <= 25.00) {
        return 'style="color: #ff5330"';    
    }elseif ($value > 25.00 && $value <= 30.00) {
        return 'style="color: #ff7627"';    
    }elseif ($value > 30.00 && $value <= 35.00) {
        return 'style="color: #ff8c3d"';    
    }elseif ($value > 35.00 && $value <= 40.00) {
        return 'style="color: #fd9751"';    
    }elseif ($value > 40.00 && $value <= 45.00) {
        return 'style="color: #ffc946"';    
    }elseif ($value > 45.00 && $value <= 50.00) {
        return 'style="color: #ffd15e"';    
    }elseif ($value > 50.00 && $value <= 55.00) {
        return 'style="color: #3fde3f"';    
    }elseif ($value > 55.00 && $value <= 60.00) {
        return 'style="color: #38c037"';    
    }elseif ($value > 60.00 && $value <= 65.00) {
        return 'style="color: #34a42f"';    
    }elseif ($value > 65.00 && $value <= 70.00) {
        return 'style="color: #2d8a26"';    
    }elseif ($value > 70.00 && $value <= 75.00) {
        return 'style="color: #24601c"';    
    }elseif ($value > 75.00 && $value <= 80.00) {
        return 'style="color: #2a6617"';    
    }elseif ($value > 80.00 && $value <= 90.00) {
        return 'style="color: #1b7402"';    
    }elseif ($value > 90.00 && $value <= 100.00) {
        return 'style="color: #0fb542"';    
    }elseif ($value > 100) {
        return 'style="color: #0ec40e"';
    }
}

function dateTransform($last_date){
    //var_dump($last_date);
    $string_month = substr($last_date, 0, 2);
    $month = (int)$string_month;
    $string_day = substr($last_date, 3, 6);
    return '<strong>'.$string_day.' '.monthConverter($month).'</strong>';
}

function monthConverter($integer, ...$full_month){
    $temp = '';
    
    if ($full_month){
        switch($integer){
        case 1: $temp = 'GENNAION'; break;
        case 2: $temp = 'FEBBRAIO'; break;
        case 3: $temp = 'MARZO'; break;
        case 4: $temp = 'APRILE'; break;
        case 5: $temp = 'MAGGIO'; break;
        case 6: $temp = 'GIUGNO'; break;
        case 7: $temp = 'LUGLIO'; break;
        case 8: $temp = 'AGOSTO'; break;
        case 9: $temp = 'SETTEMBRE'; break;
        case 10: $temp = 'OTTOBRE'; break;
        case 11: $temp = 'NOVEMBRE'; break;
        case 12: $temp = 'DICEMBRE'; break;
    }
    }else {
        switch($integer){
        case 1: $temp = 'GEN'; break;
        case 2: $temp = 'FEB'; break;
        case 3: $temp = 'MAR'; break;
        case 4: $temp = 'APR'; break;
        case 5: $temp = 'MAG'; break;
        case 6: $temp = 'GIU'; break;
        case 7: $temp = 'LUG'; break;
        case 8: $temp = 'AGO'; break;
        case 9: $temp = 'SET'; break;
        case 10: $temp = 'OTT'; break;
        case 11: $temp = 'NOV'; break;
        case 12: $temp = 'DIC'; break;
    }
    }
    
    return $temp;
}

function titleTransform($title){
    return '<strong class="tooltip"><span class="tooltiptext">'.$title.'</span>'
            .substr($title, 0, 25).'...</strong>';
}

function searchAuthorById(&$authors, &$id){
    foreach ($authors as $author) {
        if ($author->post_author == $id){
            return '<strong>'.transformName($author->display_name).'</strong>';
        }
    }
}

function transformName($string){
    $temp = explode(' ', $string);
    $temp[0] = substr($temp[0], 0, 1).'. ';
    return implode($temp, " ");            
}

function today(){
    return date('d') .' ' . monthConverter(date('m'), true) . ' ' . date('Y');
}

function dateDifference($date_1, $date_2, $differenceFormat = '%a' ){
   
    $interval = date_diff(date_create($date_1), date_create($date_2));
   
    return $interval->format($differenceFormat);
}

function evalDifferenceDays($diff_days, $delta_days, $article_title){
    return '<b class="tooltip" '. styleColorGradient( ($delta_days/$diff_days)*100 ) .'>' 
            . $diff_days . 
            '<span class="tooltiptext">Sono passati circa ' . $diff_days . 
            ' giorni dalla pubblicazione dell\'articolo ' . $article_title .
            '</span></b>';
}

function iconEvaluation($Delta, $param=7){
    $Delta = ($param/$Delta)*100;
    return '<i class="'. iconWeight( $Delta ) .' tooltip" '. styleColorGradient($Delta).'"><span class="tooltiptext">'. tooltipIconWeight($Delta).'</span></i>';
}

function iconWeight($value){
    if ($value <= 10.00) {
        return 'fas fa-angle-double-down';    
    }elseif ($value > 10.00 && $value <= 25.00) {
        return 'fas fa-angle-down';   
    }elseif ($value > 25.00 && $value <= 40.00) {
        return 'fas fa-angle-double-left';   
    }elseif ($value > 40.00 && $value < 50.00) {
        return 'fas fa-angle-left';    
    }elseif ($value == 50.00) {
        return 'fas fa-bars';   
    }elseif ($value > 50.00 && $value <= 60.00) { 
        return 'fas fa-angle-right';    
    }elseif ($value > 60.00 && $value <= 75.00) { 
        return 'fas fa-angle-double-right';    
    }elseif ($value > 75.00 && $value <= 90.00) {   
        return 'fas fa-angle-up';    
    }elseif ($value > 90.00) {      
        return 'fas fa-angle-double-up';
    }
}

function tooltipIconWeight($value){
    if ($value < 10.00) {
        return 'Valutazione pessima <br> minore del 10% ';    
    }elseif ($value >= 10.00 && $value < 25.00) {
        return 'Valutazione estremamente negativa <br> minore del 25% ';   
    }elseif ($value >= 25.00 && $value < 40.00) {
        return 'Valutazione negativa <br> minore del 40% ';   
    }elseif ($value >= 40.00 && $value < 50.00) {
        return 'Valutazione più negativa che positiva <br> minore del 50% ';    
    }elseif ($value == 50.00) {
        return 'Valutazione nella media <br> esattamente 50% ';   
    }elseif ($value >= 50.00 && $value < 60.00) { 
        return 'Valutazione più positiva che negativa <br> minore del 60% ';    
    }elseif ($value >= 60.00 && $value < 75.00) { 
        return 'Valutazione positiva <br> minore del 75% ';    
    }elseif ($value >= 75.00 && $value < 90.00) {   
        return 'Valutazione estremamente positiva <br> minore del 90% ';    
    }elseif ($value >= 90.00) {      
        return 'Valutazione ottima <br> maggiore del 90% ';
    }
}

function toolTipTextIconExplain($explanation = ' '){
    return 
    '<strong class="tooltip">Rank<span class="tooltiptext"> 
        Il sistema di Ranking visualizza in maniera grafica un risultato valutato secondo determinati parametri
        <ul class="tooltiplist">
            <li><i class="fas fa-angle-double-down"></i> Valutazione pessima minore del 10%</li>
            <li><i class="fas fa-angle-down"></i> Valutazione estremamente negativa minore del 25%</li>
            <li><i class="fas fa-angle-double-left"></i> Valutazione negativa minore del 40%</li>
            <li><i class="fas fa-angle-left"></i> Valutazione più negativa che positiva minore del 50%</li>
            <li><i class="fas fa-bars"></i> Valutazione nella media esattamente del 50%</li>
            <li><i class="fas fa-angle-right"></i> Valutazione più positiva che negativa minore del 60%</li>
            <li><i class="fas fa-angle-double-right"></i> Valutazione positiva minore del 75%</li>
            <li><i class="fas fa-angle-up"></i> Valutazione estremamente positiva minore del 90%</li>
            <li><i class="fas fa-angle-double-up"></i> Valutazione ottima maggiore del 90%</li>
        </ul>
        '.$explanation.' 
    </span></strong>
    ';
}

function toolTipEngineExplain(){
    return
    '<strong>Sono disponibili due motori per la creazione di diagrammi:</strong><br>
        <ul class="tooltiplist">
            <li>
                <i class="fab fa-google"> Google Charts:</i> 
                Uso del motore di rendering Google per rappresentare i diagrammi, 
                presenta diagrammi molto puliti e precisi al costo di effettuare richieste esterne al sito.
            </li>
            <li>
                <i class="fab fa-js"> Chartsjs:</i> 
                Uso del motore di rendering Chartsjs per rappresentare i diagrammi, 
                presenta diagrammi più semplici e fini al costo di appesantire il carico sul browser dell\'utente.
            </li>
        </ul>';
}

function evalText($value){
    if ( $value < 25.00 ){
        return '<b '.styleColorGradient($value). '> peggiore </b>';
    } elseif ( $value > 25.00 && $value < 50.00 ){
        return '<b '.styleColorGradient($value). '> comunque peggiore </b>';
    } elseif ( $value == 50.00 ){
        return '<b '.styleColorGradient($value). '> uguale </b>';
    }elseif ( $value > 50.00 && $value < 75.00 ){
        return '<b '.styleColorGradient($value). '> comunque migliore </b>';
    } else {
        return '<b '.styleColorGradient($value). '> migliore </b>';
    }
}

function arithmeticWeight($value, $delta_days){
    $string = substr($value, 0, 4);
    return '<strong class="tooltip" '. styleColorGradient( ($delta_days/$value)*100 )
            .'><center>' . $string . '<span class="tooltiptext">Secondo la media
             aritmetica, viene pubblicato un nuovo articolo ogni '.$string.' giorni,
             che risulta essere un valore '. evalText( ($delta_days/$value)*100 ).' rispetto al
             valore impostato ('.$delta_days.' giorni).
             Nota che questo valore è influenzato dal numero di post da visualizzare
            </span></center></strong>';
}

function geometicWeight($value, $delta_days){
    $string = substr($value, 0, 4);
    return '<strong class="tooltip" '. styleColorGradient( ($delta_days/$value)*100 )
            .'><center>' . $string . '<span class="tooltiptext">Secondo la media
             geometrica, viene pubblicato un nuovo articolo ogni '.$string.' giorni,
             che risulta essere un valore '. evalText( ($delta_days/$value)*100 ).' rispetto al
             valore impostato ('.$delta_days.' giorni).    
             Nota che questo valore è influenzato dal numero di post da visualizzare
            </span></center></strong>';
}

function median($median, $delta_days){    
    return '<strong class="tooltip" '. styleColorGradient( ($delta_days/$median)*100 )
            .'><center>' . $median . '<span class="tooltiptext">Secondo la mediana,
             viene pubblicato un nuovo articolo ogni '.$median.' giorni.
             Questo valore è generato tenendo conto di tutti i post pubblicati.
            </span></center></strong>';
}


function merge_sort($my_array){
    if (count($my_array) == 1) {
        return $my_array;
    }
    $mid = count($my_array) / 2;
    $left = array_slice($my_array, 0, $mid);
    $right = array_slice($my_array, $mid);
    $left = merge_sort($left);
    $right = merge_sort($right);
    return merge($left, $right);
}

function merge($left, $right){
	$res = array();
	while (count($left) > 0 && count($right) > 0){
            if($left[0] > $right[0]){
		$res[] = $right[0];
		$right = array_slice($right , 1);
            }else{
		$res[] = $left[0];
		$left = array_slice($left, 1);
            }
	}
	while (count($left) > 0){
            $res[] = $left[0];
            $left = array_slice($left, 1);
	}
	while (count($right) > 0){
            $res[] = $right[0];
            $right = array_slice($right, 1);
	}
	return $res;
}

