<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Utilities
 *
 * @author abuango
 */
class Utilities {
    //put your code here
    
    public function getUserNotifications($acc_id){
        global $db;
        $output = "";
        $db->query("SELECT date_time, details FROM tbl_notifications WHERE notif_read = 0 AND acc_id = ?", array($acc_id));
        if($db->found_rows > 0){
           while($row = $db->fetch_assoc()){
               $output .= "<li>[ ".$row['date_time']." ] - ".$row['details']."</li>";
           }
        }else{
            $output = "No Notifications Found!";
        }
        //return $db->dlookup('date_time, details', 'tbl_notifications', 'acc_id = '.$acc_id);
        return $output;
    }
    
    public function getStates($state_id = false){
        global $db;
        
        $output = "";
        
        if($state_id == false){
            $db->query("SELECT * FROM tbl_states;");
        }else{
            $db->query("SELECT * FROM tbl_states WHERE id = ?;", array($state_id));
        }
        if($db->found_rows > 0){
            while($row = $db->fetch_assoc()){
                if($state_id == false){
                    $output .= "<option value='".$row['id']."'>".$row['state_name']."</option>";
                }else{
                    if($row['id'] == $state_id){
                        $output .= "<option value='".$row['id']."' selected = 'selected'>".$row['state_name']."</option>";
                    }
                }
            }
        }
        
        return $output;
    }
    
    public function getLGAs($state_id, $lga_id = false){
        global $db;
        
        $output = "";
        
      
            $db->query("SELECT * FROM tbl_lga WHERE state_id = ?;", array($state_id));
        
        if($db->found_rows > 0){
            while($row = $db->fetch_assoc()){
                
                if($lga_id == false){
                
                    $output .= "<option value='".$row['id']."'>".$row['lga_name']."</option>";
                }else{
                     if($row['id'] == $lga_id){
                        $output .= "<option value='".$row['id']."' selected='selected'>".$row['lga_name']."</option>";
                     }else{
                         $output .= "<option value='".$row['id']."'>".$row['lga_name']."</option>";
                     }
                }
            }
        }
        
        return $output;
    }
    
    public function getDepts($dept_id = false){
        global $db;
        $output = "";
        
            $db->query("SELECT dept_id, dept_name FROM tbl_depts;");
        
        
        if($db->found_rows > 0){
            while($row = $db->fetch_assoc()){
                
                if($dept_id == false){
                
                    $output .= "<option value='".$row['dept_id']."'>".$row['dept_name']."</option>";
                }else{
                     if($row['dept_id'] == $dept_id){
                        $output .= "<option value='".$row['dept_id']."' selected='selected'>".$row['dept_name']."</option>";
                     }else{
                         $output .= "<option value='".$row['dept_id']."'>".$row['dept_name']."</option>";
                     }
                }
            }
        }
        
        return $output;
    }
}
