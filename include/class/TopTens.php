<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TopTens
 *
 * @author ale
 */
class TopTens {
    private $toptens = array();
    private $toptens_length = 0;

    private $toptenspref = array();
    private $toptenspref_length = 0;

    private $toptensqp = array();
    private $toptensqp_length = 0;
    
    private $Q;
        
    public function __construct() {
        global $wpdb;
        $this->Q = $wpdb;
        $this->init();
    }
    
    protected function init(){
        $this->toptens = RMQ_table($this->Q, $this->Q->prefix.'recensility_top_ten');
        $this->toptens_length = count($this->toptens);
        $this->toptenspref = RMQ_table($this->Q, $this->Q->prefix.'recensility_top_ten_prefered');
        $this->toptenspref_length = count($this->toptenspref);
        $this->toptensqp = RMQ_table($this->Q, $this->Q->prefix.'recensility_top_ten_quality_price');
        $this->toptensqp_length = count($this->toptensqp);
    }
    
    public function getTopTen(int $index=-1){
        if ($index < 0){
            return $this->toptens;
        } elseif ( $index <= $this->toptens_length) {
            return $this->toptens[$index];
        } 
        
        return false;
    }
    
    public function getNumOfTopten(){
        return $this->toptens_length;
    }
    
    public function getTopTenPrefered(int $index=-1){
        if ($index < 0){
            return $this->toptenspref;
        } elseif ( $index <= $this->toptenspref_length) {
            return $this->toptenspref[$index];
        } 
        
        return false;
    }
    
    public function getNumOfTopTenPrefered(){
        return $this->toptenspref_length;
    }
    
    public function getTopTenQualityPrice(int $index=-1){
        if ($index < 0){
            return $this->toptensqp;
        } elseif ( $index <= $this->toptensqp_length) {
            return $this->toptensqp[$index];
        } 
        
        return false;
    }
    
    public function getNumOfTopTenQualityPrice(){
        return $this->toptensqp_length;
    }
}
