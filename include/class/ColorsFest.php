<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ColorsFest
 *
 * @author ale
 */
class ColorsFest {
    private $colors = array();
    private $length = 0;
    private $active_id = 0;
    private $active_exadecimal = '';
    private $active_name = '';
    private $stylesheet_dir = '';
    
    private $Q;
    
    public function __construct(){
        global $wpdb;
        $this->Q = $wpdb;
        $this->init();         
    }
    
    protected function init(){
        $this->colors = RMQ_get_colors($this->Q);
        $this->length = count($this->colors);
        
        foreach ( $this->colors as $color ){
            if ( $color->is_active == 'true' ){
                $this->active_id = $color->id;
                $this->active_exadecimal = $color->exadecimal;
                $this->active_name = $color->name;
            }
        }
        
        $this->stylesheet_dir = get_home_path().'/wp-content/themes/recensility/style.css';
    }
    
    public function getActiveExadecimal(){
        return $this->active_exadecimal;
    }
    
    public function getActiveName(){
        return $this->active_name;
    }
    
    public function getColors(int $index=-1){
        if ( $index < 0 ){
            return $this->colors;
        } elseif ( $index < $this->length ){
            return $this->colors[$index];
        } 
        
        return false;
    }
    
    public function getColorName(int $index=-1){
        if ( $index < 0 ){
            return $this->colors;
        } elseif ( $index < $this->length ){
            return $this->colors[$index]->name;
        } 
        
        return false;
    }
    
    public function getColorExadecimal(int $index=-1){
        if ( $index < 0 ){
            return $this->colors;
        } elseif ( $index < $this->length ){
            return $this->colors[$index]->exadecimal;
        } 
        
        return false;
    }
    
    public function getColorActive(int $index=-1){
        if ( $index < 0 ){
            return $this->colors;
        } elseif ( $index < $this->length ){
            return $this->colors[$index]->is_active;
        } 
        
        return false;
    }
    
    public function getDate(int $index=-1){
        if ( $index < 0 ){
            return $this->colors;
        } elseif ( $index < $this->length ){
            return $this->colors[$index]->archive;
        } 
        
        return false;
    }
    
    public function getID(int $index=-1){
        if ( $index < 0 ){
            return $this->colors;
        } elseif ( $index < $this->length ){
            return $this->colors[$index]->id;
        } 
        
        return false;
    }
    
    public function getLength(){
        return $this->length;
    }
    
    public function getStylesheetDir(){
        return $this->stylesheet_dir;
    }
    
    public function setActive(int $id, int $index){
        if ( $id != $this->active_id ){
            $this->Q->query('UPDATE `'.$this->Q->prefix.'recensility_color_fest` SET `is_active`= "true" WHERE `id` = \''.$id.'\'' );
            $this->Q->query('UPDATE `'.$this->Q->prefix.'recensility_color_fest` SET `is_active`= "false" WHERE `id` = \''.$this->active_id.'\'' );
            
            $activate_exa = $this->colors[$index]->exadecimal;
            
            file_put_contents( $this->stylesheet_dir, str_replace($this->active_exadecimal, $activate_exa, file_get_contents( $this->stylesheet_dir ), $i) );
            
            $this->active_id = $this->colors[$index]->id;
            $this->active_exadecimal = $this->colors[$index]->exadecimal;
            $this->active_name = $this->colors[$index]->name;
            
            return true;
        }
        
        return false;
    }
    
    public function insert(string $name, string $exadecimal){
        $this->Q->query('INSERT INTO `'.$this->Q->prefix.'recensility_color_fest` ('
                 . '`name`, `exadecimal`, `is_active`, `archive`) VALUES ('
                 . '\''.$name.'\', \''.$exadecimal.'\', \'false\', CURRENT_TIMESTAMP)');
        
        $init = new stdClass();
        $init->name = $name;
        $init->exadecimal = $exadecimal;
        $init->is_active = false;
        $init->archive = date('Y-m-d');
        
        array_push( $this->colors, $init );
    }
    
    public function delete(int $index, int $id) {
        unset($this->colors[$index]);
        $this->Q->query('DELETE FROM `'.$this->Q->prefix.'recensility_color_fest` WHERE `id` = \''.$id.'\'');
        $this->length = $this->length-1;
    }
}
