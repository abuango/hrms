<?php

require_once 'views/header.php';
require_once 'views/nav.php';

$passport = new Passport($data);
$utils = new Utilities();
?>


       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Update User Profile</h1> 
          <p style=" display: <?php echo isset($error)? 'block':'none'; ?> ; margin:2px; padding: 3px; border:dashed 1px red; text-align: center; color: red"><?php echo $error; ?></p>
           
            <div class="row">
                <div class="col-md-3">
                    
                        <div class="panel panel-primary update-section">
                            <div class="panel-heading">Passport Photograph </div>
                            <div class="panel-body" style="text-align: center">
                                
                                <img class="img-responsive img-circle"  data-src="holder.js/300x300" width="300px" height="300px" src="<?php echo $passport->getPassport($data); ?>" alt="...">
                               
                                <hr/>
                                <p>Change Passport</p>
                                <form class="form" action="" method="POST" enctype="multipart/form-data">
                                    <input type="file" name="passport" > 
                                    <input type ="hidden" name="formHandler" value="profile-passport" />
                                    <input type="submit" name="submit" value="Upload" />
                                </form>
                                
                            </div>
                           
                        </div>
                    
                    
                  
                            
                         
                </div>
                
                <div class="col-md-9">
                   <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Account Details </div>
                            <div class="panel-body">
                                <?php
                                    $account = new StaffAccounts();
                                ?>
                                <form id = 'new-staff' style="display: none" class="form" action="" method="POST" enctype="text/multi-part">   
                                <table class="table table-striped">
                                    
                                    <tr>
                                        <td>Staff Number</td>
                                        <td>
                                            <input type="text" name="staff_num" value="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>
                                           
                                                <input type="password" name="new_password" />
                                                
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Account type</td>
                                        <td>
                                           
                                                <select name="acc_type" >
                                                   <?php echo $account->getAcctTypeOptions(); ?>
                                                </select>
                                               
                                        </td>
                                    </tr>
                                    
                                </table>
                                 <input type ="hidden" name="formHandler" value="profile-new_acc" />
                               <input type="submit" name="submit" value="Add New staff" />
                               </form>
                                    
                                <table id="acc_update" class="table table-striped update-section">
                                    <tr>
                                        <td>Staff Number</td>
                                        <td><?php echo $account->getStaffNum($data); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>
                                            <form class="form" action="" method="POST" enctype="text/multi-part">
                                                <input type="password" name="new_password" />
                                                <input type ="hidden" name="formHandler" value="profile-new_password" />
                                                <input type="submit" name="submit" value="Change" />
                                            </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Account type</td>
                                        <td>
                                            <form class="form" action="" method="POST" enctype="text/multi-part">
                                                <select name="acc_type" >
                                                    <?php echo $account->getAcctTypeOptions($account->getAcctType($data)); ?>
                                                </select>
                                                <input type ="hidden" name="formHandler" value="profile-acc_type" />
                                                <input type="submit" name="submit" value="Change" />
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                                
                                
                            </div>
                           
                          </div>
                        
                    
                    </div>
                
                
                    <div class="col-md-6">

                           <div class="panel panel-primary update-section">
                               <div class="panel-heading">Bio Data </div>
                               <div class="panel-body">
                                   <form style="display: block" class="form" action="" method="POST" enctype="text/multi-part">   
                                   <table class="table table-striped">
                                       <tr>
                                           <td>
                                               First Name
                                           </td>
                                           <td>
                                               <input type="text" name="fname" value="<?php echo $account->getFirstName($data); ?>" />
                                           </td>
                                       </tr>
                                       <tr>
                                           <td>
                                               Middle Name
                                           </td>
                                           <td>
                                               <input type="text" name="mname" value="<?php echo $account->getMiddleName($data); ?>" />
                                           </td>
                                       </tr>
                                       <tr>
                                           <td>
                                               Last Name
                                           </td>
                                           <td>
                                               <input type="text" name="lname" value="<?php echo $account->getLastName($data); ?>" />
                                           </td>
                                       </tr>
                                       <tr>
                                           <td>
                                               Date of Birth
                                           </td>
                                           <td>
                                               <input type="text" name="dob" value="<?php echo $account->getDOB($data); ?>" />
                                           </td>
                                       </tr>
                                       
                                       <tr>
                                           <td>
                                               State of Origin
                                           </td>
                                           <td>
                                               <select id="sofo" name="sofo">
                                                   <?php 
                                                        echo $utils->getStates($account->getSOFO($data)); 
                                                   ?>
                                               </select>
                                           </td>
                                       </tr>
                                       
                                       <tr>
                                           <td>
                                               LGA
                                           </td>
                                           <td>
                                               <select id="lga" name="lga">
                                                    <?php echo $utils->getLGAs($account->getSOFO($data), $account->getLGA($data)); ?>
                                               </select>
                                           </td>
                                       </tr>
                                   </table>
                                   <input type="submit" value="Update Bio-Data" />
                                   <input type ="hidden" name="formHandler" value="profile-update_biodata" />
                                   </form>
                               </div>

                             </div>


                   </div>
                    
                    <div class="col-md-6">
                        <div class="panel panel-primary update-section">
                            <div class="panel-heading">Next of Kin </div>
                            <div class="panel-body">
                                <?php
                                    $nok = new NextOfKin($data);
                                ?>
                                <form style="display: block" class="form" action="" method="POST" enctype="text/multi-part">   
                                <table class="table table-striped">
                                    <tr>
                                        <td>Fullname</td>
                                        <td><input type="text" name="nok_fullname" value="<?php echo $nok->getNOKName($data); ?>" ></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><input type="text" name="nok_address" value="<?php echo $nok->getNOKAddress($data); ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><input type="text" name="nok_phone" value="<?php echo $nok->getNOKPhone($data); ?>" ></td>
                                    </tr>
                                    <tr>
                                        <td>Email Address</td>
                                        <td><input type="text" name="nok_email" value="<?php echo $nok->getNOKEmail($data); ?>"></td>
                                    </tr>
                                </table>
                                    <input type="submit" value="Update Next Of Kin" />
                                   <input type ="hidden" name="formHandler" value="profile-update_nok" />
                                   </form>
                            </div>
                           
                          </div>
                        
                    
                    </div>
                
                
                    <div class="col-md-6">

                           <div class="panel panel-primary update-section">
                               <div class="panel-heading">Contact Information </div>
                               <div class="panel-body">
                                   
                                   <?php
                                        $contact = new ContactAddress($data);
                                        $addresses = $contact->getAddress();
                                        $phones = $contact->getPhones();
                                        $emails = $contact->getEmails();
                                    ?>
                                   
                                   <form style="display: block" class="form" action="" method="POST" enctype="text/multi-part">   
                                   <table class="table table-striped">
                                       <tr>
                                           <td>Contact Address</td>
                                           <td>
                                               <textarea name="contact_address"><?php echo $addresses['contact_address']; ?></textarea>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td>Permanent Address</td>
                                           <td>
                                               <textarea name="perm_address"><?php echo $addresses['permanent_address']; ?></textarea>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td>Primary Phone No.</td>
                                           <td><input type="text" name="pri_phone" value="<?php echo $phones['pri_phone_num']; ?>"></td>
                                       </tr>
                                       <tr>
                                           <td>Other Phone No.</td>
                                           <td><input type="text" name="other_phone" value="<?php echo $phones['other_phone_num']; ?>"></td>
                                       </tr>
                                       <tr>
                                           <td>Primary Email</td>
                                           <td><input type="text" name="pri_email" value="<?php echo $emails['pri_email_address']; ?>"></td>
                                       </tr>
                                       <tr>
                                           <td>Other Email</td>
                                           <td><input type="text" name="other_email" value="<?php echo $emails['other_email_address']; ?>"></td>
                                       </tr>
                                       
                                     </table>
                                   
                                    <input type="submit" value="Update Contact Information" />
                                   <input type ="hidden" name="formHandler" value="profile-update_contact_info" />
                                   </form>
                               </div>

                             </div>


                   </div>
                    
                    
                    <div class="col-md-6 update-section">

                           <div class="panel panel-primary">
                               <div class="panel-heading">Employment Information <span class="glyphicon glyphicon-pencil pull-right" title="Edit"></span></div>
                              <div class="panel-body">
                                  <form style="display: block" class="form" action="" method="POST" enctype="text/multi-part">   
                              
                                   <?php
                                   
                                   $emp_info = new EmploymentInfo($data);
                                   $depts = new Departments();
                                   
                                   $dept = $utils->getDepts($emp_info->getDept());
                                   $emp_dates = $emp_info->getEmpDates();
                                   ?>
                                   
                                   <table class="table table-striped">
                                       <tr><td style="">Grade Level</td><td><input name="grade_level" value="<?php echo $emp_info->getGradeLevel(); ?>" /></td></tr>
                                       <tr><td>Step</td><td><input name="step" value="<?php echo $emp_info->getStep(); ?>" /></td></tr>
                                       <tr><td>Employment Date</td><td><input name="emp_date" value="<?php echo $emp_dates['emp_date']; ?>" /></td></tr>
                                       <tr><td>Last Promotion Date</td><td><input name="last_promo_date" value="<?php echo $emp_dates['emp_last_promo_date']; ?>" /></td></tr>
                                       <tr><td>Department</td><td><select name="dept" > <?php echo $dept; ?> </select></td></tr>
                                       
                                     </table>
                                   
                                   <input type="submit" value="Update Employment Information" />
                                   <input type ="hidden" name="formHandler" value="profile-update_employment_info" />
                                   </form>
                               </div>

                             </div>


                   </div>
                    
                    <div class="col-md-6 update-section">

                           <div class="panel panel-primary">
                               <div class="panel-heading">Assign HOD Role <span class="glyphicon glyphicon-pencil pull-right" title="Edit"></span></div>
                              <div class="panel-body">
                                  <form style="display: block" class="form" action="" method="POST" enctype="text/multi-part">   
                              
                                   <?php
                                   
                                  
                                   $depts = new Departments();
                                   
                                   $dept = $utils->getDepts($depts->getDeptByHOD($data));
                                  
                                   ?>
                                   
                                   <table class="table table-striped">
                                       
                                       <tr><td>Department</td><td><select name="dept" > <?php echo $dept; ?> </select></td></tr>
                                       
                                     </table>
                                   
                                   <input type="submit" value="Update Department Information" />
                                   <input type ="hidden" name="formHandler" value="profile-update_dept_info" />
                                   </form>
                               </div>

                             </div>


                   </div>
                    
                    <div class="col-md-12">

                           <div class="panel panel-primary update-section">
                               <div class="panel-heading">Qualifications <span class="glyphicon glyphicon-plus-sign pull-right" style="" id="add-quali" title="Add">Add Qualification</span></div>
                               
                               <div class="panel-body">
                                   <form style="display: none" id="add-quali-form" class="form" action="" method="POST" enctype="text/multi-part">   
                                       <table class="table table-striped">
                                        <tr>
                                           <td>Institution</td>
                                           <td><input type="text" name="institution" ></td>
                                       </tr>
                                       <tr>
                                           <td>Course</td>
                                           <td><input type="text" name="course" ></td>
                                       </tr>
                                       <tr>
                                           <td>Year of Entry</td>
                                           <td><input type="text" name="yr_entry" ></td>
                                       </tr>
                                       <tr>
                                           <td>Year of Completion</td>
                                           <td><input type="text" name="yr_completion" ></td>
                                       </tr>
                                       <tr>
                                           <td>Qualification obtained</td>
                                           <td><input type="text" name="quali_obtained" ></td>
                                       </tr>
                                   </table>
                                   
                                       <input type="submit" value="Add Qualification" />  <a  id="hide-quali-form">Hide Form</a>
                                   <input type ="hidden" name="formHandler" value="profile-add_quali" />
                               </form>
                                   <?php 
                                        $quali = new Qualifications($data);
                                                
                                   ?>
                                   <table class="table table-striped">
                                       <thead>
                                           <th>Institution</th>
                                           <th>Course</th>
                                           <th>Year of Entry</th>
                                           <th>Year of Completion</th>
                                           <th>Qualification Obtained</th>
                                       </thead>
                                       <tbody>
                                           <?php echo $quali->getStaffQualifications(); ?>
                                       </tbody>
                                   </table>
                               </div>

                             </div>
                        
                        <div class="col-md-12 update-section">

                           <div class="panel panel-primary">
                               <div class="panel-heading">Promotions <span class="glyphicon glyphicon-plus-sign pull-right" id="add-promo" title="Add"> Add Promotion</span> </div>
                               <div class="panel-body">
                                   
                                   <form style="display: none" id="add-promo-form" class="form" action="" method="POST" enctype="text/multi-part">   
                                       <table class="table table-striped">
                                        
                                       <tr>
                                           <td>New Level</td>
                                           <td><input type="text" name="new_level" ></td>
                                       </tr>
                                       <tr>
                                           <td>New Step</td>
                                           <td><input type="text" name="new_step" ></td>
                                       </tr>
                                   </table>
                                   
                                       <input type="submit" value="Add Promotion" />  <a  id="hide-promo-form">Hide Form</a>
                                   <input type ="hidden" name="formHandler" value="profile-add_promo" />
                               </form>
                                   
                                   <?php
                                    $promos = new Promotions($data);
                                    $promo = $promos->getStaffPromotions();
                                    if($promo != false){
                                        if(is_array($promo[0]) == true){
                                            $output_data = "<tr><td>Promotion Date</td><td>Previous Level</td><td>Previous Step</td><td>New Level</td><td>New Step</td><td></td></tr>";
                                            foreach($promo as $p){
                                                $output_data .= "<tr><td>".$p['promo_date']."</td><td>".$p['promo_prev_level']."</td><td>".$p['promo_prev_step']."</td><td>".$p['promo_new_level']."</td><td>".$p['promo_new_step']."</td><td><a id = '".$p['promo_id']."' class = 'removePromo' >Remove</a></td></tr>";
                                            }
                                        }else{
                                            $p = $promo;
                                           $output_data .= "<tr><td>".$p['promo_date']."</td><td>".$p['promo_prev_level']."</td><td>".$p['promo_prev_step']."</td><td>".$p['promo_new_level']."</td><td>".$p['promo_new_step']."</td><td><a id = '".$row['promo_id']."' class = 'removePromo' >Remove</a></td></tr>";
                                        }
                                    }  else {
                                        $output_data = "No Promotions.";
                                    }

                                    ?>
                                   <table class="table table-striped">
                                       <?php echo $output_data; ?>
                                     </table>
                               </div>

                             </div>


                   </div>


                   </div>
                    
                    
                </div>
                
            </div>
          
          
        </div>
