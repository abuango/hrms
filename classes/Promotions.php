<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Promotions{
    
    public $acc_id;
    
    public function __construct($acc_id) {
        $this->acc_id = $acc_id;
    }
    
    public function addPromotion($promo_date, $promo_prev_level, $promo_prev_step, $promo_new_level, $promo_new_step){
        global $db;
        
        $status = $db->insert('tbl_promotions',
                    array(
                        'acc_id' => $this->acc_id,
                        'promo_date' => $promo_date,
                        'promo_prev_level' => $promo_prev_level,
                        'promo_prev_step' => $promo_prev_step,
                        'promo_new_level' => $promo_new_level,
                        'promo_new_step' => $promo_new_step
                    )
                );
        if($status == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function updatePromotion($promo_id, $promo_date, $promo_prev_level, $promo_prev_step, $promo_new_level, $promo_new_step){
        global $db;
        
        $status = $db->update('tbl_promotions',
                    array(
                        'promo_date' => $promo_date,
                        'promo_prev_level' => $promo_prev_level,
                        'promo_prev_step' => $promo_prev_step,
                        'promo_new_level' => $promo_new_level,
                        'promo_new_step' => $promo_new_step
                    ), 'acc_id = ? AND promo_id = ?', array($this->acc_id, $promo_id)
                );
        if($status == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function deletePromotion($promo_id){
        global $db;
        
        return $db->delete('tbl_promotions', 'promo_id = ?', array($promo_id));
    }
    
    public function getPromotionDetails($promo_id){
        global $db;
        
        return $db->dlookup('promo_date, promo_prev_level, promo_prev_step, promo_new_level, promo_new_step','tbl_promotions', 'promo_id = ?', array($promo_id));
    }
    
    public function getStaffPromotions(){
        global $db;
        
        $db->query("SELECT promo_id, promo_date, promo_prev_level, promo_prev_step, promo_new_level, promo_new_step FROM tbl_promotions WHERE acc_id = ?", array($this->acc_id));
        if($db->found_rows){
            return $db->fetch_assoc_all();
        }else{
            return false;
        }
        
    }
}
