<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Datasheet
 *
 * @author ale
 */
class Datasheets {
    
    private $smartphones = array();
    private $smartphones_length = 0;
    
    private $socs = array();
    private $socs_length = 0;
    
    private $rams = array();
    private $rams_length = 0;
    
    private $mgpus = array();
    private $mgpus_length = 0;
    
    private $parts = array();
    private $parts_length = 0;
    
    private $ports = array();
    private $ports_length = 0;
    
    private $displays = array();
    private $displays_length = 0;
    
    private $expansions = array();
    private $expansions_length = 0;
    
    private $protections = array();
    private $protections_length = 0;
    
    private $wifis = array();
    private $wifis_length = 0;
    
    private $sims = array();
    private $sims_length = 0;
    
    private $unlocks = array();
    private $unlocks_length = 0;
    
    private $bluetooths = array();
    private $bluetooths_length = 0;
    
    private $brands = array();
    private $brands_length = 0;
        
    private $cpus = array();
    private $cpus_length = 0;
    
    private $gpus = array();
    private $gpus_length = 0;
    
    private $fitbands = array();
    private $fitbands_length = 0;
    
    private $oses = array();
    private $oses_length = 0;
    
    private $moses = array();
    private $moses_length = 0;
    
    private $mosesgui = array();
    private $mosesgui_length = 0;
    
    private $Q;
    
    public function __construct(){
        global $wpdb;
        $this->Q = $wpdb;
        $this->init();
    }
    
    protected function init(){
                
        $this->smartphones = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_smartphone');
        $this->smartphones_length = count($this->smartphones);

        $this->socs = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_soc');
        $this->socs_length = count($this->socs);

        $this->rams = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_ram');
        $this->rams_length = count($this->rams);

        $this->mgpus = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_mobile_gpu');
        $this->mgpus_length = count($this->mgpus);

        $this->parts = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_part');
        $this->parts_length = count($this->parts);

        $this->ports = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_port');
        $this->ports_length = count($this->ports);

        $this->displays = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_display');
        $this->displays_length = count($this->displays);

        $this->expansions = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_expansion_slot');
        $this->expansions_length = count($this->expansions);

        $this->protections = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_protection');
        $this->protections_length = count($this->protections);

        $this->wifis = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_wifi');
        $this->wifis_length = count($this->wifis);

        $this->sims = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_sim');
        $this->sims_length = count($this->sims);

        $this->unlocks = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_unlock');
        $this->unlocks_length = count($this->unlocks);

        $this->bluetooths = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_bluetooth');
        $this->bluetooths_length = count($this->bluetooths);

        $this->brands = RMQ_table($this->Q, $this->Q->prefix.'recensility_brand');
        $this->brands_length = count($this->brands);

        $this->cpus = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_cpu');
        $this->cpus_length = count($this->cpus);

        $this->gpus = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_gpu');
        $this->gpus_length = count($this->gpus);

        $this->fitbands = RMQ_table($this->Q, $this->Q->prefix.'recensility_schede_tecniche_fitband');
        $this->fitbands_length = count($this->fitbands);

        $this->oses = RMQ_table($this->Q, $this->Q->prefix.'recensility_software_os');
        $this->oses_length = count($this->oses);

        $this->moses = RMQ_table($this->Q, $this->Q->prefix.'recensility_software_mobile_os');
        $this->moses_length = count($this->moses);

        $this->mosesgui = RMQ_table($this->Q, $this->Q->prefix.'recensility_software_mobile_gui');
        $this->mosesgui_length = count($this->mosesgui);
    }
    
    public function getSmartphones(int $index=-1){
        if ($index < 0){
            return $this->smartphones;
        } elseif ( $index <= $this->smartphones_length) {
            return $this->smartphones[$index];
        } 
        
        return false;
    }
    
    public function getSmartphonesLength(){
        return $this->smartphones_length;
    }
    
    public function getSocs(int $index=-1){
        if ($index < 0){
            return $this->socs;
        } elseif ( $index <= $this->socs_length) {
            return $this->socs[$index];
        } 
        
        return false;
    }
    
    public function getSocsLength(){
        return $this->socs_length;
    }
    
    public function getRams(int $index=-1){
        if ($index < 0){
            return $this->rams;
        } elseif ( $index <= $this->rams_length) {
            return $this->rams[$index];
        } 
        
        return false;
    }
    
    public function getRamsLength(){
        return $this->rams_length;
    }
    
    public function getMgpus(int $index=-1){
        if ($index < 0){
            return $this->mgpus;
        } elseif ( $index <= $this->mgpus_length) {
            return $this->mgpus[$index];
        } 
        
        return false;
    }
    
    public function getMgpusLength(){
        return $this->mgpus_length;
    }
    
