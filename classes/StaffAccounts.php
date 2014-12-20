<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class StaffAccounts{
    
    public function createStaff($staff_num, $password, $acc_type){
        global $db;
        
        $status = $db->insert('tbl_account',
                    array(
                        'staff_num' => $staff_num,
                        'password' => md5($password),
                        'acc_type' => $acc_type
                    )
                );
        if($status == true){
            return $db->insert_id();
        }else{
            return false;
        }
        
        
    }
    
    public function deleteStaff($acc_id){
        global $db;
        
        return $db->delete('tbl_account', 'acc_id = ?', array($acc_id));
        
    }
    
    public function changeStaffNum($acc_id, $new_staffnum){
        global $db;
        
        $status = $db->update('tbl_account', array('staff_num' => $new_staffnum), 'acc_id = ?', array($acc_id));
        
        return $status;
    }
    
    public function resetPassword($acc_id, $newpassword){
        global $db;
        //$hashed_pass = 
        $status = $db->update('tbl_account', array('password' => md5($newpassword)), 'acc_id = ?', array($acc_id));
        
        return $status;
    }
    
    public function changeAcctType($acc_id, $acc_type){
        global $db;
        
        $status = $db->update('tbl_account', array('acc_type' => $acc_type), 'acc_id = ?', array($acc_id));
        
        return $status;
    }
    
    public function getAcctType($acc_id){
        global $db;
        
        return $db->dlookup('acc_type', 'tbl_account', 'acc_id = ?', array($acc_id));
    }
    
    public function getAcctTypeOptions($acc_id = false){
        $options = "";
        
       $o1 = $acc_id == 1 ? "selected='selected'" : "";
       $o2 = $acc_id == 2 ? "selected='selected'" : "";
       $o3 = $acc_id == 3 ? "selected='selected'" : "";
        
        $options .= "<option value = '1' " . $o1 ." >Staff</option>"
                . "<option value = '2' " . $o2 .">HOD</option>"
                . "<option value = '3' " . $o3 .">HR</option>";
        return $options;
    }
    
    public function doLogin($staffnum, $password){
        global $db;
        //echo 1.5;
        $data = $db->dlookup('acc_id, staff_num, acc_type', 'tbl_account', 'staff_num = ? AND password = ?', array($staffnum, md5($password)));
        //echo 2;
        return $data;
    }
    
    public function getFullName($acc_id){
        global $db;
        
        $fullname = $db->dlookup('bio_fname, bio_mname, bio_lname', 'tbl_bio_data', 'acc_id = ?', array($acc_id));
        
        return $fullname['bio_lname'].', '.$fullname['bio_fname'].' '.$fullname['bio_mname'];
        
    }
    
    public function getFirstName($acc_id){
        global $db;
        
       return $db->dlookup('bio_fname', 'tbl_bio_data', 'acc_id = ?', array($acc_id));        
    }
    
    public function getMiddleName($acc_id){
        global $db;
        
       return $db->dlookup('bio_lname', 'tbl_bio_data', 'acc_id = ?', array($acc_id));        
    }
    
    public function getLastName($acc_id){
        global $db;
        
       return $db->dlookup('bio_mname', 'tbl_bio_data', 'acc_id = ?', array($acc_id));        
    }
    
    public function getDOB($acc_id){
        global $db;
        
        return $db->dlookup('bio_dob', 'tbl_bio_data', 'acc_id = ?', array($acc_id));
    }
    
    public function getSOFO($acc_id){
        global $db;
        
        return $db->dlookup('bio_sofo', 'tbl_bio_data', 'acc_id = ?', array($acc_id));
    }
    
    public function getLGA($acc_id){
        global $db;
        
        return $db->dlookup('bio_lga', 'tbl_bio_data', 'acc_id = ?', array($acc_id));
    }
    
    public function getStaffNum($acc_id){
         global $db;
         return $db->dlookup('staff_num', 'tbl_account', 'acc_id = ?', array($acc_id));
    }
    
    public function updateBioData($acc_id, $fname, $mname, $lname,  $dob, $sofo, $lga){
        global $db;
        
        if($db->dlookup('acc_id', 'tbl_bio_data', 'acc_id = ?', array($acc_id) ) == false){
            return $db->insert(
                'tbl_bio_data', 
                array(
                    'acc_id' => $acc_id,
                    'bio_fname' => $fname,
                    'bio_mname' => $mname,
                    'bio_lname' => $lname,
                    'bio_dob' => $dob,
                    'bio_sofo' => $sofo,
                    'bio_lga' => $lga
                )
                );
        }else{
             return $db->update(
                'tbl_bio_data', 
                array(
                    'bio_fname' => $fname,
                    'bio_mname' => $mname,
                    'bio_lname' => $lname,
                    'bio_dob' => $dob,
                    'bio_sofo' => $sofo,
                    'bio_lga' => $lga
                ),
                'acc_id = ?', array($acc_id)
                );
        }
        
       
    }
    
    
    public function searchUsers($query, $dept_id = false){
        global $db;
        $dept = new Departments();
       
        if($dept_id == false){
            $db->query("SELECT a.acc_id, a.staff_num, a.acc_type FROM tbl_account as a, tbl_bio_data as bd WHERE a.acc_id = bd.acc_id AND( a.staff_num LIKE '%".$query."%' OR bd.bio_fname LIKE '%".$query."%' OR bd.bio_mname LIKE '%".$query."%' OR bd.bio_lname LIKE '%".$query."%')");
        }else{
            $db->query("SELECT a.acc_id, a.staff_num, a.acc_type FROM tbl_account as a, tbl_bio_data as bd, tbl_employment_info as emp WHERE a.acc_id = bd.acc_id AND a.acc_id = emp.acc_id AND (a.staff_num LIKE '%".$query."%' OR bd.bio_fname LIKE '%".$query."%' OR bd.bio_mname LIKE '%".$query."%' OR bd.bio_lname LIKE '%".$query."%') AND emp.emp_dept_id = ".$dept_id);
        }
        
        if($db->found_rows > 0){
            $rows = $db->fetch_assoc_all();
            $n = 1;
            $output_data = "";
            foreach($rows as $row){
                $passport = new Passport($row['acc_id']);
                 $emp = new EmploymentInfo($row['acc_id']);
                 //echo $dept->getDeptName($emp->getDept());
                $output_data .= "<tr><td>".$n++."</td><td><img src='".$passport->getPassport($row['acc_id'])."' width='100px' height='100px' /></td><td><a href='index.php?section=accounts&action=viewProfile&data=".$row['acc_id']."'>".$row['staff_num']."</a></td><td>".$this->getFullName($row['acc_id'])."</td><td>".$row['acc_type']."</td><td>".$dept->getDeptName($emp->getDept())."</td><td>".$emp->getGradeLevel()."</td><td>".$emp->getStep()."</td></tr>";
            }
        }else{
            return "No result found!";
        }
        
        return $output_data;
    }
    
    
    
    
}
