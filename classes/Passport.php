<?php


class Passport{
    
    public $acc_id;
    
    public function __construct($acc_id) {
        $this->acc_id = $acc_id;
    }
    
    public function addPassport($file_id){
        global $db;
        
        if($db->dlookup('acc_id', 'tbl_passport', 'acc_id = ?', array($this->acc_id)) != false){
            $db->delete('tbl_passport', 'acc_id = ?', array($this->acc_id));
        }
        
        $status = $db->insert('tbl_passport',
                    array(
                        'acc_id' => $this->acc_id,
                        'file_id' => $file_id
                    )
                );
        if($status == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function updatePassport($pic_id, $file_id){
        global $db;
        
        $status = $db->update('tbl_passport',
                    array(
                        
                        'file_id' => $file_id
                    ), 'pic_id = ? AND acc_id = ?', array($pic_id, $this->acc_id)
                );
        if($status == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function deletePassport($pic_id){
        global $db;
        
        return $db->delete('tbl_passport', 'pic_id = ?', array($pic_id));
    }
    
    public function getPassport($acc_id){
        global $db;
        $f = new FileManager();
        return $f->getFileURL($db->dlookup('file_id', 'tbl_passport', 'acc_id = ?', array($acc_id)));
    }
}

