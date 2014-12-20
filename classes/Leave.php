<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Leave{
    
    public $acc_id;
    
    public function __construct($acc_id) {
        $this->acc_id = $acc_id;
    }
    
    public function createLeaveRequest($leave_start_date, $leave_end_date,  $leave_details){
        global $db;
        
        $status = $db->insert('tbl_leave_apps',
                    array(
                        'acc_id' => $this->acc_id,
                        'leave_start_date' => $leave_start_date,
                        'leave_end_date' => $leave_end_date,
                        'duration' => 0,
                        'leave_details' => $leave_details
                    )
                );
        if($status == true){
            
            $db->insert('tbl_leave_status', array(
                'leave_id' => $db->insert_id(),
                'leave_status' => 0
            ));
            
            return true;
        }else{
            return false;
        }
    }
    
    public function updateLeaveRequest($leave_id, $leave_start_date, $leave_end_date, $duration, $leave_details){
        global $db;
        
        $status = $db->update('tbl_leave_apps',
                    array(
                        'leave_start_date' => $leave_start_date,
                        'leave_end_date' => $leave_end_date,
                        'duration' => $duration,
                        'leave_details' => $leave_details
                    ), 'acc_id = ? AND leave_id = ?', array($this->acc_id, $leave_id)
                );
        if($status == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteLeave($leave_id){
        global $db;
        
        return $db->delete('tbl_leave_apps', 'leave_id = ?', array($leave_id));
    }
    
    public function getLeaveRequest($leave_id){
        global $db;
        
        return $db->dlookup('leave_start_date, leave_end_date, duration, leave_details','tbl_leave_apps', 'leave_id = ?', array($leave_id));
    }
    
    public function getStaffLeaveRequests(){
        global $db;
        
        return $db->dlookup('leave_start_date, leave_end_date, duration, leave_details','tbl_leave_apps', 'acc_id = ?', array($this->acc_id));
    }
    
    public function getLeaveStatus($leave_id){
        global $db;
        
        return $db->dlookup('leave_status, processed_by_id, comment', 'tbl_leave_status', 'leave_id = ?', array($leave_id));
        
    }
    
    public function getLeaveRequests(){
        global $db;
        
        $acc = new StaffAccounts();
       
        
        $table_data = "";
        
        $db->query("SELECT l.*, ls.leave_status FROM tbl_leave_apps as l, tbl_leave_status as ls WHERE l.leave_id = ls.leave_id ORDER BY ls.leave_status DESC");
        
        if($db->found_rows > 0){
            while($row = $db->fetch_assoc()){
                 $emp_info = new EmploymentInfo($row['acc_id']);
                 $depts = new Departments();
                                   
                 $dept = $depts->getDeptName($emp_info->getDept());
                 
                 //$req_status = $row['leave_status'] == 0 ? "PENDING":"TREATED";
                 
                 switch($row['leave_status']){
            case 0 :
                $lv_status = "PENDING";
                break;
            case 1 :
                $lv_status = "APPROVED";
                break;
            case 2 :
                $lv_status = "REJECTED";
                break;
            default;
                break;
        }
                $table_data .= "<tr><td><a href='index.php?section=accounts&action=viewProfile&data=".$row['acc_id']."'>".$acc->getStaffNum($row['acc_id'])."</a></td><td>".$acc->getFullName($row['acc_id'])."</td><td>".$dept."</td><td>".$row['leave_start_date']."</td><td>".$row['leave_end_date']."</td><td>".$lv_status."</td><td><a href='index.php?section=leave&action=manageLeave&data=".$row['leave_id']."'>View Details</a></td></tr>";
            }
            
            return $table_data;
        }else{
            return false;
        }
    }
    
    public function updateLeaveStatus($leave_id, $leave_status, $hr_id, $comment){
        global $db;
        
        $db->update('tbl_leave_status',
                    array(
                        'leave_status' => $leave_status,
                        'processed_by_id' => $hr_id,
                        'comment' => $comment
                    ), 'leave_id = ?', array($leave_id)
                );
    }
}
