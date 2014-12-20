<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$staff = new StaffAccounts();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ATBU HRMS</title>
    <script type="text/javascript" src="res/js/jquery-1.11.1.min.js" ></script>
    <!-- Bootstrap -->
    <link href="res/css/bootstrap.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="res/css/dashboard.css" rel="stylesheet">

  </head>
  <body>


    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          
            <a class="navbar-brand" style="color: #fff" href="#">ATBU HRMS</a>
        </div>
          <div class="navbar-right" style="padding:3px;">
              <span class="glyphicon glyphicon-user"></span>  -  Hello <?php echo $staff->getFullName($_SESSION['acc_id']); ?> &nbsp; <a href="index.php?out=1" class="btn btn-danger" >Logout</a>
          </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
