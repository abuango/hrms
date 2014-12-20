<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
switch ($action) {
    case 'applyLeave':
        require_once 'views/leave_application.php';

        break;

    case 'manageLeave':
        require_once 'views/manage_leave.php';

        break;
        
    
    default:
        break;
}
