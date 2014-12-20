<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Departments
 *
 * @author abuango
 */
class Departments {
    //put your code here
    
    public function addDept($dept_name, $dept_details, $location){
        global $db;
        
        return $db->insert('tbl_depts', array(
           
            'dept_name' => $dept_name,
            'other_details' => $dept_details,
            'location' => $location
        ));
    }
    
     public function updateDept($dept_id, $dept_name, $dept_details, $location){
        global $db;
        
        return $db->update('tbl_depts', array(
            
            'dept_name' => $dept_name,
            'other_details' => $dept_details,
            'location' => $location
        ), 'dept_id = ?', array($dept_id));
    }
    
    public function deleteDept($dept_id){
        global $db;
        
        return $db->delete('tbl_depts', 'dept_id = ?', array($dept_id));
    }
    
    public function getDept($dept_id){
        global $db;
        
        return $db->dlookup('dept_name, other_details, location', 'tbl_depts', 'dept_id = ?', array($dept_id));
    }
    
    public function getDeptName($dept_id){
        global $db;
        
        return $db->dlookup('dept_name', 'tbl_depts', 'dept_id = ?', array($dept_id));
    }
    
    public function getHOD($dept_id){
        global $db;
        
        return $db->dlookup('hod_acc_id', 'tbl_depts', 'dept_id = ?', array($dept_id));
    }
    
    public function getDepts(){
        global $db;
        $acc = new StaffAccounts();
        $db->query("SELECT * FROM tbl_depts");
        $output_data = "";
        if($db->found_rows > 0){
            //echo $db->found_rows;
            $rows = $db->fetch_assoc_all();
            foreach($rows as $row){
                //print_r($row);
                $output_data .= "<tr><td>".$row['dept_name']."</td><td>".$row['location']."</td><td>".$row['other_details']."</td><td>".$acc->getFullName($row['hod_acc_id'])."</td><td>[ <a href='index.php?section=depts&action=edit&data=".$row['dept_id']."'>Edit</a> ][ <a href='index.php?section=depts&action=delete&data=".$row['dept_id']."'>Delete</a> ]</td></tr>";
                        
            }
        }
        
        return $output_data;
    }
    
    public function getDeptByHOD($hod){
        global $db;
        
        return $db->dlookup('dept_id', 'tbl_depts', 'hod_acc_id = ?', array($hod));
    }
    
    public function setHOD($dept_id, $hod){
        global $db;
        
        return $db->update('tbl_depts', array('hod_acc_id' => $hod), 'dept_id = ?', array($dept_id));
    }
}
