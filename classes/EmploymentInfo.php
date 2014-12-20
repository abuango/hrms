<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmploymentInfo
 *
 * @author abuango
 */
class EmploymentInfo {
    //put your code here
    
     public $acc_id;
    
    public function __construct($acc_id) {
        $this->acc_id = $acc_id;
    }
    
    public function createEmploymentInfo($emp_date, $emp_last_promo_date, $emp_grade_level, $emp_step, $emp_dept_id){
        
        global $db;
        
        return $db->insert('tbl_employment_info', array(
            'emp_date' => $emp_date,
            'emp_last_promo_date' => $emp_last_promo_date,
            'emp_grade_level' => $emp_grade_level,
            'emp_step' => $emp_step,
            'emp_dept_id' => $emp_dept_id,
            'acc_id' => $this->acc_id
        ));
    }
    
    public function updateEmploymentInfo($emp_date, $emp_last_promo_date, $emp_grade_level, $emp_step, $emp_dept_id){
        
        global $db;
        
        return $db->update('tbl_employment_info', array(
            'emp_date' => $emp_date,
            'emp_last_promo_date' => $emp_last_promo_date,
            'emp_grade_level' => $emp_grade_level,
            'emp_step' => $emp_step,
            'emp_dept_id' => $emp_dept_id,
        ), ' acc_id = ?', array( $this->acc_id));
    }
    
    public function deleteEmploymentInfo($emp_id){
        global $db;
        
        return $db->delete('tbl_employment_info', 'emp_id = ?', array($emp_id));
    }
    
    public function getEmpDates(){
        global $db;
        
        return $db->dlookup('emp_date, emp_last_promo_date', 'tbl_employment_info', 'acc_id = ?', array($this->acc_id));
    }
    
    public function getGradeLevel(){
        global $db;
        
        return $db->dlookup('emp_grade_level', 'tbl_employment_info', 'acc_id = ?', array($this->acc_id));
    
    }
    
    public function getStep(){
        global $db;
        
        return $db->dlookup('emp_step', 'tbl_employment_info', 'acc_id = ?', array($this->acc_id));
    
    }
    
    public function getDept(){
        global $db;
        
        return $db->dlookup('emp_dept_id', 'tbl_employment_info', 'acc_id = ?', array($this->acc_id));
    
    }
    
    
    public function setGradeLevel($emp_grade_level){
        
        global $db;
        
        return $db->update('tbl_employment_info', array(
            
            'emp_grade_level' => $emp_grade_level
        ), 'acc_id = ?', array($this->acc_id));
    }
    
     public function setStep($emp_step){
        
        global $db;
        
        return $db->update('tbl_employment_info', array(
            
            'emp_step' => $emp_step
        ), 'acc_id = ?', array($this->acc_id));
    }
    
    public function setDept($emp_dept_id){
        
        global $db;
        
        return $db->update('tbl_employment_info', array(
            
            'emp_dept_id' => $emp_dept_id
        ), 'acc_id = ?', array($this->acc_id));
    }
    
}
