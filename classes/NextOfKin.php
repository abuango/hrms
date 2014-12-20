<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class NextOfKin{
    
    public $acc_id;
    
    public function __construct($acc_id) {
        $this->acc_id = $acc_id;
    }
    
    public function createNOK($fullname, $address, $phone, $email){
        global $db;
        
        $status = $db->insert('tbl_next_of_kin',
                    array(
                        'acc_id' => $this->acc_id,
                        'nok_fullname' => $fullname,
                        'nok_contact_address' => $address,
                        'nok_phone_num' => $phone,
                        'nok_email' => $email
                    )
                );
        if($status == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function updateNOK($fullname, $address, $phone, $email){
        global $db;
        
        $status = $db->update('tbl_next_of_kin',
                    array(
                        'nok_fullname' => $fullname,
                        'nok_contact_address' => $address,
                        'nok_phone_num' => $phone,
                        'nok_email' => $email
                    ), 'acc_id = ?', array($this->acc_id)
                );
        if($status == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteNOK($acc_id){
        global $db;
        
        return $db->delete('tbl_next_of_kin', 'acc_id = ?', array($acc_id));
    }
    
    public function getNOKName($acc_id){
        global $db;
        
        return $db->dlookup('nok_fullname', 'tbl_next_of_kin', 'acc_id = ?', array($acc_id));
    }
    
    public function getNOKAddress($acc_id){
        global $db;
        
        return $db->dlookup('nok_contact_address', 'tbl_next_of_kin', 'acc_id = ?', array($acc_id));
    }
    
    public function getNOKPhone($acc_id){
        global $db;
        
        return $db->dlookup('nok_phone_num', 'tbl_next_of_kin', 'acc_id = ?', array($acc_id));
    }
    
    public function getNOKEmail($acc_id){
        global $db;
        
        return $db->dlookup('nok_email', 'tbl_next_of_kin', 'acc_id = ?', array($acc_id));
    }
    
    public function getNOK(){
        global $db;
        
        return $db->dlookup('nok_fullname, nok_contact_address, nok_phone_num, nok_email', 'tbl_next_of_kin', 'acc_id = ?', array($this->acc_id));
    }
}