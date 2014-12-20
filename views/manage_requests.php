<?php

require_once 'views/header.php';
require_once 'views/nav.php';

$req = new Requests(0);
$file = new FileManager();
$acc = new StaffAccounts();

if(isset($data)){
    $req_details = $req->getRequest($data);
    
    if($req_details != false){
        $tbl_req_details = "<tr><td>Submission Date</td><td>".$req_details['req_date']."</td></tr>"
                . "<tr><td>Request Details</td><td>".$req_details['req_details']."</td></tr>"
                . "<tr><td>Attachment File</td><td><a href='". $file->getFileURL($req_details['req_file_id'])."'>Download File</a></td></tr>";
        
        $req_status_details = $req->getRequestStatus($data);
        
        $req_status = $req_status_details['req_status'] == 0 ? "PENDING":"TREATED";
        $tbl_req_status = "<tr><td>Request Status</td><td>".$req_status."</td></tr>"
                . "<tr><td>Processed By</td><td>".$acc->getFullName($req_status_details['processed_by_id'])."</td></tr>"
                . "<tr><td>Comment</td><td>".$req_status_details['comment']."</td></tr>";
    }else{
        $tbl_req_details = "No data Found!";
    }
}
?>
       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Manage Requests</h1>
           
          <div class="row">
              
              <div class="col-md-6">
                  <div class="panel panel-primary">
                               <div class="panel-heading">Request Details </div>
                               <div class="panel-body">
                                   <table class="table table-striped">
                                       <?php echo $tbl_req_details; ?>
                                   </table>
                               </div>

                             </div>
              </div>
              
              <div class="col-md-6">
                  <div class="panel panel-primary">
                               <div class="panel-heading">Approval </div>
                               <div class="panel-body">
                                   <table class="table table-striped">
                                       <?php echo $tbl_req_status; ?>
                                   </table>
                                   
                                   <hr/>
                                   <?php if(isset($data)){ ?>
                                   <form class="form" method="POST">
                                       <table class="table table-striped">
                                       <tr>
                                           <td>
                                               Request Status
                                           </td>
                                           <td>
                                               <select name="req_status">
                                                   <option value="0">PENDING</option>
                                                   <option value="1">TREATED</option>
                                               </select>
                                           </td>
                                       </tr>
                                       <tr>
                                           <td>
                                               Comment
                                           </td>
                                           <td>
                                               <textarea name='req_comment'></textarea>
                                           </td>
                                       </tr>
                                       </table>
                                       <input type="submit" value="Submit" />
                                   <input type ="hidden" name="formHandler" value="request-status-update" />
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
                       <th>Date of Submission</th>
                        <th>Status</th>
                        <th>View Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                       <?php echo $req->getRequests(); ?>
                    </tr>
                </tbody>
            </table>
          </div>
        </div>
<?php  

require_once 'views/footer.php';



