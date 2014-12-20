<?php

require_once 'views/header.php';
require_once 'views/nav.php';
?>
       
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Apply for Leave</h1>
           
          <div class="row">
              <div class="col-md-7">
                <form class="form" role="form" method='POST'>

                  <div class="form-group">
                      <label >Start Date:</label>
                      <input type="text" class="form-control" name="leave_startdate" id="" placeholder="Enter Date">
                    </div>
                  <div class="form-group">
                      <label >End Date:</label>
                      <input type="text" class="form-control" name="leave_enddate" id="" placeholder="Enter Date">
                    </div>
                  <div class="form-group">
                      <label >Details:</label>
                      <textarea class="form-control" name="leave_details" rows="3"></textarea>
                    </div>
                  <br>
                  <button type="submit" class="btn btn-default">Submit</button>
                  <input type="hidden" name="formHandler" value="leave-apply" />
                </form>
              </div>
              
              <div class="col-md-5">
                  <div class="panel panel-primary">
                            <div class="panel-heading">Leave Application Instructions</div>
                            <div class="panel-body">
                                <ul>
                                    <li> Enter the details of your leave application in the form on the left specifying the Start and End Date in the format (YYYY-MM-DD). All fields are compulsory.</li>
                                </ul>
                            </div>
                            <div class="panel-footer"></div>
                          </div>
              </div>
              
          </div>
            
          
          <br>
          <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <?php echo $error; ?>
          </div>
          <hr/>
          
          
        </div>
<?php  

require_once 'views/footer.php';



