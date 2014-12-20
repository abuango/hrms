<?php

require_once 'views/header.php';
require_once 'views/nav.php';

$lv = new Leave(0);
$file = new FileManager();
$acc = new StaffAccounts();

if(isset($data)){
    $lv_details = $lv->getLeaveRequest($data);
    
    if($lv_details != false){
        $tbl_lv_details = "<tr><td>Start Date</td><td>".$lv_details['leave_start_date']."</td></tr>"
                . "<tr><td>End Date</td><td>".$lv_details['leave_end_date']."</td></tr>"
                . "<tr><td>Leave Details</td><td>".$lv_details['leave_details']."</td></tr>";
        
        $lv_status_details = $lv->getLeaveStatus($data);
        
        switch($lv_status_details['leave_status']){
            case 0 :
                $lv_status = "PENDING";
                break;
            case 1 :
                $lv_status = "APPROVED";
                break;
            case 2 :
                $lv_status = "REJECTED";
                break;
            default;
                break;
        }
        
        $tbl_lv_status = "<tr><td>Leave Status</td><td>".$lv_status."</td></tr>"
                . "<tr><td>Processed By</td><td>".$acc->getFullName($lv_status_details['processed_by_id'])."</td></tr>"
                . "<tr><td>Comment</td><td>".$lv_status_details['comment']."</td></tr>";
    }else{
        $tbl_lv_details = "No data Found!";
    }
}
?>
       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Manage Leave Applications</h1>
           
          <div class="row">
              
              <div class="col-md-6">
                  <div class="panel panel-primary">
                               <div class="panel-heading">Leave Details </div>
                               <div class="panel-body">
                                   <table class="table table-striped">
                                       <?php echo $tbl_lv_details; ?>
                                   </table>
                               </div>

                             </div>
              </div>
              
              <div class="col-md-6">
                  <div class="panel panel-primary">
                               <div class="panel-heading">Approval </div>
                               <div class="panel-body">
                                   <table class="table table-striped">
                                       <?php echo $tbl_lv_status; ?>
                                   </table>
                                   
                                   <hr/>
                                   <?php if(isset($data)){ ?>
                                   <form class="form" method="POST">
                                       <table class="table table-striped">
                                       <tr>
                                           <td>
                                               Leave Status
                                           </td>
                                           <td>
                                               <select name="lv_status">
                                                   <option value="0">PENDING</option>
                                                   <option value="1">APPROVED</option>
                                                   <option value="2">REJECTED</option>
                                               </select>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td>
                                               Comment
                                           </td>
                                           <td>
                                               <textarea name='lv_comment'></textarea>
                                           </td>
                                       </tr>
                                       </table>
                                       <input type="submit" value="Submit" />
                                   <input type ="hidden" name="formHandler" value="leave-status-update" />
                                   </form>
                                   
                                   <?php } ?>
                               </div>

                             </div>
              </div>
              
          </div>
          
          <br>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <?php echo $error; ?>
          </div>
          <hr/>
          
          <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        
                        <th>Staff Number</th>
                        <th>Staff Name</th>
                        <th>Department</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>View Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       <?php echo $lv->getLeaveRequests(); ?>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
<?php  

require_once 'views/footer.php';



