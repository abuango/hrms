<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

 <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="index.php?section=dashboard">Dashboard</a></li>
            
            
            <li><a href="index.php?section=accounts&action=viewProfile&data=<?php echo $_SESSION['acc_id']; ?>">Your Profile</a></li>
            <li><a href="index.php?section=requests&action=createRequest">Update Request</a></li>
            <li><a href="index.php?section=leave&action=applyLeave">Leave Application</a></li>
            <?php if($_SESSION['acc_type'] == 2){ ?>
            <hr/>
            <li><a href="index.php?section=leave&action=manageLeave">Manage Leave Applications</a></li>
            <?php }  if($_SESSION['acc_type'] == 3){ ?>
            <hr/>
            <li><a href="index.php?section=requests&action=manageRequest">Manage Update Requests</a></li>
            <li><a href="index.php?section=accounts&action=updateProfile&data=add_staff">Add Staff</a></li>
            <li><a href="index.php?section=accounts&action=searchStaff">Staff List</a></li>
            <li><a href="index.php?section=depts">Manage Departments</a></li>
            
            <?php } ?>
            <hr/>
           
          </ul>
        
     <div style="bottom: 40px">
         
         <hr/>
         <div style="text-align: center">&copy; 2014 <p style="font-style: italic" >Maryam Muhammad Lawal<br> (09/22536/U/1)</p> B.Tech Computer Sci, Mathematics Programme, Abubakar Tafawa Balewa University</div>
         
     </div>
        </div>
