<?php

require_once 'views/header.php';
require_once 'views/nav.php';

$acct = new StaffAccounts();

$passport = new Passport($data);

?>
       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">User Profile</h1>
           
            <div class="row">
                <div class="col-md-3">
                    
                        <div class="panel panel-primary">
                            <div class="panel-heading">Passport Photograph <span class="glyphicon glyphicon-pencil pull-right" title="Edit"></span></div>
                            <div class="panel-body" style="text-align: center">
                                
                                <img class="img-responsive img-circle"  data-src="holder.js/300x300" width="300px" height="300px" src="<?php echo $passport->getPassport($data); ?>" alt="...">
                               
                            </div>
                           
                        </div>
                    
                    <?php if($_SESSION['acc_type'] == 3){ ?>
                    <div class="panel panel-danger">
                            <div class="panel-heading">Administrative options</div>
                            <div class="panel-body" >
                                
                               <div class="list-group">
                                   
                                <a href="index.php?section=accounts&action=updateProfile&data=<?php echo $data; ?>" class="list-group-item">Update User Profile</a>
                                
                                
                              </div>
                               
                            </div>
                           
                        </div>   
                    <?php } ?>
                            
                         
                </div>
                
                <div class="col-md-9">
                   <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Bio-Data <span class="glyphicon glyphicon-pencil pull-right" title="Edit"></span></div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <tr><td style="width: 25%">First Name</td><td><?php echo $acct->getFirstName($data); ?></td></tr>
                                    <tr><td>Middle Name</td><td> <?php echo $acct->getMiddleName($data); ?></td></tr>
                                    <tr><td>Last Name</td><td> <?php echo $acct->getLastName($data); ?></td></tr>
                                  </table>
                            </div>
                           
                          </div>
                        
                    
                    </div>
                
                
                    <div class="col-md-6">

                           <div class="panel panel-primary">
                               <div class="panel-heading">Contact Information <span class="glyphicon glyphicon-pencil pull-right" title="Edit"></span></div>
                               <div class="panel-body">
                                   <table class="table table-striped">
                                       <?php
                                            $contacts = new ContactAddress($data);
                                            $phones = $contacts->getPhones();
                                            $address = $contacts->getAddress();
                                            $email = $contacts->getEmails();
                                       ?>
                                       <tr><td style="width: 30%">Phone Numbers</td><td><?php echo $phones['pri_phone_num'].", ".$phones['other_phone_num']; ?></td></tr>
                                       <tr><td>Contact Address</td><td><?php echo $address['contact_address']; ?></td></tr>
                                       <tr><td>Email Address</td><td><?php echo $email['pri_email_address'].", ".$email['other_email_address']; ?></td></tr>
                                     </table>
                               </div>

                             </div>


                   </div>
                    
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Next of Kin <span class="glyphicon glyphicon-pencil pull-right" title="Edit"></span></div>
                            <div class="panel-body">
                                <?php 
                                
                                $nok = new NextOfKin($data);
                                
                                
                                ?>
                                
                                <table class="table table-striped">
                                    <tr><td style="width: 25%">Full name</td><td><?php echo $nok->getNOKName($data); ?></td></tr>
                                    <tr><td>Contact Address</td><td><?php echo $nok->getNOKAddress($data); ?></td></tr>
                                    <tr><td>Phone Number</td><td><?php echo $nok->getNOKEmail($data); ?></td></tr>
                                    <tr><td>Email Address</td><td><?php echo $nok->getNOKPhone($data); ?></td></tr>
                                  </table>
                            </div>
                           
                          </div>
                        
                    
                    </div>
                
                    <div class="col-md-6">

                           <div class="panel panel-primary">
                               <div class="panel-heading">Employment Information <span class="glyphicon glyphicon-pencil pull-right" title="Edit"></span></div>
                               <div class="panel-body">
                                   <?php
                                   
                                   $emp_info = new EmploymentInfo($data);
                                   $depts = new Departments();
                                   
                                   $dept = $depts->getDeptName($emp_info->getDept());
                                   $emp_dates = $emp_info->getEmpDates();
                                   ?>
                                   
                                   <table class="table table-striped">
                                       <tr><td style="width: 30%">Grade Level</td><td><?php echo $emp_info->getGradeLevel(); ?></td></tr>
                                       <tr><td>Step</td><td><?php echo $emp_info->getStep(); ?></td></tr>
                                       <tr><td>Employment Date</td><td><?php echo $emp_dates['emp_date']; ?></td></tr>
                                       <tr><td>Last Promotion Date</td><td><?php echo $emp_dates['emp_last_promo_date']; ?></td></tr>
                                       <tr><td>Department</td><td><?php echo $dept; ?></td></tr>
                                     </table>
                               </div>

                             </div>


                   </div>
                
                    <div class="col-md-12">
                        
                        <?php
                        $qualis = new Qualifications($data);
                        
                        $output_data = $qualis->getStaffQualifications();
                        
                        //echo $_SESSION['acc_id'];
                        
                        
                        ?>

                           <div class="panel panel-primary">
                               <div class="panel-heading">Qualifications <span class="glyphicon glyphicon-pencil pull-right" title="Edit"></span> </div>
                               <div class="panel-body">
                                   <table class="table table-striped">
                                       <?php echo $output_data; ?>
                                     </table>
                               </div>

                             </div>


                   </div>
                    
                    
                    
                    <div class="col-md-12">

                           <div class="panel panel-primary">
                               <div class="panel-heading">Promotions <span class="glyphicon glyphicon-pencil pull-right" title="Edit"></span> </div>
                               <div class="panel-body">
                                   
                                   <?php
                                    $promos = new Promotions($data);
                                    $promo = $promos->getStaffPromotions();
                                    if($promo != false){
                                        if(is_array($promo[0]) == true){
                                            $output_data = "<tr><td>Promotion Date</td><td>Previous Level</td><td>Previous Step</td><td>New Level</td><td>New Step</td></tr>";
                                            foreach($promo as $p){
                                                $output_data .= "<tr><td>".$p['promo_date']."</td><td>".$p['promo_prev_level']."</td><td>".$p['promo_prev_step']."</td><td>".$p['promo_new_level']."</td><td>".$p['promo_new_step']."</td></tr>";
                                            }
                                        }else{
                                            $p = $promo;
                                           $output_data .= "<tr><td>".$p['promo_date']."</td><td>".$p['promo_prev_level']."</td><td>".$p['promo_prev_step']."</td><td>".$p['promo_new_level']."</td><td>".$p['promo_new_step']."</td></tr>";
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
<?php  

require_once 'views/footer.php';