    public function getParts(int $index=-1){
        if ($index < 0){
            return $this->parts;
        } elseif ( $index <= $this->parts_length) {
            return $this->parts[$index];
        } 
        
        return false;
    }
    
    public function getPartsLength(){
        return $this->parts_length;
    }
    
    public function getPorts(int $index=-1){
        if ($index < 0){
            return $this->ports;
        } elseif ( $index <= $this->ports_length) {
            return $this->ports[$index];
        } 
        
        return false;
    }
    
    public function getPortsLength(){
        return $this->ports_length;
    }
    
    public function getDisplays(int $index=-1){
        if ($index < 0){
            return $this->displays;
        } elseif ( $index <= $this->displays_length) {
            return $this->displays[$index];
        } 
        
        return false;
    }
    
    public function getDisplaysLength(){
        return $this->displays_length;
    }
    
    public function getExpansions(int $index=-1){
        if ($index < 0){
            return $this->expansions;
        } elseif ( $index <= $this->expansions_length) {
            return $this->expansions[$index];
        } 
        
        return false;
    }
    
    public function getExpansionsLength(){
        return $this->expansions_length;
    }
    
    public function getProtections(int $index=-1){
        if ($index < 0){
            return $this->protections;
        } elseif ( $index <= $this->protections_length) {
            return $this->protections[$index];
        } 
        
        return false;
    }
    
    public function getProtectionsLength(){
        return $this->protections_length;
    }
    
    public function getWifis(int $index=-1){
        if ($index < 0){
            return $this->wifis;
        } elseif ( $index <= $this->wifis_length) {
            return $this->wifis[$index];
        } 
        
        return false;
    }
    
    public function getWifisLength(){
        return $this->wifis_length;
    }
    
    public function getSims(int $index=-1){
        if ($index < 0){
            return $this->sims;
        } elseif ( $index <= $this->sims_length) {
            return $this->sims[$index];
        } 
        
        return false;
    }
    
    public function getSimsLength(){
        return $this->sims_length;
    }
    
    public function getUnlocks(int $index=-1){
        if ($index < 0){
            return $this->unlocks;
        } elseif ( $index <= $this->unlocks_length) {
            return $this->unlocks[$index];
        } 
        
        return false;
    }
    
    public function getUnlocksLength(){
        return $this->unlocks_length;
    }
    
    public function getBluetooths(int $index=-1){
        if ($index < 0){
            return $this->bluetooths;
        } elseif ( $index <= $this->bluetooths_length) {
            return $this->bluetooths[$index];
        } 
        
        return false;
    }
    
    public function getBluetoothsLength(){
        return $this->bluetooths_length;
    }
    
    public function getBrands(int $index=-1){
        if ($index < 0){
            return $this->brands;
        } elseif ( $index <= $this->brands_length) {
            return $this->brands[$index];
        } 
        
        return false;
    }
    
    public function getBrandsLength(){
        return $this->brands_length;
    }
        
    public function getCpus(int $index=-1){
        if ($index < 0){
            return $this->cpus;
        } elseif ( $index <= $this->cpus_length) {
            return $this->cpus[$index];
        } 
        
        return false;
    }
    
    public function getCpusLength(){
        return $this->cpus_length;
    }
    
    public function getGpus(int $index=-1){
        if ($index < 0){
            return $this->gpus;
        } elseif ( $index <= $this->gpus_length) {
            return $this->gpus[$index];
        } 
        
        return false;
    }
    
    public function getGpusLength(){
        return $this->gpus_length;
    }
    
    public function getFitbands(int $index=-1){
        if ($index < 0){
            return $this->fitbands;
        } elseif ( $index <= $this->fitbands_length) {
            return $this->fitbands[$index];
        } 
        
        return false;
    }
    
    public function getFitbandsLength(){
        return $this->fitbands_length;
    }
    
    public function getOses(int $index=-1){
        if ($index < 0){
            return $this->oses;
        } elseif ( $index <= $this->oses_length) {
            return $this->oses[$index];
        } 
        
        return false;
    }
    
    public function getOsesLength(){
        return $this->oses_length;
    }
    
    public function getMoses(int $index=-1){
        if ($index < 0){
            return $this->moses;
        } elseif ( $index <= $this->moses_length) {
            return $this->moses[$index];
        } 
        
        return false;
    }
    
    public function getMosesLength(){
        return $this->moses_length;
    }
    
    public function getMosesgui(int $index=-1){
        if ($index < 0){
            return $this->mosesgui;
        } elseif ( $index <= $this->mosesgui_length) {
            return $this->mosesgui[$index];
        } 
        
        return false;
    }
    
    public function getMosesguiLength(){
        return $this->mosesgui_length;
    }
}
