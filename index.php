<?php
error_reporting(0); //Disables all error messages, comment out the line to starting seeing any error or warnings
session_start(); //Initialisez session storage

require_once 'utils/db_config.php';

if(isset($_GET['out'])){
    
    //Checks if the user has initiated a Logout
    unset($_SESSION['acc_type']);
    unset($_SESSION['acc_id']);
    unset($_SESSION['staff_num']);
    
    $error = "You have been logged out!";
}

function __autoload($classname) {
    //This is a magic function that helps in loading classes required by the program
    $filename = "classes/". $classname .".php";
    include_once($filename);
}

//The lines below filters the data the systems receives from outside for any issue
$section = filter_input(INPUT_GET, 'section', FILTER_SANITIZE_STRING, array('FILTER_FLAG_NO_ENCODE_QUOTES', 'FILTER_FLAG_STRIP_HIGH') );
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING, array('FILTER_FLAG_NO_ENCODE_QUOTES', 'FILTER_FLAG_STRIP_HIGH') );
$data = filter_input(INPUT_GET, 'data', FILTER_SANITIZE_STRING, array('FILTER_FLAG_NO_ENCODE_QUOTES', 'FILTER_FLAG_STRIP_HIGH') );

if(isset($_POST['formHandler'])){
    //if any form is submitted, pass execution to the form handler controller
    require_once 'controllers/formhandler.php';
    
}else{


//Check if a section is request and serve as appropriate
if(isset($section)){

    if(isset($_SESSION['acc_id'])){ //checks if the user is logged in
        switch($section){
            case 'accounts':
                require_once 'controllers/accounts.php'; //Accounts setion
                break;

            case "requests":
                require_once 'controllers/requests.php'; //Requests Management
                break;

            case "depts":
                require_once 'controllers/depts.php'; //Manage Departments
                break;

            case "employment":
                require_once 'controllers/employment.php'; //Employment Information
                break;

            case "leave":
                require_once 'controllers/leave.php'; //leave Management
                break;

            case "reports":
                require_once 'controllers/reports.php';
                break;

            case "messaging":
                require_once 'controllers/messaging.php'; //Messaging
                break;

            case "dashboard":
                require_once 'views/dashboard.php'; //Dashboard
                break;
            case "script":
                require_once 'controllers/script_handler.php';
                break;
        }
    }else{
        //Unauthoorised access detected
        $error = "Authentication is required!";
        require_once 'views/index.php';
    }
    
}else{
    
    require_once 'views/index.php';
}
}