<script type="text/javascript">
    $(document).ready(function(){
       <?php if($data === 'add_staff') {
           echo 'var newstaff = 1;';
       } else{
           echo 'var newstaff = 0;';
       } ?> 
               //alert(1);
               if(newstaff === 0){
                   
                   $('.update-section').show();
                   $('#new-staff').hide();
               }else{
                   $('.update-section').hide();
                   $('#new-staff').show();
               }
               
               $('#add-quali').click(function(){                 
                    
                         $('#add-quali-form').show();
                   
                  });
                  
                  $('#hide-quali-form').click(function(){                 
                    
                         $('#add-quali-form').hide();
                   
                  });
                  
                  $('#add-promo').click(function(){                 
                    
                         $('#add-promo-form').show();
                   
                  });
                  
                  $('#hide-promo-form').click(function(){                 
                    
                         $('#add-promo-form').hide();
                   
                  });
              
               
               $('#sofo').change(function(){
                   var url = "index.php?section=script&action=lga&data="+$('#sofo').val();
                  // alert(url);
                   $.ajax({
                                           type: "POST",
                                           //dataType: "json",
                                           url: url,
                                           //data: params,
                                           success: function( data ) {
                                               //alert(data);
                                            $('#lga').empty().append(data);

                                              },
                                           complete: function (xObj, status){
                                                 
                                                 
                                           },
                                           error: function (x, status, error){
                                                   alert(error);
                                                 }
                                             });
                });
                
                $('.removeQuali').click(function(){
                    var id = $(this).attr('id');
               var url = "index.php?section=script&action=removeQuali&data="+id;
                       
               //alert(id);
               $.ajax({
                                           type: "POST",
                                           //dataType: "json",
                                           url: url,
                                           //data: params,
                                           success: function( data ) {
                                             //alert(data);
                                            location.reload();

                                              },
                                           complete: function (xObj, status){
                                                 
                                                 
                                           },
                                           error: function (x, status, error){
                                                   alert(error);
                                                 }
                                             });
                });
                
                $('.removePromo').click(function(){
                    var id = $(this).attr('id');
               var url = "index.php?section=script&action=removePromo&data="+id;
                       
               //alert(id);
               $.ajax({
                                           type: "POST",
                                           //dataType: "json",
                                           url: url,
                                           //data: params,
                                           success: function( data ) {
                                             //alert(data);
                                            location.reload();

                                              },
                                           complete: function (xObj, status){
                                                 
                                                 
                                           },
                                           error: function (x, status, error){
                                                   alert(error);
                                                 }
                                             });
                });
           });
           
           
           
           
           
</script>
<?php  

require_once 'views/footer.php';



