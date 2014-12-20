<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Qualifications{
    
    public $acc_id;
    
    public function __construct($acc_id) {
        $this->acc_id = $acc_id;
    }
    
    public function addQualification($institution, $course, $yr1, $yr2, $quali_obtained){
        global $db;
        
        $status = $db->insert('tbl_qualifications',
                    array(
                        'acc_id' => $this->acc_id,
                        'quali_institution' => $institution,
                        'quali_course' => $course,
                        'quali_yr1' => $yr1,
                        'quali_yr2' => $yr2,
                        'quali_obtained' => $quali_obtained
                    )
                );
        if($status == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function updateQualification($quali_id, $institution, $course, $yr1, $yr2, $quali_obtained){
        global $db;
        
        $status = $db->update('tbl_qualifications',
                    array(
                        'quali_institution' => $institution,
                        'quali_course' => $course,
                        'quali_yr1' => $yr1,
                        'quali_yr2' => $yr2,
                        'quali_obtained' => $quali_obtained
                    ), 'acc_id = ? AND quali_id = ?', array($this->acc_id, $quali_id)
                );
        if($status == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteQualification($quali_id){
        global $db;
        
        return $db->delete('tbl_qualifications', 'quali_id = ?', array($quali_id));
    }
    
    public function getQualification($quali_id){
        global $db;
        
        return $db->dlookup('quali_institution, quali_course, quali_yr1, quali_yr2, quali_obtained','tbl_qualifications', 'quali_id = ?', array($quali_id));
    }
    
    public function getStaffQualifications(){
        global $db;
        
        $db->query("SELECT quali_id, quali_institution, quali_course, quali_yr1, quali_yr2, quali_obtained FROM tbl_qualifications WHERE acc_id = ?", array($this->acc_id));
        if($db->found_rows){
            
            $quali_tr = $this->acc_id."";
            
            while($row = $db->fetch_assoc()){
                $quali_tr .= "<tr><td>".$row['quali_institution']."</td><td>".$row['quali_course']."</td><td>".$row['quali_yr1']."</td><td>".$row['quali_yr2']."</td><td>".$row['quali_obtained']."</td><td><a id = '".$row['quali_id']."' class = 'removeQuali' >Remove</a></td></tr>";
            }
            
            return $quali_tr;
        }else{
            return "No Qualifications entered yet!";
        }
    }
}
