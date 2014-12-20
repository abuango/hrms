<?php

/**
 * Description of ContactAddress
 *
 * @author abuango
 */
class ContactAddress {
    //Contact Address class
    
     
    public $acc_id;
    
    public function __construct($acc_id) {
        $this->acc_id = $acc_id;
    }
    
    
    public function createContactAddress ($contact_address, $permanent_address, $phone, $other_phone, $email, $other_email){
        global $db;
        
        $status = $db->insert('tbl_contact_address', 
                array(
                    'acc_id' => $this->acc_id,
                    'contact_address' => $contact_address,
                    'permanent_address' => $permanent_address,
                    'pri_phone_num' => $phone,
                    'other_phone_num' => $other_phone,
                    'pri_email_address' => $email,
                    'other_email_address' => $other_email
                ));
        
       return $status;
    }
    
    public function updateAddresses( $contact_address, $permanent_address){
        global $db;
        
        return $db->update('tbl_contact_address', 
                array(
                    
                    'contact_address' => trim($contact_address),
                    'permanent_address' => trim($permanent_address)
                    
                ), 'acc_id = ?', array($this->acc_id));
    }
    
    public function updatePhoneNumbers( $phone, $other_phone){
        global $db;
        
        return $db->update('tbl_contact_address', 
                array(
                    
                    'pri_phone_num' => $phone,
                    'other_phone_num' => $other_phone
                    
                ), 'acc_id = ?', array($this->acc_id));
    }
    
    public function updateEmails($email, $other_email){
        global $db;
        
        return $db->update('tbl_contact_address', 
                array(
                    
                    'pri_email_address' => $email,
                    'other_email_address' => $other_email
                    
                ), 'acc_id = ?', array($this->acc_id));
    }
    
    
    public function deleteContact($contact_id){
        global $db;
        
        return $db->delete('tbl_contact_address', 'contact_id = ?', array($contact_id));
    }
    
    
    public function getAddress(){
        global $db;
        
        return $db->dlookup('contact_address, permanent_address', 'tbl_contact_address', 'acc_id = ?', array($this->acc_id));
    }
    
    public function getPhones(){
        global $db;
        
        return $db->dlookup('pri_phone_num, other_phone_num', 'tbl_contact_address', 'acc_id = ?', array($this->acc_id));
    }
    
    public function getEmails(){
        global $db;
        
        return $db->dlookup('pri_email_address, other_email_address', 'tbl_contact_address', 'acc_id = ?', array($this->acc_id));
    }
    
    
    
    
    
}
