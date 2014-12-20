<?php

require_once 'views/header.php';
require_once 'views/nav.php';

$u = new Utilities();


$notifications = $u->getUserNotifications($_SESSION['acc_id']);
$log = new LogManager();
$logs = $log->getUserLog($_SESSION['acc_id']);
$passport = new Passport($_SESSION['acc_id'])
?>
       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>
           
            <div class="row">
                <div class="col-md-4">
                    
                           
                              <div class="thumbnail">
                                  <img data-src="holder.js/300x300" width="300px" height="300px" src="<?php echo $passport->getPassport($_SESSION['acc_id']); ?>" alt="...">
                                <div class="caption">
                                    <h3>Welcome <?php echo $staff->getFullName($_SESSION['acc_id']); ?></h3>
                                  
                                  
                                </div>
                              </div>
                            
                         
                </div>
                
                <div class="col-md-4">
                   
                        <div class="panel panel-primary">
                            <div class="panel-heading">System Notifications</div>
                            <div class="panel-body">
                                <ul>
                                    <?php echo $notifications; ?>
                                </ul>
                            </div>
                            <div class="panel-footer"></div>
                          </div>
                        
                    
                </div>
                
                <div class="col-md-4">
                   
                        <div class="panel panel-primary">
                            <div class="panel-heading">Activity Logs</div>
                            <div class="panel-body">
                                <ul>
                                    <?php echo $logs; ?>
                                </ul>
                            </div>
                            <div class="panel-footer"></div>
                          </div>
                    
                </div>
            </div>
          
          
        </div>
<?php  

require_once 'views/footer.php';



