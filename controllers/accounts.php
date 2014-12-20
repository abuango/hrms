<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

switch ($action) {
    case 'createUser':
        require_once 'views/createuser.php';
        break;

    case 'viewProfile':
        require_once 'views/viewprofile.php';
        break;
        
    case 'updateProfile':
        require_once 'views/updateprofile.php';
        break;
    
    case 'passReset':
        require_once 'views/viewprofile.php';
        break;
    
    case 'viewLogs':
        require_once 'views/viewlogs.php';
        break;
    
    case 'searchStaff':
        require_once 'views/search_users.php';
        break;
    
    default:
        break;
}

