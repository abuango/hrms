<?php
$account = new StaffAccounts();
switch ($_POST['formHandler']){
    case  'signin':
    //echo 1;
    $login_data = $account->doLogin($_POST['staff_num'], $_POST['password']);
    //echo 3;
    //print_r($login_data);
    if($login_data != false){
        $_SESSION['acc_id'] = $login_data['acc_id'];
        $_SESSION['staff_num'] = $login_data['staff_num'];
        $_SESSION['acc_type'] = $login_data['acc_type'];
        
        header("Location: index.php?section=dashboard");
        
    }else{
        $error = "Invalid Access!";
        //echo $error;
        require_once  "views/index.php";
    }
    
    break;
    
    case 'profile-passport':
        $file = new FileManager("res/uploads/passports/", 100);
        $passport = new Passport( $data);
        //print_r($_FILES);
        if(isset($_FILES['passport']['name'])){
            
           $pport_upload = $file ->uploadfile($_FILES['passport']['tmp_name'], $_FILES['passport']['name'], 'passport_'.$data);
           //echo 1;
           if($pport_upload[0] == true){
               //echo 3;
               $file_id = $file->addFile($data, $pport_upload[1], "Passport Photo graph for ".$data, "PASSPORT");
               //echo 4;
               if($passport->addPassport($file_id) == false){
                   //echo 6;
                   $error = "There was a problem uploading the passport";
                    require_once  "views/updateprofile.php";
               }else{
                   //echo 7;
                   $error = "Upload Successful";
                    require_once  "views/updateprofile.php";
               }
                   
               
           }else{
               echo 5;
               $error = $pport_upload[1];
           }
        }
     
        break;
        
    case 'profile-new_acc':
        if(isset($_POST['staff_num']) AND isset($_POST['new_password']) AND isset($_POST['acc_type'])){
            
            
            $acc_id = $account->createStaff($_POST['staff_num'], $_POST['new_password'], $_POST['acc_type']);
            
            if($acc_id != false){
                header("Location: index.php?section=accounts&action=updateProfile&data=".$acc_id);
            }else{
                $error = "Error Creating Account!";
            }
                    
        }else{
            $error = "Invalid Input parameters";
        }
        
        require_once  "views/updateprofile.php";
        
        break;
        
    case 'profile-new_password':
        
        if(isset($_POST['new_password'])){
           if( $account->resetPassword($data, $_POST['new_password']) == true){
               $error = "Password reset Successful!";
           }else{
               $error = "Something went wrong while updating password, please try again";
           }
        }
        require_once  "views/updateprofile.php";
        break;
        
    case 'profile-acc_type':
        
         if(isset($_POST['acc_type'])){
           if( $account->changeAcctType($data, $_POST['acc_type']) == true){
               $error = "Account Type change Successful!";
           }else{
               $error = "Something went wrong while updating Account type, please try again";
           }
        }else{
            $error = "Invalid Input parameters";
        }
        require_once  "views/updateprofile.php";
        break;
        
    case 'profile-update_biodata':
        
         if(isset($_POST['fname']) AND isset($_POST['mname']) AND isset($_POST['lname']) AND isset($_POST['dob']) AND isset($_POST['sofo']) AND isset($_POST['lga'])){
           if( $account->updateBioData($data, $_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['dob'], $_POST['sofo'], $_POST['lga']) == true){
               $error = "Data Update Successful!";
           }else{
               $error = "Something went wrong while updating Bio Data, please try again";
           }
        }else{
            $error = "Invalid input parameters";
        }
        require_once  "views/updateprofile.php";
        break;
        
    case 'profile-update_nok':
        
        $nok = new NextOfKin($data);
        if($nok->getNOK() == false){
            if(isset($_POST['nok_fullname']) AND isset($_POST['nok_address']) AND isset($_POST['nok_phone']) AND isset($_POST['nok_email'])){
               if($nok->createNOK($_POST['nok_fullname'], $_POST['nok_address'], $_POST['nok_phone'], $_POST['nok_email']) == true){
                   $error = "Next of Kin Data Added!";
               }  else {
                   $error = "Something went wrong while updating Next of Kin Data, please try again";
               }
            }else{
                $error = "Required data were not filled properly";
            }
        }else{
            if(isset($_POST['nok_fullname']) AND isset($_POST['nok_address']) AND isset($_POST['nok_phone']) AND isset($_POST['nok_email'])){
               if($nok->updateNOK($_POST['nok_fullname'], $_POST['nok_address'], $_POST['nok_phone'], $_POST['nok_email']) == true){
                   $error = "Next of Kin Data updated!";
               }  else {
                   $error = "Something went wrong while updating Next of Kin Data, please try again";
               }
            }else{
                $error = "Required data were not filled properly";
            }
        }
        require_once  "views/updateprofile.php";
        break;
    
    case 'profile-update_contact_info':
        
        $contact = new ContactAddress($data);
        
        if($contact->getAddress() == false){
            if(isset($_POST['contact_address']) AND isset($_POST['perm_address']) AND isset($_POST['pri_phone']) AND isset($_POST['other_phone']) AND isset($_POST['pri_email']) AND isset($_POST['other_email'])){
               if($contact->createContactAddress($_POST['contact_address'], $_POST['perm_address'], $_POST['pri_phone'], $_POST['other_phone'], $_POST['pri_email'], $_POST['other_email']) === true){
                   $error = "Contact Information updated!";
               }  else {
                   $error = "Something went wrong while updating Contact Information , please try again";
               }
            }else{
                $error = "Required data were not filled properly";
            }
        }else{
            if(isset($_POST['contact_address']) AND isset($_POST['perm_address']) AND isset($_POST['pri_phone']) AND isset($_POST['other_phone']) AND isset($_POST['pri_email']) AND isset($_POST['other_email'])){
               if($contact->updateAddresses($_POST['contact_address'], $_POST['perm_address'])  === true AND $contact->updatePhoneNumbers($_POST['pri_phone'], $_POST['other_phone'])  === true AND $contact->updateEmails($_POST['pri_email'], $_POST['other_email']) === true){
                   $error = "Contact Information updated!";
               }  else {
                   $error = "Something went wrong while updating Contact Information , please try again";
               }
            }else{
                $error = "Required data were not filled properly";
            }
        }
        require_once  "views/updateprofile.php";
        break;
    
    case 'profile-add_quali':
        
        $quali = new Qualifications($data);
        
        if(isset($_POST['institution']) AND isset($_POST['course']) AND isset($_POST['yr_entry']) AND isset($_POST['yr_completion']) AND isset($_POST['quali_obtained'])){
            if($quali->addQualification($_POST['institution'], $_POST['course'], $_POST['yr_entry'], $_POST['yr_completion'], $_POST['quali_obtained']) === true){
                $error = "Qualification added successfully";
            }else{
                $error = "Something went wrong while adding Qualification , please try again";
            }
        }else{
                $error = "Required data were not filled properly";
            }
        require_once  "views/updateprofile.php";
        break;
        
        
    case 'profile-add_promo':
        //echo 2;
        $promo = new Promotions($data);
        $emp_info = new EmploymentInfo($data);
        //echo 3;
        if(isset($_POST['new_level']) AND isset($_POST['new_step'])){
            $dt = date("Y-m-d");
            //echo $dt;
            //echo 1;
            if($promo->addPromotion($dt, $emp_info->getGradeLevel(), $emp_info->getStep(), $_POST['new_level'], $_POST['new_step']) == false){
                $error = "Something went wrong while adding the promotion, please try again";
            }else{
                $error = "Promotion added successfully";
                
                $emp_info->setGradeLevel($_POST['new_level']);
                $emp_info->setStep($_POST['new_step']);
            }
        }else{
            $error = "Incomplete Entry, please try again";
        }
        
        require_once  "views/updateprofile.php";
        
        break;
        
    case 'profile-update_employment_info':
        
        $emp_info = new EmploymentInfo($data);
        
        if(isset($_POST['grade_level']) AND isset($_POST['step']) AND isset($_POST['emp_date']) AND isset($_POST['last_promo_date']) AND isset($_POST['dept'])){
            if($emp_info->getStep() == false){
                if($emp_info->createEmploymentInfo($_POST['emp_date'], $_POST['last_promo_date'], $_POST['grade_level'], $_POST['step'], $_POST['dept'] ) == false){
                    $error = "Employment Information successfully added";
                }else{
                    $error = "Error adding employment information";
                }
            }else{
                if($emp_info->updateEmploymentInfo($_POST['emp_date'], $_POST['last_promo_date'], $_POST['grade_level'], $_POST['step'], $_POST['dept'] ) != false){
                    $error = "Employment Information successfully updated";
                }else{
                    $error = "Error updating employment information";
                }
            }
        }
        
        require_once  "views/updateprofile.php";
        
        break;
        
    case 'create-request':
        
        $file = new FileManager("res/uploads/attachments/", 2048);
        $req = new Requests($_SESSION['acc_id']);
        
        //print_r($_FILES);
        if(isset($_FILES['request_attachment']['name']) AND isset($_POST['request_details'])){
            
           $attach_upload = $file ->uploadfile($_FILES['request_attachment']['tmp_name'], $_FILES['request_attachment']['name'], 'attachment_'.$_SESSION['acc_id'].'_'.microtime(true));
           //echo 1;
           if($attach_upload[0] == true){
               //echo 3;
               $file_id = $file->addFile($_SESSION['acc_id'], $attach_upload[1], "Request Attachment ", "ATTACHMENT");
               
              if( $req->createRequest(date('Y-m-d'), $_POST['request_details'], $file_id ) === false){
                  $error = "Error creating request, please try again";
              }else{
                  $error = "Request submitted successfully";
              }
               
           }else{
               //echo 5;
               $error = $attach_upload[1];
           }
        }
        
        require_once 'views/create_request.php';
        
        break;
        
    case 'request-status-update':
        
        $req = new Requests($data);
        
        if(isset($_POST['req_comment']) AND isset($_POST['req_status'])){
            if($req->updateRequestStatus($data, $_POST['req_status'], $_SESSION['acc_id'], $_POST['req_comment']) === FALSE){
                $error = "Problem encountered while updating Request Status";
            }else{
                $error = "Status Update Successful";
            }
        }
        
        require_once 'views/manage_requests.php';
        break;
        
    case 'leave-status-update':
        
        $lv = new Leave($data);
        
        if(isset($_POST['lv_comment']) AND isset($_POST['lv_status'])){
            if($lv->updateLeaveStatus($data, $_POST['lv_status'], $_SESSION['acc_id'], $_POST['lv_comment']) === FALSE){
                $error = "Problem encountered while updating Leave Status";
            }else{
                $error = "Status Update Successful";
            }
        }
        
        require_once 'views/manage_leave.php';
        break;
        
    case 'leave-apply':
        
        $lv = new Leave($_SESSION['acc_id']);
        
        if(isset($_POST['leave_startdate']) AND isset($_POST['leave_enddate']) AND isset($_POST['leave_details'])){
           if( $lv->createLeaveRequest($_POST['leave_startdate'], $_POST['leave_enddate'], $_POST['leave_details']) == false){
               $error = "Error creating Leave Request";
           }else{
               $error = "Leave Request submitted";
           }
        }else{
            $error = "Incomplete entries!";
        }
        
        require_once 'views/leave_application.php';
        break;
        
        
    case 'profile-update_dept_info':
        
        $depts = new Departments();
        
        if(isset($_POST['dept'])){
           if($depts->setHOD($_POST['dept'], $data) == false){
               $error = "Something went wrong, please try again!";
           }else{
               $error = "Staff has been assigned HOD";
           }
        }
        
        break;
        
    case 'add-dept':
        
        $depts = new Departments();
        
        if(isset($_POST['dept_name']) AND isset($_POST['location']) AND isset($_POST['other_details'])){
            if($depts->addDept($_POST['dept_name'], $_POST['other_details'], $_POST['location']) == false){
                $error = "Error adding department";
            }else{
                $error = "Department added!";
            }
        }else{
            $error = "Incomplete entry";
        }
        require_once "views/manage_dept.php";
        break;
        
    case 'edit-dept':
        
        $depts = new Departments();
        
        if(isset($_POST['dept_name']) AND isset($_POST['location']) AND isset($_POST['other_details'])){
            if($depts->updateDept($data, $_POST['dept_name'], $_POST['other_details'], $_POST['location']) == false){
                $error = "Error updating department";
            }else{
                $error = "Department updated!";
            }
        }else{
            $error = "Incomplete entry";
        }
        
        require_once "views/manage_dept.php";
        
        break;
        
    case 'searchUsers':
        
        if(isset($_POST['searchQ']) AND $_POST['dept'] == 'All'){
          //echo 1;
            $searchResult = $account->searchUsers($_POST['searchQ']);
            
        }else if(isset($_POST['searchQ']) AND $_POST['dept'] != 'All'){
          //echo 2;
            $searchResult = $account->searchUsers($_POST['searchQ'], $_POST['dept'] );
        }else{
            $error = "User Not found!";
        }
        
        require_once 'views/search_users.php';
        break;
        
    default:
        require_once "views/dashboard.php";
        break;
}
