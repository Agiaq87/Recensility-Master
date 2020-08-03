<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FastLinks
 *
 * @author ale
 */
class FastLinks {
    private $fastlinks = array();
    private $length = 0;
    private $Q;
    
    public function __construct() {
        global $wpdb;
        $this->Q = $wpdb;
        $this->init();
    }
    
    protected function init(){
        $this->fastlinks = RMQ_table($this->Q, $this->Q->prefix.'recensility_fast_link');
        $this->length = count($this->fastlinks);
    }


    public function getFastLinks(int $index=-1){
        if ( $index < 0 ){
            return $this->fastlinks;
        } elseif ( $index < $this->length ){
            return $this->fastlinks[$index];
        }
        
        return false;
    }
    
    public function getLength(){
        return $this->length;
    }
    
    public function getID(int $index=0){
        if ( $index < 0 || $index > $this->length ){
            return false;
        } else {
            return $this->fastlinks[$index]->id;
        }
    }
    
    public function getLinkName(int $index=0){
        if ( $index < 0 || $index > $this->length ){
            return false;
        } else {
            return $this->fastlinks[$index]->link_name;
        }
    }
    
    public function getIconClass(int $index=0){
        if ( $index < 0 || $index > $this->length ){
            return false;
        } else {
            return $this->fastlinks[$index]->icon_class;
        }
    }
    
    public function getDate(int $index=0){
        if ( $index < 0 || $index > $this->length ){
            return false;
        } else {
            return $this->fastlinks[$index]->archive;
        }
    }
    
    public function getURL(int $index=0){
        if ( $index < 0 || $index > $this->length ){
            return false;
        } else {
            return $this->fastlinks[$index]->link_url;
        }
    }
    
    public function update(int $index, int $id, string $name, string $icon, string $url){
        $this->fastlinks[$index]->icon_class = $icon;
        $this->fastlinks[$index]->link_name = $name;
        $this->fastlinks[$index]->link_url = $url;
        $this->Q->query('UPDATE `'.$this->Q->prefix.'recensility_fast_link` SET `link_name` = \''.$name.'\', `icon_class` = \''.$icon.'\', `link_url` = \''.$url.'\' WHERE `id` = '.$id);
    }
    
    public function delete(int $index, int $id){
        unset($this->fastlinks[$index]);
        $this->Q->query('DELETE FROM `'.$this->Q->prefix.'recensility_fast_link` WHERE `id` = '.$id);
    }
}
