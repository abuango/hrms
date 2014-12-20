<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Requests
 *
 * @author abuango
 */
class Requests {
    //put your code here
    
    public $acc_id;
    
    public function __construct($acc_id) {
        $this->acc_id = $acc_id;
    }
    
    public function createRequest($req_date, $req_details, $req_file_id = 0){
        global $db;
        
        $status = $db->insert('tbl_requests',
                    array(
                        'acc_id' => $this->acc_id,
                        'req_date' => $req_date,
                        'req_details' => $req_details,
                        'req_file_id' => $req_file_id
                    )
                );
        if($status == true){
            
            $db->insert('tbl_req_status', array(
                'req_id' => $db->insert_id(),
                'req_status' => 0
            ));
            
            return true;
        }else{
            return false;
        }
    }
    
    public function updateRequest($req_id, $req_date, $req_details, $req_file_id = 0){
        global $db;
        
        $status = $db->update('tbl_requests',
                    array(
                        'req_date' => $req_date,
                        'req_details' => $req_details,
                        'req_file_id' => $req_file_id
                    ), 'acc_id = ? AND req_id = ?', array($this->acc_id, $req_id)
                );
        if($status == true){
            return true;
        }else{
            return false;
        }
    }
    
    public function deleteRequest($req_id){
        global $db;
        
        return $db->delete('tbl_requests', 'leave_id = ?', array($req_id));
    }
    
    public function getRequest($req_id){
        global $db;
        
        return $db->dlookup('req_date, req_details, req_file_id','tbl_requests', 'req_id = ?', array($req_id));
    }
    
    public function getUpdateRequests(){
        global $db;
        
        return $db->dlookup('req_date, req_details, req_file_id','tbl_requests', 'acc_id = ?', array($this->acc_id));
    }
    
    public function getRequestStatus($req_id){
        global $db;
        
        return $db->dlookup('req_status, processed_by_id, comment', 'tbl_req_status', 'req_id = ?', array($req_id));
        
    }
    
    public function getRequests(){
        global $db;
        
        $acc = new StaffAccounts();
       
        
        $table_data = "";
        
        $db->query("SELECT r.*, rs.req_status FROM tbl_requests as r, tbl_req_status as rs WHERE r.req_id = rs.req_id ORDER BY rs.req_status DESC");
        
        if($db->found_rows > 0){
            
            while($row = $db->fetch_assoc()){
                 $emp_info = new EmploymentInfo($row['acc_id']);
                 $depts = new Departments();
                                   
                 $dept = $depts->getDeptName($emp_info->getDept());
                 
                 $req_status = $row['req_status'] == 0 ? "PENDING":"TREATED";
                $table_data .= "<tr><td><a href='index.php?section=accounts&action=viewProfile&data=".$row['acc_id']."'>".$acc->getStaffNum($row['acc_id'])."</a></td><td>".$acc->getFullName($row['acc_id'])."</td><td>".$dept."</td><td>".$row['req_date']."</td><td>".$req_status."</td><td><a href='index.php?section=requests&action=manageRequest&data=".$row['req_id']."'>View Details</a></td></tr>";
            }
            
            return $table_data;
        }else{
            return false;
        }
    }
    
    
    public function updateRequestStatus($req_id, $req_status, $hr_id, $comment){
        global $db;
        
        $db->update('tbl_req_status',
                    array(
                        'req_status' => $req_status,
                        'processed_by_id' => $hr_id,
                        'comment' => $comment
                    ), 'req_id = ?', array($req_id)
                );
    }
}
