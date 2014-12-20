<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LogManager
 *
 * @author abuango
 */
class LogManager {
    //put your code here
    
    public function addLog($log_type, $entity_id, $details){
        global $db;
        
        return $db->insert('tbl_logs', array('log_type' => $log_type, 'entity_id' => $entity_id, 'details' => $details, 'log_date_time' => DATE(NOW()))); 
        //Fix Date and time string later
    }
    
    public function deleteLog($log_id){
        global $db;
        
        return $db->delete('tbl_logs', 'log_id = ?', array($log_id));
    }
    
    public function getLog($log_id){
        global $db;
        
        return $db->dlookup('log_type, entity_id, details, log_date_time', 'tbl_logs', 'log_id = ?', array($log_id));
    }
    
    
    public function getUserLog($acc_id){
        global $db;
        
        $output = "";
        $db->query("SELECT details, log_date_time FROM tbl_logs WHERE entity_id = ?", array($acc_id));
        
        if($db->found_rows > 0){
            while($row = $db->fetch_assoc()){
                $output .= "<li> [ ".$row['log_date_time']." ] - ".$row['details']."</li>";
            }
        }else{
            $output = "No Log found!";
        }
        
        return $output;
    }
    
    public function getDateLog($date1, $date2){
        global $db;
        
        return $db->dlookup('log_type, entity_id, details, log_date_time', 'tbl_logs', 'log_date_time >= ? AND log_date_time <= ?', array($date1, $date2));
    }
      
}
