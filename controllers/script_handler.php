<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

switch($action){
    case 'lga':
        $utils = new Utilities();
        echo $utils->getLGAs($data);
        break;
    case 'removeQuali':
        $quali = new Qualifications($data);
        echo $quali->deleteQualification($data);
        break;
    case 'removePromo':
        $promo = new Promotions($data);
        echo $promo->deletePromotion($data);
        break;
    
    default:
        
        break;
}

