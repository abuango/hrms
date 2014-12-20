<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
switch ($action) {
    case 'createRequest':
        require_once 'views/create_request.php';

        break;

    case 'manageRequest':
        require_once 'views/manage_requests.php';

        break;
        
    
    default:
        break;
}
